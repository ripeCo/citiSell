<?php
	$this->load->view('../../front-templates/head.php');
	$this->load->view('../../front-templates/header.php');
	$this->load->view('../../front-templates/navigation.php');
?>


<div id="inner_page"><!-- Begin: inner_page -->
	<div class="userfav_wrapper">
    	<div class="container">
            <div class="row">
                <div class="user_favorite"><!-- Begin: user_hi -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    
                        <div class="row">
                            
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                
								<div class="user_name2"><!-- Begin: user_name2 -->
                                    
									<p class="user_name2_h3">
										<i class="fa fa-history" style="color:#FF712D;"></i> 
										Your
										
										<?php
											if($this->uri->segment(7) == NULL){
												echo 'All';
											}{
												echo $this->uri->segment(7);
											}
										?>
										
										Orders List
									</p>
									
                                </div><!-- End: user_name2 -->
								
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-right:0;">
                                <div class="purchage_list"><!-- Begin: purchage_list -->
									<ul>
                                        <li>
											<a style="color:#D91E76;" href="<?php echo base_url(); ?>page/login/logout">Sign Out</a>
										</li>
										
										<li>
											<a href="<?php echo base_url(); ?>page/user/setting/<?php echo $this->session->userdata('userid'); ?>">
												Account Settings
											</a>
										</li>
										
                                        <li>
											<a href="<?php echo base_url(); ?>page/user/userprofile/<?php echo $this->session->userdata('userid'); ?>">
												Public Profile
											</a>
										</li>
										
                                        <li>
											<a href="<?php echo base_url(); ?>page/user/viewpurchases/<?php echo $this->session->userdata('userid'); ?>">
												Purchases &amp; Reviews
											</a>
										</li>
                                    </ul>
                                </div><!-- End: purchage_list -->
                            </div>
                        </div>
                    </div>  
                </div><!-- End: user_hi -->
            </div>
        </div>
    </div>

	

	<div class="favorite_main">
    	<div class="container">
        
        	<div class="row">
            
            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="ur_favoritesL" style="overflow:unset;"><!-- Begin: ur_favoritesL -->
                    	<div class="row">
						
                        
                        	<div class="bbttn">
                                <div class="urfav_title"><!-- Begin: urfav_title -->
                                	
									<a class="btn <?php if($this->uri->segment(7) === NULL){ echo $btnclass = 'btn-success'; }else{ echo $btnclass = 'btn-default'; } ?>" href="<?php echo base_url(); ?>page/user/vieworders/<?php echo $this->session->userdata('userid'); ?>/<?php echo $this->session->userdata('shopopen'); ?>/0" role="button" >
									
										All (<?php echo checkNumber(number_format($all_results)); ?>)
										
									</a>
									
                                </div><!-- End: urfav_title -->
                            </div>
							
                        
                        	<div class="bbttn" style="padding:2px;">
                                <div class="urfav_title"><!-- Begin: urfav_title -->
                                	
									<a class="btn <?php if($this->uri->segment(7) === 'Pending'){ echo $btnclass = 'btn-success'; }else{ echo $btnclass = 'btn-default'; }; ?>" href="<?php echo base_url(); ?>page/user/vieworders/<?php echo $this->session->userdata('userid'); ?>/<?php echo $this->session->userdata('shopopen'); ?>/0/Pending" role="button">
									
										Pending (<?php echo checkNumber(number_format($pending_results)); ?>)
										
									</a>
									
                                </div><!-- End: urfav_title -->
                            </div>
							
                        
                        	<div class="bbttn" style="padding:2px;">
                                <div class="urfav_title"><!-- Begin: urfav_title -->
                                	<a class="btn <?php if($this->uri->segment(7) === 'Delivered'){ echo $btnclass = 'btn-success'; }else{ echo $btnclass = 'btn-default'; } ?>" href="<?php echo base_url(); ?>page/user/vieworders/<?php echo $this->session->userdata('userid'); ?>/<?php echo $this->session->userdata('shopopen'); ?>/0/Completed" role="button">
									
										Delivered (<?php echo checkNumber(number_format($delivered_results)); ?>)
										
									</a>
                                </div><!-- End: urfav_title -->
                            </div>
							
                        
                        	<div class="bbttn" style="padding:2px;">
                                <div class="urfav_title"><!-- Begin: urfav_title -->
                                	<a class="btn <?php if($this->uri->segment(7) === 'Cancelled'){ echo $btnclass = 'btn-success'; }else{ echo $btnclass = 'btn-default'; } ?>" href="<?php echo base_url(); ?>page/user/vieworders/<?php echo $this->session->userdata('userid'); ?>/<?php echo $this->session->userdata('shopopen'); ?>/0/Cancelled" role="button">
									
										Cancelled (<?php echo checkNumber(number_format($cancelled_results)); ?>)
										
									</a>
                                </div><!-- End: urfav_title -->
                            </div>
                                                        
                        </div>
                    </div><!-- End: ur_favoritesL -->
                </div>
				
                
            	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-xs-offset-0">
                    <div class="ur_favoritesR"><!-- Begin: ur_favoritesL -->
                    
                        <div class="input-group">
                          <!--input type="text" class="form-control" placeholder="Search your purchases...">
                          <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Search</button>
                          </span-->
                        </div><!-- /input-group -->
                      
                    </div><!-- End: ur_favoritesL -->
                </div>
                
            </div>
			
            
        	<div class="row">
            
            	<?php
					
					if(is_array($allitem) && count($allitem)) {
						$s = 0;
						foreach($allitem as $allitems){
						$orderiid = $allitems->orderid;
						
						$s++;
				?>
				
				<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                    
					<div class="purchases_box"><!-- Begin: favitem_box -->
                    	
						<div class="purchase-title">
							
							<h5><b>Order from </b>
								
								<?php
									$shopid = $this->uri->segment(5);
									$userid = $allitems->order_userid;
									
									// Get shopid from mega_orderdetails
									$purchaseShopSql1 = $this->db->query("select * from mega_orderdetails where orderid=$orderiid and shopid=$shopid group by shopid");
									extract($purchaseShopSql1->row_array()); // Get shopname from mega_shops
									
									$purchaseShopSql2 = $this->db->query("select display_name from mega_users where userid=$userid");
									extract($purchaseShopSql2->row_array());
									
									// Get shopname from mega_shops
										$orderShopSql2 = $this->db->query("select shop_name,shop_location from mega_shops where shopid=$shopid");
										extract($orderShopSql2->row_array());
									
									$userprofileurl = base_url().'page/user/userprofile/'.$userid;
									
									echo ' - <a href="'.$userprofileurl.'">'.$display_name.'</a>';
									
								?>
							</h5>
							
							<h5> <b>Ordered -</b> <?php echo $allitems->order_date; ?> <span>$<?php echo number_format($subtotal+$shippping_cost,2); ?></span></h5>
							
						</div>
                    	
						<div class="purchase-buttons">
							
							<h4 class="btn btn-default pbtns">
								<span class="text-danger" style="font-size:18px;"><?php echo $allitems->ordernumber; ?></span>
							</h4>
							
							<!--a class="btn btn-default pbtns" href="<?php //echo base_url(); ?>page/user/purchasedetails/<?php //echo $this->session->userdata('userid'); ?>/<?php //echo $allitems->orderid; ?>/<?php //echo $allitems->ordernumber; ?>">
								View order details
							</a-->
							
							<!--a class="btn btn-default pbtns" href="">Shop Contact</a>
							<a class="btn btn-default pbtns" href="">Shop Name - BuySell24</a-->
							
						</div>
						
						<div class="purchase-products-info">
							
							<span style="display: inline; float: left; padding: 2px 0 2px 5px; width: 64%;">
								<?php
									// Get shopid from mega_orderdetails
									$purchaseShopSql3 = $this->db->query("select * from mega_orderdetails where orderid=$orderiid and shopid=$shopid group by orderid");
									extract($purchaseShopSql3->row_array());
										
										$productid = $productid;
										
										// Get productName from mega_products
										$purchaseShopSql4 = $this->db->query("select product_name,product_image from mega_products where productid=$productid and shopid=$shopid");
										extract($purchaseShopSql4->row_array());
										
										// Product details link building
										$pname = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $product_name)))))))).'/'.$productid;
										$producturl = base_url().'page/pdetails/'.$pname;
										
										$sspname = $shop_name;
										
										if(!empty($shipprocessingtime) || $shipprocessingtime !== NULL){
											$shpredy = $shipprocessingtime;
										}else{
											$shpredy = 0;
										}
										
								?>
								
								<a href="<?php echo $producturl; ?>" style="display: inline; float: left; padding: 2px 0 2px 5px; width: 100%;">
									
									<p class="purchases_productname">
										
										<?php
											
											echo '<i class="fa fa-product-hunt"></i> '. $product_name;
											
										?>
										
									</p>
									
								</a>
									
								<p>
									<?php
										if($productVariations !== ''){
											echo '<b>Variations - </b> ( '. $productVariations.' )';
										}
									?>
								</p>
								
								<p>
									<?php
										echo '<b>Quantity - </b>'.$quantity;
									?>
								</p>
								
							</span>
							
							
							<span style="float:left; display:inline; width:15%; position: relative; top: 0;">
								<a href="<?php echo $producturl; ?>"
								<!-- Product Image -->
								<?php
									// Check product Image NULL Or Not
									$ppimgRec = explode(',',$product_image);
										
									for($ppiRec=0;$ppiRec< count($ppimgRec);$ppiRec++){
										
										if($product_image == NULL){
											$pimglocationRec = base_url()."assets/frontend/images/shops/default-img.jpg";
										}else{
											$snameRec = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $sspname))));
											
											$pimglocationRec = base_url()."assets/frontend/images/shops/$snameRec/$ppimgRec[$ppiRec]";
										}
										
										echo '<img style="display: inline; height: 85px; margin-right: 6px; overflow: hidden; position: relative; top: 0px; width: 100px;" src="'.$pimglocationRec.'" alt="'.$product_name.'" class="img-responsive img-thumbnail" />';
										break;
									}
								?>
								</a>
							</span>
							
							
							<span style="display:inline;float: left; font-size: 14px; position: relative; text-align: right; top: 0px; width: 20%;">
								<p>
									<span> $<?php echo $unitprice; ?> X <?php echo $quantity; ?></span>
									 =
									 <b> $<?php echo number_format($unitprice * $quantity,2); ?> </b>
								</p>
								
								<p style="border-bottom:1px solid #ccc;">
									<span> Shipping cost</span>
									 =
									 <b> $<?php echo number_format($shippping_cost,2); ?> </b>
								</p>
								
								<p>
									<b> Ordered Total </b>
									 =
									 <b> $<?php echo number_format($subtotal + $shippping_cost,2); ?> </b>
								</p>
							</span>
							
						</div>
						
						<div class="purchase-status">
							
							<div class="orderStatuus1">
								
								<h6><?php echo $allitems->order_status; ?></h6><br/>
								
								<p><b>Order On - <?php echo $allitems->order_date; ?></b></p><br/>
								
								<p><b>Order From - <?php echo $shop_location; ?>, VA To <?php echo $allitems->order_usercountry; ?></b></p><br/>
								
								<p><b>Shipping ready to <?php echo $shpredy; ?></b></p>
								
							</div>
							
							
							<div class="orderStatuus2">
								
								<!-- Nav tabs -->
								  <ul class="nav nav-tabs tabtitle_setting" role="tablist">
									
									<li role="presentation">
										<a href="#account<?php echo $s; ?>" aria-controls="account<?php echo $s; ?>" role="tab" data-toggle="tab">
											<i class="fa fa-check-square"></i>
											Paid
										</a>
									</li>
									
									<li role="presentation" class="active">
										<a href="#security<?php echo $s; ?>" aria-controls="security<?php echo $s; ?>" role="tab" data-toggle="tab">
											
											<?php
												$purchaseShopSql003 = $this->db->query("select shippingstatus from mega_ordershop where orderid=$orderiid and shopid=$shopid");
												extract($purchaseShopSql003->row_array());
												
												if($shippingstatus == 'Pending'){ echo '<span class="text-warning"><i class="fa fa-exclamation-triangle"></i> Not Shipped</span>'; }
												
												else if($shippingstatus == 'Cancel'){ echo '<span class="text-danger"><i class="fa fa-times-circle"></i> Canceled</span>'; }
												
												else if($shippingstatus == 'Delivered'){ echo '<span class="text-success"><i class="fa fa-check-square"></i> Shipped</span>'; }
												
												else{ echo '<span class="text-primary"><i class="fa fa-spinner"></i> Processing</span>'; }
											?>
											
											
										</a>
									</li>
									
									<li role="presentation">
										<a href="#addresses<?php echo $s; ?>" aria-controls="addresses<?php echo $s; ?>" role="tab" data-toggle="tab">
										
											Receipt - <?php echo $allitems->ordernumber; ?>
										
										</a>
									</li>
									
									<!--<li role="presentation"><a href="#creditcards" aria-controls="creditcards" role="tab" data-toggle="tab">Credit Cards</a></li>-->
									<!--<li role="presentation"><a href="#emails" aria-controls="emails" role="tab" data-toggle="tab">Emails</a></li>-->
								  </ul>
								  
								  
								  <!-- Tab panes -->
								  <div class="tab-content details_tab_content">
								  
									<div role="tabpanel" class="tab-pane" id="account<?php echo $s; ?>">
									
										<div class="row">
										
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="account_about"><!-- Begin: account_about -->
													
													<p class="account_about_p">
														
														<strong>Payment Method</strong><br />
														  
													</p>
														
													<p style="padding-left:14px; padding-top:4px;color: #449d44; font-weight: bold;" class="text-primary account_about_p">
														<i class="fa fa-paypal"></i>
														Paid via <b><?php echo $allitems->order_paymenttype; ?></b>
													</p>
														
													<p style="padding-left:14px; padding-top:14px;" class="account_about_p">
														<i class="fa fa-check-square-o"></i>
														Paid on <?php echo $allitems->order_date; ?>.
													</p>
													
												</div><!-- End: account_about -->
											</div>
											
										</div>

									</div>
									
									<div role="tabpanel" class="tab-pane active" id="security<?php echo $s; ?>">
										
										<div class="row">
										
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="account_about"><!-- Begin: account_about -->
													
													<p class="account_about_p">
														
														<b>
															<i class="fa fa-clock-o"></i> Scheduled to ship by
															<?php
																$myDate = $allitems->order_date;
																$wkd = shipprocessingtimes($shpredy);
																echo date('M d, Y', strtotime($myDate . $wkd));
															?>.
														</b><br/>
														
														<span>For orders paid by credit card, marking shipped cannot be undone.</span><br/>
														
													</p>
													
														
													<p class="account_about_p">
														
														<a style="padding:0px 5px; font-size: 13px;" class="btn btn-success" href="">Print Shipping Label</a>
														
														<a style="padding:0px 5px; font-size: 13px;" class="btn btn-success" href="">Mark as Shipped</a>
														
													</p>
													
													
													<p class="account_about_p">
														<strong> <i class="fa fa-map-marker"></i> Ship to</strong><br />
														 <?php echo $allitems->order_ship_address; ?>
													</p>
													
												</div><!-- End: account_about -->
											</div>
											
										</div>
										
									</div>
									
									<div role="tabpanel" class="tab-pane" id="addresses<?php echo $s; ?>">
										
										<div class="row">
										
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="account_about"><!-- Begin: account_about -->
													
													<p class="account_about_p">
														
														<a class="btn btn-primary" href="<?php echo base_url(); ?>page/user/yourorder/<?php echo $orderiid; ?>/<?php echo $shopid; ?>">
															
															Click for view - <?php echo $allitems->ordernumber; ?>
															
														</a>
														
													</p>
													
												</div><!-- End: account_about -->
											</div>
											
										</div>
										
									</div>

									
									
								  </div>
								  
								  
								
							</div>
							
						</div>
						
                    </div><!-- End: favitem_box -->
					
                </div>
						
				<?php } }else{ ?>
				
					<p>&nbsp;</p>
					
					<h4> <i>Sorry! <?php if($this->uri->segment(7) !== NULL){ echo $this->uri->segment(7); }else{ echo 'Any'; } ?> orders didn't found yet!</i> </h4>
				
				<?php } ?>
				
				
                                
            </div>
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">    
				<h3 class="border_styles" style="margin-top:25px;">&nbsp;</h3>
					
				<div class="row">
					<div class="col-md-12">
						<div class="row"><?php echo $this->pagination->create_links(); ?></div> 
					</div>
				</div>
					
			</div>
            
        </div>
    </div>
	
    
</div><!-- End: inner_page -->


<?php $this->load->view('../../front-templates/footer.php'); ?>

