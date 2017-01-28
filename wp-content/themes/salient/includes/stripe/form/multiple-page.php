<!--my token ->>>  pk_test_jgmwLo0RtxV342m0e5sfmxwY -->
<!--client token ->> pk_test_Oxm6sN3ADQ2kN69GfpfBwOGK  -->
<?php
global $wpdb;
$getStripeConfig = $wpdb->get_row( "SELECT * FROM  wp_stripe_config", ARRAY_A );
//unset($_SESSION['pp_users']['stripe']['subscription']);

if(!isset($_SESSION['pp_users']['stripe']['subscription'])) {
$getStripe = $wpdb->get_row("
        SELECT
          sp.page,sp.is_funnel as funnel,f.fee_amount,f.redirect_page as fee_redirect,
          f.description as fee_description,p.plan_price,p.plan_trial,
          p.plan_name,p.plan_id,p.description as plan_description,
          p.redirect_page as plan_redirect
          FROM  wp_stripe_page sp
            LEFT JOIN wp_stripe_fee f ON sp.fee_id = f.id
            LEFT JOIN wp_stripe_plan p ON p.id = sp.plan_id
        WHERE page = '".get_page_uri()."'", ARRAY_A);

//get_page_uri()
if(!empty($getStripeConfig) && (!empty($getStripe))){
        if(!empty($getStripe['fee_amount']) && !empty($getStripe['plan_price'])) {
        ?>
        <form style="display: none" action="" class="stripe_f" method="POST">
            <input type="hidden" name="m_funnel" value="<?php echo $getStripe['funnel']; ?>">
            <input type="hidden" name="m_redirect" value="/<?php echo $getStripe['fee_redirect']; ?>/"> <!-- /oto-gqkc/ -->
            <input type="hidden" name="m_page_type" value="<?php echo $getStripe['page']; ?>"> <!--join-kc -->
            <input type="hidden" name='m_amount' value="<?php echo $getStripe['fee_amount']; ?>"> <!--one time payment -->
            <input type="hidden" name='m_sub_id' value="<?php echo $getStripe['plan_id']; ?>">
            <input type="hidden" name='m_sub_name' value="<?php echo $getStripe['plan_name']; ?>">
            <input type="hidden" name='m_sub_trial' value="<?php echo $getStripe['plan_trial']; ?>">
            <input type="hidden" name='m_sub_amount' value="<?php echo $getStripe['plan_price']; ?>"> <!--subscription -->
            <input type="hidden" name='m_sub_desc' value="<?php if(isset($getStripe['fee_description'])){ echo $getStripe['fee_description'];} else { echo $getStripe['plan_description']; } ?>"> <!--subscription -->
            <script
                src="https://checkout.stripe.com/checkout.js" id="join-kc" class="stripe-button"
                data-key="<?php echo $getStripeConfig['stripe_secret']; ?>"
                data-amount="<?php echo $getStripe['fee_amount']; ?>"
                data-name="MusicSupervisor"
                data-description="<?php if(isset($getStripe['fee_description'])){ echo $getStripe['fee_description'];} else { echo $getStripe['plan_description']; } ?>"
                data-shipping-address="true"
                data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                data-locale="auto">
            </script>

        </form>
        <?php } elseif(!empty($getStripe['fee_amount']) && empty($getStripe['plan_price'])){ ?>
            <form style="display: none" action="" class="stripe_f" method="POST">
                <input type="hidden" name="m_funnel" value="/<?php echo $getStripe['funnel']; ?>/">
                <input type="hidden" name="onetime_redirect" value="/<?php echo $getStripe['fee_redirect']; ?>/"> <!-- /oto-gqkc/ -->
                <input type="hidden" name="onetime_page_type" value="<?php echo $getStripe['page']; ?>"> <!--join-kc -->
                <input type="hidden" name='onetime_desc' value="<?php echo $getStripe['fee_description']; ?>">
                <input type="hidden" name='onetime_amount' value="<?php echo $getStripe['fee_amount']; ?>"> <!--one time payment -->
                <script
                    src="https://checkout.stripe.com/checkout.js" id="join-kc" class="stripe-button"
                    data-key="<?php echo $getStripeConfig['stripe_secret']; ?>"
                    data-amount="<?php echo $getStripe['fee_amount']; ?>"
                    data-name="MusicSupervisor"
                    data-description="<?php if(isset($getStripe['fee_description'])){ echo $getStripe['fee_description'];} ?>"
                    data-shipping-address="true"
                    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                    data-locale="auto">
                </script>

            </form>
            <?php } ?>

<?php } ?>

<?php } else { ?>
    <?php
    $getStripe = $wpdb->get_row("
        SELECT
          sp.page,sp.is_funnel as funnel,f.fee_amount,f.redirect_page as fee_redirect,
          f.description as fee_description,p.plan_price,p.plan_trial,
          p.plan_name,p.plan_id,p.description as plan_description,
          p.redirect_page as plan_redirect
          FROM  wp_stripe_page sp
            LEFT JOIN wp_stripe_fee f ON sp.fee_id = f.id
            LEFT JOIN wp_stripe_plan p ON p.id = sp.plan_id
        WHERE page = '".get_page_uri()."'", ARRAY_A);
    if(!empty($getStripe['page'])) {

        ?>

        <form style="display: none" action="" class="stripe_f" method="POST">
            <input type="hidden" name="m_funnel" value="<?php echo $getStripe['funnel']; ?>">
            <input type="hidden" name="m_redirect" value="/<?php echo $getStripe['plan_redirect']; ?>/"> <!-- /oto-gqkc/ -->
            <input type="hidden" name="m_page_type" value="<?php echo $getStripe['page']; ?>"> <!--join-kc -->
            <input type="hidden" name='m_amount' value="<?php echo $getStripe['fee_amount']; ?>"> <!--one time payment -->
            <input type="hidden" name='m_sub_id' value="<?php echo $_SESSION['pp_users']['stripe']['subscription']['id']; ?>">
            <input type="hidden" name='m_customer_id' value="<?php echo $_SESSION['pp_users']['stripe']['customer']['id']; ?>">

            <input type="hidden" name='m_sub_name' value="<?php echo $getStripe['plan_name']; ?>">
            <input type="hidden" name='new_plan_name' value="<?php echo $getStripe['plan_id']; ?>">
            <input type="hidden" name='m_sub_trial' value="<?php echo $getStripe['plan_trial']; ?>">
            <input type="hidden" name='m_sub_amount' value="<?php echo $getStripe['plan_price']; ?>"> <!--subscription -->
            <input type="hidden" name='m_sub_desc' value="<?php if(isset($getStripe['fee_description'])){ echo $getStripe['fee_description'];} else { echo $getStripe['plan_description']; } ?>"> <!--subscription -->
            <input type="submit" style="display: none" id="stripe_upsell">
            <!--
            <script
                src="https://checkout.stripe.com/checkout.js" id="join-kc" class="stripe-button"
                data-key="<?php echo $getStripeConfig['stripe_secret']; ?>"
                data-amount="<?php echo $getStripe['fee_amount']; ?>"
                data-name="MusicSupervisor"
                data-description="<?php if(isset($getStripe['fee_description'])){ echo $getStripe['fee_description'];} else { echo $getStripe['plan_description']; } ?>"
                data-shipping-address="true"
                data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                data-locale="auto">
            </script>
            -->

        </form>

<?php } ?>
<?php } ?>



