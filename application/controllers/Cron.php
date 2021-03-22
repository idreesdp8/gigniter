<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cron extends CI_Controller
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
        // $this->load->model('user/bookings_model', 'bookings_model');
        // $this->load->model('user/gigs_model', 'gigs_model');
        // $perms_arrs = array('role_id' => $vs_role_id);
        // $this->gig_status_key = 'gig-status';
        // $this->genre_key = 'genre';
        // $this->category_key = 'category';

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
        echo "Hello from index \n";
    }
    public function test()
    {
        echo "Hello from test \n";
    }

    
}
