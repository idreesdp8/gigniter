<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Bookings extends CI_Controller
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
		$this->load->model('admin/customers_model', 'customers_model');
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
		$transactions = $this->bookings_model->get_transactions_by_booking_id($booking->id);
		$customer = '';
		$destination = '';
		foreach($transactions as $transaction) {
			if($transaction->type == 'charge') {
				$customer = $transaction->customer_id;
			} else if($transaction->type == 'transfer') {
				$destination = $transaction->destination_id;
			}
		}
		
		require_once('application/libraries/stripe-php/init.php');
		$stripeSecret = $this->config->item('stripe_api_key');
		\Stripe\Stripe::setApiKey($stripeSecret);
		$customer = \Stripe\Customer::retrieve($customer);
		$account = \Stripe\Account::retrieve($destination);
		// echo json_encode($account->individual);
		// die();
		$booking->user_name = $user->fname.' '.$user->lname;
		$data['booking'] = $booking;
		$data['customer'] = $customer;
		$data['transactions'] = $transactions;
		$data['account'] = $account;
		
		// echo json_encode($data);
		// die();
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
}