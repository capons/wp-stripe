jQuery(function($) {
    var planPrice;
    $("input[name='stripe_plan_amount']").focusout(function () {
        planPrice = $("input[name='stripe_plan_amount']").val();
            $("input[name='stripe_plan_amount']").val(Number(planPrice).toLocaleString('en-US', {
                style: 'currency',
                currency: 'USD'
            }));
    });
    var fee;
    $("input[name='stripe_pay_amount']").focusout(function () {
        fee = $("input[name='stripe_pay_amount']").val();
        $("input[name='stripe_pay_amount']").val(Number(fee).toLocaleString('en-US', {
            style: 'currency',
            currency: 'USD'
        }));
    });

});
