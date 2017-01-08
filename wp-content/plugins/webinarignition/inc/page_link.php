<?php
// ********* META DATA BOX ********************///

add_action('add_meta_boxes', 'webinarignitionx_meta_box_add');

function webinarignitionx_meta_box_add() {
    add_meta_box('webinarignitionx-id', 'Link To WebinarIgnition', 'webinarignitionx_meta_box_cb', 'page', 'side', 'high');
}

function webinarignitionx_meta_box_cb() {

    global $post;
    $values = get_post_custom($post->ID);

    wp_nonce_field('webinarignitionx_meta_box_nonce', 'webinarignitionx_box_nonce');

    $webinarignitionxSelected = $values['webinarignitionx_meta_box_select'];

    $webinar_id = $webinarignitionxSelected[0];
    ?>
    <h4 style=" margin-bottom: 0px; margin-top: 15px;">Select A WebinarIgnition Campaign Page:</h4>
    <span style="font-size: 11px;">This page will be replaced with this campaign page...</span>
    <br>
    <select name="webinarignitionx_meta_box_select" id="webinarignitionx_meta_box_select"
            style="margin-top: 10px; width: 250px;">

        <option <?php
        if ($webinar_id == "0") {
            echo "selected='selected'";
        }
        ?> value="0">NONE
        </option>


        <?php
        global $wpdb;

        $table_db_name = $wpdb->prefix . "webinarignition";

        $templates = $wpdb->get_results("SELECT * FROM $table_db_name ORDER BY ID DESC", ARRAY_A);

        foreach ($templates as $template) {

            $name = stripslashes($template['appname']);
            $id = stripslashes($template['ID']);
            $selectedBox = "";
            if ($webinar_id == $id) {
                $selectedBox = "selected='selected'";
            }

            echo "<option $selectedBox value='$id'>$name</option>";
        }
        ?>

    </select>

<?php
}

// Save Settings

add_action('save_post', 'webinarignitionx_meta_box_save');

function webinarignitionx_meta_box_save($post_id) {
    // Bail if we're doing an auto save
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    // if our nonce isn't there, or we can't verify it, bail
    if (!isset($_POST['webinarignitionx_box_nonce']) || !wp_verify_nonce($_POST['webinarignitionx_box_nonce'], 'webinarignitionx_meta_box_nonce'))
        return;

    // if our current user can't edit this post, bail
    if (!current_user_can('edit_post'))
        return;

    // now we can actually save the data
    // Make sure your data is set before trying to save it

    if (isset($_POST['webinarignitionx_meta_box_select']))
        update_post_meta($post_id, 'webinarignitionx_meta_box_select', esc_attr($_POST['webinarignitionx_meta_box_select']));
}

// Get post settings ::

add_action('template_redirect', 'webinarignitionx_checkpost');

function webinarignitionx_checkpost() {

    // get POST ID:
    global $post;
    $values = get_post_custom($post->ID);
    if (empty($values['webinarignitionx_meta_box_select']))
        return;
    $webinarignitionxSelected = $values['webinarignitionx_meta_box_select'];
    $pluginName = 'webinarignition';
    $webinar_id = $webinarignitionxSelected[0];


    if ($webinar_id !== "0" && !empty($webinar_id)) {

        $client = urlencode($webinar_id); // used as global, do not remove

        // Return Option Object:
        $results = get_option('webinarignition_campaign_' . $webinar_id);

        // Thank You Page
        if (isset($_GET['confirmed'])) {
            if (!is_user_logged_in() && ($results->paid_status === 'paid' && !isset($_GET[$results->paid_code]))) {
                wp_redirect($results->webinar_permalink);
            }
            // Template CLEAN SIMPLE
            include("lp/thankyou_cp.php");
        } else if (isset($_GET['preview-countdown'])) {

            // Preview Count Down Page
            include("lp/countdown.php");
        } else if (isset($_GET['preview-webinar'])) {

            // Preview Webinar Page
            include("lp/webinar.php");
        } else if (isset($_GET['preview-replay'])) {

            // Preview Replay Page
            include("lp/replay.php");
        } else if (isset($_GET['console'])) {

            // Preview Replay Page
            include("lp/console.php");
        } else if (isset($_GET['live'])) {
            if (!is_user_logged_in() && ($results->paid_status == "paid" && !isset($_GET[md5($results->paid_code)]))) {
                // redirect if not paid..
                wp_redirect($results->webinar_permalink);
            }
            // Check
            if ($results->webinar_date == "AUTO") {
                // Auto Page - Set Based On Time ::
                $leadID = $_GET['lid'];
                global $wpdb;
                $table_db_name = $wpdb->prefix . "webinarignition_leads_evergreen";
                $query = "(SELECT * FROM $table_db_name WHERE id = '$leadID' )";
                $leadinfo = $wpdb->get_row($query, OBJECT);
                // Set Timezone
                date_default_timezone_set($leadinfo->lead_timezone);
                // Get Dates
                $todaysdate = strtotime("now");
                $live = strtotime($leadinfo->date_picked_and_live);
                $replay = strtotime($leadinfo->date_after_live);

                // If date has not yet reached...
                if ($todaysdate <= $live) {
                    // Today is equal to live or less then live... show countdown
                    include("lp/countdown.php");
                } else if ($todaysdate >= $replay) {
                    // Today is equal to replay or greater then replay... show replay
                    include("lp/replay.php");
                } else if (($todaysdate <= $todaysdate) && ($todaysdate <= $replay)) {
                    // TOday is equal or within range of live and replay dates...
                    include("lp/webinar.php");
                }
            } else {
                // Live Page -- Get Switch Settings ::
                if ($results->webinar_switch == "" || $results->webinar_switch == "countdown") {
                    // Show Countdown Page
                    include("lp/countdown.php");
                } else if ($results->webinar_switch == "live") {
                    // Show Live Webinar
                    include("lp/webinar.php");
                } else if ($results->webinar_switch == "replay") {
                    // Show Webinar Replay
                    include("lp/replay.php");
                } else if ($results->webinar_switch == "closed") {
                    // Show Live Webinar
                    include("lp/closed.php");
                }
            }
        } else if (isset($_GET['googlecalendar'])) {

            // Add To Calendar
            include("lp/google.php");
        } else if (isset($_GET['ics'])) {

            // Add To iCal
            include("lp/ics.php");
        } else if (isset($_GET['googlecalendarA'])) {

            // Add To Calendar
            include("lp/googleA.php");
        } else if (isset($_GET['icsA'])) {

            // Add To iCal
            include("lp/icsA.php");
        } else if (isset($_GET['3rdpartypost'])) {

            // 3rd Party Post
            include("lp/posted.php");
        } else if (isset($_GET['trkorder'])) {

            // Track Order
            include("lp/ordertrk.php");
        } else if (isset($_GET['arsubmit'])) {

            // Track Order
            include("ar_submit.php");
        } else if (isset($_GET['preview_auto_thankyou'])) {
            // Track Order
            include("lp/thankyou_cp_preview.php");
        } else if (isset($_GET['register-now'])) {
            // Auto Register...
            include("lp/auto-register.php");
        } else {

            if ($results->fe_template == "lp" || $results->fe_template == "") {
                // Shows Thank You Page - CORE TEMPLATE
                include("lp/index.php");
            } else {
                // Stylish Template
                include("lp/index_" . $results->fe_template . ".php");
            }

        }
        die();
    }
}