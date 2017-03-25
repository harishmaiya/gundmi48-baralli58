<?php
$this->load->view('admin/templates/header.php');
?>
<script>
$(document).ready(function(){
	$('.nxtTab').click(function(){

		var cur = $(this).parent().parent().parent().parent().parent();
		cur.hide();
		cur.next().show();
		var tab = cur.parent().parent().prev();
		tab.find('a.active_tab').removeClass('active_tab').parent().next().find('a').addClass('active_tab');
	});
	$('.prvTab').click(function(){
		var cur = $(this).parent().parent().parent().parent().parent();
		cur.hide();
		cur.prev().show();
		var tab = cur.parent().parent().prev();
		tab.find('a.active_tab').removeClass('active_tab').parent().prev().find('a').addClass('active_tab');
	});
});
</script>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Edit Host</h6>
						<div id="widget_tab">
			              <ul>
			                <li><a href="#tab1" class="active_tab">Host Details</a></li>
			                <li><a href="#tab2">Payout Details</a></li>
							<li><a href="#tab3">Change Password</a></li>
			              </ul>
			            </div>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'regitstraion_form' ,'enctype' => 'multipart/form-data');
						echo form_open('admin/seller/insertEditSeller',$attributes);
						
					?>
	 						<div id="tab1">
	 						<ul>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="full_name">First Name <span class="req">*</span></label>
									<div class="form_input">
										<input name="firstname" onkeypress="return onlyAlphabets(event,this);"   style=" width:295px" id="firstname" value="<?php echo $seller_details->row()->firstname;?>" type="text" tabindex="1" class="required tipTop" title="Please enter the user firstname"/>
																				<span id="listspace_error_firstname" style="color:red"></span>
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="full_name">Last Name <span class="req">*</span></label>
									<div class="form_input">
										<input name="lastname" onkeypress="return onlyAlphabets(event,this);"  style=" width:295px" id="lastname" value="<?php echo $seller_details->row()->lastname;?>" type="text" tabindex="1" class="required tipTop" title="Please enter the user lastname"/>
																	<span id="listspace_error_lastname" style="color:red"></span>
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="gender">I Am</label>
									<div class="form_input">
                                    <select name="gender" id="gender" class=" large tipTop"  title="Please select the gender">
                                    <option value="Male" <?php if($seller_details->row()->gender=='Male'){echo 'selected="selected"';}?>>Male</option>
                                    <option value="Female" <?php if($seller_details->row()->gender=='Female'){echo 'selected="selected"';}?>>Female</option>
                                    <option value="Unspecified" <?php if($seller_details->row()->gender=='Unspecified'){echo 'selected="selected"';}?>>Unspecified</option>
                                    </select>
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="gender">Date of birth</label>
									<div class="form_input">
                                    <select name="dob_month" id="user_birthdate_2i" class="valid">
                                        <option value="1" <?php if($seller_details->row()->dob_month=='1'){echo 'selected="selected"';}?> >January</option>
                                        <option value="2" <?php if($seller_details->row()->dob_month=='2'){echo 'selected="selected"';}?>>February</option>
                                        <option value="3" <?php if($seller_details->row()->dob_month=='3'){echo 'selected="selected"';}?>>March</option>
                                        <option value="4" <?php if($seller_details->row()->dob_month=='4'){echo 'selected="selected"';}?>>April</option>
                                        <option value="5" <?php if($seller_details->row()->dob_month=='5'){echo 'selected="selected"';}?>>May</option>
                                        <option value="6" <?php if($seller_details->row()->dob_month=='6'){echo 'selected="selected"';}?>>June</option>
                                        <option value="7" <?php if($seller_details->row()->dob_month=='7'){echo 'selected="selected"';}?>>July</option>
                                        <option value="8" <?php if($seller_details->row()->dob_month=='8'){echo 'selected="selected"';}?>>August</option>
                                        <option value="9" <?php if($seller_details->row()->dob_month=='9'){echo 'selected="selected"';}?>>September</option>
                                        <option value="10" <?php if($seller_details->row()->dob_month=='10'){echo 'selected="selected"';}?>>October</option>
                                        <option value="11" <?php if($seller_details->row()->dob_month=='11'){echo 'selected="selected"';}?>>November</option>
                                        <option value="12" <?php if($seller_details->row()->dob_month=='12'){echo 'selected="selected"';}?>>December</option>
                                        </select>
										<?php
										$dateObj = new DateTime;
										$year = $dateObj->format("Y")-15;
										//echo "Current year is: " . $year; die;
										?>
                                        
                                        
                                        <select name="dob_date" id="user_birthdate_3i">
                                        <?php
                                        for($i=1;$i<=31;$i++){
                                        
                                        echo '<option value="'.$i.'"'; 
                                        if($seller_details->row()->dob_date==$i){echo 'selected="selected"';}
                                        
                                        echo '>'.$i.'</option>';
                                        }
                                        
                                        
                                         ?>
                                        </select>
                                        
                                        <select name="dob_year" id="user_birthdate_1i" class="valid">
                                        <?php 
                                        for($i=$year;$i > 1920;$i--){
                                        
                                        echo '<option value="'.$i.'"'; 
                                        if($seller_details->row()->dob_year==$i){echo 'selected="selected"';}
                                        
                                        echo '>'.$i.'</option>';
                                        }
                                        ?>
                                        </select>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="phone_no">Phone no </label>
									<div class="form_input">
										<input type="text" style=" width:295px" name="phone_no" value="<?php  echo $seller_details->row()->phone_no; ?>" onkeypress="return numericOnly(event,this);" />
									</div>
								</div>
								</li> 
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="s_city">Where You Live</label>
									<div class="form_input">
										<input type="text" style=" width:295px" name="s_city" value="<?php  echo $seller_details->row()->s_city; ?>" />
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="description">Describe Yourself</label>
									<div class="form_input">
										<textarea name="description" style="width:295px;"><?php  echo $seller_details->row()->description; ?></textarea>
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="s_city">Company</label>
									<div class="form_input">
										<input type="text" style=" width:295px" name="school" value="<?php  echo $seller_details->row()->school; ?>" />
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="work">Work</label>
									<div class="form_input">
										<input type="text" style=" width:295px" name="work" value="<?php  echo $seller_details->row()->work; ?>" />
									</div>
								</div>

																<li>
									<div class="form_grid_12">
										<label class="field_title" for="timezone" >Time Zone</label>
										<div class="form_input">
											<div class="user_renter">
												<select name="timezone"  id="user_preference_time_zone">
													<option value="">Select</option>
													<option value="Pacific/Kwajalein" <?php if($seller_details->row()->timezone=='Pacific/Kwajalein'){?>selected="selected"<?php }?>>(GMT-12:00) International Date Line West</option>
<option value="Pacific/Midway" <?php if($seller_details->row()->timezone=='Pacific/Midway'){?>selected="selected"<?php }?>>(GMT-11:00) Midway Island</option>
<option value="Pacific/Apia" <?php if($seller_details->row()->timezone=='Pacific/Apia'){?>selected="selected"<?php }?>>(GMT-11:00) Samoa</option>
<option value="Pacific/Honolulu" <?php if($seller_details->row()->timezone=='Pacific/Honolulu'){?>selected="selected"<?php }?>>(GMT-10:00) Hawaii</option>
<option value="America/Anchorage" <?php if($seller_details->row()->timezone=='America/Anchorage'){?>selected="selected"<?php }?>>(GMT-09:00) Alaska</option>
<option value="America/Los_Angeles" <?php if($seller_details->row()->timezone=='America/Los_Angeles'){?>selected="selected"<?php }?>>(GMT-08:00) Pacific Time (US & Canada)</option>
<option value="America/Tijuana" <?php if($seller_details->row()->timezone=='America/Tijuana'){?>selected="selected"<?php }?>>(GMT-08:00) Tijuana</option>
<option value="America/Phoenix" <?php if($seller_details->row()->timezone=='America/Phoenix'){?>selected="selected"<?php }?>>(GMT-07:00) Arizona</option>
<option value="America/Chihuahua" <?php if($seller_details->row()->timezone=='America/Chihuahua'){?>selected="selected"<?php }?>>(GMT-07:00) Chihuahua</option>
<option value="America/Mazatlan" <?php if($seller_details->row()->timezone=='America/Mazatlan'){?>selected="selected"<?php }?>>(GMT-07:00) Mazatlan</option>
<option value="America/Denver" <?php if($seller_details->row()->timezone=='America/Denver'){?>selected="selected"<?php }?>>(GMT-07:00) Mountain Time (US & Canada)</option>
<option value="America/Managua" <?php if($seller_details->row()->timezone=='America/Managua'){?>selected="selected"<?php }?>>(GMT-06:00) Central America</option>
<option value="America/Chicago" <?php if($seller_details->row()->timezone=='America/Chicago'){?>selected="selected"<?php }?>>(GMT-06:00) Central Time (US & Canada)</option>
<option value="America/Mexico_City" <?php if($seller_details->row()->timezone=='America/Mexico_City'){?>selected="selected"<?php }?>>(GMT-06:00) Guadalajara</option>
<option value="America/Mexico_City" <?php if($seller_details->row()->timezone=='America/Mexico_City'){?>selected="selected"<?php }?>>(GMT-06:00) Mexico City</option>
<option value="America/Monterrey" <?php if($seller_details->row()->timezone=='America/Monterrey'){?>selected="selected"<?php }?>>(GMT-06:00) Monterrey</option>
<option value="America/Regina" <?php if($seller_details->row()->timezone=='America/Regina'){?>selected="selected"<?php }?>>(GMT-06:00) Saskatchewan</option>
<option value="America/New_York" <?php if($seller_details->row()->timezone=='America/New_York'){?>selected="selected"<?php }?>>(GMT-05:00) Eastern Time (US & Canada)</option>
<option value="America/Indiana/Indianapolis" <?php if($seller_details->row()->timezone=='America/Indiana/Indianapolis'){?>selected="selected"<?php }?>>(GMT-05:00) Indiana (East)</option>
<option value="America/Bogota" <?php if($seller_details->row()->timezone=='America/Bogota'){?>selected="selected"<?php }?>>(GMT-05:00) Bogota</option>
<option value="America/Lima" <?php if($seller_details->row()->timezone=='America/Lima'){?>selected="selected"<?php }?>>(GMT-05:00) Lima</option>
<option value="America/Bogota" <?php if($seller_details->row()->timezone=='America/Bogota'){?>selected="selected"<?php }?>>(GMT-05:00) Quito</option>
<option value="America/Caracas" <?php if($seller_details->row()->timezone=='America/Caracas'){?>selected="selected"<?php }?>>(GMT-04:00) Caracas</option>
<option value="America/Halifax" <?php if($seller_details->row()->timezone=='America/Halifax'){?>selected="selected"<?php }?>>(GMT-04:00) Atlantic Time (Canada)</option>
<option value="Georgetown" <?php if($seller_details->row()->timezone=='Georgetown'){?>selected="selected"<?php }?>>(GMT-04:00) Georgetown</option>
<option value="America/La_Paz" <?php if($seller_details->row()->timezone=='America/La_Paz'){?>selected="selected"<?php }?>>(GMT-04:00) La Paz</option>
<option value="America/Santiago" <?php if($seller_details->row()->timezone=='America/Santiago'){?>selected="selected"<?php }?>>(GMT-04:00) Santiago</option>
<option value="America/St_Johns" <?php if($seller_details->row()->timezone=='America/St_Johns'){?>selected="selected"<?php }?>>(GMT-03:30) Newfoundland</option>
<option value="America/Sao_Paulo" <?php if($seller_details->row()->timezone=='America/Sao_Paulo'){?>selected="selected"<?php }?>>(GMT-03:00) Brasilia</option>
<option value="America/Argentina/Buenos_Aires" <?php if($seller_details->row()->timezone=='America/Argentina/Buenos_Aires'){?>selected="selected"<?php }?>>(GMT-03:00) Buenos Aires</option>
<option value="America/Godthab" <?php if($seller_details->row()->timezone=='America/Godthab'){?>selected="selected"<?php }?>>(GMT-03:00) Greenland</option>
<option value="America/Noronha" <?php if($seller_details->row()->timezone=='America/Noronha'){?>selected="selected"<?php }?>>(GMT-02:00) Mid-Atlantic</option>
<option value="Atlantic/Azores" <?php if($seller_details->row()->timezone=='Atlantic/Azores'){?>selected="selected"<?php }?>>(GMT-01:00) Azores</option>
<option value="Atlantic/Cape_Verde" <?php if($seller_details->row()->timezone=='Atlantic/Cape_Verde'){?>selected="selected"<?php }?>>(GMT-01:00) Cape Verde Is.</option>
<option value="Africa/Casablanca" <?php if($seller_details->row()->timezone=='Africa/Casablanca'){?>selected="selected"<?php }?>>(GMT+00:00) Casablanca</option>
<option value="Europe/London" <?php if($seller_details->row()->timezone=='Europe/London'){?>selected="selected"<?php }?>>(GMT+00:00) Dublin</option>
<option value="Europe/London" <?php if($seller_details->row()->timezone=='Europe/London'){?>selected="selected"<?php }?>>(GMT+00:00) Edinburgh</option>
<option value="Europe/Lisbon" <?php if($seller_details->row()->timezone=='Europe/Lisbon'){?>selected="selected"<?php }?>>(GMT+00:00) Lisbon</option>
<option value="Europe/London" <?php if($seller_details->row()->timezone=='Europe/London'){?>selected="selected"<?php }?>>(GMT+00:00) London</option>
<option value="Africa/Monrovia" <?php if($seller_details->row()->timezone=='Africa/Monrovia'){?>selected="selected"<?php }?>>(GMT+00:00) Monrovia</option>
<option value="Europe/Amsterdam" <?php if($seller_details->row()->timezone=='Europe/Amsterdam'){?>selected="selected"<?php }?>>(GMT+01:00) Amsterdam</option>
<option value="Europe/Belgrade" <?php if($seller_details->row()->timezone=='Europe/Belgrade'){?>selected="selected"<?php }?>>(GMT+01:00) Belgrade</option>
<option value="Europe/Berlin" <?php if($seller_details->row()->timezone=='Europe/Berlin'){?>selected="selected"<?php }?>>(GMT+01:00) Berlin</option>
<option value="Europe/Berlin" <?php if($seller_details->row()->timezone=='Europe/Berlin'){?>selected="selected"<?php }?>>(GMT+01:00) Bern</option>
<option value="Europe/Bratislava" <?php if($seller_details->row()->timezone=='Europe/Bratislava'){?>selected="selected"<?php }?>>(GMT+01:00) Bratislava</option>
<option value="Europe/Brussels" <?php if($seller_details->row()->timezone=='Europe/Brussels'){?>selected="selected"<?php }?>>(GMT+01:00) Brussels</option>
<option value="Europe/Budapest" <?php if($seller_details->row()->timezone=='Europe/Budapest'){?>selected="selected"<?php }?>>(GMT+01:00) Budapest</option>
<option value="Europe/Copenhagen" <?php if($seller_details->row()->timezone=='Europe/Copenhagen'){?>selected="selected"<?php }?>>(GMT+01:00) Copenhagen</option>
<option value="Europe/Ljubljana" <?php if($seller_details->row()->timezone=='Europe/Ljubljana'){?>selected="selected"<?php }?>>(GMT+01:00) Ljubljana</option>
<option value="Europe/Madrid" <?php if($seller_details->row()->timezone=='Europe/Madrid'){?>selected="selected"<?php }?>>(GMT+01:00) Madrid</option>
<option value="Europe/Paris" <?php if($seller_details->row()->timezone=='Europe/Paris'){?>selected="selected"<?php }?>>(GMT+01:00) Paris</option>
<option value="Europe/Prague" <?php if($seller_details->row()->timezone=='Europe/Prague'){?>selected="selected"<?php }?>>(GMT+01:00) Prague</option>
<option value="Europe/Rome" <?php if($seller_details->row()->timezone=='Europe/Rome'){?>selected="selected"<?php }?>>(GMT+01:00) Rome</option>
<option value="Europe/Sarajevo" <?php if($seller_details->row()->timezone=='Europe/Sarajevo'){?>selected="selected"<?php }?>>(GMT+01:00) Sarajevo</option>
<option value="Europe/Skopje" <?php if($seller_details->row()->timezone=='Europe/Skopje'){?>selected="selected"<?php }?>>(GMT+01:00) Skopje</option>
<option value="Europe/Stockholm" <?php if($seller_details->row()->timezone=='Europe/Stockholm'){?>selected="selected"<?php }?>>(GMT+01:00) Stockholm</option>
<option value="Europe/Vienna" <?php if($seller_details->row()->timezone=='Europe/Vienna'){?>selected="selected"<?php }?>>(GMT+01:00) Vienna</option>
<option value="Europe/Warsaw" <?php if($seller_details->row()->timezone=='Europe/Warsaw'){?>selected="selected"<?php }?>>(GMT+01:00) Warsaw</option>
<option value="Africa/Lagos" <?php if($seller_details->row()->timezone=='Africa/Lagos'){?>selected="selected"<?php }?>>(GMT+01:00) West Central Africa</option>
<option value="Europe/Zagreb" <?php if($seller_details->row()->timezone=='Europe/Zagreb'){?>selected="selected"<?php }?>>(GMT+01:00) Zagreb</option>
<option value="Europe/Athens" <?php if($seller_details->row()->timezone=='Europe/Athens'){?>selected="selected"<?php }?>>(GMT+02:00) Athens</option>
<option value="Europe/Bucharest" <?php if($seller_details->row()->timezone=='Europe/Bucharest'){?>selected="selected"<?php }?>>(GMT+02:00) Bucharest</option>
<option value="Africa/Cairo" <?php if($seller_details->row()->timezone=='Africa/Cairo'){?>selected="selected"<?php }?>>(GMT+02:00) Cairo</option>
<option value="Africa/Harare" <?php if($seller_details->row()->timezone=='Africa/Harare'){?>selected="selected"<?php }?>>(GMT+02:00) Harare</option>
<option value="Europe/Helsinki" <?php if($seller_details->row()->timezone=='Europe/Helsinki'){?>selected="selected"<?php }?>>(GMT+02:00) Helsinki</option>
<option value="Europe/Istanbul" <?php if($seller_details->row()->timezone=='Europe/Istanbul'){?>selected="selected"<?php }?>>(GMT+02:00) Istanbul</option>
<option value="Asia/Jerusalem" <?php if($seller_details->row()->timezone=='Asia/Jerusalem'){?>selected="selected"<?php }?>>(GMT+02:00) Jerusalem</option>
<option value="Europe/Kiev" <?php if($seller_details->row()->timezone=='Europe/Kiev'){?>selected="selected"<?php }?>>(GMT+02:00) Kyev</option>
<option value="Europe/Minsk" <?php if($seller_details->row()->timezone=='Europe/Minsk'){?>selected="selected"<?php }?>>(GMT+02:00) Minsk</option>
<option value="Africa/Johannesburg" <?php if($seller_details->row()->timezone=='Africa/Johannesburg'){?>selected="selected"<?php }?>>(GMT+02:00) Pretoria</option>
<option value="Europe/Riga" <?php if($seller_details->row()->timezone=='Europe/Riga'){?>selected="selected"<?php }?>>(GMT+02:00) Riga</option>
<option value="Europe/Sofia" <?php if($seller_details->row()->timezone=='Europe/Sofia'){?>selected="selected"<?php }?>>(GMT+02:00) Sofia</option>
<option value="Europe/Tallinn" <?php if($seller_details->row()->timezone=='Europe/Tallinn'){?>selected="selected"<?php }?>>(GMT+02:00) Tallinn</option>
<option value="Europe/Vilnius" <?php if($seller_details->row()->timezone=='Europe/Vilnius'){?>selected="selected"<?php }?>>(GMT+02:00) Vilnius</option>
<option value="Asia/Baghdad" <?php if($seller_details->row()->timezone=='Asia/Baghdad'){?>selected="selected"<?php }?>>(GMT+03:00) Baghdad</option>
<option value="Asia/Kuwait" <?php if($seller_details->row()->timezone=='Asia/Kuwait'){?>selected="selected"<?php }?>>(GMT+03:00) Kuwait</option>
<option value="Europe/Moscow" <?php if($seller_details->row()->timezone=='Europe/Moscow'){?>selected="selected"<?php }?>>(GMT+03:00) Moscow</option>
<option value="Africa/Nairobi" <?php if($seller_details->row()->timezone=='Africa/Nairobi'){?>selected="selected"<?php }?>>(GMT+03:00) Nairobi</option>
<option value="Asia/Riyadh" <?php if($seller_details->row()->timezone=='Asia/Riyadh'){?>selected="selected"<?php }?>>(GMT+03:00) Riyadh</option>
<option value="Europe/Moscow" <?php if($seller_details->row()->timezone=='Europe/Moscow'){?>selected="selected"<?php }?>>(GMT+03:00) St. Petersburg</option>
<option value="Europe/Volgograd" <?php if($seller_details->row()->timezone=='Europe/Volgograd'){?>selected="selected"<?php }?>>(GMT+03:00) Volgograd</option>

<option value="Asia/Tehran" <?php if($seller_details->row()->timezone=='Asia/Tehran'){?>selected="selected"<?php }?>>(GMT+03:30) Tehran</option>
<option value="Asia/Muscat" <?php if($seller_details->row()->timezone=='Asia/Muscat'){?>selected="selected"<?php }?>>(GMT+04:00) Abu Dhabi</option>
<option value="Asia/Baku" <?php if($seller_details->row()->timezone=='Asia/Baku'){?>selected="selected"<?php }?>>(GMT+04:00) Baku</option>
<option value="Asia/Muscat" <?php if($seller_details->row()->timezone=='Asia/Muscat'){?>selected="selected"<?php }?>>(GMT+04:00) Muscat</option>
<option value="Asia/Tbilisi" <?php if($seller_details->row()->timezone=='Asia/Tbilisi'){?>selected="selected"<?php }?>>(GMT+04:00) Tbilisi</option>
<option value="Asia/Yerevan" <?php if($seller_details->row()->timezone=='Asia/Yerevan'){?>selected="selected"<?php }?>>(GMT+04:00) Yerevan</option>
<option value="Asia/Kabul" <?php if($seller_details->row()->timezone=='Asia/Kabul'){?>selected="selected"<?php }?>>(GMT+04:30) Kabul</option>
<option value="Asia/Yekaterinburg" <?php if($seller_details->row()->timezone=='Asia/Yekaterinburg'){?>selected="selected"<?php }?>>(GMT+05:00) Ekaterinburg</option>
<option value="Asia/Karachi" <?php if($seller_details->row()->timezone=='Asia/Karachi'){?>selected="selected"<?php }?>>(GMT+05:00) Islamabad</option>
<option value="Asia/Karachi" <?php if($seller_details->row()->timezone=='Asia/Karachi'){?>selected="selected"<?php }?>>(GMT+05:00) Karachi</option>
<option value="Asia/Tashkent" <?php if($seller_details->row()->timezone=='Asia/Tashkent'){?>selected="selected"<?php }?>>(GMT+05:00) Tashkent</option>
<option value="Asia/Kolkata" <?php if($seller_details->row()->timezone=='Asia/Kolkata'){?>selected="selected"<?php }?>>(GMT+05:30) Chennai</option>
<option value="Asia/Kolkata" <?php if($seller_details->row()->timezone=='Asia/Kolkata'){?>selected="selected"<?php }?>>(GMT+05:30) Kolkata</option>
<option value="Asia/Kolkata" <?php if($seller_details->row()->timezone=='Asia/Kolkata'){?>selected="selected"<?php }?>>(GMT+05:30) Mumbai</option>
<option value="Asia/Kolkata" <?php if($seller_details->row()->timezone=='Asia/Kolkata'){?>selected="selected"<?php }?>>(GMT+05:30) New Delhi</option>

<option value="Asia/Kathmandu" <?php if($seller_details->row()->timezone=='Asia/Kathmandu'){?>selected="selected"<?php }?>>(GMT+05:45) Kathmandu</option>
<option value="Asia/Almaty" <?php if($seller_details->row()->timezone=='Asia/Almaty'){?>selected="selected"<?php }?>>(GMT+06:00) Almaty</option>
<option value="Asia/Dhaka" <?php if($seller_details->row()->timezone=='Asia/Dhaka'){?>selected="selected"<?php }?>>(GMT+06:00) Astana</option>
<option value="Asia/Dhaka" <?php if($seller_details->row()->timezone=='Asia/Dhaka'){?>selected="selected"<?php }?>>(GMT+06:00) Dhaka</option>
<option value="Asia/Novosibirsk" <?php if($seller_details->row()->timezone=='Asia/Novosibirsk'){?>selected="selected"<?php }?>>(GMT+06:00) Novosibirsk</option>
<option value="Asia/Colombo" <?php if($seller_details->row()->timezone=='Asia/Colombo'){?>selected="selected"<?php }?>>(GMT+06:00) Sri Jayawardenepura</option>
<option value="Asia/Rangoon" <?php if($seller_details->row()->timezone=='Asia/Rangoon'){?>selected="selected"<?php }?>>(GMT+06:30) Rangoon</option>
<option value="Asia/Bangkok" <?php if($seller_details->row()->timezone=='Asia/Bangkok'){?>selected="selected"<?php }?>>(GMT+07:00) Bangkok</option>
<option value="Asia/Bangkok" <?php if($seller_details->row()->timezone=='Asia/Bangkok'){?>selected="selected"<?php }?>>(GMT+07:00) Hanoi</option>
<option value="Asia/Jakarta" <?php if($seller_details->row()->timezone=='Asia/Jakarta'){?>selected="selected"<?php }?>>(GMT+07:00) Jakarta</option>

<option value="Asia/Krasnoyarsk" <?php if($seller_details->row()->timezone=='Asia/Krasnoyarsk'){?>selected="selected"<?php }?>>(GMT+07:00) Krasnoyarsk</option>
<option value="Asia/Hong_Kong" <?php if($seller_details->row()->timezone=='Asia/Hong_Kong'){?>selected="selected"<?php }?>>(GMT+08:00) Beijing</option>
<option value="Asia/Chongqing" <?php if($seller_details->row()->timezone=='Asia/Chongqing'){?>selected="selected"<?php }?>>(GMT+08:00) Chongqing</option>
<option value="Asia/Hong_Kong" <?php if($seller_details->row()->timezone=='Asia/Hong_Kong'){?>selected="selected"<?php }?>>(GMT+08:00) Hong Kong</option>
<option value="Asia/Irkutsk" <?php if($seller_details->row()->timezone=='Asia/Irkutsk'){?>selected="selected"<?php }?>>(GMT+08:00) Irkutsk</option>
<option value="Asia/Kuala_Lumpur" <?php if($seller_details->row()->timezone=='Asia/Kuala_Lumpur'){?>selected="selected"<?php }?>>(GMT+08:00) Kuala Lumpur</option>
<option value="Australia/Perth" <?php if($seller_details->row()->timezone=='Australia/Perth'){?>selected="selected"<?php }?>>(GMT+08:00) Perth</option>
<option value="Asia/Singapore" <?php if($seller_details->row()->timezone=='Asia/Singapore'){?>selected="selected"<?php }?>>(GMT+08:00) Singapore</option>
<option value="Asia/Taipei" <?php if($seller_details->row()->timezone=='Asia/Taipei'){?>selected="selected"<?php }?>>(GMT+08:00) Taipei</option>
<option value="Asia/Irkutsk" <?php if($seller_details->row()->timezone=='Asia/Irkutsk'){?>selected="selected"<?php }?>>(GMT+08:00) Ulaan Bataar</option>
<option value="Asia/Urumqi" <?php if($seller_details->row()->timezone=='Asia/Urumqi'){?>selected="selected"<?php }?>>(GMT+08:00) Urumqi</option>

<option value="Asia/Tokyo" <?php if($seller_details->row()->timezone=='Asia/Tokyo'){?>selected="selected"<?php }?>>(GMT+09:00) Osaka</option>
<option value="Asia/Tokyo" <?php if($seller_details->row()->timezone=='Asia/Tokyo'){?>selected="selected"<?php }?>>(GMT+09:00) Sapporo</option>
<option value="Asia/Seoul" <?php if($seller_details->row()->timezone=='Asia/Seoul'){?>selected="selected"<?php }?>>(GMT+09:00) Seoul</option>
<option value="Asia/Tokyo" <?php if($seller_details->row()->timezone=='Asia/Tokyo'){?>selected="selected"<?php }?>>(GMT+09:00) Tokyo</option>
<option value="Asia/Yakutsk" <?php if($seller_details->row()->timezone=='Asia/Yakutsk'){?>selected="selected"<?php }?>>(GMT+09:00) Yakutsk</option>
<option value="Australia/Adelaide" <?php if($seller_details->row()->timezone=='Australia/Adelaide'){?>selected="selected"<?php }?>>(GMT+09:30) Adelaide</option>
<option value="Australia/Darwin" <?php if($seller_details->row()->timezone=='Australia/Darwin'){?>selected="selected"<?php }?>>(GMT+09:30) Darwin</option>
<option value="Australia/Brisbane" <?php if($seller_details->row()->timezone=='Australia/Brisbane'){?>selected="selected"<?php }?>>(GMT+10:00) Brisbane</option>
<option value="Australia/Sydney" <?php if($seller_details->row()->timezone=='Australia/Sydney'){?>selected="selected"<?php }?>>(GMT+10:00) Canberra</option>
<option value="Pacific/Guam" <?php if($seller_details->row()->timezone=='Pacific/Guam'){?>selected="selected"<?php }?>>(GMT+10:00) Guam</option>
<option value="Australia/Hobart" <?php if($seller_details->row()->timezone=='Australia/Hobart'){?>selected="selected"<?php }?>>(GMT+10:00) Hobart</option>
<option value="Australia/Melbourne" <?php if($seller_details->row()->timezone=='Australia/Melbourne'){?>selected="selected"<?php }?>>(GMT+10:00) Melbourne</option>
<option value="Pacific/Port_Moresby" <?php if($seller_details->row()->timezone=='Pacific/Port_Moresby'){?>selected="selected"<?php }?>>(GMT+10:00) Port Moresby</option>
<option value="Australia/Sydney" <?php if($seller_details->row()->timezone=='Australia/Sydney'){?>selected="selected"<?php }?>>(GMT+10:00) Sydney</option>
<option value="Asia/Vladivostok" <?php if($seller_details->row()->timezone=='Asia/Vladivostok'){?>selected="selected"<?php }?>>(GMT+110:00) Vladivostok</option>
<option value="Asia/Magadan" <?php if($seller_details->row()->timezone=='Asia/Magadan'){?>selected="selected"<?php }?>>(GMT+11:00) Magadan</option>
<option value="Asia/Magadan" <?php if($seller_details->row()->timezone=='Asia/Magadan'){?>selected="selected"<?php }?>>(GMT+11:00) New Caledonia</option>
<option value="Asia/Magadan" <?php if($seller_details->row()->timezone=='Asia/Magadan'){?>selected="selected"<?php }?>>(GMT+11:00) Solomon Is.</option>


<option value="Pacific/Auckland" <?php if($seller_details->row()->timezone=='Pacific/Auckland'){?>selected="selected"<?php }?>>(GMT+12:00) Auckland</option>
<option value="Pacific/Fiji" <?php if($seller_details->row()->timezone=='Pacific/Fiji'){?>selected="selected"<?php }?>>(GMT+12:00) Fiji</option>
<option value="Asia/Kamchatka" <?php if($seller_details->row()->timezone=='Asia/Kamchatka'){?>selected="selected"<?php }?>>(GMT+12:00) Kamchatka</option>
<option value="Pacific/Fiji" <?php if($seller_details->row()->timezone=='Pacific/Fiji'){?>selected="selected"<?php }?>>(GMT+12:00) Marshall Is.</option>

<option value="Pacific/Auckland" <?php if($seller_details->row()->timezone=='Pacific/Auckland'){?>selected="selected"<?php }?>>(GMT+12:00) Wellington</option>
<option value="Pacific/Tongatapu" <?php if($seller_details->row()->timezone=="Pacific/Tongatapu"){?>selected="selected"<?php }?>>(GMT+13:00) Nuku'alofa</option></select>

												</select> 

												<span class="tips-text"><?php if($this->lang->line('Yourhometime') != '') { echo stripslashes($this->lang->line('Yourhometime')); } else echo "Your home time zone.";?></span>
											</div>
											</div>
											</div>


											</li>

											 <li>
											 
													<div class="form_grid_12">
													
														<label class="field_title" for="language">Languages Known:</label>
													
													<div class="form_input">
													<?php $language = explode(',', $seller_details->row()->languages_known); 
													foreach($language as $key => $lang){	
														if($key != 0)
														{
															echo ", ";
														}
														$condition = array('language_code'=>$lang);
														$user_language = $this->user_model->get_all_details ( LANGUAGES_KNOWN, $condition );
														$lang_name= $user_language->row()->language_name; 
														echo $lang_name;
													}?>
													</div>
													</div>
													
													</li>
								
								
								
								

                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="email">Email Address </label>
									<div class="form_input">
										<?php echo $seller_details->row()->email;?>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="image">User Image (Image Size 272px X 272px)</label>
									<div class="form_input">
										<input name="image" id="image" type="file" tabindex="7" class="large tipTop" title="Please select user image" />
									</div>
									<div class="form_input"><img src="<?php if($seller_details->row()->image==''){ echo base_url().'images/site/profile.png';}else{ echo base_url();?>images/users/<?php echo $seller_details->row()->image;}?>" width="100px"/></div>
								</div>
								</li>
								<!--<li>
								<div class="form_grid_12">
									<label class="field_title" for="web_url">Website</label>
									<div class="form_input">
										<input type="text" name="web_url" value="<?php echo $seller_details->row()->web_url;?>" class="tipTop large" title="Enter the website url" />
									</div>
								</div>
								</li>-->
                               <li>
								<div class="form_grid_12">
									<div class="form_input">
										<input type="button" class="btn_small btn_blue nxtTab" id="nextImage" tabindex="9" value="Next"/>
									</div>
								</div>
								</li>
							</ul>
						</div>
						<div id="tab2">
							<ul>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="accname">Paypal Email <span class="req">*</span></label>
									<div class="form_input">
										<input type="text" name="paypal_email" value="<?php echo $seller_details->row()->paypal_email;?>" class="required tipTop large" title="Enter the Paypal Email" />
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="accname">Account Name <span class="req">*</span></label>
									<div class="form_input">
										<input type="text" name="accname" value="<?php echo $seller_details->row()->accname;?>" class="required tipTop large" title="Enter the bank account Name" />
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="accno">Account Number <span class="req">*</span></label>
									<div class="form_input">
										<input type="text" id="accno" name="accno" value="<?php echo $seller_details->row()->accno;?>" class="required tipTop large" title="Enter the bank account number" />
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="bankname">Bank Name <span class="req">*</span></label>
									<div class="form_input">
										<input type="text" name="bankname" value="<?php echo $seller_details->row()->bankname;?>" class="required tipTop large" title="Enter the bank name" />
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<input type="button" class="btn_small btn_blue prvTab" tabindex="9" value="Prev"/>
										<button type="submit"  onclick="return checkValue();" class="btn_small btn_blue" tabindex="4"><span>Update</span></button>
									</div>
								</div>
								</li>
							</ul>
						</div>
						<div id="tab3">
							<ul>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="password">Password</label>
									<div class="form_input">
										<input type="password" name="password" value="" class="tipTop large" id="new_password" title="Enter the Password" onkeyup="return CheckPasswordStrength(this.value);" />
										<label class="error">Note: Password should be alphanumeric </label>
									</div>
									<div class="form_input">
									<span id="new_password_warn1" style="color:#FF0000;"></span>
									
									</div>
									<div class="form_input">
									<span id="new_password_warn"  style="color:#FF0000;"></span>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="confirm-password">Confirm Password</label>
									<div class="form_input">
										<input type="password" name="confirm-password" value="" class="tipTop large" id="confirm_password" title="Enter the Confirm Password" />
									</div>
									<div class="form_input">
									<span id="confirm_password_warn"  style="color:#FF0000;"></span>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" onclick="return checkPassword();" class="btn_small btn_blue" tabindex="4"><span>Update</span></button>
									</div>
								</div>
								</li>
							</ul>
						</div>
						
						<input type="hidden" name="seller_id" value="<?php echo $seller_details->row()->id;?>"/>
						<input type="hidden" name="email" value="<?php echo $seller_details->row()->email;?>"/>
						</form>
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
<script type="text/javascript">

$(document).ready(function(){

$('#regitstraion_form').validate({ ignore: "" });
$("#image").rules("add", {
        accept: "jpg|jpeg|png|ico|bmp"
    });
		$('#accno').bind('keyup blur',function(){ 
		$(this).val( $(this).val().replace(/^[A-Za-z]*$/g,'') ); 
	});
	
}); 
function checkValue()
{
	var fname = $('#firstname').val();
	var lname =  $('#lastname').val();
	if(fname==""){
	$("#listspace_error_firstname").text('Please enter a firstname');
return false;
	}
		if(lname==""){
	$("#listspace_error_lastname").text('Please enter a lastname');
return false;
	}
}
function CheckPasswordStrength(password) { 
        var password_strength = document.getElementById("new_password_warn1");
 $('#new_password_warn').html('');
        //TextBox left blank.
        if (password.length == 0) {
            password_strength.innerHTML = "";
            return;
        }
 
        //Regular Expressions.
        var regex = new Array();
        regex.push("[A-Z]"); //Uppercase Alphabet.
        regex.push("[a-z]"); //Lowercase Alphabet.
        regex.push("[0-9]"); //Digit.
        regex.push("[$@$!%*#?&]"); //Special Character.
 
        var passed = 0;
 
        //Validate for each Regular Expression.
        for (var i = 0; i < regex.length; i++) {
            if (new RegExp(regex[i]).test(password)) {
                passed++;
            }
        }
 
        //Validate for length of Password.
        if (passed > 2 && password.length > 8) {
            passed++;
        }
 
        //Display status.
        var color = "";
        var strength = ""; 
        switch (passed) {
            case 0:
            case 1:
                strength = "Weak";
                color = "red";
                break;
            case 2:
                strength = "Good";
                color = "darkorange";
                break;
            case 3:
            case 4:
                strength = "Strong";
                color = "green";
                break;
            case 5:
                strength = "Very Strong";
                color = "darkgreen";
                break;
        }
        /*  $("#new_password_warn").html(strength);  
        $("#new_password_warn").css('color',color);  */
		password_strength.innerHTML = strength;
        password_strength.style.color = color;
		 
    }
function checkPassword(){
	$('#old_password_warn').html('');$('#new_password_warn').html('');$('#confirm_password_warn').html('');
	if($('#old_password').val()==''){
		$('#old_password_warn').html('Please Enter Current Password.');
		$('#old_password').focus();
		return false;
	}else if($('#new_password').val()==''){
		$('#new_password_warn').html('Please Enter New Password.');
		$('#new_password').focus();
		return false;
	}
	else if($("#new_password_warn1").html() == 'Weak'){
		$("#new_password_warn").html('Your Password should be characters and numbers');
		$("#new_password").focus();
	    return false;						
	}
	else if($('#confirm_password').val()==''){
		$('#confirm_password_warn').html('Please Enter Confirm Password.');
		$('#confirm_password').focus();
		return false;
	}else if($('#confirm_password').val()!=$('#new_password').val()){
		$('#confirm_password_warn').html('Passwords not matching');
		$('#confirm_password').focus();
		return false;
	}else if($('#confirm_password').val()==$('#old_password').val()){
		$('#confirm_password_warn').html('Old and new paswords shouldn\'t be same.');
		$('#confirm_password').focus();
		return false;
	}else if($('#new_password').val().length <= 5){
		$('#new_password_warn').html('Password should be minimum 6 characters');
		$('#new_password').focus();
		return false;
	}else{
		 return true;
	}
}</script>
<?php 
$this->load->view('admin/templates/footer.php');
?>