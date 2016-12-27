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
								foreach($last8items as $last4itemsview){
									
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
													
													echo '<img class="img-responsive img-thumbnail" src="'.$pd242imglocation.'" alt="'.$last4itemsview->product_name.'" />';
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
					
					
                    
                    <div class="recommend_products"><!-- Begin: recommend_products -->
						<div class="row">
						
							<?php
								foreach($last40items as $recommandedpview){
									
									// Get product info
									$recomndProductsql = $this->db->query("SELECT * FROM mega_products where productid='".$recommandedpview->productid."'");
									
									$recomndProductFetch 	= $recomndProductsql->row_array();
									extract($recomndProductFetch);
									
									// Get shop info
									$nvs_queryRecom 		= $this->db->query("SELECT * FROM mega_shops where shopid='".$shopid."'");
									$nvs_resultsRecom 	= $nvs_queryRecom->row_array();
									extract($nvs_resultsRecom);
							?>
							
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								<div class="recompro_box recomnd" style="height:300px !important;"><!-- Begin: recompro_box -->
								
									<div class="recompro_box_img"><!-- Begin: recompro_box_img" -->
									
									
										<div class="main view-third">
											<!-- THIRD EXAMPLE -->
											<div class="view">

											<a href="<?php echo base_url(); ?>page/pdetails/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $product_name)))))))); ?>/<?php echo $productid; ?>">
											
											<?php
												$ppimgRec = explode(',',$product_image);
													
												for($ppiRec=0;$ppiRec< count($ppimgRec);$ppiRec++){
													
													// Check product Image NULL Or Not
													if($product_image == NULL){
														$pimglocationRec = base_url()."assets/frontend/images/shops/default-img.jpg";
													}else{
														$snameRec = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shop_name))));
														
														$pimglocationRec = base_url()."assets/frontend/images/shops/$snameRec/$ppimgRec[$ppiRec]";
													}
													
													echo '<img style="height:225px !important;" class="img-responsive img-thumbnail" src="'.$pimglocationRec.'" alt="'.$product_name.'" />';
													break;
												}
											?>
												
											</a>	
												
											</div>
										</div>
									
										
									</div><!-- End: recompro_box_img" -->
									
									<div class="recompro_box_txt"><!-- Begin: recompro_box_txt" -->	
										
										<h6 class="recompro_box_txt_h6" style="width:93% !important;">
											
											<a href="<?php echo base_url(); ?>page/pdetails/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $product_name)))))))); ?>/<?php echo $productid; ?>">
											
												<?php echo substr($product_name,0,40); ?> ...
												
											</a>
											
										</h6>
										
										<p class="recompro_box_txt_p">
											
											<a href="<?php echo base_url(); ?>page/yourshop/viewshop/<?php echo $shopid; ?>">
												<?php  echo $shop_name; ?>
											</a>
											
											<span class="recompro_box_txt_span">
												<i class="fa fa-usd"></i> <?php echo $product_price; ?> USD
											</span>
										</p>
									</div><!-- End: recompro_box_txt" -->
									
								</div><!-- End: recompro_box -->
							</div>
							
							<?php } ?>
							
							
							
						</div>
					</div><!-- End: recommend_products -->
                    
					
					
                    

                </div><!-- End: ourpic4_you -->
            </div>
        </div>
        
    </div>
</div><!-- End: inner_page -->


<?php $this->load->view('../../front-templates/footer.php'); ?>
