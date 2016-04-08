jQuery(function($) {
    $('form[name="paiement"]').submit(function(event) {
        var $form = $(this);

        // Disable the submit button to prevent repeated clicks
        $form.find('button').prop('disabled', true);

        Stripe.card.createToken($form, stripeResponseHandler);

        // Prevent the form from submitting with the default action
        return false;
    });
});

function stripeResponseHandler(status, response) {
    var $form = $('form[name="paiement"]');

    if (response.error) {
        // Show the errors on the form
        $form.append($('<span class="stripe-error">' +response.error.message +'</span>'));
        $form.find('button').prop('disabled', false);
    } else {
        // response contains id and card, which contains additional card details
        var token = response.id;
        // Insert the token into the form so it gets submitted to the server
        $form.find('#application_stripebundle_cardformtype_token').val(token);
        // Clear Form data for security
        $form.find('#application_stripebundle_cardformtype_card').val('');
        $form.find('#application_stripebundle_cardformtype_cvc').val('');
        $form.find('#application_stripebundle_cardformtype_month').val('');
        $form.find('#application_stripebundle_cardformtype_year').val('');


        // and submit
        $form.get(0).submit();
    }
};
