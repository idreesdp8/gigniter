<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('admin/widgets/meta_tags'); ?>
</head>
<body class="pace-done ">
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
                <?php $form_act = "admin/galleries/add"; ?>
                <form name="datas_form" id="datas_form" method="post" action="<?php echo site_url($form_act); ?>" class="form-horizontal" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-9">
                      <div class="form-group">
                        <label class="col-md-3 control-label" for="title"> Title <span class="reds">*</span></label>
                        <div class="col-md-8">
                          <input name="title" id="title" type="text" class="form-control" value="<?php echo set_value('title'); ?>" data-error="#title1">
                          <span id="title1" class="text-danger"><?php echo form_error('title'); ?></span> </div>
                      </div> 
					  
					  <div class="form-group">
						<label class="col-md-3 control-label" for="image">Image <span class="reds">*</span></label>
						<div class="col-md-8">
						  <input type="file" name="image" id="image" class="file-styled" data-error="#image1">
						  <span id="image1" class="text-danger"> <?php echo (isset($cstmr_img_error)) ? $cstmr_img_error : ''; ?> </span> 
						</div>
					  </div>    
					  
					  <div class="form-group">
                        <label class="col-md-3 control-label" for="status"> Status <span class="reds"> </span></label>
                        <div class="col-md-8">
                          <select name="status" id="status" class="form-control cstm_select2" data-error="#status1">
                            <option value=""> Select Status </option>
							 <option value="0" <?php if(isset($_POST['status']) && $_POST['status']==0){ echo 'selected="selected"'; } ?>> Inactive </option>
                            <option value="1" <?php if(isset($_POST['status']) && $_POST['status']==1){ echo 'selected="selected"'; } ?>> Active </option>  
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
                          <button class="btn border-slate text-slate-800 btn-flat" type="submit" name="saves" id="saves"><i class="glyphicon glyphicon-ok position-left"></i>Save</button>
                           
                          <button class="btn border-slate text-slate-800 btn-flat" type="submit" name="saves_and_new" id="save_and_new"><i class="glyphicon glyphicon-repeat position-left"></i>Save & New</button>
                           
                          <button type="reset" class="btn border-slate text-slate-800 btn-flat"><i class="glyphicon glyphicon-refresh position-left"></i>Clear</button>
                           
                          <button type="button" class="btn border-slate text-slate-800 btn-flat" onClick="window.location='<?php echo site_url('admin/galleries/index'); ?>';"><i class="glyphicon glyphicon-chevron-left position-left"></i>Cancel</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
                <script type="text/javascript">   
					$(document).ready(function(){ 
						var validator = $('#datas_form').validate({
						rules: {                
							title: {
								required: true 
							}, 
							image: {
								required: true,
								accepts: 'jpg|joeg|png|gif';
							}   
						},
						messages: { 
							title: {
								required: "This is required field" 
							}, 
							image: {
								required: "This is required field",
								accepts: 'Accepts only images having extension of jpg|joeg|png|gif';
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