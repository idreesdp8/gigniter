<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		// echo json_encode($this->session->userdata('cart_contents'));
		// die();

		$this->dbs_user_id = $vs_id = $this->session->userdata('us_id');
		$this->login_vs_role_id = $this->dbs_role_id = $vs_role_id = $this->session->userdata('us_role_id');
		$this->load->model('user/general_model', 'general_model');
		$this->load->model('user/roles_model', 'roles_model');
		// if(isset($vs_id) && (isset($vs_role_id) && $vs_role_id>=1)){

		// // 	$res_nums = $this->general_model->check_controller_permission_access('Admin/Users',$vs_role_id,'1');
		// // 	if($res_nums>0){

		// // 	}else{
		// // 		redirect('/');
		// // 	} 
		// }else{
		// 	redirect('login');
		// }

		$this->load->model('user/users_model', 'users_model');
		$this->load->model('user/customers_model', 'customers_model');
		$this->load->model('user/configurations_model', 'configurations_model');
		$this->load->model('user/bookings_model', 'bookings_model');
		$this->load->model('user/gigs_model', 'gigs_model');
		$perms_arrs = array('role_id' => $vs_role_id);
		// $this->gig_status_key = 'gig-status';
		// $this->genre_key = 'genre';
		// $this->category_key = 'category';

		// $this->load->library('Ajax_pagination');
		// $this->load->library('cart');
		// $this->load->library('stripe');
		// $this->perPage = 25;
	}

	public function index()
	{
		$data['user'] = $this->users_model->get_user_by_id($this->dbs_user_id);
		$user_id = $this->dbs_user_id ?? 0;
		$cart_items = $this->bookings_model->get_user_cart_items($user_id);
		$total_price = 0;
		foreach ($cart_items as $item) {
			$tier = $this->gigs_model->get_ticket_tier_by_id($item->ticket_tier_id);
			$item->ticket_tier_name = $tier->name;
			$item->ticket_tier_price = $tier->price;
			$price = $item->quantity * $item->ticket_tier_price;
			$total_price += $price;
		}
		$data['cart_items'] = $cart_items;
		$data['total_price'] = $total_price;
		// echo json_encode($data['cart_items']);
		// echo json_encode($total_price);
		// die();
		$this->load->view('frontend/cart/index', $data);
	}

	public function book_tier($gig_id = '')
	{
		$data['gig'] = $this->gigs_model->get_gig_by_id($gig_id);
		if ($this->dbs_user_id == $data['gig']->user_id) {
			redirect('/');
		}
		$data['venues'] = [];
		if ($data['gig']->venues) {
			$data['venues'] = explode(',', $data['gig']->venues);
		}
		$tiers = $this->gigs_model->get_ticket_tiers_by_gig_id($gig_id);
		foreach ($tiers as $tier) {
			$tier->bundles = $this->gigs_model->get_ticket_bundles_by_ticket_tier_id($tier->id);
			$tier->image = '';
			if ($tier->bundles) {
				foreach ($tier->bundles as $bundle) {
					if ($tier->image == '') {
						$tier->image = $bundle->image;
					}
				}
			}
		}
		$data['tiers'] = $tiers;
		// echo json_encode($tiers);
		// die();
		$this->load->view('frontend/cart/book_ticket', $data);
	}

	public function add()
	{
		$insert_flag = true;
		$cart_items = $this->cart->contents();
		$gig_id = $this->input->post('gig_id');
		$ticket_tier_ids = $this->input->post('ticket_tier_id[]');
		$quantities = $this->input->post('qty[]');
		foreach ($cart_items as $item) {
			$cart_gig_id = $item['gig_id'];
			if ($gig_id != $cart_gig_id) {
				$insert_flag = false;
			}
		}
		if (!$insert_flag) {
			$this->session->set_flashdata('warning_msg', 'Please checkout first!');
			redirect($this->input->server('HTTP_REFERER'));
		}
		$created_on = date('Y-m-d H:i:s');
		$gig = $this->gigs_model->get_gig_by_id($gig_id);
		$length = count($ticket_tier_ids);
		for ($i = 0; $i < $length; $i++) {
			// if ($quantities[$i]) {
			$tier = $this->gigs_model->get_ticket_tier_by_id($ticket_tier_ids[$i]);
			$param[] = [
				'id' => $ticket_tier_ids[$i],
				'gig_id' => $gig_id,
				'gig_title' => $gig->title,
				'ticket_tier_id' => $ticket_tier_ids[$i],
				'qty' => $quantities[$i],
				'price' => $tier->price,
				'name' => $tier->name,
				'created_on' => $created_on,
			];
			// }
		}

		$res = $this->cart->insert($param);
		// echo json_encode($this->cart->contents());die();
		if ($res) {
			redirect('cart/checkout');
		} else {
			$this->session->set_flashdata('error_msg', 'Problem occured!');
			redirect($this->input->server('HTTP_REFERER'));
		}
	}

	public function delete_item()
	{
		$rowid = $this->input->post('rowid');
		$item = $this->cart->get_item($rowid);
		if ($item) {
			$res = $this->cart->remove($rowid);
			if ($res) {
				$response = [
					'status' => 200,
					'message' => 'Item is removed from your cart!',
					'total_amount' => $this->cart->total(),
					'total_items' => $this->cart->total_items(),
					'is_empty' => $this->cart->contents() ? 0 : 1,
				];
			} else {
				$response = [
					'status' => 500,
					'message' => 'Error: Item is not removed!'
				];
			}
		} else {
			$response = [
				'status' => 404,
				'message' => 'Item is not found in your cart!'
			];
		}
		echo json_encode($response);
	}
	public function update_item()
	{
		$rowid = $this->input->post('rowid');
		$qty = $this->input->post('qty');
		// echo $rowid;
		// echo $qty;
		// die();
		$item = $this->cart->get_item($rowid);
		if ($item) {
			$data = array(
				'rowid' => $rowid,
				'qty'   => $qty
			);
			$res = $this->cart->update($data);
			if ($res) {
				$item = $this->cart->get_item($rowid);
				// echo json_encode($item);
				// die();
				$response = [
					'status' => 200,
					'message' => 'Cart is updated!',
					'item_total' => $item['subtotal'],
					'total_amount' => $this->cart->total()
				];
			} else {
				$response = [
					'status' => 500,
					'message' => 'Error updating cart!'
				];
			}
		} else {
			$response = [
				'status' => 404,
				'message' => 'Item is not found in your cart!'
			];
		}
		echo json_encode($response);
	}

	function checkout()
	{
		// if() {
		// 	echo $this->dbs_user_id;
		// } else {
		// 	echo 'meow';
		// }
		// die();
		// // $this->cart->destroy();
		$cart_items = $this->cart->contents();

		foreach ($cart_items as $item) {
			$gig_id = $item['gig_id'];
		}
		// echo json_encode($cart_items);
		// die();
		if (isset($_POST) && !empty($_POST) && !empty($cart_items) && isset($this->dbs_user_id)) {

			$email_to = $this->input->post("user_email");
			$fname = $this->input->post("user_fname");
			$lname = $this->input->post("user_lname");
			$name = ucfirst($fname) . ' ' . ucfirst($lname);
			$token = $this->input->post('stripe-token');


			// $user = $this->users_model->get_user_by_email($email_to);
			$user_id = $this->dbs_user_id;
			// if (!$user_id) {
			// 	$this->load->helper('string');
			// 	$password = random_string('alnum', 8);
			// 	$this->session->set_userdata(['password' => $password]);
			// 	$password = $this->general_model->safe_ci_encoder($password);
			// 	$role = $this->roles_model->get_role_by_name('User');
			// 	$created_on = date('Y-m-d H:i:s');
			// 	$status = 0;
			// 	$datas = array(
			// 		'email' => $email_to,
			// 		'fname' => $fname,
			// 		'lname' => $lname ?? '',
			// 		'password' => $password,
			// 		'role_id' => $role->id,
			// 		'status' => $status,
			// 		'created_on' => $created_on
			// 	);
			// 	$user_id = $this->users_model->insert_user_data($datas);
			// 	// $is_sent1 = $this->send_email($email_to, 'Account Registration', 'account_password');
			// 	// $is_sent2 = $this->send_email($email_to, 'Verification Code', 'verification');
			// }

			$ticket_limit = $this->gigs_model->get_gig_ticket_limit($gig_id);
			$threshold = floor($ticket_limit * .6);

			$price = $this->cart->total();
			$booking_no = 'GN_' . strtotime('now');
			$created_on = date('Y-m-d H:i:s', strtotime('now'));

			$is_physical_gig = $this->gigs_model->check_gig_venue_type($gig_id, 'Physical');
			$booking_params = [
				'booking_no' => $booking_no,
				'user_id' => $user_id,
				'gig_id' => $gig_id,
				'price' => $price,
				'is_paid' => 0,
				'created_on' => $created_on,
				'qr_token' => $qr_token
			];

			$res = $this->bookings_model->insert_booking_data($booking_params);
			// $user_accounts = [];
			if ($res) {
				foreach ($cart_items as $item) {
					$i = 1;
					$cart_params[] = [
						'gig_id' => $item['gig_id'],
						'ticket_tier_id' => $item['ticket_tier_id'],
						'quantity' => $item['qty'],
						'price' => $item['subtotal'],
						'user_id' => $user_id,
						'booking_id' => $res,
						'created_on' => $item['created_on'],
					];
					while ($item['qty']) {

						if ($is_physical_gig == 1) {
							$qr_token = uniqid();

							$ticket_params[] = [
								'ticket_no' => $user_id . '_' . $item['gig_id'] . '_' . $res . '_' . $item['ticket_tier_id'] . '_' . $i,
								'gig_id' => $item['gig_id'],
								'ticket_tier_id' => $item['ticket_tier_id'],
								'booking_id' => $res,
								'user_id' => $user_id,
								'qr_token' => $qr_token,
							];
							//downloads_url().
							$this->general_model->custom_qr_img_generate($qr_token, "downloads/tickets_qr_code_imgs/ticket_" . $qr_token . ".png");
						} else {
							$ticket_params[] = [
								'ticket_no' => $user_id . '_' . $item['gig_id'] . '_' . $res . '_' . $item['ticket_tier_id'] . '_' . $i,
								'gig_id' => $item['gig_id'],
								'ticket_tier_id' => $item['ticket_tier_id'],
								'booking_id' => $res,
								'user_id' => $user_id,
								'qr_token' => '',
							];
						}

						$item['qty']--;
						$i++;
					}
				}
				$resp = $this->bookings_model->insert_cart_data($cart_params);
				$this->gigs_model->insert_tickets_data($ticket_params);
			}

			$ticket_bought = $this->bookings_model->get_gig_ticket_bought($gig_id);
			// $items = $this->bookings_model->get_booking_items_by_gig_id($gig_id);
			// $ticket_bought = 0;
			// foreach ($items as $item) {
			// 	$ticket_bought += $item->quantity;
			// }
			// echo json_encode($ticket_bought->quantity);
			// die();

			$this->create_customer($token, $email_to, $name, $res);
			if ($ticket_bought->quantity > $threshold) {
				$this->charge_and_transfer($gig_id);
			}
			$this->calculate_popularity($gig_id, $ticket_bought->quantity);
			// $is_sent = $this->send_email($email_to, 'Booking Done', 'ticket_purchase');
			if ($is_physical_gig == 1 && (isset($gig_id) && $gig_id > 0)) {
				$this->sendQRCode_Email($gig_id, $user_id);
			}
			if (true) {
				$this->cart->destroy();
				// redirect('cart/checkout');
				// redirect('cart/thankyou');
				$this->load->view('frontend/cart/thankyou', ['gig_id' => $gig_id]);
			} else {
				redirect('cart/checkout');
			}
		} else {
			$cart_items = $this->cart->contents();

			if ($this->dbs_user_id) {
				$data['user'] = $this->users_model->get_user_by_id($this->dbs_user_id);
			} else {
				// $uri = uri_string();
				// $this->session->set_userdata('redirect', $uri);
				$data['user'] = [];
			}

			$data['cart_items'] = $cart_items;
			$data['total_amount'] = $this->cart->total();
			$this->load->view('frontend/cart/checkout', $data);
		}
	}

	public function sendQRCode_Email($sl_gig_id, $sl_usr_id)
	{
		/* $config = Array(
		  'protocol' => 'smtp',
		  'smtp_host' => 'ssl://smtp.googlemail.com',
		  'smtp_port' => 465,
		  'smtp_user' => 'abc@gmail.com', 
		  'smtp_pass' => 'passwrd', 
		  'mailtype' => 'html',
		  'charset' => 'iso-8859-1',
		  'wordwrap' => TRUE
		);
		
		$this->load->library('email', $config);*/

		$this->load->library('email');
		$from_name = $this->config->item('from_name');
		$from_email = $this->config->item('info_email');

		$rows = $this->gigs_model->get_tickets_by_gig_and_userid($sl_gig_id, $sl_usr_id);
		if (isset($rows)) {
			foreach ($rows as $row) {
				$gig_ticket_no = $row->ticket_no;
				$gig_ticket_qr_token = $row->qr_token;

				if (strlen($gig_ticket_qr_token) > 0) {

					$mail_to_name = $row->fname . ' ' . $row->lname;
					$mail_to = $row->email;

					$gig_title = $row->title;
					$gig_subtitle = $row->subtitle;
					$gig_category = $row->category;
					$gig_poster = $row->poster;
					$gig_address = $row->address;
					$gig_poster = $row->poster;

					$mail_text = "Hi $mail_to_name, <br> <br> Gigniter is sending you, your new created Tick QR Code as attached below. <br> <br> Regards, <br> Gigniter Team";

					//$this->email->set_newline("\r\n");  
					$this->email->from($from_email, $from_name);
					$this->email->to($mail_to);
					$this->email->subject($gig_title . ' ' . $gig_ticket_no);
					$this->email->message($mail_text);
					if ($_SERVER['HTTP_HOST'] == "localhost") { /* skip mail sending */
						$attched_file = $_SERVER["DOCUMENT_ROOT"] . "/gigniter/downloads/tickets_qr_code_imgs/ticket_" . $gig_ticket_qr_token . ".png";
					} else {
						$attched_file = $_SERVER["DOCUMENT_ROOT"] . "/downloads/tickets_qr_code_imgs/ticket_" . $gig_ticket_qr_token . ".png";

						$this->email->attach($attched_file);
						$this->email->send();
					}

					/*if($this->email->send()){
						echo 'Email send.';
					}else{
						show_error($this->email->print_debugger());
					}*/
				}
			}
		}
	}

	function create_customer($token, $email, $name, $booking_id)
	{
		require_once('application/libraries/stripe-php/init.php');
		$stripeSecret = $this->config->item('stripe_api_key');
		\Stripe\Stripe::setApiKey($stripeSecret);
		try {
			$customer = \Stripe\Customer::create(array(
				'email' => $email,
				'name' => $name,
				'source'  => $token,
				'description' => 'Gigniter Customer'
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
		$this->bookings_model->update_booking_data($booking_id, array('customer_stripe_id' => $customer->id));
	}

	function charge_and_transfer($gig_id)
	{
		require_once('application/libraries/stripe-php/init.php');
		$stripeSecret = $this->config->item('stripe_api_key');
		\Stripe\Stripe::setApiKey($stripeSecret);

		$currency = $this->config->item('stripe_currency');
		$bookings = $this->bookings_model->get_bookings_by_gig_id($gig_id);
		foreach ($bookings as $booking) {
			// echo $booking->customer_stripe_id;
			// die();
			$total_charged = $booking->price;
			$charge = \Stripe\Charge::create([
				"amount" => $total_charged * 100,
				"currency" => $currency,
				"customer" => $booking->customer_stripe_id,
				"description" => "Thank you for purchasing Tickets from Gigniter!",
				'metadata' => array(
					'order_id' => $booking->booking_no
				)
			]);

			$chargeJson = $charge->jsonSerialize();
			if ($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1) {
				//order details
				$this->bookings_model->update_booking_data($booking->id, array('is_paid' => 1));
				$txn_id = $chargeJson['balance_transaction'];
				$amount = $chargeJson['amount'];
				$payment_currency = $chargeJson['currency'];
				$payment_status = $chargeJson['status'];
				$charge_param = [
					'booking_id' => $booking->id,
					'charge_id' => $chargeJson['id'],
					'transaction_id' => $txn_id,
					'user_send' => $booking->user_id,
					'amount' => $amount / 100,
					'type' => $chargeJson['object'],
					'customer_id' => $chargeJson['customer'],
					'created_on' => date('Y-m-d H:i:s', $chargeJson['created']),
				];

				$this->bookings_model->insert_transaction_data($charge_param);

				$cart_items = $this->bookings_model->get_booking_items($booking->id);
				//if order inserted successfully
				if ($payment_status == 'succeeded') {
					foreach ($cart_items as $item) {
						$gig = $this->gigs_model->get_gig_by_id($item->gig_id);
						$user_stripe_detail = $this->users_model->get_user_stripe_details($gig->user_id);
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
						// echo json_encode($transfer);
						// die();
					}
				}
				// else {

				// 	$out['status'] = '2';
				// 	$out['message'] = 'Error: Customer Charge has been failed!';
				// 	// $out['txn_id'] = $txn_id;
				// 	// $out['amount'] = $amount;
				// 	// $out['currency'] = $payment_currency;
				// 	// $out['payment_status'] = $payment_status;
				// 	// $out['transfer'] = '';
				// 	$this->session->set_flashdata('error_msg', $out['message']);
				// 	redirect('cart/checkout');
				// 	echo json_encode($out);
				// 	die();
				// }
			}
			// else {

			// 	$out['status'] = '3';
			// 	$out['message'] = 'Error: Transaction has been failed!';
			// 	$this->session->set_flashdata('error_msg', $out['message']);
			// 	redirect('cart/checkout');
			// 	echo json_encode($out);
			// 	die();
			// }
		}
		// echo json_encode($bookings);
		// die();
	}

	function calculate_popularity($gig_id, $backers)
	{
		$weightages = $this->configurations_model->get_all_configurations_by_key('popularity_weightage');
		$data = array();
		$data = [
			'backers_per_day_weightage' => 0,
			'percentage_funded_weightage' => 0,
			'percentage_per_day_weightage' => 0,
			'amount_raised_weightage' => 0,
		];
		if ($weightages) {
			foreach ($weightages as $weight) {
				$data[$weight->label . '_weightage'] = $weight->value;
			}
		}
		// echo json_encode($data);
		// die();
		$popularity = 0;

		$campaign_date = $this->gigs_model->get_gig_campaign_date_diff($gig_id);
		$diff = abs($campaign_date->diff) == 0 ? 1 : abs($campaign_date->diff);
		// echo $diff;
		// die();
		$backers_score = ($backers / $diff) * $data['backers_per_day_weightage'];
		$popularity += $backers_score;

		$amount_raised = $this->bookings_model->get_gig_amount_raised($gig_id);
		$goal_amount = $this->gigs_model->get_gig_goal_amount($gig_id);
		$percentage_funded = (100 * $amount_raised->price / $goal_amount->goal_amount);
		$percentage_funded_score = $percentage_funded * $data['percentage_funded_weightage'];
		$popularity += $percentage_funded_score;

		$percentage_per_day_score = ($percentage_funded / $diff) * $data['percentage_per_day_weightage'];
		$popularity += $percentage_per_day_score;

		$amount_raised_score = $amount_raised->price * $data['amount_raised_weightage'];
		$popularity += $amount_raised_score;

		$param = [
			'popularity' => $popularity
		];
		$gig_popularity = [
			'gig_id' => $gig_id,
			'date_diff' => $diff,
			'backers' => $backers ?? 0,
			'amount_raised' => $amount_raised->price ?? 0,
			'score' => $popularity
		];
		$gig_popularity_data = $this->gigs_model->get_gig_popularity_data($gig_id);
		if ($gig_popularity_data) {
			$this->gigs_model->delete_gig_popularity_data($gig_id);
		}
		$this->gigs_model->insert_gig_popularity_data($gig_popularity);
		$this->gigs_model->update_gig_data($gig_id, $param);
	}

	function refresh_popularity()
	{
		$gigs = $this->gigs_model->get_all_active_gigs();
		if ($gigs) {
			foreach ($gigs as $gig) {
				$ticket_bought = $this->bookings_model->get_gig_ticket_bought($gig->id);
				$this->calculate_popularity($gig->id, $ticket_bought->quantity);
			}
			$this->session->set_flashdata('success_msg', 'Popularity score is updated!');
		} else {
			$this->session->set_flashdata('error_msg', 'Problem occured!');
		}
		redirect('admin/gigs/popular_gigs');
		// echo json_encode($gigs);
		// die();
	}

	function send_email($to_email, $subject, $email_for)
	{
		$this->load->library('email');
		$from_email = $this->config->item('info_email');
		$from_name = $this->config->item('from_name');

		if ($email_for == 'verification') {
			$this->load->helper('string');
			$code = random_string('alnum', 6);
			$this->session->set_userdata(['verification_code' => $code]);
			$data['link'] = user_base_url() . 'account/verify_email?email=' . $this->general_model->safe_ci_encoder($to_email) . '&code=' . $this->general_model->safe_ci_encoder($code);
			$msg = $this->load->view('email/verification_code', $data, TRUE);
		}
		if ($email_for == 'account_password') {
			$data['password'] = $this->session->userdata('password');
			$msg = $this->load->view('email/account_password', $data, TRUE);
			$this->session->unset_userdata('password');
		}
		if ($email_for == 'forgot_password') {
			$data['link'] = user_base_url() . 'account/reset_password/' . $this->general_model->safe_ci_encoder($to_email);
			$msg = $this->load->view('email/forgot_password', $data, TRUE);
		}

		if ($email_for == 'ticket_purchase') {
			// $data['link'] = user_base_url() . 'account/reset_password/' . $this->general_model->safe_ci_encoder($to_email);
			$msg = $this->load->view('email/ticket_purchase', '', TRUE);
		}
		$this->email->from($from_email, $from_name);
		$this->email->to($to_email);
		$this->email->subject($subject);
		$this->email->message($msg);
		// echo json_encode($this->email);
		// die();
		//Send mail
		if ($this->email->send()) {
			return true;
		} else {
			// return false;
			echo json_encode($this->email->print_debugger());
			die();
		}
	}

	function thankyou()
	{
		$this->load->view('frontend/cart/thankyou');
	}
}
