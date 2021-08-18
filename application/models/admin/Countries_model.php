<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Countries_model extends CI_Model {

	 function __construct() {
		parent::__construct();  
	}   
	
	/*country function starts*/ 
	
	function trash_country($id){
		if($id >0){
			$this->db->where('id', $id);
			$this->db->delete('countries');
		} 
		return true;
	}
	
	function get_all_countries(){
		$this->db->order_by('name');
	   $query = $this->db->get('countries');
	   return $query->result();
	} 
	
	function get_country_by_id($id){ 
		$query = $this->db->get_where('countries',array('id'=> $id));
		return $query->row();
	} 
	
	function get_country_by_name($name){ 
		$query = $this->db->get_where('countries',array('name'=> $name));
		return $query->row();
	} 
	 
	function insert_country_data($data){ 
		return $this->db->insert('countries', $data) ? $this->db->insert_id() : false;
	}  
	
	function update_country_data($args1,$data){ 
		$this->db->where('id',$args1);
		return $this->db->update('countries', $data);
	} 
	/*country functions ends*/ 
	
}  ?>