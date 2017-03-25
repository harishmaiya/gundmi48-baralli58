<?php

if(!empty($values))
{
 foreach($values as $row){?>
							<div class="accordion-group">
								<div class="accordion-heading">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#leftMenu" href="#<?php echo $row['id']; ?>">
									<?php echo $row['question'];?>? <span style="float:right;"><img src="<?php echo base_url();?>images/small-arrow.png"></span>
									</a>
								</div>
								<div id="<?php echo $row['id']; ?>" class="accordion-body collapse" style="height: 0px; ">
									<div class="accordion-inner-content">
										<!--<ul>
											<li>This is one</li>
											<li>This is two</li>
											<li>This is Three</li>
										</ul>-->
										
										
										
										<div class="col-md-11" style="color: #333333;font-family: 'Conv_DaxLight';font-size: 14px;line-height: 22px;">
											
											<p>
												<?php echo $row['answer']; ?>
											</p>
										</div>
										
									</div>
								</div>
							</div>
<?php }}
else
{
?><p style="color: #333333;font-family: 'Conv_DaxLight';font-size: 14px;line-height: 22px;"><?php
if($this->lang->line('no_answers_found') != '') { echo stripslashes($this->lang->line('no_answers_found')); } else echo "No Result Found!";
?></p><?php
}
?>	