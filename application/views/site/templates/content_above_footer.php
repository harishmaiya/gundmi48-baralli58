<?php if($this->config->item('ios_link') != '' || $this->config->item('android_link')){?>
<section>
		
		<div class="bottom-phone-main">
		
		<div class="container">
		
			<div class="bottom-phone-bg"><img src="images/site/section-footer.jpg"></div>
			
			<div class="bottom-phone-content-main">
		
				<div class="bottom-phone-content">
				
					<h1><?php echo $this->config->item('email_title');?></h1>
					
					<h2>For your phone</h2>
					
					<ul>
						<?php if($this->config->item('ios_link') != ''){?>
						<li><a target="blank" href="<?php echo $this->config->item('ios_link');?>"><img src="images/site/apple.png"></a></li>
						<?php } if($this->config->item('android_link')){?>
						<li><a target="blank" href="<?php echo $this->config->item('android_link');?>"><img src="images/site/android.png"></a></li>
						<?php } ?>
					</ul>
				
				</div>
			
			</div>
			
		</div>
		
		</div>

</section>
<?php } ?>
<section>
	<div class="bottom-section">
<div class="container">
<div class="host-section">
<?php 
	
foreach($this->data['prefooter_results']->result() as $prefooter_result):?>
<a href="<?php echo $prefooter_result->footer_link;?>">
<div class="col-md-4">
<div class="host-area cenralize">

	<span class="host-container"><img src="images/prefooter/<?php echo $prefooter_result->image;?>"><span class="image-shadow"></span></span>

<span class="stat-text"><?php echo stripslashes($prefooter_result->footer_title);?></span>

<ul class="host-list">
<?php $short_descriptions=explode('//',$prefooter_result->short_description);
foreach($short_descriptions as $short_description):?>
<li><?php echo stripslashes($short_description);?></li>
<?php endforeach;?>
</ul>
<!--<a class="devlop-link" href="<?php echo $prefooter_result->footer_link;?>">
<?php echo $prefooter_result->footer_title;?> </a>-->
</div>	
</div>
</a>
<?php endforeach;?>
</div>
</div>
</div>
</section>