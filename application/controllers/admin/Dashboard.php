<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->dbs_user_id = $vs_id = $this->session->userdata('us_id');
		$this->login_usr_role_id = $this->dbs_user_role_id = $vs_user_role_id = $this->session->userdata('us_role_id');
		$this->load->model('admin/general_model', 'general_model');
		$this->load->model('admin/permissions_model', 'permissions_model');
		if (isset($vs_id) && (isset($vs_user_role_id) && $vs_user_role_id >= 1)) {
			// /* ok */
			// $res_nums = $this->general_model->check_controller_permission_access('Admin/Dashboard', $vs_user_role_id, '1');
			// if ($res_nums > 0) {
			// 	/* ok */
			// } else {
				// redirect('/');
			// }
		} else {
			redirect('admin/login');
		}

		$this->load->model('admin/dashboard_model', 'dashboard_model');
		$this->load->model('admin/admin_model', 'admin_model');
		$this->load->model('admin/gigs_model', 'gigs_model');
		$this->load->model('user/bookings_model', 'bookings_model');
		$this->load->library('Ajax_pagination');
		$this->perPage = 12;
	}



	function index()
	{
		// $res_nums = $this->general_model->check_controller_method_permission_access('Admin/Dashboard','index',$this->dbs_user_role_id,'1');  
		// if($res_nums>0){  

		$data['gigs_count'] = $this->gigs_model->get_gigs_count();
		$data['customers_count'] = $this->bookings_model->get_customers_count();
		$data['bookings_count'] = $this->bookings_model->get_bookings_count();
		$data['transaction'] = $this->bookings_model->get_total_admin_fee();
		// $data['']
		// echo json_encode($data);
		// die();
		$this->load->view('admin/dashboard/index', $data);

		//  }else{ 
		// 	$this->load->view('admin/no_permission_access'); 
		// }
	}

	// function line_chart() {
	// 	$gigs = $this->gigs_model->get
	// }
}
