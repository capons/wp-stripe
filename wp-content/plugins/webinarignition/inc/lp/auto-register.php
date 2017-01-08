<?php

// Auto Register From URL & Submit AR URL

// Get Results
$id = $client;
$results = get_option('webinarignition_campaign_' . $id);

// Get variables
$name = $_GET["n"];
$email = $_GET["e"];

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $results->webinar_desc; ?></title>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f0f0;
            font-family: "Arial";
            color: #414141;
        }

        .loaderBox {
            margin-right: auto;
            margin-left: auto;
            width: 250px;
            background-color: #fff;
            border-radius: 10px;
            text-align: center;
            padding: 20px;
            margin-top: 30px;
            border-bottom: 3px solid #DDD;
        }

        .informationBox {
            width: 350px;
            margin-right: auto;
            margin-left: auto;
            margin-top: 30px;
            text-align: center;
        }
    </style>

    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>

    <script type="text/javascript">
        <?php
        //make the thank you page url
        if($results->custom_ty_url_state === 'show' && !empty($results->custom_ty_url)) {
            $thank_you_page_url = $results->custom_ty_url;
        } else {
            $thank_you_page_url = $results->webinar_permalink . '?confirmed';
            if($results->paid_status === 'paid')
                $thank_you_page_url .= '&' . urlencode($results->paid_code);
        }
        ?>
        var thank_you_url = '<?php echo $thank_you_page_url; ?>';

        $(document).ready(function () {

            $('#ar_submit_iframe').load(function (event) {
                if (!$(this).data('can_load'))
                    return false;
                window.location.href = thank_you_url;
            });

            // on load submit information & submit AR Form...

            // AJAX FOR WP
            var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';

            var data = {
                action: 'webinarignition_add_lead_auto_reg',
                id: "<?php echo $client; ?>",
                name: "<?php echo $name; ?>",
                email: "<?php echo $email; ?>",
                ip: "<?php echo $_SERVER['REMOTE_ADDR']; ?>",
                source: "AutoReg"
            };

            $.post(ajaxurl, data, function () {
                if ($("#AR-INTEGRATION").length > 0) {
                    $('#ar_submit_iframe').data('can_load', 'true');
                    HTMLFormElement.prototype.submit.call($("#AR-INTEGRATION")[0]);
                } else {
                    window.location.href = thank_you_url;
                }
            });

        });
    </script>

</head>
<body>

<div class="informationBox">
    <h2 style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px dashed #b3b3b3;"><?php echo $results->webinar_desc; ?></h2>
    <h4 style="font-weight:normal;"><?php echo $results->webinar_host; ?></h4>
</div>

<div class="loaderBox">
    <i class="fa fa-spinner fa-spin fa-4x"></i>
</div>


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
                        ?><input type="text" name="<?php echo $results->ar_name; ?>" id="ar-name"
                                 value="<?php echo $name; ?>" /><?php
                        break;
                    case 'ar_email':
                        ?><input type="text" name="<?php echo $results->ar_email; ?>" id="ar-email"
                                 value="<?php echo $email; ?>" /><?php
                        break;
                    default:
                        break;
                }
            }
        ?>

        <?php echo stripcslashes($results->ar_hidden); ?>

    </form>

</div>
</body>
</html>