<?php
	$this->load->view('../../front-templates/head.php');
	$this->load->view('../../front-templates/header.php');
	$this->load->view('../../front-templates/navigation.php');
	
	if( $this->session->userdata('isLogin') == TRUE){
		$shopid 				= $this->session->userdata('shopopen');
		$userid 				= $this->session->userdata('userid');
		
		$sqluser = $this->db->query("select * from mega_users where userid=$userid");
		$sqlfetchuser = $sqluser->row_array();
		extract($sqlfetchuser);
		
	}else{
		if($this->uri->segment(4) !== NULL){
			$userid 				= $this->uri->segment(4);
		}else{ $userid = 16; }
		
		$sqluser = $this->db->query("select * from mega_users where userid=$userid");
		$sqlfetchuser = $sqluser->row_array();
		extract($sqlfetchuser);
		
	}
	
?>


<div id="inner_page"><!-- Begin: inner_page -->

    <div class="container">
    
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="innerpage_head"><!-- Begin: innerpage_head -->
                
				<p class="innerpage_head_p">
					<a href="<?php echo base_url(); ?>page/user/userarea">Home</a>
					<i class="fa fa-angle-double-right"></i>
					<a href="<?php echo base_url(); ?>page/user/userprofile/<?php echo $userid; ?>">
						<?php echo ucfirst($display_name); ?> Profile
					</a>
					<i class="fa fa-angle-double-right"></i>
					<span class="p_active"> Shops</span>
				</p>
				
            </div><!-- End: innerpage_head -->
        </div>  
    </div>
    
    <div class="row">
        <div class="usershop_inner"><!-- Begin: usershop_inner -->
        
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <div class="userlft_fav"><!-- Begin: userlft_fav -->
                    <div class="profilepic"><!-- Begin: profilepic -->
                    	
						<a href="<?php echo base_url(); ?>page/user/userprofile/<?php echo $userid; ?>">
							<img src="<?php echo base_url(); ?>assets/frontend/images/<?php if($this->session->userdata('user_picture') == NULL ){echo 'users/userprofile.png'; }else{ echo 'users/'.$this->session->userdata('user_picture');} ?>" class="img-responsive img-circle" alt="profile" style="margin: 0 20px 0px 0px;" align="left" vspace="5" hspace="5" />
                    	</a>
						
                    </div><!-- End: profilepic -->
					
                    <h6 class="profilepic_browse_h6">
						<a href="<?php echo base_url(); ?>page/user/userprofile/<?php echo $userid; ?>">
							<?php echo ucfirst($display_name); ?>
						</a>
					</h6>
					
                    <div class="profile_list">
                    	
						<ul>
                        	<li>
								<a href="<?php echo base_url(); ?>page/user/userprofile/<?php echo $userid; ?>">Profile</a>
							</li>
							
                        	<li>
								<a href="<?php echo base_url(); ?>page/user/favotites/<?php echo $userid; ?>">Favorites</a>
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
									
                                    <p class="profile_contact_p">with <?php echo ucfirst($display_name); ?> </p>
									
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
                	<h6 class="userrt_fav_h6"><?php echo ucfirst($display_name); ?> Favorite Shops</h6>
                    
                    <div class="fav_tavuser">
                    
                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs" role="tablist">
                        
						<li role="presentation">
							<a href="<?php echo base_url(); ?>page/user/favotites/<?php echo $userid; ?>">Items</a>
						</li>
                        
						<li role="presentation" class="active">
							<a href="#shopshop" aria-controls="shop" role="tab" data-toggle="tab">Shop</a>
						</li>
						
                        <!--li role="presentation"><a href="#treasuries" aria-controls="treasuries" role="tab" data-toggle="tab">Treasuries</a></li-->
						
                      </ul>
                    
                      <!-- Tab panes -->
                      <div class="tab-content" style="background:#f5f5f1;padding:12px 15px;height:263px;">
                        <div role="tabpanel" class="tab-pane" id="shopitems">...</div>
                        
                        <div role="tabpanel" class="tab-pane active" id="shopshop">
                        
                        	<p class="userrt_fav_p">Your favorite shops will live here.</p>
                        
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
