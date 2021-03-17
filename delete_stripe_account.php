<?php

$account_id = $_GET['account_id'];

require_once('application/libraries/stripe-php/init.php');
$stripeSecret = 'sk_test_51IFCkrEjw9qpkhzpKDCVt8JFjXmez0JY0m4oXSC06EZmQ9ijwvfKAaZMcdPM14vR8LLgz81YH6VZiztX8ADl6Sis00CDVZZA0O';

$stripe = new \Stripe\StripeClient($stripeSecret);
$account = $stripe->accounts->delete(
    $account_id,
    []
);
echo $account;
// echo $account_id;
