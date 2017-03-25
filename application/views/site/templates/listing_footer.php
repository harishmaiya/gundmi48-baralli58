<!---FOOTER-->
<footer>
<div class="footer_inner">
	<div class="main_2">
    	
        <div class="footer_copyrights_links">
        	
        	<span><?php echo $this->config->item('footer_content');?></span>
        
        </div>
       			
        
        <div class="footer_inner_links">
        
        	<ul>
            
               <?php 
						if ($cmsList->num_rows() > 0){
							foreach ($cmsList->result() as $row){
								
								if(in_array($row->id,array('1','20','4','22','47')) && $row->hidden_page =='No' && $row->category == 'Main') {
						?>
                        
                        
                        
                        
                        
        	<li><a href="pages/<?php echo $row->seourl; ?>"><?php echo $row->page_name;?></a></li><?php } } } ?>
            <!--<li><a href="<?php echo base_url().'blog/'; ?>"><?php echo 'Blog';?></a></li>-->
                
        	</ul>
        
        </div>
        
        
                    <div class="language-curr-picker">
                   		 <div class="lang-selector btn-group btn-dropdown" >
                      <button class="btn gray dropdown-toggle" id="broswe_box4">
                        <i class="globe"></i>
                        <span class="value language">English </span> <span class="currency_arrow"><img src="images/drop_down_icon.png" /></span>
                      </button>
                          <ul class="dropdown-menu nav language-dropdown bottom-up" id="broswe_box_li" >
                            <?php 
                $selectedLangCode = $this->session->userdata('language_code');
                if ($selectedLangCode == ''){
                	$selectedLangCode = $defaultLg[0]['lang_code'];
                }
                if (count($activeLgs)>0){
                	foreach ($activeLgs as $activeLgsRow){
                ?>							
                    <li><a href="lang/<?php echo $activeLgsRow['lang_code'];?>" <?php if ($selectedLangCode == $activeLgsRow['lang_code']){echo 'class="selected"';}?>><?php echo $activeLgsRow['name'];?></a></li>
                <?php 
                	}
                }
                ?> 
                            
                          </ul>
                    </div>
          			</div>
        
    </div>
</div>
</footer>
<!---FOOTER-->
</body>
</html>