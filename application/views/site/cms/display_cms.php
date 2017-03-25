<?php
$this->load->view('site/templates/header');
?>

<div class="lang-en wider no-subnav thing signed-out winOS" style="min-height:350px;">
 <div id="container-wrapper">
	<div class="container ">
		<section>
	<div class="main3">
		<div class="middle_section" id="content_text">
			<h1><?php echo $pageDetails->row()->page_name; ?></h1>
			<p><?php if ($pageDetails->num_rows()>0){ echo preg_replace('/\s+/', ' ', trim(stripcslashes($pageDetails->row()->description))); }?></p>
	    </div>	
    </div>
</section>
	</div>
	<!-- / container -->
</div>

</div> 

<?php
$this->load->view('site/templates/footer');
?>


