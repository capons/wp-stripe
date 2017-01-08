<!-- DASHBOARD AREA -->
<div id="dashboardTab" class="consoleTabs">

    <div class="statsDashbord">

        <div class="statsTitle statsTitle-Dassh">

            <div class="statsTitleIcon">
                <i class="icon-cogs icon-2x"></i>
            </div>

            <div class="statsTitleCopy">
                <?php if ($results->webinar_date == "AUTO") {
                    echo '<h2>Auto Webinar Console Dashboard</h2>';
                } else {
                    ?>
                    <h2>Live Console Dashboard</h2>
                <?php } ?>
                <p>Overview of your webinar campaign...</p>
            </div>

            <div class="statsTitleEvent">
                <span class="infoLabel">Webinar Name:</span>
                <span class="infoLabelInner"><?php echo stripcslashes($data->appname); ?></span>
            </div>

            <br clear="all"/>

        </div>

    </div>

    <div class="innerOuterContainer">

        <div class="innerContainer">

            <div class="airSwitch" style="padding-top: 10px; display:none;">

                <div class="airSwitchLeft">
                    <span class="airSwitchTitle">Live Webinar Switch</span>
                    <span class="airSwitchInfo"> <a href="<?php echo get_permalink($data->postID); ?>?live"
                                                    target="_blank" class="small button"> <i
                                class="icon-external-link"></i> Live Event URL</a>  </span>
                </div>

                <div class="airSwitchRight" style="text-align: right;">
                    <select style="margin-top: 5px; margin-bottom: 0px;" id="masterSwitch">
                        <option
                            value="countdown" <?php if (isset($results->webinar_switch) && ($results->webinar_switch == 'countdown' || $results->webinar_switch == '')) {
                            echo 'selected';
                        } ?> >Show Countdown Page
                        </option>
                        <option value="live" <?php if (isset($results->webinar_switch) && $results->webinar_switch == 'live') {
                            echo 'selected';
                        } ?> >Show Live Webinar
                        </option>
                        <option value="replay" <?php if (isset($results->webinar_switch) && $results->webinar_switch == 'replay') {
                            echo 'selected';
                        } ?> >Show Webinar Replay
                        </option>
                        <option value="closed" <?php if (isset($results->webinar_switch) && $results->webinar_switch == 'closed') {
                            echo 'selected';
                        } ?> >Show Closed Page
                        </option>
                    </select>

                    <div class="infoLabel"
                         style="font-size: 9px; margin-top: 5px; color: #919191; font-weight: normal; text-align: center; "
                         id="masterSwitchCopy">( Updates / Saves On Change )
                    </div>
                </div>

                <br clear="all"/>

            </div>

            <div class="dash-wrapper-left">

                <div class="dash-stat-block dash-block-1" <?php if ($results->webinar_date == "AUTO") {
                    echo 'style="display:none;"';
                } ?> >
                    <div class="dash-stat-number" id="usersOnlineCount">0</div>
                    <div class="dash-stat-label">Live Viewers On Webinar</div>
                </div>

                <div class="dash-stat-block dash-block-2">
                    <div class="dash-stat-number"><?php echo $totalLeads; ?></div>
                    <div class="dash-stat-label">Total Registrants</div>
                </div>

                <div class="dash-stat-block dash-block-5">
                    <div class="dash-stat-number"><?php echo $totalOrders; ?></div>
                    <div class="dash-stat-label">Total Orders</div>
                </div>

                <div class="dash-stat-block dash-block-3">
                    <div class="dash-stat-number" id="dashTotalQ"><?php echo $totalQuestions; ?></div>
                    <div class="dash-stat-label">Total Questions</div>
                </div>

                <div class="dash-stat-block dash-block-4" <?php if ($results->webinar_date == "AUTO") {
                    echo 'style="display:none;"';
                } ?> >
                    <div class="dash-stat-number" id="dashTotalActiveQ"><?php echo $totalQuestionsActive; ?></div>
                    <div class="dash-stat-label">Total Active Questions</div>
                </div>

                <div class="dash-stat-block dash-block-6" <?php if ($results->webinar_date == "AUTO") {
                    echo 'style="display:none;"';
                } ?> >
                    <div class="dash-stat-label"
                         style="padding-bottom: 20px">
                        <?php
                        global $GoogleAuth;
                        if (!$GoogleAuth->is_authorized()) {
                            ?>
                            <a id="google-start-hangout" class="google-authorize"
                               href="<?php echo $GoogleAuth->get_auth_url(); ?>"><i
                                    class="icon-google-plus-sign"></i> Connect Google Account</a>
                        <?php
                        } else {
                            ?>
                            <a id="google-start-hangout"
                               href="https://plus.google.com/hangouts/_?hso=0&amp;gid="><i
                                    class="icon-google-plus-sign"></i> Start a Hangout</a>
                            <a id="revoke-google-auth" href="#" style="font-size:12px"><i
                                    class="icon-google-plus-sign"></i> Logout Google Account</a>
                        <?php
                        } ?>

                    </div>
                </div>

                <br clear="left"/>

            </div>

            <div class="dash-wrapper-right" style="display:none;">

                <div class="dash-webinar-info" style="text-align: center;">
                    <span class="infoLabel" style="font-size: 16px;">Webinar Sales Funnel</span>
                    <span class="infoLabelInner">w/ preview links</span>
                </div>

                <div class="dash-webinar-buttons">

                    <a href="<?php echo get_permalink($data->postID); ?>" target="_blank"
                       class="button small secondary dash-preview-btns"><i class="icon-external-link"></i> Landing Page
                        <span class="round success label"><?php if ($data->total_lp == "") {
                                echo "0";
                            } else {
                                echo $data->total_lp;
                            } ?></span></a>
                    <a href="<?php echo get_permalink($data->postID); ?>?confirmed" target="_blank"
                       class="button small secondary dash-preview-btns"><i class="icon-external-link"></i> Thank You
                        Page <span class="round success label"><?php if ($data->total_ty == "") {
                                echo "0";
                            } else {
                                echo $data->total_ty;
                            } ?></span></a>
                    <a href="<?php echo get_permalink($data->postID); ?>?preview-countdown" target="_blank"
                       class="button small secondary dash-preview-btns"><i class="icon-external-link"></i> CountDown</a>
                    <a href="<?php echo get_permalink($data->postID); ?>?preview-webinar" target="_blank"
                       class="button small secondary dash-preview-btns"><i class="icon-external-link"></i> Live Webinar
                        <span class="round success label"><?php if ($data->total_live == "") {
                                echo "0";
                            } else {
                                echo $data->total_live;
                            } ?></span></a>
                    <a href="<?php echo get_permalink($data->postID); ?>?preview-replay" target="_blank"
                       class="button small secondary dash-preview-btns"><i class="icon-external-link"></i> Webinar
                        Replay <span class="round success label"><?php if ($data->total_replay == "") {
                                echo "0";
                            } else {
                                echo $data->total_replay;
                            } ?></span></a>
                </div>

            </div>

            <br clear="left"/>

        </div>
    </div>

</div>

<script>
    var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
    var hangout_started = false;

    jQuery(document).ready(function () {

        $('#revoke-google-auth').click(function (event) {
            event.preventDefault();
            $.post(ajaxurl, {
                action: 'webinarignition_revoke_google_auth'
            }, function (result) {
                window.location.reload();
            });
        });

        $('#google-start-hangout').not('.google-authorize').click(function (event) {
            event.preventDefault();

            if (hangout_started) {
                alert('Please refresh this page to start a new webinar broadcast.');
                return;
            }
            hangout_started = true;

            //start auto embed
            check_hangout_embed();

            var w = $(window).width() * 90 / 100;
            var h = $(window).height() * 90 / 100;
            var left = (screen.width / 2) - (w / 2);
            var top = (screen.height / 2) - (h / 2);
            return window.open($(this).attr('href'), 'Google Hangout', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

        });

        function check_hangout_embed() {
            setTimeout(function () {
                $.post(ajaxurl, {
                    action: 'webinarignition_hangouts_update_embed_video',
                    webinar_id: <?php echo $client; ?>
                }, function (result) {
                    if (result.status == 'NOK' && result.message == 'reauth') {
                        alert('Please close the current hangout. Refresh your console page and re-start the hangout. Authorization required with Google.');
                        return;
                    }
                    if (result.status != 'OK') {
                        check_hangout_embed();
                    }
                }, 'json');
            }, 13000);
        }

    })
    ;

</script>