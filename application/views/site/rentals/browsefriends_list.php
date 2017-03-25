<?php 
//echo '<pre>';print_r($productList->result());die;
$this->load->view('site/templates/header');
?>
 
 
       <div class="yourlisting bgcolor">
<div class="top-listing-head">
 <div class="main">   
           <ul id="nav">
                <li><a href="<?php echo base_url(); ?>popular" class="write_title"><?php if($this->lang->line('popular') != '') { echo stripslashes($this->lang->line('popular')); } else echo "Popular"; ?></a></li>
          <?php if($loginCheck!=''){ ?>
          <li class="active"><a href="<?php echo base_url(); ?>browsefriends" class="write_title"><?php if($this->lang->line('Friends') != '') { echo stripslashes($this->lang->line('Friends')); } else echo "Friends"; ?></a></li>
          <li><a href="<?php echo base_url(); ?>users/<?php echo $loginCheck; ?>/wishlists" class="write_title"><?php if($this->lang->line('MyWishLists') != '') { echo stripslashes($this->lang->line('MyWishLists')); } else echo "My Wish Lists"; ?></a></li>
          <?php } ?>
              <li></li>
            </ul> </div></div></div>     
            
<div class="body_content">
	


<section>


<div class="container">


<div class="banner-container browsefriendsbannner">
    <div class="row">
        <div class="col-md-12">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
              
                <ul class="carousel-inner">
                    <li class="item active">
                        <img src="images/brwse.png" alt="First slide">
                        
                    </li>
                 
                </div>
              <!--  <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                    <span class="left-ars"></span></a>

                    <a class="right carousel-control"
                        href="#carousel-example-generic" data-slide="next"><span class="right-ars">
                        </span></a>-->
            </ul>
            <div class="main-text hidden-xs">
                <div class="col-md-12 text-center">

                    <div class="container">
                    <h1 class="listing-text"><?php if($this->lang->line('invite_friends_detail') != '') { echo stripslashes($this->lang->line('invite_friends_detail')); } else echo "See the listings your friends are saving to their Wish Lists."; ?></h1>
                   
                    <a class="faced" href="invite-friends"><img src="images/face.png"></a>
            </div>
        </div>

         </div>
    </div>
</div>
<div id="push">
</div>
</div>

</section>
</div>

<?php 
 $this->load->view('site/templates/footer');
?>


