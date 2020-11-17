<?php
	defined('BASEPATH') OR exit('No direct script access allowed'); 
	class Apis_model extends CI_Model {
			   
		private $giftango_api_url = 'https://api.giftango.com/'; // 'https://api.giftango.com/';
		private $giftango_api_login_email = 'bamboo'; //'bambootest';
		private $giftango_api_login_password = 'UzM[pfq*@z4iA_jq=&[NRk%>MEixrUWe'; //'Bamb00LIVEKEY~'; //'RQXX2nOOv;Usz9aO:q)Ja)9t-?TwG2D=';   
		  
		/*	Alder Credentials 
		Account: Bamboo [AUD]
		ClientID: bamboo
		ProgramID(s): 6075
		Domain: https://api.giftango.com/ */
 	
	
		/*private $giftango_api_url = 'https://api.giftango.com/';
		private $giftango_api_login_email = 'bambootest';
		private $giftango_api_login_password = 'RQXX2nOOv;Usz9aO:q)Ja)9t-?TwG2D=';  
		
		
		private $ngc_api_url = 'https://api-test.ngcprograms.com/v2/'; 
		private $ngc_api_login_email = 'bambootest162551';
		private $ngc_api_login_password = 'dY0*7cd!PC98%q5q!LI3'; */
		
	
		private $ngc_api_url = 'https://api.ngcprograms.com/v2/'; 
		private $ngc_api_login_email = 'bamboomarketing162551'; //'bamboomarketing162551';
		private $ngc_api_login_password = 'h8nB5UE6t%NMVPU3W8e&'; //'uC#1KJ4HhA17sJHE%bCg';   
		
		
		private $tango_card_url = 'https://api.tangocard.com/raas/v2/'; 
		private $tango_card_login_email = 'bamboo';
		private $tango_card_login_password = 'GPAfBGgypclNxwouftB&BxEVzkPhVw?MZRtciJoqbcvr';  
		 
		/*private $tango_card_url = 'https://integration-api.tangocard.com/raas/v2/'; 
		private $tango_card_login_email = 'bambooapitest';
		private $tango_card_login_password = '$iJgK&Zncv@HddBWFXZdIFqJJiXbYKBqOdgHGMxfQVS';*/
		 
		 
		function __construct() {
			parent::__construct();  
		} 
		
		/* giftango functions starts */
		public function generate_giftango_access_token(){ 
		 
			$status = true;
			$response = array();  
			try {
				$curl = curl_init();
	
				$headers = array('Content-Type: application/x-www-form-urlencoded');
	
				/*$giftango_data = 'grant_type=client_credentials&client_id='.$this->giftango_api_login_email.'&client_secret=' . $this->giftango_api_login_password;*/
				
				
				$postData = array('grant_type' => 'client_credentials', 'client_id' => $this->giftango_api_login_email, 'client_secret' => $this->giftango_api_login_password);
				
				
				curl_setopt($curl, CURLOPT_URL, $this->giftango_api_url . 'auth/token');
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curl, CURLOPT_TIMEOUT, 10);
				curl_setopt($curl, CURLOPT_POST, true);
				//curl_setopt($curl, CURLOPT_POSTFIELDS, $giftango_data);
				curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postData));
				curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	
				$response = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);
				if ($err) {
					$status = false;
					return $status;
				} else {
					$response = json_decode($response);
					return $response;
					//$token = $response->access_token;
					//print_r($response);
				 
				}
			} catch (\Exception $e) {
				$status = false;
				return $status;
			}
		}
		
		
		public function get_giftango_catalogs($giftango_access_token) {
 
			$curl = curl_init();
	
			$headers = array('Content-Type: application/json', 'accept: application/json', 'Authorization: Bearer ' . $giftango_access_token); 
			 
			curl_setopt($curl, CURLOPT_URL, 'https://app.giftango.com/programs/programs/6075/catalogs/1');//6066  6075  6066
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_TIMEOUT, 10);
	 
			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	
			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);
	 
			if ($err) {
				return $err;
			} else {
			   return $response; 
			}
		}
		
		public function order($unique_ord_id, $sku_val, $amount, $giftango_access_token, $quantity_vl, $expiry_date) { 
		 
			try {
				$curl = curl_init();
			
				$headers = array('Content-Type: application/json', 'accept: application/json', 'ProgramId: 6075', 'Authorization: Bearer '.$giftango_access_token); 
				//6066  
					
				$ord_data = json_encode( array("CustomerOrderId" => $unique_ord_id, "saleBeforeDate" => $expiry_date,
					"Recipients" => [[ 
						"FirstName" => "Ruben",
						"LastName" => "Mikayelyan",
						"EmailAddress" => "rubmiq@bk.ru",
						"DeliverEmail" => FALSE, 
						"Products" => [array( "Sku" => "$sku_val", "Value" => $amount, "Quantity" => $quantity_vl,"saleBeforeDate" => $expiry_date)]
					]]));
	
	
				curl_setopt($curl, CURLOPT_URL, $this->giftango_api_url . 'orders');
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curl, CURLOPT_TIMEOUT, 10);
				curl_setopt($curl, CURLOPT_POST, true);
				curl_setopt($curl, CURLOPT_POSTFIELDS, $ord_data);
				curl_setopt($curl, CURLOPT_HEADER, 1);
				curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	
				$response = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);
	
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				 
				return $response;
				
				/*$HH = $this->get_headers_from_curl_response($response);
				  
				$giftango_url_order = $this->giftango_url.'orders/';	
				
				$order_uri = str_replace("$giftango_url_order", '', $HH['Location']);
				sleep(5);
			   // echo $order_uri;
				$card = $this->get_order($order_uri, $giftango_access_token);
	//            echo $HH['Location']."/n";
				//echo $order_uri;
				return $card;*/
			} catch (\Exception $e) {
				$this->status = false;
			}
		} 
		
		public function get_order($uri, $giftango_access_token) {
			$curl = curl_init();
	
			$headers = array('Content-Type: application/json', 'accept: application/json', 'Authorization: Bearer ' . $giftango_access_token);
	
	// echo '<pre>';
	//            echo 'Request';
	//            echo 'URL: '.$this->appurl . 'programs/programs/6066/catalogs/1 ';
	//            echo 'Headers:';
	//            print_r($headers);
	//            echo 'Body';
	//            print_r($data);
	
			curl_setopt($curl, CURLOPT_URL, $this->giftango_api_url . 'cards/order/' . $uri);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_TIMEOUT, 10);
	
	//            curl_setopt($curl, CURLOPT_POST, true);
	//            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			curl_setopt($curl, CURLOPT_HEADER, 1);
			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	
			$response = curl_exec($curl);
			$info = curl_getinfo($curl);
			
			$err = curl_error($curl);
			curl_close($curl);
			if ($err) {
				return $err;
			} else {
			 
	
				$response = [
				  'headers' => substr($response, 0, $info["header_size"]),
				  'body' => substr($response, $info["header_size"]),
				];
				
	
				return $response;
			}
		}
	
	
		function get_all_giftango_catalog_data_track(){ 
		   //$this->db->order_by("product_name", "asc");
		   $query = $this->db->get('apis_giftango_catelogs_tbl');
		   return $query->result();
		} 
		
		
		function get_all_giftango_catalog_distinct_data_track(){ 
			$query = $this->db->query("SELECT * FROM apis_giftango_catelogs_tbl GROUP BY brand_name ORDER BY brand_name ASC");
			return $query->result(); 
		} 
		
		
		function get_all_giftango_catalog_by_brand_name($sl_brand_name_vl){ 
		
			if(strlen($sl_brand_name_vl)>0){
				$query = $this->db->query('SELECT * FROM apis_giftango_catelogs_tbl WHERE brand_name="'.$sl_brand_name_vl.'" ORDER BY min_amount ASC');
				return $query->result(); 				
			}else{
				return false;
			}	 
		} 
		
		function get_all_giftango_catalog_by_brnd_name_and_demoniation_val($sl_brnd_name_vl, $sl_demoniation_name_vl){ 
		
			if(strlen($sl_brnd_name_vl)>0 && strlen($sl_demoniation_name_vl)>0){
				$query = $this->db->query('SELECT * FROM apis_giftango_catelogs_tbl WHERE brand_name="'.$sl_brnd_name_vl.'" AND ( min_amount="'.$sl_demoniation_name_vl.'" OR ( min_amount<="'.$sl_demoniation_name_vl.'" AND max_amount>="'.$sl_demoniation_name_vl.'" ) )');
				return $query->row();  
				 		
			}else{
				return false;
			}	 
		} 
		 
		
		function get_giftango_catalog_data_track_by_sku($sku_vl){ 
			if(strlen($sku_vl)>0){
				$query = $this->db->get_where('apis_giftango_catelogs_tbl',array('product_sku'=> $sku_vl));
				return $query->row();
			}else{
				return false;
			}
		}
		
		function get_giftango_catalog_data_track_by_id($id_vl){ 
			if($id_vl >0){
				$query = $this->db->get_where('apis_giftango_catelogs_tbl',array('id'=> $id_vl));
				return $query->row();
			}else{
				return false;
			}
		}
		
		function insert_giftango_catalog_data_track($data){ 
			return $this->db->insert('apis_giftango_catelogs_tbl', $data);
		} 
		
		function update_giftango_catalog_data_track_by_sku($sku_vl,$data){ 
			if(strlen($sku_vl)>0){
				$this->db->where('product_sku',$sku_vl);
				return $this->db->update('apis_giftango_catelogs_tbl', $data);
			} 
		}
		
		function update_giftango_catalog_data_track_by_id($id_vl,$data){ 
			if($id_vl>0){
				$this->db->where('id',$id_vl);
				return $this->db->update('apis_giftango_catelogs_tbl', $data);
			} 
		}  
		
		function trash_giftango_catalog_data_track_by_id($id_vl){
			if($id_vl >0){
				//$this->db->where('id', $args2); 
				
				$del_array = array('id=' => $id_vl); 
				$this->db->where($del_array);
				
				$this->db->delete('apis_giftango_catelogs_tbl');
			} 
			return true;
		}  
	
	/* giftango functions ends */	
		
		/* ngc functions ends */
		public function get_ngc_inventory() { 
			$curl = curl_init(); 
			$headers = array('Content-Type: application/json', 'accept: application/json');
	 		 
			curl_setopt($curl, CURLOPT_URL, $this->ngc_api_url.'inventory'); // ping   //vendor
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_TIMEOUT, 10);
			curl_setopt($curl, CURLOPT_USERPWD, $this->ngc_api_login_email . ":" . $this->ngc_api_login_password);
			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	 
			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);
	
			if ($err) {
				return $err;
			} else {  
				return $response;
			} 
		} 
		
		public function get_ngc_api_card_by_audit_number($audit_num_paras) {
 
			$curl = curl_init();
			$headers = array('Content-Type: application/json', 'accept: application/json');
			// $data = ['username' => $this->email, 'password' => $this->password];
			curl_setopt($curl, CURLOPT_URL, $this->ngc_api_url.'giftcard?auditNumber='.$audit_num_paras);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	
			curl_setopt($curl, CURLOPT_TIMEOUT, 10); 
			// curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_USERPWD, $this->ngc_api_login_email . ":" . $this->ngc_api_login_password);
			// curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	 
			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);
	
			if ($err) {
				return $err;
			} else {
				//return $response; 
				return json_decode($response); 
			}
		}
		
		function get_all_ngc_catalog_data_track(){ 
		   //$this->db->order_by("product_name", "asc");
		   $query = $this->db->get('apis_ngc_catelogs_tbl');
		   return $query->result();
		}  
		
		function get_ngc_catalog_data_track_by_code($code_vl){ 
			if(strlen($code_vl)>0){
				$query = $this->db->get_where('apis_ngc_catelogs_tbl',array('brand_code' => $code_vl));
				return $query->row();
			}else{
				return false;
			}
		}
		
		function get_ngc_catalog_data_track_by_id($id_vl){ 
			if($id_vl >0){
				$query = $this->db->get_where('apis_ngc_catelogs_tbl',array('id'=> $id_vl));
				return $query->row();
			}else{
				return false;
			}
		}
		
		function insert_ngc_catalog_data_track($data){ 
			return $this->db->insert('apis_ngc_catelogs_tbl', $data);
		} 
		
		function update_ngc_catalog_data_track_by_code($code_vl,$data){ 
			if(strlen($code_vl)>0){
				$this->db->where('brand_code',$code_vl);
				return $this->db->update('apis_ngc_catelogs_tbl', $data);
			} 
		}
		
		function update_ngc_catalog_data_track_by_id($id_vl,$data){ 
			if($id_vl>0){
				$this->db->where('id',$id_vl);
				return $this->db->update('apis_ngc_catelogs_tbl', $data);
			} 
		}  
		
		function trash_ngc_catalog_data_track_by_id($id_vl){
			if($id_vl >0){
				//$this->db->where('id', $args2); 
				
				$del_array = array('id=' => $id_vl); 
				$this->db->where($del_array);
				
				$this->db->delete('apis_ngc_catelogs_tbl');
			} 
			return true;
		}
		
		
		
			/* ngc sub items starts */
			function get_all_ngc_catalog_sub_items_data_track(){ 
			   //$this->db->order_by("product_name", "asc");
			   $query = $this->db->get('apis_ngc_catelog_items_fixed_values_tbl');
			   return $query->result();
			} 
			
			function get_ngc_catalog_sub_items_data_track_by_catelog_item_id($catelog_item_id){ 
				if($catelog_item_id>0){
					$query = $this->db->get_where('apis_ngc_catelog_items_fixed_values_tbl',array('catelog_item_id'=> $catelog_item_id));
					return $query->result();
				}else{
					return false;
				}
			}
			
			function get_ngc_catalog_sub_items_data_track_by_id($id_vl){ 
				if($id_vl >0){
					$query = $this->db->get_where('apis_ngc_catelog_items_fixed_values_tbl',array('id'=> $id_vl));
					return $query->row();
				}else{
					return false;
				}
			}
			
			
			function insert_ngc_catalog_sub_items_data_track($data2){ 
				return $this->db->insert('apis_ngc_catelog_items_fixed_values_tbl', $data2);
			} 
			
			function trash_ngc_catalog_sub_items_data_brand_id($id_vl){
				if($id_vl >0){
					 $this->db->query("delete from apis_ngc_catelog_items_fixed_values_tbl where catelog_item_id='".$id_vl."' ");
				} 
				return true;
			} 
			
			function trash_ngc_catalog_sub_items_data_id($id_vl){
				if($id_vl >0){
					 $this->db->query("delete from apis_ngc_catelog_items_fixed_values_tbl where id='".$id_vl."' ");
				} 
				return true;
			} 
			/* ngc sub items ends */  
		
		 /* ngc functions ends */
		 
		 
		/* tango cards functions ends */
		public function get_tangocard_catelog() {
			
			$curl = curl_init();
			$headers = array('Content-Type: application/json', 'accept: application/json'); 
			curl_setopt($curl, CURLOPT_URL, $this->tango_card_url.'catalogs?verbose=true');
			
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			
			curl_setopt($curl, CURLOPT_TIMEOUT, 10);
			// curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_USERPWD, $this->tango_card_login_email . ":" . $this->tango_card_login_password);
			//curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
			//
			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);
			
			if ($err) {
				return $err;
			} else {
				return $response; 
			} 
		}
		
		
		function get_all_tangocard_catalog_data_track(){ 
		   //$this->db->order_by("product_name", "asc");
		   $query = $this->db->get('apis_tangocards_catelogs_tbl');
		   return $query->result();
		}  
		
		function get_tangocard_catalog_data_track_by_key($key_vl){ 
			if(strlen($key_vl)>0){
				$query = $this->db->get_where('apis_tangocards_catelogs_tbl',array('brand_key' => $key_vl));
				return $query->row();
			}else{
				return false;
			}
		}
		
		function get_tangocard_catalog_data_track_by_id($id_vl){ 
			if($id_vl >0){
				$query = $this->db->get_where('apis_tangocards_catelogs_tbl',array('id'=> $id_vl));
				return $query->row();
			}else{
				return false;
			}
		}
		
		function insert_tangocard_catalog_data_track($data){ 
			return $this->db->insert('apis_tangocards_catelogs_tbl', $data);
		} 
		
		function update_tangocard_catalog_data_track_by_key($key_vl,$data){ 
			if(strlen($key_vl)>0){
				$this->db->where('brand_key',$key_vl);
				return $this->db->update('apis_tangocards_catelogs_tbl', $data);
			} 
		}
		
		function update_tangocard_catalog_data_track_by_id($id_vl,$data){ 
			if($id_vl>0){
				$this->db->where('id',$id_vl);
				return $this->db->update('apis_tangocards_catelogs_tbl', $data);
			} 
		}  
		
		function trash_tangocard_catalog_data_track_by_id($id_vl){
			if($id_vl >0){
				//$this->db->where('id', $args2); 
				
				$del_array = array('id=' => $id_vl); 
				$this->db->where($del_array);
				
				$this->db->delete('apis_tangocards_catelogs_tbl');
			} 
			return true;
		}

	
		
			/* tangocard sub items starts */
			function get_all_tangocard_catalog_sub_items_data_track(){ 
			   //$this->db->order_by("product_name", "asc");
			   $query = $this->db->get('apis_tangocards_catelog_items_tbl');
			   return $query->result();
			} 
			
			function get_tangocard_catalog_sub_items_data_track_by_catelog_item_id($catelog_item_id){ 
				if($catelog_item_id>0){
					$query = $this->db->get_where('apis_tangocards_catelog_items_tbl',array('catelog_item_id'=> $catelog_item_id));
					return $query->result();
				}else{
					return false;
				}
			}
			
			function get_tangocard_catalog_sub_items_data_track_by_id($id_vl){ 
				if($id_vl >0){
					$query = $this->db->get_where('apis_tangocards_catelog_items_tbl',array('id'=> $id_vl));
					return $query->row();
				}else{
					return false;
				}
			}
			
			function get_tangocard_catalog_sub_items_data_track_by_utid($utid_vl){ 
				if(strlen($utid_vl) >0){
					$query = $this->db->get_where('apis_tangocards_catelog_items_tbl',array('utid' => $utid_vl));
					return $query->row();
				}else{
					return false;
				}
			}
			
			
			function insert_tangocard_catalog_sub_items_data_track($data2){ 
				return $this->db->insert('apis_tangocards_catelog_items_tbl', $data2);
			} 
			
			function trash_tangocard_catalog_sub_items_data_brand_id($id_vl){
				if($id_vl >0){
					 $this->db->query("delete from apis_tangocards_catelog_items_tbl where catelog_item_id='".$id_vl."' ");
				} 
				return true;
			} 
			
			function trash_tangocard_catalog_sub_items_data_id($id_vl){
				if($id_vl >0){
					 $this->db->query("delete from apis_tangocards_catelog_items_tbl where id='".$id_vl."' ");
				} 
				return true;
			} 
			
			function get_brands_suppliers_by_m_paras($code_creation_by, $supplier_id, $brand_id){  
				if($code_creation_by>'0' && $supplier_id>'0' && $brand_id>'0'){
					$query = $this->db->get_where('brands_suppliers_api_tbl',array('api_brand_type' => $code_creation_by, 'supplier_id' => $supplier_id, 'brand_id' => $brand_id));
					return $query->row();
				}else{
					return '';
				}
			}  
			
			function get_tangocard_by_brand_id_and_denomination_val($brvd_id_vl,$denomiatoin_vl){  
				if($brvd_id_vl>'0' && $denomiatoin_vl>'0'){
					$query = $this->db->get_where('apis_tangocards_catelog_items_tbl',array('catelog_item_id' => $brvd_id_vl, 'face_value' => $denomiatoin_vl));
					return $query->row();
				}else{
					return '';
				}
			}
			
			/* tangocard sub items ends */  
		
		 /* tango cards functions ends */ 
		 
						
	}  ?>