<?php
header("Content-type: application/octet-stream");
//header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Payable_".date('Y-m-d').".xls");
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
        <td colspan="3" align="left">'.$this->config->item('site_title').' Account Payable List</td>
        
	</tr>
	<tr>
    	<td colspan="11">&nbsp;</td>
	</tr>
	</table>';	
		
$XML .= '<table border="1">
	<tr>
    	<th>S No</th>
		<th>Booking No</th>
        <th>Property ID</th>		
		<th>Check In</th>
		<th>Check Out</th>
        <th>Transaction Id</th>
		<th>Transaction Date</th>
		<th>Transaction Method</th>
        <th>Amount</th>
    </tr>';
$sno = 1;
foreach ($newbookingList->result() as $row){
    	
	$XML .='<tr>
    	<td style="text-align:left">'.$sno.'</td>
		<td style="text-align:left">'.$row->Bookingno.'</td>
        <td style="text-align:left">'.$row->prd_id.'</td>
        <td style="text-align:left">'.date('d-m-Y',strtotime($row->checkin)).'</td>
        <td style="text-align:left">'.date('d-m-Y',strtotime($row->checkout)).'</td>
        <td style="text-align:left">'.$row->transaction_id.'</td>
        <td style="text-align:left">'.$row->transaction_date.'</td>
        <td style="text-align:left">Paypal</td>
        <td style="text-align:left">'.$row->totalAmt.'</td>
      </tr>';
	$sno=$sno+1;

}
	$XML .='</table>';	
echo $XML;


?>
                                                               