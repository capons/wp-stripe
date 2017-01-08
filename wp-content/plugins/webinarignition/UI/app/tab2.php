<div class="tabber" id="tab2" style="display: none;">

<div class="titleBar">


	<div class="titleBarText">
		<h2>Webinar Settings</h2>

		<p>Here you can edit & manage your webinar settings...</p>
	</div>

	<div class="launchConsole" style="margin-right: -20px;">
		<a href="<?php echo wi_fixPerma($data->postID); ?>preview-webinar" target="_blank"><i
				class="icon-external-link-sign"></i> Preview Webinar Page</a>
	</div>

	<br clear="all"/>

</div>

<?php

display_edit_toggle(
	"time",
	"Countdown Page - Settings & Copy",
	"we_edit_countdown",
	"<b>SEPERATE PAGE:</b> This is the settings for the countdown page... (before webinar is live)"
);

?>

<div id="we_edit_countdown" class="we_edit_area">
	<?php
	display_wpeditor(
		$_GET['id'],
		$results->cd_headline,
		"Countdown Headline",
		"cd_headline",
		"This is the copy that is shown above the countdown timer...",
		""
	);
	if ( $results->webinar_date == "AUTO" ) {
	} else {

		display_option(
			$_GET['id'],
			$results->cd_button_show,
			"Show Registration Button",
			"cd_button_show",
			"You can either show the registration button, or you can hide it.",
			"Show button [shown], Hide button [hidden]"
		);

		?>
		<div class="cd_button_show" id="cd_button_show_shown">
			<?php

			display_field(
				$_GET['id'],
				$results->cd_button_copy,
				"Register Button Copy",
				"cd_button_copy",
				"This is the copy that is shown on the button below the countdown timer...",
				"Ex. Register For The Webinar"
			);
			display_color(
				$_GET['id'],
				$results->cd_button_color,
				"Button Color",
				"cd_button_color",
				"This is the color of the button...",
				"Ex. #000000"
			);
			display_option(
				$_GET['id'],
				$results->cd_button,
				"Register Button URL",
				"cd_button",
				"You can either link to the landing page in this funnel or a custom URL",
				"Go To Landing Page [we], Custom Landing Page URL [custom]"
			);
			?>
			<div class="cd_button" id="cd_button_custom">
				<?php
				display_field(
					$_GET['id'],
					$results->cd_button_url,
					"Custom Landing Page URL",
					"cd_button_url",
					"This is a custom URL you want the button to go on the countdown page...",
					"Ex. http://yoursite.com/register-for-webinar/"
				);
				?>
			</div>
		</div>
		<?php
		display_wpeditor(
			$_GET['id'],
			$results->cd_headline2,
			"Register Headline",
			"cd_headline2",
			"This is the copy that is shown under the countdown timer, above the button...",
			""
		);

	}

	display_info(
		"Note: Countdown Page",
		"This is the page people will see if they go to the webinar page if it is not yet live..."
	);

	display_field(
		$_GET['id'],
		$results->cd_months,
		"Translate: months",
		"cd_months",
		"You can change the sub title for the count down...",
		"Ex. months"
	);

	display_field(
		$_GET['id'],
		$results->cd_weeks,
		"Translate: weeks",
		"cd_weeks",
		"You can change the sub title for the count down...",
		"Ex. weeks"
	);

	display_field(
		$_GET['id'],
		$results->cd_days,
		"Translate: Days",
		"cd_days",
		"You can change the sub title for the count down...",
		"Ex. days"
	);
	display_field(
		$_GET['id'],
		$results->cd_hours,
		"Translate: hours",
		"cd_hours",
		"You can change the sub title for the count down...",
		"Ex. hours"
	);
	display_field(
		$_GET['id'],
		$results->cd_minutes,
		"Translate: minutes",
		"cd_minutes",
		"You can change the sub title for the count down...",
		"Ex. minutes"
	);
	display_field(
		$_GET['id'],
		$results->cd_seconds,
		"Translate: seconds",
		"cd_seconds",
		"You can change the sub title for the count down...",
		"Ex. seconds"
	);

	?>
</div>

<?php

// display_tutorial(
// 	"Webinar Settings Video Tutorial:",
// 	"http://webinarignition.com/members/download-training/"
// );

display_edit_toggle(
	"cogs",
	"Webinar Info Copy",
	"we_edit_webinar_settings",
	"<b>Advance:</b> Edit the webinar information..."
);

?>

<div id="we_edit_webinar_settings" class="we_edit_area">
	<?php
	// display_field(
	// 	$_GET['id'],
	// 	$results->webinar_title,
	// 	"Webinar Title",
	// 	"webinar_title",
	// 	"This is what the title of your webinar will be called...",
	// 	"Ex. How I Rock At Webinars..."
	// );
	// display_field(
	// 	$_GET['id'],
	// 	$results->webinar_desc,
	// 	"Webinar Description",
	// 	"webinar_desc",
	// 	"This is the description of what they will learning on the webinar...",
	// 	"Ex. Learn insider trade secrets..."
	// );
	// display_field(
	// 	$_GET['id'],
	// 	$results->webinar_host,
	// 	"Webinar Host(s)",
	// 	"webinar_host",
	// 	"This is the name(s) of the host(s) of the webinar...",
	// 	"Ex. Mark Thompson & Dylan Jones"
	// );
	// display_info(
	// 		"Note: Webinar Info",
	// 		"This is also used for the META SEO settings; Site Title & Description..."
	// );
	// display_date(
	// 	$_GET['id'],
	// 	$results->webinar_date,
	// 	"Webinar Date",
	// 	"webinar_date",
	// 	"This is the day that the webinar will go live...",
	// 	"Ex. M-D-Y"
	// );
	// display_field(
	// 	$_GET['id'],
	// 	$results->webinar_start_time,
	// 	"Webinar Start Time",
	// 	"webinar_start_time",
	// 	"The time the webinar starts... <b>MUST BE IN 24 time (hour:minute): ie: 12:30</b>",
	// 	"12:30"
	// );
	// display_field(
	// 	$_GET['id'],
	// 	$results->webinar_end_time,
	// 	"Webinar End Time",
	// 	"webinar_end_time",
	// 	"The time the webinar is due to end (used for the calendars)...  <b>MUST BE IN 24 time (hour:minute): ie: 13:30</b>",
	// 	"13:30"
	// );
	// display_timezones(
	// 	$_GET['id'],
	// 	$results->webinar_timezone,
	// 	"Webinar Timezone",
	// 	"webinar_timezone",
	// 	"This is the timezone for your webinar...",
	// 	"Ex. -5"
	// );
	?>

	<?php
	// display_info(
	// 		"Note: Webinar Time - For Calendars",
	// 		"This information is used on countdown page, and for the add to calendar buttons (google calendar, ical, and outlook)..."
	// );
	display_option(
		$_GET['id'],
		$results->webinar_info_block,
		"Webinar Info Block Copy",
		"webinar_info_block",
		"You can edit what the webinar info block says, if you want to translate it...",
		"Keep Defaults [default], Translate / Edit Copy [custom]"
	);
	?>
	<div class="webinar_info_block" id="webinar_info_block_custom" style="display: none;">
		<?php
		display_field(
			$_GET['id'],
			$results->webinar_info_block_title,
			"Title Of Info Block",
			"webinar_info_block_title",
			"This is the copy shown at the top of the info block...",
			"Ex. Webinar Information"
		);
		display_field(
			$_GET['id'],
			$results->webinar_info_block_host,
			"Host Title",
			"webinar_info_block_host",
			"This is the copy that displays next to the hosts...",
			"Ex. Your Host:"
		);
		display_field(
			$_GET['id'],
			$results->webinar_info_block_eventtitle,
			"Webinar Title",
			"webinar_info_block_eventtitle",
			"This is the copy that displays next to the webinar title...",
			"Ex. Webinar Topic:"
		);
		display_field(
			$_GET['id'],
			$results->webinar_info_block_desc,
			"Webinar Description",
			"webinar_info_block_desc",
			"This is the copy that displays next to the webinar description...",
			"Ex. What You Will Learn:"
		);
		?>
	</div>
</div>

<?php
if ( $results->webinar_date == "AUTO" ) {
	display_edit_toggle(
		"play-sign",
		"Webinar Auto Video Settings",
		"we_edit_webinar_video",
		"Your live video setup settings here..."
	);
} else {
	display_edit_toggle(
		"play-sign",
		"Webinar Live Embed Video Settings",
		"we_edit_webinar_video",
		"Your live video setup settings here..."
	);
}
?>

<div id="we_edit_webinar_video" class="we_edit_area">
	<?php

	if ( $results->webinar_date == "AUTO" ) {

		display_option(
			$_GET['id'],
			$results->webinar_source_toggle,
			"Toggle Video Source",
			"webinar_source_toggle",
			"You can switch between iframe embed, or direct video source from Amazon S3, etc",
			"Default [default], Iframe [iframe]"
		);

		?>
		<div class="webinar_source_toggle" id="webinar_source_toggle_default">
			<?php

			display_field(
				$_GET['id'],
				$results->auto_video_url,
				"Webinar Video URL .MP4 *",
				"auto_video_url",
				"The MP4 file that you want to play as your automated webinar... must be in .mp4 format as its uses a html5 video player...",
				"Ex. http://yoursite.com/webinar-video.mp4"
			);

			display_field(
				$_GET['id'],
				$results->auto_video_url2,
				"Webinar Video URL .WEBM *",
				"auto_video_url2",
				"The Webm file that you want to play as your automated webinar... must be in .webm format as its uses a html5 video player... <b>Must have both formats!</b>",
				"Ex. http://yoursite.com/webinar-video.webm"
			);

			display_field(
				$_GET['id'],
				$results->auto_video_length,
				"Webinar Video Length In Minutes",
				"auto_video_length",
				"This is how long your webinar video is... <b>Must be in minutes ie:  60</b>",
				'Ex. 60'
			);

			display_field(
				$_GET['id'],
				$results->auto_video_load,
				"Webinar Video Loading Copy",
				"auto_video_load",
				"This is the text that is shown above the video as it loads...",
				'Ex. Please Wait - Webinar Is Loading...'
			);

			display_option(
				$_GET['id'],
				$results->webinar_live_overlay,
				"Video Overlay",
				"webinar_live_overlay",
				"Choose whether or not to disable video player's left and right click functionality on the live page. Enabling this option will prevent users from being able to click any of the player controls.",
				"Disabled [0], Enabled [1]"
			);

			display_color(
				$_GET['id'],
				$results->webinar_live_bgcolor,
				"Live Video Background Color",
				"webinar_live_bgcolor",
				"This is the color for the area around the video...",
				"#000000"
			);

			display_info(
				"Note: Live Embed Code",
				"This is the embed code the live streaming service gives you, it is automatically resized to fit: 920px by 518px..."

			);
            ?>
		</div>
		<div class="webinar_source_toggle" id="webinar_source_toggle_iframe">
			<?php
			display_textarea(
				$_GET['id'],
				$results->webinar_iframe_source,
				"Auto Webinar Iframe",
				"webinar_iframe_source",
				"Provide the iframe source of your video/embed code/etc",
				"Video embed code..."
			);

				display_option(
					$_GET['id'],
					$results->webinar_live_overlay,
					"Disable Video Controls",
					"webinar_live_overlay1",
					"Choose whether or not to disable video player's left and right click functionality on the live page. Enabling this option will prevent users from being able to click any of the player controls.",
					"Disabled [0], Enabled [1]"
				);
			?>
            <?php display_info(
                "Note: Iframe timed CTA issue",
                "Due to the fact that we cannot reference videos embedded in an iframe, we are unable to determine the time a video has played. Therefore, timed CTA's will not work when using embedded iframe videos."
            );
            ?>

		</div>



	<?php

	} else {
		display_option(
			$_GET['id'],
			$results->privacy_status,
			"Video Privacy Status",
			"privacy_status",
			"Choose Privacy Status for your Youtube Broadcasts",
			"Unlisted [unlisted], Public [public]"
		);
		display_textarea(
			$_GET['id'],
			$results->webinar_live_video,
			"Live Video Embed Code",
			"webinar_live_video",
			"This is the embed code for the live streaming for the webinar, can Google Hangouts, JustinTV, YouStream, etc...",
			"Live video embed code..."
		);
		display_option(
			$_GET['id'],
			$results->webinar_live_overlay,
			"Disable Video Controls",
			"webinar_live_overlay",
			"Choose whether or not to disable video player's left and right click functionality on the live page. Enabling this option will prevent users from being able to click any of the player controls.",
			"Disabled [0], Enabled [1]"
		);
		display_color(
			$_GET['id'],
			$results->webinar_live_bgcolor,
			"Live Video Background Color",
			"webinar_live_bgcolor",
			"This is the color for the area around the video...",
			"#000000"
		);
		display_info(
			"Note: Live Embed Code",
			"This is the embed code the live streaming service gives you, it is automatically resized to fit: 920px by 518px..."
		);
	}
	?>
</div>

<?php

if ( $results->webinar_date == "AUTO" ) {

	display_edit_toggle(
		"money",
		"Auto Webinar Actions",
		"we_edit_auto_actions",
		"Settings for timed actions, ending redirect and CTA popup..."
	);

	?>
	<div id="we_edit_auto_actions" class="we_edit_area">

		<?php

		display_option(
			$_GET['id'],
			$results->auto_action,
			"CTA Action",
			"auto_action",
			"Settings for the CTA to appear on the automated webinar page. Can either be shown from the start OR based on a time in the video...",
			"Always Show CTA [start], Show CTA Based On Time In Video [time]"
		);
		?>

		<div class="auto_action" id="auto_action_time">
			<?php
			display_field(
				$_GET['id'],
				$results->auto_action_time,
				"Action Time :: Minute Mark",
				"auto_action_time",
				"This is when you want your CTA are to display based on the minute mark of your video.
                Ie. when your video gets to (or passed) minute 34, it will show the CTA. <b>Minute mark should be clear like '34'.</b> ",
				"Ex. 34"
			);
			?>
		</div>

		<?php

		display_wpeditor(
			$_GET['id'],
			$results->auto_action_copy,
			"CTA Headline Copy",
			"auto_action_copy",
			"This is the copy that is shown above the main CTA button..."
		);

		display_field(
			$_GET['id'],
			$results->auto_action_btn_copy,
			"CTA Button Copy",
			"auto_action_btn_copy",
			"This is what the CTA button copy says...",
			"Ex. Click Here To Claim Your Spot"
		);

		display_field(
			$_GET['id'],
			$results->auto_action_url,
			"CTA Button URL",
			"auto_action_url",
			"This is where the button will go... <b>if you dont want the CTA button to appear, put 'off' in this area here...</b>",
			"Ex. http://yoursite.com/order-now"
		);

		display_option(
			$_GET['id'],
			$results->auto_redirect,
			"Ending Redirect",
			"auto_redirect",
			"You can have them redirect to any URL you want after the video is done playing...",
			"Disable Ending Redirect [1], Enable Ending Redirect [redirect]"
		);

		?>

		<div class="auto_redirect" id="auto_redirect_redirect">
			<?php
			display_field(
				$_GET['id'],
				$results->auto_redirect_url,
				"Ending Redirect URL",
				"auto_redirect_url",
				"This is the URL you want them to go to when the webinar is over...",
				"Ex. http://yoursite.com/order-now"
			);
			?>
		</div>

	</div>
<?php

}

display_edit_toggle(
	"picture",
	"Webinar Banner Settings",
	"we_edit_webinar_design",
	"Design settings for the top banner area..."
);

?>

<div id="we_edit_webinar_design" class="we_edit_area">
	<?php
	display_option(
		$_GET['id'],
		$results->webinar_banner_bg_style,
		"Banner Background Style",
		"webinar_banner_bg_style",
		"You can choose between a simple background color, or to have a background iamge (repeating horiztonally)",
		"Show Banner Area [show], Hide Banner Area [hide]"
	);
	?>
	<div class="webinar_banner_bg_style" id="webinar_banner_bg_style_show">
		<?php
		display_color(
			$_GET['id'],
			$results->webinar_banner_bg_color,
			"Banner Background Color",
			"webinar_banner_bg_color",
			"Choose a color for the top banner area, this will fill the entire top banner area...",
			"#FFFFFF"
		);
		?>
		<?php
		display_field_image(
			$_GET['id'],
			$results->webinar_banner_bg_repeater,
			"Banner Repeating BG Image",
			"webinar_banner_bg_repeater",
			"This is the image that is repeated horiztonally in the background of the banner area... If you leave this blank, it will just show the banner BG color... <br><br><b>best results:</b> 89px high..",
			"http://yoursite.com/banner-bg.png"
		);
		?>
		<?php
		display_field_image(
			$_GET['id'],
			$results->webinar_banner_image,
			"Banner Image URL:",
			"webinar_banner_image",
			"This is the URL for the banner image you want to be shown. By defualt it is placed in the middle, perfect for a logo... <br><br><b>best results:</b> 89px high and 960px wide...",
			"http://yoursite.com/banner-image.png"
		);
		display_info(
			"Note: Banner Image Sizing",
			"The background image (repeating) and the banner image should have the size height, so it looks good on the site, any size will work, but best is around 89px high..."
		);
		?>
	</div>
</div>

<?php

display_edit_toggle(
	"magic",
	"Webinar Background Settings",
	"we_edit_webinar_bg",
	"Design settings for the background area..."
);

?>

<div id="we_edit_webinar_bg" class="we_edit_area">
	<?php
	display_color(
		$_GET['id'],
		$results->webinar_background_color,
		"Background Color",
		"webinar_background_color",
		"This is the color for the main section, this fills the entire webinar page area...",
		"#DDDDDD"
	);
	display_field_image(
		$_GET['id'],
		$results->webinar_background_image,
		"Repeating Background Image URL",
		"webinar_background_image",
		"You can have a repeating image to be shown as the background to add some flare to your webinar page...",
		"http://yoursite.com/background-image.png"
	);
	display_info(
		"Note: Background Image",
		"If this is left blank, no background image will be shown..."
	);
	?>
</div>

<?php

display_edit_toggle(
	"comments",
	"Question / Answer Area",
	"we_edit_webinar_qa",
	"Settings for your question system - built-in or 3rd party integration..."
);

?>

<div id="we_edit_webinar_qa" class="we_edit_area">
	<?php

	display_wpeditor(
		$_GET['id'],
		$results->webinar_qa_title,
		"Q / A Headline Copy",
		"webinar_qa_title",
		"This is the copy shown above the QA System (under the webinar video)",
		""
	);

	display_option(
		$_GET['id'],
		$results->webinar_qa,
		"Q / A Type",
		"webinar_qa",
		"You can either choose from our built-in simple Q/A System, or use a 3rd party service...",
		"Simple Q/A [we], 3rd Party Service [custom], Hide Q/A [hide]"
	);
	?>
	<div class="webinar_qa" id="webinar_qa_we">
		<?php
		display_field(
			$_GET['id'],
			$results->webinar_qa_name_placeholder,
			"Name Field Placeholder",
			"webinar_qa_name_placeholder",
			"This is the placeholder copy for the name field on the Q / A system...",
			"Ex. Your Full Name..."
		);
		display_field(
			$_GET['id'],
			$results->webinar_qa_email_placeholder,
			"Email Field Placeholder",
			"webinar_qa_email_placeholder",
			"This is the placeholder copy for the email field on the Q / A system...",
			"Ex. Your Email Address..."
		);
		display_field(
			$_GET['id'],
			$results->webinar_qa_desc_placeholder,
			"Question Field Placeholder",
			"webinar_qa_desc_placeholder",
			"This is the placeholder copy for the question field on the Q / A system...",
			"Ex. Ask Your Question Here..."
		);
		display_field(
			$_GET['id'],
			$results->webinar_qa_button,
			"Submit Question Button Copy",
			"webinar_qa_button",
			"This is the copy that is shown on the button to submit the question",
			"Ex. Submit Your Question"
		);
		display_color(
			$_GET['id'],
			$results->webinar_qa_button_color,
			"Button Color",
			"webinar_qa_button_color",
			"This is the color of the button for submitting a question",
			"Ex. #000000"
		);
		display_wpeditor(
			$_GET['id'],
			$results->webinar_qa_thankyou,
			"Thank You Copy",
			"webinar_qa_thankyou",
			"This is the copy that is shown when they submit a question, shows for a 20 seconds, then QA re apears..",
			""
		);
		?>
	</div>
	<div class="webinar_qa" id="webinar_qa_custom">
		<?php
		display_textarea(
			$_GET['id'],
			$results->webinar_qa_custom,
			"Q / A Custom Code",
			"webinar_qa_custom",
			"This is the code for the live chat / QA system you want to use, this code should be provided to you by the 3rd party service...",
			"Live chat code..."
		);
		display_info(
			"Note: 3rd Party Service",
			"A great system to use is LiveFyre, it has a nice social integration, so that it creates buzz for your live webinar and for the replay webinar..."
		);
		?>
	</div>
</div>

<?php

display_edit_toggle(
	"volume-up",
	"Turn Up Speakers Copy",
	"we_edit_webinar_speaker",
	"Copy / Settings for the turn up speakers copy..."
);

?>

<div id="we_edit_webinar_speaker" class="we_edit_area">
	<?php
	display_field(
		$_GET['id'],
		$results->webinar_speaker,
		"Turn Up Speakers Copy",
		"webinar_speaker",
		"This is the copy shown at the top of the webinar reminding viewers to turn up their speakers...",
		"Ex. Turn Up Your Speakers..."
	);
	display_color(
		$_GET['id'],
		$results->webinar_speaker_color,
		"Turn Up Speakers Copy Color",
		"webinar_speaker_color",
		"This is the color of the copy fo the turn up speaker...",
		"Ex. #000000"
	);
	?>
</div>

<?php

display_edit_toggle(
	"user",
	"Invite Friends To Webinar",
	"we_edit_webinar_social",
	"Copy / Settings for inviting friends into the webinar..."
);

?>

<div id="we_edit_webinar_social" class="we_edit_area">
	<?php

	display_option(
		$_GET['id'],
		$results->social_share_links,
		"Enable / Disable Social Share Links",
		"social_share_links",
		"You can enable or disable the social share links.",
		"Disable [disabled], Enable [enabled]"
	);

	?>

	<div class="social_share_links" id="social_share_links_enabled">
		<?php
		display_field(
			$_GET['id'],
			$results->webinar_invite,
			"Invite Headline",
			"webinar_invite",
			"This is the copy the copy shown above the webinar video to invite friends to the webinar (Facebook & Twitter)...",
			"Ex. Invite Your Friends To The Webinar"
		);
		display_color(
			$_GET['id'],
			$results->webinar_invite_color,
			"Invite Headline Color",
			"webinar_invite_color",
			"This is the color of the copy fo the invite headline...",
			"Ex. #000000"
		);
		display_option(
			$_GET['id'],
			$results->webinar_fb_share,
			"Facebook Share",
			"webinar_fb_share",
			"You can turn on or off the Facebook like area...",
			"Enable [on], Disable [off]"
		);
		display_option(
			$_GET['id'],
			$results->webinar_tw_share,
			"Twitter Share",
			"webinar_tw_share",
			"You can turn on or off the Twiter like area...",
			"Enable [on], Disable [off]"
		);
		display_option(
			$_GET['id'],
			$results->webinar_gp_share,
			"Google Plus Share",
			"webinar_gp_share",
			"You can turn on or off the G+ like area...",
			"Enable [on], Disable [off]"
		);
		display_option(
			$_GET['id'],
			$results->webinar_ld_share,
			"LinkedIn Share",
			"webinar_ld_share",
			"You can turn on or off the LinkedIn like area...",
			"Enable [on], Disable [off]"
		);
		display_info(
			"Note: Social Share Messages",
			"The share social messages for the Twitter and Facebook are taken from the webinar event info; Title & Description..."
		);
		?>
	</div>

</div>

<?php

// display_edit_toggle(
// 	"phone",
// 	"Call In Number",
// 	"we_edit_webinar_callin",
// 	"Copy / Settings for the call in number (can be replaced for something else)"
// );

?>

<div id="we_edit_webinar_callin" class="we_edit_area">
	<?php
	display_option(
		$_GET['id'],
		$results->webinar_callin,
		"Webinar Call In Number",
		"webinar_callin",
		"You can hide or show the call in number if you have a number for viewers to call in and ask questions... ",
		"Enable Call Number [show], Disable Call Number [hide]"
	);
	?>
	<div class="webinar_callin" id="webinar_callin_show">
		<?php
		display_field(
			$_GET['id'],
			$results->webinar_callin_copy,
			"Call In Copy",
			"webinar_callin_copy",
			"This is the copy that is shown next to the call number...",
			"Ex. To Join Call:"
		);
		display_color(
			$_GET['id'],
			$results->webinar_callin_color,
			"Call In Phone Copy Color",
			"webinar_callin_color",
			"This is the color of the copy fo the Call In Phone headline...",
			"Ex. #000000"
		);
		display_field(
			$_GET['id'],
			$results->webinar_callin_number,
			"Call In Phone Number",
			"webinar_callin_number",
			"This is the actual number they would need to call to join in on the live call...",
			"Ex. 1-555-555-5555"
		);
		display_color(
			$_GET['id'],
			$results->webinar_callin_color2,
			"Phone Number Color",
			"webinar_callin_color2",
			"This is the color of the copy fo the Phone number...",
			"Ex. #000000"
		);
		display_info(
			"Note: Call Number",
			"Need a phone number for a conference call? Try <a href='http://freeconferencing.com/ ' target='_blank' >Free Conferencing</a>..."
		);
		?>
	</div>
</div>

<?php

// display_edit_toggle(
// 	"microphone",
// 	"Live Copy",
// 	"we_edit_webinar_live",
// 	"Copy / Settings for the 'we are live' text under the live video..."
// );

?>

<div id="we_edit_webinar_live" class="we_edit_area">
	<?php
	display_field(
		$_GET['id'],
		$results->webinar_live,
		"Live Webinar Copy",
		"webinar_live",
		"This is the copy shown under the video in green to show people the webinar is live...",
		"Ex. Webinar Is Live"
	);
	display_color(
		$_GET['id'],
		$results->webinar_live_color,
		"Live Webinar Color",
		"webinar_live_color",
		"This is the color of the copy...",
		"#000000"
	);
	?>
</div>

<?php

display_edit_toggle(
	"gift",
	"Live Give Away",
	"we_edit_webinar_giveaway",
	"Copy / Settings for the give away block... (not required)"
);

?>

<div id="we_edit_webinar_giveaway" class="we_edit_area">
	<?php

	display_option(
		$_GET['id'],
		$results->webinar_giveaway_toggle,
		"Toggle Webinar Giveaway",
		"webinar_giveaway_toggle",
		"You can hide or show the free give away block on the webinar page...",
		"Show Giveaway Block [show], Hide Giveaway Block [hide]"
	);

	?>
	<div class="webinar_giveaway_toggle" id="webinar_giveaway_toggle_show">
		<?php

		display_field(
			$_GET['id'],
			$results->webinar_giveaway_title,
			"Give Away Block Title",
			"webinar_giveaway_title",
			"This is the title for the give away block...",
			"Ex. Thank You Gift:"
		);
		display_wpeditor(
			$_GET['id'],
			$results->webinar_giveaway,
			"Give Away Copy",
			"webinar_giveaway",
			"Copy for the give away, can anything you want here..."
		);
		display_info(
			"Note: Give Away",
			"Giving people a gift for coming to the webinar is a great way to get people to join the call, give away a report, or something else of great valuable..."
		);
		?>

	</div>

</div>


<div class="bottomSaveArea">
	<a href="#" class="blue-btn-44 btn saveIt" style="color:#FFF;"><i class="icon-save"></i> Save & Update</a>
</div>

</div>
