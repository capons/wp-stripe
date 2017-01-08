<?php

global $wpdb;
$table_db_name = $wpdb->prefix . $pluginName;

$ID = $_GET['id'];

$data = $wpdb->get_row("SELECT * FROM $table_db_name WHERE id = '$ID'", OBJECT);

// Return Option Object:
$results = get_option('webinarignition_campaign_' . $ID);

function stripslashesFull($input) {
    if (is_array($input)) {
        $input = array_map('stripslashesFull', $input);
    } elseif (is_object($input)) {
        $vars = get_object_vars($input);
        foreach ($vars as $k => $v) {
            $input->{$k} = stripslashesFull($v);
        }
    } else {
        $input = stripslashes($input);
    }
    return $input;
}

$results = stripslashesFull($results);


?>

<div class="editTop" style="margin-bottom: 20px;">


    <div class="appinfo" style="margin-left: 5px;">

        <div class="apptopIcon">
            <i class="icon-<?php if ($results->webinar_date == "AUTO") {
                echo "refresh";
            } else {
                echo "microphone";
            } ?> icon-3x "></i>
        </div>

        <div class="apptopTitle">
				<span class="appTitle">
					<span class="weName"><?php echo stripcslashes($data->appname); ?></span> 
					<span class="weNameField" style="display:none;"><input type="text"
                                                                           class="inputField inputFieldNameEdit"
                                                                           name="webinarURLName" id="webinarURLName"
                                                                           value="<?php echo stripcslashes($data->appname); ?>"></span>
					<a href="#" class="editURLWE">EDIT</a>
				</span>

            <span class="appMeta"><b>Created:</b> <?php echo stripcslashes($data->created); ?></span>
        </div>

        <br clear="left"/>

    </div>

    <div class="appactionz" style="padding-top: 12px;">
        <span class=" btn blue-btn-4 saveIt " id="saveIt" style="margin-left: 15px;">
            <a href="#"><i class="icon-save" style="margin-right: 5px;"></i>
                Save & Update
            </a>
        </span>
    </div>


    <br clear="all">

</div>

<div class="editNav">

    <div class="editItem editSelected editItemFirst" tab="tab1">
        <i class="icon-home icon-3x"></i>
        Dashboard
    </div>

    <div class="editItem" tab="tab9">
        <i class="icon-beaker icon-3x"></i>
        Design / Template
    </div>

    <div class="editItem" tab="tab3">
        <i class="icon-file icon-3x"></i>
        Registration Page
    </div>

    <div class="editItem" tab="tab4">
        <i class="icon-copy icon-3x"></i>
        Thank You
    </div>

    <div class="editItem" tab="tab2">
        <i class="icon-microphone icon-3x"></i>
        <?php if ($results->webinar_date == "AUTO") {
            echo "Auto";
        } else {
            echo "Live";
        } ?> Webinar
    </div>

    <div class="editItem" tab="tab5">
        <i class="icon-film icon-3x"></i>
        Webinar Replay
    </div>

    <div class="editItem" tab="tab8">
        <i class="icon-envelope icon-3x"></i>
        Notifications
    </div>

    <div class="editItem editItemEnd" tab="tab6">
        <i class="icon-cogs icon-3x"></i>
        Extra Settings
    </div>

    <br clear="all">

</div>

<div class="editArea">

    <form id="editApp">

        <input type="text" class="inputField inputFieldNameEdit" name="webinarURLName2" id="webinarURLName2"
               value="<?php echo stripcslashes($data->appname); ?>" style="display:none;">
        <input type="hidden" name="webinar_permalink" id="webinar_permalink"
               value="<?php echo get_permalink($data->postID); ?>">

        <?php

        display_field_hidden(
            "action",
            $pluginName . "_edit"
        );

        display_field_hidden(
            "id",
            $_GET['id']
        );

        ?>

        <?php


        include("app/tab1.php");
        include("app/tab2.php");
        include("app/tab3.php");
        include("app/tab4.php");
        include("app/tab5.php");
        include("app/tab6.php");
        include("app/tab7.php");
        include("app/tab8.php");
        include("app/tab9.php");

        ?>


    </form>


    <div id="arcode_hdn_div"></div>
    <div id="arcode_hdn_div2"></div>

</div>