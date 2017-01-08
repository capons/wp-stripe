<?php

// ADD WORDPRESS

define('WP_USE_THEMES', false);
require('../../../../wp-blog-header.php');
status_header(200);

// Deal ID
$ID = ( int )$_POST['id'];

if (!wp_verify_nonce($_POST['nonce'], 'wi_delete_campaign_' . $ID))
    wp_nonce_ays('wi_delete_campaign_' . $ID);

if (!is_user_logged_in())
    die('Unauthorized action.');

global $wpdb;

$getVersion = "webinarignition";
$table_db_name = $wpdb->prefix . $getVersion;

// Also Delete Corrasponding Page Post
$results = $wpdb->get_row("SELECT * FROM $table_db_name WHERE id = '$ID'", OBJECT);
wp_delete_post($results->postID, true);
$wpdb->query("DELETE FROM $table_db_name WHERE id = $ID");
