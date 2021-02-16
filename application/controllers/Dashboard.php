<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		// $this->dbs_user_id = $vs_id = $this->session->userdata('us_id');
		// $this->login_usr_role_id = $this->dbs_user_role_id = $vs_user_role_id = $this->session->userdata('us_role_id');
		$this->load->model('user/general_model', 'general_model');
		$this->load->model('user/permissions_model', 'permissions_model');
		$this->load->model('user/gigs_model', 'gigs_model');
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

		$this->genre_key = 'genre';
		$this->category_key = 'category';
		$this->gig_status_key = 'gig-status';

		$this->load->model('user/dashboard_model', 'dashboard_model');
		// $this->load->model('user/admin_model', 'admin_model');
		$this->load->library('Ajax_pagination');
		// $this->perPage = 12;
	}

	public function index()
	{
		$gigs = $this->gigs_model->get_all_active_gigs();
		$featured_gigs = array();
		$now_showing = array();
		$just_in = array();
		if ($gigs) {
			// $today = strtotime('Today');
			$now = new DateTime();
			// echo $now;die();
			foreach ($gigs as $gig) {
				$user = $this->users_model->get_user_by_id($gig->user_id);
				$gig->user_name = $user->fname . ' ' . $user->lname;
				$args = [
					'key' => $this->genre_key,
					'value' => $gig->genre
				];
				$genre = $this->configurations_model->get_configuration_by_key_value($args);
				$gig->genre_name = $genre->label;
				$gig_date = new DateTime($gig->gig_date);
				$interval = $gig_date->diff($now);
				$gig->days_left = $interval->format('%a');
				$created_on = new DateTime($gig->created_on);
				$interval1 = $created_on->diff($now);
				$gig_created_diff = $interval1->format('%a');
				$gig->booked = 0;
				$gig->ticket_left = $gig->goal - 0;
				if ($gig->is_featured) {
					$featured_gigs[] = $gig;
				}
				if ($gig->days_left == 0 && (new DateTime(date('H:i:s')) > new DateTime(date('H:i:s', strtotime($gig->start_time))) && new DateTime(date('H:i:s')) < new DateTime(date('H:i:s', strtotime($gig->end_time))))) {
					$now_showing[] = $gig;
				}
				if ($gig_created_diff <= 1) {
					$just_in[] = $gig;
				}
			}
		}
		$data['gigs'] = $gigs;
		$data['featured_gigs'] = $featured_gigs;
		$data['now_showing'] = $now_showing;
		$data['just_in'] = $just_in;
		// $data['gigs'] = [];
		// echo json_encode(new DateTime(date('H:i:s')));
		// echo json_encode($data['now_showing']);
		// echo json_encode($time_spanned);
		// echo json_encode($time_spanned1);
		// die();
		$this->load->view('frontend/index', $data);
	}
}
