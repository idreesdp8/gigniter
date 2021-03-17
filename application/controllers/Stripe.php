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
            "description" => "Thank you for buying!"
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
            'description' => 'Gigniter Customer',
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
}
