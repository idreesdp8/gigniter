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
					$form_act = "admin/pages/update/".$args1;
				} ?>
                <form name="datas_form" id="datas_form" method="post" action="<?php echo site_url($form_act); ?>" class="form-horizontal">
				
				
				<div class="row">
                    <div class="col-md-9">
                      <div class="form-group">
                        <label class="col-md-3 control-label" for="page_name"> Page Name <span class="reds">*</span></label>
                        <div class="col-md-8">
                          <input name="page_name" id="page_name" type="text" class="form-control" value="<?php echo (isset($record)) ? stripslashes($record->page_name): set_value('page_name'); ?>" data-error="#page_name1">
                          <span id="page_name1" class="text-danger"><?php echo form_error('page_name'); ?></span> </div>
                      </div>
					  <div class="form-group">
                        <label class="col-md-3 control-label" for="page_slug"> Slug <span class="reds">*</span></label>
                        <div class="col-md-8">
                          <input name="page_slug" id="page_slug" type="text" class="form-control" value="<?php echo (isset($record)) ? stripslashes($record->page_slug): set_value('page_slug'); ?>" data-error="#page_slug1">
                          <span id="page_slug1" class="text-danger"><?php echo form_error('page_slug'); ?></span> </div>
                      </div>
					  
                      <div class="form-group">
                        <label class="col-md-3 control-label" for="meta_title"> Meta Title <span class="reds">*</span></label>
                        <div class="col-md-8">
                          <input name="meta_title" id="meta_title" type="text" class="form-control" value="<?php echo (isset($record)) ? stripslashes($record->meta_title): set_value('meta_title'); ?>" data-error="#meta_title1">
                          <span id="meta_title1" class="text-danger"><?php echo form_error('meta_title'); ?></span> </div>
                      </div> 
                      <div class="form-group">
                        <label class="col-md-3 control-label" for="meta_keyword"> Meta Keyword <span class="reds">  </span></label>
                        <div class="col-md-8"> 
						  <textarea name="meta_keyword" id="meta_keyword" type="text" class="form-control" data-error="#meta_keyword1" rows="5"><?php echo (isset($record)) ? stripslashes($record->meta_keyword): set_value('meta_keyword'); ?></textarea> 
                          <span id="meta_keyword1" class="text-danger"><?php echo form_error('meta_keyword'); ?></span> </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label" for="meta_description"> Meta Description<span class="reds"> </span></label>
                        <div class="col-md-8">
							<textarea name="meta_description" id="meta_description" type="text" class="form-control" data-error="#meta_description1" rows="5"><?php echo (isset($record)) ? stripslashes($record->meta_description): set_value('meta_description'); ?></textarea> 
                          <span id="meta_description1" class="text-danger"><?php echo form_error('meta_description'); ?></span> </div>
                      </div>
                       
                      <div class="form-group">
                        <label class="col-md-3 control-label" for="summary"> Summary <span class="reds"> </span></label>
                        <div class="col-md-8">
                          <textarea name="summary" id="summary" type="text" class="form-control" data-error="#summary1" rows="5"><?php echo (isset($record)) ? stripslashes($record->summary): set_value('summary'); ?></textarea>
                          <span id="summary1" class="text-danger"><?php echo form_error('summary'); ?></span> </div>
                      </div>
					  
					  <div class="form-group">
                        <label class="col-md-3 control-label" for="details"> Details <span class="reds"> </span></label>
                        <div class="col-md-8">
                          <textarea name="details" id="details" type="text" class="form-control" data-error="#details1" rows="5"><?php echo (isset($record)) ? stripslashes($record->details): set_value('details'); ?></textarea>
                          <span id="details1" class="text-danger"><?php echo form_error('details'); ?></span> </div>
                      </div>
					  
                      <div class="form-group">
                        <label class="col-md-3 control-label" for="status">Page Status<span class="reds"> </span></label>
                        <div class="col-md-8">
                          <select name="status" id="status" class="form-control cstm_select2" data-error="#status1">
                            <option value=""> Select Page Status </option> 
                            <option value="1" <?php if(isset($record) && $record->status == '1'){ echo 'selected="selected"'; }else if(isset($_POST['status']) && $_POST['status']==1){ echo 'selected="selected"'; } ?>> Active </option> 
							<option value="0" <?php if(isset($record) && $record->status == '0'){ echo 'selected="selected"'; }elseif(isset($_POST['status']) && $_POST['status']==0){ echo 'selected="selected"'; } ?>> Inactive </option> 
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
                          <button type="button" class="btn border-slate text-slate-800 btn-flat" onClick="window.location='<?php echo site_url('admin/pages/index'); ?>';"><i class="glyphicon glyphicon-chevron-left position-left"></i>Cancel</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
                 <script type="text/javascript">   
					$(document).ready(function(){ 
						var validator = $('#datas_form').validate({
						rules: {                
							page_name: {
								required: true 
							},
							page_slug: {
								required: true 
							},
							meta_title: {
								required: true, 
							},  
						},
						messages: { 
							page_name: {
								required: "This is required field" 
							},
							page_slug: {
								required: "This is required field" 
							},
							meta_title: {
								required: "This is required field", 
							},
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
