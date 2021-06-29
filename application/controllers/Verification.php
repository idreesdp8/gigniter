<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Verification extends CI_Controller
{

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function __construct(){
        parent::__construct();
        $this->dbs_user_id = $this->session->userdata('us_id'); 
        $this->dbs_role_name = $this->session->userdata('us_role_name');
		
        $this->load->model('user/general_model', 'general_model'); 
        $this->load->model('user/users_model', 'users_model'); 
        $this->load->model('user/configurations_model', 'configurations_model'); 
        $this->load->model('user/gigs_model', 'gigs_model'); 
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */

    public function qr_token($qr_token = ''){
	
		if ($this->dbs_user_id) {
		
			if ($qr_token != '') {
				$rows = $this->gigs_model->get_tickets_by_qr_code_token(array($qr_token));  
				if ($rows) {
					$row = $rows[0];
					/*//print_r($rows);
					echo $this->dbs_user_id; 
					echo $row->gig_user_id;
					exit;*/ 
					if ($this->dbs_role_name == 'Admin' || $this->dbs_user_id == $row->gig_user_id){
					
						$this->session->set_flashdata('success_msg', 'Ticket has been Validated!'); 
						$validated_on = date('Y-m-d H:i:s'); 
						
						$this->gigs_model->update_tickets_data($row->ticket_id, ['is_validated' => 1, 'validated_on' => $validated_on]);
						redirect('/transactions/tickets/'.$row->gig_id); 
					}else{ 
						$this->session->set_flashdata('warning_msg', 'You cannot validate this ticket as you are not owner of this gig!');
						redirect('/transactions/tickets/'.$row->gig_id);
					}
					
				}else{
					$this->session->set_flashdata('warning_msg', 'Invalid Access!');
					$uri = uri_string();
					$this->session->set_userdata('redirect', $uri);
					redirect('signin');
				}
				
			}else{
				$this->session->set_flashdata('warning_msg', 'Invalid Access!');
				redirect('signin');
			}
			
		 }else{
            $uri = uri_string();
            $this->session->set_userdata('redirect', $uri);
            redirect('signin');
         }
    } 
}
