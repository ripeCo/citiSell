<?php
	$this->load->view('../../front-templates/head.php');
	$this->load->view('../../front-templates/header.php');
	$this->load->view('../../front-templates/navigation.php');
	
	extract($users); // Get all info from users table using userid
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
					
					<span class="p_active"><?php echo $this->session->userdata('displayname'); ?> Profile Setting</span>
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
						<a href="#account" aria-controls="account" role="tab" data-toggle="tab">Account</a>
					</li>
					
                    <!--<li role="presentation"><a href="#preferences" aria-controls="preferences" role="tab" data-toggle="tab">Preferences</a></li>-->
                    <!--<li role="presentation"><a href="#privacy" aria-controls="privacy" role="tab" data-toggle="tab">Privacy</a></li>-->
					
                    <li role="presentation">
						<a href="#security" aria-controls="security" role="tab" data-toggle="tab">Security</a>
					</li>
                    
					<li role="presentation">
						<a href="#addresses" aria-controls="addresses" role="tab" data-toggle="tab">Addresses</a>
					</li>
					
                    <!--<li role="presentation"><a href="#creditcards" aria-controls="creditcards" role="tab" data-toggle="tab">Credit Cards</a></li>-->
                    <!--<li role="presentation"><a href="#emails" aria-controls="emails" role="tab" data-toggle="tab">Emails</a></li>-->
                  </ul>
                
                  <!-- Tab panes -->
                  <div class="tab-content details_tab_content">
                  
                    <div role="tabpanel" class="tab-pane active" id="account">
                    
                        <div class="row">
                        
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="account_about"><!-- Begin: account_about -->
                                	
									<h3 class="account_about_h3">About You</h3>
									
                                    <p class="account_about_p">
										
										<strong>Name</strong><br /><?php echo $this->session->userdata('displayname'); ?> &nbsp;
										
										<a href="<?php echo base_url(); ?>page/user/edituserprofile">
											<i class="fa fa-edit"></i> Edit profile
										</a>
										
									</p>
									
                                    <p class="account_about_p">
										<strong>User Email</strong><br />
										<?php echo $this->session->userdata('useremail'); ?>&nbsp;&nbsp;
										<!--span class="cannot_span">cannot be changed</span-->
									</p>
									
                                    <p class="account_about_p">
										<strong>Member since</strong><br />
										<?php echo $this->session->userdata('userregistrationdate'); ?>
									</p>
									
                                </div><!-- End: account_about -->
                            </div>
                            
                            <!--div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="account_about">
                                	<h3 class="account_about_h3">Connected Accounts</h3>
                                    
                                    <div class="connect_box">
                                    	<p class="connect_box_p"><a href="#"><i class="fa fa-facebook-square"></i> Connect with Facebook</a></p>
                                    </div>
                                    <div class="connect_box">
                                    	<p class="connect_box_p"><a href="#"><i class="fa fa-twitter-square"></i> Connect with Twitter</a></p>
                                    </div>
                                    <div class="connect_box">
                                    	<p class="connect_box_p2"><a href="#"><i class="fa fa-google-plus-square"></i> Connect with Google-plus</a></p>
                                    </div>
                                    <p></p>
                                    
                                </div>
                                
                            </div-->
                            
                        </div>
                        <div class="clearfix"></div>
                        
                       
						<div class="row">
                        
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="account_password"><!-- Begin: account_password -->
                                	<h3 class="account_about_h3"> <i class="fa fa-key"></i>

									Change Password
									
									</h3>
									
                                    <div class="set_pass">
                                        
										<form class="form-horizontal" action="<?php echo base_url(); ?>page/login/changeuserpass" method="post">
                                          
										  <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-5 control-label"> Current Password</label>
                                            <div class="col-sm-7">
                                              
											  <input type="hidden" name="userid" value="<?php echo $this->session->userdata('userid'); ?>" />
											  
                                              <input type="password" name="currentpassword" required="required" class="form-control" placeholder="Enter current password" />
                                            </div>
                                          </div>
										  
                                          <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-5 control-label">New Password</label>
                                            <div class="col-sm-7">
                                              <input type="password" name="newpassword" class="form-control" id="field_pwd1" placeholder="Enter new password" title="Password must contain at least 6 characters, including UPPER/lowercase and numbers." required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" />
                                            </div>
                                          </div>
										  
                                          <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-5 control-label">Confirm New Password</label>
                                            <div class="col-sm-7">
                                              <input type="password" name="confirmnewpassword" class="form-control" id="field_pwd2" placeholder="Enter confirm password" title="Please enter the same Password as above." required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" />
                                            </div>
                                          </div>
										  
                                          <div class="form-group">
                                            <div class="col-sm-offset-5 col-sm-8">
                                              <button type="submit" class="btn btn-info">Change Password</button>
                                            </div>
                                          </div>
										  
                                        </form>
										
                                    </div>
                                </div><!-- End: account_password -->
                            </div>
                            
                        </div>
						
						
                        <div class="clearfix"></div>

                        <div class="row">
                        
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="account_password"><!-- Begin: account_password -->
                                	
									<h3 class="account_about_h3"> <i class="fa fa-envelope"></i> Email</h3>
                                    
									<p class="account_about_p">
										<strong>Current email</strong><br /><?php echo $this->session->userdata('useremail'); ?>
									</p>
									
                                    <p class="account_about_p">
										<strong>Status</strong><br /><br />
										<label class="label label-success">
											<?php echo $this->session->userdata('userstatus'); ?>
										</label>
									</p>
                                    
                                    <h6 class="set_pass_h6"> <i class="fa fa-pencil"></i> Change your email</h6>
                                    
                                    <div class="set_pass">
                                        
										<form class="form-horizontal" action="<?php echo base_url(); ?>page/login/changeuseremail" method="post">
                                          
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-5 control-label">New Email</label>
												<div class="col-sm-7">
													
													<input type="hidden" name="userid" value="<?php echo $this->session->userdata('userid'); ?>" />
													
													<input type="email" name="newemail" required="required" class="form-control" placeholder="Enter new email">
													
												</div>
											</div>
											  
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-5 control-label">Confirm New Email</label>
												<div class="col-sm-7">
												  <input type="email" name="confirmemail" required="required" class="form-control" placeholder="Enter new confirm email" />
												</div>
											</div>
											  
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-5 control-label">Your ctSell Password</label>
												<div class="col-sm-7">
												  <input type="password" name="currentpassword" required="required" class="form-control" placeholder="Enter current password" />
												</div>
											</div>
										  
											<div class="form-group">
												<div class="col-sm-offset-5 col-sm-8">
												  <button type="submit" class="btn btn-info">Change Email</button>
												</div>
											</div>
										  
                                        </form>
										
                                    </div>
                                    
                                </div><!-- End: account_password -->
                            </div>
                            
                        </div>
                        <div class="clearfix"></div>
                        
                        <div class="row">
                        
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="account_password"><!-- Begin: account_password -->
                                	<h3 class="account_about_h3">Close Your Account</h3>
                                    <p class="account_about_p"><strong>What happens when you close your Account?</strong><br />Your profile, shop and listings won't appear anywhere on <?php echo sitename(); ?>.People who try to view your profile, shop or one of your shop's listings will see a message that the page is not available.<br /><br />
Non-delivery cases you have opened will be closed.Reported non-delivery cases for an items you never received from a shop will no longer be active.<br /><br />You can reopen your account any time.If you want to reopen your account, simply sign in to <?php echo sitename(); ?>.com when you want to return. You can also contact <?php echo sitename(); ?> support to help you reopen your account. No one will be able to use your username, and your account settings will remain intact.</p>
                                </div><!-- End: account_password -->
                            </div>
                            
                        </div>

                    </div>
                    
                    <div role="tabpanel" class="tab-pane" id="preferences">
                        <p class="userrt_fav_p">Your favorite shops will live here.</p>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane" id="privacy">
                        <p class="userrt_fav_p">Your favorite Treasury lists will live here.</p>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane" id="security">
                        <div class="row">
                        
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="account_security"><!-- Begin: account_security -->
                                	<h3 class="account_about_h3">Security Settings</h3>
                                    
									<form action="<?php echo base_url(); ?>page/user/signinnotification" method="post">
									
										
										<div class="security_box"><!-- Begin: security_box -->
											<div class="security_lft">
												<p class="security_box_p"><strong>Sign In Notifications</strong><br />Receive an email when your account is accessed from a new device or browser.</p>
											</div>
											
											<div class="security_midle">
												<p class="security_box_p">
													
													<?php if($logininfo == 1){ ?>
														<button class="btn btn-primary" type="button">
															<span class="badge">on</span>
														</button>
													<?php }else{ ?>
														<button class="btn btn-danger" type="button">
															<span class="badge">off</span>
														</button>
													<?php } ?>
													
												</p>
											</div>
											
											<div class="security_rt">
												
												<?php if($logininfo == 1){ ?>
													
													<button class="btn btn-default" name="logininfo" value="0" type="submit" style="float:right;">
														<i class="fa fa-close"></i> Disable
													</button>
													
												<?php }else{ ?>
													
													<button class="btn btn-primary" name="logininfo" value="1" type="submit" style="float:right;">
														<i class="fa fa-check-circle"></i> Enable
													</button>
													
												<?php } ?>
												
											</div>
											
										</div><!-- End: security_box -->
										
									</form>
									
									
									<form action="<?php echo base_url(); ?>page/user/signinhistory" method="post">
									
										<div class="security_box" id="last_box"><!-- Begin: security_box -->
											<div class="security_lft">
												<p class="security_box_p"><strong>Sign In History</strong><br />View your recent sign ins and sign out other active sign ins.</p>
											</div>
											
											<div class="security_midle">
												<p class="security_box_p">
													
													<?php if($loginhistory == 1){ ?>
														<button class="btn btn-primary" type="button">
															<span class="badge">on</span>
														</button>
													<?php }else{ ?>
														<button class="btn btn-danger" type="button">
															<span class="badge">off</span>
														</button>
													<?php } ?>
													
												</p>
											</div>
											
											<div class="security_rt">
												
												<?php if($loginhistory == 1){ ?>
													
													<button class="btn btn-default" name="loginhistory" value="0" type="submit" style="float:right;">
														<i class="fa fa-close"></i> Disable
													</button>
													
												<?php }else{ ?>
													
													<button class="btn btn-primary" name="loginhistory" value="1" type="submit" style="float:right;">
														<i class="fa fa-check-circle"></i> Enable
													</button>
													
												<?php } ?>
												
											</div>
											
										</div><!-- End: security_box -->
									
									</form>
									
                                </div><!-- End: account_security -->
                            </div>
                            
                        </div>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane" id="addresses">
                    	<div class="row">
                        
                        	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                <div class="set_address"><!-- Begin: set_address -->
                                
                                	<h6 class="set_address_h6">Your shipping addresses</h6>
                                    
                                    <div class="address_main"><!-- Begin: address_main -->
                                        
										<p class="security_box_p">
											
											<strong>
												<?php //echo $this->session->userdata('displayname'); ?>
												<i class="fa fa-map-marker"></i>
												Shipping Address 1
											</strong><br /><br />
											
											<address>
												<?php echo $user_address; ?>
											</address>
											
										</p>
										
                                        <div class="footer_add">
                                            
											<button data-toggle="modal" data-target="#addressedit1" data-target=".bs-example-modal-sm" class="btn btn-info" type="submit">
												<?php if($user_address == ''){echo 'Add Address';}else{echo 'Edit Address'; } ?>
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
                                
                                	<h6 class="set_address_h6">&nbsp;</h6>
                                    
                                    <div class="address_main"><!-- Begin: address_main -->
                                        
										<p class="security_box_p">
											
											<strong>
												<?php //echo $this->session->userdata('displayname'); ?>
												<i class="fa fa-map-marker"></i>
												Shipping Address 2
											</strong><br /><br />
											
											<address>
												<?php echo $user_address2; ?>
											</address>
											
										</p>
										
                                        <div class="footer_add">
                                            
											<button data-toggle="modal" data-target="#addressedit2" data-target=".bs-example-modal-sm" class="btn btn-info" type="submit">
												<?php if($user_address2 == ''){echo 'Add Address';}else{echo 'Edit Address'; } ?>
											</button>
											
                                            <!--button class="btn btn-info" type="submit">
												Remove
											</button-->
                                        </div>
                                    </div><!-- End: address_main -->

                                </div><!-- End: set_address -->
                            </div>
							
							
							<!-- Start Of Address Edit -->
							
							<div class="contact_modal">
                           
						   <!-- Modal -->
                            
							<div class="modal fade bs-example-modal-sm" id="addressedit1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                
                                  <div class="modal-header">
                                    
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    
									<h4 class="profile_contact_h4" id="myModalLabel">
										<i class="fa fa-map-marker"></i>
										Shipping Adress <?php if($user_address == ''){echo 'Add New';}else{echo 'Edit'; } ?>
									</h4>
									
                                    <p class="profile_contact_p">of <?php echo $this->session->userdata('displayname'); ?></p>
									
									
                                  </div>
                                  
								<form action="<?php echo base_url(); ?>page/user/shippingaddress1" method="post">
								  
									<div class="modal-body">
										<div class="row">
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="profile_contact">
													  
													  
													  <div class="form-group">
														<label for="exampleInputEmail1">Shipping Address</label>
														<textarea name="user_address1" rows="8" cols="4" class="form-control" placeholder="Write Shipping Address"><?php echo $user_address; ?></textarea>
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
                            
							<div class="modal fade bs-example-modal-sm" id="addressedit2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                
                                  <div class="modal-header">
                                    
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    
									<h4 class="profile_contact_h4" id="myModalLabel">
										<i class="fa fa-map-marker"></i>
										Shipping Adress <?php if($user_address2 == ''){echo 'Add New';}else{echo 'Edit'; } ?>
									</h4>
									
                                    <p class="profile_contact_p">of <?php echo $this->session->userdata('displayname'); ?></p>
									
									
                                  </div>
                                  
								<form action="<?php echo base_url(); ?>page/user/shippingaddress2" method="post">
								  
									<div class="modal-body">
										<div class="row">
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="profile_contact">
													  
													  
													  <div class="form-group">
														<label for="exampleInputEmail1">Shipping Address</label>
														<textarea name="user_address2" rows="8" cols="4" class="form-control" placeholder="Write Shipping Address"><?php echo $user_address2; ?></textarea>
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

                    <div role="tabpanel" class="tab-pane" id="creditcards">
                        <p class="userrt_fav_p">It's only possible to add a new credit card during checkout.</p>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane" id="emails">
                        <p class="userrt_fav_p">Your favorite Treasury lists will live here.</p>
                    </div>
                    
                  </div>
                
                </div>
            </div>  
        
        </div><!-- End: usershop_inner -->        
    </div>
    
    </div>
    
</div><!-- End: inner_page -->


<?php $this->load->view('../../front-templates/footer.php'); ?>