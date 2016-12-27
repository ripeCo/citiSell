<div id="navigation"><!-- Begin: navigation -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              
				<div id="cnav-header" class="ui-toolkit cnav-header hide-xs">
				  <div id="cnav-header-inner" class="body-max-width cnav-header-inner position-relative col-group">
					
					<!-- Main Menus html being-->
					<nav class="catnav-primary display-block no-wrap bg-white col-xs-12">
					  <ul class="pl-xs-0">
						
						<!-- Get Query for all Main Menus -->
						<?php
							$this->load->model('navigation_model');
							$mainmenusArray = array( 7001 => 'Clothing & Accessories', 7002 => 'Hand made Jewelry', 7003 => 'Handicraft Supplies', 7004 => 'Weddings', 7005 => 'Cosmetics', 7006 => 'Living & Home', 7007 => 'Kids Need', 7008 => 'Vintage');
				
							foreach($mainmenusArray as $key1 => $values1){
						?>
						
						<li id="catnav-primary-link-<?php echo $key1; ?>" data-node_id="<?php echo $key1; ?>" class="catnav-primary-item list-inline-item"> 
							<a class="text-gray" href="#"><?php echo $values1; // Show Name of Main Menus ?></a> 
						</li>
						
						<?php } ?>
						
					  </ul>
					</nav>
					
					<!-- Main Menus html end-->
					
					
					<div id="catnav-dropdown" class="catnav-dropdown position-absolute col-xs-12 col-centered display-none">
					  <div class="catnav-dropdown-inner vertical-align-top bg-white overflow-hidden bl-xs-1 bb-xs-1 br-xs-1 bt-xs-1">
						
						
						<!-- Main Menus Under Category html Being-->
						
						<!-- Get Query for all category under by Main Menus -->
                        <?php
									
							foreach($mainmenusArray as $key001 => $values001){
						?>
						<div class="category-container category-<?php echo $key001; ?> width-full has-sidebar has-finds-promo display-none">
						
						<aside id="catnav-sidebar" class="catnav-sidebar col-xs-3 br-xs-1 display-inline-block pl-xs-0 pr-xs-0 pt-xs-2 pb-xs-3 has-finds-promo">
							<ul class="catnav-sidebar-list list-nav list-unstyled text-gray-lightest">
							  
								<!-- Get Query for all category under by Main Menus -->
								<?php
									$catview =	$this->navigation_model->category($values001,1); // Get Category where status is 1
									foreach($catview as $value2){
										
										$c0atid = $key001.$value2->category_id;
								?>
								
								<li id="category-nav-side-nav-<?php echo $c0atid; ?>" data-node_id="<?php echo $c0atid; ?>" class="sidenav-text-link list-nav-item p-xs-0 active">
								    <a class="pr-xs-3 pl-xs-2 pl-md-3 pt-xs-1 pb-xs-1 display-block" href="<?php echo base_url(); ?>page/category/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $value2->category_name))));  ?>/<?php echo $value2->category_id;  ?>">
									
										<?php echo $value2->category_name; /* Echo Category Names */  ?>
										<span class="pl-xs-6 sidenav-icon ss-navigateright text-gray-lightest"></span>
										
									</a>
								</li>
								
								<?php } ?>
							  
							</ul>
						</aside>
						  
						  <section class="catnav-subcategories col-xs-8 col-lg-9 pl-xs-3 pr-xs-3 pt-xs-2 vertical-align-top height-full display-inline-block">
							
							<!-- Get Query for all category under by Main Menus -->
							<?php
								$catview003 =	$this->navigation_model->category($values001,1); // Get Category where status is 1
								foreach($catview003 as $value003){
								
								$cccatid = $key001.$value003->category_id;
							?>
							<div class="catnav-tertiary col-xs-12 pb-xs-3 pl-xs-0 mb-xs-3 pr-xs-0 category-<?php echo $cccatid; ?>">
							 
								<ul class="list-unstyled display-inline-block col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xl-8 pl-xs-0 catnav-dropdown-multi-column-list">
									
									<?php
										// Gel All Subcategory According to CategoryID
										$query = $this->db->query("SELECT * FROM mega_subcategory where category_id=$value003->category_id and sub_cat_status=1");
										$results = $query->result();

										foreach ($results as $row){
										
										$subcatid = $key001.$value003->category_id.$row->sub_category_id;
									?>
									
									<li id="catnav-l3-<?php echo $subcatid; ?>" data-node_id="<?php echo $subcatid; ?>" class="col-xs-12 pl-xs-0">
										<a class="text-gray display-block pt-xs-1 pb-xs-1" href="<?php echo base_url(); ?>page/subcategory/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $value003->category_name))));  ?>/<?php echo $value003->category_id;  ?>/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $row->sub_category_name))));  ?>/<?php echo $row->sub_category_id; ?>">
										
											<?php echo $row->sub_category_name; ?>
										</a>
										
										<?php
											// Gel All Subcategory According to CategoryID
											$query2 = $this->db->query("SELECT * FROM mega_subcategorylevel2 where sub_category_id=$row->sub_category_id and sub_cat_lev2_status=1");
											$results2 = $query2->result();
											
											if( $query2->num_rows() > 0 ){
												
												echo '<ul class="list-unstyled catnav-dropdown-text-small">';
												
												foreach ($results2 as $row2){
												$lev2subcatid = $key001.$value003->category_id.$row->sub_category_id.$row2->sub_category_lev2_id;
											?>
												<li id="catnav-l4-<?php echo $lev2subcatid; ?>" data-node_id="<?php echo $lev2subcatid; ?>">
													
													<a class="text-gray-lighter display-block pt-xs-1 pb-xs-1 pl-xs-2" href="<?php echo base_url(); ?>page/subcategorylev2/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $value003->category_name))));  ?>/<?php echo $value003->category_id;  ?>/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $row->sub_category_name))));  ?>/<?php echo $row->sub_category_id; ?>/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $row2->sub_category_lev2_name))));  ?>/<?php echo $row2->sub_category_lev2_id; ?>">
														
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
								
							  
								<div style="height: 438px;" class="finds-promo-container pt-xs-3 pr-xs-0 pb-xs-1 display-inline-block float-right  col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">

									<a href="http://www.citisell.com/" class="finds-promo display-block parent-hover-underline position-relative height-full bg-white bl-xs-1 pl-xs-3">
									
									<div class="finds-promo-image-container img-hover-effect">
										<img src="<?php echo base_url(); ?>assets/frontend/images/interface/logo.png" alt="Spring fashion accessories" class="finds-promo-image display-block" width="100%">
									</div>
									
									<div class="finds-promo-text  pt-xs-2">
									  <div class="finds-promo-name text-gray-lighter text-smaller">CitiSell</div>
									  <div class="finds-promo-title child-hover-underline h2 text-gray-darker" style="font-size:18px;">Stick in with CitiSell.com</div>
									</div>
									
									</a>
									
								</div>
							</div>
							
							<?php } ?>
							
							
							
						  </section>
						</div>
						
						<?php } ?>
						<!-- Main Menus Under Category html end-->
						
						
					  </div>
					</div>
				  </div>
				</div>
			  
            </div>
        </div>
    </div>
</div><!-- End: navigation -->


<!-- END: common notifiocations -->
<?php  //} ?>