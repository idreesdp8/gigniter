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
				<label class="col-md-3 control-label lbl" for="page_name"> Page Name </label>
				<div class="col-md-8">
					<?php echo (isset($record)) ? stripslashes($record->page_name): ''; ?>
				</div>
				</div>  
				<div class="form-group">
				<label class="col-md-3 control-label lbl" for="page_slug"> Slug </label>
				<div class="col-md-8">
					<?php echo (isset($record)) ? stripslashes($record->page_slug): ''; ?>
				</div>
				</div>
				 
				<div class="form-group">
				<label class="col-md-3 control-label lbl" for="meta_title"> Meta Title </label>
				<div class="col-md-8">
					<?php echo (isset($record)) ? stripslashes($record->meta_title): ''; ?>
				</div>
				</div>
				
				<div class="form-group">
				<label class="col-md-3 control-label lbl" for="meta_keyword"> Meta Keyword </label>
				<div class="col-md-8">
					<?php echo (isset($record)) ? stripslashes($record->meta_keyword): ''; ?>
				</div>
				</div>
				
				<div class="form-group">
				<label class="col-md-3 control-label lbl" for="meta_description"> Meta Description </label>
				<div class="col-md-8">
					<?php echo (isset($record)) ? stripslashes($record->meta_description): ''; ?>
				</div>
				</div> 
				
				<div class="form-group">
				<label class="col-md-3 control-label lbl" for="summary"> Summary </label>
				<div class="col-md-8">
					<?php echo (isset($record)) ? stripslashes($record->summary): ''; ?>
				</div>
				</div>
				
				<div class="form-group">
				<label class="col-md-3 control-label lbl" for="details"> Detail </label>
				<div class="col-md-8">
					<?php echo (isset($record)) ? stripslashes($record->details): ''; ?>
				</div>
				</div>
				
			    <div class="form-group">
					<label class="col-md-3 control-label lbl" for="status">Status </label>
					<div class="col-md-8">
				 	<a><span class="label label-success"> 
					<?php 
						if($record->status==0){ 
							echo 'Inactive';
						}else if($record->status==1){ 
							echo 'Active';
						}  ?></span> </a>
				  </div>
			  </div> 
				
				<div class="form-group">
				<label class="col-md-3 control-label lbl" for="added_on">Added On </label>
				<div class="col-md-8">
					<?php echo date('d-M-Y H:i:s',strtotime($record->added_on)); ?>
				 </div>
				</div>
			</div> 
		</div>
   </form> 
</div>
