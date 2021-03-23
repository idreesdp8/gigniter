<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Account extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->dbs_user_id = $vs_id = $this->session->userdata('us_id');
		$this->login_vs_role_id = $this->dbs_role_id = $vs_role_id = $this->session->userdata('us_role_id');
		// $vs_user_role_name = $this->session->userdata('us_role_name');
		// // $role = $this->roles_model->get_role_by_id($vs_user_role_id);
		// if(isset($vs_user_role_name)){
		// 	if($vs_user_role_name=='Admin'){
		// 		redirect("admin/dashboard");
		// 	}else {
		// 		redirect('dashboard');
		// 	}
		// }

		$this->load->model('user/general_model', 'general_model');
		$this->load->model('user/roles_model', 'roles_model');
		$this->load->model('user/users_model', 'users_model');
		$this->load->model('user/countries_model', 'countries_model');
	}

	function signin()
	{
		if (isset($_POST) && !empty($_POST)) {
			// echo json_encode($_POST);
			// die();
			$email = $this->input->post("email");
			$password = $this->input->post("password");

			// form validation 
			$this->form_validation->set_rules("email", "Email", "trim|required|xss_clean");
			$this->form_validation->set_rules("password", "Password", "trim|required|xss_clean");

			if ($this->form_validation->run() == FALSE) {
				// validation fail 
				if (isset($_SESSION['error_msg'])) {
					unset($_SESSION['error_msg']);
				}
				$this->load->view('frontend/account/signin');
				// redirect('login');
			} else {
				// check for user credentials
				$password = $this->general_model->safe_ci_encoder($password);
				$result = $this->users_model->get_user($email, $password);
				if (isset($result)) {
					if ($result->status == 1) {
						// set session	
						$cstm_sess_data = array(
							'us_login' => TRUE,
							'us_id' => $result->id,
							'us_role_id' => $result->role_id,
							'us_username' => ($result->username ? ucfirst($result->username) : ''),
							'us_fname' => ($result->fname ? ucfirst($result->fname) : ''),
							'us_lname' => ($result->lname ? ucfirst($result->lname) : ''),
							'us_fullname' => ($result->fname ? ucfirst($result->fname) : '').' '.($result->lname ? ucfirst($result->lname) : ''),
							'us_email' => $result->email
						);
						$this->session->set_userdata($cstm_sess_data);
						echo json_encode($this->session->userdata());
						die();
						if ($this->session->has_userdata('redirect')) {
							redirect($this->session->redirect);
						} else {
							redirect('/');
						}
						// redirect("dashboard");
					} else {
						$this->session->set_flashdata('error_msg', 'Your account is Inactive, please contact Admin!');
						$this->load->view('frontend/account/signin');
					}
				} else {
					$this->session->set_flashdata('error_msg', 'Email or Password is incorrect!');
					redirect('login');
				}
			}
		} else {
			$this->load->view('frontend/account/signin');
		}
	}
	function signup()
	{
		if (isset($_POST) && !empty($_POST)) {
			// get form input
			$email = $this->input->post("email");
			$password = $this->input->post("password");

			// $this->send_email($email);

			// echo $email.' '.$password;
			// die();
			// form validation 
			$this->form_validation->set_rules("email", "Email", "trim|required|xss_clean|valid_email|is_unique[users.email]");
			$this->form_validation->set_rules("password", "Password", "trim|required|xss_clean");

			if ($this->form_validation->run() == FALSE) {
				// validation fail
				if (isset($_SESSION['error_msg'])) {
					unset($_SESSION['error_msg']);
				}
				$this->load->view('frontend/account/signup');
			} else {
				$password = $this->general_model->safe_ci_encoder($password);
				$role = $this->roles_model->get_role_by_name('User');
				$created_on = date('Y-m-d H:i:s');
				$status = 0;
				$datas = array(
					'email' => $email,
					'password' => $password,
					'role_id' => $role->id,
					'status' => $status,
					'created_on' => $created_on
				);
				// echo json_encode($datas);
				// die();
				$insert_data = $this->users_model->insert_user_data($datas);
				if (isset($insert_data)) {
					$result = $this->users_model->get_user_by_id($insert_data);
					$is_sent = $this->send_email($result->email, 'Verification Code', 'verification');
					if ($is_sent) {
						$this->session->set_flashdata("success_msg", "A verification email has been sent to your email address");
					} else {
						$this->session->set_flashdata("error_msg", "You have encountered an error");
					}
					$this->load->view('frontend/account/verfication_page');
				} else {
					$this->session->set_flashdata('error_msg', 'An error has been generated while creating an account, please try again!');
					redirect('register');
				}
			}
		} else {
			$this->load->view('frontend/account/signup');
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
		if ($email_for == 'forgot_password') {
			$data['link'] = user_base_url() . 'account/reset_password/' . $this->general_model->safe_ci_encoder($to_email);
			$msg = $this->load->view('email/forgot_password', $data, TRUE);
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

	// function account_verified_page()
	// {
	// 	$this->load->view('frontend/account/account_verified');
	// }

	function verify_email()
	{
		$email = $this->general_model->safe_ci_decoder($this->input->get('email'));
		$code = $this->general_model->safe_ci_decoder($this->input->get('code'));
		$user = $this->users_model->get_user_by_email($email);
		$sess_code = $this->session->userdata('verification_code');
		if ($user && ($sess_code == $code)) {
			$data_arr = [
				'status' => 1
			];
			$this->users_model->update_user_data($user->id, $data_arr);
			$this->session->unset_userdata('verification_code');
			$result = $this->users_model->get_user_by_id($user->id);
			// set session	
			$cstm_sess_data = array(
				'us_login' => TRUE,
				'us_id' => $result->id,
				'us_role_id' => $result->role_id,
				'us_username' => ($result->username ? ucfirst($result->username) : ''),
				'us_fname' => ($result->fname ? ucfirst($result->fname) : ''),
				'us_lname' => ($result->lname ? ucfirst($result->lname) : ''),
				'us_email' => $result->email
			);

			$this->session->set_userdata($cstm_sess_data);

			$this->load->view('frontend/account/account_verified');
			// redirect("dashboard");
		}
	}

	function forgot_password()
	{
		if (isset($_SESSION['error_msg'])) {
			unset($_SESSION['error_msg']);
		}

		if (isset($_SESSION['success_msg'])) {
			unset($_SESSION['success_msg']);
		}
		if (isset($_POST) && !empty($_POST)) {
			$email = $this->input->post("email");
			// echo $email;
			// die();

			// form validation
			$this->form_validation->set_rules("email", "Email", 'required|trim|xss_clean|valid_email');

			if ($this->form_validation->run() == FALSE) {
				// validation fail
				if (isset($_SESSION['error_msg'])) {
					unset($_SESSION['error_msg']);
				}
				$this->load->view('frontend/account/forgot_password');
			} else {
				// check for user credentials
				$result = $this->users_model->get_user_by_email($email);
				if ($result) {
					if (!$result->status) {
						$this->session->set_flashdata('error_msg', 'Your Email is not verified yet!');
						$this->load->view('frontend/account/forgot_password');
						return 0;
					}
					// echo json_encode($result);
					// die();

					$is_sent = $this->send_email($result->email, 'Password Reset Link', 'forgot_password');

					if ($is_sent) {
						$this->session->set_flashdata('success_msg', 'Please check your Email, We have sent you password reset link!');
					} else {
						$this->session->set_flashdata('error_msg', 'You have encountered an error');
					}
					$this->load->view('frontend/account/forgot_password');
				} else {
					$this->session->set_flashdata('error_msg', 'This Email doesn\'t exists in our record!');
					$this->load->view('frontend/account/forgot_password');
				}
			}
		} else {

			$this->load->view('frontend/account/forgot_password');
		}
	}

	function reset_password($email = '')
	{
		if (isset($_SESSION['error_msg'])) {
			unset($_SESSION['error_msg']);
		}

		if (isset($_SESSION['success_msg'])) {
			unset($_SESSION['success_msg']);
		}

		if (isset($_POST) && !empty($_POST)) {

			$new_password = $this->input->post("password");
			$email = $this->input->post("email");
			$email = $this->general_model->safe_ci_decoder($email);

			// echo $email.' '.$new_password;
			// die();
			// form validation
			$this->form_validation->set_rules("password", "New Password", 'required|trim|xss_clean');

			if ($this->form_validation->run() == FALSE) {
				if (isset($_SESSION['error_msg'])) {
					unset($_SESSION['error_msg']);
				}
				$this->load->view('frontend/account/reset_password');
			} else {
				$user = $this->users_model->get_user_by_email($email);
				$new_password = $this->general_model->safe_ci_encoder($new_password);

				$update_array = array('password' => $new_password);
				$res = $this->users_model->update_user_data($user->id, $update_array);

				if ($res) {
					$result = $this->users_model->get_user_by_id($user->id);
					// set session	
					$cstm_sess_data = array(
						'us_login' => TRUE,
						'us_id' => $result->id,
						'us_role_id' => $result->role_id,
						'us_username' => ($result->username ? ucfirst($result->username) : ''),
						'us_fname' => ($result->fname ? ucfirst($result->fname) : ''),
						'us_lname' => ($result->lname ? ucfirst($result->lname) : ''),
						'us_email' => $result->email
					);
					$this->session->set_userdata($cstm_sess_data);
					$this->session->set_flashdata('success_msg', 'Your Account Password has been changed successfully!');
					$this->load->view('frontend/account/reset_password');
					// redirect('/');
				} else {
					$this->session->set_flashdata('error_msg', 'Unable to change your Account, please try again!');
					$this->load->view('frontend/account/reset_password');
				}
			}
		} else {
			$data['email'] = $email;
			$this->load->view('frontend/account/reset_password', $data);
		}
	}

	public function logoff()
	{
		$this->session->sess_destroy();
		redirect('/');
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

	public function profile()
	{
		if (isset($_POST) && !empty($_POST)) {
			// echo json_encode($_POST);
			// echo json_encode($_FILES);
			// die();
			$data = $_POST;

			// form validation 
			$this->form_validation->set_rules("fname", "First Name", "trim|required|xss_clean");

			if ($this->form_validation->run() == FALSE) {
				// validation fail
				if (isset($_SESSION['error_msg'])) {
					unset($_SESSION['error_msg']);
				}
				// $this->load->view('frontend/account/profile');
				redirect('admin/users/update/' . $data['id']);
			} else {

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
					// 'email' => $data['email'],
					// 'mobile_no' => $data['mobile_no'],
					// 'phone_no' => $data['phone_no'],
					'description' => $data['description'],
					'address' => $data['address'],
					'country_id' => $data['country_id'],
				);
				if (isset($data['password']) && $data['password'] != '') {
					$password = $this->general_model->safe_ci_encoder($data['password']);
					$datas['password'] = $password;
				}
				// echo json_encode($datas);
				// die();

				$prf_img_error = '';
				$alw_typs = array('image/jpg', 'image/jpeg', 'image/png', 'image/gif');
				// $imagename = (isset($_POST['old_image']) && $_POST['old_image'] != '') ? $_POST['old_image'] : '';
				if (isset($_FILES['image']['tmp_name']) && $_FILES['image']['tmp_name'] != '') {
					// echo json_encode($_FILES['image']);
					// die();
					if (!(in_array($_FILES['image']['type'], $alw_typs))) {
						$tmp_img_type = "'" . ($_FILES['image']['type']) . "'";
						$prf_img_error .= "Profile image type: $tmp_img_type not allowed!<br>";
					}

					if ($prf_img_error == '') {
						$user = $this->users_model->get_user_by_id($data['id']);
						@unlink("downloads/profile_pictures/thumb/$user->image");
						@unlink("downloads/profile_pictures/$user->image");
						$image_path = profile_image_relative_path();
						$thumbnail_path = profile_thumbnail_relative_path();
						$imagename = time() . $this->general_model->fileExists($_FILES['image']['name'], $image_path);
						$target_file = $image_path . $imagename;
						@move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
						$width = 200;
						$height = 200;
						$thumbnail = $this->general_model->_resize_and_crop($imagename, $image_path, $thumbnail_path, $width, $height);
						if ($thumbnail == '1') {
							$thumbnail_file = $thumbnail_path . $imagename;
						}
						// echo $thumbnail;
						// die();
						// @move_uploaded_file($_FILES["image"]["tmp_name"], $thumbnail_file);
						$datas['image'] = $imagename;
					}
					if (strlen($prf_img_error) > 0) {
						$this->session->set_flashdata('prof_img_error', $prf_img_error);
						redirect('account/profile');
						// $this->load->view('admin/users/add', $data);
					}
				}
				$res = $this->users_model->update_user_data($data['id'], $datas);
				if (isset($res)) {
					$created_on = date('Y-m-d H:i:s');
					$this->remove_social_links($data['id']);
					foreach ($social_links as $key => $value) {
						$temp = ['user_id' => $data['id'], 'platform' => $key, 'url' => $value, 'created_on' => $created_on];
						$this->users_model->insert_user_social_link($temp);
					}
					$cstm_sess_data = array(
						// 'us_username' => ($res->username ? ucfirst($res->username) : ''),
						'us_fname' => ($data['fname'] ? ucfirst($data['fname']) : ''),
						'us_lname' => ($data['lname'] ? ucfirst($data['lname']) : ''),
					);
					$this->session->set_userdata($cstm_sess_data);
					$stripe_id = $this->input->post('stripe_id');
					if ($stripe_id) {
						$account = $this->create_user_stripe_account($stripe_id);
						$temp = [
							'user_id' => $data['id'],
							'stripe_id' => $stripe_id,
							'stripe_account_id' => $account->id,
						];
						$this->users_model->trash_user_stripe_details($data['id']);
						$this->users_model->insert_user_stripe_details($temp);
					}
					$this->session->set_flashdata('success_msg', 'User updated successfully!');
				} else {
					$this->session->set_flashdata('error_msg', 'Error: while updating user!');
				}

				redirect("account/profile");
			}
		} else {
			$user = $this->users_model->get_user_by_id($this->dbs_user_id);
			if ($user) {
				$data['countries'] = $this->countries_model->get_all_countries();
				$links = $this->users_model->get_social_links($this->dbs_user_id);
				$stripe_details = $this->users_model->get_user_stripe_details($this->dbs_user_id);
				$detail_submitted_flag = 'NA';
				if ($stripe_details) {
					$detail_submitted_flag = 'restricted';
					if ($stripe_details) {
						$stripe_account = $this->check_user_account_details($stripe_details->stripe_account_id);
						// echo json_encode($stripe_account);
						// die();
						if ($stripe_account->charges_enabled) {
							$detail_submitted_flag = 'enabled';
						}
					}
				}
				$user->stripe_id = $stripe_details ? $stripe_details->stripe_id : null;
				$user->detail_submitted_flag = $detail_submitted_flag;
				if (isset($links) && !empty($links)) {
					foreach ($links as $link) {
						$platform = $link->platform;
						$user->$platform = $link->url;
					}
					// $data['link'] = $temp;
				} /* else {
					$data['link'] = [];
				} */
				$data['user'] = $user;
				// echo json_encode($user);
				// die();
				$this->load->view('frontend/account/profile', $data);
			} else {
				redirect('account/logoff');
			}
		}
	}

	function check_user_account_details($account_id)
	{
		require_once('application/libraries/stripe-php/init.php');
		$stripeSecret = $this->config->item('stripe_api_key');

		$stripe = new \Stripe\StripeClient($stripeSecret);
		$account = $stripe->accounts->retrieve(
			$account_id,
			[]
		);
		return $account;
	}

	function enable_stripe_account()
	{
		$user_id = $this->input->get('user_id');
		$stripe_details = $this->users_model->get_user_stripe_details($user_id);

		require_once('application/libraries/stripe-php/init.php');
		$stripeSecret = $this->config->item('stripe_api_key');
		$stripe = new \Stripe\StripeClient($stripeSecret);
		$response = $stripe->accountLinks->create([
			'account' => $stripe_details->stripe_account_id,
			'refresh_url' => user_base_url() . 'account/enable_stripe_account?user_id=' . $user_id,
			'return_url' => user_base_url() . 'profile',
			'type' => 'account_update',
		]);
		redirect($response->url);
		// echo json_encode($response);
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
}
