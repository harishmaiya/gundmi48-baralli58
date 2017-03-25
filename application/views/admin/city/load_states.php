<select class="chzn-select required" name="stateid" tabindex="-1" style="width: 375px; display: none;" data-placeholder="Please select the state name">
	<option value=""></option>
<?php 
if ($states_list_value->num_rows()>0){
	foreach ($states_list_value->result_array() as $row){
?>
	<option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
<?php }}?>
</select>