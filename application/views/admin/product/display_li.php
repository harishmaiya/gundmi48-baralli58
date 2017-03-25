<ul>
<?php
foreach($result->result() as $row)
{
?>
<li>
<input type="checkbox" class="checkbox_check" name="sub_list[]" id="commonmost" style="margin-left:2em" value ="<?php echo $row->list_value_id; ?>_<?php echo $row->id; ?>"/><span><?php echo $row->sub_list_value; ?></span>
</li>
<?php
}
?>
</ul>