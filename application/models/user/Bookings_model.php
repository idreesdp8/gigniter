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



	function get_all_filter_bookings_admin($params = array())
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
		if (array_key_exists("is_paid", $params)) {
			$is_paid = $params["is_paid"];
			$whrs .= " AND is_paid='$is_paid'";
		}
		if (array_key_exists("gig_id", $params)) {
			$gig_id = $params["gig_id"];
			$whrs .= " AND gig_id='$gig_id'";
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

		$query = $this->db->query("SELECT * FROM bookings WHERE id > 0 $whrs ORDER BY created_on DESC $limits ");
		return $query->result();
	}

	function get_booking_items_count($id)
	{
		$this->db->select_sum('quantity');
		$query = $this->db->get_where('cart', array('booking_id' => $id));
		return $query->row();
	}

	function get_booking_items($id)
	{
		$query = $this->db->get_where('cart', array('booking_id' => $id));
		return $query->result();
	}

	function get_booking_items_by_gig_id($id)
	{
		$query = $this->db->get_where('cart', array('gig_id' => $id));
		return $query->result();
	}

	function get_booking_item_by_id($id)
	{
		$query = $this->db->get_where('cart', array('id' => $id));
		return $query->row();
	}

	function get_all_bookings()
	{
		$this->db->order_by('created_on', 'DESC');
		$query = $this->db->get('bookings');
		return $query->result();
	}

	function get_bookings_by_user_id($user_id)
	{
		$sql = "SELECT * FROM bookings WHERE user_id = ? ORDER BY is_paid ASC, created_on DESC";
		$query = $this->db->query($sql, array($user_id));
		return $query->result();
	}

	function get_bookings_by_user_and_gig_id($user_id, $gig_id)
	{
		$sql = "SELECT * FROM bookings WHERE user_id = ? AND gig_id = ?";
		$query = $this->db->query($sql, array($user_id, $gig_id));
		return $query->result();
	}

	function get_bookings_by_gig_id($gig_id)
	{
		$sql = "SELECT * FROM bookings WHERE gig_id = ? AND is_paid = 0";
		$query = $this->db->query($sql, array($gig_id));
		return $query->result();
	}

	function get_all_bookings_by_gig_id($gig_id)
	{
		$sql = "SELECT * FROM bookings WHERE gig_id = ?";
		$query = $this->db->query($sql, array($gig_id));
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
		$ress = $this->db->insert('transactions', $data) ? $this->db->insert_id() : false;
		return $ress;
	}

	function get_transaction_by_id($id)
	{
		$query = $this->db->get_where('transactions', array('id' => $id));
		return $query->row();
	}

	function get_transactions_by_booking_id($id)
	{
		$query = $this->db->get_where('transactions', array('booking_id' => $id));
		return $query->result();
	}

	function get_charged_transaction_by_booking_id($id)
	{
		$query = $this->db->get_where('transactions', array('booking_id' => $id, 'type' => 'charge'));
		return $query->row();
	}

	function get_transactions_by_user_id($id, $type)
	{
		if ($type == 'customer') {
			$query = $this->db->get_where('transactions', array('user_send' => $id));
		} else {
			$query = $this->db->get_where('transactions', array('user_received' => $id));
		}
		return $query->result();
	}

	function get_transactions_by_type($type)
	{
		$query = $this->db->get_where('transactions', array('type' => $type));
		return $query->result();
	}

	function get_all_transactions()
	{
		$this->db->order_by('created_on', 'DESC');
		$query = $this->db->get('transactions');
		return $query->result();
	}



	function insert_cart_data($data)
	{
		$ress = $this->db->insert('cart', $data) ? $this->db->insert_id() : false;
		// $ress = $this->db->insert_batch('cart', $data);
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

	function add_ticket_share($data)
	{
		$ress = $this->db->insert('ticket_share', $data) ? $this->db->insert_id() : false;
		return $ress;
	}

	function get_ticket_shares_cart_id($id)
	{
		$query = $this->db->get_where('ticket_share', array('cart_id' => $id));
		return $query->result();
	}

	function get_tickets_by_user($email, $id)
	{
		$this->db->where('user_id =', $id);
		$this->db->or_where('friend_email =', $email);
		$query = $this->db->get('ticket_share');
		return $query->result();
	}

	function get_customers_count()
	{
		$this->db->group_by('user_id');
		$this->db->from('bookings');
		// $query = $this->db->get();
		return $this->db->count_all_results();
	}

	function get_bookings_count()
	{
		$query = $this->db->count_all('bookings');
		return $query;
	}

	function get_total_admin_fee()
	{
		$this->db->select_sum('admin_fee');
		$query = $this->db->get('transactions');
		return $query->row();
	}

	function get_gig_amount_raised($gig_id)
	{
		$this->db->select_sum('price');
		$this->db->where('gig_id =', $gig_id);
		$query = $this->db->get('cart');
		return $query->row();
	}

	function get_gig_ticket_bought($gig_id)
	{
		$this->db->select_sum('quantity');
		$this->db->where('gig_id =', $gig_id);
		$query = $this->db->get('cart');
		return $query->row();
	}
	
	function get_tickets_by_bookingid($sl_booking_id){
		$query = $this->db->query("SELECT ticket_no, qr_token FROM tickets WHERE booking_id='".$sl_booking_id."' ");
		return $query->result(); 
	}
	
	function get_tickets_by_tierid($sl_tierid){
		$query = $this->db->query("SELECT ticket_no, qr_token FROM tickets WHERE ticket_tier_id='".$sl_tierid."' ");
		return $query->result(); 
	}
	
	function get_tickets_by_tierid_cartid($sl_tierid, $sl_cartid){
		$query = $this->db->query("SELECT * FROM tickets WHERE ticket_tier_id='".$sl_tierid."' AND cart_id='".$sl_cartid."' ");
		return $query->result(); 
	}
}
