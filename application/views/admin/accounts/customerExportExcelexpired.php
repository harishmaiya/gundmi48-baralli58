<?php
header("Content-type: application/octet-stream");
//header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Renters_Expired_.".date('Y-m-d').".xls");
header("Pragma: no-cache");
header("Expires: 0");
$this->load->model('order_model');




?>
<?php
$XML .= '<table>
	<tr>
    	<td colspan="2" align="right">Date :</td>
		<td colspan="2" align="left">'. date('Y-m-d'). '</td>
		<td colspan="3" align="right">Title :</td>
        <td colspan="3" align="left">'.$this->config->item('site_title').' Account '.$status.' List</td>
        
	</tr>
	<tr>
    	<td colspan="11">&nbsp;</td>
	</tr>
	</table>';	
		
$XML .= '<table border="1">
	<tr>
    	<th>S No</th>
		<th>Booking No</th>
        <th>Date</th> 
		<th>Property ID</th>		
		<th>Guest Email</th>
		<th>Guest Contact</th>
		<th>Host Email</th>
		<th>Host Contact</th>
		<th>Booking Status</th>
        
        
    </tr>';
$sno = 1;
foreach($getCustomerDetails as $myrow) {
            
     $bookedstatus = $status;
	$bookedstatus = $status;
	 $guestdetail = $this->order_model->get_all_details(USERS,array('id'=>$myrow[renter_id])); 		
	$XML .='<tr>
    	<td style="text-align:left">'.$sno.'</td>
		<td style="text-align:left">'.ucfirst($myrow[Bookingno]).'</td>
        <td style="text-align:left">'.date('d-m-Y',strtotime($myrow[dateAdded])).'</td>
        <td style="text-align:left">'.ucfirst($myrow[prd_id]).'</td>
        <td style="text-align:left">'.$myrow['email'].'</td>
		
        <td style="text-align:left">'.$myrow[phone_no].'</td>
		<td style="text-align:left">'.$guestdetail->row()->email.'</td>
		<td style="text-align:left">'.$guestdetail->row()->phone_no.'</td>
        <td style="text-align:left">'.$bookedstatus.'</td>
    </tr>';
	$sno=$sno+1;

}
	$XML .='</table>';	
echo $XML;


?>
                                                               