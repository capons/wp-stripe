<div class="tabber" id="tab8" style="display: none;">

    <div class="titleBar">
        <h2>Webinar Notification Setting:</h2>

        <p>Here you can manage the notification emails & txt for the webinar...</p>
    </div>

    <?php
    // display_tutorial(
    // 	"Email Notication & SendGrid Settings Video Tutorial:",
    // 	"http://webinarignition.com/members/download-training/"
    // );
    ?>

    <?php
    display_edit_toggle(
        "cogs", "SMTP Integration -- SendGrid / PostMark / Mandrill / Amazon SES", "we_edit_smtp_int", "Your settings for sending out emails with 3rd party mail API services..."
    );
    ?>

    <div id="we_edit_smtp_int" class="we_edit_area">
        <?php

// fix :: cron-fuse :: now unconditional
// --------------------------------------------------------------------------------------
            display_field
            (
               $_GET['id'], WEBINARIGNITION_URL."inc/schedule_notifications.php",
               "Cronjob URL:", "cronjoburl", "This is the URL that should be setup with your Cronjob... <br><br>
               <a href='http://webinarignition.com/docs/cron_auto.pdf' target='_blank' ><b>Cronjob Setup Tutorial</b></a>", "Cronjob URL..."
            );
// --------------------------------------------------------------------------------------


/* old :: deprecated
// --------------------------------------------------------------------------------------
        if ($results->webinar_date == "AUTO") {
            display_field(
                $_GET['id'], WEBINARIGNITION_URL . "inc/schedule_email_auto.php?id=" . $_GET['id'], "Cronjob URL:", "cronjoburl", "This is the URL that should be setup with your Cronjob... <br><br>
			<a href='http://webinarignition.com/docs/cron_auto.pdf' target='_blank' ><b>Cronjob Setup Tutorial</b></a>", "Cronjob URL..."
            );
        } else {
            display_field(
                $_GET['id'], WEBINARIGNITION_URL . "inc/schedule_email_live.php?id=" . $_GET['id'], "Cronjob URL:", "cronjoburl", "This is the URL that should be setup with your Cronjob... <br><br>
			<a href='http://webinarignition.com/docs/cron_live.pdf' target='_blank' ><b>Cronjob Setup Tutorial</b></a>", "Cronjob URL..."
            );
        }
// --------------------------------------------------------------------------------------
*/

        display_field(
            $_GET['id'], $results->smtp_host, "SMTP Host:", "smtp_host", "This is your SMTP host, you can get this from your email provider... <br><br>
		<a href='http://webinarignition.com/docs/SMTP_mandrill.pdf' target='_blank' ><b>Mandrill Integration Tutorial</b></a><br><br>
		<a href='http://webinarignition.com/docs/SMTP_sendgrid.pdf' target='_blank' ><b>SendGrid Integration Tutorial</b></a><br><br>
		<a href='http://webinarignition.com/docs/SMTP_postmark.pdf' target='_blank' ><b>Postmark Integration Tutorial</b></a>", "SMTP Host..."
        );

        display_field(
            $_GET['id'], $results->smtp_port, "SMTP Port:", "smtp_port", "This is your SMTP port, you can get this from your email provider... read Help PDF", "SMTP Port..."
        );

        display_option(
            $_GET['id'], $results->transfer_protocol, "Choose transfer protocol", "transfer_protocol", "Choose transfer protocol. If not sure, choose TLS", "TLS [tls], SSL [ssl], NONE [none]"
        );

        display_field(
            $_GET['id'], $results->smtp_user, "SMTP Username:", "smtp_user", "This is your SMTP username...", "SMTP Username..."
        );

        display_field(
            $_GET['id'], $results->smtp_pass, "SMTP Password:", "smtp_pass", "This is your SMTP password...", "SMTP Password..."
        );

        display_field(
            $_GET['id'], $results->smtp_name, "From Name:", "smtp_name", "This is the name that the email will be from...", "Your Name..."
        );

        display_field(
            $_GET['id'], $results->smtp_email, "From Email:", "smtp_email", "This is email that your email will be sent out (the reply to email)...", "Your Email..."
        );
        global $user_email;
        display_info(
            "SMTP Help:", "Read the PDF for help with Connecting with SendGrid, Mandrill, PostMarkApp and Gmail."
            . '<div><h4><i class="icon-wrench"></i> Test SMTP configuration</h4>'
            . '<div style="margin-top:6px;display: inline-block" id="webinarignition_test_smtp" class="grey-btn">Save & Test SMTP</div>'
            . '</div>'
        );
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function ($)
            {
               $('#webinarignition_test_smtp').click(function ()
               {
                  $trigger = $(this);

                  if ($(this).find('img').length > 0)
                  { return; }

                  var bkpHtm = $trigger.html();
                  var bzyIcn = '<img src="<?php echo WEBINARIGNITION_URL . 'images/ajax-loader.gif'; ?>" />';

                  $trigger.html(bzyIcn+' Saving...');

                  wi_saveIt
                  (
                     function()
                     {
                        $trigger.html(bzyIcn+' Testing...');

                        $.post
                        (
                           ajaxurl,
                           {action:'webinarignition_test_smtp', campaign_id:'<?php echo @$_GET['id']; ?>'},

                           function(data)
                           {
                              $trigger.html(bkpHtm);

                              if (data && data.status === 1) { 
                                  alert('SMTP details are good!'); 
                              } else if (data && data.status === 2) {
                                 alert('Sendmail details are good!');  
                              }
                              else
                              { alert('Error: ' + data.errors); }
                           },

                           'json'
                        );
                     }
                  );
               });
            });
        </script>
    </div>

    <?php
    display_edit_toggle(
        "envelope", "On Sign Up Email - First Email", "we_edit_email_signup", "This is the email copy that is sent out when they first sign up..."
    );
    ?>

    <div id="we_edit_email_signup" class="we_edit_area">
        <?php
        display_field(
            $_GET['id'], $results->email_signup_sbj, "Sign Up Email Subject", "email_signup_sbj", "This is the sign up email subject line...", ""
        );
        display_wpeditor(
            $_GET['id'], $results->email_signup_body, "Email Body Copy", "email_signup_body", "This your email body copy..."
        );

        display_info(
            "Supported Email Shortcodes:", "Lead Email: {EMAIL} - Webinar Link: {LINK} - Date: {DATE} - Title: {TITLE} -  HOST: {HOST}"
        );
        ?>
    </div>



    <?php
    display_edit_toggle(
        "envelope-alt", "Email Notification #1 - Live Webinar", "we_edit_email_signup_2", "This email should be sent out 1 day before the webinar..."
    );
    ?>

    <div id="we_edit_email_signup_2" class="we_edit_area">

        <?php
        display_option(
            $_GET['id'], $results->email_notiff_1, "Toggle Email Notification #1", "email_notiff_1", "You can have this notification sent out or not...", "Enable Email Notification [on], Disable Email Notification [off]"
        );
        ?>
        <div class="email_notiff_1" id="email_notiff_1_on">

            <?php
            display_field(
                $_GET['id'], $results->email_notiff_sbj_1, "Sign Up Email Subject", "email_notiff_sbj_1", "This is the sign up email subject line...", "Email Subject Line..."
            );
            display_wpeditor(
                $_GET['id'], $results->email_notiff_body_1, "Email Body Copy", "email_notiff_body_1", "This your email that is sent out. Formatted with HTML..."
            );

            if ($results->webinar_date == "AUTO") {
                // show nothing...
            } else {

                display_date(
                    $_GET['id'], $results->email_notiff_date_1, "Scheduled Date", "email_notiff_date_1", "This is the date on which this email is out sent out...", "Scheduled Date..."
                );

                display_time(
                    $_GET['id'], $results->email_notiff_time_1, "Scheduled Time", "email_notiff_time_1", "This is the time that the will be sent out on the date (above)..."
                );

                display_option(
                    $_GET['id'], $results->email_notiff_status_1, "Status Of Email", "email_notiff_status_1", "This will tell if this email was sent out or not. If it was sent, and you want to change the date, remember to change this back to not sent...", "Email Queued [queued], Email Has Been Sent [sent]"
                );
            }

            display_info(
                "Supported Email Shortcodes:", "Lead Email: {EMAIL} - Webinar Link: {LINK} - Date: {DATE} - Title: {TITLE} -  HOST: {HOST}"
            );
            ?>
        </div>
    </div>

    <?php
    display_edit_toggle(
        "envelope-alt", "Email Notification #2 - Live Webinar", "we_edit_email_signup_3", "This email should be sent out 1 hour before the webinar..."
    );
    ?>

    <div id="we_edit_email_signup_3" class="we_edit_area">
        <?php
        display_option(
            $_GET['id'], $results->email_notiff_2, "Toggle Email Notification #2", "email_notiff_2", "You can have this notification sent out or not...", "Enable Email Notification [on], Disable Email Notification [off]"
        );
        ?>
        <div class="email_notiff_2" id="email_notiff_2_on">

            <?php
            display_field(
                $_GET['id'], $results->email_notiff_sbj_2, "Sign Up Email Subject", "email_notiff_sbj_2", "This is the sign up email subject line...", "Email Subject Line..."
            );
            display_wpeditor(
                $_GET['id'], $results->email_notiff_body_2, "Email Body Copy", "email_notiff_body_2", "This your email that is sent out. Formatted with HTML..."
            );

            if ($results->webinar_date == "AUTO") {
                // show nothing...
            } else {

                display_date(
                    $_GET['id'], $results->email_notiff_date_2, "Scheduled Date", "email_notiff_date_2", "This is the date on which this email is out sent out...", "Scheduled Date..."
                );

                display_time(
                    $_GET['id'], $results->email_notiff_time_2, "Scheduled Time", "email_notiff_time_2", "This is the time that the will be sent out on the date (above)..."
                );

                display_option(
                    $_GET['id'], $results->email_notiff_status_2, "Status Of Email", "email_notiff_status_2", "This will tell if this email was sent out or not. If it was sent, and you want to change the date, remember to change this back to not sent...", "Email Queued [queued], Email Has Been Sent [sent]"
                );
            }

            display_info(
                "Supported Email Shortcodes:", "Lead Email: {EMAIL} - Webinar Link: {LINK} - Date: {DATE} - Title: {TITLE} -  HOST: {HOST}"
            );
            ?>
        </div>
    </div>

    <?php
    display_edit_toggle(
        "envelope-alt", "Email Notification #3 - Live Webinar", "we_edit_email_signup_4", "This email should be sent out when the webinar is live..."
    );
    ?>

    <div id="we_edit_email_signup_4" class="we_edit_area">
        <?php
        display_option(
            $_GET['id'], $results->email_notiff_3, "Toggle Email Notification #3", "email_notiff_3", "You can have this notification sent out or not...", "Enable Email Notification [on], Disable Email Notification [off]"
        );
        ?>
        <div class="email_notiff_3" id="email_notiff_3_on">

            <?php
            display_field(
                $_GET['id'], $results->email_notiff_sbj_3, "Sign Up Email Subject", "email_notiff_sbj_3", "This is the sign up email subject line...", "Email Subject Line..."
            );
            display_wpeditor(
                $_GET['id'], $results->email_notiff_body_3, "Email Body Copy", "email_notiff_body_3", "This your email that is sent out. Formatted with HTML..."
            );

            if ($results->webinar_date == "AUTO") {
                // show nothing...
            } else {

                display_date(
                    $_GET['id'], $results->email_notiff_date_3, "Scheduled Date", "email_notiff_date_3", "This is the date on which this email is out sent out...", "Scheduled Date..."
                );

                display_time(
                    $_GET['id'], $results->email_notiff_time_3, "Scheduled Time", "email_notiff_time_3", "This is the time that the will be sent out on the date (above)..."
                );

                display_option(
                    $_GET['id'], $results->email_notiff_status_3, "Status Of Email", "email_notiff_status_3", "This will tell if this email was sent out or not. If it was sent, and you want to change the date, remember to change this back to not sent...", "Email Queued [queued], Email Has Been Sent [sent]"
                );
            }

            display_info(
                "Supported Email Shortcodes:", "Lead Email: {EMAIL} - Webinar Link: {LINK} - Date: {DATE} - Title: {TITLE} -  HOST: {HOST}"
            );
            ?>
        </div>
    </div>

    <?php
    display_edit_toggle(
        "envelope-alt", "Email Notification #1 - Replay Webinar", "we_edit_email_signup_5", "This email should be sent out 1 hour after the webinar..."
    );
    ?>

    <div id="we_edit_email_signup_5" class="we_edit_area">
        <?php
        display_option(
            $_GET['id'], $results->email_notiff_4, "Toggle Email Notification #4", "email_notiff_4", "You can have this notification sent out or not...", "Enable Email Notification [on], Disable Email Notification [off]"
        );
        ?>
        <div class="email_notiff_4" id="email_notiff_4_on">

            <?php
            display_field(
                $_GET['id'], $results->email_notiff_sbj_4, "Sign Up Email Subject", "email_notiff_sbj_4", "This is the sign up email subject line...", "Email Subject Line..."
            );
            display_wpeditor(
                $_GET['id'], $results->email_notiff_body_4, "Email Body Copy", "email_notiff_body_4", "This your email that is sent out. Formatted with HTML..."
            );

            if ($results->webinar_date == "AUTO") {
                // show nothing...
            } else {

                display_date(
                    $_GET['id'], $results->email_notiff_date_4, "Scheduled Date", "email_notiff_date_4", "This is the date on which this email is out sent out...", "Scheduled Date..."
                );

                display_time(
                    $_GET['id'], $results->email_notiff_time_4, "Scheduled Time", "email_notiff_time_4", "This is the time that the will be sent out on the date (above)..."
                );

                display_option(
                    $_GET['id'], $results->email_notiff_status_4, "Status Of Email", "email_notiff_status_4", "This will tell if this email was sent out or not. If it was sent, and you want to change the date, remember to change this back to not sent...", "Email Queued [queued], Email Has Been Sent [sent]"
                );
            }

            display_info(
                "Supported Email Shortcodes:", "Lead Email: {EMAIL} - Webinar Link: {LINK} - Date: {DATE} - Title: {TITLE} -  HOST: {HOST}"
            );
            ?>
        </div>
    </div>

    <?php
    display_edit_toggle(
        "envelope-alt", "Email Notification #2 - Replay Webinar", "we_edit_email_signup_6", "This email should be sent out 1 day after the webinar..."
    );
    ?>

    <div id="we_edit_email_signup_6" class="we_edit_area">
        <?php
        display_option(
            $_GET['id'], $results->email_notiff_5, "Toggle Email Notification #5", "email_notiff_5", "You can have this notification sent out or not...", "Enable Email Notification [on], Disable Email Notification [off]"
        );
        ?>
        <div class="email_notiff_5" id="email_notiff_5_on">

            <?php
            display_field(
                $_GET['id'], $results->email_notiff_sbj_5, "Sign Up Email Subject", "email_notiff_sbj_5", "This is the sign up email subject line...", "Email Subject Line..."
            );
            display_wpeditor(
                $_GET['id'], $results->email_notiff_body_5, "Email Body Copy", "email_notiff_body_5", "This your email that is sent out. Formatted with HTML..."
            );

            if ($results->webinar_date == "AUTO") {
                // show nothing...
            } else {

                display_date(
                    $_GET['id'], $results->email_notiff_date_5, "Scheduled Date", "email_notiff_date_5", "This is the date on which this email is out sent out...", "Scheduled Date..."
                );

                display_time(
                    $_GET['id'], $results->email_notiff_time_5, "Scheduled Time", "email_notiff_time_5", "This is the time that the will be sent out on the date (above)..."
                );

                display_option(
                    $_GET['id'], $results->email_notiff_status_5, "Status Of Email", "email_notiff_status_5", "This will tell if this email was sent out or not. If it was sent, and you want to change the date, remember to change this back to not sent...", "Email Queued [queued], Email Has Been Sent [sent]"
                );
            }

            display_info(
                "Supported Email Shortcodes:", "Lead Email: {EMAIL} - Webinar Link: {LINK} - Date: {DATE} - Title: {TITLE} -  HOST: {HOST}"
            );
            ?>
        </div>
    </div>

    <?php
    display_edit_toggle(
        "comments", "TXT Reminder - Send out TXT MSG 1 Hour Before Live...", "we_edit_twilio", "This is a txt msg that is sent out 1 hour before live..."
    );
    ?>

    <div id="we_edit_twilio" class="we_edit_area">
        <?php
        display_option(
            $_GET['id'], $results->email_twilio, "Toggle TXT Notification", "email_twilio", "You can have this notification sent out or not...", "Enable TXT Notification [on], Disable TXT Notification [off]"
        );
        ?>
        <div class="email_twilio" id="email_twilio_on">
            <?php
            // if( $results->webinar_date == "AUTO" ){
            // 	display_field(
            // 		$_GET['id'],
            // 		WEBINARIGNITION_URL . "inc/schedule_email_auto_sms.php?id=". $_GET['id'],
            // 		"Cronjob URL SMS:",
            // 		"cronjoburlsms",
            // 		"This is the URL that should be setup with your Cronjob... read Help PDF for more info.",
            // 		"Cronjob URL..."
            // 	);
            // } else {
            // 	display_field(
            // 		$_GET['id'],
            // 		WEBINARIGNITION_URL . "inc/schedule_email_live_sms.php?id=". $_GET['id'],
            // 		"Cronjob URL SMS:",
            // 		"cronjoburlsms",
            // 		"This is the URL that should be setup with your Cronjob... read Help PDF for more info.",
            // 		"Cronjob URL..."
            // 	);
            // }

            display_field(
                $_GET['id'], $results->twilio_id, "Twilio Account ID", "twilio_id", "This is your twilio account ID... <br><b><a href='https://www.twilio.com/' target='_blank'>Create Twilio Account</a></b>", "Twilio Account SID"
            );
            display_field(
                $_GET['id'], $results->twilio_token, "Twilio Account Token", "twilio_token", "This is your account token...", "Twilio Account Token"
            );
            display_field(
                $_GET['id'], $results->twilio_number, "Twilio Phone Number", "twilio_number", "This is your twilio number that you want the txt msg to be from...<br><b>Example: +19253456789</b>", "+1XXXXXXXXXX"
            );
            display_textarea(
                $_GET['id'], $results->twilio_msg, "Txt Message", "twilio_msg", "This is the txt message that is sent out, shortcode with {LINK} for the URL, but we suggest you creating a tinyURL...", "TXT MSG here..."
            );

            display_info(
                "Send Test SMS:", "Send a test text message to check your Twilio configuration."
                . '<div>'
                . '<div style="color: #FF0038">NOTE: You MUST Save & Update your settings before testing.</div>'
                . '<input type="text" id="webinarignition_test_sms_number" class="inputField" style="width: 200px !important; height: 40px !important; margin-top: 7px; line-height:inherit !important;" /> <div style="margin-top:6px;display: inline-block" id="webinarignition_test_sms" class="grey-btn">Send SMS</div>'
                . '</div>'
            );
            ?>
            <script type="text/javascript">
                jQuery(document).ready(function ($) {
                    $('#webinarignition_test_sms').click(function () {
                        var phone_number = $('#webinarignition_test_sms_number').val();
                        if (!phone_number) {
                            alert('Provide a phone number to send the SMS to.');
                            return;
                        }
                        $trigger = $(this);
                        if ($(this).find('img').length > 0)
                            return;
                        var backup_html = $trigger.html();
                        $trigger.html('<img src="<?php echo WEBINARIGNITION_URL . 'images/ajax-loader.gif'; ?>" />');
                        $.post(ajaxurl, {
                            action: 'webinarignition_test_sms',
                            campaign_id: '<?php echo @$_GET['id']; ?>',
                            phone_number: phone_number
                        }, function (data) {
                            $trigger.html(backup_html);
                            if (data && data.status === 1) {
                                alert('SMS has been sent.');
                            } else {
                                alert('Error: ' + data.errors);
                            }
                        }, 'json');
                    });
                });
            </script>
            <?php
            if ($results->webinar_date == "AUTO") {
                // show nothing...
            } else {

                display_date(
                    $_GET['id'], $results->email_twilio_date, "Scheduled Date", "email_twilio_date", "This is the date on which this txt message is out sent out...", "Scheduled Date..."
                );

                display_time(
                    $_GET['id'], $results->email_twilio_time, "Scheduled Time", "email_twilio_time", "This is the time that the will be sent out on the date (above)..."
                );

                display_option(
                    $_GET['id'], $results->email_twilio_status, "Status Of TXT MSG", "email_twilio_status", "This will tell if this TXT MSG was sent out or not. If it was sent, and you want to change the date, remember to change this back to not sent...", "TXT MSG Queued [queued], TXT MSG Has Been Sent [sent]"
                );
            }
            ?>
        </div>
    </div>
    <?php
    display_edit_toggle(
        "file-alt", "Logs", "we_view_log", "View the notification transmission logs"
    );
    $log_types = array(WI_Logs::LIVE_EMAIL,WI_Logs::LIVE_SMS);
    if($results->webinar_date == 'AUTO') {
        $log_types = array(WI_Logs::AUTO_EMAIL,WI_Logs::AUTO_SMS);
        $results->webinar_timezone = false;
    }
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $("#we_view_log").on("click", ".paginate", function() {
                $.ajax({
                    url: ajaxurl,
                    type: 'post',
                    data: {
                        action: "wi_show_logs_get",
                        campaign_id: <?php echo $_GET['id']; ?>,
                        page: $(this).attr("page")
                    }
                }).success(function (data) {
                    $("#we_view_log").html(data);
                });
            });
        });
    </script>
    <div id="we_view_log" class="we_edit_area">
    <?php wi_show_logs($results->id, $log_types, 1, $results->webinar_timezone); ?>
    </div>

    <div class="bottomSaveArea">
        <a href="#" class="blue-btn-44 btn saveIt" style="color:#FFF;"><i class="icon-save"></i> Save & Update</a>
    </div>

</div>
