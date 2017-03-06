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
						$get_thumbs = $this->page_model->get_productimgs($viewShopLast6p->productid);
						
						// Get shop info
						$nvs_queryShopL6p 		= $this->db->query("SELECT * FROM mega_shops where shopid='".$viewShopLast6p->shopid."'");
						$nvs_resultsShopL6p 	= $nvs_queryShopL6p->row_array();
						extract($nvs_resultsShopL6p);
				?>
				
				<div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                    <div class="ourpic4u_box"><!-- Begin: ourpic4u_box -->
                        
						<a href="<?php echo base_url(); ?>page/pdetails/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $viewShopLast6p->product_name)))))))); ?>/<?php echo $viewShopLast6p->productid; ?>">
							<?php
								$sname = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shop_name))));	
								$pooimglocation = base_url()."assets/frontend/images/shops/".$sname."/";
							?>
							
							<?php 
								if(count($get_thumbs) !== 0){
							?>
							<img class="img-responsive" src="<?php echo $pooimglocation.$get_thumbs['pic_name']; ?>" alt="<?php echo $viewShopLast6p->product_name; ?>" />
							<?php }else{ ?>
							<img class="img-responsive" src="<?php echo base_url()."assets/frontend/images/shops/default-img.jpg"; ?>" alt="No Image Avaliable" />
							<?php } ?>
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
                            
							
                                        
                        </div><!-- End: sl_landscap -->
                    </div>
                    <div class="clearfix"></div>
					
					
                    
                    <div class="recommend_products"><!-- Begin: recommend_products -->
						<div class="row">
						
							<?php
								foreach($last60items as $recommandedpview){
									$get_thumbs = $this->page_model->get_productimgs($recommandedpview->productid);
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
														$sname = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shop_name))));	
														$pooimglocation = base_url()."assets/frontend/images/shops/".$sname."/";
													?>
													
													<?php 
														if(count($get_thumbs) !== 0){
													?>
													<img class="img-responsive" src="<?php echo $pooimglocation.$get_thumbs['pic_name']; ?>" alt="<?php echo $recommandedpview->product_name; ?>" />
													<?php }else{ ?>
													<img class="img-responsive" src="<?php echo base_url()."assets/frontend/images/shops/default-img.jpg"; ?>" alt="No Image Avaliable" />
													<?php } ?>
												</a>
											</div>
										</div>
									
										
									</div><!-- End: recompro_box_img" -->
									
									<div class="recompro_box_txt"><!-- Begin: recompro_box_txt" -->	
										
										<h6 class="recompro_box_txt_h6" style="width:90% !important;">
											
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
