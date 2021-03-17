<script src="https://js.stripe.com/v3/"></script>
<script>
    var pub_key = '<?php echo $this->config->item('stripe_pub_key'); ?>';
    var stripe = Stripe(pub_key);
    var elements = stripe.elements();
    var cardElement = elements.create('card', {
        hidePostalCode: true
    });
    // var resultContainer = document.getElementById('paymentResponse');

    cardElement.mount('#card-element');
    cardElement.on('change', function(event) {
        if (event.complete) {
            // enable payment button
        } else if (event.error) {
            // show validation to customer
        }
    });
    var form = document.getElementById('datas_form');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        createToken();
    });

    // Create single-use token to charge the user
    function createToken() {
        stripe.createToken(cardElement).then(function(result) {
            if (result.error) {
                // Inform the user if there was an error
                alert(result.error.message);
                // resultContainer.innerHTML = '<p>' + result.error.message + '</p>';
            } else {
                // Send the token to your server
                stripeTokenHandler(result.token);
            }
        });
    }

    // Callback to handle the response from stripe
    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripe-token');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);
        // setTimeout(function(){
        // alert(token.id);

        // Submit the form
        form.submit();
        // }, 1000);
    }
</script>