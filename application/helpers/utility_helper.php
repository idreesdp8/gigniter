<?php 
	
	function admin_asset_url(){
	   return base_url().'backend_assets/';
	} 
	
	function assets_url(){
	   return base_url().'assets/';
	}  

	function product_image_url(){
	   return base_url().'downloads/products_images/';
	}  

	function product_thumbnail_image_url(){
	   return base_url().'downloads/products_images/thumb/';
	}  
	
	function admin_base_url(){
		return base_url().'index.php/admin/';
	}
	
	function profile_image_relative_path(){
		return 'downloads/profile_pictures/';
	}

	function profile_thumbnail_relative_path(){
		return 'downloads/profile_pictures/thumb/';
	}

	function profile_image_url(){
		return base_url().profile_image_relative_path();
	}

	function profile_thumbnail_image_url(){
		return base_url().profile_thumbnail_relative_path();
	}

?>