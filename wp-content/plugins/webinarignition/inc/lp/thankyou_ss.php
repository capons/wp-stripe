<?php
// universal variables
$full_path = get_site_url();
$assets = WEBINARIGNITION_URL . "inc/lp/";

// Get DB Info
global $wpdb;
$table_db_name = $wpdb->prefix . "webinarignition";
$ID = $client;
$data = $wpdb->get_results("SELECT * FROM $table_db_name WHERE id = '$ID'", OBJECT);
foreach ($data as $data) {

}

$pluginName = "webinarignition";
$sitePath = WEBINARIGNITION_URL;

// Get Results
$id = $client;
$results = get_option('webinarignition_campaign_' . $id);
?>

<?php
if ($results->webinar_date == "AUTO") {

    // Auto Webinar Information...
    // Get ID
    $getAutoID = $_COOKIE['we-trk-' . $client];
    // Get Data
    $table_db_name = $wpdb->prefix . "webinarignition_leads_evergreen";
    $autoData = $wpdb->get_results("SELECT * FROM $table_db_name WHERE id = '$getAutoID'", OBJECT);
    foreach ($autoData as $autoData) {

    }

    // Get Date
    $date_format = get_option("date_format");
    $autoDate_info = explode(" ", $autoData->date_picked_and_live);
    $autoDate = $autoDate_info[0];
    $autoDate_format = date($date_format, strtotime($autoDate_info[0]));
    // Final Step = Translate Months
    $months = $results->auto_translate_months;
    $days = $results->auto_translate_days;

    $autoDate_format = wi_translate_dm($months, $autoDate_format);
    $autoDate_format = wi_translate_dm($days, $autoDate_format, 'days');

    $autoTime_format = $autoDate_info[1];
    $autoTime = wi_get_time_tz($autoTime_format,$results->webinar_timezone, $results->time_format, $results->time_suffix);
    $autoTZ_org = $autoData->lead_timezone;
    $dtz = new DateTimeZone($autoTZ_org);
    $time_in_sofia = new DateTime('now', $dtz);
    $autoTZ = $dtz->getOffset($time_in_sofia) / 3600;
    $autoTZ = ($autoTZ < 0 ? $autoTZ : "+" . $autoTZ);

    // instant test
    $instantTest = "";
    if ($autoData->trk8 == "yes") {
        $instantTest = "style='display:none;'";
    }
} else {
    $dtz = new DateTimeZone($results->webinar_timezone);
    $time_in_sofia = new DateTime('now', $dtz);
    $autoTZ = $dtz->getOffset($time_in_sofia) / 3600;
    $autoTZ = ($autoTZ < 0 ? $autoTZ : "+" . $autoTZ);
}
?>

<!DOCTYPE html>
<html>
<head>

    <!-- META INFO -->
    <title><?php
        if ($results->meta_site_title_ty == "") {
            display($results->lp_metashare_title, "Amazing Webinar");
        } else {
            echo $results->meta_site_title_ty;
        }
        ?></title>
    <meta name="description" content="<?php
    if ($results->meta_desc_ty == "") {
        display($results->lp_metashare_desc, "Join this amazing webinar, and discover industry trade secrets!");
    } else {
        echo $results->meta_desc_ty;
    }
    ?>">

    <?php
    if ($results->ty_share_image == "") {

    } else {
        ?>
        <meta property="og:image" content="<?php display($results->ty_share_image, ""); ?>"/><?php } ?>


    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <link href="<?php echo $assets; ?>css/normalize.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $assets; ?>css/foundation.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $assets; ?>js-libs/css/intlTelInput.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $assets; ?>css/main.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $assets; ?>css/ss.css" rel="stylesheet" type="text/css"/>

    <link href="<?php echo $assets; ?>css/ssres.css" rel="stylesheet" type="text/css"/>

    <link href="<?php echo $assets; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $assets; ?>css/font-awesome-ie7.min.css" rel="stylesheet" type="text/css"/>

    <?php include("css/ss_css.php"); ?>

    <!-- CUSTOM JS -->
    <script type="text/javascript">
        <?php display($results->custom_lp_js, ""); ?>
    </script>
    <!-- CUSTOM CSS -->
    <style type="text/css">
        <?php display($results->custom_lp_css, ""); ?>
    </style>


</head>
<body>

<!-- TOP AREA -->
<div class="topArea">
    <div class="bannerTop">
        <?php
        if ($results->lp_banner_image == "") {
            // echo "NONE";
        } else {
            echo "<img src='$results->lp_banner_image' />";
        }
        ?>
    </div>
</div>

<!-- Main Area -->
<div class="mainWrapper">

<!-- HEADLINE AREA -->
<div class="headlineArea">
    <div class="ssHeadline">
        <?php
        display(
            $results->ty_headline, "<h2 style='margin-top: -10px;' >Congrats! You're All Signed Up For The Webinar</h2>"
        );
        ?>
    </div>
</div>

<!-- MAIN AREA -->
<div class="cpWrapper">

<div class="cpLeftSide">
    <!-- VIDEO / CTA AREA -->
    <div class="videoBlock">

        <div class="ctaArea">
            <?php
            if ($results->ty_cta_type == "" || $results->ty_cta_type == "video") {
                display(
                    do_shortcode($results->ty_cta_video_code), '<img src="' . $assets . 'images/novideo.png" />'
                );
            } else {
                echo "<img src='";
                display($results->ty_cta_image, $assets . 'images/noctaimage.png');
                echo "' height='281' width='500' />";
            }
            ?>
        </div>

    </div>

    <div class="innerHeadline addedArrow ">
                                                                        <span>
                                                                                    <?php
                                                                                    display(
                                                                                        $results->ty_step1_headline, 'Step#1: Grab The Webinar URL'
                                                                                    );
                                                                                    ?>
                                                                        </span>
        <br clear="right"/>
    </div>

    <!-- WEBINAR URL AREA -->
    <div class="webinarURLWrapper">

        <div class="webinarURLHeadline">
            <?php
            display(
                $results->ty_webinar_headline, 'Here is the webinar URL...'
            );
            ?>
        </div>

        <!-- AUTO CODE BLOCK AREA -->
        <?php if ($results->webinar_date == "AUTO") { ?>
            <!-- AUTO DATE -->
            <input type="text" id="webbyURL" value="<?php
            if ($results->ty_webinar_url == "custom") {
                echo $results->ty_werbinar_custom_url;
            } else {
                echo wi_fixPerma($data->postID)."live&lid=" . $getAutoID . "&event=OI3shBXlqsw&live=1";
            }
            ?>">
        <?php } else { ?>
            <input type="text" id="webbyURL" value="<?php
            if ($results->ty_webinar_url == "custom") {
                echo $results->ty_werbinar_custom_url;
            } else {
                echo wi_fixPerma($data->postID)."live";
            }
            ?>">
        <?php } ?>
        <!-- END AUTO CODE BLOCK AREA -->

        <div class="webinarURLHeadline2">
            <?php
            display(
                $results->ty_webinar_subheadline, 'Save and bookmark this URL so you can get access to the live webinar and webinar replay...'
            );
            ?>
        </div>

    </div>

    <div style="display:<?php display($results->ty_share_toggle, "none"); ?>;">

        <div class="innerHeadline addedArrow ">
                                                                                    <span>
                                                                                                <?php
                                                                                                display(
                                                                                                    $results->ty_step2_headline, 'Step #2: Share & Unlock Cool Reward...'
                                                                                                );
                                                                                                ?>
                                                                                    </span>
            <br clear="right"/>
        </div>

        <div class="innerCopy">

            <!-- SHARE BLOCK -->
            <div class="shareBlock wi-block--sharing">

                <?php
                if ($results->ty_fb_share == "off") {

                } else {
                    ?>
                    <div class="socialShare">
                        <div class="fb-like" data-href="<?php echo get_permalink($data->postID); ?>" data-send="false"
                             data-layout="box_count" data-width="48" data-show-faces="false" data-font="arial"></div>
                    </div>
                    <div class="socialDivider"></div>
                <?php } ?>

                <?php
                if ($results->ty_tw_share == "off") {

                } else {
                    ?>
                    <div class="socialShare">
                        <a href="https://twitter.com/share" class="twitter-share-button"
                           data-url="<?php echo get_permalink($data->postID); ?>" data-lang="en"
                           data-related="anywhereTheJavascriptAPI" data-count="vertical">Tweet</a>
                    </div>
                    <div class="socialDivider"></div>
                <?php } ?>

                <?php
                if ($results->ty_ld_share == "off") {

                } else {
                    ?>
                    <div class="socialShare">
                        <script src="//platform.linkedin.com/in.js" type="text/javascript">
                            lang: en_US
                        </script>
                        <script type="IN/Share" data-url="<?php echo get_permalink($data->postID); ?>"
                                data-counter="top" data-onSuccess="shareLinkedIn"></script>
                    </div>
                    <div class="socialDivider"></div>
                <?php } ?>

                <?php
                if ($results->ty_gp_share == "off") {

                } else {
                    ?>
                    <div class="socialShare">
                        <div class="g-plus" data-onendinteraction="sharedGP" data-action="share"
                             data-href="<?php echo wi_fixPerma($data->postID)."live"; ?>"
                             data-annotation="vertical-bubble" data-height="60"></div>
                    </div>
                <?php } ?>
                <br clear="left"/>

            </div>

            <!-- SHARE REWARD - UNLOCK -->
            <div class="shareReward ssSalesArea">
                <div class="sharePRE">
                    <?php
                    display(
                        $results->ty_share_intro, '<h4>Share This Webinar & Unlock Free Report</h4>
							<p>Simply share the webinar on any of the social networks above, and you will get instant access to this report...</p>'
                    );
                    ?>
                </div>
                <div class="shareREVEAL " style="display: none;">
                    <?php
                    display(
                        $results->ty_share_reveal, '<h4>Congrats! Reward Unlocked</h4>
							<p>Here is the text that would be shown when they unlock a reward...</p>'
                    );
                    ?>
                </div>
            </div>

        </div>

    </div>


</div>

<div class="cpRightSide">
    <div class="ssRight2">

        <div class="ticketWrapper">

            <!-- TICKET HEADLINE -->
            <div class="ticketHeadline">
                <!-- <img src="images/ticket.png" align="left" /> -->
                <i class="icon-ticket icon-4x ticketIcon"></i>
                <span
                    class="optinHeadline1"><?php display($results->ty_ticket_headline, "Your Webinar Ticket"); ?></span>
                <span
                    class="optinHeadline2"><?php display($results->ty_ticket_subheadline, "The Webinar Event Information...") ?></span>
                <br clear="left"/>
            </div>

            <div class="ticketInfo">
                <div class="ticketSection">
                    <i class="icon-desktop"></i>
                    <?php if ($results->ty_ticket_webinar_option == "custom") {
                        ?>
                        <b><?php display($results->ty_ticket_webinar, "Webinar"); ?></b>
                        <?php display($results->ty_webinar_option_custom_title, "Webinar Event Title"); ?>
                    <?php
                    } else {
                        ?>
                        <b>Webinar:</b> <?php display($results->webinar_desc, "Webinar Event Title"); ?>
                    <?php } ?>
                </div>
                <div class="ticketSection">
                    <i class="icon-bullhorn"></i>
                    <?php if ($results->ty_ticket_host_option == "custom") {
                        ?>
                        <b><?php display($results->ty_ticket_host, "Host"); ?></b>
                        <?php display($results->ty_webinar_option_custom_host, "Your Name Here"); ?>
                    <?php
                    } else {
                        ?>
                        <b>Host:</b> <?php display($results->webinar_host, "Host name"); ?>
                    <?php } ?>
                </div>
                <div class="ticketSection" <?php echo $instantTest; ?> >
                    <i class="icon-calendar"></i>
                    <?php if ($results->ty_ticket_date_option == "custom") {
                        ?>
                        <b><?php display($results->ty_ticket_date, "Date"); ?></b>
                        <!-- AUTO CODE BLOCK AREA -->
                        <?php if ($results->webinar_date == "AUTO") { ?>
                            <!-- AUTO DATE -->
                            <?php echo $autoDate_format; ?>
                        <?php } else { ?>
                            <?php display($results->ty_webinar_option_custom_date, "Webinar Date Here"); ?>
                        <?php } ?>
                        <!-- END AUTO CODE BLOCK AREA -->
                    <?php
                    } else {
                        ?>
                        <b>Date:</b>
                        <!-- AUTO CODE BLOCK AREA -->
                        <?php if ($results->webinar_date == "AUTO") { ?>
                            <!-- AUTO DATE -->
                            <?php echo $autoDate_format; ?>
                        <?php } else { ?>
                            <?php display($results->lp_webinar_headline, "Webinar Date Here"); ?>
                        <?php } ?>
                        <!-- END AUTO CODE BLOCK AREA -->
                    <?php } ?>
                </div>
                <div class="ticketSection"  <?php echo $instantTest; ?> >
                    <i class="icon-time"></i>
                    <?php if ($results->ty_ticket_time_option == "custom") {
                        ?>
                        <b><?php display($results->ty_ticket_time, "Time"); ?></b>
                        <!-- AUTO CODE BLOCK AREA -->
                        <?php if ($results->webinar_date == "AUTO") { ?>
                            <!-- AUTO DATE -->
                            <?php echo $autoTime; ?>
                        <?php } else { ?>
                            <?php display($results->ty_webinar_option_custom_time, "Webinar Date Here"); ?>
                        <?php } ?>
                        <!-- END AUTO CODE BLOCK AREA -->
                    <?php
                    } else {
                        ?>
                        <b>Time:</b>
                        <!-- AUTO CODE BLOCK AREA -->
                        <?php if ($results->webinar_date == "AUTO") { ?>
                            <!-- AUTO DATE -->
                            <?php echo $autoTime; ?>
                        <?php } else { ?>
                            <?php display($results->lp_webinar_subheadline, "Webinar Date Here"); ?>
                        <?php } ?>
                        <!-- END AUTO CODE BLOCK AREA -->
                    <?php } ?>
                </div>

                <div class="ticketCDArea ticketSection" style="display: <?php
                if ($results->tycdarea == "" || $results->tycdarea == "show") {
                    echo "block";
                } else {
                    echo "none";
                }
                ?> ;">

                    <!-- AUTO CODE BLOCK AREA -->
                    <?php if ($results->webinar_date == "AUTO") { ?>
                        <a href="<?php echo wi_fixPerma($data->postID)."live&lid=" . $_GET['lid']; ?>"
                           class="ticketCDAreaBTN button alert radius disabled addedArrow" id="webinarBTNNN">
                            <?php display($results->tycd_countdown, "Webinar Starts Soon:"); ?>
                            <div id="defaultCountdown"></div>
                        </a>
                    <?php } else { ?>
                        <a href="<?php echo wi_fixPerma($data->postID)."live"; ?>"
                           class="ticketCDAreaBTN button alert radius disabled addedArrow" id="webinarBTNNN">
                            <?php display($results->tycd_countdown, "Webinar Starts Soon:"); ?>
                            <div id="defaultCountdown"></div>
                        </a>
                    <?php } ?>
                    <!-- END AUTO CODE BLOCK AREA -->

                </div>

            </div>

        </div>

        <!-- ADD TO CALENDARS -->
        <div class="addCalendar" <?php echo $instantTest; ?> >

            <div class="addCalendarHeadline">
                <i class="icon-calendar icon-4x ticketIcon"></i>
                <span
                    class="optinHeadline1"><?php display($results->ty_calendar_headline, "Add To Your Calendar"); ?></span>
                <span
                    class="optinHeadline2"><?php display($results->ty_calendar_subheadline, "Remind Yourself Of The Event"); ?></span>
                <br clear="left"/>
            </div>

            <!-- AUTO CODE BLOCK AREA -->
            <?php if ($results->webinar_date == "AUTO") { ?>
                <!-- AUTO DATE -->
                <a href="?googlecalendarA&id=<?php echo $getAutoID; ?>" class="small button" target="_blank">
                    <i class="icon-plus-sign"></i> <?php display($results->ty_calendar_google, "Google Calendar"); ?>
                </a>
                <a href="?icsA&id=<?php echo $getAutoID; ?>" class="small button" target="_blank">
                    <i class="icon-plus-sign"></i> <?php display($results->ty_calendar_ical, "iCal / Outlook"); ?>
                </a>
            <?php } else { ?>
                <a href="?googlecalendar" class="small button" target="_blank">
                    <i class="icon-plus-sign"></i> <?php display($results->ty_calendar_google, "Google Calendar"); ?>
                </a>
                <a href="?ics" class="small button" target="_blank">
                    <i class="icon-plus-sign"></i> <?php display($results->ty_calendar_ical, "iCal / Outlook"); ?>
                </a>
            <?php } ?>
            <!-- END OF AUTO CODE BLOCK -->

        </div>

        <!-- PHONE REMINDER -->
        <div class="phoneReminder" style="<?php
        if ($results->txt_area == "off") {
            echo "display:none";
        }
        ?>">

            <div id="phonePre">
                <div class="phoneReminderHeadline">
                    <i class="icon-mobile-phone icon-4x ticketIcon"></i>
                    <span class="optinHeadline1"><?php display($results->txt_headline, "Get A SMS Reminder"); ?></span>
                    <span
                        class="optinHeadline2"><?php display($results->txt_subheadline, "Text Message 1 Hour Before Event..."); ?></span>
                    <br clear="left"/>
                </div>
                <?php
                // Get Lead Info
                $cookieName = "we-trk-" . $client;
                $leadID = $_COOKIE["$cookieName"];
                // Get Lead Info - IE. Phone Number ::
                global $wpdb;
                $table_db_name = $wpdb->prefix . "webinarignition_leads_new";
                $leads = $wpdb->get_row("SELECT * FROM $table_db_name WHERE id = '$leadID' ", OBJECT);
                ?>
                <input type="text" class="wi_phone_number" id="optPhone" value="<?php echo $leads->phone; ?>"
                       placeholder="<?php display($results->txt_placeholder, "Enter Your Mobile Phone Number..."); ?>">
                <a href="#" id="storePhone"
                   class="button addedArrow"><?php display($results->txt_btn, "Get Text Message Reminder"); ?></a>
                <input type="hidden" value="<?php echo $leadID; ?>" id="leadID">
            </div>
            <div id="phoneReveal">
                <?php display($results->txt_reveal, "Thanks! You will get the reminder 1 hour before the webinar..."); ?>
            </div>
        </div>

    </div>
</div>

<br clear="both"/>

</div>

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

<!-- SOCIAL JS CODES -->
<div id="fb-root"></div>
<script>
    window.fbAsyncInit = function () {
        FB.init({appId: '178580152294594', status: true, cookie: true,
            xfbml: true});

        // FACEBOOK LIKE/SHARE
        FB.Event.subscribe('edge.create',
            function (response) {
                $(".sharePRE").hide();
                $(".shareREVEAL").show();
            }
        );

    };
    (function () {
        var e = document.createElement('script');
        e.async = true;
        e.src = document.location.protocol +
            '//connect.facebook.net/en_US/all.js';
        document.getElementById('fb-root').appendChild(e);
    }());</script>


<script type="text/javascript">
    (function () {
        var po = document.createElement('script');
        po.type = 'text/javascript';
        po.async = true;
        po.src = 'https://apis.google.com/js/plusone.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(po, s);
    })();
</script>

<!-- TWITTER -->
<script>
    //Twitter Widgets JS
    window.twttr = (function (d, s, id) {
        var t, js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://platform.twitter.com/widgets.js";
        fjs.parentNode.insertBefore(js, fjs);
        return window.twttr || (t = {_e: [], ready: function (f) {
            t._e.push(f)
        }});
    }(document, "script", "twitter-wjs"));

    //Once twttr is ready, bind a callback function to the tweet event
    twttr.ready(function (twttr) {
        twttr.events.bind('tweet', function (event) {
            $(".sharePRE").hide();
            $(".shareREVEAL").show();
        });
    });
</script>

<!-- JS AREA -->
<script src="<?php echo $assets; ?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>js/countdown.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>js/cookie.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>js-libs/js/intlTelInput.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>js/frontend.js"></script>

<script type="text/javascript">
    jQuery.expr[':'].parents = function (a, i, m) {
        return jQuery(a).parents(m[3]).length < 1;
    };

    $(document).ready(function () {

        // AJAX FOR WP
        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';

        // TRACK +1 VIEW
        $getTrackingCookie = $.cookie('we-trk-ty-<?php echo $client; ?>');

        if ($getTrackingCookie != "tracked") {
            // No Cookie Set - Track View
            $.cookie('we-trk-ty-<?php echo $client; ?>', "tracked", {expires: 30});
            var data = {action: 'webinarignition_track_view', id: "<?php echo $client; ?>", page: "ty"};
            $.post(ajaxurl, data, function (results) {
            });
        } else {
            // Already tracked...
        }
        // Track +1 Total
        var data = {action: 'webinarignition_track_view_total', id: "<?php echo $client; ?>", page: "ty"};
        $.post(ajaxurl, data, function (results) {
        });

        // SHARE UNLOCKS

        // LinkedIN Share ::
        function shareLinkedIn(success) {
            $(".sharePRE").hide();
            $(".shareREVEAL").show();
        }

        // GooglePlus Share ::
        function sharedGP(jsonParam) {
            $(".sharePRE").hide();
            $(".shareREVEAL").show();
        }

        var austDay = new Date();

        <?php if ( $results->webinar_date == "AUTO" ) { ?>
        <?php
        // Get Date
        $expire = $autoDate;

        // Check Format ie - OR /
        if ( strpos($expire, '-') ) {
                    $exDate = explode("-", $expire);
        } else {
                    $exDate = explode("/", $expire);
        }

        // $exDate = explode("-", $expire);
        $exYear = $exDate[0];
        $exMonth = $exDate[1];
        $exDay = $exDate[2];
        // Get Time
        $time = $autoTime_format;
        $exTime = explode(":", $time);
        $exHr = $exTime[0];
        $exMin = str_replace([' AM', ' PM'],"", $exTime[1]);
        $exSec = false; //$exTime[2];
        ?>
        austDay = $.countdown.UTCDate(<?php echo $autoTZ; ?>, <?php echo $exYear ? $exYear : '0'; ?>, <?php echo $exMonth ? $exMonth : '0'; ?> -1, <?php echo $exDay ? $exDay : '0'; ?>, <?php echo $exHr ? $exHr : '0'; ?>, <?php echo $exMin ? $exMin : '0'; ?>, <?php echo $exSec ? $exSec : '0'; ?>);
        <?php } else { ?>
        <?php
        // Get Date
        $expire = $results->webinar_date;

        // Check Format ie - OR /
        if ( strpos($expire, '-') ) {
                    $exDate = explode("-", $expire);
        } else {
                    $exDate = explode("/", $expire);
        }

            // $exDate = explode("-", $expire);
            $exYear = $exDate[2];
            $exMonth = $exDate[0];
            $exDay = $exDate[1];
            // Get Time
            $time = $results->webinar_start_time;
            $exTime = explode(":", $time);
            $exHr = $exTime[0];
            $exMin = str_replace([' AM', ' PM'],"", $exTime[1]);
            $exSec = false; //$exTime[2];
           ?>
        austDay = $.countdown.UTCDate(<?php echo $autoTZ; ?>, <?php echo $exYear ? $exYear : '0'; ?>, <?php echo $exMonth ? $exMonth : '0'; ?> -1, <?php echo $exDay ? $exDay : '0'; ?>, <?php echo $exHr ? $exHr : '0'; ?>, <?php echo $exMin ? $exMin : '0'; ?>, <?php echo $exSec ? $exSec : '0'; ?>);
        <?php } ?>


        $('#defaultCountdown').countdown({
            until: austDay,
            onExpiry: expired_cd,
            compact: true,
            alwaysExpire: true,
            compactLabels: ['<?php display($results->tycd_years, "y"); ?>', '<?php display($results->tycd_months, "m"); ?>', '<?php display($results->tycd_weeks, "w"); ?>', '<?php display($results->tycd_days, "d"); ?>'], // The compact texts for the counters
        });

        function expired_cd() {
            $(".ticketCDAreaBTN").text('<?php display($results->tycd_progress, "Webinar Is In Progress"); ?>');
            $("#defaultCountdown").hide();
            $("#webinarBTNNN").removeClass("disabled");
            $("#webinarBTNNN").removeClass("alert");
            $("#webinarBTNNN").addClass("success");
        }

        // VIDEO FIXES:
        $(".ctaArea").find("iframe, embed, object").height(281).width(500);
        // Mobile Move Ticket Block
        if ($(window).width() < 480) {
            $(".ctaArea").find("iframe, embed, object").height(215).width(287);
        }

        // Save Phone && Reveal Text
        $('#storePhone').click(function () {

            // Lead ID
            $ID = $("#leadID").val();
            // Phone NUmber
            $PHONE = $("#optPhone").val();

            // Post & Save & Reveal
            var data = {action: 'webinarignition_store_phone', id: "" + $ID + "", phone: "" + $PHONE + ""};
            $.post(ajaxurl, data, function (results) {
                $("#phonePre").hide();
                $("#phoneReveal").show();
            });

            return false;
        });

    });
</script>

<?php if ($results->webinar_date == "AUTO") { ?>
    <iframe src="<?php echo wi_fixPerma($data->postID)."arsubmit&id=" . $getAutoID; ?>" id="AR" width="300"
            height="300" style="display: none;"></iframe>
<?php } ?>

</body>
</html>
