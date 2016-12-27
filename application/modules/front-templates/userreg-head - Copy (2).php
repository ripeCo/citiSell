<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-0">
                <div class="h_right"><!-- Begin: h_right -->
                	<div class="row">
                    
                    	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="hr_box"><!-- Begin: hr_box -->
                            	
								<p class="hr_box_p">
									<a href="#register" id="reg" class="registerm" data-toggle="modal" data-target="#myModal">Sell on ctSell</a>
								</p>
								
                            </div><!-- End: hr_box -->
                        </div>
                        
                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="hr_box"><!-- Begin: hr_box -->
                            	
								<p class="hr_box_p">
									<a href="#register" id="reg" class="registerm" data-toggle="modal" data-target="#myModal">Register</a>
								</p>
                                
                                
								
                                <!-- User Registration & Login Popup Modal -->
								 
                                <!-- Modal -->
                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      
                                      <div class="modal-body">
                                        <div class="row">
                                            <div class="popup_tab"><!-- Begin: popup_tab -->
                                            
                                            
                                                <div>
                                                
                                                  <!-- Nav tabs -->
                                                  <ul class="nav nav-tabs" role="tablist">
                                                  
                                                    <li role="presentation" id="register" class="">
                                                        <a href="#register" class="registerm" aria-controls="register" role="tab" data-toggle="tab">Register</a>
                                                    </li>
													
                                                    <li role="presentation" id="signin" class="">
                                                        <a href="#signin" class="signin" aria-controls="signin" role="tab" data-toggle="tab">Sign In</a>
                                                    </li>
													
                                                    <li role="presentation" id="forgotp" class="">
                                                        <a href="#forgotp" class="forgotp" aria-controls="forgotp" role="tab" data-toggle="tab">Forgot Password</a>
                                                    </li>
													
                                                  </ul>
                                                
                                                  <!-- Tab panes -->
                                                  <div class="tab-content">
                                                    <div role="tabpanel" class="tab-pane registr" id="register">
													
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="register_details"><!-- Begin: register_details -->
                                                                        
                                                                  <div class="pop_social">
                                                                
                                                                    <div class="row">
                                                                    
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                          <div class="logfb">
                                                                            <a class="btn btn-default" href="#" role="button" style="width:100%;background:#4682d8;color:#fff;">
                                                                                <i class="fa fa-facebook"></i> Register With Facebook
                                                                            </a>
                                                                          </div>
                                                                        </div>
                                                                        
                                                                        <!--div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-0">
                                                                          <div class="logtt">
                                                                            <a class="btn btn-default" href="#" role="button" style="width:100%;background:#e04733;color:#fff;"><i class="fa fa-google-plus"></i> Register With Google+</a>
                                                                          </div>
                                                                        </div-->
                                                                        
                                                                    </div>
                                                                    
    
                                                                </div>
																  
                                                                <!-- User Registration Start -->
                                                                <?php
                                                                    
                                                                    // Get User Or Visitors Info
                                                                    // this is where you get the ip
                                                                    $ip = $_SERVER['REMOTE_ADDR'];
                                                                    $country_code = getCountryFromIP($ip, "code");
                                                                    // this is where you create the variable that get you the name of the country
                                                                    $country = getCountryFromIP($ip, " NamE ");
                                                                    //echo "Hello there!<br>This is Gaurav Parmar and I welcome you to my website.<br>Your machine's IP is : <b>$ip</b><br>Your visiting country is : <b>$country</b><br>Your country code is : <b>$country_code</b>";
                                                                    
                                                                ?>

                                                                <div class="pop_register">
                                                                
                                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                      <div class="reg_form">
                                                                          
                                                                          <form class="form-horizontal" action="<?php echo base_url(); ?>page/user/userreg" method="post">
                                                                        
                                                                              <input type="hidden" name="userip" value="<?php echo $ip; ?>" />
                                                                              <input type="hidden" name="user_country" value="<?php echo $country; ?>" />
                                                                        
                                                                            <div class="form-group">
                                                                                <label for="inputEmail3" class="col-sm-3 control-label">First Name</label>
                                                                                <div class="col-sm-9">
                                                                                    <input type="text" required="required" class="form-control" id="inputEmail3" name="user_first_name" placeholder="Enter first name" />
                                                                                </div>
                                                                            </div>
                                                                          
                                                                            <div class="form-group">
                                                                                <label for="inputEmail3" class="col-sm-3 control-label">Last Name</label>
                                                                                <div class="col-sm-9">
                                                                                    <input type="text" required="required" class="form-control" id="inputEmail3" name="user_last_name" placeholder="Enter last name" />
                                                                                </div>
                                                                            </div>
                                                                          
                                                                            <div class="radio_box">
                                                                                <div class="form-group">
                                                                                    <label for="inputEmail3" class="col-sm-3 control-label">Gender</label>
                                                                                    <div class="col-sm-9">

                                                                                        <label class="radio-inline">
                                                                                          <input type="radio" name="user_gender" id="inlineRadio1" value="Male">
                                                                                           Male
                                                                                        </label>

                                                                                        <label class="radio-inline">
                                                                                          <input type="radio" name="user_gender" id="inlineRadio1" value="Female">
                                                                                           Female 
                                                                                        </label>

                                                                                        <label class="radio-inline">
                                                                                          <input type="radio" name="user_gender" id="inlineRadio1" value="Private">
                                                                                            Rather not say
                                                                                         </label>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                          
                                                                            <div class="form-group">
                                                                                <label for="inputEmail3" class="col-sm-3 control-label">Enter E-mail</label>
                                                                                <div class="col-sm-9">
                                                                                    <input type="email" required="required" class="form-control" id="inputEmail3" name="user_email" placeholder="Enter e-mail">
                                                                                </div>
                                                                            </div>
                                                                          
                                                                            <div class="form-group">
                                                                                <label for="inputPassword3" class="col-sm-3 control-label">Password</label>
                                                                                <div class="col-sm-9">
                                                                                    <input type="password" class="form-control" id="field_pwd1" name="user_password" placeholder="Enter password" title="Password must contain at least 6 characters, including UPPER/lowercase and numbers." required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}">
                                                                                </div>
                                                                            </div>
                                                                          
                                                                            <div class="form-group">
                                                                                <label for="inputPassword3" class="col-sm-3 control-label">Confirm Password</label>
                                                                                <div class="col-sm-9">
                                                                                    <input type="password" class="form-control" id="field_pwd2" name="conf_user_password" placeholder="Enter confirm password" title="Please enter the same Password as above." required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}">
                                                                                </div>
                                                                            </div>
                                                                          
                                                                          <div class="form-group">
                                                                            <div class="col-sm-offset-3 col-sm-9">
                                                                                
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input name="newsletter" type="checkbox" value="1">
                                                                                       I want to receive ctSell Finds, an email newsletter of fresh trends.
                                                                                    </label>
                                                                                </div>
                                                                            
                                                                            </div>
                                                                          </div>
                                                                          
                                                                        <div class="form-group">
                                                                            <div class="col-sm-offset-3 col-sm-9">
                                                                              <button type="submit" class="btn btn-info btn-sm custom-button" style="width:40%;">Register Now</button>
                                                                            </div>
                                                                        </div>
                                                                          
                                                                          
                                                                        </form>
                                                                      </div>
                                                                    </div>
                                                                        
                                                                </div>
																
																<!-- User Registration End -->
                                                                
                                                                                                                                
                                                                </div><!-- End: register_details -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
													
													
													
                                                    <div role="tabpanel" class="tab-pane signi" id="signin">
													
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            
                                                                <div class="signin_details"><!-- Begin: register_details -->
                                                                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                  
                                                                      <form class="form-horizontal" id="myForm" action="<?php echo base_url(); ?>page/login/dologin" method="post">
                                                                      
                                                                            <div class="form-group">
                                                                                
																				<label for="inputEmail3" class="col-sm-3 control-label">User email</label>
                                                                                <div class="col-sm-9">
                                                                                    
																					<input type="email" name="user_email" class="form-control" id="inputEmail3" placeholder="Enter Email">
																					
																					<?php echo form_error('user_email'); ?>
																					
                                                                                </div>
																				
                                                                            </div>
																			
                                                                            <div class="form-group">
                                                                                
																				<label for="inputPassword3" class="col-sm-3 control-label">Password</label>
                                                                                <div class="col-sm-9">
                                                                                    
																					<input type="password" name="user_password" class="form-control" id="inputPassword3" placeholder="Enter Password">
																					
																					<?php echo form_error('user_password'); ?>
																					
                                                                                </div>
																				
                                                                            </div>
                                                                          
                                                                            <div class="form-group">
                                                                                <div class="col-sm-offset-3 col-sm-9">
                                                                                  <div class="checkbox">
                                                                                    <label>
                                                                                      <input name="remember" type="checkbox" checked="checked" value="1">Remember me
                                                                                    </label>
                                                                                  </div>
                                                                                </div>
                                                                            </div>
                                                                          
                                                                            <div class="form-group">
                                                                                <div class="col-sm-offset-3 col-sm-9 col-md-9 col-lg-9">
                                                                                  <button type="submit" class="btn btn-info btn-sm custom-button" style="width:40%;">Signin</button>
                                                                                </div>
                                                                            </div>
                                                                          
                                                                    </form>
                                                                        
                                                                    <div class="or_separator">
                                                                        <div class="or-spacer">
                                                                          <div class="mask"></div>
                                                                          <span><i>or</i></span>
                                                                        </div>
                                                                      </div>
                                                                    
                                                                      <div class="pop_social">
                                                                    
                                                                        <div class="row">
                                                                        
                                                                            <div class="col-lg-12 col-md-21 col-sm-12 col-xs-12">
                                                                              <div class="logfb">
                                                                                
                                                                                <a class="btn btn-default" href="#" role="button" style="width:100%;background:#4682d8;color:#fff;">
                                                                                        <i class="fa fa-facebook"></i> Sign in With Facebook
                                                                                </a>
																				
                                                                              </div>
                                                                            </div>
                                                                            
                                                                            <!--div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-0">
                                                                              <div class="logtt">
                                                                                <a class="btn btn-default" href="#" role="button" style="width:100%;background:#e04733;color:#fff;"><i class="fa fa-google-plus"></i> Sign in With Google+</a>
                                                                              </div>
                                                                            </div-->
                                                                            
                                                                        </div>
                                                                        
        
                                                                     </div>
                                                                      
																	<div class="modal_fp">
                                                                    
																	</div>
                                                                        <p style="font-size:12px;text-align:center;padding-top:15px;">
																			<!--a href="#" data-toggle="modal" data-target="#forgotpass" style="color:#337ab7;">Forgot Password?</a-->
																				Not yet a member you?
																				<a data-toggle="tab" role="tab" aria-controls="register" class="registerm" href="#register">Register Here
																				</a>
																				
																				<br/>
																				
																				Forgot your password?
																				<a data-toggle="tab" role="tab" aria-controls="forgotp" class="forgotp" href="#forgotp">Password reovery
																				</a>
																				
																				
																		</p>
                                                                    </div>
                                                                        
                                                                    
                                                                </div><!-- End: signin_details -->
                                                            </div>
                                                        </div>
                                                    </div>
													
													
													
													<div role="tabpanel" class="tab-pane forgot" id="forgotp">
													
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            
                                                                <div class="signin_details"><!-- Begin: register_details -->
                                                                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                  
                                                                      <form class="form-horizontal" id="myForm" action="<?php echo base_url(); ?>page/login/resetpass" method="post">
																	  
																			<div class="form-group">
																				<label for="inputEmail3" class="col-sm-3 control-label">User Email</label>
																				<div class="col-sm-9">
																					<input type="email" required="required" name="user_email" class="form-control" id="inputEmail3" placeholder="Enter User Email">
																				</div>
																				<?php echo form_error('user_email'); ?>
																			</div>
																		  
																			<div class="form-group">
																				<div class="col-sm-offset-3 col-sm-9 col-md-9 col-lg-9">
																				  <button type="submit" class="btn btn-info btn-sm custom-button" style="width:40%;">Reset Password</button>
																				</div>
																			</div>
																		  
																	</form>
                                                                        
                                                                    <div class="or_separator">
                                                                        <div class="or-spacer">
                                                                          <div class="mask"></div>
                                                                          <span><i>or</i></span>
                                                                        </div>
                                                                      </div>
                                                                    
                                                                    <div class="modal_fp">
                                                                    
																	</div>
                                                                        <p style="font-size:12px;text-align:center;padding-top:15px;">
																			<!--a href="#" data-toggle="modal" data-target="#forgotpass" style="color:#337ab7;">Forgot Password?</a-->
																				Not yet a member you? <a data-toggle="tab" role="tab" aria-controls="signin" class="signin" href="#signin">Sign In</a>
																		</p>
                                                                    </div>
                                                                        
                                                                    
                                                                </div><!-- End: signin_details -->
                                                            </div>
                                                        </div>
                                                    </div>
													
													
													
                                                    
                                                  </div>
                                                
                                                </div>                                                
                                            
                                            </div><!-- End: popup_tab -->
                                        </div>
                                      </div>
                                      
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
								
								
								
								<!-- Forgot Password Being -->
								
								<div class="modal fade" id="forgotpass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								  <div class="modal-dialog" role="document">
									<div class="modal-content">
									  
									  <div class="modal-body">
										<div class="row">
											<div class="popup_tab"><!-- Begin: popup_tab -->
											
											
												<div>
												
												  <!-- Nav tabs -->
												  <ul class="nav nav-tabs" role="tablist">
												  
													<li role="presentation" class="active">
														
														<a href="#forgotpass" aria-controls="register" role="tab" data-toggle="tab">Forgot Password</a>
														
													</li>
												  </ul>
												
												  <!-- Tab panes -->
												  <div class="tab-content">
													
													<div role="tabpanel" class="tab-pane active" id="forgotpass">
														<div class="row">
															<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
															
																<div class="signin_details"><!-- Begin: register_details -->
																  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																  
																	  <form class="form-horizontal" id="myForm" action="<?php echo base_url(); ?>page/login/resetpass" method="post">
																	  
																			<div class="form-group">
																				<label for="inputEmail3" class="col-sm-3 control-label">User Email</label>
																				<div class="col-sm-9">
																					<input type="email" required="required" name="user_email" class="form-control" id="inputEmail3" placeholder="Enter User Email">
																				</div>
																				<?php echo form_error('user_email'); ?>
																			</div>
																		  
																			<div class="form-group">
																				<div class="col-sm-offset-3 col-sm-9 col-md-9 col-lg-9">
																				  <button type="submit" class="btn btn-info btn-sm custom-button" style="width:40%;">Reset Password</button>
																				</div>
																			</div>
																		  
																	</form>
																		
																	
															</div>
														</div>
													</div>
													
												  </div>
												
												</div>                                                
											
											</div><!-- End: popup_tab -->
										</div>
									  </div>
									  
									  <div class="modal-footer">
										<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
									  </div>
									</div>
								  </div>
								</div>
                                
                            </div><!-- End: hr_box -->
                        </div>
						
						<!-- Forgot Password End -->
                                
                            </div><!-- End: hr_box -->
                        </div>

                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="hr_box"><!-- Begin: hr_box -->
                            	<p class="hr_box_p">
									<a href="#signin" id="#sig" class="signin" data-toggle="modal" data-target="#myModal">Sign in</a>
								</p>
                            </div><!-- End: hr_box -->
                        </div>

                    	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <div class="hr_box01"><!-- Begin: hr_box -->
                            	<p class="hr_box01_p"><a href="cart.php"><i class="fa fa-shopping-cart" style="font-size:18px;"></i> <br />Cart</a></p>
                            </div><!-- End: hr_box -->
                        </div>

                    </div>
                </div><!-- End: h_right -->
            </div>
			
		