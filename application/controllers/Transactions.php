<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transactions extends CI_Controller
{

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function __construct()
    {
        parent::__construct();


        $this->dbs_user_id = $vs_id = $this->session->userdata('us_id');
        $this->login_vs_role_id = $this->dbs_role_id = $vs_role_id = $this->session->userdata('us_role_id');
        $this->load->model('user/general_model', 'general_model');
        // $this->load->model('user/roles_model', 'roles_model');
        // if(isset($vs_id) && (isset($vs_role_id) && $vs_role_id>=1)){

        // // 	$res_nums = $this->general_model->check_controller_permission_access('Admin/Users',$vs_role_id,'1');
        // // 	if($res_nums>0){

        // // 	}else{
        // // 		redirect('/');
        // // 	} 
        // }else{
        // 	redirect('login');
        // }

        // $this->load->model('user/users_model', 'users_model');
        // $this->load->model('user/transactions_model', 'transactions_model');
        // $this->load->model('user/configurations_model', 'configurations_model');
        $this->load->model('user/bookings_model', 'bookings_model');
        $this->load->model('user/gigs_model', 'gigs_model');
        // $perms_arrs = array('role_id' => $vs_role_id);
        // $this->gig_status_key = 'gig-status';
        // $this->genre_key = 'genre';
        // $this->category_key = 'category';

        // $this->load->library('Ajax_pagination');
        $this->load->library('cart');
        // $this->load->library('stripe');
        // $this->perPage = 25;
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function index()
    {
        $user_id = $this->dbs_user_id;
        $transactions = $this->bookings_model->get_transactions_by_user_id($user_id, 'customer');
        foreach($transactions as $transaction) {
            $booking = $this->bookings_model->get_booking_by_id($transaction->booking_id);
            $cart_items = $this->bookings_model->get_booking_items($booking->id);
            $gig_names = '';
            $ticket_names = '';
            if($cart_items){
                foreach($cart_items as $item) {
                    $gig = $this->gigs_model->get_gig_by_id($item->gig_id);
                    $ticket = $this->gigs_model->get_ticket_tier_by_id($item->ticket_tier_id);
                    $temp_gig_titles[] = $gig->title;
                    $gig_names = implode(', ', $temp_gig_titles);
                    $temp_tickets[] = $ticket->name;
                    $ticket_names = implode(', ', $temp_tickets);
                }
            }
            $transaction->booking = $booking;
            $transaction->gig_names = $gig_names;
            $transaction->ticket_names = $ticket_names;
        }
        $data['transactions'] = $transactions;
        // echo json_encode($transactions);
        // die();
        $this->load->view('frontend/transactions/index', $data);
    }

    
}
