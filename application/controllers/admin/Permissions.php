<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Permissions extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$is_logged_in = $this->session->userdata('us_login');
		if (!$is_logged_in) {
			redirect("admin/login");
		}
		$vs_user_role_name = $this->session->userdata('us_role_name');
		if(isset($vs_user_role_name)){
			if($vs_user_role_name!='Admin'){
				redirect('dashboard');
			}
		}


		$this->dbs_user_id = $vs_id = $this->session->userdata('us_id');
		$this->login_vs_role_id = $this->dbs_role_id = $vs_role_id = $this->session->userdata('us_role_id');
		$this->load->model('admin/general_model', 'general_model');
		// if(isset($vs_id) && (isset($vs_role_id) && $vs_role_id>=1)){
		// 	/* ok */ 
		// 	$res_nums = $this->general_model->check_controller_permission_access($vs_role_id);
		// 	if($res_nums>0){
		// 		/* ok */ 
		// 	}else{
		// 		redirect('/');
		// 	} 
		// }else{
		// 	redirect('/');
		// }
		$this->load->model('admin/permissions_model', 'permissions_model');
		$this->load->model('admin/users_model', 'users_model');
		$this->load->model('admin/roles_model', 'roles_model');
		$this->load->model('admin/gigs_model', 'gigs_model');
		$this->load->model('admin/admin_model', 'admin_model');
		$perms_arrs = array('role_id' => $vs_role_id);

		$this->load->library('Ajax_pagination');
		$this->perPage = 25;
	}


	/* Permission module starts */
	function index()
	{

		// $res_nums =  $this->general_model->check_controller_method_permission_access('Admin/Permissions','index',$this->dbs_role_id,'1'); 
		// if($res_nums>0){ 

		$sel_module_id = $sel_user_type_id = '';
		$paras_arrs = array();


		if ($this->input->post('sel_per_page_val')) {
			$per_page_val = $this->input->post('sel_per_page_val');
			$_SESSION['tmp_per_page_val'] = $per_page_val;
		} else if (isset($_SESSION['tmp_per_page_val'])) {
			unset($_SESSION['tmp_per_page_val']);
		}

		if ($this->input->post('module_id')) {
			$sel_module_id = $this->input->post('module_id');
			$_SESSION['tmp_module_id_val'] = $sel_module_id;
			$paras_arrs = array_merge($paras_arrs, array("module_id_val" => $sel_module_id));
		} else if (isset($_SESSION['tmp_module_id_val'])) {
			unset($_SESSION['tmp_module_id_val']);
		}

		if ($this->input->post('user_type_id')) {
			$sel_user_type_id = $this->input->post('user_type_id');
			$_SESSION['tmp_user_type_val'] = $sel_user_type_id;

			$paras_arrs = array_merge($paras_arrs, array("user_type_id_val" => $sel_user_type_id));
		} else if (isset($_SESSION['tmp_user_type_val'])) {
			unset($_SESSION['tmp_user_type_val']);
		}


		if (isset($_SESSION['tmp_per_page_val'])) {
			$show_pers_pg = $_SESSION['tmp_per_page_val'];
		} else {
			$show_pers_pg = $this->perPage;
		}

		//total rows count
		// $totalRec = count($this->permissions_model->get_all_permission_with_user_modules_roles($paras_arrs));

		//pagination configuration
		$config['target']      = '#dyns_list';
		$config['base_url']    = site_url('/admin/permissions/index2');
		// $config['total_rows']  = $totalRec;
		$config['per_page']    = $show_pers_pg; //$this->perPage;

		// $this->ajax_pagination->initialize($config); 

		$paras_arrs = array_merge($paras_arrs, array("limit" => $show_pers_pg));

		$records = $data['records'] = $this->permissions_model->get_all_permissions();
		// echo json_encode($data);
		// die();
		// $data['page_headings'] = "Permissions List";
		$this->load->view('admin/permissions/index', $data);

		// }else{ 
		// 	$this->load->view('admin/no_permission_access'); 
		// } 
	}


	function index2()
	{

		$data['role_arrs'] = $this->roles_model->get_all_roles();
		$sel_module_id = $sel_user_type_id = '';

		$paras_arrs = array();
		$page = $this->input->post('page');
		if (!$page) {
			$offset = 0;
		} else {
			$offset = $page;
		}

		$data['page'] = $page;


		if ($this->input->post('sel_per_page_val')) {
			$per_page_val = $this->input->post('sel_per_page_val');
			$_SESSION['tmp_per_page_val'] = $per_page_val;
		} else if (isset($_SESSION['tmp_per_page_val'])) {
			$per_page_val = $_SESSION['tmp_per_page_val'];
		}


		if (isset($_POST['module_id'])) {
			$sel_module_id = $this->input->post('module_id');
			if ($sel_module_id > 0) {
				$_SESSION['tmp_module_id_val'] = $sel_module_id;
				$paras_arrs = array_merge($paras_arrs, array("module_id_val" => $sel_module_id));
			} else {
				unset($_SESSION['tmp_module_id_val']);
			}
		} else if (isset($_SESSION['tmp_module_id_val'])) {  ///
			$sel_module_id = $_SESSION['tmp_module_id_val'];
			$paras_arrs = array_merge($paras_arrs, array("module_id_val" => $sel_module_id));
		}


		if (isset($_POST['user_type_id'])) {
			$sel_user_type_id = $this->input->post('user_type_id');
			if ($sel_user_type_id > 0) {
				$_SESSION['tmp_user_type_val'] = $sel_user_type_id;

				$paras_arrs = array_merge($paras_arrs, array("user_type_id_val" => $sel_user_type_id));
			} else {
				unset($_SESSION['tmp_user_type_val']);
			}
		} else if (isset($_SESSION['tmp_user_type_val'])) {  ///
			$sel_user_type_id = $_SESSION['tmp_user_type_val'];
			$paras_arrs = array_merge($paras_arrs, array("user_type_id_val" => $sel_user_type_id));
		}


		if (isset($_SESSION['tmp_per_page_val'])) {
			$show_pers_pg = $_SESSION['tmp_per_page_val'];
		} else {
			$show_pers_pg = $this->perPage;
		}

		//total rows count
		$totalRec = count($this->permissions_model->get_all_permission_with_user_modules_roles($paras_arrs));

		//pagination configuration
		$config['target']      = '#dyns_list';
		$config['base_url']    = site_url('/admin/permissions/index2');
		$config['total_rows']  = $totalRec;
		$config['per_page']    = $show_pers_pg; //$this->perPage;

		$this->ajax_pagination->initialize($config);

		$paras_arrs = array_merge($paras_arrs, array('start' => $offset, 'limit' => $show_pers_pg));

		$data['records'] = $this->permissions_model->get_all_permission_with_user_modules_roles($paras_arrs);

		$data['page_headings'] = "Permissions List";
		$this->load->view('admin/permissions/index2', $data);
	}

	function trash($id)
	{

		// $res_nums =  $this->general_model->check_controller_method_permission_access('Admin/Permissions', 'trash', $this->dbs_role_id, '1');
		// if ($res_nums > 0) {

			// $data['page_headings'] = "Permissions List";
			if ($id > 0) {
				$this->permissions_model->trash_permission($id);
			}
			$this->session->set_flashdata('deleted_msg', 'Permission is deleted');
			redirect('admin/permissions');
		// } else {
		// 	$this->load->view('admin/no_permission_access');
		// }
	}

	function trash_aj()
	{
		$res_nums =  $this->general_model->check_controller_method_permission_access('Admin/Permissions', 'trash', $this->dbs_role_id, '1');
		if ($res_nums > 0) {

			if (isset($_POST["args1"]) && $_POST["args1"] > 1) {
				$args1 = $this->input->post("args1");
				$this->permissions_model->trash_permission($args1);
			}

			$this->index2();
		} else {
			$this->load->view('admin/no_permission_access');
		}
	}


	function trash_multiple()
	{

		$res_nums =  $this->general_model->check_controller_method_permission_access('Admin/Permissions', 'trash', $this->dbs_role_id, '1');
		if ($res_nums > 0) {

			$data['page_headings'] = "Permissions";

			if (isset($_POST["multi_action_check"]) && count($_POST["multi_action_check"]) > 0) {
				$del_checks = $_POST["multi_action_check"];
				foreach ($del_checks as $args1) {
					if ($args1 > 0) {
						$this->permissions_model->trash_permission($args1);
					}
				}
			}
			$this->index2();
		} else {
			$this->load->view('admin/no_permission_access');
		}
	}

	function add()
	{
		// echo json_encode($_POST);
		// die();

		// $res_nums = $this->general_model->check_controller_method_permission_access('Admin/Permissions', 'add', $this->dbs_role_id, '1');
		// if ($res_nums > 0) {

		// get form input
		$name = $this->input->post("name");


		// form validation
		$this->form_validation->set_rules("name", "Permission Name", "trim|required|xss_clean");

		if ($this->form_validation->run() == FALSE) {
			// validation fail
			redirect("admin/permissions");
		} else {
			$record = $this->general_model->get_permission_by_name($name);
			if ($record) {
				$this->session->set_flashdata('warning_msg', 'Warning: This permission is already added!');
			} else {
				$created_on = date('Y-m-d H:i:s');
				$data = array(
					'name' => $name,
					'created_on' => $created_on
				);
				$res = $this->permissions_model->insert_permission_data($data);
				// echo json_encode($res);
				// die();
				if (isset($res)) {
					$this->session->set_flashdata('success_msg', 'Permission added successfully!');
				} else {
					$this->session->set_flashdata('error_msg', 'Error while adding Permission!');
				}
			}
			redirect("admin/permissions");
		}
		// } else {
		// 	$this->load->view('admin/no_permission_access');
		// }
	}

	function edit()
	{
		// echo $this->input->post("id");
		$result = $this->permissions_model->get_permission_by_id($this->input->post("id"));
		echo json_encode($result);
	}

	function update()
	{
		// echo json_encode($_POST);
		// die();

		// $res_nums =  $this->general_model->check_controller_method_permission_access('Admin/Permissions', 'update', $this->dbs_role_id, '1');
		// if ($res_nums > 0) {

				// get form input
				$name = $this->input->post("name");
				$id = $this->input->post("id");

				// form validation
				$this->form_validation->set_rules("name", "Permission Name", "trim|required|xss_clean");

				// $rec_nums = $this->general_model->get_permission_by_module_role($perid, $module_id, $role_id);

				if ($this->form_validation->run() == FALSE) {
					// validation fail
					redirect("admin/permissions");
				} else if(isset($id) && $id != '') {
					$record = $this->general_model->get_permission_by_name($name);
					if ($record) {
						$this->session->set_flashdata('warning_msg', 'Warning: This permission is already added!');
					} else {
						$data = array(
							'name' => $name
						);
						$res = $this->permissions_model->update_permission_data($id, $data);
						if (isset($res)) {
							$this->session->set_flashdata('success_msg', 'Permission updated successfully!');
						} else {
							$this->session->set_flashdata('error_msg', 'Error while updating permission!');
						}
					}
					redirect("admin/permissions/index");
				}
		// } else {
		// 	$this->load->view('admin/no_permission_access');
		// }
	}

	/* Permission module ends */
}
