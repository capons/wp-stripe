<?php

    
if(!session_id()) {
    session_start();
}
    
//Application Configurations
$app_id		= trim($results->fb_id);
$app_secret	= trim($results->fb_secret);
$site_url	= get_permalink($data->postID);

if( ($app_id != "") && ($app_secret != "") ) {
    
    try{
            include_once "Facebook/autoload.php";
    }catch(Exception $e){
            error_log($e);
    }
    // Create our application instance
    $fb = new Facebook\Facebook([
      'app_id' => $app_id,
      'app_secret' => $app_secret,
      'default_graph_version' => 'v2.5',
    ]);


    $helper = $fb->getRedirectLoginHelper();
    $accessToken = $helper->getAccessToken();

    if(isset($accessToken)) {

        $fb->setDefaultAccessToken($accessToken);
        try {
            $response = $fb->get('/me?fields=id,name,email');
            $userNode = $response->getGraphUser();
          } catch(Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
          } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
          }

          $user_info = array();
          $user_info['name'] = $userNode->getName();
          $user_info['email'] = $userNode->getEmail();

    } else {


       $permissions = ['email'];
       $loginUrl = $helper->getLoginUrl($site_url, $permissions);

    }
    
}


?>