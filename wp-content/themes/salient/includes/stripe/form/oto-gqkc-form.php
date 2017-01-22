<?php
if(isset($_SESSION['pp_users']['stripe']['subscription'])) {
    global $wpdb;
    $getPagePlan = $wpdb->get_row( "SELECT * FROM  wp_stripe_plan WHERE page_use = '".get_page_uri()."'", ARRAY_A );
    if(!empty($getPagePlan)) {
        ?>
        <!--if isset $_SESSION subscription ->>>> update subscription to new -->
        <!--my token ->>>  pk_test_jgmwLo0RtxV342m0e5sfmxwY -->
        <!--client token ->> pk_test_Oxm6sN3ADQ2kN69GfpfBwOGK  -->
        <form style="display: none; opacity: 0" action="" method="POST">
            <input type="hidden" name="redirect" value="/<?php echo $getPagePlan['redirect_page']; ?>/"> <!-- /oto-ygkc/ -->
            <input type="hidden" name="page_type" value="oto-gqkc">
            <input type="hidden" name='amount' value="<?php echo $getPagePlan['plan_price']; ?>">
            <input type="hidden" name='sub_id'
                   value="<?php echo $_SESSION['pp_users']['stripe']['subscription']['id']; ?>">
            <input type="hidden" name='sub_new_id' value="<?php echo $getPagePlan['plan_id']; ?>">
            <input type="hidden" name='sub_new_name' value="<?php echo $getPagePlan['plan_name']; ?>">
            <input type="submit" style="display: none" id="stripe_upsell">


            <!--
            <script
                src="https://checkout.stripe.com/checkout.js" id="join-kc" class="stripe-button"
                data-key="pk_test_jgmwLo0RtxV342m0e5sfmxwY"
                data-amount="5776"
                data-name="MusicSupervisor"
                data-description=""
                data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                data-locale="auto">
            </script>
            -->

        </form>
        <?php
    }
} else {
?>
    <!-- if _SESSION subscription do not exist -> create new subscription -->
    <!--my token ->>>  pk_test_jgmwLo0RtxV342m0e5sfmxwY -->
    <!--client token ->> pk_test_Oxm6sN3ADQ2kN69GfpfBwOGK  -->
    <!--
    <form style="display: none" action="" class="stripe_f" method="POST">
        <input type="hidden" name="redirect" value="/oto-ygkc/">
        <input type="hidden" name="page_type" value="oto-gqkc">
        <input type="hidden" name='amount' value="5776">
        <input type="hidden" name='sub_id' value="">

        <script
            src="https://checkout.stripe.com/checkout.js" id="join-kc" class="stripe-button"
            data-key="pk_test_Oxm6sN3ADQ2kN69GfpfBwOGK"
            data-amount="5776"
            data-name="MusicSupervisor"
            data-description=""
            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
            data-locale="auto">
        </script>


    </form>
    -->
<?php } ?>




