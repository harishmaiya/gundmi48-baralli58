<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
 header("Content-type: application/octet-stream");
//header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Receivable_and_payable-".date('Y-m-d').".xls");
header("Pragma: no-cache");
header("Expires: 0");
 $this->load->model('order_model');




?>
<?php
$XML .= '<table width=100%>
	<tr>
    	<td colspan="2" align="right">Date :</td>
		<td colspan="2" align="left">'. date('Y-m-d'). '</td>
		<td colspan="3" align="right">Title :</td>
        <td colspan="3" align="left">'.$this->config->item('site_title').' Account Receivable List</td>
        
	</tr>
	<tr>
    	<td colspan="11">&nbsp;</td>
	</tr>
	</table>';	
		
$XML .= '<table border="1">
	<tr>
    	<th>S No</th>
		<th>Date</th>
		<th>Booking No</th>
		<th>Host Email</th>
		<th>Total Amount</th>
		<th>Discount</th>
		<th>Paid</th>
		<th>Guest Service Fee</th>
		<th>Host Service Fee</th>
		<th>Net Profit</th>
		<th>Amount to Host</th>
    </tr>';
$sno = 1;
foreach ($commissionTracking->result() as $row){
    $total_value = $row->pro_total_amount-$row->pro_discount_amount;
	$net_pro = $row->pro_host_fee+$row->pro_guest_fee;
	$XML .='<tr>
    	<td style="text-align:left">'.$sno.'</td>
		<td style="text-align:left">'.date('d-m-Y',strtotime($row->dateAdded)).'</td>
        <td style="text-align:left">'.$row->booking_no.'</td>
        <td style="text-align:left">'.$row->host_email.'</td>
        <td style="text-align:left">'.$admin_currency_symbol.' '.$row->pro_total_amount.'</td>
		<td style="text-align:left">';
		if($row->discount_amount != 0.00) 
			$XML .= $admin_currency_symbol.' '. $row->pro_discount_amount;
		$XML .= '</td><td style="text-align:left">'.$admin_currency_symbol.' '.$total_value.'</td>
        <td style="text-align:left">'.$admin_currency_symbol.' '.$row->pro_guest_fee.'</td>
        <td style="text-align:left">'.$admin_currency_symbol.' '.$row->pro_host_fee.'</td>
        <td style="text-align:left">'.$admin_currency_symbol.' '.$net_pro.'</td>
		<td style="text-align:left">'.$admin_currency_symbol.' '.$row->pro_payable_amount.'</td>
    </tr>';
	$sno=$sno+1;

}
	$XML .='</table>';	
echo $XML;


?>
                                                               