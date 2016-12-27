<div id="header"><!-- Begin: header -->
    <div class="container">
        <div class="row">
        
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <div class="logo"><!-- Begin: logo -->
                	<h1>
						<a href="user.php">
							<img src="<?php echo base_url(); ?>assets/frontend/images/interface/logo.png" class="img-responsive" alt="Logo" />
						</a>
					</h1>
                </div><!-- End: logo -->
            </div>
            
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="h_search"><!-- Begin: h_search -->
                
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="input-group">
                        
                        
                          <input type="text" id="tags" class="form-control" placeholder="Search for items or shops">
                          <span class="input-group-btn">
                            <button class="btn btn-default sbtn_header" type="button">Search</button>
                          </span>
                        </div><!-- /input-group -->
                      </div><!-- /.col-lg-6 -->
                    </div><!-- /.row -->
                
                </div><!-- End: h_search -->
            </div>

            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-0">
                <div class="h_right"><!-- Begin: h_right -->
                    
                    <div class="shr_box"><!-- Begin: shr_box -->
                    	<a href="user.php">
                            <i class="fa fa-home"></i>
                            <p class="shr_box_p">Home</p>
                        </a>
                    </div><!-- End: shr_box -->
                    
                    <div class="shr_box"><!-- Begin: shr_box -->
                    	<a href="favorite.php">
                            <i class="fa fa-heart-o"></i>
                            <p class="shr_box_p">Favorite</p>
                        </a>
                    </div><!-- End: shr_box -->

                    <div class="shr_box"><!-- Begin: shr_box -->
                    	<a href="your_shop.php">
                            <i class="fa fa-shopping-basket"></i>
                            <p class="shr_box_p">Your shop</p>
                        </a>
                    </div><!-- End: shr_box -->

                    <div class="shr_box"><!-- Begin: shr_box -->
                    
                        <div class="dropdown">
                          <a id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-user"></i>
                            <p class="shr_box_p">You</p>
                          </a>
                          <ul class="dropdown-menu" aria-labelledby="dLabel">
                          
                          	<div class="user_profie">
                            
                                <div class="profile_head">
                                	<div class="userprofile_img">
                                    	<img src="<?php echo base_url(); ?>assets/frontend/images/interface/favorite_people.jpg" class="img-responsive img-circle" alt="profile" />
                                    </div>
                                    <div class="userprofile_title">
                                    	<h6 class="userprofile_title_h6">Md Salahuddin Khan</h6>
                                        <a href="profile.php" class="btn_profile" href="#" role="button">View Profile</a>
                                    </div>
                                </div>
                                
                                <div class="profile_main">
                                    <ul>
                                        <li><a href="purchases.php">Purchases and reviews</a></li>
                                        <li><a href="setting.php">Account settings </a></li>
                                    </ul>
                                </div>
                                
                                <div class="profile_footer">
                                    <h5 class="profile_footer_p"><a href="index.php">Sign out</a></h5>
                                </div>
                                
                            </div>
                          </ul>
                        </div>

                    </div><!-- End: shr_box -->
                    
                    <div class="shr_box" id="last_box"><!-- Begin: shr_box -->
                    	<a href="cart.php">
                            <i class="fa fa-cart-plus"></i>
                            <p class="shr_box_p">Cart</p>
                        </a>
                    </div><!-- End: shr_box -->

                </div><!-- End: h_right -->
            </div>

        </div>
    </div>
</div><!-- End: header -->
