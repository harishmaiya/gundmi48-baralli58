<?php
$this->load->view('admin/templates/header.php');
//echo '<pre>';print_r($admin_replay->result());die;
extract($privileges);
?>
<form action="admin/contact_us/replaymail1" method="post" class="replaymail-con">
	<ul>				
<li>
 <div><label>Email:</label></div>
  <div> 
						<input class="cnt-bx" type="text" readonly name="replayemail"
         
		  value= " <?php echo $admin_replay->row()->email;?>"> 
		 
	
         
         </div>
		 
		 </li>
		<li>
		
		<div><label>Subject:</label></div>
		<div> 
						<input class="cnt-bx" type="text" readonly name="subject"
         
		  value= " <?php echo $admin_replay->row()->subject;?>"> 
         </div>
		 </li>
		 <li>
		<div><label>Message:</label></div>
		<div> 
						<input class="cnt-bx" type="text" readonly name="message"
         
		  value= " <?php echo $admin_replay->row()->message;?>">       
         </div>
		 
		 </li>
		 
		 </ul>
		 <ul>
		 <li>
		 <div>
		<label>REPLY MESSAGE:</label>
		</div>
		 <div><textarea name="your-message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required" aria-required="true" aria-invalid="false"></textarea>
		 </div>
		 </li>
		 <span class="replaymsg-btn"><input type="submit"></span>
		 </ul>
		 

</form>
<?php 
$this->load->view('admin/templates/footer.php');
?>