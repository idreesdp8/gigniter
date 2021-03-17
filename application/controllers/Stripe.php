<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stripe extends CI_Controller
{

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
        $this->load->helper('url');
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function index()
    {
        $this->load->view('frontend/stripePayment/index');
    }

    public function demo()
    {
        $this->load->view('frontend/stripePayment/demo');
    }

    public function demo2()
    {
        $this->load->view('frontend/stripePayment/demo2');
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function payment()
    {
        require_once('application/libraries/stripe-php/init.php');

        $stripeSecret = 'sk_test_51IFCkrEjw9qpkhzpKDCVt8JFjXmez0JY0m4oXSC06EZmQ9ijwvfKAaZMcdPM14vR8LLgz81YH6VZiztX8ADl6Sis00CDVZZA0O';

        \Stripe\Stripe::setApiKey($stripeSecret);

        $stripe = \Stripe\Charge::create([
            "amount" => $this->input->post('amount'),
            "currency" => "usd",
            "source" => $this->input->post('tokenId'),
            "description" => "This is from nicesnippets.com"
        ]);

        // after successfull payment, you can store payment related information into your database

        $data = array('success' => true, 'data' => $stripe);

        echo json_encode($data);
    }

    public function charge_customer()
    {
        require_once('application/libraries/stripe-php/init.php');
        $stripeSecret = $this->config->item('stripe_api_key');
        $stripe = new \Stripe\StripeClient($stripeSecret);

        $customer_id = $this->input->post('customer_id');
        $amount = $this->input->post('amount');

        $charge = $stripe->charges->create([
            "amount" => $amount * 100,
            "currency" => 'usd',
            "customer" => $customer_id,
            "description" => "Demo1 customer charge"
        ]);

        $data = array('success' => true, 'data' => $charge);
        echo json_encode($data);
    }

    function check_customer()
    {
        // echo $customer_id;
        // die();
        require_once('application/libraries/stripe-php/init.php');
        $stripeSecret = $this->config->item('stripe_api_key');
        $stripe = new \Stripe\StripeClient($stripeSecret);
        $customer = $stripe->customers->retrieve(
            $this->input->post('customer_id'),
            []
        );
        $data = array('success' => true, 'data' => $customer);
        echo json_encode($data);
    }

    function create_customer()
    {
        require_once('application/libraries/stripe-php/init.php');
        $stripeSecret = $this->config->item('stripe_api_key');
        $stripe = new \Stripe\StripeClient($stripeSecret);
        $customer = $stripe->customers->create([
            'source' => $this->input->post('token'),
            'email' => $this->input->post('email'),
            'name' => $this->input->post('name'),
            'description' => 'Demo1 Customer',
        ]);
        // echo json_encode($customer);
        // die();
        $data = array('success' => true, 'data' => $customer);
        echo json_encode($data);
    }

    function transfer()
    {
        require_once('application/libraries/stripe-php/init.php');
        $stripeSecret = $this->config->item('stripe_api_key');
        $stripe = new \Stripe\StripeClient($stripeSecret);

        $amount = $this->input->post('amount');
        $user_account = $this->input->post('user_account');
        $admin_fee = $this->input->post('admin_fee');
        $amount = $amount - ($amount * $admin_fee / 100);

        $transfer = $stripe->transfers->create([
            'amount' => $amount,
            'currency' => 'usd',
            'destination' => $user_account,
            // 'transfer_group' => 'ORDER_95',
        ]);
        // echo $transfer;
        $data = array('success' => true, 'data' => $transfer);
        echo json_encode($data);
    }

    function transfer2()
    {
        $name = $this->input->post('cust_name');
        $email = $this->input->post('cust_email');
        $card_num = $this->input->post('card_no');
        $card_cvc = $this->input->post('cvc');
        $card_exp_month = $this->input->post('exp_month');
        $card_exp_year = $this->input->post('exp_year');
        $total_charged = $this->input->post('charge_amount');
        $admin_fee = $this->input->post('admin_fee');
        $user_account = $this->input->post('user_account');
        $total_paid = $total_charged - ($total_charged * $admin_fee / 100);

        // echo $total_charged;
        // echo $total_paid;
        // // echo $total_charged;
        // die();

        require_once('application/libraries/stripe-php/init.php');
        $stripePublic = $this->config->item('stripe_pub_key');
        $stripeSecret = $this->config->item('stripe_api_key');

        \Stripe\Stripe::setApiKey($stripePublic);

        $success_md = 0;
        $error_msg = '';

        try {
            $token_result = \Stripe\Token::create(
                array(
                    "card" => array(
                        "name" => $name,
                        "number" => $card_num,
                        "exp_month" => $card_exp_month,
                        "exp_year" => $card_exp_year,
                        "cvc" => $card_cvc,
                    )
                )
            );
            $token = $token_result["id"];
            $resps = \Stripe\Stripe::setApiKey($stripeSecret);

            $success_md = 1;
            $error_msg = '';
        } catch (\Exception $e) {
            $error1 = $e->getMessage();
            $error_msg = $error1;
            $success_md = 0;
        }
        if ($success_md == 1) {
            try {
                $customer = \Stripe\Customer::create(array(
                    'email' => $email,
                    'source'  => $token,
                    'description' => 'Demo2 Customer'
                ));

                // echo json_encode($customer);
                // die();

                $success_md = 1;
                $error_msg = 0;
            } catch (\Exception $e) {
                $error0 = $e->getMessage();
                $error_msg = $error0;
                $success_md = 0;
            }
        }
        if ($success_md == 1) {
            // $itemPrice = $total_charged;
            $currency = "usd";

            // sleep(20);
            //charge a credit or a debit card
            $charge = \Stripe\Charge::create([
                "amount" => $total_charged,
                "currency" => $currency,
                "customer" => $customer->id,
                "description" => "Demo2 customer charge",
				'metadata' => array(
					'order_id' => '123123'
				)
            ]);

            //retrieve charge details
            $chargeJson = $charge->jsonSerialize();

            //check whether the charge is successful
            if ($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1) {
                //order details
                $txn_id = $chargeJson['balance_transaction'];
                $amount = $chargeJson['amount'];
                $payment_currency = $chargeJson['currency'];
                $payment_status = $chargeJson['status'];

                //if order inserted successfully
                if ($payment_status == 'succeeded') {
                    $transfer = \Stripe\Transfer::create([
                        'amount' => $total_paid,
                        'currency' => 'usd',
                        'destination' => $user_account,
                    ]);

                    $transferJson = $transfer->jsonSerialize();


                    $out['status'] = '1';
                    $out['message'] = 'Success: Your transaction has been completed successfully.';
                    $out['txn_id'] = $txn_id;
                    $out['amount'] = $amount;
                    $out['currency'] = $payment_currency;
                    $out['payment_status'] = $payment_status;
                    $out['transfer'] = $transferJson;
                } else {

                    $out['status'] = '2';
                    $out['message'] = 'Error: Customer Charge has been failed!';
                    $out['txn_id'] = $txn_id;
                    $out['amount'] = $amount;
                    $out['currency'] = $payment_currency;
                    $out['payment_status'] = $payment_status;
                    $out['transfer'] = '';
                }
            } else {

                $out['status'] = '3';
                $out['message'] = 'Error: Transaction has been failed!';
            }
        } else {

            $out['status'] = '5';
            $out['message'] = "$error_msg";
        }

        $data = array('success' => true, 'data' => $out);
        echo json_encode($data);
    }
}
