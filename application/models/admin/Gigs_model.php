<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Gigs_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function trash_gig($args2)
	{
		$this->db->where('id', $args2);
		$this->db->delete('gigs');
		return true;
	}

	function get_all_active_gigs()
	{
		$sql = "SELECT * FROM gigs WHERE date(gig_date) > CURDATE() AND status = 1";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function get_all_filter_gigs($params = array())
	{
		$whrs = '';
		$sort_by = '';
		if (array_key_exists("q_val", $params)) {
			$q_val = $params['q_val'];
			if (strlen($q_val) > 0) {
				$whrs .= " AND ( name LIKE '%$q_val%' OR email LIKE '%$q_val%' OR phone_no LIKE '%$q_val%' OR mobile_no LIKE '%$q_val%' OR address LIKE '%$q_val%' ) ";
			}
		}
		if (array_key_exists("sort_by", $params)) {
			if($params['sort_by'] == 'just_in'){
				$sort_by = 'ORDER BY created_on DESC';
			} else if($params['sort_by'] == 'most_popular'){
				$sort_by = 'ORDER BY popularity DESC, created_on DESC';
			} else if($params['sort_by'] == 'closing_soon'){
				$sort_by = 'ORDER BY date(gig_date) ASC';
			}
		} else {
			$sort_by = 'ORDER BY created_on DESC';
		}
		if (array_key_exists("status", $params)) {
			$status = $params['status'];
			$whrs .= " AND status='$status'";
		}
		if (array_key_exists("is_featured", $params)) {
			$is_featured = $params['is_featured'];
			$whrs .= " AND is_featured='$is_featured'";
		}
		if (array_key_exists("from", $params)) {
			$from = $params['from'];
			if($from) {
				$whrs .= " AND date(gig_date) >= CURDATE()";
			} else {
				$whrs .= " AND date(gig_date) <= CURDATE()";
			}
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

		$query = $this->db->query("SELECT * FROM gigs WHERE id >'0' $whrs $sort_by $limits ");
		return $query->result();
	}

	function get_all_filter_popular_gigs($params = array())
	{
		$whrs = '';
		$sort_by = '';
		if (array_key_exists("q_val", $params)) {
			$q_val = $params['q_val'];
			if (strlen($q_val) > 0) {
				$whrs .= " AND ( name LIKE '%$q_val%' OR email LIKE '%$q_val%' OR phone_no LIKE '%$q_val%' OR mobile_no LIKE '%$q_val%' OR address LIKE '%$q_val%' ) ";
			}
		}
		if (array_key_exists("sort_by", $params)) {
			if($params['sort_by'] == 'just_in'){
				$sort_by = 'ORDER BY created_on DESC';
			} else if($params['sort_by'] == 'most_popular'){
				$sort_by = 'ORDER BY popularity DESC, created_on DESC';
			} else if($params['sort_by'] == 'closing_soon'){
				$sort_by = 'ORDER BY date(gig_date) ASC';
			}
		} else {
			$sort_by = 'ORDER BY popularity DESC, created_on DESC';
		}
		if (array_key_exists("status", $params)) {
			$status = $params['status'];
			$whrs .= " AND status='$status'";
		}
		if (array_key_exists("is_featured", $params)) {
			$is_featured = $params['is_featured'];
			$whrs .= " AND is_featured='$is_featured'";
		}
		if (array_key_exists("from", $params)) {
			$from = $params['from'];
			if($from) {
				$whrs .= " AND date(gig_date) > CURDATE()";
			} else {
				$whrs .= " AND date(gig_date) <= CURDATE()";
			}
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

		$query = $this->db->query("SELECT * FROM gigs WHERE id >'0' $whrs $sort_by $limits ");
		return $query->result();
	}


	function get_all_gigs()
	{
		$this->db->order_by('created_on', 'DESC');
		$query = $this->db->get('gigs');
		return $query->result();
	}
	
	function get_featured_gigs()
	{
		$sql = "SELECT * FROM gigs WHERE is_featured = 1 ORDER BY created_on DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function get_popular_gigs()
	{
		$sql = "SELECT * FROM gigs WHERE date(gig_date) > CURDATE() ORDER BY popularity DESC, created_on DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function get_gig($email, $password)
	{
		$query = $this->db->get_where('gigs', array('email' => $email, 'password' => $password));
		return $query->row();
	}

	function get_client($email, $password)
	{
		$query = $this->db->get_where('gigs', array('email' => $email, 'password' => $password, 'role_id' => '3'));
		return $query->row();
	}

	function get_gig_by_email($email)
	{
		$query = $this->db->get_where('gigs', array('email' => $email));
		return $query->row();
	}

	function get_gig_by_id($args1)
	{
		$query = $this->db->get_where('gigs', array('id' => $args1));
		return $query->row();
	}

	function insert_gig_data($data)
	{
		$ress = $this->db->insert('gigs', $data) ? $this->db->insert_id() : false;
		return $ress;
	}

	function add_ticket_tier($data)
	{
		$ress = $this->db->insert('ticket_tiers', $data) ? $this->db->insert_id() : false;
		return $ress;
	}

	function get_ticket_tiers_by_gig_id_user_id($param)
	{
		$query = $this->db->get_where('ticket_tiers', array('user_id' => $param['user_id'], 'gig_id' => $param['gig_id']));
		return $query->result();
	}

	function get_ticket_tiers_by_gig_id($gig_id)
	{
		$query = $this->db->get_where('ticket_tiers', array('gig_id' => $gig_id));
		return $query->result();
	}

	function get_ticket_tier_by_id($id)
	{
		$query = $this->db->get_where('ticket_tiers', array('id' => $id));
		return $query->row();
	}

	function add_ticket_tier_bundle($data)
	{
		$ress = $this->db->insert('ticket_bundles', $data) ? $this->db->insert_id() : false;
		return $ress;
	}

	function get_ticket_bundles_by_ticket_tier_id($id)
	{
		$query = $this->db->get_where('ticket_bundles', array('ticket_tier_id' => $id));
		return $query->result();
	}

	function remove_bundle_by_id($args2)
	{
		$this->db->where('id', $args2);
		$this->db->delete('ticket_bundles');
		return true;
	}

	function remove_ticket_tiers_by_id($args2)
	{
		$this->db->where('id', $args2);
		$this->db->delete('ticket_tiers');
		return true;
	}

	function update_gig_data($args1, $data)
	{
		$this->db->where('id', $args1);
		return $this->db->update('gigs', $data);
	}

	function get_today_gigs()
	{
		$sql = "SELECT * FROM gigs WHERE date(gig_date) = CURDATE() AND status <= 1";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function get_previous_gigs()
	{
		$sql = "SELECT * FROM gigs WHERE date(gig_date) < CURDATE() AND status <= 2";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function get_gig_custom_data($data_arr)
	{
		$query = $this->db->get_where('gigs', $data_arr);
		return $query->row();
	}

	function get_config_by_id($args1)
	{
		$query = $this->db->get_where('config', array('id' => $args1));
		return $query->row();
	}

	function insert_config_data($data)
	{
		$ress = $this->db->insert('config', $data);
		return $ress;
	}

	function update_config_data($args1, $data)
	{
		$this->db->where('id', $args1);
		return $this->db->update('config', $data);
	}

	function get_gigs_count()
	{
		$query = $this->db->count_all('gigs');
		return $query;
	}

	function get_count_new_gigs()
	{
		$query = $this->db->get_where('gigs', array('is_approved' => 0, 'is_draft' => 0));
		return $query->num_rows();
	}

	function get_new_gigs()
	{
		$this->db->order_by('created_on', 'DESC');
		$query = $this->db->get_where('gigs', array('is_rejected' => 0, 'is_approved' => 0, 'is_draft' => 0));
		return $query->result();
	}

	function remove_gig_stream($gig_id)
	{
		$this->db->where('gig_id', $gig_id);
		$this->db->delete('gig_stream');
		return true;
	}

	function get_gig_popularity_data($gig_id)
	{
		$ress = $this->db->get_where('gig_popularity', array('gig_id' => $gig_id));
		return $ress->row();
	}
}
