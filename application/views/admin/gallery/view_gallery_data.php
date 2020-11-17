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
          <label class="col-md-3 control-label lbl" for="title"> Title </label>
          <div class="col-md-8"> <?php echo (isset($record)) ? stripslashes($record->title): ''; ?> </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label lbl" for="image"> Image </label>
          <div class="col-md-8"> <img src="http://localhost/ci/family_reunion/downloads/galleries_images/<?php echo (isset($record)) ? stripslashes($record->image): ''; ?>" title="<?php echo (isset($record->title)) ? stripslashes($record->title): ''; ?>" alt="<?php echo (isset($record->title)) ? stripslashes($record->title): ''; ?>" width="120px" /> </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label lbl" for="status">Status </label>
          <div class="col-md-8"> <a><span class="label label-success">
            <?php 
				if($record->status==0){ 
					echo 'Inactive';
				}else if($record->status==1){ 
					echo 'Active';
				}  ?> </span> </a> </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label lbl" for="country">Added On </label>
          <div class="col-md-8"> <?php echo date('d-M-Y H:i:s',strtotime($record->added_on)); ?> </div>
        </div>
      </div>
    </div>
  </form>
</div>
