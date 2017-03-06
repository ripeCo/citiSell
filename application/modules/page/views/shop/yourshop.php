<?php
	$this->load->view('../../front-templates/head.php');
	$this->load->view('../../front-templates/header.php');
	$this->load->view('../../front-templates/navigation.php');

	if(!empty($users)){
		extract($users); // Get all info from users table using userid
	}else{
		redirect(base_url()."page/yourshop/newshop");
	}
?>
	<!-- This for dependency select category, Subcategory & Subcategory level2 --->
	<script type="text/javascript">
		$(document).ready(function(){
			$("#category").change(function(){
				var id=$(this).val();
				var dataString = 'category_id='+ id;

				$.ajax
				({
				type: "POST",
				url: "<?php echo base_url(); ?>page/yourshop/getproductsubcategory",
				data: dataString,
				cache: false,
				success: function(html)
				{
					$("#subcategory").html(html);
				} 
				});	
			});


			$("#subcategory").change(function(){
				var id=$(this).val();
				var dataString = 'subcategory_id='+ id;

			$.ajax
				({
				type: "POST",
				url: "<?php echo base_url(); ?>page/yourshop/getproductsubcategorylev2",
				data: dataString,
				cache: false,
				success: function(html)
				{
					$("#subcategorylev2").html(html);
				} 
				});
			});

		});
		
		
		
		// Free Shipping
		
		$(document).ready(function(){
			$checks1 = $("#freelocal");
			$checks2 = $("#freeinternational");
			
			$checks1.on('click', function() {
				var string = $checks1.filter(":checked").map(function(i,v){
					return this.value;
				}).get().join(" ");
				$('.field_results1').val(string);
			});
			
			$checks2.on('click', function() {
				var string = $checks2.filter(":checked").map(function(i,v){
					return this.value;
				}).get().join(" ");
				$('.field_results2').val(string);
			});
			
		});
		
	</script>

	<div id="inner_page"><!-- Begin: inner_page -->
		<div class="container">
			<div class="row">
				<div class="usershop_inner"><!-- Begin: usershop_inner -->
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="your_shop"><!-- Begin: your_shop -->
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<form action="#" id="myForm" role="form" data-toggle="validator" method="post" accept-charset="utf-8">
									<!-- SmartWizard html -->
									<div id="smartwizard">
										<ul>
											<li><a href="#step-1"><small>Shop preferences</small></a></li>
											<li><a href="#step-2"><small>Name your shop</small></a></li>
											<li><a href="#step-3"><small>Stock your shop</small></a></li>
											<li><a href="#step-4"><small>How you'll get paid</small></a></li>
											<li><a href="#step-5"><small>Set up billing</small></a></li>
										</ul>
										
										<div>
											<div id="step-1">
												<form role="form" action="" id="preferences" method="post" accept-charset="utf-8">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<h3 class="shop_steptitle">Shop preferences </h3>
													<p class="shop_step_p">Let's get started! Tell us about you and your shop.</p>
													
													<div class="row">
														<div class="stepcontent02"><!-- Begin: stepcontent02 -->
														
															<div class="shopperformance_box"><!-- Begin: shopperformance_box -->
															
																<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
																	<div class="stockform_lft"><!-- Begin: stockform_lft -->
																	
																		<div class="hor_frm">
																			<div class="row">
																				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																					<div class="hor_frm">
																						<div class="row">
																							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																								
																								<div class="form-horizontal">
																								
																								  <div style ="margin-top:15px;" class="form-group">
																									
																									<label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">
																										Shop language <span style="color:#FF3A3D"> *</span>
																									</label>
																									
																									<div class="col-sm-9">
																										
																										<select readonly="readonly" onfocus="this.blur();" id="shop_language" name="shop_language" required="required" style="width:64%;" class="form-control">
																											
																											<option selected="selected" value="English">English</option>
																											
																										</select>
																										
																									</div>
																								  </div>
																								  <div class="clearfix"></div>
																								  
																								  <div style="margin-top:15px;" class="form-group">
																									
																									<label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">
																										Shop country <span style="color:#FF3A3D"> *</span>
																									</label>
																									
																									<div class="col-sm-9">
																										
																										<select readonly="readonly" id="shop_location" name="shop_location" required="required" style="width:64%;" class="form-control">
																										  
																										  <option>What is Country?</option>
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
																								  </div>
																								  
																								  <div class="clearfix"></div>
																								  
																								  <div style="margin-top:15px;" class="form-group">
																									
																									<label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">		Shop currency <span style="color:#FF3A3D"> *</span>
																									</label>
																									
																									<div class="col-sm-9">
																										
																										<select readonly="readonly" id="shop_currency" name="shop_currency" onfocus="this.blur();" required="required" style="width:64%;" class="form-control">
																											
																											<option selected="selected" value="USD">
																												$ United State Dollar
																											</option>
																										</select>
																										
																									</div>
																								  </div>
																								  
																								  <div class="clearfix"></div>
																								  
																								  <div style="margin-top:15px;" class="form-group">
																									
																									<label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">
																										Which of these best describes you?
																										<span style="color:#FF3A3D"> *</span>
																									</label>
																									
																									<div class="col-sm-9">
																										
																										<select id="intention" name="intention" required="required" style="width:64%;" class="form-control">
																											
																											<option selected="selected" value="Selling is my full-time job">
																												Selling is my full-time job
																											</option>
																											
																											<option value="Sell part-time but hope to sell full-time">
																												Sell part-time but hope to sell full-time
																											</option>
																											
																											<option value="I sell part-time and that’s how I like it ">
																												I sell part-time and that’s how I like it 
																											</option>
																											
																											<option value="Other ">
																												Other 
																											</option>
																											
																										</select>
																										
																									</div>
																								  </div>
																								  
																								</div>
																								
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																		
																	</div><!-- End: stockform_lft -->
																</div>
																
																<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
																	<div class="stockform_rht"><!-- Begin: stockform_rht -->
																		
																		<p class="stockform_rht_p">
																			The language you’ll use to describe your items.<br><br><br><br> Where is your shop based?<br><br><br>The currency you'll use to price your items. Shoppers in other countries will automatically see prices in their local currency.<br><br><br>This is just an FYI for us, and won’t affect the opening of your shop.
																		</p>
																		
																	</div><!-- End: stockform_rht -->
																</div>
																
															</div><!-- Begin: shopperformance_box -->
															
															
															
															<div class="row">
																<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																	<button type="button" id="submit" class="btn btn-info nextBtn pull-right btn_submit">Save & Continue</button>
																</div>
															</div>
																						
														</div><!-- End: stepcontent02 -->
														
														
													</div>  
													
												</div>
												</form>
											</div>
											<div id="step-2">
												<form role="form" action="" method="post" accept-charset="utf-8" autocomplete="off">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<h3 class="shop_steptitle">Name your shop 
														<span class='text-success'>
															<?php if(!empty($shop_name)){ echo ' - '.$shop_name; } ?>
														</span>
													</h3>
													
													<p class="shop_step_p">Choose a memorable name that reflects your style.</p>
													
													<div class="row">
														<div class="stepcontent03"><!-- Begin: stepcontent03 -->
																											
															<div class="shopperformance_box"><!-- Begin: shopperformance_box -->
															
																<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-0">
																   
																	<div class="input-group form-group">
																	  
																	<?php if(!empty($shop_name)){ ?>
																	
																	<h4 class='text-success'>
																	   
																	   <?php echo $shop_name; ?> - <b class="badge badge-green"> <i class="fa fa-check"></i> Available</b>
																	   
																	</h4>
																	
																	<?php } ?>
																	  
																	</div>
																   
																   <div class="input-group form-group">
																	  
																	  <input type="hidden" name="old_shopname" value="<?php if(!empty($shop_name)){echo $shop_name;} ?>" />
																	  
																	  
																	  <input type="text" <?php if(!empty($shop_name)){ echo ' onfocus="this.blur();"'; echo ' readonly="readonly"'; } ?> required="required" name="shop_name" id="shop_name" placeholder="Enter your shop name..." class="form-control input-lg inputtxtcheck2" value="<?php if(!empty($shop_name)){ echo $shop_name; } ?>" />
																		
																		<span class="input-group-btn">
																		
																			<button type="button" class="btn btn-info input-lg inputtxtcheck">Check availability</button>
																		
																		</span>
																		
																		<?php //echo base_url().'assets/frontend/images/shops/'; ?>
																	  
																	</div>
																   
																   <div class="input-group form-group">
																	  
																		<span id="result"></span>
																	  
																	</div>
																	
																	<p class="stepcontent03_p">Your shop name will appear in your shop and next to each of your listings throughout ctSell. You can change it later if you’d like. Here are some tips for picking a shop name.</p>
																</div>
																
															</div><!-- Begin: shopperformance_box -->
															
															<div class="row">
																<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																	<button type="button" id="shopnamecheck" class="btn btn-info nextBtn pull-right btn_submit">
																		Save & Continue
																	</button>
																</div>
															</div>
																																			
														</div><!-- End: stepcontent03 -->
														
													</div>  
													
												</div>
												</form>
											</div>
											<div id="step-3">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<h3 class="shop_steptitle">Stock your shop </h3>
													<p class="shop_step_p">Add as many listings as you can. Ten or more would be a great start.<br>More listings means more chances to be discovered! </p>
														
													<div class="row">
													
														<div class="stepcontent02"><!-- Begin: stepcontent01 -->
														
															<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
																<div class="shoppre_box"><!-- Begin: shoppre_box -->
																	<a data-target="#myModal" data-toggle="modal" href="#">
																		
																		<div class="shoppre_bxtop">
																			<i class="fa fa-plus-circle"></i>
																			<h6 class="shoppre_bxtop_h6">Add a listing</h6>
																		</div>
																		<div class="shoppre_bxbtm"></div>
																		
																	</a>
																</div><!-- End: shoppre_box -->
															</div>
															
															
															<?php
																
																if($this->yourshop_model->shopproduct_num($shopid) > 0){
																
																foreach($this->yourshop_model->getproducts($shopid) as $viewproducts){
															?>
															
																<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
																	<div class="shoppre_box"><!-- Begin: shoppre_box -->
																		
																		<a href="#">
																			<div class="shoppre_bxtop">
																				<?php
																					$pimg = explode(',',$viewproducts->product_image);
																						
																					for($pi=0;$pi< count($pimg);$pi++){
																						
																						// Check product Image NULL Or Not
																						if($viewproducts->product_image == NULL){
																							$imglocation = base_url()."assets/frontend/images/shops/default-img.jpg";
																						}else{
																							$sname = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shop_name))));
																							
																							$imglocation = base_url()."assets/frontend/images/shops/$sname/$pimg[$pi]";
																						}
																						
																						echo '<img src="'.$imglocation.'" alt="'.$viewproducts->product_name.'" title="'.$viewproducts->product_name.'" />';
																						break;
																					}
																				?>
																			</div>
																			
																			<div class="shoppre_bxbtm">
																				<h5 class="pname"><?php  echo $viewproducts->product_name; ?></h5>
																				<h6 class="pprice"><?php  echo $viewproducts->product_price; ?> <span>USD</span></6>
																			</div>
																		</a>
																		
																	</div><!-- End: shoppre_box -->
																</div>
															
															<?php		
																	}
																}else{
															?>
															
															<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
																<div class="shoppre_box"><!-- Begin: shoppre_box -->
																	<a href="#">
																		<div class="shoppre_bxtop">
																		</div>
																		<div class="shoppre_bxbtm"></div>
																	</a>
																</div><!-- End: shoppre_box -->
															</div>
															
															
															<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
																<div class="shoppre_box"><!-- Begin: shoppre_box -->
																	<a href="#">
																		<div class="shoppre_bxtop">
																		</div>
																		<div class="shoppre_bxbtm"></div>
																	</a>
																</div><!-- End: shoppre_box -->
															</div>
															
															
															<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
																<div class="shoppre_box"><!-- Begin: shoppre_box -->
																	<a href="#">
																		<div class="shoppre_bxtop">
																		</div>
																		<div class="shoppre_bxbtm"></div>
																	</a>
																</div><!-- End: shoppre_box -->
															</div>
															
															
															<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
																<div class="shoppre_box"><!-- Begin: shoppre_box -->
																	<a href="#">
																		<div class="shoppre_bxtop">
																		</div>
																		<div class="shoppre_bxbtm"></div>
																	</a>
																</div><!-- End: shoppre_box -->
															</div>
															
															
															<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
																<div class="shoppre_box"><!-- Begin: shoppre_box -->
																	<a href="#">
																		<div class="shoppre_bxtop">
																		</div>
																		<div class="shoppre_bxbtm"></div>
																	</a>
																</div><!-- End: shoppre_box -->
															</div>
															
															
															<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
																<div class="shoppre_box"><!-- Begin: shoppre_box -->
																	<a href="#">
																		<div class="shoppre_bxtop">
																		</div>
																		<div class="shoppre_bxbtm"></div>
																	</a>
																</div><!-- End: shoppre_box -->
															</div>
															
															
															<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
																<div class="shoppre_box"><!-- Begin: shoppre_box -->
																	<a href="#">
																		<div class="shoppre_bxtop">
																		</div>
																		<div class="shoppre_bxbtm"></div>
																	</a>
																</div><!-- End: shoppre_box -->
															</div>
															
															<?php } ?>
															
															
															<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																
																<button type="button" id="shoplisting" class="btn btn-info nextBtn pull-right btn_submit">
																	Save & Continue
																</button>
																
															</div>

														</div><!-- End: stepcontent01 -->
														
													</div>   
																								
												</div>
											</div>
											<div id="step-4" class="">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<h3 class="shop_steptitle">How you'll get paid</h3>
													<p class="shop_step_p">Choose a memorable name that reflects your style.</p>
													
													<div class="row">
														<div class="stepcontent03"><!-- Begin: stepcontent03 -->
																											
															<div class="shopperformance_box"><!-- Begin: shopperformance_box -->
															
																<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																
																	<p class="stepcontent03_p"><strong>Payment policies :</strong> We currently accept Paypal. An existing Paypal account is not required to pay via this method. If you would like to pay with any major credit card, simply select Paypal as your method of payment in the ctSell checkout, click on the green "Pay with Paypal" button, and follow the steps to pay with a credit card. Paypal will simply facilitate the transaction.<br><br>

					If you pay via echeck with Paypal it takes 3-5 days before the payment clears. Your order will not be started until the payment has been cleared. This delays production time by 3-5 days.</p>

																</div>
																
															</div><!-- Begin: shopperformance_box -->
															
															<div class="row">
																<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																	<button type="button" class="btn btn-info nextBtn pull-right btn_submit">Save & Continue</button>
																</div>
															</div>
																																			
														</div><!-- End: stepcontent03 -->
														
													</div>  
													
												</div>
											</div>
											<div id="step-5">
												<form role="form" action="<?php echo base_url(); ?>page/yourshop/paymentinfosave" id="billing" method="post" accept-charset="utf-8">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<h3 class="shop_steptitle">Set up billing</h3>
													<p class="shop_step_p">Choose a memorable name that reflects your style.</p>
													
													<div class="row">
														<div class="stepcontent03"><!-- Begin: stepcontent03 -->
																											
															<div class="shopperformance_box"><!-- Begin: shopperformance_box -->
															
																<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																
																	<div class="payment_box01">
																		<h3 class="payment_box_h3">Payment methods</h3>
																		
																		<label style="margin-top:15px;" class="radio-inline">
																			
																			<input type="radio" value="Paypal" class="paypal" name="paymentmethod" id="paymentmethod" />
																			<p class="step5_pay_label">
																				<li class="paypal-icon"></li>
																			</p>
																			
																		</label>
																		
																		<label style="margin-top:15px;" class="radio-inline">
																			
																			<input type="radio" value="Creditcard" class="creditcard" id="paymentmethod" name="paymentmethod">
																			<p class="step5_pay_label">
																				<li class="cc-icons"></li>
																			</p>
																			
																		</label>
																		
																		
																	</div>
																	

																</div>
																
																
																
																<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
																	
																	<!-- Paypal Info -->
																	<div class="paypalinfo" style="display:none;">
																		
																		<div class="form-group">
																			<h4>Enter paypal id</h4>
																		</div>
																		
																		<div class="form-group">
																			<input type="email" name="paymentemail" id="paymentemail" class="form-control" placeholder="Paypal Id" />
																		</div>
																		
																	</div>
																	
																	<!-- Visa,Master etc cards info Info -->
																	<div class="creditcardinfo" style="display:none;">
																		
																		<div class="form-group">
																			<h4>Credit cards information</h4>
																		</div>
																		
																		<div class="form-group">
																			<input type="text" name="paymenttype" id="paymenttype" class="form-control" placeholder="Card Name" />
																		</div>
																		
																		<div class="form-group">
																			<input type="text" name="nameoncard" id="nameoncard" class="form-control" placeholder="Name on your Card" />
																		</div>
																		
																		<div class="form-group">
																			<input type="text" name="cardnumber" id="cardnumber" maxlength="20" autocomplete="off" class="form-control" placeholder="Card Number" />
																		</div>
																		
																		<div class="form-group">
																			<input type="text" name="cvc" id="cvc" maxlength="4" autocomplete="off" class="form-control" placeholder="CVC" />
																		</div>
																		
																		<div class="form-group">
																			<input type="text" name="securitycode" id="securitycode" maxlength="3" autocomplete="off" class="form-control" placeholder="Security code" style="width:250px;" />
																		</div>
																		
																		<div class="form-group">
																			<select class="form-control" name="expiremonth" id="expiremonth" style="width:180px; display:inline;float:left;margin-right:5px;">
																				
																				<option value="">---Card Expire month---</option>
																				
																				<option value="01">Jan</option>
																				
																				<option value="02">Feb</option>
																				
																				<option value="03">Mar</option>
																				
																				<option value="04">Apr</option>
																				
																				<option value="05">May</option>
																				
																				<option value="06">Jun</option>
																				
																				<option value="07">Jul</option>
																				
																				<option value="08">Aug</option>
																				
																				<option value="09">Sep</option>
																				
																				<option value="10">Oct</option>
																				
																				<option value="11">Nov</option>
																				
																				<option value="12">Dec</option>
																				
																			</select>
																			
																			<select class="form-control" name="expireyear" id="expireyear" style="width:180px; display:inline;float:left;margin-right:5px;">
																				
																					<option value="">---Card Expire year---</option>
																				<?php
																					for($y=2015;$y<=2070;$y++){
																						echo '<option value="'.$y.'">'.$y.'</option>';
																					}
																				?>
																				
																				
																			</select>
																		</div>
																		
																	</div>
																	
																</div>
																
																
																<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
																	
																	<!-- Bank Account Info -->
																	<div class="bankinfo" style="display:block;">
																		
																		<div class="form-group">
																			<h4> <i class="fa fa-bank"></i> Bank Info</h4>
																		</div>
																		
																		<div style="margin-top:15px;" class="form-group">
																									
																			<label class="col-sm-4 control-label hor_frm_title" for="inputEmail3">
																				Country <span style="color:#575748"> *</span>
																			</label>

																			<div class="col-sm-8">
																			
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
																		</div>
																		
																		<div class="clearfix"></div>
																		
																			<div style="margin-top:15px;" class="form-group">
																										
																				<label class="col-sm-4 control-label hor_frm_title" for="inputEmail3">
																					Account type <span style="color:#575748"> *</span>
																				</label>

																				<div class="col-sm-8">
																				
																					<select readonly="readonly" id="accounttype" name="accounttype" required="required" style="width:80%;" class="form-control">
																					  
																					  <option>What is account type?</option>
																					  
																					  <option value="Checking account">Checking account</option>
																					  <option value="Savings account">Savings account</option>
																					  <option value="Certificate of Deposit (CD)">Certificate of Deposit (CD)</option>
																					  <option value="Money market account">Money market account</option>
																					  <option value="Individual Retirement Accounts (IRAs)">Individual Retirement Accounts (IRAs)</option>
																					  
																					</select>
																				
																				</div>
																			</div>
																		
																		<div class="clearfix"></div>
																		
																			<div style="margin-top:15px;" class="form-group">
																										
																				<label class="col-sm-4 control-label hor_frm_title" for="inputEmail3">
																					Acc. owner name <span style="color:#575748"> *</span>
																				</label>

																				<div class="col-sm-8">
																				
																				<input type="text" name="accownername" id="accownername" class="form-control" placeholder="Account owner name?" />
																				
																				</div>
																			</div>
																		
																			<div class="clearfix"></div>
																			
																			<div style="margin-top:15px;" class="form-group">
																										
																				<label class="col-sm-4 control-label hor_frm_title" for="inputEmail3">
																					Routing number <span style="color:#575748"> *</span>
																				</label>

																				<div class="col-sm-8">
																				
																				<input type="text" name="routingnumber" id="routingnumber" class="form-control" placeholder="Routing number?" />
																				
																				</div>
																			</div>
																			
																			
																			<div class="clearfix"></div>
																			
																			<div style="margin-top:15px;" class="form-group">
																										
																				<label class="col-sm-4 control-label hor_frm_title" for="inputEmail3">
																					Account number <span style="color:#575748"> *</span>
																				</label>

																				<div class="col-sm-8">
																				
																				<input type="text" name="accountnumber" id="accountnumber" class="form-control" placeholder="Account number?" />
																				
																				</div>
																			</div>
																		
																		</div>
																		
																	</div>
																	
																</div>
																
																
															</div><!-- Begin: shopperformance_box -->
															
															<div class="row">
																<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																	<button type="submit" class="btn btn-info nextBtn pull-right btn_submit">Finish</button>
																</div>
															</div>
															
														</div><!-- End: stepcontent03 -->
														
													</div>
													</form>
											</div>
										</div>
									</div>
									</form>
								</div>
							</div>					
						</div><!-- End: your_shop -->
					</div>  
				</div><!-- End: usershop_inner -->        
			</div>
		</div>
	</div>
	
	<script type="text/javascript">
		// Shop Name Avalibility Check
		$(document).ready(function(){    
			$("#shop_name").keyup(function()
			{		
				var shop_name = $(this).val();	
				
				if(shop_name.length > 3)
				{		
					$("#result").html('checking...');
					
					/*$.post("username-check.php", $("#reg-form").serialize())
						.done(function(data){
						$("#result").html(data);
					});*/
					
					$.ajax({
						
						type : 'POST',
						url  : '<?php echo base_url(); ?>page/yourshop/shopavailablecheck',
						data : $(this).serialize(),
						success : function(data)
							{
								$("#result").html(data);
							}
						});
						return false;
				}
				else
				{
					$("#result").html('');
				}
			});

		});
	</script>


	<!-- Insert Data without Refresh -->

	<script type="text/javascript">
		$(function() {
			// Shop Preferences 
			$('#submit').click(function() {

				//get input data as a array
				var post_data = {
					'shop_language'	: $("#shop_language").val(),
					'shop_currency'	: $("#shop_currency").val(),
					'shop_location'	: $("#shop_location").val(),
					'intention'		: $("#intention").val(),
					'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
				};

				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>page/yourshop/shoppreferences",
					data: post_data,
					success: function(shop_language) {
						// return success message to the id='result' position
						$("#result").html(shop_language);
					}
				});

			});


			// shopname check  
			$('#shopnamecheck').click(function() {

				//get input data as a array
				var post_data = {
					'shop_name'	: $("#shop_name").val(),
					'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
				};

				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>page/yourshop/shopnamesave",
					data: post_data,
					success: function(shop_name) {
						// return success message to the id='result' position
						$("#result").html(shop_name);
					}
				});

			});


			// Set Billing check  
			$('#billing000000').click(function() {

				//get input data as a array
				var paymentmeth = $("#paymentmethod").val();
				
				if(paymentmeth === 'Paypal'){
					var post_data = {
						'paymentmethod'	: $("#paymentmethod").val(),
						'paymentemail'	: $("#paymentemail").val(),
						'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
					};
				}else{
					var post_data = {
						'paymentmethod'	: $("#paymentmethod").val(),
						'cardnumber'	: $("#cardnumber").val(),
						'cvc'			: $("#cvc").val(),
						'securitycode'	: $("#securitycode").val(),
						'expiremonth'	: $("#expiremonth").val(),
						'expireyear'	: $("#expireyear").val(),
						'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
					};
				}

				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>page/yourshop/paymentinfosave",
					data: post_data,
					success: function(paymentmethod) {
						$("#result").html(paymentmethod);
					}
				});

			});
		});
	</script>
<?php //$this->load->view('../../front-templates/footer.php'); ?>
<!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include jQuery Validator plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
    

    <!-- Include SmartWizard JavaScript source -->
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/js/jquery.smartWizard.min.js'); ?>"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            
            // Toolbar extra buttons
            var btnFinish = $('<button></button>').text('Finish')
                                             .addClass('btn btn-info')
                                             .on('click', function(){ 
                                                    if( !$(this).hasClass('disabled')){ 
                                                        var elmForm = $("#myForm");
                                                        if(elmForm){
                                                            elmForm.validator('validate'); 
                                                            var elmErr = elmForm.find('.has-error');
                                                            if(elmErr && elmErr.length > 0){
                                                                alert('Oops we still have error in the form');
                                                                return false;    
                                                            }else{
                                                                alert('Great! we are ready to submit form');
                                                                elmForm.submit();
                                                                return false;
                                                            }
                                                        }
                                                    }
                                                });
            var btnCancel = $('<button></button>').text('Cancel')
                                             .addClass('btn btn-danger')
                                             .on('click', function(){ 
                                                    $('#smartwizard').smartWizard("reset"); 
                                                    $('#myForm').find("input, textarea").val(""); 
                                                });                         
            
            
            
            // Smart Wizard
            $('#smartwizard').smartWizard({ 
                    selected: 0, 
                    theme: 'dots',
                    transitionEffect:'fade',
                    toolbarSettings: {toolbarPosition: 'bottom',
                                      toolbarExtraButtons: [btnFinish, btnCancel]
                                    },
                    anchorSettings: {
                                markDoneStep: true, // add done css
                                markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
                                removeDoneStepOnNavigateBack: true, // While navigate back done step after active step will be cleared
                                enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
                            }
                 });
            
            $("#smartwizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
                var elmForm = $("#form-step-" + stepNumber);
                // stepDirection === 'forward' :- this condition allows to do the form validation 
                // only on forward navigation, that makes easy navigation on backwards still do the validation when going next
                if(stepDirection === 'forward' && elmForm){
                    elmForm.validator('validate'); 
                    var elmErr = elmForm.children('.has-error');
                    if(elmErr && elmErr.length > 0){
                        // Form validation failed
                        return false;    
                    }
                }
                return true;
            });
            
            $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection) {
                // Enable finish button only on last step
                if(stepNumber == 3){ 
                    $('.btn-finish').removeClass('disabled');  
                }else{
                    $('.btn-finish').addClass('disabled');
                }
            });                               
            
        });   
    </script>
<?php include(APPPATH.'modules/front-templates/footer.php'); ?>