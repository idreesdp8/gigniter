<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configurations_model extends CI_Model {

	 function __construct() {
		parent::__construct();  
	}   
	
	/*configuration function starts*/ 
	
	function trash_configuration($id){
		if($id >0){
			$this->db->where('id', $id);
			$this->db->delete('configurations');
		} 
		return true;
	}
	
	function get_all_configurations(){
	   $query = $this->db->get('configurations');
	   return $query->result();
	} 
	
	function get_all_configurations_by_key($key)
	{
		$query = $this->db->get_where('configurations',array('key'=> $key));
		return $query->result();
	}
	
	function get_configuration_by_key($key)
	{
		$query = $this->db->get_where('configurations',array('key'=> $key));
		return $query->row();
	}
	
	function get_configuration_by_key_value($param)
	{
		$query = $this->db->get_where('configurations',array('key'=>$param['key'],'value'=>$param['value']));
		return $query->row();
	}
	
	function get_configuration_by_key_label($key, $label)
	{
		$query = $this->db->get_where('configurations',array('key'=>$key,'label'=>$label));
		return $query->row();
	}
	
	function get_configuration_by_id($id){ 
		$query = $this->db->get_where('configurations',array('id'=> $id));
		return $query->row();
	} 
	 
	function insert_configuration_data($data){ 
		return $this->db->insert('configurations', $data) ? $this->db->insert_id() : false;
	}  
	
	function update_configuration_data($args1,$data){ 
		$this->db->where('id',$args1);
		return $this->db->update('configurations', $data);
	} 
	/*configuration functions ends*/ 
	
}  ?>