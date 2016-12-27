<?php
	$this->load->view('../../front-templates/head.php');
	$this->load->view('../../front-templates/header.php');
	$this->load->view('../../front-templates/navigation.php');
	
	extract($billinginfo); // Get all billing info
	
	$usrid = $this->session->userdata('userid');
	// get user billing address
	$billingSql = $this->db->query("select user_address from mega_users where userid=$usrid");
	extract($billingSql->row_array());
	
?>


<div id="inner_page"><!-- Begin: inner_page -->

    <div class="container">
    
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="innerpage_head"><!-- Begin: innerpage_head -->
                
				<p class="innerpage_head_p">
					
					<a href="<?php echo base_url(); ?>page/user/userarea">Home</a>
					<i class="fa fa-angle-double-right"></i>
					
					<a href="<?php echo base_url(); ?>page/user/userprofile/<?php echo $this->session->userdata('userid'); ?>"><?php echo $this->session->userdata('displayname'); ?> Profile</a>
					
					<i class="fa fa-angle-double-right"></i>
					
					<span class="p_active"><?php echo $breadcrumb; ?> </span>
				</p>
				
            </div><!-- End: innerpage_head -->
        </div>  
    </div>
    
    <div class="row">
        <div class="usershop_inner"><!-- Begin: usershop_inner -->
        
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <div class="userlft_fav"><!-- Begin: userlft_fav -->
                    <div class="profile_list">
                    	
						<div class="profilepic"><!-- Begin: profilepic -->
                    	
							<a href="<?php echo base_url(); ?>page/user/userprofile/<?php echo $this->session->userdata('userid'); ?>">
								<img src="<?php echo base_url(); ?>assets/frontend/images/<?php if($this->session->userdata('user_picture') == NULL ){echo 'users/userprofile.png'; }else{ echo 'users/'.$this->session->userdata('user_picture');} ?>" class="img-responsive img-circle" alt="profile" style="margin: 0 20px 0px 0px;" align="left" vspace="5" hspace="5" />
							</a>
							
							<div class="profilepic_browse">
								<a href="<?php echo base_url(); ?>page/user/edituserprofile"><i class="fa fa-camera"></i></a>
							</div>
							
						</div><!-- End: profilepic -->
					
						<ul>
							<li>
								<a href="<?php echo base_url(); ?>page/user/viewpurchases/<?php echo $this->session->userdata('userid'); ?>">Purchases &amp; Reviews</a>
							</li>
							
							<li>
								<a href="<?php echo base_url(); ?>page/user/userprofile/<?php echo $this->session->userdata('userid'); ?>">Public Profile</a>
							</li>
							
							<li>
								<a href="<?php echo base_url(); ?>page/user/setting">Settings</a>
							</li>
							
							<li>
								<a href="<?php echo base_url(); ?>page/login/logout">Sign Out</a>
							</li>
							
						</ul>
						
                    </div>
                </div><!-- End: userlft_fav -->
            </div> 
            
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                <div class="fav_tavuser">
				
									
					<h4 class="col-lg-offset-5">
						<?php
							 
							// Success Or Failor check
							if(isset($success_msg)){
								echo '<span id="msg" class="text-success"> <i class="fa fa-check-circle"></i> '.$success_msg.' </span><br/>';
							}else if(isset($error_msg)){
								echo '<span class="text-danger"> <i class="fa fa-exclamation-triangle"></i> '.$error_msg.' </span><br/>';
							}
						?>
					</h4>
                
                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs tabtitle_setting" role="tablist">
                    
					<li role="presentation" class="active">
						<a href="#addresses" aria-controls="addresses" role="tab" data-toggle="tab">Billing Informations</a>
					</li>
					
                    <!--<li role="presentation"><a href="#creditcards" aria-controls="creditcards" role="tab" data-toggle="tab">Credit Cards</a></li>-->
                    <!--<li role="presentation"><a href="#emails" aria-controls="emails" role="tab" data-toggle="tab">Emails</a></li>-->
                  </ul>
                
                  <!-- Tab panes -->
                  
                    <div role="tabpanel" class="tab-pane" id="addresses">
                    	<div class="row">
                        
                        	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                <div class="set_address"><!-- Begin: set_address -->
									
									<p>&nbsp;</p>
									<h5>BILLING CARD ON FILE</h5>
									<p>This card will also be charged when your Shop Payment Account has a negative balance.</p>
								
                                	<div class="address_main"><!-- Begin: address_main -->
                                        
										<p class="security_box_p">
											
											<?php
												if($paymenttype == 'Creditcard'){
											?>
											
											<h5><b> <i class="fa fa-credit-card-alt"></i> Credit Card </h5>
											
											<p style="padding-left:14px; padding-top:14px;" class="account_about_p">
												
												<h4>
													<?php echo $cardname; ?> ending in <b class="text-success"><?php echo substr($cardnumber, -4); ?></b>
												</h4>
												<b>Expires date -</b> <?php echo $expiremonth; ?> / <?php echo $expireyear; ?>
											</p>
											
											<br/>
											
											<h5><b>Name on card -</b> <?php echo $nameoncard; ?></h5>
											
											<p class="clearfix">&nbsp;</p>
																						
											<br/>
											
											<h5><b>Billing address -</b> </h5>
											
											<br/>
											
											<address>
												<?php echo $user_address; ?>
											</address>
											
											<?php
												}else{
											?>
											
											<h5><b> <i class="fa fa-credit-card-alt"></i> Paypal </h5>
											
											<p style="padding-left:14px; padding-top:14px;" class="account_about_p">
											
												Paypal account id is <b class="text-success"><?php echo substr($paymentemail,0,4); ?>---<?php echo substr($paymentemail, -12); ?></b>.
											</p>
											
											<?php
												}
											?>
											
										</p>
										
                                        <div class="footer_add">
                                            
											<button data-toggle="modal" data-target="#addressedit1" data-target=".bs-example-modal-sm" class="btn btn-info" type="submit">
												<?php if($user_address == ''){echo 'Add Address';}else{echo 'Edit Records'; } ?>
											</button>
											
                                            <!--button class="btn btn-info" type="submit">
												Remove
											</button-->
                                        </div>
                                    </div><!-- End: address_main -->

                                </div><!-- End: set_address -->
                            </div>
                        
						
                        	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                <div class="set_address"><!-- Begin: set_address -->
									
									<p>&nbsp;</p>
									<h6 class="set_address_h6">&nbsp;</h6>
                                    <p>&nbsp;</p>
									
                                    <div class="address_main"><!-- Begin: address_main -->
                                        
										<p class="security_box_p">
											
											<h5><b> <i class="fa fa-university"></i> Bank Account </h5>
									
											<p style="padding-left:14px; padding-top:7px;" class="account_about_p">
											
												<?php
													if($bankaccount == 0){
														echo '<b class="text-danger">Bank account didn\'t added yet!</b>';
													}else{ echo '<b class="text-success">Checking account ending in '.substr($accountnumber, -4).'</b>'; }
												?>
												
											</p>
											
										</p>
										
                                        <div class="footer_add">
                                            
											<button data-toggle="modal" data-target="#addressedit2" data-target=".bs-example-modal-sm" class="btn btn-info" type="submit">
												<?php if($user_address == ''){echo 'Add Address';}else{echo 'Edit Records'; } ?>
											</button>
											
                                            <!--button class="btn btn-info" type="submit">
												Remove
											</button-->
                                        </div>
                                    </div><!-- End: address_main -->

                                </div><!-- End: set_address -->
                            </div
							
							
							<!-- Start Of Address Edit -->
							
							<div class="contact_modal">
                           
						   <!-- Modal -->
                            
							<div class="modal fade bs-example-modal-md" id="addressedit1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                
                                  <div class="modal-header">
                                    
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    
									<h4 class="profile_contact_h4" id="myModalLabel">
										<i class="fa fa-map-marker"></i>
										Credit Card Billing Informations <?php if($user_address == ''){echo 'Add New';}else{echo 'Edit'; } ?>
									</h4>
									
                                    <p class="profile_contact_p">of <?php echo $this->session->userdata('displayname'); ?></p>
									
									
                                  </div>
								  
                                  
								<form action="<?php echo base_url(); ?>page/accounts/billinginfoedit/<?php echo $this->session->userdata('userid'); ?>/<?php echo $this->session->userdata('shopid'); ?>" method="post">
								  
									<div class="modal-body">
										<div class="row">
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="profile_contact">
													  
													  <h5> <i class="fa fa-cc-visa"></i> Credit card Info</h5>
													  
														<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
													  
															<div class="form-group">
															
																<label for="exampleInputEmail1">Name on Card : </label>
															
																<input name="nameoncard" class="form-control" placeholder="Name on card?" value="<?php echo $nameoncard; ?>" />
															
															</div>
													  
														</div>
													  
														<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
													  
															<div class="form-group">
															
																<label for="exampleInputEmail1">Card Name : </label>
															
																<input name="cardname" class="form-control" placeholder="Card Name?" value="<?php echo $cardname; ?>" />
															
															</div>
													  
														</div>
													  
														<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
													  
															<div class="form-group">
															
																<label for="exampleInputEmail1">Card Number : </label>
															
																<input name="cardnumber" class="form-control" placeholder="Card Number?" value="<?php echo $cardnumber; ?>" />
															
															</div>
													  
														</div>
														
													  
														<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
													  
															<div class="form-group">
															
																<input style="width:70px;float:left;display:inline;margin-right:4px;" name="cvc" class="form-control" placeholder="CVC?" value="<?php echo $cvc; ?>" />
																
																<input style="width:70px;float:left;display:inline;margin-right:4px;" name="securitycode" class="form-control" placeholder="security code?" value="<?php echo $securitycode; ?>" />
																
																<input style="width:120px;float:left;display:inline;margin-right:4px;" name="expiremonth" class="form-control" placeholder="Expire Month?" value="<?php echo $expiremonth; ?>" />
																
																<input style="width:120px;float:left;display:inline;margin-right:4px;" name="expireyear" class="form-control" placeholder="Expire year?" value="<?php echo $expireyear; ?>" />
															
															</div>
													  
														</div>
														
														<h2>&nbsp;</h2>
														<p style="clear:both;">&nbsp;</p>
													  
													  
														<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													  
															<div class="form-group">
														
															<label for="exampleInputEmail1">Billing Address : </label>
															
															<textarea name="user_address1" rows="4" cols="4" class="form-control" placeholder="Write Shipping Address"><?php echo $user_address; ?></textarea>
														
														</div>
													  
													  </div>
													  
													
												</div>
											</div>
										</div>
									</div>
                                  
                                  <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                    <button type="reset" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                  </div>
								  
								  
								</form>
								  
                                </div>
                              </div>
                            </div>
                            
							
							
							
							<div class="modal fade bs-example-modal-md" id="addressedit2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                
                                  <div class="modal-header">
                                    
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    
									<h4 class="profile_contact_h4" id="myModalLabel">
										<i class="fa fa-map-marker"></i>
										Bank Account Billing Informations <?php if($user_address == ''){echo 'Add New';}else{echo 'Edit'; } ?>
									</h4>
									
                                    <p class="profile_contact_p">of <?php echo $this->session->userdata('displayname'); ?></p>
									
									
                                  </div>
                                  
								<form action="<?php echo base_url(); ?>page/accounts/billingbankinfoedit/<?php echo $this->session->userdata('userid'); ?>/<?php echo $this->session->userdata('shopid'); ?>" method="post">
								  
									<div class="modal-body">
										<div class="row">
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="profile_contact">
													  
													  
													<div class="form-group">
														
														<label for="exampleInputEmail1">Bank Country Name</label>
														
														<select readonly="readonly" id="bankcountry" name="bankcountry" required="required" style="width:80%;" class="form-control">
															  
															<option>What is bank Country?</option>
															<optgroup label="Select a Country">
																
																<option value="">Select country</option>
																								
																<?php $fxdcountry = fixedcountry();  foreach($fxdcountry as $cresult){ 
																
																	if(empty($country)){ $contry = 'Bangladesh';}
																	if($cresult == $contry){ $slt = 'selected="selected"'; }else{ $slt = ''; }
																
																	echo '<option '.$slt.' value="'.$cresult.'">'.$cresult.'</option>';
																
																 } ?>
																
															</optgroup>
														  
														</select>
														
													</div>
													  
													  
													<div class="form-group">
														
														<label for="exampleInputEmail1">Bank Name</label>
														
														<input name="bankname" style="width:80%;" class="form-control" value="<?php echo $bankname; ?>" placeholder="Bank Name?" />
														
													</div>
													  
													  
													<div class="form-group">
														
														<label for="exampleInputEmail1">Account Type</label>
														
														<select readonly="readonly" id="accounttype" name="accounttype" required="required" style="width:80%;" class="form-control">
																  
														  <option>What is account type?</option>
														  
														  <option <?php if($accounttype == 'Checking account'){ echo 'selected="selected"'; } ?> value="Checking account">Checking account</option>
														  
														  <option <?php if($accounttype == 'Savings account'){ echo 'selected="selected"'; } ?> value="Savings account">Savings account</option>
														 
														 <option <?php if($accounttype == 'Certificate of Deposit (CD)'){ echo 'selected="selected"'; } ?> value="Certificate of Deposit (CD)">Certificate of Deposit (CD)</option>
														  
														  <option <?php if($accounttype == 'Money market account'){ echo 'selected="selected"'; } ?> value="Money market account">Money market account</option>
														  
														  <option <?php if($accounttype == 'Individual Retirement Accounts (IRAs)'){ echo 'selected="selected"'; } ?> value="Individual Retirement Accounts (IRAs)">Individual Retirement Accounts (IRAs)</option>
														  
														</select>
														
													</div>
													  
													  
													<div class="form-group">
														
														<label for="exampleInputEmail1">Acc. owner name <span style="color:#575748"> *</span></label>
														
														<input type="text" name="accownername" value="<?php echo $accownername; ?>" style="width:80%;" id="accownername" class="form-control" placeholder="Account owner name?" />
														
													</div>
													  
													  
													<div class="form-group">
														
														<label for="exampleInputEmail1">Routing Number <span style="color:#575748"> *</span></label>
														
														<input type="text" name="routingnumber" value="<?php echo $routingnumber; ?>" style="width:80%;" id="routingnumber" class="form-control" placeholder="Routing number?" />
														
													</div>
													  
													  
													<div class="form-group">
														
														<label for="exampleInputEmail1">Account number <span style="color:#575748"> *</span></label>
														
														<input type="text" name="accountnumber" value="<?php echo $accountnumber; ?>" style="width:80%;" id="accountnumber" class="form-control" placeholder="Account number?" />
														
													</div>
													  
													
												</div>
											</div>
										</div>
									</div>
                                  
                                  <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                    <button type="reset" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                  </div>
								  
								  
								</form>
								  
                                </div>
                              </div>
                            </div>
							
							
                        </div>
						
						<!-- End Of Address Edit -->
                            
                        	<!--div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-5 col-xs-offset-0">
                                <div class="set_address">
                                    <button class="btn btn-default" type="submit" style="float:right">Add a new address</button>
                                </div>
                            </div-->
                            
                        </div>
                    </div>
                    
                  </div>
                
                </div>
            </div>  
        
        </div><!-- End: usershop_inner -->        
    </div>
    
    </div>
    
</div><!-- End: inner_page -->


<?php $this->load->view('../../front-templates/footer.php'); ?>
