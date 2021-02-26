<?php 
	
	function admin_asset_url(){
	   return base_url().'backend_assets/';
	} 
	
	function user_asset_url(){
	   return base_url().'frontend_assets/';
	} 
	
	// function assets_url(){
	//    return base_url().'assets/';
	// }  

	function product_image_url(){
	   return base_url().'downloads/products_images/';
	}  

	function product_thumbnail_image_url(){
	   return base_url().'downloads/products_images/thumb/';
	}  
	
	function admin_base_url(){
		return base_url().'admin/';
	}
	
	function user_base_url(){
		return base_url().'index.php/';
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
	
	function poster_relative_path(){
		return 'downloads/posters/';
	}

	function poster_thumbnail_relative_path(){
		return 'downloads/posters/thumb/';
	}
	
	function bundle_relative_path(){
		return 'downloads/bundles/';
	}

	function bundle_thumbnail_relative_path(){
		return 'downloads/bundles/thumb/';
	}

	function poster_url(){
		return base_url().poster_relative_path();
	}

	function poster_thumbnail_url(){
		return base_url().poster_thumbnail_relative_path();
	}

	function bundle_url(){
		return base_url().bundle_relative_path();
	}

	function bundle_thumbnail_url(){
		return base_url().bundle_thumbnail_relative_path();
	}
	
?>