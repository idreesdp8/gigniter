<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Live extends CI_Controller
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
        $this->dbs_user_email = $vs_email = $this->session->userdata('us_email');
        $this->login_vs_role_id = $this->dbs_role_id = $vs_role_id = $this->session->userdata('us_role_id');
        $this->load->model('user/general_model', 'general_model');
        $this->load->model('user/permissions_model', 'permissions_model');
        // if(isset($vs_id) && (isset($vs_role_id) && $vs_role_id>=1)){

        // // 	$res_nums = $this->general_model->check_controller_permission_access('Admin/Users',$vs_role_id,'1');
        // // 	if($res_nums>0){

        // // 	}else{
        // // 		redirect('/');
        // // 	} 
        // }else{
        // 	redirect('login');
        // }

        $this->load->model('user/users_model', 'users_model');
        $this->load->model('user/configurations_model', 'configurations_model');
        // $this->load->model('user/countries_model', 'countries_model');
        $this->load->model('user/bookings_model', 'bookings_model');
        $this->load->model('user/gigs_model', 'gigs_model');
        // $perms_arrs = array('role_id' => $vs_role_id);
        $this->gig_status_key = 'gig-status';
        $this->genre_key = 'genre';
        $this->category_key = 'category';

        // $this->load->library('Ajax_pagination');
        // $this->perPage = 25;
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function index()
    {
        $this->load->view('frontend/stream/index');
    }

    public function my_shows()
    {
        $dbs_user_email = $this->dbs_user_email;
        $dbs_user_id = $this->dbs_user_id;
        // $user = $this->users_model->get_user_by_email($dbs_user_email);
        // $gigs = $this->gigs_model->get_upcoming_user_gigs($user_id);
        // $bookings = $this->bookings_model->get_bookings_by_user_id($user->id);
        $tickets = $this->bookings_model->get_tickets_by_user($dbs_user_email, $dbs_user_id);
        // echo json_encode($tickets);die();
        $gigs = [];
        $now = new DateTime();
        foreach ($tickets as $ticket) {
            $cart = $this->bookings_model->get_booking_item_by_id($ticket->cart_id);
        // echo json_encode($cart);die();

            $temp = $this->gigs_model->get_gig_by_id($cart->gig_id);
            $user = $this->users_model->get_user_by_id($temp->user_id);
            $temp->user_name = $user->fname . ' ' . $user->lname;
            $args1 = [
                'key' => $this->genre_key,
                'value' => $temp->genre
            ];
            $genre = $this->configurations_model->get_configuration_by_key_value($args1);
            $temp->genre_name = $genre->label;
            $args2 = [
                'key' => $this->category_key,
                'value' => $temp->category
            ];
            $category = $this->configurations_model->get_configuration_by_key_value($args2);
            $temp->category_name = $category->label;
            $gig_date = new DateTime($temp->gig_date);
            $interval = $gig_date->diff($now);
            $temp->days_left = $interval->format('%a');
            $gigs[] = $temp;
        }
        $data['gigs'] = $gigs;
        $this->load->view('frontend/live/my_shows', $data);
        // echo json_encode($shows);
    }
}
