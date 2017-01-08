<?php

// ADD WORDPRESS
define('WP_USE_THEMES', false);
require('../../../../wp-blog-header.php');
status_header(200);

$ID = $_GET['id'];

// Get Active Questions For This Webinar
$table_db_name = $wpdb->prefix . "webinarignition_questions_new";
$questionsActive = $wpdb->get_results("SELECT * FROM $table_db_name WHERE app_id = '$ID'", OBJECT);

echo count($questionsActive);

die();
?>