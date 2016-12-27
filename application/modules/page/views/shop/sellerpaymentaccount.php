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
                                    
									<p class="user_name2_h3">
										
										<i class="fa fa-shopping-bag" style="color:#FF712D;"></i> 
										
										<span style="color:#E75325;"><?php echo $breadcrumb; ?></span>
										
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
								<b> <i class="fa fa-check-square"></i> Available for Deposit </b>
							</h4>
							
						</div>
                    	
						
						<div class="purchase-products-info-0">
							
							<span style="display: inline; float: left; padding: 8px 0 2px 5px; width: 90%; height:241px;">
								
								<div class="account_about"><!-- Begin: account_about -->
													
									<p>&nbsp;</p>
									
									<h4 class="account_about_po">
										
										<?php echo '$'.number_format($currentbalance,2); ?>
										  
									</h4>
									
									
									<h3>
										Your Available Balance.
									</h3>
									
										
									<!--p style="padding-left:14px; padding-top:7px;" class="account_about_p">
									
										You have no deposits scheduled. <br/><br/>

										<?php //if($currentbalance >= 2){ ?>
										
										<input style="padding: 2px 20px;" class="btn btn-success" type="submit"value="Schedule Earlier Deposit" name="disburse">
										
										<?php //}else{ ?>
										
										<input style="padding: 2px 20px;" class="btn btn-default" type="submit" disabled="disabled" value="Schedule Earlier Deposit" name="disburse">
										
										<?php //} ?>
										
									</p-->
										
									<p style="border-bottom:1px solid #ccc;">&nbsp;</p>
										
									<p style="padding-left:14px; padding-top:14px;" class="account_about_p">
										
										<h5><b>Total Account Balance - </b>$<?php echo number_format($currentbalance,2); ?></h5>
										
										<p>When will my funds be available</p>
										
									</p>
									
								</div><!-- End: account_about -->
								
							</span>
							
						</div>
						
                    </div><!-- End: favitem_box -->
					
                </div>
            
            	
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    
					<div class="purchases_box"><!-- Begin: favitem_box -->
                    	
						<div class="purchase-title">
							
							<h4 class="text-success"><b> <i class="fa fa-cog"></i> Account Settings </b></h4>
							
						</div>
                    	
						
						<div class="purchase-products-info-0">
							
							<span style="display: inline; float: left; padding: 8px 0 2px 5px; width: 90%; height:241px;">
								
								<div class="account_about"><!-- Begin: account_about -->
													
									<p>&nbsp;</p>
									
									<h5><b> <i class="fa fa-university"></i> Bank Account </h5>
									
									<p style="padding-left:14px; padding-top:7px;" class="account_about_p">
									
										<?php
											if($bankaccount == 0){
												echo '<b class="text-danger">Bank account didn\'t added yet!</b>';
											}else{ echo '<b class="text-success">Checking account ending in '.substr($accountnumber, -4).'</b>'; }
										?>
										. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
										<a href="<?php echo base_url(); ?>page/accounts/billinginfo/<?php echo $userid; ?>/<?php echo $shopid; ?>/0/?ref=seller_billing_platform">
											Update
										</a> <br/>
										
									</p>
										
									<p style="border-bottom:1px solid #ccc;">&nbsp;</p>
										
									<p>&nbsp;</p>
									
									<?php
										if($paymenttype == 'Creditcard'){
									?>
									
									<h5><b> <i class="fa fa-credit-card-alt"></i> Credit Card </h5>
									
									<p style="padding-left:14px; padding-top:14px;" class="account_about_p">
									
										<?php echo $cardname; ?> ending in <b class="text-success"><?php echo substr($cardnumber, -4); ?></b>. 
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										
										<a href="<?php echo base_url(); ?>page/accounts/billinginfo/<?php echo $userid; ?>/<?php echo $shopid; ?>/0/?ref=seller_billing_platform">
											Update
										</a> <br/>
										
										Expires on <?php echo $expiremonth; ?> / <?php echo $expireyear; ?>
									</p>
									<?php
										}else{
									?>
									
									<h5><b> <i class="fa fa-credit-card-alt"></i> Paypal </h5>
									
									<p style="padding-left:14px; padding-top:14px;" class="account_about_p">
									
										Paypal account id is <b class="text-success"><?php echo substr($paymentemail,0,4); ?>---<?php echo substr($paymentemail, -12); ?></b>. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
										
										
									</p>
									
									<?php
										}
									?>
									
								</div><!-- End: account_about -->
								
							</span>
							
						</div>
						
                    </div><!-- End: favitem_box -->
					
                </div>
            
            	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    
					<div class="purchases_box"><!-- Begin: favitem_box -->
                    	
						<div class="purchase-title">
							
							<h4 class="text-success"><b> <i class="fa fa-archive"></i> Order Activity </b></h4>
							
						</div>
                    	
						
						<div class="purchase-products-info-0">
							
							<span style="display: inline; float: left; padding: 2px 0 2px 5px; width: 100%; min-height: 241px; height:auto;">
								
								<div class="account_about"><!-- Begin: account_about -->
													
									<div class="datatable-tasks">
										<table class="table table-bordered">
											<thead>
												<tr bgcolor="#ddd">
													<th width="10%">Date</th>
													<th width="50%">Description</th>
													<th width="10%">Amount (USD)</th>
													<th width="8%">Fees (USD)</th>
													<th width="8%">Net (USD)</th>
													<th width="10%">Balance (USD)</th>
												</tr>
											</thead>
											<tbody>
												
											<?php
				
											if(is_array($allitem) && count($allitem)) {
												$s = 0;
												foreach($allitem as $allitems){
												//$orderiid = $allitems->orderid;
												
												$s++;
											?>
												
											<tr>
												<td><?php echo $allitems->paymentmonth; ?></td>
												<td><?php echo $allitems->descriptions; ?></td>
												
												<td align="right" style="<?php if($allitems->paymentmade == 'Pending'){ echo 'color:#333'; }else{ echo 'color:#6AB341'; } ?>">(													<?php
														
														echo '$'.$allitems->amount;
														
													?>
												)</td>
												
												<td align="right" style="<?php if($allitems->paymentmade == 'Pending'){ echo 'color:#333'; }else{ echo 'color:#6AB341'; } ?>">(
													<?php
														
														echo '$'.$allitems->fees;
														
													?>
												)</td>
												
												<td align="right" style="<?php if($allitems->paymentmade == 'Pending'){ echo 'color:#333'; }else{ echo 'color:#6AB341'; } ?>">(
													<?php
														
														echo '$'.$allitems->netamount;
														
													?>
												)</td>
												
												<td align="right">(
													<?php
														
														echo '$'.$allitems->currentbalance;
														
													?>
												)</td>
												
											</tr>
												
											<?php
													}
												}
											?>
												
											</tbody>
											
										</table>
									</div>
									
									<!-- Paginations -->
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">    
										<h3 class="border_styles" style="margin-top:25px;">&nbsp;</h3>
											
										<div class="row">
											<div class="col-md-12">
												<div class="row"><?php echo $this->pagination->create_links(); ?></div> 
											</div>
										</div>
											
									</div>
									
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

