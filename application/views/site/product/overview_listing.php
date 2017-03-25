<?php
$this->load->view('site/templates/header');
$this->load->view('site/templates/listing_head_side');
?>
<script src="js/site/<?php echo SITE_COMMON_DEFINE ?>addProperty.js"></script>
<script>
	function overview(){
		document.getElementById("overviewlist").submit();
	}
	function disbleEnterKey(){    
		if (event.keyCode == 13){        
			event.cancelBubble = true;
			event.returnValue = false;
		}
	} 
	
	var keyCount = 0;
    $(function () {
        $("#product_title, #description").keypress(function (e) {
			var string = $(this).val();
			var stringArr = string.split(" ");
			var len = stringArr.length;
			var lastString = stringArr[len-1];
			var len = lastString.length;
            if (keyCount > 1){
				e.preventDefault();
				swal("Oops", "Long press not allowed...!", 'error');
			}
			if(len > 15) {
                e.preventDefault();
				swal("Oops", "Word length exceeded...!", 'error');
            }
            keyCount++;
        });

        $("#product_title, #description").keyup(function () {
            keyCount = 0;
        });
    });
</script>



            <div class="right_side overview">
            
            <div class="dashboard_price_main" style="border-bottom:none;">
            
            	<div class="dashboard_price">
            
                    <div class="dashboard_price_left">
                    
                    	<h3><?php if($this->lang->line('Overview') != '') { echo stripslashes($this->lang->line('Overview')); } else echo "Overview";?></h3>
                        
                        <p><?php if($this->lang->line('Atitleandsummary') != '') { echo stripslashes($this->lang->line('Atitleandsummary')); } else echo "A title and summary displayed on your public listing page.";?> </p>
                    
                    </div>
                   <form id="overviewlist" name="overviewlist" action="site/product/saveOverviewList" method="post">
                    <div class="dashboard_price_right">
                    
                    	<div class="overview_title">
                        
                        	<label><?php if($this->lang->line('Title') != '') { echo stripslashes($this->lang->line('Title')); } else echo "Title";?></label>
                        
                        	<input type="text" value="<?php echo $listDetail->row()->product_title;?>" placeholder="<?php if($this->lang->line('Title') != '') { echo stripslashes($this->lang->line('Title')); } else echo "Title";?>" class="title_overview" 
                            onchange="javascript:ChangeOVerview(this,<?php echo $listDetail->row()->id; ?>);" name="product_title" style="color:#000 !important;" id="product_title"  onkeydown="disbleEnterKey();"/>
                            
                            <input type="hidden" id="id" name="id" value="<?php echo $listDetail->row()->id; ?>" />
                            
                            <!--<span>35 characters left</span>-->
                        
                        </div>
                        
                        
                        <div class="overview_title">
                        
                        	<label><?php if($this->lang->line('Summary') != '') { echo stripslashes($this->lang->line('Summary')); } else echo "Summary";?> <small> <?php if($this->lang->line('Maximum150words') != '') { echo stripslashes($this->lang->line('Maximum150words')); } else echo "Maximum 150 words";?></small></label>
                            
                            <textarea class="title_overview"  placeholder="<?php if($this->lang->line('Maximum150words') != '') { echo stripslashes($this->lang->line('Maximum150words')); } else echo "Maximum 150 words";?>" rows="8"  onchange="javascript:ChangeOVerviewdesc(this,<?php echo $listDetail->row()->id; ?>);"  name="description" id="description" style="color:#000 !important;"><?php echo strip_tags($listDetail->row()->description);?></textarea>
                        
                            <!--<span>250 characters left</span>-->
                        
                        </div>
						
	
						
						
						
						
						
                        
                    </div>
                </form>
                </div>
            
            </div>
			<?php if($listDetail->row()->space =="" || $listDetail->row()->guest_access =="" || $listDetail->row()->interact_guest =="" || $listDetail->row()->neighbor_overview =="" || $listDetail->row()->neighbor_around =="" || $listDetail->row()->house_rules ==""){?>
             <p class="price_text_links"><?php if($this->lang->line('Wanttowrite') != '') { echo stripslashes($this->lang->line('Wanttowrite')); } else echo "Want to write even more? You can also";?> <a href="detail_list/<?php echo $listDetail->row()->id;?>"> <?php if($this->lang->line('addadetaileddescription') != '') { echo stripslashes($this->lang->line('addadetaileddescription')); } else echo "add a detailed description";?></a><?php if($this->lang->line('toyourlisting') != '') { echo stripslashes($this->lang->line('toyourlisting')); } else echo "to your listing";?></p>
			 <?php }?>
            </div>
            
            <div class="calender_comments">
            
            	<div class="calender_comment_content">
                
                	<!--<i class="calender_comment_content_icon"><img src="images/calender_available_icon.jpg" /></i>-->
                    
               <!--     <div class="calender_comment_text">
                    
                    	<h2><?php if($this->lang->line('Agreattitle') != '') { echo stripslashes($this->lang->line('Agreattitle')); } else echo "A great summary";?></h2>
                    
                    	<p><?php if($this->lang->line('Agreattitleisunique') != '') { echo stripslashes($this->lang->line('Agreattitleisunique')); } else echo "A great summary is rich and exciting! It should cover the major features of your space and neighborhood in 250 characters or less.";?></p>
                        
                        <p><strong><?php if($this->lang->line('example') != '') { echo stripslashes($this->lang->line('example')); } else echo "Example";?>:</strong><?php if($this->lang->line('Ourcooland') != '') { echo stripslashes($this->lang->line('Ourcooland')); } else echo "Our cool and comfortable one bedroom apartment with exposed brick has a true city feeling! It comfortably fits two and is centrally located on a quiet street, just two blocks from Washington Park. Enjoy a gourmet kitchen, roof access, and easy access to all major subway lines!";?>  </p>
                        
                    
                    </div>-->
                    
                    
                
                </div>
            
            </div>
        	
        
        </div>
        
    </div>
    <script type="text/javascript" language="javascript">
		function limitKeyword(limitCount, limitNum) {
		var limitField = document.getElementById("product_name");
			if (limitField.value.length > limitNum) {
				limitField.value = limitField.value.substring(0, limitNum);
				} else {
				limitCount.value = limitNum - limitField.value.length;
			}
		}

		//한글입력 허용. josungwoo		
		//$('#product_title').bind('input', function() {
		//	  $(this).val($(this).val().replace(/[^a-z0-9_ ]/gi, ''));
		//});	

</script>
<style>
#counter-text {
    color: red !important;
}
</style>
<!--<script type="text/javascript" src="js/jQuery.textareaCounter.min.js"></script>-->
<script type="text/javascript">
(function($){
	$.fn.textareaCounter = function(options) {
		// setting the defaults
		// $("textarea").textareaCounter({ limit: 100 });
		var defaults = {
			limit: 150
		};	
		var options = $.extend(defaults, options);
 
		// and the plugin begins
		return this.each(function() {
			var obj, text, wordcount, limited;
			
			obj = $(this);
			obj.after('<span style="font-size: 11px; clear: both; margin-top: 3px; display: block;" id="counter-text">Max. '+options.limit+' words</span>');

			obj.keyup(function() {
			    text = obj.val();
			    if(text === "") {
			    	wordcount = 0;
			    } else {
				    wordcount = $.trim(text).split(" ").length;
				}
			    if(wordcount > options.limit) {
			        $("#counter-text").html('<span style="color: #DD0000;">0 words left</span>');
					limited = $.trim(text).split(" ", options.limit);
					limited = limited.join(" ");
					$(this).val(limited);
			    } else {
			        $("#counter-text").html((options.limit - wordcount)+' words left');
			    } 
			});
		});
	};
})(jQuery);
$("textarea").textareaCounter();
</script>
  <script>
  
  function activateSubmit(){
  //alert('');
    var len = $('#description').val().split(" ").length;
    if(len < 150){ //15 words, hardcoded, probably change this to maxwords, or whatever.
	//alert(len);
     //alert('Enter only 150 words');
    }
    
  }
</script>
<!---DASHBOARD-->
<?php
$this->load->view('site/templates/footer');
?>

