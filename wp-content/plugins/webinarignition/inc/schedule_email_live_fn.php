<?php

// ####################################
//
//  Check If Current Is Within Range Of Email Date
//
// ####################################


function wi_dt_check($start_date, $end_date, $date_from_db)
{

    // Convert to timestamp
    $start_ts = strtotime($start_date);
    $end_ts = strtotime($end_date);
    $user_ts = strtotime($date_from_db);

    // Check that user date is between start & end
    if (($user_ts >= $start_ts) && ($user_ts <= $end_ts)) {
        return "yes";
    } else {
        return "no";
    }
}

// ####################################
//
//  Send Email Notification
//
// ####################################
// --------------------------------------------------------------------------------------
   function wi_send_email($ID, $num, $results)
   {
      global $wpdb;
      $table_db_name = $wpdb->prefix . "webinarignition_leads_new";

      $port = (($results->smtp_port == "") ? 25 : $results->smtp_port);
      $list = $wpdb->get_results("SELECT * FROM $table_db_name WHERE app_id = '$ID' ", OBJECT);
      $body = '';
      $link = $results->webinar_permalink.(strstr($results->webinar_permalink, '?') ? '&' : '?');
      $link.= (($results->paid_status == "paid") ? "live=1&".md5($results->paid_code) : "live=1");

      $getBodyEmail = $results->{"email_notiff_body_".$num};
      $getBodyEmail = str_replace("{TITLE}", $results->webinar_desc, $getBodyEmail);
      $getBodyEmail = str_replace("{HOST}", $results->webinar_host, $getBodyEmail);
      $liveWebbyDate = explode("-", $results->webinar_date);
      $autoDate = $liveWebbyDate[2] . "-" . $liveWebbyDate[0] . "-" . $liveWebbyDate[1];
      $date_format = get_option("date_format");
      $autoDate_format = date($date_format, strtotime($autoDate));
      $months = $results->auto_translate_months;
      $days = $results->auto_translate_days;
      $autoDate_format = wi_translate_dm($months, $autoDate_format);
      $autoDate_format = wi_translate_dm($days, $autoDate_format, 'days');

      $body = str_replace("{DATE}", $autoDate_format . " @ " . wi_get_time_tz($results->webinar_start_time, $results->webinar_timezone, $results->time_format, $results->time_suffix), $getBodyEmail);
      $errs = 0;
      $mesg = '';
      
     //check whether smtp is available; this will be used to determine whether to use smtp or Sendmail later
    $smtp_avail = true;
    $connection =  @fsockopen ($results->smtp_host, $results->smtp_port, $errno, $errstr, 15);
    if (!is_resource($connection)) {
        $smtp_avail = false;
    }

      foreach ($list as $lead) {

         $lnk = (!strstr($link, 'lid=') ? $link."&lid={$lead->ID}" : $link);

         $bdy = $body;
         $bdy = str_replace("{NAME}", $lead->name, $bdy);
         $bdy = str_replace("{EMAIL}", $lead->email, $bdy);
         $bdy = str_replace("{LINK}", '<a href="'.$lnk .'">'.$lnk .'</a>', $bdy);

         $mail = new PHPMailer;
         $mail->CharSet = 'UTF-8';
         
         if($smtp_avail) {
             
             $mail->isSMTP();
             $mail->Host = $results->smtp_host;
             $mail->SMTPAuth = true;
             $mail->Username = $results->smtp_user;
             $mail->Password = $results->smtp_pass;
             $mail->SMTPSecure = $results->transfer_protocol ? $results->transfer_protocol : 'tls';   
             $mail->Port = $port;
             $mail->From = $results->smtp_email;
             $mail->FromName = $results->smtp_name;             
         
         } else {
             
             $mail->isSendmail();
             $mail->setFrom($results->smtp_email, $results->smtp_name);
         }

         $mail->WordWrap = 50;
         $mail->IsHTML(true);
         $mail->addAddress($lead->email, $lead->name);
         $mail->Subject = $results->{"email_notiff_sbj_".$num};
         $mail->Body = $bdy;
         $mesg = "Added {$lead->name} ({$lead->email}) to email recipient list\n";

          WI_Logs::add($mesg,$ID, WI_Logs::LIVE_EMAIL);

            if (!$mail->Send()) {

               $headers  = 'MIME-Version: 1.0' . "\r\n";
               $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
               $headers .=  'From: ' . $results->smtp_email . "\r\n" .
               'Reply-To: ' . $results->smtp_email . "\r\n" .
               'X-Mailer: PHP/' . phpversion(); 

               if(!mail($lead->email, $results->{"email_notiff_sbj_".$num}, $bdy, $headers)) {

                   WI_Logs::add("ERROR:: Email could not be sent. Error message: {$mail->ErrorInfo}",$ID, WI_Logs::LIVE_EMAIL);

               }

            } else {
            WI_Logs::add("Mail Sent.",$ID, WI_Logs::LIVE_EMAIL);
         }
      }

      return true;
   }
// --------------------------------------------------------------------------------------




// ####################################
//
//  Send TXT Notification
//
// ####################################
function wi_send_txt($results)
{
    // LOOP THROUGH EMAILS HERE ::
    global $wpdb;
    $table_db_name = $wpdb->prefix . "webinarignition_leads_new";
    $leads = $wpdb->get_results("SELECT * FROM $table_db_name WHERE app_id = '{$results->id}' ", OBJECT);
    // Loop Through Each Lead & Send ::
    // Send TXT Messages
    $AccountSid = $results->twilio_id;
    $AuthToken = $results->twilio_token;
    $client = new Services_Twilio($AccountSid, $AuthToken);

    $MSG = $results->twilio_msg;
    // Shortcode {LINK}
    if ($results->paid_status == "paid") {
        $MSG = str_replace("{LINK}", $results->webinar_permalink . "?live&" . md5($results->paid_code), $MSG);
    } else {
        $MSG = str_replace("{LINK}", $results->webinar_permalink . "?live", $MSG);
    }
    $txt_sent = false;

    foreach ($leads as $leads) {
        if ($leads->phone == "undefined" || $leads->phone == "") {

        } else {
            $txt_sent = true;
            try {

                $client->account->messages->create(array(
                    'To' => trim($leads->phone),
                    'From' => $results->twilio_number,
                    'Body' => $MSG,
                ));
                WI_Logs::add("TXT Sent to {$leads->name} ({$leads->phone})",$results->id, WI_Logs::LIVE_SMS);
                //echo 'TXT Sent :: ' . $leads->phone;
                //echo "<br>";
            } catch (Exception $e) {
                // Error On Phone Number - Do Nothing
                // echo 'Error: ' . $e->getMessage();
                WI_Logs::add("Error sending TXT to {$leads->name} ({$leads->phone}): ".$e->getMessage(),$results->id, WI_Logs::LIVE_SMS);
            }
        }
    }
    if(!$txt_sent) {
        WI_Logs::add("No leads to send TXT to.",$results->id, WI_Logs::LIVE_SMS);
    }
}
// --------------------------------------------------------------------------------------




// AUTO
// --------------------------------------------------------------------------------------
// Send Out Emails
function we_cron_email($ID, $LEADID, $num, $NAME, $EMAIL, $DATE, $TIMEZONE)
{
    // Setup Info
    $results = get_option('webinarignition_campaign_' . $ID);

    //check if notification is disabled, and halt sending it
    if ($results->{'email_notiff_' . $num} == 'off') {
        WI_Logs::add(prettifyNotificationTitle($num) . " disabled - aborting!",$ID, WI_Logs::AUTO_EMAIL);
        return;
    }
    
     //check whether smtp is available; this will be used to determine whether to use smtp or Sendmail later
    $smtp_avail = true;
    $connection =  @fsockopen ($results->smtp_host, $results->smtp_port, $errno, $errstr, 5);
    if (!is_resource($connection)) {
        $smtp_avail = false;
    }

 

    $mail = new PHPMailer;
    $mail->CharSet = 'UTF-8';
    
    if($smtp_avail) { 

    
        // EMAIL SETTINGS
        $mail->IsSMTP();
        //$mail->SMTPDebug = true;
        $mail->Host = $results->smtp_host;
        $mail->SMTPAuth = true;
        $mail->Username = $results->smtp_user;
        $mail->Password = $results->smtp_pass;
        $mail->SMTPSecure = $results->transfer_protocol ? $results->transfer_protocol : 'tls';
        $mail->From = $results->smtp_email;
        $mail->FromName = $results->smtp_name;
        // SMTP Port
        $port = (($results->smtp_port == "") ? 25 : $results->smtp_port); 
        $mail->Port = $port;
        
    }  else {
        
        $mail->isSendmail();
        $mail->setFrom($results->smtp_email, $results->smtp_name);
        
    }    


    
    // EMAIL COPY ::
    $mail->WordWrap = 50;
    $mail->IsHTML(true);
    $getSBJ = "email_notiff_sbj_" . $num;
    $mail->Subject = $results->$getSBJ;

    // Preprocess Email w/ Shortcodes
    $getBody = "email_notiff_body_" . $num;
    $getBodyEmail = $results->$getBody;
    // Shortcode :: TITLE
    $getBodyEmail = str_replace("{TITLE}", $results->webinar_desc, $getBodyEmail);
    // Shortcode :: HOST
    $getBodyEmail = str_replace("{HOST}", $results->webinar_host, $getBodyEmail);
    // Shortcode :: LINK

/* deprecated
    if ($results->paid_status == "paid") {
        $_webinar_link = $results->webinar_permalink . "?live&lid=" . $LEADID . "&event=OI3shBXlqsw&live=1&" . md5($results->paid_code);
    } else {
        $_webinar_link = $results->webinar_permalink . "?live&lid=" . $LEADID . "&event=OI3shBXlqsw&live=1";
    }
*/


// fix :: email link
// --------------------------------------------------------------------------------------
   $_webinar_link = $results->webinar_permalink.(strstr($results->webinar_permalink, '?') ? '&' : '?');
   $_webinar_link.= "lid=$LEADID&event=OI3shBXlqsw&live=1";
   $_webinar_link.= (($results->paid_status == "paid") ? "&".md5($results->paid_code) : "");
// --------------------------------------------------------------------------------------

    $getBodyEmail = str_replace("{LINK}", '<a href="' . $_webinar_link . '">' . $_webinar_link . '</a>', $getBodyEmail);
    // Shortcode :: DATE
    // Translate ::
    $date_format = get_option("date_format");
    $autoDate_info = explode(" ", $DATE);
    $autoDate_format = date($date_format, strtotime($autoDate_info[0]));
    // Final Step = Translate Months
    $months = $results->auto_translate_months;
    $days = $results->auto_translate_days;

    $autoDate_format = wi_translate_dm($months, $autoDate_format);
    $autoDate_format = wi_translate_dm($days, $autoDate_format, 'days');

    // Replace
    $getBodyEmail = str_replace("{DATE}", $autoDate_format . " @ " . wi_get_time_tz($autoDate_info[1],$TIMEZONE, $results->time_format, $results->time_suffix) , $getBodyEmail);

    // Send Email
    $mail->AddAddress($EMAIL, $NAME);

    $mail->Body = $getBodyEmail;

    // Mail Lead
    if (!$mail->Send()) {

        // echo 'Mailer Error: ' . $mail->ErrorInfo;
        WI_Logs::add("ERROR:: Email could not be sent. Error message: {$mail->ErrorInfo}",$ID, WI_Logs::AUTO_EMAIL);
        return false;
    } else {
        // echo 'Email Sent :: ' . $EMAIL;
        // echo "<br>";
        WI_Logs::add("Mail Sent.",$ID, WI_Logs::AUTO_EMAIL);
        return true;
    }
}

// ####################################
//
//  Send TXT Notification
//
// ####################################
function wi_send_txt_auto($ID, $PHONE, $LEADID)
{

    // Get Results
    $results = get_option('webinarignition_campaign_' . $ID);

    $AccountSid = $results->twilio_id;
    $AuthToken = $results->twilio_token;
    $client = new Services_Twilio($AccountSid, $AuthToken);

    $MSG = $results->twilio_msg;
    // Shortcode {LINK}
    // NOTE :: alteration
    // --------------------------------------------------------------------------------------
    $_webinar_link = $results->webinar_permalink.(strstr($results->webinar_permalink, '?') ? '&' : '?');
    $_webinar_link.= "lid=$LEADID&event=OI3shBXlqsw&live=1";
    // --------------------------------------------------------------------------------------

    $MSG = str_replace("{LINK}", $_webinar_link,
        $MSG);

    try {

        $client->account->messages->create(array(
            'To' => trim($PHONE),
            'From' => $results->twilio_number,
            'Body' => $MSG,
        ));
        WI_Logs::add("TXT notification Sent.", $ID, WI_Logs::AUTO_SMS);
    } catch (Exception $e) {
        // Error On Phone Number - Do Nothing
        // echo 'Error: ' . $e->getMessage();
        WI_Logs::add("Error sending TXT to {$PHONE}: ".$e->getMessage(),$ID, WI_Logs::AUTO_SMS);
    }
}
