<?php
	$this->load->view('../../front-templates/head.php');
	$this->load->view('../../front-templates/header.php');
	$this->load->view('../../front-templates/navigation.php');
	
?>


<div id="inner_page"><!-- Begin: inner_page -->
    <div class="container">
    
        <div class="row">
            <div class="user_hi"><!-- Begin: user_hi -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                
                
                    <div class="user_name"><!-- Begin: user_name -->
                        <h3 class="user_name_h3">
							Hi, <span class="shopcolor"><?php echo $this->session->userdata('displayname'); ?>!</span>
						</h3>
                    </div><!-- End: user_name -->
					
					
                    <?php
				 
						// Success Or Failor check
						if(isset($success_msg)){
							
							echo '<h4 id="msg" class="text-success text-center"> <i class="fa fa-check-circle"></i> '.$success_msg.' </h4>';
							$redurl = base_url().'page/user/userarea';
							$this->output->set_header('refresh:3; url='.$redurl);
							
						}else if(isset($error_msg)){
							
							echo '<h4 class="text-danger text-center"> <i class="fa fa-exclamation-triangle"></i> '.$error_msg.' </h4>';
							
						}
						
					?>
                    
                </div>  
            </div><!-- End: ourpic4_you -->
        </div>
        <div class="clearfix"></div>


        <div class="row">
            <div class="ourpic4_you"><!-- Begin: ourpic4_you -->
            
                <?php
					foreach($shoplast6p as $viewShopLast6p){
						
						// Get shop info
						$nvs_queryShopL6p 		= $this->db->query("SELECT * FROM mega_shops where shopid='".$viewShopLast6p->shopid."'");
						$nvs_resultsShopL6p 	= $nvs_queryShopL6p->row_array();
						extract($nvs_resultsShopL6p);
				?>
				
				<div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                    <div class="ourpic4u_box"><!-- Begin: ourpic4u_box -->
                        
						<a href="<?php echo base_url(); ?>page/pdetails/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $viewShopLast6p->product_name)))))))); ?>/<?php echo $viewShopLast6p->productid; ?>">
							
							<?php
								$ppimgShopL6p = explode(',',$viewShopLast6p->product_image);
									
								for($ppiShopL6p=0;$ppiShopL6p< count($ppimgShopL6p);$ppiShopL6p++){
									
									// Check product Image NULL Or Not
									if($viewShopLast6p->product_image == NULL){
										$pimglocationShopL6p = base_url()."assets/frontend/images/shops/default-img.jpg";
									}else{
										$snameShopL6p = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shop_name))));
										
										$pimglocationShopL6p = base_url()."assets/frontend/images/shops/$snameShopL6p/$ppimgShopL6p[$ppiShopL6p]";
									}
									
									echo '<img class="img-responsive" src="'.$pimglocationShopL6p.'" alt="'.$viewShopLast6p->product_name.'" />';
									break;
								}
							?>
							
						</a>
						
                    </div><!-- End: ourpic4u_box -->
                </div>  
                
				<?php } ?>
				
                
            </div><!-- End: ourpic4_you -->
        </div>
        <div class="clearfix"></div>
        
        <div class="row">
        	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="shopur_latest"><!-- Begin: shopur_latest -->
                
                    <div class="row">
                        <div class="sl_landscap"><!-- Begin: sl_landscap -->
                        
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            	<div class="landseeall">
                                    <p class="landseeall_p">
										Shop our latest handpicked collections 
										<span class="span_sl_landscap">
											<a href="<?php echo base_url(); ?>page/catpaginat/category/0">
												See All <i class="fa fa-angle-double-right"></i>
											</a>
										</span>
									</p>
                                </div>
                            </div>
                            
							
							<?php
								foreach($last2items as $last2itemsview){
									
									$nvsd_query212 		= $this->db->query("SELECT * FROM mega_shops where shopid='".$last2itemsview->shopid."'");
									$nvsd_results212 	= $nvsd_query212->row_array();
									extract($nvsd_results212);
									
									$getCatName = $this->db->query("SELECT * FROM mega_productcategories where category_id='".$last2itemsview->product_category_id."'");
									extract($getCatName->row_array());
							?>
							
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="dlandscape2"><!-- Begin: dlandscape2 -->
                                    <div class="row">
                                    
                                        <div class="landscape_main"><!-- Begin: landscape_main -->
                                        
                                            <a href="<?php echo base_url(); ?>page/category/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $category_name)))); ?>/<?php echo $category_id; ?>">
                                            
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="landscape_img"><!-- Begin: landscape_img -->
                                                        
														<?php
															$pd212pimg = explode(',',$last2itemsview->product_image);
																
															for($pd212pi=0;$pd212pi< count($pd212pimg);$pd212pi++){
																
																// Check product Image NULL Or Not
																if($last2itemsview->product_image == NULL){
																	$pd212imglocation = base_url()."assets/frontend/images/shops/default-img.jpg";
																}else{
																	$sname = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shop_name))));
																	
																	$pd212imglocation = base_url()."assets/frontend/images/shops/$sname/$pd212pimg[$pd212pi]";
																}
																
																echo '<img class="img-responsive" src="'.$pd212imglocation.'" alt="'.$last2itemsview->product_name.'" />';
																break;
															}
															//echo $category_name;
														?>
														
                                                    </div><!-- End: landscape_img -->
                                                </div>
                                                
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="landscape_txt"><!-- Begin: landscape_txt -->
                                                        
														<h6 class="landscape_txt_h6">Latest Items</h6>
										
														<h3 class="landscape_txt_h3"><?php echo substr($last2itemsview->product_name,0,80); ?></h3>
														
                                                    </div><!-- End: landscape_txt -->
                                                </div>
                                            
                                            </a>
                                        
                                        </div><!-- End: landscape_main -->
                                        
                                    </div>
                                </div><!-- End: dlandscape2 -->
                            </div>
							
							
							<?php } ?>
                            
                            
							<?php
								foreach($last4items as $last4itemsview){
									
									$nvsd_query242 		= $this->db->query("SELECT * FROM mega_shops where shopid='".$last4itemsview->shopid."'");
									$nvsd_results242 	= $nvsd_query242->row_array();
									extract($nvsd_results242);
									
									$getCatName4 = $this->db->query("SELECT * FROM mega_productcategories where category_id='".$last4itemsview->product_category_id."'");
									extract($getCatName4->row_array());
							?>
                            
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="dportate"><!-- Begin: dportate -->
                                
                                    <a href="<?php echo base_url(); ?>page/category/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $category_name)))); ?>/<?php echo $category_id; ?>">
                                    
                                        <div class="dportate_img"><!-- Begin: dportate_img -->
                                            
											<?php
												$pd242pimg = explode(',',$last4itemsview->product_image);
													
												for($pd242pi=0;$pd242pi< count($pd242pimg);$pd242pi++){
													
													// Check product Image NULL Or Not
													if($last4itemsview->product_image == NULL){
														$pd242imglocation = base_url()."assets/frontend/images/shops/default-img.jpg";
													}else{
														$sname = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shop_name))));
														
														$pd242imglocation = base_url()."assets/frontend/images/shops/$sname/$pd242pimg[$pd242pi]";
													}
													
													echo '<img class="img-responsive" src="'.$pd242imglocation.'" alt="'.$last4itemsview->product_name.'" />';
													break;
												}
												//echo $category_name;
											?>
											
                                        </div><!-- End: dportate_img -->
                                        
                                        <div class="dportate_txt"><!-- Begin: dportate_txt -->
                                            
											<h6 class="dportate_txt_h6">Latest Items</h6>
                                            
											<h3 class="dportate_txt_h3">
												<?php echo substr($last4itemsview->product_name,0,43); ?>
											</h3>
											
                                        </div><!-- End: dportate_txt -->
                                        
                                    </a>
                                    
                                </div><!-- End: dportate -->
                            </div>
                            
                            
							<?php } ?>
							
                                        
                        </div><!-- End: sl_landscap -->
                    </div>
                    <div class="clearfix"></div>
					
					
                    
                    <div class="row">
                        <div class="ur_feed"><!-- Begin: ur_feed -->
                        
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            	<div class="urfeed_main"><!-- Begin: urfeed_main -->
                                	<div class="row">
                                    
                                    	<div class="col-lg-1 col-md-1 col-sm-3 col-xs-12">
                                            <p class="ur_feed_p">Your feed</p>
                                        </div>
                                        
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	
                                            <div class="btn-group" data-toggle="buttons">
                                              
											  <label class="btn btn-default active">
                                                <input type="checkbox" autocomplete="off" checked> <span class="span_follow">Following</span>
                                              </label>
											  
                                              <!--label class="btn btn-default">
                                                <input type="checkbox" autocomplete="off"> <span class="span_follow">Interactions</span>
                                              </label-->
											  
                                            </div>
                                        
                                        </div>
                                        
                                    </div>
                                </div><!-- End: urfeed_main -->
                            </div>
                            
                        </div><!-- End: ur_feed -->
                    </div>
                    <div class="clearfix"></div>
					
					
                    
                    <div class="row">
                        <div class="following_interaction"><!-- Begin: following_interaction -->
                        
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                <div class="following_left"><!-- Begin: following_left -->
                                
                                    <div class="row">
									
                                    
									<?php
										foreach($last8items as $last8itemsview){
											
											$nvsd_query248 		= $this->db->query("SELECT * FROM mega_shops where shopid='".$last8itemsview->shopid."'");
											$nvsd_results248 	= $nvsd_query248->row_array();
											extract($nvsd_results248);
											
											$getCatName8 = $this->db->query("SELECT * FROM mega_productcategories where category_id='".$last8itemsview->product_category_id."'");
											extract($getCatName8->row_array());
											
											// Product Rating
											
											$prevcsql = $this->db->query("select product_rating from mega_productreviews where shopid=$last8itemsview->shopid and productid=$last8itemsview->productid and product_rating=5");
											
											if($prevcsql->num_rows() >0){
												extract($prevcsql->row_array());
											}
											
									?>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="following_left_box"><!-- Begin: following_left_box -->
                                            
                                            
											<?php
												$pd248pimg = explode(',',$last8itemsview->product_image);
												
												echo '<div class="photobox_main">';
													for($pd248pi=0;$pd248pi< count($pd248pimg);$pd248pi++){
														
														// Check product Image NULL Or Not
														if($last8itemsview->product_image == NULL){
															$pd248imglocation = base_url()."assets/frontend/images/shops/default-img.jpg";
														}else{
															$sname8 = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shop_name))));
															
															$pd248imglocation = base_url()."assets/frontend/images/shops/$sname8/$pd248pimg[$pd248pi]";
														}
														
														
														echo '<div class="photobox_follow">';
														
														echo '<img class="img-responsive" src="'.$pd248imglocation.'" alt="'.$last8itemsview->product_name.'" />';
														
														echo '</div>';
														
													}
												//echo $category_name;
												echo '</div>';
											?>
											
											
                                            
                                            <div class="follow_title">
                                                
												<div class="ft_txt">
                                                    
													<h6 class="ft_txt_h6">
														Sonofa Wood Cutter &nbsp;
														<span class="span_fttxt">
															<?php 
																if(!empty($product_rating)){
																	echo calculateStarRating($product_rating,1);
																}else{
																	echo calculateStarRating(4.50,1);
																}
																
																
															?>
														</span>
													</h6>
													
                                                    <p class="ft_txt_p">
														
														<a href="<?php echo base_url(); ?>page/pdetails/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $last8itemsview->product_name)))))))); ?>/<?php echo $last8itemsview->productid; ?>">
														
															<?php echo substr($last8itemsview->product_name,0,37); ?>...
															
														</a>
													</p>
													
                                                </div>
												
												
                                                <div class="ft_heart">
                                                    
													<a href="#">
														<i class="fa fa-heart-o"></i>
													</a>
													
                                                </div>
                                            </div>
											
                                            
                                            <div class="follow_pshop">
                                                
												<div class="ft_txt">
                                                    
													<p class="follow_pshop_p" style="bottom: 30px; padding: 0; position: absolute;">
														
														One of the most popular shop  
														<b class="text-success"><?php echo $shop_name; ?></b>
													</p>
													
                                                </div>
												
                                                
                                            </div>
                                            
                                        </div><!-- End: following_left_box -->
                                    </div>
									
									
									<?php } ?>
									
                                    
                                    
                                    
                                    
                                    
                                    </div>
                                    
                                </div><!-- End: following_left -->
                            </div>
                            
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="following_right"><!-- Begin: following_right -->
                                
                                	<div class="row">
                                    
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="ctsell_app01"><!-- Begin: ctsell_app -->
                                                
                                                <h3 class="ctsell_app01_h3">CitiSell app: Tap into inspiration</h3>
                                                <h6 class="ctsell_app01_h6">Get a free download link. <a href="#">Learn More</a></h6>
                                                
                                                <div class="searh_btn01">
                                                    <div class="input-group">
                                                      <input type="text" class="form-control" placeholder="(123) 456 78910">
                                                      <span class="input-group-btn">
                                                        <button class="btn btn-default" type="button">Send!</button>
                                                      </span>
                                                    </div><!-- /input-group -->
                                                </div>
                                                
                                                <p class="ctsell_app01_p">Your standard messaging and data rates may apply.</p>
                                                
                                            </div><!-- End: ctsell_app -->
                                        </div>
                                        
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="ctsell_app02"><!-- Begin: ctsell_app02 -->
                                                
                                                <h3 class="ctsell_app02_h3">Browse</h3>
                                                
                                                <div class="ctsell_items"><!-- Begin: ctsell_items -->
                                                    <ul>
                                                        <li><a href="#">Trending Items</a></li>
                                                        <li><a href="#">CitiSell Local</a></li>
                                                    </ul>
                                                </div><!-- End: ctsell_items -->
                                                
                                                <div class="story_behind"><!-- Begin: story_behind -->
                                                    <h3 class="story_behind_h3">Story Behind the Shop &nbsp;&nbsp;<span class="span_btn"><a href="#">See more</a></span></h3>
                                                    <p class="story_behind_p"><img src="<?php echo base_url(); ?>assets/frontend/images/products/story_behind.jpg" style="margin: 0 12px 0px 0px;" align="left" vspace="5" hspace="5"><strong>Plywood Office</strong><br />Get a glimpse into the process of this architect-turned-furniture maker.<br />
                                                    <a href="#">Read the story and tour their studio</a></p>
                                                </div><!-- End: story_behind -->
                                                
                                                <div class="pwoffice_pic"><!-- Begin: pwoffice_pic -->
                                                    <ul>
                                                        <li><a href="#"><img src="<?php echo base_url(); ?>assets/frontend/images/products/urpic4u06.jpg" class="img-responsive" alt="photo" /></a></li>
                                                        <li><a href="#"><img src="<?php echo base_url(); ?>assets/frontend/images/products/urpic4u05.jpg" class="img-responsive" alt="photo" /></a></li>
                                                        <li><a href="#"><img src="<?php echo base_url(); ?>assets/frontend/images/products/urpic4u03.jpg" class="img-responsive" alt="photo" /></a></li>
                                                    </ul>
                                                </div><!-- End: pwoffice_pic -->
                                                
                                                <div class="more_from"><!-- Begin: more_from -->
                                                    <h3 class="story_behind_h3">More From the CitiSell Blog &nbsp;&nbsp;<span class="span_btn"><a href="#">See more</a></span></h3>
                                                    <div class="mofro_box">
                                                        <p class="story_behind_p"><a href="#"><img src="<?php echo base_url(); ?>assets/frontend/images/products/from_product01.jpg" style="margin: 0 12px 0px 0px;" align="left" vspace="5" hspace="5"></a><strong><a href="#">4 Iconic Minimalist Interiors — and How to Get the Look</a></strong><br /><a href="#"> Shop the collection</a></p>
                                                    </div>
                                                    <div class="mofro_box" id="last_box">
                                                        <p class="story_behind_p"><a href="#"><img src="<?php echo base_url(); ?>assets/frontend/images/products/from_product02.jpg" style="margin: 0 12px 0px 0px;" align="left" vspace="5" hspace="5"></a><strong><a href="#">Turn Your Pin Collection Into a Work of Art</a></strong><br /><a href="#"> Make this </a></p>
                                                    </div>
                                                </div><!-- End: more_from -->
                                                
                                                <div class="ctsell_find"><!-- Begin: ctsell_find -->
                                                    <h3 class="story_behind_h3">CitiSell Finds</h3>
                                                    <p class="ctsell_find_p">Your daily Etsy shopping guide.</p>
                                                    <a type="submit" class="btn btn-default" style="margin-top:5px;">Subcribe</a>
                                                </div><!-- End: ctsell_find -->
    
                                                <div class="more_ways"><!-- Begin: more_ways -->
                                                    <h3 class="story_behind_h3">More Ways to Shop</h3>
                                                    <ul>
                                                        <li><a href="#"><i class="fa fa-circle-o"></i>&nbsp; Categories</a></li>
                                                        <li><a href="#"><i class="fa fa-circle-o"></i>&nbsp; Gift Cards</a></li>
                                                        <li><a href="#"><i class="fa fa-circle-o"></i>&nbsp; Treasury</a></li>
                                                        <li><a href="#"><i class="fa fa-circle-o"></i>&nbsp; Shop Nearby Items</a></li>
                                                        <li><a href="#"><i class="fa fa-circle-o"></i>&nbsp; Find a Shop</a></li>
                                                        <li><a href="#"><i class="fa fa-circle-o"></i>&nbsp; Search for People</a></li>
                                                        <li><a href="#"><i class="fa fa-circle-o"></i>&nbsp; Prototypes</a></li>
                                                    </ul>
                                                </div><!-- End: more_ways -->
                                                                                            
                                            </div><!-- End: ctsell_app02 -->
                                        </div>
                                        
                                    </div>
                                    
                                </div><!-- End: following_right -->
                            </div>
                            
                        </div><!-- End: following_interaction -->
                    </div>
                    
					
					
                    

                </div><!-- End: ourpic4_you -->
            </div>
        </div>
        
    </div>
</div><!-- End: inner_page -->


<?php $this->load->view('../../front-templates/footer.php'); ?>
