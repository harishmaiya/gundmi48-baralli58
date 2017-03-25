<?php 
$data = '';
$title = '<table>
	<tr>
    	<td colspan="2" align="right">Date :</td>
		<td colspan="2" align="left">'. date('Y-m-d'). '</td>
		<td colspan="3" align="right">Title :</td>
        <td colspan="3" align="left">'.$this->config->item('site_title').' User Details</td>
        
	</tr>
	<tr>
    	<td colspan="11">&nbsp;</td>
	</tr>
	</table>';	

$header = $title.'<table border="1"><tr>';

$field_count = (array) $users_detail[0];
$field_count=count($field_count);
 foreach ($users_detail[0] as $table_field=>$field_value)
    {
 $field_count--;
 $header .= '<th>'.$table_field.'</th>';
 if($field_count==0)
 {
 $header .= '</tr>';
 }
    } 
 foreach ($users_detail as $field_name=>$field_values)
		{
		$data .= '<tr>';
		foreach ($field_values as $field=>$field_value)
		{
		$data .= '<td style="text-align:left">'.$field_value.'</td>';
        }
		$data .='</tr>';
       } 
		$data =$header.$data;
		
if ( $data == "" )
{
    $data = "\nNo Record(s) Found!\n";                        
}
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Renters.xls");
header("Pragma: no-cache");
header("Expires: 0");
print "$data";
?>