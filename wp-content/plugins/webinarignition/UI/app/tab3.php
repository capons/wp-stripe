<div class="tabber" id="tab3" style="display: none;">

<div class="titleBar">

	<div class="titleBarIcon">
		<!-- <i class="icon-file icon-5x"></i> -->
	</div>

	<div class="titleBarText">
		<h2>Landing Page Settings:</h2>

		<p>Here you can edit & manage your webinar registration page...</p>
		<!-- <p><span class=" btn blue-btn-5" id="previews" ><a href="<?php echo get_permalink( $data->postID ); ?>" target="_blank" ><i class="icon-external-link" ></i> View Landing Page</a></span></p> -->
	</div>

	<div class="launchConsole">
		<a href="<?php echo get_permalink( $data->postID ); ?>" target="_blank"><i class="icon-external-link-sign"></i>
			Preview Registration Page</a>
	</div>

	<br clear="all"/>

</div>

<?php
// Evergreen Check
if ( $results->webinar_date == "AUTO" ) {
	// Evergreen
	display_edit_toggle(
		"calendar", "Auto Webinar Dates & Times", "we_edit_lp_auto_dates",
		"Select the dates & times for the auto webinar..."
	);
	?>
	<div id="we_edit_lp_auto_dates" class="we_edit_area">
		<?php
		display_option(
			$_GET['id'], $results->lp_schedule_type, "Webinar Schedule Type", "lp_schedule_type",
			"Choose if you want to customize the dates and times when your webinar will be available, or choose a fixed date and time.",
			"Customized [customized], Fixed [fixed], Delayed [delayed]"
		);
		?>
		<div class="lp_schedule_type" id="lp_schedule_type_customized">
			<?php
			//dates
			display_option(
				$_GET['id'], $results->auto_today, "Today - Instant Replay", "auto_today",
				"You can allow people to watch the replay right away...", "Enable [yes], Disable [no]"
			);
			display_option(
				$_GET['id'], $results->auto_monday, "Monday", "auto_monday",
				"You can choose to show this day as a possible day for the webinar, it will select the next possible occurance within the week...",
				"Enable [yes], Disable [no]"
			);
			display_option(
				$_GET['id'], $results->auto_tuesday, "Tuesday", "auto_tuesday",
				"You can choose to show this day as a possible day for the webinar, it will select the next possible occurance within the week...",
				"Enable [yes], Disable [no]"
			);
			display_option(
				$_GET['id'], $results->auto_wednesday, "Wednesday", "auto_wednesday",
				"You can choose to show this day as a possible day for the webinar, it will select the next possible occurance within the week...",
				"Enable [yes], Disable [no]"
			);
			display_option(
				$_GET['id'], $results->auto_thursday, "Thursday", "auto_thursday",
				"You can choose to show this day as a possible day for the webinar, it will select the next possible occurance within the week...",
				"Enable [yes], Disable [no]"
			);
			display_option(
				$_GET['id'], $results->auto_friday, "Friday", "auto_friday",
				"You can choose to show this day as a possible day for the webinar, it will select the next possible occurance within the week...",
				"Enable [yes], Disable [no]"
			);
			display_option(
				$_GET['id'], $results->auto_saturday, "Saturday", "auto_saturday",
				"You can choose to show this day as a possible day for the webinar, it will select the next possible occurance within the week...",
				"Enable [yes], Disable [no]"
			);
			display_option(
				$_GET['id'], $results->auto_sunday, "Sunday", "auto_sunday",
				"You can choose to show this day as a possible day for the webinar, it will select the next possible occurance within the week...",
				"Enable [yes], Disable [no]"
			);
			display_field(
				$_GET['id'], $results->auto_blacklisted_dates, "Blacklist Dates", "auto_blacklisted_dates",
				"Here you can hide certain dates or holidays...<br><br><b>The format must be Y-M-D and seperated by a comma and space.<br><br>IE: 2013-12-25, 2013-01-01</b>",
				""
			);
			//times below
			display_time_auto(
				$_GET['id'], $results->auto_time_1, "Webinar Time #1", "auto_time_1",
				"This is the first time for the auto webinar, you can have up to three times during the day, you need atleast 1 time..."
			);
			display_time_auto(
				$_GET['id'], $results->auto_time_2, "Webinar Time #2", "auto_time_2",
				"This is the first time for the auto webinar, you can have up to three times during the day, you need atleast 1 time..."
			);
			display_time_auto(
				$_GET['id'], $results->auto_time_3, "Webinar Time #3", "auto_time_3",
				"This is the first time for the auto webinar, you can have up to three times during the day, you need atleast 1 time..."
			);
			?>
		</div>
		<div class="lp_schedule_type" id="lp_schedule_type_fixed">
			<?php

			display_date(
				$_GET['id'], $results->auto_date_fixed, "Fixed Webinar Date", "auto_date_fixed",
				"Choose a fixed date for your evergreen webinar.", "Choose date"
			);

			display_time(
				$_GET['id'], $results->auto_time_fixed, "Fixed Webinar Time", "auto_time_fixed",
				"Choose a fixed time for your evergreen webinar."
			);
			display_timezone_identifiers(
				$_GET['id'], $results->auto_timezone_fixed, "Fixed Webinar Timezone", "auto_timezone_fixed",
				"Choose a timezone for your webinar.", "Select webinar timezone"
			);
			?>
		</div>
		<div class="lp_schedule_type" id="lp_schedule_type_delayed">
			<?php
			display_field(
				$_GET['id'], $results->delayed_day_offset, "Delay available registration date by", "delayed_day_offset",
				"Specify by how many days to delay the available registration date, based when the user visited the registration page.",
				"Example: 3"
			);

			// fix :: time format
			// -----------------------------------------------------------------------------------
				$uts = strtotime($results->auto_time_delayed);						// unix time stamp
				$lst = ['12h'=>date('g:i A',$uts), '24h'=>date('H:i',$uts)];	// time option list
				$opt = substr($results->time_format, 0, 3);
			// -----------------------------------------------------------------------------------

			display_time(
				$_GET['id'], $lst[$opt], "Fixed Webinar Time", "auto_time_delayed",
				"Choose a fixed time for your evergreen webinar."
			);
			display_option(
				$_GET['id'], $results->delayed_timezone_type, "Choose timezone type", "delayed_timezone_type",
				"Choose whether you want to specify a fixed timezone, or let the user sign up for a time in their timezone.",
				"Fixed [fixed], User Specific [user_specific]"
			);
			?>
			<div class="delayed_timezone_type" id="delayed_timezone_type_user_specific">
				<?php
				display_wpeditor(
					$_GET['id'], $results->auto_timezone_user_specific_name, "Your Timezone translation",
					"auto_timezone_user_specific_name",
					"Translate 'Your Timezone' text into your language.",
					""
				);
				?>
			</div>
			<div class="delayed_timezone_type" id="delayed_timezone_type_fixed">
				<?php
				display_timezone_identifiers(
					$_GET['id'], $results->auto_timezone_delayed, "Fixed Webinar Timezone", "auto_timezone_delayed",
					"Choose a timezone for your webinar.", "Select webinar timezone"
				);
				?>
			</div>
		</div>
	</div>

<?php
}
?>

<?php
display_edit_toggle(
	"edit-sign", "Translation For Months / Days / Copy", "we_edit_lp_auto_times_translate",
	"Translation options for date. times & copy..."
);
?>
<div id="we_edit_lp_auto_times_translate" class="we_edit_area">
	<?php
	display_field(
		$_GET['id'], $results->auto_translate_months, "Translate :: Months", "auto_translate_months",
		"Translation for the Months, must be in comma separated format i.e. January, February, March etc<br><Br><b>** Must be in order! (January to December)</b>",
		""
	);
	display_field(
		$_GET['id'], $results->auto_translate_days, "Translate :: Days", "auto_translate_days",
		"Translation for the Days, must be in comma separated format i.e. Monday, Tuesday, Wednesday etc<br><Br><b>** Must be in order! (Monday to Sunday)</b>",
		""
	);
	if ( $results->webinar_date == "AUTO" ) {
		display_field(
			$_GET['id'], $results->auto_translate_instant, "Translate :: Watch Replay", "auto_translate_instant",
			"This is the text that is shown if they want to watch the replay...", "Ex. Watch Replay"
		);
		display_field(
			$_GET['id'], $results->auto_translate_headline1, "Choose Date Headline", "auto_translate_headline1",
			"This is the headline text for choosing a date for the webinar...", "Ex. Choose a Date To Attend..."
		);
		display_field(
			$_GET['id'], $results->auto_translate_subheadline1, "Choose Date Sub-Headline",
			"auto_translate_subheadline1", "This is shown under the headline above...",
			"Ex. Select a date that best suits your schedule..."
		);
		display_field(
			$_GET['id'], $results->auto_translate_headline2, "Choose Time Headline", "auto_translate_headline2",
			"This is the headline text for choosing a time for the webinar...", "Ex. What Time Is Best For You?"
		);
		display_field(
			$_GET['id'], $results->auto_translate_subheadline2, "Choose Time Sub-Headline",
			"auto_translate_subheadline2", "This is shown under the headline above and shows the users local time...",
			"Ex. Your Local Time is:"
		);
	}
	?>
</div>

<?php
display_edit_toggle(
	"picture", "Banner Settings", "we_edit_lp_header_image", "Your main banner image for the landing page..."
);
?>

<div id="we_edit_lp_header_image" class="we_edit_area">
	<?php
	display_option(
		$_GET['id'], $results->lp_banner_bg_style, "Banner Background Style", "lp_banner_bg_style",
		"You can choose between a simple background color, or to have a background iamge (repeating horiztonally)",
		"Show Banner Area [show], Hide Banner Area [hide]"
	);
	?>
	<div class="lp_banner_bg_style" id="lp_banner_bg_style_show">
		<?php
		display_color(
			$_GET['id'], $results->lp_banner_bg_color, "Banner Background Color", "lp_banner_bg_color",
			"Choose a color for the top banner area, this will fill the entire top banner area...", "#FFFFFF"
		);
		?>
		<?php
		display_field_image(
			$_GET['id'], $results->lp_banner_bg_repeater, "Banner Repeating BG Image", "lp_banner_bg_repeater",
			"This is the image that is repeated horiztonally in the background of the banner area... If you leave this blank, it will just show the banner BG color... <br><br><b>best results:</b> 89px high..",
			"http://yoursite.com/banner-bg.png"
		);
		?>
		<?php
		display_field_image(
			$_GET['id'], $results->lp_banner_image, "Banner Image URL:", "lp_banner_image",
			"This is the URL for the banner image you want to be shown. By defualt it is placed in the middle, perfect for a logo... <br><br><b>best results:</b> 89px high and 960px wide...",
			"http://yoursite.com/banner-image.png"
		);
		display_info(
			"Note: Banner Sizing",
			"Your banner image size can be any height, but its best at 89px high. Also, your banner repeating graphic should be the same height..."
		);
		?>
	</div>

</div>

<?php
display_edit_toggle(
	"magic", "Background Style Settings", "we_edit_lp_bg", "Select the style of your background..."
);
?>

<div id="we_edit_lp_bg" class="we_edit_area">
	<?php
	display_color(
		$_GET['id'], $results->lp_background_color, "Background Color", "lp_background_color",
		"This is the color for the main section, this fills the entire landing page area...", "#DDDDDD"
	);
	display_field_image(
		$_GET['id'], $results->lp_background_image, "Repeating Background Image URL", "lp_background_image",
		"You can have a repeating image to be shown as the background to add some flare to your landing page...",
		"http://yoursite.com/background-image.png"
	);
	display_info(
		"Note: Background Image", "If you leave the background image blank, no bg image will be shown..."
	);
	?>
</div>

<?php
display_edit_toggle(
	"cogs", "Meta Information (Social Share Settings)", "we_edit_lp_metashare",
	"Edit your meta information used for the social sharing features..."
);
?>

<div id="we_edit_lp_metashare" class="we_edit_area">
	<?php
	display_field(
		$_GET['id'], $results->lp_metashare_title, "Meta Site Title", "lp_metashare_title",
		"This is your site title - this will be used as the main headline for social shares...",
		"Ex. Amazing Webinar Training!"
	);

	display_field(
		$_GET['id'], $results->lp_metashare_desc, "Meta Description", "lp_metashare_desc",
		"This is your site description - this will be used as the main copy for social shares...",
		"Ex. Check out this awesome training, this is a one time webinar!"
	);

	display_field(
		$_GET['id'], $results->ty_share_image, "Social Share Image URL", "ty_share_image",
		"This is the image that is used with the social shares, for best results, keep it: 120px by 120px..",
		"Ex. http://yoursite.com/share-image.png"
	);
	?>
</div>

<?php
display_edit_toggle(
	"edit-sign", "Main Headline", "we_edit_lp_headline", "Copy for the main headline on the landing page..."
);
?>

<div id="we_edit_lp_headline" class="we_edit_area">
	<?php
	display_wpeditor(
		$_GET['id'], $results->lp_main_headline, "Main Headline", "lp_main_headline",
		"This appears above the main optin area. This should really get people excited for your event, so they really want to be there...",
		""
	);
	?>
</div>

<?php
display_edit_toggle(
	"film", "CTA Area - Video / Image Settings", "we_edit_lp_cta_area",
	"The core CTA area, which can be a video or an image..."
);
?>

<div id="we_edit_lp_cta_area" class="we_edit_area">
	<?php
	display_color(
		$_GET['id'], $results->lp_cta_bg_color, "CTA Area Background Color", "lp_cta_bg_color",
		"This is the color for the CTA area that video or image is displayed, a good contrast color will get a lot of attention for this area...",
		"#000000"
	);

	display_info(
		"Note: CTA BG Color", "This is also used for the thank you page for the CTA area there..."
	);

	display_option(
		$_GET['id'], $results->lp_cta_type, "CTA Type:", "lp_cta_type",
		"You can choose to display a video embed code or have an image to be shown here. A video will get higher results...",
		"Show Video [video], Show Image [image]"
	);
	?>
	<div class="lp_cta_type" id="lp_cta_type_video">
		<?php
		display_textarea(
			$_GET['id'], $results->lp_cta_video_code, "Video Embed Code", "lp_cta_video_code",
			"This is your video embed code. Your video will be auto-resized to fit the area which is <b>500px width and 281px height</b> <Br><br>EasyVideoPlayer users must resize their video manually...",
			"Ex. Youtube embed code, Vimeo embed code, etc"
		);
		display_info(
			"Note: Video Size",
			"The video will auto-resized, but its best you have a video with the same aspect ratio of 500x281..."
		);
		?>
	</div>

	<div class="lp_cta_type" id="lp_cta_type_image" style="display: none;">
		<?php
		display_field_image(
			$_GET['id'], $results->lp_cta_image, "CTA Image URL", "lp_cta_image",
			"This is the image that will be shown in the main cta area, this image will be resized to fit the area: <b>500px width and 281px height</b>...",
			"http://yoursite.com/cta-image.png"
		);
		display_info(
			"Note: CTA Image", "For the best results, make sure your CTA image is 500 wide..."
		);
		?>
	</div>

</div>

<?php
display_edit_toggle(
	"edit-sign", "Sales Copy", "we_edit_lp_sales_copy",
	"The main landing page copy that appears under the CTA video / image area..."
);
?>

<div id="we_edit_lp_sales_copy" class="we_edit_area">
	<?php
	display_field(
		$_GET['id'], $results->lp_sales_headline, "Sales Copy Headline", "lp_sales_headline",
		"This is the copy that is shown above the sales copy for the landing page, it has a background color to make it pop on the page...",
		"Ex. What You Will Learn On The Webinar..."
	);
	display_color(
		$_GET['id'], $results->lp_sales_headline_color, "Sales Copy Headline BG Color", "lp_sales_headline_color",
		"This is the background color for the headline area... Make it a color that stands out on the page. The sales copy headline will always be white, so make sure this color works well with white text...",
		"#0496AC"
	);
	display_info(
		"Note: Headline BG Color", "This color will also be used in the thank you page for the step headlines..."
	);
	display_wpeditor(
		$_GET['id'], $results->lp_sales_copy, "Main Sales Copy", "lp_sales_copy",
		"This is the main sales copy that is shown under the CTA area and sales headline. This is where you can explain all the finer details about the webinar...",
		""
	);
	display_info(
		"Note: Sales Copy",
		"This is shown below the video area, you can have the main bits of what they will learn on the webinar here..."
	);
	?>
</div>

<?php
display_edit_toggle(
	"edit-sign", "Optin Headline", "we_edit_lp_optin_headline", "The headline that appears over the optin area..."
);
?>

<div id="we_edit_lp_optin_headline" class="we_edit_area">
	<?php
	display_wpeditor(
		$_GET['id'], $results->lp_optin_headline, "Optin Headline", "lp_optin_headline",
		"This is shown on the right hand side of the page above the webinar date...", ""
	);
	?>
</div>

<?php
if ( $data->camtype == "auto" ) {

} else {

	display_edit_toggle(
		"calendar", "Optin Webinar Date", "we_edit_lp_optin_date", "Dates / Copy for the landing page..."
	);
}
?>

<div id="we_edit_lp_optin_date" class="we_edit_area">
	<?php
	display_field(
		$_GET['id'], $results->lp_webinar_month, "Webinar Month", "lp_webinar_month",
		"This is shown in the calendar icon, in the top red area...", "Ex. MAY"
	);
	display_field(
		$_GET['id'], $results->lp_webinar_day, "Webinar Day", "lp_webinar_day",
		"This is shown in the calendar icon in the main area, this should just be the date...", "Ex. 23"
	);
	display_field(
		$_GET['id'], $results->lp_webinar_headline, "Webinar Date Headline", "lp_webinar_headline",
		"This is the text displayed next to the calendar, ideal for restating the date again...", "Ex. Thursday 23rd"
	);
	display_field(
		$_GET['id'], $results->lp_webinar_subheadline, "Webinar Date Sub Headline", "lp_webinar_subheadline",
		"This is shown under the headline above, ideal for stating the time of the webinar...",
		"at 5pm Eastern, 2pm Pacific"
	);
	display_info(
		"Note: Webinar Date",
		"This does not inherit the info from the webinar, because it is styled differently, this gives you more freedom on how you present the info to the user..."
	);
	?>
</div>

<?php
display_edit_toggle(
	"user", "Webinar Host Info", "we_edit_lp_host", "Information about the webinar host, Photo & Text..."
);
?>

<div id="we_edit_lp_host" class="we_edit_area" style="display: none;">
	<?php
	display_option(
		$_GET['id'], $results->lp_webinar_host_block, "Banner Background Style", "lp_webinar_host_block",
		"You can choose to show or hide the webinar host info block...",
		"Show Host Info Area [show], Hide Host Info Area [hide]"
	);
	?>
	<div class="lp_webinar_host_block" id="lp_webinar_host_block_show">

		<?php
		display_field_image(
			$_GET['id'], $results->lp_host_image, "Webinar Host Photo URL", "lp_host_image",
			"This is the image for the person hosting the webinar, this is shown under the optin area... <b>best results: 100px wide and  100px high</b>",
			"http://yoursite.com/webinar-host.png"
		);

		display_textarea(
			$_GET['id'], $results->lp_host_info, "Webinar Host Info", "lp_host_info",
			"This is the text that is show on the right side of the webinars host photo. This should tell the visitor who the host is and why they should listen them...(html allowed ie. <b>bold tags</b>)",
			""
		);
		?>

	</div>

</div>

<?php
display_edit_toggle(
	"money", "Paid Webinar", "we_edit_lp_paid", "Require payment to sign up & view webinar.."
);
?>
<div id="we_edit_lp_paid" class="we_edit_area">
	<?php

	display_option(
		$_GET['id'],
		$results->paid_status,
		"Paid Status",
		"paid_status",
		"Choose to make it a free webinar, or a paid webinar...",
		"Free Webinar [free], Paid Webinar [paid]"
	);

	?>
	<div class="paid_status" id="paid_status_paid" style="display: none;">
		<?php
		display_wpeditor(
			$_GET['id'],
			$results->paid_headline,
			"Pay Headline",
			"paid_headline",
			"This is the headline that is above the order button..."
		);


		display_wpeditor(
			$_GET['id'],
			$results->payment_form,
			"Payment Form",
			"payment_form",
			"This is the form users will enter their payment details in (for Stripe). Ensure it is pasted in as 'Text'... <br><br>
                        <a href='http://webinarignition.com/docs/stripe_setup.pdf' target='_blank' ><b>Stripe Setup Tutorial</b></a>"
		);

		display_option(
			$_GET['id'],
			$results->paid_button_type,
			"Order Button Type",
			"paid_button_type",
			"Choose order button type, can be default or custom code.",
			"Default [default], Custom [custom]"
		);
		?>
		<div class="paid_button_type" id="paid_button_type_custom" style="display: none;">
			<?php
			display_textarea(
				$_GET['id'], $results->paid_button_custom,
				"Raw HTML Version Of Your Optin Code:",
				"paid_button_custom",
				"This is the custom code for your order button. Can be shortcode.",
				"This is the custom code for your order button. Can be shortcode."
			);
			?>
		</div>
		<div class="paid_button_type" id="paid_button_type_default" style="display: none;">
			<?php
			display_field(
				$_GET['id'],
				$results->paid_btn_copy,
				"Order Button Copy",
				"paid_btn_copy",
				"This is the copy that is displayed on the order button...",
				"Order Now!"
			);

			display_field(
				$_GET['id'],
				$results->stripe_secret_key,
				"Stripe Secret Key",
				"stripe_secret_key",
				"Set your Secret Key: remember to change this to your Live Secret Key in production. Get your keys here https://dashboard.stripe.com/account/apikeys",
				"Stripe Secret Key"
			);


			display_field(
				$_GET['id'],
				$results->stripe_publishable_key,
				"Stripe Publishable Key",
				"stripe_publishable_key",
				"Set your Publishable Key: remember to change this to your Live Publishable Key in production. Get your keys here https://dashboard.stripe.com/account/apikeys",
				"Stripe Publishable Key"
			);

			display_field(
				$_GET['id'],
				$results->stripe_charge,
				"Charge",
				"stripe_charge",
				"Your charge (in US cents; for Stripe payment only)",
				"Ex: 12000"
			);

			display_field(
				$_GET['id'],
				$results->stripe_charge_description,
				"Stripe Charge Description",
				"stripe_charge_description",
				"Your charge descrfiption(for Stripe payment only)",
				"Charge for amazing webinar"
			);

			display_color(
				$_GET['id'],
				$results->paid_btn_color,
				"Order button color...",
				"paid_btn_color",
				"This is the color of the order button...",
				"#000000"
			);
			?>
		</div>
		<?php
		display_field(
			$_GET['id'],
			$results->paid_pay_url,
			"Payment Checkout URL",
			"paid_pay_url",
			"This is the URL for your payment page, check out page for Paypal, 1shoppingcart, etc...",
			"http://paypal.com/order-product"
		);
		display_field(
			$_GET['id'],
			! empty( $results->paid_code ) ? $results->paid_code : ( $paid_code = wi_generate_key( 32 ) ),
			"Secret Paid Code",
			"paid_code",
			"This is the secret code used to verify that people returning from a successful payment are presented the webinar.<br/>" .
			"<strong>Do not edit this code after people started paying for your webinar, or they won't be able to access your webinar anymore!</strong>",
			""
		);
		display_field(
			$_GET['id'],
			get_permalink( $data->postID ) . "?" . ( isset( $paid_code ) ? $paid_code : $results->paid_code ),
			"Thank You Page URL",
			"paid_thank_you_url",
			"This is the url that you take people who purchased the webinar so they can sign up...",
			""
		);
		display_field(
			$_GET['id'],
			get_permalink( $data->postID ) . "?live&" . md5( ( isset( $paid_code ) ? $paid_code : $results->paid_code ) ),
			"Paid Webinar URL",
			"paid_webinar_url",
			"This is the new webinar live URL webinar - only paid members should know this URL...",
			""
		);
		?>
		<script src="//crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/md5.js"></script>
		<script>
			jQuery(document).ready(function ($) {
				var $thank_you_url = $('#paid_thank_you_url'),
					$webinar_url = $('#paid_webinar_url');
				$thank_you_url.add($webinar_url).attr('readonly', 'readonly').click(function () {
					$(this).select();
				});
				$('#paid_code').bind('change keyup', function () {
					$thank_you_url.val('<?php echo get_permalink($data->postID) . "?"; ?>' + $(this).val());
					$webinar_url.val('<?php echo get_permalink($data->postID) . "?live&"; ?>' + CryptoJS.MD5($(this).val()));
				});
			});
		</script>
	</div>
</div>

<?php
display_edit_toggle(
	"cog", "Optin Form Creator / AR Integration", "we_edit_lp_ar", "Setup your integration with your Auto-Responder"
);
?>

<div id="we_edit_lp_ar" class="we_edit_area">
<?php
if ( $results->webinar_date !== "AUTO" ) {
	display_option(
		$_GET['id'], $results->lp_fb_button, "Facebook Connect Button", "lp_fb_button",
		"You can choose to use the Facebook connect button, by default its not shown, and if you do enable it, you must setup the FB connect settings in order for it to work...",
		"Disable - FB Connect [hide], Enable - FB Connect [show]"
	);
}
?>
<div class="lp_fb_button" id="lp_fb_button_show" style="display: none;">
	<?php
	display_field(
		$_GET['id'], $results->fb_id, "Facebook App ID", "fb_id", "This is your FB App ID", "Get From Facebook App..."
	);

	display_field(
		$_GET['id'], $results->fb_secret, "Facebook App Secret", "fb_secret", "This is your FB App Secret",
		"Get From Facebook App..."
	);

	display_field(
		$_GET['id'], $results->lp_fb_copy, "Facebook Connect Button Copy", "lp_fb_copy",
		"This is the text that is shown on the Facebook Connect sign up button...", "Ex. Register With Facebook"
	);
	display_field(
		$_GET['id'], $results->lp_fb_or, "Custom Copy 'OR'", "lp_fb_or",
		"You can the copy for the copy displayed under the FB connect button...", "Ex. OR"
	);
	display_info(
		"Note: FB Button",
		"You will need to make sure you setup the FB Connect info, it is editable at the bottom of this page..."
	);
	?>
</div>

<?php
display_textarea(
	$_GET['id'], $results->ar_code, "Raw HTML Version Of Your Optin Code:", "ar_code", "This should be the raw html version of the optin code your AR service provides you...<br><br>
		<a href='http://webinarignition.com/docs/AR_aweber.pdf' target='_blank' ><b>Aweber Integration Tutorial</b></a><br><br>
		<a href='http://webinarignition.com/docs/AR_mailchimp.pdf' target='_blank' ><b>MailChimp Integration Tutorial</b></a>",
	"The RAW html form code given to you by your AR service..."
);


?>
<div class="editSection section--ar_fields">
	<div id="ar_templates" class="hidden">
		<div class="available-fields">
			<li class="wi-form-field wi-form-field--available">
				<span class="wi-field-add" data-hidden="false" data-name="">add</span>
				{field_name}
			</li>
			<li class="wi-form-field wi-form-field--hidden">
				<span class="wi-field-add" data-hidden="true" data-names="">add</span>
				{field_names}
			</li>
		</div>
		<div class="labels">
			<input type="hidden" class="ar_name" value="Full Name / First Name"/>
			<input type="hidden" class="ar_lname" value="Last Name"/>
			<input type="hidden" class="ar_email" value="Email"/>
			<input type="hidden" class="ar_phone" value="Phone"/>
		</div>
		<div class="label_names">
			<input type="hidden" class="ar_name" value="lp_optin_name"/>
			<input type="hidden" class="ar_lname" value="lp_optin_lname"/>
			<input type="hidden" class="ar_email" value="lp_optin_email"/>
			<input type="hidden" class="ar_phone" value="lp_optin_phone"/>
		</div>
		<div class="form-builder">
			<li class="wi-form-fieldblock">
				<div class="field-block--table">
					<div class="field-block field-block--cell">
						<small class="sublabel">Field Type:</small>
						<input type="text" class="fieldblock field__ar-label" value="" disabled="disabled"/>
					</div>
					<div class="field-block field-block--cell">
						<small class="sublabel">Map to (AR Form Field):</small>
						<select class="fieldblock field__ar-mapping">
							<option value="">* Not mapped</option>
						</select>
					</div>
				</div>
				<div class="field-block">
					<small class="sublabel">Field label / placeholder:</small>
					<input class="fieldblock field__label" type="text"/>
				</div>
				<div class="field__actions">
					<a href="#" class="field__action js_fieldblock-move field__action--move">Order</a>
					<a href="#" class="field__action js__fieldblock-remove field__action--remove">Remove</a>
				</div>
				<div class="hidden">
					<input type="hidden" class="field__label-name"/>
					<input type="hidden" class="field__ar-name"/>
				</div>
			</li>
		</div>
		<div class="form-builder-hidden-field">
			<div class="field-block--table field-group">
				<div class="field-block field-block--cell">
					<small class="sublabel">Field name:</small>
					<input type="text" class="fieldblock fieldblock__name" value=""/>
				</div>
				<div class="field-block field-block--cell">
					<small class="sublabel">Field value:</small>
					<input type="text" class="fieldblock fieldblock__value" value=""/>
				</div>
			</div>
		</div>
	</div>
	<section class="wi wi__ar_section extracted-form_fields">
		<h2>Available Fields</h2>

		<div class="wi-form-field">
			<span class="wi-field-set js__set-form-options">set</span>
			Set Action URL and Method from raw html
		</div>
		<div class="wi-form-field">
			<span class="wi-field-add" data-hidden="false" data-name="ar_name">add</span>
			Full Name / First Name field
		</div>
		<div class="wi-form-field">
			<span class="wi-field-add" data-hidden="false" data-name="ar_lname">add</span>
			Last Name field
		</div>
		<div class="wi-form-field">
			<span class="wi-field-add" data-hidden="false" data-name="ar_email">add</span>
			Email field
		</div>
		<div class="wi-form-field">
			<span class="wi-field-add" data-hidden="false" data-name="ar_phone">add</span>
			Phone field
		</div>
		<ul id="wi-available-fields" class="content"></ul>
		<div id="ar_available_mappings" class="hidden" data-mappings=""></div>
		<div class="clear"></div>
	</section>
	<section class="wi wi__ar_section form_builder">
		<h2>Form Builder</h2>

		<div class="field-block--table">
			<div class="field-block field-block--cell field-block--form-action">
				<label for="ar_url">Form Action URL:</label>
				<input type="text" id="ar_url"/>
			</div>
			<div class="field-block field-block--cell field-block--form-method">
				<label for="ar_method">Form Method:</label>
				<select id="ar_method">
					<option value="post">POST</option>
					<option value="get">GET</option>
				</select>
			</div>
		</div>
		<div class="field-block">
			<label>Form Fields:</label>
			<ul id="wi-form-builder" class="wi-form-builder"></ul>

			<!--<label>Hidden Fields:</label>-->

			<div class="wi-form-fields--hidden hidden">
				<div id="wi-form-hidden-fields" class="fieldblock__content"></div>
				<div class="field__actions">
					<a href="#" class="field__action js__fieldblock-remove field__action--remove">Remove Hidden
						Fields</a>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</section>
	<div id="ar-settings" class="hidden ar-integration-settings">
		<?php
		$_props = array(
			'ar_url',
			'ar_method',
			'ar_name',
			'ar_lname',
			'ar_phone',
			'ar_email',
			'ar_hidden',
			'lp_optin_name',
			'lp_optin_lname',
			'lp_optin_email',
			'lp_optin_phone',
			'ar_fields_order'
		);
		foreach ( $_props as $_prop ) {
			if ( ! empty( $results->$_prop ) ) {
				if ( ! is_array( $results->$_prop ) ) {
					?>
					<input type="hidden" name="<?php echo $_prop; ?>"
					       value="<?php echo htmlentities( $results->$_prop, ENT_QUOTES, "UTF-8" ); ?>"/>
				<?php
				} else {
					foreach ( $results->$_prop as $_key => $_val ) {
						?>
						<input type="hidden" name="<?php echo $_prop; ?>[<?php echo $_key; ?>]"
						       value="<?php echo htmlentities( $_val, ENT_QUOTES, "UTF-8" ); ?>"/>
					<?php
					}
				}
			}
		}
		?>
	</div>
</div>

<?php


// fix :: ar integration test
// --------------------------------------------------------------------------------------
	display_info
	(
	   "AR Integrartion Help", "Use the button below to test your AR Integration setup."
	   .'<div style="margin-top:6px;display: inline-block" id="wi_test_ar" class="grey-btn">'
		.'Save & Test AR Integration</div>'
	);
?>
  <script type="text/javascript">
      jQuery(document).ready(function ($)
      {
         $('#wi_test_ar').click(function ()
         {
            $trigger = $(this);
            var bkpHtm = $trigger.html();
            $trigger.html('Saving...');

            wi_saveIt
            (
               function()
               {
                  $trigger.html(bkpHtm);

				      modal
				      ({
				         name: $trigger.id+'_modal',
				         head: 'AR Integration Test',
				         body: '<div style="width:100%; height:100%; padding:16px; overflow:auto">'+
				                  '<b>'+
				                     'In order to test your AR integration setup, these steps may help:<br><br>'+
				                  '</b>'+
				                     '<li>Click the <b>test button</b> below.</li>'+
				                     '<li>In the new window, fill in the registration form with dummy info for testing, then click <b>register</b>.</li>'+
				                     '<li>The modal (window) that opens up shows the response from your AR provider.</li>'+
				                     '<li>Read the response to determine if the lead was successfully added.</li>'+
				                     '<li>If all went well, you\'re registered for the webinar and you\'re now also in your autoresponder list - well done!</li>'+
				                '</div>',
				         foot:
				         {
				            test:function()
				            {
				               window.open("<?php echo wi_fixPerma($data->postID); ?>artest=1");
				            },

				            done:function(){ modal.exit(); }
				         }
				      });
               }
            );
         });
      });
  </script>
<?php
// --------------------------------------------------------------------------------------


display_option(
	$_GET['id'], $results->lp_optin_button, "Optin Button Style", "lp_optin_button",
	"You can choose between our optin button or your own custom image optin button...",
	"CSS Button [color], Custom Image Button [image]"
);
?>

<div class="lp_optin_button" id="lp_optin_button_color">
	<?php
	display_color(
		$_GET['id'], $results->lp_optin_btn_color, "Optin Button Color", "lp_optin_btn_color",
		"This is the color you want the optin button to be... by default it will be green...", "#74BB00"
	);
	?>
</div>


	<div class="lp_optin_button" id="lp_optin_button_image" style="display:none;">
	<?php
	display_field_image(
		$_GET['id'], $results->lp_optin_btn_image, "Custom Button Image URL", "lp_optin_btn_image",
		"This is the url for your custom optin button, for best results, it should be 327px wide...",
		"http://yoursite.com/custom-optin-image.png"
	);
	?>
</div>
<?php
display_field(
	$_GET['id'], $results->lp_optin_btn, "Optin Button Copy", "lp_optin_btn",
	"This is the text that is shown on the optin button...", "Ex. Register For The Webinar"
);
display_field(
	$_GET['id'], $results->lp_optin_spam, "Optin Spam Notice", "lp_optin_spam",
	"This is the spam notice that is shown under the optin area... Helps a lot for conversion rates...",
	"Ex. * we will not spam, sell, rent, or lease your information *"
);

display_wpeditor(
	$_GET['id'], $results->lp_optin_closed, "Optin Closed Message", "lp_optin_closed",
	"This is message displayed when the webinar registration is closed.",
	""
);


if ( $results->webinar_date !== "AUTO" ) {
	display_option(
		$_GET['id'],
		$results->custom_ty_url_state,
		"Thank You URL",
		"custom_ty_url_state",
		"You can choose to keep default WebinarIgnition confirmation page, or redirect users to a custom URL.",
		"Keep Default [hide], Custom URL [show]"
	);
}
?>
<div class="custom_ty_url_state" id="custom_ty_url_state_show" style="display: none;">
	<?php
	display_field(
		$_GET['id'], $results->custom_ty_url, "Custom Thank You URL", "custom_ty_url",
		"Instead of redirecting the user to the WebinarIgnition confirmation page, the user will be redirected to a custom thank you page that you define here.",
		"http://google.com"
	);
	?>
</div>
</div>

<div class="bottomSaveArea">
	<a href="#" class="blue-btn-44 btn saveIt" style="color:#FFF;"><i class="icon-save"></i> Save & Update</a>
</div>

</div>
