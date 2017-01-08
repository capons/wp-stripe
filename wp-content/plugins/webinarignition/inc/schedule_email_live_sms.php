<?php

set_time_limit(0);
ignore_user_abort();

// ADD WORDPRESS
define('WP_USE_THEMES', false);
require('../../../../wp-blog-header.php');
status_header(200);

// Include Twilio Lib
require 'Services/Twilio.php';

// Include Helper Functions
require 'schedule_email_live_fn.php';

// CRON Setup For Sending Out Emails
$campaignID = $_GET["id"];

// Get Results
$results = get_option('webinarignition_campaign_' . $campaignID);

// SETUP :: Core Time Settings
$TZID = wi_convert_utc_to_tzid($results->webinar_timezone);
date_default_timezone_set("$TZID");
$date_and_time = date('Y-m-d H:i');
$date_only = date('Y-m-d');
$time_only = date('H:i');
$time_only_e = explode(":", $time_only);

// SETUP :: Buffer Zone
$time = strtotime($time_only);
$startTime = date("H:i", strtotime('-30 minutes', $time));
$endTime = date("H:i", strtotime('+30 minutes', $time));
$time_buffer = $time_only_e[1] - 10;
$time_buffer2 = $time_only_e[1] + 10;
$dt_buffer_n = $date_only . " " . $startTime;
$dt_buffer_p = $date_only . " " . $endTime;

// #####################################
//
// ### Schedule Checks - Match Time/Date
//
// #####################################
//
// NOTIFICATION TXT
//
// #####################################
//
$check_dt_txt = wi_build_time($campaignID, $results->email_twilio_date, $results->email_twilio_time);
$check_txt_day_before = wi_dt_check($dt_buffer_n, $dt_buffer_p, $check_dt_txt);
if ( $check_txt_day_before == "yes" ) {
        if ( $results->date_txt_day_before_checkxx != "sent" ) {
                // Send Out TXT
                wi_send_txt($results);
                echo "<br><br><b>TXT :: 1 HOUR BEFORE :: Triggered</b><br><br>";
        }
}