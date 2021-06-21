<?php
defined('BASEPATH') or exit('No direct script access allowed'); 
require APPPATH . '/libraries/REST_Controller.php';

class Apis extends REST_Controller {

	public function __construct(){
		parent::__construct(); 
		//$this->load->model('user/general_model', 'general_model'); 
		$this->load->model('admin/gigs_model', 'gigs_model');  
		
	} 
	
	public function verify_qr_code_by_token_get($ticket_qr_token){ 
		if(strlen($ticket_qr_token) >0){
			$row = $this->gigs_model->get_complete_ticket_detail_by_qr_token($ticket_qr_token); 
			
			if($row){ 
				//$resp_arrs = array();  
				//$resp_arrs[] = $row;
				
				$message = array( 'status' => "200", 'message' => "Ticket detail fetched successfully!", 'contents' => $row);
				$this->set_response($message, REST_Controller::HTTP_OK);
			}else{
				$message = array( 'status' => "502", 'message' => "No record found!", 'contents' => []);
				$this->set_response($message, REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code  
			} 
			
			
		}else{
			$message = array( 'status' => "502", 'message' => "Invalid access, please provide QR Code token number!", 'contents' => []);
			$this->set_response($message, REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code  
		}
	}  
}
