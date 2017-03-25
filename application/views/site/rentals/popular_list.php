<?php 
$this->load->view('site/templates/header');
?>
<div class="yourlisting bgcolor">
	<div class="top-listing-head">
		<div class="main">   
			<ul id="nav">
				<li class="active"><a href="<?php echo base_url(); ?>popular" class="write_title"><?php if($this->lang->line('popular') != '') { echo stripslashes($this->lang->line('popular')); } else echo "Popular"; ?></a></li>
				<?php if($loginCheck!=''){ ?>
				<!--<li><a href="<?php echo base_url(); ?>browsefriends" class="write_title"><?php if($this->lang->line('Friends') != '') { echo stripslashes($this->lang->line('Friends')); } else echo "Friends"; ?></a></li>-->
				<li><a href="<?php echo base_url(); ?>users/<?php echo $loginCheck; ?>/wishlists" class="write_title"><?php if($this->lang->line('MyWishLists') != '') { echo stripslashes($this->lang->line('MyWishLists')); } else echo "My Wish Lists"; ?></a></li>
				<?php } ?>
				<li></li>
			</ul>
		</div>
	</div>
</div>
<div class="body_content">
	<div class="container">
		<div>
				<ul class="popular-listing">
				<?php  $count=0;
				if($product->num_rows()>0)
				{
				foreach($product->result_array() as $product_image )
				{ $count++;
				if(($count%5)==0)
				{ 
				$li_class_name='big-poplr';
				}else {
				$li_class_name='';
				}
				?>
				<li class="<?php echo $li_class_name; ?>">
					<div class="img-top">
						<div class="figures-cobnt">
							<?php   if(($product_image['product_image']!='') &&(file_exists('./server/php/rental/resize/'.$product_image['product_image'])))
							{?>
							<a href="<?php echo base_url();?>rental/<?php echo $product_image['id']; ?>">
							<img src="<?php echo base_url();?>server/php/rental/resize/<?php echo $product_image['product_image'];?>">
							</a>
							<?php } else if(($product_image['product_image']!='') &&(file_exists('./server/php/rental/'.$product_image['product_image']))){
							?>
							<a href="<?php echo base_url();?>rental/<?php echo $product_image['id']; ?>">
							<img src="<?php echo base_url();?>server/php/rental/<?php echo $product_image['product_image'];?>">
							<?php }else{ ?> 
							<a href="<?php echo base_url();?>rental/<?php echo $product_image['id']; ?>">
							<img src="<?php echo  base_url();?>server/php/rental/dummyProductImage.jpg">
							</a>
							<?php }?>
						</div>
						<div class="posi-abs">
							<?php if($loginCheck==''){?>
							<a class="ajax cboxElement heart reg-popup" href="site/rentals/AddWishListForm/<?php echo $product_image['id'];?>"></a>
							<?php } else { ?>
							<a class="ajax cboxElement <?php if(in_array($product_image['id'],$newArr))echo 'heart-exist'; else echo 'heart';?>" href="site/rentals/AddWishListForm/<?php echo $product_image['id'];?>"></a>
							<?php }?>
							<label class="pric-tag"><?php echo $this->session->userdata('currency_s').' '. CurrencyValue($product_image['id'],$product_image['price']);?></label>
							<a class="aurtors num2" href="<?php echo base_url();?>users/show/<?php echo $product_image['user_id'];?>">
							<img src="<?php if(strpos($product_image['user_image'], 'googleusercontent') > 1) { echo $product_image['user_image'];} else if($product_image['user_image']!=''){ echo base_url().'images/users/'.$product_image['user_image'];} else{ echo base_url().'images/user_unknown.jpg';}?>" style="border-radius: 50%;">
							</a>
						</div>
					</div>
					<div class="img-bottom">
						<span class="headlined23"><?php  echo $product_image['product_title'];?></span>
						<p class="describ"><?php  echo $product_image['city'];?></p>
					</div>
				</li>
				<?php } } ?>
			</ul>
			<div id="infscr-loading" style="display: none;">
				<span class="loading">Loading...</span>
			</div>
			<div class="pagination" style="display: block" id="sample">
				<?php echo $paginationDisplay; ?>
			</div>
		</div>
	</div>
</div>

<script>
var $win     = $(window);
var loading=false;
$(window).scroll(function()  
//function xx(evt)
{ 
if(($(window).scrollTop() + $(window).height()) > ($(document).height()-500)) //user scrolled to bottom of the page?
{

var surl= $('.btn-more').attr('href');
if(!surl) surl='';
if(surl != '' && loading==false) //there's more data to load
{

loading = true; //prevent further ajax loading
//$('#infscr-loading').show(); 
$.ajax({
type : 'get',
url : surl,

dataType : 'html',
success : function(response)
{

var responce_html=$(response);
var res_val=responce_html.find('ul.popular-listing li');
$('ul.popular-listing').append(res_val);
$('.pagination a').remove();
var respo_val=responce_html.find('a.btn-more');
$('.pagination').append(respo_val);
$('#infscr-loading').hide(); //hide loading image once data is received

loading = false; 
after_ajax_load();

}
});return false;
}}});
</script> 
<?php
$this->load->view('site/templates/footer');
?> 