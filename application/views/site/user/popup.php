<div class="main">
	<div class="dashboard_full">
    					<div class="dashboard_full_tex">
                     <div class="right_dashboard_content">
                     <table width="100%" border="0" cellspacing="0" cellpadding="0" class="property_table">
 
<?php /*?><?php foreach($InquirieDisplay->result() as $InquiryRow){ ?><?php */?>
  <tr>
 		<td width="10%">Rental Name</td>
 			<?php /*?><?php foreach($ProductDisplay->result() as $ProductRow){ 
   				if($ProductRow->id==$InquiryRow->rental_id){?><?php */?>
 					<td width="20%"<?php /*?>><?php echo $ProductRow->product_title; ?></td> <?php } } ?><?php */?>
  </tr>
  <tr>
  	    <td width="20%">First Name</td>
  		<td width="60%">1<?php /*?><?php echo $InquiryRow->firstname; ?><?php */?></td>
  </tr>
  <tr>
  		<td width="20%">Last Name</td>
    	<td width="60%">2</td>
  </tr>
  <tr>
  		<td width="20%">Email</td>
    	<td width="60%">3</td>
  </tr>
  <tr>
  		<td width="20%">Phone</td>
    	<td width="60%">4</td>
  <tr>
  		<td width="20%">Arrival Date</td>
        <td width="60%">5</td>
  </tr>
  <tr>
  		<td width="20%">Depature Date</td>
     	<td width="60%">6</td>
  </tr>
  <tr>
  		<td width="20%">Adults</td>
    	<td width="60%">7</td>
  </tr>
  <tr>
  		<td width="20%">Children</td>
    	<td width="60%">8</td>
  </tr>
  <tr>	
  		<td width="20%">Comments</td>
        <td width="60%">9</td>
  </tr>
 <?php /*?><?php } ?>	<?php */?>
</table>
     </div>
          </div>
            </div>
              </div>
   </body>
</html>