<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Gigs extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$is_logged_in = $this->session->userdata('us_login');
		if (!$is_logged_in) {
			redirect("admin/login");
		}
		$vs_user_role_name = $this->session->userdata('us_role_name');
		if (isset($vs_user_role_name)) {
			if ($vs_user_role_name != 'Admin') {
				redirect('dashboard');
			}
		}


		$this->dbs_user_id = $vs_id = $this->session->userdata('us_id');
		$this->login_vs_role_id = $this->dbs_role_id = $vs_role_id = $this->session->userdata('us_role_id');
		$this->load->model('admin/general_model', 'general_model');
		$this->load->model('admin/permissions_model', 'permissions_model');
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
		$this->load->model('user/bookings_model', 'bookings_model');
		$perms_arrs = array('role_id' => $vs_role_id);
		$this->key = 'gig-status';
		$this->category_key = 'category';
		$this->genre_key = 'genre';

		$this->load->library('Ajax_pagination');
		$this->perPage = 25;
	}

	function reload_datatable()
	{
		$data = array();
		if ($this->input->post('sort_by') && $this->input->post('sort_by') != '') {
			$data['sort_by'] = $this->input->post('sort_by');
		}
		if ($this->input->post('status') > -1 && $this->input->post('status') != '') {
			$data['status'] = $this->input->post('status');
		}
		if ($this->input->post('is_featured') > -1 && $this->input->post('is_featured') != '') {
			$data['is_featured'] = $this->input->post('is_featured');
		}
		if ($this->input->post('from') > -1 && $this->input->post('from') != '') {
			$data['from'] = $this->input->post('from');
		}
		// echo json_encode($data);
		$gigs = $this->gigs_model->get_all_filter_gigs($data);
		if ($gigs) {
			foreach ($gigs as $key => $value) {
				$user = $this->users_model->get_user_by_id($value->user_id);
				$temp = ['key' => $this->key, 'value' => $value->status];
				$status = $this->configurations_model->get_configuration_by_key_value($temp);
				if ($value->status == 0) {
					$badge_class = 'badge-danger';
				} elseif ($value->status == 1) {
					$badge_class = 'badge-success';
				} elseif ($value->status == 2) {
					$badge_class = 'badge-primary';
				} elseif ($value->status == 3) {
					$badge_class = 'badge-secondary';
				}
				if ($value->is_featured) {
					$feature_html = '<span class="badge badge-success">Yes</span>';
				} else {
					$feature_html = '<span class="badge badge-danger">No</span>';
				}
				$category = $this->configurations_model->get_configuration_by_key_value(['key' => $this->category_key, 'value' => $value->category]);
				$genre = $this->configurations_model->get_configuration_by_key_value(['key' => $this->genre_key, 'value' => $value->genre]);
				$value->status_label = $status->label;
				$status_html = '<span class="badge ' . $badge_class . '">' . $value->status_label . '</span>';
				$category_label = $category->label;
				$genre_label = $genre->label;
				$user_name = ($user->fname ?? '') . ' ' . ($user->lname ?? '');
				$res = $this->get_tickets_booked_and_left($value);
				$value->booked = $res['booked'];
				$value->ticket_left = $res['ticket_left'];
				$buttons = '
						<div class="d-flex">
							<a href="' . admin_base_url() . 'bookings?gig_id=' . $value->id . '" data-popup="tooltip" data-original-title="See Bookings" type="button" class="btn btn-primary btn-icon ml-2"><i class="icon-cart5"></i></a>
							<a href="' . admin_base_url() . 'gigs/update/' . $value->id . '" type="button" class="btn btn-primary btn-icon ml-2"><i class="icon-pencil7"></i></a>
							<form action="' . admin_base_url() . 'gigs/trash/' . $value->id . '">
								<button type="submit" class="btn btn-danger btn-icon ml-2"><i class="icon-trash"></i></button>
							</form>
						</div>';
				$result['data'][$key] = array(
					$key + 1,
					$user_name,
					$value->title,
					// $category_label,
					// $genre_label,
					$value->popularity,
					$value->gig_date ? date('M d, Y', strtotime($value->gig_date)) : 'NA',
					$status_html,
					$feature_html,
					round($res['booked'], 0) . '%',
					date('M d, Y', strtotime($value->created_on)),
					// $paid_status,
					$buttons
				);
			}
		} else {
			$result['data'] = [];
		}
		echo json_encode($result);
	}

	function reload_popular_datatable()
	{
		$data = array();
		if ($this->input->post('sort_by') && $this->input->post('sort_by') != '') {
			$data['sort_by'] = $this->input->post('sort_by');
		}
		if ($this->input->post('status') > -1 && $this->input->post('status') != '') {
			$data['status'] = $this->input->post('status');
		}
		if ($this->input->post('is_featured') > -1 && $this->input->post('is_featured') != '') {
			$data['is_featured'] = $this->input->post('is_featured');
		}
		if ($this->input->post('from') > -1 && $this->input->post('from') != '') {
			$data['from'] = $this->input->post('from');
		}
		// echo json_encode($data);
		$gigs = $this->gigs_model->get_all_filter_popular_gigs($data);
		if ($gigs) {
			foreach ($gigs as $key => $value) {
				$user = $this->users_model->get_user_by_id($value->user_id);
				$temp = ['key' => $this->key, 'value' => $value->status];
				$status = $this->configurations_model->get_configuration_by_key_value($temp);
				if ($value->status == 0) {
					$badge_class = 'badge-danger';
				} elseif ($value->status == 1) {
					$badge_class = 'badge-success';
				} elseif ($value->status == 2) {
					$badge_class = 'badge-primary';
				} elseif ($value->status == 3) {
					$badge_class = 'badge-secondary';
				}
				if ($value->is_featured) {
					$feature_html = '<span class="badge badge-success">Yes</span>';
				} else {
					$feature_html = '<span class="badge badge-danger">No</span>';
				}
				$category = $this->configurations_model->get_configuration_by_key_value(['key' => $this->category_key, 'value' => $value->category]);
				$genre = $this->configurations_model->get_configuration_by_key_value(['key' => $this->genre_key, 'value' => $value->genre]);
				$value->status_label = $status->label;
				$status_html = '<span class="badge ' . $badge_class . '">' . $value->status_label . '</span>';
				$category_label = $category->label;
				$genre_label = $genre->label;
				$user_name = $user->fname . ' ' . $user->lname;
				$res = $this->get_tickets_booked_and_left($value);
				$value->popularity_data = $this->gigs_model->get_gig_popularity_data($value->id);
				$value->booked = $res['booked'];
				$value->ticket_left = $res['ticket_left'];
				$buttons = '
						<div class="d-flex">
							<a href="' . admin_base_url() . 'gigs/update/' . $value->id . '" type="button" class="btn btn-primary btn-icon ml-2"><i class="icon-pencil7"></i></a>
							<form action="' . admin_base_url() . 'gigs/trash/' . $value->id . '">
								<button type="submit" class="btn btn-danger btn-icon ml-2"><i class="icon-trash"></i></button>
							</form>
						</div>';
				$result['data'][$key] = array(
					$key + 1,
					$user_name,
					$value->title,
					// $category_label,
					// $genre_label,
					$value->popularity,
					$value->popularity_data->backers ?? '0',
					$value->popularity_data->date_diff ?? '0',
					'$' . $value->goal_amount,
					$value->popularity_data ? '$' . $value->popularity_data->amount_raised : '$0',
					date('M d, Y', strtotime($value->created_on)),
					// $paid_status,
					$buttons
				);
			}
		} else {
			$result['data'] = [];
		}
		echo json_encode($result);
	}

	/* users functions starts */
	function index()
	{
		// $res_nums = $this->general_model->check_controller_method_permission_access('Admin/Users', 'index', $this->dbs_role_id, '1');
		// if ($res_nums > 0) {

		$categories = $this->configurations_model->get_all_configurations_by_key($this->category_key);
		$genres = $this->configurations_model->get_all_configurations_by_key($this->genre_key);
		$statuses = $this->configurations_model->get_all_configurations_by_key($this->key);
		// echo json_encode($categories);
		// die();
		$gigs = $this->gigs_model->get_all_gigs();
		foreach ($gigs as $gig) {

			$user = $this->users_model->get_user_by_id($gig->user_id);
			$temp = ['key' => $this->key, 'value' => $gig->status];
			$status = $this->configurations_model->get_configuration_by_key_value($temp);
			$category = $this->configurations_model->get_configuration_by_key_value(['key' => $this->category_key, 'value' => $gig->category]);
			$genre = $this->configurations_model->get_configuration_by_key_value(['key' => $this->genre_key, 'value' => $gig->genre]);
			$gig->status_label = $status->label;
			$gig->category_label = $category->label;
			$gig->genre_label = $genre->label;

			$gig->user_name = (isset($user->fname)) ? $user->fname . ' ' . $user->lname : '';

			$res = $this->get_tickets_booked_and_left($gig);
			$gig->booked = $res['booked'];
			$gig->ticket_left = $res['ticket_left'];
		}
		$data['records'] = $gigs;
		$data['categories'] = $categories;
		$data['genres'] = $genres;
		$data['statuses'] = $statuses;
		// echo json_encode($data);
		// die();
		// $data['page_headings'] = "Users List";
		$this->load->view('admin/gigs/index', $data);
		// } else {
		// 	$this->load->view('admin/no_permission_access');
		// }
	}
	function featured_gigs()
	{
		// $res_nums = $this->general_model->check_controller_method_permission_access('Admin/Users', 'index', $this->dbs_role_id, '1');
		// if ($res_nums > 0) {

		$gigs = $this->gigs_model->get_featured_gigs();
		foreach ($gigs as $gig) {
			$user = $this->users_model->get_user_by_id($gig->user_id);
			$temp = ['key' => $this->key, 'value' => $gig->status];
			$status = $this->configurations_model->get_configuration_by_key_value($temp);
			$category = $this->configurations_model->get_configuration_by_key_value(['key' => $this->category_key, 'value' => $gig->category]);
			$genre = $this->configurations_model->get_configuration_by_key_value(['key' => $this->genre_key, 'value' => $gig->genre]);
			$gig->status_label = $status->label;
			$gig->category_label = $category->label;
			$gig->genre_label = $genre->label;
			$gig->user_name = $user->fname . ' ' . $user->lname;
			$res = $this->get_tickets_booked_and_left($gig);
			$gig->booked = $res['booked'];
			$gig->ticket_left = $res['ticket_left'];
		}
		$data['records'] = $gigs;
		// echo json_encode($data);
		// die();
		// $data['page_headings'] = "Users List";
		$this->load->view('admin/gigs/featured_gigs', $data);
		// } else {
		// 	$this->load->view('admin/no_permission_access');
		// }
	}
	function popular_gigs()
	{
		// $res_nums = $this->general_model->check_controller_method_permission_access('Admin/Users', 'index', $this->dbs_role_id, '1');
		// if ($res_nums > 0) {

		$gigs = $this->gigs_model->get_popular_gigs();
		foreach ($gigs as $gig) {
			$user = $this->users_model->get_user_by_id($gig->user_id);
			$temp = ['key' => $this->key, 'value' => $gig->status];
			$gig->popularity_data = $this->gigs_model->get_gig_popularity_data($gig->id);
			$status = $this->configurations_model->get_configuration_by_key_value($temp);
			$category = $this->configurations_model->get_configuration_by_key_value(['key' => $this->category_key, 'value' => $gig->category]);
			$genre = $this->configurations_model->get_configuration_by_key_value(['key' => $this->genre_key, 'value' => $gig->genre]);
			$gig->status_label = $status->label;
			$gig->category_label = $category->label;
			$gig->genre_label = $genre->label;
			$gig->user_name = $user->fname . ' ' . $user->lname;
			$res = $this->get_tickets_booked_and_left($gig);
			$gig->booked = $res['booked'];
			$gig->ticket_left = $res['ticket_left'];
		}
		$data['records'] = $gigs;
		// echo json_encode($data);
		// die();
		// $data['page_headings'] = "Users List";
		$this->load->view('admin/gigs/popular_gigs', $data);
		// } else {
		// 	$this->load->view('admin/no_permission_access');
		// }
	}
	function new()
	{
		// $res_nums = $this->general_model->check_controller_method_permission_access('Admin/Users', 'index', $this->dbs_role_id, '1');
		// if ($res_nums > 0) {

		$gigs = $this->gigs_model->get_new_gigs();
		foreach ($gigs as $gig) {
			$user = $this->users_model->get_user_by_id($gig->user_id);
			$temp = ['key' => $this->key, 'value' => $gig->status];
			$gig->popularity_data = $this->gigs_model->get_gig_popularity_data($gig->id);
			$status = $this->configurations_model->get_configuration_by_key_value($temp);
			$category = $this->configurations_model->get_configuration_by_key_value(['key' => $this->category_key, 'value' => $gig->category]);
			$genre = $this->configurations_model->get_configuration_by_key_value(['key' => $this->genre_key, 'value' => $gig->genre]);
			$gig->status_label = $status->label;
			$gig->category_label = $category->label;
			$gig->genre_label = $genre->label;
			$gig->user_name = $user->fname . ' ' . $user->lname;
			$res = $this->get_tickets_booked_and_left($gig);
			$gig->booked = $res['booked'];
			$gig->ticket_left = $res['ticket_left'];
		}
		$data['records'] = $gigs;
		// echo json_encode($data);
		// die();
		// $data['page_headings'] = "Users List";
		$this->load->view('admin/gigs/new_gigs', $data);
		// } else {
		// 	$this->load->view('admin/no_permission_access');
		// }
	}

	function approve_gig($gig_id = '')
	{
		if ($gig_id == '') {
			redirect('admin/gigs/new');
		}
		$data = [
			'is_approved' => 1,
			'is_rejected' => 0,
			'status' => 1
		];
		$this->gigs_model->update_gig_data($gig_id, $data);
		$this->session->set_flashdata('success_msg', 'Gig is accepted');
		redirect('admin/gigs/new');
	}

	function reject_gig()
	{
		$gig_id = $this->input->post('gig_id');
		$gig = $this->gigs_model->get_gig_by_id($gig_id);
		$user = $this->users_model->get_user_by_id($gig->user_id);
		$rejection_reason = $this->input->post('rejection_reason');
		if ($gig_id == '') {
			// redirect('admin/gigs/new');
			echo json_encode([
				'status' => false,
			]);
			die();
		}
		$data = [
			'is_approved' => 0,
			'is_rejected' => 1,
			'status' => 0,
			'rejection_reason' => $rejection_reason
		];
		log_message('info', json_encode($data));
		$this->send_email($user->email, 'Gig Rejected', $rejection_reason);
		$this->gigs_model->update_gig_data($gig_id, $data);
		$this->session->set_flashdata('deleted_msg', 'Gig is rejected');
		echo json_encode([
			'status' => true,
			'route' => 'gigs/new'
		]);
		// redirect('admin/gigs/new');
	}

	function trash($args2 = '')
	{
		// $res_nums = $this->general_model->check_controller_method_permission_access('Admin/Users', 'trash', $this->dbs_role_id, '1');
		// if ($res_nums > 0) {

		// $data['page_headings'] = "Users List";
		// echo $args2;
		// die();
		$gig = $this->gigs_model->get_gig_by_id($args2);
		@unlink("downloads/posters/thumb/$gig->poster");
		@unlink("downloads/posters/$gig->poster");
		$this->remove_tickets($args2);
		$this->remove_gig_stream($args2);
		$this->gigs_model->trash_gig($args2);
		$this->session->set_flashdata('deleted_msg', 'Gig is deleted');
		redirect('admin/gigs');
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
			$file = [];
			if (isset($_FILES['image']['tmp_name']) && $_FILES['image']['tmp_name'] != '') {
				$file = $_FILES['image'];
			}
			// echo $file['name'];
			// die();

			// form validation
			$this->form_validation->set_rules("title", "Title", "trim|required|xss_clean");
			$this->form_validation->set_rules("category", "Category", "trim|required|xss_clean");
			$this->form_validation->set_rules("genre", "Genre", "trim|required|xss_clean");
			$this->form_validation->set_rules("ticket_limit", "Goal", "trim|required|xss_clean");
			if ($this->form_validation->run() == FALSE) {
				// validation fail
				// $this->load->view('admin/users/add', $data);
				redirect('admin/gigs/add');
			} else {

				$prof_poster_error = '';
				$alw_typs = array('image/jpg', 'image/jpeg', 'image/png', 'image/gif');
				// $imagename = (isset($_POST['old_image']) && $_POST['old_image'] != '') ? $_POST['old_image'] : '';
				$imagename = '';
				// echo 'gg';
				if (isset($_FILES['poster']['tmp_name']) && $_FILES['poster']['tmp_name'] != '') {
					// echo json_encode($_FILES['poster']);
					if (!(in_array($_FILES['poster']['type'], $alw_typs))) {
						$tmp_img_type = "'" . ($_FILES['poster']['type']) . "'";
						$prof_poster_error .= "Poster type: $tmp_img_type not allowed!<br>";
						echo $prof_poster_error;
					}

					if ($prof_poster_error == '') {
						$image_path = poster_relative_path();
						$thumbnail_path = poster_thumbnail_relative_path();
						$imagename = time() . $this->general_model->fileExists($_FILES['poster']['name'], $image_path);
						$target_file = $image_path . $imagename;
						@move_uploaded_file($_FILES["poster"]["tmp_name"], $target_file);
						$width = 360;
						$height = 354;
						$thumbnail = $this->general_model->_resize_and_crop($imagename, $image_path, $thumbnail_path, $width, $height);
						if ($thumbnail == '1') {
							$thumbnail_file = $thumbnail_path . $imagename;
						}
						// echo $thumbnail;
						@move_uploaded_file($_FILES["poster"]["tmp_name"], $thumbnail_file);
					}
					if (strlen($prof_poster_error) > 0) {
						$this->session->set_flashdata('prof_poster_error', $prof_poster_error);
						redirect('admin/gigs/add');
						// $this->load->view('admin/users/add', $data);
					}
				}

				$created_on = date('Y-m-d H:i:s');
				$datas = array(
					'user_id' => $this->dbs_user_id,
					'title' => $data['title'] ?? null,
					'subtitle' => $data['subtitle'] ?? null,
					'category' => $data['category'] ?? null,
					'genre' => $data['genre'] ?? null,
					'address' => $data['address'] ?? null,
					'poster' => $imagename,
					'ticket_limit' => $data['ticket_limit'] ?? null,
					'goal_amount' => $data['goal_amount'],
					'threshold' => $data['threshold'],
					'is_overshoot' => $data['is_overshoot'] ?? 0,
					'campaign_date' => $data['campaign_date'] ? date('Y-m-d H:i:s', strtotime($data['campaign_date'])) : $created_on,
					'gig_date' => $data['campaign_date'] ? date('Y-m-d H:i:s', strtotime($data['gig_date'])) : $created_on,
					'venues' => array_key_exists('venues', $data) ? implode(',', $data['venues']) : '',
					'status' => $data['status'] ?? null,
					'created_on' => $created_on,
				);
				// echo json_encode($datas);
				// die();
				$this->update_user_data($data, $file, $this->dbs_user_id);
				// die();
				$res = $this->gigs_model->insert_gig_data($datas);

				if ($res) {
					$this->add_tickets($data, $res);
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
			// echo json_encode($data['user']);
			// die();
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

	function update_user_data($data, $file, $user_id = '')
	{
		// echo json_encode($data);
		// echo json_encode($files);
		// die();
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
			'address' => $data['user_address'],
			'country_id' => $data['country_id'],
		);

		$prf_img_error = '';
		$alw_typs = array('image/jpg', 'image/jpeg', 'image/png', 'image/gif');
		// $imagename = (isset($_POST['old_image']) && $_POST['old_image'] != '') ? $_POST['old_image'] : '';
		if (!empty($file) && isset($file['tmp_name']) && $file['tmp_name'] != '') {
			// echo json_encode($files['image']);
			// die();
			if (!(in_array($file['type'], $alw_typs))) {
				$tmp_img_type = "'" . ($file['type']) . "'";
				$prf_img_error .= "Profile image type: $tmp_img_type not allowed!<br>";
			}

			if ($prf_img_error == '') {
				$user = $this->users_model->get_user_by_id($user_id);
				@unlink("downloads/profile_pictures/thumb/$user->image");
				@unlink("downloads/profile_pictures/$user->image");
				$image_path = profile_image_relative_path();
				$thumbnail_path = profile_thumbnail_relative_path();
				$imagename = time() . $this->general_model->fileExists($file['name'], $image_path);
				$target_file = $image_path . $imagename;
				@move_uploaded_file($file["tmp_name"], $target_file);
				$width = 200;
				$height = 200;
				$thumbnail = $this->general_model->_resize_and_crop($imagename, $image_path, $thumbnail_path, $width, $height);
				if ($thumbnail == '1') {
					$thumbnail_file = $thumbnail_path . $imagename;
				}
				// echo $thumbnail;
				@move_uploaded_file($file["tmp_name"], $thumbnail_file);
				$datas['image'] = $imagename;
			}
			if (strlen($prf_img_error) > 0) {
				$this->session->set_flashdata('prof_img_error', $prf_img_error);
				redirect('admin/gigs/update');
				// $this->load->view('admin/users/add', $data);
			}
		}
		$res = $this->users_model->update_user_data($user_id, $datas);
		if (isset($res)) {
			$created_on = date('Y-m-d H:i:s');
			$this->remove_social_links($user_id);
			foreach ($social_links as $key => $value) {
				$temp = ['user_id' => $user_id, 'platform' => $key, 'url' => $value, 'created_on' => $created_on];
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

	function add_tickets($data, $gig_id)
	{
		$created_on = date('Y-m-d H:i:s');
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
				'is_unlimited' => isset($data["ticket_is_unlimited_$j"]) ? $data["ticket_is_unlimited_$j"] : 0,
				'created_on' => $created_on,
			];
			$res = $this->gigs_model->add_ticket_tier($tier);
			if ($res) {
				// echo $j;
				$this->add_ticket_bundles($data, $res, $j);
				// die();
			}
		}
	}

	function add_ticket_bundles($data, $res, $tier)
	{
		// echo json_encode($data);
		$created_on = date('Y-m-d H:i:s');
		if (isset($data["bundle_title_tier$tier"])) {
			$length = count($data["bundle_title_tier$tier"]);
			for ($i = 0; $i < $length; $i++) {
				// $j = $i + 1;
				$imagename = (isset($_POST["old_bundle_image_tier$tier"][$i]) && $_POST["old_bundle_image_tier$tier"][$i] != '') ? $_POST["old_bundle_image_tier$tier"][$i] : '';
				if (isset($_FILES["bundle_image_tier$tier"]['tmp_name'][$i]) && $_FILES["bundle_image_tier$tier"]['tmp_name'][$i] != '') {
					$image_path = bundle_relative_path();
					$thumbnail_path = bundle_thumbnail_relative_path();
					$imagename = $res . hrtime(true) . $this->general_model->fileExists($_FILES["bundle_image_tier$tier"]['name'][$i], $image_path);
					$target_file = $image_path . $imagename;
					@move_uploaded_file($_FILES["bundle_image_tier$tier"]["tmp_name"][$i], $target_file);
					$width = 200;
					$height = 200;
					$thumbnail = $this->general_model->_resize_and_crop($imagename, $image_path, $thumbnail_path, $width, $height);
					if ($thumbnail == '1') {
						$thumbnail_file = $thumbnail_path . $imagename;
					}
					// echo $thumbnail;
					@move_uploaded_file($_FILES["bundle_image_tier$tier"]["tmp_name"][$i], $thumbnail_file);
				}
				$bundle = [
					'ticket_tier_id' => $res,
					'title' => $data["bundle_title_tier$tier"][$i],
					'image' => $imagename,
					'created_on' => $created_on,
				];
				// echo json_encode($bundle);
				$this->gigs_model->add_ticket_tier_bundle($bundle);
			}
		}
	}

	function remove_tickets($gig_id)
	{
		$tickets = $this->gigs_model->get_ticket_tiers_by_gig_id($gig_id);
		if (isset($tickets) && !empty($tickets)) {
			foreach ($tickets as $ticket) {
				$bundles = $this->gigs_model->get_ticket_bundles_by_ticket_tier_id($ticket->id);
				if (isset($bundles) && !empty($bundles)) {
					foreach ($bundles as $bundle) {
						// @unlink("downloads/bundles/thumb/$bundle->image");
						// @unlink("downloads/bundles/$bundle->image");
						$this->gigs_model->remove_bundle_by_id($bundle->id);
					}
				}
				$this->gigs_model->remove_ticket_tiers_by_id($ticket->id);
			}
		}
	}

	function update($args1 = '')
	{

		// $res_nums = $this->general_model->check_controller_method_permission_access('Admin/Users', 'update', $this->dbs_role_id, '1');
		// if ($res_nums > 0) {

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
			$this->form_validation->set_rules("ticket_limit", "Goal", "trim|required|xss_clean");

			if ($this->form_validation->run() == FALSE) {
				// validation fail
				redirect('admin/gigs/update/' . $data['id']);
			} else {

				$datas = array(
					'title' => $data['title'],
					'subtitle' => $data['subtitle'] ?? null,
					'category' => $data['category'],
					'genre' => $data['genre'],
					'address' => $data['address'] ?? null,
					'ticket_limit' => $data['ticket_limit'],
					'goal_amount' => $data['goal_amount'],
					'threshold' => $data['threshold'],
					'is_overshoot' => $data['is_overshoot'] ?? 0,
					'is_featured' => $data['is_featured'],
					'is_draft' => $data['is_draft'],
					'is_exclusive' => $data['is_exclusive'],
					'campaign_date' => $data['campaign_date'] ? date('Y-m-d', strtotime($data['campaign_date'])) : null,
					'gig_date' => $data['gig_date'] ? date('Y-m-d', strtotime($data['gig_date'])) : null,
					'start_time' => $data['start_time'] ? date('H:i:s', strtotime($data['start_time'])) : null,
					'end_time' => $data['end_time'] ? date('H:i:s', strtotime($data['end_time'])) : null,
					'venues' => array_key_exists('venues', $data) ? implode(',', $data['venues']) : '',
					'status' => $data['status'] ?? null,
				);

				$prof_poster_error = '';
				$alw_typs = array('image/jpg', 'image/jpeg', 'image/png', 'image/gif');
				// $imagename = (isset($_POST['old_image']) && $_POST['old_image'] != '') ? $_POST['old_image'] : '';
				$gig = $this->gigs_model->get_gig_by_id($data['id']);
				if (isset($_FILES['poster']['tmp_name']) && $_FILES['poster']['tmp_name'] != '') {
					// echo json_encode($_FILES['image']);
					// die();
					if (!(in_array($_FILES['poster']['type'], $alw_typs))) {
						$tmp_img_type = "'" . ($_FILES['poster']['type']) . "'";
						$prof_poster_error .= "Poster type: $tmp_img_type not allowed!<br>";
					}

					if ($prof_poster_error == '') {
						@unlink("downloads/posters/thumb/$gig->poster");
						@unlink("downloads/posters/$gig->poster");
						$image_path = poster_relative_path();
						$thumbnail_path = poster_thumbnail_relative_path();
						$imagename = time() . $this->general_model->fileExists($_FILES['poster']['name'], $image_path);
						$target_file = $image_path . $imagename;
						@move_uploaded_file($_FILES["poster"]["tmp_name"], $target_file);
						$width = 360;
						$height = 354;
						$thumbnail = $this->general_model->_resize_and_crop($imagename, $image_path, $thumbnail_path, $width, $height);
						if ($thumbnail == '1') {
							$thumbnail_file = $thumbnail_path . $imagename;
						}
						// echo $thumbnail;
						@move_uploaded_file($_FILES["poster"]["tmp_name"], $thumbnail_file);
						$datas['poster'] = $imagename;
					}
					if (strlen($prof_poster_error) > 0) {
						$this->session->set_flashdata('prof_poster_error', $prof_poster_error);
						redirect('admin/gigs/update');
						// $this->load->view('admin/users/add', $data);
					}
				}
				// echo json_encode($datas);
				// die();
				$user_id = $gig->user_id;
				$file = [];
				if (isset($_FILES['image']['tmp_name']) && $_FILES['image']['tmp_name'] != '') {
					$file = $_FILES['image'];
				}
				// $this->update_user_data($data, $file, $user_id);
				$res = $this->gigs_model->update_gig_data($data['id'], $datas);
				if (isset($res)) {
					// $this->remove_tickets($data['id']);
					// $this->add_tickets($data, $data['id']);
					$this->session->set_flashdata('success_msg', 'Gig updated successfully!');
				} else {
					$this->session->set_flashdata('error_msg', 'Error: while updating gig!');
				}

				redirect("admin/gigs");
			}
		} else {
			$gig = $this->gigs_model->get_gig_by_id($args1);
			$venues = explode(',', $gig->venues);
			$gig->venues = $venues;
			$data['gig'] = $gig;
			// $param = [
			// 	'user_id' => $this->dbs_user_id,
			// 	'gig_id' => $args1
			// ];
			$tickets = $this->gigs_model->get_ticket_tiers_by_gig_id($args1);
			foreach ($tickets as $ticket) {
				$bundles = $this->gigs_model->get_ticket_bundles_by_ticket_tier_id($ticket->id);
				$ticket->bundles = $bundles;
			}
			$data['tickets'] = $tickets;
			$data['categories'] = $this->configurations_model->get_all_configurations_by_key('category');
			$data['genres'] = $this->configurations_model->get_all_configurations_by_key('genre');
			$data['status'] = $this->configurations_model->get_all_configurations_by_key('gig-status');
			$data['google_api_key'] = $this->configurations_model->get_configuration_by_key('google-address-api-key');
			$data['countries'] = $this->countries_model->get_all_countries();
			$data['user'] = $this->users_model->get_user_by_id($gig->user_id);
			$links = $this->users_model->get_social_links($gig->user_id);
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
			$this->load->view('admin/gigs/update', $data);
		}
		// } else {
		// 	$this->load->view('admin/no_permission_access');
		// }
	}

	function change_status($status = '')
	{
		$code = 'error_msg';
		$message = 'Error: Gigs status could not be changed!';
		$res = false;
		if ($status == "2") {
			$gigs = $this->gigs_model->get_today_gigs();
			if ($gigs) {
				$data = [
					'status' => $status
				];
				foreach ($gigs as $gig) {
					$res = $this->gigs_model->update_gig_data($gig->id, $data);
				}
			} else {
				$code = 'warning_msg';
				$message = 'No Gigs Found';
			}
		} else if ($status == '3') {
			$gigs = $this->gigs_model->get_previous_gigs();
			if ($gigs) {
				$data = [
					'status' => $status
				];
				foreach ($gigs as $gig) {
					$res = $this->gigs_model->update_gig_data($gig->id, $data);
				}
			} else {
				$code = 'warning_msg';
				$message = 'No Gigs Found';
			}
		}
		if ($res) {
			$code = 'success_msg';
			$message = 'Gigs status changed!';
		}
		$this->session->set_flashdata($code, $message);
		redirect("admin/gigs");
	}

	function remove_gig_stream($gig_id)
	{
		$this->gigs_model->remove_gig_stream($gig_id);
	}

	function get_tickets_booked_and_left($gig)
	{
		// echo json_encode($gig);
		// die();
		$cart_items = $this->bookings_model->get_booking_items_by_gig_id($gig->id);
		$ticket_bought = 0;
		foreach ($cart_items as $item) {
			$ticket_bought += $item->quantity;
		}
		$param['ticket_left'] = $gig->ticket_limit - $ticket_bought;
		$param['booked'] = $ticket_bought / $gig->ticket_limit * 100;
		return $param;
	}
	/* users functions ends */

	// function update_gig_data()
	// {
	// 	$data = $this->input->post();
	// 	echo json_encode($data);
	// }

	function streaming_details($gig_id)
	{
		$gig = $this->gigs_model->get_gig_by_id($gig_id);
		$stream_details = $this->gigs_model->get_stream_details($gig_id);
		$data = [
			'gig' => $gig,
			'stream_details' => $stream_details,
		];
		$this->load->view('admin/gigs/stream_details', $data);
	}

	function send_email($to_email, $subject, $reason = '')
	{
		$this->load->library('email');
		$from_email = $this->config->item('info_email');
		$from_name = $this->config->item('from_name');

		$data['reason'] = $reason;
		$msg = $this->load->view('email/gig_rejected', $data, TRUE);

		$this->email->from($from_email, $from_name);
		$this->email->to($to_email);
		$this->email->subject($subject);
		$this->email->message($msg);
		//Send mail
		if ($this->email->send()) {
			return true;
		} else {
			return false;
		}
	}
}
