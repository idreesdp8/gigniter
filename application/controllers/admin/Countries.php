<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Countries extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();


		$this->dbs_user_id = $vs_id = $this->session->userdata('us_id');
		$this->login_vs_role_id = $this->dbs_role_id = $vs_role_id = $this->session->userdata('us_role_id');
		// $this->load->model('admin/general_model', 'general_model');
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
		$this->load->model('admin/countries_model', 'countries_model');
		$perms_arrs = array('role_id' => $vs_role_id);

		$this->load->library('Ajax_pagination');
		$this->perPage = 25;
	}


	/* Permission module starts */
	function index()
	{

		// $res_nums =  $this->general_model->check_controller_method_permission_access('Admin/Permissions','index',$this->dbs_role_id,'1'); 
		// if($res_nums>0){ 
		// $key = $this->key;
		$data['records'] = $this->countries_model->get_all_countries();
		// echo json_encode($data);
		// die();
		// $data['page_headings'] = "Permissions List";
		$this->load->view('admin/countries/index', $data);

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
			$this->countries_model->trash_country($id);
		}
		$this->session->set_flashdata('deleted_msg', 'Country is deleted');
		redirect('admin/countries');
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
		$name = $this->input->post("name");


		// form validation
		$this->form_validation->set_rules("name", "Country Name", "trim|required|xss_clean");

		if ($this->form_validation->run() == FALSE) {
			// validation fail
			redirect("admin/countries");
		} else {
			$record = $this->countries_model->get_country_by_name($name);
			if ($record) {
				$this->session->set_flashdata('warning_msg', 'Warning: This country is already added!');
			} else {
				$created_on = date('Y-m-d H:i:s');
				$data = array(
					'name' => $name,
					'created_on' => $created_on
				);
				// echo json_encode($data);
				// die();
				$res = $this->countries_model->insert_country_data($data);
				// echo json_encode($res);
				// die();
				if (isset($res)) {
					$this->session->set_flashdata('success_msg', 'Country added successfully!');
				} else {
					$this->session->set_flashdata('error_msg', 'Error while adding Country!');
				}
			}
			redirect("admin/countries");
		}
		// } else {
		// 	$this->load->view('admin/no_permission_access');
		// }
	}

	function edit()
	{
		// echo $this->input->post("id");
		$result = $this->countries_model->get_country_by_id($this->input->post("id"));
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
		$name = $this->input->post("name");
		$id = $this->input->post("id");

		// form validation
		$this->form_validation->set_rules("name", "Country Name", "trim|required|xss_clean");

		// $rec_nums = $this->general_model->get_permission_by_module_role($perid, $module_id, $role_id);

		if ($this->form_validation->run() == FALSE) {
			// validation fail
			redirect("admin/countries");
		} else if (isset($id) && $id != '') {
			$record = $this->countries_model->get_country_by_name($name);
			if ($record) {
				$this->session->set_flashdata('warning_msg', 'Warning: This country is already added!');
			} else {
				$data = array(
					'name' => $name,
				);
				$res = $this->countries_model->update_country_data($id, $data);
				if (isset($res)) {
					$this->session->set_flashdata('success_msg', 'Country updated successfully!');
				} else {
					$this->session->set_flashdata('error_msg', 'Error while updating genre!');
				}
			}
			redirect("admin/countries");
		}
		// } else {
		// 	$this->load->view('admin/no_permission_access');
		// }
	}

	/* Permission module ends */
}
