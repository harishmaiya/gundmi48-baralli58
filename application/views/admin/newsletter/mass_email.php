<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6><?php echo $heading;?></h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'mass_email');
						echo form_open('admin/newsletter/mass_email',$attributes) 
					?>
	 						<ul>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="news_title">Email To <span class="req">*</span></label>
									<div class="form_input">
                                    <input type="radio" name="mail_to" value="all" id="all_user">All User
									<input type="radio" name="mail_to" value="particular" id="particular_user">Particular Users
									</div>
								</div>
								</li>
								<li id="particular_user_detail" style="display:none;">
								<div class="form_grid_12">
									
									<div class="form_input">
                                    <select name="email_list[]" multiple="multiple">
									<?php foreach($user_emails as $user_email) :?>
									<option value="<?php echo $user_email->email;?>"><?php echo $user_email->firstname.' '.$user_email->lastname;?></option>
									<?php endforeach;?>
									</select>
									</div>
								</div>
								</li>
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="subject">Subject<span class="req">*</span></label>
									<div class="form_input">
                                    <input name="subject" style=" width:295px" id="subject" type="text" tabindex="1" value="" class="required tipTop" title="Please enter the subject"/>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="message">Message <span class="req">*</span></label>
									<div class="form_input">
                                    <textarea cols="60" rows="10" class="tipTop mceEditor" name="message" id="message_content"></textarea>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue" tabindex="4"><span>Submit</span></button>
									</div>
								</div>
								</li>
							</ul>
						</form>
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
<script type="text/javascript">
$('#all_user').click(function()
{
$('#particular_user_detail').hide();
});
$('#particular_user').click(function()
{
$('#particular_user_detail').show();
});

$(document).ready(function()
{
if($('#particular_user').is(':checked')==true)
{
$('#particular_user_detail').show();
}
});
</script>
<?php 
$this->load->view('admin/templates/footer.php');
?>