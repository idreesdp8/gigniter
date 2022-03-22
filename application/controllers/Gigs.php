<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gigs extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();


		$this->dbs_user_id = $vs_id = $this->session->userdata('us_id');
		$this->login_vs_role_id = $this->dbs_role_id = $vs_role_id = $this->session->userdata('us_role_id');
		$this->load->model('user/general_model', 'general_model');
		$this->load->model('user/permissions_model', 'permissions_model');
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
		$this->load->model('user/configurations_model', 'configurations_model');
		$this->load->model('user/countries_model', 'countries_model');
		$this->load->model('user/bookings_model', 'bookings_model');
		$this->load->model('user/gigs_model', 'gigs_model');
		$perms_arrs = array('role_id' => $vs_role_id);
		$this->gig_status_key = 'gig-status';
		$this->genre_key = 'genre';
		$this->category_key = 'category';

		$this->load->library('Ajax_pagination');
		$this->perPage = 10;
	}

	public function detail()
	{
		$id = $_GET['gig'];
		$gig = $this->gigs_model->get_gig_by_id($id);
		$user_bookings = $this->bookings_model->get_bookings_by_user_and_gig_id($this->dbs_user_id, $id);
		// echo json_encode($user_bookings);
		// die();
		if ($gig->is_approved || ($this->dbs_user_id && $this->dbs_user_id == $gig->user_id)) {
			$user = $this->users_model->get_user_by_id($gig->user_id);
			$gig->user_name = (isset($user->fname)) ? $user->fname . ' ' . $user->lname : '';
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
			$now = new DateTime();
			$gig_date = new DateTime($gig->gig_date);
			$interval = $gig_date->diff($now);
			$gig->days_left = $interval->format('%a');

			$res = $this->get_tickets_booked_and_left($gig);
			$gig->booked = $res['booked'];
			$gig->ticket_left = $res['ticket_left'];
			$gig->images = $this->gigs_model->get_gig_gallery_images($id);
			if ($gig->start_time && $gig->end_time) {
				$start_time = new DateTime($gig->start_time);
				$end_time = new DateTime($gig->end_time);
				$duration = $end_time->diff($start_time);
				$gig->duration = $duration->format('%h hrs %i mins');
			} else {
				$gig->duration = 'NA';
			}
			$buyers = array();
			$res = $this->gigs_model->get_gig_buyers($id);
			foreach ($res as $k => $v) {
				$buyers[] = $v->user_id;
			}
			$gig->buyers = $buyers;
			$gig->reactions = $this->gigs_model->get_reaction_count($id);
			$data['gig'] = $gig;
			$tiers = $this->gigs_model->get_ticket_tiers_by_gig_id($id);
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
			$user;
			$links = $this->users_model->get_social_links($gig->user_id);
			foreach ($links as $link) {
				if ($link->platform == 'mail') {
					$user->mail = $link->url;
				} elseif ($link->platform == 'facebook') {
					$user->facebook = $link->url;
				} elseif ($link->platform == 'instagram') {
					$user->instagram = $link->url;
				} elseif ($link->platform == 'twitter') {
					$user->twitter = $link->url;
				}
			}
			$data['tiers'] = $tiers;
			$data['user'] = $user;
			$data['user_bookings'] = $user_bookings;
			$data['stream_details'] = $this->gigs_model->get_stream_details($id);
			// echo json_encode($data);die();
			$this->load->view('frontend/gigs/detail', $data);
		} else {
			redirect('/');
		}
	}

	public function create_user($data, $file)
	{
		$social_links = [];
		if (isset($data['mail']) && $data['mail'] != '') {
			$social_links['mail'] = $data['mail'];
		}
		if (isset($data['facebook']) && $data['facebook'] != '') {
			$social_links['facebook'] = $data['facebook'];
		}
		if (isset($data['instagram']) && $data['instagram'] != '') {
			$social_links['instagram'] = $data['instagram'];
		}
		if (isset($data['twitter']) && $data['twitter'] != '') {
			$social_links['twitter'] = $data['twitter'];
		}
		$role = $this->roles_model->get_role_by_name('User');

		// $password = $data['password'];
		$password = $this->general_model->safe_ci_encoder($data['password']);
		$created_on = date('Y-m-d H:i:s');
		$status = 0;
		$datas = array(
			'fname' => $data['fname'],
			'lname' => $data['lname'],
			'email' => $data['email'],
			'password' => $password,
			'description' => $data['description'],
			'address' => $data['user_address'],
			'role_id' => $role->id,
			'status' => $status,
			'created_on' => $created_on,
			'country_id' => $data['country_id'],
		);

		$prf_img_error = '';
		$alw_typs = array('image/jpg', 'image/jpeg', 'image/png', 'image/gif');
		// $imagename = (isset($_POST['old_image']) && $_POST['old_image'] != '') ? $_POST['old_image'] : '';
		if (!empty($file) && isset($file['tmp_name']) && $file['tmp_name'] != '') {
			// echo json_encode($files['image']);
			// die();
			if (!(in_array($file['type'], $alw_typs))) {
				$tmp_img_type = "'" . ($file['type']) . "'";
				$prf_img_error .= "Profile image type: $tmp_img_type not allowed!<br>";
			}

			if ($prf_img_error == '') {
				$image_path = profile_image_relative_path();
				$thumbnail_path = profile_thumbnail_relative_path();
				$imagename = time() . $this->general_model->fileExists($file['name'], $image_path);
				$target_file = $image_path . $imagename;
				@move_uploaded_file($file["tmp_name"], $target_file);
				$width = 200;
				$height = 200;
				$thumbnail = $this->general_model->_resize_and_crop($imagename, $image_path, $thumbnail_path, $width, $height);
				if ($thumbnail == '1') {
					$thumbnail_file = $thumbnail_path . $imagename;
				}
				// echo $thumbnail;
				@move_uploaded_file($file["tmp_name"], $thumbnail_file);
				$datas['image'] = $imagename;
			}
			if (strlen($prf_img_error) > 0) {
				$this->session->set_flashdata('prof_img_error', $prf_img_error);
				redirect('gigs/update');
				// $this->load->view('admin/users/add', $data);
			}
		}
		$res = $this->users_model->insert_user_data($datas);
		if (isset($res)) {
			$created_on = date('Y-m-d H:i:s');
			foreach ($social_links as $key => $value) {
				$temp = ['user_id' => $res, 'platform' => $key, 'url' => $value, 'created_on' => $created_on];
				$this->users_model->insert_user_social_link($temp);
			}
			// set session	
			$cstm_sess_data = array(
				'us_login' => TRUE,
				'us_id' => $res,
				'us_role_id' => $role->id,
				'us_username' => 'user' . strtotime('now'),
				'us_fname' => ($data['fname'] ? ucfirst($data['fname']) : ''),
				'us_lname' => ($data['lname'] ? ucfirst($data['lname']) : ''),
				'us_fullname' => ($data['fname'] ? ucfirst($data['fname']) : '') . ' ' . ($data['lname'] ? ucfirst($data['lname']) : ''),
				'us_email' => $data['email'],
				'us_role_name' => $role->id,
			);

			$this->session->set_userdata($cstm_sess_data);


			$stripe_id = $data['stripe'];

			$account = $this->create_user_stripe_account($stripe_id);
			$temp = [
				'user_id' => $res,
				'stripe_id' => $stripe_id,
				'stripe_account_id' => $account->id,
			];
			$this->users_model->insert_user_stripe_details($temp);
			$this->send_email($data['email'], 'Verification Code', 'verification');
		}
		return $res;
	}


	public function create_user_stripe_account($stripe_id)
	{
		require_once('application/libraries/stripe-php/init.php');
		$stripeSecret = $this->config->item('stripe_api_key');

		$stripe = new \Stripe\StripeClient($stripeSecret);

		$account = $stripe->accounts->create([
			'type' => 'custom',
			'email' => $stripe_id,
			'capabilities' => [
				'card_payments' => ['requested' => true],
				'transfers' => ['requested' => true],
			],
		]);
		return $account;
		// echo json_encode($account);
		// die();
	}

	public function preview($gig_data = '', $gig_files = '')
	{
		// echo json_encode($gig_data['ticket_name']);
		// die();
		// $gig_data = $this->session->userdata('gig_data');
		// $gig_files = $this->session->userdata('gig_files');
		$category = str_replace('-', ' ', ucwords($gig_data['category'], '-'));
		$genre = str_replace('-', ' ', ucwords($gig_data['genre'], '-'));

		$start_time = new DateTime($gig_data['start_time']);
		$end_time = new DateTime($gig_data['end_time']);
		$duration = $end_time->diff($start_time);
		$gig_duration = $duration->format('%h hrs %i mins');

		$now = new DateTime();
		$gig_date = new DateTime($gig_data['gig_date']);
		$interval = $gig_date->diff($now);
		$days_left = $interval->format('%a');

		$imagename = '';
		if (isset($gig_files['poster']['tmp_name']) && $gig_files['poster']['tmp_name'] != '') {
			$image_path = session_relative_path();
			$thumbnail_path = session_thumbnail_relative_path();
			$imagename = time() . $this->general_model->fileExists($gig_files['poster']['name'], $image_path);
			$target_file = $image_path . $imagename;
			@move_uploaded_file($gig_files["poster"]["tmp_name"], $target_file);
			$width = 360;
			$height = 354;
			$thumbnail = $this->general_model->_resize_and_crop($imagename, $image_path, $thumbnail_path, $width, $height);
			if ($thumbnail == '1') {
				$thumbnail_file = $thumbnail_path . $imagename;
			}
			@move_uploaded_file($gig_files["poster"]["tmp_name"], $thumbnail_file);
		}
		$videoname = '';
		if (isset($gig_files['video']['tmp_name']) && $gig_files['video']['tmp_name'] != '') {
			$video_path = session_relative_path();
			$videoname = time() . $this->general_model->fileExists($gig_files['video']['name'], $video_path);
			$target_file = $video_path . $videoname;
			@move_uploaded_file($gig_files["video"]["tmp_name"], $target_file);
		}

		$data = array(
			'title' => $gig_data['title'],
			'username' => $gig_data['fname'] . ' ' . $gig_data['lname'],
			'genre' => $genre,
			'category' => $category,
			'poster' => $imagename,
			'video' => $videoname,
			'gig_date' => date('d M, Y', strtotime($gig_data['gig_date'])),
			'duration' => $gig_duration,
			'booked' => 0,
			'ticket_limit' => $gig_data['goal'],
			'days_left' => $days_left,
			'stream_url' => '',
			'stream_key' => '',
		);
		// $length = 0;
		// if($gig_data['ticket_name'] && !empty($gig_data['ticket_name'])){
		// 	$tickets = $gig_data['ticket_name'];
		// 	$length = count($tickets);
		// }
		// echo $length;
		// die();
		// for ($i = 0; $i < $length; $i++) {
		$i = 0;
		foreach ($gig_data['ticket_name'] as $ticket_name) {
			if ($ticket_name == '') continue;
			$tier = [];
			$j = $i + 1;
			if ($gig_data['ticket_name'][$i] != '') {
				$tier = [
					'name' => $gig_data['ticket_name'][$i],
					'price' => $gig_data['ticket_price'][$i],
					'quantity' => $gig_data['ticket_quantity'][$i],
				];
			}
			// $bundle_tiers = array();
			// if ($gig_data["bundle_title_tier$j"] && !empty($gig_data["bundle_title_tier$j"])) {
			// 	$bundle_tiers = $gig_data["bundle_title_tier$j"];
			// }
			// $bundle_length = count($bundle_tiers);
			$bundle = [];
			// for ($k = 0; $k < $bundle_length; $k++) {
			foreach ($gig_data["bundle_title_tier$j"] as $bundle_title) {
				if ($bundle_title == '') continue;
				// $j = $i + 1;
				$imagename = '';
				if (isset($gig_files["bundle_image_tier$j"]['tmp_name'][$k]) && $gig_files["bundle_image_tier$j"]['tmp_name'][$k] != '') {
					$image_path = session_relative_path();
					$thumbnail_path = session_thumbnail_relative_path();
					$imagename = hrtime(true) . $this->general_model->fileExists($gig_files["bundle_image_tier$j"]['name'][$k], $image_path);
					$target_file = $image_path . $imagename;
					@move_uploaded_file($gig_files["bundle_image_tier$j"]["tmp_name"][$k], $target_file);
					$width = 200;
					$height = 200;
					$thumbnail = $this->general_model->_resize_and_crop($imagename, $image_path, $thumbnail_path, $width, $height);
					if ($thumbnail == '1') {
						$thumbnail_file = $thumbnail_path . $imagename;
					}
					// echo $thumbnail;
					@move_uploaded_file($gig_files["bundle_image_tier$j"]["tmp_name"][$k], $thumbnail_file);
				}
				$bundle[] = [
					'image' => $imagename,
				];
			}
			$tier['bundle'] = $bundle;
			$tiers[] = $tier;
			$i++;
		}
		$data['tiers'] = $tiers;

		// $this->session->unset_userdata('gig_data');
		// $this->session->unset_userdata('gig_files');
		$this->session->set_userdata('preview_data', $data);
		redirect('gigs/preview2');
		// echo json_encode($data);
		// // echo json_encode($gig_files);
		// echo json_encode($this->session->userdata());
	}

	public function preview2()
	{
		$data = $this->session->userdata('preview_data');
		// echo json_encode($data);
		// die();
		$this->load->view('frontend/gigs/preview', $data);
	}

	public function add()
	{
		if ($this->dbs_user_id) {
			$user = $this->users_model->get_user_by_id($this->dbs_user_id);
			if (!$user->status) {
				redirect('account/verify_account');
			}
		}
		$is_new_user = 0;
		if (isset($_POST) && !empty($_POST)) {
			$data = $_POST;
			$files = $_FILES;
			
			$user_image = [];
			if (isset($_FILES['image']['tmp_name']) && $_FILES['image']['tmp_name'] != '') {
				$user_image = $_FILES['image'];
			}

			$this->form_validation->set_rules("title", "Title", "trim|required|xss_clean");
			$this->form_validation->set_rules("category", "Category", "trim|required|xss_clean");
			$this->form_validation->set_rules("genre", "Genre", "trim|required|xss_clean");
			$this->form_validation->set_rules("goal", "Goal", "trim|required|xss_clean");
			$this->form_validation->set_rules("threshold", "Threshold", "trim|required|xss_clean");
			// $this->form_validation->set_rules("goal_amount", "Goal Amount", "trim|required|xss_clean");
			$this->form_validation->set_rules("campaign_date", "Campaign Date", "trim|required|xss_clean");
			$this->form_validation->set_rules("gig_date", "Gig date", "trim|required|xss_clean");
			$this->form_validation->set_rules("start_time", "Start Time", "trim|required|xss_clean");
			$this->form_validation->set_rules("end_time", "End Time", "trim|required|xss_clean");
			if (!$this->dbs_user_id) {
				$this->form_validation->set_rules(
					'email',
					'Email',
					'trim|required|xss_clean|valid_email|is_unique[users.email]',
					array(
						'is_unique' => 'We\'re sorry, the login email already exists. Please try a different email address to register, or <a class="signup-error-link" href="' . user_base_url() . 'login">login</a> to your existing account.'
					)
				);
				$this->form_validation->set_rules(
					'stripe',
					'Stripe integration',
					'trim|required|xss_clean|valid_email'
				);
			}
			if ($this->form_validation->run() == FALSE) {
				// validation fail
				// $this->load->view('frontend/gigs/add', $data);
				$this->session->set_flashdata('error_msg', 'Error: while adding gig!');
				redirect('gigs/add');
			} else {
				if ($this->dbs_user_id) {
					$this->update_user_data($data, $user_image, $this->dbs_user_id);
					$data['user_id'] = $this->dbs_user_id;
				} else {
					$is_new_user = 1;
					// echo $is_new_user;
					// die();
					$data['user_id'] = $this->create_user($data, $user_image);
				}

				$prf_img_error = '';
				$alw_typs = array('image/jpg', 'image/jpeg', 'image/png', 'image/gif');
				// $imagename = (isset($_POST['old_image']) && $_POST['old_image'] != '') ? $_POST['old_image'] : '';
				$imagename = '';
				// echo 'gg';
				if (isset($_FILES['poster']['tmp_name']) && $_FILES['poster']['tmp_name'] != '') {
					// echo json_encode($_FILES['poster']);
					if (!(in_array($_FILES['poster']['type'], $alw_typs))) {
						$tmp_img_type = "'" . ($_FILES['poster']['type']) . "'";
						$prf_img_error .= "Poster type: $tmp_img_type not allowed!<br>";
						echo $prf_img_error;
					}

					if ($prf_img_error == '') {
						$image_path = poster_relative_path();
						$thumbnail_path = poster_thumbnail_relative_path();
						$imagename = time() . $this->general_model->fileExists($_FILES['poster']['name'], $image_path);
						$target_file = $image_path . $imagename;
						@move_uploaded_file($_FILES["poster"]["tmp_name"], $target_file);
						$width = 360;
						$height = 354;
						$thumbnail = $this->general_model->_resize_and_crop($imagename, $image_path, $thumbnail_path, $width, $height);
						if ($thumbnail == '1') {
							$thumbnail_file = $thumbnail_path . $imagename;
						}
						// echo $thumbnail;
						@move_uploaded_file($_FILES["poster"]["tmp_name"], $thumbnail_file);
					}
					if (strlen($prf_img_error) > 0) {
						$this->session->set_flashdata('prof_img_error', $prf_img_error);
						redirect('gigs/add');
						// $this->load->view('admin/users/add', $data);
					}
				}
				$prf_vid_error = '';
				$alw_typs = array('video/mp4');
				// $imagename = (isset($_POST['old_image']) && $_POST['old_image'] != '') ? $_POST['old_image'] : '';
				$videoname = '';
				// echo 'gg';
				if (isset($_FILES['video']['tmp_name']) && $_FILES['video']['tmp_name'] != '') {
					// echo json_encode($_FILES['poster']);
					if (!(in_array($_FILES['video']['type'], $alw_typs))) {
						$tmp_vid_type = "'" . ($_FILES['video']['type']) . "'";
						$prf_vid_error .= "Video type: $tmp_vid_type not allowed!<br>";
						echo $prf_vid_error;
					}

					if ($prf_vid_error == '') {
						$video_path = video_relative_path();
						$videoname = time() . $this->general_model->fileExists($_FILES['video']['name'], $video_path);
						$target_file = $video_path . $videoname;
						@move_uploaded_file($_FILES["video"]["tmp_name"], $target_file);
					}
					if (strlen($prf_vid_error) > 0) {
						$this->session->set_flashdata('prof_vid_error', $prf_vid_error);
						redirect('gigs/add');
						// $this->load->view('admin/users/add', $data);
					}
				}

				$created_on = date('Y-m-d H:i:s');
				$status = 0;
				$datas = array(
					'user_id' => $data['user_id'],
					'title' => $data['title'] ?? null,
					'subtitle' => $data['subtitle'] ?? null,
					'category' => $data['category'] ?? null,
					'genre' => $data['genre'] ?? null,
					'venues' => array_key_exists('venues', $data) ? implode(',', $data['venues']) : '',
					'address' => $data['address'] ?? null,
					'poster' => $imagename,
					'video' => $videoname,
					'ticket_limit' => $data['goal'] ?? null,
					// 'goal_amount' => $data['goal_amount'] ?? null,
					'threshold' => $data['threshold'] ?? null,
					'meeting_platform' => $data['meeting_platform'] ?? null,
					'meeting_url' => $data['meeting_url'] ?? null,
					'is_overshoot' => $data['is_overshoot'] ?? 0,
					'campaign_date' => $data['campaign_date'] ? date('Y-m-d', strtotime($data['campaign_date'])) : null,
					'gig_date' => $data['campaign_date'] ? date('Y-m-d', strtotime($data['gig_date'])) : null,
					'start_time' => date('H:i:s', strtotime($data['start_time'])),
					'end_time' => date('Y-m-d H:i:s', strtotime($data['end_time'])),
					'status' => $status,
					'is_draft' => $data['is_draft'],
					'created_on' => $created_on,
				);
				// echo json_encode($datas);
				// die();
				// die();
				$res = $this->gigs_model->insert_gig_data($datas);

				if ($res) {
					$gig_history = [
						'gig_id' => $res,
						'action' => 'gig_created',
						'text' => 'Gig is submitted to admin for approval'
					];
					$this->gigs_model->insert_gig_history($gig_history);
					// $this->create_channel($data['title'], $res);
					$user = $this->users_model->get_user_by_id($data['user_id']);
					$this->send_email($user->email, 'Gig Created', 'gig_created');
					$this->add_tickets($data, $res);
					// if($is_new_user){
					// 	redirect('account/verfication_page');
					// }
					// die();
					$this->session->set_flashdata('success_msg', 'Gig added successfully');
					// if ($data['is_draft'] == 2) {
					redirect("gigs/detail?gig=" . $res);
					// }
					// $response = [
					// 	'status' => '200',
					// ];
				} else {
					$this->session->set_flashdata('error_msg', 'Error: while adding gig!');
					// $response = [
					// 	'status' => '500',
					// ];
				}
				// echo json_encode($response);
				// $this->load->view('admin/gigs/add');
				// die();
				redirect('my_gigs');
				// echo json_encode($response);
			}
		} else {
			// if (isset($this->dbs_user_id) && (isset($this->dbs_role_id) && $this->dbs_role_id >= 1)) {

			$data['gig'] = isset($this->dbs_user_id) ? $this->gigs_model->check_completed_gig_by_user_id($this->dbs_user_id) : false;
			// echo json_encode($data);
			// die();
			// if($gig){
			// 	$this->session->set_flashdata('warning_msg', 'You already have a gig waiting for approval');
			// 	redirect('my_gigs');
			// }
			if (isset($this->dbs_user_id)) {
				$user = $this->users_model->get_user_by_id($this->dbs_user_id);
				$stripe_details = $this->users_model->get_user_stripe_details($user->id);
				$user->stripe = $stripe_details->stripe_id ?? '';
				$data['user'] = $user;
			}
			$data['countries'] = $this->countries_model->get_all_countries();
			$data['categories'] = $this->configurations_model->get_all_configurations_by_key('category');
			$data['buffer_days'] = $this->configurations_model->get_all_configurations_by_key('buffer-days')[0]->value;
			$data['genres'] = $this->configurations_model->get_all_configurations_by_key('genre');
			$data['threshold_value'] = $this->configurations_model->get_configuration_by_key('threshold-value');
			$links = $this->users_model->get_social_links($this->dbs_user_id);
			if (isset($links) && !empty($links)) {
				foreach ($links as $key => $val) {
					$temp[] = [$val->platform => $val->url];
				}
				$data['link'] = $temp;
			} else {
				$data['link'] = [];
			}
			// echo json_encode($data);
			// die();

			if ($this->dbs_user_id) {
				$user = $this->users_model->get_user_by_id($this->dbs_user_id);
				if ($user->status) {
					$this->load->view('frontend/gigs/create2', $data);
					// die();
				} else {
					$this->load->view('frontend/gigs/create', $data);
				}
			} else {
				$this->load->view('frontend/gigs/create', $data);
			}
			// } else {
			// 	$uri = uri_string();
			// 	$this->session->set_userdata('redirect', $uri);
			// 	redirect('login');
			// }
		}
	}

	function create_channel($title, $gig_id)
	{
		$channel_name = str_replace(' ', '_', $title);
		$data = $this->configurations_model->get_all_configurations_by_key('aws');
		$key = $data[0]->value;
		$secret = $data[1]->value;
		$version = $data[2]->value;
		$region = $data[3]->value;
		require 'amazonivs/aws-autoloader.php';
		$ivs = new Aws\IVS\IVSClient([
			'version' => $version,
			'region' => $region,
			'credentials' => [
				'key'    => $key,
				'secret' => $secret,
			],
		]);
		$result = $ivs->createChannel([
			'name' => $channel_name
		]);
		$channel = $result->get('channel');
		$streamKey = $result->get('streamKey');
		$datas['channel_arn'] = $channel['arn'];
		$datas['playback_url'] = $channel['playbackUrl'];
		$datas['stream_url'] = 'rtmps://' . $channel['ingestEndpoint'] . ':443/app/';
		$datas['stream_arn'] = $streamKey['arn'];
		$datas['stream_key'] = $streamKey['value'];
		$datas['gig_id'] = $gig_id;
		$this->gigs_model->add_channel($datas);
	}

	function update_user_data($data, $file, $user_id = '')
	{
		// echo json_encode($data);
		// echo json_encode($files);
		// die();
		$social_links = [];
		if (isset($data['mail']) && $data['mail'] != '') {
			$social_links['mail'] = $data['mail'];
		}
		if (isset($data['facebook']) && $data['facebook'] != '') {
			$social_links['facebook'] = $data['facebook'];
		}
		if (isset($data['instagram']) && $data['instagram'] != '') {
			$social_links['instagram'] = $data['instagram'];
		}
		if (isset($data['twitter']) && $data['twitter'] != '') {
			$social_links['twitter'] = $data['twitter'];
		}
		$datas = array(
			'fname' => $data['fname'],
			'lname' => $data['lname'],
			'description' => $data['description'],
			'address' => $data['user_address'],
			'country_id' => $data['country_id'],
		);

		$prf_img_error = '';
		$alw_typs = array('image/jpg', 'image/jpeg', 'image/png', 'image/gif');
		// $imagename = (isset($_POST['old_image']) && $_POST['old_image'] != '') ? $_POST['old_image'] : '';
		if (!empty($file) && isset($file['tmp_name']) && $file['tmp_name'] != '') {
			// echo json_encode($files['image']);
			// die();
			if (!(in_array($file['type'], $alw_typs))) {
				$tmp_img_type = "'" . ($file['type']) . "'";
				$prf_img_error .= "Profile image type: $tmp_img_type not allowed!<br>";
			}

			if ($prf_img_error == '') {
				$user = $this->users_model->get_user_by_id($user_id);
				@unlink("downloads/profile_pictures/thumb/$user->image");
				@unlink("downloads/profile_pictures/$user->image");
				$image_path = profile_image_relative_path();
				$thumbnail_path = profile_thumbnail_relative_path();
				$imagename = time() . $this->general_model->fileExists($file['name'], $image_path);
				$target_file = $image_path . $imagename;
				@move_uploaded_file($file["tmp_name"], $target_file);
				$width = 200;
				$height = 200;
				$thumbnail = $this->general_model->_resize_and_crop($imagename, $image_path, $thumbnail_path, $width, $height);
				if ($thumbnail == '1') {
					$thumbnail_file = $thumbnail_path . $imagename;
				}
				// echo $thumbnail;
				@move_uploaded_file($file["tmp_name"], $thumbnail_file);
				$datas['image'] = $imagename;
			}
			if (strlen($prf_img_error) > 0) {
				$this->session->set_flashdata('prof_img_error', $prf_img_error);
				redirect('gigs/update');
				// $this->load->view('admin/users/add', $data);
			}
		}
		$res = $this->users_model->update_user_data($user_id, $datas);
		if ($res) {
			$created_on = date('Y-m-d H:i:s');
			$this->remove_social_links($user_id);
			foreach ($social_links as $key => $value) {
				$temp = ['user_id' => $user_id, 'platform' => $key, 'url' => $value, 'created_on' => $created_on];
				$this->users_model->insert_user_social_link($temp);
			}
			$cstm_sess_data = array(
				// 'us_username' => ($res->username ? ucfirst($res->username) : ''),
				'us_fname' => ($data['fname'] ? ucfirst($data['fname']) : ''),
				'us_lname' => ($data['lname'] ? ucfirst($data['lname']) : ''),
				'us_fullname' => ($data['fname'] ? ucfirst($data['fname']) : '') . ' ' . ($data['lname'] ? ucfirst($data['lname']) : ''),
			);
			$this->session->set_userdata($cstm_sess_data);
			$stripe_id = $data['stripe'];
			$stripe_details = $this->users_model->get_user_stripe_details($user_id);
			if (!$stripe_details || ($stripe_details && $stripe_details->stripe_id != $stripe_id)) {
				$this->users_model->trash_user_stripe_details($user_id);
				if ($stripe_id) {
					$account = $this->create_user_stripe_account($stripe_id);
					$temp = [
						'user_id' => $user_id,
						'stripe_id' => $stripe_id,
						'stripe_account_id' => $account->id,
					];
					$this->users_model->insert_user_stripe_details($temp);
				}
			}
			return true;
		}
		return false;
	}

	function remove_social_links($id)
	{
		$links = $this->users_model->get_social_links($id);
		if (isset($links)) {
			foreach ($links as $key => $value) {
				$this->users_model->trash_social_link($value->id);
			}
		}
	}

	function add_tickets($data, $gig_id)
	{
		$created_on = date('Y-m-d H:i:s');
		if (isset($data["ticket_name"]) && $data['ticket_name'] != '') {
			$length = count($data['ticket_name']);
			// echo $length;
			// die();
			for ($i = 0; $i < $length; $i++) {
				$j = $i + 1;
				$res = false;
				if ($data['ticket_name'][$i] != '') {
					$tier = [
						'user_id' => $data['user_id'] ?? $this->dbs_user_id,
						'gig_id' => $gig_id,
						'name' => $data['ticket_name'][$i],
						'price' => $data['ticket_price'][$i],
						'quantity' => $data['ticket_quantity'][$i],
						'description' => $data['ticket_description'][$i],
						'is_unlimited' => isset($data["ticket_is_unlimited_$j"]) ? $data["ticket_is_unlimited_$j"] : 0,
						'created_on' => $created_on,
					];
					$res = $this->gigs_model->add_ticket_tier($tier);
				}
				if ($res) {
					// echo $j;
					$this->add_ticket_bundles($data, $res, $j);
					// die();
				}
			}
			return true;
		}
		return false;
	}

	function add_ticket_bundles($data, $res, $tier)
	{
		// echo json_encode($data);
		$created_on = date('Y-m-d H:i:s');
		if (isset($data["bundle_title_tier$tier"])) {
			$length = count($data["bundle_title_tier$tier"]);
			for ($i = 0; $i < $length; $i++) {
				// $j = $i + 1;
				$imagename = (isset($_POST["old_bundle_image_tier$tier"][$i]) && $_POST["old_bundle_image_tier$tier"][$i] != '') ? $_POST["old_bundle_image_tier$tier"][$i] : '';
				if (isset($_FILES["bundle_image_tier$tier"]['tmp_name'][$i]) && $_FILES["bundle_image_tier$tier"]['tmp_name'][$i] != '') {
					$image_path = bundle_relative_path();
					$thumbnail_path = bundle_thumbnail_relative_path();
					$imagename = $res . hrtime(true) . $this->general_model->fileExists($_FILES["bundle_image_tier$tier"]['name'][$i], $image_path);
					$target_file = $image_path . $imagename;
					@move_uploaded_file($_FILES["bundle_image_tier$tier"]["tmp_name"][$i], $target_file);
					$width = 200;
					$height = 200;
					$thumbnail = $this->general_model->_resize_and_crop($imagename, $image_path, $thumbnail_path, $width, $height);
					if ($thumbnail == '1') {
						$thumbnail_file = $thumbnail_path . $imagename;
					}
					// echo $thumbnail;
					@move_uploaded_file($_FILES["bundle_image_tier$tier"]["tmp_name"][$i], $thumbnail_file);
				}
				$bundle = [
					'ticket_tier_id' => $res,
					'title' => $data["bundle_title_tier$tier"][$i],
					'image' => $imagename,
					'created_on' => $created_on,
				];
				// echo json_encode($bundle);
				$this->gigs_model->add_ticket_tier_bundle($bundle);
			}
		}
	}


	function update($args1 = '')
	{
		if ($args1 == '') {
			$args1 = $this->input->post('id');
		}
		$gig = $this->gigs_model->get_gig_by_id($args1);
		if ($gig->user_id == $this->dbs_user_id) {
			if (!$gig->is_approved) {

				if (isset($_POST) && !empty($_POST)) {
					// get form input
					$data = $_POST;
					// echo json_encode($_FILES);
					// echo json_encode($data);
					// die();


					// form validation
					$this->form_validation->set_rules("category", "Category", "trim|required|xss_clean");
					$this->form_validation->set_rules("genre", "Genre", "trim|required|xss_clean");
					$this->form_validation->set_rules("threshold", "Threshold", "trim|required|xss_clean");
					$this->form_validation->set_rules("campaign_date", "Campaign Date", "trim|required|xss_clean");
					$this->form_validation->set_rules("gig_date", "Gig date", "trim|required|xss_clean");

					if ($this->form_validation->run() == FALSE) {
						// validation fail
						redirect('gigs/update/' . $data['id']);
					} else {

						$datas = array(
							'subtitle' => $data['subtitle'] ?? null,
							'category' => $data['category'],
							'genre' => $data['genre'],
							'address' => $data['address'] ?? null,
							// 'goal_amount' => $data['goal_amount'],
							'threshold' => $data['threshold'],
							'meeting_platform' => $data['meeting_platform'] ?? null,
							'meeting_url' => $data['meeting_url'] ?? null,
							'is_overshoot' => $data['is_overshoot'] ?? 0,
							'is_complete' => 1,
							'is_draft' => $data['is_draft'] ?? 1,
							'campaign_date' => date('Y-m-d H:i:s', strtotime($data['campaign_date'])),
							'gig_date' => date('Y-m-d H:i:s', strtotime($data['gig_date'])),
							'start_time' => date('H:i:s', strtotime($data['start_time'])),
							'end_time' => date('Y-m-d H:i:s', strtotime($data['end_time'])),
							'venues' => array_key_exists('venues', $data) ? implode(',', $data['venues']) : '',
						);
						if ($data['goal']) {
							$datas['ticket_limit'] = $data['goal'];
						}
						if ($data['title']) {
							$datas['title'] = $data['title'];
						}
						// echo json_encode($datas);
						// die();

						$prof_poster_error = '';
						$alw_typs = array('image/jpg', 'image/jpeg', 'image/png', 'image/gif');
						// $imagename = (isset($_POST['old_image']) && $_POST['old_image'] != '') ? $_POST['old_image'] : '';
						$gig = $this->gigs_model->get_gig_by_id($data['id']);
						if (isset($_FILES['poster']['tmp_name']) && $_FILES['poster']['tmp_name'] != '') {
							// echo json_encode($_FILES['image']);
							// die();
							if (!(in_array($_FILES['poster']['type'], $alw_typs))) {
								$tmp_img_type = "'" . ($_FILES['poster']['type']) . "'";
								$prof_poster_error .= "Poster type: $tmp_img_type not allowed!<br>";
							}

							if ($prof_poster_error == '') {
								@unlink("downloads/posters/thumb/$gig->poster");
								@unlink("downloads/posters/$gig->poster");
								$image_path = poster_relative_path();
								$thumbnail_path = poster_thumbnail_relative_path();
								$imagename = time() . $this->general_model->fileExists($_FILES['poster']['name'], $image_path);
								$target_file = $image_path . $imagename;
								@move_uploaded_file($_FILES["poster"]["tmp_name"], $target_file);
								$width = 360;
								$height = 354;
								$thumbnail = $this->general_model->_resize_and_crop($imagename, $image_path, $thumbnail_path, $width, $height);
								if ($thumbnail == '1') {
									$thumbnail_file = $thumbnail_path . $imagename;
								}
								// echo $thumbnail;
								@move_uploaded_file($_FILES["poster"]["tmp_name"], $thumbnail_file);
								$datas['poster'] = $imagename;
							}
							if (strlen($prof_poster_error) > 0) {
								$this->session->set_flashdata('prof_poster_error', $prof_poster_error);
								redirect('admin/gigs/update');
								// $this->load->view('admin/users/add', $data);
							}
						}
						$prf_vid_error = '';
						$alw_typs = array('video/mp4');
						// $videoname = '';
						if (isset($_FILES['video']['tmp_name']) && $_FILES['video']['tmp_name'] != '') {
							// echo json_encode($_FILES['poster']);
							if (!(in_array($_FILES['video']['type'], $alw_typs))) {
								$tmp_vid_type = "'" . ($_FILES['video']['type']) . "'";
								$prf_vid_error .= "Video type: $tmp_vid_type not allowed!<br>";
								echo $prf_vid_error;
							}

							if ($prf_vid_error == '') {
								@unlink("downloads/videos/$gig->video");
								$video_path = video_relative_path();
								$videoname = time() . $this->general_model->fileExists($_FILES['video']['name'], $video_path);
								$target_file = $video_path . $videoname;
								@move_uploaded_file($_FILES["video"]["tmp_name"], $target_file);
								$datas['video'] = $videoname;
							}
							if (strlen($prf_vid_error) > 0) {
								$this->session->set_flashdata('prof_vid_error', $prf_vid_error);
								redirect('gigs/add');
								// $this->load->view('admin/users/add', $data);
							}
						}
						// echo json_encode($datas);
						// die();
						$data['user_id'] = $gig->user_id;
						$file = [];
						if (isset($_FILES['image']['tmp_name']) && $_FILES['image']['tmp_name'] != '') {
							$file = $_FILES['image'];
						}
						$this->update_user_data($data, $file, $data['user_id']);
						$res = $this->gigs_model->update_gig_data($data['id'], $datas);
						if (isset($res)) {

							$gig_history = [
								'gig_id' => $args1,
								'action' => 'gig_created',
								'text' => 'Gig Updated'
							];
							$this->gigs_model->insert_gig_history($gig_history);
							$this->remove_tickets($data['id']);
							$this->add_tickets($data, $data['id']);
							// $this->update_tickets($data);
							$this->session->set_flashdata('success_msg', 'Gig updated successfully!');
						} else {
							$this->session->set_flashdata('error_msg', 'Error: while updating gig!');
						}

						redirect("my_gigs");
					}
				} else {
					$gig = $this->gigs_model->get_gig_by_id($args1);
					$venues = explode(',', $gig->venues);
					$gig->venues = $venues;
					$data['gig'] = $gig;
					// $param = [
					// 	'user_id' => $this->dbs_user_id,
					// 	'gig_id' => $args1
					// ];
					$tickets = $this->gigs_model->get_ticket_tiers_by_gig_id($args1);
					foreach ($tickets as $ticket) {
						$bundles = $this->gigs_model->get_ticket_bundles_by_ticket_tier_id($ticket->id);
						$ticket->bundles = $bundles;
					}
					$data['tickets'] = $tickets;
					$data['categories'] = $this->configurations_model->get_all_configurations_by_key('category');
					$data['genres'] = $this->configurations_model->get_all_configurations_by_key('genre');
					$data['status'] = $this->configurations_model->get_all_configurations_by_key('gig-status');
					$data['threshold_value'] = $this->configurations_model->get_configuration_by_key('threshold-value');
					$data['buffer_days'] = $this->configurations_model->get_all_configurations_by_key('buffer-days')[0]->value;
					$data['google_api_key'] = $this->configurations_model->get_configuration_by_key('google-adress-api-key');
					$data['countries'] = $this->countries_model->get_all_countries();
					// $data['user'] = $this->users_model->get_user_by_id($gig->user_id);

					$user = $this->users_model->get_user_by_id($gig->user_id);
					$stripe_details = $this->users_model->get_user_stripe_details($user->id);
					$user->stripe = $stripe_details->stripe_id ?? '';
					$data['user'] = $user;
					$links = $this->users_model->get_social_links($gig->user_id);
					if (isset($links) && !empty($links)) {
						foreach ($links as $key => $val) {
							$temp[] = [$val->platform => $val->url];
						}
						$data['link'] = $temp;
					} else {
						$data['link'] = [];
					}
					// echo json_encode($data);
					// die();
					$this->load->view('frontend/gigs/update', $data);
				}
			} else {
				$this->session->set_flashdata('warning_msg', 'Gig is approved! Contact admin to edit your Gig.');
				redirect('my_gigs');
			}
		} else {
			$this->session->set_flashdata('warning_msg', 'This gig does not belong to you!');
			redirect('my_gigs');
		}
	}

	function update_tickets($data)
	{
		// $data['ticket_id'] = ['239'];
		if (isset($data["ticket_id"]) && $data['ticket_id'] != '') {
			$length = count($data['ticket_id']);
			// echo $length;
			// die();
			for ($i = 0; $i < $length; $i++) {
				$j = $i + 1;
				$res = false;
				if ($data['ticket_id'][$i] != '') {
					$bundles = $this->gigs_model->get_ticket_bundles_by_ticket_tier_id($data['ticket_id'][$i]);
					if (isset($bundles) && !empty($bundles)) {
						foreach ($bundles as $bundle) {
							$this->gigs_model->remove_bundle_by_id($bundle->id);
						}
					}
					$tier = [
						'name' => $data['ticket_name'][$i],
						'price' => $data['ticket_price'][$i],
						'quantity' => $data['ticket_quantity'][$i],
						'description' => $data['ticket_description'][$i],
						'is_unlimited' => isset($data["ticket_is_unlimited_$j"]) ? $data["ticket_is_unlimited_$j"] : 0,
					];
					$res = $this->gigs_model->update_ticket_tier($tier, $data['ticket_id'][$i]);
				}
				if ($res) {
					// echo $j;
					$this->add_ticket_bundles($data, $res, $j);
					// die();
				}
			}
		}
	}

	function remove_tickets($gig_id, $delete_bundle_img = '')
	{
		$tickets = $this->gigs_model->get_ticket_tiers_by_gig_id($gig_id);
		if (isset($tickets) && !empty($tickets)) {
			foreach ($tickets as $ticket) {
				$bundles = $this->gigs_model->get_ticket_bundles_by_ticket_tier_id($ticket->id);
				if (isset($bundles) && !empty($bundles)) {
					foreach ($bundles as $bundle) {
						if ($delete_bundle_img) {
							@unlink("downloads/bundles/thumb/$bundle->image");
							@unlink("downloads/bundles/$bundle->image");
						}
						$this->gigs_model->remove_bundle_by_id($bundle->id);
					}
				}
				$this->gigs_model->remove_ticket_tiers_by_id($ticket->id);
			}
		}
	}

	public function test_stream($gig_id)
	{
		$stream_details = $this->gigs_model->get_stream_details($gig_id);
		$data['playback_url'] = $stream_details->playback_url;
		$data['gig_id'] = $gig_id;
		$this->load->view('frontend/gigs/live', $data);
	}

	public function explore()
	{
		// $sort_by = $this->input->get("sort_by");
		// $live = $this->input->get("live");
		$param = array();
		if ($this->input->get('live')) {
			$live = $this->input->get("live");
			$_SESSION['tmp_live'] = $live;
			$param['is_live'] = $live;
		} else if (isset($_SESSION['tmp_live'])) {
			unset($_SESSION['tmp_live']);
		}
		if ($this->input->get('sort_by')) {
			$sort_by = $this->input->get("sort_by");
			$_SESSION['tmp_sort_by'] = $sort_by;
			$param['sort_by'] = $sort_by;
		} else if (isset($_SESSION['tmp_sort_by'])) {
			unset($_SESSION['tmp_sort_by']);
		}

		// if ($live || $live > -1) {
		// 	$param['is_live'] = $live;
		// }
		// if ($sort_by) {
		// 	$param['sort_by'] = $sort_by;
		// }
		// $param['limit'] = 10;
		$per_page_val = 10;
		if ($per_page_val) {
			$_SESSION['tmp_per_page_val'] = $per_page_val;
		} else if (isset($_SESSION['tmp_per_page_val'])) {
			unset($_SESSION['tmp_per_page_val']);
		}
		if (isset($_SESSION['tmp_per_page_val'])) {
			$show_pers_pg = $_SESSION['tmp_per_page_val'];
		} else {
			$show_pers_pg = $this->perPage;
		}

		$totalRec = count($this->gigs_model->get_all_filter_gigs($param));
		// $config['target']      = '#grid_view';
		// $config['base_url']    = user_base_url() . 'gigs/index2';
		$config['total_rows']  = $totalRec;
		$config['per_page']    = $show_pers_pg;

		$this->ajax_pagination->initialize($config);

		$param['limit'] = $show_pers_pg;
		// echo json_encode($param);
		$gigs = $this->gigs_model->get_all_filter_gigs($param);
		// echo json_encode($gigs);
		// die();
		if ($gigs) {
			$now = new DateTime();
			foreach ($gigs as $gig) {
				$user = $this->users_model->get_user_by_id($gig->user_id);
				$gig->user_name = ($user->fname ?? '') . ' ' . ($user->lname ?? '');
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
				$gig_date = new DateTime($gig->gig_date);
				$interval = $gig_date->diff($now);
				$gig->days_left = $interval->format('%a');
				$res = $this->get_tickets_booked_and_left($gig);
				$gig->booked = $res['booked'];
				$gig->ticket_left = $res['ticket_left'];
			}
		}
		$data['gigs'] = $gigs;
		$data['param'] = $param;
		$data['categories'] = $this->configurations_model->get_all_configurations_by_key('category');
		$data['genres'] = $this->configurations_model->get_all_configurations_by_key('genre');
		// echo json_encode($data);
		// die();
		$this->load->view('frontend/gigs/explore', $data);
	}

	function index2()
	{
		// $res_nums =  $this->general_model->check_controller_method_permission_access('Admin/Products', 'index', $this->login_usr_role_id, '1');
		// if ($res_nums > 0) {

		// $data['page_headings'] = "Products List";

		$paras_arrs = array();
		$page = $this->input->post('page');
		if (!$page) {
			$offset = 0;
		} else {
			$offset = $page;
		}

		$data['page'] = $page;

		if ($this->input->post("limit")) {
			$per_page_val = $this->input->post("limit");
			$_SESSION['tmp_per_page_val'] = $per_page_val;
		} else if (isset($_SESSION['tmp_per_page_val'])) {
			$per_page_val = $_SESSION['tmp_per_page_val'];
		}

		if (isset($_POST['s_val'])) {
			$s_val = $this->input->post('s_val');
			if (strlen($s_val) > 0) {
				$_SESSION['tmp_s_val'] = $s_val;
				$paras_arrs = array_merge($paras_arrs, array("s_val" => $s_val));
			} else {
				unset($_SESSION['tmp_s_val']);
			}
		} else if (isset($_SESSION['tmp_s_val'])) {
			$s_val = $_SESSION['tmp_s_val'];
			$paras_arrs = array_merge($paras_arrs, array("s_val" => $s_val));
		}

		if (isset($_POST['status_val'])) {
			$status_val = $this->input->post('status_val');
			if ($status_val != '') {
				$_SESSION['tmp_status_val'] = $status_val;
				$paras_arrs = array_merge($paras_arrs, array("status_val" => $status_val));
			} else {
				unset($_SESSION['tmp_status_val']);
			}
		} else if (isset($_SESSION['tmp_status_val'])) {
			$status_val = $_SESSION['tmp_status_val'];
			$paras_arrs = array_merge($paras_arrs, array("status_val" => $status_val));
		}


		if (isset($_SESSION['tmp_per_page_val'])) {
			$show_pers_pg = $_SESSION['tmp_per_page_val'];
		} else {
			$show_pers_pg = $this->perPage;
		}

		//total rows count
		$totalRec = count($this->products_model->get_all_filter_products($paras_arrs));

		//pagination configuration
		$config['target']      = '#dyns_list';
		$config['base_url']    = site_url('/admin/products/index2');
		$config['total_rows']  = $totalRec;
		$config['per_page']    = $show_pers_pg; //$this->perPage;

		$this->ajax_pagination->initialize($config);

		$paras_arrs = array_merge($paras_arrs, array('start' => $offset, 'limit' => $show_pers_pg));

		$data['records'] = $this->products_model->get_all_filter_products($paras_arrs);

		$this->load->view('admin/products/index2', $data);
		// } else {
		// 	$this->load->view('admin/no_permission_access');
		// }
	}

	function filter_gig()
	{
		$cat = $this->input->post("category");
		$gen = $this->input->post("genre");
		$sort = $this->input->post("sort");
		$live = $this->input->post("live");
		$limit = $this->input->post("limit");
		$page = $this->input->post("page");
		if (!$page) {
			$offset = 0;
		} else {
			$offset = $page;
		}
		// echo ($cat);
		// echo ($gen);
		// echo ($sort);
		// echo ($live);
		// echo ($limit);
		// echo ($page);
		$param = array();
		if ($cat) {
			$param['category'] = $cat;
		}
		if ($gen) {
			$param['genre'] = $gen;
		}
		if ($sort) {
			$param['sort_by'] = $sort;
		}
		if ($live) {
			$param['is_live'] = $live;
		}

		if ($limit) {
			$per_page_val = $limit;
			$_SESSION['tmp_per_page_val'] = $per_page_val;
		} else if (isset($_SESSION['tmp_per_page_val'])) {
			$per_page_val = $_SESSION['tmp_per_page_val'];
		}

		if ($limit) {
			$show_pers_pg = $limit;
		} else {
			$show_pers_pg = $this->perPage;
		}

		if (isset($_SESSION['tmp_per_page_val'])) {
			$show_pers_pg = $_SESSION['tmp_per_page_val'];
		} else {
			$show_pers_pg = $this->perPage;
		}


		$totalRec = count($this->gigs_model->get_all_filter_gigs($param));
		// $config['target']      = '#grid_view';
		// $config['base_url']    = user_base_url() . 'gigs/index2';
		$config['total_rows']  = $totalRec;
		$config['per_page']    = $show_pers_pg;

		$this->ajax_pagination->initialize($config);

		$param['start'] = $offset;
		$param['limit'] = $show_pers_pg;
		// if ($page) {
		// 	$param['page'] = $page;
		// }
		$gigs = $this->gigs_model->get_all_filter_gigs($param);
		// echo json_encode($gigs);
		// echo json_encode($totalRec);
		// die();
		// echo json_encode($gigs);
		// die();
		if ($gigs) {
			$now = new DateTime();
			foreach ($gigs as $gig) {
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
				$gig_date = new DateTime($gig->gig_date);
				$interval = $gig_date->diff($now);
				$gig->days_left = $interval->format('%a');
				$res = $this->get_tickets_booked_and_left($gig);
				$gig->booked = $res['booked'];
				$gig->ticket_left = $res['ticket_left'];
			}
		}
		$data['gigs'] = $gigs;

		// $response = array();
		$this->load->view('frontend/gigs/partial_explore_grid', $data);

		// if ($data['gigs']) {
		// 	$response = [
		// 		'grid' => $this->load->view('frontend/gigs/partial_explore_grid', $data, TRUE),
		// 		'list' => $this->load->view('frontend/gigs/partial_explore_list', $data, TRUE)
		// 	];
		// }
		// echo json_encode($response);
	}

	function filter_my_gigs()
	{
		$prev_completed = $this->gigs_model->check_completed_gig_by_user_id($this->dbs_user_id);
		$status = $this->input->post("status");
		$search = $this->input->post("search");
		$param = array();
		// echo 'Status: ' . $status . ' Search: ' . $search;
		if ($status) {
			if ($status == 'live') {
				$status = 2;
			} else if ($status == 'completed') {
				$status = 3;
			} else if ($status == 'upcoming') {
				$status = 1;
			}
			$param['status'] = $status;
		}
		if ($search) {
			$param['search'] = $search;
		}
		$param['user_id'] = $this->dbs_user_id;
		$gigs = $this->gigs_model->filter_my_gigs($param);
		// echo json_encode($gigs);
		// die();
		if ($gigs) {
			$now = strtotime('now');
			foreach ($gigs as $gig) {
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
				if ($gig->gig_date) {
					$gig_date = strtotime($gig->gig_date);
					$interval = $gig_date - $now;
					$gig->days_left = ceil($interval / 3600 / 24)/* ->format('%a') */;
				} else {
					$gig->days_left = 'NA';
				}
				$res = $this->get_tickets_booked_and_left($gig);
				$gig->booked = $res['booked'];
				$gig->ticket_left = $res['ticket_left'];
			}
		}
		$data['gigs'] = $gigs;
		$data['prev_completed'] = $prev_completed;
		// echo json_encode($data);
		// die();

		// $response = array();

		// if ($data['gigs']) {
		// 	$response = [
		// 		'status' => 1,
		// 		'view' => $this->load->view('frontend/gigs/partial_my_gigs', $data, TRUE)
		// 	];
		// } else {
		// 	$response = [
		// 		'status' => 0,
		// 	];
		// }
		echo $this->load->view('frontend/gigs/partial_my_gigs', $data, TRUE);
		// echo json_encode($response);
	}

	function my_gigs()
	{
		$prev_completed = $this->gigs_model->check_completed_gig_by_user_id($this->dbs_user_id);
		// $prev_active = $this->gigs_model->check_latest_active_gig_by_user_id($this->dbs_user_id);
		// echo json_encode($prev_completed);
		// echo json_encode($prev_active);
		// die();

		$gigs = $this->gigs_model->get_user_gigs($this->dbs_user_id);
		if ($gigs) {
			$now = strtotime('now');
			foreach ($gigs as $gig) {
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
				if ($gig->gig_date) {
					$gig_date = strtotime($gig->gig_date);
					$interval = $gig_date - $now;
					$gig->days_left = ceil($interval / 3600 / 24)/* ->format('%a') */;
				} else {
					$gig->days_left = 'NA';
				}
				$res = $this->get_tickets_booked_and_left($gig);
				$gig->booked = $res['booked'];
				$gig->ticket_left = $res['ticket_left'];
			}
		}
		$data['gigs'] = $gigs;
		$data['prev_completed'] = $prev_completed;
		// $data['prev_active'] = $prev_active;
		// echo json_encode($data);
		// die();
		$this->load->view('frontend/gigs/my_gigs', $data);
	}

	function resubmit_for_approval($id = '')
	{
		$data = [
			'is_rejected' => 0,
			'rejection_reason' => null
		];
		$res = $this->gigs_model->update_gig_data($id, $data);

		$gig_history = [
			'gig_id' => $id,
			'action' => 'gig_submitted',
			'text' => 'Gig resumbitted for approval'
		];
		$this->gigs_model->insert_gig_history($gig_history);
		if ($res) {
			$this->session->set_flashdata('success_msg', 'Gig is submitted for approval.');
		} else {
			$this->session->set_flashdata('warning_msg', 'Error: Gig could not be submitted for approval.');
		}
		redirect('my_gigs');
	}

	function trash($args2 = '')
	{

		// $res_nums = $this->general_model->check_controller_method_permission_access('Admin/Users', 'trash', $this->dbs_role_id, '1');
		// if ($res_nums > 0) {

		// $data['page_headings'] = "Users List";
		// echo $args2;
		// die();
		$gig = $this->gigs_model->get_gig_by_id($args2);
		// echo json_encode($gig);
		// die();
		if (!$gig->is_approved) {
			@unlink("downloads/posters/thumb/$gig->poster");
			@unlink("downloads/posters/$gig->poster");
			$this->remove_tickets($args2, 1);
			$this->gigs_model->trash_gig($args2);
			$this->session->set_flashdata('deleted_msg', 'Gig is deleted');
			redirect('my_gigs');
		} else {
			$this->session->set_flashdata('warning_msg', 'Gig is approved! Contact admin to delete your Gig.');
			redirect('my_gigs');
		}
		// } else {
		// 	$this->load->view('admin/no_permission_access');
		// }
	}

	function get_gig_book_now_data()
	{
		$id = $this->input->post('id');
		$tiers = $this->gigs_model->get_ticket_tiers_by_gig_id($id);
		echo json_encode($tiers);
	}

	function select_tier()
	{
		$tier = $this->input->post('tier');
		$quantity = $this->input->post('quantity');
		$gig_id = $this->input->post('gig_id');
		$param = [
			'ticket_tier' => $tier,
			'quantity' => $quantity,
			'gig_id' => $gig_id
		];
		$this->session->set_userdata($param);
		redirect('gigs/checkout');
		// echo json_encode('Tier: '.$tier.' Quantity: '.$quantity.' Gig_id: '.$gig_id);
	}

	function launch_campaign()
	{
		$id = $this->input->post("gig_id");
		$res = $this->gigs_model->launch_gig_campaign($id);
		echo $res;
	}

	function add_gallery($id = '')
	{
		if ($_POST || $_FILES) {
			$gig_id = $this->input->post('id');
			if ($_FILES) {
				foreach ($_FILES["images"]["tmp_name"] as $key => $tmp_name) {
					if ($_FILES["images"]["tmp_name"][$key] !== '') {
						$image_path = gig_images_relative_path();
						$imagename = $gig_id . hrtime(true) . $this->general_model->fileExists($_FILES["images"]["name"][$key], $image_path);
						$target_file = $image_path . $imagename;
						@move_uploaded_file($_FILES["images"]["tmp_name"][$key], $target_file);

						$data[] = [
							'gig_id' => $gig_id,
							'image' => $imagename
						];
					}
				}
				$prev_images = $this->gigs_model->get_gig_gallery_images($gig_id);
				// echo json_encode($prev_images);
				// echo json_encode($gig_id);
				// die();
				foreach ($prev_images as $prev) {
					@unlink("downloads/gig_images/$prev->image");
				}
				$this->gigs_model->remove_gig_gallery_images($gig_id);
			}
			$res = $this->gigs_model->add_gig_gallery_images($data);
			if ($res) {
				$this->session->set_flashdata('success_msg', 'Gig images uploaded successfully!');
			} else {
				$this->session->set_flashdata('error_msg', 'Error: Gig images could not be uploaded!');
			}

			redirect("my_gigs");
			// echo json_encode($data);
			// echo json_encode($_FILES);
			// die();
		} else {
			$data['gig'] = $this->gigs_model->get_gig_by_id($id);
			$this->load->view('frontend/gigs/add_gallery', $data);
		}
	}

	function update_reaction()
	{
		$data['reaction'] =  $this->input->post('reaction');
		$data['user_id'] =  $this->input->post('user_id');
		$data['gig_id'] =  $this->input->post('gig_id');
		// $reaction_data = $this->gigs_model->get_reaction_data($data);
		// if ($reaction_data) {
		// 	$ress = $this->gigs_model->update_reaction_data($reaction_data->id, $data);
		// } else {
		// 	$ress = $this->gigs_model->add_reaction_data($data);
		// }
		$emoji = $this->gigs_model->get_emoji_reaction_data($data);
		$ress = false;
		if (!$emoji) {
			$ress = $this->gigs_model->add_reaction_data($data);
		}

		if ($ress) {
			$result['status'] = true;
			$result['reaction_data'] = $this->gigs_model->get_emoji_reaction_data($data);
			$result['gig'] = $this->gigs_model->get_reaction_count($data['gig_id']);
		} else {
			$result['status'] = false;
			$result['gig'] = $this->gigs_model->get_reaction_count($data['gig_id']);
		}
		echo json_encode($result);
	}

	function get_reactions()
	{
		$data['gig_id'] =  $this->input->post('gig_id');
		$result['gig'] = $this->gigs_model->get_reaction_count($data['gig_id']);
		echo json_encode($result);
	}

	function submit_for_approval()
	{
		$check_gig = $this->gigs_model->check_for_approval_submitted_gigs($this->dbs_user_id);
		if (!$check_gig) {
			$id = $this->input->post('id');
			$param = [
				'is_draft' => 0,
			];
			$res = $this->gigs_model->update_gig_data($id, $param);

			$gig_history = [
				'gig_id' => $id,
				'action' => 'gig_submitted',
				'text' => 'Gig sumbitted for approval'
			];
			$this->gigs_model->insert_gig_history($gig_history);
		} else {
			$res = false;
		}
		echo $res;
	}

	function send_email($to_email, $subject, $email_for)
	{
		$this->load->library('email');
		$from_email = $this->config->item('info_email');
		$from_name = $this->config->item('from_name');

		if ($email_for == 'verification') {
			$this->load->helper('string');
			$code = random_string('alnum', 6);
			$user = $this->users_model->get_user_by_email($to_email);
			$this->users_model->update_user_data($user->id, ['code' => $code]);
			// $this->session->set_userdata(['verification_code' => $code]);
			$data['link'] = user_base_url() . 'account/verify_email?email=' . $this->general_model->safe_ci_encoder($to_email) . '&code=' . $this->general_model->safe_ci_encoder($code);
			$msg = $this->load->view('email/verification_code', $data, TRUE);
		}
		if ($email_for == 'forgot_password') {
			$data['link'] = user_base_url() . 'account/reset_password/' . $this->general_model->safe_ci_encoder($to_email);
			$msg = $this->load->view('email/forgot_password', $data, TRUE);
		}
		if ($email_for == 'gig_created') {
			$msg = $this->load->view('email/gig_created', '', TRUE);
		}


		$this->email->from($from_email, $from_name);
		$this->email->to($to_email);
		$this->email->subject($subject);
		$this->email->message($msg);
		//Send mail
		if ($this->email->send()) {
			return true;
		} else {
			return false;
		}
	}

	function save_gig_data_step_one()
	{
		// echo json_encode($_FILES);
		// echo json_encode($_POST);
		// die();

		$data = $_POST;

		//upload image
		$imagename = '';
		if (isset($_FILES['poster']['tmp_name']) && $_FILES['poster']['tmp_name'] != '') {
			$image_path = poster_relative_path();
			$thumbnail_path = poster_thumbnail_relative_path();
			$imagename = time() . $this->general_model->fileExists($_FILES['poster']['name'], $image_path);
			$target_file = $image_path . $imagename;
			@move_uploaded_file($_FILES["poster"]["tmp_name"], $target_file);
			$width = 360;
			$height = 354;
			$thumbnail = $this->general_model->_resize_and_crop($imagename, $image_path, $thumbnail_path, $width, $height);
			if ($thumbnail == '1') {
				$thumbnail_file = $thumbnail_path . $imagename;
			}
			@move_uploaded_file($_FILES["poster"]["tmp_name"], $thumbnail_file);
		}
		//upload video
		$videoname = '';
		if (isset($_FILES['video']['tmp_name']) && $_FILES['video']['tmp_name'] != '') {
			$video_path = video_relative_path();
			$videoname = time() . $this->general_model->fileExists($_FILES['video']['name'], $video_path);
			$target_file = $video_path . $videoname;
			@move_uploaded_file($_FILES["video"]["tmp_name"], $target_file);
		}

		$created_on = date('Y-m-d H:i:s');
		$status = 0;
		$datas = array(
			'user_id' => $this->dbs_user_id,
			'title' => $data['title'] ?? null,
			'subtitle' => $data['subtitle'] ?? null,
			'category' => $data['category'] ?? null,
			'genre' => $data['genre'] ?? null,
			'venues' => array_key_exists('venues', $data) ? implode(',', $data['venues']) : '',
			'address' => $data['address'] ?? null,
			'poster' => $imagename,
			'video' => $videoname,
			'ticket_limit' => $data['goal'] ?? null,
			'threshold' => $data['threshold'] ?? null,
			'is_overshoot' => $data['is_overshoot'] ?? 0,
			'campaign_date' => $data['campaign_date'] ? date('Y-m-d', strtotime($data['campaign_date'])) : null,
			'gig_date' => $data['campaign_date'] ? date('Y-m-d', strtotime($data['gig_date'])) : null,
			'start_time' => date('H:i:s', strtotime($data['start_time'])),
			'end_time' => date('Y-m-d H:i:s', strtotime($data['end_time'])),
			'status' => $status,
			'is_draft' => 1,
			'is_complete' => 0,
			'created_on' => $created_on,
		);
		$res = $this->gigs_model->insert_gig_data($datas);

		if ($res) {
			$gig_history = [
				'gig_id' => $res,
				'action' => 'gig_created',
				'text' => 'Step 1 done'
			];
			$this->gigs_model->insert_gig_history($gig_history);
			$response = [
				'status' => 1,
				'gig_id' => $res,
				'message' => 'Step 1 done'
			];
		} else {
			$response = [
				'status' => 0,
				'message' => 'Error! Something went wrong.'
			];
		}
		echo json_encode($response);
	}
	function save_gig_data_step_two()
	{
		// echo json_encode($_POST);

		$res = $this->add_tickets($_POST, $_POST['gig_id']);
		// $res = $this->gigs_model->insert_gig_data($datas);

		if ($res) {
			$gig_history = [
				'gig_id' => $_POST['gig_id'],
				'action' => 'gig_created',
				'text' => 'Step 2 done'
			];
			$this->gigs_model->insert_gig_history($gig_history);
			$response = [
				'status' => 1,
				'gig_id' => $_POST['gig_id'],
				'message' => 'Step 2 done'
			];
		} else {
			$response = [
				'status' => 0,
				'message' => 'Error! Something went wrong.'
			];
		}
		echo json_encode($response);
	}
	function save_gig_data_step_three()
	{
		// echo json_encode($_POST);
		// echo json_encode($_FILES);
		// die();
		$user_image = [];
		if (isset($_FILES['image']['tmp_name']) && $_FILES['image']['tmp_name'] != '') {
			$user_image = $_FILES['image'];
		}
		$res = $this->update_user_data($_POST, $user_image, $this->dbs_user_id);

		if ($res) {
			$gig_history = [
				'gig_id' => $_POST['gig_id'],
				'action' => 'gig_created',
				'text' => 'Step 3 done'
			];
			$this->gigs_model->insert_gig_history($gig_history);
			$response = [
				'status' => 1,
				'gig_id' => $_POST['gig_id'],
				'message' => 'Step 3 done'
			];
		} else {
			$response = [
				'status' => 0,
				'message' => 'Error! Something went wrong.'
			];
		}
		echo json_encode($response);
	}
	function save_gig_data_step_final()
	{
		// echo json_encode($_POST);
		// // echo json_encode($_FILES);
		// die();
		$data = [
			'is_draft' => $_POST['is_draft'],
			'is_complete' => 1
		];
		$res = $this->gigs_model->update_gig_data($_POST['gig_id'], $data);

		if ($res) {
			$text = $_POST['is_draft'] ? 'Gig saved as draft' : 'Gig sumbitted for approval';
			$gig_history = [
				'gig_id' => $_POST['gig_id'],
				'action' => 'gig_submitted',
				'text' => $text
			];
			$this->gigs_model->insert_gig_history($gig_history);
			$response = [
				'status' => 1,
				'return_url' => 'gigs/detail?gig=' . $_POST['gig_id'],
			];
		} else {
			$response = [
				'status' => 0,
				'message' => 'Error! Something went wrong.'
			];
		}
		echo json_encode($response);
	}

	function get_gig_history()
	{
		$gig_id = $this->input->post('gig_id');
		$data['gig'] = $this->gigs_model->get_gig_by_id($gig_id);
		$data['gig_history'] = $this->gigs_model->get_gig_history($gig_id);
		echo json_encode($data);
	}

	function check_user_incomplete_gigs()
	{
		$incomplete_gig_count = $this->gigs_model->get_count_incomplete_gigs($this->dbs_user_id);
		if ($incomplete_gig_count > 0) {
			$response = [
				'status' => 1,
				'count' => $incomplete_gig_count,
				'redirect_url' => '/my_gigs'
			];
		} else {
			$response = [
				'status' => 0,
				'redirect_url' => '/gigs/add'
			];
		}
		echo json_encode($response);
	}

	function test()
	{
		// echo $this->general_model->safe_ci_decoder('cUpGWGVN');
		// $send = $this->send_email('hamza0952454@gmail.com', 'Verification Code', 'verification');
		// echo $send;
		$res = $this->gigs_model->test_query();
		echo json_encode($res);
	}

	function get_tickets_booked_and_left($gig)
	{
		// echo json_encode($gig);
		// die();
		$cart_items = $this->bookings_model->get_booking_items_by_gig_id($gig->id);
		$ticket_bought = 0;
		foreach ($cart_items as $item) {
			$ticket_bought += $item->quantity;
		}
		$ticket_left = $gig->ticket_limit - $ticket_bought;
		$param['ticket_left'] = $ticket_left > 0 ? $ticket_left : 0;
		$param['booked'] = floor($ticket_bought / $gig->ticket_limit * 100);
		return $param;
	}
}
