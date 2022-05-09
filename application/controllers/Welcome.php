<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
	
	
	public function index2()
	{
		require 'vendor/autoload.php';
	
		// instantiate and use the dompdf class
		$dompdf = new Dompdf\Dompdf();

		$html = $this->load->view('welcome_message',[],true);

		$dompdf->loadHtml($html);

		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('A4', 'landscape');

		// Render the HTML as PDF
		$dompdf->render();

		// Get the generated PDF file contents
		$pdf = $dompdf->output();

		// Output the generated PDF to Browser
		$dompdf->stream();
	}

	public function test()
	{
		$this->load->model('user/configurations_model', 'configurations_model');
		$this->load->model('user/users_model', 'users_model');
		$this->load->model('user/bookings_model', 'bookings_model');
		$this->load->model('user/gigs_model', 'gigs_model');

		require_once('application/libraries/stripe-php/init.php');
		$stripe_config = $this->configurations_model->get_configuration_by_key_label('stripe', 'stripe_secret');
		\Stripe\Stripe::setApiKey($stripe_config->value);

		$currency = $this->config->item('stripe_currency');
		
		$bookings = $this->bookings_model->get_unpaid_bookings();
		if($bookings) {
			foreach($bookings as $booking) {
				$cart_items = $this->bookings_model->get_booking_items($booking->id);
				$gig = $this->gigs_model->get_gig_by_id($booking->gig_id);
				$gig_date = strtotime($gig->gig_date);
				$now = strtotime('now');
				$interval = $gig_date - $now;
				$hours = round($interval / 3600, 0);
				foreach ($cart_items as $item) {
					$user_stripe_detail = $this->users_model->get_user_stripe_details($gig->user_id);
					//if user has stripe added and connected and only 48 hours are remaining before gig date
					if ($user_stripe_detail && !$user_stripe_detail->is_restricted && $hours < 48) {
						$admin_fee = $this->configurations_model->get_configuration_by_key('admin-commission');
						$amount = $item->price - ($item->price * $admin_fee->value / 100);
						$transfer = \Stripe\Transfer::create([
							'amount' => $amount * 100,
							'currency' => $currency,
							'destination' => $user_stripe_detail->stripe_account_id,
						]);
						$transferJson = $transfer->jsonSerialize();
						if ($transferJson['amount_reversed'] == 0 && !$transferJson['reversed']) {
							$transfer_param = [
								'booking_id' => $booking->id,
								'transfer_id' => $transferJson['id'],
								'transaction_id' => $transferJson['balance_transaction'],
								'amount' => $transferJson['amount'] / 100,
								'type' => $transferJson['object'],
								'destination_id' => $transferJson['destination'],
								'user_received' => $gig->user_id,
								'admin_fee' => $item->price * $admin_fee->value / 100,
								'created_on' => date('Y-m-d H:i:s', $transferJson['created']),
							];
							$this->bookings_model->insert_transaction_data($transfer_param);
						}
					}
				}
			}
		}
	}
}
