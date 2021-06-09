<script src="https://js.stripe.com/v3/"></script>
<!-- <script src="<?php echo user_asset_url(); ?>js/stripe.js"></script> -->
<script>
    var pub_key = '<?php echo $this->config->item('stripe_pub_key'); ?>';
    var stripe = Stripe(pub_key);
    var elements = stripe.elements();
    // var cardElement = elements.create('card', {
    //     'hidePostalCode': true
    // });
    var cardNumberElement = elements.create('cardNumber');
    var cardExpiryElement = elements.create('cardExpiry');
    var cardCvcElement = elements.create('cardCvc');
    // var resultContainer = document.getElementById('paymentResponse');
    var style = {
        base: {
            color: '#32325d',
            lineHeight: '24px',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };
    // cardElement.mount('#card-element', {style: style});
    cardNumberElement.mount('#cardNumber');
    cardExpiryElement.mount('#cardExpiry');
    cardCvcElement.mount('#cardCvc');
    // cardElement.on('change', function(event) {
    //     if (event.complete) {
    //         // enable payment button
    //     } else if (event.error) {
    //         // show validation to customer
    //     }
    // });
    cardNumberElement.on('change', function(event) {
        var displayError = document.getElementById('cardNumber-errors');
        if (event.complete) {
            displayError.textContent = '';
        } else if (event.error) {
            displayError.textContent = event.error.message;
        }
    });
    cardCvcElement.on('change', function(event) {
        var displayError = document.getElementById('cardCvc-errors');
        if (event.complete) {
            displayError.textContent = '';
        } else if (event.error) {
            displayError.textContent = event.error.message;
        }
    });
    cardExpiryElement.on('change', function(event) {
        var displayError = document.getElementById('cardExpiry-errors');
        if (event.complete) {
            displayError.textContent = '';
        } else if (event.error) {
            displayError.textContent = event.error.message;
        }
    });
    var form = document.getElementById('datas_form');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        var is_empty = document.getElementById('is_empty').value;
        var user_id = document.getElementById('user_id').value;
        // alert(is_empty);
        if (is_empty == 1 || user_id == 0) {
            if (is_empty == 1) {
                swal({
                    icon: 'warning',
                    title: 'Your Cart is Empty',
                    text: 'Please add some items in your cart first!',
                });
            }
            if (user_id == 0) {
                swal({
                    icon: 'warning',
                    title: 'You need to sign in!',
                });
            }
        } else {
            createToken();
        }
    });

    // Create single-use token to charge the user
    function createToken() {
        stripe.createToken(cardNumberElement, cardExpiryElement, cardCvcElement).then(function(result) {
            if (result.error) {
                // Inform the user if there was an error
                swal({
                    icon: 'error',
                    title: result.error.message,
                });
                // alert(result.error.message);
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