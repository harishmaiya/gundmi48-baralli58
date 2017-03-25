<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>View Currency</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label');
						echo form_open(ADMIN_PATH,$attributes) 
					?>
	 						<ul>
                            	<li>
								<div class="form_grid_12">
									<label class="field_title" for="location_name">Country Name</label>
									<div class="form_input">
                                    <?php echo $currency_details->row()->country_name;?>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="country_tax">Currency Symbol</label>
									<div class="form_input">
                                   <?php echo $currency_details->row()->currency_symbols;?>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="country_tax">Currency Rate</label>
									<div class="form_input">
                                   <?php echo $currency_details->row()->currency_rate;?>
									</div>
								</div>
								</li>
	 							<li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_title">Currency Type</label>
                    <div class="form_input">
                      <?php echo $currency_details->row()->currency_type;?>
                    </div>
                  </div>
                </li>
 
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<a href="<?php echo ADMIN_PATH;?>/currency/display_currency_list" class="tipLeft" title="Go to currency list"><span class="badge_style b_done">Back</span></a>
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
<?php 
$this->load->view('admin/templates/footer.php');
?>