<?php

// Edit Campaign // Save
add_action('wp_ajax_webinarignition_edit', 'webinarignition_edit_callback');
add_action('wp_ajax_webinarignition_test_smtp', 'webinarignition_test_smtp');
add_action('wp_ajax_webinarignition_test_sms', 'webinarignition_test_sms');
add_action('wp_ajax_webinarignition_hangouts_update_embed_video', 'webinarignition_hangouts_update_embed_video');
add_action('wp_ajax_webinarignition_revoke_google_auth', 'webinarignition_revoke_google_auth');
add_action('wp_ajax_webinarignition_process_stripe_charge', 'webinarignition_process_stripe_charge');

function webinarignition_process_stripe_charge() {
    
    $wi_campaign = get_option('webinarignition_campaign_' . $_POST['campaign_id'], false);
    $stripe_secret_key          = $wi_campaign->stripe_secret_key;
    $stripe_charge              = $wi_campaign->stripe_charge;
    $stripe_charge_description  = $wi_campaign->stripe_charge_description;
    
    if(empty($wi_campaign)) {
       die(); 
    }
    
    require 'stripe-php/init.php';
    
    // Set your secret key: remember to change this to your live secret key in production
    // See your keys here https://dashboard.stripe.com/account/apikeys
    \Stripe\Stripe::setApiKey($stripe_secret_key);

    $token = $_POST['token'];
    // Create the charge on Stripe's servers - this will charge the user's card
    try {
      $charge = \Stripe\Charge::create(array(
        "amount" => $stripe_charge, // amount in cents, again
        "currency" => "usd",
        "source" => $token,
        "description" => $stripe_charge_description
        ));
    } catch(\Stripe\Error\Card $e) {
      // The card has been declined
        die(json_encode(array('status' => 0,'error'=>$e->getMessage(), 'token'=> $token, 'charge'=>$charge)));
    }    

    die(json_encode(array('status' => 1, 'token'=> $token, 'charge'=>$charge)));
    
}

function webinarignition_test_smtp() {
    
    $wi_campaign = get_option('webinarignition_campaign_' . $_POST['campaign_id'], false);
    if (empty($wi_campaign))
        die();
        // Include PHPMailerFunction
        require_once 'PHPMailerAutoload.php';
        global $user_email;
        $mail = new PHPMailer;
        //$mail->SMTPDebug = 2; 
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();
        $mail->Host = $wi_campaign->smtp_host;
        $mail->SMTPAuth = true;
        $mail->Username = $wi_campaign->smtp_user;
        $mail->Password = $wi_campaign->smtp_pass;
        $mail->SMTPSecure = $wi_campaign->transfer_protocol ? $wi_campaign->transfer_protocol : 'tls';
        $mail->From = $wi_campaign->smtp_email;
        $mail->FromName = $wi_campaign->smtp_name;
        $mail->Port = $wi_campaign->smtp_port;
        $mail->AddAddress($user_email, 'WebinarIgnition Customer');
        $mail->Subject = 'WebinarIgnition SMTP Testing';
        $mail->Body = 'Hello! This is a test email to make sure your SMTP details are correct. Good day!';

    if (!$mail->send()) {
        
        $mail = new PHPMailer;
        $mail->isSendmail();
        $mail->setFrom($wi_campaign->smtp_email, $wi_campaign->smtp_name);
        $mail->addAddress($user_email, 'WebinarIgnition Customer'); 
        $mail->Subject = 'WebinarIgnition Sendmail Testing';
        $mail->Body = 'Hello! This is a test email to notify you that the SMTP test failed. The good news is that the Sendmail test is successful, and your system will thus use Sendmail to send Webinarignition\'s scheduled notifications.'
                . 'No further action on your part is necessary, besides setting up your cron jobs if you have not done so already. Good day!';        
        
        if(!$mail->send()) {
          
            $subject = 'WebinarIgnition PHP mail() test';
            $body = 'Hello! This is a test email to notify you that the SMTP and Sendmail tests failed. The good news is that the PHP\'s mail() is successful, and your system will thus use PHP\'s mail() function to send Webinarignition\'s notifications.'
                                . 'No further action on your part is necessary, besides setting up your cron jobs if you have not done so already. Good day!'; 
            $headers = 'From: ' . $wi_campaign->smtp_email . "\r\n" .
                'Reply-To: ' . $wi_campaign->smtp_email . "\r\n" .
                'X-Mailer: PHP/' . phpversion();           
            
           if(!mail($user_email, $subject, $body, $headers)) {
                die(json_encode(array('status' => -1, 'errors' => 'PHP mail() test failed')));
               }  else {
                die(json_encode(array('status' => 3, 'errors' => 'PHP\'s mail() test was successful! Check your mailbox for the confirmation message.'))); //PHP mail() test successful
            }
            
        } else {
            die(json_encode(array('status' => 2, 'errors' => 'The Sendmail test was successful! Check your mailbox for the confirmation message.'))); //Sendmail test successful
        } 
                
    } else {
            die(json_encode(array('status' => 1, 'errors' => 'The SMTP test was successful! Check your mailbox for the confirmation message.')));  //Smtp test successful
    }
    
}

function webinarignition_test_sms() {
    // Include Twilio Lib
    require_once 'Services/Twilio.php';
    $wi_campaign = get_option('webinarignition_campaign_' . $_POST['campaign_id'], false);
    if (empty($wi_campaign))
        die();
    $AccountSid = $wi_campaign->twilio_id;
    $AuthToken = $wi_campaign->twilio_token;
    $client = new Services_Twilio($AccountSid, $AuthToken);

    try {

        $client->account->messages->create(array(
            'To' => trim($_POST['phone_number']),
            'From' => $wi_campaign->twilio_number,
            'Body' => 'You received this message to test WebinarIgnition SMS integration.',
        ));

        echo json_encode(array('status' => 1));
    } catch (Exception $e) {
        echo json_encode(array('status' => -1, 'errors' => $e->getMessage()));
    }
    die();
}

function webinarignition_revoke_google_auth() {
    include_once(WEBINARIGNITION_PATH . '/classes/GoogleAuth.php');
    global $GoogleAuth;
    delete_option('wi_google_auth_token');
    unset($_SESSION['token']);
    die();
}

function webinarignition_hangouts_update_embed_video() {
    $option_id = 'webinarignition_campaign_' . $_POST['webinar_id'];
    $wi_campaign = get_option($option_id, false);
    if (empty($wi_campaign))
        die(json_encode(array('status' => 'NOK', 'message' => 'Campaign does not exists!')));

    include_once(WEBINARIGNITION_PATH . '/classes/GoogleAuth.php');
    global $GoogleAuth;
    if (!$GoogleAuth->is_authorized())
        die(json_encode(array('status' => 'NOK', 'message' => 'reauth')));

    try {
        // Execute an API request that lists broadcasts owned by the user who
        // authorized the request.
        $broadcastsResponse = $GoogleAuth->youtube_client()->liveBroadcasts->listLiveBroadcasts(
            'id,status,contentDetails',
            array(
                'mine' => 'true',
            ));

        if (empty($broadcastsResponse['items']))
            die(json_encode(array('status' => 'NOK')));

        $last_item = end($broadcastsResponse['items']);
        $embed_html = $last_item['contentDetails']['monitorStream']['embedHtml'];

        if ($wi_campaign->privacy_status !== 'public') {
            unset($last_item['contentDetails']);
            $last_item['status']['privacyStatus'] = 'unlisted';
            $updateResponse = $GoogleAuth->youtube_client()->liveBroadcasts->update('status', $last_item);
        }

    } catch (Google_ServiceException $e) {
        die(json_encode(array('status' => 'NOK', 'message' => sprintf('<p>A service error occurred: <code>%s</code></p>',
            htmlspecialchars($e->getMessage())))));
    } catch (Google_Exception $e) {
        $GoogleAuth->refresh_token();
        die(json_encode(array('status' => 'NOK', 'message' => sprintf('<p>An client error occurred: <code>%s</code></p>',
            htmlspecialchars($e->getMessage())))));
    }

    if (!empty($embed_html)) {
        $wi_campaign->webinar_live_video = $embed_html;
        $wi_campaign->replay_video = $embed_html;

        update_option($option_id, $wi_campaign);
    }

    die(json_encode(array('status' => 'OK')));
}


    if(!function_exists('wi_build_time')) {
        function wi_build_time($date, $time)
        {
            // ReArrange Date To Fit Format
            if (strpos($date, '-')) {
                $exDate = explode("-", $date);
            } else {
                $exDate = explode("/", $date);
            }

            $exYear = $exDate[2];
            $exMonth = $exDate[0];
            $exDay = $exDate[1];

            $newDate = $exYear . "-" . $exMonth . "-" . $exDay . " " . $time;

            return $newDate;
        }
    }

function webinarignition_edit_callback() {

    // Get ID & Post Data Array
    $id = $_POST['id'];
    $data = $_POST;

    if(isset($_POST['webinar_source_toggle']) && $_POST['webinar_source_toggle'] == 'iframe') {
        $data['webinar_live_overlay'] = $_POST['webinar_live_overlay1'];
        unset($data['webinar_live_overlay1']);
    }

    foreach ($data as $key => $value) {
        $data[$key] = !is_array($value) ? stripslashes($value) : $value;
    }

    // Convert Array To Object
    $object = array_to_object_wi($data);

    if (strpos($object->webinar_date, '-')) {
        $fullDate = explode("-", $object->webinar_date);
    } else {
        $fullDate = explode("/", $object->webinar_date);
    }

    $objectData = get_option('webinarignition_campaign_' . $id);

    if(strtotime(wi_build_time($objectData->webinar_date, $objectData->webinar_time)) != strtotime(wi_build_time($object->webinar_date  , $object->webinar_time))) {
        //Webinar Date has changed
        // Update email notification dates & times
        $notification_times = wi_webinar_live_notification_times( $fullDate, $object->webinar_start_time );

        $object->email_notiff_date_1 = $notification_times[ 'daybefore' ][ 'date' ];
        $object->email_notiff_time_1 = $notification_times[ 'daybefore' ][ 'time' ];

        $object->email_notiff_date_2 = $notification_times[ 'hourbefore' ][ 'date' ];
        $object->email_notiff_time_2 = $notification_times[ 'hourbefore' ][ 'time' ];

        $object->email_notiff_date_3 = $notification_times[ 'live' ][ 'date' ];
        $object->email_notiff_time_3 = $notification_times[ 'live' ][ 'time' ];

        $object->email_notiff_date_4 = $notification_times[ 'hourafter' ][ 'date' ];
        $object->email_notiff_time_4 = $notification_times[ 'hourafter' ][ 'time' ];

        $object->email_notiff_date_5 = $notification_times[ 'dayafter' ][ 'date' ];
        $object->email_notiff_time_5 = $notification_times[ 'dayafter' ][ 'time' ];

        $object->email_twilio_date = $notification_times[ 'live' ][ 'date' ];
        $object->email_twilio_time = $notification_times[ 'hourbefore' ][ 'time' ];
    }

    // Update Option Field:
    update_option('webinarignition_campaign_' . $id, $object);

    $objectData = get_option('webinarignition_campaign_' . $id);

    // Resave & Redo URL
    $webinarName = $object->webinarURLName2;

    // Get Current Name From DB
    global $wpdb;
    $table_db_name = $wpdb->prefix . "webinarignition";
    $findstat = $wpdb->get_results("SELECT * FROM $table_db_name WHERE id = '$id'", OBJECT);

    foreach ($findstat as $findstat) {

    }

    if ($findstat->appname == $webinarName) {
        // do nothing - same name...
    } else {
        // Update Inside Of DB
        $wpdb->update($table_db_name, array(
                'appname' => $webinarName
            ), array('id' => $id)
        );
        // ReName permalink URL
        $my_post = array();
        $my_post['ID'] = $findstat->postID;
        $my_post['post_name'] = $webinarName;
        wp_update_post($my_post);
    }

    // Check If -- Copy Update

    if ($objectData->copy_time_update == "1") {
        // Do Update With Time & Copy
        $fullDate = $objectData->webinar_date;

        if (strpos($fullDate, '-')) {
            $fullDate = explode("-", $fullDate);
        } else {
            $fullDate = explode("/", $fullDate);
        }

        // $fullDate = explode("-", $fullDate);
        $setDate = $fullDate[2] . "/" . $fullDate[0] . "/" . $fullDate[1];

        $getDate = date('l jS \of F Y', strtotime($setDate));
        $getDate22 = $getDate;
        $getDate = explode(" ", $getDate);

        $getDay = str_replace("th", "", $getDate[1]);
        $getDay = str_replace("rd", "", $getDay);
        $getDay = str_replace("st", "", $getDay);
        $getDay = str_replace("nd", "", $getDay);

        $setTime = $objectData->webinar_start_time;
        $getTime = date("h:i:s A", strtotime($setTime));

        $getTime = explode(" ", $getTime);
        $getHour = explode(":", $getTime[0]);
        $getHour2 = $getHour[0];
        // Check for 0 in front of time..
        if ($getHour2[0] == "0") {
            $getHour2 = str_replace("0", "", $getHour2);
        }

        $timezone = $objectData->webinar_timezone;
        print_r($objectData->webinar_timezone);

        $host = $objectData->webinar_host;
        $desc = $objectData->webinar_desc;
        $orgdate = $objectData->webinar_date;

        $time = $objectData->webinar_start_time;

        $linkToLive = get_permalink($findstat->postID);

        $emailSetup = "Dear {NAME},\n

%%INTRO%%

<b>Date:</b>
Join us on live :: {DATE}

<b>Webinar Topic:</b>
{TITLE}\n

<b>Webinar Hosts:</b>
{HOST}\n

<b># Click here to join:</b>
{LINK}\n

# You will be connected to video using your computer's microphone and speakers.  A headset is recommended.\n

System Requirements:\n

PC-based attendees
Required: Windows® 7, Vista, XP or 2003 Server\n

Mac-based attendees
Required: Mac OS® X 10.6 or newer\n

Mobile attendees
Required: iPhone®, iPad®, Android™ phone or Android tablet\n";


        $clonedResults = get_option('webinarignition_campaign_' . $id);

        // --- EMAIL NOTIFICATION UPDATE SETTINGS --
        //
        // Set Date & Get BeforeDay / NextDay - BeforeTime / NextTime
        //
        $newDate = $fullDate[2] . "-" . $fullDate[0] . "-" . $fullDate[1];
        $newTime = strtotime($clonedResults->webinar_start_time);
        $beforeDay = date("Y-m-d", strtotime('-1 day', strtotime($newDate)));
        $beforeDayReformat = date("m-d-Y", strtotime($beforeDay));
        $nextDay = date("Y-m-d", strtotime('+1 day', strtotime($newDate)));
        $nextDayReformat = date("m-d-Y", strtotime($nextDay));
        $beforeTime = date("H:i", strtotime('-1 hour', $newTime));
        $nextTime = date("H:i", strtotime('+1 hour', $newTime));
        //
        // -- C/U Email #1 - 1 Day Before Webinar
        //
        // Set: Date / Time / SBJ / Body
        //
        $clonedResults->email_notiff_date_1 = $beforeDayReformat;
        $clonedResults->email_notiff_time_1 = $clonedResults->webinar_start_time;
        $clonedResults->email_notiff_status_1 = "queued";
        $clonedResults->email_notiff_sbj_1 = "WEBINAR REMINDER :: Goes Live Tomorrow :: " . $clonedResults->webinar_desc;
        $clonedResults->email_notiff_body_1 = str_replace("%%INTRO%%", "This is a reminder that the webinar you signed up for is tomorrow...<br>", $emailSetup);
        //
        // -- C/U Email #2 - 1 Hour Before Webinar
        //
        // Set: Date / Time / SBJ / Body
        //
        $clonedResults->email_notiff_date_2 = $clonedResults->webinar_date;
        $clonedResults->email_notiff_time_2 = $beforeTime;
        $clonedResults->email_notiff_status_2 = "queued";
        $clonedResults->email_notiff_sbj_2 = "WEBINAR REMINDER :: Goes Live In 1 Hour :: " . $clonedResults->webinar_desc;
        $clonedResults->email_notiff_body_2 = str_replace("%%INTRO%%", "The webinar is live in 1 hour!<br>", $emailSetup);
        //
        // -- C/U Email #3 - Webinar Is Live
        //
        // Set: Date / Time / SBJ / Body
        //
        $clonedResults->email_notiff_date_3 = $clonedResults->webinar_date;
        $clonedResults->email_notiff_time_3 = $clonedResults->webinar_start_time;
        $clonedResults->email_notiff_status_3 = "queued";
        $clonedResults->email_notiff_sbj_3 = "We Are Live";
        $clonedResults->email_notiff_body_3 = str_replace("%%INTRO%%", "We are live, on air and ready to go!<br>", $emailSetup);
        //
        // -- C/U Email #4 - Replay Video Is Live
        //
        // Set: Date / Time / SBJ / Body
        //
        $clonedResults->email_notiff_date_4 = $clonedResults->webinar_date;
        $clonedResults->email_notiff_time_4 = $nextTime;
        $clonedResults->email_notiff_status_4 = "queued";
        $clonedResults->email_notiff_sbj_4 = "Replay Is Ready";
        $clonedResults->email_notiff_body_4 = str_replace("%%INTRO%%", "We just posted the replay video for the webinar tonight...<br>", $emailSetup);
        //
        // -- C/U Email #5 - 1 Day After Live Webinar
        //
        // Set: Date / Time / SBJ / Body
        //
        $clonedResults->email_notiff_date_5 = $nextDayReformat;
        $clonedResults->email_notiff_time_5 = $clonedResults->webinar_start_time;
        $clonedResults->email_notiff_status_5 = "queued";
        $clonedResults->email_notiff_sbj_5 = "Did You See The Replay?";
        $clonedResults->email_notiff_body_5 = str_replace("%%INTRO%%", "Did you get a chance to check out the webinar replay? It's coming down very soon!<br>", $emailSetup);;
        //
        // -- C/U TXT - 1 Hour Before Live Webinar
        //
        // Set: Date / Time / TEXT
        //
        $clonedResults->email_twilio_date = $clonedResults->webinar_date;
        $clonedResults->email_twilio_time = $beforeTime;
        $clonedResults->email_twilio_status = "queued";
        // $clonedResults->twilio_msg = "The webinar is starting soon! Jump On Live: {LINK}";
        // Save New Additions


        $clonedResults->lp_main_headline = '<h4 class="subheader">Introducing This Exclusive Webinar From ' . $host . '</h4><h2 style="margin-top: -10px;">' . $desc . '</h2>';
        $clonedResults->lp_webinar_month = $getDate[3];
        $clonedResults->lp_webinar_day = $getDay;
        $clonedResults->lp_webinar_headline = $getDate[0] . " The " . $getDate[1];
        $clonedResults->lp_webinar_subheadline = "At " . $getHour2 . ":" . $getHour[1] . " " . $getTime[1];
        $clonedResults->cd_headline = '<h4 class="subheader">This Webinar Is Not Live - <b>We Go Live Soon!</b></h4><h2 style="margin-top: -10px; margin-bottom: 30px;">Webinar Starts: ' . $getDate22 . '</h2>';
        $clonedResults->email_signup_sbj = "[Reminder] Your Webinar Starts: " . $getDate22;
        $clonedResults->email_signup_body = str_replace("%%INTRO%%", "Here is the webinar information you just signed up for...<br>", $emailSetup);

        update_option('webinarignition_campaign_' . $id, $clonedResults);

        echo "redirect";
        die();
    }
}
