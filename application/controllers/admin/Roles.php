<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Roles extends CI_Controller
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
		// 	$res_nums = $this->general_model->check_controller_permission_access('Admin/Roles',$vs_role_id,'1');
		// 	if($res_nums>0){
		// 		/* ok */
		// 	}else{
		// 		redirect('/');
		// 	} 
		// }else{
		// 	redirect('/');
		// }

		$this->load->model('admin/users_model', 'users_model');
		$this->load->model('admin/admin_model', 'admin_model');
		$this->load->model('admin/roles_model', 'roles_model');
		$this->load->model('admin/gigs_model', 'gigs_model');
		$this->load->model('admin/permissions_model', 'permissions_model');
		$perms_arrs = array('role_id' => $vs_role_id);

		$this->load->library('Ajax_pagination');
		$this->perPage = 25;
	}


	function index()
	{
		// $res_nums = $this->general_model->check_controller_method_permission_access('Admin/Roles', 'index', $this->dbs_role_id, '1');
		// if ($res_nums > 0) {

		// $data['page_headings'] = "Roles List";
		$data['records'] = $this->roles_model->get_all_roles();
		$this->load->view('admin/roles/index', $data);
		// } else {
		// 	$this->load->view('admin/no_permission_access');
		// }
	}


	function trash($args2 = '')
	{
		// $res_nums = $this->general_model->check_controller_method_permission_access('Admin/Roles', 'trash', $this->dbs_role_id, '1');
		// if ($res_nums > 0) {

		// $data['page_headings'] = "Roles List";
		if ($args2 > 0) {
			$this->desync_role_permissions($args2);
			$this->roles_model->trash_role($args2);
		}
		$this->session->set_flashdata('deleted_msg', 'Role is deleted');
		redirect('admin/roles');
		// } else {
		// 	$this->load->view('admin/no_permission_access');
		// }
	}


	function trash_aj()
	{
		$res_nums = $this->general_model->check_controller_method_permission_access('Admin/Roles', 'trash', $this->dbs_role_id, '1');
		if ($res_nums > 0) {

			if (isset($_POST["args1"]) && $_POST["args1"] > 0) {
				$args1 = $this->input->post("args1");
				$this->roles_model->trash_role($args1);
			}

			$data['records'] = $this->roles_model->get_all_roles();
			$this->load->view('admin/roles/index_aj', $data);
		} else {
			$this->load->view('admin/no_permission_access');
		}
	}

	function trash_multiple()
	{
		$res_nums = $this->general_model->check_controller_method_permission_access('Admin/Roles', 'trash', $this->dbs_role_id, '1');
		if ($res_nums > 0) {

			if (isset($_POST["multi_action_check"]) && count($_POST["multi_action_check"]) > 0) {
				$del_checks = $_POST["multi_action_check"];
				foreach ($del_checks as $args2) {
					$this->roles_model->trash_role($args2);
				}
			}

			$data['records'] = $this->roles_model->get_all_roles();
			$this->load->view('admin/roles/index_aj', $data);
		} else {
			$this->load->view('admin/no_permission_access');
		}
	}


	function add()
	{
		// $res_nums = $this->general_model->check_controller_method_permission_access('Admin/Roles', 'add', $this->dbs_role_id, '1');
		// if ($res_nums > 0) {

		// $data['page_headings'] = 'Add Role';

		if (isset($_POST) && !empty($_POST)) {
			// echo json_encode($_POST);
			// die();

			// get form input
			$name = $this->input->post("name");
			$permission_ids = $this->input->post("permission_ids");
			// echo json_encode($permission_ids);
			// die();
			// form validation
			$this->form_validation->set_rules("name", "Role Name", "trim|required|xss_clean");

			if ($this->form_validation->run() == FALSE) {
				// validation fail
				redirect('admin/roles/add');
			} else {
				$record = $this->general_model->get_role_by_name($name);
				if ($record) {
					$this->session->set_flashdata('warning_msg', 'Warning: This role is already added!');
				} else {
					$created_on = date('Y-m-d H:i:s');
					$data = array(
						'name' => $name,
						'created_on' => $created_on
					);
					$res = $this->roles_model->insert_role_data($data);
					if (isset($res)) {
						if (isset($permission_ids)) {
							foreach ($permission_ids as $permission_id) {
								$temp[] = array(
									'role_id' => $res,
									'permission_id' => $permission_id
								);
							}
							$sync_perm = $this->general_model->sync_role_permissions($temp);
							if ($sync_perm) {
								$this->session->set_flashdata('success_msg', 'Role added successfully!');
							} else {
								$this->session->set_flashdata('error_msg', 'Error while adding Role Permissions!');
							}
						}
						$this->session->set_flashdata('success_msg', 'Role added successfully!');
					} else {
						$this->session->set_flashdata('error_msg', 'Error while adding Role!');
					}
				}
				redirect('admin/roles');
			}
		} else {
			$data['records'] = $this->permissions_model->get_all_permissions();
			$this->load->view('admin/roles/add', $data);
		}
		// } else {
		// 	$this->load->view('admin/no_permission_access');
		// }
	}


	function update($args1 = '')
	{

		// $res_nums = $this->general_model->check_controller_method_permission_access('Admin/Roles', 'update', $this->dbs_role_id, '1');
		// if ($res_nums > 0) {

		// if (isset($args1) && $args1 != '') {
		// 	$data['args1'] = $args1; //
		// 	$data['page_headings'] = 'Update Role';
		// } else {
		// 	$data['page_headings'] = 'Add Role';
		// }

		if (isset($_POST) && !empty($_POST)) {
			// echo json_encode($_POST);
			// die();

			// get form input
			$name = $this->input->post("name");
			$permission_ids = $this->input->post("permission_ids");
			$args1 = $this->input->post("args1");
			// form validation
			$this->form_validation->set_rules("name", "Role Name", "trim|required|xss_clean");

			if ($this->form_validation->run() == FALSE) {
				// validation fail
				// echo 'Helo';
				$this->load->view('admin/roles/update');
			} else if (isset($args1) && $args1 != '') {
				// echo 'World';
				// $created_on = date('Y-m-d H:i:s');
				$record = $this->general_model->get_role_by_name($name);
				$role = $this->roles_model->get_role_by_id($args1);

				if ($record && $name != $role->name) {
					$this->session->set_flashdata('warning_msg', 'Warning: This role is already added!');
				} else {
					$data = array(
						'name' => $name,
					);
					$res = $this->roles_model->update_role_data($args1, $data);
					// echo $res;
					// die();
					if ($res) {
						if (isset($permission_ids)) {
							// echo 'meow';

							foreach ($permission_ids as $permission_id) {
								$temp[] = array(
									'role_id' => $args1,
									'permission_id' => $permission_id
								);
							}
							$this->desync_role_permissions($args1);
							$sync_perm = $this->general_model->sync_role_permissions($temp);
							if ($sync_perm) {
								$this->session->set_flashdata('success_msg', 'Role updated successfully!');
							} else {
								$this->session->set_flashdata('error_msg', 'Error while updating Role Permissions!');
							}
						}
						$this->session->set_flashdata('success_msg', 'Role updated successfully!');
					} else {
						$this->session->set_flashdata('error_msg', 'Error while updating Role!');
					}
				}
				// echo 'meow';
				// die();
				redirect('admin/roles');
			} else {
				$data['args1'] = $args1;
				$data['role'] = $this->roles_model->get_role_by_id($args1);
				$data['records'] = $this->permissions_model->get_all_permissions();
				$role_permissions = $this->general_model->get_role_permissions($args1);
				$temp = [];
				if (isset($role_permissions)) {
					foreach ($role_permissions as $key => $value) {
						$temp[] = $value->permission_id;
					}
				}
				$data['role_permissions'] = $temp;
				// echo json_encode($data);
				// die();
				$this->load->view('admin/roles/update', $data);
			}
		} else {
			$data['args1'] = $args1;
			$data['role'] = $this->roles_model->get_role_by_id($args1);
			$data['records'] = $this->permissions_model->get_all_permissions();
			$role_permissions = $this->general_model->get_role_permissions($args1);
			$temp = [];
			if (isset($role_permissions)) {
				foreach ($role_permissions as $key => $value) {
					$temp[] = $value->permission_id;
				}
			}
			$data['role_permissions'] = $temp;
			$this->load->view('admin/roles/update', $data);
		}
		// } else {
		// 	$this->load->view('admin/no_permission_access');
		// }
	}

	function desync_role_permissions($role_id)
	{
		$role_permissions = $this->general_model->get_role_permissions($role_id);
		if (isset($role_permissions)) {
			foreach ($role_permissions as $key => $value) {
				$this->general_model->desync_role_permissions($value->id);
			}
		}
	}
}
