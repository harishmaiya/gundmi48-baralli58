<?php 
$this->load->view('site/templates/header');
?>
<script src="js/site/<?php echo SITE_COMMON_DEFINE ?>jquery-ui-1.8.18.custom.min.js"></script>
<script type="text/javascript">
    jQuery(document).ready( function () {
        $(".datepicker").datepicker({ minDate:0, dateFormat: 'yy-mm-dd'});
    });
</script>
<script src="js/site/<?php echo SITE_COMMON_DEFINE ?>new.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="css/site/<?php echo SITE_COMMON_DEFINE ?>new.css" />
<link rel="stylesheet" type="text/css" media="all" href="css/site/<?php echo SITE_COMMON_DEFINE ?>jquery-ui-1.8.18.custom.css" />
<div class="top_search">
    <div class="main">
        <?php echo form_open(base_url('city/search'),array('class'=>'custom show-search-options position-left search-area','method'=>'get','style'=>'position:static; margin:0','id'=>'search_form')); ?>
            <span style="float:left; text-shadow:none; font-weight:bold; margin:10px 10px 0 100px">Search for</span>
            <div class="input-wrapper">
              <input type="text" placeholder="Where do you want to go?" value="<?php if($_GET['city']!='')  echo $_GET['city']; ?>"  name="city" id="location" autocomplete="off" class="location">
              <div class="for_auto_search"></div>
            </div>
          <!--  <div class="input-wrapper">
              <input type="text" class="location" autocomplete="off" id="property" name="location" placeholder="Property ID"  />
            </div>-->
            <div class="input-wrapper" id="checkinWrapper">
              <input type="text" placeholder="Arrival" name="datefrom" value="<?php if($_GET['datefrom']!='')  echo $_GET['datefrom']; ?>" class="checkin search-option datepicker" id="checkin">
              <span class="search-area-icon"></span> </div>
            <div class="input-wrapper" id="checkoutWrapper">
              <input type="text" placeholder="Departure" name="expiredate" value="<?php if($_GET['expiredate']!='')  echo $_GET['expiredate']; ?>"  class="checkout search-option datepicker" id="checkout">
              <span class="search-area-icon"></span></div>
            <input type="submit" value="Search" style="border:none;" class="large pink btn icon-and-text position-left">
          </form>
           <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>"  />
    </div>
</div>
<div id="content">
    <div class="top_search">
        <div class="bread_crumb">
            <div class="main">
                <ul class="sort_filter">
                    <li>
                        <label>Price :</label>
                        <select class="text_filter price-range">
                            <option value="">Any</option>
                              <option value="1-20"><?php echo $currencySymbol;?>1-20</option>
                              <option value="21-100"><?php echo $currencySymbol;?>21-100</option>
                              <option value="101-200"><?php echo $currencySymbol;?>101-200</option>
                              <option value="201-500"><?php echo $currencySymbol;?>201-500</option>
                              <option value="501+"><?php echo $currencySymbol;?>501+</option>
                        </select>
                    </li>
                    <li>
                        <label>Bedrooms :</label>
                        <select class="text_filter">
                            <option>Any</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4+</option>
                        </select>
                    </li>
                    <li>
                        <label>Sleeps :</label>
                        <select class="text_filter">
                            <option>Any</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                        </select>
                    </li>
                    <li>
                        <label>Type :</label>
                        <select class="text_filter">
                            <option>Any</option>
                            <option>Condo/Townhouse</option>
                            <option>Multi-Family</option>
                            <option>Single Family</option>
                        </select>
                    </li>
                </ul>
                <ul class="list_by">
                    <a href="#" class="li_active"><li style="background:url(images/list.png) no-repeat left">List</li></a>
                    <a href="#"><li style="background:url(images/bymap.png) no-repeat left">Map</li></a>
                </ul>
            </div>
        </div>
    </div>
    <!--selection-->
    <!--body content-->
   
    <section>
        <div class="main">
            <div class="welcome_div" style="margin:20px 0 10px">
                <div class="page_title W99">Agadir - 3 Vacation Rentals</div>
                <div id="searchblock" class="search_right W99">
                <ul id="results" class="unstyled">
                    <?php 
                    $products = $productList->result();
                    if(!empty($products))
                    {
                        //$imageTotalArray = $image_count->result_array();
                        foreach($products as $product)
                        {
                            $count = 0;
                            foreach($imageTotalArray as $imageOne)
                            {
                                if($imageOne['product_id'] == $product->id)
                                {
                                    $count = $imageOne['count_image'];  
                                }
                            }
                            /*foreach($product_image->result() as $productImag)
                            {
                                 if($product->id==$productImag->product_id)
                                 {  
                                    $image = img(array('src'=>base_url('images/product/'.$productImag->product_image),'width'=>'192','height'=>'113'));
                                 }
                             }*/
                            echo '<li class="search_result">
                        <div class="pop_image_small">
                            <a href="'.base_url('room/'.$product->seourl).'">                          
                                <div class="list-media-box">'.$image.'
                                  <div class="listing-count2 panel-background-dark-trans panel-border">'.$count.' Photos</div>
                                </div>
                            </a>
                        </div>
                        <div class="room_right">
                        <h3 class="room_title overflow-ellipsis">
                            <a href="'.base_url('room/'.$product->seourl).'">'.stripslashes($product->product_title).'</a>
                        </h3>
                        <ul class="reputation unstyled">
                                <li class="badge badge_type_reviews-bubble">
                                    <span class="badge_image">
                                        <span class="badge_text reviews-bubble">1</span>
                                    </span>
                                    <span class="badge_name">Bedrooms</span>
                                </li>
                                <li class="badge badge_type_reviews-bubble">
                                    <span class="badge_image">
                                        <span class="badge_text reviews-bubble">1</span>
                                    </span>
                                    <span class="badge_name">Bathrooms</span>
                                </li>
                                <li class="badge badge_type_reviews-bubble">
                                    <span class="badge_image">
                                        <span class="badge_text reviews-bubble">13</span>
                                    </span>
                                    <span class="badge_name">Sleeps</span>
                                </li>
                                
                        </ul>
                        <div class="price ">
                            <div class="price_data">$'.$product->price.'</div>
                        </div>
                        <ul class="room_btn">
                            <li>'.anchor(base_url('room/'.$product->seourl),'Details',array('class'=>'submit_btn')).'</li>
                            <li><a href="#" class="submit_btn">Reviews</a></li>
                        </ul>
                        </div>
                    </li>';
                        }
                    }
                    else
                    {
                        echo '<li><center>No Rooms found</center></li>';    
                    }
                    ?>
                    
                </ul>
           </div>
            </div>
        </div>
    </section>
</div>
<script src="js/site/shoplist.js" type="text/javascript"></script>
<?php 
$this->load->view('site/templates/footer');
?>