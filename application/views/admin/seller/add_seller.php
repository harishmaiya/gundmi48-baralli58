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
	$('#tab2 input[type="checkbox"]').click(function(){
		var cat = $(this).parent().attr('class');
		var curCat = cat;
		var catPos = '';
		var added = '';
		var curPos = curCat.substring(3);
		var newspan = $(this).parent().prev();
		if($(this).is(':checked')){
			while(cat != 'cat1'){
				cat = newspan.attr('class');
				catPos = cat.substring(3);
				if(cat != curCat && catPos<curPos){
					if (jQuery.inArray(catPos, added.replace(/,\s+/g, ',').split(',')) >= 0) {
					    //Found it!
					}else{
						newspan.find('input[type="checkbox"]').attr('checked','checked');
						added += catPos+',';
					}
				}
				newspan = newspan.prev(); 
			}
		}else{
			var newspan = $(this).parent().next();
			if(newspan.get(0)){
				var cat = newspan.attr('class');
				var catPos = cat.substring(3);
			}
			while(newspan.get(0) && cat != curCat && catPos>curPos){
				newspan.find('input[type="checkbox"]').attr('checked',this.checked);	
				newspan = newspan.next(); 	
				cat = newspan.attr('class');
				catPos = cat.substring(3);
			}
		}
	});
		
});
</script>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Add New Host</h6>
                        <div id="widget_tab">
			              <ul>
			                <li><a href="#tab1" class="active_tab">Host Details</a></li>
			                <li><a href="#tab2">Payout Details</a></li>
			              </ul>
			            </div>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'regitstraion_form', 'enctype' => 'multipart/form-data');
						echo form_open_multipart('admin/seller/insertEditRenter',$attributes) 
					?>		<div id="tab1">
	 						<ul>
	 							
                                <li>
								<div class="form_grid_12">
									<label class="field_title"  for="firstname1">First Name <span class="req">*</span></label>
									<div class="form_input">
										<input name="firstname" onkeypress="return onlyAlphabets(event,this);" style=" width:295px" id="firstname33" value="" type="text" tabindex="1" class="required tipTop" title="Please enter the renter firstname" maxlength="15"/>
										<span id="listspace_error" style="color:red"></span>
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title"  for="lastname">Last Name <span class="req">*</span></label>
									<div class="form_input">
										<input name="lastname" onkeypress="return onlyAlphabets(event,this);" style=" width:295px" id="lastname" value="" type="text" tabindex="1" class="required tipTop" title="Please enter the renter lastname" maxlength="15"/>
										<span id="listspace_error_lastname" style="color:red"></span>
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="gender">I Am</label>
									<div class="form_input">
                                    <select name="gender" id="gender" class=" large tipTop"  title="Please select the gender">
                                    <option value="Male" >Male</option>
                                    <option value="Female" >Female</option>
                                    <option value="Unspecified">Unspecified</option>
                                    </select>
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="dob_month">Date of birth</label>
									<div class="form_input">
                                    <select name="dob_month" id="user_birthdate_2i" class="valid tipTop"  title="Please select date of birth">
                                        <option value="1"  >January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4" >April</option>
                                        <option value="5" >May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9" >September</option>
                                        <option value="10">October</option>
                                        <option value="11" >November</option>
                                        <option value="12">December</option>
                                        </select>
                                    <?php
									$dateObj = new DateTime;
									$year = $dateObj->format("Y")-15;
									?>
                                        
                                        <select name="dob_date" id="user_birthdate_3i">
                                        <?php
                                        for($i=1;$i<=31;$i++){
                                        
                                        echo '<option value="'.$i.'"'; 
                                        //if($seller_details->row()->dob_date==$i){echo 'selected="selected"';}
                                        echo '>'.$i.'</option>';
                                        }
                                                                               
                                         ?>
                                        </select>
                                        
                                        <select name="dob_year" id="user_birthdate_1i" class="valid">
                                        <?php 
                                        for($i=$year;$i > 1920;$i--){
                                        
                                        echo '<option value="'.$i.'"'; 
                                        //if($seller_details->row()->dob_year==$i){echo 'selected="selected"';}
                                        
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
										<input type="text" style=" width:295px" onkeypress="return numericOnly(event,this);" id="phone_no" name="phone_no" value="" class="tipTop"  title="Please enter your phone number" maxlength="10"/>
									</div>
								</div>
								</li> 
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="s_city">Where You Live</label>
									<div class="form_input">
										<input type="text" style=" width:295px" name="s_city" value="" class="tipTop"  title="Please enter your current location" />
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="description">Describe Yourself</label>
									<div class="form_input">
										<textarea name="description" style="width:295px;" class="tipTop"  title="Please enter your details" ></textarea>
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="school">Company</label>
									<div class="form_input">
										<input type="text" style=" width:295px" name="school" value="" class="large tipTop"  title="Please enter your school name" />
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="work">Work</label>
									<div class="form_input">
										<input type="text" style=" width:295px" name="work" value="" class="large tipTop"  title="Please enter your work" />
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="email">Email Address<span class="req">*</span></label>
									<div class="form_input">
										<input type="text" style=" width:295px" name="email" id="email" value="" class="required large tipTop" title="Please enter your email address" />
										<span id="listspace_error1" style="color:red"></span>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="new_password">New Password <span class="req">*</span></label>
									<div class="form_input">
										<input name="new_password" id="new_password" type="password" tabindex="5" onkeyup="return CheckPasswordStrength(this.value);" class=" large tipTop" title="Please enter the new password"/>
										<label class="error">Note: Password should be alphanumeric</label>
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
									<label class="field_title" for="confirm_password">Re-type Password <span class="req">*</span></label>
									<div class="form_input">
										<input name="confirm_password" id="confirm_password" type="password" tabindex="6" class=" large tipTop" title="Please re-type the above password"/>
									</div>
									<div class="form_input">
									<span id="confirm_password_warn"  style="color:#FF0000;"></span>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="image">User Image (Image Size 275px X 275px)</label>
									<div class="form_input">
										<input name="image" id="image" type="file" tabindex="7" class="large tipTop" title="Please select user image" />
									</div>
								</div>
								</li>
                                
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status <span class="req">*</span></label>
									<div class="form_input">
										<div class="active_inactive">
											<input type="checkbox" tabindex="8" name="status" checked="checked" id="active_inactive_active" class="active_inactive"/>
										</div>
									</div>
								</div>
								</li>
								
                                <li>
                <div class="form_grid_12">
                  <div class="form_input">
                    <input type="button" id="nextpage" class="btn_small btn_blue nxtTab" tabindex="9" value="Next"/>
                  </div>
                </div>
              </li>
							</ul>
                            </div>
                            <div id="tab2">
							<ul>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="accname">Paypal Email</label>
									<div class="form_input">
										<input type="text" name="paypal_email" value="" class="required tipTop large" title="Enter the Paypal Email" />
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="accname">Account Name</label>
									<div class="form_input">
										<input type="text" name="accname" value="" class="required tipTop large" title="Enter the bank account Name" />
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="accno">Account Number</label>
									<div class="form_input">
										<input type="text" name="accno" id="accno" value="" class="required tipTop large" title="Enter the bank account number" />
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="bankname">Bank Name</label>
									<div class="form_input">
										<input type="text" name="bankname" value="" class="required tipTop large" title="Enter the bank name" />
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<div class="form_input">
                                    	<input type="button" class="btn_small btn_blue prvTab" tabindex="9" value="Prev"/>
										<button type="submit"  id="validate_adduser_form" class="btn_small btn_blue" tabindex="9" ><span>Submit</span></button>
									</div>
								</div>
								</li>
								
							</ul>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
	<script>



   
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
$(document).ready(function(){
	$('#regitstraion_form').validate({ignore: ""});
	$('#regitstraion_form').validate().settings.ignore = [];
	$("#image").rules("add", {
		accept: "jpg|jpeg|png|ico|bmp"
	});
	

	$('#accno').bind('keyup blur',function(){ 
		$(this).val( $(this).val().replace(/^[A-Za-z]*$/g,'') ); 
	});
}); 
$('#validate_adduser_form').click(function(){

if($("#new_password_warn1").html() == 'Weak'){
		$("#new_password_warn").html('Your Password should be characters and numbers');
		$("#new_password").focus();
	    return false;						
	}
	else if($('#confirm_password').val()!=$('#new_password').val()){
		$('#confirm_password_warn').html('Passwords not matching');
		$('#confirm_password').focus();
		return false;
	}
	else{
	return true;
	}

});
</script>
<?php 
$this->load->view('admin/templates/footer.php');
?>