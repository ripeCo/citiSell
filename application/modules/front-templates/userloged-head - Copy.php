<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-0">
    <div class="h_right"><!-- Begin: h_right -->
	
	
		<div class="shr_box"><!-- Begin: shr_box -->
            <a href="<?php echo base_url(); ?>page/user/userarea">
                <i class="fa fa-home"></i>
                <p class="shr_box_p">Home</p>
            </a>
        </div><!-- End: shr_box -->
		

        <div class="shr_box"><!-- Begin: shr_box -->
            <a href="<?php echo base_url(); ?>page/user/favotites">
                <i class="fa fa-heart-o"></i>
                <p class="shr_box_p">Favorite</p>
            </a>
        </div><!-- End: shr_box -->
		
		<div class="shr_box"><!-- Begin: shr_box -->

            <div class="dropdown">
              
			  <!-- Check here shop opend or Not Yet ! -->
			<?php
				
				if( $this->session->userdata('shopopen') === 0){
					
			?>
				
			  <a href="<?php echo base_url(); ?>page/yourshop/newshop" id="dLabel">
				<i class="fa fa-shopping-basket"></i>
                <p class="shr_box_p shop">Your shop </p>
              </a>
			  
				<?php
					
					}else{
						
						
				?>
			  
			  <a id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fa fa-shopping-basket"></i>
                <p class="shr_box_p shop">Your shop <i class="fa fa-caret-down"></i> </p>
              </a>
			  
              <ul class="dropdown-menu" aria-labelledby="dLabel">

                    <div class="user_profie">

                    <div class="profile_head">
						
						<div class="userprofile_img">
                            <?php
								if( $this->session->userdata('shoplogo') !== NULL ){
									$shoplog = $this->session->userdata('shoplogo');
								}else{
									$shoplog = 'shop-logo.png';
								}
							?>
							
							<img src="<?php echo base_url(); ?>assets/frontend/images/shops/<?php echo $shoplog; ?>" class="img-responsive img-circle" alt="Shop Logo" />
							
							
                        </div>
						
                        <div class="userprofile_title">
						
                            <h6 class="userprofile_title_h6"><?php echo $this->session->userdata('shopname'); ?></h6>
                            <!--a href="profile.php" class="btn_profile" href="#" role="button">View Profile</a-->
							
                        </div>
						
                    </div>

                    <div class="profile_main">
                        <ul>
                            <li><a href="purchases.php">Purchases and reviews</a></li>
                            <li><a href="setting.php">Account settings </a></li>
                        </ul>
                    </div>

                </div>
              </ul>
			  
			  <?php } ?>
			  
            </div>

        </div><!-- End: shr_box -->
		
		

        <div class="shr_box"><!-- Begin: shr_box -->

            <div class="dropdown">
              <a id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-user"></i>
                <p class="shr_box_p">You <i class="fa fa-caret-down"></i> </p>
              </a>
              <ul class="dropdown-menu" aria-labelledby="dLabel">

                    <div class="user_profie">

                    <div class="profile_head">
						
						<div class="userprofile_img">
                            <img src="<?php echo base_url(); ?>assets/frontend/images/<?php if($this->session->userdata('user_picture') == NULL ){echo 'users/userprofile.png'; }else{ echo 'users/'.$this->session->userdata('user_picture');} ?>" class="img-responsive img-circle" alt="profile" />
                        </div>
						
                        <div class="userprofile_title">
						
                            <h6 class="userprofile_title_h6"><?php echo $this->session->userdata('displayname'); ?></h6>
                            <a href="<?php echo base_url(); ?>page/user/userprofile" class="btn_profile" role="button">View Profile</a>
							
                        </div>
						
                    </div>

                    <div class="profile_main">
                        <ul>
                            <li><a href="<?php echo base_url(); ?>page/user/purchasereview">Purchases and reviews</a></li>
                            <li><a href="<?php echo base_url(); ?>page/user/setting">Account settings </a></li>
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

        <div class="shr_box" id="last_box"><!-- Begin: shr_box -->
            <a href="cart.php">
                <i class="fa fa-cart-plus"></i>
                <p class="shr_box_p">Cart</p>
            </a>
        </div><!-- End: shr_box -->

    </div><!-- End: h_right -->
</div>