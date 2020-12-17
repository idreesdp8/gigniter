<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Gigs extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();


		$this->dbs_user_id = $vs_id = $this->session->userdata('us_id');
		$this->login_vs_role_id = $this->dbs_role_id = $vs_role_id = $this->session->userdata('us_role_id');
		$this->load->model('admin/general_model', 'general_model');
		// if(isset($vs_id) && (isset($vs_role_id) && $vs_role_id>=1)){

		// 	$res_nums = $this->general_model->check_controller_permission_access('Admin/Users',$vs_role_id,'1');
		// 	if($res_nums>0){

		// 	}else{
		// 		redirect('/');
		// 	} 
		// }else{
		// 	redirect('/');
		// }

		$this->load->model('admin/users_model', 'users_model');
		$this->load->model('admin/configurations_model', 'configurations_model');
		$this->load->model('admin/countries_model', 'countries_model');
		$this->load->model('admin/gigs_model', 'gigs_model');
		$perms_arrs = array('role_id' => $vs_role_id);
		$this->key = 'gig-status';

		$this->load->library('Ajax_pagination');
		$this->perPage = 25;
	}

	/* users functions starts */
	function index()
	{
		// $res_nums = $this->general_model->check_controller_method_permission_access('Admin/Users', 'index', $this->dbs_role_id, '1');
		// if ($res_nums > 0) {

		$gigs = $this->gigs_model->get_all_gigs();
		foreach ($gigs as $gig) {
			$temp = ['key' => $this->key, 'value' => $gig->status];
			$status = $this->configurations_model->get_configuration_by_key_value($temp);
			$gig->status_label = $status->label;
		}
		$data['records'] = $gigs;
		// echo json_encode($data);
		// die();
		// $data['page_headings'] = "Users List";
		$this->load->view('admin/gigs/index', $data);
		// } else {
		// 	$this->load->view('admin/no_permission_access');
		// }
	}

	function trash($args2 = '')
	{
		// $res_nums = $this->general_model->check_controller_method_permission_access('Admin/Users', 'trash', $this->dbs_role_id, '1');
		// if ($res_nums > 0) {

		// $data['page_headings'] = "Users List";
		$user = $this->users_model->get_user_by_id($args2);
		@unlink("downloads/profile_pictures/thumb/$user->image");
		@unlink("downloads/profile_pictures/$user->image");
		$this->users_model->trash_user($args2);
		$this->session->set_flashdata('deleted_msg', 'User is deleted');
		redirect('admin/users');
		// } else {
		// 	$this->load->view('admin/no_permission_access');
		// }
	}


	function add()
	{

		// $res_nums = $this->general_model->check_controller_method_permission_access('Admin/Users','add',$this->dbs_role_id,'1'); 
		// if($res_nums>0){ 

		// $data['page_headings'] = 'Add User';

		// $arrs_field = array('role_id' => '2');
		// $data['manager_arrs'] = $this->general_model->get_gen_all_users_by_field($arrs_field);
		// $data['role_arrs'] = $this->roles_model->get_all_roles();

		if (isset($_POST) && !empty($_POST)) {

			// get form input
			$data = $_POST;
			// echo json_encode($data);
			// echo json_encode($_FILES);
			// die();

			// form validation
			$this->form_validation->set_rules("title", "Title", "trim|required|xss_clean");
			$this->form_validation->set_rules("category", "Category", "trim|required|xss_clean");
			$this->form_validation->set_rules("genre", "Genre", "trim|required|xss_clean");
			$this->form_validation->set_rules("goal", "Goal", "trim|required|xss_clean");
			$this->form_validation->set_rules("campaign_date", "Campaign Date", "trim|required|xss_clean");
			$this->form_validation->set_rules("gig_date", "Gig date", "trim|required|xss_clean");
			if ($this->form_validation->run() == FALSE) {
				// validation fail
				// $this->load->view('admin/users/add', $data);
				redirect('admin/gigs/add');
			} else {

				$prf_img_error = '';
				$alw_typs = array('image/jpg', 'image/jpeg', 'image/png', 'image/gif');
				// $imagename = (isset($_POST['old_image']) && $_POST['old_image'] != '') ? $_POST['old_image'] : '';
				$imagename = '';
				// echo 'gg';
				if (isset($_FILES['poster']['tmp_name']) && $_FILES['poster']['tmp_name'] != '') {
					// echo json_encode($_FILES['poster']);
					if (!(in_array($_FILES['poster']['type'], $alw_typs))) {
						$tmp_img_type = "'" . ($_FILES['poster']['type']) . "'";
						$prf_img_error .= "Poster type: $tmp_img_type not allowed!<br>";
						echo $prf_img_error;
					}

					if ($prf_img_error == '') {
						$image_path = poster_relative_path();
						$thumbnail_path = poster_thumbnail_relative_path();
						$imagename = time() . $this->general_model->fileExists($_FILES['poster']['name'], $image_path);
						$target_file = $image_path . $imagename;
						@move_uploaded_file($_FILES["poster"]["tmp_name"], $target_file);
						$width = 200;
						$height = 200;
						$thumbnail = $this->general_model->_create_thumbnail($imagename, $image_path, $thumbnail_path, $width, $height);
						if ($thumbnail == '1') {
							$thumbnail_file = $thumbnail_path . $imagename;
						}
						// echo $thumbnail;
						@move_uploaded_file($_FILES["poster"]["tmp_name"], $thumbnail_file);
					}
					if (strlen($prf_img_error) > 0) {
						$this->session->set_flashdata('prof_img_error', $prf_img_error);
						redirect('admin/gigs/add');
						// $this->load->view('admin/users/add', $data);
					}
				}

				$created_on = date('Y-m-d H:i:s');
				$datas = array(
					'title' => $data['title'] ?? null,
					'subtitle' => $data['subtitle'] ?? null,
					'category' => $data['category'] ?? null,
					'genre' => $data['genre'] ?? null,
					'address' => $data['address'] ?? null,
					'poster' => $imagename,
					'goal' => $data['goal'] ?? null,
					'is_overshoot' => $data['is_overshoot'] ?? 0,
					'campaign_date' => $data['campaign_date'] ? date('Y-m-d H:i:s', strtotime($data['campaign_date'])) : $created_on,
					'gig_date' => $data['campaign_date'] ? date('Y-m-d H:i:s', strtotime($data['gig_date'])) : $created_on,
					'venues' => array_key_exists('venues', $data) ? implode(',', $data['venues']) : '',
					'status' => $data['status'] ?? null,
					'created_on' => $created_on,
				);
				// echo json_encode($datas);
				// die();
				$this->update_user_data($data, $_FILES);
				// die();
				$res = $this->gigs_model->insert_gig_data($datas);

				if ($res) {
					$this->add_tickets($data, $res, $created_on);
					// die();
					$this->session->set_flashdata('success_msg', 'Gig added successfully');
				} else {
					$this->session->set_flashdata('error_msg', 'Error: while adding gig!');
				}
				// echo json_encode($response);
				// $this->load->view('admin/gigs/add');
				// die();
				redirect("admin/gigs");
			}
		} else {
			// $data['roles'] = $this->roles_model->get_all_roles_without_admin();
			$data['categories'] = $this->configurations_model->get_all_configurations_by_key('category');
			$data['genres'] = $this->configurations_model->get_all_configurations_by_key('genre');
			$data['status'] = $this->configurations_model->get_all_configurations_by_key('gig-status');
			$data['countries'] = $this->countries_model->get_all_countries();
			$data['user'] = $this->users_model->get_user_by_id($this->dbs_user_id);
			$links = $this->users_model->get_social_links($this->dbs_user_id);
			if (isset($links) && !empty($links)) {
				foreach ($links as $key => $val) {
					$temp[] = [$val->platform => $val->url];
				}
				$data['link'] = $temp;
			} else {
				$data['link'] = [];
			}
			// echo json_encode($data);
			// die();
			$this->load->view('admin/gigs/add', $data);
		}

		// }else{ 
		// 	$this->load->view('admin/no_permission_access'); 
		// }   
	}

	function update_user_data($data, $files)
	{
		echo json_encode($data);
		echo json_encode($files);
		$social_links = [];
		if (isset($data['mail']) && $data['mail'] != '') {
			$social_links['mail'] = $data['mail'];
		}
		if (isset($data['facebook']) && $data['facebook'] != '') {
			$social_links['facebook'] = $data['facebook'];
		}
		if (isset($data['instagram']) && $data['instagram'] != '') {
			$social_links['instagram'] = $data['instagram'];
		}
		if (isset($data['twitter']) && $data['twitter'] != '') {
			$social_links['twitter'] = $data['twitter'];
		}
		$datas = array(
			'fname' => $data['fname'],
			'lname' => $data['lname'],
			'description' => $data['description'],
			'address' => $data['address'],
			'country_id' => $data['country_id'],
		);

		$prf_img_error = '';
		$alw_typs = array('image/jpg', 'image/jpeg', 'image/png', 'image/gif');
		// $imagename = (isset($_POST['old_image']) && $_POST['old_image'] != '') ? $_POST['old_image'] : '';
		if (isset($_FILES['image']['tmp_name']) && $_FILES['image']['tmp_name'] != '') {
			// echo json_encode($_FILES['image']);
			// die();
			if (!(in_array($_FILES['image']['type'], $alw_typs))) {
				$tmp_img_type = "'" . ($_FILES['image']['type']) . "'";
				$prf_img_error .= "Profile image type: $tmp_img_type not allowed!<br>";
			}

			if ($prf_img_error == '') {
				$user = $this->users_model->get_user_by_id($this->dbs_user_id);
				@unlink("downloads/profile_pictures/thumb/$user->image");
				@unlink("downloads/profile_pictures/$user->image");
				$image_path = profile_image_relative_path();
				$thumbnail_path = profile_thumbnail_relative_path();
				$imagename = time() . $this->general_model->fileExists($_FILES['image']['name'], $image_path);
				$target_file = $image_path . $imagename;
				@move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
				$width = 200;
				$height = 200;
				$thumbnail = $this->general_model->_create_thumbnail($imagename, $image_path, $thumbnail_path, $width, $height);
				if ($thumbnail == '1') {
					$thumbnail_file = $thumbnail_path . $imagename;
				}
				// echo $thumbnail;
				@move_uploaded_file($_FILES["image"]["tmp_name"], $thumbnail_file);
				$datas['image'] = $imagename;
			}
			if (strlen($prf_img_error) > 0) {
				$this->session->set_flashdata('prof_img_error', $prf_img_error);
				redirect('admin/users/update');
				// $this->load->view('admin/users/add', $data);
			}
		}
		$res = $this->users_model->update_user_data($this->dbs_user_id, $datas);
		if (isset($res)) {
			$created_on = date('Y-m-d H:i:s');
			$this->remove_social_links($this->dbs_user_id);
			foreach($social_links as $key=>$value){
				$temp = ['user_id'=>$this->dbs_user_id, 'platform'=>$key, 'url'=>$value, 'created_on'=>$created_on];
				$this->users_model->insert_user_social_link($temp);
			}
		}
	}

	function remove_social_links($id)
	{
		$links = $this->users_model->get_social_links($id);
		if (isset($links)) {
			foreach ($links as $key => $value) {
				$this->users_model->trash_social_link($value->id);
			}
		}
	}

	function add_tickets($data, $gig_id, $created_on)
	{
		$length = count($data['ticket_name']);
		for ($i = 0; $i < $length; $i++) {
			$j = $i + 1;
			$tier = [
				'user_id' => $this->dbs_user_id,
				'gig_id' => $gig_id,
				'name' => $data['ticket_name'][$i],
				'price' => $data['ticket_price'][$i],
				'quantity' => $data['ticket_quantity'][$i],
				'description' => $data['ticket_description'][$i],
				'is_limited' => isset($data["ticket_is_limited_$j"]) ? $data["ticket_is_limited_$j"] : 0,
				'created_on' => $created_on,
			];
			$res = $this->gigs_model->add_ticket_tier($tier);
			if ($res) {
				// echo $j;
				$this->add_ticket_bundles($data, $res, $j, $created_on);
				// die();
			}
		}
	}

	function add_ticket_bundles($data, $res, $tier, $created_on)
	{
		// echo json_encode($data);
		$length = count($data["bundle_name_tier$tier"]);
		for ($i = 0; $i < $length; $i++) {
			// $j = $i + 1;
			$bundle = [
				'ticket_tier_id' => $res,
				'name' => $data["bundle_name_tier$tier"][$i],
				'quantity' => $data["bundle_quantity_tier$tier"][$i],
				'price' => $data["bundle_price_tier$tier"][$i],
				'created_on' => $created_on,
			];
			// echo json_encode($bundle);
			$this->gigs_model->add_ticket_tier_bundle($bundle);
		}
	}

	function update($args1 = '')
	{

		// $res_nums = $this->general_model->check_controller_method_permission_access('Admin/Users', 'update', $this->dbs_role_id, '1');
		// if ($res_nums > 0) {

		// if (isset($args1) && $args1 != '') {
		// 	$data['args1'] = $args1;
		// 	$data['page_headings'] = 'Update User';
		// 	$update_record_arr = $data['record'] = $this->users_model->get_user_by_id($args1);
		// } else {
		// 	$data['page_headings'] = 'Add User';
		// }
		// $arrs_field = array('role_id' => '2');
		// $data['manager_arrs'] = $this->general_model->get_gen_all_users_by_field($arrs_field);
		// $data['role_arrs'] = $this->roles_model->get_all_roles();

		if (isset($_POST) && !empty($_POST)) {
			// get form input
			$data = $_POST;
			// echo json_encode($data);
			// echo json_encode($_FILES['image']);
			// die();

			// form validation
			$this->form_validation->set_rules("fname", "Name", "trim|required|xss_clean");
			$this->form_validation->set_rules("role_id", "Role", "trim|required|xss_clean");

			if ($this->form_validation->run() == FALSE) {
				// validation fail
				redirect('admin/users/update/' . $data['id']);
			} else {

				$datas = array(
					'fname' => $data['fname'],
					'lname' => $data['lname'],
					'role_id' => $data['role_id'],
					'mobile_no' => $data['mobile_no'],
					'phone_no' => $data['phone_no'],
					'description' => $data['description'],
					'address' => $data['address'],
					'city' => $data['city'],
					'state' => $data['state'],
					'country' => $data['country'],
					'zip' => $data['zip'],
					'status' => $data['status'],
				);

				$prf_img_error = '';
				$alw_typs = array('image/jpg', 'image/jpeg', 'image/png', 'image/gif');
				// $imagename = (isset($_POST['old_image']) && $_POST['old_image'] != '') ? $_POST['old_image'] : '';
				if (isset($_FILES['image']['tmp_name']) && $_FILES['image']['tmp_name'] != '') {
					// echo json_encode($_FILES['image']);
					// die();
					if (!(in_array($_FILES['image']['type'], $alw_typs))) {
						$tmp_img_type = "'" . ($_FILES['image']['type']) . "'";
						$prf_img_error .= "Profile image type: $tmp_img_type not allowed!<br>";
					}

					if ($prf_img_error == '') {
						$user = $this->users_model->get_user_by_id($data['id']);
						@unlink("downloads/profile_pictures/thumb/$user->image");
						@unlink("downloads/profile_pictures/$user->image");
						$image_path = profile_image_relative_path();
						$thumbnail_path = profile_thumbnail_relative_path();
						$imagename = time() . $this->general_model->fileExists($_FILES['image']['name'], $image_path);
						$target_file = $image_path . $imagename;
						@move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
						$width = 200;
						$height = 200;
						$thumbnail = $this->general_model->_create_thumbnail($imagename, $image_path, $thumbnail_path, $width, $height);
						if ($thumbnail == '1') {
							$thumbnail_file = $thumbnail_path . $imagename;
						}
						// echo $thumbnail;
						@move_uploaded_file($_FILES["image"]["tmp_name"], $thumbnail_file);
						$datas['image'] = $imagename;
					}
					if (strlen($prf_img_error) > 0) {
						$this->session->set_flashdata('prof_img_error', $prf_img_error);
						redirect('admin/users/update');
						// $this->load->view('admin/users/add', $data);
					}
				}
				/*$password = md5($password);*/
				//$password = $this->general_model->encrypt_data($password);
				if (isset($data['password']) && $data['password'] != '') {
					$password = $this->general_model->safe_ci_encoder($data['password']);
					$datas['password'] = $password;
				}
				// echo json_encode($datas);
				// die();
				$res = $this->users_model->update_user_data($data['id'], $datas);
				if (isset($res)) {
					$this->session->set_flashdata('success_msg', 'User updated successfully!');
				} else {
					$this->session->set_flashdata('error_msg', 'Error: while updating user!');
				}

				redirect("admin/users");
			}
		} else {
			$data['user'] = $this->users_model->get_user_by_id($args1);
			$data['roles'] = $this->roles_model->get_all_roles_without_admin();
			// echo json_encode($data);
			// die();
			$this->load->view('admin/users/update', $data);
		}
		// } else {
		// 	$this->load->view('admin/no_permission_access');
		// }
	}

	/* users functions ends */
}
