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
    <input type="hidden" name="redirect" value="/oto-gqkc/"> <!-- /oto-gqkc/ -->
    <input type="hidden" name="page_type" value="join-kc">
    <input type="hidden" name='amount' value="<?php echo $getPageFee['fee_amount']; ?>"> <!--one time payment -->
    <input type="hidden" name='sub_amount' value="<?php echo $getPagePlan['plan_price']; ?>"> <!--subscription -->
    <script
        src="https://checkout.stripe.com/checkout.js" id="join-kc" class="stripe-button"
        data-key="<?php echo $getStripeConfig['stripe_secret']; ?>"
        data-amount="<?php echo $getPageFee['fee_amount']; ?>"
        data-name="MusicSupervisor"
        data-description="<?php echo $getPageFee['fee_amount']; ?>$, after <?php $getPagePlan['plan_trial']; ?> days <?php echo $getPagePlan['plan_price']; ?>$/month"
        data-shipping-address="true"
        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
        data-locale="auto">
    </script>



</form>
<?php } ?>