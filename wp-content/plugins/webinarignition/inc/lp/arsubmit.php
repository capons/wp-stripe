<?php
// ADD WORDPRESS

define('WP_USE_THEMES', false);
require('../../../../../wp-blog-header.php');

// Deal ID
$id = $_GET['id'];

$results = get_option('webinarignition_campaign_' . $id);
?>

    <!-- AR OPTIN INTEGRATION -->
    <div class="arintegration" style="display:none;">

        <iframe id="ar_submit_iframe" name="ar_submit_iframe"></iframe>
        <form action="<?php echo $results->ar_url; ?>" id="AR-INTEGRATION" method="<?php echo $results->ar_method; ?>"
              target="ar_submit_iframe">

            <?php
            if (!empty($results->ar_fields_order) && is_array($results->ar_fields_order))
                foreach ($results->ar_fields_order as $_field) {
                    if (empty($results->$_field))
                        continue;
                    switch ($_field) {
                        case 'ar_name':
                            ?><input type="text" name="<?php echo $results->ar_name; ?>" id="ar-name" value="" /><?php
                            break;
                        case 'ar_lname':
                            ?><input type="text" name="<?php echo $results->ar_lname; ?>" id="ar-lname" value="" /><?php
                            break;
                        case 'ar_email':
                            ?><input type="text" name="<?php echo $results->ar_email; ?>" id="ar-email" value="" /><?php
                            break;
                        case 'ar_phone':
                            ?><input type="text" name="<?php echo $results->ar_phone; ?>" id="ar-phone" value="" /><?php
                            break;
                        default:
                            break;
                    }
                }
            ?>

            <?php echo stripcslashes($results->ar_hidden); ?>

        </form>

    </div>

<?php
if ($results->ar_url !== "") {
    ?>

    <script>
        function myfunc() {
            if (document.getElementById('AR-INTEGRATION')) {
                console.log('here');
                HTMLFormElement.prototype.submit.call(document.getElementById('AR-INTEGRATION'));
            }
        }
        window.onload = myfunc;
    </script>

<?php } ?>