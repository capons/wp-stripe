<?php

// ADD WORDPRESS
define('WP_USE_THEMES', false);
require('../../../../wp-blog-header.php');
status_header(200);

// Count User As Online -- User Tracking...
global $wpdb;
$table_db_name = $wpdb->prefix . "webinarignition_users_online";
// Purge All Who Havent been updated in 5 minutes...
$currentTime = date("Y-m-d H:i:s");
$currentTime = strtotime($currentTime);
$minus5Minutes = date("Y-m-d H:i:s", strtotime('-5 minutes', $currentTime));
$wpdb->query("DELETE FROM $table_db_name WHERE dt < '$minus5Minutes' ");
// Count All
$lookUpIP = $wpdb->get_results("SELECT * FROM $table_db_name", OBJECT);
echo count($lookUpIP);
die();