<script type="text/javascript">
	$.getScript("<?php echo base_url();?>js/site/bootstrap-datepicker.js", function(){
		var startDate = '<?php echo date('m/d/Y');?>';
		var FromEndDate = new Date();
		var ToEndDate = new Date();
		ToEndDate.setDate(ToEndDate.getDate()+365);
		$('#home_date_from').datepicker({
			weekStart: 1,
			startDate: '<?php echo date('m/d/Y');?>',
			endDate: '<?php echo $endingDate;?>',
			autoclose: true
		}).on('changeDate', function(selected){
			startDate = new Date(selected.date.valueOf());
			startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
			$('#home_date_to').datepicker('setStartDate', startDate);
		}); 

		$('#home_date_to').datepicker({
			weekStart: 1,
			startDate: '<?php echo $startingDate;?>',
			endDate: ToEndDate,
			autoclose: true
		}).on('changeDate', function(selected){
			FromEndDate = new Date(selected.date.valueOf());
			FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));
			$('#home_date_from').datepicker('setEndDate', FromEndDate);
		});
	});
	
	$( document ).ready(function() {
		$('#amount').keypress(function (event) {
			var key = window.event ? event.keyCode : event.which;
			if (event.keyCode == 8 || event.keyCode == 46 || event.keyCode == 37 || event.keyCode == 39) {
				return true;
			} else if ( key < 48 || key > 57 ) {
				return false;
			}
			else return true;
		});
		$('#cancel_calendar').click(function(){
			changeCalendar();
		});
		
		$('#valu1').click(function(){
			$('#price_li').toggle();
		});
		
		$('#valu2').click(function(){
			$('#price_li').toggle();
		});
		
		$('#save_calendar').click(function(){
			var home_date_from = $('#home_date_from').val();
			var home_date_to = $('#home_date_to').val();
			var productId = $('#productId').val();
			var selectedVal = "";
			var selected = $("#valu1:checked");
			if (selected.length > 0) {
				selectedVal = selected.val();
			}
			var selected = $("#valu2:checked");
			if (selected.length > 0) {
				selectedVal = selected.val();
			}
			var notes = $('#notes').val();
			var amount = $('#amount').val();
			if(amount == '' && selectedVal == 'available'){
				$('#amount').focus();
				return false;
			}
			if(notes == ''){
				$('#notes').focus();
				return false;
			}
			$.ajax({
				url: '<?php echo base_url();?>site/cms/save_calendar',
				type:"POST",
				data:{"home_date_from":home_date_from,"home_date_to":home_date_to, "productId":productId,"status":selectedVal, "amount":amount,"notes":notes},
				success:function(data){
					changeCalendar();
				}
			});
		});
		
		$('#home_date_from').change(function(){
			var home_date_from = $('#home_date_from').val();
			var home_date_to = $('#home_date_to').val();
			$.ajax(
			{
				type: 'POST',
				url: '<?php echo base_url();?>site/cms/get_time_stamp',
				data:{'home_date_from':home_date_from, 'home_date_to':home_date_to},
				dataType: 'json',
				success: function(response) 
				{
					$('.lhalf').remove();	
					$('.rhalf').remove();	
					$(".date-selected").removeClass('date-selected');
					$( '.current-date' ).each(function() {
						if(($(this).attr('id') <= response.to && $(this).attr('id') >= response.from) || ($(this).attr('id') >= response.to && $(this).attr('id') <= response.from)){
							$(this).addClass('date-selected');
							$(this).append( '<div class="lhalf"></div>' );	
							$(this).next().append( '<div class="rhalf"></div>' );	
						}
					});
				}
			});
		});
		
		$('#home_date_to').change(function(){
			var home_date_from = $('#home_date_from').val();
			var home_date_to = $('#home_date_to').val();
			$.ajax(
			{
				type: 'POST',
				url: '<?php echo base_url();?>site/cms/get_time_stamp',
				data:{'home_date_from':home_date_from, 'home_date_to':home_date_to},
				dataType: 'json',
				success: function(response) 
				{
					$('.lhalf').remove();	
					$('.rhalf').remove();	
					$(".date-selected").removeClass('date-selected');
					$( '.current-date' ).each(function() {
						if($(this).attr('id') <= response.to && $(this).attr('id') >= response.from){
							$(this).addClass('date-selected');
							$(this).append( '<div class="lhalf"></div>' );	
							$(this).next().append( '<div class="rhalf"></div>' );	
						}
					});
				}
			});

		});
	});
</script>
<?php if($error_message == '') {?>
<div class="calenderpopu">
	<ul class="calenderlite">
		<li>
			<input placeholder="dd/mm/yyyy" class="fromdate new_two_popup" id="home_date_from" value="<?php echo $startingDate;?>" type="text">
			<span><?php if($this->lang->line('to') != '') { echo stripslashes($this->lang->line('to')); } else echo "to";?></span> 
			<input placeholder="dd/mm/yyyy" id="home_date_to" value="<?php echo $endingDate;?>" class="todate new_two_popup" type="text">
		</li>
		<li>
			<div class="inputradios">
				<ul class="inputradioslist">
					<li>
						<input id="valu1" name="status" type="radio" value="available" checked="checked">
						<label for="valu1"><?php if($this->lang->line('Available') != '') { echo stripslashes($this->lang->line('Available')); } else echo "Available";?></label>
					</li>
					<li>
						<input id="valu2" name="status" value="unavailable" type="radio">
						<label for="valu2"><?php if($this->lang->line('Unavailable') != '') { echo stripslashes($this->lang->line('Unavailable')); } else echo "Unavailable";?></label>
					</li>
				</ul>
			</div>	
		</li>
		<li id="price_li">
			<div class="pricetags">
				<span class="pricetag_symbol"><?php echo $currencySymbol;?></span>
				<input type="text" id="amount" class="pricetag_rate" value="" maxlength="5">
				<label class="select_currency"><?php if($this->lang->line('per_night') != '') { echo stripslashes($this->lang->line('per_night')); } else echo "per night";?></label>
			</div>
		</li>
		<!--<li>
			<textarea class="textarelist" id="notes" placeholder="<?php if($this->lang->line('notes') != '') { echo stripslashes($this->lang->line('notes')); } else echo "notes..";?>"></textarea>
		</li>-->
		<li class="btngrp">
			<button class="savebnt" id="save_calendar"><?php if($this->lang->line('save') != '') { echo stripslashes($this->lang->line('save')); } else echo "Save";?></button>
			<button class="close-btn" id="cancel_calendar"><?php if($this->lang->line('Close') != '') { echo stripslashes($this->lang->line('Close')); } else echo "Close";?></button>
			
		</li>
	</ul>
</div>
<?php } else { ?>
<div class="calenderpopu">
	<ul class="calenderlite">
		<li>
			<input placeholder="dd/mm/yyyy" class="fromdate new_two_popup" id="home_date_from" value="<?php echo $startingDate;?>" type="text">
			<span><?php if($this->lang->line('to') != '') { echo stripslashes($this->lang->line('to')); } else echo "to";?></span> 
			<input placeholder="dd/mm/yyyy" id="home_date_to" value="<?php echo $endingDate;?>" class="todate new_two_popup" type="text">
		</li>
		<li>
			<div class="inputradios">
				<span><?php echo $error_message;?></span>
			</div>		
		</li>
		<li>
			<div class="inputradios"></div>		
		</li>
		<li class="btngrp">
			<button class="close-btn" id="cancel_calendar"><?php if($this->lang->line('Close') != '') { echo stripslashes($this->lang->line('Close')); } else echo "Close";?></button>
		</li>
	</ul>
</div>
<?php } ?>