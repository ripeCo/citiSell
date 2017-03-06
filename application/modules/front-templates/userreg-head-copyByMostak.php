<div id="alfa"><!-- Begin: alfa -->
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                <div class="alfa_lft"><!-- Begin: alfa_lft -->
                	<p class="alfa_lft_p">
						Where hand made fashion jewelary introducing new style.
						<b style="color: #fff; float: right; font-size: 23px; position: relative; top: -3px;"><?php echo betaversion(); ?>!</b>
					</p>
                </div><!-- End: alfa_lft -->
            </div>
            
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                <div class="alfa_rt"><!-- Begin: alfa_rt -->
					<p class="alfa_rt_p01">
						<a href="#signin" id="#sig" class="signin" data-toggle="modal" data-target=".loggin"><i class="fa fa-lock" aria-hidden="true"></i> Login</a>
					</p>
                	<p class="alfa_rt_p02">
						<a href="#register" id="reg" class="registerm" data-toggle="modal" data-target="#myModal"><i class="fa fa-user" aria-hidden="true"></i> Register</a>
					</p>
                	<p class="alfa_rt_p03">
						<a href="#register" id="reg" class="registerm" data-toggle="modal" data-target="#myModal"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Sell on <?php echo sitename(); ?></a>
					</p>
                    <!--a href="#signin" id="#sig" class="signin" data-toggle="modal" data-target="#myModal">Sign in</a>
					<a href="#register" id="reg" class="registerm" data-toggle="modal" data-target="#myModal">Sell on ctSell</a>
					<a href="#register" id="reg" class="registerm" data-toggle="modal" data-target="#myModal">Register</a-->
					
								
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
										
										<!--li role="presentation" id="forgotp" class="">
											<a href="#forgotp" class="forgotp" aria-controls="forgotp" role="tab" data-toggle="tab">Forgot Password</a>
										</li-->
										
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
																
																<h3>
																	<i class="fa fa-user"></i>
																	New user Register here
																</h3>
																
															  </div>
															</div>
														
															<!--div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
															  <div class="logfb">
																<a class="btn btn-default" href="#" role="button" style="width:100%;background:#4682d8;color:#fff;">
																	<i class="fa fa-facebook"></i> Register With Facebook
																</a>
															  </div>
															</div-->
															
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
																<!--input type="hidden" name="user_country" value="<?php echo $country; ?>" /-->
															
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
																			  <input checked type="radio" name="user_gender" id="inlineRadio1" value="Male">
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
																		<input type="password" class="form-control" id="field_pwd1" name="user_password" placeholder="Enter password" required="required" />
																	</div>
																</div>
																<div class="form-group">
																	<label for="inputPassword3" class="col-sm-3 control-label">Confirm Password</label>
																	<div class="col-sm-9">
																		<input type="password" class="form-control" id="field_pwd2" name="conf_user_password" placeholder="Enter confirm password" required="required" />
																	</div>
																</div>
																
															  
																<div class="form-group">
																	<div class="col-sm-offset-3 col-lg-9">
																		
																		<div class="checkbox">
																			<label>
																				<input name="newsletter" type="checkbox" value="1">
																				I must agree the <a target="_blank" href="<?php echo base_url(); ?>page/terms">Terms & Conditions</a> and <a target="_blank" href="<?php echo base_url(); ?>page/ppolicy">Business Policy</a> for <?php echo sitename(); ?>.com
																			</label>
																		</div>
																	
																	</div>
																</div>
															  
																<div class="form-group">
																	<div class="col-sm-offset-3 col-lg-9">
																	  <button type="submit" class="btn btn-info btn-sm custom-button" style="width:40%;">Register Now</button>
																	</div>
																</div>
																<div style="border-bottom:1px solid #ddd;">&nbsp;</div>
																<div class="form-group">
																	<div class="col-lg-12 col-md-12 col-sm-12">
																		<div class="checkbox">
																			<label>
																				If you do not agree our <a target="_blank" href="<?php echo base_url(); ?>page/terms">Terms & Conditions</a> and <a target="_blank" href="<?php echo base_url(); ?>page/ppolicy">Business Policy</a> please do not register!
																			</label>
																		</div>
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
																	For a new member -
																	<a data-toggle="tab" role="tab" aria-controls="register" class="registerm" href="#register">Register Here
																	</a>
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
                </div><!-- End: alfa_rt -->
            </div>
        </div>
    </div>
</div><!-- End: alfa -->
<script>
	/*
	$('form#signinfrm').on('submit', function(form){
		form.preventDefault();
		$.post(base_url + "page/login/checkuser", $('form#signinfrm').serialize(), function(data){
			$('.edit_modelprice').modal('hide');
			$("input#modelpriceVal").val('');
			if(data.status == 'ok'){
				$('.displayPrice-'+data.model_id).html(data.display_price);
			}else{
				
			}
		}, "json");
	});
	*/
</script>