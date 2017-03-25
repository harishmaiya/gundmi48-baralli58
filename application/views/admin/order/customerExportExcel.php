<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
header("Content-type: application/octet-stream");
//header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Renters_".$status."".date('m-d-Y').".xls");
header("Pragma: no-cache");
header("Expires: 0");
$this->load->model('user_model');


/*
<th>Transaction ID</th>		 
<td style="text-align:left">'.ucfirst($myrow[paypal_transaction_id]).'</td>
*/

?>
<?php
$XML .= '<table>
	<tr>
    	<td colspan="2" align="right">Date :</td>
		<td colspan="2" align="left">'. date('Y-m-d'). '</td>
		<td colspan="3" align="right">Title :</td>
        <td colspan="3" align="left">'.$this->config->item('site_title').' Finance '.$status.' List</td>
        
	</tr>
	<tr>
    	<td colspan="11">&nbsp;</td>
	</tr>
	</table>';	
		
$XML .= '<table border="1">
	<tr>
			<th>S no</th>
			<th>User Email</th> 
			<th>Payment Date</th>
			<th>Property Title</th>
			<th>Booking No</th>
			<th>Total</th>
			<th>Discount</th>
			<th>Paid</th>
			<th>Payment Type</th>
			<th>Status</th>
    </tr>';
$sno = 1;
foreach($getCustomerDetails as $myrow) {

     $bookedstatus = ($myrow[status]=="Pending")?"Failed":$myrow[status];
     $ptype = ($myrow[payment_type]=="Credit Cart")?"Credit Card":$myrow[payment_type]; 	
$discount_amount = $myrow['pro_totalAmt'] - $myrow['pro_discount_amount'];	 
if($myrow['pro_totalAmt'] != '')
$total = $myrow['pro_totalAmt'];
else
	$total = $myrow['total'];
	$XML .='<tr>
    	<td style="text-align:left">'.$sno.'</td>
		<td style="text-align:left">'.lcfirst($myrow[email]).'</td>
		<td style="text-align:left">'.date('m-d-Y',strtotime($myrow[created])).'</td>
		<td style="text-align:left">'.ucfirst($myrow[product_name]).'</td>
		<td style="text-align:left">'.ucfirst($myrow[bookingno]).'</td>
        <td style="text-align:left">'.$curr_symbol.' '.$total.'</td><td style="text-align:left">';
		if($myrow['discount_amount'] != 0.00)$XML .= $curr_symbol.' '.$discount_amount;
		$XML .='</td><td style="text-align:left">'.$curr_symbol.' '.$myrow['total'].'</td><td style="text-align:left">'.ucfirst($myrow["payment_type"]).'</td>
        <td style="text-align:left">'.$bookedstatus.'</td>
    </tr>';
	$sno=$sno+1;


}
	$XML .='</table>';	
echo $XML;


?>
                                                               