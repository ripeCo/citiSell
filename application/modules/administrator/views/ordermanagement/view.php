<?php

	// Common files are loaded
	$this->load->view('../../templates/head-view.php');
	$this->load->view('../../templates/headeer.php');
	$this->load->view('../../templates/sidebar-left.php');

	if(isset($success_msg)){
		
?>
<script> <!-- This Script for Page redirect after 4 second -->
	setTimeout(function(){
		window.location.href = '<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2); ?>';
	},4000)
</script>
<?php } ?>

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->

        <div class="row">
            <div class="col-sm-12">
                <section class="panel">

                    <h5 style="position:relative;top:10px;right: 100px;">
                        
                        <a class="btn btn-success pull-right" href="<?php echo base_url(); ?><?php echo $this->uri->segment(1).'/'.$this->uri->segment(2); ?>">
                            <i class="fa fa-eye"></i>&nbsp;View Record
                        </a>
						
                    </h5>

					<header class="panel-heading">
                       <i class="fa fa-eye"></i> <?php echo $breadcrumb; ?>
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>
                    </header>

                    <?php
                        // Success Or Failor check

                        if(isset($success_msg)){
                            echo '<h4 id="msg" class="text-primary bg-success pdd5"> <i class="fa fa-check-circle"></i> '.$success_msg.' </h4>';
                        }else if(isset($error_msg)){
                            echo '<h4 class="text-danger bg-danger pdd5"> <i class="fa fa-exclamation-triangle"></i> '.$error_msg.' </h4>';
                        }

                    ?>

                    <div class="panel-body">
                        <div class="adv-table">
							<!-- Tasks table -->
							<div class="block">

								<div class="datatable-tasks">
									<table class="display table table-bordered table-striped" id="dynamic-table">
										<thead>
										<tr>
											<th>#</th>
											<th width="75%">Order Details</th>
											<th width="15%">Order Status</th>
										</tr>
										</thead>
										<tbody>

										<?php $s = 0; $i=1; foreach ($vieworders as $result){ $s++; ?>
										
										<?php
											$this->load->model('shopmanagement_model');
										?>
										
											<tr>

												<td> <?php echo $i++; ?> </td>
												<td>
													
													<div class="purchases_box"><!-- Begin: favitem_box -->
                    	
													<div class="purchase-title">
														
														<h5><b>Order from </b>
															
															<?php
																$userid = $result->order_userid;
																$orderiid = $result->orderid;
																
																// Get shopid from mega_orderdetails
																$purchaseShopSql1 = $this->db->query("select * from mega_orderdetails where orderid=$orderiid group by orderid");
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
														
														<h5> <b>Ordered -</b> <?php echo $result->order_date; ?> <span>$<?php echo number_format($subtotal+$shippping_cost,2); ?></span></h5>
														
													</div>
													
													<div class="purchase-buttons">
														
														<h4 class="btn btn-default pbtns">
															<span class="text-danger" style="font-size:18px;"><?php echo $result->ordernumber; ?></span>
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
															
															<a href="<?php echo $producturl; ?>" target="_blank" style="display: inline; float: left; padding: 2px 0 2px 5px; width: 100%;">
																
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
															
															<a target="_blank" href="<?php echo $producturl; ?>"
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
															
															<h6><?php echo $result->order_status; ?></h6><br/>
															
															<p><b>Order On - <?php echo $result->order_date; ?></b></p>
															
															<p><b>Order From - <?php echo $shop_location; ?>, VA To <?php echo $result->order_usercountry; ?></b></p>
															
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
																	
																		Receipt - <?php echo $result->ordernumber; ?>
																	
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
																					Paid via <b><?php echo $result->order_paymenttype; ?></b>
																				</p>
																					
																				<p style="padding-left:14px; padding-top:14px;" class="account_about_p">
																					<i class="fa fa-check-square-o"></i>
																					Paid on <?php echo $result->order_date; ?>.
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
																							if($shpredy !== ''){
																								$myDate = $result->order_date;
																								$wkd = shipprocessingtimes($shpredy);
																								echo date('M d, Y', strtotime($myDate . $wkd));
																							}else{
																								echo '<b class="text-danger">Processing Time didn\'t set yet!</b>';
																							}
																						?>.
																					</b><br/>
																					
																					<span>For orders paid by credit card, marking shipped cannot be undone.</span><br/>
																					
																				</p>
																				
																					
																				<p class="account_about_p">
																					
																					<a style="padding:0px 5px; font-size: 13px;" class="btn btn-success" href="">Print Shipping Label</a>
																					
																					<!--a style="padding:0px 5px; font-size: 13px;" class="btn btn-success" href="">Mark as Shipped</a-->
																					
																				</p>
																				
																				
																				<p class="account_about_p">
																					<strong> <i class="fa fa-map-marker"></i> Ship to</strong><br />
																					 <?php echo $result->order_ship_address; ?>
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
																						
																						Click for view - <?php echo $result->ordernumber; ?>
																						
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
													
												</td>
												
												<td align="center">
													
														<span class="badge bg-primary"><?php echo $result->order_status; ?></span>
												</td>

											</tr>
										<?php } ?>

										</tbody>
									</table>
								</div>
							</div>
							<!-- /tasks table -->
                        </div>
                    </div>
                </section>
            </div>
        </div>


        <!-- page end-->
        </section>
    </section>
    <!--main content end-->

<?php $this->load->view('../../templates/sidebar-right.php'); ?>

</section>

<?php
	$this->load->view('../../templates/view-footer.php');
?>
