<!---FOOTER-->
<footer>
<div class="footer-bg">
	<div class="container">
		<div class="container1">
			<div class="col-md-4 inputfoot">
				<div class="country-lop">
					<script>
					function changeLanguage(e){
						var strUser = e.options[e.selectedIndex].value;
						window.location.href = strUser;
					}
					</script>

					<select onChange="changeLanguage(this);">
						<?php 
						$selectedLangCode = $this->session->userdata('language_code');
						if ($selectedLangCode == ''){
							$selectedLangCode = $defaultLg[0]['lang_code'];
						}
						if (count($activeLgs)>0){
							foreach ($activeLgs as $activeLgsRow){?>							
								<option value="<?php echo base_url();?>lang/<?php echo $activeLgsRow['lang_code'];?>" <?php if ($selectedLangCode == $activeLgsRow['lang_code']){echo 'selected="selected"';}?>><?php echo $activeLgsRow['name'];?></option>
						<?php } } ?>
					</select>

				</div>
				<div class="country-lop">
					<script>
					function changeCurrency(e)
					{
					var strUser = e.options[e.selectedIndex].value;
					window.location.href = strUser;
					}
					</script>
					<select onChange="changeCurrency(this);">
						<?php 
						if($currency_setup->num_rows() >0){ 
							foreach($currency_setup->result() as $currency_s){
							if($currency_s->currency_type==$this->session->userdata('currency_type')){
								$SelecTed='selected="selected"';
							}else{
								$SelecTed='';
							}?>							
								<option value="<?php echo base_url(); ?>change-currency/<?php echo $currency_s->id; ?>" <?php echo $SelecTed; ?>><?php echo $currency_s->currency_type; ?></option>
							<?php } 
						} ?>
					</select>
				</div>
			</div>
			<div class="col-md-4">
				<ul class="footer-list">
				<li><span><?php if($this->lang->line('Company') != '') { echo stripslashes($this->lang->line('Company')); } else echo "Company"; ?></span></li>
				<?php 
				if ($cmsList->num_rows() > 0){
					foreach ($cmsList->result() as $row){ ?>
						<li><a href="pages/<?php echo $row->seourl; ?>"><?php echo $row->page_name;?></a></li> 
					<?php } 
				} ?>
				</ul>
			</div>

			<div class="col-md-4">
				<ul class="footer-list">
					<a href="<?php echo base_url();?>"><img src="images/logo/<?php echo $this->config->item('logo_image');?>" alt=""></a>
				</ul>
			</div>
		</div>

		<div class="copy-txt col-md-12 footer-bottom">
			<span><?php if($this->lang->line('JoinUsOn') != '') { echo stripslashes($this->lang->line('JoinUsOn')); } else echo "Join Us On"; ?></span>
			<ul class="footer-list">
				<li></li>
				<?php if($this->config->item('facebook_link') != ''){ ?>
				<li><a target="_blank" href="<?php echo $this->config->item('facebook_link');?>" alt="<?php if($this->lang->line('signup_facebook') != '') { echo stripslashes($this->lang->line('signup_facebook')); } else echo "Facebook";?>"><i class="icon footer-icon icon-facebook"></i></a></li>
				<?php } if($this->config->item('twitter_link') != ''){ ?>
				<li><a target="_blank" href="<?php echo $this->config->item('twitter_link');?>" alt="<?php if($this->lang->line('signup_twitter') != '') { echo stripslashes($this->lang->line('signup_twitter')); } else echo "Twitter";?>"><i class="icon footer-icon icon-twitter"></i></a></li><?php } if($this->config->item('googleplus_link') != ''){?>
				<li><a target="_blank" href="<?php echo $this->config->item('googleplus_link');?>" alt="<?php if($this->lang->line('signup_google') != '') { echo stripslashes($this->lang->line('signup_google')); } else echo "Google+";?>"><i class="icon footer-icon icon-google-plus"></i></a></li><?php }if($this->config->item('youtube_link') != ''){?>
				<li><a target="_blank" href="<?php echo $this->config->item('youtube_link');?>" alt="<?php if($this->lang->line('signup_youtube') != '') { echo stripslashes($this->lang->line('signup_youtube')); } else echo "Youtube";?>"><i class="fa fa-youtube-play"></i></a></li>
				<?php }if($this->config->item('pinterest') != ''){ ?>
				<li><a target="_blank" href="<?php echo $this->config->item('pinterest');?>" alt="<?php if($this->lang->line('pinterest') != '') { echo stripslashes($this->lang->line('pinterest')); } else echo "Pinterest";?>"><i class="icon footer-icon icon-pinterest"></i></a></li>
				<?php } ?>
			</ul>
			<!--<p><?php echo stripslashes($this->config->item('footer_content'));?></p>-->
			<p><?php if($this->lang->line('copy_right')!=''){ echo stripslashes($this->lang->line('copy_right')); }else echo 'Copyright 2016. Renters. All rights reserved';?></p>
		</div>
	</div>
</div>
<link rel="stylesheet" media="all" href="css/site/style-responsive.css" type="text/css" />
<link rel="stylesheet" media="all" href="css/site/style-responsive-only.css" type="text/css" />
</footer>
<!---FOOTER-->
<script type="text/javascript">
$('.country-lop').click(function(){
	if($(this).find('.dropdn').css('display')=='none'){
		$(this).find('.dropdn').css('display','block');
		$(this).next().find('.dropdn').css('display','none');
		$(this).prev().find('.dropdn').css('display','none');
	}else{
		$('.dropdn').css('display','none');
	}
});
$(function(){
	$('.dropdn').each(function(){
		var selected_language=$(this).find('.active').text();
		if(selected_language !=''){
			$(this).prev('input').val(selected_language);
		}
	});
});

$(function(){
	$(window).scroll(function(){
		if($(window).scrollTop()==0){
			$('.header').css('padding','27px 0 20px');
		} else {
			$('.header').css('padding','7px 0 0px');
		}
	});
});

</script>
<?php if($this->config->item('google_verification_code')){ echo stripslashes($this->config->item('google_verification_code')); } ?>
</body>
</html>