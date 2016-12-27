<?php
	$this->load->view('../../front-templates/head.php');
	$this->load->view('../../front-templates/header.php');
	$this->load->view('../../front-templates/navigation.php');
	
	extract($billpaymentinfo);
	
	extract($paymentinfo);
	extract($paymentmethodsinfo);
	
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
										
										<i class="fa fa-shopping-bag" style="color:#FF712D;"></i> 
										
										<span style="color:#5579BB;"><?php echo $breadcrumb; ?> ( <?php echo $this->session->userdata('shopname'); ?> )</span>
										
									</p>
									
                                </div><!-- End: user_name2 -->
								
                            </div>
							
                            
                        </div>
                        
                    </div>  
                </div><!-- End: user_hi -->
            </div>
        </div>
    </div>

	
<form method="post" action="<?php echo base_url(); ?>page/cart/billpayment">

	<input type="hidden" name="userid" value="<?php echo $this->session->userdata('userid'); ?>" />
	<input type="hidden" name="buyername" value="<?php echo $this->session->userdata('displayname'); ?>" />
	<input type="hidden" name="shopname" value="<?php echo $this->session->userdata('shopname'); ?>" />

	<div class="favorite_main">
    	<div class="container">
        
            
        	<div class="row">
				
            	
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    
					<div class="purchases_box"><!-- Begin: favitem_box -->
                    	
						<div class="purchase-title">
							
							<h4 class="text-success">
								<b> <i class="fa fa-check-square"></i> Choose payment amount.  </b>
							</h4>
							
						</div>
                    	
						
						<div class="purchase-products-info-0">
							
							<span style="display: inline; float: left; padding: 8px 0 2px 5px; width: 90%; height:auto;">
								
								
								
									<div class="account_about"><!-- Begin: account_about -->
														
										<h4>
											<input checked="checked" type="radio" id="payment1" value="total_balance" name="paymentamount_choice" />
											Outstanding Bill Amount
											
										</h4>
										
										<h4 class="account_about_po">
											
											<?php echo '$'.number_format($fees,2); ?>
											<input type="hidden" name="totalbill" value="<?php echo $fees; ?>" />
											 
										</h4>
										
										<p> This is the total of all your unpaid fees. </p>
											
										<p style="border-bottom:1px solid #ccc;">&nbsp;</p>
										
														
										<h4>
											<input type="radio" id="payment2" value="other" name="paymentamount_choice" />
											Custom choice amount
											
										</h4>
										
										<h4 class="account_about_po">
											
											<div class="input-group">
											  
											  <span class="input-group-addon">$</span>
											  <input type="text" placeholder="0.00" class="text" name="other_amount" style="border: 1px solid #ccc; border-bottom-right-radius: 4px; border-top-right-radius: 4px; width: 160px;" />
											
											</div>
											 
										</h4>
										
										<p> Custom choice amount cannot be greater than your outstanding amount. </p>
											
										<p style="border-bottom:1px solid #ccc;">&nbsp;</p>
										
										
										<h3>
											<i class="fa fa-shopping-bag"></i>
											<?php echo $this->session->userdata('shopname'); ?>
										</h3>
										
										<p style="border-bottom:1px solid #ccc;">&nbsp;</p>
											
										<p style="padding-left:14px; padding-top:14px;" class="account_about_p">
											
											<h2>
												<i class="fa fa-calendar" aria-hidden="true"></i>
												<span class="text-warning">
													Today - <?php echo date('F d, Y'); ?>
												</span>
											</h2>
											
											<p>&nbsp;</p>
											
										</p>
										
									</div><!-- End: account_about -->
								
								
							</span>
							
						</div>
						
                    </div><!-- End: favitem_box -->
					
                </div>
            
            	
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    
					<div class="purchases_box"><!-- Begin: favitem_box -->
                    	
						<div class="purchase-title">
							
							<h4 class="text-success">
								<b> <i class="fa fa-credit-card-alt"></i> Choose payment method.  </b>
							</h4>
							
						</div>
                    	
						
						<div class="purchase-products-info-0">
							
							<span style="display: inline; float: left; padding: 8px 0 2px 5px; width: 90%; height:auto;">
								
								<div class="account_about"><!-- Begin: account_about -->
													
									<p>&nbsp;</p>
									
									
									
									<h5><b> <i class="fa fa-credit-card-alt"></i> Choose payment method.  </h5>
									
									<p style="padding-left:14px; padding-top:14px;" class="account_about_p">
									
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							
								<div id="panel2">
								
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										
										<h5 style="color: #7fba00; font-weight: bold;">
											
											<input class="billinline" checked="checked" type="radio" name="paymentmethod" value="Paypal" />
												
											<img class="img-responsive billinline" src="<?php echo base_url(); ?>assets/frontend/images/interface/payment03.png" alt="Paypal">
											
										</h5>
										
										<h5 style="color: #7fba00; font-weight: bold;">
											
											<input class="billinline" type="radio" name="paymentmethod" value="Credit-Card" />
												
													<img class="img-responsive billinline" src="<?php echo base_url(); ?>assets/frontend/images/interface/payment01.png" alt="American Express">
													
													<img class="img-responsive billinline" src="<?php echo base_url(); ?>assets/frontend/images/interface/payment02.png" alt="Master Card">
													
													<img class="img-responsive billinline" src="<?php echo base_url(); ?>assets/frontend/images/interface/discover-80.png" alt="Discover">
													
													<img class="img-responsive billinline" src="<?php echo base_url(); ?>assets/frontend/images/interface/payment04.png" alt="Visa Card">
											
										</h5>
										
									</div>
								
								</div>
								
							</div>
										
									</p>
									
										
									<p style="border-bottom:1px solid #ccc;">&nbsp;</p>
									<p style="border-bottom:1px solid #ccc;">&nbsp;</p>
									
									<h3> &nbsp; </h3>
									
									<h3>
										
										<button class="btn btn-success" onclick="return confirmbillpay();" name="billpayment" value="Confirm Bill Payment" type="submit">	
											
											Confirm Bill Payment
											
										</button>
										
									</h3>
									
								</div><!-- End: account_about -->
								
							</span>
							
						</div>
						
                    </div><!-- End: favitem_box -->
					
                </div>
            	
				
                                
            </div>
            
        </div>
    </div>
	
	</form>
	
    
</div><!-- End: inner_page -->


<?php $this->load->view('../../front-templates/footer.php'); ?>

