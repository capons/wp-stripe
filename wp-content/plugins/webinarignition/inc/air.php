<?php

// ADD WORDPRESS
define('WP_USE_THEMES', false);
require('../../../../wp-blog-header.php');
status_header(200);

$ID = $_GET['id'];
$IP = $_GET['ip'];

// Count User As Online -- User Tracking...
global $wpdb;
$table_db_name = $wpdb->prefix . "webinarignition_users_online";
$lookUpIP = $wpdb->get_row("SELECT * FROM $table_db_name WHERE app_id = '$ID' AND ip = '$IP' ", OBJECT);

if (empty($lookUpIP)) {
    // Not Found -- Add Users
    $wpdb->insert($table_db_name, array('app_id' => $ID, 'ip' => $IP, 'dt' => date("Y-m-d H:i:s")));
} else {
    // Found -- Update Time
    $wpdb->update($table_db_name, array('dt' => date("Y-m-d H:i:s")), array('id' => $lookUpIP->ID));
}
// Purge All Who Havent been updated in 5 minutes...
// $currentTime = date("Y-m-d H:i:s");
// $currentTime = strtotime($currentTime);
// $minus5Minutes = date("Y-m-d H:i:s", strtotime('-5 minutes', $currentTime));
// $wpdb->query("DELETE FROM $table_db_name WHERE dt < '$minus5Minutes' ");	
// Return Option Object:
$results = get_option('webinarignition_campaign_' . $ID);

// Check If Message is ON, if not, do nothing...
if ($results->air_toggle == "" || $results->air_toggle == "off") {
    // Air Message Not On
    echo "OFF";
    die();
} else {
    // Air Message On, show Message::
    $showHTML = $results->air_html;
    $showHTML = str_replace("<!DOCTYPE html><html><head></head><body>", "", $showHTML);
    $showHTML = str_replace("</body></html>", "", $showHTML);
    echo stripcslashes($showHTML);
    echo '<div id="orderBTNArea">';
    if ($results->air_btn_url == "") {

    } else {
        echo '<a href="' . $results->air_btn_url . '" target="_blank" class="large radius button success addedArrow replayOrder" style="background-color: #6BBA40; ?>; border: 1px solid rgba(0,0,0,0.20); width: 880px; margin-top:0px;" >' . $results->air_btn_copy . '</a>';
    }
    echo '</div>';
    die();
}
?>