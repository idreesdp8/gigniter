<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles_model extends CI_Model {

	 function __construct() {
		parent::__construct();  
	}   
	
	/* roles function starts */   
	function trash_role($args2){
		if($args2 >0){
			$this->db->where('id', $args2);
			$this->db->delete('roles');
		} 
		return true;
	}
	
	function get_all_roles(){
	   $query = $this->db->get('roles');
	   return $query->result();
	} 

	function get_all_roles_without_admin(){
		$this->db->where('name !=','Admin');
	   $query = $this->db->get('roles');
	   return $query->result();
	} 
	
	function get_role_by_id($args1){ 
		$query = $this->db->get_where('roles',array('id'=> $args1));
		return $query->row();
	}
	
	
	 
	function insert_role_data($data){ 
		return $this->db->insert('roles', $data) ? $this->db->insert_id() : false;
	}  
	
	function update_role_data($args1,$data){ 
		$this->db->where('id',$args1);
		return $this->db->update('roles', $data);
	}
	/* roles function ends */  
	  
	
}
