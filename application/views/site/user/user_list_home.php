<?php 
$this->load->view('site/templates/header',$this->data);
?>

<script type="text/javascript">

function notes_reload(evt){

	var nid = $(evt).attr("nid");
	var notes = $(evt).val();
	$.ajax({
        type: 'POST',
        url: 'site/rentals/edit_notes',
        data: {"nid":nid,"notes":notes},
        dataType: 'json',
        success: function(json){
				if(json.result == '1'){
					//window.location.reload();
				}
				return false;
		}
    });
	
}
function Edit_WishListCat(){
	$("#wishlist_warn_cat").html("");
		var list_name= $("#wishlist_name").val();
	var list_id = $("#list_id").val();
	$("#list_name").val("");
	var select = $("#wish_select").val();
		if(list_name==""){
		$("#wishlist_warn_cat").html("Please enter wishlist category.");
		return false;
		}else{

			$.ajax({
		        type: 'POST',
		        url: 'site/rentals/rentalwishlistcategoryAdd',
		        data: {"list_name":list_name,"whocansee":select,"list_id":list_id},
		        dataType: 'json',
		        success: function(json){
						if(json.result == '5'){
							window.location.reload();
						}
						if(json.result == '1'){
							$("#wishlist_warn_cat").html("This category already exists.");
						}
						return false;
				}
		    });
		}
		return false;
}
</script>



<!-- <div class="top-listing-head">
 		<div class="main">   
            <ul id="nav">
                <li class="active"><a href="<?php echo base_url();?>dashboard">Dashboard</a></li>
                <li><a href="<?php echo base_url();?>inbox">Inbox</a></li>
                <li><a href="<?php echo base_url();?>listing/all">Your Listing</a></li>
                <li><a href="<?php echo base_url();?>trips/upcoming">Your Trips</a></li>
				<li><a href="<?php echo base_url();?>users/<?php echo $userDetails->row()->id; ?>/wishlists">Wishlists</a></li>
                <li><a href="<?php echo base_url();?>settings">Profile</a></li>
                <li><a href="<?php echo base_url();?>account">Account</a></li>
                <li><a href="<?php echo base_url();?>plan">Plan</a></li>
            </ul> </div></div>  -->

<div class="content">

  <div class="yourlisting bgcolor">
<div class="top-listing-head">
 <div class="main">   
            <ul id="nav">
                <li><a href="<?php echo base_url(); ?>popular" class="write_title">Popular</a></li>
          <?php if($loginCheck!=''){ ?>
          <!--<li><a href="<?php echo base_url(); ?>invite-friends" class="write_title">Friends</a></li>-->
          <li class="active"><a href="<?php echo base_url(); ?>users/<?php echo $loginCheck; ?>/wishlists" class="write_title">My Wish Lists</a></li>
          <?php } ?>
              <li></li>
            </ul> </div></div></div>


        <div class="wish-areas">
        <div class="container">

         <div class="wish-area-top"> 
            <div class="matte-media-box"><a href="users/show/<?php echo $userDetails->row()->id; ?>">
              <img width="70" height="70" alt="<?php echo ucfirst($userDetails->firstname); ?>" src="<?php if($userDetails->row()->image !=''){echo 'images/users/'.$userDetails->row()->image;}else{echo 'images/site/profile.png';} ?>">
            </a></div>
          
          <div class="wish-area-right"><h1 class="wist-tiles"><?php echo ucfirst($userDetails->row()->firstname); ?>'s Wish Lists <span style="font-size:20px;" class="item-count">(<?php echo $list_details->row()->name; ?>)</span></h1>
          <label class="mobile-stater"><span>Listings:</span>
<span id="tot_pro"><strong><?php echo $totalProducts; ?></strong></span>
<!--  <a class="edit-button"   href="user/<?php echo $loginCheck;?>/wishlists/<?php echo $list_details->row()->id;?>/edit">Edit</a>-->

<a data-toggle="modal" href="#myModal">Edit</a>


<a class="confirmation" href="site/user/DeleteallWishList/<?php echo $list_details->row()->id;?>">Delete</a>

<i class="icon icon-lock" title="Visible only to you and not shared anywhere." data-behavior="tooltip"></i></label>
           </div>  </div>
<?php //echo("<pre>");print_r($product_details->result());die;?>
    	<div class="wishlists_detail">
<?php if($totalProducts == '0'){?>
<div style="height:100px; width:600px; text-align:center;"><h1>Your's Wishlist is Empty</h1></div>
<?php }?>
<?php if($totalProducts > '0'){?>
<?php if($product_details->num_rows()>0){
?>

<ul class="container results-list unstyled">

<?php 
if ($product_details->num_rows()>0){

			foreach ($product_details->result() as $productRow){
			
			$imgArr = $productRow->product_image;
          		$img = 'dummyProductImage.jpg';
          		
          			if ($imgArr != ''){
						$img = $imgArr;
						
          			}
          	

 ?>
 <div><?php ?></div>
 <div class="wishlists-container">
<div class="show_view clearfix">

<li class="" id="wish_<?php echo $productRow->id; ?>">



  


 <?php  
 //echo("<pre>");print_r( $list_details);die;
 if (($wishlist_image[$productRow->id] != '' && $wishlist_image[$productRow->id]->num_rows()>0)){
         		
         		?>

<div id="transition-timer-carousel<?php echo $productRow->id; ?>" class="carousel slide transition-timer-carousel" data-ride="carousel">
  
 
      <!-- Wrapper for slides -->
      <ul class="carousel-inner">
      <?php 
      $count = 0;
      foreach( $wishlist_image[$productRow->id]->result() as $product_image)
      {
      	if ($product_image->product_image != ''){
      ?>
        <li class="item <?php if($count==0){?>active<?php }?>"><img src="<?php if($product_image->product_image == ''){ echo base_url(). PRODUCTPATH.'dummyProductImage.jpg'; } else { if(strpos($product_image->product_image, 's3.amazonaws.com') > 1){ echo $product_image->product_image; }else {  if($product_image->product_image!= '' && file_exists('./server/php/rental/thumbnail/'.$product_image->product_image)){ echo base_url()."server/php/rental/thumbnail/".$product_image->product_image; } else {echo base_url()."server/php/rental/".$product_image->product_image;} } } ?>" /></li>
       <?php $count++;} }?>
        
      </ul>
      
      <!-- Controls -->
      <a class="left carousel-control" href="#transition-timer-carousel<?php echo $productRow->id; ?>" data-slide="prev">
        <span class="glyphicon gldfgyphicon-chevron-left"></span>
      </a>

      <a class="right carousel-control" href="#transition-timer-carousel<?php echo $productRow->id; ?>" data-slide="next">
        <span class="glyphicon glyphicodfgn-chevron-right"></span>
      </a>

          <!-- Indicators -->
      <ol class="carousel-indicators">
       <?php 
      	$count = 0;
      foreach( $wishlist_image[$productRow->id]->result() as $product_image)
      {
      	if ($product_image->product_image != ''){
      ?>
        <li data-target="#transition-timer-carousel<?php echo $productRow->id; ?>" data-slide-to="<?php echo $count;?>" class="<?php if($count==0){?>active<?php }?>"></li>
        <?php 
        $count++;
      	}
      }
        ?>
      </ol>
    </div>
            
     
     <?php }?>


    <div class="wishlists_span7">
      <h2 class="weight-normal"><a href="rental/<?php echo $productRow->id; ?>"><?php echo $productRow->product_title; ?></h2>
      <span class="space1 name-area"><?php echo $productRow->address.','.$productRow->name.','.$productRow->post_code; ?></span>
      <ul class="unstyled inline spaced color-gray space1">
      <?php $listings = $productRow->listings;
			$listArray = json_decode($listings);//print_r($listArray);
      //echo'<pre>';print_r($listArray);exit;
			//echo $listArray->Bedrooms;
	  ?>
        <?php if($productRow->room_type!=''){?><li style="font-size: 14px;" >Room Type : <?php echo ucfirst($productRow->room_type);?></li><?php } ?>
        <!-- <li style="font-size: 14px;">Bed rooms <?php echo $listArray->Bedrooms;?></li> -->
       <?php if($listArray->Bathrooms !=''){?> <li style="font-size: 14px;">Bath Rooms : <?php echo $listArray->Bathrooms;?></li><?php } ?>
      </ul></a>

      <div class="text-areads">

        <img alt="<?php echo ucfirst($userDetails->firstname); ?>" src="<?php if($userDetails->row()->image !=''){echo 'images/users/'.$userDetails->row()->image;}else{echo 'images/site/profile.png';} ?>">
        
        <textarea class="adeds-note" id="adeds-note" onblur="return notes_reload(this);" nid="<?php echo $productRow->nid;?>"><?php echo $productRow->notes;?></textarea>

      </div>
	 
    
    </div>


    <div class="priced-rowd"> 
        <h3 ><?php echo $currencySymbol.''.CurrencyValue($productRow->id,$productRow->price);  ?></h3>
        <span class="color-gray font-tiny" >per night</span>
     

<div class="btn-group wish_list_button_container">
  <!--<a title="Save this listing to review later." data-img="https://a0.muscache.com/pictures/5918299/large.jpg" data-address="Wallace Garden 3rd St, Chennai, Tamil Nadu, India" data-name="Hanu Reddy Residences,WallaceGarden" data-hosting_id="496297" class="wish_list_button saved btn gray"><span class="icon icon-heart"></span>Change</a>-->
  
 
 <a class="ajax cboxElement gray newbts1" href="site/rentals/AddWishListForm/<?php echo $productRow->id;?>">Change</a>
 <a class="gray newbts2" onclick="return DeleteWishList('<?php echo $productRow->id; ?>','<?php echo $list_details->row()->id; ?>')"><span class="icon icon-remove"></span> Remove</a>
</div>
 </div>
</li>

<?php }}?>








<?php /*?><li class="" id="wish_<?php echo $productRow->id; ?>">



  




<div id="transition-timer-carousel" class="carousel slide transition-timer-carousel" data-ride="carousel">
  

      <!-- Wrapper for slides -->
      <ul class="carousel-inner">
         <li class="item active"><img src="images/wis4.png" /></li>
         <li class="item"><img src="images/wis6.png" /></li>
         <li class="item"><img src="images/wis5.png" /></li>
      </ul>

      <!-- Controls -->
      <a class="left carousel-control" href="#transition-timer-carousel" data-slide="prev">
        <span class="glyphicon gldfgyphicon-chevron-left"></span>
      </a>

      <a class="right carousel-control" href="#transition-timer-carousel" data-slide="next">
        <span class="glyphicon glyphicodfgn-chevron-right"></span>
      </a>

          <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#transition-timer-carousel" data-slide-to="0" class="active"></li>
        <li data-target="#transition-timer-carousel" data-slide-to="1"></li>
        <li data-target="#transition-timer-carousel" data-slide-to="2"></li>
      </ol>
    </div>
            
     
     


    <div class="wishlists_span7">
      <h2 class="weight-normal"><a href="rental/<?php echo $productRow->id; ?>"><?php echo $productRow->product_name; ?></h2>
      <span class="space1 name-area"><?php echo $productRow->address.','.$productRow->name.','.$productRow->post_code; ?></span>
      <ul class="unstyled inline spaced color-gray space1">
        <li style="font-size: 14px;" ><?php echo ucfirst($productRow->room_type);?></li>
        <li style="font-size: 14px;">Bed rooms <?php echo $productRow->bedrooms;?></li>
        <li style="font-size: 14px;">Bath Rooms <?php echo $productRow->bathrooms;?></li>
      </ul></a>

      <div class="text-areads">

        <img alt="<?php echo ucfirst($userDetails->firstname); ?>" src="<?php if($userDetails->row()->image !=''){echo 'images/users/'.$userDetails->row()->image;}else{echo 'images/site/profile.png';} ?>">
        <textarea class="adeds-note">Add Notes</textarea>

      </div>
   
    
    </div>


    <div class="priced-rowd"> 
        <h3 ><?php echo $currencySymbol.''.$productRow->price * $this->session->userdata('currency_r'); ?></h3>
        <span class="color-gray font-tiny" >per night</span>
     

<div class="btn-group wish_list_button_container">
  <!--<a title="Save this listing to review later." data-img="https://a0.muscache.com/pictures/5918299/large.jpg" data-address="Wallace Garden 3rd St, Chennai, Tamil Nadu, India" data-name="Hanu Reddy Residences,WallaceGarden" data-hosting_id="496297" class="wish_list_button saved btn gray"><span class="icon icon-heart"></span>Change</a>-->
 <a class="gray newbts1" onclick="return DeleteWishList('<?php echo $productRow->id; ?>','<?php echo $list_details->row()->id; ?>')">change</a> 
  <a class="gray newbts2" onclick="return DeleteWishList('<?php echo $productRow->id; ?>','<?php echo $list_details->row()->id; ?>')"><span class="icon icon-remove"></span> Remove</a>
</div>
 </div>
</li> */ ?>


<?php // }?>
</div></div>


</ul>

<?php } ?>
<?php } ?>
</div></div>


<div id="myModal" class="modal fade in wisthlistpopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">

<div class="modal-create modal-content">
<div class="panel-header">Edit Wish List</div>
<form>
<div class="panel-body">
<input type="hidden" value="10042418" name="user_id">
<label for="wishlist_name">Wish List Name</label>
<input  style="width: 90%;" id="wishlist_name" type="text" name="list_name" value="<?php echo $list_details->row()->name;?>">
<input type="hidden" id="list_id" value="<?php echo $list_details->row()->id;?>"/>
<label class="row-space-top-2">Who can see this?</label>
<div class="">
<div class="col-middle">
<div id="wishlist-edit-privacy-setting" class="select-block">
<select id="wish_select" name="wish_select" style="width: 90%;">
<option <?php if($list_details->row()->whocansee == 'Everyone'){?>selected="selected"<?php }?> value="0"> Everyone </option>
<option <?php if($list_details->row()->whocansee == 'Only me'){?>selected="selected"<?php }?> value="1"> Only Me </option>
</select>
</div>
<p id="wishlist_warn_cat" style="color:#FF0000; background:#CCCCCC; display:inline-block; width:100%; "></p>
</div>

</div>
</div>
<div class="panel-footer">
<button style=" padding: 11px 35px;" onclick="return Edit_WishListCat();" class="btn btn-primary save" type="submit">Save</button>
<button style="float: right; " class="cancel" data-dismiss="modal" type="button">Cancel</button>
</div>
</form>
</div>
</div>
</div>
</div>



</div>
<script type="text/javascript">
$('.confirmation').click(function(e) {
e.preventDefault(); // Prevent the href from redirecting directly
var linkURL = $(this).attr("href");
warnBeforeRedirect(linkURL);
});

 function warnBeforeRedirect(linkURL) {
    swal({
		title: "",
		text: "Are you sure want to delete?",
		type: "",
		showCancelButton: true,
		confirmButtonColor: "#009999",
		confirmButtonText: "Ok",
		cancelButtonText: "Cancel",
		closeOnConfirm: false,
		closeOnCancel: false
    }, function(response) {
	if(response==true){
	window.location.href = linkURL;
	swal("Deleted!", "Wishlist deleted", "success");
	}else{
	swal("Cancelled", "Wishlist cancelled", "error");
	//alert(response); return false;
      // Redirect the user
     } 
    });
  }
</script>


<style type="text/css">
        .transition-timer-carousel .carousel-caption {
    background: -moz-linear-gradient(top,  rgba(0,0,0,0) 0%, rgba(0,0,0,0.1) 4%, rgba(0,0,0,0.5) 32%, rgba(0,0,0,1) 100%); /* FF3.6+ */
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0)), color-stop(4%,rgba(0,0,0,0.1)), color-stop(32%,rgba(0,0,0,0.5)), color-stop(100%,rgba(0,0,0,1))); /* Chrome,Safari4+ */
    background: -webkit-linear-gradient(top,  rgba(0,0,0,0) 0%,rgba(0,0,0,0.1) 4%,rgba(0,0,0,0.5) 32%,rgba(0,0,0,1) 100%); /* Chrome10+,Safari5.1+ */
    background: -o-linear-gradient(top,  rgba(0,0,0,0) 0%,rgba(0,0,0,0.1) 4%,rgba(0,0,0,0.5) 32%,rgba(0,0,0,1) 100%); /* Opera 11.10+ */
    background: -ms-linear-gradient(top,  rgba(0,0,0,0) 0%,rgba(0,0,0,0.1) 4%,rgba(0,0,0,0.5) 32%,rgba(0,0,0,1) 100%); /* IE10+ */
    background: linear-gradient(to bottom,  rgba(0,0,0,0) 0%,rgba(0,0,0,0.1) 4%,rgba(0,0,0,0.5) 32%,rgba(0,0,0,1) 100%); /* W3C */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00000000', endColorstr='#000000',GradientType=0 ); /* IE6-9 */
  width: 100%;
  left: 0px;
  right: 0px;
  bottom: 0px;
  text-align: left;
  padding-top: 5px;
  padding-left: 15%;
  padding-right: 15%;
}
.transition-timer-carousel .carousel-caption .carousel-caption-header {
  margin-top: 10px;
  font-size: 24px;
}

@media (min-width: 970px) {
    /* Lower the font size of the carousel caption header so that our caption
    doesn't take up the full image/slide on smaller screens */
  .transition-timer-carousel .carousel-caption .carousel-caption-header {
    font-size: 36px;
  }
}
.transition-timer-carousel .carousel-indicators {
  bottom: 0px;
  margin-bottom: 5px;
  float: left;
  display: inline-block;
  text-align: center;
  width: 100%;
}
.transition-timer-carousel .carousel-control {
  z-index: 11;
}
.transition-timer-carousel .transition-timer-carousel-progress-bar {
    height: 5px;
    background-color: #5cb85c;
    width: 0%;
    margin: -5px 0px 0px 0px;
    border: none;
    z-index: 11;
    position: relative;
}
.transition-timer-carousel .transition-timer-carousel-progress-bar.animate{
    /* We make the transition time shorter to avoid the slide transitioning
    before the timer bar is "full" - change the 4.25s here to fit your
    carousel's transition time */
    -webkit-transition: width 4.25s linear;
  -moz-transition: width 4.25s linear;
  -o-transition: width 4.25s linear;
  transition: width 4.25s linear;
}

.transition-timer-carousel{
    float: left;
    margin: 0 20px 0 0;
    width: 20%;
}
.show_view .carousel-indicators li.active{
    background: none repeat scroll 0 0 #2c2d2f;}
.show_view .carousel-indicators li{

    background: #CACCCD;
    display: inline-block;
    float: none;
    height: 10px;
    margin: 0;
    width: 10px;
}

.carousel-indicators{position: unset}

.wishlists_span7{
    float: left;
    width: 51%;
}

.priced-rowd{float: left; width: 23%}
.show_view li{float: left; width: 100%}
.name-area{float: left; width: 100%; font-size: 24px;    color: #ff5a5f;}
.spaced {float: left; width: 100%}

.spaced li{float: left; padding: 0 10px; width: auto;  color: #82888a;
    font-family: Circular,"Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 13px;
    line-height: 1.43;
}

.btn-group.wish_list_button_container{float: left; width: 100%;padding: 30px 0 0;}

.carousel-control.left{left: 0}
.carousel-control.right{right: 0}

.carousel-indicators li{
    background: none repeat scroll 0 0 #2c2d2f;
    display: inline-block;
    float: none;
    height: 10px;
    width: 10px;
}

.show_view li#wish_8{
    border-bottom: 1px solid #dedede;
    padding: 30px 0;
}

.show_view li#wish_8:first-child{
;
    padding: 0 0 30px 0;
}


.show_view li#wish_8:last-child{
    border-bottom: none;

}
    </style>
<?php 
$this->load->view('site/templates/footer',$this->data);
?>
