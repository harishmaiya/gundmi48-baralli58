<?php
header("Content-type: application/octet-stream");
//header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=airbnbclone-".date('Y-m-d').".xls");
header("Pragma: no-cache");
header("Expires: 0");
$this->load->model('user_model');
?>
<?php
/*$XML = "Date\t". date('Y-m-d'). "\nTitle\t ".$this->config->item('site_title')." Renters Details List\n\n\tNo\tFirstName\tLastName\tEmail\tDate Registered\tDaily Alerts\tWeekly Alerts\tMonthly Alerts\tLast Login\tLogin IP\tStatus\n";
$file =$this->config->item('site_title')."_Order_details_". date("Y-m-d"). ".xls";
$sno = 1;
foreach($getCustomerDetails as $myrow) {
								$this->load->model('user_model');
								  $a = $this->user_model->get_users_alert_details($myrow['id'],'Daily');
								  $getAvalue= $a->num_rows();
								  $b = $this->user_model->get_users_alert_details($myrow['id'],'Weekly');
								  $getBvalue= $b->num_rows();
								  $c = $this->user_model->get_users_alert_details($myrow['id'],'Monthly');
								  $getCvalue= $c->num_rows();
	$XML.= "\t";
	$XML.= $sno. "\t";
	$XML.= $myrow[first_name]. "\t";
	$XML.= $myrow[last_name]. "\t";
	$XML.= $myrow[email]. "\t";
    $XML.= date('Y-m-d',strtotime($myrow[created])). "\t";
	$XML.= $getAvalue. "\t";
	$XML.= $getBvalue. "\t";
	$XML.= $getCvalue. "\t";
	$XML.= date('Y-m-d',strtotime($myrow[last_login_date])). "\t";
    $XML.= $myrow[last_login_ip]. "\t";
	$XML.= $myrow[status]. "\n";
	$sno=$sno+1;
	
}
		
echo $XML;*/
$XML .= '<table>
	<tr>
    	<td colspan="2" align="right">Date :</td>
		<td colspan="2" align="left">'. date('Y-m-d'). '</td>
		<td colspan="3" align="right">Title :</td>
        <td colspan="3" align="left">'.$this->config->item('site_title').' Rentals List</td>
        
	</tr>
	<tr>
    	<td colspan="11">&nbsp;</td>
	</tr>
	</table>';	
		
$XML .= '<table border="1">
	<tr>
    	<th>No</th>
        <th>Rantal Name</th>       
        <th>Price</th>
		<th>Location</th>
		<th>Featured</th>
        
        <th>Status</th>
    </tr>';
$sno = 1;
foreach($getCustomerDetails as $myrow) {

								 /* $a = $this->user_model->get_users_alert_details($myrow['id'],'Daily');
								  $getAvalue= $a->num_rows();
								  $b = $this->user_model->get_users_alert_details($myrow['id'],'Weekly');
								  $getBvalue= $b->num_rows();
								  $c = $this->user_model->get_users_alert_details($myrow['id'],'Monthly');
								  $getCvalue= $c->num_rows();*/
	$XML .='<tr>
    	<td style="text-align:left">'.$sno.'</td>
        <td style="text-align:left">'.ucfirst($myrow[product_title]).'</td>
        <td style="text-align:left">'.ucfirst($myrow[price]).'</td>
        <td style="text-align:left">'.ucfirst($myrow[city]).'</td>
        <td style="text-align:left">'.ucfirst($myrow[featured]).'</td>
      
        <td style="text-align:left">'.$myrow[status].'</td>
    </tr>';
	$sno=$sno+1;

}
	$XML .='</table>';	
echo $XML;

    
    







?>
                                                               