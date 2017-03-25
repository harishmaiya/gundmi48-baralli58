<div class="thanks-main">
<div class="thanks-book">
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

<h1><?php echo $errdesc; ?></h1>

<div class="booking">
<h1>Thanks for your Booking</h1>
<h5>We are glad that you choose our service, please review us after your journey.</h5>
</div>
<div class="booking-success">
<h2>Booking <?php echo $status; ?></h2>
<div class="grid-con">
<div class="grid-step1">
<p><a href="">Your Booking Reference Number is-</a></p>
<p><a href=""><?php echo $RefNo; ?></a></p>
</div>
<div class="grid-step1">
<p><a href="">Amount to be paid -</a></p>
<p><a href="">RM <?php echo $amount; ?></a></p>
</div></div>
</div>
</div>
</div>
<?php
header('Refresh: 10; URL=http://www.staynest.com/');
?>