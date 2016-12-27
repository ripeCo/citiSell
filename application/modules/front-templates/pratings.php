<?php

	$previewsql0 = $this->db->query("select * from mega_productreviews where shopid=$shopid and productid=$productid order by product_reviewid DESC LIMIT 50");
	
	$prevcsql0 = $this->db->query("select SUM(product_rating) as prate from mega_productreviews where shopid=$shopid and productid=$productid");
	
	if($prevcsql0->num_rows() >0){
		extract($prevcsql0->row_array());
	}
	
	$previewFetch0 = $previewsql0->result();
	
	$numrev0 = $previewsql0->num_rows();
	
	//$pratings = calculateStarRating($prate,$numrev);
	//echo $pratings;

	if($previewsql0->num_rows() >0){
		foreach($previewFetch0 as $prevviewShow0){
			
		$previewUsersql0 = $this->db->query("select display_name,user_picture from mega_users where userid=$prevviewShow0->userid");
	
		extract($previewUsersql0->row_array());
		
		//$pdtls = base_url().'page/view/product_details.php';
?>



<div class="rate_profile" id="result"><!-- Begin: rate_profile -->

	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
		<div class="rate_pic"><!-- Begin: rate_pic -->
			
			<a href="<?php echo base_url(); ?>page/user/userprofile/<?php echo $prevviewShow0->userid; ?>">
			
				<img src="<?php echo base_url(); ?>assets/frontend/images/users/<?php echo $user_picture; ?>" class="img-responsive img-rounded" alt="<?php echo $display_name; ?> profile picture" />
			
			</a>
			
			<h6 class="rate_pic_h6">Reviewed by</h6>
			
			<p class="rate_pic_p">
				
				<a href="<?php echo base_url(); ?>page/user/userprofile/<?php echo $prevviewShow0->userid; ?>">
					<?php echo $display_name; ?>
				</a>
				
			</p>
			
		</div><!-- End: rate_pic -->
	</div>
	
	<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
	
		<div class="rate_details"><!-- Begin: rate_details -->
		
			<div class="rate_icon">
			
				<div class="star_rate">
					
					<?php echo cuserreviewStarRating($prevviewShow0->product_rating); ?>
					
				</div>
				
				<div class="star_ratedate">
					<p class="star_ratedate_p">
						<?php echo $prevviewShow0->product_review_date; ?>
					</p>
				</div>
																				
			</div>
			
			<p class="rate_details_p">
				<?php echo $prevviewShow0->product_review_details; ?>
			</p>
			
		</div><!-- End: rate_details -->
		
	</div>
	
</div><!-- End: rate_profile -->

<?php
		}
	}
?>