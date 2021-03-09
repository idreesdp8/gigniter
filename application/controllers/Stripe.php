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
}
