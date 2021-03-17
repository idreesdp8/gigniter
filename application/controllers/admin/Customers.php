<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Customers extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();


		$this->dbs_user_id = $vs_id = $this->session->userdata('us_id');
		$this->login_vs_role_id = $this->dbs_role_id = $vs_role_id = $this->session->userdata('us_role_id');
		$this->load->model('admin/general_model', 'general_model');
		$this->load->model('admin/permissions_model', 'permissions_model');
		// if(isset($vs_id) && (isset($vs_role_id) && $vs_role_id>=1)){

		// 	$res_nums = $this->general_model->check_controller_permission_access('Admin/Users',$vs_role_id,'1');
		// 	if($res_nums>0){

		// 	}else{
		// 		redirect('/');
		// 	} 
		// }else{
		// 	redirect('/');
		// }

		$this->load->model('admin/users_model', 'users_model');
		// $this->load->model('admin/configurations_model', 'configurations_model');
		$this->load->model('admin/gigs_model', 'gigs_model');
		$this->load->model('user/bookings_model', 'bookings_model');
		$perms_arrs = array('role_id' => $vs_role_id);
		// $this->key = 'gig-status';

		// $this->load->library('Ajax_pagination');
		// $this->perPage = 25;
	}

	/* users functions starts */
	function index()
	{
		// $res_nums = $this->general_model->check_controller_method_permission_access('Admin/Users', 'index', $this->dbs_role_id, '1');
		// if ($res_nums > 0) {

		$bookings = $this->bookings_model->get_all_bookings();
		foreach ($bookings as $booking) {
			$user = $this->users_model->get_user_by_id($booking->user_id);
			$count = $this->bookings_model->get_booking_items_count($booking->id);
			// $temp = ['key' => $this->key, 'value' => $booking->status];
			// $status = $this->configurations_model->get_configuration_by_key_value($temp);
			// $booking->status_label = $status->label;
			$booking->user_name = $user->fname.' '.$user->lname;
			$booking->item_count = $count;
		}
		$data['records'] = $bookings;
		// echo json_encode($data);
		// die();
		// $data['page_headings'] = "Users List";
		$this->load->view('admin/bookings/index', $data);
		// } else {
		// 	$this->load->view('admin/no_permission_access');
		// }
	}

	function trash($args2 = '')
	{
		// $res_nums = $this->general_model->check_controller_method_permission_access('Admin/Users', 'trash', $this->dbs_role_id, '1');
		// if ($res_nums > 0) {

		// $data['page_headings'] = "Users List";
		// echo $args2;
		// die();
		$this->bookings_model->remove_booking_cart_items($args2);
		$this->bookings_model->trash_booking($args2);
		$this->session->set_flashdata('deleted_msg', 'Booking is deleted');
		redirect('admin/bookings');
		// } else {
		// 	$this->load->view('admin/no_permission_access');
		// }
	}

	function show($args1 = '')
	{
		$booking = $this->bookings_model->get_booking_by_id($args1);
		$user = $this->users_model->get_user_by_id($booking->user_id);
		$booking->user_name = $user->fname.' '.$user->lname;
		$data['booking'] = $booking;
		$cart_items = $this->bookings_model->get_booking_items($args1);
		foreach($cart_items as $item){
			$gig = $this->gigs_model->get_gig_by_id($item->gig_id);
			$ticket_tier = $this->gigs_model->get_ticker_tier_by_id($item->ticket_tier_id);
			$item->gig_title = $gig->title;
			$item->ticket_tier = $ticket_tier;
			$ticket_tier_bundles = $this->gigs_model->get_ticket_bundles_by_ticket_tier_id($item->ticket_tier_id);
			// $item->image = '';
			$item->bundles = $ticket_tier_bundles;
			// if($ticket_tier_bundles) {
			// 	foreach($ticket_tier_bundles as $bundle) {
			// 		if($item->image == '') {
			// 			$item->image = $bundle->image;
			// 		}
			// 	}
			// }
		}
		$data['cart_items'] = $cart_items;
		// echo json_encode($data);
		// die();
		$this->load->view('admin/bookings/show', $data);
	}

	// function update($args1 = '')
	// {

	// 	// $res_nums = $this->general_model->check_controller_method_permission_access('Admin/Users', 'update', $this->dbs_role_id, '1');
	// 	// if ($res_nums > 0) {

	// 	if (isset($_POST) && !empty($_POST)) {
	// 		// get form input
	// 		$data = $_POST;
	// 		// echo json_encode($data);
	// 		// echo json_encode($_FILES);
	// 		// die();

	// 		// form validation
	// 		$this->form_validation->set_rules("title", "Title", "trim|required|xss_clean");
	// 		$this->form_validation->set_rules("category", "Category", "trim|required|xss_clean");
	// 		$this->form_validation->set_rules("genre", "Genre", "trim|required|xss_clean");
	// 		$this->form_validation->set_rules("goal", "Goal", "trim|required|xss_clean");
	// 		$this->form_validation->set_rules("campaign_date", "Campaign Date", "trim|required|xss_clean");
	// 		$this->form_validation->set_rules("gig_date", "Gig date", "trim|required|xss_clean");

	// 		if ($this->form_validation->run() == FALSE) {
	// 			// validation fail
	// 			redirect('admin/gigs/update/' . $data['id']);
	// 		} else {

	// 			$datas = array(
	// 				'title' => $data['title'],
	// 				'subtitle' => $data['subtitle'] ?? null,
	// 				'category' => $data['category'],
	// 				'genre' => $data['genre'],
	// 				'address' => $data['address'] ?? null,
	// 				'goal' => $data['goal'],
	// 				'is_overshoot' => $data['is_overshoot'] ?? 0,
	// 				'is_featured' => $data['is_featured'],
	// 				'is_draft' => $data['is_draft'],
	// 				'is_exclusive' => $data['is_exclusive'],
	// 				'campaign_date' => date('Y-m-d H:i:s', strtotime($data['campaign_date'])),
	// 				'gig_date' => date('Y-m-d H:i:s', strtotime($data['gig_date'])),
	// 				'start_time' => date('H:i:s', strtotime($data['start_time'])),
	// 				'end_time' => date('H:i:s', strtotime($data['end_time'])),
	// 				'venues' => array_key_exists('venues', $data) ? implode(',', $data['venues']) : '',
	// 				'status' => $data['status'] ?? null,
	// 			);

	// 			$prof_poster_error = '';
	// 			$alw_typs = array('image/jpg', 'image/jpeg', 'image/png', 'image/gif');
	// 			// $imagename = (isset($_POST['old_image']) && $_POST['old_image'] != '') ? $_POST['old_image'] : '';
	// 			$gig = $this->gigs_model->get_gig_by_id($data['id']);
	// 			if (isset($_FILES['poster']['tmp_name']) && $_FILES['poster']['tmp_name'] != '') {
	// 				// echo json_encode($_FILES['image']);
	// 				// die();
	// 				if (!(in_array($_FILES['poster']['type'], $alw_typs))) {
	// 					$tmp_img_type = "'" . ($_FILES['poster']['type']) . "'";
	// 					$prof_poster_error .= "Poster type: $tmp_img_type not allowed!<br>";
	// 				}

	// 				if ($prof_poster_error == '') {
	// 					@unlink("downloads/posters/thumb/$gig->poster");
	// 					@unlink("downloads/posters/$gig->poster");
	// 					$image_path = poster_relative_path();
	// 					$thumbnail_path = poster_thumbnail_relative_path();
	// 					$imagename = time() . $this->general_model->fileExists($_FILES['poster']['name'], $image_path);
	// 					$target_file = $image_path . $imagename;
	// 					@move_uploaded_file($_FILES["poster"]["tmp_name"], $target_file);
	// 					$width = 360;
	// 					$height = 354;
	// 					$thumbnail = $this->general_model->_create_thumbnail($imagename, $image_path, $thumbnail_path, $width, $height);
	// 					if ($thumbnail == '1') {
	// 						$thumbnail_file = $thumbnail_path . $imagename;
	// 					}
	// 					// echo $thumbnail;
	// 					@move_uploaded_file($_FILES["poster"]["tmp_name"], $thumbnail_file);
	// 					$datas['poster'] = $imagename;
	// 				}
	// 				if (strlen($prof_poster_error) > 0) {
	// 					$this->session->set_flashdata('prof_poster_error', $prof_poster_error);
	// 					redirect('admin/gigs/update');
	// 					// $this->load->view('admin/users/add', $data);
	// 				}
	// 			}
	// 			// echo json_encode($datas);
	// 			// die();
	// 			$user_id = $gig->user_id;
	// 			$file = [];
	// 			if (isset($_FILES['image']['tmp_name']) && $_FILES['image']['tmp_name'] != '') {
	// 				$file = $_FILES['image'];
	// 			}
	// 			$this->update_user_data($data, $file, $user_id);
	// 			$res = $this->gigs_model->update_gig_data($data['id'], $datas);
	// 			if (isset($res)) {
	// 				$this->remove_tickets($data['id']);
	// 				$this->add_tickets($data, $data['id']);
	// 				$this->session->set_flashdata('success_msg', 'Gig updated successfully!');
	// 			} else {
	// 				$this->session->set_flashdata('error_msg', 'Error: while updating gig!');
	// 			}

	// 			redirect("admin/gigs");
	// 		}
	// 	} else {
	// 		$booking = $this->bookings_model->get_booking_by_id($args1);
	// 		$user = $this->users_model->get_user_by_id($booking->user_id);
	// 		$booking->user_name = $user->fname.' '.$user->lname;
	// 		$data['booking'] = $booking;
	// 		$cart_items = $this->bookings_model->get_booking_items($args1);
	// 		// foreach ($cart_items as $item) {
	// 		// 	$bundles = $this->gigs_model->get_ticket_bundles_by_ticket_tier_id($item->id);
	// 		// 	$item->bundles = $bundles;
	// 		// }
	// 		$data['tickets'] = $cart_items;
	// 		$data['categories'] = $this->configurations_model->get_all_configurations_by_key('category');
	// 		$data['genres'] = $this->configurations_model->get_all_configurations_by_key('genre');
	// 		$data['status'] = $this->configurations_model->get_all_configurations_by_key('gig-status');
	// 		$data['countries'] = $this->countries_model->get_all_countries();
	// 		$data['user'] = $this->users_model->get_user_by_id($gig->user_id);
	// 		$links = $this->users_model->get_social_links($gig->user_id);
	// 		if (isset($links) && !empty($links)) {
	// 			foreach ($links as $key => $val) {
	// 				$temp[] = [$val->platform => $val->url];
	// 			}
	// 			$data['link'] = $temp;
	// 		} else {
	// 			$data['link'] = [];
	// 		}
	// 		// echo json_encode($data);
	// 		// die();
	// 		$this->load->view('admin/gigs/update', $data);
	// 	}
	// 	// } else {
	// 	// 	$this->load->view('admin/no_permission_access');
	// 	// }
	// }

	/* users functions ends */
}
