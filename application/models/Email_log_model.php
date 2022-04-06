
<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Email_log_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function trash_email_log($args2)
	{
		// if($args2 >1){
		$this->db->where('id', $args2);
		$this->db->delete('email_log');
		// } 
		return true;
	}


	function get_all_email_logs()
	{
		$this->db->select('email_log.*, CONCAT(users.fname,\" \",users.lname) AS user_name');
		// $this->db->from('email_log');
		$this->db->join('users', 'users.id = email_log.user_id');
		$query = $this->db->get('email_log');
		// echo json_encode($query);
		// die();
		return $query->result();
	}

	function get_email_log_by_id($id)
	{
		$query = $this->db->get_where('email_log', array('id' => $id));
		return $query->row();
	}

	function get_email_logs_by_user_id($user_id)
	{
		$query = $this->db->get_where('email_log', array('user_id' => $user_id));
		return $query->row();
	}

	function insert_email_log_data($data)
	{
		$ress = $this->db->insert('email_log', $data) ? $this->db->insert_id() : false;
		return $ress;
	}

	function update_email_log_data($args1, $data)
	{
		$this->db->where('id', $args1);
		return $this->db->update('email_log', $data);
	}
}
