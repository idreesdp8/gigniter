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

	
	function get_filter_gigs_tickets($params = array())
	{
		$whrs = " where t1.id>'0' ";
		if (array_key_exists("gig_id", $params)) {
			$gig_id = $params['gig_id'];
			if ($gig_id > 0) {
				$whrs .= " AND t1.gig_id='$gig_id' ";
			}
		}

		if (array_key_exists("is_paid", $params)) {
			$is_paid = $params['is_paid'];
			if ($is_paid == 0) {
				$whrs .= " AND t5.is_paid='0' ";
			} else if ($is_paid == 1) {
				$whrs .= " AND t5.is_paid='1' ";
			}
		}

		$query = $this->db->query("SELECT t1.id as ticket_id, t1.gig_id, t1.ticket_no, t1.qr_token, t1.is_validated, t2.title, t2.subtitle, t2.gig_date, t2.start_time, t2.end_time, t2.category, t2.poster, t2.address, t2.venues, t3.fname, t3.lname, t3.email, t4.created_on, t5.price, t5.is_paid FROM tickets t1
		LEFT JOIN gigs t2 ON t2.id = t1.gig_id 
		LEFT JOIN users t3 ON t3.id = t1.user_id 
		LEFT JOIN ticket_tiers t4 ON t4.id = t1.ticket_tier_id  
		LEFT JOIN bookings t5 ON t5.id = t1.booking_id $whrs ");
		return $query->result();
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
		if (array_key_exists("category", $params)) {
			$category = $params["category"];
			$whrs .= " AND category='$category'";
		}
		if (array_key_exists("genre", $params)) {
			$genre = $params["genre"];
			$whrs .= " AND genre='$genre'";
		}
		if (array_key_exists("is_live", $params)) {
			$genre = $params["is_live"];
			if($params['is_live'] == 1){
				$whrs .= " AND status=2";
			} else if($params['is_live'] == 0){
				$whrs .= " AND status=1";
			}
		} else {
			$whrs .= " AND status=1";
		}
		if (array_key_exists("sort_by", $params)) {
			if($params['sort_by'] == 'just_in'){
				$sort_by = ' ORDER BY created_on DESC';
			} else if($params['sort_by'] == 'most_popular'){
				$sort_by = ' ORDER BY popularity DESC, created_on DESC';
			} else if($params['sort_by'] == 'closing_soon'){
				$sort_by = ' ORDER BY date(gig_date) ASC';
			}
		} else {
			$sort_by = ' ORDER BY created_on DESC';
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

		$query = $this->db->query("SELECT * FROM gigs WHERE date(gig_date) > CURDATE() AND is_approved = 1 $whrs $sort_by $limits ");
		return $query->result();
	}

	function filter_my_gigs($params = array())
	{
		// echo json_encode($params);
		// die();
		$whrs = '';
		if (array_key_exists("search", $params)) {
			$search = $params['search'];
			if (strlen($search) > 0) { ///* OR subtitle LIKE '%$search%' OR address LIKE '%$search%' */ 
				$whrs .= " AND ( title LIKE '%$search%' ) ";
			}
		}
		if (array_key_exists("category", $params)) {
			$category = $params["category"];
			$whrs .= " AND category='$category'";
		}
		if (array_key_exists("genre", $params)) {
			$genre = $params["genre"];
			$whrs .= " AND genre='$genre'";
		}
		if (array_key_exists("status", $params)) {
			$status = $params["status"];
			$whrs .= " AND status='$status'";
		}
		if (array_key_exists("user_id", $params)) {
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
		$sql = "SELECT * FROM gigs WHERE date(gig_date) > CURDATE() AND status = 1 AND is_approved = 1";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function get_featured_gigs()
	{
		$sql = "SELECT * FROM gigs WHERE date(gig_date) > CURDATE() AND status = 1 AND is_approved = 1 AND is_featured = 1";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function get_featured_and_exclusive_gigs()
	{
		$sql = "SELECT * FROM gigs WHERE date(gig_date) > CURDATE() AND status = 1 AND is_approved = 1 AND (is_featured = 1 OR is_exclusive = 1)";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function get_just_in_gigs()
	{
		$sql = "SELECT * FROM gigs WHERE date(gig_date) > CURDATE() AND status = 1 AND is_approved = 1 ORDER BY created_on DESC";
		$query = $this->db->query($sql);
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
		$sql = "SELECT * FROM gigs WHERE status = 2 AND is_approved = 1";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function get_artist_gigs($user_id)
	{
		$sql = "SELECT * FROM gigs WHERE status = 1 AND is_approved = 1 AND user_id = $user_id ORDER BY created_on DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function get_closing_soon_gigs()
	{
		$sql = "SELECT * FROM gigs WHERE date(gig_date) > CURDATE() AND status = 1 AND is_approved = 1 ORDER BY date(gig_date) ASC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function get_popular_gigs()
	{
		$sql = "SELECT * FROM gigs WHERE date(gig_date) > CURDATE() AND status = 1 AND is_approved = 1 ORDER BY popularity DESC, created_on DESC";
		$query = $this->db->query($sql);
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

	function get_gig_ticket_limit($id)
	{
		$sql = "SELECT ticket_limit FROM gigs WHERE id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->row()->ticket_limit;
	}

	function check_gig_by_user_id($args1)
	{
		$this->db->order_by('created_on', 'DESC');
		$query = $this->db->get_where('gigs', array('user_id' => $args1, 'is_draft' => 0));
		return $query->row();
	}

	function check_completed_gig_by_user_id($args1)
	{
		$this->db->order_by('created_on', 'DESC');
		$query = $this->db->get_where('gigs', array('user_id' => $args1, 'status' => 3));
		return $query->row();
	}

	function check_latest_active_gig_by_user_id($args1)
	{
		$this->db->order_by('created_on', 'DESC');
		$query = $this->db->get_where('gigs', array('user_id' => $args1, 'status' => 1));
		return $query->row();
	}

	function get_gig_buyers($gig_id)
	{
		$this->db->select('user_id');
		$query = $this->db->get_where('bookings', array('gig_id' => $gig_id));
		return $query->result();
	}

	function insert_gig_data($data)
	{
		$ress = $this->db->insert('gigs', $data) ? $this->db->insert_id() : false;
		return $ress;
	}

	function get_gig_campaign_date_diff($id)
	{
		$sql = "SELECT DATEDIFF(campaign_date, CURDATE()) AS diff FROM gigs WHERE id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->row();
	}

	function get_gig_goal_amount($id)
	{
		$this->db->select('goal_amount');
		$this->db->where('id', $id);
		$query = $this->db->get('gigs');
		return $query->row();
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

	function remove_gig_gallery_images($args2)
	{
		$this->db->where('gig_id', $args2);
		$this->db->delete('gig_images');
		return true;
	}

	function add_gig_gallery_images($data)
	{
		$ress = $this->db->insert_batch('gig_images', $data);
		return $ress;
	}

	function update_gig_data($args1, $data)
	{
		$this->db->where('id', $args1);
		return $this->db->update('gigs', $data);
	}

	function get_gig_gallery_images($gig_id)
	{
		$query = $this->db->get_where('gig_images', array('gig_id' => $gig_id));
		return $query->result();
	}

	function get_gig_custom_data($data_arr)
	{
		$query = $this->db->get_where('gigs', $data_arr);
		return $query->row();
	}

	function update_ticket_tier($data, $id)
	{
		$this->db->where('id', $id);
		return $this->db->update('ticket_tiers', $data);
	}

	function insert_tickets_data($data)
	{
		$ress = $this->db->insert_batch('tickets', $data);
		return $ress;
	}

	function get_tickets($data)
	{
		$query = $this->db->get_where(
			'tickets',
			array(
				'booking_id' => $data['booking_id'],
				'gig_id' => $data['gig_id'],
				'ticket_tier_id' => $data['ticket_tier_id'],
				'user_id' => $data['user_id'],
			)
		);
		return $query->result();
	}
	function add_channel($data)
	{
		$ress = $this->db->insert('gig_stream', $data) ? $this->db->insert_id() : false;
		return $ress;
	}
	function get_stream_details($gig_id)
	{
		$query = $this->db->get_where('gig_stream', array('gig_id' => $gig_id));
		return $query->row();
	}

	function launch_gig_campaign($gig_id, $campaign_date = null)
	{
		if(!$campaign_date){
			$query = $this->db->query('SELECT DATE(NOW()) as date');
			$campaign_date = ($query->result())[0]->date;
		}
		$data = ['campaign_date' => $campaign_date];
		$this->db->where('id', $gig_id);
		return $this->db->update('gigs', $data);
		// return $campaign_date;
	}

	function insert_gig_popularity_data($data)
	{
		$ress = $this->db->insert('gig_popularity', $data) ? $this->db->insert_id() : false;
		return $ress;
	}

	function get_gig_popularity_data($gig_id)
	{
		$query = $this->db->get_where('gig_popularity', array('gig_id' => $gig_id));
		return $query->row();
	}

	function delete_gig_popularity_data($gig_id)
	{
		$this->db->where('gig_id', $gig_id);
		$this->db->delete('gig_popularity');
		return true;
	}

	function get_reaction_data($data)
	{
		$query = $this->db->get_where('gig_reactions', array('gig_id' => $data['gig_id'], 'user_id' => $data['user_id']));
		return $query->row();
	}

	function get_emoji_reaction_data($data)
	{
		$query = $this->db->get_where('gig_reactions', array('gig_id' => $data['gig_id'], 'user_id' => $data['user_id'], 'reaction' => $data['reaction']));
		return $query->row();
	}

	function update_reaction_data($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update('gig_reactions', $data);
	}

	function add_reaction_data($data)
	{
		$ress = $this->db->insert('gig_reactions', $data) ? $this->db->insert_id() : false;
		return $ress;
	}

	function get_reaction_count($gig_id)
	{
		$sql = "SELECT count(id) AS total_reactions, 
						sum(CASE WHEN reaction = 'thumbs-up' THEN 1 ELSE 0 END) AS like_reactions,
						sum(CASE WHEN reaction = 'heart' THEN 1 ELSE 0 END) AS heart_reactions
						FROM gig_reactions WHERE gig_id=$gig_id";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function check_for_approval_submitted_gigs($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->where('is_draft', 0);
		$this->db->where('status', 0);
		$this->db->or_where('status', 1);
		$query = $this->db->get('gigs');
		return $query->row();
	}
	
	
	
	function check_gig_venue_type($sl_gig_id, $sl_venue){
		$query = $this->db->query("SELECT count(id) AS NUMS FROM gigs WHERE id='".$sl_gig_id."' AND FIND_IN_SET('".$sl_venue."',venues)");
		$total_physical_gigs = $query->row()->NUMS;
		
		if($total_physical_gigs >0){
			return '1';
		}else{
			return '0';
		} 
	}
 
	/*
	id	t1.ticket_no	t1.gig_id	ticket_tier_id	booking_id	cart_id	t1.user_id	t1.qr_token 	
	
	
	t2.id	t2.user_id	t2.title	t2.subtitle	t2.category	t2.poster	t2.address
	
	t3.id	t3.fname	t3.lname	t3.email
	tickets t1
	gigs t2
	users t3 
	*/ 
	
	function get_tickets_by_qr_code_token($qr_token_arrs){
		if(count($qr_token_arrs)>0){ 
			$qr_token_txts = '';
			foreach($qr_token_arrs as $qr_token_arr){
				$qr_token_txts .= "'".$qr_token_arr."',";
			} 
			
			$qr_token_txts = rtrim($qr_token_txts, ','); 
			 
			$query = $this->db->query("SELECT t1.id as ticket_id, t1.ticket_no, t1.gig_id, t1.is_validated, t2.user_id as gig_user_id, t1.ticket_tier_id, t1.booking_id, t1.user_id, t1.qr_token, t2.title, t2.subtitle, t2.gig_date, t2.start_time, t2.end_time, t2.address, t2.category, t2.poster, t2.address, t3.fname, t3.lname, t3.email FROM tickets t1
		LEFT JOIN gigs t2 ON t2.id = t1.gig_id 
		LEFT JOIN users t3 ON t3.id = t1.user_id 
		WHERE t1.qr_token IN (".$qr_token_txts.") ");
		
		/*WHERE t1.qr_token IN ='".$sl_gig_id."' AND t1.user_id='".$sl_usr_id."' ");*/
		return $query->result(); 
		
		}else{
			return false;
		}  
	}
	

	function get_tickets_by_gig_and_userid($sl_gig_id, $sl_usr_id){
		$query = $this->db->query("SELECT t1.ticket_no, t1.qr_token, t1.is_validated, t2.title, t2.subtitle, t2.category, t2.poster, t2.address, t3.fname, t3.lname, t3.email FROM tickets t1
		LEFT JOIN gigs t2 ON t2.id = t1.gig_id 
		LEFT JOIN users t3 ON t3.id = t1.user_id 
		WHERE t1.gig_id='".$sl_gig_id."' AND t1.user_id='".$sl_usr_id."' ");
		return $query->result(); 
	}
	
 	function get_tickets_by_gigid($sl_gig_id){
		$query = $this->db->query("SELECT t1.ticket_no, t1.qr_token, t1.is_validated, t2.title, t2.subtitle, t2.category, t2.poster, t2.address, t3.fname, t3.lname, t3.email, t4.created_on, t5.price FROM tickets t1
		LEFT JOIN gigs t2 ON t2.id = t1.gig_id 
		LEFT JOIN users t3 ON t3.id = t1.user_id 
		LEFT JOIN ticket_tiers t4 ON t4.id = t1.ticket_tier_id  
		LEFT JOIN bookings t5 ON t5.id = t1.booking_id  
		WHERE t1.gig_id='".$sl_gig_id."' ");
		return $query->result(); 
	}

	
	function get_ticket_data_by_qr_token($qr_token){
		$res = $this->db->get_where('tickets', array('qr_token' => $qr_token));
		return $res->row();
	}
	
	function update_tickets_data($args1, $datas) {
		$this->db->where('id', $args1);
		return $this->db->update('tickets', $datas);
	}
	
}