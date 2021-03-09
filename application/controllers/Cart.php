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
		// $this->load->model('user/configurations_model', 'configurations_model');
		// $this->load->model('user/countries_model', 'countries_model');
		$this->load->model('user/carts_model', 'carts_model');
		$this->load->model('user/gigs_model', 'gigs_model');
		$perms_arrs = array('role_id' => $vs_role_id);
		// $this->gig_status_key = 'gig-status';
		// $this->genre_key = 'genre';
		// $this->category_key = 'category';

		// $this->load->library('Ajax_pagination');
		$this->load->library('cart');
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
		if($data['gig']->venues) {
			$data['venues'] = explode(',', $data['gig']->venues);
		}
		$tiers = $this->gigs_model->get_ticket_tiers_by_gig_id($gig_id);
		foreach($tiers as $tier) {
			$tier->bundles = $this->gigs_model->get_ticket_bundles_by_ticket_tier_id($tier->id);
			$tier->image = '';
			if($tier->bundles) {
				foreach($tier->bundles as $bundle) {
					if($tier->image == '') {
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
		if (isset($_POST) && !empty($_POST)) {
			// echo json_encode($_POST);
			// die();
			$email_to = $this->input->post("user_email");
			$fname = $this->input->post("user_fname");
			$lname = $this->input->post("user_lname");
			$is_sent = $this->send_email($email_to, 'Order Created', 'ticket_purchase');
			if ($is_sent) {
				$this->cart->destroy();
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
					$insert_data = $this->users_model->insert_user_data($datas);
					$is_sent1 = $this->send_email($email_to, 'Account Registration', 'account_password');
					$is_sent2 = $this->send_email($email_to, 'Verification Code', 'verification');
				}
				redirect('cart/thankyou');
			} else {
				redirect('cart/checkout');
			}
		} else {
			// $this->session->unset_userdata('redirect');
			// if (isset($this->dbs_user_id) && (isset($this->dbs_role_id) && $this->dbs_role_id >= 1)) {
			// $data['user'] = $this->users_model->get_user_by_id($this->dbs_user_id);
			// $link = $this->users_model->get_specific_social_link($this->dbs_user_id, 'mail');
			// $data['mail_link'] = $link->url;

			if ($this->dbs_user_id) {
				$data['user'] = $this->users_model->get_user_by_id($this->dbs_user_id);
				$link = $this->users_model->get_specific_social_link($this->dbs_user_id, 'mail');
				$data['mail_link'] = $link->url ?? '';
			} else {
				$uri = uri_string();
				// $this->session->set_userdata('redirect', $uri);
				$data['user'] = [];
				$data['mail_link'] = '';
			}

			$cart_items = $this->cart->contents();
			$data['cart_items'] = $cart_items;
			// echo json_encode($cart_items);
			// die(); 

			// $gig = $this->gigs_model->get_gig_by_id($this->session->userdata('gig_id'));
			// $venues = explode(',', $gig->venues);
			// foreach ($venues as $venue) {
			// 	$temp[] = str_replace('-', ' ', $venue);
			// }
			// $gig->venues = $temp;
			// $data['gig'] = $gig;
			// $tier =  $this->session->userdata('ticket_tier');
			// echo $tier;
			// die();
			// $data['quantity'] = $this->session->userdata('quantity');
			// $tier = $this->gigs_model->get_ticket_tier_by_id($this->session->userdata('ticket_tier'));
			// $data['tier'] = $tier;
			// $price = $data['quantity'] * $tier->price;
			// $data['total_price'] = $price;
			// echo json_encode($data);
			// die();
			$this->load->view('frontend/cart/checkout', $data);
			// } else {
			// 	$uri = uri_string();
			// 	$this->session->set_userdata('redirect', $uri);
			// 	redirect('login');
			// }
		}
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
