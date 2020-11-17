<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('admin/widgets/meta_tags'); ?>
</head>
<body class="">
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
                <?php 
			  	$form_act = '';
				if(isset($args1) && $args1>0){
					$form_act = "admin/members/update/".$args1;
				} ?>
                <form name="datas_form" id="datas_form" method="post" action="<?php echo site_url($form_act); ?>" class="form-horizontal">
                  <div class="row">
                    <div class="col-md-9">
                      <div class="form-group">
                        <label class="col-md-3 control-label" for="first_name"> First Name <span class="reds">*</span></label>
                        <div class="col-md-8">
                          <input name="first_name" id="first_name" type="text" class="form-control" value="<?php echo (isset($record)) ? stripslashes($record->first_name): set_value('first_name'); ?>" data-error="#first_name1">
                          <span id="first_name1" class="text-danger"><?php echo form_error('first_name'); ?></span> </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label" for="last_name"> Last Name <span class="reds"></span></label>
                        <div class="col-md-8">
                          <input name="last_name" id="last_name" type="text" class="form-control" value="<?php echo (isset($record)) ? stripslashes($record->last_name): set_value('last_name'); ?>" data-error="#last_name1">
                          <span id="last_name1" class="text-danger"><?php echo form_error('last_name'); ?></span> </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label" for="email"> Email <span class="reds">*</span></label>
                        <div class="col-md-8">
                          <input name="email" id="email" type="text" class="form-control" value="<?php echo (isset($record)) ? stripslashes($record->email): set_value('email'); ?>" data-error="#email1">
                          <span id="email1" class="text-danger"><?php echo form_error('email'); ?></span> </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label" for="password">Password <span class="reds"> *</span></label>
                        <div class="col-md-8">
                          <?php 
								if(isset($record) && strlen($record->password)>0){
									$pwd_val0 = $record->password;  
									$pwd_val = $this->general_model->safe_ci_decoder($pwd_val0);
								}else{
									$pwd_val = set_value('password');
								} ?>
                          <input name="password" id="password" type="password" class="form-control" value="<?php echo $pwd_val; ?>" style="display:inline; width:86%;" data-error="#password1">
                          <span> &nbsp;
                          <input type="checkbox" name="show_hide_password" id="show_hide_password" value="1" onClick="if(password.type=='text')password.type='password'; else password.type='text';" class="styled">
                          Show </span> <span id="password1" class="text-danger" generated="true"><?php echo form_error('password'); ?></span> </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label" for="phone_no"> Phone Number <span class="reds"> </span></label>
                        <div class="col-md-8">
                          <input name="phone_no" id="phone_no" type="text" class="form-control" value="<?php echo (isset($record)) ? stripslashes($record->phone_no): set_value('phone_no'); ?>" data-error="#phone_no1">
                          <span id="phone_no1" class="text-danger"><?php echo form_error('phone_no'); ?></span> </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label" for="mobile_no"> Mobile Number <span class="reds">*</span></label>
                        <div class="col-md-8">
                          <input name="mobile_no" id="mobile_no" type="text" class="form-control" value="<?php echo (isset($record)) ? stripslashes($record->mobile_no): set_value('mobile_no'); ?>" data-error="#mobile_no1">
                          <span id="mobile_no1" class="text-danger"><?php echo form_error('mobile_no'); ?></span> </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label" for="address"> Address <span class="reds"> </span></label>
                        <div class="col-md-8">
                          <textarea name="address" id="address" type="text" class="form-control" data-error="#address1" rows="5"><?php echo (isset($record)) ? stripslashes($record->address): set_value('address'); ?></textarea>
                          <span id="address1" class="text-danger"><?php echo form_error('address'); ?></span> </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label" for="status">Status<span class="reds"> </span></label>
                        <div class="col-md-8">
                          <select name="status" id="status" class="form-control cstm_select2" data-error="#status1">
                            <option value=""> Select Status </option>
                            <option value="0" <?php if(isset($_POST['status']) && $_POST['status']==0){ echo 'selected="selected"'; }else if(isset($record->status) && $record->status==0){ echo 'selected="selected"'; } ?>> Pending </option>
                            <option value="1" <?php if(isset($_POST['status']) && $_POST['status']==1){ echo 'selected="selected"'; }else if(isset($record->status) && $record->status==1){ echo 'selected="selected"'; } ?>> Active </option>
                            <option value="2" <?php if(isset($_POST['status']) && $_POST['status']==2){ echo 'selected="selected"'; }else if(isset($record->status) && $record->status==2){ echo 'selected="selected"'; } ?>> Suspended </option>
                          </select>
                          <span id="status1" class="text-danger"><?php echo form_error('status'); ?></span> </div>
                      </div>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-9">
                      <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-8">
                          <?php if(isset($record)){	?>
                          <input type="hidden" name="args1" id="args1" value="<?php echo $record->id; ?>">
                          <button class="btn border-slate text-slate-800 btn-flat" type="submit" name="updates" id="updates"><i class="glyphicon glyphicon-ok position-left"></i>Update</button>
                          <?php } ?>
                          &nbsp;
                          <button type="button" class="btn border-slate text-slate-800 btn-flat" onClick="window.location='<?php echo site_url('admin/members/index'); ?>';"><i class="glyphicon glyphicon-chevron-left position-left"></i>Cancel</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
                <script type="text/javascript">   
			$(document).ready(function(){ 
				var validator = $('#datas_form').validate({
				rules: {                
					first_name: {
						required: true 
					},
					email: {
						required: true,
						email : true, 
					},
					mobile_no: {
						required: true 
					} 
				},
				messages: { 
					first_name: {
						required: "This is required field" 
					},
					email: {
						required: "This is required field",
						email: "Please enter a vaild email address!", 
					},
					mobile_no: {
						required: "This is required field" 
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
