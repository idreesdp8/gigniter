<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Users_model extends CI_Model {

	 function __construct() {
		parent::__construct();
	}
	
	function trash_user($args2){
		// if($args2 >1){
			$this->db->where('id', $args2);
			$this->db->delete('users');
		// } 
		return true;
	}
	
	
	function get_all_filter_users($params = array()){
		$whrs ="AND fname != 'Admin'"; 
		if(array_key_exists("q_val",$params)){
			$q_val = $params['q_val']; 
			if(strlen($q_val)>0){
				// OR phone_no LIKE '%$q_val%' OR mobile_no LIKE '%$q_val%' OR address LIKE '%$q_val%' 
				$whrs .=" AND ( fname LIKE '%$q_val%' OR lname LIKE '%$q_val%' OR email LIKE '%$q_val%')";
			}
		}  
		if(array_key_exists("role_id",$params)){
			$role_id = $params['role_id']; 
			if($role_id){
				// OR phone_no LIKE '%$q_val%' OR mobile_no LIKE '%$q_val%' OR address LIKE '%$q_val%' 
				$whrs .=" AND role_id = $role_id ";
			}
		}  

		// echo $whrs;
		// die();
		 
		$limits ='';
		// if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
		// 	$tot_limit =   $params['limit'];
		// 	$str_limit =   $params['start']; 			 
		// 	$limits = " LIMIT $str_limit, $tot_limit ";
        // }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
        //      $tot_limit =   $params['limit'];
		// 	$limits = " LIMIT $tot_limit ";
		// }   
		
		$query = $this->db->query("SELECT * FROM users WHERE id >'0' $whrs ORDER BY id ASC $limits "); 
		return $query->result(); 
	}  

	function get_filtered_user_stripe_details($params)
	{
		$whrs = '';
		if(array_key_exists("search",$params)){
			$q_val = $params['search']; 
			if(strlen($q_val)>0){
				// OR phone_no LIKE '%$q_val%' OR mobile_no LIKE '%$q_val%' OR address LIKE '%$q_val%' 
				$whrs .=" AND ( users.fname LIKE '%$q_val%' OR users.lname LIKE '%$q_val%' OR user_stripe_details.stripe_id LIKE '%$q_val%')";
			}
		} 
		if(array_key_exists("is_restricted",$params)){
			$is_restricted = $params['is_restricted'];
			if($is_restricted > -1) {
				$whrs .= " AND user_stripe_details.is_restricted = '$is_restricted'";
			}
		}
		
		$query = $this->db->query("SELECT * FROM users LEFT JOIN user_stripe_details ON user_stripe_details.user_id = users.id WHERE users.id >'0' $whrs"); 
		return $query->result();
	}
	


	function get_user_stripe_details($args1)
	{
		$query = $this->db->get_where('user_stripe_details', array('user_id' => $args1));
		return $query->row();
	}
	function get_all_users(){
	   $query = $this->db->get('users');
	   return $query->result();
	} 

	function get_user($email,$password){ 
		$query = $this->db->get_where('users',array('email'=> $email,'password'=> $password));
		return $query->row();
	}
	
	function get_client($email,$password){ 
		$query = $this->db->get_where('users',array('email' => $email, 'password' => $password, 'role_id' => '3'));
		return $query->row();
	}
	
	function get_user_by_email($email){
		$query = $this->db->get_where('users',array('email'=> $email));
		return $query->row();
	}
	
	function get_user_by_id($args1){ 
		$query = $this->db->get_where('users',array('id'=> $args1));
		return $query->row();
	}
	
	function get_social_links($args1){ 
		$query = $this->db->get_where('user_social_links',array('user_id'=> $args1));
		return $query->result();
	}
	
	function trash_social_link($args2){
			$this->db->where('id', $args2);
			$this->db->delete('user_social_links');
		return true;
	}
	
	function insert_user_data($data){ 
		$ress = $this->db->insert('users', $data) ? $this->db->insert_id() : false;
		return $ress;
	}  
	
	function insert_user_social_link($data){ 
		$ress = $this->db->insert('user_social_links', $data) ? $this->db->insert_id() : false;
		return $ress;
	}  
	
	function update_user_data($args1,$data){ 
		$this->db->where('id',$args1);
		return $this->db->update('users', $data);
	}
	 
	function get_user_custom_data($data_arr){ 
		$query = $this->db->get_where('users',$data_arr);
		return $query->row();
	}
	
	function get_config_by_id($args1){ 
		$query = $this->db->get_where('config',array('id'=> $args1));
		return $query->row();
	}
	
	function insert_config_data($data){  
		$ress = $this->db->insert('config', $data);
		return $ress;
	}  
	
	function update_config_data($args1,$data){ 
		$this->db->where('id',$args1);
		return $this->db->update('config', $data);
	}
	 
}  ?>