<?php 
$this->load->view('site/templates/header');
?>
<div class="lang-en wider no-subnav thing signed-out winOS" style="min-height:350px;">
 <div id="container-wrapper">
<div class="contact">
<section>
<div class="contact-us">
<div class="container">
   <div class="contact-space">
    <h2 class="contac-text">Contact Us</h2>
    <div class="col-md-6">
      <form action="site/cms/contactus" id="form" method="post">
      <ul class="contact-area">
      
        <li>
        <div class="col-md-4">
		<label class="text-name">Your Name:</label>
		</div>
		
         <div class="col-md-7">
		 <input id="name" name="name" id="name" placeholder="Your Name" class="cnt-bx" 
		 onkeypress="return onlyAlphabets(event,this);" type="text" 
		 
		 <?php if ($loginCheck == '')
		 { ?> value="" 
		 <?php }
		 else
		 { ?>
		 value= " <?php echo $userDetails->row()->user_name;?>">
		 <?php } ?>
		 </div>
      
       </li>


           <li>
        <div class="col-md-4"><label class="text-name">Email:</label></div>
         <!--<div class="col-md-7"><input type="email" id="contact_email" name="email" placeholder="Your@yourcompany.com" class="cnt-bx" type="text" onblur="validateEmail(this);"
          <?php if ($loginCheck == '')
		 { ?> value="" 
		 <?php }
		 else
		 { ?>
		  value= " <?php echo $userDetails->row()->email;?>">
		 <?php } ?>
         
         </div>-->
		 <div class="col-md-7"><input  id="contact_email" name="email" placeholder="Your@yourcompany.com" class="cnt-bx" type="text"
          <?php if ($loginCheck == '')
		 { ?> value="" 
		 <?php }
		 else
		 { ?>
		  value= " <?php echo $userDetails->row()->email;?>">
		 <?php } ?>
         
         </div>
        </li>

      

           <li>
        <div class="col-md-4"><label class="text-name">Subject:</label></div>
          <?php 
        
        	if($_GET['a'] !='')
        	{?>
        	<div class="col-md-7"><input name="subject" id="subject" class="cnt-bx widful" value="<?php echo $_GET['a'];?>"></div>
       <?php }else { ?>
         <div class="col-md-7"><input placeholder="General Enquiry" name="subject" id="subject" class="cnt-bx widful" type="text"></div>
        <?php }?> </li>


           <li>
        <div class="col-md-4"><label class="text-name">Message:</label></div>
         <div class="col-md-7"><textarea class="cnt-bx widful" name="msg"  id="msg" type="text"></textarea></div>

        </li>
          





           <li>
        <div class="col-md-4"></div>
		
         <div class="col-md-7"></textarea>
         <?php
					      // show captcha HTML using Securimage::getCaptchaHtml()
					      require_once 'captcha/securimage.php';
					      $options = array();
					      $options['input_name'] = 'ct_captcha'; // change name of input element for form post
					
					      if (!empty($_SESSION['ctform']['captcha_error'])) {
					        // error html to show in captcha output
					        $options['error_html'] = $_SESSION['ctform']['captcha_error'];
					      }
					
					      echo Securimage::getCaptchaHtml($options);
						  		 
					    ?>
         </li>


          

          <li>
       <?php /*?> <div class="col-md-4"></div>
           <div class="col-md-7"><input class="get-code" value="Get Code" type="submit"></div>
         </li>

 <li>
        <div class="col-md-4"></div>
         <div class="col-md-7"><input placeholder="Security Code" name="security_code" id="security_code" class="cnt-bx widful" type="text"></textarea></div>
         </li>*/ ?>



        <div class="col-md-4"></div>
         <div class="col-md-7"><p  class="text-name" style="color:green;">Captcha letters are not case sensitive.</p></div>


          <li>
        <div class="col-md-4"></div>
         <div class="col-md-7"><input class="send-btd" value="Send" type="button" onclick="checkval()";></div>
         </li>
      </ul>
      </form>
    </div>








<div class="col-md-6">
  <div class="address-section">
  
<div class="address-contained">
 <p> 
 <?php echo $cmscontactus->row()->description;?>   
</p>
  
</div>

 <?php /*?> <div class="map-frame">
  <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3971.8742511119563!2d100.3114405!3d5.436062499999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sHunza+Tower%2CGurney+Paragon%2C+Jalan+Kelawai%2C10250%2C+Penang.!5e0!3m2!1sen!2sin!4v1417184761768" width="500" height="200" frameborder="0" style="border:0"></iframe>
  </div> */?>

  <ul class="social-side">
    <li><a href="<?php echo $this->config->item('facebook_link'); ?>" target="_blank"></a></li>
    <li><a class="g1" href="<?php echo $this->config->item('twitter_link'); ?>" target="_blank"></a></li>
      <li><a class="g2" href="<?php echo $this->config->item('googleplus_link'); ?>" target="_blank"></a></li>
  </ul>
  
  


   </div>    

<div>
<div>
</section>
</div>

</div>
</div>
<script language="Javascript" type="text/javascript">
 
        function onlyAlphabets(e, t) {
            try {
                if (window.event) {
                    var charCode = window.event.keyCode;
                }
                else if (e) {
                    var charCode = e.which;
                }
                else { return true; }
                if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123))
                    return true;
                else
                    return false;
            }
            catch (err) {
                sweetAlert("Oops...", err.Description, "error");
            }
        }
 
    </script>
	
	<script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
	<script>
	//$(document).ready(function(){
 $(function() {
// Setup form validation on the #register-form element
   /*  $("#form").validate({
 
        // Specify the validation rules
        rules: {
           
            email: {
                required: true,
                email: true
            },
			
        },
 
        // Specify the validation error messages
        messages: {
            
			//email: "Please enter a valid email address",
           
        },
 
        submitHandler: function(form) {
            form.submit();
        }
    }); */
 
  });
	</script>
	<script>
	function validateEmail(emailField){
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

        if (reg.test(emailField.value) == false) 
        {
            sweetAlert("Oops...", "Invalid Email Address", "error");
            return false;
        }

        return true;

}
</script>
<script type="text/javascript">
function checkval()
{
	
	var name = $('#name').val();
	var email = $('#contact_email').val();
	var subject = $('#subject').val();
	var msg = $('#msg').val();
	
	  if(name==''){
		sweetAlert("Oops...", "Full name required", "error");
	}else if(validateEmail(email) == false){
		sweetAlert("Oops...", "Enter Valid email address", "error");
	}else if(subject==''){
		sweetAlert("Oops...", "Subject required", "error");
	}else if(msg==''){
		sweetAlert("Oops...", "Message required", "error");
	}else
	{
		$("#form").submit();
	}
}
function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}
<?php /*?>var email = document.forms["form"]["email"].value;
var atpos = email.indexOf("@");
var dotpos = email.lastIndexOf(".");
if (atpos< 1 || dotpos<atpos+2 || dotpos+2>=email.length) {
    alert("Not a valid e-mail address");
    return false;
} */?>
</script>
<style>
.captcha_refresh{margin-left: 10px;}
</style>
<?php
$this->load->view('site/templates/footer');
?>