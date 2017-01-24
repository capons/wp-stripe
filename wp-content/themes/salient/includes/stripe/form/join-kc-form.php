<!--my token ->>>  pk_test_jgmwLo0RtxV342m0e5sfmxwY -->
<!--client token ->> pk_test_Oxm6sN3ADQ2kN69GfpfBwOGK  -->
<?php
global $wpdb;
$getStripeConfig = $wpdb->get_row( "SELECT * FROM  wp_stripe_config", ARRAY_A );
$getPageFee = $wpdb->get_row( "SELECT * FROM  wp_stripe_fee WHERE page_use = '".get_page_uri()."'", ARRAY_A );
$getPagePlan = $wpdb->get_row( "SELECT * FROM  wp_stripe_plan WHERE page_use = '".get_page_uri()."'", ARRAY_A );
//get_page_uri()
if(!empty($getStripeConfig) && !empty($getPageFee) && !empty($getPagePlan)){
?>
<form style="display: none" action="" class="stripe_f" method="POST">
    <input type="hidden" name="redirect" value="/<?php echo $getPageFee['redirect_page']; ?>/"> <!-- /oto-gqkc/ -->
    <input type="hidden" name="page_type" value="join-kc">
    <input type="hidden" name='amount' value="<?php echo $getPageFee['fee_amount']; ?>"> <!--one time payment -->
    <input type="hidden" name='sub_amount' value="<?php echo $getPagePlan['plan_price']; ?>"> <!--subscription -->
    <input type="hidden" name='sub_id' value="<?php echo $getPagePlan['plan_id']; ?>">
    <input type="hidden" name='sub_name' value="<?php echo $getPagePlan['plan_name']; ?>">
    <input type="hidden" name='sub_trial' value="<?php echo $getPagePlan['plan_trial']; ?>">
    <input type="hidden" name='desc' value="<?php if(isset($getPageFee['description'])){ echo $getPageFee['description'];} else { echo $getPagePlan['description']; } ?>">
    <script
        src="https://checkout.stripe.com/checkout.js" id="join-kc" class="stripe-button"
        data-key="<?php echo $getStripeConfig['stripe_secret']; ?>"
        data-amount="<?php echo $getPageFee['fee_amount']; ?>"
        data-name="MusicSupervisor"
        data-description="<?php if(isset($getPageFee['description'])){ echo $getPageFee['description'];} else { echo $getPagePlan['description']; } ?>"
        data-shipping-address="true"
        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
        data-locale="auto">
    </script>



</form>
<?php } ?>