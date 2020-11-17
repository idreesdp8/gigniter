<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clients_model extends CI_Model {

	 function __construct() {
		parent::__construct();  
	}   
	
	/* Clients function starts */ 
	function get_all_filter_clients($params = array()){
		$whrs =''; 
		if(array_key_exists("s_val",$params)){
			$s_val = $params['s_val'];  
			        
			if(strlen($s_val)>0){  
				$whrs .=" AND ( name LIKE '%$s_val%' OR email LIKE '%$s_val%' OR phone_no LIKE '%$s_val%' OR mobile_no LIKE '%$s_val%' OR company_name LIKE '%$s_val%' OR address LIKE '%$s_val%' ) ";
			}
		}   
		
		if(array_key_exists("status_val",$params)){
			$status_val = $params['status_val']; 
			
			if($status_val != ''){	
				$whrs .=" AND status = '$status_val' ";
			}
		}     
		 
		$limits ='';
		if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
			$tot_limit =   $params['limit'];
			$str_limit =   $params['start']; 			 
			$limits = " LIMIT $str_limit, $tot_limit ";
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
             $tot_limit =   $params['limit'];
			$limits = " LIMIT $tot_limit ";
		}   
		
		$query = $this->db->query("SELECT * FROM clients_tbl WHERE 1=1 $whrs ORDER BY added_on ASC $limits ");
		return $query->result(); 
	}  
	
  	function get_all_clients(){ 
	   $query = $this->db->get('clients_tbl');
	   return $query->result();
	} 
	
	function get_client_by_id($args1){ 
		if($args1>0){
			$query = $this->db->get_where('clients_tbl',array('id'=> $args1));
			return $query->row();
		}else{
			return '';
		}
	}
	
	function get_client_by_email($email){ 
		if(strlen($email)>'0'){
			$query = $this->db->get_where('clients_tbl', array('email' => $email));
			return $query->row();
		}else{
			return '';
		}
	}
	
	function get_client_by_token($token){ 
		if(strlen($token)>'0'){
			$query = $this->db->get_where('clients_tbl', array('token' => $token));
			return $query->row();
		}else{
			return '';
		}
	}
	
	function get_client_by_email_password($email, $hsh_password){ 
	
		if(strlen($email)> '0' && strlen($hsh_password)>'0'){ 
		
			$query = $this->db->get_where('clients_tbl',array('email' => $email, 'password' => $hsh_password ));
			return $query->row();
			
		}else{
			return '';
		}
	}
	 
	function insert_client_data($data){ 
		return $this->db->insert('clients_tbl', $data);
	}  
	
	function update_client_data($args1,$data){ 
		if($args1>0){
			$this->db->where('id',$args1);
			return $this->db->update('clients_tbl', $data);
		} 
	}  
	
	function trash_client($args2){
		if($args2 >0){
			//$this->db->where('id', $args2); 
			
			$del_array = array('id=' => $args2); 
			$this->db->where($del_array);
			
			$this->db->delete('clients_tbl');
		} 
		return true;
	}  
	
	
 
	/* Clients functions ends */ 
	
}  ?>