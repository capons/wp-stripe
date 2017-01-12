
<?php if (isset($_SESSION['pp_users']['stripe']['customer'])){ ?>
    <!--my token ->>>  pk_test_jgmwLo0RtxV342m0e5sfmxwY -->
    <!--client token ->> pk_test_Oxm6sN3ADQ2kN69GfpfBwOGK  -->
    <form style="display: none; opacity: 0"  action="" method="POST">
        <input type="hidden" name="redirect" value="/congratulations/">
        <input type="hidden" name="page_type" value="oto-ygkc">
        <input type="hidden" name='amount' value="19888">
        <input type="hidden" name='sub_id' value="<?php echo $_SESSION['pp_users']['stripe']['customer']['id']; ?>">
        <input type="submit" style="display: none"  id="stripe_upsell">
        <!--
        <script
            src="https://checkout.stripe.com/checkout.js" id="join-kc" class="stripe-button"
            data-key="pk_test_jgmwLo0RtxV342m0e5sfmxwY"
            data-amount="19888"
            data-name="MusicSupervisor"
            data-description=""
            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
            data-locale="auto">
        </script>
        -->

    </form>
<?php } else { ?>
    <!--my token ->>>  pk_test_jgmwLo0RtxV342m0e5sfmxwY -->
    <!--client token ->> pk_test_Oxm6sN3ADQ2kN69GfpfBwOGK  -->
    <!--
    <form style="display: none" class="stripe_f" action="" method="POST">
        <input type="hidden" name="redirect" value="/congratulations/">
        <input type="hidden" name="page_type" value="oto-ygkc">
        <input type="hidden" name='amount' value="19888">
        <input type="hidden" name='sub_id' value="">
        <script
            src="https://checkout.stripe.com/checkout.js" id="join-kc" class="stripe-button"
            data-key="pk_test_Oxm6sN3ADQ2kN69GfpfBwOGK"
            data-amount="19888"
            data-name="MusicSupervisor"
            data-description=""
            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
            data-locale="auto">
        </script>

    </form>
    -->

<?php } ?>
