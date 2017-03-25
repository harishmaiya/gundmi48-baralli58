<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Add New Currency</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'commentForm');
						echo form_open(ADMIN_PATH.'/currency/insertEditCurrency',$attributes) 
					?> 		
                    	<div id="tab1">
	 						<ul>
							    <li>
								    <div class="form_grid_12">
									    <label class="field_title" for="location_name">Country Name <span class="req">*</span></label>
									    <div class="form_input">
										    <select name="country_name" style=" width:295px; height:25px;" id="name" title="Please select country" tabindex="1" class="required tipTop">
											<option value="">Select Country</option>
											<?php if($countryList->num_rows() >0){
											      foreach($countryList->result() as $get_list){?>
												      <option value="<?php echo $get_list->name?>"><?php echo $get_list->name?></option>     
										    <?php } }?>
											</select>
									    </div>
								    </div>
								</li>
                                <li>
								    <div class="form_grid_12">
									    <label class="field_title" for="currency_symbol">Currency Symbol<span class="req">*</span></label>
									    <div class="form_input">
                                            <input name="currency_symbols" style=" width:295px" id="currency_symbol" type="text" tabindex="1" class="required tipTop" title="Please enter the currency symbol"/>
									    </div>
								    </div>
								</li>
                                <li>
								    <div class="form_grid_12">
									    <label class="field_title" for="currency_type">Currency Code<span class="req">*</span></label>
									    <div class="form_input">
                                            <input name="currency_type" style=" width:295px" id="currency_type" type="text" tabindex="1" class="required tipTop" title="Please enter the currency Code"/><br /><br />
                                            <span style="font-size:14px; color:#CC3300;" >*Note: Add the currency code accept by Paypal, to view the currency codes click the Below link,<br /><br /> <a href="javascript: void(0)" onclick="window.open('https://developer.paypal.com/webapps/developer/docs/classic/api/currency_codes/ ', 'Paypal Currency Code', 'width=1200, height=1200'); 
                                             return false;">https://developer.paypal.com/webapps/developer/docs/classic/api/currency_codes/ </a></span>
									    </div>
								    </div>
								</li>
                                <li>
								    <div class="form_grid_12">
									    <label class="field_title" for="currency_type">1 USD($)<span class="req">*</span></label>
									    <div class="form_input">
                                            <input name="currency_rate" style=" width:295px" id="currency_rate" type="text" tabindex="1" class="required number tipTop" title="Please enter the currency rate"/>
									    </div>
								    </div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status <span class="req">*</span></label>
									<div class="form_input">
										<div class="active_inactive">
                                        <input type="checkbox" name="status" checked="checked" id="active_inactive_active" class="active_inactive"/>
										</div>
									</div>
								</div>
								</li>
								<!--<input type="hidden" name="location_id" value=""/>-->
								<li>
								    <div class="form_grid_12">
									    <div class="form_input">
										    <button type="submit" class="btn_small btn_blue" tabindex="4"><span>Submit</span></button>
									    </div>
								    </div>
								</li>
							</ul>
                        </div>

						</form>
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>