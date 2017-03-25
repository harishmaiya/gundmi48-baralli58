<div class="widget_content">
                  <table class="display display_tbl" id="image_tbl">
                    <thead>
                      <tr align="center">
                        <th > Sno </th>
                        <th> Image </th>
                        <!--<th> Position </th>-->
                        <th> Action </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
					      // echo "<pre>";print_r($imgDetail->result_array());
							if (!empty($imgDetail) && !empty($product_details)){
								$i=0;$j=1;
								$this->session->set_userdata(array('product_image_'.$product_details->row()->id => $product_details->row()->image));
								foreach ($imgDetail->result() as $img){
									if ($img != ''){
							?>
                      <tr id="img_<?php echo $img->id ?>">
                        <td class="center tr_select "><input type="hidden" name="imaged[]" value="<?php echo $img->product_image; ?>"/>
                          <?php echo $j;?> </td>
                        <td class="center "><img src="<?php if(($img->product_image!='') &&(file_exists('./server/php/rental/thumbnail/'.$img->product_image)))
           { echo base_url();?>server/php/rental/thumbnail/<?php echo $img->product_image; } else { echo base_url();?>server/php/rental/<?php echo $img->product_image; } ?>"  height="80px" width="80px" /> </td>
<!--                        <td class="center"><span>
                          <input type="text" style="width: 15%;" name="changeorder[]" value="<?php echo $i; ?>" size="3" />
                          </span> </td>
-->                        <td class="center tr_select"><ul class="action_list" style="background:none;border-top:none;">
                            <li style="width:100%;"><a class="p_del tipTop" href="javascript:void(0)" onClick="javascript:DeleteProductImage(<?php echo $img->id; ?>,<?php echo $product_details->row()->id; ?>);" title="Delete this image">Remove</a></li>
                          </ul></td>
                      </tr>
                      <?php 
							$j++;
									}
									$i++;
								}
							}
							?>
                    </tbody>
                    <tfoot>
                      <tr align="center">
                        <th> Sno </th>
                        <th> Image </th>
                        <!--<th> Position </th>-->
                        <th> Action </th>
                      </tr>
                    </tfoot>
                  </table>
                </div>