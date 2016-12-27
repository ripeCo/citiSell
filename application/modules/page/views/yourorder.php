<?php
	$this->load->view('../../front-templates/head.php');
	$this->load->view('../../front-templates/header.php');
	$this->load->view('../../front-templates/navigation.php');
	
	extract($orderdetails);
?>


<div id="inner_page"><!-- Begin: inner_page -->

	<div class="userfav_wrapper">
    	<div class="container">
            <div class="row">
                <div class="user_favorite"><!-- Begin: user_hi -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    
                        <div class="row">
                            
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                
								<div class="user_name2"><!-- Begin: user_name2 -->
                                    
									<p class="user_name2_h3">
										<i class="fa fa-history" style="color:#FF712D;"></i> 
										Order details - <span style="color:#E75325;"><?php echo $ordernumber; ?></span>, On 
										<?php
											$myDate = $order_date;
											$wkd = shipprocessingtimes($shipprocessingtime);
											echo $paidon = date('M d, Y', strtotime($myDate . $wkd));
										?>.
										
									</p>
									
                                </div><!-- End: user_name2 -->
								
								<a class="btn btn-primary" href="<?php echo base_url(); ?>page/user/vieworders/<?php echo $this->session->userdata('userid'); ?>/<?php echo $this->session->userdata('shopopen'); ?>/0">Return to Orders</a>
								
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
            
				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                    
					<div class="purchases_box"><!-- Begin: favitem_box -->
                    	
						<div class="purchase-title">
							
							<h4 class="text-success"><b> <i class="fa fa-check-square"></i> Paid </b></h4>
							
						</div>
                    	
						
						<div class="purchase-products-info-0">
							
							<span style="display: inline; float: left; padding: 2px 0 2px 5px; width: 100%;">
								
								<div class="account_about"><!-- Begin: account_about -->
													
									<h2 class="account_about_po">
										
										Payment Method
										  
									</h2>
										
									<p style="padding-left:14px; padding-top:4px;color: #449d44; font-weight: bold;" class="text-primary account_about_p">
										<i class="fa fa-paypal"></i>
										Paid via <b><?php echo $order_paymenttype; ?></b>
									</p>
									
									<p>&nbsp;</p>
										
									<p style="padding-left:14px; padding-top:14px;" class="account_about_p">
									
										Payment records are available in your 
										
										<a href="<?php echo base_url(); ?>page/accounts/payment/<?php echo $this->session->userdata('userid');?>/<?php echo $this->session->userdata('shopid');?>/0/?ref=seller_accounts_platform">
										
											hop Payment Account
										
										</a>. 
										
									</p>
										
									<p>&nbsp;</p>
										
									<p style="padding-left:14px; padding-top:14px;" class="account_about_p">
										<i class="fa fa-check-square-o"></i>
										Paid on <?php echo $paidon; ?>.
									</p>
									
								</div><!-- End: account_about -->
								
							</span>
							
						</div>
						
                    </div><!-- End: favitem_box -->
					
                </div>
            
            	
				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                    
					<div class="purchases_box"><!-- Begin: favitem_box -->
                    	
						<div class="purchase-title">
							
							<h4><b> 
								<?php
									if($order_shipped == 0){ echo '<span class="text-warning"><i class="fa fa-exclamation-triangle"></i> Not Shipped</span>'; }else{
										echo '<span class="text-success"><i class="fa fa-check-square"></i> Shipped</span>';
									}
								?>
							</b></h4>
							
						</div>
                    	
						
						<div class="purchase-products-info-0">
							
							<span style="display: inline; float: left; padding: 2px 0 2px 5px; width: 100%;">
								
								<div class="account_about"><!-- Begin: account_about -->
													
									<p class="account_about_p">
										
										<b>
											<i class="fa fa-clock-o"></i> Scheduled to ship by
											<?php
												echo $paidon;
											?>.
										</b>
									</p>
									
									<p>&nbsp;</p>
													
									<p class="account_about_p">
										
										<span>For orders paid by credit card, marking shipped cannot be undone.</span><br/>
										
									</p>
									
									<p>&nbsp;</p>
									
										
									<p class="account_about_p">
										
										<a style="padding:0px 5px; font-size: 13px;" class="btn btn-success" href="">Print Shipping Label</a>
										
										<a style="padding:0px 5px; font-size: 13px;" class="btn btn-success" href="">Mark as Shipped</a>
										
									</p>
									
									<p>&nbsp;</p>
									
									
									<p class="account_about_p">
										<strong> <i class="fa fa-map-marker"></i> Ship to</strong><br />
										 <?php echo $order_ship_address; ?>
									</p>
									
								</div><!-- End: account_about -->
								
							</span>
							
						</div>
						
                    </div><!-- End: favitem_box -->
					
                </div>
            
            	
				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                    
					<div class="purchases_box" style="min-height:93px !important;"><!-- Begin: favitem_box -->
                    	
						<div class="purchase-title">
							
							<h4><b> 
								<i class="fa fa-shopping-bag"></i>
								Shop - 
								<?php
									// Get shopname from mega_shops
										$shopiid = $this->session->userdata('shopid');
										$purchaseShopSql2 = $this->db->query("select * from mega_shops where shopid=$shopiid");
										extract($purchaseShopSql2->row_array());
									
										$shopurl = base_url().'page/yourshop/viewshop/'.$shopid;
										
										echo ' <a href="'.$shopurl.'"> '.$shop_name.'</a>';
								?>
							</b></h4>
							
						</div>
                    	
						
						<div class="purchase-products-info-0">
							
							<span style="display: inline; float: left; padding: 2px 0 2px 5px; width: 100%;">
								
								<div class="account_about"><!-- Begin: account_about -->
													
									<p class="account_about_p">
										
										<b>
											<i class="fa fa-clock-o"></i> Shop
											<?php
												echo $shoptitle;
											?>.
										</b>
									</p>
									
									<p>&nbsp;</p>
									
										
									<p class="account_about_p">
										
										<a style="font-size: 13px; height: 100px;  padding: 5px; width: 100px; display:inline; float:left;position: relative;top:-8px;" href="<?php echo $shopurl; ?>">
											
											<?php
												if( $shoplogo !== NULL ){
													$shoplog = $shoplogo;
													$sname = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shop_name))));
													
											?>
											
											<img src="<?php echo base_url(); ?>assets/frontend/images/shops/<?php echo $sname.'/'.$shoplog; ?>" class="img-responsive img-thumbnail" alt="Shop Logo" />
											
											<?php }else{ ?>
											
											<img src="<?php echo base_url(); ?>assets/frontend/images/shops/nologo.jpg" class="img-responsive img-thumbnail" alt="Shop Logo" />
											
											<?php
												}
											?>
											
										
										</a>
										
										<b>Shop Email: </b>
										<a style="padding:0px 5px; font-size: 13px; display:inline;" class="btn btn-success" href="mailto:<?php echo $this->session->userdata('useremail'); ?>?Subject=Buyer%20contact" target="_top"> <?php echo $this->session->userdata('useremail'); ?> </a>
									</p>
									
									<p>&nbsp;</p>
									
									
									<p class="account_about_p">
										<strong> <i class="fa fa-map-marker"></i> Shop Location</strong><br />
										 <?php echo $shop_location; ?>
									</p>
									
								</div><!-- End: account_about -->
								
							</span>
							
						</div>
						
                    </div><!-- End: favitem_box -->
					
                </div>
            
            	
				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                    
					<div class="purchases_box" style="min-height:80px !important;"><!-- Begin: favitem_box -->
                    	
						<div class="purchase-title">
							
							<h4><b> 
								<i class="fa fa-user"></i>
								Buyer - 
								<?php
									// Get shopname from mega_shops
										$orderUserSql2 = $this->db->query("select order_userid from mega_orders where orderid=$orderid");
										extract($orderUserSql2->row_array());
									
									// Get shopname from mega_shops
										$orderUserNameSql2 = $this->db->query("select display_name,about_user,user_city,user_picture,user_email from mega_users where userid=$order_userid");
										extract($orderUserNameSql2->row_array());
									
										$userprofile = base_url().'page/user/userprofile/'.$order_userid;
										
										echo ' <a href="'.$userprofile.'"> '.$display_name.'</a>';
								?>
							</b></h4>
							
						</div>
                    	
						
						<div class="purchase-products-info-0">
							
							<span style="display: inline; float: left; padding: 2px 0 2px 5px; width: 100%;">
								
								<div class="account_about"><!-- Begin: account_about -->
													
									<p class="account_about_p">
										
										<b>
											<i class="fa fa-clock-o"></i>
											<?php
												echo $about_user;
											?>.
										</b>
									</p>
									
									<p>&nbsp;</p>
													
									<p class="account_about_p">
										
										<a style="font-size: 13px; height: 100px;  padding: 5px; width: 100px; display:inline; float:left;position: relative;top:-8px;" href="<?php echo $userprofile; ?>">
											
											<?php
												if( $user_picture !== NULL ){
													$user_picture = $user_picture;
											?>
											
											<img src="<?php echo base_url(); ?>assets/frontend/images/users/<?php echo $user_picture; ?>" class="img-responsive img-thumbnail" alt="userprofile" />
											
											<?php }else{ ?>
											
											<img src="<?php echo base_url(); ?>assets/frontend/images/users/userprofile.png" class="img-responsive img-thumbnail" alt="userprofile" />
											
											<?php } ?>
											
										
										</a>
										
										<b>Buyer Email: </b>
										<a style="padding:0px 5px; font-size: 13px; display:inline;" class="btn btn-success" href="mailto:<?php echo $user_email; ?>?Subject=Shopper%20contact" target="_top"> <?php echo $user_email; ?> </a>
									</p>
									
									<p>&nbsp;</p>
									
									
									<p class="account_about_p">
										<strong> <i class="fa fa-map-marker"></i> Buyer Location</strong><br />
										 <?php echo $user_city; ?>
									</p>
									
								</div><!-- End: account_about -->
								
							</span>
							
						</div>
						
                    </div><!-- End: favitem_box -->
					
                </div>
            
            	
				<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                    
					<div class="purchases_box" style="min-height:80px !important;"><!-- Begin: favitem_box -->
                    	
						<div class="purchase-title">
							
							<h4><b> 
								<i class="fa fa-user"></i>
								Order Item  <?php echo $quantity; ?>
							</b></h4>
							
						</div>
                    	
						<?php
							// Get shopid from mega_orderdetails
							$purchaseShopSql3 = $this->db->query("select * from mega_orderdetails where orderid=$orderid and shopid=$shopid group by shopid");
							foreach($purchaseShopSql3->result() as $vaal2){
								
								$productid 	= $vaal2->productid;
								$spid 	= $vaal2->shopid;
								
								// Get shopname from mega_shops
									$purchaseShopSql02 = $this->db->query("select shop_name,shop_location from mega_shops where shopid=$spid");
									extract($purchaseShopSql02->row_array());
								
								// Get productName from mega_products
								$purchaseShopSql4 = $this->db->query("select product_name,product_image from mega_products where productid=$productid");
								extract($purchaseShopSql4->row_array());
								
								
								$shpredy = $vaal2->shipprocessingtime;
								
								// Product details link building
								$pname = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $product_name)))))))).'/'.$productid;
								$producturl = base_url().'page/pdetails/'.$pname;
								
						?>
						<div class="purchase-products-detailsinfo">
							
							<span style="display: inline; float: left; padding: 2px 0 2px 5px; width: 64%;">
								
								<a href="<?php echo $producturl; ?>" style="padding: 2px 0 2px 5px; width: 100%;">
									
									<span class="purchases_productname">
										
										<?php
											echo '<i class="fa fa-product-hunt"></i> '. $product_name;
										?>
										
									</span>
									
								</a>
								
									
								<p>
									<?php
										if($vaal2->productVariations !== ''){
											echo '<b>Variations - </b> ( '. $vaal2->productVariations.' )';
										}
									?>
								</p>
								
								<p>
									<?php
										echo '<b>Quantity - </b>'.$vaal2->quantity;
									?>
								</p>
								
							</span>
							
							
							<span style="float:left;display:inline;width:15%;">
								
								<a href="<?php echo $producturl; ?>"
								<!-- Product Image -->
								<?php
									// Check product Image NULL Or Not
									$ppimgRec = explode(',',$product_image);
										
									for($ppiRec=0;$ppiRec< count($ppimgRec);$ppiRec++){
										
										if($product_image == NULL){
											$pimglocationRec = base_url()."assets/frontend/images/shops/default-img.jpg";
										}else{
											$snameRec = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shop_name))));
											
											$pimglocationRec = base_url()."assets/frontend/images/shops/$snameRec/$ppimgRec[$ppiRec]";
										}
										
										echo '<img style="width:100px; height:85px;overflow:hidden;display:inline;margin-right: 6px;float: right;" src="'.$pimglocationRec.'" alt="'.$product_name.'" class="img-responsive img-thumbnail" />';
										break;
									}
								?>
								</a>
							</span>
							
							
							<span style="display:inline;float: left; font-size: 14px; position: relative; text-align: right; top: 30px; width: 20%;">
								
								<p>
									<span> $<?php echo $vaal2->unitprice; ?> X <?php echo $vaal2->quantity; ?></span>
									 =
									 <b> $<?php echo number_format($vaal2->unitprice * $vaal2->quantity,2); ?> </b>
								</p>
								
								<p>
									<b> Shipping cost</b>
									 =
									 <b> $<?php echo number_format($vaal2->shippping_cost,2); ?> </b>
								</p>
								
							</span>
							
						</div>
							
								
						<?php
							}
						?>	
						
						
						<div class="purchase-total">
							
							<div class="pmethd" style="left: 10px; position: relative; top: 18px;">
								
								
								<a style="color: #fff; display: inline; font-size: 17px; padding: 0 11px;margin-right: 7px;" class="btn btn-warning orderstttus" href=""> 
									
									<i class="fa fa-reply"></i>
									Refund order 
								</a>
								
								<a style="color: #fff; display: inline; font-size: 17px; padding: 0 11px;margin-right: 7px;" class="btn btn-danger orderstttus" href="">
									
									<i class="fa fa-times-circle"></i>
									Cancel order
								</a>
								
								
								<a style="color: #fff; display: inline; font-size: 17px; padding: 0 11px;margin-right: 7px;" class="btn btn-success orderstttus" href="">
									
									<i class="fa fa-check-circle"></i>
									Deliver order
								</a>
								
								
							</div>
							
							<div class="pmethd2">
								
								<?php
									// Get productName from mega_products
									
									$orderDtails = $this->db->query("select sum(subtotal) as ordersub,SUM(shippping_cost) as orderSpCost from mega_orderdetails where orderid=$orderid and shopid=$shopid");
									extract($orderDtails->row_array());
								?>
								
								<h4 style="color:#222; text-align:right; width:332px; border-bottom:1px solid #e1e1e1; margin-top: 8px !important;">
									<span class="tit">Total item cost =</span> 
									<span style="color:#222"> $<?php echo $ordersub; ?></span>
								</h4>
								
								<h4 style="color:#222; text-align:right; width:332px; border-bottom:1px solid #e1e1e1; margin-bottom: 3px !important; padding-bottom:3px;">
									<span class="tit">Total shipping cost =</span> 
									<span style="color:#222"> $<?php echo number_format($orderSpCost,2); ?></span>
								</h4>
								
								<h4 style="color:#DA5325; text-align:right; width:332px; border-top:1px solid #e1e1e1; margin-top: 2px !important;">
									<b class="tit">Order total =</b>
									<b style="color:#3399FF; font-weight:bold !important;font-size: 18px;"> $<?php echo number_format($ordersub+$orderSpCost,2); ?></b>
								</h4>
								
							</div>
							
						</div>
						
                    </div><!-- End: favitem_box -->
					
                </div>
				
				
                                
            </div>
            
        </div>
    </div>
	
    
</div><!-- End: inner_page -->


<?php $this->load->view('../../front-templates/footer.php'); ?>

