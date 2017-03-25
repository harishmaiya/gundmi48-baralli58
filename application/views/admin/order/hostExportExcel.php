<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
header("Content-type: application/octet-stream");
//header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Renters_listing_".date('m-d-Y').".xls");
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
        <td colspan="3" align="left">'.$this->config->item('site_title').' Finance Host List</td>
        
	</tr>
	<tr>
    	<td colspan="11">&nbsp;</td>
	</tr>
	</table>';	
		
$XML .= '<table border="1">
	<tr>
    	<th>No</th>
		<th>Order Id</th>
        <th>User Email</th> 
        <th>Property Title</th> 
		<th>Transaction ID</th>		
		<th>Total</th>
		<th>Payment Date</th>
		<th>Payment Type</th>
        
        <th>Status</th>
    </tr>';
$sno = 1;
foreach($getCustomerDetails as $myrow) {

     $bookedstatus = ($myrow[status]=="Pending")?"Failed":$myrow[status];
			
	$XML .='<tr>
    	<td style="text-align:left">'.$sno.'</td>
		<td style="text-align:left">'.ucfirst($myrow[bookingId]).'</td>
        <td style="text-align:left">'.lcfirst($myrow[email]).'</td>
        <td style="text-align:left">'.lcfirst($myrow[prd_name]).'</td>
        <td style="text-align:left">'.ucfirst($myrow[paypal_txn_id]).'</td>
        <td style="text-align:left">'.$curr_symbol.' '.AdminCurrencyValue($myrow['product_id'] ,$myrow['amount']).'</td>
		<td style="text-align:left">'.date('m-d-Y',strtotime($myrow[created])).'</td>
        <td style="text-align:left">'.ucfirst($myrow[payment_type]).'</td>
        <td style="text-align:left">Paid</td>
    </tr>';
	$sno=$sno+1;


}
	$XML .='</table>';	
echo $XML;


?>
                                                               