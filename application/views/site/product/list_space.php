<?php 
$this->load->view('site/templates/header');
$accommodates="";
$roombedVal=json_decode($listValues->row()->listing_values);
$accommodates=$roombedVal->accommodates;
?>


<script type="text/javascript">
function clickRoom(val){
	localStorage.setItem("room_type", val);
	document.getElementById("home_type"+val).checked = true;
	var home_type_val = $('#home_type'+val).val();
	$('#room_type_value').val(home_type_val);
	$('#homelist'+val).toggle();
}

function clickProperty(val){
	localStorage.setItem("home_type", val);
    document.getElementById("home_type"+val).checked = true;
    var home_type_val = $('#home_type'+val).val();
	$('#home_type_value').val(home_type_val);
    $('#homelist'+val).toggle();
}

function clickRoomHide(val){
	$('#room_type_value').val();
	$('#homelist'+val).css("display","none");
}

function clickPropertyHide(val){
	$('#home_type_value').val();
    $('#homelist'+val).css("display","none");
}

function homeViewNew(){
	var tmp = $('#home_type_new').val();
   var tmpArr = tmp.split('-');
   var val = tmpArr[1];
   var home_type_val = tmpArr[0];
   if(val>0){
        $('#home_type_value').val(home_type_val);
    }else{
        $('.temp_home_type').remove();
    }
    if($('#homelist'+val).css('display')=='block'){
	
        $('#homelist'+val).hide('');    
    }else{
	
	//$('#homelist6').show('');
        $('#homelist'+val).show('');
		
    }
}
function roomViewNew(){
var tmp = $('#room_type_new').val();
   var tmpArr = tmp.split('-');
   var val = tmpArr[1];
   var home_type_val = tmpArr[0];
   if(val>0){
        $('#room_type_value').val(home_type_val);
    }else{
        $('.temp_home_type').remove();
    }
    if($('#homelist'+val).css('display')=='block'){
	
        $('#homelist'+val).hide('');    
    }else{
	
	//$('#homelist6').show('');
        $('#homelist'+val).show('');
		
    }
}

function accommodatesView(evt){
	localStorage.setItem("accommodates", $(evt).val());
	$('.accommodates_type_field_btn #citylist1').css('display','block');
    $(evt).parent().next().find('em').text($(evt).val());
	$('#accommodates').val($(evt).val());
}

function click_accom(){
	$('.accommodates_type_field_btn #citylist1').css('display','none');
}
function ViewSubmitbutton(val){
	localStorage.setItem("location",$("#autocompleteNewList").val());
	$(".continue_hide").css("opacity", "1");
}
</script>
<div class="dashboard listyourspace">
    <div class="main">
        <div class="list_space">
            <div class="list_title center">
                <h1 class="border_line hr"><span><?php if($this->lang->line('list_your') != '') { echo stripslashes($this->lang->line('list_your')); } else echo "List Your Space";?></span> <hr /></h1>
			</div>
        </div>
    </div>
    <div class="list_background">
        <div class="main">
			<form action='<?php echo base_url();?>site/product/add_space' id = 'contact_form' method='post'>
			<input type="hidden" name="accommodates" id="accommodates"  value="">
			<input type="hidden" name="home_type_1" id="home_type_value"  value="">
			<input type="hidden" name="room_type_1" id="room_type_value"  value="">
			<div class="list_field">
               <div class="home_type">
				<?php foreach($listspace->result() as $value){
				$id=$value->id;?>
					<div class="desin-loop">
						<label><?php echo $value->attribute_name; ?></label>
						<div class="home_type_field">
							<ul class="home_type_field_btn">
							<?php
							
							$sql = 'SELECT * FROM fc_listspace_values WHERE listspace_id = '.$id.' order by other asc';
							$inner = $this->db->query($sql);
							foreach($inner->result() as $listvalue)
							{ if($listvalue->other != 'Yes'){?>			
								
								<li>
								<?php if($value->attribute_seourl == 'roomtype'){ ?>
										<a  href="javascript:clickRoom('<?php echo $listvalue->id; ?>');">
									<?php }else{ ?>
										<a  href="javascript:clickProperty('<?php echo $listvalue->id; ?>');">
									<?php }  ?>
										<?php 
										if($listvalue->image!=""){
											$imgPath=base_url().'images/attribute/'.$listvalue->image;
										}else{
											$imgPath=base_url().'images/attribute/default-list-img.png';
										}
										?>
										<img src="<?php echo $imgPath; ?>" alt="<?php echo $listvalue->list_value; ?>" class="list-img" />
										<span>
											<input type="radio" id="home_type<?php echo $listvalue->id; ?>" value="<?php echo $listvalue->list_value; ?>" />
											<?php echo $listvalue->list_value; ?>
										</span>
									</a>
								</li>
						 
								<?php
								} }
								foreach($inner->result() as $listvalue){?>
								
								<?php if($value->attribute_seourl == 'roomtype'){ ?>
								<div class="apart_hide" id="homelist<?php echo $listvalue->id; ?>">
									<a href="javascript:clickRoomHide('<?php echo $listvalue->id; ?>');">
								<?php }else{ ?> 
									<div class="apart_hide" id="homelist<?php echo $listvalue->id; ?>">
									<a href="javascript:clickPropertyHide('<?php echo $listvalue->id; ?>');">
								<?php } ?>
										<div class="aparthide_left">
											<?php if($listvalue->image!=""){
												$imgPath=base_url().'images/attribute/'.$listvalue->image;
											}else{
												$imgPath=base_url().'images/attribute/default-list-img.png';
											}
											?>
											<img src="<?php echo $imgPath;?>" alt="<?php echo $listvalue->list_value;?>" class="list-img" />
											<span><?php echo $listvalue->list_value; ?></span>
										</div>
										<div class="aparthide_right">
											<i class="aparthide_left_arrow"></i>
											<strong><?php echo $listvalue->list_description; ?></strong>
										</div>
									</a>
									</div>
									<?php }if($listvalue->other == 'Yes'){?>  
									<span>
										<?php if($value->attribute_seourl == 'roomtype') {?>
										<select style="height:65px;"  onchange="javascript:roomViewNew();" class="other-opt" id="room_type_new">
										<?php } else {?>
										<select style="height:65px;"  onchange="javascript:homeViewNew();" class="other-opt" id="home_type_new">
										<?php } ?>
											<option value="">Other</option>
											<?php }?>
											<?php	 foreach($inner->result() as $listvalue){
											if($listvalue->other == 'Yes'){
											?>
											<option value="<?php echo $listvalue->list_value;?>-<?php echo $listvalue->id;?>"><?php echo $listvalue->list_value;?></option>
											<?php	}	 }?>
										</select>
									</span>
								</div>                    
							</ul>
						</div>
						<?php } ?>
					</div> 
					<div class="accommodates_type">
						<label>Accommodates</label>
						<div class="accommodates_type_field" >
							<ul class="accommodates_type_field_btn">
								<li>
									<i class="appa_icon icon-8"></i>
									<select class="select-bor" id="accommodateslist1" onchange="accommodatesView(this)" >
									<?php if($accommodates!=""){ 
									$accommodatesArr=@explode(',',$accommodates);
									foreach($accommodatesArr as $rows){?>
									<option value="<?php echo $rows; ?>">
										<?php echo $rows; ?>
									</option>
									<?php } } ?>
									</select>
								</li>
								<div class="apart_hide" id="citylist1" onClick="click_accom();">
									<div class="aparthide_left ">
										<em class="em_selected"></em>
									</div>
									<div class="aparthide_right1">
                                    
                                    
                                    </div>
                                </div>
							</ul>
						</div>
					</div>
					<div class="city_type">
						<label>City</label>
						<div class="city_type_field">
							<ul class="city_type_field_btn">
								<li>
									<i class="appa_icon icon-10"></i>
									<span>
										<input name="city" id="autocompleteNewList" placeholder="Accord,New York,United States..." type="text" autocomplete="off" style="width: 100%;" onselect="selectFunction(this)" onKeyPress="javascript:ViewSubmitbutton('1');">
										<div id="cityser_warn" style="font-size:12px; color:#FF0000; float:right;" ></div>
									</span>
								</li>
							</ul>
							<div class="for_auto_ser"></div>
						</div>
					</div>
					<div class="city_type">
						<label></label>
						<input type="submit"  <?php if($this->session->userdata('fc_session_user_id')==''){?>class="login-popup continue_hide tick_icon"<?php } else {?>id="list_submit"  class="continue_hide tick_icon"<?php }?> value="Continue"/>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!---DASHBOARD-->

<script type="text/javascript">
$(function () {
	$('#autocompleteNewList').keydown(function (e) {
		if (e.shiftKey || e.ctrlKey || e.altKey) {
			e.preventDefault();
		} else {
			var key = e.keyCode;
			if (!((key == 8) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90) || (key >= 48 && key <= 57) || (key >= 96 && key <= 105))) {
				e.preventDefault();
			}
		}
	});
});
</script>

<?php 
$this->load->view('site/templates/footer');
?>
<!---FOOTER-->
</body>
</html>