<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Validate extends CI_Controller
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
        $this->dbs_role_name = $vs_role_id = $this->session->userdata('us_role_name');
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

        $this->load->model('user/users_model', 'users_model');
        // $this->load->model('user/transactions_model', 'transactions_model');
        $this->load->model('user/configurations_model', 'configurations_model');
        $this->load->model('user/bookings_model', 'bookings_model');
        $this->load->model('user/gigs_model', 'gigs_model');
        // $perms_arrs = array('role_id' => $vs_role_id);
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function index()
    {
        echo 'Index Page';
    }

    public function qr($qr_token = '')
    {
        // echo $this->dbs_role_name;
        if ($qr_token != '') {
            $ticket = $this->gigs_model->get_ticket_data_by_qr_token($qr_token);
            $gig = $this->gigs_model->get_gig_by_id($ticket->gig_id);
            if ($this->dbs_user_id) {
                if ($this->dbs_role_name == 'Admin' || $this->dbs_user_id == $gig->user_id) {
                    $data = [
                        'is_validated' => 1
                    ];
                    $this->gigs_model->update_tickets_data($ticket->id, $data);
                    redirect('/');
                } else {
                    redirect('/');
                }
            } else {
                $uri = uri_string();
                $this->session->set_userdata('redirect', $uri);
                redirect('signin');
            }
        } else {
            redirect('/');
        }
    }
    public function validate_ticket()
    {
        $ticket_token = $this->input->post('ticket_token');
        // echo $ticket_token;
        // die();
        $ticket = $this->gigs_model->get_ticket_data_by_qr_token($ticket_token);
        $gig = $this->gigs_model->get_gig_by_id($ticket->gig_id);
        if ($this->dbs_user_id) {
            if ($this->dbs_role_name == 'Admin' || $this->dbs_user_id == $gig->user_id) {
                $data = [
                    'is_validated' => 1
                ];
                $this->gigs_model->update_tickets_data($ticket->id, $data);
				$this->session->set_flashdata('success_msg', 'Ticket is Validated');
                redirect('/transactions/tickets/'.$gig->id);
            } else {
				$this->session->set_flashdata('warning_msg', 'You cannot validate the tickets of this gig!');
                redirect('/transactions/tickets/'.$gig->id);
            }
        } else {
            $uri = uri_string();
            $this->session->set_userdata('redirect', $uri);
            redirect('signin');
        }
    }
}
