<?php
$vs_user_role_id = $this->session->userdata('us_role_id');
$role_permissions = $this->general_model->get_role_permissions($vs_user_role_id); 
if(isset($role_permissions)){
	foreach ($role_permissions as $role_permission) {
		if(isset($role_permission->permission_id) && $role_permission->permission_id >0){
			$permission = $this->permissions_model->get_permission_by_id($role_permission->permission_id);
			$user_permissions[] = $permission->name;
		}
	}
}  
$new_gigs = $this->gigs_model->get_count_new_gigs(); ?>

<!-- Main sidebar -->
<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        Navigation
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->


    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->
                <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i>
                </li>
                <li class="nav-item" id="sidebar_dashboard">
                    <a href="<?php echo admin_base_url(); ?>dashboard" class="nav-link">
                        <i class="icon-home4"></i>
                        <span>
                            Dashboard
                        </span>
                    </a>
                </li>
                <?php if (in_array('create-gig', $user_permissions) || in_array('edit-gig', $user_permissions) || in_array('view-gig', $user_permissions) || in_array('delete-gig', $user_permissions)) : ?>
                    <li class="nav-item nav-item-submenu" id="sidebar_gig">
                        <a href="#" class="nav-link"><i class="icon-mic2"></i> <span>Gigs</span></a>
                        <ul class="nav nav-group-sub" data-submenu-title="Gigs">
                            <?php if (in_array('create-gig', $user_permissions)) : ?>
                                <!-- <li class="nav-item" id="sidebar_gig_add"><a href="<?php echo admin_base_url(); ?>gigs/add" class="nav-link">Add Gig</a></li> -->
                            <?php endif; ?>
                            <?php if (in_array('edit-gig', $user_permissions) || in_array('view-gig', $user_permissions) || in_array('delete-gig', $user_permissions)) : ?>
                                <li class="nav-item" id="sidebar_gig_view"><a href="<?php echo admin_base_url(); ?>gigs" class="nav-link">All Gigs</a></li>
                            <?php endif; ?>
                            <?php if (in_array('edit-gig', $user_permissions) || in_array('view-gig', $user_permissions) || in_array('delete-gig', $user_permissions)) : ?>
                                <li class="nav-item" id="sidebar_approval_gig_view"><a href="<?php echo admin_base_url(); ?>gigs/new" class="nav-link">Gigs Waiting for Approval (<?php echo $new_gigs ?>)</a></li>
                            <?php endif; ?>
                            <?php if (in_array('edit-gig', $user_permissions) || in_array('view-gig', $user_permissions) || in_array('delete-gig', $user_permissions)) : ?>
                                <li class="nav-item" id="sidebar_featured_gig_view"><a href="<?php echo admin_base_url(); ?>featured_gigs" class="nav-link">Featured Gigs</a></li>
                            <?php endif; ?>
                            <?php if (in_array('edit-gig', $user_permissions) || in_array('view-gig', $user_permissions) || in_array('delete-gig', $user_permissions)) : ?>
                                <li class="nav-item" id="sidebar_popular_gig_view"><a href="<?php echo admin_base_url(); ?>popular_gigs" class="nav-link">Popular Gigs</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if (in_array('edit-email-log', $user_permissions) || in_array('view-email-log', $user_permissions) || in_array('delete-email-log', $user_permissions)) : ?>
                <li class="nav-item" id="sidebar_email-log">
                    <a href="<?php echo admin_base_url(); ?>users/email_log" class="nav-link">
                        <i class="icon-cart"></i>
                        <span>
                            Email log
                        </span>
                    </a>
                </li>
                <?php endif; ?>
                <?php if (in_array('edit-booking', $user_permissions) || in_array('view-booking', $user_permissions) || in_array('delete-booking', $user_permissions)) : ?>
                    <li class="nav-item" id="sidebar_booking">
                        <a href="<?php echo admin_base_url(); ?>bookings" class="nav-link">
                            <i class="icon-cart"></i>
                            <span>
                                Bookings
                            </span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if (in_array('edit-transaction', $user_permissions) || in_array('view-transaction', $user_permissions) || in_array('delete-transaction', $user_permissions)) : ?>
                    <!-- <li class="nav-item" id="sidebar_transaction_all">
                        <a href="<?php echo admin_base_url(); ?>transactions" class="nav-link">
                            <i class="icon-coin-dollar"></i>
                            <span>
                                Transactions
                            </span>
                        </a>
                    </li> -->
                    <li class="nav-item nav-item-submenu" id="sidebar_transaction">
                        <a href="#" class="nav-link" id="sidebar_transaction_nav"><i class="icon-coin-dollar"></i> <span>Transactions</span></a>
                        <ul class="nav nav-group-sub" data-submenu-title="Transactions">
                            <li class="nav-item" id="sidebar_transaction_view"><a href="<?php echo admin_base_url(); ?>transactions" class="nav-link">Transactions</a></li>
                            <li class="nav-item" id="sidebar_transaction_tickets"><a href="<?php echo admin_base_url(); ?>transactions/tickets" class="nav-link">Tickets</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if (in_array('edit-user-stripe', $user_permissions) || in_array('view-user-stripe', $user_permissions) || in_array('delete-user-stripe', $user_permissions)) : ?>
                <li class="nav-item" id="sidebar_user-stripe">
                    <a href="<?php echo admin_base_url(); ?>user_stripe_details" class="nav-link">
                        <i class="icon-coins"></i>
                        <span>
                            User Stripe details
                        </span>
                    </a>
                </li>
                <?php endif; ?>


                <?php if (in_array('create-email-template', $user_permissions) || in_array('edit-email-template', $user_permissions) || in_array('view-email-template', $user_permissions) || in_array('delete-email-template', $user_permissions)) : ?>
                    <li class="nav-item nav-item-submenu" id="sidebar_email">
                        <a href="#" class="nav-link"><i class="icon-stack"></i> <span>Email Templates</span></a>
                        <ul class="nav nav-group-sub" data-submenu-title="Email Templates">
                            <li class="nav-item" id="sidebar_email_view"><a href="<?php echo admin_base_url(); ?>email_templates/index" class="nav-link">Email Templates</a></li>
                            <li class="nav-item" id="sidebar_email_add"><a href="<?php echo admin_base_url(); ?>email_templates/add" class="nav-link">Add New</a></li>
                        </ul>
                    </li>
                <?php endif; ?>


                <?php if (in_array('create-user', $user_permissions) || in_array('edit-user', $user_permissions) || in_array('view-user', $user_permissions) || in_array('delete-user', $user_permissions)) : ?>
                    <li class="nav-item nav-item-submenu" id="sidebar_user">
                        <a href="#" class="nav-link"><i class="icon-users4"></i> <span>Users</span></a>
                        <ul class="nav nav-group-sub" data-submenu-title="Users">
                            <?php if (in_array('create-user', $user_permissions)) : ?>
                                <li class="nav-item" id="sidebar_user_add"><a href="<?php echo admin_base_url(); ?>users/add" class="nav-link">Add User</a></li>
                            <?php endif; ?>
                            <?php if (in_array('edit-user', $user_permissions) || in_array('view-user', $user_permissions) || in_array('delete-user', $user_permissions)) : ?>
                                <li class="nav-item" id="sidebar_user_view"><a href="<?php echo admin_base_url(); ?>users" class="nav-link">All Users</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if (in_array('create-permission', $user_permissions) || in_array('edit-permission', $user_permissions) || in_array('view-permission', $user_permissions) || in_array('delete-permission', $user_permissions) || in_array('create-role', $user_permissions) || in_array('edit-role', $user_permissions) || in_array('view-role', $user_permissions) || in_array('delete-role', $user_permissions)) : ?>
                    <li class="nav-item nav-item-submenu" id="sidebar_role_permission">
                        <a href="#" class="nav-link"><i class="icon-price-tags2"></i> <span>Roles &amp; Permissions</span></a>
                        <ul class="nav nav-group-sub" data-submenu-title="Roles & Permissions">
                            <?php if (in_array('create-permission', $user_permissions) || in_array('edit-permission', $user_permissions) || in_array('view-permission', $user_permissions) || in_array('delete-permission', $user_permissions)) : ?>
                                <li class="nav-item" id="sidebar_permission"><a href="<?php echo admin_base_url(); ?>permissions" class="nav-link">Permissions</a></li>
                            <?php endif; ?>
                            <?php if (in_array('create-role', $user_permissions) || in_array('edit-role', $user_permissions) || in_array('view-role', $user_permissions) || in_array('delete-role', $user_permissions)) : ?>
                                <li class="nav-item nav-item-submenu" id="sidebar_role">
                                    <a href="#" class="nav-link">Roles</a>
                                    <ul class="nav nav-group-sub">
                                        <?php if (in_array('create-role', $user_permissions)) : ?>
                                            <li class="nav-item" id="sidebar_role_add"><a href="<?php echo admin_base_url(); ?>roles/add" class="nav-link">Add Role</a></li>
                                        <?php endif; ?>
                                        <?php if (in_array('edit-role', $user_permissions) || in_array('view-role', $user_permissions) || in_array('delete-role', $user_permissions)) : ?>
                                            <li class="nav-item" id="sidebar_role_view"><a href="<?php echo admin_base_url(); ?>roles" class="nav-link">All Roles</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if (in_array('create-configuration', $user_permissions) || in_array('edit-configuration', $user_permissions) || in_array('view-configuration', $user_permissions) || in_array('delete-configuration', $user_permissions)) : ?>
                    <li class="nav-item nav-item-submenu" id="sidebar_configuration">
                        <a href="#" class="nav-link"><i class="icon-cog"></i> <span>Configurations</span></a>
                        <ul class="nav nav-group-sub" data-submenu-title="Configurations">
                            <li class="nav-item" id="sidebar_config"><a href="<?php echo admin_base_url(); ?>configurations" class="nav-link">All Configurations</a></li>
                            <li class="nav-item" id="sidebar_stripe"><a href="<?php echo admin_base_url(); ?>configurations/stripe" class="nav-link">Stripe Configuration</a></li>
                            <li class="nav-item" id="sidebar_aws"><a href="<?php echo admin_base_url(); ?>configurations/aws_config" class="nav-link">AWS Configuration</a></li>
                            <li class="nav-item" id="sidebar_genre"><a href="<?php echo admin_base_url(); ?>genres" class="nav-link">Gig Genres</a></li>
                            <li class="nav-item" id="sidebar_category"><a href="<?php echo admin_base_url(); ?>categories" class="nav-link">Gig Categories</a></li>
                            <li class="nav-item" id="sidebar_gig_status"><a href="<?php echo admin_base_url(); ?>gig_statuses" class="nav-link">Gig Statuses</a></li>
                            <li class="nav-item" id="sidebar_gig_rejection"><a href="<?php echo admin_base_url(); ?>rejection_reasons" class="nav-link">Gig Rejection Reasons</a></li>
                            <li class="nav-item" id="sidebar_popularity_weightage"><a href="<?php echo admin_base_url(); ?>configurations/popularity_weightage" class="nav-link">Popularity Weightages</a></li>
                            <li class="nav-item" id="sidebar_country"><a href="<?php echo admin_base_url(); ?>countries" class="nav-link">Countries</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
                <!-- /main -->

            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->

</div>
<!-- /main sidebar -->