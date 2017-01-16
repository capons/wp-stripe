<!--my token ->>>  pk_test_jgmwLo0RtxV342m0e5sfmxwY -->
<!--client token ->> pk_test_Oxm6sN3ADQ2kN69GfpfBwOGK  -->
<form style="display: none" action="" class="stripe_f" method="POST">
    <input type="hidden" name="redirect" value="/oto-gqkc/"> <!-- /oto-gqkc/ -->
    <input type="hidden" name="page_type" value="join-kc">
    <input type="hidden" name='amount' value="9888"> <!--one time payment -->
    <input type="hidden" name='sub_amount' value="3888"> <!--subscription -->
    <script
        src="https://checkout.stripe.com/checkout.js" id="join-kc" class="stripe-button"
        data-key="pk_test_jgmwLo0RtxV342m0e5sfmxwY"
        data-amount="9888"
        data-name="MusicSupervisor"
        data-description="98.88$, after 30 days 38.88$/month"
        data-shipping-address="true"
        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
        data-locale="auto">
    </script>



</form>