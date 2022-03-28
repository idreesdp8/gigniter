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
        if (isset($vs_id) && (isset($vs_role_id) && $vs_role_id >= 1)) {

            // 	$res_nums = $this->general_model->check_controller_permission_access('Admin/Users',$vs_role_id,'1');
            // 	if($res_nums>0){

            // 	}else{
            // 		redirect('/');
            // 	} 
        } else {
            redirect('/');
        }

        $this->load->model('user/users_model', 'users_model');
        // $this->load->model('user/transactions_model', 'transactions_model');
        $this->load->model('user/configurations_model', 'configurations_model');
        $this->load->model('user/bookings_model', 'bookings_model');
        $this->load->model('user/gigs_model', 'gigs_model');
        // $perms_arrs = array('role_id' => $vs_role_id);
        $this->gig_status_key = 'gig-status';
        $this->genre_key = 'genre';
        $this->category_key = 'category';

        // $this->load->library('Ajax_pagination');
        // $this->load->library('cart');
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
        $gigs = $this->gigs_model->get_active_user_gigs($user_id);
        // $transactions = $this->bookings_model->get_transactions_by_user_id($user_id, 'customer');
        foreach ($gigs as $gig) {
            $status = $this->configurations_model->get_configuration_by_key_value(['key' => $this->gig_status_key, 'value' => $gig->status]);
            $gig->status_label = $status->label;
            // $booking = $this->bookings_model->get_booking_by_id($transaction->booking_id);
            // $cart_items = $this->bookings_model->get_booking_items($booking->id);
            // $gig_names = '';
            // $ticket_names = '';
            // if ($cart_items) {
            //     foreach ($cart_items as $item) {
            //         $gig = $this->gigs_model->get_gig_by_id($item->gig_id);
            //         $ticket = $this->gigs_model->get_ticket_tier_by_id($item->ticket_tier_id);
            //         $temp_gig_titles[] = $gig->title;
            //         $gig_names = implode(', ', array_unique($temp_gig_titles));
            //         $temp_tickets[] = $ticket->name;
            //         $ticket_names = implode(', ', array_unique($temp_tickets));
            //     }
            // }
            // $transaction->booking = $booking;
            // $transaction->gig_names = $gig_names;
            // $transaction->ticket_names = $ticket_names;
        }
        $data['gigs'] = $gigs;
        // echo json_encode($gigs);
        // die();
        $this->load->view('frontend/transactions/index', $data);
    }

    public function show($args1 = '')
    {
        if ($args1 != '') {
            $gig = $this->gigs_model->get_gig_by_id($args1);
            $status = $this->configurations_model->get_configuration_by_key_value(['key' => $this->gig_status_key, 'value' => $gig->status]);
            $category = $this->configurations_model->get_configuration_by_key_value(['key' => $this->category_key, 'value' => $gig->category]);
            $genre = $this->configurations_model->get_configuration_by_key_value(['key' => $this->genre_key, 'value' => $gig->genre]);
            $gig->status_label = $status->label;
            $gig->category_label = $category->label;
            $gig->genre_label = $genre->label;
            $cart_items = $this->bookings_model->get_booking_items_by_gig_id($args1);
            $ticket_bought = 0;
            $total_sale = 0;
            // $bundles = array();
            foreach ($cart_items as $item) {
                $user = $this->users_model->get_user_by_id($item->user_id);
                $ticket = $this->gigs_model->get_ticket_tier_by_id($item->ticket_tier_id);
                if (isset($ticket->id)) {
                    $bundles = $this->gigs_model->get_ticket_bundles_by_ticket_tier_id($ticket->id);
                    $ticket->bundles = $bundles;
                } else {
                    //$ticket->bundles = '';	
                }
                $booking = $this->bookings_model->get_booking_by_id($item->booking_id);
                $ticket_bought += $item->quantity;
                $total_sale += $item->price;
                $item->user_name = (isset($user->fname)) ? $user->fname . ' ' . $user->lname : '';
                $item->ticket = $ticket;
                $item->booking = $booking;
            }
            $gig->cart_items = $cart_items;
            $gig->ticket_left = $gig->ticket_limit - $ticket_bought;
            $gig->total_sale = $total_sale;
            $gig->booked = floor($ticket_bought / $gig->ticket_limit * 100);
            // $gig->booked = 100;
            $data['gig'] = $gig;

            // echo json_encode($gig);
            // die();
            $this->load->view('frontend/transactions/show', $data);
        }
    }

    public function tickets($gig_id = '')
    {
        if ($gig_id != '') {
            $params['gig_id'] = $gig_id;
            $gig = $this->gigs_model->get_gig_by_id($gig_id);
            $data['gig'] = $gig;
            $data['tickets_rows'] = $this->gigs_model->get_filter_gigs_tickets($params);
            $this->load->view('frontend/transactions/tickets', $data);
        } else {
            redirect('my_gigs');
        }
    }
    public function send_ticket()
    {
        $ticket_token = $this->input->post('ticket_token');
        $ticket = $this->gigs_model->get_ticket_data_by_qr_token($ticket_token);
        $user = $this->users_model->get_user_by_id($ticket->user_id);

        $this->load->library('email');
        $from_email = $this->config->item('info_email');
        $from_name = $this->config->item('from_name');

        $data['link'] = user_base_url() . 'bookings/download_tickets?user_id=' . $ticket->user_id . '&gig_id=' . $ticket->gig_id . '&booking_id=' . $ticket->booking_id . '&ticket_tier_id=' . $ticket->ticket_tier_id;
        $msg = $this->load->view('email/ticket_download', $data, TRUE);

        $this->email->from($from_email, $from_name);
        $this->email->to($user->email);
        $this->email->subject('Download Ticket');
        $this->email->message($msg);


        if ($this->email->send()) {
            $resp = [
                'status' => true,
                'message' => 'Ticket has been sent!'
            ];
        } else {
            $resp = [
                'status' => false,
                'message' => json_encode($this->email->print_debugger())
            ];
        }
        echo json_encode($resp);
    }

    public function my_wallet()
    {
        // $gig = $this->gigs_model->get_gig_by_id($args1);
        $data['gigs'] = [];
        $gigs = $this->gigs_model->get_user_gigs($this->dbs_user_id);
        // echo json_encode($gigs);
        // die();
        foreach ($gigs as $gig) {
            $status = $this->configurations_model->get_configuration_by_key_value(['key' => $this->gig_status_key, 'value' => $gig->status]);
            $category = $this->configurations_model->get_configuration_by_key_value(['key' => $this->category_key, 'value' => $gig->category]);
            $genre = $this->configurations_model->get_configuration_by_key_value(['key' => $this->genre_key, 'value' => $gig->genre]);
            $gig->status_label = $status->label;
            $gig->category_label = $category->label;
            $gig->genre_label = $genre->label;
            $cart_items = $this->bookings_model->get_booking_items_by_gig_id($gig->id);
            $ticket_bought = 0;
            $total_sale = 0;
            // $bundles = array();
            foreach ($cart_items as $item) {
                // $user = $this->users_model->get_user_by_id($item->user_id);
                // $ticket = $this->gigs_model->get_ticket_tier_by_id($item->ticket_tier_id);
                // if (isset($ticket->id)) {
                //     $bundles = $this->gigs_model->get_ticket_bundles_by_ticket_tier_id($ticket->id);
                //     $ticket->bundles = $bundles;
                // } else {
                //     //$ticket->bundles = '';	
                // }
                // $booking = $this->bookings_model->get_booking_by_id($item->booking_id);
                $ticket_bought += $item->quantity;
                $total_sale += $item->price;
                // $item->user_name = (isset($user->fname)) ? $user->fname . ' ' . $user->lname : '';
                // $item->ticket = $ticket;
                // $item->booking = $booking;
            }
            // $gig->cart_items = $cart_items;
            $gig->ticket_left = ($gig->ticket_limit - $ticket_bought) < 0 ? 0 : ($gig->ticket_limit - $ticket_bought);
            $gig->total_sale = $total_sale;
            $gig->ticket_bought = $ticket_bought;
            // $gig->booked = 100;
            $data['gigs'][] = $gig;
        }

        // echo json_encode($data);
        // die();
        $this->load->view('frontend/transactions/show_wallet', $data);
    }
}
