<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pages extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		// $this->dbs_user_id = $vs_id = $this->session->userdata('us_id');
		// $this->login_usr_role_id = $this->dbs_user_role_id = $vs_user_role_id = $this->session->userdata('us_role_id');
		$this->load->model('user/general_model', 'general_model');
		$this->load->model('user/permissions_model', 'permissions_model');
		$this->load->model('user/configurations_model', 'configurations_model');
		$this->load->model('user/users_model', 'users_model');
		// if (isset($vs_id) && (isset($vs_user_role_id) && $vs_user_role_id >= 1)) {
		// 	// /* ok */
		// 	// $res_nums = $this->general_model->check_controller_permission_access('Admin/Dashboard', $vs_user_role_id, '1');
		// 	// if ($res_nums > 0) {
		// 	// 	/* ok */
		// 	// } else {
		// 	// 	redirect('/');
		// 	// }
		// } else {
		// 	redirect('account/login');
		// }

		$this->load->model('user/dashboard_model', 'dashboard_model');
		// $this->load->model('user/admin_model', 'admin_model');
		$this->load->library('Ajax_pagination');
		// $this->perPage = 12;
	}

	function contact()
	{
		$this->load->view('frontend/pages/contact');
	}

	function about()
	{
		$this->load->view('frontend/pages/about');
	}

	function terms()
	{
		$this->load->view('frontend/pages/terms');
	}

	function privacy_policy()
	{
		$this->load->view('frontend/pages/privacy_policy');
	}

	function faq()
	{
		$this->load->view('frontend/pages/faq');
	}
}
