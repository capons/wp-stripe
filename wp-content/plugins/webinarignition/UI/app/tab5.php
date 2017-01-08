<div class="tabber" id="tab5" style="display: none;">

<div class="titleBar">

    <div class="titleBarText">
        <h2>Webinar Replay Settings:</h2>

        <p>Here you can manage the settings for the webinar...</p>
    </div>

    <div class="launchConsole" style="margin-right: -20px;">
        <a href="<?php echo wi_fixPerma($data->postID); ?>preview-replay" target="_blank"><i
                class="icon-external-link-sign"></i> Preview Webinar Replay</a>
    </div>

    <br clear="all"/>

</div>


<?php

if ($results->webinar_date == "AUTO") {
    // no need to show this area...
} else {

    display_edit_toggle(
        "film",
        "Replay Video",
        "we_edit_replay_video",
        "Setup for the video that is played on the webinar replay page..."
    );

}

?>

<div id="we_edit_replay_video" class="we_edit_area">
    <?php
    display_textarea(
        $_GET['id'],
        $results->replay_video,
        "Replay Video",
        "replay_video",
        "This is the embed code for the video for the webinar replay...",
        "Ex. Video embed code / iframe code"
    );
    display_info(
        "Note: Video Embed Code",
        "If you are using Google Hangouts embed code, the same code they provide for the live boardcast will be the same code you enter here...  920px by 518px..."
    );
    ?>
</div>

<?php

display_edit_toggle(
    "time",
    "Countdown - Expiring Replay",
    "we_edit_replay_cd",
    "Settings for when the replay expires..."
);

?>

<div id="we_edit_replay_cd" class="we_edit_area">
    <?php

    if ($results->webinar_date == "AUTO") {
        display_option(
            $_GET['id'],
            $results->auto_replay,
            "Replay Availability",
            "auto_replay",
            "The amount of time the auto replay is available for. Default its open for 3 days the event...<br/>" .
            "<strong>Disabling the replay will prevent Instant Webinar Access. Only disable the replay, if you are not using the instant access feature.</strong>",
            "Open 3 Days [3], Open 2 Days [2], Open 1 Day [1], Disabled [0]"
        );
    } else {

        display_option(
            $_GET['id'],
            $results->replay_optional,
            "Optional:: Countdown",
            "replay_optional",
            "You can choose to show the countdown timer or hide it on your replay page...",
            "Show Countdown Timer [show], Hide Countdown Timer [hide]"
        );
        ?>
        <div class="replay_optional" id="replay_optional_show">
            <?php
            display_date(
                $_GET['id'],
                $results->replay_cd_date,
                "Countdown Close Date",
                "replay_cd_date",
                "This is the date the webinar goes down by, after this date, the replay page will be replaced with the closed page...",
                "MM-DD-YYYY"
            );
            display_field(
                $_GET['id'],
                $results->replay_cd_time,
                "Countdown Close Time",
                "replay_cd_time",
                "This is the time when the replay ends, <b>MUST BE IN 24 TIME, ie:  12:00 or 17:30</b>",
                "12:00"
            );

            ?>
        </div>
    <?php
    }
    display_field(
        $_GET['id'],
        $results->replay_cd_headline,
        "Countdown Headline",
        "replay_cd_headline",
        "This is the headline above the countdown area for how long the replay is live for...",
        "Ex. This Replay Is Being Taken Down On Tuesday May 23rd"
    );
    ?>

</div>

<?php

display_edit_toggle(
    "money",
    "Timed Action - Order Button",
    "we_edit_replay_timed",
    "Setup the timed action - order button / html..."
);

?>

<div id="we_edit_replay_timed" class="we_edit_area">
    <?php

    if ($results->webinar_date == "AUTO") {
        // no need to show this area...
        ?>
        <h3>Timed Actions From The 'Live' Webinar are used for the replay...</h3>
    <?php
    } else {

        display_option(
            $_GET['id'],
            $results->replay_timed_style,
            "Timed Action Style",
            "replay_timed_style",
            "You can choose between a simple order button or custom HTML...",
            "Order Button [button], Custom HTML Copy [custom]"
        );
        ?>
        <div class="replay_timed_style" id="replay_timed_style_button">
            <?php
            display_field(
                $_GET['id'],
                $results->replay_order_copy,
                "Order Button Copy",
                "replay_order_copy",
                "This is what the order button says...",
                "Ex. Order Your Copy Now"
            );
            display_field(
                $_GET['id'],
                $results->replay_order_url,
                "Order URL",
                "replay_order_url",
                "This is the URL where the order button will go...",
                "Ex. http://yoursite.com/order-now"
            );
            ?>
        </div>
        <div class="replay_timed_style" id="replay_timed_style_custom">
            <?php
            display_wpeditor(
                $_GET['id'],
                $results->replay_order_html,
                "Custom HTML Copy",
                "replay_order_html",
                "This is custom html you can have for the timed area which will show under the replay..."
            );
            ?>
        </div>
        <?php
        display_field(
            $_GET['id'],
            $results->replay_order_time,
            "Time For Button To Appear",
            "replay_order_time",
            "This is the time in seconds you want the button to appear...",
            "Ex. 60"
        );
        display_info(
            "Note: Timed Action",
            "The timed action is in seconds, one second is 1, one minute would be 60, 15 minutes would be 900..."
        );

    }
    ?>
</div>

<?php

display_edit_toggle(
    "remove-sign",
    "Webinar Closed Copy",
    "we_edit_replay_closed",
    "Copy / Settings for the closed page - when the replay has expired..."
);

?>

<div id="we_edit_replay_closed" class="we_edit_area">
    <?php
    display_wpeditor(
        $_GET['id'],
        $results->replay_closed,
        "Webinar Closed Copy",
        "replay_closed",
        "This is the copy that is displayed when the countdown reaches zero, or when you select webinar closed in the main webinar control...",
        ""
    );
    ?>
</div>

<div class="bottomSaveArea">
    <a href="#" class="blue-btn-44 btn saveIt" style="color:#FFF;"><i class="icon-save"></i> Save & Update</a>
</div>

</div>
