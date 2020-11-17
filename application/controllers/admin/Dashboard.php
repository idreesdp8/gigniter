<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Dashboard extends CI_Controller{

		public function __construct(){
			parent::__construct();
			
			$this->dbs_user_id = $vs_id = $this->session->userdata('us_id');
			$this->login_usr_role_id = $this->dbs_user_role_id = $vs_user_role_id = $this->session->userdata('us_role_id');
			$this->load->model('admin/general_model', 'general_model');
			if(isset($vs_id) && (isset($vs_user_role_id) && $vs_user_role_id>=1)){
			// 	/* ok */
				
			// 	$res_nums = $this->general_model->check_controller_permission_access('Admin/Dashboard',$vs_user_role_id,'1');
			// 	if($res_nums>0){
			// 		/* ok */
			// 	}else{
			// 		redirect('/');
			// 	} 
				
			}else{
				redirect('admin/login');
			}
			 
			$this->load->model('admin/dashboard_model', 'dashboard_model');  
			$this->load->model('admin/admin_model', 'admin_model');   
			$this->load->library('Ajax_pagination');
			$this->perPage = 12;
		}  
		
		
		
		function index(){
			// $res_nums = $this->general_model->check_controller_method_permission_access('Admin/Dashboard','index',$this->dbs_user_role_id,'1');  
			// if($res_nums>0){  
				 
				$this->load->view('admin/dashboard/index');
				
			//  }else{ 
			// 	$this->load->view('admin/no_permission_access'); 
			// }
		} 
		
		function index11(){
			$res_nums = $this->general_model->check_controller_method_permission_access('Dashboard','index',$this->dbs_user_role_id,'1');  
			if($res_nums>0){
			  	$this->load->model('admin/codes_model','codes_model');
				$datas = array();
				$datas['page_headings']="Dashboard"; 
				 
				
				$paras_arrs = array();	
				
				$vs_id = 0; //$this->session->userdata('us_id'); 
				/*$paras_arrs = array_merge($paras_arrs, array("client_id_val" => $vs_id));*/
				$paras_arrs = array_merge($paras_arrs, array("limit" => 20));
				
				$datas['total_sum_of_spending_revenue'] = $this->codes_model->get_client_total_sum_of_codes_spendings($vs_id); 
				 
				$datas['total_count_of_spending_revenue'] = $this->codes_model->get_client_total_count_of_codes_spendings_by_statuses($vs_id,'0');
				$datas['active_count_of_spending_revenue'] = $this->codes_model->get_client_total_count_of_codes_spendings_by_statuses($vs_id,'1');
				$datas['expired_count_of_spending_revenue'] = $this->codes_model->get_client_total_count_of_codes_spendings_by_statuses($vs_id,'2');
				$datas['redeem_count_of_spending_revenue'] = $this->codes_model->get_client_total_count_of_codes_spendings_by_statuses($vs_id,'3');
				
				   
				$datas['records'] = $this->codes_model->get_all_filter_codes($paras_arrs); 
				 
				$this->load->view('admin/dashboard/index',$datas);
				
			 }else{ 
				$this->load->view('admin/no_permission_access'); 
			}
		}  
		
		/* brands controller starts */
		function index111(){
		
			$res_nums =  $this->general_model->check_controller_method_permission_access('Dashboard','index',$this->login_usr_role_id,'1'); 
			if($res_nums>0){    
				$this->load->model('suppliers_model'); 
				$this->load->model('currencies_model'); 
				$this->load->model('denominations_model'); 
				$data['suppliers_rows'] = $this->suppliers_model->get_all_suppliers();
				$data['currencies_rows'] = $this->currencies_model->get_all_currencies();
				$data['denominations_rows'] = $this->denominations_model->get_all_denominations(); 
				$paras_arrs = array();	
				 
				if($this->input->post('sel_per_page_val')){
					$per_page_val = $this->input->post('sel_per_page_val'); 
					$_SESSION['tmp_per_page_val'] = $per_page_val;  
					
				}else if(isset($_SESSION['tmp_per_page_val'])){
						unset($_SESSION['tmp_per_page_val']);
					} 
				
				if($this->input->post('s_val')){
					$s_val = $this->input->post('s_val'); 
					$_SESSION['tmp_s_val'] = $s_val;
					$paras_arrs = array_merge($paras_arrs, array("s_val" => $s_val));
					
				}else if(isset($_SESSION['tmp_s_val'])){
						unset($_SESSION['tmp_s_val']);
					}   
					 
				
				if(isset($_SESSION['tmp_per_page_val'])){
					$show_pers_pg = $_SESSION['tmp_per_page_val'];	 
				}else{
					$show_pers_pg = $this->perPage;
				}
				 
				//total rows count
				$totalRec = count($this->brands_model->get_all_filter_brands($paras_arrs));
				
				//pagination configuration
				$config['target']      = '#dyns_list';
				$config['base_url']    = site_url('/client/dashboard/index2');
				$config['total_rows']  = $totalRec;
				$config['per_page']    = $show_pers_pg; //$this->perPage;
				$config['uri_segment']    = 4; 
				
				$this->ajax_pagination->initialize($config); 
				
				$paras_arrs = array_merge($paras_arrs, array("limit" => $show_pers_pg));
				/*echo "<pre>";
				print_r($paras_arrs); 
				echo "</pre>";
				exit;*/
				$data['page_headings'] = "Dashboard - Brands List";
				
				$records = $data['records'] = $this->brands_model->get_all_filter_brands($paras_arrs); 
				
				$this->load->view('admin/dashboard/index',$data); 
			}else{ 
				$this->load->view('admin/no_permission_access'); 
			}	 
		} 
	
		function index2222(){
			$res_nums =  $this->general_model->check_controller_method_permission_access('Dashboard','index',$this->login_usr_role_id,'1'); 
			if($res_nums>0){
			
				$data['page_headings'] = "Dashboard - Brands List";
		
				$paras_arrs = array();	
				$page = $this->input->post('page');
				if(!$page){
					$offset = 0;
				}else{
					$offset = $page;
				} 
				
				$data['page'] = $page;
					
				if($this->input->post('sel_per_page_val')){
					$per_page_val = $this->input->post('sel_per_page_val'); 
					$_SESSION['tmp_per_page_val'] = $per_page_val;  
					
				}else if(isset($_SESSION['tmp_per_page_val'])){
						$per_page_val = $_SESSION['tmp_per_page_val'];
					} 	  
					
				if(isset($_POST['s_val'])){
					$s_val = $this->input->post('s_val'); 
					if(strlen($s_val)>0){
						$_SESSION['tmp_s_val'] = $s_val;
						$paras_arrs = array_merge($paras_arrs, array("s_val" => $s_val)); 
					}else{
						unset($_SESSION['tmp_s_val']);
					}
					
				}else if(isset($_SESSION['tmp_s_val'])){
					$s_val = $_SESSION['tmp_s_val']; 
					$paras_arrs = array_merge($paras_arrs, array("s_val" => $s_val));
				}  
					  
				if(isset($_SESSION['tmp_per_page_val'])){
					$show_pers_pg = $_SESSION['tmp_per_page_val'];	 
				}else{
					$show_pers_pg = $this->perPage;
				}
				 
				//total rows count
				$totalRec = count($this->brands_model->get_all_filter_brands($paras_arrs)); 
				
				//pagination configuration
				$config['target']      = '#dyns_list';
				$config['base_url']    = site_url('/client/dashboard/index2');
				$config['total_rows']  = $totalRec;
				$config['per_page']    = $show_pers_pg; //$this->perPage;
				$config['uri_segment']    = 4; 
				
				$this->ajax_pagination->initialize($config); 
				
				$paras_arrs = array_merge($paras_arrs, array('start' => $offset, 'limit'=> $show_pers_pg));
				
			   $data['records'] = $this->brands_model->get_all_filter_brands($paras_arrs); 
				 
				$this->load->view('admin/dashboard/index2',$data); 
			}else{ 
				$this->load->view('admin/no_permission_access'); 
			}
		}
	
		
		function view_code_data($paras1=''){  
		 
			$res_nums =  $this->general_model->check_controller_method_permission_access('Codes','index',$this->login_usr_role_id,'1'); 
			if($res_nums>0){    
				if($paras1>0){  
					$data['page_headings'] = "View Code";
					
					$this->load->model('codes_model');
					
					$data['record'] = $this->codes_model->get_code_with_brand_denomination_by_id($paras1);  
					 
					$this->load->view('admin/dashboard/view_code_data',$data); 
					
				}else{
					$this->load->view('admin/no_permission_access'); 
				} 
			}else{ 
				$this->load->view('admin/no_permission_access'); 
			}
		}   
	
	}
?>
