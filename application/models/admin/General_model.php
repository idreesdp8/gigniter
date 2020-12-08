<?php
defined('BASEPATH') or exit('No direct script access allowed');
class General_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}
	/* general functions starts */

	public function validate_email_format($sel_email)
	{
		$msgs = '';
		if (empty($sel_email)) {
			$msgs = "Email is required field!";
		} else {
			//$sel_email1 = test_input($sel_email); 

			if (!filter_var($sel_email, FILTER_VALIDATE_EMAIL)) {
				$msgs = "Invalid Email format!";
			}
		}

		return $msgs;
	}


	public function validate_input_format($sel_input)
	{
		$msgs = '';
		if (empty($sel_input)) {
			$msgs = "is required field!";
		}

		return $msgs;
	}


	public function validate_web_address_format($sel_web_input)
	{

		$msgs = '';
		if (empty($sel_web_input)) {
			$msgs = "";
		} else {
			//$web_input = test_input($sel_web_input);
			// check if URL address syntax is valid (this regular expression also allows dashes in the URL)
			if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $sel_web_input)) {
				$msgs = "Invalid URL Address!";
			}
		}

		return $msgs;
	}


	public function validate_phone_format($sel_phone_input)
	{

		$msgs = '';
		if (empty($sel_phone_input)) {
			$msgs = "Phone Number is required field!";
		} else {
			//$phone_input = test_input($sel_phone_input);

			if (!preg_match("/^[0-9]*$/", $sel_phone_input)) {
				$msgs = "Please enter digits only!";
			}
		}

		return $msgs;
	}


	public function _create_thumbnail($fileName, $source_paths, $target_paths, $width, $height)
	{

		$this->load->library('image_lib');
		$config['image_library'] = 'gd2';
		$config['source_image'] = $source_paths . $fileName;
		$config['create_thumb'] = FALSE;
		$config['maintain_ratio'] = FALSE;
		$config['width'] = $width;
		$config['height'] = $height;
		$config['new_image'] = $target_paths . $fileName;
		$this->image_lib->initialize($config);
		if ($this->image_lib->resize()) {
			return '1';
		} else {
			return $this->image_lib->display_errors();
		}
	}

	function get_permission_by_module_role($per_id, $mod_id, $rol_id)
	{
		if ($mod_id > 0 && $rol_id > 0) {
			$whrs = " WHERE id >'0' ";
			if ($per_id > 0) {
				$whrs = " WHERE id!='$per_id' ";
			}
			$whrs .= " AND module_id='$mod_id' AND role_id='$rol_id' ";
			$query = $this->db->query(" SELECT count(*) AS NUMS FROM permissions_tbl $whrs ");
			$row_nums = $query->row()->NUMS;
			return $row_nums;
		} else {
			return '0';
		}
	}

	function get_role_permissions($role_id)
	{
		if($role_id) {
			$whrs = " WHERE role_id = '$role_id'";
			$query = $this->db->query("SELECT * FROM role_permissions $whrs");
			return $query->result();
		} else {
			return array();
		}
	}

	function get_permission_by_name($name)
	{
		if ($name) {
			$whrs = " WHERE id >'0' ";
			// if ($per_id > 0) {
			// 	$whrs = " WHERE id!='$per_id' ";
			// }
			$whrs .= " AND name='$name' ";
			$query = $this->db->query(" SELECT * FROM permissions $whrs ");
			$row_nums = $query->result();
			return $row_nums;
		} else {
			return '0';
		}
	}

	function get_role_by_name($name)
	{
		if ($name) {
			$whrs = " WHERE id >'0' ";
			// if ($per_id > 0) {
			// 	$whrs = " WHERE id!='$per_id' ";
			// }
			$whrs .= " AND name='$name' ";
			$query = $this->db->query(" SELECT * FROM roles $whrs ");
			$row_nums = $query->result();
			return $row_nums;
		} else {
			return '0';
		}
	}

	function sync_role_permissions($data)
	{
		return $this->db->insert_batch('role_permissions', $data);
	}

	function desync_role_permissions($id)
	{
		if($id >0){
			$this->db->where('id', $id);
			$this->db->delete('role_permissions');
		} 
		return true;
	}

	public function check_controller_permission_access($contrlrs_name, $rol_id, $is_restrick)
	{
		$whrs = '';
		if (strlen($contrlrs_name) > 0 && $rol_id > 0 && $is_restrick == 1) {
			$whrs = " AND m.controller_name='$contrlrs_name' AND p.role_id='$rol_id' ";
		}

		$query = $this->db->query("SELECT count(p.id) AS NUMS FROM permissions p, modules_tbl m WHERE p.module_id=m.id $whrs ");
		$row_nums = $query->row()->NUMS;
		return $row_nums;
	}

	public function check_controller_method_permission_access($contrlrs_name, $mthd_name, $rol_id, $is_restrick)
	{
		$whrs = '';
		if (strlen($contrlrs_name) > 0 && strlen($mthd_name) > 0 && $rol_id > 0 && $is_restrick == 1) {
			$whrs = " AND m.controller_name='$contrlrs_name' AND p.role_id='$rol_id' ";

			if ($mthd_name == 'add') {
				$whrs .= " AND p.is_add_permission='1' ";
			}
			if ($mthd_name == 'update') {
				$whrs .= " AND p.is_update_permission='1' ";
			}
			if ($mthd_name == 'view' || $mthd_name == 'index') {
				$whrs .= " AND p.is_view_permission='1' ";
			}
			if ($mthd_name == 'delete' || $mthd_name == 'trash') {
				$whrs .= " AND p.is_delete_permission='1' ";
			}
		}

		$query = $this->db->query("SELECT count(p.id) AS NUMS FROM permissions_tbl p, modules_tbl m WHERE p.module_id=m.id $whrs ");
		$row_nums = $query->row()->NUMS;
		return $row_nums;
	}

	public function check_controller_method_permission_access111($contrlrs_name, $mthd_field, $mthd_name, $rol_id, $is_restrick)
	{
		$whrs = '';
		if (strlen($contrlrs_name) > 0 && strlen($mthd_field) > 0 && strlen($mthd_name) > 0 && $rol_id > 0 && $is_restrick == 1) {
			$whrs = " AND m.controller_name='$contrlrs_name' AND p.role_id='$rol_id' ";

			if ($mthd_field == 'add_method_name') {
				$whrs .= " AND m.add_method_name='$mthd_name' AND p.is_add_permission='1' ";
			}
			if ($mthd_field == 'update_method_name') {
				$whrs .= " AND m.update_method_name='$mthd_name' AND p.is_update_permission='1' ";
			}
			if ($mthd_field == 'view_method_name') {
				$whrs .= " AND m.view_method_name='$mthd_name' AND p.is_view_permission='1' ";
			}
			if ($mthd_field == 'delete_method_name') {
				$whrs .= " AND m.delete_method_name='$mthd_name' AND p.is_delete_permission='1' ";
			}
		}

		$query = $this->db->query("SELECT count(p.id) AS NUMS FROM permissions_tbl p, modules_tbl m WHERE p.module_id=m.id $whrs ");
		$row_nums = $query->row()->NUMS;
		return $row_nums;
	}

	//file upoading function                 
	public function fileExists($file, $dir)
	{

		$i = 1;
		$probeer = $file;
		while (file_exists($dir . $probeer)) {
			$punt = strrpos($file, ".");
			if (substr($file, ($punt - 3), 1) !== ("[") && substr($file, ($punt - 1), 1) !== ("]")) {
				$probeer = substr($file, 0, $punt) . "[" . $i . "]" .
					substr($file, ($punt), strlen($file) - $punt);
			} else {
				$probeer = substr($file, 0, ($punt - 3)) . "[" . $i . "]" .
					substr($file, ($punt), strlen($file) - $punt);
			}
			$i++;
		}
		return $probeer;
	} // end of the file uploading function

	public function get_custom_file_extension($str)
	{
		$i = strrpos($str, ".");
		if (!$i) {
			return "";
		}

		$l = strlen($str) - $i;
		$ext = substr($str, $i + 1, $l);
		return $ext;
	}

	public function genernate_thumbnails($filename, $extension, $uploadedfile, $file_to_upload, $newwidth, $newheightsss)
	{

		if ($extension == "jpg" || $extension == "jpeg") {
			$src = imagecreatefromjpeg($uploadedfile);
		} else if ($extension == "png") {
			$src = imagecreatefrompng($uploadedfile);
		} else {
			$src = imagecreatefromgif($uploadedfile);
		}

		list($width, $height) = getimagesize($uploadedfile);

		if ($newwidth > $width) {
			$newwidth = $width;
		}

		if ($newwidth > $width) {
			$newwidth = $width;
			$newheight = $height;
		} else {
			$newheight = ($height / $width) * $newwidth;
		}

		$tmp = imagecreatetruecolor($newwidth, $newheight);

		imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

		$filename = $file_to_upload . $filename;

		imagejpeg($tmp, $filename, 100);

		imagedestroy($src);
		imagedestroy($tmp);
	}

	public function get_user_info_by_id($args1)
	{
		$query = $this->db->get_where('users_tbl', array('id' => $args1));
		return $query->row();
	}


	public function get_gen_all_users_list()
	{
		$query = $this->db->get('users_tbl');
		return $query->result();
	}

	public function get_gen_all_siteusers_list()
	{
		$query = $this->db->get('siteusers_tbl');
		return $query->result();
	}

	public function get_user_role_info_by_id($args1)
	{
		$this->db->select("u.*, r.name AS user_role_name");
		$this->db->from('users_tbl u, roles_tbl r');
		$this->db->where('u.role_id=r.id');
		$this->db->where("u.id=$args1");
		$query = $this->db->get();
		return $query->row();
	}

	/* encryption and decryption functions starts */
	public function encrypt_data($cstm_string)
	{
		$output = false;
		$key = 'E0B554B341FF5632DE241FBF4B1DBB37'; // initialization vector 
		$iv = md5(md5($key));

		$output = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $cstm_string, MCRYPT_MODE_CBC, $iv);
		$output = base64_encode($output);
		$output = rtrim($output, "");
		$output = trim($output, "");
		return $output;
	}

	public function decrypt_data($cstm_string)
	{
		$output = false;
		$key = 'E0B554B341FF5632DE241FBF4B1DBB37'; // initialization vector
		$iv = md5(md5($key));

		$output = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($cstm_string), MCRYPT_MODE_CBC, $iv);
		$output = rtrim($output, "");
		$output = trim($output, "");
		return $output;
	}


	public function safe_ci_encoder($str_txts)
	{

		$ret_data = base64_encode($str_txts);
		$ret_data = str_replace(array('+', '/', '='), array('-', '_', ''), $ret_data);
		return $ret_data;
	}

	public function safe_ci_decoder($str_txts)
	{
		$ret_data = str_replace(array('-', '_'), array('+', '/'), $str_txts);
		$mod4 = strlen($ret_data) % 4;
		if ($mod4) {
			$ret_data .= substr('====', $mod4);
		}
		return base64_decode($ret_data);
	}
	/* encryption and decryption functions ends */

	function get_gen_all_users_by_field($arrs_field)
	{
		$query = $this->db->get_where('users_tbl', $arrs_field);
		return $query->result();
	}

	public function get_gen_permission_check($perms_arrs)
	{
		$query = $this->db->get_where('permissions_tbl', $perms_arrs);
		return $query->result();
	}

	/* module permissions check starts */
	public function check_gen_module_permission($needle, $needle_field, $haystack)
	{
		if ($haystack) {
			foreach ($haystack as $item) {
				if (isset($item->$needle_field) && $item->$needle_field == $needle && ($item->is_add_permission == 1 || $item->is_update_permission == 1 || $item->is_view_permission == 1 || $item->is_delete_permission == 1)) {
					return true;
				}
			}
		}
		return false;
	}

	public function in_array_field($needle, $needle_field, $needle2, $needle_field2, $haystack)
	{
		if ($haystack) {
			foreach ($haystack as $item) {
				if (isset($item->$needle_field) && $item->$needle_field == $needle && $item->$needle_field2 == $needle2) {
					return true;
				}
			}
		}
		return false;
	}

	public function in_array_section_field($needle, $needle_field, $needle_field2, $haystack)
	{
		if ($haystack) {
			foreach ($haystack as $item) {
				if (isset($item->$needle_field) && $item->$needle_field == $needle) {
					return $item->$needle_field2;
				}
			}
		}
		return false;
	}

	/* module permissions check ends */


	public function get_configuration()
	{
		$query = $this->db->get_where('config_tbl', array('id' => '1'));
		return $query->row();
	}

	public function get_gen_colors($paras1)
	{
		$retrn_vals = '';
		switch ($paras1) {
			case 1:
				$retrn_vals = '#003366';
				break;
			case 2:
				$retrn_vals = '#ff7373';
				break;
			case 3:
				$retrn_vals = '#008080';
				break;
			case 4:
				$retrn_vals = '#40e0d0';
				break;
			case 5:
				$retrn_vals = '#fa8072';
				break;
			case 6:
				$retrn_vals = '#008000';
				break;
			case 7:
				$retrn_vals = '#0099cc';
				break;
			case 8:
				$retrn_vals = '#cc0000';
				break;
			case 9:
				$retrn_vals = '#999999';
				break;
			case 10:
				$retrn_vals = '#c39797';
				break;

			default:
				$retrn_vals = '#660066';
		}
		return $retrn_vals;
	}


	public function exportExcelData($exp_records)
	{
		$headings = false;
		if (!empty($exp_records))
			foreach ($exp_records as $exp_row) {
				if (!$headings) {
					// display field/column names as a first row
					echo implode("\t", array_keys($exp_row)) . "\n";
					$headings = true;
				}
				echo implode("\t", ($exp_row)) . "\n";
			}
	}

	function random_string($length)
	{
		$str = '';
		$chars = "abcdefghijklmnopqrstuvwxyz0123456789";
		$size = strlen($chars);
		for ($i = 0; $i < $length; $i++) {
			$str .= $chars[rand(0, $size - 1)];
		}
		return $str;
	}


	function get_gen_all_users_assigned()
	{

		$vs_id = $this->session->userdata('us_id');
		$vs_user_role_id = $this->session->userdata('us_role_id');

		$this->db->select("u.* ");
		$this->db->from('users_tbl u');
		if ($vs_user_role_id == 3) {
			$wheress = " id=$vs_id ";
		} else if ($vs_user_role_id == 2) {
			$wheress = " id=$vs_id OR ( role_id='3' AND parent_id=$vs_id ) ";
		} else {
			$wheress = "id >0";
		}

		$this->db->where($wheress);
		$query = $this->db->get();
		return $query->result();
	}

	function get_all_users_with_roles()
	{
		$this->db->select("u.*, r.name AS role_name");
		$this->db->from('users_tbl u, roles_tbl r');
		$this->db->where('u.role_id=r.id');
		$query = $this->db->get();
		return $query->result();
	}

	function get_gen_siteuser_by_id($args1)
	{
		if ($args1 > 0) {
			$query = $this->db->get_where('siteusers_tbl', array('id' => $args1));
			return $query->row();
		} else {
			return '';
		}
	}


	public function get_status_type($paras1)
	{
		$ret_txt = '';
		if ($paras1 == 0) {
			$ret_txt = 'Inactive';
		} else if ($paras1 == 1) {
			$ret_txt = 'Active';
		}
		return $ret_txt;
	}



	/*public function get_currency_symbol($paras1){
				$ret_txt = ''; 
				if($paras1 >0){  
					$query = $this->db->query("SELECT symbol FROM currencies_tbl WHERE id='$paras1' "); 
					$ret_txt = $query->row()->symbol;
				
				}
				return $ret_txt;
		   }*/



	function get_sl_users_by_ids($sl_usrids)
	{
		if (strlen($sl_usrids) > 0) {
			$query = $this->db->query("SELECT id, name, role_id, email, password, mobile_no FROM users_tbl WHERE id IN (" . $sl_usrids . ")");
			return $query->result();
		} else {
			return '';
		}
	}


	function get_user_names_ids($usrids)
	{
		$ret_txt = '';
		if (strlen($usrids) > 0) { //status='1'  
			$query = $this->db->query("SELECT name FROM users_tbl WHERE id IN (" . $usrids . ")");
			$rowws = $query->result();
			if (isset($rowws)) {
				foreach ($rowws as $roww) {
					$ret_txt .= $roww->name . ', ';
				}

				$ret_txt = rtrim($ret_txt, ', ');
			}
		}

		return $ret_txt;
	}


	function get_gen_tag_names_by_ids($tagsids)
	{
		$ret_txt = '';
		if (strlen($tagsids) > 0) { //status='1'  
			$query = $this->db->query("SELECT name FROM tags_tbl WHERE id IN (" . $tagsids . ")");
			$rowws = $query->result();
			if (isset($rowws)) {
				foreach ($rowws as $roww) {
					$ret_txt .= '<span class="badge badge-primary"> ' . $roww->name . ' </span>, ';
				}

				$ret_txt = rtrim($ret_txt, ', ');
			}
		}

		return $ret_txt;
	}

	function get_business_card_info_by_id($sl_id)
	{
		if ($sl_id > 0) {
			$query = $this->db->query("SELECT * FROM business_cards_tbl WHERE id=$sl_id ");
			return $query->row();
		} else {
			return '';
		}
	}

	/* general functions ends */
}
