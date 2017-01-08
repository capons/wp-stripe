<?php 
	
	// ADD WORDPRESS
	
	define('WP_USE_THEMES', false);
	require('../../../../wp-blog-header.php');

	$ID = $_GET['id'];
	
	global $wpdb;
	
	$getVersion = "webinarignition_leads";
	$table_db_name = $wpdb->prefix . $getVersion;
	
	$results = $wpdb->get_results("SELECT * FROM $table_db_name WHERE app_id = '$ID' ", OBJECT);
	
	// CSV Header:
	
	header("Content-type: application/text");
	header("Content-Disposition: attachment; filename=export_leads_bcc.txt");
	header("Pragma: no-cache");
	header("Expires: 0");
	
	foreach ($results as $results) {
	    
	    echo $results->email;
	    echo ",";
	}
	
	
?>