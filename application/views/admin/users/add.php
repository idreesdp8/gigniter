<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('admin/widgets/meta_tags'); ?>
</head>
<body>
<!-- Main navbar -->
<?php $this->load->view('admin/widgets/header'); ?>
<!-- /main navbar -->
<!-- Page container -->
<div class="page-container">
  <!-- Page content -->
  <div class="page-content">
    <!-- Main sidebar -->
    <?php $this->load->view('admin/widgets/left_sidebar'); ?>
    <!-- /main sidebar -->
    <!-- Main content -->
    <div class="content-wrapper">
      <!-- Page header -->
      <?php $this->load->view('admin/widgets/content_header'); ?>
      <!-- /page header -->
      <!-- Content area -->
      <div class="content">
        <!-- Dashboard content -->
        <div class="row">
          <div class="col-lg-12">
            <?php if($this->session->flashdata('success_msg')){ ?>
            <div class="alert alert-success no-border">
              <button data-dismiss="alert" class="close" type="button"><span>×</span><span class="sr-only">Close</span></button>
              <?php echo $this->session->flashdata('success_msg'); ?> </div>
            <?php } 
        if($this->session->flashdata('error_msg')){ ?>
            <div class="alert alert-danger no-border">
              <button data-dismiss="alert" class="close" type="button"><span>×</span><span class="sr-only">Close</span></button>
              <?php echo $this->session->flashdata('error_msg'); ?> </div>
            <?php } ?>
            <!-- Horizontal form -->
            <div class="panel panel-flat">
              <div class="panel-heading">
                <h5 class="panel-title">
                  <?= $page_headings; ?>
                  Form </h5>
              </div>
              <div class="panel-body">
                <?php $form_act = "admin/users/add"; ?>
                <form name="datas_form" id="datas_form" method="post" action="<?php echo site_url($form_act); ?>" class="form-horizontal" enctype="multipart/form-data">
                  <div class="form-group">
                    <label class="control-label col-lg-2" for="name">Name <span class="reds"> *</span></label>
                    <div class="col-lg-6">
                      <input name="name" id="name" type="text" class="form-control" value="<?php echo set_value('name'); ?>" data-error="#name1">
                      <span id="name1" class="text-danger" generated="true"><?php echo form_error('name'); ?></span> </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-2 control-label" for="role_id">Role Name <span class="reds"> *</span></label>
                    <div class="col-md-6">
                      <select name="role_id" id="role_id" class="form-control select" data-error="#role_id1">
                        <option value="">Select Role Name</option>
                        <?php  
            if(isset($role_arrs) && count($role_arrs)>0){
                foreach($role_arrs as $role_arr){
                    $sel_1 = '';
                    if(isset($_POST['role_id']) && $_POST['role_id']==$role_arr->id){
                        $sel_1 = 'selected="selected"';
                    } ?>
                        <option value="<?= $role_arr->id; ?>" <?php echo $sel_1; ?>>
                        <?= stripslashes($role_arr->name); ?>
                        </option>
                        <?php 
                    }
                } ?>
                      </select>
                      <span id="role_id1" class="text-danger" generated="true"><?php echo form_error('role_id'); ?></span> </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-2 control-label" for="email">Email <span class="reds"> *</span></label>
                    <div class="col-md-6">
                      <input name="email" id="email" type="text" class="form-control" value="<?php echo set_value('email'); ?>" data-error="#email1">
                      <span id="email1" class="text-danger" generated="true"><?php echo form_error('email'); ?></span> </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-2 control-label" for="password">Password <span class="reds"> *</span></label>
                    <div class="col-md-6">
                      <?php $pwd_val = set_value('password'); ?>
                      <input name="password" id="password" type="password" class="form-control" value="<?php echo $pwd_val; ?>" style="display:inline; width:86%;" data-error="#password1">
                      <span> &nbsp;
                      <input type="checkbox" name="show_hide_password" id="show_hide_password" value="1" onClick="if(password.type=='text')password.type='password'; else password.type='text';" class="styled">
                      Show </span> <span id="password1" class="text-danger" generated="true"><?php echo form_error('password'); ?></span> </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-2 control-label" for="phone_no">Phone No <span class="reds"></span></label>
                    <div class="col-md-6">
                      <input name="phone_no" id="phone_no" type="text" class="form-control" value="<?php echo set_value('phone_no'); ?>" data-error="#phone_no1">
                      <span id="phone_no1" class="text-danger" generated="true"><?php echo form_error('phone_no'); ?></span> </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-2 control-label" for="mobile_no">Mobile No <span class="reds"></span></label>
                    <div class="col-md-6">
                      <input name="mobile_no" id="mobile_no" type="text" class="form-control" value="<?php echo set_value('mobile_no'); ?>" data-error="#mobile_no1">
                      <span id="mobile_no1" class="text-danger" generated="true"><?php echo form_error('mobile_no'); ?></span> </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-2 control-label" for="company_name">Company Name</label>
                    <div class="col-md-6">
                      <input name="company_name" id="company_name" type="text" class="form-control" value="<?php echo set_value('company_name'); ?>">
                      <span class="text-danger"><?php echo form_error('company_name'); ?></span> </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-2 control-label" for="address">Address <span class="reds"> *</span> </label>
                    <div class="col-md-6">
                      <textarea name="address" id="address" class="form-control" rows="5" data-error="#address1"><?php echo set_value('address'); ?></textarea>
                      <span id="address1" class="text-danger" generated="true"><?php echo form_error('address'); ?></span> </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-2 control-label" for="status">Account Status <span class="reds"> *</span></label>
                    <div class="col-md-6">
                      <select name="status" id="status" class="form-control select">
                        <option value="1" <?php if(isset($_POST['status']) && $_POST['status']==1){ echo 'selected="selected"'; } ?>> Active </option>
                        <option value="0" <?php if(isset($_POST['status']) && $_POST['status']==0){ echo 'selected="selected"'; } ?>> Inactive </option>
                      </select>
                      <span id="password1" class="text-danger" generated="true"><?php echo form_error('status'); ?></span> </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-2 control-label" for="image">Profile Picture</label>
                    <div class="col-md-6">
                      <input type="file" name="image" id="image" class="file-styled" data-error="#image1">
                      <span id="image1" class="text-danger" generated="true">
                      <?php  
				echo form_error('image'); 
				if(isset($_SESSION['prof_img_error'])){
					echo $_SESSION['prof_img_error'];
				} ?>
                      </span> </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-2 control-label"></label>
                    <div class="col-md-6">
                      <button class="btn border-slate text-slate-800 btn-flat" type="submit" name="saves" id="saves"><i class="glyphicon glyphicon-ok position-left"></i>Save</button>
                       
                      <button class="btn border-slate text-slate-800 btn-flat" type="submit" name="saves_and_new" id="save_and_new"><i class="glyphicon glyphicon-repeat position-left"></i>Save & New</button>
                       
                      <button type="reset" class="btn border-slate text-slate-800 btn-flat"><i class="glyphicon glyphicon-refresh position-left"></i>Clear</button>
                       
                      <button type="button" class="btn border-slate text-slate-800 btn-flat" onClick="window.location='<?php echo site_url('admin/users/index'); ?>';"><i class="glyphicon glyphicon-chevron-left position-left"></i>Cancel</button>
                    </div>
                  </div>
                </form>
                <script type="text/javascript">  
        $(document).ready(function(){ 
            var validator = $('#datas_form').validate({
            rules: {
                name: {
                    required: true 
                }, 
				role_id: {
                    required: true 
                }, 
				email: {
                    required: true,
					email: true 
                }, 
				password: {
                    required: true, 
					minlength: 5
                }, 
				address: {
                    required: true 
                }, 
				status: {
                    required: true 
                }, 
				image: {
                    required: false,
					accept:"gif|png|jpg|jpeg" 
                }  
            },
            messages: { 
				name: {
                    required: "This is required field" 
                }, 
				role_id: {
                    required: "This is required field" 
                }, 
				email: {
                    required: "This is required field",
					email: "Please enter a valid Email address!" 
                }, 
				password: {
                    required: "This is required field", 
					minlength: "Minimum 5 characters needed!"
                },
				address: {
                    required: "This is required field" 
                },
				status: {
                    required: "This is required field" 
                }, 
				image: {
                    required: "This is required field",
					accept:"Accepts images having extension gif|png|jpg|jpeg" 
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
            submitHandler: function(){ 
                document.forms["datas_form"].submit();
            }  
          });
        }); 
    </script>
              </div>
            </div>
            <!-- /horizotal form -->
          </div>
        </div>
        <!-- /dashboard content -->
        <!-- Footer -->
        <?php $this->load->view('admin/widgets/footer'); ?>
        <!-- /footer -->
      </div>
      <!-- /content area -->
    </div>
    <!-- /main content -->
  </div>
  <!-- /page content -->
</div>
<!-- /page container -->
</body>
</html>
