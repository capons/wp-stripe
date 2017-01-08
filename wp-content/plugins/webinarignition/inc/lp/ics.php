<?php

// Get Results
$results = get_option('webinarignition_campaign_' . $client);

// Get DB Info
global $wpdb;
$table_db_name = $wpdb->prefix . $pluginName;
$data = $wpdb->get_row("SELECT * FROM $table_db_name WHERE id = '$client'", OBJECT);

// Webinar Info
$title = $results->webinar_desc ? $results->webinar_desc : "Webinar Title";
$desc = $results->webinar_desc ? $results->webinar_desc : "Info for what you will learn on the webinar...";
$host = $results->webinar_host ? $results->webinar_host : "Webinar Host";

if ($results->ty_webinar_url == "custom") {
    $url = $results->ty_werbinar_custom_url;
} else {
    $url = get_permalink($data->postID) . "?live";
}

    
$results->webinar_start_time  = date("H:i", strtotime($results->webinar_start_time));


$timezone = $results->webinar_timezone;
if (!in_array($timezone[0], array('-', '+'))) {
    $timezone = '+' . $timezone;
}
$timezone_sign = $timezone[0];
$timezone_offset = str_pad(str_replace('0', '', substr($timezone, 1)), 4, '0', STR_PAD_BOTH);
$date = DateTime::createFromFormat('m-d-Y H:i:s', $results->webinar_date . ' ' . $results->webinar_start_time . ':00' ,new DateTimeZone($timezone_offset));
$date->setTimezone(new DateTimeZone('UTC'));

define('DATE_FORMAT', 'Ymd\THis');

header("Content-type: application/text");
header("Content-Disposition: attachment; filename=webinar-date.ics");
header("Pragma: no-cache");
header("Expires: 0");

echo
    "BEGIN:VCALENDAR" . "\r\n" .
    "VERSION:2.0" . "\r\n" .
    "PRODID:-//project/author//NONSGML v1.0//EN" . "\r\n" .
    "CALSCALE:GREGORIAN" . "\r\n" .
    "METHOD:PUBLISH" . "\r\n" .
    "BEGIN:VTIMEZONE" . "\r\n" .
    "TZID:GMT" . "\r\n" .
    "BEGIN:STANDARD" . "\r\n" .
    "DTSTART:20071028T010000" . "\r\n" .
    "TZOFFSETTO:+0000" . "\r\n" .
    "TZOFFSETFROM:+0000" . "\r\n" .
    "END:STANDARD" . "\r\n" .
    "END:VTIMEZONE" . "\r\n" .
    "BEGIN:VEVENT" . "\r\n" .
    "DTSTART;TZID=GMT:" . $date->format(DATE_FORMAT) . "\r\n" .
    "DTEND;TZID=GMT:" . $date->modify('+1 hour')->format(DATE_FORMAT) . "\r\n" .
    "UID:" . $date->getTimestamp() . '@' . $client . "\r\n" .
    "DTSTAMP:" . gmdate(DATE_FORMAT) . 'Z' . "\r\n" .
    "SUMMARY:" . $title . "\r\n" .
    "DESCRIPTION:" . $desc . '. Visit ' . $url . "\r\n" .
    "URL;VALUE=URI:" . $url . "\r\n" .
    "END:VEVENT" . "\r\n" .
    "END:VCALENDAR";