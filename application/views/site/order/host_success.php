<?php 
$this->load->view('site/templates/header');
?>
<style>
.cart-list.chept2{
float: left;
width: 100%;
margin: 20px 0px;
}
.thanks-main{
width:70%;
margin:0px auto;
}
.booking{
background:#717171;
width:100%;
text-align:center;
font-size:24px;
color:#fff;
padding:5px 0px;
}
.booking h1{
padding:5px 0px;
margin:0px;
font-size:35px;
font-weight: 100;
}
.booking h5{
padding:0px;
padding-bottom:10px;
margin:0px;
font-size: 13px;
font-weight: 100;
}
.booking-success{
background: #E7E7E7;
float: left;
width: 96%;
margin: 16px;
}
.grid-con{
width:95%;
margin:0 auto;
}
.booking-success h2 {
margin-left: 2%;
}
.grid-step1{
width:100%;
float:left;
margin: 10px 0px;
}
.grid-step1 p{
width: 45%;
float: left;
background: #a5a5a5;
color: #fff;
padding: 10px;
margin-right: 12px;
}
.grid-step1 p a{
text-decoration:none;
}
.grid-step1 p:last-child{
margin-right:0px;
margin-left: 20px;
}
.grid-step1 p a{
color:#fff;
}
.thanks-book{
border:1px solid #a5a5a5;
float: left;
width: 100%;
}
</style>

<link rel="stylesheet" type="text/css" media="all" href="css/site/cms.css">

<div class="lang-en wider no-subnav thing signed-out winOS" data-twttr-rendered="true" >
 <div id="container-wrapper">
	<div class="container ">
		
		<div class="wrapper-content right-sidebar">			
			<div class="content_text" /*style="width:890px;"*/>
<?php //echo '<pre>'; print_r($invoicedata->result_array()); die; ?>	

		
	<div id="content" style="padding:0px 20px 20px 20px;">
	    
            <div class="cart-list chept2">
					<div class="thanks-main">
<div class="thanks-book">

<div class="booking">
<h1>Thanks for your Booking</h1>
<h5>We are glad that you choose our service, please review us after your journey.</h5>
</div>
<div class="booking-success">
<h2>Booking Success</h2>
<div class="grid-con">
<div class="grid-step1">
<p><a href=""> Property Name</a></p>
<p><a href=""><?php echo $get_property_name; ?></a></p>
</div>
<div class="grid-step1">
<p><a href="">Amount to be paid -</a></p>


<?php if($payment_gross!='' ||$payment_gross!=0){?>
<p><a href=""><?php echo $this->session->userdata('currency_s').' '.USDtoCurrentCurrency($payment_gross); ?></a></p>
<?php }  else {?>
<p><a href=""><?php echo $this->session->userdata('currency_s').' '.USDtoCurrentCurrency($totalAmount); ?></a></p>
<?php } ?>
</div></div>
</div>
</div>
</div>
<?php header('Refresh:5; url='.base_url().'listing/all');?>

</div>
	  </div>
</div>
		</div>
		<!-- / wrapper-content -->
	</div>
	<!-- / container -->
</div>

</div>	 
<?php 
     $this->load->view('site/templates/footer');
     ?>
