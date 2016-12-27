<?php
	$this->load->view('../../front-templates/head.php');
	$this->load->view('../../front-templates/header.php');
	$this->load->view('../../front-templates/navigation.php');
	
	extract($pdetails); // Extract product details
	
	$sqlshop = $this->db->query("select * from mega_shops where shopid=$shopid");
	$sqlshopfetch = $sqlshop->row_array();
	extract($sqlshopfetch);
?>

<div id="inner_page"><!-- Begin: inner_page -->
    <div class="container">
    
        
        
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="details_top"><!-- Begin: details_top -->
                	<div class="row">
                    
                    	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                            <div class="dt_lft"><!-- Begin: dt_lft -->
                            	<div class="row">
                                
                                	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <div class="dtl_photo"><!-- Begin: dtl_photo -->
                                        	
											<?php
												if( $shoplogo !== NULL ){
													$shoplog = $shoplogo;
												}else{
													$shoplog = 'shop-logo.png';
												}
											?>
											
											<img src="<?php echo base_url(); ?>assets/frontend/images/shops/<?php echo $shoplog; ?>" class="img-responsive img-thumbnail" alt="Shop Logo" />
											
                                        </div><!-- End: dtl_photo -->
                                    </div>
                                    
                                	<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <div class="dtl_txt"><!-- Begin: dtl_txt -->
                                        	
											<h6 class="dtl_txt_h6">
												
												<a href="#">
													
													<?php echo $shop_name; ?>
													
												</a>
												
											</h6>
                                            <!-- Standard button -->
											
                                            <a href="" class="btn btn-default" style="margin-top:10px;">
												
												<i class="fa fa-heart" style="color:#bebebe"> </i>
												Favorite Shop
												
											</a>
											
                                        </div><!-- End: dtl_txt -->
                                    </div>
                                    
                                </div>
                            </div><!-- End: dt_lft -->
                        </div>
                        
                    	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                            <div class="dt_rt"><!-- Begin: dt_rt -->
                            	<div class="row">
                                	
									<?php
										$shopppimg = explode(',',$product_image);
											
										for($shopppi=0;$shopppi< count($shopppimg);$shopppi++){
											
											// Check product Image NULL Or Not
											if($product_image == NULL){
												$shoppimglocation = base_url()."assets/frontend/images/shops/default-img.jpg";
											}else{
												$sname1 = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shop_name))));
												
												$shoppimglocation = base_url()."assets/frontend/images/shops/$sname1/$shopppimg[$shopppi]";
											}
											
											//echo '<img class="img-responsive" src="'.$shoppimglocation.'" alt="'.$product_name.'" />';
											//break;
											
											echo '
												<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
												<div class="photo_dtails"><!-- Begin: photo_dtails -->
													
													<img class="img-responsive" src="'.$shoppimglocation.'" alt="'.$product_name.'" />
													
												</div><!-- End: photo_dtails -->
											</div>
											';
										}
									?>
									
									
                                    
									
								</div>
                            </div><!-- End: dt_rt -->
                        </div>
						
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
							<div class="photo_dtails img-thumbnail" style="display:block;"><!-- Begin: photo_dtails -->
								
								<h6 class="dt_rt_h6"><?php echo $product_stock; ?></h6>
								
								<p class="dt_rt_p">Items</p>
								
							</div><!-- End: photo_dtails -->
						</div>
                        
                    </div>
                </div><!-- End: details_top -->
            </div>
        </div>
        <div class="clearfix"></div>
        
        <div class="row">
            <div class="pd_wrapper"><!-- Begin: pd_wrapper -->
            
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                    <div class="product_main"><!-- Begin: product_main -->
                    	
                        
                        
                        <div class="row">
                            <div class="like_items"><!-- Begin: like_items -->
                            
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="favorite_like"><!-- Begin: favorite_like -->
                                        <!-- Standard button -->
                                        <a href="favorite.php" class="btn btn-default" style="margin-top:10px;"><i class="fa fa-heart" style="color:#bebebe"> </i> Favorite</a>
                                    </div><!-- End: favorite_like -->
                                </div>
								
                                
                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                    <div class="favorite_like"><!-- Begin: favorite_like -->
                                    	<h6 class="favorite_like_h6">Like this item?</h6>
                                        <p class="favorite_like_p">Add it to your favorites to revisit it later. </p>
                                    </div><!-- End: favorite_like -->
                                </div>
								
                                
                            </div><!-- End: like_items -->
                        </div>
                        <div class="clearfix"></div>
						
						
                        
                        <div class="row">
                            <div class="product_banner"><!-- Begin: product_banner -->
                            
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="pb_main"><!-- Begin: pb_main -->
                                    
                                        <div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 800px; height: 556px; overflow: hidden; visibility: hidden; background-color: #24262e;">
                                            <!-- Loading Screen -->
                                            
											<div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
                                                <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                                                
												<div style="position:absolute;display:block;background:url(<?php echo base_url(); ?>assets/frontend/images/product_banner/loading.gif) no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
                                            </div>
											
											
                                            <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 800px; height: 456px; overflow: hidden;">
                                                
												<?php
													$shopppsliderimg = explode(',',$product_image);
														
													for($shopppi02=0;$shopppi02< count($shopppsliderimg);$shopppi02++){
														
														// Check product Image NULL Or Not
														if($product_image == NULL){
															$shoppimglocation02 = base_url()."assets/frontend/images/shops/default-img.jpg";
														}else{
															$sname02 = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shop_name))));
															
															$shoppimglocation02 = base_url()."assets/frontend/images/shops/$sname02/$shopppsliderimg[$shopppi02]";
														}
														
														//echo '<img class="img-responsive" src="'.$shoppimglocation.'" alt="'.$product_name.'" />';
														//break;
														
														echo '
															<div data-p="144.50" style="display: none;">
                                                    
																<img data-u="image" src="'.$shoppimglocation02.'" />
																
																
																<img data-u="thumb" src="'.$shoppimglocation02.'" />
																
															</div>
														';
													}
												?>
												
												
												
												
                                            </div>
											
											
											
                                            <!-- Thumbnail Navigator -->
                                            <div data-u="thumbnavigator" class="jssort01" style="position:absolute;left:0px;bottom:0px;width:800px;height:100px;background:#e9e9e9" data-autocenter="1">
                                                <!-- Thumbnail Item Skin Begin -->
                                                <div data-u="slides" style="cursor: default;">
                                                    <div data-u="prototype" class="p">
                                                        <div class="w">
                                                            <div data-u="thumbnailtemplate" class="t"></div>
                                                        </div>
                                                        <div class="c"></div>
                                                    </div>
                                                </div>
                                                <!-- Thumbnail Item Skin End -->
                                            </div>
											
                                            <!-- Arrow Navigator -->
                                            <span data-u="arrowleft" class="jssora05l" style="top:158px;left:8px;width:40px;height:40px;"></span>
                                            <span data-u="arrowright" class="jssora05r" style="top:158px;right:8px;width:40px;height:40px;"></span>
											
                                        </div>
                                    
                                    </div><!-- End: pb_main -->
                                </div>
                                                                
                            </div><!-- End: product_banner -->
                        </div>
                        <div class="clearfix"></div>
						
						
						
                        
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="details_tab"><!-- Begin: details_tab -->
                                    <div>
									
									<?php
										$previewsql = $this->db->query("select * from mega_productreviews where shopid=$shopid and productid=$productid");
										
										$previewFetch = $previewsql->result();
										
									?>
                                    
                                      <!-- Nav tabs -->
                                      <ul class="nav nav-tabs details_tab_title" role="tablist">
                                      
                                        <li role="presentation" class="active">
										
											<a href="#item_details" aria-controls="item_details" role="tab" data-toggle="tab">Items Details</a>
										</li>
										
                                        <li role="presentation">
											<a href="#tab_rate" aria-controls="tab_rate" role="tab" data-toggle="tab">
												<i class="fa fa-star" style="color:#ffdc1e"></i>
												<i class="fa fa-star" style="color:#ffdc1e"></i>
												<i class="fa fa-star" style="color:#ffdc1e"></i>
												<i class="fa fa-star" style="color:#ffdc1e"></i>
												<i class="fa fa-star-half-o" style="color:#ffdc1e"></i>
												<?php echo $previewsql->num_rows(); ?>
											</a>
										</li>
                                        
                                        <li role="presentation"><a href="#shipping_policy" aria-controls="shipping_policy" role="tab" data-toggle="tab">Shipping &amp; Policies</a></li>
                                      </ul>
                                    
                                      <!-- Tab panes -->
                                      <div class="tab-content details_tab_content">
                                      
                                        <div role="tabpanel" class="tab-pane active" id="item_details">
                                        
                                        	<p class="item_details_p"> <?php echo $product_item_details; ?> </p>
                                        
                                        </div>
                                        
                                        <div role="tabpanel" class="tab-pane" id="tab_rate">
                                        
                                        	<div class="row">
                                            
                                                
												<?php
													
													if($previewsql->num_rows() >0){
														foreach($previewFetch as $prevviewShow){
															
														$previewUsersql = $this->db->query("select display_name,user_picture from mega_users where userid=$prevviewShow->userid");
													
													extract($previewUsersql->row_array());	
												?>
												
												<div class="rate_profile" id="results"><!-- Begin: rate_profile -->
                                                
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <div class="rate_pic"><!-- Begin: rate_pic -->
                                                        	
															<img src="<?php echo base_url(); ?>assets/frontend/images/users/<?php echo $user_picture; ?>" class="img-responsive img-rounded" alt="<?php echo $display_name; ?> profile picture" />
															
                                                            <h6 class="rate_pic_h6">Reviewed by</h6>
															
                                                            <p class="rate_pic_p">
																
																<a href="#">
																	<?php echo $display_name; ?>
																</a>
																
															</p>
															
                                                        </div><!-- End: rate_pic -->
                                                    </div>
                                                    
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                    
                                                        <div class="rate_details"><!-- Begin: rate_details -->
                                                        
                                                        	<div class="rate_icon">
                                                            
                                                            	<div class="star_rate">
                                                                    
																	<i class="fa fa-star" style="color:#ffdc1e"></i>
																	
																	<i class="fa fa-star" style="color:#ffdc1e"></i>
																	
																	<i class="fa fa-star" style="color:#ffdc1e"></i>
																	
																	<i class="fa fa-star" style="color:#ffdc1e"></i>
																	
																	<i class="fa fa-star-half-full" style="color:#ffdc1e"></i>
																	
                                                                </div>
                                                                
                                                                <div class="star_ratedate">
                                                                	<p class="star_ratedate_p">
																		<?php echo $prevviewShow->product_review_date; ?>
																	</p>
                                                                </div>
                                                                                                                                
                                                            </div>
                                                            
                                                            <p class="rate_details_p">
																<?php echo $prevviewShow->product_review_details; ?>
															</p>
                                                            
                                                        </div><!-- End: rate_details -->
                                                        
                                                    </div>
                                                    
                                                </div><!-- End: rate_profile -->
												
												<?php
														}
													}
												?>
												
												<div align="center">
													<button class="load_more" id="load_more_button">load More</button>
													<div class="animation_image" style="display:none;">
													<img src="<?php echo base_url(); ?>assets/frontend/images/ajax-loader.gif"> Loading...</div>
												</div>
                                                
												
												<!-- Product Review for product -->
                                                <form name="productreview" action="">
													
													<?php
														if( $this->session->userdata('isLogin') == True){
													?>
													
													<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <div class="rate_pic"><!-- Begin: rate_pic -->
														
															<h3>Reviews</h3>
														
														</div>
													</div>
													
													<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                    
                                                        <div class="rate_details" style="margin-top:10px;"><!-- Begin: rate_details -->
														
															<div class="input-group">
																<select style="float:left; margin-bottom:5px;" class="form-control" name="product_rating" id="product_rating">
																
																	<option value="">--- Product Rating ---</option>
																	<option value="1">1</option>
																	<option value="2">2</option>
																	<option value="3">3</option>
																	<option value="4">4</option>
																	<option value="5">5</option>
																	
																</select>
															</div>
														
															<div class="input-group">
																<textarea class="form-control" name="product_review_details" id="product_review_details" cols="50" rows="7"></textarea>
															</div>
															
														<input type="hidden" name="userid" id="userid" value="<?php echo $userid; ?>" />
														
														<input type="hidden" name="shopid" id="shopid" value="<?php echo $shopid; ?>" />
														
														<input type="hidden" name="productid" id="productid" value="<?php echo $productid; ?>" />
														
															
															<div class="input-group">
																
																<div style="float: right !important; margin-top: 12px; width: 460px;">
																
																	<input type="reset" name="productreview" id="productreview" class="btn btn-primary pull-right" value="Save" />
																	
																</div>
																
															</div>
															
															
																
																<span id="result"></span>
																
															
															
														</div>
													</div>
													
													<?php }else{ ?>
													
													<div class="col-lg-12 col-md-13 col-sm-12 col-xs-12">
													
														<h4>
															<a data-target="#myModal" data-toggle="modal" href="#register">
															
																Put your review about this product.
																
															</a>
														</h4>
													
													</div>
													
													<?php } ?>
													
												</form>

                                                
                                                
                                            </div>
                                        
                                        </div>
                                        
                                        <div role="tabpanel" class="tab-pane" id="shipping_policy">
										
											<?php
												$nvsd_queryShippingPolicy 	= $this->db->query("SELECT * FROM mega_shippingdetails where shopid='".$shopid."' AND productid='".$productid."'");
												$nvsd_resultsShippingPolicy = $nvsd_queryShippingPolicy->row_array();
												extract($nvsd_resultsShippingPolicy);
											?>
                                        
                                        	<div class="payment_box01">
                                            	<h3 class="payment_box_h3">Payment methods</h3>
                                                <ul>
                                                	<li><img src="<?php echo base_url(); ?>assets/frontend/images/interface/payment01.png" class="img-responsive" /></li>
                                                	<li><img src="<?php echo base_url(); ?>assets/frontend/images/interface/payment02.png" class="img-responsive" /></li>
                                                	<li><img src="<?php echo base_url(); ?>assets/frontend/images/interface/payment03.png" class="img-responsive" /></li>
                                                	<li><img src="<?php echo base_url(); ?>assets/frontend/images/interface/payment04.png" class="img-responsive" /></li>
                                                </ul>
												
                                                <p class="payment_box01_p">
													Ready to ship in <?php echo $processing_time; ?>.
												</p>
												
                                            </div>
                                            
                                        	<div class="payment_box02">
                                            	<h3 class="payment_box_h3">Shipping costs</h3>
                                                <div class="row">
                                                
                                                	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                                    	<div class="pay_cost">
                                                            
															<select name="shippingto" class="form-control">
                                                              
															  <option value="United States">United States</option>
															  
                                                            </select>
															
                                                        </div>
                                                    </div>
                                                    
                                                	<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                                    	<div class="pay_cost">
                                                        	
															<p class="pay_cost_p">
																<span>Shipping cost by itself </span>
																$<?php
																	if(!empty($shipping_cost_by_itself)){
																		echo $shipping_cost_by_itself;
																	}else{ echo number_format(0); }
																?> USD 
															</p>
                                                        	
															<p class="pay_cost_p">
																<span>Shipping cost with another items </span>
																$<?php
																	if(!empty($shipping_cost_with_another_items)){
																		echo $shipping_cost_with_another_items;
																	}else{ echo number_format(0); }
																?> USD 																
															</p>
															
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        
                                        	<div class="payment_box02">
                                            	<h3 class="payment_box_h3">Our policies</h3>
                                                
                                                <div class="row">
                                                
												
												
                                                	<div class="ppolicy_box">
                                                        
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="pay_policies">
                                                                
																<p class="pay_policies_p">
																
																	<?php
																		if(!empty($product_shopping_policy)){
																			echo $product_shopping_policy;
																		}else{ echo ''; }
																	?>
																
																</p>
	
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                	

                                                	
                                                    
                                                </div>
                                                
                                            </div>

                                        </div>
                                        
                                      </div>
                                    
                                    </div>
                                </div><!-- End: details_tab -->
                            </div>
                        </div>
                        
                        
                    </div><!-- End: product_main -->
                </div>
                
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                
                    <div class="details_sidebar"><!-- Begin: details_sidebar -->
                    
						<form class="form-horizantal" action="">
						
                    	<div class="row">
                        	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="sideproduct_box"><!-- Begin: sideproduct_box -->
                                	
									<h6 class="sideproduct_box_h3">
										<b><?php echo $product_name; ?></b>
									</h6>
									
                                    <div class="row">
                                    
                                        <div class="price_quetion"><!-- Begin: price_quetion -->
                                        
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="priceque_box"><!-- Begin: priceque_box -->
                                                    
													<h3 class="price_quetionbox_h3">
														$<?php echo $product_price; ?><span class="span_color"> USD</span>
													</h3>
													
                                                    <p class="available_itemsp">
														
														<?php if($product_stock > 0){ ?>
														
														Available
														<span class="span_color">
															<?php echo $product_stock; ?> Items
														</span>
														
														<?php }else{
																echo "<span class='btn btn-danger soldout'>Soldout</span>";
															}
														?>
														
													</p>
													
                                                </div><!-- End: priceque_box -->
                                            </div>
                                            
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="priceque_box"><!-- Begin: priceque_box -->
                                                    <a type="button" data-toggle="modal" data-target="#myModal3" class="btn btn-default priceque_box_p">Ask a question</a>
                                                    <div class="contact_modal">
                                                        <!-- Modal -->
                                                        <div class="modal fade bs-example-modal-sm" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                          <div class="modal-dialog modal-sm" role="document">
                                                            <div class="modal-content">
                                                            
                                                              <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                <h4 class="profile_contact_h4" id="myModalLabel">New conversation</h4>
                                                                <p class="profile_contact_p">with Refat Hasan</p>
                                                              </div>
                                                              
                                                              <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                        <div class="profile_contact">
                                                                            <form>
                                                                              <div class="form-group">
                                                                                <label for="exampleInputEmail1">Subject</label>
                                                                                <input type="email" class="form-control" placeholder="Enter subject">
                                                                              </div>
                                                                              <div class="form-group">
                                                                                <label for="exampleInputEmail1">Message</label>
                                                                                <textarea rows="3" cols="3" class="form-control" placeholder="Enter message"></textarea>
                                                                              </div>
                                                                              <div class="form-group">
                                                                                <label for="exampleInputFile">Attached image</label>
                                                                                <input type="file" id="exampleInputFile">
                                                                              </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                              </div>
                                                              
                                                              <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary">Send</button>
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div><!-- End: priceque_box -->
                                            </div>
                                            
                                        </div><!-- End: price_quetion -->
                                                                            
                                    </div>
                                    
                                    <div class="row">
                                    
                                        <div class="select_price"><!-- Begin: select_price -->
                                        
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="select_pricebox"><!-- Begin: select_pricebox -->
                                                    <p class="select_pricebox_p">Quantity</p>
													
                                                    <select name="quantity" class="form-control">
														
														<option value="">--- Select quantity ---</option>
														<?php for($q=1;$q<=100;$q++){ ?>
														
															<option value="<?php echo $q; ?>"><?php echo $q; ?></option>
															
														<?php } ?>
													  
                                                    </select>
                                                    
                                                </div><!-- End: select_pricebox -->
                                            </div>
                                            
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="select_pricebox"><!-- Begin: select_pricebox -->
                                                    
													
													<?php
														// Get all Option groups name
														$shopPoptions = $this->db->query("select * from mega_productoptions where product_id=$productid GROUP BY option_group_id");
														
														$shopPFetch = $shopPoptions->result();
														
														foreach($shopPFetch as $shopPview){
															
															$optgroupid = $shopPview->option_group_id;
															
															// Get all Options name
															$shopPoptionGroup = $this->db->query("select * from mega_optiongroups where optiongroup_id=$optgroupid");
														
															$shopPGroupFetch = $shopPoptionGroup->row_array();
															extract($shopPGroupFetch);
													?>
													
													<p class="select_pricebox_p">
														<b><?php echo $option_group_name; ?></b>
													</p>
													
                                                    <select name="<?php echo $option_group_name; ?>" class="form-control" style="float:left; margin-bottom:5px;">
														<option value="">--- Select <?php echo $option_group_name; ?> ---</option>
														<?php
															$shopPoptionsdtls = $this->db->query("select * from mega_productoptions where product_id=4 AND option_group_id=$optgroupid GROUP BY option_group_id");
														
															$shopPdtlsFetch = $shopPoptionsdtls->result();
															
															foreach($shopPdtlsFetch as $shopdtlsPview){
														?>
														
														<option value="<?php echo $shopdtlsPview->option_details; ?>">
															<?php echo $shopdtlsPview->option_details; ?>
														</option>
														
														<?php } ?>
														
                                                    </select>
													
													<?php } ?>
													
													
                                                </div><!-- End: select_pricebox -->
                                            </div>
                                            
                                        </div><!-- End: select_price -->
                                                                            
                                    </div>
                                    
                                    <div class="row">
                                    
                                        <div class="overview"><!-- Begin: overview -->
                                        
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="overview_main"><!-- Begin: overview_main -->
                                                	<h6 class="overview_main_h6"><b>Overview</b></h6>
                                                	
													<?php echo $product_overview; ?>
													
                                                </div><!-- End: overview_main -->
                                            </div>
                                                                                        
                                        </div><!-- End: overview -->
                                                                            
                                    </div>
                                    
                                    <div class="row">
                                    
                                        <div class="adtocart"><!-- Begin: adtocart -->
                                        
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="adtocart_inner"><!-- Begin: adtocart_inner -->
                                                    
													<a type="button" class="btn btn-success" style="width:50%; text-align:center;">
														Add to cart
													</a>
													
                                                </div><!-- End: adtocart_inner -->
                                            </div>
                                                                                        
                                        </div><!-- End: adtocart -->
                                                                            
                                    </div>
                                    
                                </div><!-- End: sideproduct_box -->
                            </div>
                        </div>
						
						</form>
						
                        <div class="clearfix"></div>
						
						
                        
                        <div class="row">
                        	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="sideproduct_box01"><!-- Begin: sideproduct_box01 -->
                                	
                                    <div class="row">
                                    
                                    	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="dp_favorite"><!-- Begin: dp_favorite -->
                                                <!-- Standard button -->
                                                <a type="button" href="favorite.php" class="btn btn-default"><i class="fa fa-heart-o"></i> <span class="adtocart_p">Favorite</span></a>
                                            </div><!-- End: dp_favorite -->
                                        </div>
                                        
                                    	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-0">
                                            <div class="dp_favorite"><!-- Begin: dp_favorite -->
                                                <ul class="nav nav-pills" style="display:none;">
                                                  <li role="presentation" class="dropdown">
                                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                                      <i class="fa fa-list default"></i> <span class="adtocart_p">Add to</span> <span class="caret"></span>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                      <li><a href="#">Home</a></li>
                                                      <li><a href="#">Home</a></li>
                                                      <li><a href="#">Home</a></li>
                                                    </ul>
                                                  </li>
                                                </ul>
                                            </div><!-- End: dp_favorite -->
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="dp_social"><!-- Begin: dp_social -->
                                        	<ul>
                                            	<li><a href="#"><img src="<?php echo base_url(); ?>assets/frontend/images/interface/pd_social01.png" alt="Social" /></a></li>
                                            	<li><a href="#"><img src="<?php echo base_url(); ?>assets/frontend/images/interface/pd_social02.png" alt="Social" /></a></li>
                                            	<li><a href="#"><img src="<?php echo base_url(); ?>assets/frontend/images/interface/pd_social03.png" alt="Social" /></a></li>
                                            	<li><a href="#"><img src="<?php echo base_url(); ?>assets/frontend/images/interface/pd_social04.png" alt="Social" /></a></li>
                                            </ul>
                                        </div><!-- End: dp_social -->
                                    </div>
                                    
                                </div><!-- End: sideproduct_box01 -->
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        
                        <div class="row">
                        	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="sideproduct_box02"><!-- Begin: sideproduct_box02 -->
                                	
                                    <div class="row">
                                    
                                    	
										
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-xs-offset-0">
                                            
											
											
											<div class="dsp_top"><!-- Begin: dsp_top -->
                                            	
												<?php
													if( $shoplogo !== NULL ){
														$shoplog = $shoplogo;
													}else{
														$shoplog = 'shop-logo.png';
													}
												?>
												
												<img src="<?php echo base_url(); ?>assets/frontend/images/shops/<?php echo $shoplog; ?>" class="img-responsive img-rounded" alt="Shop Logo" />
												
                                            	<h3 class="dsp_top_h3"><?php echo $shop_name; ?></h3>
												
                                            </div><!-- End: dsp_top -->
											
											
                                        </div>
										
										
                                        
                                    </div>
                                    <div class="clearfix"></div>

                                    
                                    <div class="dp_main"><!-- Begin: dp_main -->
                                        <div class="row">
                                        
                                            
											<?php
												$nvsd_queryShopRelatedP = $this->db->query("SELECT * FROM mega_products where shopid='".$shopid."' order by rand() LIMIT 8");
												
												$nvsd_resultsShopRelatedP 	= $nvsd_queryShopRelatedP->result();
												
												foreach($nvsd_resultsShopRelatedP as $viewShopRelatedP){
											?>
											
											
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="dsp_box"><!-- Begin: dsp_box -->
                                                
                                                    <div class="dsp_box_img"><!-- Begin: dsp_box_img" -->
                                                    
                                                    
                                                        <div class="main view-third">
                                                            <!-- THIRD EXAMPLE -->
                                                            

															
															<div class="view2">
                        
                                                              <a href="<?php echo base_url(); ?>page/pdetails/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $viewShopRelatedP->product_name)))))))); ?>/<?php echo $viewShopRelatedP->productid; ?>">
															  
															  <?php
																$shoprppimg = explode(',',$viewShopRelatedP->product_image);
																	
																for($shoprppi=0;$shoprppi< count($shoprppimg);$shoprppi++){
																	
																	// Check product Image NULL Or Not
																	if($viewShopRelatedP->product_image == NULL){
																		$shoprpimglocation = base_url()."assets/frontend/images/shops/default-img.jpg";
																	}else{
																		$snameshoprp = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shop_name))));
																		
																		$shoprpimglocation = base_url()."assets/frontend/images/shops/$snameshoprp/$shoprppimg[$shoprppi]";
																	}
																	
																	echo '<img class="img-responsive" src="'.$shoprpimglocation.'" alt="'.$viewShopRelatedP->product_name.'" />';
																	break;
																}
															?>
															  
															</a>
															
															<div class="mask">
																<div class="heart_rate">
																	
																	<?php
																		if($this->session->userdata('isLogin') == FALSE){
																	?>
																		<a href="#" data-toggle="modal" data-target="#myModal" class="info"><i class="fa fa-heart-o" style="font-weight:bold"></i></a>
																		
																	<?php }else{ ?>
																	
																		<a href="#" class="info"><i class="fa fa-heart-o" style="font-weight:bold"></i></a>
																		
																	<?php } ?>
																	
																</div>
															</div>
															
                                                            </div>
                                                        </div>
                                                    
                                                        
                                                    </div><!-- End: dsp_box_img" -->
                                                    
                                                    <div class="dsp_box_txt"><!-- Begin: dsp_box_txt" -->	
                                                        
														<h6 class="dsp_box_txt_h6">
															
															<a href="<?php echo base_url(); ?>page/pdetails/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $viewShopRelatedP->product_name)))))))); ?>/<?php echo $viewShopRelatedP->productid; ?>">
															
																<?php
																	echo substr($viewShopRelatedP->product_name,0,23);
																?>...
															</a>
															
														</h6>
														
                                                        <p class="dsp_box_txt_p">
															
															<span class="dsp_box_txtspan">
																<i class="fa fa-usd"></i>
																<?php
																	echo $viewShopRelatedP->product_price;
																?> USD
															</span>
															
														</p>
														
                                                    </div><!-- End: dsp_box_txt" -->
                                                    
                                                </div><!-- End: dsp_box -->
                                            </div>
											
											
											<?php } ?>
                                            
                                            
                                            
                                                                        
                                        </div>
                                    </div><!-- End: dp_main -->
                                        
                                    
                                </div><!-- End: sideproduct_box02 -->
                            </div>
                        </div>
                        
                    </div><!-- End: details_sidebar -->
                    
                    
                </div>
                
            </div><!-- End: pd_wrapper -->
        </div>

                
    </div>
</div><!-- End: inner_page -->


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript">

$(function() {

	// Product review 
	$('#productreview').click(function() {

		//get input data as a array
		var post_data = {
			'userid'				: $("#userid").val(),
			'shopid'				: $("#shopid").val(),
			'productid'				: $("#productid").val(),
			'product_rating'		: $("#product_rating").val(),
			'product_review_details': $("#product_review_details").val(),
			'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
		};

		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>page/preview",
			data: post_data,
			success: function(product_review_details) {
				// return success message to the id='result' position
				$("#result").html(product_review_details);
			}
		});

	});


});
</script>

</script>


<?php $this->load->view('../../front-templates/footer.php'); ?>
