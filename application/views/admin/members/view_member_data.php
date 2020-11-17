<div class="content" style="padding-bottom:0px;"> 
<style>
	label.lbl {
		margin: 0px !important;
		padding: 0px !important; 
		font-weight:bold;
	}
	
	label.lbl_r {
		margin: 0px !important;
		padding: 0px !important; 
		text-align:right;
	}
	
</style>
   <form name="view_datas_form" id="view_datas_form" method="post" action="" class="form-horizontal">
		<div class="row">
			<div class="col-md-9">
				<div class="form-group">
				<label class="col-md-3 control-label lbl" for="first_name"> First Name </label>
				<div class="col-md-8">
					<?php echo (isset($record)) ? stripslashes($record->first_name): ''; ?>
				</div>
				</div>  
				<div class="form-group">
				<label class="col-md-3 control-label lbl" for="last_name"> Last Name </label>
				<div class="col-md-8">
					<?php echo (isset($record)) ? stripslashes($record->last_name): ''; ?>
				</div>
				</div>
				 
				<div class="form-group">
				<label class="col-md-3 control-label lbl" for="email"> Email </label>
				<div class="col-md-8">
					<?php echo (isset($record)) ? stripslashes($record->email): ''; ?>
				</div>
				</div>
				
				<div class="form-group">
				<label class="col-md-3 control-label lbl" for="phone_no"> Phone Number </label>
				<div class="col-md-8">
					<?php echo (isset($record)) ? stripslashes($record->phone_no): ''; ?>
				</div>
				</div>
				
				<div class="form-group">
				<label class="col-md-3 control-label lbl" for="template_contents"> Mobile Number </label>
				<div class="col-md-8">
					<?php echo (isset($record)) ? stripslashes($record->mobile_no): ''; ?>
				</div>
				</div> 
				
				<div class="form-group">
				<label class="col-md-3 control-label lbl" for="address"> Address </label>
				<div class="col-md-8">
					<?php echo (isset($record)) ? stripslashes($record->address): ''; ?>
				</div>
				</div>
				
			    <div class="form-group">
					<label class="col-md-3 control-label lbl" for="status">Status </label>
					<div class="col-md-8">
				 	<a><span class="label label-success"> 
					<?php 
						if($record->status==0){ 
							echo 'Pending';
						}else if($record->status==1){ 
							echo 'Active';
						}else if($record->status==2){ 
							echo 'Suspended';
						} ?></span> </a>
				  </div>
			  </div> 
				
				<div class="form-group">
				<label class="col-md-3 control-label lbl" for="country">Added On </label>
				<div class="col-md-8">
					<?php echo date('d-M-Y H:i:s',strtotime($record->created_on)); ?>
				 </div>
				</div>
			</div> 
		</div>
   </form> 
</div>
