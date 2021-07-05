<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('admin/layout/meta_tags'); ?>
<title>Update My Profile</title> 
</head>
<body>
<?php $this->load->view('admin/layout/header'); ?>
<div class="page-content">
  <?php $this->load->view('admin/layout/sidebar'); ?>
  <div class="content-wrapper">
    <div class="page-header page-header-light">
      <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
          <div class="breadcrumb"> <a href="<?php echo admin_base_url(); ?>dashboard" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a> <span class="breadcrumb-item active">Update Profile</span> </div>
          <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a> </div>
      </div>
    </div>
    <div class="content">
      <?php $this->load->view('alert/alert'); ?>
      <!-- Basic layout-->
      <div class="card">
        <div class="card-header header-elements-inline">
          <h5 class="card-title">Update Profile</h5>
        </div>  
		<div class="card-body"> 
		<form name="datas_form" id="datas_form" method="post" action="<?php echo site_url('admin/settings/my_profile'); ?>" class="form-horizontal" enctype="multipart/form-data">
		 
			<div class="row">
				<div class="col-md-6"> 
				  <div class="form-group">
					<label for="fname">First Name: </label>
					<input name="fname" id="fname" type="text" class="form-control" value="<?php echo (isset($row)) ? $row->fname : set_value('fname'); ?>" data-error="#fname1">
					<span id="fname1" class="text-danger"><?php echo form_error('fname'); ?></span>
				  </div>
				  <div class="form-group">
					<label for="lname">Last Name <span class="reds"> </span></label>
					 <input name="lname" id="lname" type="text" class="form-control" value="<?php echo (isset($row)) ? $row->lname : set_value('lname'); ?>" data-error="#lname1">
				  <span id="name1" class="text-danger"><?php echo form_error('lname'); ?></span>
				  </div>   
				  
				  <div class="form-group">
					<label  for="email">Email <span class="reds">*</span> </label>
					<input name="email" id="email" type="text" class="form-control" value="<?php echo (isset($row)) ? $row->email : set_value('email'); ?>" readonly disabled="disabled">
					<span id="email1" class="text-danger"><?php echo form_error('email'); ?></span>
				  </div>
				  <div class="form-group">
					<label for="phone_no">Phone No <span class="reds">*</span></label>
					  <input name="phone_no" id="phone_no" type="text" class="form-control" value="<?php echo (isset($row)) ? $row->phone_no : set_value('phone_no'); ?>" data-error="#phone_no1">
				  	  <span id="phone_no1" class="text-danger"><?php echo form_error('phone_no'); ?></span> 
				  </div>  
				  
				   <div class="form-group">
					<label for="mobile_no">Mobile No <span class="reds">*</span></label>
					 <input name="mobile_no" id="mobile_no" type="text" class="form-control" value="<?php echo (isset($row)) ? $row->mobile_no : set_value('mobile_no'); ?>" data-error="#mobile_no1">
				  <span id="mobile_no1" class="text-danger"><?php echo form_error('mobile_no'); ?></span> 
				  </div>  
				</div> 
				
				 <div class="col-md-6"> 
				  <div class="form-group">
					<label for="description">Description</label></label>
					 <textarea name="description" id="description" class="form-control" rows="5" data-error="#description1"><?php echo (isset($row)) ? $row->description : set_value('description'); ?></textarea>
				  <span class="text-danger"><?php echo form_error('description'); ?></span> 
				  </div>
				  <div class="form-group">
					<label  for="address">Address <span class="reds">*</span></label>
					 <textarea name="address" id="address" class="form-control" rows="5" data-error="#address1"><?php echo (isset($row)) ? $row->address : set_value('address'); ?></textarea>
				  <span id="address1" class="text-danger"><?php echo form_error('address'); ?></span>
				  </div> 
				  
				  <div class="form-group">
					<label for="image">Picture <span class="reds">*</span></label>
					<input type="file" name="image" id="image" class="file-styled" data-error="#image1">
					<?php if(isset($row->image) && strlen($row->image)>0){ ?>
					<input type="hidden" name="old_image" id="old_image" value="<?php echo $row->image; ?>">
					<?php echo '( '.$row->image.'	)'; } ?> <span id="image1" class="text-danger">
					<?php 
						echo form_error('image'); 
						if(isset($_SESSION['prof_img_error'])){
							echo $_SESSION['prof_img_error'];
						} ?>
					</span>  
				   
				  </div> 
				</div>
			</div>
  		 
			 <div class="text-right">
				<button type="submit" name="updates" id="updates" class="btn btn-primary">Update Profile <i class="icon-paperplane ml-2"></i> </button>
			  </div>  
		</form>  
		</div>
      </div>
      <!-- /basic layout -->
    </div>
    <?php $this->load->view('admin/layout/footer'); ?>
  </div>
</div>
<script type="text/javascript">  
	$(document).ready(function(){ 
		var validator = $('#datas_form').validate({
		rules: {    
			fname: {
				required: true 
			},  
			phone_no: {
				required: true,
				digits: true 
			},
			mobile_no: {
				required: true,
				digits: true 
			}, 
			address: {
				required: true 
			}, 
			image: {
				required: false,
				accept:"gif|png|jpg|jpeg" 
			}  
		},
		messages: { 
			fname: {
				required: "This is required field" 
			},  
			phone_no: {
				required: "This is required field",
				digits: "Enter a Numbers only!" 
			},
			mobile_no: {
				required: "This is required field",
				digits: "Enter a Numbers only!" 
			}, 
			address: {
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
</body>
</html>
