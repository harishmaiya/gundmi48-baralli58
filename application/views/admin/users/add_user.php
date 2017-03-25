<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Add New Member</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'adduser_form', 'enctype' => 'multipart/form-data' , 'autocomplete' => "off");
						echo form_open_multipart('admin/users/insertEditUser',$attributes) 
					?>
	 						<ul>
	 							<li>
								<div class="form_grid_12">
									<label class="field_title" for="firstname">First Name <span class="req">*</span></label>
									<div class="form_input">
										<input name="firstname" id="firstname"  onkeypress="return onlyAlphabets(event,this);"  type="text" tabindex="1" class="required large tipTop" title="Please enter the user First Name" maxlength="15"/>
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="lastname">Last Name <span class="req">*</span></label>
									<div class="form_input">
										<input name="lastname" id="lastname"  onkeypress="return onlyAlphabets(event,this);"  type="text" tabindex="1" class="required large tipTop" title="Please enter the user Last Name" maxlength="15"/>
									</div>
								</div>
								</li>
                                
                                
                                
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="gender">I Am</label>
									<div class="form_input">
                                    <select name="gender" id="gender" class=" large tipTop"  title="Please select the gender">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Unspecified">Unspecified</option>
                                    </select>
									</div>
								</div>
								</li>
								 <li>
								 
								<div class="form_grid_12">
									<label class="field_title" for="gender">Date of birth</label>
									<div class="form_input">
                                    <select name="dob_month" id="user_birthdate_2i" class="valid">
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
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
                                        
                                        
                                        echo '>'.$i.'</option>';
                                        }
                                        
                                        
                                         ?>
                                        </select>
                                        
                                        <select name="dob_year" id="user_birthdate_1i" class="valid">
                                        <?php 
										
                                        for($i=$year;$i > 1920;$i--){
                                        
                                        echo '<option value="'.$i.'"'; 
                                        
                                        
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
										<input type="text" style=" width:295px" name="phone_no" onkeypress="return numericOnly(event,this);"/>
									</div>
								</div>
								</li> 
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="s_city">Where You Live</label>
									<div class="form_input">
										<input type="text" style=" width:295px" name="s_city"/>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="description">Describe Yourself</label>
									<div class="form_input">
										<textarea name="description" style="width:295px;"></textarea>
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="s_city">Company</label>
									<div class="form_input">
										<input type="text" style=" width:295px" name="school" />
									</div>
								</div>
								</li>
								 <li>
								<div class="form_grid_12">
									<label class="field_title" for="work">Work</label>
									<div class="form_input">
										<input type="text" style=" width:295px" name="work"/>
									</div>
								</div>
								</li>
								
	 							<li>
								<div class="form_grid_12">
									<label class="field_title" for="email">Email Address <span class="req">*</span></label>
									<div class="form_input">
										<input name="email" id="email" type="text" tabindex="4" class="required email large tipTop" title="Please enter the user email address"/>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="new_password">New Password <span class="req">*</span></label>
									<div class="form_input">
										<input name="new_password" id="new_password" type="password" onkeyup="return CheckPasswordStrength(this.value);" autocomplete="off" tabindex="5" class=" large tipTop" title="Please enter the new password"/>
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
									<label class="field_title" for="confirm_password">Re-type Password <span class="req">*</span></label>
									<div class="form_input">
										<input name="confirm_password" id="confirm_password" type="password" autocomplete="off" tabindex="6" class=" large tipTop" title="Please re-type the above password"/>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="image">User Image (Image  Size 275px X 275px)</label>
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
										<button type="submit" id="validate_adduser_form" class="btn_small btn_blue" tabindex="9"><span>Submit</span></button>
									</div>
								</div>
								</li>
							</ul>
						</form>
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
<!--Hogan-->
<script type="text/javascript">
$(document).ready(function(){
	$("#image").rules("add", {
        accept: "jpg|jpeg|png|ico|bmp"
    });
});
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

$('#validate_adduser_form').click(function(){

if($("#new_password_warn1").html() == 'Weak'){
		$("#new_password_warn").html('Your Password should be characters and numbers');
		$("#new_password").focus();
	    return false;						
	}
var image_name=$('#image').val();
var ext = $('#image').val().split('.').pop().toLowerCase();
if(image_name !='')
{
if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
    alert('Only Images can be Uploaded');
}
else{
$('#adduser_form').submit();
}
}
else{
$('#adduser_form').submit();
}
});
</script>
<!--Hogan ends-->
<?php 
$this->load->view('admin/templates/footer.php');
?>