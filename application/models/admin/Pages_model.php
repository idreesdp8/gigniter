<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages_model extends CI_Model {

	function __construct() {
		parent::__construct();  
	}
	/* Pages function starts */ 
	
	// meta_title meta_keyword meta_description summary details
	function get_all_filter_pages($params = array()){
		$whrs =''; 
		if(array_key_exists("s_val",$params)){
			$s_val = $params['s_val'];  
			        
			if(strlen($s_val)>0){ 
				$whrs .=" AND ( page_name LIKE '%$s_val%' OR meta_title LIKE '%$s_val%' OR meta_keyword LIKE '%$s_val%' OR meta_description LIKE '%$s_val%' OR summary LIKE '%$s_val%' OR details LIKE '%$s_val%' ) ";
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
		
		$query = $this->db->query("SELECT * FROM pages_tbl WHERE 1=1 $whrs ORDER BY added_on ASC $limits ");
		return $query->result(); 
	}  
	
  	function get_all_pages(){ 
	   $query = $this->db->get('pages_tbl');
	   return $query->result();
	} 
	
	function get_page_by_id($args1){ 
		if($args1>0){
			$query = $this->db->get_where('pages_tbl',array('id'=> $args1));
			return $query->row();
		}else{
			return '';
		}
	}
	
	function get_page_by_email($email){ 
		if(strlen($email)>'0'){
			$query = $this->db->get_where('pages_tbl', array('email' => $email));
			return $query->row();
		}else{
			return '';
		}
	}
	
	function get_page_by_token($token){ 
		if(strlen($token)>'0'){
			$query = $this->db->get_where('pages_tbl', array('token' => $token));
			return $query->row();
		}else{
			return '';
		}
	}
	
	function get_page_by_email_password($email, $hsh_password){ 
	
		if(strlen($email)> '0' && strlen($hsh_password)>'0'){ 
		
			$query = $this->db->get_where('pages_tbl',array('email' => $email, 'password' => $hsh_password ));
			return $query->row();
			
		}else{
			return '';
		}
	}
	 
	function insert_page_data($data){ 
		return $this->db->insert('pages_tbl', $data);
	}  
	
	function update_page_data($args1,$data){ 
		if($args1>0){
			$this->db->where('id',$args1);
			return $this->db->update('pages_tbl', $data);
		} 
	}  
	
	function trash_page($args2){
		if($args2 >0){
			//$this->db->where('id', $args2); 
			
			$del_array = array('id=' => $args2); 
			$this->db->where($del_array);
			
			$this->db->delete('pages_tbl');
		} 
		return true;
	}  
	
	
 
	/* Clients functions ends */ 
	
}  ?>