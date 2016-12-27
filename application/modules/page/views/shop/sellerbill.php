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

	

	<div class="favorite_main">
    	<div class="container">
        
            
        	<div class="row">
				
				<?php if( $fees > 0 ){ ?>
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="section-header bill auto">
						
						<h3 class="bill" style="text-align:center;">
						
							Your next scheduled payment will be on <span class="payday"><?php echo nextpaymentmonth(); ?>,</span><br>Or, if you donot pay the existing bill within <b class="black"><?php echo paymentwithin(); ?></b>, than your shop will be Disabled untill you paid your bill.
							
						</h3>
						
					</div>
				
				</div>
				
				<?php } ?>
				
            	
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
                    
					<div class="purchases_box"><!-- Begin: favitem_box -->
                    	
						<div class="purchase-title">
							
							<h4 class="text-success">
								<b> <i class="fa fa-archive"></i> Monthly Statements </b>
								
								<form class="pull-right" method="post" action="<?php echo base_url(); ?>page/accounts/bill/<?php echo $this->session->userdata('userid');?>/<?php echo $this->session->userdata('shopid');?>/0/?ref=seller_accounts_platform">
									
									<label for="year">View custom year statements: </label>
									
									<select name="year" id="year">
										<option value="">Select Year?</option>
										<?php
											for($y=2015;$y<2070;$y++){
												
												if($y==date('Y')){
													echo '<option selected="selected" value="'.$y.'">'.$y.'</option>';
												}else{
													echo '<option value="'.$y.'">'.$y.'</option>';
												}
												
												
											}
										?>
										
									</select>
									
									<input type="submit" value="GO" />
									
								</form>
								
							</h4>
							
						</div>
                    	
						
						<div class="purchase-products-info-0">
							
							<span style="display: inline; float: left; padding: 2px 0 2px 5px; width: 100%; min-height: 241px; height:auto;">
								
								<div class="account_about"><!-- Begin: account_about -->
													
									<div class="datatable-tasks">
										<table class="table table-bordered">
											<thead>
												<tr bgcolor="#ddd">
													<th width="10%">Month</th>
													<th width="15%">Opening Balance (USD)</th>
													<th width="15%">Fees (USD)</th>
													<th width="15%">Payments (USD)</th>
													<th width="15%">Closing Balance (USD)</th>
												</tr>
											</thead>
											<tbody>
												
											<?php
				
											if(is_array($allitem) && count($allitem)) {
												foreach($allitem as $allitems){
													
													$bmonth = str_replace(" ","_", $allitems->billmonth);
											?>
												
											<tr>
												<td>
													<a href="<?php echo base_url(); ?>page/accounts/billdetails/<?php echo $this->session->userdata('userid');?>/<?php echo $this->session->userdata('shopid');?>/0/<?php echo $bmonth; ?>">
													
														<?php echo $allitems->billmonth; ?>
														
													</a>
												</td>
												
												<td align="right">$<?php echo $allitems->openingbalance; ?></td>
												
												<td align="right">(													<?php
														
														echo '$'.$allitems->fees;
														
													?>
												)</td>
												
												<td align="right" style="<?php if($allitems->paymentamount == 'Pending'){ echo 'color:#333'; }else{ echo 'color:#6AB341'; } ?>">(
													<?php
														
														echo '$'.$allitems->paymentamount;
														
													?>
												)</td>
												
												<td align="right">(
													<?php
														
														echo '$'.$allitems->closingbalance;
														
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

