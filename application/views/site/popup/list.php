<?php if ($loginCheck != ''){
?>
<script type="text/javascript">
function CreateWishListCat(){
//alert('');
	$("#wishlist_warn").html("");
	var rental_id = $("#pid").val();
	//var user_id = $("#renter_id").val();
	var list_name= $("#list_name").val();
	$("#list_name").val("");
		if(list_name.trim()==""){
		$("#wishlist_warn").html("Please enter wishlist category.");
		return false;
		}else{
		$.ajax({
	        type: 'POST',
	        url: 'site/rentals/rentalwishlistcategoryAdd',
	        data: {"list_name":list_name,"rental_id":rental_id},
	        dataType: 'json',
	        success: function(json){
					if(json.result == '0'){
					 $('#WishListUl').prepend(json.wlist);
					}
					if(json.result == '1'){
						$("#wishlist_warn").html("This category already exists.");
					}
					return false;
			}
	    });
		}
		return false;

}
</script>
<!-- add_to_list overlay -->
<div class="popup ly-title update add-to-list animated newstaynest" id="inline_wishlist" >
<a class="close-btn" data-dismiss="modal" onclick="click_test()" id="pre-approve-close" style="cursor:pointer;"><span class="">x</span></a>
	<div class="default" style="display: block;">
		<p class="ltit"><?php if($this->lang->line('header_add_list') != '') { echo stripslashes($this->lang->line('header_add_list')); } else echo "Add to List"; ?><!--<a class="clos-ars" href="javascript:void(0);">x</a>--></p>
        <h3><?php echo $productList->row()->product_title; ?></h3>
	<form action="site/rentals/AddToWishList" onsubmit="return validateForm()" method="post" id="form" enctype="multipart/form-data">
	
		<div class="fancyd-item">
			<div class="image-wrapper">
				<div class="item-image"><img width="400" src="<?php echo base_URL().PRODUCTPATH.$productList->row()->product_image; ?>"></div>
			</div>
            
			<div class="item-categories">
			
			<div class="detaild-area"><span><?php echo $productList->row()->product_title; ?></span>
            <span><?php  echo $productList->row()->CityName.', '.$productList->row()->State_name.', '.$productList->row()->Country_name; ?></span>
		</div>
		
		<span class="wishgarea">0 Wish list</span>
				
                <input type="hidden" id="pid" name="pid" value="<?php echo $productList->row()->id; ?>" />
				<div class="ful-feld-areas">

				<fieldset class="list-categories">
					<div class="list-box">
					<ul id="WishListUl">
                    <?php 
					//echo '<pre>';print_r($WishListCat->result());die;
					if(count($WishListCat->result()) > 0){
						foreach($WishListCat->result() as $wishlist){ 
							$WishRentalsArr=explode(',',$wishlist->product_id);
						?>
	<li><label><input type="checkbox" name="wishlist_cat[]" id="wish_list" value="<?php echo $wishlist->id; ?>" <?php if(in_array($productList->row()->id,$WishRentalsArr)){ ?>checked="checked" <?php } ?> /><?php echo $wishlist->name; ?></label></li>
<?php } 
 } ?>

</ul></div></fieldset>
					<fieldset class="new-list">
						
						<input type="text" placeholder="<?php if($this->lang->line('header_create_nwlist') != '') { echo stripslashes($this->lang->line('header_create_nwlist')); } else echo "Create New List"; ?>" value="" name="list_name" id="list_name" >
                        <p id="wishlist_warn" style="color:#FF0000; background:#CCCCCC;"></p>
						<a class="btn-create" href="javascript:void(0);" onclick="return CreateWishListCat();" ><?php if($this->lang->line('header_create') != '') { echo stripslashes($this->lang->line('header_create')); } else echo "Create"; ?></a>
					</fieldset>
					
					
				
			</div>
			<div class="notes-area"><span class="add-text">Add Notes</span>
					<?php if(count($notesAdded->result()) == 0){?>
					<textarea name="add-notes" class="add-notes"></textarea>
					<input type="hidden" id="nid" name="nid" value="" />
					<?php }
					if(count($notesAdded->result()) == 1){?>
						<textarea name="add-notes" class="add-notes"><?php echo $notesAdded->row()->notes;?></textarea>
						<input type="hidden" id="nid" name="nid" value="<?php echo $notesAdded->row()->id;?>" />
					<?php }?> 
				   </div>
		</div></div>
		<div class="btn-area">
				<input class="btn-add-to-list btn-done" type="submit" name="submit" value="<?php if($this->lang->line('header_done') != '') { echo stripslashes($this->lang->line('header_done')); } else echo "Done"; ?>"/>
				
			</div>
			<span id="listspace_error" style="color:red"></span>
            </form>
	</div>
    </div>
	<script>
	function  validateForm(){
	//alert('');
	var checked=false;
	var elements = document.getElementsByName("wishlist_cat[]");
	for(var i=0; i < elements.length; i++){
		if(elements[i].checked) {
			checked = true;
		}
	}
	if (!checked) {
		sweetAlert("Oops...", "Enter the Wishlist Name", "error");
	}
	return checked;
	/* var list_name=$('#list_name').val();
	var wish_list=$('#wish_list').val();
	var wish_list1 = document.getElementById("wish_list").value;
	//alert(wish_list1);
	//$('#listspace_error').html('');
	if(list_name == '')
	{
	alert('Enter the Wishlist Name');
	return false;
	}
	else if(wish_list1 == ''){
	alert('Enter the Wishlist Name');
	} */
	}
	</script>
	<script>
// $("#list_name").on("input", function(){
//   var regexp = /[^A-Za-z]/g;
//   if($(this).val().match(regexp)){
//     $(this).val( $(this).val().replace(regexp,'') );
//   }
// });
	</script>
	
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script type="text/javascript">
$(function () {
	$('#list_name').keydown(function (e) {
		var charCode = e.which;

        if(charCode == 8 || charCode == 0 || charCode == 32 || charCode == 44 || charCode == 46 )
        {
             return;
        }
        else
        {
            var keyChar = String.fromCharCode(charCode); 
            return /[a-zA-Z]/.test(keyChar); 
        } 
	});
});
</script>
<script>
$(document).ready(function(){
  $(".wishgarea").click(function(){
    $(".ful-feld-areas").addClass("disply-imputant");
  });
});

function click_test(){

$('#cboxOverlay').click();
}
</script>


<?php }?>