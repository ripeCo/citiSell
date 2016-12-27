<?php
	$this->load->view('../../front-templates/head.php');
	$this->load->view('../../front-templates/header.php');
	$this->load->view('../../front-templates/navigation.php');
?>


<div id="discover_tems"><!-- Begin: discover_tems -->
    <div class="container">
    
        <div class="row">
            <div class="discover_head"><!-- Begin: discover_head -->
                
            	<h1 class="discover_head_h3">
                    
                    <?php
                        /*if(isset($success_msg)){
                            echo '<span class="text-success"><i class="fa fa-thumbs-up"></i> Congratulation !<span>';
                        }else{
                            echo '<span class="text-danger"><i class="fa fa-frown-o"></i> Nope !<span>';
                        }*/
                    ?>
                    
                </h1>
                
                <h1>&nbsp;</h1>
                <h3> <i class="fa fa-shopping-cart"></i> <?php echo $breadcrumb; ?></h3>
            
                
            </div><!-- End: discover_head -->
        </div>
    </div>
</div><!-- End: discover_tems -->


<div id="what_items"><!-- Begin: what_items -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="whatitem_inner"><!-- Begin: whatitem_inner -->
                    <h3 class="whatitem_inner_h3">
                        
         
                    <?php
                       // Success Or Failor check
                       if(isset($success_msg)){
                           echo '<h4 id="msg" class="text-primary bg-success pdd5"> <i class="fa fa-check-circle"></i> '.$success_msg.' </h4>';
                           echo '<h5 class="text-primary pdd5"> <i class="fa fa-check-square-o"></i> '.$slage.' </h5>';
                       }else if(isset($error_msg)){
                           echo '<h4 class="text-danger bg-danger pdd5"> <i class="fa fa-exclamation-triangle"></i> '.$error_msg.' </h4>';
                       }
                    ?>
                             
                    </h3>
                    
                    <div class="whatitem_more">
                        
						<div>
									
						  <!-- Nav tabs -->
							<ul class="nav nav-tabs" role="tablist">
							
								<li role="presentation" id="signin" class="active">
									<a href="#signin" class="signin" aria-controls="signin" role="tab" data-toggle="tab">Sign In</a>
								</li>
								
								<li role="presentation" id="register" class="">
									<a href="#register" class="registerm" aria-controls="register" role="tab" data-toggle="tab">Register</a>
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
											
												<div class="col-lg-11 col-md-11 col-sm-11 col-xs-12">
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
										
											<div class="col-lg-11 col-md-11 col-sm-11 col-xs-12">
											  <div class="reg_form">
												  
												  <form class="form-horizontal" action="<?php echo base_url(); ?>page/user/userreg" method="post">
												
													  <input type="hidden" name="userip" value="<?php echo $ip; ?>" />
													  <!--input type="hidden" name="user_country" value="<?php //echo $country; ?>" /-->
												
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
														
														<label for="inputEmail3" class="col-sm-3 control-label">Your Country</label>
														
														<div class="col-sm-9">
															
															<select required="required" name="user_country" id="user_country" class="form-control">
																
																<option value="">Select country</option>
																
																<?php $fxdcountry = fixedcountry();  foreach($fxdcountry as $cresult){ 
																
																	if(empty($country)){ $contry = 'Bangladesh';}
																	if($cresult == $contry){ $slt = 'selected="selected"'; }else{ $slt = ''; }
																
																	echo '<option '.$slt.' value="'.$cresult.'">'.$cresult.'</option>';
																
																 } ?>
																
															</select>
															
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
																<input name="newsletter" checked="checked" type="checkbox" value="1">
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
							
							
							<div role="tabpanel" class="tab-pane signi active" id="signin">
							
								<div class="row">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									
										<div class="signin_details"><!-- Begin: register_details -->
										  <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
										  
											  <form class="form-horizontal" id="myForm" action="<?php echo base_url(); ?>page/login/dochklogin" method="post">
											  
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
												
													<div class="col-lg-11 col-md-11 col-sm-11 col-xs-12">
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
												
											</div>
												
											
										</div><!-- End: signin_details -->
									</div>
								</div>
							</div>
							
							
							
						  </div>
						
						</div>   
						
                    </div>
                </div><!-- End: whatitem_inner -->
            </div>
        </div>
    </div>
</div>


<div id="satisfied_customer"><!-- Begin: satisfied_customer -->
    <div class="container">
        <div class="row">
        
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="satisfation_box"><!-- Begin: satisfation_box -->
                	<img src="<?php echo base_url(); ?>assets/frontend/images/interface/satisefaction01.png" class="img-responsive" alt="Satisfield Customer" />
                	<h3 class="satisfation_box_h3">Satisfied Customers</h3>
                    <p class="satisfation_box_p">Get to know shops and items with reviews from our community. </p>
                </div><!-- End: satisfation_box -->
            </div>
            
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="satisfation_box"><!-- Begin: satisfation_box -->
                	<img src="<?php echo base_url(); ?>assets/frontend/images/interface/satisefaction02.png" class="img-responsive" alt="Satisfield Customer" />
                	<h3 class="satisfation_box_h3">Passionate Sellers</h3>
                    <p class="satisfation_box_p">Buy from creative people who care about quality and craftsmanship.</p>
                </div><!-- End: satisfation_box -->
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="satisfation_box"><!-- Begin: satisfation_box -->
                	<img src="<?php echo base_url(); ?>assets/frontend/images/interface/satisefaction03.png" class="img-responsive" alt="Satisfield Customer" />
                	<h3 class="satisfation_box_h3">Secure Transactions</h3>
                    <p class="satisfation_box_p">Feel confident knowing our Trust &amp; Safety team is here to protect you.</p>
                </div><!-- End: satisfation_box -->
            </div>
            
        </div>
    </div>
</div><!-- End: satisfied_customer -->

<?php $this->load->view('../../front-templates/footer.php'); ?>
