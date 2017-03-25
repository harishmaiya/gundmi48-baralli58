<?php 
 //if($this->uri->segment(1)== 'things' && $this->uri->segment(1)!= 'stores' && $this->uri->segment(3)!= 'edit' && $this->uri->segment(3)!= 'own-edit'){
    if($currency_setup->num_rows() >0){ ?>
    <form method="post" enctype="multipart/form data" action="change-currency">
    <select name="currency_value" onChange="submit()">
    <?php foreach($currency_setup->result() as $currency_s){
	           echo "<option value='".$currency_s->id."'>".$currency_s->country_name."&nbsp;&nbsp;".$currency_s->currency_type."</option></li>";
          } ?>
	</select>
    </form>
<div class="popup currency ly-title" id="userMsg" >
       <p class="ltit"><?php if($this->lang->line('choose_currency') != '') { echo stripslashes($this->lang->line('choose_currency')); } else echo "Choose Your Currency "; ?></p>
	   
	   <div class="ltxt">
	   <form action="change-currency/<?php echo $productDetails->row()->seller_product_id;?>/<?php echo $productDetails->row()->product_name;?>" method="post">
	      <ul class="currency_list">
		   <li data-value='Cedis'><a href='#'>Default Cedis</a></li>
          <?php foreach($currency_setup->result() as $currency_s){
	           echo "<li data-value='".$currency_s->id."'><a href='#'>".$currency_s->currency_symbols."&nbsp;&nbsp;".$currency_s->country_name."&nbsp;&nbsp;".$currency_s->currency_type."</a></li>";
          } ?>
		  
	      </ul>
		  <input id="store_id" size="15" name="store_id" type="hidden" value="<?php echo $this->session->userdata('cur_store_id'); ?>"/>
		  <input id="currency_value" size="15" name="currency_value" type="hidden" />
	      <div class="btn-area">
		      <input type="submit" class="btn-done" id="currency-submit" value="<?php if($this->lang->line('save') != '') { echo stripslashes($this->lang->line('save')); } else echo "Save"; ?>"/>
	      </div>
		  </form>
	   </div>
	   <button title="Close" class="ly-close"><i class="ic-del-black"></i></button>
</div>
<?php } //}?>
<script>
jQuery(function($){

	var dlg_userMsg = $.dialog('currency');
	$('.currency_setup').click(function(event){
	//alert('hi');
		event.preventDefault();
		dlg_userMsg.open();
	});
	$(".currency_list").on("click", "a", function(e){
    e.preventDefault();
    var $this = $(this).parent();
    $this.addClass("select").siblings().removeClass("select");
    $("#currency_value").val($this.data("value"));
	 });
});
</script>

<style>
.popup.currency{
	width: 450px;
	margin: 0 auto;
}
.popup.currency .ltxt {
	position: relative;
	border-radius: 0;
	padding: 18px 15px 15px;
	background: #fff;
	color: #393d4d;
}
.popup.currency .ltxt p {
	color: #393d4d;
	font-weight: bold;
	font-size: 14px;
	padding-bottom: 14px;
}
.popup.currency .btn-area {
	padding: 13px 15px;
	background: #fff;
	box-shadow: none;
	border-top-color: #e6e8ea;
	text-align: left;
	box-sizing: border-box;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	-o-box-sizing: border-box;
	-ms-box-sizing: border-box;
	margin: 0;
}
.popup.currency .btn-done {
    margin:0 auto;
	cursor:pointer;
	font-size: 13px;
	border: 1px solid #396c9d;
	color: #fff;
	height: 32px;
	font-weight: bold;
	padding: 0 12px;
	box-shadow: inset 0 1px 0px rgba(175,207,236,0.2),0 1px 0 rgba(0,0,0,0.11);
	background: -webkit-linear-gradient(top, #538cc4, #4781b9);
	background: -ms-linear-gradient(top, #538cc4, #4781b9);
	background: -moz-linear-gradient(top, #538cc4, #4781b9);
	background: -o-linear-gradient(top, #538cc4, #4781b9);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#538cc4',endColorstr='#4781b9');
	border-radius: 2px;
	text-shadow: 0 -1px 0 rgba(77,123,196,.75);
}
.popup.currency .ltxt .currency_list {list-style-type:none;}
.popup.currency .ltxt .currency_list li{display:inline;margin:3px;overflow:hidden; height:25px; width:200px;}
.popup.currency .ltxt .currency_list li a{display:block;text-decoration:none; width:200px;}
.popup.currency .ltxt .currency_list li a:hover{background:#0192B5;margin:0px;}
.popup.currency .ltxt .currency_list .select a{background:#0192B5;margin:0px;}
</style>