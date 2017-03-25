<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Edit City Name</h6>
                        <div id="widget_tab">
              				<ul>
               					 <li><a href="#tab1" class="active_tab">Content</a></li>
               					 <li><a href="#tab2">SEO</a></li>
             				 </ul>
            			</div>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'commentForm','enctype' => 'multipart/form-data');
						echo form_open('admin/neighborhood/insertEditneighborhood',$attributes) 
					?> 		
                    	<div id="tab1">
	 						<ul>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="name">City Name<span class="req">*</span></label>
									<div class="form_input">
                                    <input name="name" style=" width:295px" id="name" value="<?php echo $city_details->row()->name; ?>" type="text" tabindex="1" class="required tipTop" title="Please enter the city"/>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="neighborhoods">Primary Neighborhood Name<span class="req">*</span></label>
									<div class="form_input">
                                        <select class="required chzn-select " name="neighborhoods" tabindex="1" style="width: 375px;" data-placeholder="Please select the primary neighborhood name" > 
                                            <option value=""></option>
                                        	<?php foreach ($PrimaryNhDisplay as $row){?>
                                            <option value="<?php echo $row['id'];?>" <?php if($city_details->row()->neighborhoods==$row['id']){echo 'selected="selected"';} ?>><?php echo $row['name'];?></option>
                                        	<?php }?>
                                        </select>
                                    </div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="citylogo">Logo (Image Size 1300px X 700px)<span class="req">*</span></label>
									<div class="form_input">
                                    <input name="citylogo" id="citylogo" type="file" tabindex="5" class="large tipTop" title="Please select the logo image"/>
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Logo Image (Image Size 315px X 165px)</label>
									<div class="form_input">
                                    <img src="images/city/<?php echo $city_details->row()->citylogo;?>" width="50px" height="50px"  />
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="citythumb">image<span class="req">*</span></label>
									<div class="form_input">
                                   <input name="citythumb" id="citythumb" type="file" tabindex="5" class="large tipTop" title="Please select the thumb image"/>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">image image</label>
									<div class="form_input">
                                    <img src="images/city/<?php echo $city_details->row()->citythumb;?>" width="50px" height="50px"  />
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Tags </label>
									<div class="form_input">
										<input id="tags_1" type="text" name="tags" class="tags" value="<?php echo $city_details->row()->tags;?>"/>
									</div>
								</div>
								</li>
                                
                               <li>
                                  <div class="form_grid_12">
                                    <label class="field_title" for="short_description">Short Description</label>
                                    <div class="form_input">
                                      <textarea name="short_description" id="short_description" class="large tipTop" title="Please enter the short description"><?php echo $city_details->row()->short_description;?></textarea>
                                    </div>
                                  </div>
                                </li>
                                <li>
                                  <div class="form_grid_12">
                                    <label class="field_title" for="description">Description</label>
                                    <div class="form_input">
                                      <textarea name="description" id="description" class="large tipTop mceEditor" title="Please enter the description"><?php echo $city_details->row()->description; ?></textarea>
                                    </div>
                                  </div>
                                </li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="category">Category</label>
									<div class="form_input">
                                        <select class="required chzn-select " name="category[]" multiple="multiple" tabindex="1" style="width: 375px;" data-placeholder="Please select the neighborhood category">
                                                <?php $categoryNArr=@explode(',',$city_details->row()->category);if($categoryArr->num_rows() > 0){foreach ($categoryArr->result() as $row){?>
                                                    <option value="<?php echo trim(stripslashes($row->attr_name));?>" <?php if(in_array($row->attr_name,$categoryNArr)){echo 'selected="selected"';} ?> ><?php echo $row->attr_name;?></option>
                                                <?php }}?>
                                        </select>
                                    </div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="featured">Featured Neighborhood </label>
									<div class="form_input">
										<div class="yes_no">
											<input type="checkbox" name="featured" id="1_0_1" class="yes_no"  <?php if ($city_details->row()->featured == '1'){echo 'checked="checked"';}?>/>
										</div>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status <span class="req">*</span></label>
									<div class="form_input">
										<div class="active_inactive">
											<input type="checkbox" tabindex="7" name="status" id="active_inactive_active" class="active_inactive" <?php if ($city_details->row()->status == 'Active'){echo 'checked="checked"';}?>  />
										</div>
									</div>
								</div>
								</li>
								<input type="hidden" name="city_id" value="<?php echo $city_details->row()->id;?>"/>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue" tabindex="4"><span>Submit</span></button>
									</div>
								</div>
								</li>
							</ul>
                        </div>
                       <div id="tab2">
              <ul>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_title">Meta Title</label>
                    <div class="form_input">
                      <input name="meta_title" id="meta_title" value="<?php echo $city_details->row()->meta_title;?>" type="text" tabindex="1" class="large tipTop" title="Please enter the page meta title"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_tag">Meta Keyword</label>
                    <div class="form_input">
                      <textarea name="meta_keyword" id="meta_keyword" tabindex="2" class="large tipTop" title="Please enter the page meta keyword"><?php echo $city_details->row()->meta_keyword;?></textarea>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_description">Meta Description</label>
                    <div class="form_input">
                      <textarea name="meta_description" id="meta_description" tabindex="3" class="large tipTop" title="Please enter the meta description"><?php echo $city_details->row()->meta_description;?></textarea>
                    </div>
                  </div>
                </li>
              </ul>
             <ul><li><div class="form_grid_12">
				<div class="form_input">
					<button type="submit" class="btn_small btn_blue" tabindex="4"><span>Submit</span></button>
				</div>
			</div></li></ul>
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