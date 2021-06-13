<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('admin/layout/meta_tags'); ?>
<title>Update Email Template</title> 
</head>
<body>
<?php $this->load->view('admin/layout/header'); ?>
<div class="page-content">
  <?php $this->load->view('admin/layout/sidebar'); ?>
  <div class="content-wrapper">
    <div class="page-header page-header-light">
      <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
          <div class="breadcrumb"> <a href="<?php echo admin_base_url(); ?>dashboard" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a> <a href="<?php echo admin_base_url(); ?>email_templates/index" class="breadcrumb-item"> Email Templates</a> <span class="breadcrumb-item active">Update Email Template</span> </div>
          <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a> </div>
      </div>
    </div>
    <div class="content">
      <?php $this->load->view('alert/alert'); ?>
      <!-- Basic layout-->
      <div class="card">
        <div class="card-header header-elements-inline">
          <h5 class="card-title">Update Email Template</h5>
        </div>
		 <?php 
			$form_act = '';
			if(isset($args1) && $args1>0){
				$form_act = admin_base_url()."email_templates/update/".$args1;
			} ?>
			<script>
				function operate_email_slug(){
					var subject_val = document.getElementById('subject').value; 
					subject_val = subject_val.toLowerCase();
					subject_val = subject_val.trim();
					subject_val = subject_val.replaceAll(/ /ig, '-');
					subject_val = subject_val.replaceAll(/&/ig, 'and');
					subject_val = subject_val.replaceAll(/'/ig, '');
					subject_val = subject_val.replaceAll(/"/ig, '');
					document.getElementById('template_slug').value = subject_val;
				}
			</script>
			<form name="datas_form" id="datas_form" method="post" action="<?php echo $form_act; ?>" enctype="multipart/form-data">
          <div class="card-body">
            <div class="row">
              <div class="col-md-2">
                <label for="recipients">Recipient Email(s) <span class="text-danger">*</span></label>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Enter Recipient Email(s)" name="recipients" id="recipients" value="<?php echo (isset($record)) ? stripslashes($record->recipients) : set_value('recipients'); ?>" data-error="#recipients1" />
                  <span id="recipients1" class="text-danger" generated="true"><?php echo form_error('recipients'); ?></span> </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2">
                <label for="subject">Subject <span class="text-danger">*</span></label>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Mail Subject" value="<?php echo (isset($record)) ? stripslashes($record->subject) : set_value('subject'); ?>" data-error="#subject1" onKeyUp="operate_email_slug();" onBlur="operate_email_slug();" />
                  <span id="subject1" class="text-danger"><?php echo form_error('subject'); ?></span> </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2">
                <label for="template_slug">Template Slug <span class="text-danger">*</span></label>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <input type="text" name="template_slug" id="template_slug" class="form-control" placeholder="Enter Template Slug" value="<?php echo (isset($record)) ? stripslashes($record->template_slug) : set_value('template_slug'); ?>" data-error="#template_slug1" />
                  <span id="template_slug1" class="text-danger"><?php echo form_error('template_slug'); ?></span> </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2">
                <label for="content">Template Content <span class="text-danger">*</span></label>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <textarea name="content" id="content" cols="40" rows="6" placeholder="Enter Template Content" class="form-control" data-error="#content1"><?php echo (isset($record)) ? stripslashes($record->content) : set_value('content'); ?></textarea>
                  <span id="content1" class="text-danger"><?php echo form_error('content'); ?></span> </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2"> </div>
              <div class="col-md-7">
			  <?php if(isset($record)){	?>
					<input type="hidden" name="args1" id="args1" value="<?php echo $record->id; ?>"> 
					<button type="submit" name="update_record" class="btn btn-primary"><i class="icon-add mr-2"></i> Update </button>
					<button type="button" name="reset_btn" class="btn btn-secondary" onClick="window.location='<?php echo admin_base_url(); ?>email_templates/index';"><i class="icon-reset mr-1"></i> Cancel </button>
            <?php } ?>
			 
              </div>
            </div>
          </div>
        </form> 
      </div>
      <!-- /basic layout -->
    </div>
    <?php $this->load->view('admin/layout/footer'); ?>
  </div>
</div>
<script>
        $(document).ready(function() {
            $('#sidebar_user').addClass('nav-item-open');
            $('#sidebar_user ul').first().css('display', 'block');
            $('#sidebar_user_add a').addClass('active');

            var validator = $('#datas_form').validate({
                rules: {
                    recipients: {
                        required: true,
                    },
                    subject: {
                        required: true, 
                    },
                    template_slug: {
                        required: true, 
                    },
                    content: {
                        required: true, 
                    }
                },
                messages: {
					 recipients: {
                        required: "This is required field",
                    },
                    subject: {
                        required: "This is required field", 
                    },
                    template_slug: {
                        required: "This is required field", 
                    },
                    content: {
                        required: "This is required field", 
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
