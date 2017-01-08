<?php

// ADD WORDPRESS
define('WP_USE_THEMES', false);
require('../../../../wp-blog-header.php');
status_header(200);

$ID = $_GET['id'];

// Get Active Questions For This Webinar
$table_db_name = $wpdb->prefix . "webinarignition_questions_new";
$questionsActive = $wpdb->get_results("SELECT * FROM $table_db_name WHERE app_id = '$ID' AND status = 'live' ", OBJECT);

foreach ( $questionsActive as $questionsActive ) {
            echo "

	 		 <!-- QUESTION BLOCK -->
				<div class='questionBlockWrapper questionBlockWrapperActive' qa_lead='" . $questionsActive->ID . "' id='QA-BLOCK-" . $questionsActive->ID . "' >

					<div class='questionBlockQuestion'>
						<span class='questionBlockTitle' >" . $questionsActive->question . "</span>
						<span class='questionBlockAuthor' >" . $questionsActive->name . " - <span class='radius secondary label qa-lead-search'>" . $questionsActive->email . "</span></span>
					</div>

					<div class='questionActions'>

						<div class='questionBlockIcons qbi-remove' qaID='" . $questionsActive->ID . "'>
							<i class='icon-remove icon-large'></i>
						</div>

						<div class='questionBlockIcons qbi-reply' mail='" . $questionsActive->email . "' >
							<i class='icon-comments icon-large'></i>
						</div>

						<div class='questionBlockIcons qbi-answer' id='qbi-answer-" . $questionsActive->ID . "' qaID='" . $questionsActive->ID . "'>
							<i class='icon-check-sign icon-large'></i>
						</div>

						<br clear='left' />

					</div>

					<br clear='all' />

				</div>
				<!-- END OF QUESTION BLOCK -->

	 	";
}

$table_db_name = $wpdb->prefix . "webinarignition_questions";
$questionsActive = $wpdb->get_results("SELECT * FROM $table_db_name WHERE app_id = '$ID' AND status = 'live' ", OBJECT);

foreach ( $questionsActive as $questionsActive ) {
            echo "

	 		 <!-- QUESTION BLOCK -->
				<div class='questionBlockWrapper questionBlockWrapperActive' qa_lead='" . $questionsActive->ID . "' id='QA-BLOCK-" . $questionsActive->ID . "' >

					<div class='questionBlockQuestion'>
						<span class='questionBlockTitle' >" . $questionsActive->question . "</span>
						<span class='questionBlockAuthor' >N/A Info</span>
					</div>

					<div class='questionActions'>

						<div class='questionBlockIcons qbi-remove' qaID='" . $questionsActive->ID . "'>
							<i class='icon-remove icon-large'></i>
						</div>

						<div class='questionBlockIcons qbi-answer' id='qbi-answer-" . $questionsActive->ID . "' qaID='" . $questionsActive->ID . "'>
							<i class='icon-check-sign icon-large'></i>
						</div>

						<br clear='left' />

					</div>

					<br clear='all' />

				</div>
				<!-- END OF QUESTION BLOCK -->

	 	";
}



die();
?>