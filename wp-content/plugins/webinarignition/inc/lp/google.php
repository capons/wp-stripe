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

//encode url parameters
$title = urlencode($title);
$desc = urlencode($desc);
$host = urlencode($host);
$url = urlencode($url);

$timezone = $results->webinar_timezone;
if (!in_array($timezone[0], array('-', '+'))) {
    $timezone = '+' . $timezone;
}
$timezone_sign = $timezone[0];
$timezone_offset = str_pad(str_replace('0', '', substr($timezone, 1)), 4, '0', STR_PAD_BOTH);


$results->webinar_start_time  = date("H:i", strtotime($results->webinar_start_time));


$date = DateTime::createFromFormat('m-d-Y H:i:s', $results->webinar_date . ' ' . $results->webinar_start_time . ':00', new DateTimeZone($timezone_offset));
$date->setTimezone(new DateTimeZone('UTC'));


define('DATE_FORMAT', 'Ymd\THis');

// Build Final URL
$build_url = "http://www.google.com/calendar/event?action=TEMPLATE&text=" . $title . "&dates=" . $date->format(DATE_FORMAT) . 'Z' . "/" . $date->modify('+1 hour')->format(DATE_FORMAT) . 'Z' . "&details=" . $desc . "&location=" . $url . "&trp=true&sprop=" . $host . "&sprop=name:" . $url;

// echo $build_url;
header("Location: $build_url");