<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Email_templates extends CI_Controller{ 
		   
		public function __construct(){
			parent::__construct();
			$is_logged_in = $this->session->userdata('us_login');
			if (!$is_logged_in) {
				redirect("admin/login");
			}
			$vs_user_role_name = $this->session->userdata('us_role_name');
			if(isset($vs_user_role_name)){
				if($vs_user_role_name!='Admin'){
					redirect('dashboard');
				}
			}
			 
			$this->login_usr_id = $vs_id = $this->session->userdata('us_id');
			$this->login_usr_role_id = $vs_role_id = $this->session->userdata('us_role_id');
			
			$this->load->model('admin/general_model', 'general_model'); 
			$this->load->model('admin/email_templates_model', 'email_templates_model'); 
			$this->load->model('admin/permissions_model', 'permissions_model');
			$this->load->model('admin/gigs_model', 'gigs_model');
			$this->load->model('admin/admin_model', 'admin_model'); 
			$this->load->library('Ajax_pagination');
			$this->perPage = 25;
		}   
		  
		/* Email_templates controller starts */
		function index(){      
			//total rows count 
			$data['page_headings'] = "Email Templates List";
			$params = array();
			
			if(isset($_POST['search']) && strlen($_POST['search'])>0){
				$search_val = $_POST['search'];
				$params = array('s_val' => $search_val);
			}
			
			$data['records'] = $this->email_templates_model->get_all_filter_email_templates($params); 
			$this->load->view('admin/email_templates/index',$data);   
		}  
	 
		function trash($paras1=''){  
		
			 if($paras1 >0){    
				$res = $this->email_templates_model->trash_email_template($paras1);   
				if(isset($res)){
					$this->session->set_flashdata('success_msg','Record deleted successfully!');
				}else{
					$this->session->set_flashdata('error_msg','Error: Unable to delete record, please try again!');
				}  	
			 }else{
				$this->session->set_flashdata('error_msg','Error: Unable to delete record, please try again!');
			}   
			 
			 redirect("admin/email_templates/index");	 
		} 
		
		 
	
		function add(){
		
			$data['page_headings'] = 'Add Email Template'; 
			if(isset($_POST) && !empty($_POST)){  
				// get form input
				$recipients = $this->input->post("recipients");  
				$subject = $this->input->post("subject");
				$template_slug = $this->input->post("template_slug");
				$content = $this->input->post("content");    
				$added_on = $updated_on = date('Y-m-d H:i:s');  
				
				// form validation
				$this->form_validation->set_rules("recipients", "Recipients", "trim|required|xss_clean");
				$this->form_validation->set_rules("subject", "Subject", "trim|required|xss_clean");
				$this->form_validation->set_rules("template_slug", "Template Slug", "trim|required|xss_clean");  
				$this->form_validation->set_rules("content", "Content", "trim|required|xss_clean"); 
				
				if($this->form_validation->run() == FALSE){
				// validation fail
					$this->load->view('admin/email_templates/add',$data); 
				}else{    
					
					$datas = array('recipients' => $recipients,'subject' => $subject, 'template_slug' => $template_slug,'content' => $content,'added_on' => $added_on,'updated_on' => $updated_on); 
					$res = $this->email_templates_model->insert_email_template_data($datas); 
					if(isset($res)){   
				
						$this->session->set_flashdata('success_msg','Record inserted successfully!');
					}else{
						$this->session->set_flashdata('error_msg','Error: while inserting record!');
					}  
					
					redirect("admin/email_templates/index");	 
				} 	 
				
			}else{
				$this->load->view('admin/email_templates/add',$data);
			} 
		}  
	
	
	 	function update($args1=''){   
			$data['page_headings'] = 'Update Email Template'; 
			if(isset($args1) && $args1!=''){ 
				$data['args1'] = $args1; 
				$data['record'] = $this->email_templates_model->get_email_templates_by_id($args1);
			}
			
			if(isset($_POST) && !empty($_POST)){ 
				// get form input
				$recipients = $this->input->post("recipients");  
				$subject = $this->input->post("subject");
				$template_slug = $this->input->post("template_slug");
				$content = $this->input->post("content");   
				$updated_on = date('Y-m-d H:i:s');  
				
				// form validation
				$this->form_validation->set_rules("recipients", "Recipients", "trim|required|xss_clean");
				$this->form_validation->set_rules("subject", "Subject", "trim|required|xss_clean");
				$this->form_validation->set_rules("template_slug", "Template Slug", "trim|required|xss_clean");  
				$this->form_validation->set_rules("content", "Content", "trim|required|xss_clean"); 
			  
				if($this->form_validation->run() == FALSE){
					// validation fail
					$this->load->view('admin/email_templates/update',$data);
				}else if(isset($args1) && $args1!=''){   
				
					$datas = array('recipients' => $recipients,'subject' => $subject, 'template_slug' => $template_slug,'content' => $content,'updated_on' => $updated_on);  
					$res = $this->email_templates_model->update_email_template_data($args1, $datas); 
					if(isset($res)){    
						$this->session->set_flashdata('success_msg','Record updated successfully!');
					}else{
						$this->session->set_flashdata('error_msg','Error: while updating record!');
					} 
					
					redirect("admin/email_templates/index");
				} 	 
				
			}else{
				$this->load->view('admin/email_templates/update',$data);
			}  
		}  
	
	
		function view($paras1=''){
			$data['page_headings'] = "View Email Template";	     
			$data['record'] = $this->email_templates_model->get_email_template_by_id($paras1);   
			$this->load->view('admin/email_templates/view_email_template_data',$data); 
		} 
	
		 
		/* Email Templates controller ends */
	 		
	}
	?>