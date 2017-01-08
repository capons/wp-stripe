<?php
$full_path = get_site_url();
$assets = WEBINARIGNITION_URL . "inc/lp/";

// Get Results
$id = $client;
$results = get_option('webinarignition_campaign_' . $id);

// Check if its a auto Webinar
if ($results->webinar_date == "AUTO") {
    // Get Information
    $leadID = $_GET['lid'];
    global $wpdb;
    $table_db_name = $wpdb->prefix . "webinarignition_leads_evergreen";
    $query = "(SELECT * FROM $table_db_name WHERE id = '$leadID' )";
    $leadinfo = $wpdb->get_row($query, OBJECT);

    // Get the Lead's Timezone
//    $autoTZ_org = $leadinfo->lead_timezone;
//    $dtz = new DateTimeZone($autoTZ_org);

    //echo "$autoTZ_org";

    // Get current time based on lead's timezone
    //$time_in_sofia = new DateTime('now', $dtz);

    // Get offset between server time and lead's time
    //$autoTZ = ($dtz->getOffset($time_in_sofia)) / 3600;
    //$autoTZ = ($autoTZ < 0 ? $autoTZ : "+" . $autoTZ);

    //echo "<br />";
    //echo $autoTZ;
}
?>
<!DOCTYPE html>
<html>
<head>

    <!-- META INFO -->
    <title><?php display($results->lp_metashare_title, "Amazing Webinar"); ?></title>
    <meta name="description"
          content="<?php display($results->lp_metashare_desc, "Join this amazing webinar, and discover industry trade secrets!"); ?>">
    <?php
    if ($results->ty_share_image == "") {

    } else {
        ?>
        <meta property="og:image" content="<?php display($results->ty_share_image, ""); ?>"/><?php } ?>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <link href="<?php echo $assets; ?>css/normalize.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $assets; ?>css/foundation.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $assets; ?>css/main.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $assets; ?>css/webinar.css" rel="stylesheet" type="text/css"/>

    <?php include("css/webinar_css.php"); ?>

    <link href="<?php echo $assets; ?>css/cdres.css" rel="stylesheet" type="text/css"/>

    <link href="<?php echo $assets; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $assets; ?>css/font-awesome-ie7.min.css" rel="stylesheet" type="text/css"/>

    <link href="<?php echo $assets; ?>css/countdown.css" rel="stylesheet" type="text/css"/>


    <script src="<?php echo $assets; ?>js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo $assets; ?>js/countdown.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            var austDay = new Date();

            <?php
            // Get Date
            if ( $results->webinar_date == "AUTO" ) {
                        $livedate = explode(" ", $leadinfo->date_picked_and_live);
                        $expire = $livedate[0];
                        // Check Format ie - OR /
                        if ( strpos($expire, '-') ) {
                                    $exDate = explode("-", $expire);
                        } else {
                                    $exDate = explode("/", $expire);
                        }

                        // $exDate = explode("-", $expire);
                        $exYear = $exDate[0];
                        $exMonth = (int)$exDate[1];
                        $exDay = $exDate[2];
            } else {
                        $expire = $results->webinar_date;
                        // Check Format ie - OR /
                        if ( strpos($expire, '-') ) {
                                    $exDate = explode("-", $expire);
                        } else {
                                    $exDate = explode("/", $expire);
                        }

                        // $exDate = explode("-", $expire);
                        $exYear = $exDate[2];
                        $exMonth = (int)$exDate[0];
                        $exDay = $exDate[1];
            }



            // Get Time
            if ( $results->webinar_date == "AUTO" ) {
                        $time = $livedate[1];
            } else {
                        $time = $results->webinar_start_time;
            }

            $time = date('H:i', strtotime($time));

            $exTime = explode(":", $time);
            $exHr = $exTime[0];
            $exMin = $exTime[1];
            $exSec = "00";
            ?>

            <?php if( $results->webinar_date == "AUTO" ){
                $tz = new DateTimeZone($leadinfo->lead_timezone);
            ?>
            austDay = $.countdown.UTCDate(<?php echo $tz->getOffset(new DateTime()) / 3600; ?>, <?php echo $exYear ? $exYear : '0'; ?>, <?php echo $exMonth ? $exMonth : '0'; ?>-1, <?php echo $exDay ? $exDay : '0'; ?>, <?php echo $exHr ? $exHr : '0'; ?>, <?php echo $exMin ? $exMin : '0'; ?>, <?php echo $exSec ? $exSec : '0'; ?>);
            <?php } else {
                $tz = new DateTimeZone($results->webinar_timezone);
                ?>
            austDay = $.countdown.UTCDate(<?php echo $tz->getOffset(new DateTime())/3600; ?>, <?php echo $exYear ? $exYear : '0'; ?>, <?php echo $exMonth ? $exMonth : '0'; ?>-1, <?php echo $exDay ? $exDay : '0'; ?>, <?php echo $exHr ? $exHr : '0'; ?>, <?php echo $exMin ? $exMin : '0'; ?>, <?php echo $exSec ? $exSec : '0'; ?>);
            <?php } ?>


            $('#defaultCountdown').countdown({
                until: austDay,
                onExpiry: expired_cd,
                alwaysExpire: true,
                labels: ['Years', '<?php display($results->cd_months, "Months"); ?>', '<?php display($results->cd_weeks, "Weeks"); ?>', '<?php display($results->cd_days, "Days"); ?>', '<?php display($results->cd_hours, "Hours"); ?>', '<?php display($results->cd_minutes, "Minutes"); ?>', '<?php display($results->cd_seconds, "Seconds"); ?>'],
                labels1: ['Year', '<?php display($results->cd_months, "Months"); ?>', '<?php display($results->cd_weeks, "Weeks"); ?>', '<?php display($results->cd_days, "Days"); ?>', '<?php display($results->cd_hours, "Hours"); ?>', '<?php display($results->cd_minutes, "Minutes"); ?>', '<?php display($results->cd_seconds, "Seconds"); ?>']
            });

            function expired_cd() {

               <?php $prmaLink = wi_fixPerma($results->postID); ?>

                <?php if ( $results->webinar_date == "AUTO" ) { ?>
                window.location.href = "<?php echo $prmaLink; ?>live&lid=<?php echo $_GET['lid']; ?>";
                <?php } else { ?>
                // reset link to show live webinar
                var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
                var data = {
                    action: 'webinarignition_update_to_live',
                    id: "<?php echo $client; ?>"
                }
                $.post(ajaxurl, data, function (results) {
                    window.location.href = "<?php echo $prmaLink; ?>live";
                });
                <?php } ?>

            }

        });
    </script>

    <?php include("css/webinar_css.php"); ?>

    <!-- CUSTOM JS -->
    <script type="text/javascript">
        <?php display($results->custom_webinar_js, ""); ?>
    </script>
    <!-- CUSTOM CSS -->
    <style type="text/css">
        <?php display($results->custom_webinar_css, ""); ?>
    </style>

</head>
<body>

<!-- TOP AREA -->
<div class="topArea">
    <div class="bannerTop">
        <?php
        if ($results->webinar_banner_image == "") {
            // echo "NONE";
        } else {
            echo "<img src='$results->webinar_banner_image' />";
        }
        ?>
    </div>
</div>

<!-- Main Area -->
<div class="mainWrapper">

    <!-- HEADLINE AREA -->
    <?php if ($results->webinar_date == "AUTO") { ?>
        <div class="headlineArea">
            <?php
            display(
                $results->cd_headline, '<h4 class="subheader" >You Are Viewing The Webinar That Is Not Yet Live - <b>We Go Live Soon!</b></h4>');
            ?>
        </div>
    <?php } else { ?>
        <div class="headlineArea">
            <?php
            display(
                $results->cd_headline, '<h4 class="subheader" >You Are Viewing The Webinar That Is Not Yet Live - <b>We Go Live Soon!</b></h4>
				 <h2 style="margin-top: -10px; margin-bottom: 30px;" >Webinar Starts {DATE}</h2>');
            ?>
        </div>
    <?php } ?>

    <!-- COUNTDOWN AREA -->
    <div class="countdownArea">
        <center>
            <div id="defaultCountdown"></div>
        </center>
        <br clear="left"/>
    </div>

    <br clear="left"/>


    <?php
    if ($results->webinar_date == "AUTO") {
        // Display Date ::
        // Get Date
        $autoDate_info = explode(" ", $leadinfo->date_picked_and_live);
        $autoDate = $autoDate_info[0];

        $date_format = get_option("date_format");
        $autoDate_format = date($date_format, strtotime($autoDate_info[0]));
        // Final Step = Translate Months
        $months = $results->auto_translate_months;
        $days = $results->auto_translate_days;

        $autoDate_format = wi_translate_dm($months, $autoDate_format);
        $autoDate_format = wi_translate_dm($days, $autoDate_format, 'days');

        $autoTime = wi_get_time_tz($autoDate_info[1], $results->webinar_timezone, $results->time_format, $results->time_suffix);

        $autoDate2 = $autoDate_format . " - " . $autoTime;
        echo "<div class='cd_auto_date' >" . $autoDate2 . "</div>";
    }
    ?>

    <!-- UNDER COUNTDOWN AREA -->
    <?php if ($results->webinar_date == "AUTO") { ?>
    <?php } else { ?>

        <div class="headlineArea" style="margin-top: 30px;">

            <?php
            display(
                $results->cd_headline2, '<h4 class="subheader" >Not Signed Up Yet For The Awesome Webinar?</h4>
			 <h2 style="margin-top: -10px; margin-bottom: 30px;" >Signup To The Webinar</h2>');
            ?>

            <?php
            if ($results->cd_button_show !== 'hidden') {
                ?>
                <a href="<?php
                if ($results->cd_button == "custom") {
                    echo $results->cd_button_url;
                } else {
                    echo "?page_id=".$_GET['page_id'];
                }
                ?>" id="optinBTN" class="large button"
                   style="border: 1px solid rgba(0,0,0,0.10); background-color: <?php display($results->cd_button_color, "#74BB00"); ?>;"><?php display($results->cd_button_copy, "Register For Webinar"); ?></a>
            <?php } ?>
        </div>
    <?php } ?>

</div>

<!-- BOTTOM AREA -->
<div class="bottomArea">
    <div><?php display($results->footer_copy, "All Rights Reserved - Copyright @ " . date('Y')); ?></div>
    <?php if ($results->footer_branding == "show" || $results->footer_branding == "") { ?>
        <div style="margin-top: 15px;"><a
                href="<?php display($results->footer_branding_url, "//webinarignition.com/"); ?>"
                target="_blank"><b><?php display($results->footer_branding_copy, "Powered By WebinarIgnition"); ?></b></a>
        </div>
    <?php } ?>
</div>

<!--Extra code-->
<?php
echo $results->footer_code;
?>

</body>
</html>
