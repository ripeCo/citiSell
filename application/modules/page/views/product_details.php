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
                <div class="details_top0"><!-- Begin: details_top -->
                	<div class="row">
                    
                    	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                            <div class="dt_lft0"><!-- Begin: dt_lft -->
                            	<div class="row">
                                
                                	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <div class="dtl_photo"><!-- Begin: dtl_photo -->
                                        	
											<a style="color:#FF8F27;font-weight:bold;" href="<?php echo base_url(); ?>page/yourshop/viewshop/<?php echo $shopid; ?>">
											
												<?php
													if( $shoplogo !== NULL ){
														$shoplog = $shoplogo;
														$sname = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shop_name))));
												?>
											
												<img src="<?php echo base_url(); ?>assets/frontend/images/shops/<?php echo $sname.'/'.$shoplog; ?>" class="img-responsive img-thumbnail" alt="Shop Logo" />
												
												<?php }else{ ?>
												
												<img src="<?php echo base_url(); ?>assets/frontend/images/shops/nologo.jpg" class="img-responsive img-thumbnail" alt="Shop Logo" />
												
												<?php } ?>
											
											</a>
											
                                        </div><!-- End: dtl_photo -->
                                    </div>
                                    
                                	<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <div class="dtl_txt"><!-- Begin: dtl_txt -->
                                        	
											<h6 class="dtl_txt_h6">
												
												<a class="btn btn-default btn-lg" href="<?php echo base_url(); ?>page/yourshop/viewshop/<?php echo $shopid; ?>">
													
													<?php echo $shop_name; ?>
													
												</a>
												
											</h6>
                                            <!-- Standard button -->
											
											
                                        </div><!-- End: dtl_txt -->
                                    </div>
                                    
                                </div>
                            </div><!-- End: dt_lft -->
                        </div>
                        
                    	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                            <div class="dt_rt0"><!-- Begin: dt_rt -->
                            	<div class="row">
									<?php
										$get_product_photos = $this->yourshop_model->get_photoby_product(intval($productid));
										foreach($get_product_photos as $photo){
									?>
										<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
											<div class="photo_dtails"><!-- Begin: photo_dtails -->
											
											<?php $img_path =  base_url().'assets/frontend/images/shops/'.str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $photo['shopname'])))).'/'.$photo['pic_name']; ?>
												<img class="img-responsive" src="<?php echo $img_path; ?>" alt="" />
											</div><!-- End: photo_dtails -->
										</div>
									<?php } ?>
								</div>
                            </div><!-- End: dt_rt -->
                        </div>
						
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
							<div class="photo_dtails img-thumbnail" style="display:block;height: 123px;background: #ecefe3 none repeat scroll 0 0;"><!-- Begin: photo_dtails -->
								
								<div class="item-stocks">
									
									<h6 class="dt_rt_h6"><?php echo $product_stock; ?></h6>
									
									<p class="dt_rt_p">Items InStock</p>
								
								</div>
								
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
                            
                                <h6 class="sideproduct_box_h3">
									<b><?php echo $product_name; ?></b>
								</h6>
                                
                            </div><!-- End: like_items -->
                        </div>
                        <div class="clearfix"></div>
						
						
                        
                        <div class="row">
                           <?php if($this->session->userdata('shopopen') == $shopid && $this->session->userdata('isLogin') == True){ ?>
								
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
									
									<div style="padding:12px 26px;">
										
										<span class="modify">
											<a class="btn btn-success mdfy" title="Edit" href="<?php echo base_url(); ?>page/yourshop/pedit/<?php echo $productid; ?>">
												
												<i class="fa fa-pencil"></i>
												Edit
												
											</a>
										</span>
										
										<span class="modify">
											<a class="btn btn-success mdfy" title="Active" href="<?php echo base_url(); ?>page/yourshop/pedit/<?php echo $productid; ?>">
												<i class="fa fa-check-square"></i>
												Active
											</a>
										</span>
										
										<span class="modify">
											<a class="btn btn-success mdfy" title="Deactive" href="<?php echo base_url(); ?>page/yourshop/pedit/<?php echo $productid; ?>">
											
												<i class="fa fa-times-circle"></i>
												Deactivate
											</a>
										</span>
										
										<!--span class="modify">
											<a class="btn btn-success mdfy" title="Renew" href="<?php echo base_url(); ?>page/yourshop/pedit/<?php //echo $productid; ?>">
												Renew
											</a>
										</span-->
									
									</div>
									
								</div>
							
							<?php } ?>
							
							
							<div class="product_banner"><!-- Begin: product_banner -->
                            
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="pb_main"><!-- Begin: pb_main -->
                                    
                                        <div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 600px; height: 571px; overflow: hidden; visibility: hidden;">
                                            <!-- Loading Screen -->
                                            
											<div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
                                                <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                                                
												<div style="position:absolute;display:block;background:url(<?php echo base_url(); ?>assets/frontend/images/product_banner/loading.gif) no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
                                            </div>
											
											
                                            <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 600px; height: 557px; overflow: hidden;background-color: #fff !important;">
                                                <?php
													$get_product_photos = $this->yourshop_model->get_photoby_product(intval($productid));
													
													if(count($get_product_photos) !== 0){
													$shoppimglocation02 = base_url()."assets/frontend/images/shops/default-img.jpg";
													foreach($get_product_photos as $photo){
												?>
													<?php $img_path =  base_url().'assets/frontend/images/shops/'.str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $photo['shopname'])))).'/'.$photo['pic_name']; ?>
													<div data-p="144.50" style="display: none;">
														<img class="pdetailsimg" data-u="image" src="<?php echo $img_path; ?>" />
														<img data-u="thumb" src="<?php echo $img_path; ?>" />
													</div>
												<?php }?>
												
												<?php }else{ ?>
													<div data-p="144.50" style="display: none;">
														<img class="pdetailsimg" data-u="image" src="<?php echo $shoppimglocation02; ?>" />
														<img data-u="thumb" src="<?php echo $shoppimglocation02; ?>" />
													</div>
												<?php } ?>
												
                                            </div>
											
											
                                            <!-- Thumbnail Navigator -->
                                            <div data-u="thumbnavigator" class="jssort01" style="position:absolute;left:0px;bottom:-75px;width:600px;height:86px;background:#e9e9e9" data-autocenter="1">
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
                                            <span data-u="arrowleft" class="jssora05l" style="height: 40px !important; left: 8px !important; top: 263px !important; width: 40px !important;">
												<i class="fa fa-chevron-circle-left" aria-hidden="true"></i>

											</span>
                                            
											<span data-u="arrowright" class="jssora05r" style="height: 40px !important; left: 551px !important; position: absolute !important; right: 8px !important; top: 263px !important; width: 40px !important;">
												<i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
											</span>
											
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
										$previewsql = $this->db->query("select * from mega_productreviews where shopid=$shopid and productid=$productid order by product_reviewid DESC LIMIT 50");
										
										$prevcsql = $this->db->query("select SUM(product_rating) as prate from mega_productreviews where shopid=$shopid and productid=$productid");
										
										if($prevcsql->num_rows() >0){
											extract($prevcsql->row_array());
										}
										
										$previewFetch = $previewsql->result();
										
										$numrev = $previewsql->num_rows();
										
										//$pratings = calculateStarRating($prate,$numrev);
										//echo $pratings;
										
									?>
                                    
                                      <!-- Nav tabs -->
                                      <ul class="nav nav-tabs details_tab_title" role="tablist">
                                      
                                        <li role="presentation" class="active">
										
											<a href="#item_details" aria-controls="item_details" role="tab" data-toggle="tab">Item Description</a>
										</li>
										
                                        <li role="presentation">
											<a href="#tab_rate" aria-controls="tab_rate" role="tab" data-toggle="tab">
												
												<?php echo calculateStarRating($prate,$numrev); ?>
												
												<?php echo $previewsql->num_rows(); ?>
											</a>
										</li>
                                        
                                        <li role="presentation"><a href="#shipping_policy" aria-controls="shipping_policy" role="tab" data-toggle="tab">Shipping &amp; Policies</a></li>
                                      </ul>
                                    
                                      <!-- Tab panes -->
                                      <div class="tab-content details_tab_content">
                                      
                                        <div role="tabpanel" class="tab-pane active" id="item_details">
                                        
                                        	<p class="item_details_p">
												&nbsp;&nbsp;&nbsp;&nbsp;
												<?php echo $product_item_details; ?>
											</p>
                                        
                                        </div>
                                        
                                        <div role="tabpanel" class="tab-pane" id="tab_rate">
                                        
                                        	<div class="row">
											
											<a id="previews"></a>
											
												<!-- Product Review for product -->
                                                <form name="productreview" method="post" action="<?php echo base_url(); ?>page/preview/pid/<?php echo $productid; ?>">
													
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
															
														<input type="hidden" name="userid" id="userid" value="<?php echo $this->session->userdata('userid'); ?>" />
														
														<input type="hidden" name="shopid" id="shopid" value="<?php echo $shopid; ?>" />
														
														<input type="hidden" name="productid" id="productid" value="<?php echo $productid; ?>" />
														
															
															<div class="input-group">
																
															<div style="float: right !important; margin-top: 12px; width: 460px;">
															
															<!--input type="reset" name="productreview" id="productreview" class="btn btn-primary pull-right" value="Post Review" /-->
															
															<input type="submit" name="productreview" class="btn btn-primary pull-right" value="Post Review" />
																	
																</div>
																
															</div>
															
																
														</div>
													</div>
													
													<?php }else{ ?>
													
													<div class="col-lg-12 col-md-13 col-sm-12 col-xs-12">
													
														<h4 class="putProductReview">
															<a data-target="#myModal" data-toggle="modal" class="signin" id="#sig" href="#signin">
															
																Put your review about this product.
																
															</a>
														</h4>
													
													</div>
													
													<?php } ?>
													
												</form>
                                            
                                                
												<?php
													
													if($previewsql->num_rows() >0){
														foreach($previewFetch as $prevviewShow){
															
														$previewUsersql = $this->db->query("select display_name,user_picture from mega_users where userid=$prevviewShow->userid");
													
														extract($previewUsersql->row_array());
														
														//$pdtls = base_url().'page/view/product_details.php';
												?>



												<div class="rate_profile" id="result"><!-- Begin: rate_profile -->

													<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
														<div class="rate_pic"><!-- Begin: rate_pic -->
															
															<a href="<?php echo base_url(); ?>page/user/userprofile/<?php echo $prevviewShow->userid; ?>">
															
																<img src="<?php echo base_url(); ?><?php if($user_picture !== ''){echo 'assets/frontend/images/users/'.$user_picture;}else{ echo 'assets/frontend/images/default-avatar.v9899025-75x75.gif'; } ?>" class="img-responsive img-rounded" alt="<?php echo $display_name; ?> profile picture" />
															
															</a>
															
															<h6 class="rate_pic_h6">Reviewed by</h6>
															
															<p class="rate_pic_p">
																
																<a href="<?php echo base_url(); ?>page/user/userprofile/<?php echo $prevviewShow->userid; ?>">
																	<?php echo $display_name; ?>
																</a>
																
															</p>
															
														</div><!-- End: rate_pic -->
													</div>
													
													<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
													
														<div class="rate_details"><!-- Begin: rate_details -->
														
															<div class="rate_icon">
															
																<div class="star_rate">
																	
																	<?php echo cuserreviewStarRating($prevviewShow->product_rating); ?>
																	
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

                                                
                                                
                                            </div>
                                        
                                        </div>
                                        
                                        <div role="tabpanel" class="tab-pane" id="shipping_policy">
										
											<?php
												$nvsd_queryShippingPolicy 	= $this->db->query("SELECT * FROM mega_shippingdetails where shopid='".$shopid."' AND productid='".$productid."'");
												$nvsd_resultsShippingPolicy = $nvsd_queryShippingPolicy->row_array();
												
												if($nvsd_queryShippingPolicy->num_rows() >0){
													extract($nvsd_resultsShippingPolicy);
												}
											?>
                                        
                                        	<div class="payment_box01">
                                            	<h3 class="payment_box_h3">Payment methods</h3>
                                                <ul>
                                                	
													<li>
														<img alt="American Express" src="<?php echo base_url(); ?>assets/frontend/images/interface/payment01.png" class="img-responsive" />
													</li>
													
                                                	<li>
														<img alt="Master Card" src="<?php echo base_url(); ?>assets/frontend/images/interface/payment02.png" class="img-responsive" />
													</li>
													
                                                	<li>
														<img alt="Discover" src="<?php echo base_url(); ?>assets/frontend/images/interface/discover-80.png" class="img-responsive" />
													</li>
													
                                                	<li>
														<img alt="Paypal" src="<?php echo base_url(); ?>assets/frontend/images/interface/payment03.png" class="img-responsive" />
													</li>
													
                                                	<li>
														<img alt="Visa Card" src="<?php echo base_url(); ?>assets/frontend/images/interface/payment04.png" class="img-responsive" />
													</li>
													
                                                </ul>
												
                                                <p class="payment_box01_p">
													Ready to ship in <?php if(!empty($processing_time)){echo $processing_time;} ?>.
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
                                                        <?php
																	
															$sqlshopPolicy = $this->db->query("select * from mega_shopsettings where shopid=$shopid");
															$sqlshopPolicyfetch = $sqlshopPolicy->row_array();
															
															if($sqlshopPolicy->num_rows() >0){
																extract($sqlshopPolicyfetch);
															}
														
														?>
													
												
                                                	<div class="ppolicy_box">
														
														<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                            <div class="pay_policies">
                                                                <p class="pay_policies_pl">
																	<h5>Payment Policy</h5>
																</p>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                            <div class="pay_policies">
                                                                <p class="pay_policies_p">
																	<?php if(!empty($paymentpolicy)){echo $paymentpolicy;}else{echo 'Not yet set';} ?>
																</p>
                                                            </div>
                                                        </div>
														
                                                    </div>
													
												
                                                	<div class="ppolicy_box">
														
														<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                            <div class="pay_policies">
                                                                <p class="pay_policies_pl">
																	<h5>Shipping Policy</h5>
																</p>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                            <div class="pay_policies">
                                                                <p class="pay_policies_p">
																	<?php if(!empty($shippingpolicy)){echo $shippingpolicy;}else{echo 'Not yet set';} ?>
																</p>
                                                            </div>
                                                        </div>
														
                                                    </div>
													
												
                                                	<div class="ppolicy_box">
														
														<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                            <div class="pay_policies">
                                                                <p class="pay_policies_pl">
																	<h5>Refund Policy</h5>
																</p>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                            <div class="pay_policies">
                                                                <p class="pay_policies_p">
																	<?php if(!empty($refundpolicy)){echo $refundpolicy;}else{echo 'Not yet set';} ?>
																</p>
                                                            </div>
                                                        </div>
														
                                                    </div>
													
												
                                                	<div class="ppolicy_box">
														
														<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                            <div class="pay_policies">
                                                                <p class="pay_policies_pl">
																	<h5>Additional Info</h5>
																</p>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                            <div class="pay_policies">
                                                                <p class="pay_policies_p">
																	<?php if(!empty($additionalinfo)){echo $additionalinfo;}else{echo 'Not yet set';} ?>
																</p>
                                                            </div>
                                                        </div>
														
                                                    </div>
													
												
                                                	<div class="ppolicy_box">
														
														<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                            <div class="pay_policies">
                                                                <p class="pay_policies_pl">
																	<h5>Private Receipt Info</h5>
																</p>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                            <div class="pay_policies">
                                                                <p class="pay_policies_p">
																	<?php if(!empty($privatereceiptinfo)){echo $privatereceiptinfo;}else{echo 'Not yet set';} ?>
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
                    
						<form class="form-horizantal" accept-charset="utf-8" method="post" action="<?php echo base_url(); ?>page/cart/savecrt">
						
                    	<div class="row">
                        	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="sideproduct_box"><!-- Begin: sideproduct_box -->
                                	
									
									
                                    <div class="row">
                                    
                                        <div class="price_quetion mrgt"><!-- Begin: price_quetion -->
                                        
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="priceque_box"><!-- Begin: priceque_box -->
													
													<h3 class="price_quetionbox_h3">
														<b>Price : </b>
														$<?php echo $product_price; ?><span class="span_color"> USD</span>
													</h3>
													
                                                    <p class="available_itemsp">
														
														<?php if($product_stock > 0){ ?>
														
														<b>Available</b>
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
                                                   
													<!--a type="button" data-toggle="modal" data-target="#myModal3" class="btn btn-default priceque_box_p">Ask a question</a-->
													
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
                                    
									<input type="hidden" name="shippinghome" value="<?php echo $shipping_cost_by_itself; ?>" />
									<input type="hidden" name="shippingint" value="<?php echo $shipping_cost_int_by_itself ; ?>" />
									
                                    <div class="row">
                                    
                                        <div class="select_price"><!-- Begin: select_price -->
                                        
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="select_pricebox"><!-- Begin: select_pricebox -->
                                                    <p class="select_pricebox_p">Quantity</p>
													
                                                    <select required="required" name="quantity" class="form-control">
														
														<option value="">--- Select quantity ---</option>
														<?php for($q=1;$q<=$product_stock;$q++){ ?>
														
															<option <?php if($q == 1){ echo 'selected="selected"'; } ?> value="<?php echo $q; ?>"><?php echo $q; ?></option>
															
														<?php } ?>
													  
                                                    </select>
                                                    
                                                </div><!-- End: select_pricebox -->
                                            </div>
											
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="select_pricebox"><!-- Begin: select_pricebox -->
                                                    
													
													<?php
														// Get all Option groups name
														$shopPoptions = $this->db->query("select * from mega_productvariations where productid=$productid GROUP BY optiongroupid");
														
														$shopPFetch = $shopPoptions->result();
														
														foreach($shopPFetch as $shopPview){
															
															$optgroupid = $shopPview->optiongroupid;
															
															// Get all Options name
															$shopPoptionGroup = $this->db->query("select * from mega_optiongroups where optiongroup_id=$optgroupid");
														
															$shopPGroupFetch = $shopPoptionGroup->row_array();
															if($shopPoptionGroup->num_rows() >0){
																extract($shopPGroupFetch);
															
													?>
													
													<p class="select_pricebox_p">
														<b>
														<?php if($option_group_name !== NULL){echo $option_group_name;} ?>
														</b>
													</p>
													
                                                    <select required name="<?php if($option_group_name !== NULL){echo strtolower($option_group_name);} ?>" class="form-control" style="float:left; margin-bottom:5px;">
														<option value="">--- Select <?php if($option_group_name !== NULL){echo $option_group_name;} ?> ---</option>
														<?php
															$shopPoptionsdtls = $this->db->query("select * from mega_productvariations where productid=$productid AND optiongroupid=$optgroupid");
														
															$shopPdtlsFetch = $shopPoptionsdtls->result();
															
															foreach($shopPdtlsFetch as $shopdtlsPview){
														?>
														<option value="<?php echo trim($shopdtlsPview->optionname.' '.$shopdtlsPview->measuringunits); ?>">
															<?php echo $shopdtlsPview->optionname.' '.$shopdtlsPview->measuringunits; ?>
														</option>
														<?php } ?>
                                                    </select>
													<?php } } ?>
                                                </div><!-- End: select_pricebox -->
                                            </div>
											<div class="col-lg-12">
												<!-- Product Overview -->
									<div class="p-overview">
										
										<!--h4>Item Overview :</h4-->
										
										<p class="ovp">
											<b>
											<i class="fa fa-check"></i> 
											Shipping From - </b> : 
											<?php
												echo $product_location;
											?>
										</p>
										
										<p class="ovp">
											<b>
											<i class="fa fa-check"></i> 
											Shipping Category - </b> :
											
										</p>
										
										<p class="ovp">
											<b>
											<i class="fa fa-check"></i> 
											Ship Within - </b> :
											<?php
												if(!empty($processing_time)){echo $processing_time;}
											?><br/><i>(You must count the delivery day after)</i>
										</p>
										
										<p class="ovp">
											<b>
											<i class="fa fa-check"></i> 
											Product - </b> : 
											<?php
												if($who_made == 'i_did'){
													echo 'Hand Made';
												}else{
													$splitr = split('_',$who_made);
													echo ucfirst($splitr[0]).' ';
													echo ucfirst($splitr[1]);
												}
											?>
										</p>
										
										
										<p class="ovp">
											<b>
											<i class="fa fa-check"></i> 
											Materials - </b> : 
											<?php 
												$get_materials = $this->yourshop_model->get_materials($productid);
											?>
											<?php if(count($get_materials) !== 0){ ?>
												<?php foreach($get_materials as $material){ ?>
												<?php echo ucfirst($material['material_title']).", "; ?>
												<?php } ?>
											<?php }else{ echo null; } ?>
											
											<?php
												echo ucfirst($materials);
											?>
										</p>
										
										<p class="brdrN">&nbsp;</p>
										
										<p>
											<b>
											<i class="fa fa-money"></i> 
											We Accept Payments : </b>
											<p class="brdrN">&nbsp;</p>
											
											<ul class="payments-accept">
                                                
												<li>
													<img alt="Paypal" src="<?php echo base_url(); ?>assets/frontend/images/interface/payment03.png" class="img-responsive" />
												</li>
												
												<li>
													<img alt="Master Card" src="<?php echo base_url(); ?>assets/frontend/images/interface/payment02.png" class="img-responsive" />
												</li>
												
												<li>
													<img alt="Visa Card" src="<?php echo base_url(); ?>assets/frontend/images/interface/payment04.png" class="img-responsive" />
												</li>
												
												<li>
													<img alt="Discover" src="<?php echo base_url(); ?>assets/frontend/images/interface/discover-80.png" class="img-responsive" />
												</li>
												
												<li>
													<img alt="American Express" src="<?php echo base_url(); ?>assets/frontend/images/interface/payment01.png" class="img-responsive" />
												</li>
												
											</ul>
											
										</p>
									
									</div>
											</div>
                                            
                                        </div><!-- End: select_price -->
										
                                                                            
                                    </div>
                                    
									
									
                                    <div class="row">
                                    
                                        <div class="overview"><!-- Begin: overview -->
                                        
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="overview_main"><!-- Begin: overview_main -->
                                                	<!--h6 class="overview_main_h6"><b>Overview</b></h6-->
                                                	
													<?php //echo $product_overview; ?>
													
                                                </div><!-- End: overview_main -->
                                            </div>
                                                                                        
                                        </div><!-- End: overview -->
                                                                            
                                    </div>
									
									
                                    
                                    <div class="row">
                                    
                                        <div class="adtocart"><!-- Begin: adtocart -->
                                        
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="adtocart_inner"><!-- Begin: adtocart_inner -->
                                                    
													<!-- Add to shopping cart Being -->
													
													<!--form accept-charset="utf-8" method="post" action="<?php //echo base_url(); ?>page/cart/add"-->
													
														<input type="hidden" value="<?php echo $productid; ?>" name="id">
														
														<input type="hidden" value="<?php echo $shopid; ?>" name="shopid">
														
														<input type="hidden" value="<?php echo $userid; ?>" name="shopuserid">
														
														<input type="hidden" value="<?php echo $this->session->userdata('displayname'); ?>" name="buyername">
														
														<input type="hidden" value="<?php echo $this->session->userdata('userid'); ?>" name="buyerid">
														
														<input type="hidden" value="<?php echo $shop_name; ?>" name="shopname">

														<input type="hidden" value="<?php echo $product_name; ?>" name="name">
														
														<input type="hidden" value="<?php if(!empty($shipping_cost_by_itself)){echo $shipping_cost_by_itself;} ?>" name="shipping_cost_itself">
														
														<input type="hidden" value="<?php if(!empty($shipping_cost_with_another_items)){echo $shipping_cost_with_another_items;} ?>" name="shipping_cost_with_another_items">
														
														<input type="hidden" value="<?php if(!empty($shipping_cost_int_by_itself)){echo $shipping_cost_int_by_itself;} ?>" name="shipping_cost_int_by_itself">
														
														<input type="hidden" value="<?php if(!empty($shipping_cost_int_with_another_items)){echo $shipping_cost_int_with_another_items;} ?>" name="shipping_cost_int_with_another_items">
														
														<input type="hidden" value="<?php if(!empty($processing_time)){echo $processing_time;} ?>" name="shipprocessingtime">
														
														<input type="hidden" value="<?php echo $product_price; ?>" name="price">
														
														<?php
															if($this->session->userdata('shopopen') !== $shopid){
														?>
														
														<?php
															if($shop_status == 'Suspended'){
																echo '<span class="pull-center text-warning" style="display: block; font-size: 24px; text-align: center; color:#FF1B2D;font-weight:bold;">';
																
																echo '<i class="fa fa-sign-out" aria-hidden="true"></i> This shop currently suspended!';
																
																echo '</span>';
																
															}else if($vacationmode == 'Enabled'){
																
																echo '<span class="pull-center text-warning" style="display: block; font-size: 27px; text-align: center; color:#FF1B2D;font-weight:bold;margin-right: 14px;">';	
																
																echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Shopper gone to vacation!';
																
																echo '</span>';
																
															}else{
															
														?>
														
														<button <?php if($product_stock > 0){ echo ''; }else{ echo 'disabled'; } ?> class="btn btn-success" style="width:100%; text-align:center;" type="submit" name="action">
															
															<i class="fa fa-cart-plus"></i>
															Add to Cart 
															
														</button>
														
														<?php 
																}
															}else{ ?>
															
															<h4 class="text-danger" style="width:100%; text-align: center; font-size: 17px;">
																<i class="fa fa-times-circle"></i>
																 Sorry! You cannot buy your own shop product!
															</h4>
															
														<?php } ?>
														
														
														
													
													<!-- Add to shopping cart End -->
													
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
                                    
                                    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="dp_favorite"><!-- Begin: dp_favorite -->
                                                <!-- Standard button -->
                                                
												<h4 style="color: #fff;">
													<i class="fa fa-check"></i>
													<b><?php echo $shop_name; ?></b> Listing Items
												</h4>
												
                                            </div><!-- End: dp_favorite -->
                                        </div>
                                        
                                    </div>
									
                                    <!-- Begin: dp_social -->
                                    <!--div class="row">
                                        <div class="dp_social">
                                        	<ul>
                                            	<li><a href="#"><img src="<?php //echo base_url(); ?>assets/frontend/images/interface/pd_social01.png" alt="Social" /></a></li>
                                            	<li><a href="#"><img src="<?php //echo base_url(); ?>assets/frontend/images/interface/pd_social02.png" alt="Social" /></a></li>
                                            	<li><a href="#"><img src="<?php //echo base_url(); ?>assets/frontend/images/interface/pd_social03.png" alt="Social" /></a></li>
                                            	<li><a href="#"><img src="<?php //echo base_url(); ?>assets/frontend/images/interface/pd_social04.png" alt="Social" /></a></li>
                                            </ul>
                                        </div>
                                    </div--><!-- End: dp_social -->
                                    
                                </div><!-- End: sideproduct_box01 -->
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        
                        <div class="row">
                        	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="sideproduct_box02"><!-- Begin: sideproduct_box02 -->
                                	
                                    <div class="row">
                                    
                                    	
										
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-xs-offset-0">
                                            
											
											
											<div class="dsp_top" style="border: none;"><!-- Begin: dsp_top -->
                                            	
												<a style="color:#FF8F27;font-weight:bold;" href="<?php echo base_url(); ?>page/yourshop/viewshop/<?php echo $shopid; ?>">
												
												<?php
													if( $shoplogo !== NULL ){
													$shoplog = $shoplogo;
													$sname = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shop_name))));
												?>
												
												<img style="height:122px;width: 75%;border: 1px solid #ccc;" src="<?php echo base_url(); ?>assets/frontend/images/shops/<?php echo $sname.'/'.$shoplog; ?>" class="img-responsive img-thumbnail img-circle" alt="<?php echo $shop_name; ?> Shop Logo" />
												
												<?php }else{ ?>
												
												<img style="height:122px;width: 75%;border: 1px solid #ccc;" src="<?php echo base_url(); ?>assets/frontend/images/shops/nologo.jpg" class="img-responsive img-thumbnail img-circle" alt="<?php echo $shop_name; ?> Shop Logo" />
												
												<?php } ?>
												
												</a>
												
												<p>&nbsp;</p>
												
                                            	<h3 class="dsp_top_h3">
													
													<a style="color:#FF8F27;font-weight:bold;" href="<?php echo base_url(); ?>page/yourshop/viewshop/<?php echo $shopid; ?>">
													
														<?php echo $shop_name; ?>
													
													</a>
												</h3>
												
                                            </div><!-- End: dsp_top -->
											
											
                                        </div>
										
										
                                        
                                    </div>
                                    <div class="clearfix"></div>

                                    
                                    <div class="dp_main" style="border-top:1px solid #ddd;margin-top:5px;"><!-- Begin: dp_main -->
                                        <div class="row">
                                        
                                            
											<?php
												$nvsd_queryShopRelatedP = $this->db->query("SELECT * FROM mega_products where shopid='".$shopid."' order by rand() LIMIT 8");
												
												$nvsd_resultsShopRelatedP 	= $nvsd_queryShopRelatedP->result();
												
												foreach($nvsd_resultsShopRelatedP as $viewShopRelatedP){
													$get_thumbs = $this->page_model->get_productimgs($viewShopRelatedP->productid);
											?>
											
											
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="dsp_box"><!-- Begin: dsp_box -->
                                                
                                                    <div class="dsp_box_img"><!-- Begin: dsp_box_img" -->
                                                    
                                                        <div class="main view-third">
                                                            <!-- THIRD EXAMPLE -->
															
															<div class="view2">
                        
                                                              <a href="<?php echo base_url(); ?>page/pdetails/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $viewShopRelatedP->product_name)))))))); ?>/<?php echo $viewShopRelatedP->productid; ?>">
															  
																<?php
																	$sname = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shop_name))));	
																	$pooimglocation = base_url()."assets/frontend/images/shops/".$sname."/";
																?>
																
																<?php 
																	if(count($get_thumbs) !== 0){
																?>
																<img class="img-responsive" src="<?php echo $pooimglocation.$get_thumbs['pic_name']; ?>" alt="<?php echo $viewShopRelatedP->product_name; ?>" />';
																<?php }else{ ?>
																<img class="img-responsive" src="<?php echo base_url()."assets/frontend/images/shops/default-img.jpg"; ?>" alt="No Image Avaliable" />';
																<?php } ?>
															</a>
															
															<!--div class="mask">
																<div class="heart_rate">
																	
																	<?php
																		//if($this->session->userdata('isLogin') == FALSE){
																	?>
																		<a href="#" data-toggle="modal" data-target="#myModal" class="info"><i class="fa fa-heart-o" style="font-weight:bold"></i></a>
																		
																	<?php //}else{ ?>
																	
																		<a href="#" class="info"><i class="fa fa-heart-o" style="font-weight:bold"></i></a>
																		
																	<?php //} ?>
																	
																</div>
															</div-->
															
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
/*
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


});*/
</script>



<?php $this->load->view('../../front-templates/footer.php'); ?>
