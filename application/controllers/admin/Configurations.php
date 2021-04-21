<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Configurations extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();


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
		$perms_arrs = array('role_id' => $vs_role_id);

		$this->load->library('Ajax_pagination');
		$this->perPage = 25;
	}


	/* Permission module starts */
	function index()
	{
		// $res_nums =  $this->general_model->check_controller_method_permission_access('Admin/Permissions','index',$this->dbs_role_id,'1'); 
		// if($res_nums>0){ 
		$param = [
			'key1' => 'gig-status',
			'key2' => 'genre',
			'key3' => 'category',
			'key4' => 'popularity_weightage'
		];
		$data['records'] = $this->configurations_model->get_all_configurations_except($param);
		// echo json_encode($data);
		// die();
		// $data['page_headings'] = "Permissions List";
		$this->load->view('admin/configurations/index', $data);

		// }else{ 
		// 	$this->load->view('admin/no_permission_access'); 
		// } 
	}

	function popularity_weightage()
	{
		if(isset($_POST) && !empty($_POST)){
			$data = $this->input->post();
			$created_on = date('Y-m-d H:i:s');
			foreach($data as $key => $value){
				$params[] = [
					'key' => 'popularity_weightage',
					'value' => $value,
					'label' => $key,
					'created_on' => $created_on
				];
			}
			// echo json_encode($params);
			// die();
			
			$weightages = $this->configurations_model->get_all_configurations_by_key('popularity_weightage');
			foreach($weightages as $weight) {
				$this->configurations_model->trash_configuration($weight->id);
			}

			$res = $this->configurations_model->insert_batch_configuration_data($params);
			if (isset($res)) {
				$this->session->set_flashdata('success_msg', 'Popularity Weightages added successfully!');
			} else {
				$this->session->set_flashdata('error_msg', 'Error while adding Popularity Weightages!');
			}
			redirect("admin/configurations/popularity_weightage");

		} else {
			$weightages = $this->configurations_model->get_all_configurations_by_key('popularity_weightage');
			$data = array();
			if($weightages){
				foreach($weightages as $weight) {
					$data[$weight->label] = $weight->value;
				}
			}
			// echo json_encode($data);
			// die();
			$this->load->view('admin/configurations/popularity_weightage', $data);
		}
	}

	function trash($id)
	{
		// $res_nums =  $this->general_model->check_controller_method_permission_access('Admin/Permissions', 'trash', $this->dbs_role_id, '1');
		// if ($res_nums > 0) {

		// $data['page_headings'] = "Permissions List";
		if ($id > 0) {
			$this->configurations_model->trash_configuration($id);
		}
		$this->session->set_flashdata('deleted_msg', 'Configuration is deleted');
		redirect('admin/configurations');
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
		$label = $this->input->post("label");
		$key = $this->input->post("key");
		$value = $this->input->post("value");

		// echo json_encode($_POST);
		// die();
		// form validation
		$this->form_validation->set_rules("label", "Configuration Label", "trim|required|xss_clean");
		$this->form_validation->set_rules("key", "Configuration Key", "trim|required|xss_clean");
		$this->form_validation->set_rules("value", "Configuration Value", "trim|required|xss_clean");

		if ($this->form_validation->run() == FALSE) {
			// validation fail
			redirect("admin/configurations");
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
				$this->session->set_flashdata('success_msg', 'Configuration added successfully!');
			} else {
				$this->session->set_flashdata('error_msg', 'Error while adding Configuration!');
			}
			redirect("admin/configurations");
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

	function update()
	{
		// echo json_encode($_POST);
		// die();

		// $res_nums =  $this->general_model->check_controller_method_permission_access('Admin/Permissions', 'update', $this->dbs_role_id, '1');
		// if ($res_nums > 0) {

		// get form input
		$value = $this->input->post("value");
		$label = $this->input->post("label");
		$id = $this->input->post("id");

		// form validation
		$this->form_validation->set_rules("value", "Value", "trim|required|xss_clean");
		$this->form_validation->set_rules("label", "Label", "trim|required|xss_clean");

		// $rec_nums = $this->general_model->get_permission_by_module_role($perid, $module_id, $role_id);

		if ($this->form_validation->run() == FALSE) {
			// validation fail
			redirect("admin/configurations");
		} else if (isset($id) && $id != '') {
			$data = array(
				'value' => $value,
				'label' => $label
			);
			$res = $this->configurations_model->update_configuration_data($id, $data);
			if (isset($res)) {
				$this->session->set_flashdata('success_msg', 'Configuration updated successfully!');
			} else {
				$this->session->set_flashdata('error_msg', 'Error while updating Configuration!');
			}
			redirect("admin/configurations");
		}
		// } else {
		// 	$this->load->view('admin/no_permission_access');
		// }
	}

	/* Permission module ends */
}
