<?php 
$this->load->view('site/templates/header'); 
$this->load->view('site/templates/listing_head_side');?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="<?php echo base_url();?>css/booking_calender.css">
<script type="text/javascript">
jQuery(document).ready( function () {
	$("#datefrom").datepicker({
			minDate:0,
			dateFormat: 'yy-mm-dd',
			onClose: function (selectedDate) {
			$("#dateto").datepicker("option", "minDate", selectedDate).focus();
		}
	});
	$("#dateto").datepicker({
			minDate:0,
			dateFormat: 'yy-mm-dd',
			onClose: function (selectedDate) {
			$("#datefrom").datepicker("option", "maxDate", selectedDate);
		}
	}); 
});
function Date_validation(){ 
        if(jQuery.trim($('#datefrom').val())== ''){
            $("#datefrom").focus();
            return false;
        }else if(jQuery.trim($('#dateto').val())== ''){
            $("#dateto").focus();
            return false;
        }else{
            $('#calendar_form').submit();
        }
    }
</script>

<div class="right_side manage_listing-right right_side_cal">
	<div class="calender_box_main">
		<div class="calender_box">
			<div class="calender_bottom center">
			<?php if($listDetail->row()->calendar_checked!='' && $listDetail->row()->status !='UnPublish') { ?>
				<div id="wrapper">
					<div id="monthly_calender">
						<div class="calender-container">
							<div class="calenderholder">
								<div class="calender-top">
									<div class="col-md-6 col-xs-12 calender-top-left">
										<input type="hidden" id="last_month" value="<?php echo $lastMonth;?>" />
										<input type="hidden" id="next_month" value="<?php echo $nextMonth;?>" />
										<input type="hidden" id="last_year" value="<?php echo $lastYear;?>" />
										<input type="hidden" id="next_year" value="<?php echo $nextYear;?>" />
										<input type="hidden" id="month" value="<?php echo $month;?>" />
										<input type="hidden" id="year" value="<?php echo $year;?>" />
										<ul class="lefsider">
											<?php if($blockPrev == 'No'){ ?>
											<li><a href="javascript:void(0)" id="lastMonth"><i class="fa fa-chevron-left"></i></a></li>	
											<?php } else { ?>
											<li><a href="javascript:void(0)" id="" disabled><i class="fa fa-chevron-left"></i></a></li>	
											<?php } ?>
											<li><a href="javascript:void(0)" id="nextMonth"><i class="fa fa-chevron-right"></i></a></li>	
										</ul>
										<select class="sectoptin" id="month_list">
											<option value="01" <?php if($month == 1)echo "selected='selected'";?> <?php if($monthTime > strtotime($year.'-1'))echo "disabled";?>><?php if($this->lang->line('January') != '') { echo stripslashes($this->lang->line('January')); } else echo "January";?>&nbsp;<?php echo $year;?></option>
											<option value="02" <?php if($month == 2)echo "selected='selected'";?> <?php if($monthTime > strtotime($year.'-2'))echo "disabled";?>><?php if($this->lang->line('February') != '') { echo stripslashes($this->lang->line('February')); } else echo "February";?>&nbsp;<?php echo $year;?></option>
											<option value="03" <?php if($month == 3)echo "selected='selected'";?> <?php if($monthTime > strtotime($year.'-3'))echo "disabled";?>><?php if($this->lang->line('March') != '') { echo stripslashes($this->lang->line('March')); } else echo "March";?>&nbsp;<?php echo $year;?></option>
											<option value="04" <?php if($month == 4)echo "selected='selected'";?> <?php if($monthTime > strtotime($year.'-4'))echo "disabled";?>><?php if($this->lang->line('April') != '') { echo stripslashes($this->lang->line('April')); } else echo "April";?>&nbsp;<?php echo $year;?></option>
											<option value="05" <?php if($month == 5)echo "selected='selected'";?> <?php if($monthTime > strtotime($year.'-5'))echo "disabled";?>><?php if($this->lang->line('May') != '') { echo stripslashes($this->lang->line('May')); } else echo "May";?>&nbsp;<?php echo $year;?></option>
											<option value="06" <?php if($month == 6)echo "selected='selected'";?> <?php if($monthTime > strtotime($year.'-6'))echo "disabled";?>><?php if($this->lang->line('June') != '') { echo stripslashes($this->lang->line('June')); } else echo "June";?>&nbsp;<?php echo $year;?></option>
											<option value="07" <?php if($month == 7)echo "selected='selected'";?> <?php if($monthTime > strtotime($year.'-7'))echo "disabled";?>><?php if($this->lang->line('July') != '') { echo stripslashes($this->lang->line('July')); } else echo "July";?>&nbsp;<?php echo $year;?></option>
											<option value="08" <?php if($month == 8)echo "selected='selected'";?> <?php if($monthTime > strtotime($year.'-8'))echo "disabled";?>><?php if($this->lang->line('August') != '') { echo stripslashes($this->lang->line('August')); } else echo "August";?>&nbsp;<?php echo $year;?></option>
											<option value="09" <?php if($month == 9)echo "selected='selected'";?> <?php if($monthTime > strtotime($year.'-9'))echo "disabled";?>><?php if($this->lang->line('September') != '') { echo stripslashes($this->lang->line('September')); } else echo "September";?>&nbsp;<?php echo $year;?></option>
											<option value="10" <?php if($month == 10)echo "selected='selected'";?> <?php if($monthTime > strtotime($year.'-10'))echo "disabled";?>><?php if($this->lang->line('October') != '') { echo stripslashes($this->lang->line('October')); } else echo "October";?>&nbsp;<?php echo $year;?></option>
											<option value="11" <?php if($month == 11)echo "selected='selected'";?> <?php if($monthTime > strtotime($year.'-11'))echo "disabled";?>><?php if($this->lang->line('November') != '') { echo stripslashes($this->lang->line('November')); } else echo "November";?>&nbsp;<?php echo $year;?></option>
											<option value="12" <?php if($month == 12)echo "selected='selected'";?> <?php if($monthTime > strtotime($year.'-12'))echo "disabled";?>><?php if($this->lang->line('December') != '') { echo stripslashes($this->lang->line('December')); } else echo "December";?>&nbsp;<?php echo $year;?></option>
										</select>
									</div>
									<div class="col-md-6 col-xs-12 calender-top-right">
										<ul>
											<li><span class="green-circle"></span><?php if($this->lang->line('Available') != '') { echo stripslashes($this->lang->line('Available')); } else echo "Available"; ?></li>
											<li><span class="white-circle"></span><?php if($this->lang->line('Booked') != '') { echo stripslashes($this->lang->line('Booked')); } else echo "Booked"; ?></li>
											<li><span class="gray-circle"></span><?php if($this->lang->line('Unavailable') != '') { echo stripslashes($this->lang->line('Unavailable')); } else echo "Unavailable"; ?></li>
										</ul>
									</div>
								</div>
								<div class="calenderbottom">
									<ul class="daylsit">
										<li><?php if($this->lang->line('Sun') != '') { echo stripslashes($this->lang->line('Sun')); } else echo "Sun";?></li>
										<li><?php if($this->lang->line('Mon') != '') { echo stripslashes($this->lang->line('Mon')); } else echo "Mon";?></li>
										<li><?php if($this->lang->line('Tue') != '') { echo stripslashes($this->lang->line('Tue')); } else echo "Tue";?></li>
										<li><?php if($this->lang->line('Wed') != '') { echo stripslashes($this->lang->line('Wed')); } else echo "Wed";?></li>
										<li><?php if($this->lang->line('Thu') != '') { echo stripslashes($this->lang->line('Thu')); } else echo "Thu";?></li>
										<li><?php if($this->lang->line('Fri') != '') { echo stripslashes($this->lang->line('Fri')); } else echo "Fri";?></li>
										<li><?php if($this->lang->line('Sat') != '') { echo stripslashes($this->lang->line('Sat')); } else echo "Sat";?></li>
									
									</ul>
									<ul class="calenderlist">
										<?php echo $html;?>
									</ul>	
								</div>
							</div>
						</div>
						<input type="hidden" id="date-marked" value="" />
						<input type="hidden" id="date-moving" value="" />
						<input type="hidden" id="date-finished" value="" />
						<input type="hidden" id="productId" value="<?php echo $productId?>" />
						<script type="text/javascript">
						$( document ).ready(function() { 
							$('#lastMonth').click(function(){
								var i = $("#month").val($("#last_month").val());
								if($("#last_month").val() == 12)
								$("#year").val($("#last_year").val());
								changeCalendar();
							});
							
							$('#nextMonth').click(function(){
								var i = $("#month").val($("#next_month").val());
								if($("#next_month").val() == 1)
								$("#year").val($("#next_year").val());
								changeCalendar();
							});
							
							$('#month_list').change(function(){
								var i = $("#month").val($(this).val());
								changeCalendar();
							});
							
							$( '.current-date' ).mouseenter(function() {
								if($("#date-marked").val() == ''){
									$(this).append( '<div class="lhalf"></div>' );	
									$(this).next().append( '<div class="rhalf"></div>' );	
								}else if($("#date-finished").val() == ''){
									$("#date-moving").val($(this).attr('id'));
									$(".date-selected").removeClass('date-selected');
									$( '.current-date' ).each(function() {
										if(($(this).attr('id') <= $("#date-moving").val() && $(this).attr('id') >= $("#date-marked").val()) || $(this).attr('id') >= $("#date-moving").val() && $(this).attr('id') <= $("#date-marked").val()){
											$(this).addClass('date-selected');
											$(this).append( '<div class="lhalf"></div>' );	
											$(this).next().append( '<div class="rhalf"></div>' );	
										}
									});
								}
							});

							$( ".current-date" ).mouseleave(function() {
								if($("#date-finished").val() == ''){
									$('.lhalf').remove();	
									$('.rhalf').remove();	
								}
							});
							
							
							$('.current-date').mousedown(function(event) {
								switch (event.which) {
									case 1:
										if($("#date-marked").val() == ''){
											$("#date-marked").val($(this).attr('id'));
											$(this).addClass('date-selected');
										} else if($("#date-finished").val() == ''){
											$("#date-finished").val($(this).attr('id'));
											$(this).append( '<div class="save-popup" id="save-popup"></div>' );	
											var selectedDates = [];
											$( '.date-selected' ).each(function(i) {
												selectedDates[i] = $(this).attr('id');
											});
											var productId = $('#productId').val();
											$.ajax({
												url: '<?php echo base_url();?>site/cms/get_pop_up',
												type:"POST",
												data:{"selectedDates":selectedDates, "productId":productId},
												success:function(data){
													$("#save-popup").html(data);
												}
											});
										}
										break;
									case 2:
										break;
									case 3:
										if($("#date-marked").val() == ''){
											alert('Right Mouse button pressed.');
										}
										break;
									default:
										alert('You have a strange Mouse!');
								}
							});


							$( ".current-date-1" ).click(function() {
								if($("#date-marked").val() == ''){
									$("#date-marked").val($(this).attr('id'));
									$(this).addClass('date-selected');
								} else if($("#date-finished").val() == ''){
									$("#date-finished").val($(this).attr('id'));
									$(this).append( '<div class="save-popup" id="save-popup"></div>' );	
									var selectedDates = [];
									$( '.date-selected' ).each(function(i) {
										selectedDates[i] = $(this).attr('id');
									});
									var productId = $('#productId').val();
									$.ajax({
										url: '<?php echo base_url();?>site/cms/get_pop_up',
										type:"POST",
										data:{"selectedDates":selectedDates, "productId":productId},
										success:function(data){
											$("#save-popup").html(data);
										}
									});
								}
							});
						});
						
						function changeCalendar(){
							var month = $("#month").val();
							var year = $("#year").val();
							var productId = $("#productId").val();
							$.ajax(
							{
								type: 'POST',
								url: '<?php echo base_url();?>site/cms/calendar',
								data:{'month':month, 'year':year, 'productId':productId},
								success: function(data) 
								{
									$("#monthly_calender").html(data);
								}
							});
						}
						</script>

						<script type="text/javascript">
							$( document ).ready(function() {
								$('.date-unavailable .dayholder').append( '<div class="nlhalf"></div>' );
								$('.date-unavailable').next().find('.dayholder').append( '<div class="nrhalf"></div>' );
								$('.date-available .dayholder').append( '<div class="alhalf"></div>' );
								$('.date-available').next().find('.dayholder').append( '<div class="arhalf"></div>' );
								$('.date-booked .dayholder').append( '<div class="blhalf"></div>' );
								$('.date-booked').next().find('.dayholder').append( '<div class="brhalf"></div>' );
							});
						</script>
					</div>
				</div>
			<?php }else {?>
                    <div class="calender_hide center" id="calenderlist1">
                    
                        <div class="calender_small_icon small-1"></div>
                        
                        <h2 class="calender_bottom_header"><?php if($this->lang->line('Always_Available') != '') { echo stripslashes($this->lang->line('Always_Available')); } else echo "Always Available";?></h2>
                    
                        <p><?php if($this->lang->line('Thisisyourcalendar') != '') { echo stripslashes($this->lang->line('Thisisyourcalendar')); } else echo "This is your calendar! After listing your space, return here to update your availability.";?></p>
                        
                        <a class="choose_links" href="javascript:calenderView('1')"><?php if($this->lang->line('Choose_Again') != '') { echo stripslashes($this->lang->line('Choose_Again')); } else echo "Choose Again";?></a>
                    
                    </div>
                    <div class="calender_hide center" id="calenderlist2">
                    
                        <div class="calender_small_icon small-2"></div>
                        
                        <h2 class="calender_bottom_header"><?php if($this->lang->line('Sometimes_Available') != '') { echo stripslashes($this->lang->line('Sometimes_Available')); } else echo "Sometimes Available";?></h2>
                    
                        <p><?php if($this->lang->line('Thisisyourcalendar') != '') { echo stripslashes($this->lang->line('Sometimes_Available')); } else echo "This is your calendar! After listing your space, return here to update your availability.";?></p>
                        
                        <a class="choose_links" href="javascript:calenderView('2');"><?php if($this->lang->line('Choose_Again') != '') { echo stripslashes($this->lang->line('Choose_Again')); } else echo "Choose Again";?></a>
                    
                    </div>
                    
                    <div class="calender_hide center" id="calenderlist3">
                    
                        <div class="calender_small_icon small-3"></div>
                        
                        <h2 class="calender_bottom_header"><?php if($this->lang->line('OneTimeAvailability') != '') { echo stripslashes($this->lang->line('OneTimeAvailability')); } else echo "One Time Availability";?></h2>
                    
                        <p><?php if($this->lang->line('Selectthedatesyour') != '') { echo stripslashes($this->lang->line('Selectthedatesyour')); } else echo "Select the dates your listing is available.";?></p>
                        
                        <div class="onetime_start">
                        <form name="calendar" id="calendar_form" method="post" action="site/product/saveCalender">
                        <input type="text" id="datefrom" name="datefrom" placeholder="Start Date" <?php if($listDetail->row()->datefrom != '' && $listDetail->row()->datefrom != '0000-00-00'){?>value="<?php echo $listDetail->row()->datefrom;?>" <?php } ?> class="start_overview datepicker"  />
                            
                            <span class="availability-to">to</span>
                            
                            <input type="text" id="dateto"  name="dateto" placeholder="End Date" <?php if($listDetail->row()->dateto != '' && $listDetail->row()->dateto != '0000-00-00'){?>value="<?php echo $listDetail->row()->dateto;?>" <?php } ?> class="start_overview datepicker" />
                            <input type="hidden" name="prd_id" value="<?php echo $listDetail->row()->id; ?>" />
                            <input type="submit" value="Save" onclick="return Date_validation();" class="save_btn" />
                        </form>
                        
                        </div>
                        
                        <p><?php if($this->lang->line('Afterlistingyour') != '') { echo stripslashes($this->lang->line('Afterlistingyour')); } else echo "After listing your space, return here to set custom prices and availability.";?></p>
                        
                        <a class="choose_links" href="javascript:calenderView('3');"><?php if($this->lang->line('Choose_Again') != '') { echo stripslashes($this->lang->line('Choose_Again')); } else echo "Choose Again";?></a>
                    
                    </div>
                          
                    <div class="calender_bottom_block">
                    
                        <h2 class="calender_bottom_header"><?php if($this->lang->line('Whenisyourlisting') != '') { echo stripslashes($this->lang->line('Whenisyourlisting')); } else echo "When is your listing available?";?></h2>
                        
                        <ul class="calender_detail" style="padding: 0px !important;">
                        
                            <li class="availability_option">
                            
                            <a href="javascript:calenderView('1'),Detailview('<?php echo $listDetail->row()->id;?>','always','calendar_checked');">
                            
                                <div class="calendar-image available-always" <?php if($listDetail->row()->calendar_checked=='always'){?>style="background-position: 2px -290px;"<?php }?>></div>
                                
                                <h3><?php if($this->lang->line('Always') != '') { echo stripslashes($this->lang->line('Always')); } else echo "Always";?></h3>
                                
                                <p><?php if($this->lang->line('Listalldates') != '') { echo stripslashes($this->lang->line('Listalldates')); } else echo "List all dates as available";?></p>
                            </a>
                            
                            </li>
							<li class="availability_option">
                            <a href="javascript:calenderView('2'),Detailview('<?php echo $listDetail->row()->id;?>','sometimes','calendar_checked');">
                                <div class="calendar-image available-sometimes" <?php if($listDetail->row()->calendar_checked=='sometimes'){?>style="background-position: 2px -290px;"<?php }?>></div>
                                
                                <h3><?php if($this->lang->line('Sometimes') != '') { echo stripslashes($this->lang->line('Sometimes')); } else echo "Sometimes";?></h3>
                                
                                <p><?php if($this->lang->line('Listsomedates') != '') { echo stripslashes($this->lang->line('Listsomedates')); } else echo "List some dates as available";?></p>
                             </a>   
                            
                            </li>
                            
                           <!-- <li class="availability_option">
                            <a href="javascript:calenderView('3'),DetailviewOnetime('<?php echo $listDetail->row()->id;?>','onetime','calendar_checked');">
                                <div class="calendar-image available-sometimes" <?php if($listDetail->row()->calendar_checked=='onetime'){?>style="background-position: 2px -290px;"<?php }?>></div>
                                
                                <h3><?php if($this->lang->line('OneTime') != '') { echo stripslashes($this->lang->line('OneTime')); } else echo "One Time";?></h3>
                                
                                <p><?php if($this->lang->line('ListOnly') != '') { echo stripslashes($this->lang->line('ListOnly')); } else echo "List only one time period as available";?></p>
                            </a>
                            </li> -->
                        </ul>
                        
                        </div>
                        
                        
                    <?php }?>
                    </div>
                    
                    
                    
                
                
                </div>

              <!--  <span class="calen-text"><?php if($this->lang->line('CalenderLast') != '') { echo stripslashes($this->lang->line('CalenderLast')); } else echo "Calender Last Update";?> <a class="today-text" href="#">today</a></span> -->
                
                </div>
            
            </div>
            
            <div class="calender_comments map-right">
            
                <div class="calender_comment_content">
                
                    <!--<i class="calender_comment_content_icon"><img src="images/calender_available_icon.jpg" /></i>-->
					<!--<h1><?php if($this->lang->line('Usethecalendarto') != '') { echo stripslashes($this->lang->line('Usethecalendarto')); } else echo "Use the calendar to";?><h1>-->
					<!--<li class="calender_comment_text"><?php if($this->lang->line('Setcustom') != '') { echo stripslashes($this->lang->line('Setcustom')); } else echo "Set custom Prices for specific dates";?></li>
					<li class="calender_comment_text"><?php if($this->lang->line('Markdates') != '') { echo stripslashes($this->lang->line('Markdates')); } else echo "Mark dates as unavailable";?></li>
					<li class="calender_comment_text"><?php if($this->lang->line('ViewYourupcoming') != '') { echo stripslashes($this->lang->line('ViewYourupcoming')); } else echo "View Your upcoming reservations";?></li>-->
                    
                   <!-- <p class="calender_comment_text">
					Choose the option that best fits your listing's availability. Don't worry, you can change this any time.
					</p>-->
                
                </div>
            
            </div>
<script>
$(function(){
	
		localStorage.setItem("room_type",'null');
		localStorage.setItem("home_type",'null');
		localStorage.setItem("accommodates",'null');
		localStorage.setItem("location",'');
		
	$('.calender-left-arrow').css('opacity',0.1);
	setTimeout(function() {
       available_status();
    }, 2000);
	
})
	
function available_status()
	{
		
       /** available status **/
	  
		
		$('.avail-middle').each(function(){
		var available_status=$(this).parent().next().attr('class');
		available_status1=available_status.split(' ');
		if(available_status1[2]!='available')
		{
		
		$(this).parent().next().addClass('avail-last');
		//$('.avail-first').css('background','url("<?php echo base_url().'images/available-1st.png';?>")');
		//$('.avail-first').css('background-position','right');
		$('.avail-first').css('background-color','#1b8ebf');
		$('.avail-middle').css('background-color','#1b8ebf');
		
		//$('.avail-last').css('background','url("<?php echo base_url().'images/available-last.png';?>") no-repeat');
		//$('.avail-last').css('height','72px');
		} 
		})
		/** available status **/
		
		/** booked status **/
		
		
		$('.booked-middle').each(function(){
		var available_status=$(this).parent().next().attr('class');
		available_status1=available_status.split(' ');
		if(available_status1[2]!='booked')
		{
		
		$(this).parent().next().addClass('booked-last');
	//	$('.booked-first').css('background','url("<?php echo base_url().'images/booked-1st.png';?>")');
//$('.booked-first').css('background-position','right');
		$('.booked-first').css('background-color','#fac97a');
		$('.booked-middle').css('background-color','#fac97a');
		
		//$('.booked-last').css('background','url("<?php echo base_url().'images/booked-last.png';?>") no-repeat');
		//$('.booked-last').css('height','72px');
		} 
		})
		/** booked status **/
		
		
		/** unavailable status **/
		
		$('.unavail-middle').each(function(){
		var available_status=$(this).parent().next().attr('class');
		available_status1=available_status.split(' ');
		if(available_status1[2]!='unavailable')
		{
		
		$(this).parent().next().addClass('unavail-last');
		//$('.unavail-first').css('background','url("<?php echo base_url().'images/unavailable-1st.png';?>")');
		//$('.unavail-first').css('background-position','right');
		$('.unavail-first').css('background-color','#666666');
		$('.unavail-middle').css('background-color','#666666');
		
		//$('.unavail-last').css('background','url("<?php echo base_url().'images/unavailable-last.png';?>") no-repeat');
		//$('.unavail-last').css('height','72px');
		} 
		})
		/** unavailable status **/
   
	}
function Detailview(catID,title,chk)
{
	$.ajax({
	type:'POST',
	url:'<?php echo base_url()?>site/product/saveDetailPage',
	data:{catID:catID,title:title,chk:chk},
	success:function(response)
	{
		window.location.reload(true);
	}
	})
}
function DetailviewOnetime(catID,title,chk)
{
	
}
</script>	
<style>
.calender-top-right ul li {
    font-family: "Conv_DaxLight";
    color: #333;
    font-size: 14px;
    float: left;
    margin-right: 30px;
}
.green-circle {
    width: 10px;
    height: 10px;
    float: left;
    background: #fff;
    display: block;
    border-radius: 100%;
    margin-top: 5px;
    margin-right: 10px;
    border: 1px solid #329861;
}
.white-circle {
    width: 10px;
    height: 10px;
    float: left;
    background: #FAC97A;
    display: block;
    border-radius: 100%;
    margin-top: 5px;
    margin-right: 10px;
    border: 1px solid #FAC97A;
}
.gray-circle {
    width: 10px;
    height: 10px;
    float: left;
    background: #666666;
    display: block;
    border-radius: 100%;
    margin-top: 5px;
    margin-right: 10px;
    border: 1px solid #ccc;
}
.content{
	height:44px !important;
}
</style>

<div id="myModal-rating-publish" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<a class="btn btn-default close-btn" data-dismiss="modal"><span class="">x</span></a>
				
				<a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>images/logo.png"></a>
			</div>
			
			<div class="modal-body">
				<span class="publish-head"><?php if($this->lang->line('product_page_active_instruction_publish') != '') { echo stripslashes($this->lang->line('product_page_active_instruction_publish')); } else echo "To publish your listing ";?></span>
				<span id="pending_steps_new" class="number-circle"></span> 
				<span class="publish-footer"><?php if($this->lang->line('product_page_active_instruction_more') != '') { echo stripslashes($this->lang->line('product_page_active_instruction_more')); } else echo "more Steps to be Completed";?></span>
				
				<hr style="clear:both;">
				<a class="request-trip" id="finish_my_listing"href="" style="margin-right:36%;"><?php if($this->lang->line('product_page_active_instruction_finish') != '') { echo stripslashes($this->lang->line('product_page_active_instruction_finish')); } else echo "Finish my listing";?></a>
				
			</div>
			
			
			
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dalog -->
</div>
<?php $this->load->view('site/templates/footer'); ?>