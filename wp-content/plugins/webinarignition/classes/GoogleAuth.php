<?php

class GoogleAuth {

    protected $CLIENT_ID = '389867382099-7n4bl6od5dnjj3n72e2grgq800ben2q2.apps.googleusercontent.com';
    protected $CLIENT_SECRET = 'lsiKFuCQvk1iQECSzcfzc9cC';

    public function __construct() {
        if (!session_id())
            session_start();
        $old_include_path = set_include_path(WEBINARIGNITION_PATH . '/services');
        require_once 'Google/Client.php';
        require_once 'Google/Service/YouTube.php';

        if (isset($_GET['code'])) {
            $this->google_client()->authenticate($_GET['code']);
            $_SESSION['token'] = $this->google_client()->getAccessToken();
            header('Location: ' . $this->get_actual_redirect_uri());
        }

        set_include_path($old_include_path);
    }

    protected function get_redirect_uri() {
        //use signle domain to bypass redirect_uri mismatch issue
        $redirect = 'http://webinarignition.com/redirecter/';
        return $redirect;
    }

    protected function get_actual_redirect_uri() {
        $redirect = filter_var('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
            FILTER_SANITIZE_URL);
        $parsed = parse_url($redirect);
        parse_str($parsed['query'], $parsed);
        unset($parsed['state'], $parsed['code']);
        $parsed = http_build_query($parsed);
        $redirect = preg_replace('~\?.*$~is', '?' . $parsed, $redirect);
        return $redirect;
    }

    protected function get_redirect_state() {
        $redirect = $this->get_actual_redirect_uri();
        return base64_encode($redirect);
    }

    public function google_client() {
        static $_google_client = null;
        if (is_null($_google_client)) {
            $_google_client = new Google_Client();
            $_google_client->setClientId($this->CLIENT_ID);
            $_google_client->setClientSecret($this->CLIENT_SECRET);
            $_google_client->setApprovalPrompt('auto');
            $_google_client->setAccessType('offline');
            $_google_client->setScopes('https://www.googleapis.com/auth/youtube');
            $_google_client->setState($this->get_redirect_state());
            $_google_client->setRedirectUri($this->get_redirect_uri());
        }
        if (!empty($_SESSION['token']) || $tok = get_option('wi_google_auth_token')) {
            if (!isset($tok))
                $tok = json_decode($_SESSION['token']);
            $_SESSION['token'] = json_encode($tok);
            if (!empty($tok) && (intval($tok->created) + intval($tok->expires_in)) <= time()) {
                $tok = get_option('wi_google_auth_token');
                try {
                    $_google_client->refreshToken($tok->refresh_token);
                } catch (Google_Auth_Exception $e) {
                    delete_option('wi_google_auth_token');
                    unset($_SESSION['token']);
                    $_google_client->revokeToken($tok->access_token);
                }
            } else
                $_google_client->setAccessToken($_SESSION['token']);
        }
        return $_google_client;
    }

    public function refresh_token() {
        $tok = get_option('wi_google_auth_token');
        try {
            $this->google_client()->refreshToken($tok->refresh_token);
        } catch (Google_Auth_Exception $e) {
            delete_option('wi_google_auth_token');
            unset($_SESSION['token']);
            $this->google_client()->revokeToken($tok->access_token);
        }
    }

    public function youtube_client() {
        static $_youtube_client = null;
        if (is_null($_youtube_client)) {
            $_youtube_client = new Google_Service_YouTube($this->google_client());
        }
        return $_youtube_client;
    }

    public function is_authorized() {
        if ($_access_token = $this->google_client()->getAccessToken()) {
            $tok = json_decode($_access_token);
            if (isset($tok->refresh_token))
                update_option('wi_google_auth_token', $tok);
            $_SESSION['token'] = $_access_token;
            return true;
        }
        return false;
    }

    public function get_auth_url() {
        // If the user hasn't authorized the app, initiate the OAuth flow
        return $this->google_client()->createAuthUrl();
    }

}

/**
 * @global  GoogleAuth $GLOBALS ['GoogleAuth']
 * @name    $GoogleAuth
 * @var     GoogleAuth
 */
$GLOBALS['GoogleAuth'] = new GoogleAuth();