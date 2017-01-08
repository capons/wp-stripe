<?php

// Add a new lead into for a evergreen
// ADD WORDPRESS
define('WP_USE_THEMES', false);
require('../../../../wp-blog-header.php');
status_header(200);

// Get & Set Core Values
$date_picked = "2013-06-22";

$time_picked = "16:10";
$time_e = explode(":", $time_picked);

$webinar_length = "1:20";
$webinar_length_e = explode(":", $webinar_length);

// Date Webinar Goes Live
$date_picked_and_live = $date_picked . " " . $time_picked;

echo "The Time They Choose: " . $date_picked_and_live;
echo "<br><br>";

// 1 Day BEFORE Webinar
$date_1_day_before = new DateTime($date_picked);
$date_1_day_before->modify('-1 day');
$date_1_day_before = $date_1_day_before->format('Y-m-d') . " " . $time_picked;

echo "1 Day <b>Before</b> Webinar: " . $date_1_day_before;
echo "<br><br>";

// 1 Hour Before Webinar
$date_1_hour_before_hour = $time_e[0] - 1;
$date_1_hour_before = $date_1_hour_before_hour . ":" . $time_e[1];
$date_1_hour_before = $date_picked . " " . $date_1_hour_before;

echo "1 Hour <b>Before</b> Webinar: " . $date_1_hour_before;
echo "<br><br>";

// On Webinar Complete 
$date_after_live_hour = $time_e[0] + $webinar_length_e[0];
$date_after_live_minute = $time_e[1] + $webinar_length_e[1];
$date_after_live = $date_after_live_hour . ":" . $date_after_live_minute;
$date_after_live = $date_picked . " " . $date_after_live;

echo "After <b>Completed</b> Webinar: " . $date_after_live;
echo "<br><br>";

// 1 Day AFTER Webinar
$date_1_day_after = new DateTime($date_picked);
$date_1_day_after->modify('+1 day');
$date_1_day_after = $date_1_day_after->format('Y-m-d') . " " . $time_picked;

echo "1 Day <b>After</b> Webinar: " . $date_1_day_after;
echo "<br><br>";


// Add New lead ::
global $wpdb;
$table_db_name = $wpdb->prefix . "webinarignition_leads_evergreen";

$wpdb->insert($table_db_name, array(
            'app_id' => "1",
            'name' => "Mister Thompson",
            'email' => 'monetizedesign@gmail.com',
            'created' => date('F j, Y'),
            'date_picked_and_live' => $date_picked . " " . $time_picked,
            'date_1_day_before' => $date_1_day_before,
            'date_1_hour_before' => $date_1_hour_before,
            'date_after_live' => $date_after_live,
            'date_1_day_after' => $date_1_day_after,
            'lead_timezone' => "America/New_York",
            'lead_status' => ""
));
?>