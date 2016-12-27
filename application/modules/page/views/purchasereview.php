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
											if($this->uri->segment(6) == NULL){
												echo 'All';
											}{
												echo $this->uri->segment(6);
											}
										?>
										
										purchases List
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
                                	
									<a class="btn <?php if($this->uri->segment(6) === NULL){ echo $btnclass = 'btn-success'; }else{ echo $btnclass = 'btn-default'; } ?>" href="<?php echo base_url(); ?>page/user/viewpurchases/<?php echo $this->session->userdata('userid'); ?>/0" role="button" >
									
										All (<?php echo checkNumber(number_format($all_results)); ?>)
										
									</a>
									
                                </div><!-- End: urfav_title -->
                            </div>
							
                        
                        	<div class="bbttn" style="padding:2px;">
                                <div class="urfav_title"><!-- Begin: urfav_title -->
                                	
									<a class="btn <?php if($this->uri->segment(6) === 'Pending'){ echo $btnclass = 'btn-success'; }else{ echo $btnclass = 'btn-default'; }; ?>" href="<?php echo base_url(); ?>page/user/viewpurchases/<?php echo $this->session->userdata('userid'); ?>/0/Pending" role="button">
									
										Pending (<?php echo checkNumber(number_format($pending_results)); ?>)
										
									</a>
									
                                </div><!-- End: urfav_title -->
                            </div>
							
                        
                        	<div class="bbttn" style="padding:2px;">
                                <div class="urfav_title"><!-- Begin: urfav_title -->
                                	<a class="btn <?php if($this->uri->segment(6) === 'Delivered'){ echo $btnclass = 'btn-success'; }else{ echo $btnclass = 'btn-default'; } ?>" href="<?php echo base_url(); ?>page/user/viewpurchases/<?php echo $this->session->userdata('userid'); ?>/0/Delivered" role="button">
									
										Received (<?php echo checkNumber(number_format($delivered_results)); ?>)
										
									</a>
                                </div><!-- End: urfav_title -->
                            </div>
							
                        
                        	<div class="bbttn" style="padding:2px;">
                                <div class="urfav_title"><!-- Begin: urfav_title -->
                                	<a class="btn <?php if($this->uri->segment(6) === 'Cancelled'){ echo $btnclass = 'btn-success'; }else{ echo $btnclass = 'btn-default'; } ?>" href="<?php echo base_url(); ?>page/user/viewpurchases/<?php echo $this->session->userdata('userid'); ?>/0/Cancelled" role="button">
									
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
						
						foreach($allitem as $allitems){
						$orderiid = $allitems->orderid;
				?>
				
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    
					<div class="purchases_box"><!-- Begin: favitem_box -->
                    	
						<div class="purchase-title">
							
							<h5><b>Purchased from</b> 
								
								<?php
									// Get shopid from mega_orderdetails
									$purchaseShopSql1 = $this->db->query("select orderid,shopid from mega_orderdetails where orderid=$orderiid group by shopid");
									foreach($purchaseShopSql1->result() as $vaal){
										
										$shopid = $vaal->shopid;
										
										// Get shopname from mega_shops
										$purchaseShopSql2 = $this->db->query("select shop_name,shop_location from mega_shops where shopid=$shopid");
										extract($purchaseShopSql2->row_array());
										
										$shopurl = base_url().'page/yourshop/viewshop/'.$shopid;
										
										echo ' - <a href="'.$shopurl.'">'.$shop_name.'</a>';
										
									}
								?>
							</h5>
							
							<h5> <b>Purchased On - </b> <?php echo $allitems->order_date; ?> <span>$<?php echo $allitems->order_amount; ?></span></h5>
							
						</div>
                    	
						<div class="purchase-buttons">
							
							<span class="btn btn-default pbtns"><span class="text-danger"><?php echo $allitems->ordernumber; ?></span></span>
							
							<a class="btn btn-default pbtns" href="<?php echo base_url(); ?>page/user/purchasedetails/<?php echo $this->session->userdata('userid'); ?>/<?php echo $allitems->orderid; ?>/<?php echo $allitems->ordernumber; ?>">
								View purchase details
							</a>
							
							<!--a class="btn btn-default pbtns" href="">Shop Contact</a>
							<a class="btn btn-default pbtns" href="">Shop Name - BuySell24</a-->
							
						</div>
						
						<div class="purchase-products-info">
							
							<span style="display: inline; float: left; padding: 2px 0 2px 5px; width: 75%;">
								<?php
									// Get shopid from mega_orderdetails
									$purchaseShopSql3 = $this->db->query("select productid,shipprocessingtime from mega_orderdetails where orderid=$orderiid");
									foreach($purchaseShopSql3->result() as $vaal2){
										
										$productid = $vaal2->productid;
										
										// Get productName from mega_products
										$purchaseShopSql4 = $this->db->query("select product_name,product_image,shopid from mega_products where productid=$productid");
										extract($purchaseShopSql4->row_array());
										
										// Product details link building
										$pname = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $product_name)))))))).'/'.$productid;
										$producturl = base_url().'page/pdetails/'.$pname;
										
										// Get last shopname from mega_shops
										$lastShopSql2 = $this->db->query("select shop_name from mega_shops where shopid=$shopid");
										extract($lastShopSql2->row_array());
										
										$sspname = $shop_name;
										
										$shpredy = $vaal2->shipprocessingtime;
								?>
								
								<a href="<?php echo $producturl; ?>" style="display: inline; float: left; padding: 2px 0 2px 5px; width: 100%;">
									
									<span class="purchases_productname">
										
										<?php
											echo '<i class="fa fa-product-hunt"></i> '. substr($product_name,0,65);
										?>
										
									</span>
									
								</a>
								
								<?php
									}
								?>
							</span>
							
							
							<span style="float:left;display:inline;width:25%;">
								
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
										
										echo '<img style="width:100px; height:85px;overflow:hidden;display:inline;margin-right: 6px;" src="'.$pimglocationRec.'" alt="'.$product_name.'" class="img-responsive img-thumbnail" />';
										break;
									}
								?>
								</a>
							</span>
							
						</div>
						
						<div class="purchase-status">
							
							<h6><?php echo $allitems->order_status; ?></h6>
							<p>On <?php echo $allitems->order_date; ?></p>
							<p>From <?php echo $shop_location; ?>, VA To <?php echo $allitems->order_usercountry; ?></p>
							<p>Shipping ready to <?php echo $shpredy; ?></p>
							
						</div>
						
                    </div><!-- End: favitem_box -->
					
                </div>
						
				<?php } }else{ ?>
				
					<p>&nbsp;</p>
					
					<h4> <i>Sorry! <?php if($this->uri->segment(6) !== NULL){ echo $this->uri->segment(6); } ?> records didn't found yet!</i> </h4>
				
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

