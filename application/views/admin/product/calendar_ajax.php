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
						url: '<?php echo base_url();?>admin/product/get_pop_up',
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
				url: '<?php echo base_url();?>admin/product/get_pop_up',
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
		url: '<?php echo base_url();?>admin/product/calendar',
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