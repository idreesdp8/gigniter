<?php

$customer_id = $_GET['customer_id'];

require_once('application/libraries/stripe-php/init.php');
$stripeSecret = 'sk_test_51IFCkrEjw9qpkhzpKDCVt8JFjXmez0JY0m4oXSC06EZmQ9ijwvfKAaZMcdPM14vR8LLgz81YH6VZiztX8ADl6Sis00CDVZZA0O';
$stripe = new \Stripe\StripeClient($stripeSecret);

$customer = $stripe->customers->retrieve(
    $customer_id,
    []
);
// return $customer;
echo $customer;
// echo $account_id;
