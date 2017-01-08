<div class="tabber" id="tab6" style="display: none;">

<div class="titleBar">
    <h2>Extra Settings:</h2>

    <p>Here you can manage the extra bits of your campaign like the footer, and custom JS/CSS...</p>
</div>

<?php

display_edit_toggle(
    "edit-sign",
    "Time & Date",
    "we_edit_time_date",
    "Time & Date settings"
);
?>

<div id="we_edit_time_date" class="we_edit_area">
    <?php
    display_option(
        $_GET['id'],
        $results->time_format,
        "Time Format",
        "time_format",
        "Choose time format",
        "12 Hour [12hour], 24 Hour [24hour]"
    );

    display_field(
        $_GET['id'],
        $results->time_suffix,
        "Time Suffix",
        "time_suffix",
        "String appended to time string",
        ""
    );
    ?>
</div>

<?php
display_edit_toggle(
    "edit-sign",
    "Footer Settings",
    "we_edit_footer_settings",
    "Footer Settings - Copy & Affiliate Link"
);
?>

<div id="we_edit_footer_settings" class="we_edit_area">
    <?php
    display_wpeditor(
        $_GET['id'],
        $results->footer_copy,
        "Footer Copy",
        "footer_copy",
        "This is the copy that is shown on all the pages in your funnell..."
    );
    display_option(
        $_GET['id'],
        $results->footer_branding,
        "WebinarIgnition Footer Branding",
        "footer_branding",
        "You can optionally show the branding of WebinarIgnition on the footer...",
        "Show Branding [show], Hide Branding [hide]"
    );
    ?>
    <div class="footer_branding" id="footer_branding_show">
        <?php
        display_field(
            $_GET['id'],
            $results->footer_branding_copy,
            "Branding Copy",
            "footer_branding_copy",
            "This is what the link says for WebinarIgnition to your affiliate link...",
            "Ex. Powered By WebinarIngition"
        );
        display_field(
            $_GET['id'],
            $results->footer_branding_url,
            "Your Affiliate Link",
            "footer_branding_url",
            "This your affiliate link if you want to earn money from this branding...",
            "Ex. Your Affiliate Link"
        );
        display_info(
            "Note: Affiliate Link",
            "You can sign up for an affiliate link <a href='http://webinarignition.com/jv' target='_blank' ><b>here</b></a>"
        );
        ?>
    </div>

</div>

<?php
if ($results->webinar_date == "AUTO") {
    // no show
} else {
    display_edit_toggle(
        "edit-sign",
        "Raw Optin Form Code -- 3rd Party Integration",
        "we_edit_raw_optin",
        "This is a raw optin form that you can use to integrate this webinar with other landing pages / plugins... adv. users"
    );
}
?>

<div id="we_edit_raw_optin" class="we_edit_area">

    <div class="editSection">

        <div class="inputTitle">
            <div class="inputTitleCopy">Raw Optin Code</div>
            <div class="inputTitleHelp">Integrate this page into a 3rd party page...</div>
        </div>

        <div class="inputSection">
            <?php
            $full_path2 = get_site_url();
            $assets2    = $full_path2 . "/wp-content/plugins/webinarignition/inc/lp/";

            $RAWFORMS  = 'Full Name: <input type="text" name="name"><br>
  						 Best Email: <input type="text" name="email"><br>
  						 <input type="hidden" name="campaignID" value="' . $_GET["id"] . '" >
  						 <input type="submit" value="Register For Webinar">';
            $RAWARCODE = '<form action="' . WEBINARIGNITION_URL . 'inc/lp/posted.php" method="post">' . $RAWFORMS . '</form>';
            ?>

            <textarea name="<?php echo $results->raw_optin_code; ?>" placeholder=""
                      id="<?php echo $results->raw_optin_code; ?>"
                      class="inputTextarea elem"><?php echo $RAWARCODE; ?></textarea>
        </div>
        <br clear="left">

    </div>

    <?php
    display_info(
        "Note: Raw Optin Code",
        "This code can be used to integrate with other landing pages like OptimizePress, ListEruption, etc. <br><br>
				When someone enters the form they get added to the webinar here, if you have sendgrid connected, they get an email and added to your sendgrid list. If you have an AR connected, they will also be added to the AR you setup.<br><br>
				<b>** Note: Only <u>NAME & EMAIL</u> Are sent Over ** Your optin code must not require other fields to work properly or this may not work...</b>"
    );
    ?>

</div>


<?php
display_edit_toggle(
    "cog",
    "Custom Landing Page Settings (JS / CSS) ",
    "we_edit_custom_lp",
    "You can add custom Javascript OR CSS For Your Landing Page..."
);
?>

<div id="we_edit_custom_lp" class="we_edit_area">
    <?php
    display_textarea(
        $_GET['id'],
        $results->custom_lp_js,
        "Custom JS",
        "custom_lp_js",
        "This is an area for custom JS code you can add to the page, displayed in the HEAD tag...",
        " "
    );
    display_textarea(
        $_GET['id'],
        $results->custom_lp_css,
        "Custom CSS",
        "custom_lp_css",
        "This is an area for custom CSS code you can add to the page...",
        ""
    );
    ?>
</div>

<?php
display_edit_toggle(
    "info-sign",
    "META Info - THANK YOU PAGE",
    "we_edit_lp_meta_info2",
    "Custom Meta Information for your thank you page (will fall back to landing page meta info)..."
);
?>

<div id="we_edit_lp_meta_info2" class="we_edit_area">

    <?php
    display_field(
        $_GET['id'],
        $results->meta_site_title_ty,
        "Site Title",
        "meta_site_title_ty",
        "This is the META Site Title",
        "Ex: Awesome Webinar Training"
    );

    display_field(
        $_GET['id'],
        $results->meta_desc_ty,
        "Site Description",
        "meta_desc_ty",
        "This is the META Description",
        "Ex: On This Webinar You Will Learn Amazing Things..."
    );
    ?>

</div>

<?php
display_edit_toggle(
    "cog",
    "Custom Thank You Page Settings (JS / CSS) ",
    "we_edit_custom_ty",
    "Edit your custom Javascript OR CSS for your thank you page..."
);
?>

<div id="we_edit_custom_ty" class="we_edit_area">
    <?php
    display_textarea(
        $_GET['id'],
        $results->custom_ty_js,
        "Custom JS",
        "custom_ty_js",
        "This is an area for custom JS code you can add to the page, displayed in the HEAD tag...",
        ""
    );
    display_textarea(
        $_GET['id'],
        $results->custom_ty_css,
        "Custom CSS",
        "custom_ty_css",
        "This is an area for custom CSS code you can add to the page...",
        ""
    );
    ?>
</div>

<?php
display_edit_toggle(
    "info-sign",
    "META Info - WEBINAR PAGE",
    "we_edit_lp_meta_info3",
    "Custom Meta Information for your webinar page (will fall back to landing page meta info)..."
);
?>

<div id="we_edit_lp_meta_info3" class="we_edit_area">

    <?php
    display_field(
        $_GET['id'],
        $results->meta_site_title_webinar,
        "Site Title",
        "meta_site_title_webinar",
        "This is the META Site Title",
        "Ex: Awesome Webinar Training"
    );

    display_field(
        $_GET['id'],
        $results->meta_desc_webinar,
        "Site Description",
        "meta_desc_webinar",
        "This is the META Description",
        "Ex: On This Webinar You Will Learn Amazing Things..."
    );
    ?>

</div>

<?php
display_edit_toggle(
    "cog",
    "Custom Webinar Page Settings (JS / CSS) ",
    "we_edit_custom_webinar",
    "Edit custom Javascript OR CSS for your webinar page..."
);
?>

<div id="we_edit_custom_webinar" class="we_edit_area">
    <?php
    display_textarea(
        $_GET['id'],
        $results->custom_webinar_js,
        "Custom JS",
        "custom_webinar_js",
        "This is an area for custom JS code you can add to the page, displayed in the HEAD tag...",
        ""
    );
    display_textarea(
        $_GET['id'],
        $results->custom_webinar_css,
        "Custom CSS",
        "custom_webinar_css",
        "This is an area for custom CSS code you can add to the page...",
        ""
    );
    ?>
</div>

<?php
display_edit_toggle(
    "info-sign",
    "META Info - REPLAY PAGE",
    "we_edit_lp_meta_info32",
    "Custom Meta Information for your replay page (will fall back to landing page meta info)..."
);
?>

<div id="we_edit_lp_meta_info32" class="we_edit_area">

    <?php
    display_field(
        $_GET['id'],
        $results->meta_site_title_replay,
        "Site Title",
        "meta_site_title_replay",
        "This is the META Site Title",
        "Ex: Awesome Webinar Training"
    );

    display_field(
        $_GET['id'],
        $results->meta_desc_replay,
        "Site Description",
        "meta_desc_replay",
        "This is the META Description",
        "Ex: On This Webinar You Will Learn Amazing Things..."
    );
    ?>

</div>

<?php
display_edit_toggle(
    "cog",
    "Custom Replay Page Settings (JS / CSS) ",
    "we_edit_custom_replay",
    "Edit your custom Javascript OR CSS for your replay page..."
);
?>

<div id="we_edit_custom_replay" class="we_edit_area">
    <?php
    display_textarea(
        $_GET['id'],
        $results->custom_replay_js,
        "Custom JS",
        "custom_replay_js",
        "This is an area for custom JS code you can add to the page, displayed in the HEAD tag...",
        ""
    );
    display_textarea(
        $_GET['id'],
        $results->custom_replay_css,
        "Custom CSS",
        "custom_replay_css",
        "This is an area for custom CSS code you can add to the page...",
        ""
    );
    ?>
</div>

<?php
display_edit_toggle(
    "cog",
    "Webinar Settings",
    "we_footer_code",
    "Global Webinar Settings"
);
?>

<div id="we_footer_code" class="we_edit_area">
    <?php
    display_textarea(
        $_GET['id'],
        $results->footer_code,
        "Footer Code",
        "footer_code",
        "Adds custom code at the end of the body tag.",
        ""
    );
    display_textarea(
        $_GET['id'],
        $results->footer_code_ty,
        "Footer Code on Thank You page",
        "footer_code_ty",
        "Adds custom code at the end of the body tag only to the thank you page.",
        ""
    );
    ?>
</div>

<?php
display_edit_toggle(
    "cog",
    "Performance",
    "we_edit_performance",
    "Increase performance at the cost of less features"
);
?>

<div id="we_edit_performance" class="we_edit_area">
    <?php
    display_option(
        $_GET['id'],
        $results->live_stats,
        "Live Stats",
        "live_stats",
        "Disable live stats in case you are using other statistics system, and need to improve performance.",
        "Enabled [enabled], Disabled [disabled]"
    );
    display_option(
        $_GET['id'],
        $results->wp_head_footer,
        "WP Head/Footer Integration",
        "wp_head_footer",
        "Allows to other plugins to integrate custom scripts/style in WebinarIgnition pages",
        "Disabled [disabled], Enabled [enabled]"
    );
    ?>
</div>

<div class="bottomSaveArea">
    <a href="#" class="blue-btn-44 btn saveIt" style="color:#FFF;"><i class="icon-save"></i> Save & Update</a>
</div>

</div>