<?php
// Get ID
$ID = $client;

// DB
global $wpdb;
$table_db_name = $wpdb->prefix . "webinarignition";
$findstat = $wpdb->get_row("SELECT * FROM $table_db_name WHERE id = '$ID'", OBJECT);

$full_path = get_site_url();
$assets = WEBINARIGNITION_URL . "inc/";
?>

<script src="<?php echo $assets; ?>lp/js/jquery.js"></script>
<script src="<?php echo $assets; ?>lp/js/cookie.js"></script>

<script type="text/javascript">
    $(document).ready(function () {

        // Check If Cookie Is Set -- Get ID
        $getCookieID = $.cookie('we-trk-<?php echo $ID; ?>');

        // Track Order For User
        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';

        var data = {action: 'webinarignition_track_order', id: "<?php echo $client; ?>", lead: "" + $getCookieID + ""};
        $.post(ajaxurl, data, function (results) {
        });

    });
</script>