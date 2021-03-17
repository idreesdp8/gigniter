<?php

// $account_id = $_GET['account_id'];

require_once('application/libraries/stripe-php/init.php');
$stripeSecret = 'sk_test_51IFCkrEjw9qpkhzpKDCVt8JFjXmez0JY0m4oXSC06EZmQ9ijwvfKAaZMcdPM14vR8LLgz81YH6VZiztX8ADl6Sis00CDVZZA0O';

$stripe = new \Stripe\StripeClient($stripeSecret);
// $transfer = $stripe->paymentIntents->create([
//   'amount' => 2000,
//   'currency' => 'usd',
//   'payment_method_types' => ['card'],
// ]);

$pay_intent = $stripe->paymentIntents->create([
  'payment_method_types' => ['card'],
  'amount' => 10000,
  'currency' => 'usd',
  // 'customer' => 'cus_J88mkV7ubM3uhn',
  'application_fee_amount' => 2000,
], ['stripe_account' => 'acct_1ITA68RKBgLXo8rk']);
echo $pay_intent;
// $res1 =  json_decode($pay_intent);

// // sleep(10);
// $res = $stripe->paymentIntents->confirm(
//   'pi_1IVtqJRKBgLXo8rkBmjuxPbd',
//   ['payment_method' => 'pm_card_visa']
// );

// echo $res;
// // echo $account_id;
