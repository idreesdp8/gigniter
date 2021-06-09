<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login</title>

  <!-- Global stylesheets -->
  <link href="<?php echo admin_asset_url(); ?>css/fonts.css" rel="stylesheet" type="text/css">
  <link href="<?php echo admin_asset_url(); ?>global_assets/css/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo admin_asset_url(); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo admin_asset_url(); ?>css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo admin_asset_url(); ?>css/layout.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo admin_asset_url(); ?>css/components.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo admin_asset_url(); ?>css/colors.min.css" rel="stylesheet" type="text/css">
  <!-- /global stylesheets -->

  <!-- Core JS files -->
  <script src="<?php echo admin_asset_url(); ?>global_assets/js/main/jquery.min.js"></script>
  <script src="<?php echo admin_asset_url(); ?>global_assets/js/main/bootstrap.bundle.min.js"></script>
  <script src="<?php echo admin_asset_url(); ?>global_assets/js/plugins/loaders/blockui.min.js"></script>
  <!-- /core JS files -->
  
  <script src="<?php echo admin_asset_url(); ?>global_assets/jquery.validate.js"></script>
  <!-- Theme JS files -->
  <script src="<?php echo admin_asset_url(); ?>js/app.js"></script>
  <!-- /theme JS files -->

</head>

<body>
  <!-- Page content -->
  <div class="page-content">

    <!-- Main content -->
    <div class="content-wrapper">

      <!-- Content area -->
      <div class="content d-flex justify-content-center align-items-center">

        <!-- Login form -->
        <form class="login-form" id="datas_form" action="<?php echo site_url('admin/login'); ?>" method="POST">
          <div class="card mb-0">
            <div class="card-body">
              <?php if (isset($_SESSION['success_msg'])) { ?>
                <div class="alert alert-success no-border">
                  <button data-dismiss="alert" class="close" type="button"><span>×</span><span class="sr-only">Close</span></button>
                  <?php echo $this->session->flashdata('success_msg'); ?> </div>
              <?php }
              if (isset($_SESSION['error_msg'])) { ?>
                <div class="alert alert-danger no-border">
                  <button data-dismiss="alert" class="close" type="button"><span>×</span><span class="sr-only">Close</span></button>
                  <?php echo $this->session->flashdata('error_msg'); ?> </div>
              <?php } ?>
              <div class="text-center mb-3">
                <i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                <h5 class="mb-0">Login to your account</h5>
                <span class="d-block text-muted">Enter your credentials below</span>
              </div>

              <div class="form-group form-group-feedback form-group-feedback-left">
                <input type="text" class="form-control" placeholder="Email" name="email" data-error="#email1">
                <div class="form-control-feedback">
                  <i class="icon-user text-muted"></i>
                </div>
                <span id="email1" class="text-danger"><?php echo form_error('email'); ?></span>
              </div>

              <div class="form-group form-group-feedback form-group-feedback-left">
                <input type="password" class="form-control" placeholder="Password" name="password" data-error="#password1">
                <div class="form-control-feedback">
                  <i class="icon-lock2 text-muted"></i>
                </div>
                <span id="password1" class="text-danger"><?php echo form_error('password'); ?></span>
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 ml-2"></i></button>
              </div>

              <div class="text-center">
                <a href="<?php echo site_url('admin/login/forgot_password'); ?>">Forgot password?</a>
              </div>
            </div>
          </div>
        </form>
        <!-- /login form -->

      </div>
      <!-- /content area -->


      <!-- Footer -->
      <div class="navbar navbar-expand-lg navbar-light">
        <div class="text-center d-lg-none w-100">
          <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
            <i class="icon-unfold mr-2"></i>
            Footer
          </button>
        </div>

        <div class="navbar-collapse collapse" id="navbar-footer">
          <span class="navbar-text">
            &copy; 2020. <a href="#">Gigniter</a> by <a href="#" target="_blank">FatCoders</a>
          </span>
        </div>
      </div>
      <!-- /footer -->

    </div>
    <!-- /main content -->

  </div>
  <!-- /page content -->

  <script type="text/javascript">
    $(document).ready(function() {
      var validator = $('#datas_form').validate({
        rules: {
          email: {
            required: true,
            email: true
          },
          password: {
            required: true
          }
        },
        messages: {
          email: {
            required: "Email is required field",
            email: "Please enter a valid Email address!"
          },
          password: {
            required: "Password is required field"
          }
        },
        errorPlacement: function(error, element) {
          var placement = $(element).data('error');
          if (placement) {
            $(placement).append(error)
          } else {
            error.insertAfter(element);
          }
        },
        submitHandler: function() {
          document.forms["datas_form"].submit();
        }
      });
    });
  </script>

</body>

</html>