	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="<?php echo admin_asset_url(); ?>global_assets/images/logo_icon_light.png" type="image/x-icon">

	<!-- Global stylesheets -->
	<link href="<?php echo admin_asset_url(); ?>css/fonts.css" rel="stylesheet" type="text/css">
	<link href="<?php echo admin_asset_url(); ?>global_assets/css/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo admin_asset_url(); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo admin_asset_url(); ?>css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo admin_asset_url(); ?>css/layout.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo admin_asset_url(); ?>css/components.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo admin_asset_url(); ?>css/colors.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo admin_asset_url(); ?>css/custom.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="<?php echo admin_asset_url(); ?>global_assets/js/main/jquery.min.js"></script>
	<script src="<?php echo admin_asset_url(); ?>global_assets/js/main/bootstrap.bundle.min.js"></script>
	<script src="<?php echo admin_asset_url(); ?>global_assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->
	<script>
		const base_url = '<?php echo admin_base_url() ?>';
	</script>

	<!-- Theme JS files -->
	<!-- for Sweet Alert -->
	<script src="<?php echo admin_asset_url(); ?>global_assets/js/plugins/notifications/sweet_alert.min.js"></script>
	<!-- for radio buttons -->
	<script src="<?php echo admin_asset_url(); ?>global_assets/js/plugins/forms/styling/uniform.min.js"></script>
	<!-- for switching checkboxes -->
	<script src="<?php echo admin_asset_url(); ?>global_assets/js/plugins/forms/styling/switchery.min.js"></script>
	<!-- <script src="<?php echo admin_asset_url(); ?>global_assets/js/plugins/forms/styling/switch.min.js"></script> -->
	<!-- <script src="<?php echo admin_asset_url(); ?>global_assets/js/plugins/ui/moment/moment.min.js"></script> -->
	<!-- <script src="<?php echo admin_asset_url(); ?>global_assets/js/plugins/pickers/daterangepicker.js"></script> -->
	<script src="<?php echo admin_asset_url(); ?>global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
	<!-- for profile image upload -->
	<script src="<?php echo admin_asset_url(); ?>global_assets/js/plugins/uploaders/fileinput/fileinput.min.js"></script>
	<!-- for select2 sortable function -->
	<script src="<?php echo admin_asset_url(); ?>global_assets/js/plugins/extensions/jquery_ui/interactions.min.js"></script>
	<!-- for select2 -->
	<script src="<?php echo admin_asset_url(); ?>global_assets/js/plugins/forms/selects/select2.min.js"></script>
	<!-- for validation -->
	<script src="<?php echo admin_asset_url(); ?>global_assets/jquery.validate.js"></script>
	<!-- for form wizard -->
	<script src="<?php echo admin_asset_url(); ?>global_assets/js/plugins/forms/wizards/steps.min.js"></script>
	<!-- for notification alerts -->
	<script src="<?php echo admin_asset_url(); ?>global_assets/js/plugins/notifications/pnotify.min.js"></script>

	<script src="<?php echo admin_asset_url(); ?>js/app.js"></script>


	<script src="<?php echo admin_asset_url(); ?>global_assets/js/plugins/visualization/d3/d3.min.js"></script>
	<script src="<?php echo admin_asset_url(); ?>global_assets/js/plugins/visualization/d3/d3_tooltip.js"></script>

	<!-- initialization files -->
	<script src="<?php echo admin_asset_url(); ?>global_assets/js/demo_pages/form_checkboxes_radios.js"></script>
	<script src="<?php echo admin_asset_url(); ?>global_assets/js/demo_pages/uploader_bootstrap.js"></script>
	<script src="<?php echo admin_asset_url(); ?>global_assets/js/demo_pages/form_select2.js"></script>
	<script src="<?php echo admin_asset_url(); ?>global_assets/js/demo_pages/form_wizard.js"></script>
	<script src="<?php echo admin_asset_url(); ?>global_assets/js/plugins/loaders/progressbar.min.js"></script>
	<script src="<?php echo admin_asset_url(); ?>global_assets/js/demo_pages/components_progress.js"></script>
	<script src="<?php echo admin_asset_url(); ?>global_assets/js/demo_pages/datatables_basic.js"></script>
	<!-- <script src="<?php echo admin_asset_url(); ?>global_assets/js/plugins/visualization/echarts/echarts.min.js"></script> -->
	<!-- <script src="<?php echo admin_asset_url(); ?>global_assets/js/demo_charts/echarts/light/lines/lines_stacked.js"></script> -->
	<!-- <script src="<?php echo admin_asset_url(); ?>global_assets/js/demo_charts/pages/dashboard/light/progress.js"></script>
	<script src="<?php echo admin_asset_url(); ?>global_assets/js/demo_charts/pages/dashboard/light/bars.js"></script> -->
	<!-- /theme JS files -->

	<script>
		var light; 
        $(document).bind("ajaxSend", function() {
			light = $('.content .card');
            // console.log('Ajax Start')
            $(light).block({
                message: '<i class="icon-spinner spinner"></i>',
                overlayCSS: {
                    backgroundColor: '#fff',
                    opacity: 0.8,
                    cursor: 'wait'
                },
                css: {
                    border: 0,
                    padding: 0,
                    backgroundColor: 'none'
                }
            });
        }).bind("ajaxComplete", function() {
            // console.log('Ajax Stop')
            $(light).unblock();
        });
	</script>