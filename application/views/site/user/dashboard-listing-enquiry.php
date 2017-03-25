<?php 
$this->load->view('site/templates/header');
?>
<!---DASHBOARD-->
<div class="dashboard">
	<div class="main">
    	<div id="command_center">
    
            <ul id="nav">
                <li><a href="<?php echo base_url();?>dashboard">Dashboard</a></li>
                <li><a href="<?php echo base_url();?>inbox">Inbox</a></li>
                <li class="active"><a href="<?php echo base_url();?>listing/all">Your Listing</a></li>
                <li><a href="<?php echo base_url();?>trips/upcoming">Your Trips</a></li>
                <li><a href="<?php echo base_url();?>settings">Profile</a></li>
                <li><a href="<?php echo base_url();?>account">Account</a></li>
                <li><a href="<?php echo base_url();?>plan">Plan</a></li>
            </ul>    
            <ul class="subnav">
                <li><a href="<?php echo base_url();?>listing/all">Manage Listings</a></li>
                <li><a href="<?php echo base_url();?>listing-reservation">Your Reservations</a></li>
                <li><a href="<?php echo base_url();?>listing-requirement">Reservation Requirements</a></li>
                <!--<li><a href="<?php echo base_url();?>listing-booking">Booking</a></li>
                <li   class="active"><a href="#">Enquiry</a></li>-->
            </ul>
            
            <div class="box" id="my_listings">
                <div class="middle">
                <?php if($bookedRental->num_rows() >0)
				   			    { ?>
                       <table width="100%" border="0" cellspacing="0" cellpadding="0" class="member_ship" id="productListTable">
                     		<thead>
 							 <tr height="40px"><!--<td width="15%" style="background:#f5f5f5;" ><strong>Status</strong></td>-->
   							 <td width="10%" style="background:#f5f5f5;"><strong>Dates and Location</strong></td>
   							 <td width="30%" style="background:#f5f5f5;" ><strong>Guest</strong></td>
   							 <td width="20%" style="background:#f5f5f5;"><strong>Details</strong></td>
   							 </tr>
							</thead>
                         
                 				   <?php 
								  // echo '<pre>';print_r($bookedRental->result());die;
								   
								   
								   /*echo $datebyPropid->row()->the_date;
								   echo count($datebyPropid);*/
								   
								   foreach($bookedRental->result() as $row)
									    	{ ?>
                                    
                                        <tbody>
                                       <!-- <td><p style=" color: #000; font-weight: bold;  margin-right: 80px;">Status</p></td>-->
                                        
                                        <td> <?php echo "<br>".date('M d',strtotime($row->checkin))." - ".date('d, Y',strtotime($row->checkout))."<br>";
												   echo "<a href='".base_url()."rental/".$row->product_id."'>".$row->product_title."</a><br>";
												   echo $row->address."<br>";
												   echo $row->city_name.",".$row->state_name." ".$row->post_code."<br>";
												   echo $row->country_name;
												   ?>
										</td>
                                        <td><img src="<?php echo base_url(); ?>images/users/<?php if($row->image == '') echo "owner_img.png"; else echo $row->image;?>" width="100" height="100" alt="image"/> &nbsp;&nbsp;<a href="javascript:void(0);" style="float:right; margin-right:247px;"><?php echo $row->firstname;?></a></td>
                                        <td><?php echo strtoupper($currencySymbol)." ".round(CurrencyValue($row->product_id ,$row->price ),2)." total";?> </td>
                                        </tbody>
                                        	<?php	} ?>
                                        </table>
                                       <?php } 
									else
										{ ?>
                            
							<p class="no_listings">
                 				You have no reservations.<br>
                       			<a href="<?php echo base_url()."list_space"; ?>">Create a new listing</a>.
                  			 </p>
							<?php 
							}
							?>
                        <div class="show_all_reservations">
                           <!-- <a href="#=1">View past reservation history</a>-->
                        </div>
                </div>
    </div>
           
  </div>
    </div>
</div>
<!---DASHBOARD-->
<!---FOOTER-->
<?php 
$this->load->view('site/templates/content_above_footer');
$this->load->view('site/templates/footer');
?>