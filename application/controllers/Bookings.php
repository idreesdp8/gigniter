<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Bookings extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();


		$this->dbs_user_id = $vs_id = $this->session->userdata('us_id');
		$this->login_vs_role_id = $this->dbs_role_id = $vs_role_id = $this->session->userdata('us_role_id');
		$this->load->model('user/general_model', 'general_model');
		// $this->load->model('user/permissions_model', 'permissions_model');
		// if(isset($vs_id) && (isset($vs_role_id) && $vs_role_id>=1)){

		// 	$res_nums = $this->general_model->check_controller_permission_access('Admin/Users',$vs_role_id,'1');
		// 	if($res_nums>0){

		// 	}else{
		// 		redirect('/');
		// 	} 
		// }else{
		// 	redirect('/');
		// }

		$this->load->model('user/users_model', 'users_model');
		// $this->load->model('user/customers_model', 'customers_model');
		$this->load->model('user/configurations_model', 'configurations_model');
		$this->load->model('user/bookings_model', 'bookings_model');
		$this->load->model('user/gigs_model', 'gigs_model');
		$perms_arrs = array('role_id' => $vs_role_id);
		// $this->key = 'gig-status';
		$this->genre_key = 'genre';
		$this->category_key = 'category';

		// $this->load->library('Ajax_pagination');
		// $this->perPage = 25;
	}

	/* users functions starts */
	public function index()
	{
		$user_id = $this->dbs_user_id;
		$bookings = $this->bookings_model->get_bookings_by_user_id($user_id);
		foreach ($bookings as $booking) {
			// $user = $this->users_model->get_user_by_id($booking->user_id);
			// $transaction = $this->bookings_model->get_charged_transaction_by_booking_id($booking->id);
			$cart_items = $this->bookings_model->get_booking_items($booking->id);
			$gig_names = '';
			$ticket_names = '';
			if ($cart_items) {
				$temp_gig_titles = array();
				$temp_tickets_titles = array();
				foreach ($cart_items as $item) {
					$gig = $this->gigs_model->get_gig_by_id($item->gig_id);
					$ticket = $this->gigs_model->get_ticket_tier_by_id($item->ticket_tier_id);
					$temp_gig_titles[] = $gig->title;
					$temp_gig_ids[] = $gig->id;
					$gig_id = implode(', ', array_unique($temp_gig_ids));
					$gig_name = implode(', ', array_unique($temp_gig_titles));
					$temp_tickets_titles[] = $ticket->name . ' <small>(x' . $item->quantity . ')</small>';
					$ticket_names = implode(', ', /* array_unique */ ($temp_tickets_titles));
				}
			}
			// $booking->transaction = $transaction;
			$booking->gig_name = $gig_name;
			$booking->gig_id = $gig_id;
			$booking->ticket_names = $ticket_names;
		}
		$data['bookings'] = $bookings;
		// echo json_encode($data);
		// die();
		// $data['page_headings'] = "Users List";
		$this->load->view('frontend/bookings/index', $data);
	}

	public function show($args1 = '')
	{
		if ($args1 != '') {
			$booking = $this->bookings_model->get_booking_by_id($args1);
			$transaction = $this->bookings_model->get_charged_transaction_by_booking_id($booking->id);
			$cart_items = $this->bookings_model->get_booking_items($booking->id);
			$customer = $this->users_model->get_user_by_id($booking->user_id);
			foreach ($cart_items as $item) {
				$gig = $this->gigs_model->get_gig_by_id($item->gig_id);
				$ticket = $this->gigs_model->get_ticket_tier_by_id($item->ticket_tier_id);
				$category = $this->configurations_model->get_configuration_by_key_value(['key' => $this->category_key, 'value' => $gig->category]);
				$genre = $this->configurations_model->get_configuration_by_key_value(['key' => $this->genre_key, 'value' => $gig->genre]);
				$gig->category = $category;
				$gig->genre = $genre;
				// $gig->venues = explode(',', $gig->venues);
				$item->gig = $gig;
				$item->ticket = $ticket;
			}
			$booking->items = $cart_items;
			$booking->customer = $customer;
			$booking->transaction = $transaction;
			$data['booking'] = $booking;
			
			$cart_items = $this->bookings_model->get_booking_items_by_gig_id($gig->id);
			$ticket_bought = 0;
			foreach ($cart_items as $item) {
				$ticket_bought += $item->quantity;
			}
			$gig->ticket_left = $gig->goal - $ticket_bought;
			$gig->booked = $ticket_bought / $gig->goal * 100;
			$data['gig'] = $gig;
			// echo json_encode($data);
			// die();
			$this->load->view('frontend/bookings/show', $data);
		}
	}

	public function cancel_booking($id)
	{
		// $booking_id = $this->input->post('id');
		$param = [
			'is_paid' => 2
		];
		// $res = $this->bookings_model->update_booking_data($id, $param);
		$res = $this->bookings_model->trash_booking($id);
		if ($res) {
			$this->session->set_flashdata('success_msg', 'Your Booking is cancelled!');
		} else {
			$this->session->set_flashdata('error_msg', 'Error occured');
		}
		redirect('bookings');
		// echo $booking_id;
		// die();
	}
}
