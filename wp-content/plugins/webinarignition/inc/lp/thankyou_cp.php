<?php
// Get DB Info
global $wpdb;
$table_db_name = $wpdb->prefix . "webinarignition";
$ID = $client;
$data = $wpdb->get_row("SELECT * FROM $table_db_name WHERE id = $ID", OBJECT);

$full_path = get_site_url();
$assets = WEBINARIGNITION_URL . "inc/lp/";

// Get Results
$id = $client;
$results = get_option('webinarignition_campaign_' . $id);
?>
<?php
 
    $getAutoID = $_COOKIE['we-trk-' . $client];
 
if ($results->webinar_date == "AUTO") {

    $date_format = get_option("date_format");
    // Auto Webinar Information...
    // Get ID

    // Get Data
    $table_db_name = $wpdb->prefix . "webinarignition_leads_evergreen";
    $autoData = $wpdb->get_row("SELECT * FROM $table_db_name WHERE id = $getAutoID", OBJECT);

    // Get Date
    $autoDate_info = explode(" ", $autoData->date_picked_and_live);
    $autoDate = $autoDate_info[0];
    $autoDate_format = date($date_format, strtotime($autoDate_info[0]));
    // Final Step = Translate Months
    $months = $results->auto_translate_months;
    $days = $results->auto_translate_days;

    $autoDate_format = wi_translate_dm($months, $autoDate_format);
    $autoDate_format = wi_translate_dm($days, $autoDate_format, 'days');

    $autoTime_format = $autoDate_info[1];
    $autoTime = wi_get_time_tz($autoTime_format, $autoData->lead_timezone, $results->time_format, $results->time_suffix);

    $autoTZ_org = $autoData->lead_timezone;
    if (empty($autoTZ_org)) {
        $autoTZ_org = 'Pacific/Samoa';
    }

    $dtz = new DateTimeZone($autoTZ_org);
    $time_in_sofia = new DateTime('now', $dtz);
    $autoTZ = $dtz->getOffset($time_in_sofia) / 3600;
    $autoTZ = ($autoTZ < 0 ? $autoTZ : "+" . $autoTZ);

    // instant test
    $instantTest = "";
    if ($autoData->trk8 == "yes") {
        $instantTest = "style='display:none;'";
    }
/*
    // For Month Icon
    $liveEventMonth = "";
    $liveEventDateDigit = "";

    $splitAutoDate = explode(",", $autoDate_format);
    $splitAutoDate2 = explode(".", $splitAutoDate[1]);

    $liveEventMonth = $splitAutoDate2[0];
    $liveEventDateDigit = $splitAutoDate2[1];
*/
    $liveEventMonth = date("M", strtotime($autoDate));
    $liveEventDateDigit = date("d", strtotime($autoDate));

} else {

    // Get Date
    $liveWebbyDate = explode("-", $results->webinar_date);

    $autoDate = $liveWebbyDate[2] . "-" . $liveWebbyDate[0] . "-" . $liveWebbyDate[1];

    $date_format = get_option("date_format");
    $autoDate_format = date($date_format, strtotime($autoDate));
    // Final Step = Translate Months
    $months = $results->auto_translate_months;
    $days = $results->auto_translate_days;

    $autoDate_format = wi_translate_dm($months, $autoDate_format);
    $autoDate_format = wi_translate_dm($days, $autoDate_format, 'days');

    $autoTime_format = $results->webinar_start_time;
    $autoTime = wi_get_time_tz($autoTime_format, $results->webinar_timezone, $results->time_format, $results->time_suffix);

    // instant test
    $instantTest = "";
/*
    // For Month Icon
    $liveEventMonth = "";
    $liveEventDateDigit = "";

    $splitAutoDate = explode(",", $autoDate_format);
    $splitAutoDate2 = explode(".", $splitAutoDate[1]);

    $liveEventMonth = $splitAutoDate2[0];
    $liveEventDateDigit = $splitAutoDate2[1];
*/
    $liveEventMonth = date("M", strtotime($autoDate));
    $liveEventDateDigit = date("d", strtotime($autoDate));

    $dtz = new DateTimeZone($results->webinar_timezone);
    $time_in_sofia = new DateTime('now', $dtz);
    $autoTZ = $dtz->getOffset($time_in_sofia) / 3600;
    $autoTZ = ($autoTZ < 0 ? $autoTZ : "+" . $autoTZ);

}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

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

    <!-- Bootstrap -->
    <link href="<?php echo $assets; ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $assets; ?>css/foundation.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $assets; ?>js-libs/css/intlTelInput.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $assets; ?>css/main.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $assets; ?>css/cp.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $assets; ?>css/cpres_ty.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $assets; ?>css/countdown-ty.css" rel="stylesheet" type="text/css"/>

    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.2/moment.min.js"></script>
    <link href="<?php echo $assets; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $assets; ?>css/font-awesome-ie7.min.css" rel="stylesheet" type="text/css"/>

    

    <?php include("css/ty_css.php"); ?>

    <!-- CUSTOM JS -->
    <script type="text/javascript">
        <?php display($results->custom_ty_js, ""); ?>
    </script>
    <!-- CUSTOM CSS -->
    <style type="text/css">
        <?php display($results->custom_ty_css, ""); ?>
    </style>

    <?php if ($results->wp_head_footer === 'enabled') {
        wp_head();
    } ?>

</head>
<body>

<!-- TOP AREA -->
<div class="topArea">
    <div class="bannerTop container">
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
    <!-- HEADLINE AREAA -->
    <div class="headlineArea">
        <div class="container">
            <div class="tyHeadlineIcon">
                <i class="icon-check-sign icon-4x" style="color: #6a9f37;"></i>
            </div>

            <div class="tyHeadlineCopy">
                <div
                    class="optinHeadline1"><?php display(
                        $results->ty_ticket_headline,
                        "Congrats - You Are All Signed Up!"
                    ); ?></div>
                <div
                    class="optinHeadline2"><?php display(
                        $results->ty_ticket_subheadline,
                        "Below is all the information you need for the webinar..."
                    ) ?></div>
            </div>

            <br clear="left"/>

            <?php
            // display(
            //  $results->ty_headline,
            //  "<h2 style='margin-top: -10px;' >Congrats! You're All Signed Up For The Webinar</h2>"
            // );
            ?>
        </div> 
         <!-- /.headlineArea .container-->   
    </div>
    <!-- /.headlineArea -->

    <!-- MAIN AREA -->
    <div class="cpWrapperWrapper">
    <div class="container">
    <div class="row">
        <div class="cpWrapper">
            <div class="cpLeftSide col-md-6">
                <div class="ticketWrapper">
                    <div class="eventDate" <?php echo $instantTest; ?> >

                        <?php
                        // Date Block
                        $liveEventDate = "";
                        $liveEventTime = "";
                        // DATES
                        if ($results->ty_ticket_date_option == "custom") {
                            ?>
                            <!-- AUTO CODE BLOCK AREA -->
                            <?php if ($results->webinar_date == "AUTO") { ?>
                                <!-- AUTO DATE -->
                                <?php $liveEventDate = $autoDate_format; ?>
                            <?php } else { ?>
                                <?php $liveEventDate = $autoDate_format; ?>
                            <?php } ?>
                            <!-- END AUTO CODE BLOCK AREA -->
                        <?php
                        } else {
                            ?>
                            <!-- AUTO CODE BLOCK AREA -->
                            <?php if ($results->webinar_date == "AUTO") { ?>
                                <!-- AUTO DATE -->
                                <?php $liveEventDate = $autoDate_format; ?>
                            <?php } else { ?>
                                <?php $liveEventDate = $autoDate_format; ?>
                            <?php } ?>
                            <!-- END AUTO CODE BLOCK AREA -->
                        <?php }
                        // GET TIME
                        $liveEventTime = $autoTime; ?>
                        <div class="dateIcon">
                            <div class="dateMonth">
                                <?php
                                if ($results->lp_webinar_month) {
                                    echo $results->lp_webinar_month;
                                } else {
                                    echo $liveEventMonth;
                                }
                                ?>
                            </div>
                            <div class="dateDay">
                                <?php
                                if ($results->lp_webinar_day) {
                                    echo $results->lp_webinar_day;
                                } else {
                                    echo $liveEventDateDigit;
                                }
                                ?>
                            </div>
                        </div>

                        <div class="dateInfo">
                            <div
                                class="dateHeadline"><?php echo $results->lp_webinar_headline ? $results->lp_webinar_headline : $autoDate_format; ?></div>
                            <div class="dateSubHeadline">
                                <?php
                                if ($results->lp_webinar_subheadline) {
                                    echo $results->lp_webinar_subheadline;
                                } else {
                                    echo 'At ' . $autoTime;
                                }
                                ?>
                            </div>
                        </div>

                        <br clear="left">
                    </div>

                    <div class="ticketInfo">

                        <div class="ticketInfoNew">

                            <div class="ticketSection ticketSectionNew">
                                <!-- <i class="icon-desktop"></i> -->
                                <?php if ($results->ty_ticket_webinar_option == "custom") {
                                    ?>
                                    <div class="ticketInfoIcon">
                                        <i class="icon-desktop icon-3x"></i>
                                    </div>
                                    <div class="ticketInfoCopy">
                                        <b><?php display($results->ty_ticket_webinar, "Webinar"); ?></b>

                                        <div
                                            class="ticketInfoNewHeadline"><?php display(
                                                $results->ty_webinar_option_custom_title,
                                                "Webinar Event Title"
                                            ); ?></div>
                                    </div>
                                    <br clear="left"/>
                                <?php
                                } else {
                                    ?>
                                    <div class="ticketInfoIcon">
                                        <i class="icon-desktop icon-3x"></i>
                                    </div>
                                    <div class="ticketInfoCopy">
                                        <b>Webinar:</b>

                                        <div
                                            class="ticketInfoNewHeadline"><?php display(
                                                $results->webinar_desc,
                                                "Webinar Event Title"
                                            ); ?></div>
                                    </div>
                                    <br clear="left"/>
                                <?php } ?>
                            </div>

                            <div class="ticketSection ticketSectionNew">
                                <!-- <i class="icon-bullhorn"></i>  -->
                                <?php if ($results->ty_ticket_host_option == "custom") {
                                    ?>
                                    <div class="ticketInfoIcon2">
                                        <i class="icon-microphone icon-3x"></i>
                                    </div>
                                    <div class="ticketInfoCopy2">
                                        <b><?php display($results->ty_ticket_host, "Host"); ?></b>

                                        <div
                                            class="ticketInfoNewHeadline"><?php display(
                                                $results->ty_webinar_option_custom_host,
                                                "Your Name Here"
                                            ); ?></div>
                                    </div>
                                    <br clear="left"/>
                                <?php
                                } else {
                                    ?>
                                    <div class="ticketInfoIcon2">
                                        <i class="icon-microphone icon-3x"></i>
                                    </div>
                                    <div class="ticketInfoCopy2">
                                        <b>Host:</b>

                                        <div
                                            class="ticketInfoNewHeadline"><?php display($results->webinar_host, "Host name"); ?></div>
                                    </div>
                                    <br clear="left"/>
                                <?php } ?>
                            </div>

                            <div class="ticketCDArea ticketSection ticketSectionNew">

                                <!-- AUTO CODE BLOCK AREA -->
                                <?php if ($results->webinar_date == "AUTO") { ?>
                                    <a href="<?php echo wi_fixPerma($data->postID) . "live&lid=" . $_GET['lid'] . ($results->paid_status === 'paid' ? ("&" . md5($results->paid_code)) : ''); ?>"
                                       class="ticketCDAreaBTN button alert radius disabled addedArrow"
                                       id="webinarBTNNN">
                                        <?php display($results->tycd_countdown, "Webinar Starts Soon:"); ?>
                                        <div id="defaultCountdown"></div>
                                    </a>
                                <?php } else { ?>
                                    <a href="<?php echo wi_fixPerma($data->postID) . "live" . ($results->paid_status === 'paid' ? ("&" . md5($results->paid_code)) : ''); ?>"
                                       class="ticketCDAreaBTN button alert radius disabled addedArrow"
                                       id="webinarBTNNN">
                                        <?php display($results->tycd_countdown, "Webinar Starts Soon:"); ?>
                                        <div id="defaultCountdown"></div>
                                    </a>
                                <?php } ?>
                                <!-- END AUTO CODE BLOCK AREA -->

                            </div>


                        </div>


                        <div class="webinarURLArea">

                            <div class="webinarURLHeadline">
                                <i class="icon-bookmark" style="margin-right: 10px; color: #878787;"></i>
                                <?php
                                display(
                                    $results->ty_webinar_headline,
                                    'Here Is Your Webinar Event URL...'
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
                                    echo wi_fixPerma($data->postID) . "live&lid=" . $getAutoID . "&event=OI3shBXlqsw&live=1" . ($results->paid_status === 'paid' ? ("&" . md5($results->paid_code)) : '');
                                }
                                ?>">
                            <?php } else { ?>
                                <input type="text" id="webbyURL" value="<?php
                                if ($results->ty_webinar_url == "custom") {
                                    echo $results->ty_werbinar_custom_url;
                                } else {
                                    echo wi_fixPerma($data->postID) . "live" . ($results->paid_status === 'paid' ? ("&" . md5($results->paid_code)) : '')."&lid=" . $getAutoID;
                                }
                                ?>">
                            <?php } ?>
                            <!-- END AUTO CODE BLOCK AREA -->

                            <div class="webinarURLHeadline2">
                                <?php
                                display(
                                    $results->ty_webinar_subheadline,
                                    'Save and bookmark this URL so you can get access to the live webinar and webinar replay...'
                                );
                                ?>
                            </div>
                        </div>

                    </div>

                </div>


            </div>

            <div class="cpRightSide col-md-6">
                <!-- VIDEO / CTA BLOCK AREA HERE -->
                <div class="ctaArea" <?php
                if ($results->ty_cta_type == "html") {
                    echo 'style="background-color:#FFF;"';
                }
                ?> >
                    <?php
                    if ($results->ty_cta_type == "video") {
                        display(
                            do_shortcode($results->ty_cta_video_code),
                            '<img src="' . $assets . 'images/novideo.png" />'
                        );
                    } else if ($results->ty_cta_type == "html" || $results->ty_cta_type == "") {
                        display(
                            $results->ty_cta_html,
                            '<h3>Looking Forward To Seeing You<br/> On The Webinar!</h3><p>An email is being sent to you with all the information on the left. If you want more reminders for the event. Below you can add the event dates to your calendar...</p>'
                        );
                    } else if ($results->ty_cta_type == "image") {
                        echo "<img src='";
                        display($results->ty_cta_image, $assets . 'images/noctaimage.png');
                        echo "' height='215' width='287' />";
                    }
                    ?>
                </div>

                <div class="remindersBlock" <?php echo $instantTest; ?> >

                    <div class="ticketSection ticketCalendarArea">
                        <div class="optinHeadline12"><?php display(
                                $results->ty_calendar_headline,
                                "Add To Your Calendar"
                            ); ?></div>

                        <!-- AUTO CODE BLOCK AREA -->
                        <?php if ($results->webinar_date == "AUTO") { ?>
                            <!-- AUTO DATE -->
                            <a href="?googlecalendarA&id=<?php echo $getAutoID; ?>" class="small button"
                               target="_blank">
                                <i class="icon-google-plus"></i> <?php display(
                                    $results->ty_calendar_google,
                                    "Google Calendar"
                                ); ?>
                            </a>
                            <a href="?icsA&id=<?php echo $getAutoID; ?>" class="small button" target="_blank">
                                <i class="icon-calendar"></i> <?php display($results->ty_calendar_ical, "iCal / Outlook"); ?>
                            </a>
                        <?php } else { ?>
                            <a href="?googlecalendar" class="small button" target="_blank">
                                <i class="icon-google-plus"></i> <?php display(
                                    $results->ty_calendar_google,
                                    " Google Calendar"
                                ); ?>
                            </a>
                            <a href="?ics" class="small button" target="_blank">
                                <i class="icon-calendar"></i> <?php display($results->ty_calendar_ical, "iCal / Outlook"); ?>
                            </a>
                        <?php } ?>
                        <!-- END OF AUTO CODE BLOCK -->

                    </div>

                    <!-- PHONE REMINDER -->

                    <?php
                    // Get Lead Info - IE. Phone Number ::
                    global $wpdb;
                    if ($results->webinar_date == "AUTO") {
                        // Get Lead Info
                        $leadID = $_GET["lid"];
                        $table_db_name = $wpdb->prefix . "webinarignition_leads_evergreen";
                    } else {
                        // Get Lead Info
                        $cookieName = "we-trk-" . $client;
                        $leadID = $_COOKIE["$cookieName"];
                        $table_db_name = $wpdb->prefix . "webinarignition_leads_new";
                    }

                    $leads = $wpdb->get_row("SELECT * FROM $table_db_name WHERE id = '$leadID' ", OBJECT);
                    ?>

                    <div class="phoneReminder ticketSection" style="<?php
                    if ($results->txt_area != "on") {
                        echo "display:none";
                    }
                    ?>">

                        <div id="phonePre">
                            <div class="phoneReminderHeadline">
                                <!-- <i class="icon-mobile-phone icon-4x ticketIcon"></i> -->
                    <span class="optinHeadline1"><?php display(
                            $results->txt_headline,
                            "Get A SMS Reminder"
                        ); ?></span>
                                <!-- <span class="optinHeadline2" ><?php display(
                                    $results->txt_subheadline,
                                    "Text Message 1 Hour Before Event..."
                                ); ?></span> -->
                                <br clear="left"/>
                            </div>

                            <input type="text" class="wi_phone_number"  id="optPhone" value="<?php
                            if ($leads->phone == "undefined") {
                                echo "";
                            } else {
                                echo $leads->phone;
                            }
                            ?>"
                                   placeholder="<?php display($results->txt_placeholder, "Enter Your Mobile Phone Number..."); ?>">
                            <a href="#" id="storePhone"
                               class="button addedArrow"><?php display($results->txt_btn, "Get Text Message Reminder"); ?></a>
                            <input type="hidden" value="<?php echo $leadID; ?>" id="leadID">
                        </div>
                        <div id="phoneReveal">
                            <?php display(
                                $results->txt_reveal,
                                "Thanks! You will get the reminder 1 hour before the webinar..."
                            ); ?>
                        </div>
                    </div>

                </div>


            </div>

            <br clear="both"/>


            <div class="cpUnderHeadline" style="display:<?php display($results->ty_share_toggle, "none"); ?>;">
                <?php
                display(
                    $results->ty_step2_headline,
                    'Step #2: Share & Unlock Reward...'
                );
                ?>
            </div>

            <div class="cpUnderCopy" style="display:<?php display($results->ty_share_toggle, "none"); ?>;">

                <div class="cpCopyArea">
                    <!-- SHARE BLOCK -->
                    <div class="shareBlock wi-block--sharing"
                         style="display:<?php display($results->ty_share_toggle, "none"); ?>;">

                        <?php
                        if ($results->ty_fb_share == "off") {

                        } else {
                            ?>
                            <div class="socialShare">
                                <div class="fb-like" data-href="<?php echo get_permalink($data->postID); ?>"
                                     data-send="false"
                                     data-layout="box_count" data-width="48" data-show-faces="false"
                                     data-font="arial"></div>
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
                                        data-counter="top"
                                        data-onSuccess="shareLinkedIn" data-onErro="shareLinkedIn"></script>
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
                    <div class="shareReward" style="display:<?php display($results->ty_share_toggle, "none"); ?>;">
                        <div class="sharePRE">
                            <?php
                            display(
                                $results->ty_share_intro,
                                '<h4>Share This Webinar & Unlock Free Report</h4>
                            <p>Simply share the webinar on any of the social networks above, and you will get instant access to this report...</p>'
                            );
                            ?>
                        </div>
                        <div class="shareREVEAL" style="display: none;">
                            <?php
                            display(
                                $results->ty_share_reveal,
                                '<h4>Congrats! Reward Unlocked</h4>
                            <p>Here is the text that would be shown when they unlock a reward...</p>'
                            );
                            ?>
                        </div>
                    </div>
                </div>

                <div class="cpCopyTY">
                    <!-- ADD TO CALENDARS -->
                    <div class="addCalendar" style="display:none;">

                        <div class="addCalendarHeadline">
                            <i class="icon-calendar icon-4x ticketIcon"></i>
                <span
                    class="optinHeadline1"><?php display(
                        $results->ty_calendar_headline,
                        "Add To Your Calendar"
                    ); ?></span>
                <span
                    class="optinHeadline2"><?php display(
                        $results->ty_calendar_subheadline,
                        "Remind Yourself Of The Event"
                    ); ?></span>
                            <br clear="left"/>
                        </div>

                        <!-- AUTO CODE BLOCK AREA -->
                        <?php if ($results->webinar_date == "AUTO") { ?>
                            <!-- AUTO DATE -->
                            <a href="?googlecalendarA&id=<?php echo $getAutoID; ?>" class="small button"
                               target="_blank">
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


                </div>

                <br clear="all"/>

            </div>

        </div>
    </div> 
    <!--/.cpWrapperWrapper .row-->  
    </div>
    <!--/.cpWrapperWrapper .container-->
    </div>
    <!--/.cpWrapperWrapper -->

</div>

<!-- BOTTOM AREA -->
<div class="bottomArea">
    <div class="container">
        <div><?php display($results->footer_copy, "All Rights Reserved - Copyright @ " . date('Y')); ?></div>
        <?php if ($results->footer_branding == "show" || $results->footer_branding == "") { ?>
            <div style="margin-top: 15px;"><a
                    href="<?php display($results->footer_branding_url, "//webinarignition.com/"); ?>"
                    target="_blank"><b><?php display($results->footer_branding_copy, "Powered By WebinarIgnition"); ?></b></a>
            </div>
        <?php } ?>
    </div>
</div>

<!-- SOCIAL JS CODES -->
<div id="fb-root"></div>
<script>
    window.fbAsyncInit = function () {
        FB.init({
            appId: '178580152294594', status: true, cookie: true,
            xfbml: true
        });

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
        return window.twttr || (t = {
                _e: [], ready: function (f) {
                    t._e.push(f)
                }
            });
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
<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script> -->

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


        // VIDEO FIXES:
        var wi_video_fix_w, wi_video_fix_h;
        if ($(window).width() < 825) {
            wi_video_fix_w = 290;
            wi_video_fix_h = 218;
        }
        else if ($(window).width() < 480) {
            //mobile size
            wi_video_fix_w = 278;
            wi_video_fix_h = 209;
        } else {
            wi_video_fix_w = 410;
            wi_video_fix_h = 231;
        }
        $('.ctaArea').find("iframe, embed, object").height(wi_video_fix_h).width(wi_video_fix_w);

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
        $time = date('H:i', strtotime($time));
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
            compactLabels: ['<?php display($results->tycd_years, "y"); ?>', '<?php display($results->tycd_months, "m"); ?>', '<?php display($results->tycd_weeks, "w"); ?>', '<?php display($results->tycd_days, "d"); ?>'] // The compact texts for the counters
        });

        function expired_cd() {
            $(".ticketCDAreaBTN").text('<?php display($results->tycd_progress, "Webinar Is In Progress"); ?>');
            $("#defaultCountdown").hide();
            $("#webinarBTNNN").removeClass("disabled").removeClass("alert").addClass("success");
        }

        // Save Phone && Reveal Text
        $('#storePhone').click(function () {

            // Lead ID
            $ID = $("#leadID").val();
            // Phone NUmber
            $PHONE = $("#optPhone").val();

            // Post & Save & Reveal
            <?php if ( $results->webinar_date == "AUTO" ) { ?>
            var data = {
                action: 'webinarignition_store_phone_auto',
                id: "<?php echo $_GET['lid']; ?>",
                phone: "" + $PHONE + ""
            };
            <?php } else { ?>
            var data = {action: 'webinarignition_store_phone', id: "" + $ID + "", phone: "" + $PHONE + ""};
            <?php } ?>
            $.post(ajaxurl, data, function (results) {
                $("#phonePre").hide();
                $("#phoneReveal").show();
            });

            return false;
        });


    });
</script>

<script>
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
</script>
<?php if ($results->webinar_date == "AUTO") { ?>
    <iframe target="arsubmit" src="<?php echo get_permalink($data->postID) . "?arsubmit&id=" . $getAutoID; ?>" id="AR"
            width="300"
            height="300" style="display: none;"></iframe>
<?php } ?>

<?php if ($results->wp_head_footer === 'enabled') {
    wp_footer();
} ?>

<!--Extra code-->
<?php
echo $results->footer_code;
echo $results->footer_code_ty;
?>

</body>
</html>
