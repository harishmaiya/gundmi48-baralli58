<select class="chzn-select required" name="submenu" tabindex="-1" style="width: 375px; display: none;" data-placeholder="Please select the Sub Menu">
	<option value=""></option>
<?php 

	foreach ($ajaxsub as $row){
?>
	<option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
<?php }?>
</select>