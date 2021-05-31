<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$vs_user_role_id = $this->session->userdata('us_role_id');
		$vs_user_role_name = $this->session->userdata('us_role_name');
		// $role = $this->roles_model->get_role_by_id($vs_user_role_id);
		if(isset($vs_user_role_name)){
			if($vs_user_role_name=='Admin'){
				redirect("admin/dashboard");
			}else {
				redirect('dashboard');
			}
		}
		
		$this->load->model('admin/roles_model', 'roles_model');
		$this->load->model('admin/general_model', 'general_model');
		$this->load->model('admin/users_model', 'users_model');
	}

	function index()
	{
		if (isset($_POST) && !empty($_POST)) {
			// get form input
			$email = $this->input->post("email");
			$password = $this->input->post("password");

			// form validation 
			$this->form_validation->set_rules("email", "Email", "trim|required|xss_clean|valid_email");
			$this->form_validation->set_rules("password", "Password", "trim|required|xss_clean");

			if ($this->form_validation->run() == FALSE) {
				// validation fail
				if (isset($_SESSION['error_msg'])) {
					unset($_SESSION['error_msg']);
				}
				$this->load->view('admin/login');
			} else {
				// check for user credentials
				/*$password = md5($password);*/
				$password = $this->general_model->safe_ci_encoder($password);
				$result = $this->users_model->get_user($email, $password);
				if (isset($result)) {
					if ($result->status == 1) {
						// set session	
						$role = $this->roles_model->get_role_by_id($result->role_id);
						$cstm_sess_data = array(
							'us_login' => TRUE, 
							'us_id' => $result->id, 
							'us_role_id' => $result->role_id, 
							'us_username' => ($result->username ? ucfirst($result->username) : ''),
							'us_fullname' => ($result->fname ? ucfirst($result->fname) : '') . ' ' . ($result->lname ? ucfirst($result->lname) : ''),
							'us_fname' => ($result->fname ? ucfirst($result->fname) : ''), 
							'us_lname' => ($result->lname ? ucfirst($result->lname) : ''), 
							'us_email' => $result->email,
							'us_role_name' => $role->name,
						);

						$this->session->set_userdata($cstm_sess_data);
						if(isset($role)){
							if($role->name=='Admin'){
								redirect("admin/dashboard");
							}else {
								redirect('dashboard');
							}
						}

					} else {
						$this->session->set_flashdata('error_msg', 'Your account is Inactive, please contact Admin!');
						$this->load->view('admin/login');
					}
				} else {
					$this->session->set_flashdata('error_msg', 'Invalid Email or Password!');
					$this->load->view('admin/login');
				}
			}
		} else {

			$this->load->view('admin/login');
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
}
