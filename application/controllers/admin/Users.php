<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Users extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$is_logged_in = $this->session->userdata('us_login');
		if (!$is_logged_in) {
			redirect("admin/login");
		}
		$vs_user_role_name = $this->session->userdata('us_role_name');
		if (isset($vs_user_role_name)) {
			if ($vs_user_role_name != 'Admin') {
				redirect('dashboard');
			}
		}


		$this->dbs_user_id = $vs_id = $this->session->userdata('us_id');
		$this->login_vs_role_id = $this->dbs_role_id = $vs_role_id = $this->session->userdata('us_role_id');
		$this->load->model('admin/general_model', 'general_model');
		$this->load->model('admin/permissions_model', 'permissions_model');
		// if(isset($vs_id) && (isset($vs_role_id) && $vs_role_id>=1)){

		// 	$res_nums = $this->general_model->check_controller_permission_access('Admin/Users',$vs_role_id,'1');
		// 	if($res_nums>0){

		// 	}else{
		// 		redirect('/');
		// 	} 
		// }else{
		// 	redirect('/');
		// }

		$this->load->model('admin/roles_model', 'roles_model');
		$this->load->model('admin/users_model', 'users_model');
		$this->load->model('admin/gigs_model', 'gigs_model');
		$this->load->model('user/bookings_model', 'bookings_model');
		$this->load->model('admin/countries_model', 'countries_model');
		$this->load->model('admin/admin_model', 'admin_model');
		$this->load->model('email_log_model');
		$perms_arrs = array('role_id' => $vs_role_id);

		$this->load->library('Ajax_pagination');
		$this->perPage = 25;
	}

	/* users functions starts */
	function index()
	{
		// $res_nums = $this->general_model->check_controller_method_permission_access('Admin/Users', 'index', $this->dbs_role_id, '1');
		// if ($res_nums > 0) {


		$users = $this->general_model->get_all_users_without_admin_with_roles();
		$data['roles'] = $this->roles_model->get_all_roles_without_admin();
		$data['records'] = $users;
		// echo json_encode($data);
		// die();
		// $data['page_headings'] = "Users List";
		$this->load->view('admin/users/index', $data);
		// } else {
		// 	$this->load->view('admin/no_permission_access');
		// }
	}

	function trash($args2 = '')
	{
		// $res_nums = $this->general_model->check_controller_method_permission_access('Admin/Users', 'trash', $this->dbs_role_id, '1');
		// if ($res_nums > 0) {

		// $data['page_headings'] = "Users List";
		$user = $this->users_model->get_user_by_id($args2);
		@unlink("downloads/profile_pictures/thumb/$user->image");
		@unlink("downloads/profile_pictures/$user->image");
		$this->remove_social_links($args2);
		$this->remove_gigs($args2);
		$this->remove_bookings($args2);
		$this->users_model->trash_user($args2);
		$this->session->set_flashdata('deleted_msg', 'User is deleted');
		redirect('admin/users');
		// } else {
		// 	$this->load->view('admin/no_permission_access');
		// }
	}


	function trash_aj()
	{
		$res_nums = $this->general_model->check_controller_method_permission_access('Admin/Users', 'trash', $this->dbs_role_id, '1');
		if ($res_nums > 0) {

			if (isset($_POST["args1"]) && $_POST["args1"] > 0) {
				$args1 = $this->input->post("args1");
				$this->users_model->trash_user($args1);
			}

			$data['records'] = $this->general_model->get_all_users_with_roles();
			$this->load->view('admin/users/index_aj', $data);
		} else {
			$this->load->view('admin/no_permission_access');
		}
	}

	function trash_multiple()
	{

		$res_nums = $this->general_model->check_controller_method_permission_access('Admin/Users', 'trash', $this->dbs_role_id, '1');
		if ($res_nums > 0) {

			if (isset($_POST["multi_action_check"]) && count($_POST["multi_action_check"]) > 0) {
				$del_checks = $_POST["multi_action_check"];
				foreach ($del_checks as $args2) {
					$this->users_model->trash_user($args2);
				}
			}

			$data['records'] = $this->general_model->get_all_users_with_roles();
			$this->load->view('admin/users/index_aj', $data);
		} else {
			$this->load->view('admin/no_permission_access');
		}
	}


	function add()
	{

		// $res_nums = $this->general_model->check_controller_method_permission_access('Admin/Users','add',$this->dbs_role_id,'1'); 
		// if($res_nums>0){ 

		// $data['page_headings'] = 'Add User';

		// $arrs_field = array('role_id' => '2');
		// $data['manager_arrs'] = $this->general_model->get_gen_all_users_by_field($arrs_field);
		$role = $this->general_model->get_role_by_name('User');
		// echo json_encode($role);
		// die();

		if (isset($_POST) && !empty($_POST)) {

			// get form input
			$data = $_POST;
			// echo json_encode($data);
			// die();

			$is_unique_email = '|is_unique[users.email]';
			// if (isset($update_record_arr)) {
			// 	if ($update_record_arr->email == $data['email']) {
			// 		$is_unique_email = '';
			// 	}
			// }
			// form validation
			$this->form_validation->set_rules("fname", "Name", "trim|required|xss_clean");
			$this->form_validation->set_rules("email", "Email", "trim|required|xss_clean|valid_email{$is_unique_email}");
			$this->form_validation->set_rules("password", "Password", "trim|required|xss_clean");

			if ($this->form_validation->run() == FALSE) {
				// validation fail
				// $this->load->view('admin/users/add', $data);
				redirect('admin/users/add');
			} else {

				$prf_img_error = '';
				$alw_typs = array('image/jpg', 'image/jpeg', 'image/png', 'image/gif');
				// $imagename = (isset($_POST['old_image']) && $_POST['old_image'] != '') ? $_POST['old_image'] : '';
				$imagename = '';
				// echo 'gg';
				if (isset($_FILES['image']['tmp_name']) && $_FILES['image']['tmp_name'] != '') {
					// echo json_encode($_FILES['image']);
					if (!(in_array($_FILES['image']['type'], $alw_typs))) {
						$tmp_img_type = "'" . ($_FILES['image']['type']) . "'";
						$prf_img_error .= "Profile image type: $tmp_img_type not allowed!<br>";
						echo $prf_img_error;
					}

					if ($prf_img_error == '') {
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
					}
					if (strlen($prf_img_error) > 0) {
						$this->session->set_flashdata('prof_img_error', $prf_img_error);
						redirect('admin/users/add');
						// $this->load->view('admin/users/add', $data);
					}
				}


				$created_on = date('Y-m-d H:i:s');
				$password = $this->general_model->safe_ci_encoder($data['password']);
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
					'role_id' => $role->id,
					'email' => $data['email'],
					'password' => $password,
					'mobile_no' => $data['mobile_no'],
					'phone_no' => $data['phone_no'],
					'description' => $data['description'],
					'address' => $data['address'],
					'country_id' => $data['country_id'],
					'created_on' => $created_on,
					'status' => $data['status'],
					'image' => $imagename
				);
				// echo json_encode($social_links);
				// die();
				$res = $this->users_model->insert_user_data($datas);

				if (isset($res)) {
					foreach ($social_links as $key => $value) {
						$temp = ['user_id' => $res, 'platform' => $key, 'url' => $value, 'created_on' => $created_on];
						$this->users_model->insert_user_social_link($temp);
					}
					$this->session->set_flashdata('success_msg', 'User added successfully!');
				} else {
					$this->session->set_flashdata('error_msg', 'Error: while adding user!');
				}
				redirect("admin/users");
			}
		} else {
			$data['countries'] = $this->countries_model->get_all_countries();
			$this->load->view('admin/users/add', $data);
		}

		// }else{ 
		// 	$this->load->view('admin/no_permission_access'); 
		// }   
	}

	function update($args1 = '')
	{

		// $res_nums = $this->general_model->check_controller_method_permission_access('Admin/Users', 'update', $this->dbs_role_id, '1');
		// if ($res_nums > 0) {

		// if (isset($args1) && $args1 != '') {
		// 	$data['args1'] = $args1;
		// 	$data['page_headings'] = 'Update User';
		// 	$update_record_arr = $data['record'] = $this->users_model->get_user_by_id($args1);
		// } else {`	
		// 	$data['page_headings'] = 'Add User';
		// }
		// $arrs_field = array('role_id' => '2');
		// $data['manager_arrs'] = $this->general_model->get_gen_all_users_by_field($arrs_field);
		// $data['role_arrs'] = $this->roles_model->get_all_roles();

		if (isset($_POST) && !empty($_POST)) {
			// get form input
			$data = $_POST;
			// echo json_encode($data);
			// echo json_encode($_FILES['image']);
			// die();

			// form validation
			$this->form_validation->set_rules("fname", "First Name", "trim|required|xss_clean");

			if ($this->form_validation->run() == FALSE) {
				// validation fail
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
					'mobile_no' => $data['mobile_no'],
					'phone_no' => $data['phone_no'],
					'description' => $data['description'],
					'address' => $data['address'],
					'country_id' => $data['country_id'],
					'status' => $data['status'],
				);

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
						redirect('admin/users/update');
						// $this->load->view('admin/users/add', $data);
					}
				}
				/*$password = md5($password);*/
				//$password = $this->general_model->encrypt_data($password);
				if (isset($data['password']) && $data['password'] != '') {
					$password = $this->general_model->safe_ci_encoder($data['password']);
					$datas['password'] = $password;
				}
				// echo json_encode($datas);
				// die();
				$res = $this->users_model->update_user_data($data['id'], $datas);
				if (isset($res)) {
					$created_on = date('Y-m-d H:i:s');
					$this->remove_social_links($data['id']);
					foreach ($social_links as $key => $value) {
						$temp = ['user_id' => $data['id'], 'platform' => $key, 'url' => $value, 'created_on' => $created_on];
						$this->users_model->insert_user_social_link($temp);
					}
					$this->session->set_flashdata('success_msg', 'User updated successfully!');
				} else {
					$this->session->set_flashdata('error_msg', 'Error: while updating user!');
				}

				redirect("admin/users");
			}
		} else {
			$data['user'] = $this->users_model->get_user_by_id($args1);
			$data['countries'] = $this->countries_model->get_all_countries();
			$links = $this->users_model->get_social_links($args1);
			if (isset($links) && !empty($links)) {
				foreach ($links as $key => $val) {
					$temp[] = [$val->platform => $val->url];
				}
				$data['link'] = $temp;
			} else {
				$data['link'] = [];
			}
			// echo $temp[3]['twitter'];
			// echo json_encode($data);
			// die();
			$this->load->view('admin/users/update', $data);
		}
		// } else {
		// 	$this->load->view('admin/no_permission_access');
		// }
	}

	function search()
	{
		$role_id = $this->input->post('role_id');
		$search = $this->input->post('search');
		$paras_arrs = [];
		if ($role_id) {
			$paras_arrs['role_id'] = $role_id;
		}
		if ($search) {
			$paras_arrs['q_val'] = $search;
		}
		$users = $this->users_model->get_all_filter_users($paras_arrs);
		foreach ($users as $user) {
			$role = $this->roles_model->get_role_by_id($user->role_id);
			$user->role_name = $role->name;
		}
		$data['records'] = $users;
		$this->load->view('admin/users/index_partial', $data);
		// echo json_encode($data);
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

	function remove_gigs($id)
	{
		$gigs = $this->gigs_model->get_gigs_by_user_id($id);
		if ($gigs) {
			foreach ($gigs as $key => $value) {
				$tickets = $this->gigs_model->get_ticket_tiers_by_gig_id($value->id);
				if ($tickets) {
					foreach ($tickets as $ticket) {
						$this->gigs_model->remove_bundle_by_ticket_tier_id($ticket->id);
					}
				}
				$this->gigs_model->remove_ticket_tiers_by_gig_id($value->id);
				$this->gigs_model->trash_bookings_by_gig_id($value->id);
				$this->gigs_model->trash_cart_items_by_gig_id($value->id);
				$this->gigs_model->trash_gig_images_by_gig_id($value->id);
				$this->gigs_model->trash_gig_popularity_by_gig_id($value->id);
				$this->gigs_model->trash_gig_reactions_by_gig_id($value->id);
				$this->gigs_model->trash_gig_stream_by_gig_id($value->id);
				$this->gigs_model->trash_gig($value->id);
			}
		}
	}

	function remove_bookings($id)
	{
		$this->bookings_model->remove_bookings_by_user_id($id);
		$this->bookings_model->remove_cart_items_by_user_id($id);
	}

	function send_verification_email($id)
	{
		$result = $this->users_model->get_user_by_id($id);
		$send = $this->send_email($result->email, 'Verification Code', 'verification');
		echo $send;
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

	function email_log()
	{
		$data['log'] = $this->email_log_model->get_all_email_logs();
		// echo json_encode($data);
		$this->load->view('admin/email_log/index', $data);
	}
	/* users functions ends */
}
