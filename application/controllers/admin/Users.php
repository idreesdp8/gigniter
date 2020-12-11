<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Users extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();


		$this->dbs_user_id = $vs_id = $this->session->userdata('us_id');
		$this->login_vs_role_id = $this->dbs_role_id = $vs_role_id = $this->session->userdata('us_role_id');
		$this->load->model('admin/general_model', 'general_model');
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
		$this->load->model('admin/admin_model', 'admin_model');
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
		// $data['role_arrs'] = $this->roles_model->get_all_roles();

		if (isset($_POST) && !empty($_POST)) {

			// get form input
			$data = $_POST;
			// echo json_encode($data);
			// die();

			$is_unique_email = '|is_unique[users.email]';
			if (isset($update_record_arr)) {
				if ($update_record_arr->email == $data['email']) {
					$is_unique_email = '';
				}
			}
			// form validation
			$this->form_validation->set_rules("fname", "Name", "trim|required|xss_clean");
			$this->form_validation->set_rules("role_id", "Role", "trim|required|xss_clean");
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
				}

				if (strlen($prf_img_error) > 0) {
					$this->session->set_flashdata('prof_img_error', $prf_img_error);
					redirect('admin/users/add');
					// $this->load->view('admin/users/add', $data);
				}

				$created_on = date('Y-m-d H:i:s');
				$password = $this->general_model->safe_ci_encoder($data['password']);
				$datas = array(
					'fname' => $data['fname'],
					'lname' => $data['lname'],
					'role_id' => $data['role_id'],
					'email' => $data['email'],
					'password' => $password,
					'mobile_no' => $data['mobile_no'],
					'phone_no' => $data['phone_no'],
					'description' => $data['description'],
					'address' => $data['address'],
					'city' => $data['city'],
					'state' => $data['state'],
					'country' => $data['country'],
					'zip' => $data['zip'],
					'created_on' => $created_on,
					'status' => $data['status'],
					'image' => $imagename
				);
				$res = $this->users_model->insert_user_data($datas);

				if (isset($res)) {
					$this->session->set_flashdata('success_msg', 'User added successfully!');
				} else {
					$this->session->set_flashdata('error_msg', 'Error: while adding user!');
				}
				redirect("admin/users");
			}
		} else {
			$data['roles'] = $this->roles_model->get_all_roles_without_admin();
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
		// } else {
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
			$this->form_validation->set_rules("fname", "Name", "trim|required|xss_clean");
			$this->form_validation->set_rules("role_id", "Role", "trim|required|xss_clean");

			if ($this->form_validation->run() == FALSE) {
				// validation fail
				redirect('admin/users/update/'.$data['id']);
			} else {

				$datas = array(
					'fname' => $data['fname'],
					'lname' => $data['lname'],
					'role_id' => $data['role_id'],
					'mobile_no' => $data['mobile_no'],
					'phone_no' => $data['phone_no'],
					'description' => $data['description'],
					'address' => $data['address'],
					'city' => $data['city'],
					'state' => $data['state'],
					'country' => $data['country'],
					'zip' => $data['zip'],
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
					}
					$datas['image'] = $imagename;
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
					$this->session->set_flashdata('success_msg', 'User updated successfully!');
				} else {
					$this->session->set_flashdata('error_msg', 'Error: while updating user!');
				}

				redirect("admin/users");
			}
		} else {
			$data['user'] = $this->users_model->get_user_by_id($args1);
			$data['roles'] = $this->roles_model->get_all_roles_without_admin();
			// echo json_encode($data);
			// die();
			$this->load->view('admin/users/update', $data);
		}
		// } else {
		// 	$this->load->view('admin/no_permission_access');
		// }
	}


	// function users_popup_list()
	// {

	// 	$res_nums = $this->general_model->check_controller_method_permission_access('Admin/Users', 'add', $this->dbs_role_id, '1');
	// 	if ($res_nums > 0) {

	// 		$data['page_headings'] = "Users Listings";

	// 		$paras_arrs = array();

	// 		if ($this->input->post('sel_per_page_val')) {
	// 			$per_page_val = $this->input->post('sel_per_page_val');
	// 			$_SESSION['tmp_per_page_val'] = $per_page_val;
	// 		} else if (isset($_SESSION['tmp_per_page_val'])) {
	// 			unset($_SESSION['tmp_per_page_val']);
	// 		}

	// 		if ($this->input->post('q_val')) {
	// 			$q_val = $this->input->post('q_val');
	// 			$_SESSION['tmp_q_val'] = $q_val;
	// 			$paras_arrs = array_merge($paras_arrs, array("q_val" => $q_val));
	// 		} else if (isset($_SESSION['tmp_q_val'])) {
	// 			unset($_SESSION['tmp_q_val']);
	// 		}


	// 		if (isset($_SESSION['tmp_per_page_val'])) {
	// 			$show_pers_pg = $_SESSION['tmp_per_page_val'];
	// 		} else {
	// 			$show_pers_pg = $this->perPage;
	// 		}

	// 		//total rows count
	// 		$totalRec = count($this->users_model->get_all_filter_users($paras_arrs));

	// 		//pagination configuration
	// 		$config['target']      = '#fetch_dyn_list';
	// 		$config['base_url']    = site_url('/admin/users/users_popup_list2');
	// 		$config['total_rows']  = $totalRec;
	// 		$config['per_page']    = $show_pers_pg;

	// 		$this->ajax_pagination->initialize($config);

	// 		$paras_arrs = array_merge($paras_arrs, array("limit" => $show_pers_pg));

	// 		$data['records'] = $this->users_model->get_all_filter_users($paras_arrs);

	// 		$this->load->view('admin/users/users_popup_list', $data);
	// 	} else {
	// 		$this->load->view('admin/no_permission_access');
	// 	}
	// }

	// function users_popup_list2()
	// {
	// 	$res_nums = $this->general_model->check_controller_method_permission_access('Admin/Users', 'add', $this->dbs_role_id, '1');
	// 	if ($res_nums > 0) {

	// 		$paras_arrs = $data = array();
	// 		$page = $this->input->post('page');
	// 		if (!$page) {
	// 			$offset = 0;
	// 		} else {
	// 			$offset = $page;
	// 		}

	// 		$data['page'] = $page;

	// 		/* permission checks */

	// 		if ($this->input->post('sel_per_page_val')) {
	// 			$per_page_val = $this->input->post('sel_per_page_val');
	// 			$_SESSION['tmp_per_page_val'] = $per_page_val;
	// 		} else if (isset($_SESSION['tmp_per_page_val'])) {
	// 			$show_pers_pg = $_SESSION['tmp_per_page_val'];
	// 		}

	// 		if (isset($_POST['q_val'])) {
	// 			$q_val = $this->input->post('q_val');
	// 			if (strlen($q_val) > 0) {
	// 				$_SESSION['tmp_q_val'] = $q_val;
	// 				$paras_arrs = array_merge($paras_arrs, array("q_val" => $q_val));
	// 			} else {
	// 				unset($_SESSION['tmp_q_val']);
	// 			}
	// 		} else if (isset($_SESSION['tmp_q_val'])) { ///
	// 			$q_val = $_SESSION['tmp_q_val'];
	// 			$paras_arrs = array_merge($paras_arrs, array("q_val" => $q_val));
	// 		}


	// 		if (isset($_SESSION['tmp_per_page_val'])) {
	// 			$show_pers_pg = $_SESSION['tmp_per_page_val'];
	// 		} else {
	// 			$show_pers_pg = $this->perPage;
	// 		}

	// 		//total rows count
	// 		$totalRec = count($this->users_model->get_all_filter_users($paras_arrs));

	// 		//pagination configuration
	// 		$config['target']      = '#fetch_dyn_list';
	// 		$config['base_url']    = site_url('/admin/users/users_popup_list2');
	// 		$config['total_rows']  = $totalRec;
	// 		$config['per_page']    = $show_pers_pg; // $this->perPage;

	// 		$this->ajax_pagination->initialize($config);

	// 		$paras_arrs = array_merge($paras_arrs, array('start' => $offset, 'limit' => $show_pers_pg));

	// 		$data['records'] = $this->users_model->get_all_filter_users($paras_arrs);

	// 		$this->load->view('admin/users/users_popup_list2', $data);
	// 	} else {
	// 		$this->load->view('admin/no_permission_access');
	// 	}
	// }


	// function owners_popup_add_list2222()
	// {

	// 	$res_nums = $this->general_model->check_controller_method_permission_access('Admin/Users', 'add', $this->dbs_role_id, '1');
	// 	if ($res_nums > 0) {

	// 		if (isset($_REQUEST['c_name']) && !empty($_REQUEST['c_name'])) {

	// 			$name = $this->input->post_get("c_name");
	// 			$email = $this->input->post_get("c_email");
	// 			$mobile_no = $this->input->post_get("c_mobile_no");
	// 			$created_by = $this->session->userdata('us_id');
	// 			$created_on = date('Y-m-d H:i:s');

	// 			$rec_res1 = $this->owners_model->get_owner_by_name($name);
	// 			$rec_res2 = $this->owners_model->get_owner_by_mobile_no($mobile_no);

	// 			if (isset($rec_res1) && isset($rec_res2)) {
	// 				echo 'namesmobiles';
	// 			} else if (isset($rec_res1)) {
	// 				echo 'names';
	// 			} else if (isset($rec_res2)) {
	// 				echo 'mobiles';
	// 			} else {
	// 				$datas = array('name' => $name, 'email' => $email, 'mobile_no' => $mobile_no, 'created_by' => $created_by, 'created_on' => $created_on);
	// 				$res = $this->owners_model->insert_owner_data($datas);

	// 				if (isset($res)) {
	// 					$last_insert_id = $this->db->insert_id();
	// 					echo $data['last_insert_id'] = $last_insert_id;
	// 				}
	// 			}
	// 		}
	// 	} else {
	// 		$this->load->view('admin/no_permission_access');
	// 	}
	// }


	// function fetch_users_list($sel_usrid = '')
	// {
	// 	$data['sel_usrid'] = $sel_usrid;
	// 	$this->load->view('ajax/fetch_users', $data);
	// }


	/* users functions ends */
}
