<!-- popups -->
<div id="popup_container"> <img class="loader" src="images/site/loading.gif">
  <div class="popup ly-title reply-popup"> </div>
  

<?php 
session_start();

 $site_join_msg = str_replace("{SITENAME}",$siteTitle,$this->lang->line('signup_join_msg')); 
?>
  
  
  <div class="popup sign signup signin-overlay" style="display:none;">
    <div class="popup_wrap update2">
      <h2><?php if($this->lang->line('signup_join_msg') != '') { echo $site_join_msg; } else echo "Join".$siteTitle."today"; ?></h2>
      <div class="sns-login">
        <p><?php if($this->lang->line('header_discover_amazing') != '') { echo stripslashes($this->lang->line('header_discover_amazing')); } else echo "Discover amazing stuff, collect the things you love, buy it all in one place. Sign up today and start curate your own catalog."; ?></p>
        <ul class="sns-major">
<?php 
if ($this->config->item('facebook_app_id') != '' && $this->config->item('facebook_app_secret') != ''){
?>       
          <li>
          <button class="btn-f facebook" onclick="window.location.href='<?php echo base_url().'facebook/user.php'; ?>'"><span class="icon ic-fb"><i></i></span> <b><?php if($this->lang->line('signup_facebook') != '') { echo stripslashes($this->lang->line('signup_facebook')); } else echo "Facebook"; ?></b></button>
          </li>
<?php
}
?>


<?php 
if ($this->config->item('google_client_secret') != '' && $this->config->item('google_client_id') != '' && $this->config->item('google_redirect_url') != '' && $this->config->item('google_developer_key') != '' && is_file('google-login-mats/index.php')){
?> 	
          <li>
            <button data-gapiattached="true" class="btn-g google" onclick="window.location.href='<?php echo $authUrl; ?>'" id="fancy-g-signin" next="/"><span class="icon ic-gg"><i></i></span> <b><?php if($this->lang->line('signup_google') != '') { echo stripslashes($this->lang->line('signup_google')); } else echo "Google"; ?></b></button>
          </li>
<?php 
}
?>      
          
          
<?php 
if ($this->config->item('consumer_key') != '' && $this->config->item('consumer_secret') != ''){
?> 
	          <li>
	            <button class="btn-t twitter"  onclick="window.location.href='<?php echo base_url();?>twtest/redirect'"><span class="icon ic-tw"><i></i></span> <b><?php if($this->lang->line('signup_twitter') != '') { echo stripslashes($this->lang->line('signup_twitter')); } else echo "Twitter"; ?></b></button>
	          </li>
<?php 
}
?>          
        </ul>
      </div>
      <fieldset class="frm default">
      <div class="sns-minor" style="display:none;"> <span class="trick"></span>
        <ul>
          <li>
            <button class="btn-b social bk" data-backend="VK" data-type="signin"><span class="icon ic-bk"><i></i></span> <b></b></button>
          </li>
          <li>
            <button class="btn-r social renren" data-backend="renren" data-type="signin" next="/"><span class="icon ic-re"><i></i></span> <b><?php if($this->lang->line('signup_renren') != '') { echo stripslashes($this->lang->line('signup_renren')); } else echo "Renren"; ?></b></button>
          </li>
          <li>
            <button class="btn-w social weibo" data-backend="weibo" data-type="signin" next="/"><span class="icon ic-we"><i></i></span> <b><?php if($this->lang->line('signup_weibo') != '') { echo stripslashes($this->lang->line('signup_weibo')); } else echo "Weibo"; ?></b></button>
          </li>
        </ul>
        <i class="arrow"></i> </div>
      <h3 class="stit" style="cursor: text;"><?php if($this->lang->line('signup_with_emailaddrs') != '') { echo stripslashes($this->lang->line('signup_with_emailaddrs')); } else echo "Sign up with your email address"; ?> </h3>
      <p>
        <input placeholder="<?php if($this->lang->line('header_enter_email') != '') { echo stripslashes($this->lang->line('header_enter_email')); } else echo "Enter your email address"; ?>" id="signin-email" type="text">
        <button class="btns-blue-embo btn-signup" onclick="javascript:quickSignup();"><?php if($this->lang->line('login_signup') != '') { echo stripslashes($this->lang->line('login_signup')); } else echo "Sign up"; ?></button>
      </p>
      <input class="next_url" value="/" type="hidden">
      <p class="anyway"><?php if($this->lang->line('signup_have_Accnt') != '') { echo stripslashes($this->lang->line('signup_have_Accnt')); } else echo "Have an account?"; ?> <a href="login"><?php if($this->lang->line('header_login') != '') { echo stripslashes($this->lang->line('header_login')); } else echo "Login"; ?></a></p>
      </fieldset>
    </div>
  <!--   <p class="footer">Are you a business? <a href="#">Learn more</a></p> -->
    <a href="#" class="btn-close">X</a> 
    
    </div>
<?php 
if(isset($countryList) && $this->uri->segment(2) == 'shipping' || isset($countryList) && $this->uri->segment(1) == 'cart'){
if($this->uri->segment(1) == 'cart'){
	$acURL = 'site/cart/insert_shipping_address';
}else{
	$acURL = 'site/user_settings/insertEdit_shipping_address';
}
?>
    
    <div class="popup ly-title newadds-frm" >
		<p class="ltit"><?php if($this->lang->line('shipping_add_ship') != '') { echo stripslashes($this->lang->line('shipping_add_ship')); } else echo "Add Shipping Address"; ?></p>
		<form class="ltxt" method="post" id="shippingAddForm" action="<?php echo $acURL;?>">
			<dl>
				<dt><b><?php if($this->lang->line('header_new_ship') != '') { echo stripslashes($this->lang->line('header_new_ship')); } else echo "New Shipping Address"; ?></b>
				<small><?php if($this->lang->line('header_ships_wide') != '') { echo stripslashes($this->lang->line('header_ships_wide')); } else echo "We ships worldwide with global delivery services"; ?>.</small></dt>
				<dd class="left">
					<p><label><?php if($this->lang->line('signup_full_name') != '') { echo stripslashes($this->lang->line('signup_full_name')); } else echo "Full Name"; ?></label>
					<input name="full_name" class="full required" type="text"></p>
					<p><label><?php if($this->lang->line('shipping_nickname') != '') { echo stripslashes($this->lang->line('shipping_nickname')); } else echo "Nickname"; ?></label>
					<input name="nick_name" class="full required" placeholder="<?php if($this->lang->line('header_home_work') != '') { echo stripslashes($this->lang->line('header_home_work')); } else echo "E.g. Home, Work, Aunt Jane"; ?>" type="text"></p>
					<p><label><?php if($this->lang->line('header_country') != '') { echo stripslashes($this->lang->line('header_country')); } else echo "Country"; ?></label>
					<select name="country" class="full required">
						<?php 
						if ($countryList->num_rows()>0){
							foreach ($countryList->result() as $country){
						?>
						<option value="<?php echo $country->country_code;?>"><?php echo $country->name;?></option>
						<?php 
							}
						}
						?>
					</select></p>
					<p><label><?php if($this->lang->line('header_state_province') != '') { echo stripslashes($this->lang->line('header_state_province')); } else echo "State / Province"; ?></label>
					<input class="state required" name="state" type="text"></p>
					<p><label><?php if($this->lang->line('header_zip_postal') != '') { echo stripslashes($this->lang->line('header_zip_postal')); } else echo "Zip / Postal Code"; ?></label>
					<input name="postal_code" class="zip required" type="text"></p>
					<p><input name="set_default" id="make_this_primary_addr" value="true" type="checkbox">
					<label class="check" for="make_this_primary_addr"><?php if($this->lang->line('header_make_primary') != '') { echo stripslashes($this->lang->line('header_make_primary')); } else echo "Make this my primary shipping address"; ?></label></p>
				</dd>
				<dd class="right">
					<p><label><?php if($this->lang->line('header_addrs_one') != '') { echo stripslashes($this->lang->line('header_addrs_one')); } else echo "Address Line 1"; ?></label>
					<input name="address1" class="full required" type="text"></p>
					<p><label><?php if($this->lang->line('header_addrs_two') != '') { echo stripslashes($this->lang->line('header_addrs_two')); } else echo "Address Line 2"; ?></label>
					<input name="address2" class="full" type="text"></p>
					<p><label><?php if($this->lang->line('header_city') != '') { echo stripslashes($this->lang->line('header_city')); } else echo "City"; ?></label>
					<input name="city" class="full required" type="text"></p>
					<p><label><?php if($this->lang->line('header_telephone') != '') { echo stripslashes($this->lang->line('header_telephone')); } else echo "Telephone"; ?></label>
					<input name="phone" class="full required digits" placeholder="<?php if($this->lang->line('header_ten_only') != '') { echo stripslashes($this->lang->line('header_ten_only')); } else echo "10 digits only, no dashes"; ?>" type="text"></p>
				</dd>
			</dl>
			<div class="btns-area">
				<button type="submit" class="btn-save"><?php if($this->lang->line('header_save') != '') { echo stripslashes($this->lang->line('header_save')); } else echo "Save"; ?></button>
				<button type="reset" class="btn-cancel"><?php if($this->lang->line('header_cancel') != '') { echo stripslashes($this->lang->line('header_cancel')); } else echo "Cancel"; ?></button>
			</div>
			<input type="hidden" name="user_id" value="<?php echo $loginCheck;?>"/>
		</form>
		<button class="ly-close" title="Close"><i class="ic-del-black"></i></button>
	</div>	
	<div class="popup ly-title editadds-frm" >
		<p class="ltit"><?php if($this->lang->line('header_edit_ship') != '') { echo stripslashes($this->lang->line('header_edit_ship')); } else echo "Edit Shipping Address"; ?></p>
		<form class="ltxt" method="post" id="shippingEditForm" action="site/user_settings/insertEdit_shipping_address">
			<dl>
				<dt><b><?php if($this->lang->line('header_edit_curship') != '') { echo stripslashes($this->lang->line('header_edit_curship')); } else echo "Edit your current shipping address"; ?></b>
				<small><?php if($this->lang->line('header_ships_wide') != '') { echo stripslashes($this->lang->line('header_ships_wide')); } else echo "We ships worldwide with global delivery services"; ?>.</small></dt>
				<dd class="left">
					<p><label><?php if($this->lang->line('signup_full_name') != '') { echo stripslashes($this->lang->line('signup_full_name')); } else echo "Full Name"; ?></label>
					<input name="full_name" class="full required full_name" type="text"></p>
					<p><label><?php if($this->lang->line('shipping_nickname') != '') { echo stripslashes($this->lang->line('shipping_nickname')); } else echo "Nickname"; ?></label>
					<input name="nick_name" class="full required nick_name" placeholder="<?php if($this->lang->line('header_home_work') != '') { echo stripslashes($this->lang->line('header_home_work')); } else echo "E.g. Home, Work, Aunt Jane"; ?>" type="text"></p>
					<p><label><?php if($this->lang->line('header_country') != '') { echo stripslashes($this->lang->line('header_country')); } else echo "Country"; ?></label>
					<select name="country" class="full required country">
						<?php 
						if ($countryList->num_rows()>0){
							foreach ($countryList->result() as $country){
						?>
						<option value="<?php echo $country->country_code;?>"><?php echo $country->name;?></option>
						<?php 
							}
						}
						?>
					</select></p>
					<p><label><?php if($this->lang->line('header_state_province') != '') { echo stripslashes($this->lang->line('header_state_province')); } else echo "State / Province"; ?></label>
					<input class="state required" name="state" type="text"></p>
					<p><label><?php if($this->lang->line('header_zip_postal') != '') { echo stripslashes($this->lang->line('header_zip_postal')); } else echo "Zip / Postal Code"; ?></label>
					<input name="postal_code" class="zip required postal_code" type="text"></p>
					<p><input name="set_default" class="make_this_primary_addr" value="true" type="checkbox">
					<label class="check" for="make_this_primary_addr"><?php if($this->lang->line('header_make_primary') != '') { echo stripslashes($this->lang->line('header_make_primary')); } else echo "Make this my primary shipping address"; ?></label></p>
				</dd>
				<dd class="right">
					<p><label><?php if($this->lang->line('header_addrs_one') != '') { echo stripslashes($this->lang->line('header_addrs_one')); } else echo "Address Line 1"; ?></label>
					<input name="address1" class="full required address1" type="text"></p>
					<p><label><?php if($this->lang->line('header_addrs_two') != '') { echo stripslashes($this->lang->line('header_addrs_two')); } else echo "Address Line 2"; ?></label>
					<input name="address2" class="full address2" type="text"></p>
					<p><label><?php if($this->lang->line('header_city') != '') { echo stripslashes($this->lang->line('header_city')); } else echo "City"; ?></label>
					<input name="city" class="full required city" type="text"></p>
					<p><label><?php if($this->lang->line('header_telephone') != '') { echo stripslashes($this->lang->line('header_telephone')); } else echo "Telephone"; ?></label>
					<input name="phone" class="full required digits phone" placeholder="<?php if($this->lang->line('header_ten_only') != '') { echo stripslashes($this->lang->line('header_ten_only')); } else echo "10 digits only, no dashes"; ?>" type="text"></p>
				</dd>
			</dl>
			<div class="btns-area">
				<button type="submit" class="btn-save"><?php if($this->lang->line('header_save') != '') { echo stripslashes($this->lang->line('header_save')); } else echo "Save"; ?></button>
				<button type="reset" class="btn-cancel"><?php if($this->lang->line('header_cancel') != '') { echo stripslashes($this->lang->line('header_cancel')); } else echo "Cancel"; ?></button>
			</div>
			<input type="hidden" name="user_id" value="<?php echo $loginCheck;?>"/>
			<input type="hidden" class="ship_id" name="ship_id" value="0"/>
		</form>
		<button class="ly-close" title="Close"><i class="ic-del-black"></i></button>
	</div>
 <?php }?> 
    <div class="popup sign register signup quickSignup2" style="display:none;">
	<div class="popup_wrap">
		<h2><?php if($this->lang->line('header_almost_done') != '') { echo stripslashes($this->lang->line('header_almost_done')); } else echo "Almost Done!"; ?></h2>
		<h3 class="stit"><?php if($this->lang->line('header_more_details') != '') { echo stripslashes($this->lang->line('header_more_details')); } else echo "We need a few more things to set up your account."; ?></h3>
            <fieldset class="frm">
                <p class="error" style="margin:-10px 0 20px;display:none;"></p>
                <p><label class="label"><?php if($this->lang->line('signup_full_name') != '') { echo stripslashes($this->lang->line('signup_full_name')); } else echo "Full name"; ?></label>
                <input type="text" name="fullname" class="fullname" id="fullname" placeholder="" /></p>
                <p style="display:none;"><label class="label"><?php if($this->lang->line('signup_emailaddrs') != '') { echo stripslashes($this->lang->line('signup_emailaddrs')); } else echo "Email Address"; ?></label>
                <input type="text" name="email" id="email" class="email" value="" /></p>
                <p><label class="label"><?php if($this->lang->line('header_choose_name') != '') { echo stripslashes($this->lang->line('header_choose_name')); } else echo "Choose your username"; ?></label>
                <input type="text" name="username" class="username" id="username" placeholder="" />
                <small class="url"><?php if($this->lang->line('header_your') != '') { echo stripslashes($this->lang->line('header_your')); } else echo "Your"; ?> <?php echo $siteTitle;?> <?php if($this->lang->line('header_page') != '') { echo stripslashes($this->lang->line('header_page')); } else echo "page"; ?>: <?php echo base_url();?><?php if($this->lang->line('header_user') != '') { echo stripslashes($this->lang->line('header_user')); } else echo "user"; ?>/<b><?php if($this->lang->line('signup_user_name') != '') { echo stripslashes($this->lang->line('signup_user_name')); } else echo "username"; ?></b></small></p>
                <p><label class="label"><?php if($this->lang->line('header_create_pwd') != '') { echo stripslashes($this->lang->line('header_create_pwd')); } else echo "Create a password"; ?></label>
                <input type="password" name="user_password" class="user_password" id="user_password" placeholder="" />
                <span class="loader"><b></b> <em></em></span></p>
                <p class="account-txt"><?php if($this->lang->line('header_create_acc') != '') { echo $by_creating_accnt; } else echo "By creating an account, I accept ".$siteTitle."'s"; ?>  <?php if($this->lang->line('header_terms_service') != '') { echo stripslashes($this->lang->line('header_terms_service')); } else echo "Terms of Service"; ?><br /> <?php if($this->lang->line('header_and') != '') { echo stripslashes($this->lang->line('header_and')); } else echo "and"; ?> <?php if($this->lang->line('header_privacy_policy') != '') { echo stripslashes($this->lang->line('header_privacy_policy')); } else echo "Privacy Policy"; ?>.</p>
                <button class="btns-blue-embo btn-create sign" style="width: 150px;" onclick="javascript:quickSignup2();" from_popup="true" ><?php if($this->lang->line('signup_creat_myacc') != '') { echo stripslashes($this->lang->line('signup_creat_myacc')); } else echo "Create my account"; ?></button>
            </fieldset>
	</div>
    
</div>
<?php 
if(isset($productDetails) && $this->uri->segment(1) == 'things'){
?>

<div class="popup thing-detail no-end-days" style="display:none;">
	<div class="photo-frame">
		<span class="frame-zoom"><i class="mask"></i><i class="crop"><em></em></i></span>
		<div class="figure-list-wrapper">
			<ul class="figure-list after">
			<?php 
			$imgArr = explode(',', $productDetails->row()->image);
			if (count($imgArr)>0){
				foreach ($imgArr as $imgRow){
					if ($imgRow != ''){
			?>
				<li><a href="<?php echo base_url();?>images/product/<?php echo $imgRow;?>" data-bigger="<?php echo base_url()?>images/product/<?php echo $imgRow;?>" style="background-image:url(<?php echo base_url();?>images/product/<?php echo $imgRow;?>)" class="frame"></a></li>
			<?php 
					}
				}
			}
			?>		
			</ul>
		</div>
		<a href="#prev" title="Prev" class="move prev disabled"><span class="arrow"></span></a>
		<a href="#next" title="Next" class="move next disabled"><span class="arrow"></span></a>
	</div>
	<div class="zoom-container"></div>
	<div class="thing-info">
        <h3><?php echo $productDetails->row()->product_title;?></h3>
		
		<p class="price"><?php echo $currencySymbol;?><?php echo $productDetails->row()->sale_price;?> <span class="usd"><!--  <a class="code">--><?php echo $currencyType;?><!--</a>--></span> <small style="display: none;" price="<?php echo $productDetails->row()->sale_price;?>" sample="1,000.23">/ <?php if($this->lang->line('header_approx') != '') { echo stripslashes($this->lang->line('header_approx')); } else echo "approximately"; ?> %s</small></p>
		
		<ul class="currency_codes">
			<li><a href="#"><?php if($this->lang->line('header_usd') != '') { echo stripslashes($this->lang->line('header_usd')); } else echo "US Dollar (USD)"; ?></a></li>
			<li><a href="#"><?php if($this->lang->line('header_cad') != '') { echo stripslashes($this->lang->line('header_cad')); } else echo "Canadian Dollar (CAD)"; ?></a></li>
			<li><a href="#"><?php if($this->lang->line('header_eur') != '') { echo stripslashes($this->lang->line('header_eur')); } else echo "Euro (EUR)"; ?></a></li>
			<li><a href="#"><?php if($this->lang->line('header_gbp') != '') { echo stripslashes($this->lang->line('header_gbp')); } else echo "British Pound Sterling (GBP)"; ?></a></li>
			<li><a href="#"><?php if($this->lang->line('header_jpy') != '') { echo stripslashes($this->lang->line('header_jpy')); } else echo "Japanese Yen (JPY)"; ?></a></li>
			<li><a href="#"><?php if($this->lang->line('header_krw') != '') { echo stripslashes($this->lang->line('header_krw')); } else echo "South Korean Won (KRW)"; ?></a></li>
			<li><a href="#"><?php if($this->lang->line('header_try') != '') { echo stripslashes($this->lang->line('header_try')); } else echo "Turkish Lira (TRY)"; ?></a></li>
		</ul>
		
		
        <div class="quick-shipping" sii="57397" style="padding-top:0;">
            <span class="icon truck"></span> <?php if($this->lang->line('header_immed_ship') != '') { echo stripslashes($this->lang->line('header_immed_ship')); } else echo "Immediate Shipping"; ?> <span class="tooltip"><i class="icon"></i> <small><?php if($this->lang->line('header_ship_within') != '') { echo stripslashes($this->lang->line('header_ship_within')); } else echo "Ships within 1-3 business days"; ?><b></b></small>
		</span></div>
		<div class="thing-option">
			<?php 
/*			$attributes = unserialize($productDetails->row()->option);
			if (is_array($attributes) && count($attributes)>0 && isset($attributes['attribute_name']) && is_array($attributes['attribute_name'])){
				$attrArr = array();
				$attrKeyArr = array();
				foreach ($attributes['attribute_name'] as $key=>$val){
					if (!in_array($val, $attrArr)){
						array_push($attrArr, $val);
						$attrKeyArr[$val] = $key;
					}else {
						$attrKeyArr[$val] .= ','.$key;
					}
				}
				foreach ($attrArr as $attOption){
			?>	
			<p>
				<label><?php echo $attOption;?></label>
				<select name="<?php echo 'attr_'.$attOption;?>" data-price="0" class="popup-sale-option_id <?php echo 'attr_'.$attOption;?>">
				<option weight='' value='0'>Select</option>
				<?php 
				$attOptions = explode(',', $attrKeyArr[$attOption]);
				if (count($attOptions)>0){
					foreach ($attOptions as $attOptionVal){
				?>
				<option weight="<?php echo $attributes['attribute_weight'][$attOptionVal];?>" value="<?php echo $attributes['attribute_price'][$attOptionVal];?>"><?php echo $attributes['attribute_val'][$attOptionVal];?></option>
				<?php 
					}
				}
				?>
				</select>
			</p>
		<!-- 	<div style="clear: both;"></div> -->
			<?php 
				}
			}
*/			?>	
			<input type="hidden" id="original_sale_price" value="<?php echo $productDetails->row()->sale_price;?>"/>
			<p>
				<label for="sale-quantity"><?php if($this->lang->line('header_quant_Avail') != '') { echo stripslashes($this->lang->line('header_quant_Avail')); } else echo "Quantity "; ?></label>
				
<!--				<input style="" id="popup-sale-quantity" data-mqty="<?php echo $productDetails->row()->max_quantity;?>" class="option number quantity" onkeyup="javascript:changeQty(this);" value="1" min="1" type="number">
-->             
	   <select id="popupquantity" data-mqty="<?php echo $productDetails->row()->max_quantity;?>" name="popupquantity" class="option selectBox" onchange="javascript:changeQty(this);"  >
                <?php for($m=1;$m <= $productDetails->row()->max_quantity;$m++){ ?>
                	<option value="<?php echo $m; ?>"><?php echo $m; ?></option>
                <?php } ?>    
                </select>
				<a style="position: absolute; top: 0px; right: 0px; height: 8px; padding: 0px 7px;" class="btn-up" onclick="javascript:increaseQty();" href="javascript:void(0);">
				<span>
				</span>
				</a>
				<a style="position: absolute; top: 9px; right: 0px; height: 8px; padding: 0px 7px;" class="btn-down" onclick="javascript:decreaseQty();" href="javascript:void(0);">
				<span>
				</span>
				</a>

			</p>
            
              <?php  $attrValsSetLoad = ''; //echo '<pre>'; print_r($PrdAttrVal->result_array()); 
					if($PrdAttrVal->num_rows>0){ $attrValsSetLoad = $PrdAttrVal->row()->pid; ?>
                   <label for="quantity"><?php if($this->lang->line('header_attr') != '') { echo stripslashes($this->lang->line('header_attr')); } else echo "Attribute"; ?></label>
                   	<select name="attr_name_id1" id="attr_name_id1" class="option  selectBox" style="border:1px solid #D1D3D9; width:100px;" onchange="ajaxCartAttributeChangePopup(this.value,'<?php echo $productDetails->row()->id; ?>');" >
                        <option value="0">---- Select ----</option>
                        <?php foreach($PrdAttrVal->result_array() as $Prdattrvals ){ ?>
                        <option value="<?php echo $Prdattrvals['pid']; ?>"><?php echo $Prdattrvals['attr_name']; ?></option>
                        <?php } ?>
                        </select>
                        <div style="color:#FF0000;" id="AttrErr1"></div>
				<div id="loadingImg1_<?php echo $productDetails->row()->id; ?>"></div>
              <?php } ?>
			
			<!--<input type="hidden" class="option number" name="product_id" id="product_id" value="<?php echo $productDetails->row()->id;?>">
                <input type="hidden" class="option number" name="cateory_id" id="cateory_id" value="<?php echo $productDetails->row()->category_id;?>">                
                <input type="hidden" class="option number" name="sell_id" id="sell_id" value="<?php echo $productDetails->row()->user_id;?>">
                <input type="hidden" class="option number" name="price" id="price" value="<?php echo $productDetails->row()->sale_price;?>">
                <input type="hidden" class="option number" name="product_shipping_cost" id="product_shipping_cost" value="<?php echo $productDetails->row()->shipping_cost;?>"> 
                <input type="hidden" class="option number" name="product_tax_cost" id="product_tax_cost" value="<?php echo $productDetails->row()->tax_cost;?>">
                <input type="hidden" class="option number" name="attribute_values" id="attribute_values" value="<?php echo $attrValsSetLoad; ?>">-->
                
                
			<p class="btns-area">
				<input type="button" class="btn-green-cart add_to_cart" style="cursor:pointer;" <?php if ($loginCheck==''){echo 'require_login="true"';}?> name="addtocart" value="<?php if($this->lang->line('header_add_cart') != '') { echo stripslashes($this->lang->line('header_add_cart')); } else echo "Add to Cart"; ?>" onclick="ajax_add_cart('<?php echo $PrdAttrVal->num_rows; ?>');" />
<!--				<button type="button" class="btn-green-cart add_to_cart" require_login="true" sii="57397" sisi="616001" tid="387657140413666789" prefix="popup-sale">Add to Cart</button>-->
			</p>
			
			

		</div>
		 
		<div class="description" style="">
		<?php echo $productDetails->row()->description;?>
		</div>
		
<!--  		<h4>Shipping Information</h4>
		<ul class="ship-info">
			<li><span class="tit">Estimated Arrival</span> <span class="txt">8/12 - 8/19</span></li>
		</ul>
		-->
	</div>
	<div class="clear"></div>
	<span class="ly-close"></span>
</div>
<?php }?>

<?php 
if(isset($fancyboxDetail) && $this->uri->segment(1) == 'fancybox'){
?>

<div class="popup thing-detail no-end-days" style="display:none;">
	<div class="photo-frame">
		<span class="frame-zoom"><i class="mask"></i><i class="crop"><em></em></i></span>
		<div class="figure-list-wrapper">
			<ul class="figure-list after">
			<?php 
			$imgArr = explode(',', $fancyboxDetail->row()->image);
			if (count($imgArr)>0){
				foreach ($imgArr as $imgRow){
					if ($imgRow != ''){
			?>
				<li><a href="<?php echo base_url();?>images/fancyybox/<?php echo $imgRow;?>" data-bigger="<?php echo base_url()?>images/fancyybox/<?php echo $imgRow;?>" style="background-image:url(<?php echo base_url();?>images/fancyybox/<?php echo $imgRow;?>)" class="frame"></a></li>
			<?php 
					}
				}
			}
			?>		
			</ul>
		</div>
		<a href="#prev" title="Prev" class="move prev disabled"><span class="arrow"></span></a>
		<a href="#next" title="Next" class="move next disabled"><span class="arrow"></span></a>
	</div>
	<div class="zoom-container"></div>
	<div class="thing-info">
        <h3><?php echo $fancyboxDetail->row()->name;?></h3>
		
		<p class="price"><?php echo $currencySymbol;?><?php echo $fancyboxDetail->row()->price;?> <span class="usd"><!--  <a class="code">--><?php echo $currencyType;?><!--</a>--></span> <small style="display: none;" price="<?php echo $fancyboxDetail->row()->sale_price;?>" sample="1,000.23">/ <?php if($this->lang->line('header_approx') != '') { echo stripslashes($this->lang->line('header_approx')); } else echo "approximately"; ?> %s</small></p>
		
		<ul class="currency_codes">
			<li><a href="#"><?php if($this->lang->line('header_usd') != '') { echo stripslashes($this->lang->line('header_usd')); } else echo "US Dollar (USD)"; ?></a></li>
			<li><a href="#"><?php if($this->lang->line('header_cad') != '') { echo stripslashes($this->lang->line('header_cad')); } else echo "Canadian Dollar (CAD)"; ?></a></li>
			<li><a href="#"><?php if($this->lang->line('header_eur') != '') { echo stripslashes($this->lang->line('header_eur')); } else echo "Euro (EUR)"; ?></a></li>
			<li><a href="#"><?php if($this->lang->line('header_gbp') != '') { echo stripslashes($this->lang->line('header_gbp')); } else echo "British Pound Sterling (GBP)"; ?></a></li>
			<li><a href="#"><?php if($this->lang->line('header_jpy') != '') { echo stripslashes($this->lang->line('header_jpy')); } else echo "Japanese Yen (JPY)"; ?></a></li>
			<li><a href="#"><?php if($this->lang->line('header_krw') != '') { echo stripslashes($this->lang->line('header_krw')); } else echo "South Korean Won (KRW)"; ?></a></li>
			<li><a href="#"><?php if($this->lang->line('header_try') != '') { echo stripslashes($this->lang->line('header_try')); } else echo "Turkish Lira (TRY)"; ?></a></li>
		</ul>
		
		
<!-- 		<div class="thing-option"> -->
			<?php 
/*			$attributes = unserialize($productDetails->row()->option);
			if (is_array($attributes) && count($attributes)>0 && isset($attributes['attribute_name']) && is_array($attributes['attribute_name'])){
				$attrArr = array();
				$attrKeyArr = array();
				foreach ($attributes['attribute_name'] as $key=>$val){
					if (!in_array($val, $attrArr)){
						array_push($attrArr, $val);
						$attrKeyArr[$val] = $key;
					}else {
						$attrKeyArr[$val] .= ','.$key;
					}
				}
				foreach ($attrArr as $attOption){
			?>	
			<p>
				<label><?php echo $attOption;?></label>
				<select name="<?php echo 'attr_'.$attOption;?>" data-price="0" class="popup-sale-option_id <?php echo 'attr_'.$attOption;?>">
				<option weight='' value='0'>Select</option>
				<?php 
				$attOptions = explode(',', $attrKeyArr[$attOption]);
				if (count($attOptions)>0){
					foreach ($attOptions as $attOptionVal){
				?>
				<option weight="<?php echo $attributes['attribute_weight'][$attOptionVal];?>" value="<?php echo $attributes['attribute_price'][$attOptionVal];?>"><?php echo $attributes['attribute_val'][$attOptionVal];?></option>
				<?php 
					}
				}
				?>
				</select>
			</p>
		<!-- 	<div style="clear: both;"></div> -->
			<?php 
				}
			}
*/			?>	
<!--			<input type="hidden" id="original_sale_price" value="<?php echo $fancyboxDetail->row()->price;?>"/>
			
 			<input type="hidden" class="option number" name="product_id" id="product_id" value="<?php echo $fancyboxDetail->row()->id;?>">
                <input type="hidden" class="option number" name="cateory_id" id="cateory_id" value="<?php echo $fancyboxDetail->row()->category_id;?>">                
                <input type="hidden" class="option number" name="price" id="price" value="<?php echo $fancyboxDetail->row()->price;?>">
                <input type="hidden" class="option number" name="product_shipping_cost" id="product_shipping_cost" value="<?php echo $fancyboxDetail->row()->shipping_cost;?>"> 
                <input type="hidden" class="option number" name="product_tax_cost" id="product_tax_cost" value="<?php echo $fancyboxDetail->row()->tax;?>">
                <input type="hidden" class="option number" name="attribute_values" id="attribute_values" value="">
                
                
			<p class="btns-area">
				<input type="button" class="btn-green-cart add_to_cart" <?php if ($loginCheck==''){echo 'require_login="true"';}?> name="addtocart" value="Subscribe" onclick="ajax_add_cart();" />
				<button type="button" class="btn-green-cart add_to_cart" require_login="true" sii="57397" sisi="616001" tid="387657140413666789" prefix="popup-sale">Add to Cart</button>-->
	<!--		</p> 
			
			

		</div>-->
		 
		<div class="description" style="">
		<?php echo $fancyboxDetail->row()->description;?>
		</div>
		
<!--  		<h4>Shipping Information</h4>
		<ul class="ship-info">
			<li><span class="tit">Estimated Arrival</span> <span class="txt">8/12 - 8/19</span></li>
		</ul>
		-->
	</div>
	<div class="clear"></div>
	<span class="ly-close"></span>
</div>
<?php }?>

<?php if ($loginCheck != ''){?>
<!-- add_to_list overlay -->
<div style="display:none;margin-top: 5px; margin-left: 750.5px; opacity: 1;" show_when_fancy="<?php if ($userDetails->row()->display_lists == 'Yes'){echo 'true';}else {echo 'false';}?>" class="popup ly-title update add-to-list animated" id="add-to-list-new" >
	<div class="default" style="display: block;">
		<p class="ltit"><?php if($this->lang->line('header_add_list') != '') { echo stripslashes($this->lang->line('header_add_list')); } else echo "Add to List"; ?></p>
		<button class="ly-close" type="button"><i class="ic-del-black"></i></button>
		<div class="fancyd-item">
			<div class="image-wrapper">
				<div class="item-image"><img src="images/site/product-3.jpg"></div>
			</div>
			<div class="item-categories">
				<form action="#">
					<fieldset class="list-categories">
					<div class="list-box">
					<ul>


</ul></div></fieldset>
					<fieldset class="new-list">
						<i class="ic-plus"></i>
						<input type="text" placeholder="<?php if($this->lang->line('header_create_nwlist') != '') { echo stripslashes($this->lang->line('header_create_nwlist')); } else echo "Create New List"; ?>" id="quick-create-list" name="list_name">
						<button class="btn-create" type="submit" style="display: none;"><?php if($this->lang->line('header_create') != '') { echo stripslashes($this->lang->line('header_create')); } else echo "Create"; ?></button>
					</fieldset>
				</form>
			</div>
		</div>
		<div class="btn-area">
				<button class="btn-add-to-list btn-done" type="button"><?php if($this->lang->line('header_done') != '') { echo stripslashes($this->lang->line('header_done')); } else echo "Done"; ?></button>
				<button id="i-want-this" class="btn-want" type="button"><i class="ic-plus"></i> <b><?php if($this->lang->line('header_want') != '') { echo stripslashes($this->lang->line('header_want')); } else echo "Want"; ?></b></button>
				<a class="btn-set" href="#"><i class="ic-setting"></i><span class="hidden"><?php if($this->lang->line('header_settings') != '') { echo stripslashes($this->lang->line('header_settings')); } else echo "Settings"; ?></span><i class="ic-arrow"></i></a>
				<div class="set-dropdown" style="display: none;">
					<ul>
						<li><a class="btn-unfancy" href="#"><?php echo UNLIKE_BUTTON;?></a></li>
						<li><a class="btn-create-list" href="#"><?php if($this->lang->line('header_create_nwlist') != '') { echo stripslashes($this->lang->line('header_create_nwlist')); } else echo "Create New List"; ?></a></li>
					</ul>
					<div class="hr"></div>
					<ul>
						<li><a href="settings/preferences"><?php if($this->lang->line('header_list_settings') != '') { echo stripslashes($this->lang->line('header_list_settings')); } else echo "List Settings"; ?></a></li>
					</ul>
				</div>
			</div>
	</div>
	<div style="display: none;" class="create-list">
		<p class="ltit"><?php if($this->lang->line('header_create_nwlist') != '') { echo stripslashes($this->lang->line('header_create_nwlist')); } else echo "Create New List"; ?></p>
		<button title="Close" class="close cancel"><i class="ic-del-black"></i></button>
		<form loid="14528007">
		<fieldset>
			<div class="frm">
				<p><b class="stit"><?php if($this->lang->line('header_title') != '') { echo stripslashes($this->lang->line('header_title')); } else echo "Title"; ?></b> <input type="text" placeholder="<?php if($this->lang->line('header_enter_title') != '') { echo stripslashes($this->lang->line('header_enter_title')); } else echo "Enter a title"; ?>" class="right" name="list_name"></p>
				
			</div>
			<?php if ($mainCategories->num_rows()>0){?>
			<div class="frm">
				<p>
					<b class="stit"><?php if($this->lang->line('header_category') != '') { echo stripslashes($this->lang->line('header_category')); } else echo "Category"; ?></b>
					<select class="right" id="categories-for-new-list" name="category_id">
					<option value="0"><?php if($this->lang->line('header_select_cate') != '') { echo stripslashes($this->lang->line('header_select_cate')); } else echo "Select category"; ?></option>
					<?php 
                      foreach ($mainCategories->result() as $row){
                      	if ($row->cat_name != ''){
                      ?>
					<option value="<?php echo $row->id;?>"><?php echo $row->cat_name;?></option>
					<?php 
                      	}
                      }
					?>
					</select>
				</p>
			</div>
			<?php }?>
 			
			<div class="frm">
				<b class="stit"><?php if($this->lang->line('header_contributors') != '') { echo stripslashes($this->lang->line('header_contributors')); } else echo "Contributors"; ?></b>
				<div class="right">
					<p>
<!--  						<input type="text" placeholder="Username or email address" id="create-list-find-user">
						<button class="btn-invite">Invite</button>
						</p><div class="comment-autocomplete">
							<ul>
								<script type="fancy/template">
									&lt;li&gt;&lt;img src="##image_url##" class="photo"&gt;&lt;span class="username"&gt;##username##&lt;/span&gt;&lt;span class="name"&gt;(##fullname##)&lt;/span&gt;&lt;/li&gt;
								</script>
							</ul>
						</div>
						<input type="hidden" value="" id="create-list-collaborators" name="collaborators">
					<p></p>
 		-->			<ul class="user-list">
						<li>
						<?php 
						$img = 'user-thumb1.png';
						if ($userDetails->row()->image != ''){
							$img = $userDetails->row()->image;
						}
						?>
							<img alt="<?php echo $userDetails->row()->user_name;?>" src="images/users/<?php echo $img;?>">
							<span class="left"><b><?php echo $userDetails->row()->full_name;?></b><?php echo $userDetails->row()->user_name;?></span>
							<span class="right"><?php if($this->lang->line('header_cretor') != '') { echo stripslashes($this->lang->line('header_cretor')); } else echo "Creator"; ?></span>
						</li>
						<script id="tpl-invite-user-list" type="fancy/template">
							&lt;li data-id="##id##"&gt;&lt;img src="##image_url##"&gt;&lt;span class="left"&gt;&lt;b&gt;##fullname##&lt;/b&gt;##username##&lt;/span&gt;&lt;span class="right"&gt;&lt;a href="#"&gt;&lt;i class="ic-del"&gt;&lt;/i&gt;&lt;span class="hidden"&gt;Delete&lt;/span&gt;&lt;/a&gt;&lt;/span&gt;&lt;/li&gt;
						</script>
					</ul>
 				</div>
			</div>

		</fieldset>
		<div class="btn-area">
			<button class="btn-create" type="submit"><?php if($this->lang->line('header_create_list') != '') { echo stripslashes($this->lang->line('header_create_list')); } else echo "Create list"; ?></button>
			<button class="cancel" type="button"><?php if($this->lang->line('header_cancel') != '') { echo stripslashes($this->lang->line('header_cancel')); } else echo "Cancel"; ?></button>
		</div>
		</form>
	</div>
</div>
<!-- /add_to_list overlay -->


<!-- change photo -->
<div style="margin-top: 218px; margin-left: 770.5px; opacity: 1; display: none;" class="popup change-photo none animated">
	<form id="form-photo" method="post" action="site/user_settings/change_photo" enctype="multipart/form-data">
	<p class="ltit"><?php if($this->lang->line('header_up_photo') != '') { echo stripslashes($this->lang->line('header_up_photo')); } else echo "Upload Photo"; ?></p>
	<div class="photoframe">
		<div class="uploading">
			<span><?php if($this->lang->line('settings_uploading') != '') { echo stripslashes($this->lang->line('settings_uploading')); } else echo "Uploading..."; ?></span>
		</div>
		<img id="uploaded-photo" src="images/site/blank.gif" style="background-image:url('images/users/<?php if ($userDetails->row()->image == ''){ echo 'user-thumb1.png';}else { echo $userDetails->row()->image;}?>');" alt="">
		<a href="#" id="delete_profile_image"><?php if($this->lang->line('header_delete_photo') != '') { echo stripslashes($this->lang->line('header_delete_photo')); } else echo "Delete Photo"; ?></a>
	</div>
	<div class="frm">
		<p><?php if($this->lang->line('header_allow_types') != '') { echo stripslashes($this->lang->line('header_allow_types')); } else echo "Allowed file types JPG or PNG. Maximum width and height 600px"; ?></p>
		<div class="file_input_div">
			<button class="file_input_button"><?php if($this->lang->line('header_choose_file') != '') { echo stripslashes($this->lang->line('header_choose_file')); } else echo "Choose file"; ?></button>
			<input id="fileName" class="file_input_textbox" readonly="readonly" placeholder="<?php if($this->lang->line('header_no_file') != '') { echo stripslashes($this->lang->line('header_no_file')); } else echo "No file has been selected"; ?>" type="text">
			<input id="uploadavatar" name="upload-file" class="file_input_hidden" onChange="document.getElementById('fileName').value = this.value.split(/[/\\]/).reverse()[0]" type="file">
		</div>
	</div>
	<div class="btn-area">
		<button id="save_profile_image" class="btns-blue-embo"><?php if($this->lang->line('header_up_photo') != '') { echo stripslashes($this->lang->line('header_up_photo')); } else echo "Upload Photo"; ?></button>
	</div>
	<button class="ly-close" title="Close"><i class="ic-del-black"></i></button>
	</form>
</div>
<!-- /change photo -->
<?php }?>


<div class="popup ly-title gift-recommend" style="display:none;">
	<h3 class="ltit"><?php if($this->lang->line('header_gift_recom') != '') { echo stripslashes($this->lang->line('header_gift_recom')); } else echo "Gift Recommendations"; ?></h3>
	<dl>
		<dt><?php if($this->lang->line('header_ask_the') != '') { echo stripslashes($this->lang->line('header_ask_the')); } else echo "Ask the"; ?> <?php echo $siteTitle;?> <?php if($this->lang->line('header_ask_experts') != '') { echo stripslashes($this->lang->line('header_ask_experts')); } else echo "experts"; ?></dt>
		<dd><p><?php if($this->lang->line('header_fill_form') != '') { echo stripslashes($this->lang->line('header_fill_form')); } else echo "Fill in the form below and we'll email you back with some great gift ideas you can buy right here on"; ?> <?php echo $siteTitle;?>.</p></dd>
	</dl>
	<dl>
		<dt><?php if($this->lang->line('header_description') != '') { echo stripslashes($this->lang->line('header_description')); } else echo "Description"; ?></dt>
		<dd>
			<select class="gift-target" id="gift-for">
				<option value="none"><?php if($this->lang->line('header_for') != '') { echo stripslashes($this->lang->line('header_for')); } else echo "For"; ?></option>
				<option value="male"><?php if($this->lang->line('settings_male') != '') { echo stripslashes($this->lang->line('settings_male')); } else echo "Male"; ?></option>
				<option value="female"><?php if($this->lang->line('settings_female') != '') { echo stripslashes($this->lang->line('settings_female')); } else echo "Female"; ?></option>
			</select>
			<select class="gift-category" id="gift-cat">
				<option value="none"><?php if($this->lang->line('header_category') != '') { echo stripslashes($this->lang->line('header_category')); } else echo "Category"; ?></option>
				<option value="1"><?php if($this->lang->line('header_mens') != '') { echo stripslashes($this->lang->line('header_mens')); } else echo "Men's"; ?></option><option value="2"><?php if($this->lang->line('header_womens') != '') { echo stripslashes($this->lang->line('header_womens')); } else echo "Women's"; ?></option><option value="3"><?php if($this->lang->line('header_kids') != '') { echo stripslashes($this->lang->line('header_kids')); } else echo "Kids"; ?></option><option value="4"><?php if($this->lang->line('header_pets') != '') { echo stripslashes($this->lang->line('header_pets')); } else echo "Pets"; ?></option><option value="5"><?php if($this->lang->line('header_home') != '') { echo stripslashes($this->lang->line('header_home')); } else echo "Home"; ?></option><option value="6"><?php if($this->lang->line('header_gadgets') != '') { echo stripslashes($this->lang->line('header_gadgets')); } else echo "Gadgets"; ?></option><option value="7"><?php if($this->lang->line('header_art') != '') { echo stripslashes($this->lang->line('header_art')); } else echo "Art"; ?></option><option value="8"><?php if($this->lang->line('header_food') != '') { echo stripslashes($this->lang->line('header_food')); } else echo "Food"; ?></option><option value="9"><?php if($this->lang->line('header_media') != '') { echo stripslashes($this->lang->line('header_media')); } else echo "Media"; ?></option><option value="11"><?php if($this->lang->line('header_atchitecture') != '') { echo stripslashes($this->lang->line('header_atchitecture')); } else echo "Architecture"; ?></option><option value="12"><?php if($this->lang->line('header_travel') != '') { echo stripslashes($this->lang->line('header_travel')); } else echo "Travel"; ?> &amp; <?php if($this->lang->line('header_destination') != '') { echo stripslashes($this->lang->line('header_destination')); } else echo "Destinations"; ?></option><option value="13"><?php if($this->lang->line('header_sports') != '') { echo stripslashes($this->lang->line('header_sports')); } else echo "Sports"; ?> &amp; <?php if($this->lang->line('header_outdoors') != '') { echo stripslashes($this->lang->line('header_outdoors')); } else echo "Outdoors"; ?></option><option value="14"><?php if($this->lang->line('header_diy') != '') { echo stripslashes($this->lang->line('header_diy')); } else echo "DIY"; ?> &amp; <?php if($this->lang->line('header_crafts') != '') { echo stripslashes($this->lang->line('header_crafts')); } else echo "Crafts"; ?></option><option value="15"><?php if($this->lang->line('header_workspace') != '') { echo stripslashes($this->lang->line('header_workspace')); } else echo "Workspace"; ?></option><option value="16"><?php if($this->lang->line('header_cars') != '') { echo stripslashes($this->lang->line('header_cars')); } else echo "Cars"; ?> &amp; <?php if($this->lang->line('header_vehicles') != '') { echo stripslashes($this->lang->line('header_vehicles')); } else echo "Vehicles"; ?></option><option value="10"><?php if($this->lang->line('header_other') != '') { echo stripslashes($this->lang->line('header_other')); } else echo "Other"; ?></option>
			</select>
			<select class="gift-point" id="gift-price">
				<option value="none"><?php if($this->lang->line('giftcard_price') != '') { echo stripslashes($this->lang->line('giftcard_price')); } else echo "Price"; ?></option>
				<option value="1-20">$1-20</option>
				<option value="20-100">$20-100</option>
				<option value="100-200">$100-200</option>
				<option value="200-500">$200-500</option>
				<option value="500+">$500+</option>
			</select><br>
			<textarea placeholder="<?php if($this->lang->line('header_much_detals') != '') { echo stripslashes($this->lang->line('header_much_detals')); } else echo "Please give us as much detail as possible to help you find the perfect gift, including information about the recipient, price range, etc."; ?>"></textarea>
		</dd>
	</dl>
	<div class="btn-area">
		<button class="btn-share"><?php if($this->lang->line('header_send_reqst') != '') { echo stripslashes($this->lang->line('header_send_reqst')); } else echo "Send Request"; ?></button>
	</div>
	<button title="Close" class="ly-close"><i class="ic-del-black"></i></button>
</div>


<div class="popup add-cmt ly-title" style="display:none;">
	<p class="ltit"><?php if($this->lang->line('header_add_comment') != '') { echo stripslashes($this->lang->line('header_add_comment')); } else echo "Add a Comment"; ?></p>
	<div class="ltxt">
		<p class="figcaption"></p>
		<textarea placeholder="<?php if($this->lang->line('header_write_comment') != '') { echo stripslashes($this->lang->line('header_write_comment')); } else echo "Write a comment..."; ?>"></textarea>
	</div>
	<div class="btn-area">
		<small><?php if($this->lang->line('header_use_at') != '') { echo stripslashes($this->lang->line('header_use_at')); } else echo "Use @ to mention someone"; ?></small>
		<button class="btn-done"><?php if($this->lang->line('header_post_comment') != '') { echo stripslashes($this->lang->line('header_post_comment')); } else echo "Post Comment"; ?></button>
	</div>
	<button title="Close" class="ly-close"><i class="ic-del-black"></i></button>
</div>




<div class="popup drop-to-upload no-slide" style="display:none;">
	<h1>
		<span class="top"></span><span class="left"></span><span class="right"></span><span class="bottom"></span>
		<strong><?php if($this->lang->line('header_drop_up') != '') { echo stripslashes($this->lang->line('header_drop_up')); } else echo "Drop to Upload"; ?></strong>
	</h1>
</div>
<div class="popup add-fancy box-rnd-shadow-2 ly-title step1 animated" style="margin-top: 43px; margin-left: 415px; opacity: 1; display: none;">
	<div class="step step0-error">
		<p class="ltit"><?php if($this->lang->line('header_error') != '') { echo stripslashes($this->lang->line('header_error')); } else echo "Error"; ?></p>
		<p class="message">
			<i class="ic-error-black"></i>
			<?php if($this->lang->line('header_up_try') != '') { echo stripslashes($this->lang->line('header_up_try')); } else echo "Please try uploading again. Filetype is not supported."; ?><br>
			<?php if($this->lang->line('header_img_format') != '') { echo stripslashes($this->lang->line('header_img_format')); } else echo "The image must be in one of the following formats: .jpeg, .jpg, .gif or .png."; ?>
		</p>
		<p class="btns-area"><button class="btn-blue-embo"><?php if($this->lang->line('header_okay') != '') { echo stripslashes($this->lang->line('header_okay')); } else echo "Okay"; ?></button></p>
	</div>
	<div class="step step1">
		<p class="ltit"><?php if($this->lang->line('header_add_to') != '') { echo stripslashes($this->lang->line('header_add_to')); } else echo "Add to"; ?> <?php echo $siteTitle;?></p>
		<ul class="case">
<!-- 			<li><a href="#step2"><span class="ico-web"></span>From Web</a></li> -->
			<li><a href="#step2-upload"><span class="ico-up"></span><?php if($this->lang->line('header_upload') != '') { echo stripslashes($this->lang->line('header_upload')); } else echo "Upload"; ?></a></li>
<!-- 			<li class="last"><a class="mbox_" href="#" original-title="" target="_blank"><!-- title="Email a photo directly to your collection. Name your item in the subject and write a note in the body."><a href="#step4"--><!-- <span class="ico-mail"></span>Email</a></li> -->
		</ul>
 		<p class="comment">
<!--			<a class="btn-fancyit" href="
javascript:(function(){thefancy_username='1feddf87b5115d5cf2da837516cd253318950eb7';var s_id='thefancy_tagger_bookmarklet_helper_js',s=document.getElementById(s_id),can_continue=true,t;if(s){t=window;try{if (t.thefancy_bookmarklet){t.thefancy_bookmarklet.tagger.clean_listeners();s.parentNode.removeChild(s)}else{can_continue=false}}catch(e5){can_continue=false}};if(can_continue){s=document.createElement('SCRIPT');s.type='text/javascript';s.id=s_id;s.src='http://fancy.com/bookmarklet/fancy_tagger.js?_='+(Math.random());document.getElementsByTagName('head')[0].appendChild(s)}})();
"><?php echo $siteTitle;?> It</a>
			<span class="arrow"></span> Drag this <b>button</b> to your Bookmarks Bar and <?php echo $siteTitle;?> easily from any site. [<a href="/help">?</a>]
-->		</p>
 	</div>
	<div class="step step2">
		<p class="ltit"><?php if($this->lang->line('header_add_frmweb') != '') { echo stripslashes($this->lang->line('header_add_frmweb')); } else echo "Add from Web"; ?></p>
		<div class="link">
			<p>
				<label><?php if($this->lang->line('header_enter_imglink') != '') { echo stripslashes($this->lang->line('header_enter_imglink')); } else echo "Enter an image link or a website address"; ?></label>
				<input type="text" placeholder="http://" class="input-text url_">
			</p>
		</div>
		<div class="btns-area">
			<button class="btn-blue-embo-fetch"><?php if($this->lang->line('header_fetch_imgs') != '') { echo stripslashes($this->lang->line('header_fetch_imgs')); } else echo "Fetch Images"; ?></button>
			<a class="cancel" href="#"><?php if($this->lang->line('signup_goback') != '') { echo stripslashes($this->lang->line('signup_goback')); } else echo "Go Back"; ?></a>
		</div>
		<div class="progress"><span class="progress-bar"><em></em></span></div>
	</div>
	<div class="step step2-upload">
		<p class="ltit"><?php if($this->lang->line('header_upload_to') != '') { echo stripslashes($this->lang->line('header_upload_to')); } else echo "Upload to"; ?> <?php echo $siteTitle;?></p>
		<label><?php if($this->lang->line('header_seletct_drag') != '') { echo stripslashes($this->lang->line('header_seletct_drag')); } else echo "Select an image here to upload"; ?></label>
		<form enctype="multipart/form-data" method="post" target="iframe_img_upload" action="/upload_image?callback=_upload_image_callback"><input type="hidden" value="pydBWoHBRJkFX3lt9F37BLUeLsfu9eZV" name="csrfmiddlewaretoken">
		<div class="file"><input type="file" accept="image/*" value="" name="file"></div>
		<div class="btns-area">
			<button class="btn-blue-embo-upload" type="submit"><span><?php if($this->lang->line('header_upload') != '') { echo stripslashes($this->lang->line('header_upload')); } else echo "Upload"; ?></span></button>
			<a class="cancel" href="#"><?php if($this->lang->line('signup_goback') != '') { echo stripslashes($this->lang->line('signup_goback')); } else echo "Go Back"; ?></a>
		</div>
		<div class="progress" style="display: none;"><span class="progress-bar"><em style="width: 0px;"></em></span></div>
		</form>
	</div>
	<div class="step step3">
		<p class="ltit"></p>
		<dl>
			<dt><?php if($this->lang->line('header_prod_details') != '') { echo stripslashes($this->lang->line('header_prod_details')); } else echo "Product Details"; ?> <small><?php if($this->lang->line('header_change_later') != '') { echo stripslashes($this->lang->line('header_change_later')); } else echo "(Can be changed later)"; ?></small></dt>
			<dd>
				<div class="img">
					<div class="photo-wrap"><img class="photo"></div>
					<span class="controls">
						<button class="prev"><i></i><span class="hidden"><?php if($this->lang->line('header_prev') != '') { echo stripslashes($this->lang->line('header_prev')); } else echo "Prev"; ?></span></button>
						<button class="next"><i></i><span class="hidden"><?php if($this->lang->line('onboarding_next') != '') { echo stripslashes($this->lang->line('onboarding_next')); } else echo "Next"; ?></span></button>
						<span class="cur_"><?php if($this->lang->line('header_one_ten') != '') { echo stripslashes($this->lang->line('header_one_ten')); } else echo "1 of 10"; ?></span>
					</span>
					<span class="size"></span>
				</div>
				<div class="frm">
					<input type="hidden" value="sarvan16" id="fancy_add-user_key">
					<input type="hidden" value="" id="fancy_add-photo_url">
					<label><?php if($this->lang->line('header_title') != '') { echo stripslashes($this->lang->line('header_title')); } else echo "Title"; ?></label>
					<input type="text" class="input-text" id="fancy_add-name">
					<label><?php if($this->lang->line('header_weblink') != '') { echo stripslashes($this->lang->line('header_weblink')); } else echo "Web Link"; ?></label>
					<input type="text" placeholder="http://" class="input-text" id="fancy_add-link">
					<label><?php if($this->lang->line('header_category') != '') { echo stripslashes($this->lang->line('header_category')); } else echo "Category"; ?></label>
						<select class="select-round selectBox categories_" id="fancy_add-category">
						<option value=""><?php if($this->lang->line('header_choose_categry') != '') { echo stripslashes($this->lang->line('header_choose_categry')); } else echo "Choose a category"; ?></option>
						<?php 
						if ($mainCategories->num_rows()>0){
							foreach ($mainCategories->result() as $mainCat){
						?>
						<option value="<?php echo $mainCat->id;?>"><?php echo $mainCat->cat_name;?></option>
						<?php 
							}
						}
						?>
						</select>
<!-- 					<label>Lists</label>
					<select class="select-round selectBox lists_" id="fancy_add-list_ids"><option value="">Add to Lists...</option><option value="35014649">Women's</option></select>
 -->				</div>
				<textarea placeholder="<?php if($this->lang->line('header_sam_somethng') != '') { echo stripslashes($this->lang->line('header_sam_somethng')); } else echo "Say something about this"; ?>" maxlength="200" id="fancy_add-note"></textarea>
			</dd>
		</dl>
		<div class="btns-area">
			<button class="btn-blue-embo-add"><span></span><?php if($this->lang->line('header_add_to') != '') { echo stripslashes($this->lang->line('header_add_to')); } else echo "Add to"; ?> <?php echo $siteTitle;?></button>
			<a class="cancel" href="#"><?php if($this->lang->line('signup_goback') != '') { echo stripslashes($this->lang->line('signup_goback')); } else echo "Go Back"; ?></a>
		</div>
	</div>
	<div class="step step4">
		<p class="ltit"><?php if($this->lang->line('referrals_email') != '') { echo stripslashes($this->lang->line('referrals_email')); } else echo "Email"; ?></p>
		<dl>
			<dt><?php if($this->lang->line('header_title') != '') { echo stripslashes($this->lang->line('header_title')); } else echo "Title"; ?></dt>
			<dd><input type="text" class="input-text" placeholder=<?php if($this->lang->line('header_title_image') != '') { echo stripslashes($this->lang->line('header_title_image')); } else echo "Enter a title for your image attached here"; ?>""></dd>
		</dl>
		<dl>
			<dt><?php if($this->lang->line('header_comment') != '') { echo stripslashes($this->lang->line('header_comment')); } else echo "Comment"; ?></dt>
			<dd><textarea placeholder="<?php if($this->lang->line('header_comnt_here') != '') { echo stripslashes($this->lang->line('header_comnt_here')); } else echo "Add a comment here"; ?>"></textarea></dd>
		</dl>
		<div class="btns-area">
			<button class="btn-blue-embo-add"><span></span><?php if($this->lang->line('header_send') != '') { echo stripslashes($this->lang->line('header_send')); } else echo "Send"; ?></button>
			<a class="cancel" href="#"><?php if($this->lang->line('signup_goback') != '') { echo stripslashes($this->lang->line('signup_goback')); } else echo "Go Back"; ?></a>
		</div>
	</div>
	<button title="Close" class="ly-close"><i class="ic-del-black"></i></button>
<iframe frameborder="0" name="iframe_img_upload"></iframe></div>



<!--share-->
<div uname="<?php if ($loginCheck != ''){echo $userDetails->row()->user_name;}?>" class="popup ly-title share-new" id="fancy-share" style="display:none;">
	<p class="ltit">
		<span class="share-thing"><?php if($this->lang->line('header_share_thing') != '') { echo stripslashes($this->lang->line('header_share_thing')); } else echo "Share This Thing"; ?></span>
		<span class="share-comment"><?php if($this->lang->line('header_share_comment') != '') { echo stripslashes($this->lang->line('header_share_comment')); } else echo "Share This Comment"; ?></span>
		<span class="share-list"><?php if($this->lang->line('header_share_list') != '') { echo stripslashes($this->lang->line('header_share_list')); } else echo "Share This List"; ?></span>
		<span class="share-gift"><?php if($this->lang->line('header_share_gift') != '') { echo stripslashes($this->lang->line('header_share_gift')); } else echo "Share This Gift Campaign"; ?></span>
		<span class="share-user"><?php if($this->lang->line('header_share') != '') { echo stripslashes($this->lang->line('header_share')); } else echo "Share"; ?> {{name}}'s <?php if($this->lang->line('header_profile') != '') { echo stripslashes($this->lang->line('header_profile')); } else echo "Profile"; ?></span>
	</p>
	<div class="fig">
		<span class="thum"><em class="shadow"></em><img src="images/site/blank.gif"></span>
		<div class="fig-info">
			<span class="figcaption"></span>
			<span class="username"><b></b>, <a href="#"></a></span>
			<h4></h4><p class="from"></p>
		</div>
		<div class="bio"></div>
		<p class="link"><span onclick="$(this).parents('.link').find('input').select()" class="icon ic-link"><em><?php if($this->lang->line('header_copy_clip') != '') { echo stripslashes($this->lang->line('header_copy_clip')); } else echo "Copy link to clipboard"; ?></em></span><input type="text" readonly="" class="text" id="share-link-input"></p>
	</div>
	 
	<div class="share-via">
		<ul class="less">
			
			<li><a target="_blank" class="fb" href="#"><span class="ic-fb"></span> <em><?php if($this->lang->line('header_share_on') != '') { echo stripslashes($this->lang->line('header_share_on')); } else echo "Share on "; ?>Facebook</em></a></li>
			<li><a target="_blank" class="tw" href="#"><span class="ic-tw"></span> <em><?php if($this->lang->line('header_share_on') != '') { echo stripslashes($this->lang->line('header_share_on')); } else echo "Share on "; ?>Twitter</em></a></li>
			<li><a target="_blank" class="gg" id="gplus-share" href="#"><span class="ic-gg"></span> <em><?php if($this->lang->line('header_share_on') != '') { echo stripslashes($this->lang->line('header_share_on')); } else echo "Share on "; ?>Google+</em></a></li>
			<li><a target="_blank" class="su" href="#"><span class="ic-su"></span> <em><?php if($this->lang->line('header_share_on') != '') { echo stripslashes($this->lang->line('header_share_on')); } else echo "Share on "; ?>StumbleUpon</em></a></li>
			<li><a target="_blank" class="li" href="#"><span class="ic-link"></span> <em><?php if($this->lang->line('header_share_on') != '') { echo stripslashes($this->lang->line('header_share_on')); } else echo "Share on "; ?>LinkedIn</em></a></li>
			<li><a target="_blank" class="tb" href="#"><span class="ic-tb"></span> <em><?php if($this->lang->line('header_share_on') != '') { echo stripslashes($this->lang->line('header_share_on')); } else echo "Share on "; ?>Tumblr</em></a></li>
			<li><a target="_blank" class="vk" href="#"><span class="ic-vk"></span> <em><?php if($this->lang->line('header_share_on') != '') { echo stripslashes($this->lang->line('header_share_on')); } else echo "Share on "; ?>BKohtakte</em></a></li>
			<li><a target="_blank" class="od" href="#"><span class="ic-od"></span> <em><?php if($this->lang->line('header_share_on') != '') { echo stripslashes($this->lang->line('header_share_on')); } else echo "Share on "; ?>OnHOKnaccHNKN</em></a></li>
			
			<li><a class="mx" href="#"><span class="ic-mx"></span> <em><?php if($this->lang->line('header_share_on') != '') { echo stripslashes($this->lang->line('header_share_on')); } else echo "Share on "; ?>mixi</em></a></li>
			<li><a target="_blank" class="qz" href="#"><span class="ic-qz"></span> <em><?php if($this->lang->line('header_share_on') != '') { echo stripslashes($this->lang->line('header_share_on')); } else echo "Share on "; ?>q-zone</em></a></li>
			<li><a target="_blank" class="wb" href="#"><span class="ic-wb"></span> <em><?php if($this->lang->line('header_share_on') != '') { echo stripslashes($this->lang->line('header_share_on')); } else echo "Share on "; ?>Weibo</em></a></li>
			<li><a class="mx" href="#"><span class="ic-re"></span> <em><?php if($this->lang->line('header_share_on') != '') { echo stripslashes($this->lang->line('header_share_on')); } else echo "Share on "; ?>Renren</em></a></li>
		</ul>
		<a class="show" href="#"><i class="arrow"></i></a> 
	</div>
	
	<ul class="tab">
		<li><a class="current" href="#.email"><?php if($this->lang->line('referrals_email') != '') { echo stripslashes($this->lang->line('referrals_email')); } else echo "Email"; ?> </a></li>
<!-- 		<li><a href="#.embed">Embed</a></li> -->
		<li><a href="#.anywhere"><?php echo ucfirst($siteTitle);?> <?php if($this->lang->line('header_anywhere') != '') { echo stripslashes($this->lang->line('header_anywhere')); } else echo "Anywhere"; ?></a></li>
	</ul>
	<div class="embed">
		<span class="embed-thum">
			<em class="photo"><i class="btn_fancy"></i></em>
			<em class="info_tit"></em>
			<em class="info_price"></em>
			<em class="info_by"></em>
		</span>
		<dl class="embed-size">
			<dt><?php if($this->lang->line('header_widget_size') != '') { echo stripslashes($this->lang->line('header_widget_size')); } else echo "Widget size"; ?></dt>
			<dd><label><?php if($this->lang->line('header_width') != '') { echo stripslashes($this->lang->line('header_width')); } else echo "Width"; ?>:</label> <input type="text" class="width_ text" value="640"> <?php if($this->lang->line('header_px') != '') { echo stripslashes($this->lang->line('header_px')); } else echo "px"; ?></dd>
			<dd><label><?php if($this->lang->line('header_heigth') != '') { echo stripslashes($this->lang->line('header_heigth')); } else echo "Height"; ?>:</label> <input type="text" readonly="" class="height_ text" value="640"> <?php if($this->lang->line('header_px') != '') { echo stripslashes($this->lang->line('header_px')); } else echo "px"; ?></dd>
		</dl>
		<dl>
			<dt><?php if($this->lang->line('header_contents') != '') { echo stripslashes($this->lang->line('header_contents')); } else echo "Contents"; ?></dt>
			<dd>
				<ul>
					<li><input type="checkbox" checked="" key="tt" id="embed-info_tit"> <label for="embed-info_tit"><?php if($this->lang->line('header_title') != '') { echo stripslashes($this->lang->line('header_title')); } else echo "Title"; ?></label></li>
					<li><input type="checkbox" checked="" key="pr" id="embed-info_price"> <label for="embed-info_price"><?php if($this->lang->line('giftcard_price') != '') { echo stripslashes($this->lang->line('giftcard_price')); } else echo "Price"; ?></label></li>
					<li><input type="checkbox" checked="" key="by" id="embed-info_by"> <label for="embed-info_by"><?php if($this->lang->line('signup_user_name') != '') { echo stripslashes($this->lang->line('signup_user_name')); } else echo "Username"; ?></label></li>
					<li><input type="checkbox" checked="" key="bt" id="embed-btn_fancy"> <label for="embed-btn_fancy"><?php echo ucfirst($siteTitle);?> <?php if($this->lang->line('header_it') != '') { echo stripslashes($this->lang->line('header_it')); } else echo "it"; ?></label></li>
				</ul>
			</dd>
		</dl>
		<textarea readonly="" class="text" id="share-embed-input"></textarea>
	</div>
	<div class="anywhere">
		<dl class="info">
			<dt><?php if($this->lang->line('settings_about') != '') { echo stripslashes($this->lang->line('settings_about')); } else echo "About"; ?> <?php echo ucfirst($siteTitle);?> <?php if($this->lang->line('header_anywhere') != '') { echo stripslashes($this->lang->line('header_anywhere')); } else echo "Anywhere"; ?></dt>
			<dd><?php echo ucfirst($siteTitle);?> <?php if($this->lang->line('header_anywhere_enable') != '') { echo stripslashes($this->lang->line('header_anywhere_enable')); } else echo "Anywhere enables your visitors to buy things on"; ?> <?php echo $siteTitle;?> <?php if($this->lang->line('header_direct_earn') != '') { echo stripslashes($this->lang->line('header_direct_earn')); } else echo "directly from your own blogs and websites. You will earn"; ?> <?php echo $siteTitle;?> <?php if($this->lang->line('header_crd_purch') != '') { echo stripslashes($this->lang->line('header_crd_purch')); } else echo "credits when they complete a purchase"; ?> </dd>
			<dd><textarea readonly="" class="text" id="share-anywhere"></textarea></dd>
		</dl>
	</div>
	<div class="email share-with-someone">
		<dl class="to">
			<dt><?php if($this->lang->line('onboarding_to') != '') { echo stripslashes($this->lang->line('onboarding_to')); } else echo "To"; ?></dt>
			<dd class="email-frm">
				
				<span tabindex="0" class="add">+ <?php if($this->lang->line('header_add_email') != '') { echo stripslashes($this->lang->line('header_add_email')); } else echo "Add email addresses or user names"; ?></span>
				<input type="text" class="text">
				<ul class="user-list"></ul>
			</dd>
		</dl>
		<dl>
			<dt><?php if($this->lang->line('header_addition_more') != '') { echo stripslashes($this->lang->line('header_addition_more')); } else echo "Additional note"; ?></dt>
			<dd><textarea class="text" placeholder="<?php if($this->lang->line('header_person_note') != '') { echo stripslashes($this->lang->line('header_person_note')); } else echo "Include a personal note"; ?>"></textarea></dd>
		</dl>
		<div class="btn-area">
			<button class="btns-blue-embo btn-send"><?php if($this->lang->line('header_send') != '') { echo stripslashes($this->lang->line('header_send')); } else echo "Send"; ?></button>
		</div>
	</div>
	<div class="btn-area">
		<button class="btn-share" type="button"><?php if($this->lang->line('header_share') != '') { echo stripslashes($this->lang->line('header_share')); } else echo "Share"; ?></button>
	</div>
	<button title="Close" class="ly-close" type="button"><i class="ic-del-black"></i></button>
</div>
<!--share-->


<div class="popup u_like animated" style="margin-top: 101px; margin-left: 414.5px; opacity: 1; display: none;">
    <h2><?php if($this->lang->line('header_love') != '') { echo stripslashes($this->lang->line('header_love')); } else echo "Love"; ?> <?php echo ucfirst($siteTitle);?>?</h2>
    <p><?php if($this->lang->line('header_tee_friend') != '') { echo stripslashes($this->lang->line('header_tee_friend')); } else echo "Tell your friends and receive"; ?> <?php echo ucfirst($siteTitle);?> <?php if($this->lang->line('header_credts') != '') { echo stripslashes($this->lang->line('header_credts')); } else echo "Credits"; ?>!</p>
    <img alt="" src="">
	<input type="hidden" id="message-to-post" value="http://<?php echo $siteTitle;?>.to/9tvzef" class="text">
    <p style="width:144px;" class="sns">
        <a class="btn-fb-love show-tooltip" href="#"><i class="ic-fb"></i> <span><?php if($this->lang->line('header_share_on') != '') { echo stripslashes($this->lang->line('header_share_on')); } else echo "Share on "; ?> Facebook</span></a>
        <a class="btn-tw-love btn-url-t show-tooltip" href="#"><i class="ic-tw"></i> <span><?php if($this->lang->line('header_share_on') != '') { echo stripslashes($this->lang->line('header_share_on')); } else echo "Share on "; ?> Twitter</span></a>
        <a class="btn-gg-love show-tooltip gplus-post" actionurl="http://<?php echo $siteTitle;?>.to/9tvzef?action=join" url="http://<?php echo $siteTitle;?>.to/9tvzef" actiondeeplink="join?action=join&amp;ref=sarvan16" contentdeeplink="join?ref=sarvan16" action="join_me" prefill="Join me on <?php echo $siteTitle;?> and discover amazing things!" id="google-invite-love" href="#" data-gapiattached="true"><i class="ic-gg"></i> <span><?php if($this->lang->line('header_share_on') != '') { echo stripslashes($this->lang->line('header_share_on')); } else echo "Share on "; ?> Google+</span></a>
        <a class="btn-vk-love post-love show-tooltip" data-url="http://vkontakte.ru/share.php?url=http://<?php echo $siteTitle;?>.to/9tvzef" href="#"><i class="ic-vk"></i> <span><?php if($this->lang->line('header_share_on') != '') { echo stripslashes($this->lang->line('header_share_on')); } else echo "Share on "; ?> BKohtakte</span></a>
        <a class="btn-re-love post-love show-tooltip" data-url="http://share.renren.com/share/buttonshare.do?link=http://<?php echo $siteTitle;?>.to/9tvzef" href="#"><i class="ic-re"></i> <span><?php if($this->lang->line('header_share_on') != '') { echo stripslashes($this->lang->line('header_share_on')); } else echo "Share on "; ?> Renren</span></a>
        <a class="btn-qz-love post-love show-tooltip" data-url="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=http://<?php echo $siteTitle;?>.to/9tvzef" href="#"><i class="ic-qz"></i> <span><?php if($this->lang->line('header_share_on') != '') { echo stripslashes($this->lang->line('header_share_on')); } else echo "Share on "; ?> Q-zone</span></a>
        <a class="btn-we-love post-love show-tooltip" data-url="http://service.weibo.com/share/share.php?url=http://<?php echo $siteTitle;?>.to/9tvzef&amp;appkey=&amp;title=Join me on <?php echo $siteTitle;?> and discover amazing things!;" href="#"><i class="ic-we"></i> <span><?php if($this->lang->line('header_share_on') != '') { echo stripslashes($this->lang->line('header_share_on')); } else echo "Share on "; ?> Weibo</span></a>
    </p>
    <a onclick="$(this).parents('.u_like').find('.sns').width(336).end().end().hide();$(this).parents('.u_like').find('.sns-less').show();" class="sns-more" href="#"><i></i></a>
    <a style="display:none;" onclick="$(this).parents('.u_like').find('.sns').width(144).end().end().hide();$(this).parents('.u_like').find('.sns-more').show();" class="sns-less" href="#"><i></i></a>
</div>


<div id="clone-list" class="popup clone-list">
	<div class="box-rnd-shadow-2 ly-title">
		<h3 class="ltit"><?php if($this->lang->line('header_clone_list') != '') { echo stripslashes($this->lang->line('header_clone_list')); } else echo "Clone List"; ?></h3>
		<p><?php if($this->lang->line('header_clone_this') != '') { echo stripslashes($this->lang->line('header_clone_this')); } else echo "Clone this list and all it's content to your own collection"; ?>.</p>
		<dl>
			<dt><?php if($this->lang->line('header_name') != '') { echo stripslashes($this->lang->line('header_name')); } else echo "Name"; ?></dt>
			<dd><input id="name-clone-list" placeholder="<?php if($this->lang->line('header_enter_name') != '') { echo stripslashes($this->lang->line('header_enter_name')); } else echo "Enter a name for this list"; ?>" type="text"></dd>
		</dl>
		<div class="btn-area">
			<button type="button" class="btn-clone" loid="3462155" lid="22675769"><?php if($this->lang->line('header_clone_list') != '') { echo stripslashes($this->lang->line('header_clone_list')); } else echo "Clone List"; ?></button>
		</div>
		<button type="button" class="ly-close" title="Close"><i class="ic-del-black"></i></button>
	</div>
</div>
<script>
window.fbAsyncInit = function() {
	FB.init({appId: '180603348626536', status: true,cookie: true, xfbml: true,oauth : true});
};

(function() {
	var e = document.createElement('script');
	e.type = 'text/javascript';
	e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
	e.async = true;
	var fbRoot = document.getElementById('fb-root');
	if (!fbRoot) {
		fbRoot = document.createElement('div');
		fbRoot.id = 'fb-root';
		document.body.appendChild(fbRoot);
	}
	fbRoot.appendChild(e);
}());

(function(){
	if(!window.jQuery) return setTimeout(arguments.callee, 10);

	jQuery(function($) {
		var tooltip = function(target) {
			var $target = $(target);
			if (!$('#wrapper-tooltip-love').length) {
				$('&lt;span&gt;').attr('id','wrapper-tooltip-love').appendTo(document.body);
			}
			var $tooltip = $('#wrapper-tooltip-love').show();

			$tooltip.text($target.text());
			var o = $target.offset();
			o.left = Math.round(o.left - ($tooltip.width() + 16 - $target.width()) / 2); //16:#wrapper-tooltip-love's padding
			o.top = Math.round(o.top - ($tooltip.height() + 9));
			$('#wrapper-tooltip-love').offset(o);
		};

		$('.show-tooltip')
			.mouseover(function(){ tooltip(this) })
			.mouseout(function(){ $('#wrapper-tooltip-love').hide(); });

		$('.post-love').on('click',function() {
			var url = $(this).data('url');
			var popup = window.open(null, '_blank', 'height=400,width=800,left=250,top=100,resizable=yes', true);
			popup.location.href = url;
		});

		$('.btn-fb-love').on('click',function() {
			var message = $('#message-to-post').val();
			var obj = {
				method: 'feed',
				link: $('#message-to-post').val(),
				name: $('#message-to-post').val(),
				caption: 'Join me on <?php echo $siteTitle;?> and discover amazing things!',
				description: 'Discover amazing things and unlock exclusive deals from great brands.'
			};

			function callback(response) {
			}

			FB.ui(obj, callback);
			return false;
		});

	});
})();
</script>

</div>
<!-- /popups -->