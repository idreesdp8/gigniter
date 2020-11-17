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
					$form_act = "admin/products/update/".$args1;
				} ?>
                <form name="datas_form" id="datas_form" method="post" action="<?php echo site_url($form_act); ?>" class="form-horizontal" enctype="multipart/form-data">
				<div class="row">
                    <div class="col-md-9">
                      <div class="form-group">
                        <label class="col-md-3 control-label" for="product_name"> Product Name <span class="reds">*</span></label>
                        <div class="col-md-8">
                          <input name="product_name" id="product_name" type="text" class="form-control" value="<?php echo (isset($record)) ? stripslashes($record->product_name): set_value('product_name'); ?>" data-error="#product_name1">
                          <span id="product_name1" class="text-danger"><?php echo form_error('product_name'); ?></span> </div>
                      </div>
					  <div class="form-group">
                        <label class="col-md-3 control-label" for="links">  Amazon Link <span class="reds">*</span></label>
                        <div class="col-md-8">
                          <input name="links" id="links" type="text" class="form-control" value="<?php echo (isset($record)) ? stripslashes($record->links): set_value('links'); ?>" data-error="#links1">
                          <span id="links1" class="text-danger"><?php echo form_error('links'); ?></span> </div>
                      </div>  
					  
					  <div class="form-group">
						<label class="col-md-3 control-label" for="image">Image <span class="reds">*</span></label>
						<div class="col-md-8">
						  <input type="file" name="image" id="image" class="file-styled" data-error="#image1">
						  <span id="image1" class="text-danger"> <?php echo (isset($cstmr_img_error)) ? $cstmr_img_error : ''; ?> </span> 
						  <input type="hidden" name="old_image" id="old_image" value="<?php echo (isset($record)) ? stripslashes($record->image): set_value('image'); ?>" /> 
						  
						  <span id="image_lbl"><?php echo (isset($record)) ? '('. stripslashes($record->image) .')' : ''; ?></span>
						</div>
					  </div>
					  
                      <div class="form-group">
                        <label class="col-md-3 control-label" for="summary"> Summary <span class="reds"> </span></label>
                        <div class="col-md-8"><textarea name="summary" id="summary" cols="40" rows="4" class="form-control" data-error="#summary1"><?php echo (isset($record)) ? stripslashes($record->summary): set_value('summary'); ?></textarea> 
                          <span id="summary1" class="text-danger"><?php echo form_error('summary'); ?></span> </div>
                      </div>
					  
					  <div class="form-group">
                        <label class="col-md-3 control-label" for="detail"> Detail <span class="reds"> </span></label>
                        <div class="col-md-8"><textarea name="detail" id="detail" cols="40" rows="7" class="form-control" data-error="#detail1"><?php echo (isset($record)) ? stripslashes($record->detail): set_value('detail'); ?></textarea> 
                          <span id="detail1" class="text-danger"><?php echo form_error('detail'); ?></span> </div>
                      </div>
                       
                      <div class="form-group">
                        <label class="col-md-3 control-label" for="views"> Views <span class="reds"> </span></label>
                        <div class="col-md-8">
                          <input name="views" id="views" type="text" class="form-control" value="<?php echo (isset($record)) ? stripslashes($record->views): set_value('views'); ?>" data-error="#views1">
                          <span id="views1" class="text-danger"><?php echo form_error('views'); ?></span> </div>
                      </div>
					  
					  <div class="form-group">
                        <label class="col-md-3 control-label" for="status"> Status <span class="reds"> </span></label>
                        <div class="col-md-8">
                          <select name="status" id="status" class="form-control cstm_select2" data-error="#status1">
                            <option value=""> Select Status </option>
							 <option value="0" <?php if(isset($_POST['status']) && $_POST['status']==0){ echo 'selected="selected"'; }else if(isset($record) && $record->status==0){ echo 'selected="selected"'; } ?>> Inactive </option>
                            <option value="1" <?php if(isset($_POST['status']) && $_POST['status']==1){ echo 'selected="selected"'; }else if(isset($record) && $record->status==1){ echo 'selected="selected"'; }  ?>> Active </option>  
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
                          <button type="button" class="btn border-slate text-slate-800 btn-flat" onClick="window.location='<?php echo site_url('admin/products/index'); ?>';"><i class="glyphicon glyphicon-chevron-left position-left"></i>Cancel</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
                 <script type="text/javascript">   
			$(document).ready(function(){ 
				var validator = $('#datas_form').validate({
				rules: {                
					product_name: {
						required: true 
					},
					links: {
						required: true, 
					},
					image: {
						required: true,
						accepts: 'jpg|joeg|png|gif';
					}   
				},
				messages: { 
					product_name: {
						required: "This is required field" 
					},
					links: {
						required: "This is required field", 
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
