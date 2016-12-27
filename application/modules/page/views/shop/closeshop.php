<?php
	$this->load->view('../../front-templates/head.php');
	$this->load->view('../../front-templates/header.php');
	$this->load->view('../../front-templates/navigation.php');
	
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
                                    
									<p class="user_name2_h3" style="font-size:24px;">
										
										<i class="fa fa-times-circle-o" style="color:#f00;"></i> 
										
										<span style="color:#f00;"><?php echo $breadcrumb; ?> ( <?php echo $this->session->userdata('shopname'); ?> )</span>
										
									</p>
									
                                </div><!-- End: user_name2 -->
								
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
                    
					<div class="purchases_box"><!-- Begin: favitem_box -->
                    	
						<div class="purchase-title">
							
							<h4 class="text-success">
								<b> <i class="fa fa-check-square"></i> Your billing amounts </b>
							</h4>
							
						</div>
                    	
						
						<div class="purchase-products-info-0">
							
							<span style="display: inline; float: left; padding: 8px 0 2px 5px; width: 90%; height:241px;">
								
								<div class="account_about"><!-- Begin: account_about -->
													
									<h4>Your outstanding balance</h4>
									
									<h4 class="account_about_po">
										
										<?php echo '$'.number_format($fees,2); ?>
										  
									</h4>
										
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
								<b> <i class="fa fa-credit-card-alt"></i> Payment </b>
							</h4>
							
						</div>
                    	
						
						<div class="purchase-products-info-0">
							
							<span style="display: inline; float: left; padding: 8px 0 2px 5px; width: 90%; height:241px;">
								
								<div class="account_about"><!-- Begin: account_about -->
													
									<p>&nbsp;</p>
									
									<?php
										if($paymenttype == 'Creditcard'){
									?>
									
									<h5><b> <i class="fa fa-credit-card-alt"></i> Credit Card </h5>
									
									<p style="padding-left:14px; padding-top:14px;" class="account_about_p">
									
										<b class="text-success"><?php echo $cardname; ?></b> ending in <b class="text-success"><?php echo substr($cardnumber, -4); ?></b>. 
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <!--a href=""> Update </a--> <br/>
										
										Expires on <?php echo $expiremonth; ?> / <?php echo $expireyear; ?>
									</p>
									<?php
										}else{
									?>
									
									<h5><b> <i class="fa fa-credit-card-alt"></i> Paypal </h5>
									
									<p style="padding-left:14px; padding-top:14px;" class="account_about_p">
									
										Paypal account id is <b class="text-success"><?php echo substr($paymentemail,0,4); ?>---<?php echo substr($paymentemail, -12); ?></b>. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href=""> Update </a>
									</p>
									
									<?php
										}
									?>
										
									<p style="border-bottom:1px solid #ccc;">&nbsp;</p>
										
									<p>&nbsp;</p>
									
									<h3>
										<?php if($fees > 0){ ?>
										
										<a class="btn btn-success" href="<?php echo base_url(); ?>page/accounts/billpayment/<?php echo $this->session->userdata('userid');?>/<?php echo $this->session->userdata('shopid');?>">
										
										<?php }else{ ?>
										
										<a class="btn btn-success" style="pointer-events: none; cursor: default;" href="">
										
										<?php } ?>
										
											Make your billing payment
											
										</a>
									</h3>
									
								</div><!-- End: account_about -->
								
							</span>
							
						</div>
						
                    </div><!-- End: favitem_box -->
					
                </div>
				
				
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    
					<div class="purchases_box0"><!-- Begin: favitem_box -->
                    	
						
						<div class="purchase-products-info-0">
							
							<span style="display: inline; float: left; padding: 2px 0 2px 5px; width: 100%; min-height: 241px; height:auto;">
								
								<div class="account_about"><!-- Begin: account_about -->
									
									<?php if($fees > 0){ ?>
									
									<h3 class="text-danger" style="font-style: italic; font-weight: bold; position: absolute; top: 50px;">
										<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
									
										<b><u>Important Notes:</u>- </b> May you have outstanding bill remaining, please paid your due bill then you can close your shop.
									</h3>
									
									<a onclick="return confirmshopDelete();" title="May you have outstanding bill remaining, please paid your due bill then you can close your shop." class="btn btn-danger btn-lg shopdelete" style="position: absolute; top: 130px; width: 300px; pointer-events: none; cursor: default;" href="">
										
										<i class="fa fa-times-circle" aria-hidden="true"></i> 
										Click to Close Your Shop
									</a>
									
									<?php }else{ ?>
									
									<a onclick="return confirmshopDelete();" title="Close Your Shop" class="btn btn-danger btn-lg shopdelete" style="position: absolute; top: 61px; width: 300px;" href="<?php echo base_url(); ?>page/yourshop/shopconfirmclose/<?php echo $this->session->userdata('userid'); ?>/<?php echo $this->session->userdata('shopopen'); ?>">
										
										<i class="fa fa-times-circle" aria-hidden="true"></i> 
										Click to Close Your Shop
									</a>
									
									<?php } ?>
									
									
								</div><!-- End: account_about -->
								
							</span>
							
						</div>
						
                    </div><!-- End: favitem_box -->
					
                </div>
            
            	
				                
            </div>
            
        </div>
    </div>
	
    
</div><!-- End: inner_page -->


<?php $this->load->view('../../front-templates/footer.php'); ?>

