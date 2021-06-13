<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_templates_model extends CI_Model {

	 function __construct() {
		parent::__construct();  
	}   
	
	/* Email Templates function starts */ 
	function get_all_filter_email_templates($params = array()){
		$whrs =''; 
		if(array_key_exists("s_val",$params)){
			$s_val = $params['s_val'];  
			        
			if(strlen($s_val)>0){  
				$whrs .=" AND ( recipients LIKE '%$s_val%' OR subject LIKE '%$s_val%' OR template_slug LIKE '%$s_val%' OR content LIKE '%$s_val%' ) ";
			}
		}   
		 
		$limits ='';
		/*if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
			$tot_limit =   $params['limit'];
			$str_limit =   $params['start']; 			 
			$limits = " LIMIT $str_limit, $tot_limit ";
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
             $tot_limit =   $params['limit'];
			$limits = " LIMIT $tot_limit ";
		} */  
		
		$query = $this->db->query("SELECT * FROM email_templates_tbl WHERE 1=1 $whrs ORDER BY added_on ASC $limits ");
		return $query->result(); 
	}  
	
  	function get_all_email_templates(){ 
	   $query = $this->db->get('email_templates_tbl');
	   return $query->result();
	} 
	
	function get_email_templates_by_id($args1){ 
		if($args1>0){
			$query = $this->db->get_where('email_templates_tbl',array('id'=> $args1));
			return $query->row();
		}else{
			return '';
		}
	}
	
	function get_email_templates_by_slug($template_slug){
		if(strlen($template_slug)>'0'){
			$query = $this->db->get_where('email_templates_tbl', array('template_slug' => $template_slug));
			return $query->row();
		}else{
			return '';
		}
	}  
	 
	function insert_email_template_data($data){ 
		return $this->db->insert('email_templates_tbl', $data);
	}  
	
	function update_email_template_data($args1,$data){ 
		if($args1>0){
			$this->db->where('id',$args1);
			return $this->db->update('email_templates_tbl', $data);
		} 
	}  
	
	function trash_email_template($args2){
		if($args2 >0){ 
			$del_array = array('id=' => $args2); 
			$this->db->where($del_array); 
			$this->db->delete('email_templates_tbl');
		} 
		return true;
	}  
	
	/* Email Templates functions ends */ 
	
}  ?>