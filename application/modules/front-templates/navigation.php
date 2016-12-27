<div id="navigation"><!-- Begin: navigation -->
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<ul id="nav">

					<!-- Get Query for all Main Menus -->
					<?php
						$this->load->model('navigation_model');
						$mainmenusArray = array( 1 => 'Clothing & Accessories', 2 => 'Hand made Jewelry', 3 => 'Handicraft Supplies', 4 => 'Weddings', 5 => 'Living & Home', 6 => 'Vintage', 7 => 'Cosmetics', 8 => 'Kids Need');
			
						foreach($mainmenusArray as $key1 => $values1){
					?>
						
					<li class="yahoo <?php if($key1 == 1){echo 'acttive'; } ?>">
					<a href="#"><?php echo $values1; ?>  &raquo;</a>
						
						
						<ul>
							
							<!-- Get all category under by Main Menus -->
							<?php
								$catview =	$this->navigation_model->category($values1,1); // Get Category where status is 1
								foreach($catview as $value2){
									
									$c0atid = $key001.$value2->category_id;
							?>
								
							<li>
							<a href="<?php echo base_url(); ?>page/category/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $value2->category_name))));  ?>/<?php echo $value2->category_id;  ?>">
								
								<?php echo $value2->category_name; /* Echo Category Names */  ?>
								
								<?php
									// Gel All Subcategory According to CategoryID
									$query = $this->db->query("SELECT * FROM mega_subcategory where category_id=$value2->category_id and sub_cat_status=1");
									$results = $query->result();
									
									if($query->num_rows() > 0){ echo '&raquo;'; }
								?>
								 
							</a>            
								
								<?php
											
									if( $query->num_rows() > 0 ){
								?>
								<ul>
									<?php
										foreach ($results as $row){
										
										$subcatid = $key001.$value2->category_id.$row->sub_category_id;
									?>
									
										<li>
											<a href="<?php echo base_url(); ?>page/subcategory/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $value2->category_name))));  ?>/<?php echo $value2->category_id;  ?>/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $row->sub_category_name))));  ?>/<?php echo $row->sub_category_id; ?>">
											
												<?php echo $row->sub_category_name; ?>
										
											<?php
												// Gel All Subcategory According to CategoryID
												$query2 = $this->db->query("SELECT * FROM mega_subcategorylevel2 where sub_category_id=$row->sub_category_id and sub_cat_lev2_status=1");
												$results2 = $query2->result();
												
												if($query2->num_rows() > 0){ echo '&raquo;'; }
											?>
												
											</a>
											
											<?php
											
												if( $query2->num_rows() > 0 ){
													
													echo '<ul>';
													
													foreach ($results2 as $row2){
													$lev2subcatid = $key001.$value2->category_id.$row->sub_category_id.$row2->sub_category_lev2_id;
											?>
											
												<li>
													
													<a href="<?php echo base_url(); ?>page/subcategorylev2/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $value2->category_name))));  ?>/<?php echo $value2->category_id;  ?>/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $row->sub_category_name))));  ?>/<?php echo $row->sub_category_id; ?>/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $row2->sub_category_lev2_name))));  ?>/<?php echo $row2->sub_category_lev2_id; ?>">
														<?php echo $row2->sub_category_lev2_name; ?>
													</a>
													
												</li>
												
											<?php
													}
													
													echo '</ul>';
													
												}
											?>
											
										</li>
									
									<?php } ?>
									
								</ul>
								
								<?php } ?>
								
							</li>
							
							<?php } ?>
							
						</ul>
						
					</li> 
					
					<?php
						}
					?>
					
					
					<!--li class="facebook"><a href="#">Facebook</a>
						<ul>
						<li><a href="#">Facebook Pages</a></li>
						<li><a href="#">Facebook Groups</a></li>
						</ul>
					</li>
					<li class="google"><a href="#">Google</a>
						<ul>
						<li><a href="#">Google mail</a></li>
						<li><a href="#">Google Plus</a></li>
						<li><a href="#">Google Search &raquo;</a>
							<ul>
								<li><a href="#">Search Images</a></li>
								<li><a href="#">Search Web</a></li>
							</ul>
						</li>
						</ul>
					</li>
					<li class="twitter"><a href="#">Twitter</a>
							<ul>
								<li><a href="#">New Tweets</a></li>
								<li><a href="#">Compose a Tweet</a></li>
							</ul>
					</li>
					
				</ul-->
			</div>
        </div>
    </div>
</div><!-- End: navigation -->



<?php if( $this->session->userdata('isLogin') == True AND $this->session->userdata('shopopen') !== 0){ ?>

<?php
	if($this->session->userdata('shopopen') == NULL || $this->session->userdata('shopopen') == ''){
		$s0id = rand(1,7);
	}else{
		$s0id = $this->session->userdata('shopopen');
	}
	
	$numofproducts0 = $this->db->query("select * from mega_products where shopid=$s0id and product_renew=0");
	$numofListing0 = $numofproducts0->num_rows();
	
	if($numofListing0 > 0){
?>
			
<div class="container">
	<div class="row">
		
		<div style="background:#f00; color: #fff !important; font-size: 25px; padding: 10px; text-align: center; margin:10px 0;">
			
								
			<p>May you have <?php echo '('.$numofListing0.')'; ?> Listing Items already expired and deactivated!</p>
			
			<p>If you want to sell these items you should renew items.</p>
			
			<p> <a class="btn btn-success" href="<?php echo base_url(); ?>page/yourshop/listingrenew">Click for Renew</a> </p>
			
		</div>
	
	</div>
</div>


<?php } } ?>
