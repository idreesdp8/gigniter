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
        $is_logged_in = $this->session->userdata('us_login');
        if (!$is_logged_in) {
            redirect("admin/login");
        }
        $vs_user_role_name = $this->session->userdata('us_role_name');
        if (isset($vs_user_role_name)) {
            if ($vs_user_role_name != 'Admin') {
                redirect('dashboard');
            }
        }


        $this->dbs_user_id = $vs_id = $this->session->userdata('us_id');
        $this->login_vs_role_id = $this->dbs_role_id = $vs_role_id = $this->session->userdata('us_role_id');
        $this->load->model('admin/general_model', 'general_model');
        $this->load->model('admin/permissions_model', 'permissions_model');
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

        $this->load->model('admin/users_model', 'users_model');
        // $this->load->model('user/transactions_model', 'transactions_model');
        $this->load->model('admin/configurations_model', 'configurations_model');
        $this->load->model('user/bookings_model', 'bookings_model');
        $this->load->model('admin/gigs_model', 'gigs_model');
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
        $transactions = $this->bookings_model->get_all_transactions();

        // $user_id = $this->dbs_user_id;
        // $gigs = $this->gigs_model->get_active_user_gigs($user_id);
        // // $transactions = $this->bookings_model->get_transactions_by_user_id($user_id, 'customer');
        foreach ($transactions as $transaction) {
            // $status = $this->configurations_model->get_configuration_by_key_value(['key' => $this->gig_status_key, 'value' => $gig->status]);
            // $gig->status_label = $status->label;
            $booking = $this->bookings_model->get_booking_by_id($transaction->booking_id);
            if($transaction->user_received) {
                $user = $this->users_model->get_user_by_id($transaction->user_received);
            }
            if($transaction->user_send) {
                $user = $this->users_model->get_user_by_id($transaction->user_send);
            }
            $cart_items = $this->bookings_model->get_booking_items($booking->id);
            $gig_names = '';
            // $ticket_names = '';
            if ($cart_items) {
                $temp_gig_titles = array();
                foreach ($cart_items as $item) {
                    $gig = $this->gigs_model->get_gig_by_id($item->gig_id);
                    // $ticket = $this->gigs_model->get_ticket_tier_by_id($item->ticket_tier_id);
                    $temp_gig_titles[] = $gig->title;
                    // $temp_tickets[] = $ticket->name;
                    // $ticket_names = implode(', ', array_unique($temp_tickets));
                }
                $gig_names = implode(', ', array_unique($temp_gig_titles));
            }
            $transaction->booking = $booking;
            $transaction->user_name = $user->fname . ' ' . $user->lname;
            $transaction->gig_names = $gig_names;
            // $transaction->ticket_names = $ticket_names;
        }
        $data['records'] = $transactions;
        // echo json_encode($transactions);
        // die();
        $this->load->view('admin/transactions/index', $data);
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
            // $bundles = array();
            foreach ($cart_items as $item) {
                $user = $this->users_model->get_user_by_id($item->user_id);
                $ticket = $this->gigs_model->get_ticket_tier_by_id($item->ticket_tier_id);
                // if($ticket) {
                $bundles = $this->gigs_model->get_ticket_bundles_by_ticket_tier_id($ticket->id);
                // }
                $booking = $this->bookings_model->get_booking_by_id($item->booking_id);
                $ticket_bought += $item->quantity;
                $ticket->bundles = $bundles;
                $item->user_name = $user->fname . ' ' . $user->lname;
                $item->ticket = $ticket;
                $item->booking = $booking;
            }
            $gig->cart_items = $cart_items;
            $gig->ticket_left = $gig->goal - $ticket_bought;
            $data['gig'] = $gig;

            // echo json_encode($gig);
            // die();
            $this->load->view('frontend/transactions/show', $data);
        }
    }

    // public function report()
    // {
    //     $gigs = $this->gigs_model->get_all_gigs();
    //     foreach($gigs as $gig) {
    //         $bookings = $this->bookings_model->get_all_bookings_by_gig_id($gig->id);
    //         $gig->bookings = $bookings;
    //     }


    //     $data['records'] = $gigs;
    //     $this->load->view('admin/transactions/report', $data);
    // }

    public function tickets()
    {
        $data['tickets_rows'] = $this->gigs_model->get_gigs_tickets();
        $this->load->view('admin/transactions/tickets', $data);
    }

    public function resend_qr_code()
    {

        $ticketid = $this->input->post('ticket_id');
        // echo $ticketid;
        // die();
        if ($ticketid > 0) {
            $row = $this->gigs_model->get_ticket_data_by_ticket_id($ticketid);
            if (isset($row)) {
                /* $config = Array(
				  'protocol' => 'smtp',
				  'smtp_host' => 'ssl://smtp.googlemail.com',
				  'smtp_port' => 465,
				  'smtp_user' => 'abc@gmail.com', 
				  'smtp_pass' => 'passwrd', 
				  'mailtype' => 'html',
				  'charset' => 'iso-8859-1',
				  'wordwrap' => TRUE
				); 
				$this->load->library('email', $config);*/

                $this->load->library('email');
                $from_name = $this->config->item('from_name');
                $from_email = $this->config->item('info_email');

                $row = $this->gigs_model->get_complete_ticket_detail_by_id($ticketid);
                if (isset($row)) {
                    $gig_ticket_no = $row->ticket_no;
                    $gig_ticket_qr_token = $row->qr_token;
                    if ($gig_ticket_qr_token == '') {
                        $gig_ticket_qr_token = uniqid();
                    }

                    if (strlen($gig_ticket_qr_token) > 0) {

                        $this->gigs_model->update_tickets_data($ticketid, array('qr_token' => $gig_ticket_qr_token));

                        //$this->load->model('user/General_model', 'frontend_general_model');

                        $this->general_model->custom_qr_img_generate($gig_ticket_qr_token, "downloads/tickets_qr_code_imgs/ticket_" . $gig_ticket_qr_token . ".png");

                        $mail_to_name = $row->fname . ' ' . $row->lname;
                        $mail_to = $row->email;

                        $gig_title = $row->title;
                        $gig_subtitle = $row->subtitle;
                        $gig_category = $row->category;
                        $gig_poster = $row->poster;
                        $gig_address = $row->address;
                        $gig_poster = $row->poster;

                        $mail_text = "Hi $mail_to_name, <br> <br> Gigniter is sending you, your new created Tick QR Code as attached below. <br> <br> Regards, <br> Gigniter Team";

                        //$this->email->set_newline("\r\n");  
                        $this->email->from($from_email, $from_name);
                        $this->email->to($mail_to);
                        $this->email->subject($gig_title . ' ' . $gig_ticket_no);
                        $this->email->message($mail_text);
                        // if ($_SERVER['HTTP_HOST'] == "localhost") { /* skip mail sending */
                        //     $attched_file = qrcode_url()."ticket_" . $gig_ticket_qr_token . ".png";
                        // } else {
                            $attched_file = qrcode_url()."ticket_" . $gig_ticket_qr_token . ".png";

                            // $this->email->attach($attched_file);
                            // $this->email->send(); 
                            if($this->email->send()){
                                echo 'Email send.';
                            }else{
                                echo json_encode($this->email->print_debugger());
                            }
                        // }

                    }
                }
            }
die();
            redirect(admin_base_url() . 'transactions/tickets/');
        } else {
            redirect(admin_base_url() . 'transactions/tickets/');
        }

        //$data['tickets_rows'] = $this->gigs_model->get_gigs_tickets();
        //$this->load->view('admin/transactions/tickets', $data);
    }

    function mail_test()
    {
		$this->load->library('email');
		$from_email = $this->config->item('info_email');
		$from_name = $this->config->item('from_name');
        $msg = $this->load->view('email/ticket_template', '', TRUE);
        
        $this->email->from('info@gigniter.com', 'Gigniter');
        $this->email->to('hamza0952454@gmail.com');
        $this->email->subject('Live');
		$this->email->message($msg);
        
        
        if ($this->email->send()) {
            echo 'Mail sent';
        } else {
			echo json_encode($this->email->print_debugger());
        }
        die();
    }
}
