<?php
	$this->load->view('../../front-templates/head.php');
	$this->load->view('../../front-templates/header.php');
	$this->load->view('../../front-templates/navigation.php');
	
?>

<div id="inner_page"><!-- Begin: inner_page -->
    <div class="container">
    
        <div class="row">
        
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="innerpage_head"><!-- Begin: innerpage_head -->
                    <p clainnerpage_head_p>
						
						
						<?php if($this->session->userdata('isLogin') == FALSE){ ?>
						<a href="<?php echo base_url(); ?>page/index">Home</a>
						<?php }else{ ?>
						<a href="<?php echo base_url(); ?>page/user/userarea">Home</a>
						<?php } ?>
						
						<?php if($this->uri->segment(3) !== NULL || $this->uri->segment(5) !== NULL){ ?>
						
						<i class="fa fa-angle-double-right"></i>
						
						<a href="<?php echo base_url(); ?>page/category/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $this->uri->segment(3))))); ?>/<?php echo $this->uri->segment(4); ?>">
						
							<?php echo str_replace("and","&",ucwords(str_replace('-', ' ', str_replace("'", '', $this->uri->segment(3))))); ?>
							
						</a>
						
						<i class="fa fa-angle-double-right"></i>
						
						<a href="<?php echo base_url(); ?>page/subcategory/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $this->uri->segment(3))))); ?>/<?php echo $this->uri->segment(4); ?>/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $this->uri->segment(5))))); ?>/<?php echo $this->uri->segment(6); ?>">
						
							<span class="p_active">
							
								<?php echo str_replace("and","&",ucwords(str_replace('-', ' ', str_replace("'", '', $this->uri->segment(5))))); ?>
								
							</span>
						</a>
						<?php } ?>
						<?php if($this->uri->segment(8) !== NULL || $this->uri->segment(9) !== NULL){ ?>
						
							<i class="fa fa-angle-double-right"></i>
							<span class="text-primary">
							
								<?php echo str_replace("and","&",ucwords(str_replace('-', ' ', str_replace("'", '', $this->uri->segment(7))))); ?>
								
							</span>
						<?php }?>
						
					</p>
                </div><!-- End: innerpage_head -->
            </div>  
                      
        </div>
        
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="suca_slider"><!-- Begin: suca_slider -->
                	<div class="row">
                    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="main">
                                    
									<ul id="carousel" class="elastislide-list">
                                    
										<?php
											$sqql 		= $this->db->query("select * from mega_products where product_live='Active' and product_category_id='".$this->uri->segment(4)."' order by rand() limit 30");
											$sqqlQuery 	= $sqql->result();
											
											foreach($sqqlQuery as $queryResult){
												
												$nvsd_query 		= $this->db->query("SELECT * FROM mega_shops where shopid='".$queryResult->shopid."'");
												$nvsd_results 	= $nvsd_query->row_array();
												extract($nvsd_results);
										?>
                                        
										<!-- Go to product details -->
										<li>
											<a href="<?php echo base_url(); ?>page/pdetails/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $queryResult->product_name)))))))); ?>/<?php echo $queryResult->productid; ?>">
											
												<div class="subcap_box"><!-- Begin: subcap_box -->
													
													<?php
														$pdpimg = explode(',',$queryResult->product_image);
															
														for($pdpi=0;$pdpi< count($pdpimg);$pdpi++){
															
															// Check product Image NULL Or Not
															if($queryResult->product_image == NULL){
																$pdimglocation = base_url()."assets/frontend/images/shops/default-img.jpg";
															}else{
																$sname01 = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shop_name))));
																
																$pdimglocation = base_url()."assets/frontend/images/shops/$sname01/$pdpimg[$pdpi]";
															}
															
															echo '<img class="img-responsive img-thumbnail" src="'.$pdimglocation.'" alt="'.$queryResult->product_name.'" />';
															break;
														}
													?>
													
													<h6 class="subcap_box_h6"><?php echo substr($queryResult->product_name,0,37); ?></h6>
												</div><!-- End: subcap_box -->
											
											</a>
										</li>
										
										<?php } ?>
                                        
                                    </ul>
									
                                </div>
                        </div>
                    </div>
                </div><!-- End: suca_slider -->
            </div>
        </div>
        <div class="clearfix"></div>      

        <div class="row">
        
            <div class="innerpage_main"><!-- Begin: innerpage_main -->
            
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                
                    <div class="sub_category01"><!-- Begin: sub_category01 -->
                        
                        <p>
							<a href="<?php echo base_url(); ?>page/category/<?php echo str_replace("and","&",strtolower(str_replace(' ', '-', str_replace("'", '', $this->uri->segment(3))))); ?>/<?php echo $this->uri->segment(4); ?>">
								
								<i class="fa fa-arrow-circle-right"></i> All Categories
								
							</a>
						</p>
                        
                        
                        <h6><a href="<?php echo base_url(); ?>page/category/<?php echo str_replace("and","&",strtolower(str_replace(' ', '-', str_replace("'", '', $this->uri->segment(3))))); ?>/<?php echo $this->uri->segment(4); ?>">
							
							<i class="fa fa-th"></i>
							<?php echo str_replace("and","&",ucwords(str_replace('-', ' ', str_replace("'", '', $this->uri->segment(5))))); ?>
							
						</a></h6>
    
                        <ul>
							
							<?php
								$subbcatid = $this->uri->segment(6);
								
								// Gel All Subcategory level 2 According to sub CategoryID
								$subcat_nv_query = $this->db->query("SELECT * FROM mega_subcategorylevel2 where sub_category_id=$subbcatid");
								$subcat_nv_results = $subcat_nv_query->result();
								$subcat_ccrows = $subcat_nv_query->num_rows();
								
								if($subcat_ccrows > 0){

								foreach ($subcat_nv_results as $subcat_nv_row){
								
							?>
							
                        	<li>
								<a href="<?php echo base_url(); ?>page/subcategorylev2/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $this->uri->segment(3)))));  ?>/<?php echo $this->uri->segment(4);  ?>/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $this->uri->segment(5)))));  ?>/<?php echo $this->uri->segment(6); ?>/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $subcat_nv_row->sub_category_lev2_name))));  ?>/<?php echo $subcat_nv_row->sub_category_lev2_id; ?>">
									&#x0226B;&nbsp;
									 <?php echo $subcat_nv_row->sub_category_lev2_name; ?>
								</a>
							</li>
							
							<?php } }else{
								
								$ccatid = $this->uri->segment(4);
								// Gel All Subcategory According to CategoryID
								$nv_query = $this->db->query("SELECT * FROM mega_subcategory where category_id=$ccatid");
								$nv_results = $nv_query->result();
								$ccrows = $nv_query->num_rows();

								foreach ($nv_results as $nv_row){
							?>
							
								<li>
									<a href="<?php echo base_url(); ?>page/subcategory/<?php echo str_replace("&","and",str_replace(' ', '-', str_replace("'", '', $this->uri->segment(3))));  ?>/<?php echo $this->uri->segment(4);  ?>/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $nv_row->sub_category_name))));  ?>/<?php echo $nv_row->sub_category_id;  ?>">
										&#x0226B;&nbsp;
										
										<?php echo $nv_row->sub_category_name; ?>
										
									</a>
								</li>
							
							<?php } }  ?>

                        </ul>
                        
                        
                    </div><!-- End: sub_category01 -->
                    
                    <!-- start of filtering -->
						
                    <!-- end of filtering -->
                    
                    
                    
                </div>  
                
				
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <div class="inner_products"><!-- Begin: inner_products -->
                    
                        <div class="recommend_products"><!-- Begin: recommend_products -->
                            <div class="row">
                            
							
								<?php
									if($this->uri->segment(8) == NULL){
									
										$sqql2 		= $this->db->query("select * from mega_products where product_live='Active' and product_sub_category_id='".$this->uri->segment(6)."' order by rand() limit 15");
										$sqqlQuery2 	= $sqql2->result();
									
									}else{
										
										$sqql2 		= $this->db->query("select * from mega_products where product_live='Active' and product_sub_category_lev2_id='".$this->uri->segment(8)."' order by rand() limit 15");
										$sqqlQuery2 	= $sqql2->result();
										
									}
									
									foreach($sqqlQuery2 as $queryResult2){
										
										$nvsd_query2 		= $this->db->query("SELECT * FROM mega_shops where shopid='".$queryResult2->shopid."'");
										$nvsd_results2 	= $nvsd_query2->row_array();
										extract($nvsd_results2);
								?>
								
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="recompro_box subccat"><!-- Begin: recompro_box -->
                                    
                                        <div class="recompro_box_img"><!-- Begin: recompro_box_img" -->
                                        
                                        
                                            <div class="main view-third">
                                                <!-- THIRD EXAMPLE -->
                                                <div class="view">
													
													<a href="<?php echo base_url(); ?>page/pdetails/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $queryResult2->product_name)))))))); ?>/<?php echo $queryResult2->productid; ?>">
													
													<?php
														$pd2pimg = explode(',',$queryResult2->product_image);
															
														for($pd2pi=0;$pd2pi< count($pd2pimg);$pd2pi++){
															
															// Check product Image NULL Or Not
															if($queryResult2->product_image == NULL){
																$pd2imglocation = base_url()."assets/frontend/images/shops/default-img.jpg";
															}else{
																$sname02 = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shop_name))));
																
																$pd2imglocation = base_url()."assets/frontend/images/shops/$sname02/$pd2pimg[$pd2pi]";
															}
															
															echo '<img style="height:194px !important;" class="img-responsive img-thumbnail" src="'.$pd2imglocation.'" alt="'.$queryResult2->product_name.'" />';
															break;
														}
													?>
                                                    
													
													<!--div class="mask">
														<div class="heart_rate">
															
															<?php
																//if($this->session->userdata('isLogin') == FALSE){
															?>
																<a href="#signin" id="sig" data-toggle="modal" data-target="#myModal" class="info signin">
																	<i class="fa fa-heart-o" style="font-weight:bold"></i>
																</a>
																
															<?php //}else{ ?>
															
																<a href="#" class="info"><i class="fa fa-heart-o" style="font-weight:bold"></i></a>
																
															<?php //} ?>
															
														</div>
													</div-->
													</a>
													
                                                </div>
                                            </div>
                                        
                                            
                                        </div><!-- End: recompro_box_img" -->
                                        
                                        <div class="recompro_box_txt"><!-- Begin: recompro_box_txt" -->	
                                            <h6 class="recompro_box_txt_h6" style="width:90% !important;">
												
												<a href="<?php echo base_url(); ?>page/pdetails/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $queryResult2->product_name)))))))); ?>/<?php echo $queryResult2->productid; ?>">
													
													<?php echo substr($queryResult2->product_name,0,43); ?>
													
												</a>
												
											</h6>
											
                                            <p class="recompro_box_txt_p">
												
												<a href="<?php echo base_url(); ?>page/yourshop/viewshop/<?php echo $shopid; ?>">
													<?php echo $shop_name; ?>
												</a>
												
												<span class="recompro_box_txt_span">
													<i class="fa fa-usd"></i> <?php echo $queryResult2->product_price; ?>
												</span>
												
											</p>
                                        </div><!-- End: recompro_box_txt" -->
                                        
                                    </div><!-- End: recompro_box -->
                                </div>
								
                                
								<?php } ?> 
                                
                                
                                
                              
                                
                            </div>
                        </div><!-- End: recommend_products -->
                        
                    </div><!-- End: inner_products -->
                </div>  
                
            </div><!-- End: innerpage_main -->
            
        </div>
        <div class="clearfix"></div>
        
        <div class="row">
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="topcategory"><!-- Begin: topcategory -->
                    <h3 class="border_styles">
					
						<span>Top Items in <?php echo str_replace("and","&",strtolower(str_replace('-', ' ', str_replace("'", '', $this->uri->segment(3)))));  ?></span>
						
					</h3>
                </div><!-- End: topcategory -->
            </div>
            <div class="clearfix"></div>
            
			
			<?php
				if($this->uri->segment(8) !== NULL){
					
					$sqql22 		= $this->db->query("select * from mega_products where product_live='Active' and product_category_id='".$this->uri->segment(4)."' order by rand() limit 18");
					$sqqlQuery22 	= $sqql22->result();
					
				}else{
					
					$sqql22 		= $this->db->query("select * from mega_products where product_live='Active' and product_sub_category_id='".$this->uri->segment(6)."' order by rand() limit 18");
					$sqqlQuery22 	= $sqql22->result();
					
				}
				
				foreach($sqqlQuery22 as $queryResult22){
					
					$nvsd_query22 		= $this->db->query("SELECT * FROM mega_shops where shopid='".$queryResult22->shopid."'");
					$nvsd_results22 	= $nvsd_query22->row_array();
					extract($nvsd_results22);
			?>
            
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <div class="dportate"><!-- Begin: dportate -->
                
                    <a href="<?php echo base_url(); ?>page/pdetails/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $queryResult22->product_name)))))))); ?>/<?php echo $queryResult22->productid; ?>">
                    
                        <div class="dportate_img"><!-- Begin: dportate_img -->
                            
							<?php
								$pd22pimg = explode(',',$queryResult22->product_image);
									
								for($pd22pi=0;$pd22pi< count($pd22pimg);$pd22pi++){
									
									// Check product Image NULL Or Not
									if($queryResult22->product_image == NULL){
										$pd22imglocation = base_url()."assets/frontend/images/shops/default-img.jpg";
									}else{
										$sname03 = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shop_name))));
										
										$pd22imglocation = base_url()."assets/frontend/images/shops/$sname03/$pd22pimg[$pd22pi]";
									}
									
									echo '<img class="img-responsive img-thumbnail" src="'.$pd22imglocation.'" alt="'.$queryResult22->product_name.'" />';
									break;
								}
							?>
							
                        </div><!-- End: dportate_img -->
                        
                        <div class="dportate_txt"><!-- Begin: dportate_txt -->
                            <h6 class="dportate_txt_h6">Latest Items</h6>
                            <h3 class="dportate_txt_h3">
								<?php echo substr($queryResult22->product_name,0,43); ?>
							</h3>
                        </div><!-- End: dportate_txt -->
                        
                    </a>
                    
                </div><!-- End: dportate -->
            </div>
            
            <?php } ?>
            
            
            
            
                                        
        </div>
        
        <div class="row">
        
            <div class="recommend_products"><!-- Begin: recommend_products -->
            	<div class="row">
                	
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="shop_all"><!-- Begin: shop_all -->
                            <h3 class="border_styles"><span>Shop All Accessories</span></h3>
                        </div><!-- End: shop_all -->
                    </div>
                
				
					<?php
						foreach($allitems as $allitemsview){
							$get_thumbs = $this->page_model->get_productimgs($allitemsview->productid);
					?>
				
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="recompro_box" style="height:300px !important;"><!-- Begin: recompro_box -->
                        
                            <div class="recompro_box_img"><!-- Begin: recompro_box_img" -->
                            
                            
                                <div class="main view-third">
                                    <!-- THIRD EXAMPLE -->
                                    <div class="view">
									
									<a href="<?php echo base_url(); ?>page/pdetails/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $allitemsview->product_name)))))))); ?>/<?php echo $allitemsview->productid; ?>">

										<?php
											$nvsoo_query 		= $this->db->query("SELECT * FROM mega_shops where shopid='".$allitemsview->shopid."'");
											$nvsoo_results 	= $nvsoo_query->row_array();
											extract($nvsoo_results);
											
											$sname = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shop_name))));	
											$pooimglocation = base_url()."assets/frontend/images/shops/".$sname."/";
												
										?>
										<?php 
											if(count($get_thumbs) !== 0){
										?>
										<img class="img-responsive img-thumbnail" src="<?php echo $pooimglocation.$get_thumbs['pic_name']; ?>" alt="<?php echo $allitems->product_name; ?>" />
										<?php }else{ ?>
										<img class="img-responsive img-thumbnail" src="<?php echo base_url()."assets/frontend/images/shops/default-img.jpg"; ?>" alt="No Image Avaliable" />
										<?php } ?>
                                        <!--div class="mask">
											<div class="heart_rate">
												
												<?php
													//if($this->session->userdata('isLogin') == FALSE){
												?>
													<a href="#signin" id="sig" data-toggle="modal" data-target="#myModal" class="info signin">
														<i class="fa fa-heart-o" style="font-weight:bold"></i>
													</a>
													
												<?php //}else{ ?>
												
													<a href="#" class="info"><i class="fa fa-heart-o" style="font-weight:bold"></i></a>
													
												<?php //} ?>
												
											</div>
										</div-->
										
										</a>
										
                                    </div>
                                </div>
                            
                            	
                            </div><!-- End: recompro_box_img" -->
                            
                            <div class="recompro_box_txt"><!-- Begin: recompro_box_txt" -->	
                            	
								<h6 class="recompro_box_txt_h6_sub" style="width: 91% !important;">
									
									<a href="<?php echo base_url(); ?>page/pdetails/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $allitemsview->product_name)))))))); ?>/<?php echo $allitemsview->productid; ?>">
										
										<?php echo substr($allitemsview->product_name,0,42); ?>
										
									</a>
									
								</h6>
								
                                <p class="recompro_box_txt_p">&nbsp; 
									<span class="recompro_box_txt_span">
										<i class="fa fa-usd"></i> 
										<?php  echo $allitemsview->product_price; ?>
									</span>
										
									<span class="recompro_box_txt_span_shop">
										
										<a href="<?php echo base_url(); ?>page/yourshop/viewshop/<?php echo $shopid; ?>">
											<?php  echo $shop_name; ?>
										</a>
										
									</span>
								</p>
								
                            </div><!-- End: recompro_box_txt" -->
                            
                        </div><!-- End: recompro_box -->
                    </div>
                    
                    
					<?php } ?>
                    
                    
                   
                    
                </div>
            </div><!-- End: recommend_products -->
            
        </div>
                
    </div>
</div><!-- End: inner_page -->

<?php $this->load->view('../../front-templates/footer.php'); ?>
