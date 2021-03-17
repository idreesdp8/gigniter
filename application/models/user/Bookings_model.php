<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Bookings_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function trash_booking($args2)
	{
		$this->db->where('id', $args2);
		$this->db->delete('bookings');
		return true;
	}

	function remove_booking_cart_items($args2)
	{
		$this->db->where('booking_id', $args2);
		$this->db->delete('cart');
		return true;
	}



	function get_all_filter_gigs($params = array())
	{
		// echo json_encode($params);
		// die();
		$whrs = '';
		if (array_key_exists("q_val", $params)) {
			$q_val = $params['q_val'];
			if (strlen($q_val) > 0) {
				$whrs .= " AND ( name LIKE '%$q_val%' OR email LIKE '%$q_val%' OR phone_no LIKE '%$q_val%' OR mobile_no LIKE '%$q_val%' OR address LIKE '%$q_val%' ) ";
			}
		}
		if(array_key_exists("category", $params)) {
			$category = $params["category"];
			$whrs .= " AND category='$category'";
		}
		if(array_key_exists("genre", $params)) {
			$genre = $params["genre"];
			$whrs .= " AND genre='$genre'";
		}

		$limits = '';
		if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {
			$tot_limit =   $params['limit'];
			$str_limit =   $params['start'];
			$limits = " LIMIT $str_limit, $tot_limit ";
		} elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
			$tot_limit =   $params['limit'];
			$limits = " LIMIT $tot_limit ";
		}

		$query = $this->db->query("SELECT * FROM gigs WHERE status=1 $whrs ORDER BY created_on DESC $limits ");
		return $query->result();
	}

	function get_booking_items_count($id)
	{
		$query = $this->db->get_where('cart', array('booking_id' => $id));
		return $query->num_rows();
	}

	function get_booking_items($id)
	{
		$query = $this->db->get_where('cart', array('booking_id' => $id));
		return $query->result();
	}

	function get_all_bookings()
	{
		$query = $this->db->get('bookings');
		return $query->result();
	}

	function get_user_cart_items($user_id)
	{
		$sql = "SELECT * FROM cart WHERE user_id = ? ORDER BY created_on";
		$query = $this->db->query($sql, array($user_id));
		return $query->result();
	}

	function get_booking_by_id($args1)
	{
		$query = $this->db->get_where('bookings', array('id' => $args1));
		return $query->row();
	}

	function insert_booking_data($data)
	{
		$ress = $this->db->insert('bookings', $data) ? $this->db->insert_id() : false;
		return $ress;
	}

	function insert_transaction_data($data)
	{
		$ress = $this->db->insert('tansactions', $data) ? $this->db->insert_id() : false;
		return $ress;
	}

	function insert_cart_data($data)
	{
		$ress = $this->db->insert_batch('cart', $data);
		return $ress;
	}

	function update_booking_data($args1, $data)
	{
		$this->db->where('id', $args1);
		return $this->db->update('bookings', $data);
	}

	function add_customer_charge($data)
	{
		$ress = $this->db->insert('customer_charges', $data) ? $this->db->insert_id() : false;
		return $ress;
	}
}
