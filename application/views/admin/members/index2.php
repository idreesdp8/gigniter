<?php
	if(isset($records) && count($records)>0){
	$sr=1; 
	if(isset($page) && $page >0){
		$sr = $page+1;
	} 
	
	foreach($records as $record){  
		$operate_url = 'admin/members/update/'.$record->id;
		$operate_url = site_url($operate_url);
		
		$trash_url = 'admin/members/trash_aj/'.$record->id;
		$trash_url = site_url($trash_url); ?>    
		   <tr class="<?php echo ($sr%2==0)?'gradeX':'gradeC'; ?>">
				<td><div class="checkbox"> <label for="status"> <input type="checkbox" name="multi_action_check[]" id="multi_action_check_<?php echo $record->id; ?>" value="<?php echo $record->id; ?>" class="styled"> <?php echo $sr; ?> </label> </div>						</td> 
				<td><?= stripslashes($record->first_name).' '.stripslashes($record->last_name); ?></td>	 
				<td><?= stripslashes($record->email); ?></td>
				<td><?= stripslashes($record->mobile_no); ?></td> 
				<td class="text-center">   
				<?php  
					if($record->status==0){ ?> 
					<a><span class="label label-danger"> Pending </span> </a>
				<?php }else if($record->status==1){ ?> 
					<a><span class="label label-success"> Active </span> </a>
				<?php }else{ ?> 
					<a><span class="label label-danger"> Suspended </span> </a> 
				<?php } ?>						</td>
				<td class="text-center"><?= date('d-M-Y H:i:s',strtotime($record->created_on)); ?></td>
				<td class="text-center"> 
				   <ul class="icons-list">  
					   <li class="text-primary-600"><a href="javascript:void(0);" onClick="return view_member_data('<?php echo $record->id; ?>');"  data-toggle="modal" data-target="#modal_remote_data_detail"><i class=" icon-equalizer3"></i></a></li>    
					   <li class="text-primary-600"><a href="<?php echo $operate_url; ?>"><i class="icon-pencil7"></i></a></li>
					   <li class="text-danger-600"><a href="javascript:void(0);" onClick="return operate_deletions('<?php echo $trash_url; ?>','<?php echo $record->id; ?>','dyns_list');"><i class="icon-trash"></i></a></li> 
				   </ul>
				   </td> 
				</tr>  
		<?php 
			$sr++;
			} ?> 
			<tr>
			   <td colspan="7">
			   <div style="float:left;"> <select name="per_page" id="per_page" class="form-control input-sm mb-md cstm_select2" onChange="operate_members_list();">
		  <option value="25"> Pages</option>
		  <option value="25" <?php echo (isset($_SESSION['tmp_per_page_val']) && $_SESSION['tmp_per_page_val']==25) ? 'selected="selected"':''; ?>> 25 </option>
		  <option value="50" <?php echo (isset($_SESSION['tmp_per_page_val']) && $_SESSION['tmp_per_page_val']==50) ? 'selected="selected"':''; ?>> 50 </option>
		  <option value="100" <?php echo (isset($_SESSION['tmp_per_page_val']) && $_SESSION['tmp_per_page_val']==100) ? 'selected="selected"':''; ?>> 100 </option> 
		</select>  </div>
        <div style="float:right;"> <?php echo $this->ajax_pagination->create_links();?></div></td>  
      </tr> 
	<?php   
	}else{ ?> 
	  <tr>
	   <td colspan="7" align="text-center" style="text-align:center;">
	   <div style="float:left;"> <select name="per_page" id="per_page" class="form-control input-sm mb-md cstm_select2" onChange="operate_members_list();">
		  <option value="25"> Pages</option>
		  <option value="25"> 25 </option>
		  <option value="50"> 50 </option>
		  <option value="100"> 100 </option> 
		</select>  </div>
		<div>  <strong> No Record Found! </strong></div>  </td>  
	  </tr> 
<?php } ?>    