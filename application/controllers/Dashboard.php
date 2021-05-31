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
		$this->load->model('user/bookings_model', 'bookings_model');
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
		// echo date_default_timezone_get();
		// die();
		// $gigs = $this->gigs_model->get_all_active_gigs();
		$just_in = $this->gigs_model->get_just_in_gigs();
		$closing_soon = $this->gigs_model->get_closing_soon_gigs();
		$popular = $this->gigs_model->get_popular_gigs();
		$now_showing = $this->gigs_model->get_now_showing_gigs();
		$featured_gigs = $this->gigs_model->get_featured_gigs();
		$FE_gigs = $this->gigs_model->get_featured_and_exclusive_gigs();
		// $just_in = array();
		$now = new DateTime();
		if ($featured_gigs) {
			foreach ($featured_gigs as $gig) {
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
				$res = $this->get_tickets_booked_and_left($gig);
				$gig->booked = $res['booked'];
				$gig->ticket_left = $res['ticket_left'];
			}
		}
		if ($just_in) {
			foreach ($just_in as $gig) {
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
				$res = $this->get_tickets_booked_and_left($gig);
				$gig->booked = $res['booked'];
				$gig->ticket_left = $res['ticket_left'];
			}
		}
		if ($closing_soon) {
			foreach ($closing_soon as $gig) {
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
				$res = $this->get_tickets_booked_and_left($gig);
				$gig->booked = $res['booked'];
				$gig->ticket_left = $res['ticket_left'];
			}
		}
		if ($now_showing) {
			foreach ($now_showing as $gig) {
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
				$res = $this->get_tickets_booked_and_left($gig);
				$gig->booked = $res['booked'];
				$gig->ticket_left = $res['ticket_left'];
			}
		}
		if ($popular) {
			foreach ($popular as $gig) {
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
				$res = $this->get_tickets_booked_and_left($gig);
				$gig->booked = $res['booked'];
				$gig->ticket_left = $res['ticket_left'];
			}
		}
		if ($FE_gigs) {
			foreach ($FE_gigs as $gig) {
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
				$res = $this->get_tickets_booked_and_left($gig);
				$gig->booked = $res['booked'];
				$gig->ticket_left = $res['ticket_left'];
			}
		}
		// $data['gigs'] = $gigs;
		$data['featured_gigs'] = $featured_gigs;
		$data['now_showing'] = $now_showing;
		$data['popular'] = $popular;
		$data['just_in'] = $just_in;
		$data['closing_soon'] = $closing_soon;
		$data['FE_gigs'] = $FE_gigs;
		// $data['gigs'] = [];
		// echo json_encode(new DateTime(date('H:i:s')));
		// echo json_encode($data['now_showing']);
		// echo json_encode($time_spanned);
		// echo json_encode($data);
		// die();
		$this->load->view('frontend/index', $data);
	}

	function get_tickets_booked_and_left($gig)
	{
		// echo json_encode($gig);
		// die();
		$cart_items = $this->bookings_model->get_booking_items_by_gig_id($gig->id);
		$ticket_bought = 0;
		foreach ($cart_items as $item) {
			$ticket_bought += $item->quantity;
		}
		$param['ticket_left'] = $gig->ticket_limit - $ticket_bought;
		$param['booked'] = $ticket_bought / $gig->ticket_limit * 100;
		return $param;
	}
}
