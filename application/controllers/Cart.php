<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();


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
		// $this->load->model('user/countries_model', 'countries_model');
		$this->load->model('user/bookings_model', 'bookings_model');
		$this->load->model('user/gigs_model', 'gigs_model');
		$perms_arrs = array('role_id' => $vs_role_id);
		// $this->gig_status_key = 'gig-status';
		// $this->genre_key = 'genre';
		// $this->category_key = 'category';

		// $this->load->library('Ajax_pagination');
		$this->load->library('cart');
		// $this->load->library('stripe');
		// $this->perPage = 25;
	}

	public function index()
	{
		$data['user'] = $this->users_model->get_user_by_id($this->dbs_user_id);
		$user_id = $this->dbs_user_id ?? 0;
		$cart_items = $this->carts_model->get_user_cart_items($user_id);
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
		// echo json_encode($_POST);
		// die();
		$gig_id = $this->input->post('gig_id');
		$ticket_tier_id = $this->input->post('ticket_tier_id');
		$tier = $this->gigs_model->get_ticket_tier_by_id($ticket_tier_id);
		$gig = $this->gigs_model->get_gig_by_id($gig_id);
		$quantity = $this->input->post('qty');
		$created_on = date('Y-m-d H:i:s');
		// $user_id = $this->dbs_user_id;
		// $params = [
		// 	'gig_id' => $gig_id,
		// 	'ticket_tier_id' => $ticket_tier_id,
		// 	'quantity' => $quantity,
		// 	'user_id' => $user_id ?? 0,
		// 	'created_on' => $created_on,
		// ];
		// $res = $this->carts_model->insert_cart_data($params);
		$param = [
			'id' => $ticket_tier_id,
			'gig_id' => $gig_id,
			'gig_title' => $gig->title,
			'ticket_tier_id' => $ticket_tier_id,
			'qty' => $quantity,
			'price' => $tier->price,
			'name' => $tier->name,
			'created_on' => $created_on,
		];
		$res = $this->cart->insert($param);

		if ($res) {
			redirect('cart/checkout');
			// $response = [
			// 	'status' => '200',
			// 	'message' => 'Added to Cart'
			// ];
		} else {
			// $response = [
			// 	'status' => '500',
			// 	'message' => 'Problem occured!'
			// ];
		}
		// echo json_encode($response);
	}


	function checkout()
	{
		// // $this->cart->destroy();
		// echo json_encode($this->session->userdata());
		// die();
		$cart_items = $this->cart->contents();
		if (isset($_POST) && !empty($_POST) && !empty($cart_items)) {

			$email_to = $this->input->post("user_email");
			$fname = $this->input->post("user_fname");
			$lname = $this->input->post("user_lname");
			$name = ucfirst($fname). ' ' . ucfirst($lname);
			$token = $this->input->post('stripe-token');

			
			$user = $this->users_model->get_user_by_email($email_to);
			if (!$user) {
				$this->load->helper('string');
				$password = random_string('alnum', 8);
				$this->session->set_userdata(['password' => $password]);
				$password = $this->general_model->safe_ci_encoder($password);
				$role = $this->roles_model->get_role_by_name('User');
				$created_on = date('Y-m-d H:i:s');
				$status = 0;
				$datas = array(
					'email' => $email_to,
					'fname' => $fname,
					'lname' => $lname ?? '',
					'password' => $password,
					'role_id' => $role->id,
					'status' => $status,
					'created_on' => $created_on
				);
				$user_id = $this->users_model->insert_user_data($datas);
				$is_sent1 = $this->send_email($email_to, 'Account Registration', 'account_password');
				$is_sent2 = $this->send_email($email_to, 'Verification Code', 'verification');
			}

			// echo json_encode($_POST);
			// die();

			$price = $this->cart->total();
			$booking_no = 'GN_' . strtotime('now');
			$created_on = date('Y-m-d H:i:s', strtotime('now'));
			$booking_params = [
				'booking_no' => $booking_no,
				'user_id' => $user ? $user->id : $user_id,
				'price' => $price,
				'is_paid' => 0,
				'created_on' => $created_on
			];
			$res = $this->bookings_model->insert_booking_data($booking_params);
			if($res){
				foreach($cart_items as $item) {
					$cart_params[] = [
						'gig_id' => $item['gig_id'],
						'ticket_tier_id' => $item['ticket_tier_id'],
						'quantity' => $item['qty'],
						'price' => $item['subtotal'],
						'user_id' => $user ? $user->id : $user_id,
						'booking_id' => $res,
						'created_on' => $item['created_on'],
					];
				}
				$resp = $this->bookings_model->insert_cart_data($cart_params);
			}
			$customer_id = $this->create_customer($token, $email_to, $name);
			$cust_param = [
				'customer_id' => $customer_id,
				'email' => $email_to,
				'user_id' => $user ? $user->id : $user_id,
				'booking_id' => $res,
				'created_on' => $created_on
			];
			$this->customers_model->insert_customer_data($cust_param);
			// $this->charge_amount($price, $customer_id);

			$is_sent = $this->send_email($email_to, 'Booking Done', 'ticket_purchase');
			if ($is_sent) {
				$this->cart->destroy();
				redirect('cart/thankyou');
			} else {
				redirect('cart/checkout');
			}
		} else {
			if ($this->dbs_user_id) {
				$data['user'] = $this->users_model->get_user_by_id($this->dbs_user_id);
			} else {
				// $uri = uri_string();
				// $this->session->set_userdata('redirect', $uri);
				$data['user'] = [];
			}

			$cart_items = $this->cart->contents();
			$data['cart_items'] = $cart_items;
			$this->load->view('frontend/cart/checkout', $data);
		}
	}

	function create_customer($token, $email, $name)
	{
		require_once('application/libraries/stripe-php/init.php');
		$stripeSecret = $this->config->item('stripe_api_key');
		$stripe = new \Stripe\StripeClient($stripeSecret);
		$customer = $stripe->customers->create([
			'source' => $token,
			'email' => $email,
			'name' => $name,
			'description' => 'Gigniter Customer',
		]);
		// echo json_encode($customer);
		// die();
		return $customer->id;
	}

	function charge_amount($amount, $customer_id)
	{
		require_once('application/libraries/stripe-php/init.php');
		$stripeSecret = $this->config->item('stripe_api_key');
		$currency = $this->config->item('stripe_currency');

		$stripe = new \Stripe\StripeClient($stripeSecret);

		$charge = $stripe->charges->create([
			"amount" => "10000",
			"currency" => $currency,
			"source" => $customer_id,
			"capture" => false,
			"description" => "Thank you for pledging!"
		]);

		// after successfull payment, you can store payment related information into your database

		// $data = array('success' => true, 'data' => $transaction);

		echo json_encode($charge);
		die();
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
