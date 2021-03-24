<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Codeigniter Stripe Payment Gateway Integration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <style>
        .container {
            padding: 0.5%;
        }
    </style>
</head>

<body>
    <div class="container">
        <input type="hidden" id="stripe-token" />
        <div class="row">
            <div class="col-md-8">
                <?php $this->load->view('frontend/stripePayment/links'); ?>
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <div>Customer Email</div>
                        <input type="text" class="form-control" id="cust_email" value="hamza0952454@gmail.com" />
                    </div>
                    <div class="col-md-6 mt-3">
                        <div>Customer Name</div>
                        <input type="text" class="form-control" id="cust_name" value="Hamza Bhatti" />
                    </div>
                    <div class="col-md-6 mt-3">
                        <div>Customer card Details</div>
                        <div class="mt-2 mb-2" id="card-element"></div>
                    </div>
                    <div class="col-md-6 mt-auto">
                        <button class="btn btn-primary btn-block" id="create_customer">Create Customer</button>
                    </div>
                    <div class="col-md-6 mt-3">
                        <div>Customer ID</div>
                        <input type="text" class="form-control" id="customer_id" />
                    </div>
                    <div class="col-md-6 mt-auto">
                        <button class="btn btn-primary btn-block" id="check_customer">Check Customer</button>
                    </div>

                    <div class="col-md-6 mt-3">
                        <div>Charge Amount ($)</div>
                        <input type="text" class="form-control" id="charge_amount" value="100" />
                    </div>
                    <div class="col-md-6 mt-auto">
                        <button class="btn btn-primary btn-block" id="charge">Charge Customer</button>
                    </div>
                    <div class="col-md-3 mt-3">
                        <div>Amount ($)</div>
                        <input type="text" class="form-control" id="pay_amount" value="100" />
                    </div>
                    <div class="col-md-3 mt-3">
                        <div>Admin fee (%)</div>
                        <input type="text" class="form-control" id="admin_fee" value="20" />
                    </div>
                    <div class="col-md-6 mt-3">
                        <div>Gig Owner Stripe Account</div>
                        <input type="text" class="form-control" id="user_account" value="acct_1ITA68RKBgLXo8rk" />
                    </div>
                    <div class="col-md-12 mt-3">
                        <button class="btn btn-primary btn-block" id="transfer">Pay Gig Owner</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4" id="log">
                <h4>Log</h4>
            </div>
        </div>
        <div class="row">
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
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

        $('#check_customer').click(function() {
            var customer_id = $('#customer_id').val();
            $.ajax({
                url: "<?php echo user_base_url(); ?>stripe/check_customer",
                method: 'post',
                data: {
                    customer_id: customer_id,
                },
                dataType: "json",
                success: function(response) {
                    $('#customer_id').val(response.data.id);
                    $('#log').append('<div>Customer: ' + response.data.id + '</div>');
                    $('#log').append('<div>Customer Exists!!</div>');
                }
            })
        });

        $('#create_customer').click(function() {
            createToken();
        });

        $('#charge').click(function() {
            charge_customer();
        });

        $('#transfer').click(function() {
            var user_account = $('#user_account').val();
            var pay_amount = $('#pay_amount').val();
            var admin_fee = $('#admin_fee').val();

            $.ajax({
                url: "<?php echo user_base_url(); ?>stripe/transfer",
                method: 'post',
                data: {
                    user_account: user_account,
                    admin_fee: admin_fee,
                    amount: pay_amount * 100,
                },
                dataType: "json",
                success: function(response) {
                    // $('#customer_id').val(response.data.id);
                    $('#log').append('<div>Transfer: ' + response.data.id + '</div>');
                    $('#log').append('<div>Gig Owner Received $' + response.data.amount / 100 + '</div>');
                    $('#log').append('<div>Transaction ID is ' + response.data.balance_transaction + '</div>');
                }
            })
        });

        function create_customer() {
            var token = $('#stripe-token').val();
            var cust_email = $('#cust_email').val();
            var cust_name = $('#cust_name').val();
            $.ajax({
                url: "<?php echo user_base_url(); ?>stripe/create_customer",
                method: 'post',
                data: {
                    token: token,
                    email: cust_email,
                    name: cust_name,
                },
                dataType: "json",
                success: function(response) {
                    $('#customer_id').val(response.data.id);
                    $('#log').append('<div>Customer: ' + response.data.id + '</div>');
                }
            })
        }

        function charge_customer() {
            var customer_id = $('#customer_id').val();
            var charge_amount = $('#charge_amount').val();
            $.ajax({
                url: "<?php echo user_base_url(); ?>stripe/charge_customer",
                method: 'post',
                data: {
                    customer_id: customer_id,
                    amount: charge_amount
                },
                dataType: "json",
                success: function(response) {
                    // console.log(response.data);
                    $('#log').append('<div>Customer: ' + response.data.id + '</div>');
                    $('#log').append('<div>Customer has been charged $' + response.data.amount / 100 + '</div>');
                    $('#log').append('<div>Transaction ID is ' + response.data.balance_transaction + '</div>');
                }
            })
        }

        // Create single-use token to charge the user
        function createToken() {
            stripe.createToken(cardElement).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error
                    alert(result.error.message);
                    // resultContainer.innerHTML = '<p>' + result.error.message + '</p>';
                } else {
                    // Send the token to your server
                    $('#log').append('<div>Token: ' + result.token.id + '</div>');
                    stripeTokenHandler(result.token);
                }
            });
        }

        // Callback to handle the response from stripe
        function stripeTokenHandler(token) {
            $('#stripe-token').val(token.id);
            create_customer();
        }
    </script>
</body>

</html>