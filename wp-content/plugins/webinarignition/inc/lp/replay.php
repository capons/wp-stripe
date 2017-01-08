<?php
// Get DB Info
global $wpdb;
$table_db_name = $wpdb->prefix . "webinarignition";
$ID            = $client;
$data          = $wpdb->get_row( "SELECT * FROM $table_db_name WHERE id = '$ID'", OBJECT );

$full_path = get_site_url();
$assets    = WEBINARIGNITION_URL . "inc/lp/";

// Get Results
$id = $client;
$results = get_option( 'webinarignition_campaign_' . $id );
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
    if ($results->meta_site_title_replay == "") {
        display( $results->lp_metashare_title, "Amazing Webinar" );
    } else {
        echo $results->meta_site_title_replay;
    }
    ?></title>
<meta name="description" content="<?php
if ($results->meta_desc_replay == "") {
    display( $results->lp_metashare_desc, "Join this amazing webinar, and discover industry trade secrets!" );
} else {
    echo $results->meta_desc_replay;
}
?>">

<?php
if ($results->ty_share_image == "") {

} else {
    ?>
    <meta property="og:image" content="<?php display( $results->ty_share_image, "" ); ?>"/><?php } ?>


    <!-- Bootstrap -->
    <link href="<?php echo $assets; ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $assets; ?>css/foundation.css" rel="stylesheet" type="text/css"/>

    <link href="<?php echo $assets; ?>css/main.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $assets; ?>css/webinar.css" rel="stylesheet" type="text/css"/>

    <link href="<?php echo $assets; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $assets; ?>css/font-awesome-ie7.min.css" rel="stylesheet" type="text/css"/>

    <link href="<?php echo $assets; ?>css/countdown-replay.css" rel="stylesheet" type="text/css"/>

    <script src="<?php echo $assets; ?>js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo $assets; ?>js/countdown.js"></script>
    <script type="text/javascript" src="<?php echo $assets; ?>js/cookie.js"></script>

<?php if ($results->webinar_date == "AUTO") { ?>
	<link href="//vjs.zencdn.net/5.8.8/video-js.css" rel="stylesheet">
	<script src="//vjs.zencdn.net/5.8.8/video.js"></script>
<?php } ?>

<script type="text/javascript">
$(document).ready(function () {

    <?php
    if ( $results->webinar_date == "AUTO" ) {


                $autoTZ_org = $leadinfo->lead_timezone;
                if ( $autoTZ_org == "" ) {

                            // Get Amount Of Days
                            $addDays = 3;
                            if ( $results->auto_replay == "" ) {
                                        $addDays = 3;
                            } else {
                                        $addDays = $results->auto_replay;
                            }
                            $liveDate = explode(" ", $leadinfo->date_picked_and_live);
                            $expire = date('Y-m-d', strtotime('+' . $addDays . ' day', strtotime(2013)));

                            $dtz = new DateTimeZone("America/New_York");
                } else {
                            // Get Amount Of Days
                            $addDays = 3;
                            if ( $results->auto_replay == "" ) {
                                        $addDays = 3;
                            } else {
                                        $addDays = $results->auto_replay;
                            }
                            // Get Start Date (live date)
                            $liveDate = explode(" ", $leadinfo->date_picked_and_live);
                            $expire = date('Y-m-d', strtotime('+' . $addDays . ' day', strtotime($liveDate[0])));
                            $dtz = new DateTimeZone($autoTZ_org);
                }
                $time_in_sofia = new DateTime('now', $dtz);
                $autoTZ = $dtz->getOffset($time_in_sofia) / 3600;
                $autoTZ = ($autoTZ < 0 ? $autoTZ : "+" . $autoTZ);
    } else {

                // Get Date
                $expire = $results->replay_cd_date;
    }

    // Check Format ie - OR /
    if ( strpos($expire, '-') ) {
                $exDate = explode("-", $expire);
    } else {
                $exDate = explode("/", $expire);
    }

    // $exDate = explode("-", $expire);
    if ( $results->webinar_date == "AUTO" ) {
                $exYear = $exDate[0];
                $exMonth = $exDate[1];
                $exDay = $exDate[2];
                ?>
    austDay = $.countdown.UTCDate(<?php echo $autoTZ; ?>, <?php echo $exYear ? $exYear : '0'; ?>, <?php echo $exMonth ? $exMonth : '0'; ?> -1, <?php echo $exDay ? $exDay : '0'; ?>);
    <?php
} else {
    $exYear = $exDate[2];
    $exMonth = $exDate[0];
    $exDay = $exDate[1];
    // Get Time
    $expire_time = $results->replay_cd_time;
    if( $expire_time == "" ){
        $expire_time_hour = "00";
        $expire_time_minute = "00";
    } else {
        $expire_time = explode(":", $expire_time);
        $expire_time_hour = $expire_time[0];
        $expire_time_minute = $expire_time[1];
    }
    $tz = new DateTimeZone($results->webinar_timezone);
    ?>
    austDay = $.countdown.UTCDate(<?php echo $tz->getOffset(new DateTime()) / 3600; ?>, <?php echo $exYear ? $exYear : '0'; ?>, <?php echo $exMonth ? $exMonth : '0'; ?> -1, <?php echo $exDay ? $exDay : '0'; ?>, <?php echo $expire_time_hour; ?>, <?php echo $expire_time_minute; ?>, 00);
    <?php
}
?>

    // $('#cdExpire').countdown({until: austDay, alwaysExpire: true, onExpiry: closeWebinar});
    <?php
    if ( $results->replay_optional == "hide" ) {

    } else {
                ?>
    $('#cdExpire').countdown({
        until: austDay,
        onExpiry: closeWebinar,
        alwaysExpire: true,
        labels: ['Years', '<?php display($results->cd_months, "Months"); ?>', '<?php display($results->cd_weeks, "Weeks"); ?>', '<?php display($results->cd_days, "Days"); ?>', '<?php display($results->cd_hours, "Hours"); ?>', '<?php display($results->cd_minutes, "Minutes"); ?>', '<?php display($results->cd_seconds, "Seconds"); ?>'],
        labels1: ['Year', '<?php display($results->cd_months, "Months"); ?>', '<?php display($results->cd_weeks, "Weeks"); ?>', '<?php display($results->cd_days, "Days"); ?>', '<?php display($results->cd_hours, "Hours"); ?>', '<?php display($results->cd_minutes, "Minutes"); ?>', '<?php display($results->cd_seconds, "Seconds"); ?>']
    });
    <?php } ?>

    // AJAX FOR WP
    var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';

    // TRACK +1 VIEW

    $getTrackingCookie = "<?php echo $_COOKIE['we-trk-replay' . $client]; ?>";

    if ($getTrackingCookie != "tracked") {
        // No Cookie Set - Track View
        $.cookie('we-trk-replay-<?php echo $client; ?>', "tracked", {expires: 30});
        var data = {action: 'webinarignition_track_view', id: "<?php echo $client; ?>", page: "replay"};
        $.post(ajaxurl, data, function (results) {
        });
    } else {
        // Already tracked...
    }
    // Track +1 Total
    var data = {action: 'webinarignition_track_view_total', id: "<?php echo $client; ?>", page: "replay"};
    $.post(ajaxurl, data, function (results) {
    });

    // VIDEO FIXES:
    $(".ctaArea").find("iframe, embed, object").height(518).width(920);

    // ASK QUESTION
    $('#askQuestion').click(function () {

        function validateEmail(email) {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }

        if( !validateEmail( $Email ) ) {
            $('#optEmail').addClass("errorField");
            return false;
        }

        $question = $("#question").val();

        if ($question == "") {
            // No Question
            $("#question").addClass("errorField");
        } else {

            // Submit Question...
            $("#question").removeClass("errorField");

            // AJAX Question
            var data = {
                action: 'webinarignition_submit_question',
                id: "<?php echo $client; ?>",
                question: "" + $question + ""
            };
            $.post(ajaxurl, data, function (results) {

                $("#askQArea").hide();
                $("#askQThankyou").show();

                setTimeout(function () {
                    $("#askQArea").show();
                    $("#askQThankyou").hide();
                    $("#question").val("");
                }, 15000);

            });

        }

        return false;
    });

});

// Close WEBINAR
function closeWebinar() {
    // hide webinar
    $(".webinarBlock").hide();
    $(".webinarExtraBlock").hide();
    $(".webinarBlockRight").hide();

    // Replace any video area here..
    $(".ctaArea").html("closed");

    // show closed area
    $("#closed").show();
}

// TIMED ACTION --- ORDER

<?php
if ( $results->webinar_date == "AUTO" ) {
            // For Auto Webinar...
} else {
            // Only For Live Webinars
            if ( $results->replay_order_time == "" ) {
                        // NO TIME SET - SHOW BUTTON
                        ?>
$("#orderBTN").show();
<?php
} else {
// TIME IS SET ::
?>

setTimeout('timedAction()', <?php
                        if ( $results->replay_order_time == "" ) {
                                    echo "50";
                        } else {
                                    echo $results->replay_order_time . "000";
                        }
                        ?>);

function timedAction() {
    $("#orderBTN").show();
}

<?php
}
}
?>

// Track Event Attending
$checkCookie = $.cookie('we-trk-<?php echo $client; ?>');
// Post & Track
<?php if ( $results->webinar_date == "AUTO" ) { ?>
var data = {
    action: 'webinarignition_trk_replay_auto',
    id: "<?php echo $client; ?>",
    cookie: "<?php echo $_COOKIE['we-trk-' . $client]; ?>",
    ip: "<?php echo $_SERVER['REMOTE_ADDR']; ?>"
};
<?php } else { ?>
var data = {
    action: 'webinarignition_trk_replay',
    id: "<?php echo $client; ?>",
    cookie: "<?php echo $_COOKIE['we-trk-' . $client]; ?>",
    ip: "<?php echo $_SERVER['REMOTE_ADDR']; ?>"
};
<?php } ?>
var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
$.post(ajaxurl, data, function (results) {
});

</script>

<?php include( "css/webinar_css.php" ); ?>

<!-- CUSTOM JS -->
<script type="text/javascript">
    <?php display($results->custom_replay_js, ""); ?>
</script>
<!-- CUSTOM CSS -->
<style type="text/css">
    <?php display($results->custom_replay_css, ""); ?>
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

<!-- WEBINAR WRAPPER -->
<div class="webinarWrapper container">

<!-- CLOSED WEBINAR -->
<div id="closed" class="webinarExtraBlock2" style="display:none;">
    <?php display( $results->replay_closed, "<h1>Webinar Is Over</h1>" ); ?>
</div>

<!-- WEBINAR MAIN BLOCK LEFT -->
<div class="webinarBlock">

<!-- WEBINAR TOP AREA -->
<div class="webinarTopArea">

    <div class="webinarSound" style="color: <?php display( $results->webinar_speaker_color, "#222" ); ?>;">
        <i class="icon-volume-up"></i> <?php display( $results->webinar_speaker, "Turn Up Your Speakers" ); ?>
    </div>

    <div class="webinarShare">
        <?php
        if ($results->social_share_links !== 'disabled') {
            ?>
            <div class="webinarShareCopy" style="color: <?php display( $results->webinar_invite_color, "#222" ); ?>;">
                <i class="icon-user"></i> <?php display( $results->webinar_invite,
                    "Invite Your Friends To The Webinar:" ); ?>
            </div>
            <div class="webinarShareIcons wi-block--sharing">
                <?php
                if ($results->webinar_fb_share == "off") {

                } else {
                    ?>
                    <div class="fb-like" data-href="<?php echo $results->webinar_permalink; ?>"
                         style="margin-right: 15px;"
                         data-layout="button_count" data-width="450" data-show-faces="false"></div>
                <?php } ?>
                <?php
                if ($results->webinar_tw_share == "off") {

                } else {
                    ?>
                    <a href="https://twitter.com/share" data-url="<?php echo $results->webinar_permalink; ?>"
                       class="twitter-share-button">Tweet</a>
                <?php } ?>
                <?php
                if ($results->webinar_gp_share == "off") {

                } else {
                    ?>
                    <!-- Place this tag where you want the share button to render. -->
                    <div class="g-plus" data-action="share" data-annotation="bubble"
                         data-href="<?php echo $results->webinar_permalink; ?>"></div>

                    <!-- Place this tag after the last share tag. -->
                    <script type="text/javascript">
                        (function () {
                            var po = document.createElement('script');
                            po.type = 'text/javascript';
                            po.async = true;
                            po.src = 'https://apis.google.com/js/platform.js';
                            var s = document.getElementsByTagName('script')[0];
                            s.parentNode.insertBefore(po, s);
                        })();
                    </script>&nbsp;
                <?php } ?>
                <?php
                if ($results->webinar_ld_share == "off") {

                } else {
                    ?>
                    <script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: en_US</script>
                    <script type="IN/Share" data-url="<?php echo $results->webinar_permalink; ?>"
                            data-counter="right"></script>
                <?php } ?>
            </div>
        <?php } ?>
    </div>

    <br clear="all"/>

</div>

<!-- WEBINAR VIDEO -->
<div class="webinarVideo">

    <!-- REPLAY Top -->
    <?php
    if ($results->replay_optional == "hide") {

    } else {
        ?>
        <div class="webinarExtireTop">
            <div class="webinarReplayExpireCopy">
                <span><?php display( $results->replay_cd_headline, "This Replay Is Going Down Very Soon!" ); ?></span>
            </div>
            <div class="webinarReplayExpireCD" id="cdExpire"></div>
            <br clear="left">
        </div>
    <?php } ?>

    <div class="ctaArea">
        <?php if ($results->webinar_date == "AUTO") { ?>
            <?php if ($results->webinar_source_toggle !== 'iframe') { ?>
                <video id="autoReplay" class="video-js vjs-default-skin" autoplay preload="auto" width="920"
                       height="518">
                    <source src="<?php echo $results->auto_video_url; ?>" type="video/mp4"/>
                    <source src="<?php echo $results->auto_video_url2; ?>" type="video/webm"/>
                </video>
                <input type="hidden" id="autoVideoTime">
            <?php
            } else {
                echo do_shortcode( $results->webinar_iframe_source );
            }
        } else {
            ?>
            <?php
            display(
                do_shortcode( $results->replay_video ), '<img src="' . $assets . '/images/videoplaceholder.png" />'
            );
            ?>
        <?php } ?>

    </div>

    <?php if ($results->webinar_date == "AUTO") { ?>
        <div class="timedUnderArea" id="orderBTN" style="display: <?php
        if ($results->auto_action == "time") {
            echo "none";
        } else {
            echo "block";
        }
        ?>;">
            <div id="orderBTNCopy">
                <?php display( $results->auto_action_copy, "" ); ?>
            </div>
            <div id="orderBTNArea">
                <?php
                if ($results->auto_action_url == "off") {

                } else {
                    ?>
                    <a href="<?php display( $results->auto_action_url, "#" ); ?>" target="_blank"
                       class="large radius button success  replayOrder"
                       style="background-color: <?php display( $results->replay_order_color,
                           "#6BBA40" ); ?>; border: 1px solid rgba(0,0,0,0.20); width: 880px; margin-top:0px;"><?php display( $results->auto_action_btn_copy,
                            "Click Here To Grab Your Copy Now" ); ?></a>
                <?php } ?>
            </div>
        </div>

    <?php } else { ?>

        <?php
        if ($results->replay_timed_style == "" || $results->replay_timed_style == "button") {
            ?>
            <a href="<?php display( $results->replay_order_url, "#" ); ?>" target="_blank" id="orderBTN"
               class="large radius button success addedArrow replayOrder"
               style="background-color: <?php display( $results->replay_order_color,
                   "#6BBA40" ); ?>; border: 1px solid rgba(0,0,0,0.20); display:none;"><?php display( $results->replay_order_copy,
                    "Order Your Copy Now!" ); ?></a>
        <?php
        } else {
            ?>
            <div class="timedUnderArea" id="orderBTN" style="display: none;">
                <?php display( $results->replay_order_html, "Custom HTML Here..." ); ?>
            </div>
        <?php
        }
        ?>

    <?php } ?>


</div>

<!-- WEBINAR UNDER EXTRA CTA AREA -->
<div class="webinarUnderArea">

    <!-- WEBINAR BLOCK RIGHT -->
    <div class="webinarBlockRight" style="display:none;">

        <!-- WEBINAR INFO BLOCK -->
        <div class="webinarInfo" style="margin-top: 30px;">
            <div class="webinarTopBar">
                <i class="icon-exclamation-sign"></i>
                <?php display( $results->webinar_info_block_title, "Webinar Information" ); ?>
            </div>
            <div class="webinarInner" style="padding-top:0px;">
                <div class="webinarTitleBar"><i class="icon-microphone"></i>
                    <?php display( $results->webinar_info_block_host, "Your Host:" ); ?></div>
                <div class="webinarInfoCopy">
                    <?php
                    display(
                        $results->webinar_host, 'Your Name Here'
                    );
                    ?>
                </div>

                <div class="webinarTitleBar webinarTitleBarAdded"><i class="icon-info"></i>
                    <?php display( $results->webinar_info_block_desc, "What You Will Learn:" ); ?></div>
                <div class="webinarInfoCopy">
                    <?php
                    display(
                        $results->webinar_desc,
                        'In this webinar, you will learn everything you need to know about the webinar...'
                    );
                    ?>
                </div>
            </div>
        </div>

        <!-- GIVE AWAY BLOCK -->
        <div class="webinarQA" style="<?php
        if ($results->webinar_giveaway_toggle == "hide") {
            echo "display: none;";
        }
        ?>">
            <div class="webinarTopBar">
                <i class="icon-question-sign"></i> <?php display( $results->webinar_giveaway_title,
                    "Your Special Gift:" ); ?>
            </div>
            <div class="webinarInner">

                <?php display( $results->webinar_giveaway,
                    "<h4>Your Awesome Free Gift</h4><p>You can download this awesome report made you...</p><p>[ DOWNLOAD HERE ]</p>" );
                ?>
            </div>
        </div>

    </div>


    <div class="webinarExtraBlock" style="margin-top: 30px; display:none;">


        <div id="askQArea" style="display:none;">
            <?php
            display(
                $results->webinar_qa_title, '<h4 style="margin-top: -5px;" >Got A Question?</h4>
				 <h5 class="subheader" style="margin-top: -15px;" >Submit your question, and we can answer it live on air...</h5>'
            );
            ?>

            <?php
            if ($results->webinar_qa == "custom") {
            display( $results->webinar_qa_custom, "CUSTOM Q/A SYSTEM WILL DISPLAY HERE... NO CODE ENTERED..." );
            ?>
        </div>
        <?php
        } else if ($results->webinar_qa == "hide") {
            echo "</div>";
        } else {
        ?>

        <textarea id="question"
                  placeholder="<?php display( $results->webinar_qa_desc_placeholder, "Ask Your Question Here..." ); ?>"
                  style="height: 80px;"></textarea>
        <a href="#" id="askQuestion" class="button"
           style="border: 1px solid rgba(0,0,0,0.10); background-color: <?php display( $results->webinar_qa_button_color,
               "#3E8FC7" ); ?>;"><?php display( $results->webinar_qa_button, "Submit Your Question" ); ?></a>
    </div>

    <div id="askQThankyou" style="display:none;">
        <?php display( $results->webinar_qa_thankyou,
            "<h4>Thank You For Your Question!</h4><h5 class='subheader' style='margin-top: -15px;'>The question block will refresh in 15 seconds...</h5>" ); ?>
    </div>

    <?php } ?>

</div>

</div>

</div>

<br clear="left"/>

</div>

</div>

<!-- BOTTOM AREA -->
<div class="bottomArea">
    <div class="container">
        <div><?php display( $results->footer_copy, "All Rights Reserved - Copyright @ " . date( 'Y' ) ); ?></div>
        <?php if ($results->footer_branding == "show" || $results->footer_branding == "") { ?>
            <div style="margin-top: 15px;"><a
                    href="<?php display( $results->footer_branding_url, "//webinarignition.com/" ); ?>"
                    target="_blank"><b><?php display( $results->footer_branding_copy, "Powered By WebinarIgnition" ); ?></b></a>
            </div>
        <?php } ?>
    </div>
</div>


<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=203159309749638";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<script>!function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
        if (!d.getElementById(id)) {
            js = d.createElement(s);
            js.id = id;
            js.src = p + '://platform.twitter.com/widgets.js';
            fjs.parentNode.insertBefore(js, fjs);
        }
    }(document, 'script', 'twitter-wjs');</script>

<script type="text/javascript">
    <?php
    if ( $results->webinar_date == "AUTO" ) {
                // For Auto Webinar...
                ?>
    videojs("autoReplay").ready(function () {

        var myPlayer = this;
        myPlayer.play();
        myPlayer.on('timeupdate', function () {
            var num = myPlayer.currentTime();
            num = Math.ceil(num * 10) / 10;
            var minutes = Math.floor(num / 60);
            $("#autoVideoTime").val(minutes);
            // Trigger Timed Action
            var timedAction = <?php echo (!empty($results->auto_action_time) ? $results->auto_action_time : 0); ?>;
            if (minutes >= timedAction) {
                $("#orderBTN").show();
            }
        });

        myPlayer.on('ended', function () {
            <?php
            if ( $results->auto_redirect == "redirect" ) {
                        ?>
            window.location.href = "<?php echo $results->auto_redirect_url; ?>";
            <?php } ?>
        });

    });

    $('body').on('click', '#autoReplay', function () {
        videojs("autoReplay").play();
    });
    <?php } ?>
</script>


<?php if ($results->wp_head_footer === 'enabled') {
    wp_footer();
} ?>

<!--Extra code-->
<?php
echo $results->footer_code;
?>

</body>
</html>
