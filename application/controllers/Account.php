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
				$this->load->view('frontend/signin');
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
							'us_email' => $result->email
						);
						$this->session->set_userdata($cstm_sess_data);
						if ($this->session->has_userdata('redirect')) {
							redirect($this->session->redirect);
						} else {
							redirect('/');
						}
						// redirect("dashboard");
					} else {
						$this->session->set_flashdata('error_msg', 'Your account is Inactive, please contact Admin!');
						$this->load->view('frontend/signin');
					}
				} else {
					$this->session->set_flashdata('error_msg', 'Email or Password is incorrect!');
					redirect('login');
				}
			}
		} else {
			$this->load->view('frontend/signin');
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
				$this->load->view('frontend/signup');
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
					$this->send_email($result->email);
				} else {
					$this->session->set_flashdata('error_msg', 'An error has been generated while creating an account, please try again!');
					redirect('register');
				}
			}
		} else {
			$this->load->view('frontend/signup');
		}
	}

	function send_email($to_email)
	{
		$from_email = $this->config->item('info_email');
		$from_name = $this->config->item('from_name');

		$code = $this->general_model->random_string(6);
		$this->session->set_userdata(['verification_code' => $code]);
		$data['link'] = user_base_url() . 'account/verify_email?email=' . $this->general_model->safe_ci_encoder($to_email) . '&code=' . $this->general_model->safe_ci_encoder($code);

		$msg = $this->load->view('email/verification_code', $data, TRUE);

		$this->email->from($from_email, $from_name);
		$this->email->to($to_email);
		$this->email->subject('Verification Code');
		$this->email->message($msg);
		//Send mail
		if ($this->email->send()) {
			$this->session->set_flashdata("success_msg", "A verification email has been sent to your email address");
		} else {
			$this->session->set_flashdata("error_msg", "You have encountered an error");
		}
		$this->load->view('frontend/verfication_page');
	}

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

			$this->load->view('frontend/account_verified');
			// redirect("dashboard");
		}
	}

	function forgot_password()
	{

		if (isset($_POST) && !empty($_POST)) {
			$email = $this->input->post("email");

			// form validation
			$this->form_validation->set_rules("email", "Email-ID", 'required|trim|xss_clean|valid_email');

			if ($this->form_validation->run() == FALSE) {
				// validation fail
				if (isset($_SESSION['error_msg'])) {
					unset($_SESSION['error_msg']);
				}
				$this->load->view('admin/forgot_password');
			} else {
				// check for user credentials
				$result = $this->users_model->get_user_by_email($email);
				if (isset($result)) {
					//Load email library 
					$this->load->library('email');
					$db_vs_id = $result->id;
					//$vs_id = base64_encode($db_vs_id);
					$vs_id = $db_vs_id;

					$vs_name = $result->name;
					$vs_email = $result->email;
					//$vs_password = $result->password;  

					$this->load->helper('string');
					$random_password = random_string('alnum', 20);
					$update_array = array('random_password' => $random_password);
					$result = $this->users_model->update_user_data($db_vs_id, $update_array);
					$reset_link = "admin/login/reset_password/{$vs_id}/{$random_password}/";
					$reset_link = site_url($reset_link);

					$site_name = $this->config->item('custom_site_name');

					$mailtext = "<table width='90%' border='0' align='center' cellpadding='7' cellspacing='7' style='color:#000000; font-size:12px; font-family:tahoma;'> <tbody> <tr> <td> <h4> " . $site_name . ": Reset your " . $site_name . " Password</h4> </td> </tr>";

					$mailtext .= "<tr> <td> Dear " . $vs_name . ", <br> <br> Someone recently requested a password change for your " . $site_name . " account. If this was you, you can set a new password by clicking the link below: <br> <br> <a href=\"$reset_link\" target=\"_blank\" title=\"Click here to Reset Your " . $site_name . " Password\"><strong><u>Reset Your " . $site_name . " Password</u></strong></a> <br> <br> If you don't want to change your password or didn't request this, just ignore and delete this message. <br> <br> To keep your account secure, please don't forward this email to anyone. <br> <br> The " . $site_name . " Team </td> </tr> </tbody> </table>";

					$configs_arr = $this->general_model->get_configuration();
					$from_email = $configs_arr->email;

					$config['mailtype'] = 'html';
					$this->email->initialize($config);
					$this->email->to($vs_email);
					$this->email->from($from_email);
					$this->email->subject("Reset your " . $site_name . " Account Password");
					$this->email->message($mailtext);

					if ($this->email->send()) {
						$this->session->set_flashdata('success_msg', 'Please check your Email-ID, We have sent your account info!');
					} else {
						$this->session->set_flashdata('error_msg', 'Unable to sent mail, please check configuration!');
					}
					$this->load->view('admin/forgot_password');
				} else {
					if (isset($_SESSION['success_msg'])) {
						unset($_SESSION['success_msg']);
					}
					$this->session->set_flashdata('error_msg', 'This Email-ID doesn\'t exists in our record!');
					$this->load->view('admin/forgot_password');
				}
			}
		} else {
			if (isset($_SESSION['error_msg'])) {
				unset($_SESSION['error_msg']);
			}

			if (isset($_SESSION['success_msg'])) {
				unset($_SESSION['success_msg']);
			}

			$this->load->view('admin/forgot_password');
		}
	}

	function reset_password($vs_id, $rand_numbs)
	{

		//$vs_id = base64_decode($vs_id);
		$vs_id = $vs_id;
		$rand_numbs = $rand_numbs;
		$this->session->set_flashdata('temp_vs_id', $vs_id);
		$data['vs_id'] = $vs_id;
		$data['rand_numbs'] = $rand_numbs;

		$data_arr = array('id' => $vs_id, 'random_password' => $rand_numbs);
		$result = $this->users_model->get_user_custom_data($data_arr);
		if (isset($result)) {

			if (isset($_POST) && !empty($_POST)) {

				$new_password = $this->input->post("new_password");
				$conf_password = $this->input->post("conf_password");

				// form validation
				$this->form_validation->set_rules("new_password", "New Password", 'required|trim|xss_clean|matches[conf_password]');
				$this->form_validation->set_rules("conf_password", "Confirm Password", 'required|trim|xss_clean');
				if ($this->form_validation->run() == FALSE) {
					$this->load->view('admin/reset_password', $data);
				} else {
					$tmp_vs_id = $this->session->flashdata('temp_vs_id');
					$this->load->helper('string');
					$random_password = random_string('alnum', 20);
					/*$new_password = md5($new_password);*/
					//$new_password = $this->general_model->encrypt_data($new_password);
					$new_passwor = $this->general_model->safe_ci_encoder($new_password);

					$update_array = array('password' => $new_password, 'random_password' => $random_password);
					$result = $this->users_model->update_user_data($tmp_vs_id, $update_array);

					if (isset($result)) {
						$this->session->set_flashdata('success_msg', 'Your Account Password has been changed successfully!');
						redirect('admin/login/index');
					} else {
						$this->session->set_flashdata('error_msg', 'Unable to change your Account, please try again!');
					}
				}
			} else {
				if (isset($_SESSION['error_msg'])) {
					unset($_SESSION['error_msg']);
				}

				if (isset($_SESSION['success_msg'])) {
					unset($_SESSION['success_msg']);
				}
			}

			$this->load->view('admin/reset_password', $data);
		} else {
			$this->session->set_flashdata('error_msg', 'Unable to reset your account password, please try again!');
			$this->load->view('admin/forgot_password', $data);
		}
	}

	public function logoff()
	{
		$this->session->sess_destroy();
		redirect('/');
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
				// $this->load->view('frontend/profile');
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
						$thumbnail = $this->general_model->_create_thumbnail($imagename, $image_path, $thumbnail_path, $width, $height);
						if ($thumbnail == '1') {
							$thumbnail_file = $thumbnail_path . $imagename;
						}
						// echo $thumbnail;
						@move_uploaded_file($_FILES["image"]["tmp_name"], $thumbnail_file);
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
					$this->session->set_flashdata('success_msg', 'User updated successfully!');
				} else {
					$this->session->set_flashdata('error_msg', 'Error: while updating user!');
				}

				redirect("account/profile");
			}
		} else {
			$user = $this->users_model->get_user_by_id($this->dbs_user_id);
			$data['countries'] = $this->countries_model->get_all_countries();
			$links = $this->users_model->get_social_links($this->dbs_user_id);
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
			$this->load->view('frontend/profile', $data);
		}
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
