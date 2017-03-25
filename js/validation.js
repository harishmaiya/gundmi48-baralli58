$(document).ready(function(){
	$('.checkboxCon input:checked').parent().css('background-position','-114px -260px');
	$("#selectallseeker").click(function () {
          $('.caseSeeker').attr('checked', this.checked);
          if(this.checked){
        	  $(this).parent().addClass('checked');
        	  $('.checkboxCon').css('background-position','-114px -260px');
          }else{
        	  $(this).parent().removeClass('checked');
        	  $('.checkboxCon').css('background-position','-38px -260px');
          }
    });

	$('.captcha-cls').bind("cut copy paste",function(e) {
      e.preventDefault();
	});

    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".caseSeeker").click(function(){

        if($(".caseSeeker").length == $(".caseSeeker:checked").length) {
            $("#selectallseeker").attr("checked", "checked");
            $("#selectallseeker").parent().addClass("checked");
        } else {
            $("#selectallseeker").removeAttr("checked");
            $("#selectallseeker").parent().removeClass("checked");
        }

    });

    $('.checkboxCon input').click(function(){
    	if(this.checked){
      	  $(this).parent().css('background-position','-114px -260px');
        }else{
      	  $(this).parent().css('background-position','-38px -260px');
        }
    });

	$(".popup-signup-ajax").click(function()
   {
	   //alert(baseURL);return false;
	   $.ajax(
		{
			type: 'POST',
			url: baseURL+'googlelogin/index.php',
			data:{},
			success: function(data)
			{
				//location.reload();
				//alert('sss');
				//$("#popupCheckId").val('1');
				$("#popup_container").css("display","block");
			}

		});
   });

	/**
	 * Menu notifications hover
	 *
	 */
	$('.gnb-notification').mouseenter(function(){
		if($(this).hasClass('cntLoading'))return;
		$(this).addClass('cntLoading');
		$('.feed-notification').show();
		$('.feed-notification').find('ul').remove();
		$(this).find('.loading').show();
		$.ajax({
			type:'post',
			url	: baseURL+'site/notify/getlatest',
			dataType: 'json',
			success: function(json){
				if(json.status_code == 1){
					$('.feed-notification').find('.loading').after(json.content);
					$('.moreFeed').show();
				}else if(json.status_code == 2){
					$('.feed-notification').find('.loading').after(json.content);
					$('.moreFeed').hide();
				}
			},
			complete:function(){
				$('.gnb-notification').find('.loading').hide();
				$('.gnb-notification').removeClass('cntLoading');
			}
		});
	}).mouseleave(function(){
		$('.feed-notification').hide();
	});


});


function checkBoxValidationAdmin(req,AdmEmail) {
	var tot=0;
	var chkVal = 'on';
	var frm = $('#display_form input');
	for (var i = 0; i < frm.length; i++){
		if(frm[i].type=='checkbox') {
			if(frm[i].checked) {
				tot=1;
				if(frm[i].value != 'on'){
					chkVal = frm[i].value;
				}
			}
		}
	}
	if(tot == 0) {
			sweetAlert("Oops...", "Please Select the CheckBox", "error");
			return false;
	}else if(chkVal == 'on') {
			sweetAlert("Oops...", "No records found", "error");
			return false;

	} else {
		confirm_global_status(req,AdmEmail);
	}

}
function checkBoxWithSelectValidationAdmin(req,AdmEmail) {
	var templat = $('#mail_contents').val();
	if(templat==''){
		sweetAlert("Oops...", "Please select the mail template", "error");
		return false;
	}
	var tot=0;
	var chkVal = 'on';
	var frm = $('#display_form input');
	for (var i = 0; i < frm.length; i++){
		if(frm[i].type=='checkbox') {
			if(frm[i].checked) {
				tot=1;
				if(frm[i].value != 'on'){
					chkVal = frm[i].value;
				}
			}
		}
	}
	if(tot == 0) {
			sweetAlert("Oops...", "Please Select the CheckBox", "error");
			return false;
	}else if(chkVal == 'on') {
			sweetAlert("Oops...", "No records found", "error");
			return false;

	} else {
		confirm_global_status(req,AdmEmail);
	}

}
function SelectValidationAdmin(req,AdmEmail) {
	var templat = $('#mail_contents').val();
	if(templat==''){
		sweetAlert("Oops...", "Please select the mail template", "error");
		return false;
	}

	confirm_global_status(req,AdmEmail);


}
function confirm_global_status(req,AdmEmail){
 	$.confirm({
 		'title'		: 'Confirmation',
 		'message'	: 'Whether you want to continue this action?',
 		'buttons'	: {
 			'Yes'	: {
 				'class'	: 'yes',
 				'action': function(){
					bulk_logs_action(req,AdmEmail);
 					//$('#statusMode').val(req);
 					//$('#display_form').submit();
 				}
 			},
 			'No'	: {
 				'class'	: 'no',
 				'action': function(){
 					return false;
 				}	// Nothing to do in this case. You can as well omit the action property.
 			}
 		}
 	});
 }

//Bulk Active, Inactive, Delete Logs created by siva
function bulk_logs_action(req,AdmEmail){


	var perms=prompt("For Security Purpose, Please Enter Email Id");
	if(perms==''){
			sweetAlert("Oops...", "Please Enter The Email ID", "error");
			return false;
	}else if(perms==null){
			return false;
	}else{
		if(perms==AdmEmail){
				$('#statusMode').val(req);
				$('#SubAdminEmail').val(AdmEmail);
		 		$('#display_form').submit();
		}else{
				sweetAlert("Oops...", "Please Enter The Correct Email ID", "error");
				return false;
		}
	}



}


//confirm status change
function confirm_status(path){
 	$.confirm({
 		'title'		: 'Confirmation',
 		'message'	: 'You are about to change the status of this record ! Continue?',
 		'buttons'	: {
 			'Yes'	: {
 				'class'	: 'yes',
 				'action': function(){
//alert(BaseURL+path);
 					window.location = BaseURL+path;
 				}
 			},
 			'No'	: {
 				'class'	: 'no',
 				'action': function(){
 					return false;
 				}	// Nothing to do in this case. You can as well omit the action property.
 			}
 		}
 	});
 }
//confirm mode change
function confirm_mode(path){
	$.confirm({
		'title'		: 'Confirmation',
		'message'	: 'You are about to change the display mode of this record ! Continue?',
		'buttons'	: {
			'Yes'	: {
				'class'	: 'yes',
				'action': function(){
					window.location = BaseURL+path;
				}
			},
			'No'	: {
				'class'	: 'no',
				'action': function(){
					return false;
				}	// Nothing to do in this case. You can as well omit the action property.
			}
		}
	});
}
function confirm_delete(path){
//alert(path); return false;
 	$.confirm({
 		'title'		: 'Delete Confirmation',
 		'message'	: 'You are about to delete this record. <br />It cannot be restored at a later time! Continue?',
 		'buttons'	: {
 			'Yes'	: {
 				'class'	: 'yes',
 				'action': function(){
 					window.location = BaseURL+path;
 				}
 			},
 			'No'	: {
 				'class'	: 'no',
 				'action': function(){
 					return false;
 				}	// Nothing to do in this case. You can as well omit the action property.
 			}
 		}
 	});
 }


//Category Add Function By Siva
function checkBoxCategory() {

	var tot=0;
	var chkVal = 'on';
	var frm = $('#display_form input');
	for (var i = 0; i < frm.length; i++){
		if(frm[i].type=='checkbox') {
			if(frm[i].checked) {
				tot=1;
				chkVal = frm[i].value;
			}
		}
	}
		if(tot == 0) {
				sweetAlert("Oops...", "Please Select the CheckBox", "error");
				return false;
		}else if(tot > 1){
				sweetAlert("Oops...", "Please Select only one CheckBox at a time", "error");
				return false;
		}else if(chkVal == 'on') {
				sweetAlert("Oops...", "No records found", "error");
				return false;

		} else {
			confirm_category_checkbox(chkVal);
		}

}

//Category Checkbox Confirmation
function confirm_category_checkbox(chkVal){
 	$.confirm({
 		'title'		: 'Confirmation',
 		'message'	: 'Whether you want to continue this action?',
 		'buttons'	: {
 			'Yes'	: {
 				'class'	: 'yes',
 				'action': function(){
					$('#checkboxID').val(chkVal);
 					$('#display_form').submit();
 				}
 			},
 			'No'	: {
 				'class'	: 'no',
 				'action': function(){
 					return false;
 				}	// Nothing to do in this case. You can as well omit the action property.
 			}
 		}
 	});
 }

/**
 *
 * Change the seller request status
 * @param val	-> status
 * @param sid	-> seller request id
 */
function changeSellerStatus(sid,uid){
	val = $('#seller_status_'+sid).val();
	if(val != '' && sid != ''){
		$.ajax(
	    {
	        type: 'POST',
	        url: 'admin/seller/change_seller_request',
	        data: {"id": sid,'status': val,'user_id': uid},
	        dataType: 'json',
	        success: function(json)
	        {
	            swal(json);
	        }
	    });
	}
}

function disableGiftCards(path,mail){
	$.confirm({
 		'title'		: 'Confirmation',
 		'message'	: 'You are about to change the mode of giftcards ! Continue?',
 		'buttons'	: {
 			'Yes'	: {
 				'class'	: 'yes',
 				'action': function(){
 					var perms=prompt("For Security Purpose, Please Enter Email Id");
 					if(perms==''){
 							sweetAlert("Oops...", "Please Enter The Email ID", "error");
 							return false;
 					}else if(perms==null){
 							return false;
 					}else{
 						if(perms==mail){
 							window.location = BaseURL+path;
 						}else{
							sweetAlert("Oops...", "Please Enter The Correct Email ID", "error");
							return false;
 						}
 					}
 				}
 			},
 			'No'	: {
 				'class'	: 'no',
 				'action': function(){
 					return false;
 				}	// Nothing to do in this case. You can as well omit the action property.
 			}
 		}
 	});
}

function editPictureProducts(val,imgId){

	var id = 'img_'+val;
	var sPath = window.location.pathname;
	var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
	$.ajax(
		    {
		        type: 'POST',
		        url: BaseURL+'admin/product/editPictureProducts',
		        data: {"id": id,'cpage': sPage,'position': val,'imgId':imgId},
		        dataType: 'json',
		        success: function(response)
		        {
		        	if(response == 'No') {
						sweetAlert("Oops...", "You can't delete all the images", "error");
						return false;
					  } else {
							  $('#img_'+val).remove();
					  }
		        }
		    });
}

function editPictureProductsUser(val,imgId){

	var id = 'img_'+val;
	var sPath = window.location.pathname;
	var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
	$.ajax(
			{
				type: 'POST',
				url: BaseURL+'site/product/editPictureProducts',
				data: {"id": id,'cpage': sPage,'position': val,'imgId':imgId},
				dataType: 'json',
				success: function(response)
				{
					if(response == 'No') {
						sweetAlert("Oops...", "You can't delete all the images", "error");
						return false;
					} else {
						$('#img_'+val).remove();
					}
				}
			});
}

function quickSignup(){
	var dlg_signin = $.dialog('signin-overlay'),
    	dlg_register = $.dialog('register');
	var email = $('#signin-email').val();
	$.ajax({
        type: 'POST',
        url: baseURL+'site/user/quickSignup',
        data: {"email": email},
        dataType: 'json',
        success: function(response)
        {
        	if(response.success == '0') {
				sweetAlert("Oops...", response.msg, "error");
				return false;
			 } else {
			 	$('.quickSignup2 .username').val(response.user_name);
			 	$('.quickSignup2 .url b').text(response.user_name);
			 	$('.quickSignup2 .email').val(response.email);
			 	$('.quickSignup2 .fullname').val(response.full_name);
                dlg_register.open();
			 }
        }
    });
}
function quickSignup2(){
	var username = $('.quickSignup2 .username').val();
	var email = $('.quickSignup2 .email').val();
	var password = $('.quickSignup2 .user_password').val();
	var fullname = $('.quickSignup2 .fullname').val();
	$.ajax({
        type: 'POST',
        url: baseURL+'site/user/quickSignupUpdate',
        data: {"username":username,"email": email,"password":password,"fullname":fullname},
        dataType: 'json',
        success: function(response)
        {
        	if(response.success == '0') {
				sweetAlert("Oops...", response.msg, "error");
				return false;
			 } else {
				 location.href = baseURL+'send-confirm-mail';
			 }
        }
    });
}
function reload_captcha(){
		$.ajax({
	        type: 'POST',
	        url: baseURL+'site/user/reloadCaptcha',
	        success: function(data)
	        {
				data = $.trim(data);
				var captch = data.split('-');
				$('#captacha').val(captch[0]+captch[1]);
				$('#captacha1').html(captch[0]);
				$('#captacha2').html(captch[1]);
				$('#register_captcha').val('');
	        }
	    });
}


 function onlyAlphabets(e, t) {
            try {
                if (window.event) {
                    var charCode = window.event.keyCode;
                }
                else if (e) {
                    var charCode = e.which;
                }
                else { return true; }
                if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode == 8 || charCode == 46 || e.keyCode == 9)
                    return true;
                else
                    return false;
            }
            catch (err) {
                swal(err.Description);
            }
        }

function register_user(){

	var firstname = $('#first_name').val();
	var lastname = $('#last_name').val();
	var email = $('#email').val();
	var pwd = $('#password').val();
	var cnf_pwd = $('#cnf_password').val();
	 var pwd_strength=$('#password_strength').html();
	if(firstname=='' || firstname=='First Name'){
		sweetAlert("Oops...", "Please enter the first name", "error");
	}else if(lastname=='' || lastname=='Last Name'){
		sweetAlert("Oops...", "Please enter the last name", "error");
	}else if(email=='' || email=='Email Address'){
		sweetAlert("Oops...", "Please enter the email address", "error");
	}else if(pwd==''){
		sweetAlert("Oops...", "Please enter the password", "error");
	}else if(pwd.length < 6){
		sweetAlert("Oops...", "Password must be minimum of 6 characters", "error");
	}else if(pwd_strength=="Weak"){
		sweetAlert("Oops...",'Password should contain numeric and alphabets ','error');
	}else if(cnf_pwd==''){
		sweetAlert("Oops...", "Please enter the password again", "error");
	}else if(pwd!=cnf_pwd){
		sweetAlert("Oops...", "Passwords not matching", "error");
	}else {
		var news_signup = 'no';
		if($('#checkbox').is(':checked')){
			news_signup = 'yes';
	}
	if($('#captacha').val() != $('#register_captcha').val())
	{
		$.ajax({
	        type: 'POST',
	        url: baseURL+'site/user/reloadCaptcha',
	        success: function(data)
	        {
				data = $.trim(data);
				var captch = data.split('-');
				$('#captacha').val(captch[0]+captch[1]);
				$('#captacha1').html(captch[0]);
				$('#captacha2').html(captch[1]);
	        }
	    });
		sweetAlert("Oops...", "Enter valid captcha", "error");
		$('#register_captcha').val('');
		$('#register_captcha').focus();
		return false;
	}
		$('#loading_signup').css('display','none');
		$('#loading_signup_image').css('display','block');
		$.ajax({
	        type: 'POST',
	        url: baseURL+'site/user/registerUser',
	        data: {"firstname":firstname,"lastname":lastname,"email": email,"pwd":pwd,"news_signup":news_signup},
	        dataType: 'json',
	        success: function(response)
	        {
				$('#loading_signup').css('display','block');
				$('#loading_signup_image').css('display','none');
				if(response.success == '0') {
					sweetAlert("Oops...", response.msg, "error");
					return false;
				 } else {
					//alert("Send Mail Msg"+response.msg);
					location.reload();
					 //window.location.href = baseURL+'send-confirm-mail';
				 }
				 //alert(response.success);
	        }
	    });
		return false;
	}


	return false;
}
function CheckPasswordStrength(password) {

        var password_strength = document.getElementById("new_password_warn");
 
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
        password_strength.innerHTML = strength;
        password_strength.style.color = color;
    }




function signin(){
	var signin_email = $('#signin_email_address').val();
	var signin_password = $('#signin_password').val();
	//var next_url=$('#next_url').val();


	 if(signin_email==''){
		sweetAlert("Oops...", "Please enter the email address", "error");
	}else if(signin_password==''){
		sweetAlert("Oops...", "Please enter the password", "error");
	}else if(signin_password.length < 6){
		sweetAlert("Oops...", "Password must be minimum of 6 characters", "error");
	}
	/*else if($('#login_checked_status').val()==1)
	{
	alert('Invalid Email Id');
	}*/
	else {
		var remember = 'no';
		if($('#remember').is(':checked')){
			remember = 'yes';
		}
		//alert("Scrtip"+signin_email+signin_password);
		$.ajax({

	        type: 'POST',
	        url: baseURL+'site/user/login_user',
	        data: {"email":signin_email,"password":signin_password,"remember":remember
			},

	        dataType: 'json',

	        success: function(json){
				if(json.status_code == 1){
					window.location.reload();

					
				}else{
					//$('#login_checked_status').val(1);
					swal(json.message);
				}
			}
	    });
	}
	return false;
}



<!-- script added 14/05/2014 paypal detailed stored -->
function paypaldetail(){
	//alert('welcome');
	var bank_code = $('#bank_code').val();
	var paypal_email = $('#paypal_email').val();
	var bank_name = $('#bank_name').val();
	var bank_no = $('#bank_no').val();


	if(bank_name==''){
		sweetAlert("Oops...", "Bank full name required", "error");
	}else if(bank_no==''){
		sweetAlert("Oops...", "Bank number required", "error");
	}else if(bank_code==''){
		sweetAlert("Oops...", "Bank code required", "error");
	}else if(paypal_email==''){
		sweetAlert("Oops...", "Email id required", "error");
	}else{

		$.ajax({

	        type: 'POST',
	        url: baseURL+'site/user/paypaldetail',
	        data: {"bank_name":bank_name,"bank_no":bank_no,"bank_code":bank_code,"paypalemail":paypal_email},

	        dataType: 'json',

	        success: function(json){
				if(json.status_code == 1){
					window.location.reload();

				}else{

					swal(json.message);
				}
			}
	    });

	}
	return false;
}

/* user enquiry form datas store  added 15/05/2014 */
function RentalEnquiry(){
	//alert('welcome');




	var checkin = $('#datefrom1').val();
	var checkout = $('#expiredate1').val();
	var Enquiry = $('#Enquiry').val();
	var caltophone = $('#caltophone:checked').val();
	var enquiry_timezone = $('#enquiry_timezone').val();
	var NoofGuest = $('#NoofGuest').val();
	var prd_id=$('#prd_id').val();
	var renter_id=$('#ownerid').val();
	if($("#datefrom").val()!='' && $("#expiredate").val()!='') {
        var diff = ($("#expiredate").datepicker("getDate") - $("#datefrom").datepicker("getDate")) / 1000 / 60 / 60 / 24;
	}
	//alert(caltophone);
	if(checkin==''){
		sweetAlert("Oops...", "Please select checkin date", "error");
		return false;
	}else if(checkout==''){
		sweetAlert("Oops...", "Please select checkout date", "error");
		return false;
	}else{
		$('#validationErraaaa').show();
		$.ajax({

	        type: 'POST',
	        url: baseURL+'site/user/rentalEnquiry',
	        data: {"checkin":checkin,"checkout":checkout,'numofdates':diff,"Enquiry":Enquiry,"caltophone":caltophone,"enquiry_timezone":enquiry_timezone,"NoofGuest":NoofGuest,"prd_id":prd_id,"renter_id":renter_id},

	        dataType: 'json',

	        success: function(json){
				if(json.status_code == 1){
					//window.location.reload();
					 window.location.href = baseURL+'rental/'+prd_id;

				}else{

					swal(json.message);
					return false;
				}
			}
	    });

	}


}


function RentalEnquiryBooting(){
	//alert('welcome');
	$('#validationErraaaa').show();
	var checkin = $('#datefrom1').val();
	var checkout = $('#expiredate1').val();
	var Enquiry = $('#Enquiry').val();
	var caltophone = $('#caltophone:checked').val();
	var enquiry_timezone = $('#enquiry_timezone').val();
	var NoofGuest = $('#NoofGuest').val();
	var prd_id=$('#prd_id').val();
	var renter_id=$('#renter_id').val();

	//alert(caltophone);

	/* if(bank_code==''){
		alert('Bank code required');
	}else if(paypal_email==''){
		alert('Email id required');
	}*/

		$.ajax({

	        type: 'POST',
	        url: baseURL+'site/user/rentalEnquiry',
	        data: {"checkin":checkin,"checkout":checkout,"Enquiry":Enquiry,"caltophone":caltophone,"enquiry_timezone":enquiry_timezone,"NoofGuest":NoofGuest,"prd_id":prd_id,"renter_id":renter_id},

	        dataType: 'json',

	        success: function(json){
				if(json.status_code == 1){
					//window.location.reload();
					 window.location.href = baseURL+'rental/'+prd_id;
				}else{
					swal(json.message);
					
				}
			}
	    });


	return false;
}




<!-- script end -->

function forgot_password(){
	$('#load-img-forgot').css('display','block');
	var forgot_email = $('#forgot_email').val();

	 if(forgot_email==''){
		sweetAlert("Oops...", "Email required", "error");
		$('#load-img-forgot').css('display','none');
		return false;
	}
		$.ajax({
	        type: 'POST',
	        url: baseURL+'site/user/forgot_password_user',
	        data: {"email":forgot_email},
	        dataType: 'json',
			success: function(json){
				if(json.status_code == 1){
					//alert(json.message);
					window.location.reload();
					$('#load-img-forgot').css('display','none');
				}else{
					sweetAlert("Oops...", json.message, "error");
					$('#load-img-forgot').css('display','none');
				}
			}

	    });

	return false;
}
function hideErrDiv(arg) {
	 $("#"+arg).hide("slow");
}
function resendConfirmation(mail){
	if(mail != ''){
		$('.confirm-email').html('<span>Sending...</span>');
		$.ajax({
	        type: 'POST',
	        url: baseURL+'site/user/resend_confirm_mail',
	        data: {"mail": mail},
	        dataType: 'json',
	        success: function(response){
	        	if(response.success == '0') {
					sweetAlert("Oops...", response.msg, "error");
					return false;
				 } else {
					 $('.confirm-email').html('<font color="green">Confirmation Mail Sent Successfully</font>');
				 }
	        }
	    });
	}
}
function profileUpdate(){
	$('#save_account').disable();
	var full_name=$('.setting_fullname').val();
	var web_url=$('.setting_website').val();
	var location=$('.setting_location').val();
	var twitter=$('.setting_twitter').val();
	var facebook=$('.setting_facebook').val();
	var google=$('.setting_google').val();
	var b_year=$('.birthday_year').val();
	var b_month=$('.birthday_month').val();
	var b_day=$('.birthday_day').val();
	var setting_bio=$('.setting_bio').val();
	var email=$('.setting_email').val();
	var age=$('.setting_age').val();
	var gender=$('.setting_gender:checked').val();
	$.ajax({
		type: 'POST',
		url: baseURL+'site/user_settings/update_profile',
		data: {"full_name":full_name,"web_url":web_url,"location":location,"twitter":twitter,"facebook":facebook,"google":google,"b_year":b_year,"b_month":b_month,"b_day":b_day,"about":setting_bio,"email":email,"age":age,"gender":gender},
		dataType: 'json',
		success: function(response){
			if(response.success == '0'){
				sweetAlert("Oops...", response.msg, "error");
				$('#save_account').removeAttr('disabled');
				return false;
			}else{
				window.location.href = baseURL+'settings';
			}
		}
	});
	return false;
}

function updateUserPhoto(){
	$('#save_profile_image').disable();
	if($('.uploadavatar').val()==''){
		sweetAlert("Oops...", "Choose a image to upload", "error");
		$('#save_profile_image').removeAttr('disabled');
		return false;
	}else{
		$('#profile_settings_form').removeAttr('onSubmit');
		$('#profile_settings_form').submit();
	}
}
function deleteUserPhoto(){
	$('#delete_profile_image').disable();
	var res = window.confirm('Are you sure?');
	if(res){
		$.ajax({
			type:'POST',
			url:baseURL+'site/user_settings/delete_user_photo',
			dataType:'json',
			success:function(response){
				if(response.success == '0'){
					swal(response.msg);
					$('#delete_profile_image').removeAttr('disabled');
					return false;
				}else{
					window.location.href = baseURL+'settings';
				}
			}
		});
	}else{
		$('#delete_profile_image').removeAttr('disabled');
		return false;
	}
}

/*function DeleteListYoutProperty(val){
	alert("");
	//$('#delete_profile_image').disable();
	var res = window.confirm('Are you sure?');
	if(res){
		$.ajax({
			type:'POST',
			url:baseURL+'site/product/delete_property_details',
			data:'del_id':val,dataType:'json',
			success:function(response){
				if(response.success == '0'){
					alert(response.msg);
					//$('#delete_profile_image').removeAttr('disabled');
					return false;
				}else{
					window.location.href = baseURL+'listing/all';
				}
			}
		});
	}else{
		//$('#delete_profile_image').removeAttr('disabled');
		return false;
	}
}*/

function deactivateUser(){
	$('#close_account').disable();
	var res = window.confirm('Are you sure?');
	if(res){
		$.ajax({
			url:baseURL+'site/user_settings/delete_user_account',
			success:function(response){
				window.location.href = baseURL;
			}
		});
	}else{
		$('#close_account').removeAttr('disabled');
	}
}

function delete_gift(val,gid) {

	$.ajax({
		type: 'POST',
		url:baseURL+'site/cart/ajaxDelete',
		data:{'curval':val,'cart':'gift'},
		success:function(response){
			var arr = response.split('|');
			$('#gift_cards_amount').val(arr[0]);
			$('#item_total').html(arr[0]);
			$('#total_item').html(arr[0]);
			$('#Shop_id_count').html(arr[1]);
			$('#Shop_MiniId_count').html(arr[1]+' items');
			$('#giftId_'+gid).hide();
			$('#GiftMindivId_'+gid).hide();
			if(arr[0] == 0){
				$('#GiftCartTable').hide();
				if(arr[1]==0){
					$('#EmptyCart').show();
				}
			}
		}
	});
}


function delete_subscribe(val,sid) {

	$.ajax({
		type: 'POST',
		url:baseURL+'site/cart/ajaxDelete',
		data:{'curval':val,'cart':'subscribe'},
		success:function(response){
			var arr = response.split('|');
			$('#subcrib_amount').val(arr[0]);
			$('#subcrib_ship_amount').val(arr[1]);
			$('#subcribt_tax_amount').val(arr[2]);
			$('#subcrib_total_amount').val(arr[3]);
			$('#SubCartAmt').html(arr[0]);
			$('#SubCartSAmt').html(arr[1]);
			$('#SubCartTAmt').html(arr[2]);
			$('#SubCartGAmt').html(arr[3]);
			$('#Shop_id_count').html(arr[4]);
			$('#Shop_MiniId_count').html(arr[4]+' items');
			$('#SubscribId_'+sid).hide();
			$('#SubcribtMinidivId_'+sid).hide();


			if(arr[0] == 0){
				$('#SubscribeCartTable').hide();
				if(arr[4]==0){
					$('#EmptyCart').show();
				}
			}
		}
	});
}


function ajaxEditproductAttribute(attname,attval,attId){

	//alert(attname+''+attval+''+attId);

	$('#loadingImg_'+attId).html('<span class="loading"><img src="images/indicator.gif" alt="Loading..."></span>');

	$.ajax({
		type: 'POST',
		url:baseURL+'admin/product/ajaxProductAttributeUpdate',
		data:{'attname':attname,'attval':attval,'attId':attId},
		success:function(response){
			//alert(response);
			$('#loadingImg_'+attId).html('');
		}
	});

}

function ajaxCartAttributeChange(attId,prdId){

	$('#loadingImg_'+prdId).html('<span class="loading"><img src="images/indicator.gif" alt="Loading..."></span>');
	$('#AttrErr').html('');
	$.ajax({
		type: 'POST',
		url:baseURL+'site/product/ajaxProductDetailAttributeUpdate',
		data:{'prdId':prdId,'attId':attId},
		success:function(response){
			//alert(response);
			var arr = response.split('|');

			$('#attribute_values').val(arr[0]);
			$('#price').val(arr[1]);
			$('#SalePrice').html(arr[1]);
			$('#loadingImg_'+prdId).html('');
		}
	});

}


function ajaxCartAttributeChangePopup(attId,prdId){


	$('#loadingImg1_'+prdId).html('<span class="loading"><img src="images/indicator.gif" alt="Loading..."></span>');
	$.ajax({
		type: 'POST',
		url:baseURL+'site/product/ajaxProductDetailAttributeUpdate',
		data:{'prdId':prdId,'attId':attId},
		success:function(response){
			//alert(response);
			var arr = response.split('|');
			$('#attribute_values').val(arr[0]);
			$("#attr_name_id").val(attId);
			$('#price').val(arr[1]);
			$('#SalePrice').html(arr[1]);
			$('#loadingImg1_'+prdId).html('');
		}
	});

}


function delete_cart(val,cid) {
		$.ajax({
			type: 'POST',
			url:baseURL+'site/cart/ajaxDelete',
			data:{'curval':val,'cart':'cart'},
			success:function(response){

			//alert(response);
			var arr = response.split('|');
			$('#cart_amount').val(arr[0]);
			$('#cart_ship_amount').val(arr[1]);
			$('#cart_tax_amount').val(arr[2]);
			$('#cart_total_amount').val(arr[3]);
			$('#CartAmt').html(arr[0]);
			$('#CartSAmt').html(arr[1]);
			$('#CartTAmt').html(arr[2]);
			$('#CartGAmt').html(arr[3]);
			$('#Shop_id_count').html(arr[4]);
			$('#Shop_MiniId_count').html(arr[4]+' items');
			$('#cartdivId_'+cid).hide();
			$('#cartMindivId_'+cid).hide();

			if(arr[0] == 0){
				$('#CartTable').hide();
				if(arr[4]==0){
					$('#EmptyCart').show();
				}
			}
			}
		});
}


function update_cart(val,cid) {

	var qty  = $('#quantity'+cid).val();
	var mqty = $('#quantity'+cid).data('mqty');
	if(qty-qty != 0 || qty == '' || qty == '0'){
		alert('Invalid quantity');
		sweetAlert("Oops...", "Invalid quantity", "error");
		return false;
	}
	if(qty>mqty){
		$('#quantity'+cid).val(mqty);
		qty = mqty;
		sweetAlert("Oops...", "Maximum stock available for this product is "+mqty, "error");
	}
		$.ajax({
			type: 'POST',
			url:baseURL+'site/cart/ajaxUpdate',
			data:{'updval':val,'qty':qty},
			success:function(response){
				//alert(response);
				var arr = response.split('|');
				$('#cart_amount').val(arr[1]);
				$('#cart_ship_amount').val(arr[2]);
				$('#cart_tax_amount').val(arr[3]);
				$('#cart_total_amount').val(arr[4]);
				$('#IndTotalVal'+cid).html(arr[0]);
				$('#CartAmt').html(arr[1]);
				$('#CartAmtDup').html(arr[1]);
				$('#CartSAmt').html(arr[2]);
				$('#CartTAmt').html(arr[3]);
				$('#CartGAmt').html(arr[4]);
				$('#Shop_id_count').html(arr[5]);
				$('#Shop_MiniId_count').html(arr[5]+' items');

			}
		});
}

function CartChangeAddress(IDval){

	var amt = $('#cart_amount').val();
	var disamt = $('#discount_Amt').val();


	$.ajax({
		type: 'POST',
		url:baseURL+'site/cart/ajaxChangeAddress',
		data:{'add_id':IDval,'amt':amt,'disamt':disamt},
		success:function(response){

			if(response !='0'){

				var arr = response.split('|');
				$('#cart_ship_amount').val(arr[0]);
				$('#cart_tax_amount').val(arr[1]);
				$('#cart_tax_Value').val(arr[2]);
				$('#cart_total_amount').val(arr[3]);
				$('#CartSAmt').html(arr[0]);
				$('#CartTAmt').html(arr[1]);
				$('#carTamt').html(arr[2]);
				$('#CartGAmt').html(arr[3]);

				$('#Ship_address_val').val(IDval);
				$('#Chg_Add_Val').html(arr[4]);
			}else{

				return false;
			}
		}
	});
}


function SubscribeChangeAddress(IDval){

	var amt = $('#subcrib_amount').val();

	$.ajax({
		type: 'POST',
		url:baseURL+'site/cart/ajaxSubscribeAddress',
		data:{'add_id':IDval,'amt':amt},
		success:function(response){
			if(response !='0'){
				//alert(response);
				var arr = response.split('|');
				$('#subcrib_ship_amount').val(arr[0]);
				$('#subcrib_tax_amount').val(arr[1]);
				$('#subcrib_total_amount').val(arr[3]);
				$('#SubCartSAmt').html(arr[0]);
				$('#SubCartTAmt').html(arr[1]);
				$('#SubTamt').html(arr[2]);
				$('#SubCartGAmt').html(arr[3]);
				$('#SubShip_address_val').val(IDval);
				$('#SubChg_Add_Val').html(arr[4]);
			}else{
				return false;
			}
		}
	});
}

function shipping_Subcribe_address_delete(){
	var DelId = $('#SubShip_address_val').val();
	$.ajax({
		type: 'POST',
		url:baseURL+'site/cart/ajaxDeleteAddress',
		data:{'del_ID':DelId},
		success:function(response){
			if(response ==0){
				location.reload();
			}else{
				$('#Ship_Sub_err').html('Default address don`t be deleted.');
				setTimeout("hideErrDiv('Ship_Sub_err')", 3000);
				return false;
			}
		}
	});
}

function shipping_cart_address_delete(){
	var DelId = $('#Ship_address_val').val();

	$.ajax({
		type: 'POST',
		url:baseURL+'site/cart/ajaxDeleteAddress',
		data:{'del_ID':DelId},
		success:function(response){
			if(response ==0){
				location.reload();
			}else{
				$('#Ship_err').html('Default address don`t be deleted.');
				setTimeout("hideErrDiv('Ship_err')", 3000);
				return false;
			}
		}
	});
}

function view_inquiry(shipval){
			$.ajax({
				type:'POST',
				url:baseURL+'site/user_settings/view_inquiry_details',
				data:{'inqID':shipval},
				dataType:'html',
				success:function(response){
					//alert(response);
					$('#inquiry_popup').html(response);
				}
			});
			$('#inquiry_popup').show();
			$($(".inquiry_link").colorbox({width:"600px",height:"600px", inline:true, href:"#inquiry_popup"})).trigger('click');
}

function ajax_add_cart(AttrCountVal){
	$('#QtyErr').html('');
	var login = $('.add_to_cart').attr('require_login');
	if(login){ require_login(); return;}
	var quantity=$('#quantity').val();
	var mqty = $('#quantity').data('mqty');
	if(quantity == '0' || quantity == ''){
		alert('Invalid quantity');
		sweetAlert("Oops...", "Invalid quantity", "error");
		return false;
	}
	if(quantity>mqty){
		$('#QtyErr').html('Maximum Purchase Quantity at a time is '+mqty);
		$('#quantity').val(mqty);
		return false;
	}
	if(AttrCountVal > 0){
		$('#AttrErr').html(' ');
		var AttrVal=$('#attr_name_id').val();
		if(AttrVal == 0){
			$('#AttrErr').html('Please Choose the Attribute');
			return false;
		}
	}



	//alert(AttrVal); return false;
	var product_id=$('#product_id').val();
	var sell_id=$('#sell_id').val();
	var price=$('#price').val();
	var product_shipping_cost=$('#product_shipping_cost').val();
	var product_tax_cost=$('#product_tax_cost').val();
	var cate_id=$('#cateory_id').val();
	var attribute_values=$('#attribute_values').val();

	//alert(product_id+''+sell_id+''+price+''+product_shipping_cost+''+product_tax_cost+''+attribute_values);
	$.ajax({
		type: 'POST',
		url: baseURL+'site/cart/cartadd',
		data: {'mqty':mqty,'quantity':quantity, 'product_id':product_id, 'sell_id':sell_id, 'cate_id':cate_id, 'price':price, 'product_shipping_cost':product_shipping_cost, 'product_tax_cost':product_tax_cost, 'attribute_values':attribute_values},
		success: function(response){
			//alert(response);
			var arr = response.split('|');
			if(arr[0] =='login'){
				window.location.href= baseURL+"login";
			}else if(arr[0] == 'Error'){
				//alert('siva');
				$('#ADDCartErr').html('Maximum Purchase Quantity: '+mqty+'. Already in your cart: '+arr[1]+'.');
			}else{
				$('#MiniCartViewDisp').html(arr[1]);
				$('#cart_popup').show().delay('2000').fadeOut();
			}

		}
	});
	return false;


}

function ajax_add_cart_subcribe(){
	var login = $('#subscribe').attr('require_login');
	if(login){ require_login(); return;}

	var user_id=$('#user_id').val();
	var quantity=1;
	var fancybox_id=$('#fancybox_id').val();
	var price=$('#price').val();
	var fancy_shipping_cost=$('#shipping_cost').val();
	var fancy_tax_cost=$('#tax').val();
	var category_id=$('#category_id').val();
	var name=$('#name').val();
	var seourl=$('#seourl').val();
	var image=$('#image').val();

	$.ajax({
		type: 'POST',
		url: baseURL+'site/fancybox/cartsubscribe',
		data: {'name':name, 'quantity':quantity, 'user_id':user_id, 'fancybox_id':fancybox_id, 'price':price, 'fancy_ship_cost':fancy_shipping_cost, 'category_id':category_id, 'fancy_tax_cost':fancy_tax_cost, 'seourl':seourl, 'image':image},
		success: function(response){
			//alert(response);
			if(response =='login'){
				window.location.href= baseURL+"login";
			}else{
				$('#MiniCartViewDisp').html(response);
				$('#cart_popup').show().delay('3000').fadeOut();
			}

		}
	});
	return false;
}



function ajax_add_gift_card(){

	var login = $('.create-gift-card').attr('require_login');
	if(login){ require_login(); return;}

	$('#GiftErr').html();

	var price = $('#price_value').val();
	var rec_name = $('#recipient_name').val();
	var rec_mail = $('#recipient_mail').val();
	var descp = $('#description').val();
	var sen_name = $('#sender_name').val();
	var sen_mail = $('#sender_mail').val();
	if(price ==''){
		$('#GiftErr').html('Please Select the Price Value');
		return false;
	}
	if(rec_name ==''){
		$('#GiftErr').html('Please Enter the Receiver Name');
		return false;
	}
	if(rec_mail ==''){
		$('#GiftErr').html('Please Enter the Receiver Email');
		return false;
	}else{
		if( !validateEmail(rec_mail)) {
				$('#GiftErr').html('Please Enter Valid Email Address');
				return false;
		}
	}
	if(descp =='' ){
		$('#GiftErr').html('Please  Enter the Description');
		return false;
	}

		$.ajax({
			type: 'POST',
			url: baseURL+'site/giftcard/insertEditGiftcard',
			data: {'price_value':price, 'recipient_name':rec_name, 'recipient_mail':rec_mail, 'description':descp, 'sender_name':sen_name, 'sender_mail':sen_mail },
			success: function(response){
				if(response =='login'){
					window.location.href= baseURL+"login";
				}else{
					$('#MiniCartViewDisp').html(response);
					$('#cart_popup').show();
				}
			}
		});

	return false;

}






function change_user_password(){
	$('#save_password').disable();
	var pwd = $('#pass').val();
	var cfmpwd = $('#confirmpass').val();
	if(pwd == ''){
		sweetAlert("Oops...", "Enter new password", "error");
		$('#save_password').removeAttr('disabled');
		$('#pass').focus();
		return false;
	}else if(pwd.length < 6){
		sweetAlert("Oops...", "Password must be minimum of 6 characters", "error");
		$('#save_password').removeAttr('disabled');
		$('#pass').focus();
		return false;
	}else if(cfmpwd == ''){
		sweetAlert("Oops...", "Confirm password required", "error");
		$('#save_password').removeAttr('disabled');
		$('#confirmpass').focus();
		return false;
	}else if(pwd != cfmpwd){
		sweetAlert("Oops...", "Passwords doesnot match", "error");
		$('#save_password').removeAttr('disabled');
		$('#confirmpass').focus();
		return false;
	}else{
		return true;
	}
}

function shipping_address_cart(){
	var dlg_address = $.dialog('newadds-frm'), dlg_address1 = $.dialog('editadds-frm'), $tpl = $('#address_tmpl').remove();
//	dlg_address.$obj.trigger('reset').find('.ltit').text(gettext('Add Shipping Address')).end().find('.ltxt dt').html('<b>'+gettext('New Shipping Address')+'</b><small>'+gettext('We ships worldwide with global delivery services.')+'</small>');
			dlg_address.open();

			setTimeout(function(){dlg_address.$obj.find(':text:first').focus()},10);
}


//Coupon code Used

function checkCode() {

	$('#CouponErr').html('');
	$('#CouponErr').show();

	var cartValue = $('#cart_amount').val();
	if(cartValue > 0){

	var code = $('#is_coupon').val();
	var amount = $('#cart_total_amount').val();
	var shipamount = $('#cart_ship_amount').val();
	var taxamount = $('#cart_tax_amount').val();

		if(code != '') {

			$.ajax({
			type: 'POST',
			url: baseURL+'site/cart/checkCode',
			data: {'code':code, 'amount':amount, 'shipamount':shipamount},
			success: function(response){
//				alert(response);
				var resarr = response.split('|');
				if(response == 1) {
					$('#CouponErr').html('Entered code is invalid');
					return false;
				} else if(response == 2) {
					$('#CouponErr').html('Code is already used');
					return false;
				}else if(response == 3) {
					$('#CouponErr').html('Please add more items in the cart and enter the coupon code');
					return false;
				} else if(response == 4) {
					$('#CouponErr').html('Entered Coupon code is not valid for this product');
					return false;
				} else if(response == 5) {
					$('#CouponErr').html('Entered Coupon code is expired');
					return false;
				} else if(response == 6) {
					$('#CouponErr').html('Entered code is Not Valid');
					return false;
				} else if(response == 7) {
					$('#CouponErr').html('Please add more items quantity in the particular category or product, for using this coupon code');
					return false;
				} else if(response == 8) {
					$('#CouponErr').html('Entered Gift code is expired');
					return false;
				} else if(resarr[0] == 'Success') {

					$.ajax({
					type: 'POST',
					url: baseURL+'site/cart/checkCodeSuccess',
					data: {'code':code, 'amount':amount, 'shipamount':shipamount},
					success: function(response){
//						alert(response);
						var arr = response.split('|');

						$('#cart_amount').val(arr[0]);
						$('#cart_ship_amount').val(arr[1]);
						$('#cart_tax_amount').val(arr[2]);
						$('#cart_total_amount').val(arr[3]);
						$('#discount_Amt').val(arr[4]);
						$('#CartAmt').html(arr[0]);
						$('#CartSAmt').html(arr[1]);
						$('#CartTAmt').html(arr[2]);
						$('#CartGAmt').html(arr[3]);
						$('#disAmtVal').html(arr[4]);
						$('#disAmtValDiv').show();
						$('#CouponCode').val(code);
						$('#Coupon_id').val(resarr[1]);
						$('#couponType').val(resarr[2]);
						var j=6;
						for (var i=0;i<arr[5];i++)	{
						//alert(arr[j]);
							$('#IndTotalVal'+i).html(arr[j]);
							 j++;
						}
					}
					});
				}
			}
		});
		} else {
			$('#CouponErr').html('Enter Valid Code');
		}
	} else {
		$('#CouponErr').html('Please add items in cart and enter the coupon code');

	}
	setTimeout("hideErrDiv('CouponErr')", 3000);
}

function paypal(){
	$('#PaypalPay').show();
	$('#CreditCardPay').hide();
	$('#otherPay').hide();
	$("#dep1").attr("class","depth1 current");
	$("#dep2").attr("class","depth2");
	$("#dep1 a").attr("class","current");
	$("#dep2 a").attr("class","");
}

function creditcard(){

	$('#CreditCardPay').show();
	$('#PaypalPay').hide();
	$('#otherPay').hide();

	$("#dep1").attr("class","depth1");
	$("#dep2").attr("class","depth2 current");
	$("#dep1 a").attr("class","");
	$("#dep2 a").attr("class","current");

}

function othermethods(){

	$('#otherPay').show();
	$('#PaypalPay').hide();
	$('#CreditCardPay').hide();

	$("#dep1").attr("class","depth1");
	$("#dep2").attr("class","depth2");
	$("#dep3").attr("class","depth3 current");
	$("#dep1 a").attr("class","");
	$("#dep2 a").attr("class","");
	$("#dep3 a").attr("class","current");

}

function loadListValues(e){
	var lid =  $(e).val();
	var listValue = $(e).parent().next().find('select');
	if(lid == ''){
		listValue.html('<option value="">--Select--</option>');
	}else{
		listValue.hide();
		$(e).parent().next().append('<span class="loading">Loading...</span>');
		$.ajax({
			type:'POST',
			url:BaseURL+'admin/product/loadListValues',
			data:{lid:lid},
			dataType:'json',
			success:function(json){
				listValue.next().remove();
				listValue.html(json.listCnt).show();
			}
		});
	}
}
function loadStateListValues(e){
	//$('#listCountryCnt').hide();
	//$('#listCountryCnt').hide();
	var lid =  $(e).val();
	var lvID =  $(e).val();
	//var listValue = $(e).parent().next().find('select');
	if(lid == ''){

	}else{

		$.ajax({
			type:'POST',
			url:BaseURL+'admin/product/loadStateListValues',
			data:{lid:lid},
			dataType:'json',
			success:function(json){
				$('#listStateCnt').hide();
				$('#listStateCnt').html(json.listCountryCnt).show();
			}
		});

	}
}

function loadCountryListValues(e){
	//$('#listCountryCnt').hide();
	//$('#listCountryCnt').hide();
	var lid =  $(e).val();
	var lvID =  $(e).val();
	//var listValue = $(e).parent().next().find('select');
	if(lid == ''){

	}else{

		$.ajax({
			type:'POST',
			url:BaseURL+'admin/product/loadCountryListValues',
			data:{lid:lid},
			dataType:'json',
			success:function(json){
				$('#listCountryCnt').hide();
				$('#listCountryCnt').html(json.listCountryCnt).show();
			}
		});

	}
}

function loadListValuesUser(e){
	var lid =  $(e).val();
	var listValue = $(e).parent().next().find('select');
	if(lid == ''){
		listValue.html('<option value="">--Select--</option>');
	}else{
		listValue.hide();
		$(e).parent().next().append('<span class="loading">Loading...</span>');
		$.ajax({
			type:'POST',
			url:BaseURL+'site/product/loadListValues',
			data:{lid:lid},
			dataType:'json',
			success:function(json){
				listValue.next().remove();
				listValue.html(json.listCnt).show();
			}
		});
	}
}



function changeListValues(e,lvID){
	var lid =  $(e).val();
	var listValue = $(e).parent().next().find('select');
	if(lid == ''){
		listValue.html('<option value="">--Select--</option>');
	}else{
		listValue.hide();
		$(e).parent().next().append('<span class="loading">Loading...</span>');
		$.ajax({
			type:'POST',
			url:BaseURL+'admin/product/loadListValues',
			data:{lid:lid,lvID:lvID},
			dataType:'json',
			success:function(json){
				listValue.next().remove();
				listValue.html(json.listCnt).show();
			},
			complete:function(){
				listValue.next().remove();
				listValue.show();
			}
		});
	}
}

function changeListValuesUser(e,lvID){
	var lid =  $(e).val();
	var listValue = $(e).parent().next().find('select');
	if(lid == ''){
		listValue.html('<option value="">--Select--</option>');
	}else{
		listValue.hide();
		$(e).parent().next().append('<span class="loading">Loading...</span>');
		$.ajax({
			type:'POST',
			url:BaseURL+'site/product/loadListValues',
			data:{lid:lid,lvID:lvID},
			dataType:'json',
			success:function(json){
				listValue.next().remove();
				listValue.html(json.listCnt).show();
			},
			complete:function(){
				listValue.next().remove();
				listValue.show();
			}
		});
	}
}


//confirm status change
function confirm_status_dashboard(path){
 	$.confirm({
 		'title'		: 'Confirmation',
 		'message'	: 'You are about to change the status of this record ! Continue?',
 		'buttons'	: {
 			'Yes'	: {
 				'class'	: 'yes',
 				'action': function(){
 					window.location = BaseURL+'admin/dashboard/admin_dashboard';
 				}
 			},
 			'No'	: {
 				'class'	: 'no',
 				'action': function(){
 					return false;
 				}	// Nothing to do in this case. You can as well omit the action property.
 			}
 		}
 	});
 }


function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  if( !emailReg.test( $email ) ) {
    return false;
  } else {
    return true;
  }
}

function changeShipStatus(value,dealCode,seller){
	$('.status_loading_'+dealCode).prev().hide();
	$('.status_loading_'+dealCode).show();
	$.ajax({
		type:'post',
		url:baseURL+'site/user/change_order_status',
		data:{'value':value,'dealCode':dealCode,'seller':seller},
		dataType:'json',
		success:function(json){
			if(json.status_code == 1){
//				alert('Shipping status changed successfully');
			}
		},
		fail:function(data){
			swal(data);
		},
		complete:function(){
			$('.status_loading_'+dealCode).hide();
			$('.status_loading_'+dealCode).prev().show();
		}
	});
}

function changeCatPos(evt,catID){
	var pos = $(evt).prev().val();
	if((pos-pos) != 0){
		sweetAlert("Oops...", "Invalid position", "error");
		return;
	}else{
		$(evt).hide();
		$(evt).next().show();
		$.ajax({
			type:'post',
			url:baseURL+'admin/category/changePosition',
			data:{'catID':catID,'pos':pos},
			complete:function(){
				$(evt).next().hide();
				$(evt).show().text('Done').delay(800).text('Update');
			}
		});
	}
}


function changeProductPos(evt,catID){
	var pos = $(evt).prev().val();
	if((pos-pos) != 0){
		sweetAlert("Oops...", "Invalid position", "error");
		return;
	}else{
		$(evt).hide();
		$(evt).next().show();
		$.ajax({
			type:'post',
			url:baseURL+'admin/product/changePosition',
			data:{'catID':catID,'pos':pos},
			complete:function(){
				$(evt).next().hide();
				$(evt).show().text('Done').delay(800).text('Update');
			}
		});
	}
}

function approveCmt(evt){
	if($(evt).hasClass('approving'))return;
	$(evt).addClass('approving');
	$(evt).text('Approving...');
	var cfm = window.confirm('Are you sure to approve this comment ?\n This action cannot be undone.');
	if(cfm){
		var cid = $(evt).data('cid');
		var tid = $(evt).data('tid');
		var uid = $(evt).data('uid');
		$.ajax({
			type:'post',
			url:baseURL+'site/product/approve_comment',
			data:{'cid':cid,'tid':tid,'uid':uid},
			dataType:'json',
			success:function(json){
				if(json.status_code == '1'){
					$(evt).parent().remove();
				}else{
					$(evt).removeClass('approving');
					$(evt).text('Approve');
				}
			}
		});
	}else{
		$(evt).removeClass('approving');
		$(evt).text('Approve');
	}
}

function deleteCmt(evt){
	if($(evt).hasClass('deleting'))return;
	$(evt).addClass('deleting');
	$(evt).text('Deleting...');
	var cfm = window.confirm('Are you sure to delete this comment ?\n This action cannot be undone.');
	if(cfm){
		var cid = $(evt).data('cid');
		$.ajax({
			type:'post',
			url:baseURL+'site/product/delete_comment',
			data:{'cid':cid},
			dataType:'json',
			success:function(json){
				if(json.status_code == '1'){
					$(evt).parent().parent().remove();
				}else{
					$(evt).removeClass('deleting');
					$(evt).text('Delete');
				}
			}
		});
	}else{
		$(evt).removeClass('deleting');
		$(evt).text('Delete');
	}
}

function post_order_comment(pid,utype,uid,dealcode){
	if($('.order_comment_'+pid).hasClass('posting'))return;
	$('.order_comment_'+pid).addClass('posting');
	var $form = $('.order_comment_'+pid).parent();
	if(uid==''){
		sweetAlert("Oops...", "Login required", "error");
		$('.order_comment_'+pid).removeClass('posting');
	}else{
		if($('.order_comment_'+pid).val() == ''){
			sweetAlert("Oops...", "Your comment is empty", "error");
			$('.order_comment_'+pid).removeClass('posting');
		}else{
			$form.find('img').show();
			$form.find('input').hide();
			$.ajax({
				type:'post',
				url:baseURL+'site/user/post_order_comment',
				data:{'product_id':pid,'comment_from':utype,'commentor_id':uid,'deal_code':dealcode,'comment':$('.order_comment_'+pid).val()},
				complete:function(){
					$form.find('img').hide();
					$form.find('input').show();
					window.location.reload();
				}
			});
		}
	}
}

function post_order_comment_admin(pid,dealcode){
	if($('.order_comment_'+pid).hasClass('posting'))return;
	$('.order_comment_'+pid).addClass('posting');
	var $form = $('.order_comment_'+pid).parent();
	if($('.order_comment_'+pid).val() == ''){
		sweetAlert("Oops...", "Your comment is empty", "error");
		$('.order_comment_'+pid).removeClass('posting');
	}else{
		$form.find('img').show();
		$form.find('input').hide();
		$.ajax({
			type:'post',
			url:baseURL+'admin/order/post_order_comment',
			data:{'product_id':pid,'comment_from':'admin','commentor_id':'1','deal_code':dealcode,'comment':$('.order_comment_'+pid).val()},
			complete:function(){
				$form.find('img').hide();
				$form.find('input').show();
				window.location.reload();
			}
		});
	}
}

function ChangeFeatured(FeId,rateId){
	$('#feature_'+rateId).html('<a class="c-loader" href="javascript:void(0);" title="Loading" >Loading</a>');
	var featuid=FeId;

	var id = 'feature_'+rateId;
	var sPath = window.location.pathname;
	var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
	$.ajax(
		    {
		        type: 'POST',
		        url: BaseURL+'admin/product/ChangeFeaturedProducts',
		        data: {"id": id,'cpage': sPage,'imgId':rateId,'FtrId':featuid},
		        dataType: 'json',
		        success: function(response)
		        {
					$('#feature_'+rateId).remove();
		        }

		    });

	if(featuid == 'Featured') {
		$('#feature_'+rateId).html('<a class="c-featured" href="javascript:ChangeFeatured(\'UnFeatured\','+rateId+')" title="Click To Un-Featured" >Featured</a>').show();
	}else{
		$('#feature_'+rateId).html('<a class="c-unfeatured" href="javascript:ChangeFeatured(\'Featured\','+rateId+')" title="Click To Featured" >Un-Featured</a>').show();
	}
}

function changeReceivedStatus(evt,rid){
	$(evt).hide();
	$(evt).next().show();
	$.ajax({
		type:'post',
		url:baseURL+'site/user/change_received_status',
		data:{'rid':rid,'status':$(evt).val()},
		complete:function(){
			$(evt).show();
			$(evt).next().hide();
		}
	});
}

function update_refund(evt,uid){
	if($(evt).hasClass('updating'))return;
	$(evt).addClass('updating').text('Updating..');
	var amt = $(evt).prev().val();
	if(amt == '' || (amt-amt != 0)){
		sweetAlert("Oops...", "Enter valid amount", "error");
		$(evt).removeClass('updating').text('Update');
		return false;
	}else{
		$.ajax({
			type:'post',
			url:baseURL+'admin/seller/update_refund',
			data:{'amt':amt,'uid':uid},
			complete:function(){
				window.location.reload();
			}
		});
	}
}

function DeleteWishList(pid,wid){

	var res = window.confirm('Are you sure delete the wish list?');
	if(res){
		var id = 'wish_'+pid;
		var sPath = window.location.pathname;
		var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
		$.ajax(
				{
					type: 'POST',
					url: BaseURL+'site/wishlists/DeleteWishList',
					data: {"pid": pid,'cpage': sPage,'wid': wid},
					dataType: 'json',
					success: function(json)
					{
						if(json.result == '0'){
						  $('#'+id).remove();
						  sweetAlert("Wow, Great!", "Wish list deleted successfully", "success");
						  window.location.reload();
						}
						if(json.result == '1'){
							$('#'+id).remove();
							sweetAlert("Wow, Great!", "Wish list deleted successfully", "success");
							window.location.reload();
						}
					}
				});
	}else{
		return false;
	}
}

/*function DeleteallWishList(lid)
{
	var res = window.confirm('Are you sure delete the wish list?');
	if(res){

		$.ajax(
				{
					type: 'POST',
					url: BaseURL+'site/user/DeleteallWishList',
					data: {"lid": lid},
					dataType: 'json',
					success: function(response)
					{

						if(response.status_code == 1){
							alert("Wish list deleted successfully");
							window.location.reload();
							}
						}
				});

	}
	else{
		return false;
	}
	}*/
function ChangePassword(){
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
		$( "#changePassword1" ).submit();
	}
}

function SavedNeighborhoods(val,cityname){
	var save_name=val;
	var city_name=cityname;
	$.ajax(
	{
		type: 'POST',
		url: BaseURL+'site/neighborhood/saved_neighborhoods',
		data:{'neighborhood':save_name,'city_name':city_name},
		dataType: 'json',
		success: function(response)
		{
			  $('#saveCount').html(response.count);
			  $('#saved_details').html(response.details);
			  swal(response.msg);
		}
	});
}

function DeleteNeighborhoods(val){
	var save_name=val;
	$.ajax(
	{
		type: 'POST',
		url: BaseURL+'site/neighborhood/delete_neighborhoods',
		data:{'id':save_name},
		dataType: 'json',
		success: function(response)
		{
			  $('#saveCount').html(response.count);
			  $('#row_'+save_name).hide();
			  swal(response.msg);
		}
	});
}

function delete_special_offer(bookingNo, id)
{
	$.ajax(
	{
		type: 'POST',
		url: baseURL+'site/product/delete_special_offer',
		data:{'bookingNo':bookingNo,'id':id},
		success: function(data) 
		{
			$('#delete_special_offer').remove();
			location.reload();
		}
	});
}

function offer_confirmation(action, bookingNo, id)
{
	$.ajax({
		type: 'POST',
		url: baseURL+'site/rentals/confirm_offer',
		data:{"action":action,"bookingNo":bookingNo,"id":id},
		success: function(data) 
		{
			/* $('#offer_accept_level_'+id).html(data); */
			location.reload();
		}
	});
}

       	function numericOnly(e, t) {
           try {
               if (window.event) {
                   var charCode = window.event.keyCode;
               }
               else if (e) {
                   var charCode = e.which;
               }
               else { return true; }
            	
               if ((charCode >= 48 && charCode <= 57) || charCode == 8)
                   return true;
               else
                   return false;
            }
            catch (err) {
               alert(err.Description);
            }
       	}
		
				function onlyAlphabets(e, t) {
           try {
               if (window.event) {
                   var charCode = window.event.keyCode;
               }
               else if (e) {
                   var charCode = e.which;
               }
               else { return true; }
            
               if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode == 32 || charCode == 9 || charCode == 8 || charCode == 190)
                   return true;
               else
                   return false;
           }
           catch (err) {
               alert(err.Description);
           }
       	}

