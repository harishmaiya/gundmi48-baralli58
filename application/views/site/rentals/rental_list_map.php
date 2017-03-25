<script type="text/javascript">
function downloadUrl() {  
    var totalResults= '<?php echo count($productList->result()); ?>';
    if(totalResults > 0) {
    $("#side_bar").html("<img id='validationEr1r' align='middle' style='margin-left:200px; margin-top:20px;' src='images/ajax-loader.gif' />");
    <?php 
    if(count($productList->result()) > 0){$hoverlist='1';
      foreach($productList->result() as $Row_Rental){
        
        if($Row_Rental->userid !='' && $Row_Rental->userid !='0' ){
          $useId=base_url().'users/show/'.$Row_Rental->userid;
        }else{
          $useId='javascript:void(0);';
        }
        
        if($Row_Rental->userphoto!='' && $Row_Rental->userphoto!='0' ){
		  if(strpos($Row_Rental->userphoto, 'googleusercontent') > 1)
		  $useImg=$Row_Rental->userphoto;
		  else 
          $useImg=base_url().'images/users/'.$Row_Rental->userphoto;
        }else{
          $useImg=base_url().'images/site/profile.png';
        }
      
      ?>
	
      var lat ='<?php echo $Row_Rental->latitude; ?>'; 
      var lng ='<?php echo $Row_Rental->longitude; ?>';
         
      var point = new google.maps.LatLng(lat,lng);
	  
	  <?php 
	  $simg = PRODUCTPATH.'dummyProductImage.jpg';

	  if($Row_Rental->product_image!= '' && file_exists('./server/php/rental/thumbnail/'.$Row_Rental->product_image)){ 
	  $simg = PRODUCTPATH.'thumbnail/'.$Row_Rental->product_image;
	  }
	  else if($Row_Rental->product_image!= '' && file_exists('./server/php/rental/'.$Row_Rental->product_image)){ 
	  $simg = PRODUCTPATH.$Row_Rental->product_image;	  
	  }
	  else if($Row_Rental->product_image!= '' && strpos($Row_Rental->product_image, 's3.amazonaws.com') > 1)$simg=$Row_Rental->product_image;?>
         
      var html = '<div class="infoBox similar-listing" ><li><div class="img-top"><div class="figures-cobnt"><img src="<?php echo $simg; ?>"></div><div class="posi-abs"><a class=" ajax cboxElement heart" href="site/rentals/AddWishListForm/<?php echo $Row_Rental->id; ?>" target="_blank"></a><label class="pric-tag"><span class="rm-rate"><?php echo $currencySymbol; ?></span><?php echo CurrencyValue($Row_Rental->id,$Row_Rental->price); ?></label><a class="aurtors" href="<?php echo $useId; ?>"><img style="border-radius: 50%;height: 70px;width: 100px;" src="<?php echo $useImg; ?>"></a></div></div><div class="img-bottom"><span class="headlined"><a  href="rental/<?php echo $Row_Rental->id; ?>"><?php echo addslashes($Row_Rental->product_title); ?></a></span><p class="describ"><?php if($Row_Rental->room_type > 0 ){
     $condition=array('id'=>$Row_Rental->room_type);
	  $listspace_values = $this->product_model->get_all_details(LISTSPACE_VALUES, $condition);
	  echo ucfirst($listspace_values->row()->list_value);
	  } else { 
	 echo ucfirst($Row_Rental->room_type); 
	 } ?>- <?php echo addslashes(ucfirst($Row_Rental->city_name)); ?></p></div></li></div>';
    
    var details='<li data-price="<?php echo CurrencyValue($Row_Rental->id,$Row_Rental->price); ?>"><div class="img-top">';
	<?php if($loginCheck==''){?>
	var details1='<a class="ajax cboxElement heart reg-popup1" href="site/rentals/AddWishListForm/<?php echo $Row_Rental->id;?>"></a>';
	<?php }else{ ?>
	var details1='<a class="ajax cboxElement <?php if(in_array($Row_Rental->id,$newArr))echo 'heart-exist'; else echo 'heart';?>" href="site/rentals/AddWishListForm/<?php echo $Row_Rental->id;?>"></a>';
	<?php } ?>
	
	var details2='<div class="figures-cobnt"><a href="rental/<?php echo $Row_Rental->id;?>" target="_blank"><img src="<?php echo $simg; ?>"></a></div><div class="posi-abs"><label class="pric-tag"><span class="curSymbol"><?php echo $currencySymbol; ?></span><?php echo CurrencyValue($Row_Rental->id,$Row_Rental->price); ?></label><a class="aurtors" href="<?php echo $useId; ?>"><img style="border-radius: 50%;height: 70px;width: 100px;" src="<?php echo $useImg; ?>"></a></div></div><div class="img-bottom"><span class="headlined"><a  href="rental/<?php echo $Row_Rental->id; ?>"><?php echo addslashes($Row_Rental->product_title); ?></a></span><p class="describ"><?php if($Row_Rental->room_type > 0 ){
     $condition=array('id'=>$Row_Rental->room_type);
	  $listspace_values = $this->product_model->get_all_details(LISTSPACE_VALUES, $condition);
	  echo ucfirst($listspace_values->row()->list_value);
	  } else { 
	 echo ucfirst($Row_Rental->room_type); 
	 } ?>- <?php echo addslashes(ucfirst($Row_Rental->city_name)); ?></p></div></li>';
    
      var label ='<?php echo trim(addslashes($Row_Rental->product_title));?>';
          // create the marker
          var marker = createMarker(point,label,html,"blue",details+details1+details2,'<?php echo $Row_Rental->id; ?>');
      <?php $hoverlist=$hoverlist+1;}
    } ?>
        
        // put the assembled side_bar_html contents into the side_bar div
        side_bar_html='<div class="map-areas"><ul class="similar-listing">'+side_bar_html;
        side_bar_html=side_bar_html+'</ul></div>';
		$("#side_bar").html(side_bar_html);
		side_bar_html = "";
    
    }else{
    $("#side_bar").html("No rentals found..");
    }
	
	$("#footer_pagination").html('<?php echo $newpaginationLink;?>');
}

 
</script>