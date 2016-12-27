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
						<a href="#">Home</a>
						<i class="fa fa-angle-double-right"></i>
						
						<a href="#">
							<span class="p_active">
								<?php echo ucfirst(str_replace('-', ' ', $this->uri->segment(3))); ?>
							</span>
						</a>
					</p>
                </div><!-- End: innerpage_head -->
            </div>  
                      
        </div>
                        
        <div class="row">
        
            <div class="innerpage_main"><!-- Begin: innerpage_main -->
            
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="product_category"><!-- Begin: product_category -->
                        <h6 class="product_category_h6" style="text-align:left;font-weight:bold;">
							<i class="fa fa-list"></i>
							All <?php echo ucfirst(str_replace('-', ' ', $this->uri->segment(3))); ?>
						</h6>
    
                        <ul>
                        	<?php
								$ccatid = $this->uri->segment(4);
								// Gel All Subcategory According to CategoryID
								$nv_query = $this->db->query("SELECT * FROM mega_subcategory where category_id=$ccatid");
								$nv_results = $nv_query->result();
								$ccrows = $nv_query->num_rows();
								
								if($ccrows > 0){

								foreach ($nv_results as $nv_row){
								
							?>
							
							<li>
								<a href="<?php echo base_url(); ?>page/subcategory/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $this->uri->segment(3))))); ?>/<?php echo $this->uri->segment(4); ?>/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $nv_row->sub_category_name)))); ?>/<?php echo $nv_row->sub_category_id;  ?>">
									&#x0226B;&nbsp; 
									
									<?php
										echo $nv_row->sub_category_name;
									?>
								</a>
							</li>
							
							<?php }
								}else{
									$catn = $this->uri->segment(4);
									$nvcc_query 	= $this->db->query("SELECT main_menus FROM mega_productcategories where category_id='".$catn."'");
									$nvcc_results = $nvcc_query->row_array();
									extract($nvcc_results);
									unset($nvcc_results); // Unset thus query results
									
									$nvc_query 	= $this->db->query("SELECT * FROM mega_productcategories where main_menus='".$main_menus."'");
									$nvc_results = $nvc_query->result();

									foreach ($nvc_results as $nvc_row){
							?>
							
							<li>
								<a href="<?php echo base_url(); ?>page/category/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $nvc_row->category_name))));  ?>/<?php echo $nvc_row->category_id;  ?>">
									&#x0226B;&nbsp; 
									<?php
										echo $nvc_row->category_name;
									?>
								</a>
							</li>
							
							<?php
									}
								}
							?>
							
                        </ul>
                        
                        <p class="product_category_p" style="text-align:left;font-weight:bold;">
							<a href="#">
								&#x0226A; <a href="<?php echo base_url(); ?>page/catpaginat/category/0">Shop all items</a> 
							</a>
						</p>
                        
                    </div><!-- End: product_category -->
                </div>  
                
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <div class="inner_products"><!-- Begin: inner_products -->
                    
                    	<div class="row">
							
							<?php
								
								foreach($ppcategory as $pview){
									
								$nvs_query 		= $this->db->query("SELECT * FROM mega_shops where shopid='".$pview->shopid."'");
								$nvs_results 	= $nvs_query->row_array();
								extract($nvs_results);
							?>
                            
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="plandscape"><!-- Begin: plandscape -->
                                    <div class="row">
                                    
                                        <div class="plandscape_main"><!-- Begin: plandscape_main -->
                                        
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="plandscape_img"><!-- Begin: plandscape_img -->
                                                    
													<a href="<?php echo base_url(); ?>page/pdetails/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $pview->product_name)))))))); ?>/<?php echo $pview->productid; ?>">
													
														<?php
															$ppimg = explode(',',$pview->product_image);
																
															for($ppi=0;$ppi< count($ppimg);$ppi++){
																
																// Check product Image NULL Or Not
																if($pview->product_image == NULL){
																	$pimglocation = base_url()."assets/frontend/images/shops/default-img.jpg";
																}else{
																	$sname1 = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shop_name))));
																	
																	$pimglocation = base_url()."assets/frontend/images/shops/$sname1/$ppimg[$ppi]";
																}
																
																echo '<img class="img-responsive img-thumbnail" src="'.$pimglocation.'" alt="'.$pview->product_name.'" />';
																break;
															}
														?>
													</a>
													
                                                </div><!-- End: plandscape_img -->
                                            </div>
                                                
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="plandscape_txt"><!-- Begin: plandscape_txt -->
                                                    <h6 class="plandscape_txt_h6">
														
														<a href="<?php echo base_url(); ?>page/pdetails/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $pview->product_name)))))))); ?>/<?php echo $pview->productid; ?>">
														
															<?php echo substr($pview->product_name,0,60); ?> ...
															
														</a>
														
													</h6>
													
													<?php 
														/*if(!empty($pview->product_item_details)){
															echo $pview->product_item_details;
														}else{
															echo '<span class="text-danger">About the product details not yet found!</span>';
														}*/
														
													?>
													
                                                </div><!-- End: plandscape_txt -->
                                            </div>
                                        
                                        </div><!-- End: plandscape_main -->
                                                            
                                    </div>
                                </div><!-- End: plandscape -->
                            </div>
							
							<?php } ?>
                            
                
                        </div>
                    
                        <div class="row">
                        
                            <?php
								//echo $this->uri->segment(4);
								foreach($latestitems as $viewlatest){
							?>
							
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="dportate"><!-- Begin: dportate -->
                                
                                    <a href="<?php echo base_url(); ?>page/pdetails/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $viewlatest->product_name)))))))); ?>/<?php echo $viewlatest->productid; ?>">
                                    
                                        <div class="dportate_img"><!-- Begin: dportate_img -->
                                            <?php
												$nvso_query 		= $this->db->query("SELECT * FROM mega_shops where shopid='".$viewlatest->shopid."'");
												$nvso_results 	= $nvso_query->row_array();
												extract($nvso_results);
												
												$popimg = explode(',',$viewlatest->product_image);
													
												for($popi=0;$popi< count($popimg);$popi++){
													
													// Check product Image NULL Or Not
													if($viewlatest->product_image == NULL){
														$poimglocation = base_url()."assets/frontend/images/shops/default-img.jpg";
													}else{
														$sname2 = str_replace("&","and",str_replace("'", '',str_replace(',', '', str_replace('/', '', strtolower(str_replace(' ', '-',$shop_name))))));
														
														$poimglocation = base_url()."assets/frontend/images/shops/$sname2/$popimg[$popi]";
													}
													
													echo '<img class="img-responsive img-thumbnail" src="'.$poimglocation.'" alt="'.$viewlatest->product_name.'" />';
													break;
												}
											?>
                                        </div><!-- End: dportate_img -->
										
									</a>
                                        
									<div class="dportate_txt"><!-- Begin: dportate_txt -->
										<h6 class="dportate_txt_h6">Latest Items</h6>
										
										<h3 class="dportate_txt_h3">
											
											<a href="<?php echo base_url(); ?>page/pdetails/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $viewlatest->product_name)))))))); ?>/<?php echo $viewlatest->productid; ?>">
											
												<?php echo substr($viewlatest->product_name,0,60); ?>
											
											</a>
											
										</h3>
										
									</div><!-- End: dportate_txt -->
                                        
                                    
                                    
                                </div><!-- End: dportate -->
                            </div>
                            
							<?php } ?>
                            
                                                        
                        </div>
                        
                        
                    </div><!-- End: inner_products -->
                </div>  
                
            </div><!-- End: innerpage_main -->
            
        </div>
        <div class="clearfix"></div>              
        
        <div class="row">
        
            <div class="recommend_products"><!-- Begin: recommend_products -->
            	<div class="row">
                	
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="shop_all"><!-- Begin: shop_all -->
                            <h3 class="border_styles"><span>Shop all items</span></h3>
                        </div><!-- End: shop_all -->
                    </div>
					
					
					<?php
						foreach($allitems as $allitemsview){
					?>
                
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class="recompro_box hhight" style="height:242px !important;"><!-- Begin: recompro_box -->
                        
                            <div class="recompro_box_img"><!-- Begin: recompro_box_img" -->
                            
                            
                                <div class="main view-third">
                                    <!-- THIRD EXAMPLE -->
                                    <div class="view">
									
										<a href="<?php echo base_url(); ?>page/pdetails/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $allitemsview->product_name)))))))); ?>/<?php echo $allitemsview->productid; ?>">

                                      <?php
											$nvsoo_query 		= $this->db->query("SELECT * FROM mega_shops where shopid='".$allitemsview->shopid."'");
											$nvsoo_results 	= $nvsoo_query->row_array();
											extract($nvsoo_results);
											
											$poopimg = explode(',',$allitemsview->product_image);
												
											for($poopi=0;$poopi< count($poopimg);$poopi++){
												
												// Check product Image NULL Or Not
												if($allitemsview->product_image == NULL){
													$pooimglocation = base_url()."assets/frontend/images/shops/default-img.jpg";
												}else{
													$sname3 = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shop_name))));
													
													$pooimglocation = base_url()."assets/frontend/images/shops/$sname3/$poopimg[$poopi]";
												}
												
												echo '<img class="img-responsive img-thumbnail" src="'.$pooimglocation.'" alt="'.$allitemsview->product_name.'" />';
												break;
											}
										?>
									  
                                        <!--div class="mask">
											<div class="heart_rate">
												
												<?php
													//if($this->session->userdata('isLogin') == FALSE){
												?>
													<a href="#signin" id="sig" data-toggle="modal" data-target="#myModal" class="info signin"><i class="fa fa-heart-o" style="font-weight:bold"></i></a>
													
												<?php //}else{ ?>
												
													<a href="#" class="info"><i class="fa fa-heart-o" style="font-weight:bold"></i></a>
													
												<?php //} ?>
												
											</div>
										</div-->
										
										</a>
										
                                    </div>
                                </div>
                            
                            	
                            </div><!-- End: recompro_box_img" -->
                            
                            <div class="recompro_box_txt pcct"><!-- Begin: recompro_box_txt" -->	
                            	
								<h6 class="recompro_box_txt_h6" style="width:85% !important;">
									
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
                    

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">    
					<h3 class="border_styles" style="margin-top:25px;">
						<span><a href="<?php echo base_url(); ?>page/catpaginat/category/0">Shop all items</a></span>
					</h3>
				</div>
				
                    
                </div>
            </div><!-- End: recommend_products -->
            
        </div>
                
    </div>
</div><!-- End: inner_page -->


<?php $this->load->view('../../front-templates/footer.php'); ?>
