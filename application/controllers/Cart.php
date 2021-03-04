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

	public function detail()
	{
		$id = $_GET['gig'];
		$gig = $this->gigs_model->get_gig_by_id($id);
		$user = $this->users_model->get_user_by_id($gig->user_id);
		$gig->user_name = $user->fname . ' ' . $user->lname;
		$args1 = [
			'key' => $this->genre_key,
			'value' => $gig->genre
		];
		$genre = $this->configurations_model->get_configuration_by_key_value($args1);
		$gig->genre_name = $genre->label;
		$args2 = [
			'key' => $this->category_key,
			'value' => $gig->category
		];
		$category = $this->configurations_model->get_configuration_by_key_value($args2);
		$gig->category_name = $category->label;
		$gig->booked = 0;
		$now = new DateTime();
		$gig_date = new DateTime($gig->gig_date);
		$interval = $gig_date->diff($now);
		$gig->days_left = $interval->format('%a');
		$gig->ticket_left = $gig->goal - 0;
		$data['gig'] = $gig;
		// echo json_encode($gig);die();
		$this->load->view('frontend/gigs/detail', $data);
	}

	public function add()
	{
		$gig_id = $this->input->post('gig_id');
		$ticket_tier_id = $this->input->post('tier');
		$tier = $this->gigs_model->get_ticket_tier_by_id($ticket_tier_id);
		$gig = $this->gigs_model->get_gig_by_id($gig_id);
		$quantity = $this->input->post('quantity');
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

	// function update($args1 = '')
	// {

	// 	if (isset($_POST) && !empty($_POST)) {
	// 		// get form input
	// 		$data = $_POST;
	// 		// echo json_encode($data);
	// 		// echo json_encode($_FILES);
	// 		// die();

	// 		// form validation
	// 		$this->form_validation->set_rules("title", "Title", "trim|required|xss_clean");
	// 		$this->form_validation->set_rules("category", "Category", "trim|required|xss_clean");
	// 		$this->form_validation->set_rules("genre", "Genre", "trim|required|xss_clean");
	// 		$this->form_validation->set_rules("goal", "Goal", "trim|required|xss_clean");
	// 		$this->form_validation->set_rules("campaign_date", "Campaign Date", "trim|required|xss_clean");
	// 		$this->form_validation->set_rules("gig_date", "Gig date", "trim|required|xss_clean");

	// 		if ($this->form_validation->run() == FALSE) {
	// 			// validation fail
	// 			redirect('gigs/update/' . $data['id']);
	// 		} else {

	// 			$datas = array(
	// 				'title' => $data['title'],
	// 				'subtitle' => $data['subtitle'] ?? null,
	// 				'category' => $data['category'],
	// 				'genre' => $data['genre'],
	// 				'address' => $data['address'] ?? null,
	// 				'goal' => $data['goal'],
	// 				'meeting_platform' => $data['meeting_platform'] ?? null,
	// 				'meeting_url' => $data['meeting_url'] ?? null,
	// 				'is_overshoot' => $data['is_overshoot'] ?? 0,
	// 				'campaign_date' => date('Y-m-d H:i:s', strtotime($data['campaign_date'])),
	// 				'gig_date' => date('Y-m-d H:i:s', strtotime($data['gig_date'])),
	// 				'start_time' => date('H:i:s', strtotime($data['start_time'])),
	// 				'end_time' => date('H:i:s', strtotime($data['end_time'])),
	// 				'venues' => array_key_exists('venues', $data) ? implode(',', $data['venues']) : '',
	// 			);

	// 			$prof_poster_error = '';
	// 			$alw_typs = array('image/jpg', 'image/jpeg', 'image/png', 'image/gif');
	// 			// $imagename = (isset($_POST['old_image']) && $_POST['old_image'] != '') ? $_POST['old_image'] : '';
	// 			$gig = $this->gigs_model->get_gig_by_id($data['id']);
	// 			if (isset($_FILES['poster']['tmp_name']) && $_FILES['poster']['tmp_name'] != '') {
	// 				// echo json_encode($_FILES['image']);
	// 				// die();
	// 				if (!(in_array($_FILES['poster']['type'], $alw_typs))) {
	// 					$tmp_img_type = "'" . ($_FILES['poster']['type']) . "'";
	// 					$prof_poster_error .= "Poster type: $tmp_img_type not allowed!<br>";
	// 				}

	// 				if ($prof_poster_error == '') {
	// 					@unlink("downloads/posters/thumb/$gig->poster");
	// 					@unlink("downloads/posters/$gig->poster");
	// 					$image_path = poster_relative_path();
	// 					$thumbnail_path = poster_thumbnail_relative_path();
	// 					$imagename = time() . $this->general_model->fileExists($_FILES['poster']['name'], $image_path);
	// 					$target_file = $image_path . $imagename;
	// 					@move_uploaded_file($_FILES["poster"]["tmp_name"], $target_file);
	// 					$width = 360;
	// 					$height = 354;
	// 					$thumbnail = $this->general_model->_create_thumbnail($imagename, $image_path, $thumbnail_path, $width, $height);
	// 					if ($thumbnail == '1') {
	// 						$thumbnail_file = $thumbnail_path . $imagename;
	// 					}
	// 					// echo $thumbnail;
	// 					@move_uploaded_file($_FILES["poster"]["tmp_name"], $thumbnail_file);
	// 					$datas['poster'] = $imagename;
	// 				}
	// 				if (strlen($prof_poster_error) > 0) {
	// 					$this->session->set_flashdata('prof_poster_error', $prof_poster_error);
	// 					redirect('admin/gigs/update');
	// 					// $this->load->view('admin/users/add', $data);
	// 				}
	// 			}
	// 			// echo json_encode($datas);
	// 			// die();
	// 			$user_id = $gig->user_id;
	// 			$file = [];
	// 			if (isset($_FILES['image']['tmp_name']) && $_FILES['image']['tmp_name'] != '') {
	// 				$file = $_FILES['image'];
	// 			}
	// 			$this->update_user_data($data, $file, $user_id);
	// 			$res = $this->gigs_model->update_gig_data($data['id'], $datas);
	// 			if (isset($res)) {
	// 				$this->remove_tickets($data['id']);
	// 				$this->add_tickets($data, $data['id']);
	// 				$this->session->set_flashdata('success_msg', 'Gig updated successfully!');
	// 			} else {
	// 				$this->session->set_flashdata('error_msg', 'Error: while updating gig!');
	// 			}

	// 			redirect("my_gigs");
	// 		}
	// 	} else {
	// 		$gig = $this->gigs_model->get_gig_by_id($args1);
	// 		$venues = explode(',', $gig->venues);
	// 		$gig->venues = $venues;
	// 		$data['gig'] = $gig;
	// 		// $param = [
	// 		// 	'user_id' => $this->dbs_user_id,
	// 		// 	'gig_id' => $args1
	// 		// ];
	// 		$tickets = $this->gigs_model->get_ticket_tiers_by_gig_id($args1);
	// 		foreach ($tickets as $ticket) {
	// 			$bundles = $this->gigs_model->get_ticket_bundles_by_ticket_tier_id($ticket->id);
	// 			$ticket->bundles = $bundles;
	// 		}
	// 		$data['tickets'] = $tickets;
	// 		$data['categories'] = $this->configurations_model->get_all_configurations_by_key('category');
	// 		$data['genres'] = $this->configurations_model->get_all_configurations_by_key('genre');
	// 		$data['status'] = $this->configurations_model->get_all_configurations_by_key('gig-status');
	// 		$data['countries'] = $this->countries_model->get_all_countries();
	// 		$data['user'] = $this->users_model->get_user_by_id($gig->user_id);
	// 		$links = $this->users_model->get_social_links($gig->user_id);
	// 		if (isset($links) && !empty($links)) {
	// 			foreach ($links as $key => $val) {
	// 				$temp[] = [$val->platform => $val->url];
	// 			}
	// 			$data['link'] = $temp;
	// 		} else {
	// 			$data['link'] = [];
	// 		}
	// 		// echo json_encode($data);
	// 		// die();
	// 		$this->load->view('frontend/gigs/update', $data);
	// 	}
	// }

	// function trash($args2 = '')
	// {
	// 	// $res_nums = $this->general_model->check_controller_method_permission_access('Admin/Users', 'trash', $this->dbs_role_id, '1');
	// 	// if ($res_nums > 0) {

	// 	// $data['page_headings'] = "Users List";
	// 	// echo $args2;
	// 	// die();
	// 	$gig = $this->gigs_model->get_gig_by_id($args2);
	// 	@unlink("downloads/posters/thumb/$gig->poster");
	// 	@unlink("downloads/posters/$gig->poster");
	// 	$this->remove_tickets($args2, 1);
	// 	$this->gigs_model->trash_gig($args2);
	// 	$this->session->set_flashdata('deleted_msg', 'Gig is deleted');
	// 	redirect('my_gigs');
	// 	// } else {
	// 	// 	$this->load->view('admin/no_permission_access');
	// 	// }
	// }

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
