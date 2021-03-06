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
			// echo json_encode($cart_items);
			// die();
			$gig_name = '';
			$ticket_names = '';
			if ($cart_items) {
				$temp_gig_titles = array();
				$temp_tickets_titles = array();
				$now = strtotime('now');
				foreach ($cart_items as $item) {
					$gig = $this->gigs_model->get_gig_by_id($item->gig_id);
					$gig_date = strtotime($gig->gig_date);
					$interval = $gig_date - $now;
					$hours = round($interval/3600, 0);
					$ticket = $this->gigs_model->get_ticket_tier_by_id($item->ticket_tier_id);
					$temp_gig_titles[] = $gig->title;
					$temp_gig_ids[] = $gig->id;
					$gig_id = implode(', ', array_unique($temp_gig_ids));
					$gig_name = implode(', ', array_unique($temp_gig_titles));
					$temp_tickets_titles[] = ($ticket->name ?? '') . ' <small>(x' . $item->quantity . ')</small>';
					$ticket_names = implode(', ', /* array_unique */ ($temp_tickets_titles));
				}
			}
			// $booking->transaction = $transaction;
			$booking->gig_name = $gig_name;
			$booking->hours = $hours;
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
		if ($args1 == '') {
			redirect('bookings');
		}
		$booking = $this->bookings_model->get_booking_by_id($args1);
		if($booking->user_id != $this->dbs_user_id) {
			redirect('bookings');
		}
		$transaction = $this->bookings_model->get_charged_transaction_by_booking_id($booking->id);
		$cart_items = $this->bookings_model->get_booking_items($booking->id);
		$customer = $this->users_model->get_user_by_id($booking->user_id);
		$now = strtotime('now');
		foreach ($cart_items as $item) {
			$gig = $this->gigs_model->get_gig_by_id($item->gig_id);
			$gig_date = strtotime($gig->gig_date);
			$interval = $gig_date - $now;
			$hours = round($interval/3600, 0);
			$ticket = $this->gigs_model->get_ticket_tier_by_id($item->ticket_tier_id);
			$category = $this->configurations_model->get_configuration_by_key_value(['key' => $this->category_key, 'value' => $gig->category]);
			$genre = $this->configurations_model->get_configuration_by_key_value(['key' => $this->genre_key, 'value' => $gig->genre]);
			$ticket_shares = $this->bookings_model->get_ticket_shares_cart_id($item->id);
			$gig->category = $category;
			$gig->genre = $genre;
			// $gig->venues = explode(',', $gig->venues);
			// $item->gig = $gig;
			$item->purchased = $item->quantity;
			$item->quantity = $item->quantity - count($ticket_shares);
			$temp = [];
			foreach ($ticket_shares as $share) {
				$temp[] = $share->friend_email;
			}
			$item->friends = $temp;
			$item->ticket = $ticket;
		}
		$booking->items = $cart_items;
		$booking->hours = $hours;
		$booking->customer = $customer;
		$booking->transaction = $transaction;
		$data['booking'] = $booking;

		$cart_items = $this->bookings_model->get_booking_items_by_gig_id($gig->id);
		$ticket_bought = 0;
		foreach ($cart_items as $item) {
			$ticket_bought += $item->quantity;
		}
		$threshold = floor($gig->ticket_limit * .6);
		$gig->ticket_left = $threshold - $ticket_bought;
		$gig->booked = floor($ticket_bought / $gig->ticket_limit * 100);
		$data['gig'] = $gig;
		// echo json_encode($data);
		// die();
		$this->load->view('frontend/bookings/show', $data);
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

	public function invite_friends()
	{
		$data = $_POST;
		// echo json_encode($data);
		// die();
		$user_id = $this->dbs_user_id;
		$cart_id = $this->input->post('cart_id');
		$booking_id = $this->input->post('booking_id');
		$created_on = date('Y-m-d H:i:s', strtotime('now'));
		$temp = [
			'user_id' => $user_id,
			'booking_id' => $booking_id,
			'cart_id' => $cart_id,
			'created_on' => $created_on,
		];
		$error = 1;
		foreach ($data['email'] as $email) {
			$temp['friend_email'] = $email;
			$send = $this->send_email($email, 'Invitation to Gigniter');
			if ($send) {
				$this->bookings_model->add_ticket_share($temp);
				$error = 0;
			} else {
				$error = 1;
				continue;
			}
		}
		if ($error) {
			$this->session->set_flashdata('error_msg', 'Error occured');
		} else {
			$this->session->set_flashdata('success_msg', 'Ticket are sent to your friends');
		}
		redirect('bookings');
	}
	function send_email($to_email, $subject)
	{
		$this->load->library('email');
		$from_email = $this->config->item('info_email');
		$from_name = $this->config->item('from_name');

		$data['link'] = user_base_url() . 'account/create_account?email=' . $this->general_model->safe_ci_encoder($to_email);

		$msg = $this->load->view('email/ticket_invitation', $data, TRUE);

		$this->email->from($from_email, $from_name);
		$this->email->to($to_email);
		$this->email->subject($subject);
		$this->email->message($msg);
		//Send mail
		if ($this->email->send()) {
			return true;
		} else {
			return false;
		}
	}

	function download_tickets()
	{
		// require 'vendor/autoload.php';
		if($this->input->post()){
			$data = $this->input->post();
		} else {
			$data = $this->input->get();
		}

		// echo json_encode($data);
		// die();
		$tickets = $this->gigs_model->get_tickets($data);
		foreach ($tickets as $ticket) {
			$gig = $this->gigs_model->get_gig_by_id($ticket->gig_id);
			$booking = $this->bookings_model->get_booking_by_id($ticket->booking_id);
			$owner = $this->users_model->get_user_by_id($booking->user_id);
			$ticket->gig_date = $gig->gig_date;
			$ticket->title = $gig->title;
			$ticket->start_time = $gig->start_time;
			$ticket->start_time = $gig->start_time;
			$ticket->end_time = $gig->end_time;
			$ticket->address = $gig->address;
			$ticket->fname = $owner->fname;
			$ticket->lname = $owner->lname;
		}
		$datas['tickets'] = $tickets;
		$this->load->view('frontend/bookings/download_tickets', $datas);
	}
}
