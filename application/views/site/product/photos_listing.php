<?php
$this->load->view('site/templates/header');
$this->load->view('site/templates/listing_head_side');
?>

<script type="text/javascript">
function ImageAddClick(){
	var idval =$('#prdiii').val();
	$(".dragndrop1").colorbox({width:"1000px", height:"500px", href:baseURL+"site/product/dragimageuploadinsert/"+idval});
}
<?php if($this->session->userdata('sweet_alert') != '') { ?>
swal('oops', '<?php echo $this->session->userdata('sweet_alert');?>', 'error');
<?php $this->session->unset_userdata('sweet_alert'); } ?>
</script>
<script src="js/site/<?php echo SITE_COMMON_DEFINE ?>addProperty.js"></script>
<style>
body{
	font-family:arial;
}

#preview{
	color:#cc0000;
	font-size:12px
}

.imgList {
	max-height:150px;
	margin-left:5px;
	border:1px solid #dedede;
	padding:4px;	
	float:left;	
}

.widget_content li a.coverlopp {
    position: absolute;
    top: 0;
    background: #E93F90;
    color: #fff;
    float: left;
    width: auto;
    height: auto;
    left: 10px;
    padding: 2px 12px;
    font-size: 13px;
    right: auto;
    display: none;
}

.widget_content li a.coverlopp.active{ 
	display: block;
}

.widget_content li:hover a.coverlopp {
    display: block;
}

</style>


<!-- added 23/05/2014 -->
<script>
function EmptyChk() {
	
	if(document.getElementById('rental_image').value=="") {	
	sweetAlert("Oops...", "No Images Selected", "error");
	return false;
	}
}

</script>

 <script src="js/site/addProperty.js"></script>

<!-- image uploaded script -->
<!--<script src="js/site/jquery.min.js"></script> -->
<script src="js/site/jquery.wallform.js"></script>
<script>





function uploadImage()
{
	$("#imageform").ajaxForm({target: '#preview', 
		beforeSubmit:function(){
			$("#imageloadstatus").show();
			$("#imageloadbutton").hide();
		}, 
		success:function(){
			$("#imageloadstatus").hide();
			$("#imageloadbutton").show();
		}, 
		error:function(){ 
			$("#imageloadstatus").hide();
			$("#imageloadbutton").show();
		} 
	}).submit();
}

</script>






<!-- image uploaded script end -->

 




   
            <div class="right_side nsd">
            
            <div class="dashboard_price_main">
            
            <div class="lisdt-area" align="center" style="width:590px; border:dashed 2px #0099FF;">
              <img src="images/site/cam.png">
            <h3><?php if($this->lang->line('Addaphoto') != '') { echo stripslashes($this->lang->line('Addaphoto')); } else echo "Add a photo or two!"; ?> </h3>

              <span><?php if($this->lang->line('Orthree') != '') { echo stripslashes($this->lang->line('Orthree')); } else echo "Or three, or more! Guests love photos that highlight the features of your space."; ?></span>
                <form id="imageform" method="post" enctype="multipart/form-data" action='<?php echo base_url(); ?>site/product/ajaxImageUpload' style="clear:both">
					<span class="add-photos"><?php if($this->lang->line('AddPhotos') != '') { echo stripslashes($this->lang->line('AddPhotos')); } else echo "Add Photos"; ?></span>
					<div id='imageloadstatus' style='display:none'><img src="images/site/loader.gif" alt="Uploading...."/></div>
					<div id='imageloadbutton' style="color:red;">
					<input type="file" name="photos[]" id="photoimg" multiple="true" style="background-color:red;" onchange="uploadImage();" />
					<input type="hidden" id="prd_id" name="prd_id" value="<?php echo $this->uri->segment(2); ?>" />
					</div>
				</form>
				
				
				
				
				
				
            </div>
            
                <div class="widget_content">
                      <?php if (!empty($imgDetail)){ ?>
					  <ul>
					  <?php 
						$this->session->set_userdata(array('product_image_'.$imgDetail->row()->id => $imgDetail->row()->image));
						foreach ($imgDetail->result() as $img){ ?>
								<li>
                       <input type="hidden" name="imaged[]" value="<?php echo $img->product_image; ?>"/>
                     <div class="img-holds">  <img src="<?php if(strpos($img->product_image, 's3.amazonaws.com') > 1){ echo $img->product_image; }else {  if($img->product_image!= '' && file_exists('./server/php/rental/thumbnail/'.$img->product_image)){ echo base_url()."server/php/rental/thumbnail/".$img->product_image; } else {echo base_url()."server/php/rental/".$img->product_image;} } ?>"  height="80px" width="80px" /></div>
					  
                         <a class="p_del tipTop" href="javascript:void(0)" onClick="javascript:SiteDeleteProductImage(<?php echo $img->id; ?>,<?php echo $listDetail->row()->id; ?>);" title="Delete this image"></a>
						 <?php if($img->cover == 'Cover'){ ?>
					<a  href="<?php echo base_url() ?>site/product/coverphoto/<?php echo $img->id; ?>/<?php echo $this->uri->segment(2); ?>" class="coverlopp active">Cover</a>
					<?php }else{ ?>
					<a  href="<?php echo base_url() ?>site/product/coverphoto/<?php echo $img->id; ?>/<?php echo $this->uri->segment(2); ?>" class="coverlopp">Cover</a>
					<?php } ?>
						 <br />
						<!-- <input type="text" id="<?php echo $img->id; ?>" name="<?php echo $img->id; ?>" value="<?php echo $img->caption; ?>" onblur="SavePhotoCaption('<?php echo $img->id; ?>',this.value)" />-->
						<!--  <textarea class="phtdetl" id="<?php echo $img->id; ?>" name="<?php echo $img->id; ?>"  onblur="SavePhotoCaption('<?php echo $img->id; ?>',this.value);" ><?php echo $img->caption; ?></textarea>-->
						       </li>
                       
							<?php	}  ?>
							</ul>
							<?php } ?>
                  </div>
				  
				 
              
         </div>
		 <span class="onclk-text" style="border-left: 1px solid #dcdada !important;">Want to add Video URL?&nbsp;<span onclick="show_block_cate('1')">You can add.</span></span>
		 <div class="dashboard_price_main" id="monthly" style="display:none;border-left: 1px solid #dcdada !important;" >

			<div class="overview_title">
					
				<label>ENTER YOUTUBE EMBED VIDEO URL</label>
			
				<input type="text" id="video_url" value="<?php echo $listDetail->row()->video_url;?>" onkeyup="return checkyoutubeurl();" placeholder="Meta Title" class="title_overview" 
			   onchange="javascript:Detailview(this,<?php echo $listDetail->row()->id; ?>,'video_url');" name="video_url" style="color:#000 !important;" />
				<span style="color: red;float: left;font-size: smaller;margin:0 0 10px 0;">Note*:Only Embed Video Ex:(https://www.youtube.com/embed/I4545575)</span>
				<input type="hidden" id="id" name="id" value="<?php echo $listDetail->row()->id; ?>" />
				
	
			</div>
		</div>
        </div>
		<script type="text/javascript">
		function checkyoutubeurl(){
			var url=$('#video_url').val();
			var videourl = matchYoutubeUrl(url);
			if(videourl!=false){

			}else{
				$('#video_url').val('');
			}
		}
		function matchYoutubeUrl(url) {
			var p = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
			if(url.match(p)){
				return url.match(p)[1];
			}
			return false;
		}
		function SavePhotoCaption(id,caption){
			//alert();
			$.ajax({
				type:'POST',
				dataType:'json',
				url:'<?php echo base_url()?>site/product/SavePhotoCaption',
				data:{id:id,caption:caption},
				success:function(response){
					//alert(response);
				}
			});
		}
		function show_block_cate(columin_id){
			$(".onclk-text").css("display","none");
			$("#monthly").css("display","block");  
		}
		$(document).ready(function(){
			var video_url=$('#video_url').val();
			if(video_url==''){
				$(".onclk-text").css("display","block");
				$("#monthly").css("display","none");
			}
			else{
				$(".onclk-text").css("display","none");
				$("#monthly").css("display","block");
			}
		});
		</script>
<?php
$this->load->view('site/templates/footer');
?>