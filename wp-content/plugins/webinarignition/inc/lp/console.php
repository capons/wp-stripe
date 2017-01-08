<?php

// Make sure this page is not cached. Prevents Firefox issue, with registrants not updating
header( 'Cache-Control: no-cache, no-store, must-revalidate' ); // HTTP 1.1.
header( 'Pragma: no-cache' ); // HTTP 1.0.
header( 'Expires: 0' ); // Proxies.
include_once( WEBINARIGNITION_PATH . '/classes/GoogleAuth.php' );

// universal variables
$full_path = get_site_url();
$assets    = WEBINARIGNITION_URL . "inc/lp/";


// Display Leads For This App
global $wpdb;
$ID = $client;
// Get Leads
if ($results->webinar_date == "AUTO") {

    $table_db_name = $wpdb->prefix . "webinarignition_leads_evergreen";
    $leads         = $wpdb->get_results( "SELECT * FROM $table_db_name WHERE app_id = '$ID' ", OBJECT );
    $leads2        = $wpdb->get_results( "SELECT * FROM $table_db_name WHERE app_id = '$ID' ", ARRAY_A );
    $totalLeads1   = count( $leads2 );

    $totalLeads = $totalLeads1;
} else {

    $table_db_name = $wpdb->prefix . "webinarignition_leads_new";
    $leads         = $wpdb->get_results( "SELECT * FROM $table_db_name WHERE app_id = '$ID' ", OBJECT );
    $leads2        = $wpdb->get_results( "SELECT * FROM $table_db_name WHERE app_id = '$ID' ", ARRAY_A );
    $totalLeads1   = count( $leads2 );

    $table_db_name = $wpdb->prefix . "webinarignition_leads";
    $leadsOLD      = $wpdb->get_results( "SELECT * FROM $table_db_name WHERE app_id = '$ID' ", OBJECT );
    $leadsOLD2     = $wpdb->get_results( "SELECT * FROM $table_db_name WHERE app_id = '$ID' ", ARRAY_A );
    $totalLeads2   = count( $leadsOLD2 );

    $totalLeads = $totalLeads1 + $totalLeads2;
}

// Get Questions
$table_db_name = $wpdb->prefix . "webinarignition_questions_new";

$questionsActive = $wpdb->get_results( "SELECT * FROM $table_db_name WHERE app_id = '$ID' AND status = 'live' ",
    OBJECT );
$questionsDone   = $wpdb->get_results( "SELECT * FROM $table_db_name WHERE app_id = '$ID' AND status = 'done' ",
    OBJECT );

$questionsA            = $wpdb->get_results( "SELECT * FROM $table_db_name WHERE app_id = '$ID' ", ARRAY_A );
$questionsA2           = $wpdb->get_results( "SELECT * FROM $table_db_name WHERE app_id = '$ID' AND status = 'live' ",
    ARRAY_A );
$questionsA3           = $wpdb->get_results( "SELECT * FROM $table_db_name WHERE app_id = '$ID' AND status = 'done' ",
    ARRAY_A );
$totalQuestions1       = count( $questionsA );
$totalQuestionsActive1 = count( $questionsA2 );
$totalQuestionsDone1   = count( $questionsA3 );


$table_db_name      = $wpdb->prefix . "webinarignition_questions";
$questionsActiveOLD = $wpdb->get_results( "SELECT * FROM $table_db_name WHERE app_id = '$ID' AND status = 'live' ",
    OBJECT );
$questionsDoneOLD   = $wpdb->get_results( "SELECT * FROM $table_db_name WHERE app_id = '$ID' AND status = 'done' ",
    OBJECT );

$questionsA      = $wpdb->get_results( "SELECT * FROM $table_db_name WHERE app_id = '$ID' ", ARRAY_A );
$questionsA2     = $wpdb->get_results( "SELECT * FROM $table_db_name WHERE app_id = '$ID' AND status = 'live' ",
    ARRAY_A );
$questionsA3     = $wpdb->get_results( "SELECT * FROM $table_db_name WHERE app_id = '$ID' AND status = 'done' ",
    ARRAY_A );
$totalQuestions2 = count( $questionsA );

$totalQuestionsActive = $totalQuestionsActive1 + count((array) $questionsActiveOLD);
$totalQuestionsDone   = $totalQuestionsDone1 + count((array) $questionsDoneOLD);

$totalQuestions = $totalQuestions1 + $totalQuestions2;

// Get Total Orders
$table_db_name = $wpdb->prefix . "webinarignition_leads_new";
$orders        = $wpdb->get_results( "SELECT * FROM $table_db_name WHERE app_id = '$ID' AND trk2 = 'Yes' ", ARRAY_A );
$totalOrders   = count( $orders );

// Info ::
$table_db_name = $wpdb->prefix . "webinarignition";
$data          = $wpdb->get_row( "SELECT * FROM $table_db_name WHERE id = '$ID'", OBJECT );

// Return Option Object:
$results = get_option( 'webinarignition_campaign_' . $ID );

// Path For Stuff
$pluginName = "webinarignition";
$sitePath   = WEBINARIGNITION_URL;
?>

<!DOCTYPE html>
<html>
<head>
<title>WebinarIgnition - Live Webinar Console</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">


<link href="<?php echo $assets; ?>css/normalize.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $assets; ?>css/foundation.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $assets; ?>css/stream.css" rel="stylesheet" type="text/css"/>

<link href="<?php echo $assets; ?>js/te.css" rel="stylesheet" type="text/css"/>

<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

<script src="<?php echo $assets; ?>js/jquery.js"></script>
<script src="<?php echo $assets; ?>js/jquery.dataTables.min.js"></script>
<script src="<?php echo $assets; ?>js/search.js"></script>
<script src="<?php echo $assets; ?>js/cookie.js"></script>
<script src="<?php echo $assets; ?>js/polling.js"></script>
<script src="<?php echo $assets; ?>js/te.js"></script>

<script type="text/javascript">
$(document).ready(function () {

    $('.dashTopBTN').click(function () {
        $ID = $(this).attr("tabID");
        // Toggle Tabs
        $(".consoleTabs").hide();
        $("#" + $ID).show();
        // Style Link
        $('.dashTopBTN').removeClass("success").addClass("secondary").addClass("lc-btn");
        $(this).addClass("secondary");
        $(this).removeClass("lc-btn");
        $(this).addClass("success");
        return false;
    });
    $('#airCopy').jqte();

    // Toggle For On Air
    $(".cb-enable").click(function () {
        var parent = $(this).parents('.switch');
        $('.cb-disable', parent).removeClass('selected');
        $(this).addClass('selected');
        $("#airToggle").val("on");
    });
    $(".cb-disable").click(function () {
        var parent = $(this).parents('.switch');
        $('.cb-enable', parent).removeClass('selected');
        $(this).addClass('selected');
        $("#airToggle").val("off");
    });

    // Get Totals For Leads & Conversions

    // TotalEvents
    var $totalEvent = 0;
    $('.checkEvent').each(function () {

        $check = $(this).text();
        if ($check == "Yes") {
            $totalEvent = $totalEvent + 1;
            $("#eventTotal").text($totalEvent);
            // Get Conversion
            $totalLeads = $("#leadTotal").text();
            $totalLeads = parseInt($totalLeads);
            $conversion = Math.round(($totalEvent / $totalLeads) * 100);
            $("#conversion1").text($conversion + "%");
        }

    });
    // TotalReplay
    var $totalReplay = 0;
    $('.checkReplay').each(function () {

        $check = $(this).text();
        if ($check == "Yes") {
            $totalReplay = $totalReplay + 1;
            $("#replayTotal").text($totalReplay);
            // Get Conversion
            $conversion = Math.round(($totalReplay / $totalEvent) * 100);
            $("#conversion2").text($conversion + "%");
        }

    });
    // TotalOrder
    $totalOrder = 0;
    $('.checkOrder').each(function () {

        $check = $(this).text();
        if ($check == "Yes") {
            $totalOrder = $totalOrder + 1;
            $("#orderTotal").text($totalOrder);
            // Get Conversion
            $totalLeads = $("#leadTotal").text();
            $totalLeads = parseInt($totalLeads);
            $conversion = Math.round(($totalOrder / $totalLeads) * 100);
            $("#conversion3").text($conversion + "%");
        }

    });

    // LEADS - DASHBOARD
    $('#leads').dataTable({'iDisplayLength': 10});
    var oTable = $('#leads').dataTable();
    $("#leads_filter").find("input").attr("placeholder", "Search Through Your Leads Here...");
    // DELETE LEAD
    var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
    $('body').on('click', '.delete_lead', function () {

        $ID = $(this).attr("lead_id");
        confirmation2($ID);
        // $("#table_lead_"+$ID).addClass("delete_highlight");

        return false;
    });
    function confirmation2($LEAD) {
        var answer = confirm("Are You Sure You Want To Delete This Lead?")
        if (answer) {
            var data = {
                <?php if ( $results->webinar_date == "AUTO" ) { ?>
                action: "webinarignition_delete_lead_auto",
                <?php } else { ?>
                action: "webinarignition_delete_lead",
                <?php } ?>
                id: "" + $LEAD + ""
            };
            $.post(ajaxurl, data,
                function (results) {
                    $("#table_lead_" + $LEAD).fadeOut("fast");
                });
        }
        else {

        }
    }

    $('.delete_lead2').click(function () {

        $ID = $(this).attr("lead_id");
        confirmation22($ID);
        // $("#table_lead_"+$ID).addClass("delete_highlight");

        return false;
    });
    function confirmation22($LEAD) {
        var answer = confirm("Are You Sure You Want To Delete This Lead?")
        if (answer) {


            var data = {
                action: "webinarignition_delete_lead2",
                id: "" + $LEAD + ""
            };
            $.post(ajaxurl, data,
                function (results) {
                    $("#table_lead_" + $LEAD).fadeOut("fast");
                });
        }
        else {

        }
    }

    // QA Tabs
    $('#qa-done').click(function () {

        $(".questionTabIt").removeClass("questionTabSelected");
        $(this).addClass("questionTabSelected");
        $("#QAActive").hide();
        $("#QADone").show();
        return false;
    });
    $('#qa-active').click(function () {

        $(".questionTabIt").removeClass("questionTabSelected");
        $(this).addClass("questionTabSelected");
        $("#QADone").hide();
        $("#QAActive").show();
        return false;
    });
    // Delete Question
    $('.qbi-remove').live("click", function () {

        $getID = $(this).attr("qaID");
        confirmationQA($getID);
        return false;
    });
    function confirmationQA($ID) {
        var data = {
            action: "webinarignition_delete_question",
            id: "" + $ID + ""
        };
        $.post(ajaxurl, data,
            function (results) {
                $("#QA-BLOCK-" + $ID).fadeOut("fast");
                // +1 / -1 For Tab Totals
                $totalActive = $("#totalQAActive").text();
                $totalActive = parseInt($totalActive);
                $totalQ = $("#dashTotalQ").text();
                $totalQ = parseInt($totalQ);
                $dashTotalActiveQ = $("#dashTotalActiveQ").text();
                $dashTotalActiveQ = parseInt($dashTotalActiveQ);
                if ($totalActive == 0) {
                    // Do nothing - already zero
                } else {
                    $totalActive = $totalActive - 1;
                    $("#totalQAActive").text($totalActive);
                    $totalQ = $totalQ - 1;
                    $("#dashTotalQ").text($totalQ);
                    $dashTotalActiveQ = $dashTotalActiveQ - 1;
                    $("#dashTotalActiveQ").text($dashTotalActiveQ);
                }

            });
    }

    // Delete Question
    $('.qbi-remove2').live("click", function () {

        $getID = $(this).attr("qaID");
        confirmationQA2($getID);
        return false;
    });
    function confirmationQA2($ID) {

        var data = {
            action: "webinarignition_delete_question2",
            id: "" + $ID + ""
        };
        $.post(ajaxurl, data,
            function (results) {
                $("#QA-BLOCK-" + $ID).fadeOut("fast");
                // +1 / -1 For Tab Totals
                $totalActive = $("#totalQAActive").text();
                $totalActive = parseInt($totalActive);
                $totalQ = $("#dashTotalQ").text();
                $totalQ = parseInt($totalQ);
                $dashTotalActiveQ = $("#dashTotalActiveQ").text();
                $dashTotalActiveQ = parseInt($dashTotalActiveQ);
                if ($totalActive == 0) {
                    // Do nothing - already zero
                } else {
                    $totalActive = $totalActive - 1;
                    $("#totalQAActive").text($totalActive);
                    $totalQ = $totalQ - 1;
                    $("#dashTotalQ").text($totalQ);
                    $dashTotalActiveQ = $dashTotalActiveQ - 1;
                    $("#dashTotalActiveQ").text($dashTotalActiveQ);
                }

            });
    }

    // Delete Question
    $('.qbi-removeDone').live("click", function () {

        $getID = $(this).attr("qaID");
        confirmationQA22($getID);
        return false;
    });
    function confirmationQA22($ID) {
        var data = {
            action: "webinarignition_delete_question",
            id: "" + $ID + ""
        };
        $.post(ajaxurl, data,
            function (results) {
                $("#QA-BLOCK-" + $ID).fadeOut("fast");
                // +1 / -1 For Tab Totals
                $totalQADone = $("#totalQADone").text();
                $totalQADone = parseInt($totalQADone);
                $totalQ = $("#dashTotalQ").text();
                $totalQ = parseInt($totalQ);
                if ($totalQADone == 0) {
                    // Do nothing - already zero
                } else {
                    $totalQADone = $totalQADone - 1;
                    $("#totalQADone").text($totalQADone);
                    $totalQ = $totalQ - 1;
                    $("#dashTotalQ").text($totalQ);
                }

            });
    }

    // Answer Question
    $('.qbi-reply').live("click", function () {

        $email = $(this).attr("mail");
        window.location = "mailto:" + $email + "?Subject=Answer To Your Question...";
        // window.open("mailto:"+$email+"?Subject=Answer To Your Question...");

        return false;
    });
    // Mark Q As Read
    $('.qbi-answer').live("click", function () {

        $getID = $(this).attr("qaID");
        // make update on POST
        var data = {action: 'webinarignition_update_question_status', id: "" + $getID + ""};
        $.post(ajaxurl, data, function (results) {

            $("#QA-BLOCK-" + $getID).appendTo("#question2");
            $("#qbi-answer-" + $getID).hide();
            // change qbi-remove to qbi-removeDone
            $(this).removeClass("qbi-remove");
            $(this).addClass("qbi-removeDone");
            // +1 / -1 For Tab Totals
            $totalActive = $("#totalQAActive").text();
            $totalActive = parseInt($totalActive);
            $totalDone = $("#totalQADone").text();
            $totalDone = parseInt($totalDone);
            $dashTotalActiveQ = $("#dashTotalActiveQ").text();
            $dashTotalActiveQ = parseInt($dashTotalActiveQ);
            if ($totalActive == 0) {
                // Do nothing - already zero
            } else {
                $totalActive = $totalActive - 1;
                $totalDone = $totalDone + 1;
                $("#totalQAActive").text($totalActive);
                $("#totalQADone").text($totalDone);
                $dashTotalActiveQ = $dashTotalActiveQ - 1;
                $("#dashTotalActiveQ").text($dashTotalActiveQ);
            }

        });
        return false;
    });
    // Mark Q As Read
    $('.qbi-answer2').live("click", function () {

        $getID = $(this).attr("qaID");
        // make update on POST
        var data = {action: 'webinarignition_update_question_status2', id: "" + $getID + ""};
        $.post(ajaxurl, data, function (results) {
            $("#QA-BLOCK-" + $getID).appendTo("#question2");
            $("#qbi-answer-" + $getID).hide();
            // +1 / -1 For Tab Totals
            $totalActive = $("#totalQAActive").text();
            $totalActive = parseInt($totalActive);
            $totalDone = $("#totalQADone").text();
            $totalDone = parseInt($totalDone);
            $totalActive = $totalActive - 1;
            $totalDone = $totalDone + 1;
            $("#totalQAActive").text($totalActive);
            $("#totalQADone").text($totalDone);
        });
        return false;
    });
    // QA Look Up Email

    $('.qa-lead-search').click(function () {

        $getEmail = $(this).text();
        oTable.fnFilter($getEmail);
        $(".consoleTabs").hide();
        $("#leadTab").show();
        // Style Link
        $('.dashTopBTN').removeClass("success");
        $('.dashTopBTN').addClass("secondary");
        $('.dashTopBTN').addClass("lc-btn");
        $("#leadTabBTN").addClass("secondary");
        $("#leadTabBTN").removeClass("lc-btn");
        $("#leadTabBTN").addClass("success");
        return false;
    });
    // QA Search
    $('.searchQAActive').quicksearch('.questionBlockWrapperActive', {
        'delay': 300,
        'bind': 'keyup keydown'
    });
    $('.searchQADone').quicksearch('.questionBlockWrapperDone', {
        'delay': 300,
        'bind': 'keyup keydown'
    });
    // QA Refresh
    $('.QARefresh').click(function () {

        var params = [
            "console",
            "QA"
        ];
        window.location.href = window.location.protocol + '//' + window.location.host + window.location.pathname + '?' + params.join('&');
        return false;
    });
    // QA Refresh SET
    <?php
    if ( isset($_GET['QA']) ) {
                ?>
    $(".consoleTabs").hide();
    $("#questionTab").show();
    // Style Link
    $('.dashTopBTN').removeClass("success");
    $('.dashTopBTN').addClass("secondary");
    $('.dashTopBTN').addClass("lc-btn");
    $("#questionTabBTN").addClass("secondary");
    $("#questionTabBTN").removeClass("lc-btn");
    $("#questionTabBTN").addClass("success");
    <?php
}
?>

    // Save Master Switch
    $('#masterSwitch').change(function () {

        $newVal = $(this).val();
        $("#masterSwitchCopy").html("( <b>Saving Webinar Settings...</b> )");
        var data = {
            action: 'webinarignition_update_master_switch',
            id: "<?php echo $client; ?>",
            status: "" + $newVal + ""
        };
        $.post(ajaxurl, data, function (results) {
            $("#masterSwitchCopy").html("( Updates / Saves On Change )");
        });
        return false;
    });

    // Save AIR Settings
    $('#saveAir').click(function () {

        $toggle = $("#airToggle").val();
        // $html = tinyMCE.get('airCopy').getContent();
        $html = $("#airCopy").val();
        $btncopy = $("#air_btn_copy").val();
        $btnurl = $("#air_btn_url").val();
        var data = {
            action: 'webinarignition_save_air',
            id: "<?php echo $client; ?>",
            toggle: "" + $toggle + "",
            btncopy: "" + $btncopy + "",
            btnurl: "" + $btnurl + "",
            html: "" + $html + ""
        };
        $.post(ajaxurl, data, function (results) {
            alert("Saved Broadcast Message Settings");
        });
        return false;
    });
    // Live Question Feed
    $.PeriodicalUpdater('<?php echo WEBINARIGNITION_URL; ?>inc/qa.php', {
        method: 'get',
        data: {id: "<?php echo $client; ?>"},
        minTimeout: 10000,
        maxTimeout: 15000,
        multiplier: 2,
        type: 'text',
        maxCalls: 0,
        autoStop: 0,
        cookie: {},
        verbose: 0
    }, function (remoteData, success, xhr, handle) {
        $response = remoteData;
        $("#question1").html($response);
    });
    // Get Total Questions Feed On Update
    $.PeriodicalUpdater('<?php echo WEBINARIGNITION_URL; ?>inc/qa_total.php', {
        method: 'get',
        data: {id: "<?php echo $client; ?>"},
        minTimeout: 10000,
        maxTimeout: 15000,
        multiplier: 2,
        type: 'text',
        maxCalls: 0,
        autoStop: 0,
        cookie: {},
        verbose: 0
    }, function (remoteData, success, xhr, handle) {
        $response = remoteData;
        $("#dashTotalQ").text($response);
    });
    // Track Users Online
    $.PeriodicalUpdater('<?php echo WEBINARIGNITION_URL; ?>inc/users_online.php', {
        method: 'get',
        data: {id: "<?php echo $client; ?>"},
        minTimeout: 10000,
        maxTimeout: 15000,
        multiplier: 2,
        type: 'text',
        maxCalls: 0,
        autoStop: 0,
        cookie: {},
        verbose: 0
    }, function (remoteData, success, xhr, handle) {
        $response = remoteData;
        $("#usersOnlineCount").html($response);
    });
    $('#showtrackingcode').click(function (event) {
        event.preventDefault();
        prompt("Paste This iFrame Code On Your Download Page: ", "<iframe src='<?php echo get_permalink($data->postID); ?>?trkorder' height='0' width='0' style='display:none;' ></iframe>");
    });
    // Import Leads CSV Area
    $('#importLeads').click(function () {
        $(".importCSVArea").toggle();
        return false;
    });


    $('#addCSV').click(function () {
        $csv = $("#importCSV").val();
        var data = {action: 'webinarignition_import_csv_leads', id: "<?php echo $client; ?>", csv: "" + $csv + ""};
        $.post(ajaxurl, data, function (results) {
             //alert(results);
            // reload page:
            location.reload();
        });
        return false;
    });
});
</script>


</head>
<body style="background-color: #F7F7F7;">

    <?php
    if (current_user_can( 'manage_options' )) {
        // Is logged in as admin
    } else {
        ?>
        <center>
            <h2 style="margin-top: 30px;">Not Available - Only Viewable<br> By Admin / Webinar Host</h2>

            <p>* If you are seeing this as an error, please log into your WP Admin area... *</p>
        </center>
        <?php
        die();
    }
    ?>

    <!-- TOP AREA -->
    <div class="topArea">
        <div class="consoleLogo">
            <img src="<?php echo $assets; ?>images/logoC.png">
        </div>
    </div>

    <!-- Main Area -->
    <div class="mainWrapper">

        <!-- ACTIVE QUESTIONS -->
        <div class="activeQuestionsHeadline">

            <a href="#" class="dashTopBTN button success small" tabID="dashboardTab"><i class="icon-cogs"></i>Console
                Dashboard </a>
            <a href="#" <?php
            if ($results->webinar_date == "AUTO") {
                echo 'style="display:none;"';
            }
            ?> class="dashTopBTN button secondary small lc-btn" tabID="onairTab"><i class="icon-microphone"></i> On Air
                Message</a>
            <a href="#" class="dashTopBTN button secondary small lc-btn" tabID="questionTab" id="questionTabBTN"><i
                    class="icon-question-sign"></i> Manage Questions</a>
            <a href="#" class="dashTopBTN button secondary small lc-btn" tabID="leadTab" id="leadTabBTN"><i
                    class="icon-group"></i> Manage Registrants </a>

        </div>

        <?php
        // Dashboard
        include "console/dash.php";

        // On Air
        include "console/air.php";

        // Questions
        include "console/question.php";

        // Leads
        include "console/lead.php";
        ?>

        <div class="footerArea">
            <p>Live Console For WebinarIgnition - All Rights Reserved @ <?php echo date( 'Y' ) ?></p>
        </div>

    </div>

</body>
</html>
