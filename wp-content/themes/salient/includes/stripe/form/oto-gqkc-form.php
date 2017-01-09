<?php
if(isset($_SESSION['pp_users']['stripe']['subscription'])) {
   ?>
    <!--if isset $_SESSION subscription ->>>> update subscription to new -->
    <!--my token ->>>  pk_test_jgmwLo0RtxV342m0e5sfmxwY -->
    <!--client token ->> pk_test_Oxm6sN3ADQ2kN69GfpfBwOGK  -->
    <form style="display: none" action="" method="POST">
        <input type="hidden" name="redirect" value="/congratulations/"> <!-- /oto-ygkc/ -->
        <input type="hidden" name="page_type" value="oto-gqkc">
        <input type="hidden" name='amount' value="5776">
        <input type="hidden" name='sub_id' value="<?php echo $_SESSION['pp_users']['stripe']['subscription']['id']; ?>">
        <script
            src="https://checkout.stripe.com/checkout.js" id="join-kc" class="stripe-button"
            data-key="pk_test_jgmwLo0RtxV342m0e5sfmxwY"
            data-amount="5776"
            data-name="MusicSupervisor"
            data-description=""
            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
            data-locale="auto">
        </script>

    </form>
    <?php
} else {
?>
    <!-- if _SESSION subscription do not exist -> create new subscription -->
    <!--my token ->>>  pk_test_jgmwLo0RtxV342m0e5sfmxwY -->
    <!--client token ->> pk_test_Oxm6sN3ADQ2kN69GfpfBwOGK  -->
    <form style="display: none" action="" method="POST">
        <input type="hidden" name="redirect" value="/congratulations/"> <!-- /oto-ygkc/ -->
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
<?php } ?>




