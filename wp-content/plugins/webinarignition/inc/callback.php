<?php
//exit('here');

// Create Campaign
add_action('wp_ajax_webinarignition_create', 'webinarignition_create_callback');

function webinarignition_create_callback()
{

    // WP DB Include
    global $wpdb;
    $table_db_name = $wpdb->prefix . "webinarignition";

    $clone = $_POST['cloneapp'];

    $importcode = $_POST['importcode'];
    // Save DB Info - Name & Created Date
    $wpdb->insert($table_db_name, array(
        'appname' => stripcslashes($_POST['appname']),
        'camtype' => $clone,
        'total_lp' => '0%%0',
        'total_ty' => '0%%0',
        'total_live' => '0%%0',
        'total_replay' => '0%%0',
        'created' => date('F j, Y')
    ));

    // Return The ID Of Campaign Created
    $campaignID = $wpdb->insert_id;

    // CREATE A CORRASPONDING POST ::
    $my_post = array(
        'post_title' => wp_strip_all_tags($_POST['appname']),
        'post_type' => 'page',
        'post_content' => 'NOT USED -- REPLACED WITH WEBINAR IGNITION CAMPAIGN CONTENT',
        'post_status' => 'publish'
    );

    // Insert the post into the database
    $getPostID = wp_insert_post($my_post);

    // Add postID to db:
    $wpdb->update($table_db_name, array('postID' => $getPostID), array('id' => $campaignID));

    // Set Meta Info so it links this page with the bonus page::
    update_post_meta($getPostID, 'webinarignitionx_meta_box_select', esc_attr($campaignID));

    echo $campaignID;

    // MODEL :: CORE DATA
    add_option('webinarignition_campaign_' . $campaignID, "");

    // Create Option PRE-DONE CONTENT FOR THE USER
    // *****************************************************************************
    // Parse info like Data
    $fullDate = $_POST["webinar_date"];

    if (strpos($fullDate, '-')) {
        $fullDate = explode("-", $fullDate);
    } else {
        $fullDate = explode("/", $fullDate);
    }

    $maintitle = stripslashes($_POST['appname']);

    // $fullDate = explode("-", $fullDate);
    $setDate = $fullDate[2] . "/" . $fullDate[0] . "/" . $fullDate[1];

    $getDate = date('l jS \of F Y', strtotime($setDate));
    $getDate = explode(" ", $getDate);

    $getDay = str_replace("th", "", $getDate[1]);
    $getDay = str_replace("rd", "", $getDay);
    $getDay = str_replace("st", "", $getDay);
    $getDay = str_replace("nd", "", $getDay);

    $setTime = $_POST["webinar_start_time"];
    $getTime = date("h:i:s A", strtotime($setTime));

    $getTime = explode(" ", $getTime);
    $getHour = explode(":", $getTime[0]);
    $getHour2 = $getHour[0];
    // Check for 0 in front of time..
    if ($getHour2[0] == "0") {
        $getHour2 = str_replace("0", "", $getHour2);
    }

    $timezone = "-5";
    if ($_POST["webinar_timezone"] != "") {
        $timezone = $_POST["webinar_timezone"];
    }

    $host = "Your Name";
    if ($_POST["webinar_host"] != "") {
        $host = stripslashes($_POST["webinar_host"]);
    }

    $desc = "How We Crush It With Webinars";
    if ($_POST["webinar_desc"] != "") {
        $desc = $_POST["webinar_desc"];
    }

    $emailSetup = "Quick Webinar Reminder.\n

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
Required: Windows 7, Vista, XP or 2003 Server\n

Mac-based attendees
Required: Mac OS X 10.6 or newer\n

Mobile attendees
Required: iPhone, iPad, Android phone or Android tablet\n";

    // --- EMAIL NOTIFICATION UPDATE SETTINGS --
    //
    // Set Date & Get BeforeDay / NextDay - BeforeTime / NextTime
    //
    $notification_times = wi_webinar_live_notification_times($fullDate, $setTime);

    // Data For New Webinar
    $dataArray = array(
        "webinar_desc" => $desc,
        "webinar_host" => $host,
        "webinar_date" => $notification_times['live']['date'],
        "webinar_start_time" => $notification_times['live']['time'],
        "webinar_end_time" => $notification_times['live']['time'],
        "time_format" => '24hour',
        "webinar_timezone" => $timezone,
        "lp_metashare_title" => $maintitle,
        "lp_metashare_desc" => $desc,
        "lp_main_headline" => '<h4 class="subheader">Introducing This Exclusive Webinar From ' . $host . '</h4><h2 style="margin-top: -10px;">' . $desc . '</h2>',
        "lp_webinar_month" => $getDate[3],
        "lp_webinar_day" => $getDay,
        "lp_webinar_headline" => $getDate[0] . " The " . $getDate[1],
        "lp_webinar_subheadline" => "", // "At " . $getHour2 . ":" . $getHour[1] . " " . $getTime[1] . " - " . webinarignition_utc_to_abrc($timezone),
        "cd_headline" => '<h4 class="subheader">You Are Viewing The Webinar That Is Not Yet Live - <b>We Go Live Soon!</b></h4><h2 style="margin-top: -10px; margin-bottom: 30px;">Webinar Starts Very Soon</h2>',
        "email_signup_sbj" => "[Reminder] Your Webinar :: $desc",
        "email_signup_body" => str_replace("%%INTRO%%", "Here is the webinar information you just signed up for...<br>", $emailSetup),
        "email_notiff_date_1" => $notification_times['daybefore']['date'],
        "email_notiff_time_1" => $notification_times['daybefore']['time'],
        "email_notiff_status_1" => "queued",
        "email_notiff_sbj_1" => "WEBINAR REMINDER :: Goes Live Tomorrow :: $desc",
        "email_notiff_body_1" => str_replace("%%INTRO%%", "This is a reminder that the webinar you signed up for is tomorrow...<br>", $emailSetup),
        "email_notiff_date_2" => $notification_times['hourbefore']['date'],
        "email_notiff_time_2" => $notification_times['hourbefore']['time'],
        "email_notiff_status_2" => "queued",
        "email_notiff_sbj_2" => "WEBINAR REMINDER :: Goes Live In 1 Hour :: $desc",
        "email_notiff_body_2" => str_replace("%%INTRO%%", "The webinar is live in 1 hour!<br>", $emailSetup),
        "email_notiff_date_3" => $notification_times['live']['date'],
        "email_notiff_time_3" => $notification_times['live']['time'],
        "email_notiff_status_3" => "queued",
        "email_notiff_sbj_3" => "We Are Live",
        "email_notiff_body_3" => str_replace("%%INTRO%%", "We are live, on air and ready to go!<br>", $emailSetup),
        "email_notiff_date_4" => $notification_times['hourafter']['date'],
        "email_notiff_time_4" => $notification_times['hourafter']['time'],
        "email_notiff_status_4" => "queued",
        "email_notiff_sbj_4" => "Replay is live!",
        "email_notiff_body_4" => str_replace("%%INTRO%%", "We just posted the replay video for the webinar tonight...<br>", $emailSetup),
        "email_notiff_date_5" => $notification_times['dayafter']['date'],
        "email_notiff_time_5" => $notification_times['dayafter']['time'],
        "email_notiff_status_5" => "queued",
        "email_notiff_sbj_5" => "WEBINAR REMINDER :: Goes Live Tomorrow :: $desc",
        "email_notiff_body_5" => str_replace("%%INTRO%%", "This is a reminder that the webinar you signed up for is tomorrow...<br>", $emailSetup),
        "email_twilio_date" => $notification_times['live']['date'],
        "email_twilio_time" => $notification_times['hourbefore']['time'],
        "email_twilio_status" => "queued",
        "email_twilio" => "off",
        "twilio_msg" => "The webinar is starting soon! Jump On Live: {LINK}",
        "auto_translate_months" => "Jan, Feb, Mar, Apr, May, Jun, Jul, Aug, Sep, Oct, Nov, Dec",
        "auto_translate_days" => "Monday, Tuesday, Wednesday, Thursday, Friday, Saturday, Sunday",
        "lp_banner_bg_style" => "hide",
        "webinar_banner_bg_style" => "hide",
        "smtp_name" => $host,
        "smtp_email" => get_bloginfo("admin_email"),
        'ar_fields_order' => array(
            'ar_name',
            'ar_email'
        ),
        'ar_name' => '',
        'ar_email' => '',
        'lp_optin_name' => 'Enter your name: ',
        'lp_optin_email' => 'Enter your email: ',
        'ar_hidden' => ''
    );
    $obj = array_to_object_wi($dataArray);

    // Save Campaign Setup
    if ($clone == "new") {
        // no clone - new
        update_option('webinarignition_campaign_' . $campaignID, $obj);
    } else if ($clone == "import") {
        // importing campaign -- update Name & Permalink
        $importcode = trim($importcode);
        $webinar = unserialize(base64_decode($importcode));
        $webinar->webinarURLName2 = stripcslashes($_POST['appname']);
        update_option('webinarignition_campaign_' . $campaignID, $webinar);
    } else if ($clone == "auto") {
        // Data For New Webinar

        $dataArray = array(
            "webinar_desc" => $desc,
            "webinar_host" => $host,
            "webinar_date" => "AUTO",
            "time_format" => '24hour',
            // "webinar_start_time" => "AUTO",
            // "webinar_end_time" => $time,
            // "webinar_timezone" => $timezone,
            "lp_metashare_title" => $maintitle,
            "lp_metashare_desc" => $desc,
            "lp_main_headline" => '<h4 class="subheader">Introducing This Exclusive Webinar From ' . $host . '</h4><h2 style="margin-top: -10px;">' . $desc . '</h2>',
            // "lp_webinar_month" => $getDate[3],
            // "lp_webinar_day" => $getDay,
            // "lp_webinar_headline" => $getDate[0] ." The ". $getDate[1],
            // "lp_webinar_subheadline" => "At ". $getHour2 .":". $getHour[1] ." ". $getTime[1],
            "cd_headline" => '<h4 class="subheader">You Are Viewing The Webinar That Is Not Yet Live </h4><h2 style="margin-top: -10px; margin-bottom: 30px;">We Go Live Soon.</h2>',
            "email_signup_sbj" => "[Reminder] Your Webinar Information ",
            "email_signup_body" => str_replace("%%INTRO%%", "Here is the webinar information you just signed up for...<br>", $emailSetup),
            "email_notiff_sbj_1" => "WEBINAR REMINDER :: Goes Live Tomorrow :: $desc",
            "email_notiff_body_1" => str_replace("%%INTRO%%", "This is a reminder that the webinar you signed up for is tomorrow...<br>", $emailSetup),
            "email_notiff_sbj_2" => "WEBINAR REMINDER :: Goes Live In 1 Hour :: $desc",
            "email_notiff_body_2" => str_replace("%%INTRO%%", "The webinar is live in 1 hour!<br>", $emailSetup),
            "email_notiff_sbj_3" => "We Are Live",
            "email_notiff_body_3" => str_replace("%%INTRO%%", "We are live, on air and ready to go!<br>", $emailSetup),
            "email_notiff_sbj_4" => "Replay is live!",
            "email_notiff_body_4" => str_replace("%%INTRO%%", "We just posted the replay video for the webinar tonight...<br>", $emailSetup),
            "email_notiff_sbj_5" => "WEBINAR REPLAY COMING DOWN SOON :: $desc",
            "email_notiff_body_5" => str_replace("%%INTRO%%", "This is a reminder that the webinar you, the replay is available, but coming down very soon...<br>", $emailSetup),
            "twilio_msg" => "The webinar is starting soon! Jump On Live: {LINK}",
            "email_twilio" => "off",
            "lp_banner_bg_style" => "hide",
            "webinar_banner_bg_style" => "hide",
            "auto_saturday" => "yes",
            "auto_sunday"  => "yes",
            "auto_thursday"	 => "yes",
            "auto_monday"  => "yes",
            "auto_friday"  => "yes",
            "auto_tuesday"  => "yes",
            "auto_wednesday" => "yes",
            "auto_time_1" => "16:00",
            "auto_time_2" => "18:00",
            "auto_time_3" => "20:00",
            "auto_video_length" => "60",
            "auto_translate_months" => "Jan, Feb, Mar, Apr, May, Jun, Jul, Aug, Sep, Oct, Nov, Dec",
            "auto_translate_days" => "Monday, Tuesday, Wednesday, Thursday, Friday, Saturday, Sunday",
            "auto_translate_local" => "Local Time",
            "smtp_name" => $host,
            "smtp_email" => get_bloginfo("admin_email"),
            'ar_fields_order' => array(
                'ar_name',
                'ar_email'
            ),
            'ar_name' => '',
            'ar_email' => '',
            'lp_optin_name' => 'Enter your name: ',
            'lp_optin_email' => 'Enter your email: ',
        );
        $obj = array_to_object_wi($dataArray);
        // save
        update_option('webinarignition_campaign_' . $campaignID, $obj);
    } else {
        // get option from parent campaign
        $cloneParent = get_option('webinarignition_campaign_' . $clone);
        update_option('webinarignition_campaign_' . $campaignID, $cloneParent);
    }

    // *****************************************************************************

    die();
}

// Create Campaign -- AUTO
add_action('wp_ajax_webinarignition_create_auto', 'webinarignition_create_auto_callback');

function webinarignition_create_auto_callback()
{

    // WP DB Include
    global $wpdb;
    $table_db_name = $wpdb->prefix . "webinarignition";

    // Save DB Info - Name & Created Date
    $wpdb->insert($table_db_name, array(
        'appname' => stripcslashes($_POST['appname']),
        'camtype' => 'auto',
        'created' => date('F j, Y')
    ));

    // Return The ID Of Campaign Created
    $campaignID = $wpdb->insert_id;

    // CREATE A CORRASPONDING POST ::
    $my_post = array(
        'post_title' => wp_strip_all_tags($_POST['appname']),
        'post_type' => 'page',
        'post_content' => 'NOT USED -- REPLACED WITH WEBINAR IGNITION CAMPAIGN CONTENT',
        'post_status' => 'publish'
    );

    // Insert the post into the database
    $getPostID = wp_insert_post($my_post);

    // Add postID to db:
    $wpdb->update($table_db_name, array('postID' => $getPostID), array('id' => $campaignID));

    // Set Meta Info so it links this page with the bonus page::
    update_post_meta($getPostID, 'webinarignitionx_meta_box_select', esc_attr($campaignID));

    echo $campaignID;

    add_option('webinarignition_campaign_' . $campaignID, "");

    // Create Option PRE-DONE CONTENT FOR THE USER
    // *****************************************************************************
    // Parse info like Data

    $maintitle = $_POST['appname'];

    $host = "Your Name";
    if ($_POST["webinar_host"] != "") {
        $host = $_POST["webinar_host"];
    }

    $desc = "How We Crush It With Webinars";
    if ($_POST["webinar_desc"] != "") {
        $desc = $_POST["webinar_desc"];
    }

    $linkToLive = get_permalink($getPostID);

    $emailSetup = "Quick Webinar Reminder.\n

This message is to let you know all the details for the Webinar you signed up for...\n

Date:
Join us on {WEBINARSTARTTIME}\n

Webinar Topic:
$desc\n

Webinar Hosts:
$host\n

# Click here to join:
$linkToLive?live&id={ID}\n

# You will be connected to audio uding your computer's microphone and speakers.  A headset is recommended.\n

System Requirements:\n

PC-based attendees
Required: Windows 7, Vista, XP or 2003 Server\n

Mac-based attendees
Required: Mac OS X 10.6 or newer\n

Mobile attendees
Required: iPhone, iPad, Android phone or Android tablet\n";

    // Data For New Webinar
    $dataArray = array(
        "webinar_desc" => $desc,
        "webinar_host" => $host,
        "webinar_dates" => $_POST["webinar_dates"],
        "time_format" => '24hour',
        "webinar_blocked_dates" => $_POST["webinar_blocked_dates"],
        "webinar_times" => $_POST["webinar_times"],
        "webinar_instant" => $_POST["webinar_instant"],
        "webinar_lang" => $_POST["webinar_lang"],
        "meta_site_title_lp" => $maintitle,
        "meta_desc_lp" => $desc,
        "meta_site_title_ty" => $maintitle,
        "meta_desc_ty" => $desc,
        "meta_site_title_webinar" => $maintitle,
        "meta_desc_webinar" => $desc,
        "meta_site_title_replay" => $maintitle,
        "meta_desc_replay" => $desc,
        "lp_main_headline" => "<h4 class='subheader'>Introducing This Exclusive Webinar From " . $host . "</h4><h2 style='margin-top: -10px;'>" . $desc . "</h2>",
        "cd_headline" => '<h4 class="subheader">You Are Viewing The Webinar That Is Not Yet Live - <b>We Go Live Soon!</b></h4><h2 style="margin-top: -10px; margin-bottom: 30px;">Webinar Starts: {WEBINARSTARTTIME}</h2>',
        "email_signup_sbj" => "[Reminder] Your Webinar Starts: {WEBINARSTARTTIME",
        "email_signup_body" => $emailSetup,
        "lp_banner_bg_style" => "hide",
        "webinar_banner_bg_style" => "hide",
        'ar_fields_order' => array(
            'ar_name',
            'ar_email'
        ),
        'ar_name' => '',
        'ar_email' => '',
        'lp_optin_name' => 'Enter your name: ',
        'lp_optin_email' => 'Enter your email: ',
        'ar_hidden' => ''
    );
    $obj = array_to_object_wi($dataArray);


    // *****************************************************************************

    die();
}

// ARRAY TO OBJECT FUNCTION::
function array_to_object_wi($array)
{
    $obj = new stdClass;
    foreach ($array as $k => $v) {
        if (is_array($v)) {
            $obj->{$k} = $v; //RECURSION
        } else {
            $obj->{$k} = $v;
        }
    }
    return $obj;
}

// ADD NEW LEAD
add_action('wp_ajax_nopriv_webinarignition_add_lead', 'webinarignition_add_lead_callback');
add_action('wp_ajax_webinarignition_add_lead', 'webinarignition_add_lead_callback');

function webinarignition_add_lead_callback() {

    global $wpdb;

    $is_ajax = false;

    if (defined('DOING_AJAX') && DOING_AJAX) {
        $is_ajax = true;

    }


    $table_db_name = $wpdb->prefix . "webinarignition_leads_new";

    // Check if lead with such email exists in database
    $lead = $wpdb->get_row($wpdb->prepare("SELECT ID FROM $table_db_name WHERE email = %s AND app_id = %d", $_POST['email'], $_POST['id']));

    if ($lead) {
        if ($is_ajax !== false) {
            echo $lead->ID;
            exit();
        } else {
            return $lead->ID;
        }
    }

    // Lead Source
    $source = $_POST['source'];
    if ($source == "") {
        $source = "Optin";
    }

    $wpdb->insert($table_db_name, array(
        'app_id' => $_POST['id'],
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'trk1' => $source,
        'trk3' => $_POST['ip'],
        'event' => 'No',
        'replay' => 'No',
        'created' => date('F j, Y')
    ));

    $out = $wpdb->insert_id;

    $lead_details_string = "Name: {$_POST['name']}\nEmail: {$_POST['email']}\n";
    if (isset($_POST['phone']) && $_POST['phone'] != 'undefined') {
        $lead_details_string .= "Phone: {$_POST['phone']}";
    }
    WI_Logs::add("New Lead Added\n$lead_details_string\n\nFiring registration email", $_POST['id'], WI_Logs::LIVE_EMAIL);

    // ADD TO MAILING LIST

    $results = get_option('webinarignition_campaign_' . $_POST['id']);

    $emailBody = $results->email_signup_body;
    // Shortcode :: TITLE
    $emailBody = str_replace("{TITLE}", $results->webinar_desc, $emailBody);
    // Shortcode :: HOST
    $emailBody = str_replace("{HOST}", $results->webinar_host, $emailBody);
    // Shortcode :: LINK
    // Check For Paid Link
/*
    if ($results->paid_status == "paid") {
        // Shortcode :: LINK
        $_webinar_link = $results->webinar_permalink . "?live&" . md5($results->paid_code);
    } else {
        // Shortcode :: LINK
        $_webinar_link = $results->webinar_permalink . "?live";
    }
*/

// NOTE :: alteration
// --------------------------------------------------------------------------------------
   $_webinar_link = $results->webinar_permalink.(strstr($results->webinar_permalink, '?') ? '&' : '?');
   $_webinar_link.= (($results->paid_status == "paid") ? "live=1&".md5($results->paid_code) : "live=1");
// --------------------------------------------------------------------------------------


    $emailBody = str_replace("{LINK}", '<a href="' . $_webinar_link . '">' . $_webinar_link . '</a>', $emailBody);
    // Shortcode :: DATE
    $liveWebbyDate = explode("-", $results->webinar_date);
    $autoDate = $liveWebbyDate[2] . "-" . $liveWebbyDate[0] . "-" . $liveWebbyDate[1];

    $date_format = get_option("date_format");
    $autoDate_format = date($date_format, strtotime($autoDate));
    // Final Step = Translate Months
    $months = $results->auto_translate_months;
    $days = $results->auto_translate_days;

    $autoDate_format = wi_translate_dm($months, $autoDate_format);
    $autoDate_format = wi_translate_dm($days, $autoDate_format, 'days');

    // Replace
    $emailBody = str_replace("{DATE}", $autoDate_format . " @ " . wi_get_time_tz($results->webinar_start_time, $results->webinar_timezone, $results->time_format, $results->time_suffix), $emailBody);

    // SEND EMAIL -- SMTP
    require_once 'PHPMailerAutoload.php';
    $mail = new PHPMailer;
    $mail->CharSet = 'UTF-8';

     //check whether smtp is available; this will be used to determine whether to use smtp or Sendmail later
    $smtp_avail = true;
    $connection =  @fsockopen ($results->smtp_host, $results->smtp_port, $errno, $errstr, 15);
    if (!is_resource($connection)) {
        $smtp_avail = false;
    }

    if($smtp_avail) {

       $mail->isSMTP();
       $mail->Host = $results->smtp_host;
       $mail->SMTPAuth = true;
       $mail->Username = $results->smtp_user;
       $mail->Password = $results->smtp_pass;
       $mail->SMTPSecure = $results->transfer_protocol ? $results->transfer_protocol : 'tls';
       $mail->From = $results->smtp_email;
       $mail->FromName = $results->smtp_name;
            // SMTP Port
            $port = $results->smtp_port;
            if ($port == "") {
                $port = 25;
            }

            $mail->Port = $port;

    } else {
        $mail->isSendmail();
        $mail->setFrom($results->smtp_email, $results->smtp_name);
    }

    // EMAIL COPY ::
    $mail->WordWrap = 50;
    $mail->IsHTML(true);
    $mail->Subject = $results->email_signup_sbj;
    $mail->Body = $emailBody;

    // Email
    $mail->AddAddress($_POST['email'], $_POST['name']);

    if(!$mail->send()) {

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .=  'From: ' . $results->smtp_email . "\r\n" .
        'Reply-To: ' . $results->smtp_email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

        if(!mail($_POST['email'], $results->email_signup_sbj, $emailBody, $headers)) {
            // echo 'ERROR :: Email could not be sent. - Email ID :: ' . $num;
            // echo "<br><br>";
            // echo 'Mailer Error: ' . $mail->ErrorInfo;
            //if ($is_ajax)
            //exit;
            WI_Logs::add("Registration email could not be sent to {$_POST['email']}", WI_Logs::LIVE_EMAIL);

        } else {
            WI_Logs::add("Registration email has been sent.", $_POST['id'], WI_Logs::LIVE_EMAIL);
            // echo 'SUCCESS :: Email has been sent - Email ID :: ' . $num;
        }

    }

    if ($is_ajax !== false) {

        echo $out;
            die();
    }
        return $out;


}

// ADD NEW LEAD
add_action('wp_ajax_nopriv_webinarignition_add_lead_auto', 'webinarignition_add_lead_auto_callback');
add_action('wp_ajax_webinarignition_add_lead_auto', 'webinarignition_add_lead_auto_callback');

function webinarignition_add_lead_auto_callback()
{

    global $wpdb;
    $table_db_name = $wpdb->prefix . "webinarignition_leads_evergreen";
    // Check if lead with such email exists in database
    $lead = $wpdb->get_row($wpdb->prepare("SELECT ID FROM $table_db_name WHERE email = %s AND app_id = %d", $_POST['email'], $_POST['id']));
    if ($lead) {
        echo $lead->ID;
        die();
    }

    $lead_timezone = new DateTimeZone($_POST['timezone']);

    // Get info
    $results = get_option('webinarignition_campaign_' . $_POST['id']);
    $webinarLength = $results->auto_video_length;

    $setCheckInstant = "";

    $instant = "no";

    if ($_POST['date'] == "instant_access") {
        $current_time = new DateTime( 'now', $lead_timezone );
        $todaysDate   = $current_time->format( "Y-m-d" );
        $todaysTime   = $current_time->format( "H:i" );

        // They choose to watch replay
        $time = date( 'H:i', strtotime( $todaysTime."+0 hours" ) );
        $_POST['date'] = $todaysDate;
        $_POST['time'] = $time;
    }

        // Get & Set Dates For Emails...
         $dpl = $_POST['date'] . " " . $_POST['time'];;
         $fmt = 'Y-m-d H:i';

         $date_picked_and_live = date($fmt, strtotime($dpl));
         $date_1_day_before = date($fmt, strtotime($dpl . " -1 days"));
         $date_1_hour_before = date($fmt, strtotime($dpl . " -1 hours"));
         $date_after_live = date($fmt, strtotime($dpl . " +$webinarLength minutes"));
         $date_1_day_after = date($fmt, strtotime($dpl . " +1 days"));

/*
        $date_1_day_before = date('Y-m-d', strtotime($_POST['date'] . "-1 days"));
        $date_1_day_before = $date_1_day_before . " " . $_POST['time'];

        $date_1_hour_before = date('H:i', strtotime($_POST['time'] . "-1 hours"));
        $date_1_hour_before = $_POST['date'] . " " . $date_1_hour_before;

        $date_after_live = date('H:i', strtotime($_POST['time'] . "+$webinarLength minutes"));
        $date_after_live = $_POST['date'] . " " . $date_after_live;

        $date_1_day_after = date('Y-m-d', strtotime($_POST['date'] . "+1 days"));
        $date_1_day_after = $date_1_day_after . " " . $_POST['time'];
*/
    $wpdb->insert($table_db_name, array(
        'app_id' => $_POST['id'],
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'lead_timezone' => $_POST['timezone'],
        'trk1' => 'Optin',
        'trk3' => $_POST['ip'],
        'trk8' => $instant,
        'event' => 'No',
        'replay' => 'No',
        'created' => date('F j, Y'),
        'date_picked_and_live' => $date_picked_and_live,
        'date_1_day_before' => $date_1_day_before,
        'date_1_hour_before' => $date_1_hour_before,
        'date_after_live' => $date_after_live,
        'date_1_day_after' => $date_1_day_after,
        'date_picked_and_live_check' => $setCheckInstant,
        'date_1_day_before_check' => $setCheckInstant,
        'date_1_hour_before_check' => $setCheckInstant,
        'date_after_live_check' => $setCheckInstant
    ));
    $cookieID = $wpdb->insert_id;
    echo $wpdb->insert_id;
    $lead_details_string = "Name: {$_POST['name']}\nEmail: {$_POST['email']}\n";
    if ($_POST['phone'] != 'undefined') {
        $lead_details_string .= "Phone: {$_POST['phone']}";
    }
    WI_Logs::add("New Lead Added\n$lead_details_string\n\nFiring registration email", $_POST['id'], WI_Logs::AUTO_EMAIL);
    // ADD TO MAILING LIST

    $results = get_option('webinarignition_campaign_' . $_POST['id']);

    $emailBody = $results->email_signup_body;
    // Shortcode :: TITLE
    $emailBody = str_replace("{TITLE}", $results->webinar_desc, $emailBody);
    // Shortcode :: HOST
    $emailBody = str_replace("{HOST}", $results->webinar_host, $emailBody);

/*
    // Shortcode :: LINK
    if ($results->paid_status == "paid") {
        $_webinar_link = $results->webinar_permalink . "?live&lid=" . $cookieID . "&event=OI3shBXlqsw&live=1&" . md5($results->paid_code);
    } else {
        $_webinar_link = $results->webinar_permalink . "?live&lid=" . $cookieID . "&event=OI3shBXlqsw&live=1";
    }
*/

// NOTE :: alteration
// --------------------------------------------------------------------------------------
   $_webinar_link = $results->webinar_permalink.(strstr($results->webinar_permalink, '?') ? '&' : '?');
   $_webinar_link.= "live=1&lid=$cookieID&event=OI3shBXlqsw";
   $_webinar_link.= (($results->paid_status == "paid") ? "&".md5($results->paid_code) : "");
// --------------------------------------------------------------------------------------


    $emailBody = str_replace("{LINK}", '<a href="' . $_webinar_link . '">' . $_webinar_link . '</a>', $emailBody);
    // Shortcode :: DATE
    // Translate ::
    // $autoDate_info = explode(" ", $date_picked_and_live);
    $date_format = get_option("date_format");
    $autoDate = $_POST['date'];
    $autoDate_format = date($date_format, strtotime($autoDate));
    // Final Step = Translate Months
    $months = $results->auto_translate_months;
    $days = $results->auto_translate_days;

    $autoDate_format = wi_translate_dm($months, $autoDate_format);
    $autoDate_format = wi_translate_dm($days, $autoDate_format, 'days');

    // Replace
    if ($instant == "yes") {
        if ($results->auto_translate_instant == "") {
            $emailBody = str_replace("{DATE}", "Watch Replay", $emailBody);
        } else {
            $emailBody = str_replace("{DATE}", $results->auto_translate_instant, $emailBody);
        }
    } else {
        $emailBody = str_replace("{DATE}", $autoDate_format . " @ " . wi_get_time_tz($_POST['time'], $_POST['timezone'], $results->time_format, $results->time_suffix), $emailBody);
    }

    // SEND EMAIL -- SMTP
    require_once 'PHPMailerAutoload.php';
    $mail = new PHPMailer;
    $mail->CharSet = 'UTF-8';

     //check whether smtp is available; this will be used to determine whether to use smtp or Sendmail later
    $smtp_avail = true;
    $connection =  @fsockopen ($results->smtp_host, $results->smtp_port, $errno, $errstr, 15);
    if (!is_resource($connection)) {
        $smtp_avail = false;
    }

    if($smtp_avail) {

       $mail->isSMTP();
       $mail->Host = $results->smtp_host;
       $mail->SMTPAuth = true;
       $mail->Username = $results->smtp_user;
       $mail->Password = $results->smtp_pass;
       $mail->SMTPSecure = $results->transfer_protocol ? $results->transfer_protocol : 'tls';
       $mail->From = $results->smtp_email;
       $mail->FromName = $results->smtp_name;
        // SMTP Port
        $port = $results->smtp_port;
        if ($port == "") {
            $port = 25;
        }

        $mail->Port = $port;

    } else {
        $mail->isSendmail();
        $mail->setFrom($results->smtp_email, $results->smtp_name);
    }

    // EMAIL COPY ::
    $mail->WordWrap = 50;
    $mail->IsHTML(true);
    $mail->Subject = $results->email_signup_sbj;
    $mail->Body = $emailBody;

    // Email
    $mail->AddAddress($_POST['email'], $_POST['name']);

    // Mail Lead
    if (!$mail->Send()) {
        // echo 'ERROR :: Email could not be sent. - Email ID :: ' . $num;
        // echo "<br><br>";
        // echo 'Mailer Error: ' . $mail->ErrorInfo;
        // exit;
        WI_Logs::add("Registration email could not be sent to {$_POST['email']}: " . $mail->ErrorInfo, $_POST['id'], WI_Logs::AUTO_EMAIL);
    } else {
        WI_Logs::add("Registration email has been sent.", $_POST['id'], WI_Logs::AUTO_EMAIL);
        // echo 'SUCCESS :: Email has been sent - Email ID :: ' . $num;
    }

    die();
}

// ADD NEW LEAD
add_action('wp_ajax_nopriv_webinarignition_add_lead_auto_reg', 'webinarignition_add_lead_auto_reg_callback');
add_action('wp_ajax_webinarignition_add_lead_auto_reg', 'webinarignition_add_lead_auto_reg_callback');
function webinarignition_add_lead_auto_reg_callback()
{
    global $wpdb;
    $table_db_name = $wpdb->prefix . "webinarignition_leads_new";
    // Check if lead with such email exists in database
    $lead = $wpdb->get_row($wpdb->prepare("SELECT ID FROM $table_db_name WHERE email = %s AND app_id = %d", $_POST['email'], $_POST['id']));
    if ($lead) {
        echo $lead->ID;
        die();
    }
    // Lead Source
    $source = $_POST['source'];
    if ($source == "") {
        $source = "Optin";
    }
    $wpdb->insert($table_db_name, array(
        'app_id' => $_POST['id'],
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'trk1' => $source,
        'trk3' => $_POST['ip'],
        'event' => 'No',
        'replay' => 'No',
        'created' => date('F j, Y')
    ));
    echo $wpdb->insert_id;
    $lead_details_string = "Name: {$_POST['name']}\nEmail: {$_POST['email']}\n";
    WI_Logs::add("New Lead Added\n$lead_details_string\n\nFiring registration email", $_POST['id'], WI_Logs::AUTO_EMAIL);

    // ADD TO MAILING LIST
    $results = get_option('webinarignition_campaign_' . $_POST['id']);
    $emailBody = $results->email_signup_body;
    // Shortcode :: TITLE
    $emailBody = str_replace("{TITLE}", $results->webinar_desc, $emailBody);
    // Shortcode :: HOST
    $emailBody = str_replace("{HOST}", $results->webinar_host, $emailBody);

/*
    // Shortcode :: LINK
    $_webinar_link = $results->webinar_permalink . "?live";
*/

// NOTE :: alteration
// --------------------------------------------------------------------------------------
   $_webinar_link = $results->webinar_permalink.(strstr($results->webinar_permalink, '?') ? '&' : '?');
   $_webinar_link.= (($results->paid_status == "paid") ? "live&".md5($results->paid_code) : "live");
// --------------------------------------------------------------------------------------


    $emailBody = str_replace("{LINK}", '<a href="' . $_webinar_link . '">' . $_webinar_link . '</a>', $emailBody);
    // Shortcode :: DATE
    $liveWebbyDate = explode("-", $results->webinar_date);
    $autoDate = $liveWebbyDate[2] . "-" . $liveWebbyDate[0] . "-" . $liveWebbyDate[1];
    $autoDate_format = date($date_format, strtotime($autoDate));
    // Final Step = Translate Months
    $months = $results->auto_translate_months;
    $days = $results->auto_translate_days;

    $autoDate_format = wi_translate_dm($months, $autoDate_format);
    $autoDate_format = wi_translate_dm($days, $autoDate_format, 'days');

    // Replace
    $emailBody = str_replace("{DATE}", $autoDate_format . " @ " . wi_get_time_tz($results->webinar_start_time, $results->webinar_timezone, $results->time_format, $results->time_suffix), $emailBody);

    // SEND EMAIL -- SMTP
    require_once 'PHPMailerAutoload.php';
    $mail = new PHPMailer;
    $mail->CharSet = 'UTF-8';
    // EMAIL SETTINGS
    $mail->IsSMTP();
    $mail->Host = $results->smtp_host;
    $mail->SMTPAuth = true;
    $mail->Username = $results->smtp_user;
    $mail->Password = $results->smtp_pass;
    $mail->SMTPSecure = $results->transfer_protocol ? $results->transfer_protocol : 'tls';
    $mail->From = $results->smtp_email;
    $mail->FromName = $results->smtp_name;
    // EMAIL COPY ::
    $mail->WordWrap = 50;
    $mail->IsHTML(true);
    $mail->Subject = $results->email_signup_sbj;
    $mail->Body = $emailBody;
    // SMTP Port
    $port = $results->smtp_port;
    if ($port == "") {
        $port = 25;
    }
    $mail->Port = $port;
    // Email
    $mail->AddAddress($_POST['email'], $_POST['name']);
    // Mail Lead
    if (!$mail->Send()) {
        // echo 'ERROR :: Email could not be sent. - Email ID :: ' . $num;
        // echo "<br><br>";
        // echo 'Mailer Error: ' . $mail->ErrorInfo;
        WI_Logs::add("Registration email could not be sent to {$_POST['email']}: " . $mail->ErrorInfo, $_POST['id'], WI_Logs::AUTO_EMAIL);
        exit;
    } else {
        // echo 'SUCCESS :: Email has been sent - Email ID :: ' . $num;
        WI_Logs::add("Registration email has been sent.", $_POST['id'], WI_Logs::AUTO_EMAIL);
    }
    die();
}

function webinarignition_add_lead_fb($ID, $NAME, $EMAIL, $IP)
{

    global $wpdb;
    $table_db_name = $wpdb->prefix . "webinarignition_leads_new";

    $wpdb->insert($table_db_name, array(
        'app_id' => $ID,
        'name' => $NAME,
        'email' => $EMAIL,
        'trk1' => 'FB',
        'trk3' => $IP,
        'created' => date('F j, Y')
    ));

    $getLEADID = $wpdb->insert_id;
    echo $getLEADID;
    $lead_details_string = "Name: {$NAME}\nEmail: {$EMAIL}\n";
    WI_Logs::add("New Lead Added\n$lead_details_string\n\nFiring registration email", $ID, WI_Logs::LIVE_EMAIL);

    $results = get_option('webinarignition_campaign_' . $ID);

    $emailBody = $results->email_signup_body;
    // Shortcode :: TITLE
    $emailBody = str_replace("{TITLE}", $results->webinar_desc, $emailBody);
    // Shortcode :: HOST
    $emailBody = str_replace("{HOST}", $results->webinar_host, $emailBody);

/*
    // Shortcode :: LINK
    $_webinar_link = $results->webinar_permalink . "?live";
*/

// NOTE :: alteration
// --------------------------------------------------------------------------------------
   $_webinar_link = $results->webinar_permalink.(strstr($results->webinar_permalink, '?') ? '&' : '?');
   $_webinar_link.= (($results->paid_status == "paid") ? "live&".md5($results->paid_code) : "live");
// --------------------------------------------------------------------------------------

    $emailBody = str_replace("{LINK}", '<a href="' . $_webinar_link . '">' . $_webinar_link . '</a>', $emailBody);
    // Shortcode :: DATE
    $liveWebbyDate = explode("-", $results->webinar_date);
    $autoDate = $liveWebbyDate[2] . "-" . $liveWebbyDate[0] . "-" . $liveWebbyDate[1];

    $date_format = get_option("date_format");
    $autoDate_format = date($date_format, strtotime($autoDate));
    // Final Step = Translate Months
    $months = $results->auto_translate_months;
    $days = $results->auto_translate_days;

    $autoDate_format = wi_translate_dm($months, $autoDate_format);
    $autoDate_format = wi_translate_dm($days, $autoDate_format, 'days');

    // Replace
    $emailBody = str_replace("{DATE}", $autoDate_format . " @ " . wi_get_time_tz($results->webinar_start_time, $results->webinar_timezone, $results->time_format, $results->time_suffix), $emailBody);

    // SEND EMAIL -- SMTP
    require_once 'PHPMailerAutoload.php';
    $mail = new PHPMailer;
    $mail->CharSet = 'UTF-8';
    // EMAIL SETTINGS
    $mail->IsSMTP();
    $mail->Host = $results->smtp_host;
    $mail->SMTPAuth = true;
    $mail->Username = $results->smtp_user;
    $mail->Password = $results->smtp_pass;
    $mail->SMTPSecure = $results->transfer_protocol ? $results->transfer_protocol : 'tls';
    $mail->From = $results->smtp_email;
    $mail->FromName = $results->smtp_name;
    // EMAIL COPY ::
    $mail->WordWrap = 50;
    $mail->IsHTML(true);
    $mail->Subject = $results->email_signup_sbj;
    $mail->Body = $emailBody;

    // SMTP Port
    $port = $results->smtp_port;
    if ($port == "") {
        $port = 25;
    }

    $mail->Port = $port;

    // Email
    $mail->AddAddress($EMAIL, $NAME);
    // Mail Lead
    if (!$mail->Send()) {
        // echo 'ERROR :: Email could not be sent. - Email ID :: ' . $num;
        // echo "<br><br>";
        // echo 'Mailer Error: ' . $mail->ErrorInfo;
        WI_Logs::add("Registration email could not be sent to {$EMAIL}: " . $mail->ErrorInfo, $ID, WI_Logs::LIVE_EMAIL);
        exit;
    } else {
        WI_Logs::add("Registration email has been sent.", $ID, WI_Logs::LIVE_EMAIL);
        // echo 'SUCCESS :: Email has been sent - Email ID :: ' . $num;
    }

}

function webinarignition_get_fb_id($ID, $EMAIL)
{
    // Get ID for the FB Lead
    global $wpdb;
    $table_db_name = $wpdb->prefix . "webinarignition_leads_new";
    $findstat = $wpdb->get_row("SELECT * FROM $table_db_name WHERE app_id = '$ID' AND email = '$EMAIL' ", OBJECT);

    return $findstat->ID;
}

// Track View - LANDING PAGE
add_action('wp_ajax_nopriv_webinarignition_track_lp_view', 'webinarignition_track_lp_view_callback');
add_action('wp_ajax_webinarignition_track_lp_view', 'webinarignition_track_lp_view_callback');

function webinarignition_track_lp_view_callback()
{
    // Campaign ID
    $ID = $_POST['id'];

    global $wpdb;
    $table_db_name = $wpdb->prefix . "webinarignition";
    $findstat = $wpdb->get_row("SELECT * FROM $table_db_name WHERE id = '$ID'", OBJECT);

    $wpdb->update($table_db_name, array(
        'total_views' => $findstat->total_views + 1
    ), array('id' => $ID)
    );
}

// ADD NEW QUESTION
add_action('wp_ajax_nopriv_webinarignition_submit_question', 'webinarignition_submit_question_callback');
add_action('wp_ajax_webinarignition_submit_question', 'webinarignition_submit_question_callback');

function webinarignition_submit_question_callback()
{
    global $wpdb;
    $table_db_name = $wpdb->prefix . "webinarignition_questions_new";

    $wpdb->insert($table_db_name, array(
        'app_id' => $_POST['id'],
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'question' => htmlspecialchars($_POST['question']),
        'attr1' => $_POST['lead'],
        'status' => 'live',
        'created' => date('F j, Y')
    ));
}

// ADD NEW QUESTION
add_action('wp_ajax_nopriv_webinarignition_update_question_status', 'webinarignition_update_question_status_callback');
add_action('wp_ajax_webinarignition_update_question_status', 'webinarignition_update_question_status_callback');

function webinarignition_update_question_status_callback()
{
    global $wpdb;
    $table_db_name = $wpdb->prefix . "webinarignition_questions_new";
    $ID = $_POST['id'];

    $wpdb->update($table_db_name, array(
        'status' => 'done'
    ), array('id' => $ID)
    );
}

// ADD NEW QUESTION
add_action('wp_ajax_nopriv_webinarignition_update_question_status2', 'webinarignition_update_question_status2_callback');
add_action('wp_ajax_webinarignition_update_question_status2', 'webinarignition_update_question_status2_callback');

function webinarignition_update_question_status2_callback()
{
    global $wpdb;
    $table_db_name = $wpdb->prefix . "webinarignition_questions";
    $ID = $_POST['id'];

    $wpdb->update($table_db_name, array(
        'status' => 'done'
    ), array('id' => $ID)
    );
}

// DELETE QUESTION
//add_action('wp_ajax_nopriv_webinarignition_delete_question', 'webinarignition_delete_question_callback');
add_action('wp_ajax_webinarignition_delete_question', 'webinarignition_delete_question_callback');

function webinarignition_delete_question_callback()
{
    global $wpdb;
    $table_db_name = $wpdb->prefix . "webinarignition_questions_new";
    $ID = $_POST['id'];
    $wpdb->query("DELETE FROM $table_db_name WHERE id = '$ID'");
}

// DELETE QUESTION
//add_action('wp_ajax_nopriv_webinarignition_delete_question2', 'webinarignition_delete_question2_callback');
add_action('wp_ajax_webinarignition_delete_question2', 'webinarignition_delete_question2_callback');

function webinarignition_delete_question2_callback()
{
    global $wpdb;
    $table_db_name = $wpdb->prefix . "webinarignition_questions";
    $ID = $_POST['id'];
    $wpdb->query("DELETE FROM $table_db_name WHERE id = '$ID'");
}

// DELETE LEAD
//add_action('wp_ajax_nopriv_webinarignition_delete_lead', 'webinarignition_delete_lead_callback');
add_action('wp_ajax_webinarignition_delete_lead', 'webinarignition_delete_lead_callback');

function webinarignition_delete_lead_callback()
{
    global $wpdb;
    $table_db_name = $wpdb->prefix . "webinarignition_leads_new";
    $ID = $_POST['id'];
    $wpdb->query("DELETE FROM $table_db_name WHERE id = '$ID'");
}

// DELETE LEAD
//add_action('wp_ajax_nopriv_webinarignition_delete_lead_auto', 'webinarignition_delete_lead_auto_callback');
add_action('wp_ajax_webinarignition_delete_lead_auto', 'webinarignition_delete_lead_auto_callback');

function webinarignition_delete_lead_auto_callback()
{
    global $wpdb;
    $table_db_name = $wpdb->prefix . "webinarignition_leads_evergreen";
    $ID = $_POST['id'];
    $wpdb->query("DELETE FROM $table_db_name WHERE id = '$ID'");
}

// DELETE LEAD2
//add_action('wp_ajax_nopriv_webinarignition_delete_lead2', 'webinarignition_delete_lead2_callback');
add_action('wp_ajax_webinarignition_delete_lead2', 'webinarignition_delete_lead2_callback');

function webinarignition_delete_lead2_callback()
{
    global $wpdb;
    $table_db_name = $wpdb->prefix . "webinarignition_leads";
    $ID = $_POST['id'];
    $wpdb->query("DELETE FROM $table_db_name WHERE id = '$ID'");
}

// RESET STATS
//add_action('wp_ajax_nopriv_webinarignition_reset_stats', 'webinarignition_reset_stats_callback');
add_action('wp_ajax_webinarignition_reset_stats', 'webinarignition_reset_stats_callback');

function webinarignition_reset_stats_callback()
{

    global $wpdb;
    $table_db_name = $wpdb->prefix . "webinarignition";
    $ID = $_POST['id'];

    $wpdb->update($table_db_name, array(
        'total_lp' => '0%%0',
        'total_ty' => '0%%0',
        'total_live' => '0%%0',
        'total_replay' => '0%%0'
    ), array('id' => $ID)
    );
}

// COUNTDOWN - EXPIRE -- UPDATE TO LIVE
add_action('wp_ajax_nopriv_webinarignition_update_to_live', 'webinarignition_update_to_live_callback');
add_action('wp_ajax_webinarignition_update_to_live', 'webinarignition_update_to_live_callback');

function webinarignition_update_to_live_callback()
{

    $ID = $_POST['id'];
    $results = get_option('webinarignition_campaign_' . $ID);
    // update status
    $results->webinar_switch = "live";
    // save
    update_option('webinarignition_campaign_' . $ID, $results);
}

// TRACK VIEW
add_action('wp_ajax_nopriv_webinarignition_track_view', 'webinarignition_track_view_callback');
add_action('wp_ajax_webinarignition_track_view', 'webinarignition_track_view_callback');

function webinarignition_track_view_callback()
{

    // Campaign ID
    $ID = $_POST['id'];
    $PAGE = $_POST['page'];

    global $wpdb;
    $table_db_name = $wpdb->prefix . "webinarignition";
    $findstat = $wpdb->get_row("SELECT * FROM $table_db_name WHERE id = '$ID'", OBJECT);

    if ($PAGE == "lp") {
        // LANDING PAGE
        $getData = $findstat->total_lp;
        $getData = explode("%%", $getData);
        $getUnique = $getData[0] + 1;
        $getTotal = $getData[1];
        $wpdb->update($table_db_name, array(
            'total_lp' => $getUnique . "%%" . $getTotal
        ), array('id' => $ID)
        );
    } else if ($PAGE == "ty") {
        // THANK YOU PAGE
        $getData = $findstat->total_ty;
        $getData = explode("%%", $getData);
        $getUnique = $getData[0] + 1;
        $getTotal = $getData[1];
        $wpdb->update($table_db_name, array(
            'total_ty' => $getUnique . "%%" . $getTotal
        ), array('id' => $ID)
        );
    } else if ($PAGE == "live") {
        // LIVE
        $getData = $findstat->total_live;
        $getData = explode("%%", $getData);
        $getUnique = $getData[0] + 1;
        $getTotal = $getData[1];
        $wpdb->update($table_db_name, array(
            'total_live' => $getUnique . "%%" . $getTotal
        ), array('id' => $ID)
        );
    } else if ($PAGE == "replay") {
        // REPLAY
        $getData = $findstat->total_replay;
        $getData = explode("%%", $getData);
        $getUnique = $getData[0] + 1;
        $getTotal = $getData[1];
        $wpdb->update($table_db_name, array(
            'total_replay' => $getUnique . "%%" . $getTotal
        ), array('id' => $ID)
        );
    }
}

// TRACK VIEW
add_action('wp_ajax_nopriv_webinarignition_track_view_total', 'webinarignition_track_view_total_callback');
add_action('wp_ajax_webinarignition_track_view_total', 'webinarignition_track_view_total_callback');

function webinarignition_track_view_total_callback()
{

    // Campaign ID
    $ID = $_POST['id'];
    $PAGE = $_POST['page'];

    global $wpdb;
    $table_db_name = $wpdb->prefix . "webinarignition";
    $findstat = $wpdb->get_row("SELECT * FROM $table_db_name WHERE id = '$ID'", OBJECT);

    if ($PAGE == "lp") {
        // LANDING PAGE
        $getData = $findstat->total_lp;
        $getData = explode("%%", $getData);
        $getUnique = $getData[0];
        $getTotal = $getData[1] + 1;
        $wpdb->update($table_db_name, array(
            'total_lp' => $getUnique . "%%" . $getTotal
        ), array('id' => $ID)
        );
    } else if ($PAGE == "ty") {
        // THANK YOU PAGE
        $getData = $findstat->total_ty;
        $getData = explode("%%", $getData);
        $getUnique = $getData[0];
        $getTotal = $getData[1] + 1;
        $wpdb->update($table_db_name, array(
            'total_ty' => $getUnique . "%%" . $getTotal
        ), array('id' => $ID)
        );
    } else if ($PAGE == "live") {
        // LIVE
        $getData = $findstat->total_live;
        $getData = explode("%%", $getData);
        $getUnique = $getData[0];
        $getTotal = $getData[1] + 1;
        $wpdb->update($table_db_name, array(
            'total_live' => $getUnique . "%%" . $getTotal
        ), array('id' => $ID)
        );
    } else if ($PAGE == "replay") {
        // REPLAY
        $getData = $findstat->total_replay;
        $getData = explode("%%", $getData);
        $getUnique = $getData[0];
        $getTotal = $getData[1] + 1;
        $wpdb->update($table_db_name, array(
            'total_replay' => $getUnique . "%%" . $getTotal
        ), array('id' => $ID)
        );
    }
}

// TRACK LIVE ATTEND
add_action('wp_ajax_nopriv_webinarignition_trk_event', 'webinarignition_trk_event_callback');
add_action('wp_ajax_webinarignition_trk_event', 'webinarignition_trk_event_callback');

function webinarignition_trk_event_callback()
{

    // Get Variables
    global $wpdb;
    $table_db_name = $wpdb->prefix . "webinarignition_leads_new";

    $cookieStatus = $_POST["cookie"];
    $IP = $_POST["ip"];

    if ($cookieStatus == "undefined") {
        // No Cookie Found -- Try IP
        $data = $wpdb->get_row("SELECT * FROM $table_db_name WHERE trk3 = '$IP'", OBJECT);

        if (empty($data)) {
            // No IP Found - Do Nothing...
        } else {
            // IP Found - Trk it
            echo "IP Found";
            $wpdb->update($table_db_name, array('event' => "Yes"), array('id' => $data->ID));
        }
    } else {
        // Cookie Was Found - Trk it
        echo "Cookie Found";
        $wpdb->update($table_db_name, array('event' => "Yes"), array('id' => $cookieStatus));
    }
}

// TRACK LIVE ATTEND
add_action('wp_ajax_nopriv_webinarignition_trk_event_auto', 'webinarignition_trk_event_auto_callback');
add_action('wp_ajax_webinarignition_trk_event_auto', 'webinarignition_trk_event_auto_callback');

function webinarignition_trk_event_auto_callback()
{

    // Get Variables
    global $wpdb;
    $table_db_name = $wpdb->prefix . "webinarignition_leads_evergreen";

    $cookieStatus = $_POST["cookie"];
    $IP = $_POST["ip"];

    if ($cookieStatus == "undefined") {
        // No Cookie Found -- Try IP
        $data = $wpdb->get_row("SELECT * FROM $table_db_name WHERE trk3 = '$IP'", OBJECT);

        if (empty($data)) {
            // No IP Found - Do Nothing...
        } else {
            // IP Found - Trk it
            echo "IP Found";
            $wpdb->update($table_db_name, array('event' => "Yes"), array('id' => $data->ID));
        }
    } else {
        // Cookie Was Found - Trk it
        echo "Cookie Found";
        $wpdb->update($table_db_name, array('event' => "Yes"), array('id' => $cookieStatus));
    }
}

// TRACK LIVE REPLAY
add_action('wp_ajax_nopriv_webinarignition_trk_replay', 'webinarignition_trk_replay_callback');
add_action('wp_ajax_webinarignition_trk_replay', 'webinarignition_trk_replay_callback');

function webinarignition_trk_replay_callback()
{

    // Get Variables
    global $wpdb;
    $table_db_name = $wpdb->prefix . "webinarignition_leads_new";

    $cookieStatus = $_POST["cookie"];
    $IP = $_POST["ip"];

    if ($cookieStatus == "undefined") {
        // No Cookie Found -- Try IP
        $data = $wpdb->get_row("SELECT * FROM $table_db_name WHERE trk3 = '$IP'", OBJECT);

        if (empty($data)) {
            // No IP Found - Do Nothing...
        } else {
            // IP Found - Trk it
            echo "IP Found";
            $wpdb->update($table_db_name, array('replay' => "Yes"), array('id' => $data->ID));
        }
    } else {
        // Cookie Was Found - Trk it
        echo "Cookie Found";
        $wpdb->update($table_db_name, array('replay' => "Yes"), array('id' => $cookieStatus));
    }
}

// / TRACK LIVE REPLAY
add_action('wp_ajax_nopriv_webinarignition_trk_replay_auto', 'webinarignition_trk_replay_auto_callback');
add_action('wp_ajax_webinarignition_trk_replay_auto', 'webinarignition_trk_replay_auto_callback');

function webinarignition_trk_replay_auto_callback()
{

    // Get Variables
    global $wpdb;
    $table_db_name = $wpdb->prefix . "webinarignition_leads_evergreen";

    $cookieStatus = $_POST["cookie"];
    $IP = $_POST["ip"];

    if ($cookieStatus == "undefined") {
        // No Cookie Found -- Try IP
        $data = $wpdb->get_row("SELECT * FROM $table_db_name WHERE trk3 = '$IP'", OBJECT);

        if (empty($data)) {
            // No IP Found - Do Nothing...
        } else {
            // IP Found - Trk it
            echo "IP Found";
            $wpdb->update($table_db_name, array('replay' => "Yes"), array('id' => $data->ID));
        }
    } else {
        // Cookie Was Found - Trk it
        echo "Cookie Found";
        $wpdb->update($table_db_name, array('replay' => "Yes"), array('id' => $cookieStatus));
    }
}

// GET QA -- NAME AND EMAIL
add_action('wp_ajax_nopriv_webinarignition_get_qa_name_email', 'webinarignition_get_qa_name_email_callback');
add_action('wp_ajax_webinarignition_get_qa_name_email', 'webinarignition_get_qa_name_email_callback');

function webinarignition_get_qa_name_email_callback()
{

    // Get Variables
    global $wpdb;
    $table_db_name = $wpdb->prefix . "webinarignition_leads_new";

    $cookieStatus = $_POST["cookie"];
    $IP = $_POST["ip"];

    if ($cookieStatus == "undefined") {
        // No Cookie Found -- Try IP
        $data = $wpdb->get_row("SELECT * FROM $table_db_name WHERE trk3 = '$IP'", OBJECT);

        if (empty($data)) {
            // No IP Found - Do Nothing...
            echo "NOQA";
        } else {
            // IP Found - GET NAME / EMAIL
            echo $data->name . "//" . $data->email . "//" . $data->ID;
        }
    } else {
        // Cookie Was Found - Get Info
        $data = $wpdb->get_row("SELECT * FROM $table_db_name WHERE id = '$cookieStatus'", OBJECT);

        echo $data->name . "//" . $data->email . "//" . $data->ID;
    }

    die();
}

// GET QA -- NAME AND EMAIL AUTO
add_action('wp_ajax_nopriv_webinarignition_get_qa_name_email2', 'webinarignition_get_qa_name_email2_callback');
add_action('wp_ajax_webinarignition_get_qa_name_email2', 'webinarignition_get_qa_name_email2_callback');

function webinarignition_get_qa_name_email2_callback()
{

    // Get Variables
    global $wpdb;
    $table_db_name = $wpdb->prefix . "webinarignition_leads_evergreen";

    $cookieStatus = $_POST["cookie"];
    $IP = $_POST["ip"];

    $data = $wpdb->get_row("SELECT * FROM $table_db_name WHERE id = '$cookieStatus' ", OBJECT);

    echo $data->name . "//" . $data->email . "//" . $data->ID;

    die();
}

// RESET STATS
//add_action('wp_ajax_nopriv_webinarignition_update_master_switch', 'webinarignition_update_master_switch_callback');
add_action('wp_ajax_webinarignition_update_master_switch', 'webinarignition_update_master_switch_callback');

function webinarignition_update_master_switch_callback()
{

    $ID = $_POST['id'];
    $status = $_POST['status'];

    // Return Option Object:
    $results = get_option('webinarignition_campaign_' . $ID);
    $results->webinar_switch = $status;

    update_option('webinarignition_campaign_' . $ID, $results);
}

// SAVE AIR MESSAGE
add_action('wp_ajax_nopriv_webinarignition_save_air', 'webinarignition_save_air_callback');
add_action('wp_ajax_webinarignition_save_air', 'webinarignition_save_air_callback');

function webinarignition_save_air_callback()
{

    $ID = $_POST['id'];

    // Return Option Object:
    $results = get_option('webinarignition_campaign_' . $ID);
    $results->air_toggle = $_POST['toggle'];
    $results->air_btn_copy = $_POST['btncopy'];
    $results->air_btn_url = $_POST['btnurl'];
    $results->air_html = $_POST['html'];

    update_option('webinarignition_campaign_' . $ID, $results);
}

// TRACK LIVE REPLAY
add_action('wp_ajax_nopriv_webinarignition_track_order', 'webinarignition_track_order_callback');
add_action('wp_ajax_webinarignition_track_order', 'webinarignition_track_order_callback');

function webinarignition_track_order_callback()
{

    // Get Variables
    global $wpdb;
    $table_db_name = $wpdb->prefix . "webinarignition_leads_new";

    $LEAD = $_POST['lead'];

    // Set Lead As Ordered
    $wpdb->update($table_db_name, array(
        'trk2' => 'Yes'
    ), array('id' => $LEAD)
    );
}

// Store New / Add Phone Number webinarignition_store_phone
add_action('wp_ajax_nopriv_webinarignition_store_phone', 'webinarignition_store_phone_callback');
add_action('wp_ajax_webinarignition_store_phone', 'webinarignition_store_phone_callback');

function webinarignition_store_phone_callback()
{

    // Get Variables
    global $wpdb;
    $table_db_name = $wpdb->prefix . "webinarignition_leads_new";

    $ID = $_POST['id'];
    $PHONE = $_POST['phone'];

    // Set Phone Number
    $wpdb->update($table_db_name, array(
        'phone' => $PHONE
    ), array('id' => $ID)
    );
}

// Store New / Add Phone Number webinarignition_store_phone
add_action('wp_ajax_nopriv_webinarignition_store_phone_auto', 'webinarignition_store_phone_auto_callback');
add_action('wp_ajax_webinarignition_store_phone_auto', 'webinarignition_store_phone_auto_callback');

function webinarignition_store_phone_auto_callback()
{

    // Get Variables
    global $wpdb;
    $table_db_name = $wpdb->prefix . "webinarignition_leads_evergreen";

    $ID = $_POST['id'];
    $PHONE = $_POST['phone'];

    // Set Phone Number
    $wpdb->update($table_db_name, array(
        'phone' => $PHONE
    ), array('id' => $ID)
    );
}

// Get Timezone & Local Time For Users
add_action('wp_ajax_nopriv_webinarignition_get_local_tz', 'webinarignition_get_local_tz_callback');
add_action('wp_ajax_webinarignition_get_local_tz', 'webinarignition_get_local_tz_callback');

function webinarignition_get_local_tz_callback()
{

    // Get Olson Time ::
    $timezone = $_POST['tz'];
    date_default_timezone_set($timezone);
    $dtz = new DateTimeZone($timezone);
    $time_in_sofia = new DateTime('now', $dtz);
    $offset = $dtz->getOffset($time_in_sofia) / 3600;

    echo "<i class='icon-globe' style='margin-right: 10px;' ></i> <b>UTC</b> :: " . ($offset < 0 ? $offset : "+" . $offset) . "<i class='icon-time' style='margin-left: 10px; margin-right:10px;' ></i>  <b>Local Time</b> :: " . date('g:i A');
    die();
}

// Get Timezone & Local Time For Users
add_action('wp_ajax_nopriv_webinarignition_get_local_tz_set', 'webinarignition_get_local_tz_set_callback');
add_action('wp_ajax_webinarignition_get_local_tz_set', 'webinarignition_get_local_tz_set_callback');

function webinarignition_get_local_tz_set_callback()
{

    // Get Olson Time ::
    $timezone = $_POST['tz'];
    date_default_timezone_set($timezone);
    $dtz = new DateTimeZone($timezone);
    $time_in_sofia = new DateTime('now', $dtz);
    $offset = $dtz->getOffset($time_in_sofia) / 3600;

    $set = ($offset < 0 ? $offset : "+" . $offset);
    // ReFormat UTC - GMT and half'rs
    if ($set == "+0") {
        $set = "0";
    } else if ($set == "-9.5") {
        $set = "-930";
    } else if ($set == "-4.5") {
        $set = "-430";
    } else if ($set == "+5.5") {
        $set = "+530";
    } else if ($set == "+5.75") {
        $set = "+545";
    } else if ($set == "+6.5") {
        $set = "+630";
    } else if ($set == "+9.5") {
        $set = "+930";
    }
    echo $set;
    die();
}

// UNLOCK
add_action('wp_ajax_nopriv_webinarignition_unlock', 'webinarignition_unlock_callback');
add_action('wp_ajax_webinarignition_unlock', 'webinarignition_unlock_callback');

function webinarignition_unlock_callback()
{
    // variables
    $username = $_POST["username"];
    $key = $_POST["key"];
    // POST and check...
    $resp = wp_remote_get('http://webinarignition.com/wp-content/plugins/wikeygen/inc/response.php?username=' . $username . '&key=' . $key, array(
        'user-agent' => 'WI',
        'timeout' => 10
    ));
    // Check Response
    if (!is_wp_error($resp) && $resp['body'] == "KeyFound") {
        global $wpdb;
        $table_db_name = $wpdb->prefix . "webinarignition_wi";
        $wpdb->insert($table_db_name, array('switch' => "1", 'keyused' => $key));
        echo "rD";
        die();
    } else {

// print body of resonse error message
// -----------------------------------
      echo $resp['body'];
      exit;
// -----------------------------------

      //   echo implode("\n", $resp->get_error_messages());
      //   die();

    }
}

// Add CSV Lead
add_action('wp_ajax_nopriv_webinarignition_import_csv_leads', 'webinarignition_import_csv_leads_callback');
add_action('wp_ajax_webinarignition_import_csv_leads', 'webinarignition_import_csv_leads_callback');
function webinarignition_import_csv_leads_callback()
{
    // variables
    $id = $_POST["id"];
    $csv = trim($_POST["csv"]);
    $leads = explode("\n", $csv);
    global $wpdb;
    $table_db_name = $wpdb->prefix . "webinarignition_leads_new";
    //print_r($leads);
    //echo "\r\n" .$id;
    // Loop through leads - ignore first (labels)

    foreach ($leads as $key => $lead) {
        $lead = explode(",", $lead);
        $name = trim($lead[0]);
        $email = trim($lead[1]);
        $phone = trim($lead[2]);
        // add to database...
        // Check if lead with such email exists in database
        $lead = $wpdb->get_row($wpdb->prepare("SELECT ID FROM $table_db_name WHERE email = %s", $email));
        if ($lead) {
            echo $lead->ID;
        } else {
            $wpdb->insert($table_db_name, array(
                'app_id' => $id,
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'trk1' => "import",
                'trk3' => "-",
                'event' => 'No',
                'replay' => 'No',
                'created' => date('F j, Y')
            ));
        }
    }
    // print_r($leads);
    die();
}

// Timezone UTC To Abrv.
function webinarignition_utc_to_abrc($utc)
{
    switch ($utc) {
        case "-12":
            return "Y";
        case "-11":
            return "SST";
        case "-10":
            return "CKT";
        case "-930":
            return "MART";
        case "-9":
            return "AKST";
        case "-8":
            return "PST";
        case "-7":
            return "MST";
        case "-6":
            return "CST";
        case "-5":
            return "EST";
        case "-430":
            return "VST";
        case "-330":
            return "NST";
        case "-3":
            return "SRT";
        case "-2":
            return "O";
        case "-1":
            return "EGT";
        case "0":
            return "GMT";
        case "+1":
            return "CET";
        case "+2":
            return "CAT";
        case "+3":
            return "EAT";
        case "+330":
            return "IST";
        case "+4":
            return "AST";
        case "+430":
            return "AFT";
        case "+5":
            return "PKT";
        case "+530":
            return "IST";
        case "+545":
            return "NPT";
        case "+6":
            return "BTT";
        case "+630":
            return "MMT";
        case "+7":
            return "ICT";
        case "+8":
            return "HKT";
        case "+845":
            return "ACWST";
        case "+9":
            return "JST";
        case "+930":
            return "ACST";
        case "+10":
            return "PGT";
        case "+1030":
            return "LHST";
        case "+11":
            return "VUT";
        case "+1130":
            return "NFT";
        case "+12":
            return "MHT";
        case "+1245":
            return "CHAST";
        case "+13":
            return "WST";
        case "+14":
            return "LINT";
            break;
    }
}

add_action('wp_ajax_nopriv_wi_show_logs_get', 'ajax_wi_show_logs');
add_action('wp_ajax_wi_show_logs_get', "ajax_wi_show_logs");
function ajax_wi_show_logs() {
    $webinar = get_option('webinarignition_campaign_' . $_POST['campaign_id']);

    $log_types = array(WI_Logs::LIVE_EMAIL, WI_Logs::LIVE_SMS);
    if ($webinar->webinar_date == 'AUTO') {
        $log_types = array(WI_Logs::AUTO_EMAIL, WI_Logs::AUTO_SMS);
        $webinar->webinar_timezone = false;
    }

    wi_show_logs($webinar->id, $log_types, $_POST['page'], $webinar->timezone);
    die();
}

function wi_show_logs($id, $log_types, $page, $timezone = false)
{
    $logs = WI_Logs::getLogs($id, $log_types, $page, $timezone);
    ?>
        <table>
            <tr>
                <th>Date</th>
                <th>Message</th>
            </tr>
            <?php foreach ($logs as $log) { ?>
                <tr>
                    <td><?php echo $log->date; ?></td>
                    <td><?php echo nl2br($log->message); ?></td>
                </tr>
            <?php } ?>
        </table>
        <?php WI_Logs::pagination($id); ?>
<?php
    if (defined('DOING_AJAX') && DOING_AJAX) {
        die();
    }
}
