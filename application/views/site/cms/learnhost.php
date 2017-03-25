<?php $this->load->view('site/templates/header'); ?>
<section>
  <div class="learn-more-about-hosting-page">
  <div class="container">


    	  <div class="col-sm-12">
    	  
    	  	<div class="how-it-box">
    	  	
    	  		<div class="how-top-box">
    	  	
    	  		<h2>Start earning money today</h2>
    	  		  <ul class="nav">
    	  		 
    	  		<button onclick="window.location.href='list_space'" class="text-submit-btn" >List Your Space</button>
    	  		
    	  		</div>
    	  		
    	  		<div class="advantages">
    	  		
    	  			<?php echo stripslashes($cmslearnmore->row()->description);?>
    	  			
    	  		
    	  		
    	  		</div>

          </div>
  

         <div class="col-sm-12">
      
      			<div class="how-links">Any questions about being a guest, check out our <a href="pages/faq">FAQs</a> or <a href="contact-us">drop us a line</a></div>
      
 
  		 </div>


</section>

<script>
function change_next(evt){
	$(evt).parent().prev().find('li.active').next().find('a').trigger('click');

}
function change_previous(evt)
{
	$(evt).parent().prev().find('li.active').prev().find('a').trigger('click');
}
</script>


<?php $this->load->view('site/templates/footer');?>