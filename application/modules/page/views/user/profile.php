<?php
	$this->load->view('../../front-templates/head.php');
	$this->load->view('../../front-templates/header.php');
	$this->load->view('../../front-templates/navigation.php');
	
	if( $this->session->userdata('isLogin') == TRUE){
		$shopid 				= $this->session->userdata('shopopen');
		$userid 				= $this->uri->segment(4);
		
		$sqluser = $this->db->query("select * from mega_users where userid=$userid");
		$sqlfetchuser = $sqluser->row_array();
		extract($sqlfetchuser);
		
	}else{
		
		if($this->uri->segment(4) !== NULL){
			$userid 				= $this->uri->segment(4);
		}else{ $userid = 1; }
		
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
					<span class="p_active"><?php echo ucwords($display_name); ?></span>
					
				</p>
				
            </div><!-- End: innerpage_head -->
        </div>  
    </div>
    
    <div class="row">
        <div class="usershop_inner"><!-- Begin: usershop_inner -->
        
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <div class="userlft_fav"><!-- Begin: userlft_fav -->
                    
					<div class="profilepic"><!-- Begin: profilepic -->
                    	
						<?php
							if( $this->session->userdata('isLogin') == TRUE && $this->session->userdata('userid') == $userid){
								$link = 'edituserprofile';
							}else{
								$link = 'userprofile';
							}
						?>
						
						<a href="<?php echo base_url(); ?>page/user/<?php echo $link; ?>/<?php echo $userid; ?>">
							<img src="<?php echo base_url(); ?>assets/frontend/images/users/<?php if($user_picture == NULL ){echo 'userprofile.png'; }else{ echo  $user_picture; } ?>" class="img-responsive img-circle" alt="profile" style="margin: 0 20px 0px 0px;" align="left" vspace="5" hspace="5" />
                    	</a>
						
						<div class="profilepic_browse">
                        	<a href="<?php echo base_url(); ?>page/user/<?php echo $link; ?>/<?php echo $userid; ?>"><i class="fa fa-camera"></i></a>
                        </div>
						
                    </div><!-- End: profilepic -->
					
                    <h6 class="profilepic_browse_h6">
						
						<a href="<?php echo base_url(); ?>page/user/userprofile/<?php echo $userid; ?>">
							<?php echo ucwords($display_name); ?>
						</a>
						
					</h6>
					
                    <div class="profile_list">
                    	
						<ul>
                        	<li>
								<a href="<?php echo base_url(); ?>page/user/userprofile/<?php echo $userid; ?>">Profile</a>
							</li>
							
                        	<li>
								<a href="<?php echo base_url(); ?>page/user/setting/<?php echo $userid; ?>">Settings</a>
							</li>
							
                        	<li>
								<a href="<?php echo base_url(); ?>page/login/logout/<?php echo $userid; ?>">Signout</a>
							</li>
							
                        	<!--li>
								<a href="<?php //echo base_url(); ?>page/user/favotites/<?php //echo $userid; ?>">Favorites</a>
							</li-->
							
                        	<!--li>
								<a href="followers.php">Followers</a>
							</li>
							
                        	<li>
								<a href="#" data-toggle="modal" data-target="#myModal3" data-target=".bs-example-modal-sm">Contact</a>
							</li-->
							
                        </ul>
                        
                        
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
									
                                    <p class="profile_contact_p">with <?php echo ucwords($display_name); ?></p>
									
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
                            
                    </div>
                </div><!-- End: userlft_fav -->
            </div> 
            
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                <div class="userrt_fav"><!-- Begin: userrt_fav -->
                	
					<h6 class="userrt_fav_h6">
						
						<?php echo ucwords($display_name); ?> Profile 
						
						<span class="span_edprofile">
							
							<?php if($this->session->userdata('isLogin') == TRUE && $this->session->userdata('userid') == $userid){ ?>
								<a class="btn btn-primary" href="<?php echo base_url(); ?>page/user/edituserprofile" role="button">
									Edit Profile
								</a>
							<?php } ?>
						</span>
						
					</h6>
                    
                    <div class="row">
                    
                    	
						<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                            
							<div class="profile_about"><!-- Begin: profile_about -->
                                
								<h6 class="profile_about_h6" style="font-weight:bold;">About</h6>
								
								<p> <?php echo ucfirst($about_user); ?> </p>
								
								<p>&nbsp;</p>
								
                                <p class="profile_about_p"> <b>Name :</b> <?php echo ucwords($display_name); ?></p><br/>
								
								<?php if($this->session->userdata('isLogin') == TRUE){ ?>
								<p class="profile_about_p"><b>Email :</b> <?php echo $user_email; ?></p><br/>
								<?php } ?>
								
								<p class="profile_about_p"><b>Gender :</b> <?php echo $user_gender; ?></p><br/>
								
								<p class="profile_about_p"><b>Joined :</b> <?php echo $user_registration_date; ?></p><br/>
								
                                
								<h6 class="profile_about_h6" style="font-weight:bold;">Favorite materials</h6>
								
								<p class="p_active"> <?php echo ucwords($favorite_materials); ?> </p>
								
								<p>&nbsp;</p>
								
                            </div><!-- End: profile_about -->
							
                        </div>
						
						
                        
                    	<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                            <div class="profile_fait"><!-- Begin: profile_fait -->
                            
                                <h6 class="profile_about_h6">
									 <i class="fa fa-heart-o text-danger"></i> 
									Latest items &nbsp;&nbsp;&nbsp;
										<a href="<?php echo base_url(); ?>page/">
											<span class="span_pfait">
												See more
											</span>
										</a>
									</h6>
                                
								<div class="items_title">
                                    
									<?php
										$i=0;
										foreach($favouriteitemsF4 as $getresult1){
											$get_thumbs = $this->page_model->get_productimgs($getresult1->productid);
											$i++;
											$shopid = $getresult1->shopid;
											// Get shop info
											$nvs_queryRecom1	= $this->db->query("SELECT * FROM mega_shops where shopid='".$shopid."'");
											$nvs_resultsRecom1 	= $nvs_queryRecom1->row_array();
											extract($nvs_resultsRecom1);
									?>
										
									<div class="item_titlepic" id="<?php if($i==4){ echo 'last_box'; } ?>">
                                    	
										<a href="<?php echo base_url(); ?>page/pdetails/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $getresult1->product_name)))))))); ?>/<?php echo $getresult1->productid; ?>">
											<?php
												$sname = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shop_name))));	
												$pooimglocation = base_url()."assets/frontend/images/shops/".$sname."/";
											?>
											<?php 
												if(count($get_thumbs) !== 0){
											?>
											<img class="img-responsive" src="<?php echo $pooimglocation.$get_thumbs['pic_name']; ?>" alt="<?php echo $getresult1->product_name; ?>" />
											<?php }else{ ?>
											<img class="img-responsive" src="<?php echo base_url()."assets/frontend/images/shops/default-img.jpg"; ?>" alt="No Image Avaliable" />
											<?php } ?>
										</a>
										
                                    </div>
									
									<?php
										if($i==4){break;}
										}
									?>
									
                                </div>
                                
								<div class="items_title">
                                    
									<?php
										$i=0;
										foreach($favouriteitemsL4 as $getresult1){
											$i++;
											$shopid = $getresult1->shopid;
											// Get shop info
											$nvs_queryRecom1	= $this->db->query("SELECT * FROM mega_shops where shopid='".$shopid."'");
											$nvs_resultsRecom1 	= $nvs_queryRecom1->row_array();
											extract($nvs_resultsRecom1);
									?>
										
									<div class="item_titlepic" id="<?php if($i==4){ echo 'last_box'; } ?>">
                                    	
										<a href="<?php echo base_url(); ?>page/pdetails/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $getresult1->product_name)))))))); ?>/<?php echo $getresult1->productid; ?>">
										
											<?php
											$ppimgRec1 = explode(',',$getresult1->product_image);
												
											for($ppiRec1=0;$ppiRec1< count($ppimgRec1);$ppiRec1++){
												
												// Check product Image NULL Or Not
												if($getresult1->product_image == NULL){
													$pimglocationRec1 = base_url()."assets/frontend/images/shops/default-img.jpg";
												}else{
													$snameRec1 = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shop_name))));
													
													$pimglocationRec1 = base_url()."assets/frontend/images/shops/$snameRec1/$ppimgRec1[$ppiRec1]";
												}
												
												echo '<img style="height:113px !important;width:135px !important;" class="img-responsive img-thumbnail" src="'.$pimglocationRec1.'" alt="'.$getresult1->product_name.'" />';
												break;
											}
										?>
											
										</a>
										
                                    </div>
									
									<?php
										if($i==4){break;}
										}
									?>
									
                                </div>
                                
								<div class="items_title">
                                    
									<?php
										$i=0;
										foreach($favouriteitemsLL4 as $getresult1){
											$i++;
											$shopid = $getresult1->shopid;
											// Get shop info
											$nvs_queryRecom1	= $this->db->query("SELECT * FROM mega_shops where shopid='".$shopid."'");
											$nvs_resultsRecom1 	= $nvs_queryRecom1->row_array();
											extract($nvs_resultsRecom1);
									?>
										
									<div class="item_titlepic" id="<?php if($i==4){ echo 'last_box'; } ?>">
                                    	
										<a href="<?php echo base_url(); ?>page/pdetails/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $getresult1->product_name)))))))); ?>/<?php echo $getresult1->productid; ?>">
										
											<?php
											$ppimgRec1 = explode(',',$getresult1->product_image);
												
											for($ppiRec1=0;$ppiRec1< count($ppimgRec1);$ppiRec1++){
												
												// Check product Image NULL Or Not
												if($getresult1->product_image == NULL){
													$pimglocationRec1 = base_url()."assets/frontend/images/shops/default-img.jpg";
												}else{
													$snameRec1 = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shop_name))));
													
													$pimglocationRec1 = base_url()."assets/frontend/images/shops/$snameRec1/$ppimgRec1[$ppiRec1]";
												}
												
												echo '<img style="height:113px !important;width:135px !important;" class="img-responsive img-thumbnail" src="'.$pimglocationRec1.'" alt="'.$getresult1->product_name.'" />';
												break;
											}
										?>
											
										</a>
										
                                    </div>
									
									<?php
										if($i==4){break;}
										}
									?>
									
                                </div>
								
                                
                            </div><!-- End: profile_fait -->
                        </div>
                        
                    </div>
                    
                </div><!-- End: userrt_fav -->
            </div>  
        
        </div><!-- End: usershop_inner -->        
    </div>
    
    </div>
    
</div><!-- End: inner_page -->

<?php $this->load->view('../../front-templates/footer.php'); ?>
