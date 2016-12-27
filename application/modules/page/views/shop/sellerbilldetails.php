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
            
            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    
					<a class="btn btn-primary" href="<?php echo base_url(); ?>page/accounts/bill/<?php echo $this->session->userdata('userid');?>/<?php echo $this->session->userdata('shopid');?>/0/?ref=seller_billing_platform">
					
						Return to Bill
						
					</a>
					
					<div class="purchases_box"><!-- Begin: favitem_box -->
                    	
						<div class="purchase-title">
							
							<h4 class="text-success">
								
								<b>
									<i class="fa fa-archive"></i>
									Your All Activity for This Month
								</b>
								
							</h4>
							
						</div>
                    	
						
						<div class="purchase-products-info-0">
							
							<span style="display: inline; float: left; padding: 2px 0 2px 5px; width: 100%; min-height: 241px; height:auto;">
								
								<div class="account_about"><!-- Begin: account_about -->
													
									<div class="datatable-tasks">
										<table class="table table-bordered">
											<thead>
												<tr bgcolor="#ddd">
													<th width="10%">Bill Date</th>
													<th width="50%">Particulars</th>
													<th width="15%">Activity Name</th>
													<th width="15%">Payment (USD)</th>
													<th width="15%">Fees (USD)</th>
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
													<?php echo $allitems->billdate; ?>
												</td>
												
												<td align="left">
													<?php echo $allitems->descriptions; ?>
												</td>
												
													<td>										<?php
														echo $allitems->activitytype;
													?>
												</td>
												
												<td align="right" style="<?php if($allitems->billpayment > 0){ echo 'color:#6AB341'; }else{ echo 'color:#333'; } ?>">(
													<?php
														
														echo '$'.$allitems->billpayment;
														
													?>
												)</td>
												
												<td align="right">(
													<?php
														
														echo '$'.$allitems->fees;
														
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

