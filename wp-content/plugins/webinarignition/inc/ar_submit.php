<?php
$id = $_GET['id'];
$results = get_option('webinarignition_campaign_' . $client);

$lead = $_GET['id'];

// get LEAD INFO ::
global $wpdb;
$table_db_name = $wpdb->prefix . "webinarignition_leads_evergreen";
$leadinfo = $wpdb->get_row("SELECT * FROM $table_db_name WHERE id = '$lead'", OBJECT);


if(!isset($leadinfo->lname) && strrpos($leadinfo->name," ")) {
    
    $leadinfo->lname = explode(" ", $leadinfo->name, 2);
    $leadinfo->name = $leadinfo->lname[0];
    $leadinfo->lname = $leadinfo->lname[1];
    
}


if ($leadinfo->trk9 == "") {

    // has never been run before & set extra_confirm to 1
    $wpdb->update($table_db_name, array(
            'trk9' => "1"
        ), array('id' => $lead)
    );
} else {

    // has been run before -- STOP
    echo "COMPLETED";
    die();
    
}

?>

    <!-- AR OPTIN INTEGRATION -->
    <div class="arintegration" style="display: none;">

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
                            ?><input type="text" name="<?php echo $results->ar_name; ?>" id="ar-name"
                                     value="<?php echo $leadinfo->name; ?>" /><?php
                            break;
                        case 'ar_lname':
                            ?><input type="text" name="<?php echo $results->ar_lname; ?>" id="ar-lname"
                                     value="<?php echo $leadinfo->lname; ?>" /><?php
                            break;
                        case 'ar_email':
                            ?><input type="text" name="<?php echo $results->ar_email; ?>" id="ar-email"
                                     value="<?php echo $leadinfo->email; ?>" /><?php
                            break;
                        case 'ar_phone':
                            ?><input type="text" name="<?php echo $results->ar_phone; ?>" id="ar-phone"
                                     value="<?php echo $leadinfo->phone; ?>" /><?php
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

 
// if ($findstat->ar_url !== "") {
    ?>

    <script type="text/javascript">
       
        function myfunc() {
            
            if (document.getElementById('AR-INTEGRATION')) {
                
                HTMLFormElement.prototype.submit.call(document.getElementById('AR-INTEGRATION'));

            }
        }
        window.onload = myfunc();
        
    </script>

<?php // } ?>
