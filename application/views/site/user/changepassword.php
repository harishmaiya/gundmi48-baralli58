<?php $this->load->view('site/templates/header');?>
<link rel="stylesheet" media="all" type="text/css" href="css/site/<?php echo SITE_COMMON_DEFINE ?>setting.css">

<style type="text/css">
ol.stream {position: relative;}
ol.stream.use-css3 li.anim {transition:all .25s;-webkit-transition:all .25s;-moz-transition:all .25s;-ms-transition:all .25s;visibility:visible;opacity:1;}
ol.stream.use-css3 li {visibility:hidden;}
ol.stream.use-css3 li.anim.fadeout {opacity:0;}
ol.stream.use-css3.fadein li {opacity:0;}
ol.stream.use-css3.fadein li.anim.fadein {opacity:1;}
</style>
<!-- Section_start -->
<div class="lang-en no-subnav wider winOS">
<div id="container-wrapper">
	<div class="container set_area">
		
		<?php if($flash_data != '') { ?>
		<div class="errorContainer" id="<?php echo $flash_data_type;?>">
			<script>setTimeout("hideErrDiv('<?php echo $flash_data_type;?>')", 3000);</script>
			<p><span><?php echo $flash_data;?></span></p>
		</div>
		<?php } ?>

        <div id="content">
		<form onsubmit="return change_user_password();" method="post" action="<?php echo base_url().'site/user_settings/change_user_password'?>">
		<h2 class="ptit"><?php if($this->lang->line('change_password') != '') { echo stripslashes($this->lang->line('change_password')); } else echo "Change Password"; ?></h2>
		<div style="display:none" class="notification-bar"></div>
		<div class="section password">
			<fieldset class="frm">
				<label><?php if($this->lang->line('change_new_pwd') != '') { echo stripslashes($this->lang->line('change_new_pwd')); } else echo "New Password"; ?></label>
				<input type="password" name="pass" id="pass">
				<small class="comment"><?php if($this->lang->line('change_pwd_limt') != '') { echo stripslashes($this->lang->line('change_pwd_limt')); } else echo "New password, at least 6 characters."; ?></small>
				<label><?php if($this->lang->line('change_conf_pwd') != '') { echo stripslashes($this->lang->line('change_conf_pwd')); } else echo "Confirm Password"; ?></label>
				<input type="password" name="confirmpass" id="confirmpass">
				<small class="comment"><?php if($this->lang->line('change_ur_pwd') != '') { echo stripslashes($this->lang->line('change_ur_pwd')); } else echo "Confirm your new password."; ?></small>
			</fieldset>
		</div>
		<div class="btn-area">
			<button id="save_password" class="btn-save"><?php if($this->lang->line('change_password') != '') { echo stripslashes($this->lang->line('change_password')); } else echo "Change Password"; ?></button>
			<span style="display:none" class="checking"><i class="ic-loading"></i></span>
		</div>
		</form>
	</div>

		<div id="sidebar">
			<dl class="set_menu">
				<dt><?php if($this->lang->line('referrals_account') != '') { echo stripslashes($this->lang->line('referrals_account')); } else echo "ACCOUNT"; ?></dt>
				<dd><a href="settings"><i class="ic-user"></i> <?php if($this->lang->line('referrals_profile') != '') { echo stripslashes($this->lang->line('referrals_profile')); } else echo "Profile"; ?></a></dd>
	            <dd><a href="settings/preferences"><i class="ic-pre"></i> <?php if($this->lang->line('referrals_preference') != '') { echo stripslashes($this->lang->line('referrals_preference')); } else echo "Preferences"; ?></a></dd>
				<dd><a href="settings/password" class="current"><i class="ic-pw"></i> <?php if($this->lang->line('signup_password') != '') { echo stripslashes($this->lang->line('signup_password')); } else echo "Password"; ?></a></dd>
				<dd><a href="settings/notifications"><i class="ic-noti"></i> <?php if($this->lang->line('referrals_notification') != '') { echo stripslashes($this->lang->line('referrals_notification')); } else echo "Notifications"; ?></a></dd>
			</dl>
			<dl class="set_menu">
				<dt><?php if($this->lang->line('referrals_shop') != '') { echo stripslashes($this->lang->line('referrals_shop')); } else echo "SHOP"; ?></dt>
	            <dd><a href="purchases"><i class="ic-pur"></i> <?php if($this->lang->line('referrals_purchase') != '') { echo stripslashes($this->lang->line('referrals_purchase')); } else echo "Purchases"; ?></a></dd>
	            <?php if ($userDetails->row()->group == 'Seller'){?>
	            <dd><a href="orders"><i class="ic-group"></i> <?php if($this->lang->line('referrals_orders') != '') { echo stripslashes($this->lang->line('referrals_orders')); } else echo "Orders"; ?></a></dd>
	            <?php }?>
	            <?php if ($userDetails->row()->group == 'Seller'){?>
 	            <dd><a href="credits"><i class="ic-credit"></i> Earnings</a></dd>
 	            <?php }?>
	            <dd><a href="fancyybox/manage"><i class="ic-sub"></i> <?php if($this->lang->line('referrals_subscribe') != '') { echo stripslashes($this->lang->line('referrals_subscribe')); } else echo "Subscriptions"; ?></a></dd>
	            <dd><a href="settings/shipping"><i class="ic-ship"></i> <?php if($this->lang->line('referrals_shipping') != '') { echo stripslashes($this->lang->line('referrals_shipping')); } else echo "Shipping"; ?></a></dd>
	        </dl>
			<dl class="set_menu">
				<dt><?php if($this->lang->line('referrals_sharing') != '') { echo stripslashes($this->lang->line('referrals_sharing')); } else echo "SHARING"; ?></dt>
<!-- 	            <dd><a href="credits"><i class="ic-credit"></i> Credits</a></dd>
	  -->           <dd><a href="referrals/0"><i class="ic-refer"></i> <?php if($this->lang->line('referrals_common') != '') { echo stripslashes($this->lang->line('referrals_common')); } else echo "Referrals"; ?></a></dd>
<?php 
if ($this->config->item('giftcard_status') == 'Enable'){
?> 
				<dd><a href="settings/giftcards"><i class="ic-gift"></i> <?php if($this->lang->line('referrals_giftcard') != '') { echo stripslashes($this->lang->line('referrals_giftcard')); } else echo "Gift Card"; ?></a></dd>
				<?php }
				if ($userDetails->row()->group == 'Seller'){?>
	            <dd><a href="<?php echo base_url();?>site/feed/store/<?php echo $userDetails->row()->user_name;?>" target="_blank"><i class="ic-group"></i> <?php if($this->lang->line('referrals_feedurl') != '') { echo stripslashes($this->lang->line('referrals_feedurl')); } else echo "Store Feed URL"; ?></a></dd>
	            <?php }?>
	        </dl>
		</div>
		<?php $this->load->view('site/templates/side_footer_menu');?>

	</div>
	<!-- / container -->
</div>
</div>


<!-- Section_start -->




<script>
	jQuery(function($) {
		var $select = $('.gift-recommend select.select-round');
		$select.selectBox();
		$select.each(function(){
			var $this = $(this);
			if($this.css('display') != 'none') $this.css('visibility', 'visible');
		});
	});
</script>
<script>
    //emulate behavior of html5 textarea maxlength attribute.
    jQuery(function($) {
        $(document).ready(function() {
            var check_maxlength = function(e) {
                var max = parseInt($(this).attr('maxlength'));
                var len = $(this).val().length;
                if (len > max) {
                    $(this).val($(this).val().substr(0, max));
                }
                if (len >= max) {
                    return false;
                }
            }
            $('textarea[maxlength]').keypress(check_maxlength).change(check_maxlength);
            
            
        });
    });
</script>
<?php $this->load->view('site/templates/footer');?>
