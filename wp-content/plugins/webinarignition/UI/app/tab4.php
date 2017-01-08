<div class="tabber" id="tab4" style="display: none;">

<div class="titleBar">
    <div class="titleBarIcon">
        <!-- <i class="icon-copy icon-5x"></i> -->
    </div>

    <div class="titleBarText">
        <h2>Thank You Page Settings:</h2>

        <p>Here you can edit & manage your webinar registration thank you page...</p>
        <!-- <p><span class=" btn blue-btn-5" id="previews" ><a href="<?php echo get_permalink( $data->postID ); ?>?confirmed" target="_blank" ><i class="icon-external-link" ></i> View Thank You Page</a></span></p> -->
    </div>

    <div class="launchConsole">
        <a href="<?php echo wi_fixPerma($data->postID); ?>confirmed" target="_blank"><i class="icon-external-link-sign"></i> Preview Thank You Page</a>
    </div>

    <br clear="all"/>

</div>

<?php

// display_tutorial(
// 	"Thank You Page Settings Video Tutorial:",
// 	"http://webinarignition.com/members/download-training/"
// );

display_edit_toggle(
    "edit-sign",
    "Thank You Headline",
    "we_edit_ty_headline",
    "This appears above the thank you area..."
);

?>

<div id="we_edit_ty_headline" class="we_edit_area">
    <?php
    display_field(
        $_GET['id'],
        $results->ty_ticket_headline,
        "Main Headline",
        "ty_ticket_headline",
        "This is the copy that is shown at the top of page...",
        "Ex. Congrats - Your Are Signed Up For The Event!"
    );
    display_field(
        $_GET['id'],
        $results->ty_ticket_subheadline,
        "Ticket Sub Headline",
        "ty_ticket_subheadline",
        "This is shown under the main headline...",
        "Ex. Below Is Everything You Need For The Event..."
    );
    ?>
</div>

<?php

display_edit_toggle(
    "play-sign",
    "Thank You Message Area - Copy / Video / Image Settings",
    "we_edit_ty_video",
    "Setup your thank you message / video / image for when they opt in and are on the thank you page..."
);

?>

<div id="we_edit_ty_video" class="we_edit_area">
    <?php
    display_option(
        $_GET['id'],
        $results->ty_cta_type,
        "CTA Type:",
        "ty_cta_type",
        "You can choose to display a video embed code or have an image to be shown here. A video will get higher results...",
        "Show HTML [html], Show Video [video], Show Image [image]"
    );
    ?>
    <div class="ty_cta_type" id="ty_cta_type_video" style="display: none;">
        <?php
        display_textarea(
            $_GET['id'],
            $results->ty_cta_video_code,
            "Video Embed Code",
            "ty_cta_video_code",
            "This is your video embed code. Your video will be auto-resized to fit the area which is <b>410px width and 231px height</b> <Br><br>EasyVideoPlayer users must resize their video manually...",
            "Ex. Youtube embed code, Vimeo embed code, etc"
        );
        display_info(
            "Note: Video Size",
            "The video will be auto-resized to fit the page at 410x231 - make sure your video is a similiar aspect ratio..."
        );
        ?>
    </div>

    <div class="ty_cta_type" id="ty_cta_type_image" style="display: none;">
        <?php
        display_field_image(
            $_GET['id'],
            $results->ty_cta_image,
            "CTA Image URL",
            "ty_cta_image",
            "This is the image that will be shown in the main cta area, this image will be resized to fit the area: <b>500px width and 281px height</b>...",
            "http://yoursite.com/cta-image.png"
        );
        ?>
    </div>

    <div class="ty_cta_type" id="ty_cta_type_html">
        <?php
        display_wpeditor(
            $_GET['id'],
            $results->ty_cta_html,
            "CTA HTML Copy",
            "ty_cta_html",
            "This is the copy that is shown on the right of the event ticket area..."
        );
        ?>
    </div>

</div>

<?php

display_edit_toggle(
    "link",
    "Grab Webinar URL",
    "we_edit_ty_step1",
    "This is the area for the webinar URL..."
);

?>

<div id="we_edit_ty_step1" class="we_edit_area">
    <?php
    display_field(
        $_GET['id'],
        $results->ty_webinar_headline,
        "Webinar URL Title Copy",
        "ty_webinar_headline",
        "This is the the title for the webinar URL which appears above the webinar URL form field...",
        "Ex. Here is the webinar URL..."
    );
    display_field(
        $_GET['id'],
        $results->ty_webinar_subheadline,
        "Webinar URL Sub Title Copy",
        "ty_webinar_subheadline",
        "This is the sub title that is shown UNDER the webinar url form field...",
        "Ex. Save and bookmark this URL so you can get access to the live webinar and webinar replay..."
    );
    if ($results->webinar_date == "AUTO") {
    } else {
        display_option(
            $_GET['id'],
            $results->ty_webinar_url,
            "Webinar URL",
            "ty_webinar_url",
            "The webinar URL type, you can either display the webinar link for this webinar OR if you want to use your own live webinar page, you can enter in a custom URL...",
            "WebinarIgnition URL [we], Custom Webinar URL [custom]"
        );
        ?>

        <div style="display: none;" class="ty_webinar_url" id="ty_webinar_url_custom">
            <?php
            display_field(
                $_GET['id'],
                $results->ty_werbinar_custom_url,
                "Custom Webinar URL",
                "ty_werbinar_custom_url",
                "This is the url where your webinar will be viewable... This is only if you want to use your own webinar page with another service...",
                "Ex. http://yoursite.com/webinar-page.php"
            );
            ?>
        </div>
    <?php } ?>

</div>

<?php

display_edit_toggle(
    "twitter-sign",
    "Share & Unlock Gift",
    "we_edit_ty_share",
    "This is the headline area for above the share / social unlock area..."
);

?>

<div id="we_edit_ty_share" class="we_edit_area">
    <?php

    display_option(
        $_GET['id'],
        $results->ty_share_toggle,
        "Share Unlock Settings",
        "ty_share_toggle",
        "Here you can have it where you give a reward for sharing the webinar link...",
        "Disable Share Unlock [none], Enable Share Unlock [block]"
    );

    display_info(
        "Note: Share Title & Desc",
        "The share title and description are the landing page META info which can be found in the registration page settings area..."
    );

    // display_field(
    // 	$_GET['id'],
    // 	$results->ty_share_title,
    // 	"Share Title",
    // 	"ty_share_title",
    // 	"This is the title for the sharing widgets. Used in all the social network shares...",
    // 	"Ex. Check Out Amazing Webinar..."
    // );
    // display_field(
    // 	$_GET['id'],
    // 	$results->ty_share_desc,
    // 	"Share Caption",
    // 	"ty_share_desc",
    // 	"This is the description for the sharing widgets. Used in the social nework shares...",
    // 	"Ex. Join this amazing webinar May the 4th, and discover industry trade secrets!"
    // );

    ?>
    <div class="ty_share_toggle" id="ty_share_toggle_block">
        <?php
        display_field(
            $_GET['id'],
            $results->ty_step2_headline,
            "Step #2 Headline Copy",
            "ty_step2_headline",
            "This is the copy that is shown above the sharing / unlock options...",
            "Ex. Step #2: Share & Unlock Free Gift..."
        );
        display_option(
            $_GET['id'],
            $results->ty_fb_share,
            "Facebook Share",
            "ty_fb_share",
            "You can turn on or off the Facebook like area...",
            "Enable [on], Disable [off]"
        );
        display_option(
            $_GET['id'],
            $results->ty_tw_share,
            "Twitter Share",
            "ty_tw_share",
            "You can turn on or off the Twiter like area...",
            "Enable [on], Disable [off]"
        );
        display_option(
            $_GET['id'],
            $results->ty_ld_share,
            "LinkedIn Share",
            "ty_ld_share",
            "You can turn on or off the LinkedIn like area...",
            "Enable [on], Disable [off]"
        );
        // display_option(
        // 	$_GET['id'],
        // 	$results->ty_gp_share,
        // 	"Google Plus Share",
        // 	"ty_gp_share",
        // 	"You can turn on or off the Google Plus like area...",
        // 	"Enable [on], Disable [off]"
        // );
        // display_field(
        // 	$_GET['id'],
        // 	$results->ty_share_image,
        // 	"Share Image URL",
        // 	"ty_share_image",
        // 	"This is the image that is used with the social shares, for best results, keep it: 120px by 120px..",
        // 	"Ex. http://yoursite.com/share-image.png"
        // );
        display_wpeditor(
            $_GET['id'],
            $results->ty_share_intro,
            "Pre-Share Copy",
            "ty_share_intro",
            "This is the copy that is shown under the share options before they share to unlock the reward..."
        );
        display_wpeditor(
            $_GET['id'],
            $results->ty_share_reveal,
            "Post-Share Reveal Copy",
            "ty_share_reveal",
            "This is the copy that is shown after they share on one of the social networks, best to have your download link to the free offer here..."
        );
        ?>
    </div>

</div>

<?php

 display_edit_toggle(
     "ticket",
     "Ticket / Webinar Info Block",
     "we_edit_ty_ticket",
     "This is a block for the webinar information, quick snap shot..."
 );

?>

<div id="we_edit_ty_ticket" class="we_edit_area">
    <?php
    display_option(
        $_GET['id'],
        $results->ty_ticket_webinar_option,
        "Webinar Event Title",
        "ty_ticket_webinar_option",
        "This is the webinar event title, you can use the webinar settings, or use custom event title...",
        "Use Webinar Settings [webinar], Custom Webinar Copy [custom]"
    );
    ?>
    <div style="display:none;" class="ty_ticket_webinar_option" id="ty_ticket_webinar_option_custom">
        <?php
        display_field(
            $_GET['id'],
            $results->ty_ticket_webinar,
            "Webinar",
            "ty_ticket_webinar",
            "This is the text for the Webinar text (for translating), leave blank if you don't need to translate this...",
            "Ex. Webinar"
        );
        display_field(
            $_GET['id'],
            $results->ty_webinar_option_custom_title,
            "Custom Webinar Title",
            "ty_webinar_option_custom_title",
            "This is shown next to the webinar copy, this is a custom event title...",
            "Ex. Super Awesome Webinar..."
        );
        ?>
    </div>
    <?php
    display_option(
        $_GET['id'],
        $results->ty_ticket_host_option,
        "Host Title",
        "ty_ticket_host_option",
        "This is the host title, you can use the webinar settings, or use custom host title...",
        "Use Webinar Settings [webinar], Custom Host Copy [custom]"
    );
    ?>
    <div class="ty_ticket_host_option" id="ty_ticket_host_option_custom" style="display: none;">
        <?php
        display_field(
            $_GET['id'],
            $results->ty_ticket_host,
            "Host",
            "ty_ticket_host",
            "This is the text for the Host text (for translating), leave blank if you don't need to translate this...",
            "Ex. Host"
        );
        display_field(
            $_GET['id'],
            $results->ty_webinar_option_custom_host,
            "Custom Webinar Host",
            "ty_webinar_option_custom_host",
            "This is shown next to the host copy, this is a custom host title...",
            "Ex. Mike Smith"
        );
        ?>
    </div>

    <?php

    display_option(
        $_GET['id'],
        $results->ty_ticket_date_option,
        "Date Title",
        "ty_ticket_date_option",
        "This is the date, you can use the webinar settings, or use custom date...",
        "Use Webinar Settings [webinar], Custom Date Copy [custom]"
    );

    ?>
    <div class="ty_ticket_date_option" id="ty_ticket_date_option_custom" style="display: none;">
        <?php
        display_field(
            $_GET['id'],
            $results->ty_ticket_date,
            "Date",
            "ty_ticket_date",
            "This is the text for the date text (for translating), leave blank if you don't need to translate this...",
            "Ex. Date"
        );
        if ($results->webinar_date == "AUTO") {
            // no show
        } else {
            display_field(
                $_GET['id'],
                $results->ty_webinar_option_custom_date,
                "Custom Webinar Date",
                "ty_webinar_option_custom_date",
                "This is shown next to the date copy, this is a custom Date...",
                "Ex. May 4th"
            );
        }
        ?>
    </div>

    <?php
    display_option(
        $_GET['id'],
        $results->ty_ticket_time_option,
        "Time Title",
        "ty_ticket_time_option",
        "This is the time, you can use the webinar settings, or use custom time...",
        "Use Webinar Settings [webinar], Custom Time Copy [custom]"
    );
    ?>
    <div class="ty_ticket_time_option" id="ty_ticket_time_option_custom" style="display: none;">
        <?php
        display_field(
            $_GET['id'],
            $results->ty_ticket_time,
            "Time",
            "ty_ticket_time",
            "This is the text for the time text (for translating), leave blank if you don't need to translate this...",
            "Ex. Date"
        );
        if ($results->webinar_date == "AUTO") {
            // no show
        } else {
            display_field(
                $_GET['id'],
                $results->ty_webinar_option_custom_time,
                "Custom Webinar Time",
                "ty_webinar_option_custom_time",
                "This is shown next to the time copy, this is a custom time...",
                "Ex. At 4pm, EST time..."
            );
        }
        ?>
    </div>
</div>

<?php

display_edit_toggle(
    "time",
    "Mini Countdown Area",
    "we_edit_ty_cdarea",
    "This is the mini countdown area that displays in the ticket area..."
);

?>

<div id="we_edit_ty_cdarea" class="we_edit_area">
    <?php
    // display_option(
    // 	$_GET['id'],
    // 	$results->tycdarea,
    // 	"Toggle Mini Countdown",
    // 	"tycdarea",
    // 	"You can show a mini countdown to display on the thank you page, this count downs to the time of the webinar, and depending on the status of the webinar, it has a link different link...",
    // 	"Enable Countdown Timer [show], Disable Countdown Timer [shiw]"
    // );
    ?>

    <div class="tycdarea" id="tycdarea_show">
        <?php
        display_field(
            $_GET['id'],
            $results->tycd_countdown,
            "Counting Down Copy",
            "tycd_countdown",
            "This is the copy display above the countdown timer...",
            "Ex. Webinar Starts In:"
        );

        display_field(
            $_GET['id'],
            $results->tycd_progress,
            "View Webinar Button",
            "tycd_progress",
            "This is the copy that is shown on the button when the countdown is down to zero, and the button links to the webinar...",
            "Ex. Webinar In Progress"
        );

        //translation of coompact labels for countdown, used in compact mode
        display_field(
            $_GET['id'],
            $results->tycd_years,
            "Translate::Years",
            "tycd_years",
            "Label used to describe years in countdown compact mode.",
            "Default: y"
        );
        display_field(
            $_GET['id'],
            $results->tycd_months,
            "Translate::Months",
            "tycd_months",
            "Label used to describe months in countdown compact mode.",
            "Default: m"
        );
        display_field(
            $_GET['id'],
            $results->tycd_weeks,
            "Translate::Weeks",
            "tycd_weeks",
            "Label used to describe weeks in countdown compact mode.",
            "Default: w"
        );
        display_field(
            $_GET['id'],
            $results->tycd_days,
            "Translate::Days",
            "tycd_days",
            "Label used to describe days in countdown compact mode.",
            "Default: d"
        );
        ?>
    </div>

</div>

<?php

display_edit_toggle(
    "calendar",
    "Add To Calendar Block",
    "we_edit_ty_addtocalendar",
    "This is for the for the buttons to add the webinar to their calendars..."
);

?>

<div id="we_edit_ty_addtocalendar" class="we_edit_area">
    <?php
    display_field(
        $_GET['id'],
        $results->ty_calendar_headline,
        "Add To Calendar Headline",
        "ty_calendar_headline",
        "This is the headline for the add to calendar area...",
        "Ex. Add To Calendar"
    );
    display_field(
        $_GET['id'],
        $results->ty_calendar_google,
        "Google Calendar Button Copy",
        "ty_calendar_google",
        "This is the copy for the Google Calendar button...",
        "Ex. Add To Google Calendar"
    );
    display_field(
        $_GET['id'],
        $results->ty_calendar_ical,
        "iCal / Outlook Button Copy",
        "ty_calendar_ical",
        "This is the copy for the outlook / ical button, downloads an ICS file...",
        "Ex. Add To iCal / Outlook"
    );

    // display_field(
    // 	$_GET['id'],
    // 	$results->ics_timezone,
    // 	"ICS File Timezone",
    // 	"ics_timezone",
    // 	"This is the timezone code for your ICS (calendar) file they download, by default its set to EST time...",
    // 	"Ex. America/Toronto"
    // );

    // display_info(
    // 	"Note: Calendar ICS Timezone",
    // 	"You can find your <a href='http://unicode.org/cldr/charts/supplemental/zone_tzid.html' target='_blank'><b>timezone here</b></a><br><br>Its in written format, ie: America/Toronto (very important)..."
    // );
    ?>
</div>

<?php

// display_edit_toggle(
// 	"comments",
// 	"Text Messsage Reminder",
// 	"we_edit_ty_text"
// );

?>

<!-- <div id="we_edit_ty_text" class="we_edit_area" >
		<?php
		display_field(
			$_GET['id'],
			$results->tElem1,
			"Simple Text Field",
			"tElem1",
			"This is the title of your site. Used in the Meta Site Title and with the social media title on Facebook, etc.",
			"This is an example of a text..."
		);
		?>
	</div> -->

<?php

display_edit_toggle(
    "mobile-phone",
    "TXT Reminder Area",
    "we_edit_ty_twilio",
    "Edit the copy and settings for the TXT reminder area on the thank you page..."
);

?>

<div id="we_edit_ty_twilio" class="we_edit_area">
    <?php
    display_option(
        $_GET['id'],
        $results->txt_area,
        "Toggle TXT Notification",
        "txt_area",
        "This is wether you want to enable the TXT reminder (w/ Twilio)...",
        "Show TXT Reminder Area [on], Hide TXT Reminder Area [off]"
    );
    ?>
    <div class="txt_area" id="txt_area_on">
        <?php
        display_field(
            $_GET['id'],
            $results->txt_headline,
            "Reminder TXT Headline",
            "txt_headline",
            "This is the main headline for the TXT reminder area...",
            "Ex. Get A SMS Reminder"
        );
        display_field(
            $_GET['id'],
            $results->txt_placeholder,
            "Phone Number Input Placeholder",
            "txt_placeholder",
            "This is the placeholder text for the form they enter in their phone number...",
            "Ex. Enter In Your Mobile Phone Number..."
        );
        display_field(
            $_GET['id'],
            $results->txt_btn,
            "Remind Button Copy",
            "txt_btn",
            "This is the copy that is shown on the reminder button...",
            "Ex. Get Text Message Reminder"
        );
        display_textarea(
            $_GET['id'],
            $results->txt_reveal,
            "Thank You Copy",
            "txt_reveal",
            "This is the copy that is shown once they submit their phone number...",
            "Ex. Thanks! You will get the reminder one hour before the webinar..."
        );
        ?>
    </div>
</div>

<div class="bottomSaveArea">
    <a href="#" class="blue-btn-44 btn saveBTN saveIt" style="color:#FFF;"><i class="icon-save"></i> Save & Update</a>
</div>

</div>
