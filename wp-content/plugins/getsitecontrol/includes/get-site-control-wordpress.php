<?php

class GetSiteControlWordPress {

    const PASSWORD_MIN_LENGTH = 4;

    private static $getSiteControl = null;
    public static $version = '1.2';
    public static $autoLoginLink = 'https://app.getsitecontrol.com/api/v1/users/autologin';
    public static $settings = array();
    public static $errors = array();
    public static $actions = array(
        'index' => array(
            'slug' => 'getsitecontrol',
            'function' => 'action_admin_menu_page',
            'name' => 'GetSiteControl',
            'title' => 'GetSiteControl for WordPress settings'
        ),
        'auth' => array(
            'sign-out' => array(
                'slug' => 'getsitecontrol_sign_out',
                'function' => 'action_admin_menu_sign_out',
                'name' => 'Sign out',
                'title' => 'Sign out - GetSiteControl'
            ),
        ),
        'guest' => array(
            'sign-in' => array(
                'slug' => 'getsitecontrol_sign_in',
                'function' => 'action_admin_menu_sign_in',
                'name' => 'Sign in',
                'title' => 'Sign in to GetSiteControl'
            ),
            'sign-up' => array(
                'slug' => 'getsitecontrol_sign_up',
                'function' => 'action_admin_menu_sign_up',
                'name' => 'Sign up',
                'title' => 'Sign up to GetSiteControl'
            ),
        ),

    );

    /**
     * @var Raven_Client
     */
    protected static $ravenClient = null;

    public function __construct() {

    }


    /**
     * Get instance
     *
     * @return GetSiteControlWordPress|null
     */
    public static function init() {
        if ( is_null( self::$getSiteControl ) ) {
            self::$getSiteControl = new self();
            self::add_actions();
            self::$settings = self::gsc_settings();
            if ( empty( self::$settings ) || ( self::$version !== self::$settings['version'] ) ) {
                self::install( self::$settings );
            }
        }
        return self::$getSiteControl;
    }


    /**
     * Set GetSiteControl settings
     *
     * @param $gsc_settings
     */
    public static function install( $gsc_settings ) {
        if ( empty( $gsc_settings ) ) {
            $gsc_settings = array(
                'api_key' => null,
                'version' => self::$version,
                'widget_id' => null,
                'widget_link' => null,
            );
            add_option( 'get_site_control_settings', $gsc_settings );
        }

        if ( self::$version !== $gsc_settings['version'] ) {
            self::update( $gsc_settings );
        }
    }


    /**
     * Update GetSiteControl settings
     *
     * @param $gsc_settings
     */
    public static function update( $gsc_settings ) {
        $gsc_settings['version'] = self::$version;
        update_option( 'get_site_control_settings', $gsc_settings );
    }


    /**
     * Get GetSiteControl settings
     *
     * @return mixed|void
     */
    public static function gsc_settings() {
        return get_option( 'get_site_control_settings' );
    }


    /**
     * Add actions for plugin
     */
    public static function add_actions() {
        if ( is_admin() ) {
            add_action( 'admin_init', array( __CLASS__, 'redirect_rule' ) );
            add_action( 'admin_init', array( __CLASS__, 'post_clear_api_key' ) );
            add_action( 'admin_init', array( __CLASS__, 'post_sign_in' ) );
            add_action( 'admin_init', array( __CLASS__, 'post_sign_up' ) );
            add_action( 'admin_init', array( __CLASS__, 'post_update_widget' ) );

            add_action( 'admin_menu', array( __CLASS__, 'admin_menu_add' ) );
            add_action( 'admin_menu', array( __CLASS__, 'admin_sub_menu_add' ) );

            add_action( 'admin_enqueue_scripts', array( __CLASS__, 'admin_scripts' ) );
        } else {
            if( function_exists( 'wp_print_footer_scripts' ) ) {
                add_action( 'wp_print_footer_scripts', array( __CLASS__, 'add_script' ) );
            } else {
                add_action( 'wp_footer', array( __CLASS__, 'add_script' ) );
            }
        }
    }


    /**
     * Add plugin link in sidebar
     */
    public static function admin_menu_add() {
        add_menu_page(
            self::$actions['index']['title'],
            self::$actions['index']['name'],
            'manage_options',
            self::$actions['index']['slug'],
            array( __CLASS__, self::$actions['index']['function'] ),
            GSC_URL . 'templates/images/logo@2x.png'
        );
    }


    /**
     * Add plugin sub links in sidebar
     */
    public static function admin_sub_menu_add() {
        $type = 'auth';

        if (empty(self::$settings['api_key'])) {
            $type = 'guest';
        }

        foreach (self::$actions[$type] as $action) {
            add_submenu_page(self::$actions['index']['slug'], $action['title'], $action['name'], 'manage_options', $action['slug'], array( __CLASS__, $action['function'] ));
        }
    }


    /**
     * Register styles and scripts
     */
    public static function admin_scripts() {
        wp_enqueue_style( 'gsc_admin_style', GSC_URL . 'templates/css/get-site-control-admin.css', '', self::$version );
        wp_enqueue_script( 'gsc_admin_script', GSC_URL . 'templates/js/get-site-control-admin.js', '', self::$version, true );
    }


    /**
     * Add script before </body>
     */
    public static function add_script() {
        if( !empty(self::$settings['widget_link']) ) {
            echo "
                <script id='gscq" . self::$settings['widget_id'] . "'>window._gscq = window._gscq || []</script>\n
                <script id='gsc" . self::$settings['widget_id'] . "' src='" . self::$settings['widget_link'] . "' async defer></script>\n
            ";
        }
    }


    /**
     * Main page action
     */
    public static function action_admin_menu_page() {
        self::check_access_die();

        $siteUrl = get_option('siteurl');
        $widgetsArray = array();

        $response = GetSiteControlApi::getRestClient()->get( 'sites/own', array('api_key' => self::$settings['api_key']) );

        if (empty($response->error)) {
            $responseObject = json_decode($response->response);

            //If API_KEY no expired
            if ($response->info->http_code != 401) {
                foreach ((array) $responseObject->objects as $object) {
                    $widgetsArray[] = array(
                        'id' => $object->id,
                        'script_rendered_url' => $object->script_rendered_url,
                        'url' => $object->url,
                        'manage_link' => self::$autoLoginLink . '?api_key=' . self::$settings['api_key'] . '&next=/#/dashboard/sites/' . $object->id . '/widgets/list'
                    );
                }

                $url_exist = false;
                foreach($widgetsArray as $widget) {
                    if (self::compare_urls($siteUrl, $widget['url'])) {
                        $url_exist = true;
                        if (self::$settings['widget_id'] != $widget['id'] || self::$settings['widget_link'] != $widget['script_rendered_url']) {
                            self::$settings['widget_id'] = $widget['id'];
                            self::$settings['widget_link'] = $widget['script_rendered_url'];
                            self::update(self::$settings);
                        }
                        break;
                    }
                }

                self::render_template(
                    'index',
                    array(
                        'data' => $widgetsArray,
                        'settings' => self::$settings,
                        'url_exist' => $url_exist,
                        'add_site_link' =>  self::$autoLoginLink . '?api_key=' . self::$settings['api_key'] . '&next=/#/dashboard/sites/manage',
                    )
                );

            } else {
                self::$settings['api_key'] = null;
                self::update(self::$settings);

                self::render_template(
                    'api_key_expired',
                    array(
                        'sign_in_link' => admin_url( 'admin.php?page=' . self::$actions['guest']['sign-in']['slug'] ),
                    )
                );
            }
        } else {
            self::render_template(
                'service_unavailable',
                array(
                    'error' => $response->error
                )
            );
        }
    }


    /**
     * Processing update widget id form
     */
    public function post_update_widget() {
        if (self::post('gsc_update_widget') && self::check_access() && check_admin_referer() && !empty(self::$settings['api_key'])) {

            $response = GetSiteControlApi::getRestClient()->get( 'sites/own', array('api_key' => self::$settings['api_key']) );

            if (empty($response->error)) {
                $responseObject = json_decode($response->response);

                //If API_KEY no expired
                if ($response->info->http_code != 401) {
                    foreach ((array) $responseObject->objects as $object) {
                        if (self::post('gsc_widget') == $object->id) {
                            self::$settings['widget_id'] = $object->id;
                            self::$settings['widget_link'] = $object->script_rendered_url;
                            self::update(self::$settings);
                            break;
                        }
                    }
                } else {
                    self::$settings['api_key'] = null;
                    self::update(self::$settings);
                }
            }

            wp_redirect( admin_url( 'admin.php?page=' . self::$actions['index']['slug'] ) );
        }
    }


    /**
     * Sign out action
     */
    public function action_admin_menu_sign_out() {
        self::check_access_die();
        self::render_template('sign_out');
    }


    /**
     * Processing sign out form
     */
    public function post_clear_api_key() {
        if (self::post('gsc_clear_api_key') && self::check_access() && check_admin_referer()) {
            self::$settings['api_key'] = null;
            self::update(self::$settings);
            wp_redirect( admin_url( 'admin.php?page=' . self::$actions['index']['slug'] ) );
        }
    }


    /**
     * Sign in action
     */
    public function action_admin_menu_sign_in() {
        self::check_access_die();

        $data['email'] = self::post('gsc_email', false, get_option('admin_email'));
        $data['password'] = self::post('gsc_password');

        self::render_template(
            'sign_in',
            array(
                'sign_up_link' => admin_url( 'admin.php?page=' . self::$actions['guest']['sign-up']['slug'] ),
                'data' => $data,
                'errors' => self::$errors,
            )
        );
    }


    /**
     * Processing a sign in form
     */
    public function post_sign_in() {
        if (self::post('gsc_sign_in') && check_admin_referer()) {
            $data['email'] = self::post('gsc_email');
            $data['password'] = self::post('gsc_password');

            if (self::validate($data, 'auth')) {

                $response = GetSiteControlApi::getRestClient()->post(
                    'users/login',
                    json_encode(array(
                        'email' => $data['email'],
                        'password' => $data['password'],
                    ))
                );

                if (empty($response->error)) {
                    $responseObject = json_decode($response->response);

                    if (empty($responseObject->error)) {
                        if (!empty($responseObject->api_key)) {
                            //If no errors, save the api key and login url
                            self::$settings['api_key'] = $responseObject->api_key;
                            self::update(self::$settings);
                            wp_redirect( admin_url( 'admin.php?page=' . self::$actions['index']['slug'] ) );
                        } else {
                            $errorMessage = 'Oops! Something wrong. Api key cannot be empty.';
                            self::log($errorMessage, $response);
                            self::$errors['__all__'][] = $errorMessage;
                        }
                    } else {
                        foreach((array) $responseObject->error->field_errors as $field => $messages) {
                            foreach($messages as $message) {
                                self::$errors[$field][] = $message;
                            }
                        }
                    }
                } else {
                    self::$errors['__all__'][] = $response->error;
                }
            }
        }
    }


    /**
     * Sign up action
     */
    public function action_admin_menu_sign_up() {
        self::check_access_die();

        $data['name'] = self::post('gsc_name');
        $data['email'] = self::post('gsc_email', false, get_option('admin_email'));
        $data['password'] = self::post('gsc_password');
        $data['site'] = self::post('gsc_site', false, get_option('siteurl'));

        self::render_template(
            'sign_up',
            array(
                'sign_in_link' => admin_url( 'admin.php?page=' . self::$actions['guest']['sign-in']['slug'] ),
                'data' => $data,
                'errors' => self::$errors,
            )
        );
    }


    /**
     * Processing a sign up form
     */
    public function post_sign_up() {
        if (self::post('gsc_sign_up') && check_admin_referer()) {
            $data['name'] = self::post('gsc_name');
            $data['email'] = self::post('gsc_email');
            $data['password'] = self::post('gsc_password');
            $data['site'] = self::post('gsc_site');

            if (self::validate($data, 'register')) {

                $response = GetSiteControlApi::getRestClient()->post(
                    'users/register',
                    json_encode(array(
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'password' => $data['password'],
                        'site' => $data['site'],
                        'tracking' => array(
                            'context' => 'utm_campaign=WorpressPlugin&utm_medium=plugin',
                        ),
                    ))
                );

                if (empty($response->error)) {
                    $responseObject = json_decode($response->response);

                    if (empty($responseObject->error)) {
                        //If no errors, save the api key and login url
                        self::$settings['api_key'] = $responseObject->api_key;
                        self::update(self::$settings);
                        wp_redirect( admin_url( 'admin.php?page=' . self::$actions['index']['slug'] ) );
                    } else {
                        foreach((array) $responseObject->error->field_errors as $field => $messages) {
                            foreach($messages as $message) {
                                self::$errors[$field][] = $message;
                            }
                        }
                    }
                } else {
                    self::$errors['__all__'][] = $response->error;
                }
            }
        }
    }


    /**
     * Redirect rules
     */
    public static function redirect_rule() {
        $action = self::get('page');

        if ($action == self::$actions['index']['slug'] && empty(self::$settings['api_key'])) {
            wp_redirect( admin_url( 'admin.php?page=' . self::$actions['guest']['sign-up']['slug'] ) );
        }
    }


    /**
     * Render template by name
     *
     * @param $viewFile
     * @param array $params
     */
    protected static function render_template($viewFile, $params = array()) {
        $path = GSC_PATH . '/templates/' . $viewFile . '.php';

        if (file_exists($path)) {
            foreach($params as $paramKey => $paramValue) {
                $$paramKey = $paramValue;
            }
            include_once($path);
        } else {
            wp_die('The template file (' . $viewFile . '.php) not found!');
        }
    }


    /**
     * Check user access
     *
     * @return bool
     */
    protected static function check_access() {
        return current_user_can('manage_options');
    }


    /**
     * Check user access with die
     */
    protected static function check_access_die () {
        if (!self::check_access()) {
            wp_die('You do not have sufficient permissions to access this page');
        }
    }


    /**
     * Scenarios list
     *
     * @return array
     */
    protected static function scenarios() {
        return array(
            'auth' => array('email', 'password'),
            'register' => array('name', 'email', 'password', 'site'),
        );
    }


    /**
     * Form validation
     *
     * @param $data
     * @param $scenario
     * @return bool
     */
    protected static function validate($data, $scenario) {
        $scenarios = self::scenarios();
        if (!array_key_exists($scenario, $scenarios)) {
            wp_die('Unknown scenario!');
        }

        foreach($scenarios[$scenario] as $scenarioItem) {
            call_user_func(__CLASS__ . '::' . $scenarioItem . '_validator', !empty($data[$scenarioItem]) ? $data[$scenarioItem] : null);
        }

        return empty(self::$errors);
    }


    /**
     * Name validator
     *
     * @param $data
     * @return bool
     */
    public static function name_validator($data) {
        $valid = true;

        if (empty($data)) {
            self::$errors['name'][] = 'Specify your name';
            $valid = false;
        } else if (!preg_match("#^[a-zA-Zа-яёА-ЯЁ0-9_\.\s\-]{3,}$#u", $data)) {
            self::$errors['name'][] = 'Please enter a valid name';
            $valid = false;
        }

        return $valid;
    }


    /**
     * E-mail validator
     *
     * @param $data
     * @return bool
     */
    public static function email_validator($data) {
        $valid = true;

        if (empty($data)) {
            self::$errors['email'][] = 'Specify your email address';
            $valid = false;
        } else if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
            self::$errors['email'][] = 'Please enter a valid email address';
            $valid = false;
        }

        return $valid;
    }


    /**
     * Url validator
     *
     * @param $data
     * @return bool
     */
    public static function site_validator($data) {
        $valid = true;

        if (empty($data)) {
            self::$errors['site'][] = 'Specify your site URL';
            $valid = false;
        } else if (!filter_var($data, FILTER_VALIDATE_URL)) {
            self::$errors['site'][] = 'Please enter a valid URL';
            $valid = false;
        }

        return $valid;
    }


    /**
     * Password validator
     *
     * @param $data
     * @return bool
     */
    public static function password_validator($data) {
        $valid = true;

        if (empty($data)) {
            self::$errors['password'][] = 'Enter your password';
            $valid = false;
        } else if (strlen($data) < self::PASSWORD_MIN_LENGTH) {
            self::$errors['password'][] = 'Your password must have a minimum of 4 characters';
            $valid = false;
        }

        return $valid;
    }

    /**
     * Compare Urls
     *
     * @param $url1
     * @param $url2
     * @return bool
     */
    protected static function compare_urls($url1, $url2) {
        $url1 = trim( str_replace(array('http://', 'https://'), '', $url1), '/' );
        $url2 = trim( str_replace(array('http://', 'https://'), '', $url2), '/' );
        return $url1 == $url2;
    }


    /**
     * Get value from $_GET
     *
     * @param $param
     * @param bool|false $allowEmpty
     * @param null $default
     * @return null
     */
    protected static function get($param, $allowEmpty = false, $default = null) {
        if ( (isset($_GET[$param]) && $allowEmpty) || (!empty($_GET[$param]) && !$allowEmpty) ) {
            return $_GET[$param];
        } else {
            return $default;
        }
    }


    /**
     * Get value from $_POST
     *
     * @param $param
     * @param bool|false $allowEmpty
     * @param null $default
     * @return null
     */
    protected static function post($param, $allowEmpty = false, $default = null) {
        if ( (isset($_POST[$param]) && $allowEmpty) || (!empty($_POST[$param]) && !$allowEmpty) ) {
            return $_POST[$param];
        } else {
            return $default;
        }
    }


    /**
     * Logging of errors
     *
     * @param $errorMessage
     * @param $response
     */
    public static function log($errorMessage, $response) {
        if (is_null(self::$ravenClient)) {
            self::$ravenClient = new Raven_Client('http://93839f2da63e45e681d1f185beeb5faa:282cdcd7eaac40b794f28c172e9fa314@logs.getsitecontrol.com/14');
        }

        self::$ravenClient->captureMessage(
            $errorMessage,
            array(
                'server' => !empty($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : null,
                'code' => !empty($response->info->http_code) ? $response->info->http_code : null,
                'response' => !empty($response->response) ? $response->response : null,
            )
        );
    }
}