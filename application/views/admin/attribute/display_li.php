<li>
<div class="form_grid_12">
<input type="hidden" value"" id="amenities"/>
<label class="field_title" for="list_value">List Value<span class="req">*</span></label>
<div class="form_input">
<select class="required" name="list_value_id" tabindex="-1" style="width: 375px;" data-placeholder="Select List" id="select2">
<option value="">select list value</option>
<?php 
foreach ($sub_list_details->result() as $row){
if ($row->attribute_name!='price'){
?>
<option value="<?php echo $row->id;?>"><?php echo $row->list_value;?></option>
<?php }}?>
</select>
</div>
</div>
</li>