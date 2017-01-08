<?php
// Get DB Info
global $wpdb;
$table_db_name = $wpdb->prefix . $pluginName;
$ID            = $client;
$data          = $wpdb->get_results( "SELECT * FROM $table_db_name WHERE id = '$ID'", OBJECT );
foreach ($data as $data) {

}

$full_path = get_site_url();
$assets    = WEBINARIGNITION_URL . "inc/lp/";

// Get Results
$id      = $client;
$results = get_option( 'webinarignition_campaign_' . $id );
?>

<!DOCTYPE html>
<html>
<head>

    <!-- META INFO -->
    <title><?php display( $results->webinar_title, "Amazing Webinar Training 101" ); ?></title>
    <meta name="description"
          content="<?php display( $results->webinar_desc,
              "Join this amazing webinar May the 4th, and discover industry trade secrets!" ); ?>">
    <!-- SOCIAL INFO -->
    <meta property="og:title" content="<?php display( $results->webinar_title, "Amazing Webinar Training 101" ); ?>"/>
    <meta property="og:image" content="<?php display( $results->ty_share_image, "" ); ?>"/>

    <link href="<?php echo $assets; ?>css/normalize.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $assets; ?>css/foundation.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $assets; ?>css/main.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $assets; ?>css/webinar.css" rel="stylesheet" type="text/css"/>

    <link href="<?php echo $assets; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $assets; ?>css/font-awesome-ie7.min.css" rel="stylesheet" type="text/css"/>

    <link href="<?php echo $assets; ?>css/countdown-replay.css" rel="stylesheet" type="text/css"/>

    <script src="<?php echo $assets; ?>js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo $assets; ?>js/countdown.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            <?php
            // Get Date
            $expire = $results->replay_cd_date;
            $exDate = explode("-", $expire);
            $exYear = $exDate[2];
            $exMonth = $exDate[0];
            $exDay = $exDate[1];
            ?>

            austDay = $.countdown.UTCDate(-5, 0, 0, 0);
            $('#cdExpire').countdown({until: austDay, alwaysExpire: true, onExpiry: closeWebinar});

            // AJAX FOR WP
            var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';

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

            // CLOSE WEBINAR ON LOAD

            closeWebinar();

        });

        // Close WEBINAR
        function closeWebinar() {
            // hide webinar
            $(".webinarBlock").hide();
            $(".webinarExtraBlock").hide();
            $(".webinarBlockRight").hide();

            // show closed area
            $("#closed").show();
        }

        // TIMED ACTION --- ORDER

        <?php
        if ( $results->replay_order_time == "" ) {
                    // NO TIME SET - SHOW BUTTON
                    ?>
        $("#orderBTN").show();
        <?php
} else {
        // TIME IS SET ::
        ?>

        setTimeout('timedAction()', <?php echo $results->replay_order_time; ?>);

        function timedAction() {
            $("#orderBTN").show();
        }

        <?php
}
?>

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

<!-- REPLAY Top -->
<div class="webinarExtireTop" style="display:none;">
    <div
        class="webinarReplayExpireCopy"><?php display( $results->replay_cd_headline,
            "This Replay Is Going Down Very Soon!" ); ?></div>
    <div class="webinarReplayExpireCD" id="cdExpire"></div>
    <br clear="left">
</div>

<!-- WEBINAR WRAPPER -->
<div class="webinarWrapper">

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
                    <div class="webinarShareCopy"
                         style="color: <?php display( $results->webinar_invite_color, "#222" ); ?>;">
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

            <div class="ctaArea">
                <?php
                display(
                    $results->replay_video,
                    '<iframe src="//player.vimeo.com/video/65600860?title=0&amp;byline=0&amp;portrait=0&amp;color=f04e23" width="920" height="518" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>'
                );
                ?>
            </div>

            <a href="<?php display( $results->replay_order_url, "#" ); ?>" id="orderBTN"
               class="large radius button success addedArrow replayOrder"
               style="background-color: <?php display( $results->replay_order_color,
                   "#6BBA40" ); ?>; border: 1px solid rgba(0,0,0,0.20); display:none;"><?php display( $results->replay_order_copy,
                    "Order Your Copy Now!" ); ?></a>

        </div>

        <!-- WEBINAR UNDER EXTRA CTA AREA -->
        <div class="webinarExtraBlock" style="margin-top: 30px;">


            <div id="askQArea">
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
            } else {
            ?>

            <textarea id="question"
                      placeholder="<?php display( $results->webinar_qa_desc_placeholder,
                          "Ask Your Question Here..." ); ?>"
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

<!-- WEBINAR BLOCK RIGHT -->
<div class="webinarBlockRight">

    <!-- WEBINAR INFO BLOCK -->
    <div class="webinarInfo">
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
            <div class="webinarTitleBar webinarTitleBarAdded"><i class="icon-ticket"></i>
                <?php display( $results->webinar_info_block_eventtitle, "Webinar Topic:" ); ?></div>
            <div class="webinarInfoCopy">
                <?php
                display(
                    $results->webinar_title, 'Awesome Webinar Training 101 '
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
    <div class="webinarQA">
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

<br clear="left"/>

</div>

</div>

<!-- BOTTOM AREA -->
<div class="bottomArea">
    <div><?php display( $results->footer_copy, "All Rights Reserved - Copyright @ " . date( 'Y' ) ); ?></div>
    <?php if ($results->footer_branding == "show" || $results->footer_branding == "") { ?>
        <div style="margin-top: 15px;"><a
                href="<?php display( $results->footer_branding_url, "//webinarignition.com/" ); ?>"
                target="_blank"><b><?php display( $results->footer_branding_copy, "Powered By webinarignition" ); ?></b></a>
        </div>
    <?php } ?>
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


<!--Extra code-->
<?php
echo $results->footer_code;
?>

</body>
</html>