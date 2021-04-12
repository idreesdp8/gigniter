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



	function get_all_filter_gigs($params = array())
	{
		// echo json_encode($params);
		// die();
		$whrs = '';
		// if (array_key_exists("search", $params)) {
		// 	$search = $params['search'];
		// 	if (strlen($search) > 0) {
		// 		$whrs .= " AND ( title LIKE '%$search%' /* OR subtitle LIKE '%$search%' OR address LIKE '%$search%' */ ) ";
		// 	}
		// }
		if(array_key_exists("category", $params)) {
			$category = $params["category"];
			$whrs .= " AND category='$category'";
		}
		if(array_key_exists("genre", $params)) {
			$genre = $params["genre"];
			$whrs .= " AND genre='$genre'";
		}
		// if(array_key_exists("status", $params)) {
		// 	$status = $params["status"];
		// 	$whrs .= " AND status='$status'";
		// }
		// if(array_key_exists("user_id", $params)) {
		// 	$user_id = $params["user_id"];
		// 	$whrs .= " AND user_id='$user_id'";
		// }

		$limits = '';
		if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {
			$tot_limit =   $params['limit'];
			$str_limit =   $params['start'];
			$limits = " LIMIT $str_limit, $tot_limit ";
		} elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
			$tot_limit =   $params['limit'];
			$limits = " LIMIT $tot_limit ";
		}

		$query = $this->db->query("SELECT * FROM gigs WHERE status>0 $whrs ORDER BY created_on DESC $limits ");
		return $query->result();
	}

	function filter_my_gigs($params = array())
	{
		// echo json_encode($params);
		// die();
		$whrs = '';
		if (array_key_exists("search", $params)) {
			$search = $params['search'];
			if (strlen($search) > 0) {
				$whrs .= " AND ( title LIKE '%$search%' /* OR subtitle LIKE '%$search%' OR address LIKE '%$search%' */ ) ";
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
		if(array_key_exists("status", $params)) {
			$status = $params["status"];
			$whrs .= " AND status='$status'";
		}
		if(array_key_exists("user_id", $params)) {
			$user_id = $params["user_id"];
			$whrs .= " AND user_id='$user_id'";
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

		$query = $this->db->query("SELECT * FROM gigs WHERE id>0 $whrs ORDER BY created_on DESC $limits ");
		return $query->result();
	}


	function get_all_gigs()
	{
		$query = $this->db->get('gigs');
		return $query->result();
	}

	function get_all_active_gigs()
	{
		$sql = "SELECT * FROM gigs WHERE date(gig_date) >= CURDATE() AND status = 1";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function get_just_in_gigs()
	{
		$sql = "SELECT * FROM gigs WHERE status = ? ORDER BY created_on DESC limit 2";
		$query = $this->db->query($sql, array(1));
		return $query->result();
	}

	function get_user_gigs($user_id)
	{
		$sql = "SELECT * FROM gigs WHERE user_id = ? ORDER BY created_on DESC";
		$query = $this->db->query($sql, array($user_id));
		return $query->result();
	}

	function get_upcoming_user_gigs($user_id)
	{
		// $this->db->select('*');
		// $this->db->from('gigs');
		// $this->db->join('cart', 'cart.gig_id = gigs.id');
		// $this->db->where('cart.user_id', $user_id);
		// $query = $this->db->get();
		$sql = "SELECT * FROM gigs JOIN cart ON cart.gig_id=gigs.id WHERE cart.user_id = ? ORDER BY gigs.created_on ASC";
		$query = $this->db->query($sql, array($user_id));
		// return $query;
		return $query->result();
	}

	function get_active_user_gigs($user_id)
	{
		$sql = "SELECT * FROM gigs WHERE user_id = ? AND status > ? AND is_draft = ? ORDER BY created_on DESC";
		$query = $this->db->query($sql, array($user_id, 0, 0));
		return $query->result();
	}

	function get_now_showing_gigs()
	{
		$sql = "SELECT * FROM gigs WHERE gig_date = CURDATE() AND CURTIME() BETWEEN start_time AND end_time AND status = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result();
	}

	function get_gig_by_id($args1)
	{
		$query = $this->db->get_where('gigs', array('id' => $args1));
		return $query->row();
	}

	function get_gig_threshold($id)
	{
		$sql = "SELECT threshold FROM gigs WHERE id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->row();
	}

	function check_gig_by_user_id($args1)
	{
		$query = $this->db->get_where('gigs', array('user_id' => $args1, 'is_draft' => 0));
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

	function get_ticket_tier_by_id($tier_id)
	{
		$query = $this->db->get_where('ticket_tiers', array('id' => $tier_id));
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

	function update_ticket_tier($data, $id)
	{
		$this->db->where('id', $id);
		return $this->db->update('ticket_tiers', $data);
	}
}
