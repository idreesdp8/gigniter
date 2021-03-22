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
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <a href="<?php echo user_base_url() ?>stripe/demo">Demo 1</a>
                    </div>
                    <div class="col-md-6 mt-3">
                        <a href="<?php echo user_base_url() ?>stripe/demo2">Demo 2</a>
                    </div>
                    <div class="col-md-6 mt-3">
                        <div>Customer Email</div>
                        <input type="text" class="form-control" id="cust_email" value="hamza0952454@gmail.com" />
                    </div>
                    <div class="col-md-6 mt-3">
                        <div>Customer Name</div>
                        <input type="text" class="form-control" id="cust_name" value="Hamza Bhatti" />
                    </div>
                    <div class="col-md-6 mt-3">
                        <div>Card #</div>
                        <input type="text" class="form-control" id="card_no" value="4242 4242 4242 4242" />
                    </div>
                    <div class="col-md-2 mt-3">
                        <div>Expiry Month</div>
                        <input type="text" class="form-control" id="exp_month" value="02" />
                    </div>
                    <div class="col-md-2 mt-3">
                        <div>Expiry Year</div>
                        <input type="text" class="form-control" id="exp_year" value="2022" />
                    </div>
                    <div class="col-md-2 mt-3">
                        <div>CVC</div>
                        <input type="text" class="form-control" id="cvc" value="123" />
                    </div>
                    <!-- <div class="col-md-6 mt-3">
                        <div>Customer card Details</div>
                        <div class="mt-2 mb-2" id="card-element"></div>
                    </div> -->
                    <!-- <div class="col-md-6 mt-auto">
                        <button class="btn btn-primary btn-block" id="create_customer">Create Customer</button>
                    </div> -->
                    <!-- <div class="col-md-6 mt-3">
                        <div>Customer ID</div>
                        <input type="text" class="form-control" id="customer_id" />
                    </div> -->
                    <!-- <div class="col-md-6 mt-auto">
                        <button class="btn btn-primary btn-block" id="check_customer">Check Customer</button>
                    </div> -->

                    <div class="col-md-4 mt-3">
                        <div>Charge Amount ($)</div>
                        <input type="text" class="form-control" id="charge_amount" value="100" />
                    </div>
                    <!-- <div class="col-md-6 mt-auto">
                        <button class="btn btn-primary btn-block" id="charge">Charge Customer</button>
                    </div> -->
                    <!-- <div class="col-md-3 mt-3">
                        <div>Amount ($)</div>
                        <input type="text" class="form-control" id="pay_amount" value="100" />
                    </div> -->
                    <div class="col-md-3 mt-3">
                        <div>Admin fee (%)</div>
                        <input type="text" class="form-control" id="admin_fee" value="20" />
                    </div>
                    <div class="col-md-5 mt-3">
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
    <!-- <script src="https://js.stripe.com/v3/"></script> -->
    <script>

        $('#transfer').click(function() {
            var user_account = $('#user_account').val();
            var charge_amount = $('#charge_amount').val();
            var admin_fee = $('#admin_fee').val();
            var cust_email = $('#cust_email').val();
            var cust_name = $('#cust_name').val();
            var card_no = $('#card_no').val();
            var exp_month = $('#exp_month').val();
            var exp_year = $('#exp_year').val();
            var cvc = $('#cvc').val();

            $.ajax({
                url: "<?php echo user_base_url(); ?>stripe/transfer3",
                method: 'post',
                data: {
                    user_account: user_account,
                    charge_amount: charge_amount * 100,
                    admin_fee: admin_fee,
                    cust_email: cust_email,
                    cust_name: cust_name,
                    card_no: card_no,
                    exp_month: exp_month,
                    exp_year: exp_year,
                    cvc: cvc,
                },
                dataType: "json",
                success: function(response) {
                    // $('#log').val(response);
                    if(response.data.status == 1) {
                        $('#log').append('<div><strong>Message</strong>: ' + response.data.message + '</div>');
                        $('#log').append('<div><strong>Currency</strong>: ' + response.data.currency + '</div>'); 
                        $('#log').append('<div><strong>Total Charged</strong>: $' + response.data.amount / 100 + '</div>');
                        $('#log').append('<div><strong>Charge Transaction ID</strong>: ' + response.data.txn_id + '</div>');
                        // // $('#log').append('<div><strong>Total Transfered</strong>: $' + response.data.transfer.amount / 100 + '</div>');
                        // $('#log').append('<div><strong>Transfer Transaction ID</strong>: ' + response.data.transfer.balance_transaction + '</div>');
                        $('#log').append('<div><strong>Charge Json</strong>: ' + JSON.stringify(response.data.charge) + '</div>');
                    }
                }
            })
        });
    </script>
</body>

</html>