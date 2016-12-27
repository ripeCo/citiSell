<?php
	$this->load->view('../../front-templates/head.php');
	$this->load->view('../../front-templates/header.php');
	$this->load->view('../../front-templates/navigation.php');
	
	// Get users Info by userid
	extract($users);
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
					<span class="p_active"> Profile Edit</span>
				</p>
            </div><!-- End: innerpage_head -->
        </div>  
    </div>
    
    <div class="row">
        <div class="usershop_inner"><!-- Begin: usershop_inner -->
        
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <div class="userlft_fav"><!-- Begin: userlft_fav -->
                    <div class="profile_list">
                    	
						<ul>
                        	
							<li><a href="<?php echo base_url(); ?>page/user/purchasereview">Purchases &amp; Reviews</a></li>
							
                        	<li><a href="<?php echo base_url(); ?>page/user/userprofile/<?php echo $this->session->userdata('userid'); ?>">Public Profile</a></li>
							
                        	<li><a href="<?php echo base_url(); ?>page/user/setting">Settings</a></li>
							
                        	<li><a href="<?php echo base_url(); ?>page/login/logout">Sign Out</a></li>
							
                        </ul>
						
                    </div>
                </div><!-- End: userlft_fav -->
            </div>

			<form class="form-inline" enctype="multipart/form-data" action="<?php echo base_url(); ?>page/user/updateuserprofile" method="post">
            
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                <div class="userrt_fav"><!-- Begin: userrt_fav -->
                
                	<h4 class="text-center">
						<?php
							 
							// Success Or Failor check
							if(isset($success_msg)){
								echo '<span id="msg" class="text-success"> <i class="fa fa-check-circle"></i> '.$success_msg.' </span><br/>';
							}else if(isset($error_msg)){
								echo '<span class="text-danger"> <i class="fa fa-exclamation-triangle"></i> '.$error_msg.' </span><br/>';
							}
						?>
					</h4>
					
					<h6 class="userrt_fav_h6"> <i class="fa fa-eye"></i> Your Public Profile
					
					<span class="span_editp">Everything on this page can be seen by anyone</span>
						
						<span class="span_edprofile">
							<a class="btn btn-primary" href="<?php echo base_url(); ?>page/user/userprofile/<?php echo $this->session->userdata('userid'); ?>" role="button">
								View Profile
							</a>
						</span>
						
					</h6>
                    
                    <div class="proedit_main"><!-- Begin: proedit_main -->
                    
                        <div class="proedit_box"><!-- Begin: proedit_box -->
                        	<div class="row">
                            	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="proedit_boxL">
                                    	<h6 class="proedit_box_h6">Profile Picture</h6>
                                    </div>
                                </div>
                            	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                
                                    <div class="proedit_boxR">
                                    	
										<div class="browse_pic">
                                          
										  <div class="form-group">
										  
                                            <input type="hidden" name="userid" value="<?php echo $this->session->userdata('userid'); ?>" />
											
                                            <input type="hidden" name="oldpic" value="<?php echo $user_picture; ?>">
											
                                            <input type="file" name="userfile" class="form-control pdng0" id="exampleInputFile">
											
                                          </div>
										  
                                        </div>
                                        
										<div class="profilepic_img">
                                            
											<img src="<?php echo base_url(); ?>assets/frontend/images/<?php if($user_picture == NULL ){echo 'users/userprofile.png'; }else{ echo 'users/'.$user_picture;} ?>" class="img-responsive img-circle"  title="<?php echo $display_name; ?>"/>
											
                                        </div>
										
                                        <p class="profilepic_img_p">Must be a .jpg, .gif or .png file smaller than 10MB and at least 400px by 400px.</p>
										
                                    </div>
                                    
                                </div>
                            </div>
                        </div><!-- End: proedit_box -->
                        
                        <div class="proedit_box"><!-- Begin: proedit_box -->
                        	<div class="row">
                            	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="proedit_boxL">
                                    	<h6 class="proedit_box_h6">Your Name</h6>
                                    </div>
                                </div>
                            	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <div class="proedit_boxR">
                                    	<h6 class="proedit_boxR_h6">
										
											<input type="text" class="form-control inptwidth" name="user_first_name" placeholder="First Name" value="<?php echo $user_first_name; ?>" />
											
											<input type="text" class="form-control inptwidth" name="user_last_name" placeholder="Last Name" value="<?php echo $user_last_name; ?>" />
										
										</h6>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End: proedit_box -->
                        
                        <div class="proedit_box"><!-- Begin: proedit_box -->
                        	<div class="row">
                            	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="proedit_boxL">
                                    	<h6 class="proedit_box_h6">Gender</h6>
                                    </div>
                                </div>
                            	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <div class="proedit_boxR">
                                    	<div class="radio_icon">
                                        
											<label class="radio-inline">
												<input type="radio" <?php if($user_gender == 'Male'){ echo 'checked'; } ?> name="user_gender" id="inlineRadio2" value="Male"> Male
											</label>
											
											<label class="radio-inline">
												<input type="radio" <?php if($user_gender == 'Female'){ echo 'checked'; } ?> name="user_gender" id="inlineRadio1" value="Female"> Female
											</label>
											
											<label class="radio-inline">
												<input type="radio" <?php if($user_gender == 'Private'){ echo 'checked'; } ?> name="user_gender" id="inlineRadio3" value="Private"> Rather not say
											</label>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End: proedit_box -->
                        
                        <div class="proedit_box"><!-- Begin: proedit_box -->
                        	<div class="row">
                            	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="proedit_boxL">
                                    	<h6 class="proedit_box_h6">City</h6>
                                    </div>
                                </div>
                            	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <div class="proedit_boxR">
									
                                    	<script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&language=en"></script>
										
										<input type="text" name="user_city" class="form-control input75" id="autocomplete" value="<?php echo $user_city; ?>" placeholder="Enter the city name...">

										<script>
										  var input = document.getElementById('autocomplete');
										  var autocomplete = new google.maps.places.Autocomplete(input);
										</script>
										
                                        <p class="profilepic_img_p">Start typing and choose from a suggested city to help others find you. </p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End: proedit_box -->
                        
                        <div class="proedit_box"><!-- Begin: proedit_box -->
                        	<div class="row">
                            	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="proedit_boxL">
                                    	<h6 class="proedit_box_h6">Birthday</h6>
                                    </div>
                                </div>
								    
                            	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <div class="proedit_boxR">
                                    	
										    <div class="input-append date" id="dp3" data-date="<?php echo date('Y/m/d'); ?>" data-date-format="yyyy/mm/dd">
											  <input name="user_dob" class="datepicker form-control input75" type="text" value="<?php if($user_dob == NULL){echo date('Y/m/d'); }else{ echo $user_dob; } ?>">
											  <span class="add-on"><i class="icon-th"></i></span>
											</div>
										
                                    </div>
                                </div>
                            </div>
                        </div><!-- End: proedit_box -->
                        
                        <div class="proedit_box"><!-- Begin: proedit_box -->
                        	<div class="row">
                            	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="proedit_boxL">
                                    	<h6 class="proedit_box_h6">About</h6>
                                    </div>
                                </div>
                            	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <div class="proedit_boxR">
                                    	
										<textarea rows="2" cols="2" name="about_user" class="form-control input75" placeholder="Tell people a little about yourself..."><?php echo trim($about_user); ?></textarea>
										
                                        <p class="profilepic_img_p">Tell people a little about yourself.</p>
										
                                    </div>
                                </div>
                            </div>
                        </div><!-- End: proedit_box -->
                        
                        <div class="proedit_box"><!-- Begin: proedit_box -->
                        	<div class="row">
                            	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="proedit_boxL">
                                    	<h6 class="proedit_box_h6">Favorite Materials</h6>
                                    </div>
                                </div>
                            	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <div class="proedit_boxR">
                                    	
										<textarea rows="2" name="favorite_materials" cols="2" class="form-control input75" placeholder="Favorite materials..."><?php echo trim($favorite_materials); ?></textarea>
										
                                        <p class="profilepic_img_p">Share up to 13 materials that you like. Separate each material with a comma.</p>
										
                                    </div>
                                </div>
                            </div>
                        </div><!-- End: proedit_box -->
                        
                        <!--div class="proedit_box" id="last_box">
                        	<div class="row">
                            	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="proedit_boxL">
                                    	<h6 class="proedit_box_h6">Include on <br />Your Profile</h6>
                                    </div>
                                </div>
                            	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <div class="radio_icon" style="margin-top:6px;">
                                    
                                        <label class="checkbox-inline">
                                          <input type="checkbox" id="inlineCheckbox1" value="option1">  Shop 
                                        </label>
                                        <label class="checkbox-inline">
                                          <input type="checkbox" id="inlineCheckbox2" value="option2"> Favorite items
                                        </label>
                                        <label class="checkbox-inline">
                                          <input type="checkbox" id="inlineCheckbox3" value="option3"> Favorite shops
                                        </label>
                                        <label class="checkbox-inline">
                                          <input type="checkbox" id="inlineCheckbox3" value="option3"> Treasury lists
                                        </label>
                                        <label class="checkbox-inline">
                                          <input type="checkbox" id="inlineCheckbox3" value="option3"> Teams
                                        </label>
                                        
                                    </div>
                                </div>
                            </div>
                        </div--><!-- End: proedit_box -->
                                                
                    </div><!-- End: proedit_main -->
                    
                        <button type="submit" class="btn btn-primary" style="margin-top:15px;">Save Changes</button>
                                        
                </div><!-- End: userrt_fav -->
            </div> 

		</form>			
        
        </div><!-- End: usershop_inner -->        
    </div>
    
    </div>
    
</div><!-- End: inner_page -->


<?php $this->load->view('../../front-templates/footer.php'); ?>
