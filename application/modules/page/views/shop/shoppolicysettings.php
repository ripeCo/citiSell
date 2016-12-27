<?php
	$this->load->view('../../front-templates/head.php');
	$this->load->view('../../front-templates/header.php');
	$this->load->view('../../front-templates/navigation.php');
?>


<div id="inner_page"><!-- Begin: inner_page -->

    <div class="container">
    
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="innerpage_head"><!-- Begin: innerpage_head -->
                
				<p class="innerpage_head_p">
					<a href="<?php echo base_url(); ?>page/user/userarea">Home</a>
					<i class="fa fa-angle-double-right"></i>
					<span class="p_active"> Shop Policy settings</span>
				</p>
				
            </div><!-- End: innerpage_head -->
        </div>  
    </div>
    
    <div class="row">
        <div class="usershop_inner"><!-- Begin: usershop_inner -->
        
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <div class="userlft_fav"><!-- Begin: userlft_fav -->
                    <div class="profilepic"><!-- Begin: profilepic -->
                    	
						<a href="<?php echo base_url(); ?>page/user/userprofile/<?php echo $this->session->userdata('userid'); ?>">
							<img src="<?php echo base_url(); ?>assets/frontend/images/<?php if($this->session->userdata('user_picture') == NULL ){echo 'users/userprofile.png'; }else{ echo 'users/'.$this->session->userdata('user_picture');} ?>" class="img-responsive img-circle" alt="profile" style="margin: 0 20px 0px 0px;" align="left" vspace="5" hspace="5" />
                    	</a>
						
						<div class="profilepic_browse">
                        	<a href="<?php echo base_url(); ?>page/user/edituserprofile"><i class="fa fa-camera"></i></a>
                        </div>
						
                    </div><!-- End: profilepic -->
					
                    <h6 class="profilepic_browse_h6">
						<a href="<?php echo base_url(); ?>page/user/userprofile/<?php echo $this->session->userdata('userid'); ?>">
							<?php echo $this->session->userdata('displayname'); ?>
						</a>
					</h6>
					
                    <div class="profile_list">
                    	
						<ul>
                        	<li>
								<a href="<?php echo base_url(); ?>page/user/userprofile/<?php echo $this->session->userdata('userid'); ?>">Profile</a>
							</li>
							
                        	<li>
								<a href="<?php echo base_url(); ?>page/user/favotites">Favorites</a>
							</li>
							
                        	<!--li>
								<a href="followers.php">Followers</a>
							</li-->
							
                        	<li>
								<a href="#" data-toggle="modal" data-target="#myModal3" data-target=".bs-example-modal-sm">Contact</a>
							</li>
							
                        </ul>
						
                    </div>
                    
                    
					<div class="contact_modal">
                            <!-- Modal -->
                            <div class="modal fade bs-example-modal-sm" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                
                                  <div class="modal-header">
                                    
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									
                                    <h4 class="profile_contact_h4" id="myModalLabel">
										<i class="fa fa-envelope"></i>
										New conversation
									</h4>
									
                                    <p class="profile_contact_p">with <?php echo $this->session->userdata('displayname'); ?></p>
									
                                  </div>
                                  
                                  <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="profile_contact">
                                                
												<form action="" method="post">
                                                  
												  <div class="form-group">
                                                    <label for="exampleInputEmail1">Subject</label>
                                                    <input type="email" class="form-control" placeholder="Enter subject">
                                                  </div>
                                                  
												  <div class="form-group">
                                                    <label for="exampleInputEmail1">Message</label>
                                                    <textarea rows="3" cols="3" class="form-control" placeholder="Enter message"></textarea>
                                                  </div>
												  
                                                  <!--div class="form-group">
                                                    <label for="exampleInputFile">Attached image</label>
                                                    <input type="file" id="exampleInputFile">
                                                  </div-->
												  
                                                </form>
												
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                  
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-primary">Send</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
					
                    
                </div><!-- End: userlft_fav -->
            </div> 
            
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                <div class="userrt_fav"><!-- Begin: userrt_fav -->
                	<h6 class="userrt_fav_h6">
						<i class="fa fa-cog"></i>
						Shop Policy
					</h6>
                    
                    <div class="fav_tavuser">
                    
                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs" role="tablist">
                        
						<li role="presentation">
							<a href="<?php echo base_url(); ?>page/yourshop/shopsettings?act=appearance">Info & Appearance</a>
						</li>
                        
						<li role="presentation" class="active">
							<a href="<?php echo base_url(); ?>page/yourshop/shoppolicysettings?act=policy">Policy</a>
						</li>
						
                        <!--li role="presentation"><a href="#treasuries" aria-controls="treasuries" role="tab" data-toggle="tab">Treasuries</a></li-->
						
                      </ul>
                    
                      <!-- Tab panes -->
                      <div class="tab-content" style="background: #f5f5f1 none repeat scroll 0 0; height: auto; min-height: 263px; overflow: hidden; padding: 12px 15px;">
					  
                        <div role="tabpanel" class="tab-pane" id="shopitems">...</div>
                        
                        <div role="tabpanel" class="tab-pane active" id="shopshop">
						
						<?php
							$useriid = $this->session->userdata('userid');
							$shopiid = $this->session->userdata('shopid');
							
							$shoppingSql = $this->db->query("select * from mega_shopsettings where shopid=$shopiid and userid=$useriid");
							
							if($shoppingSql->num_rows() >0){
								$shopprivacypolicysave = 'shopprivacypolicyupdate';
								extract($shoppingSql->row_array());
							}else{
								$shopprivacypolicysave = 'shopprivacypolicysave';
							}
						?>
                        
                        	<form role="form" action="<?php echo base_url(); ?>page/yourshop/<?php echo $shopprivacypolicysave; ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8" autocomplete="off">
							
								<div class="col-lg-11 col-md-11 col-sm-11 col-xs-12">
									<div class="stockform_lft"><!-- Begin: stockform_lft -->
										<div class="row">
											
											<h5 class="text-center">
												<?php
													 
													// Success Or Failor check
													if(isset($success_msg)){
														
														echo '<span id="msg" class="text-success"> <i class="fa fa-check-circle"></i> '.$success_msg.' </span><br/>';
														$redurl = base_url().'page/yourshop/shoppolicysettings';
														$this->output->set_header('refresh:3; url='.$redurl);
														
													}else if(isset($error_msg)){
														
														echo '<span class="text-danger"> <i class="fa fa-exclamation-triangle"></i> '.$error_msg.' </span><br/>';
														
													}
													
												?>

											</h5>
											
											<div class="form-group">
												
												<h3>Shop Policies</h3>
												
												<p> Ctsell encourages all shops to post policies to help shoppers make informed purchases.Don't forget! Shop Policies must follow Ctsell's Seller Guidelines and Terms of Use.Get ideas on writing shop policies. </p>
												
											</div>
											
											<hr />
											
											
											<div class="form-group">
												<label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">
													Welcome Message
												</label>
												
												<div class="col-sm-9">
													<textarea name="welcomemsg" class="form-control" id="" cols="30" rows="5" placeholder="Write your shop welcome message..."><?php if(!empty($welcomemsg)){ echo $welcomemsg; } ?></textarea>
												</div>
											</div>
											
											
											<div class="clearfix">&nbsp;</div>
											
											<div class="form-group">
												<label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">
													Payment Policy
												</label>
												
												<div class="col-sm-9">
													<textarea name="paymentpolicy" class="form-control" id="" cols="30" rows="5" placeholder="Write your shop privacy policy..."><?php if(!empty($paymentpolicy)){ echo $paymentpolicy; } ?></textarea>
												</div>
											</div>
											
											
											<div class="clearfix">&nbsp;</div>
											
											<div class="form-group">
												<label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">
													Shipping Policy
												</label>
												
												<div class="col-sm-9">
													<textarea name="shippingpolicy" class="form-control" id="" cols="30" rows="15" placeholder="Write your shop shipping policy..."><?php if(!empty($shippingpolicy)){ echo $shippingpolicy; } ?></textarea>
												</div>
											</div>
											
											
											<div class="clearfix">&nbsp;</div>
											
											<div class="form-group">
												<label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">
													Refund Policy
												</label>
												
												<div class="col-sm-9">
													<textarea name="refundpolicy" class="form-control" id="" cols="30" rows="5" placeholder="Write your shop refund policy..."><?php if(!empty($refundpolicy)){ echo $refundpolicy; } ?></textarea>
												</div>
											</div>
											
											
											<div class="clearfix">&nbsp;</div>
											
											<div class="form-group">
												<label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">
													Additional Information
												</label>
												
												<div class="col-sm-9">
													<textarea name="additionalinfo" class="form-control" id="" cols="30" rows="5" placeholder="Write your shop additional information..."><?php if(!empty($additionalinfo)){ echo $additionalinfo; } ?></textarea>
												</div>
											</div>
											
											
											<div class="clearfix">&nbsp;</div>
											
											<div class="form-group">
												<label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">
													Private receipt info
												</label>
												
												<div class="col-sm-9">
													<textarea name="privatereceiptinfo" class="form-control" id="" cols="30" rows="5" placeholder="Write your shop private receipt info..."><?php if(!empty($privatereceiptinfo)){ echo $privatereceiptinfo; } ?></textarea>
												</div>
											</div>
											
											
											
											<div class="form-group">
												&nbsp;
											</div>
											
											<div class="form-group">
												<label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">
													&nbsp;
												</label>
												
												<div class="col-sm-9">
													
													<?php if($shoppingSql->num_rows() >0){ ?>
													
													<input type="submit" name="shoppolicy" id="shoppolicy" class="btn btn-primary" value="Update" />
													
													<?php }else{ ?>
													
													<input type="submit" name="shoppolicy" id="shoppolicy" class="btn btn-primary" value="Save" />
													
													<?php } ?>
													
												</div>
											</div>
											
											<div class="form-group">
												&nbsp;
											</div>
											
									</div><!-- End: stockform_lft -->
								
								
							</div>
                        
                        </div>
							
						</form>
                        
						
                      </div>
                        
                        <!--div role="tabpanel" class="tab-pane" id="treasuries">
                        
                        	<p class="userrt_fav_p">Your favorite Treasury lists will live here.</p>

                        </div-->
						
                      </div>
                    
                    </div>
                    
                </div><!-- End: userrt_fav -->
            </div>  
        
        </div><!-- End: usershop_inner -->        
    </div>
    
    </div>
    
</div><!-- End: inner_page -->


<?php $this->load->view('../../front-templates/footer.php'); ?>
