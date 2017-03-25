<?php 
print_r($reviewData);
?>
<ul class="list-paging">
<?php if($reviewData !=''){foreach($reviewData->result_array() as $review ):?>
<li>
<div class="peps">
<figure class="peps-area">
<img src="images/users/<?php if($review['image'] == '')echo "owner_img.png"; else echo $review['image']; ?>">
</figure>

<span class="johns"><b><?php echo $review['firstname']?><br/>(Your Review)</b></span>
</div>

<div class="listd-right">
<p><?php  $word1 = word_limiter($review['review'], 25);
          $word2 = word_limiter($review['review'], 25);
          echo $word1;
          //echo $word2;?></p>
<!--<a href="#">+ more</a>-->
<label class="date-year"><?php echo date('F Y',strtotime($review['dateAdded']));?></label>
</div>
<ul class="right-review">
<li><span style="padding-right:10px;">Accuracy</span><span class="review_img" ><img class="review_st" style="width:<?php echo $review['accuracy'] * 20?>%"></span></li>
<li><span style="padding-right:10px;">Location</span><span class="review_img" ><img class="review_st" style="width:<?php echo $review['location'] * 20?>%"></span></li>
<li><span style="padding-right:10px;">Communication</span><span class="review_img" ><img class="review_st" style="width:<?php echo $review['communication'] * 20?>%"></span></li>
<li><span style="padding-right:10px;">Check In</span><span class="review_img" ><img class="review_st" style="width:<?php echo $review['checkin'] * 20?>%"></span></li>
<li><span style="padding-right:10px;">Cleanliness</span><span class="review_img" ><img class="review_st" style="width:<?php echo $review['cleanliness'] * 20?>%"></span></li>
<li><span style="padding-right:10px;">Value</span><span class="review_img" ><img class="review_st" style="width:<?php echo $review['value'] * 20?>%"></span></li>
</ul>
</li>
<?php endforeach;}?>
</ul>