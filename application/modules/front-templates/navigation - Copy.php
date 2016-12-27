<div id="navigation"><!-- Begin: navigation -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div id="menuMega" class="menu3dmega">
                
				<ul>
                    
                <!-- Get Query for all Main Menus -->
                <?php
                    $this->load->model('navigation_model');
                    $mainmenusArray = array( 1 => 'Clothing & Accessories', 2 => 'Jewelry', 3 => 'Craft Supplies & Tools', 4 => 'Weddings', 5 => 'Entertainment', 6 => 'Home & Living', 7 => 'Kids & Baby', 8 => 'Vintage');
		
                    foreach($mainmenusArray as $key1 => $values1){
                ?>
					
                  <li class="full-width"><a href="#"><?php echo $values1; ?></a>
                    <div class="dropdown-menu" >
                    
                    <div class="menu_content"><!-- Begin: menu_content -->
                    
                        <div class="row">
						
                        <!-- Get Query for all category under by Main Menus -->
                        <?php
                            $catview =	$this->navigation_model->category($values1,1); // Get Category where status is 1
                            foreach($catview as $value2){
                        ?>
						
                          <div class="col-lg-3">
                          
                            <div class="meca_box"><!-- Begin: meca_box -->
                                <h6 class="meca_box_h6">
                                    <a href="product_category.php">
                                        <i class="fa fa-th-large"></i> <?php echo $value2->category_name; /* Echo Category Names */  ?>
                                    </a>
                                </h6>
                                <ul>
                                  
									<?php
										// Gel All Subcategory According to CategoryID
										$query = $this->db->query("SELECT * FROM mega_subcategory where category_id=$value2->category_id");
										$results = $query->result();

										foreach ($results as $row){
									
										// Gel All Subcategory According to CategoryID
										$query2 = $this->db->query("SELECT * FROM mega_subcategorylevel2 where sub_category_id=$row->sub_category_id");
										$results2 = $query2->result();	
									?>
                                        
										<!--li><a href="#"><i class="fa fa-sun-o"></i> <?php //echo $row->sub_category_name; ?> </a-->
                                        <li><a href="#"> <i class="fa fa-arrow-circle-right"></i>
										<?php
											echo $row->sub_category_name;

											if( $query2->num_rows() > 0 ){
													echo ' &nbsp; <i class="fa fa-arrow-down"></i>';
											}
										?>

                                        </a>

										<ul class="lev2subcat">

												<?php

														foreach ($results2 as $row2){
												?>

												<li><a href="#"><i class="fa fa-sun-o"></i> <?php echo $row2->sub_category_lev2_name; ?> </a></li>	

												<?php } ?>

										</ul>

                                        </li>

                                <?php } ?>
								  
                                </ul>
                            </div><!-- End: meca_box -->
                            
                          </div>
						  
                           <?php } ?>
                          
                        </div>
                    
                    </div><!-- End: menu_content -->
                    
                  </div>
                </li>
                
		<?php } ?>
                  
                
                </ul>
              </div>
            </div>
        </div>
    </div>
</div><!-- End: navigation -->
