<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Rejection_reasons extends CI_Controller
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
		$this->load->model('admin/permissions_model', 'permissions_model');
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
		$this->load->model('admin/configurations_model', 'configurations_model');
		$this->load->model('admin/gigs_model', 'gigs_model');
		$perms_arrs = array('role_id' => $vs_role_id);
		$this->key = 'gig-rejection-reason';

		$this->load->library('Ajax_pagination');
		$this->perPage = 25;
	}


	/* Permission module starts */
	function index()
	{

		// $res_nums =  $this->general_model->check_controller_method_permission_access('Admin/Permissions','index',$this->dbs_role_id,'1'); 
		// if($res_nums>0){ 
		$key = $this->key;
		$data['records'] = $this->configurations_model->get_all_configurations_by_key($key);
		// echo json_encode($data);
		// die();
		// $data['page_headings'] = "Permissions List";
		$this->load->view('admin/gig_rejection_reasons/index', $data);

		// }else{ 
		// 	$this->load->view('admin/no_permission_access'); 
		// } 
	}

	function trash($id)
	{
		// $res_nums =  $this->general_model->check_controller_method_permission_access('Admin/Permissions', 'trash', $this->dbs_role_id, '1');
		// if ($res_nums > 0) {

		// $data['page_headings'] = "Permissions List";
		if ($id > 0) {
			$this->configurations_model->trash_configuration($id);
		}
		$this->session->set_flashdata('deleted_msg', 'Gig rejection reason is deleted');
		redirect('admin/rejection_reasons');
		// } else {
		// 	$this->load->view('admin/no_permission_access');
		// }
	}

	function add()
	{
		// echo json_encode($_POST);
		// die();

		// $res_nums = $this->general_model->check_controller_method_permission_access('Admin/Permissions', 'add', $this->dbs_role_id, '1');
		// if ($res_nums > 0) {

		// get form input
		$label = $this->input->post("reason");
		$value = $this->input->post("reason");
		$key = $this->key;


		// form validation
		$this->form_validation->set_rules("reason", "Reason", "trim|required|xss_clean");
		// $this->form_validation->set_rules("value", "Value", "trim|required|xss_clean");

		if ($this->form_validation->run() == FALSE) {
			// validation fail
			redirect("admin/rejection_reasons");
		} else {
			$param = ['key'=>$key,'value'=>$value];
			$record = $this->configurations_model->get_configuration_by_key_value($param);
			if ($record) {
				$this->session->set_flashdata('warning_msg', 'Warning: This gig rejection reason is already added!');
			} else {
				$created_on = date('Y-m-d H:i:s');
				$data = array(
					'key' => $key,
					'value' => $value,
					'label' => $label,
					'created_on' => $created_on
				);
				// echo json_encode($data);
				// die();
				$res = $this->configurations_model->insert_configuration_data($data);
				// echo json_encode($res);
				// die();
				if (isset($res)) {
					$this->session->set_flashdata('success_msg', 'Gig rejection reason added successfully!');
				} else {
					$this->session->set_flashdata('error_msg', 'Error while adding Gig rejection reason!');
				}
			}
			redirect("admin/rejection_reasons");
		}
		// } else {
		// 	$this->load->view('admin/no_permission_access');
		// }
	}

	function edit()
	{
		// echo $this->input->post("id");
		$result = $this->configurations_model->get_configuration_by_id($this->input->post("id"));
		echo json_encode($result);
		die();
	}

	function get_rejection_reasons()
	{
		$key = $this->key;
		$records = $this->configurations_model->get_all_configurations_by_key($key);
		$resp = [];
		foreach ($records as $record) {
			$resp[$record->value] = $record->label;
		}
		echo json_encode($resp);
	}

	function update()
	{
		// echo json_encode($_POST);
		// die();

		// $res_nums =  $this->general_model->check_controller_method_permission_access('Admin/Permissions', 'update', $this->dbs_role_id, '1');
		// if ($res_nums > 0) {

		// get form input
		$label = $this->input->post("reason");
		$key = $this->key;
		// $value = strtolower(str_replace(' ', '-', $label));
		$id = $this->input->post("id");

		// form validation
		$this->form_validation->set_rules("reason", "Reason", "trim|required|xss_clean");

		// $rec_nums = $this->general_model->get_permission_by_module_role($perid, $module_id, $role_id);

		if ($this->form_validation->run() == FALSE) {
			// validation fail
			redirect("admin/rejection_reasons");
		} else if (isset($id) && $id != '') {
			
			// $param = ['key'=>$key,'value'=>$value];
			// $record = $this->configurations_model->get_configuration_by_key_value($param);
			// if ($record) {
			// 	$this->session->set_flashdata('warning_msg', 'Warning: This genre is already added!');
			// } else {
				$data = array(
					'key' => $key,
					'label' => $label
				);
				$res = $this->configurations_model->update_configuration_data($id, $data);
				if (isset($res)) {
					$this->session->set_flashdata('success_msg', 'Gig rejection reason updated successfully!');
				} else {
					$this->session->set_flashdata('error_msg', 'Error while updating Gig rejection reason!');
				}
			// }
			redirect("admin/rejection_reasons");
		}
		// } else {
		// 	$this->load->view('admin/no_permission_access');
		// }
	}

	/* Permission module ends */
}
