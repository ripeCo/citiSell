
<div class="alfa">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="h_right" style="margin-top:0px !important; margin-bottom:15px;border:none;height:28px;padding:5px 0;"><!-- Begin: h_right -->
				
				<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
					<div class="alfa_lft"><!-- Begin: alfa_lft -->
						<p class="alfa_lft_p">
						
								Where hand made fashion jewelary introducing new style.<br/>
							
							<b style="color: #fff; font-size: 17px; position: relative; top: -3px;"><?php echo betaversion(); ?>!</b>
							
						</p>
					</div><!-- End: alfa_lft -->
				</div>
				
				<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
				
					<div class="shr_box logged"><!-- Begin: shr_box -->
						<a href="<?php echo base_url(); ?>page/user/userarea">
							<i class="fa fa-home i"></i>
							<p class="shr_box_p i">Home</p>
						</a>
					</div><!-- End: shr_box -->
					

					<!--div class="shr_box logged">
						<a href="<?php //echo base_url(); ?>page/user/favotites">
							<i class="fa fa-heart-o i"></i>
							<p class="shr_box_p i">Favorite</p>
						</a>
					</div--><!-- End: shr_box -->
					
					
					
					
					<div class="shr_box logged"><!-- Begin: shr_box -->
						<a href="<?php echo base_url(); ?>page/user/messages/<?php echo $this->session->userdata('userid'); ?>">
							
							<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js" type="text/javascript" charset="utf-8"></script>
							<script type="text/javascript" charset="utf-8">
							 
							function addmsg(type, msg){
							 
								$('#msg-alert').html(msg);
							 
							}
							 
							function waitForMsg(){
							 
								$.ajax({
								type: "GET",
								url: "<?php echo base_url(); ?>page/user/numberOfMessages",
								 
								async: true,
								cache: false,
								timeout:50000,
								 
								success: function(data){
								addmsg("new", data);
								setTimeout(
								waitForMsg,
								1000
								);
								},
								error: function(XMLHttpRequest, textStatus, errorThrown){
								addmsg("error", textStatus + " (" + errorThrown + ")");
								setTimeout(
								waitForMsg,
								15000);
								}
								});
							};
							 
								$(document).ready(function(){
							 
									waitForMsg();
							 
								});
							 
							</script>
							
							<?php
								$receiverid = $this->session->userdata('userid');
								$sqlGetReceiver98 = $this->db->query("select * from mega_message where receiverid='$receiverid' and receivedto='$receiverid' and msgstatus='unread'");
								$sqlFetchReceiver98 = $sqlGetReceiver98->row_array();
								
								//if($sqlGetReceiver98->num_rows() > 0){
									
							?>
							<span id="msg-alert"></span>
							<?php //} ?>
							
							<i class="fa fa-comments i"></i>
							<p class="shr_box_p i">Message</p>
						</a>
					</div><!-- End: shr_box -->
					
					<div class="shr_box logged"><!-- Begin: shr_box -->

						<div class="dropdown">
						  
						  <!-- Check here shop opend or Not Yet ! -->
						<?php
							
							if( $this->session->userdata('shopopen') == 0){
								
						?>
							
						  <a href="<?php echo base_url(); ?>page/yourshop/newshop" id="dLabel">
							<i class="fa fa-shopping-basket i"></i>
							<p class="shr_box_p shop i">Your shop </p>
						  </a>
						  
							<?php
								
								}else{
									
							?>
						  
						  <a id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fa fa-shopping-basket i"></i>
							<p class="shr_box_p shop i">My Shop <i class="fa fa-caret-down i"></i> </p>
						  </a>
						  
						  <ul class="dropdown-menu shp" aria-labelledby="dLabel">

								<div class="user_profie">

								<div class="profile_head">
									
									<div class="userprofile_img">
										<?php
											if( $this->session->userdata('shoplogo') !== NULL ){
												$shoplog = $this->session->userdata('shoplogo');
												$sname = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $this->session->userdata('shopname')))));
										?>
										
										<img src="<?php echo base_url(); ?>assets/frontend/images/shops/<?php echo $sname; ?>/<?php echo $shoplog; ?>" class="img-responsive img-circle" alt="Shop Logo" />
										
										<?php }else{
												$shoplog = 'nologo.jpg';
										?>
										
										<img src="<?php echo base_url(); ?>assets/frontend/images/shops/<?php echo $shoplog; ?>" class="img-responsive img-circle" alt="Shop Logo" />
										<?php } ?>
									</div>
									
									<div class="userprofile_title">
									
										<h6 class="userprofile_title_h6"><?php echo $this->session->userdata('shopname'); ?></h6>
										
										<a style="border:1px solid #ccc !important;background:#eee;color:#333 !important;" href="<?php echo base_url(); ?>page/yourshop/viewshop/<?php echo $this->session->userdata('shopopen'); ?>" class="btn_profile" href="#" role="button">
											
											View Shop 
											<i class="fa fa-chevron-right" style="font-size:13px !important;display:inline;"></i>
											
										</a>
										
									</div>
									
								</div>

								<div class="profile_main0">
									
									<nav id="menu">

										<ul class="parent-menu">

											<li><a href="#">Quick Links</a>

												<ul>

													<li>
														<a href="<?php echo base_url(); ?>page/user/userarea">
															Dashboard
														</a>
													</li>

													<li>
														<a href="<?php echo base_url(); ?>page/user/vieworders/<?php echo $this->session->userdata('userid'); ?>/<?php echo $this->session->userdata('shopopen'); ?>/0">
															Orders
														</a>
													</li>

													<li>
														<a href="<?php echo base_url(); ?>page/yourshop/listingmanager">
															Listing Manager
														</a>
													</li>

													<li>
														<a href="<?php echo base_url(); ?>page/yourshop/addlisting">
															Add a Listing
														</a>
													</li>

												</ul>

											</li>

											<li><a href="#">Listings</a>

												<ul>

													<li>
														<a href="<?php echo base_url(); ?>page/yourshop/listingmanager">
															Listing Manager
														</a>
													</li>

													<li>
														<a href="<?php echo base_url(); ?>page/yourshop/addlisting">
															Add a Listing
														</a>
													</li>

													<!--li>
														<a href="#">
															Shipping Settings
														</a>
													</li-->

													<!--li>
														<a href="#">
															Earn fee Listings
														</a>
													</li-->

												</ul>
											</li>

											<li><a href="">Shop Edit</a>

												<ul>

													<li>
														<a href="<?php echo base_url(); ?>page/yourshop/listingmanager">
															Listing Edit
														</a>
													</li>

													<li>
														<a href="<?php echo base_url(); ?>page/yourshop/deactivatedlisting">
															Listing Active
														</a>
													</li>

													<li>
														<a href="<?php echo base_url(); ?>page/yourshop/activatedlisting">
															Listing Deactive
														</a>
													</li>

													<li>
														<a href="<?php echo base_url(); ?>page/yourshop/listingrenew">
															Listing Renew
														</a>
													</li>

													<li>
														<a href="<?php echo base_url(); ?>page/yourshop/viewshop/<?php echo $this->session->userdata('shopopen'); ?>/vacationmode">
															Shop Vacation
														</a>
													</li>

													<li>
														<a href="<?php echo base_url(); ?>page/yourshop/closeshop/<?php echo $this->session->userdata('userid'); ?>/<?php echo $this->session->userdata('shopopen'); ?>">
															Close Shop
														</a>
													</li>

												</ul>
											</li>
											

											<li><a href="#">Order Management</a>

												<ul>

													<li>
														<a href="<?php echo base_url(); ?>page/user/vieworders/<?php echo $this->session->userdata('userid'); ?>/<?php echo $this->session->userdata('shopopen'); ?>/0">
															Orders
														</a>
													</li>

													<!--li><a href="#">Shipping Labels</a></li>

													<li><a href="#">Reviews</a></li-->

												</ul>
											</li>

											<!--li><a href="#">Promote</a>

												<ul>

													<li><a href="#">Promoted Listings</a></li>

													<li><a href="#">Coupon Codes</a></li>

												</ul>

											</li-->

											<li><a href="#">Finances</a>

												<ul>

													<li>
														<a href="<?php echo base_url(); ?>page/accounts/bill/<?php echo $this->session->userdata('userid');?>/<?php echo $this->session->userdata('shopid');?>/0/?ref=seller_billing_platform">
															Your Bill
														</a>
													</li>

													<li>
														<a href="<?php echo base_url(); ?>page/accounts/billinginfo/<?php echo $this->session->userdata('userid');?>/<?php echo $this->session->userdata('shopid');?>/0/?ref=seller_billing_platform">Billing Info</a>
													</li>

													<li>
														<a href="<?php echo base_url(); ?>page/accounts/payment/<?php echo $this->session->userdata('userid');?>/<?php echo $this->session->userdata('shopid');?>/0/?ref=seller_accounts_platform">Payment Account</a>
													</li>

													<!--li><a href="#">Accepted Payments</a></li-->

												</ul>

											</li>

											<li><a href="#">Shop Settings</a>

												<ul>

													<li>
														<a href="<?php echo base_url(); ?>page/yourshop/shopsettings?act=appearance">
															Info and apperance
														</a>
													</li>

												</ul>

											</li>

										</ul>

									</nav>

								</div>

							</div>
						  </ul>
						  
						  <?php } ?>
						  
						</div>

					</div><!-- End: shr_box -->
					
					

					<div class="shr_box"><!-- Begin: shr_box -->

						<div class="dropdown">
						  
						  <a id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						  <i class="fa fa-user i"></i>
							<p class="shr_box_p i">My Account <i class="fa fa-caret-down i"></i> </p>
						  </a>
						  
						  
							<ul class="dropdown-menu" aria-labelledby="dLabel">

								<div class="user_profie">

								<div class="profile_head">
									
									<div class="userprofile_img">
										<img src="<?php echo base_url(); ?>assets/frontend/images/<?php if($this->session->userdata('user_picture') == NULL ){echo 'users/userprofile.png'; }else{ echo 'users/'.$this->session->userdata('user_picture');} ?>" class="img-responsive img-circle" alt="profile" />
									</div>
									
									<div class="userprofile_title">
									
										<h6 class="userprofile_title_h6"><?php echo $this->session->userdata('displayname'); ?></h6>
										<a href="<?php echo base_url(); ?>page/user/userprofile/<?php echo $this->session->userdata('userid'); ?>" class="btn_profile" role="button">View Profile <i class="fa fa-chevron-right" style="font-size:13px !important;display:inline;"></i> </a>
										
									</div>
									
								</div>

								<div class="profile_main">
									<ul>
										<li>
											<h5 class="profile_footer_p">
												<a href="<?php echo base_url(); ?>page/user/viewpurchases/<?php echo $this->session->userdata('userid'); ?>/0">
													<i class="fa fa-eye"></i> Purchases and reviews
												</a>
											</h5>
										</li>
										
										<li>
											<h5 class="profile_footer_p">
												<a href="<?php echo base_url(); ?>page/user/setting/<?php echo $this->session->userdata('userid'); ?>">
													<i class="fa fa-cog"></i> Account settings
												</a>
											</h5>
										</li>
										
										<!--li>
											<h5 class="profile_footer_p">
												<a href="<?php //echo base_url(); ?>page/user/messages/<?php //echo $this->session->userdata('userid'); ?>">
													<i class="fa fa-envelope"></i> Messages
												</a>
											</h5>
										</li-->
										
									</ul>
								</div>

								<div class="profile_footer">
									<h5 class="profile_footer_p">
										<a href="<?php echo base_url(); ?>page/login/logout"><i class="fa fa-sign-out"></i>&nbsp; Sign out</a>
									</h5>
								</div>

							</div>
						  </ul>
						</div>

					</div><!-- End: shr_box -->
	
					

				</div><!-- End: h_right -->
			</div>
			</div>
		</div>
	</div>
</div>