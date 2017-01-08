<div id="listapps" class="dashList" style="width: 940px;">

    <div id="appHeader" class="dashHeaderListing" style="">
        <span><i class="icon-dashboard" style="margin-right: 5px;"></i> Manage All Of Your Webinars:</span>
        <!-- <span class="ctrl-btn" style="margin-left: 20px; background-color: #2b2b2b;" ><a href="http://webinarignition.com/members/download-training/" target="_blank" ><i class="icon-question-sign" style="margin-right: 5px;"></i> View Tutorials</a></span> -->
    </div>

    <?php

    // Display Apps:
    global $wpdb;
    $table_db_name = $wpdb->prefix . "webinarignition";
    $query = "(SELECT * FROM $table_db_name )";
    $results = $wpdb->get_results($query, OBJECT);
    foreach ($results as $results) {

        // Get Date // Date
        $ID = $results->ID;
        $results2 = get_option('webinarignition_campaign_' . $ID);

        ?>

	<div class="editableSectionHeading editableSectionHeadingDASH" webinarID="<?php echo $results->ID; ?>" editsection="we_edit_webinar_settings" style="margin-right: 0px; margin-left: 0px;" >

            <div class="editableSectionIcon">
                <i class="icon-<?php if ($results2->webinar_date == "AUTO") {
                    echo "refresh";
                } else {
                    echo "microphone";
                } ?> icon-2x"></i>
            </div>

            <div class="editableSectionTitle editableSectionTitleDash ">

                <div style="float:left;">
                    <?php echo stripcslashes($results->appname); ?>
				<span class="editableSectionTitleSmall"><b>Created:</b> <?php echo stripcslashes($results->created); ?></span>
                </div>

                <div class="appedit">
                    <?php

                    // Get Total Leads
                    if ($results2->webinar_date == "AUTO") {
                        $table_db_name = $wpdb->prefix . "webinarignition_leads_evergreen";
                        $leads = $wpdb->get_results("SELECT * FROM $table_db_name WHERE app_id = '$ID' ", OBJECT);
                    } else {
                        $table_db_name = $wpdb->prefix . "webinarignition_leads_new";
                        $leads = $wpdb->get_results("SELECT * FROM $table_db_name WHERE app_id = '$ID' ", OBJECT);
                    }

                    $totalLeads = count($leads);
                    $totalLeads = number_format($totalLeads);

                    ?>
                    <?php
                    if ($results2->webinar_date == "AUTO") {
                        // Auto Webinar
                        ?>
                        <span class="ctrl" style="margin-right: 6px;">EVERGREEN</span>
                    <?php
                    } else {
                        // Live Webinar
                        ?>
						<span class="ctrl" style="margin-right: 6px;" ><span style="font-weight:normal;" >Webinar Date:</span> <?php echo $results2->webinar_date; ?></span>
                    <?php
                    }
                    ?>
                    <!-- <span class="ctrl" style="margin-right: 6px;" ><span style="font-weight:normal;" >WV:</span> <?php echo number_format($results->total_live); ?></span> -->
                    <!-- <span class="ctrl2" style="margin-right: 6px;" ><i class="icon-share-alt"></i> <b>14%</b></span> -->
				<span class="ctrl" style="margin-right: 6px;" ><span style="font-weight:normal;" >Total Registrants:</span> <?php echo $totalLeads; ?></span>
                    <!-- <span class="ctrl-btn" style="margin-right: 6px;" ><a target="_blank" href="<?php echo get_permalink($results->postID); ?>"><span class="fui-eye-24 ic"></span></a></span> -->
                    <!-- <span class="ctrl-btn" ><a href="<?php echo $_SERVER["REQUEST_URI"]; ?>&id=<?php echo stripcslashes($results->ID); ?>"><i class="icon-edit-sign" style="margin-right: 5px;"></i> Edit Webinar</a></span> -->
                </div>

                <br clear="all">

            </div>

            <div class="editableSectionToggle">
                <i class="toggleIcon  icon-edit-sign icon-2x"></i>
            </div>

            <br clear="all">

        </div>

    <?php

    }

    ?>


    <div class="appnew">

        <div class="blue-btn-2 btn newWebinarBTN" style="">
            <a href="<?php echo admin_url('?page=webinarignition-dashboard&create'); ?>">
                <i class="icon-plus-sign" style="margin-right: 5px;"></i>
                Create a New Webinar
            </a>
        </div>

        <br clear="right">

    </div>

</div>

<div id="dashinfo" style="display: none;">

    <div class="helpcreate">

        <h4>Version 1.0 <i class="icon-question-sign" style="margin-left: 5px;"></i></h4>

        <p>You are currently running the 1.0 version of BETA webinarignition...</p>

    </div>

    <div class="helpcreate" style="margin-top: 40px;">

        <h4>Need Support? <i class="icon-information-sign" style="margin-left: 5px;"></i></h4>

        <p>This is the area that will have buttons for support, etc, other links...</p>

    </div>

</div>

<br clear="left">
