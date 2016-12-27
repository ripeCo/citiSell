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
                            
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                
								<div class="user_name2"><!-- Begin: user_name2 -->
                                    
									<p class="user_name2_h3"> <i class="fa fa-history" style="color:#FF712D;font-size:15px;"></i>
										Purchases details for - <span style="color:#E75325;"><?php echo $ordernumber; ?></span>
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
						
						<a class="btn btn-primary" href="<?php echo base_url(); ?>page/user/viewpurchases/<?php echo $this->session->userdata('userid'); ?>/0">Return to Purchase list</a>
                        
                    </div>  
                </div><!-- End: user_hi -->
            </div>
        </div>
    </div>

	

	<div class="favorite_main">
    	<div class="container">
        
        	<div class="row">
            	
                
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
            
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    
					<div class="purchases_details_box"><!-- Begin: favitem_box -->
                    	
						<div class="purchase-title">
							
							<h5><b>Purchased from</b> 
								
								<?php
									// Get shopid from mega_orderdetails
									$purchaseShopSql1 = $this->db->query("select orderid,shopid from mega_orderdetails where orderid=$orderid group by shopid");
									foreach($purchaseShopSql1->result() as $vaal){
										
										$shopid = $vaal->shopid;
										
										// Get shopname from mega_shops
										$purchaseShopSql2 = $this->db->query("select shop_name,shop_location from mega_shops where shopid=$shopid");
										extract($purchaseShopSql2->row_array());
										
										$shopurl = base_url().'page/yourshop/viewshop/'.$shopid;
										
										echo ' - <a href="'.$shopurl.'"><i class="fa fa-shopping-bag"></i> '.$shop_name.'</a>';
										
									}
								?>
							</h5>
							
							<h5> <b>Purchased On - </b> <?php echo $order_date; ?> <span style="font-size: 20px; position: relative; top: -12px;">$<?php echo $order_amount; ?></span></h5>
							
						</div>
						
						
						<?php
							// Get shopid from mega_orderdetails
							$purchaseShopSql3 = $this->db->query("select * from mega_orderdetails where orderid=$orderid");
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
							
							<span style="display: inline; float: left; padding: 2px 0 2px 5px; width: 70%;">
								
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
							
							
							<span style="display:inline;float: left; font-size: 14px; position: relative; text-align: right; top: 30px; width: 15%;">
								
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
						
						
						<div class="purchase-status">
							
							<h6><?php echo $order_status; ?></h6>
							<p>On <?php echo $order_date; ?></p>
							<p>From <?php echo $shop_location; ?>, VA To <?php echo $order_usercountry; ?></p>
							<p>Shipping ready to <?php echo $shpredy; ?></p>
							
						</div>
						
						
						<div class="purchase-total">
							
							<div class="pmethd">
								<h4 style="color:#DA5325;">Payment Method - <b style="color:#3399FF"> <i class="fa fa-paypal"></i> <?php echo $order_paymenttype; ?></b></h4>
								
								<p>Bill paid on - <?php echo $order_date; ?></p>
							</div>
							
							<div class="pmethd2">
								
								<h4 style="color:#222; text-align:right; width:332px; border-bottom:1px solid #e1e1e1; margin-top: 8px !important;">
									<span class="tit">Total item cost =</span> 
									<span style="color:#222"> $<?php echo number_format($order_amount - $order_shipping_amount,2); ?></span>
								</h4>
								
								<h4 style="color:#222; text-align:right; width:332px; border-bottom:1px solid #e1e1e1; margin-bottom: 3px !important; padding-bottom:3px;">
									<span class="tit">Total shipping cost =</span> 
									<span style="color:#222"> $<?php echo number_format($order_shipping_amount,2); ?></span>
								</h4>
								
								<h4 style="color:#DA5325; text-align:right; width:332px; border-top:1px solid #e1e1e1; margin-top: 2px !important;">
									<b class="tit">Order total =</b>
									<b style="color:#3399FF; font-weight:bold !important;font-size: 18px;"> $<?php echo number_format($order_amount,2); ?></b>
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

