<?php
header("Content-type: application/octet-stream");
//header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Member_List_".date('m-d-Y').".xls");
header("Pragma: no-cache");
header("Expires: 0");
$this->load->model('user_model');
?>
<?php
$XML .= '<table>
	<tr>
    	<td colspan="2" align="right">Date :</td>
		<td colspan="2" align="left">'. date('Y-m-d'). '</td>
		<td colspan="3" align="right">Title :</td>
        <td colspan="3" align="left">'.$this->config->item('site_title').' Member List</td>
        
	</tr>
	<tr>
    	<td colspan="11">&nbsp;</td>
	</tr>
	</table>';	
		
$XML .= '<table border="1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<tr>
    	<th>S.NO</th>
    	<th>Member ID</th>
        <th>FirstName</th>       
        <th>LastName</th>       
		<th>Email</th>
		<th>Verify</th>
		<th>Created Date</th>
		<th>Status</th>
        

    </tr>';
$sno = 1;
foreach($users_detail as $myrow) {
	
	$XML .='<tr>
    	
		<td style="text-align:left">'.ucfirst($sno).'</td>
		<td style="text-align:left">'.ucfirst($myrow[id]).'</td>
        <td style="text-align:left">'.ucfirst($myrow[firstname]).'</td>
        <td style="text-align:left">'.ucfirst($myrow[lastname]).'</td>
        <td style="text-align:left">'.lcfirst($myrow[email]).'</td>
		<td style="text-align:left">'.ucfirst($myrow[is_verified]).'</td>
        <td style="text-align:left">'.ucfirst($myrow[created]).'</td>
        <td style="text-align:left">'.ucfirst($myrow[status]).'</td>
      
        
    </tr>';
	$sno=$sno+1;

}
	$XML .='</table>';	
echo $XML;

?>
                                                               