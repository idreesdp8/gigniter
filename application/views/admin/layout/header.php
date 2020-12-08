<!-- Main navbar -->
<div class="navbar navbar-expand-md navbar-dark">
		<div class="navbar-brand">
			<a href="<?php echo admin_base_url(); ?>dashboard" class="d-inline-block">
				<img src="<?php echo admin_asset_url(); ?>global_assets/images/logo_light.png" alt="" class="m-auto h-auto w-50">
			</a>
		</div>

		<div class="d-md-none">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
				<i class="icon-tree5"></i>
			</button>
			<button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
				<i class="icon-paragraph-justify3"></i>
			</button>
		</div>

		<div class="collapse navbar-collapse" id="navbar-mobile">
		<ul class="navbar-nav">
				<li class="nav-item">
					<a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
						<i class="icon-paragraph-justify3"></i>
					</a>
				</li>
			</ul>
			<span class="badge bg-success ml-md-3 mr-md-auto">
				<?php
				$role_name = $this->session->userdata('us_role_name');
				echo $role_name;
				// echo $role_id;
				// // die();
				// $role = $this->roles_model->get_role_by_id($role_id);
				// echo $role['name'];
				// if($role_id == 1){
				// 	echo 'Admin';
				// } elseif ($role_id == 2) {
				// 	echo 'Artist';
				// }
				?>
			</span>
			<ul class="navbar-nav">
				<li class="nav-item dropdown dropdown-user">
					<a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
						<img src="<?php echo admin_asset_url(); ?>global_assets/images/placeholders/placeholder.jpg" class="rounded-circle mr-2" height="34" alt="">
						<span><?php echo $this->session->userdata('us_name'); ?></span>
					</a>

					<div class="dropdown-menu dropdown-menu-right">
						<a href="#" class="dropdown-item"><i class="icon-user-plus"></i> My profile</a>
						<a href="<?php echo site_url('admin/settings/logoff'); ?>" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
					</div>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->