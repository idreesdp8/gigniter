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
				<label class="col-md-3 control-label lbl" for="brand_code"> Code </label>
				<div class="col-md-6"> 
					<?php echo (isset($record) && strlen($record->brand_code)>0) ? 'xxxx'.substr($record->brand_code, -4) : ''; ?>
				</div>
				<div class="col-md-2">
				<?php if(strlen($record->brand_certificate_link)>0) {?>
					<a href="<?php echo $record->brand_certificate_link;?>" target="_blank"><span class="label bg-blue heading-text">View Card</span></a>
				<?php } ?>
				</div> 
			</div> 
			
			<div class="form-group">    
				<label class="col-md-3 control-label lbl" for="pin_code"> Pin Code </label>
				<div class="col-md-8">
					<?php echo (isset($record)) ? stripslashes($record->pin_code): ''; ?>
				</div>  
			</div>
			
			<div class="form-group"> 
				<label class="col-md-3 control-label lbl" for="brand_name"> Order Reference No </label>
				<div class="col-md-8">
				<?php   
					if($record->code_creation_by ==1){
						echo "AMC order # ".$record->ord_reference_no;
					}else if($record->code_creation_by ==2){
						echo "File Upload order # ".$record->ord_reference_no;
					}else if($record->code_creation_by ==3){ 
						echo "Incomm order # ".$record->ord_reference_no;
					}else if($record->code_creation_by ==4){ 
						echo "NGC order # ".$record->ord_reference_no;
					}else{ 
						echo $record->ord_reference_no;
					}   
					 ?>
				</div>
			</div>
			
			<div class="form-group"> 
				<label class="col-md-3 control-label lbl" for="brand_name"> Brand name </label>
				<div class="col-md-8">
					<?php echo (isset($record)) ? stripslashes($record->brand_name): ''; ?>
				</div>
			</div> 
			<div class="form-group">   
				<label class="col-md-3 control-label lbl" for="denomination_name"> Denomination </label>
				<div class="col-md-8">
					<?php echo (isset($record)) ? stripslashes($record->denomination_val): ''; ?>
				</div>
			</div> 
			
			
			<div class="form-group"> 
				<label class="col-md-3 control-label lbl" for="supplier_id"> Supplier </label>
				<div class="col-md-8">
					<?php  
						if(isset($record->supplier_id)){
							$rw1 = $this->general_model->get_user_info_by_id($record->supplier_id); 
							if(isset($rw1)){
								echo $rw1->name;
							}
						} ?>
				</div>
			</div> 
			
			<div class="form-group"> 
				<label class="col-md-3 control-label lbl" for="client_id"> Client </label>
				<div class="col-md-8"> 
					<?php  
						if(isset($record->client_id)){
							$rw2 = $this->general_model->get_user_info_by_id($record->client_id); 
							if(isset($rw2)){
								echo $rw2->name;
							}
						} ?>
				</div>
			</div> 
			
			<!--<div class="form-group"> 
			<label class="col-md-3 control-label lbl" for="created_date"> Created date </label>
			<div class="col-md-8">
				<?php echo (isset($record)) ? date('d-M-Y',strtotime($record->created_date)) : ''; ?>
			</div>
			</div>-->
			
			<div class="form-group">     
				<label class="col-md-3 control-label lbl" for="expiry_date"> Expiry date </label>
				<div class="col-md-8">
					<?php echo (isset($record)) ? date('d-M-Y',strtotime($record->expiry_date)) : ''; ?>
				</div>
			</div> 
	  
		   <div class="form-group">   
			<label class="col-md-3 control-label lbl" for="code_creation_by"> Source </label>
			<div class="col-md-8">
				<?php echo $this->general_model->get_integration_type_name($record->code_creation_by); ?> 
			</div>
		    </div> 
			
			<div class="form-group"> 
				<label class="col-md-3 control-label lbl" for="name"> Code Status </label>
				<div class="col-md-8">
					<?php  
						if($record->status==3){ ?> 
							<a><span class="label label-success">Redeem </span> </a>
					<?php }else if($record->status==2){ ?> 
							<a><span class="label label-danger">Expired</span> </a>
					<?php }else if($record->status==1){ ?> 
							<a><span class="label bg-blue">Active</span> </a> 
					<?php } ?> 
				</div>
			</div>
		  
		</div> 
	</div>
   </form> 
</div>
