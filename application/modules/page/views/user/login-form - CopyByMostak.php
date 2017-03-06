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
					
					<?php if($this->session->flashdata('login_error')){ ?>
						<span class="text-danger"><i class="fa fa-frown-o"></i> Nope !<span>
						
						<div style="padding:3px;" class="alert alert-danger fade in block-inner">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<i class="fa fa-exclamation-triangle"></i> <?php echo $this->session->flashdata('login_error'); ?>
						</div> <!-- Success Or Error Message -->
					<?php }else{ ?>
					
					<span class="text-success"><i class="fa fa-lock"></i> Login Area !<span>
					
					<?php } ?>
                    
                </h1>
				
				<h2 class="discover_head_h3">
					<?php
						 
                        // Success Or Failor check
						if(isset($success_msg)){
							echo '<span id="msg" class="text-primary"> <i class="fa fa-check-circle"></i> '.$success_msg.' </span><br/>';
						}else if(isset($error_msg)){
							echo '<span class="text-danger"> <i class="fa fa-exclamation-triangle"></i> '.$error_msg.' </span><br/>';
						}
					?>
				</h2>
                
                
                <h3> <i class="fa fa-lock"></i> <?php echo $breadcrumb; ?></h3>
            
                
            </div><!-- End: discover_head -->
        </div>
    </div>
</div><!-- End: discover_tems -->


<div id="what_items"><!-- Begin: what_items -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="whatitem_inner"><!-- Begin: whatitem_inner -->
                    
					
					<div class="signin_details"><!-- Begin: register_details -->
					  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						  
						  <form class="form-horizontal" id="myForm" action="<?php echo base_url(); ?>page/login/dologin" method="post">
						  
								<div class="form-group">
									
									<label for="inputEmail3" class="col-sm-3 control-label">User Email</label>
									<div class="col-sm-6">
										<input type="email" name="user_email" class="form-control" id="inputEmail3" placeholder="Enter Email">
									</div>
									
									<?php echo form_error('user_email'); ?>
									
								</div>
								
								<div class="form-group">
									
										<label for="inputPassword3" class="col-sm-3 control-label">Password</label>
									<div class="col-sm-6">
										<input type="password" name="user_password" class="form-control" id="inputPassword3" placeholder="Enter Password">
									</div>
									
									<?php echo form_error('user_password'); ?>
									
								</div>
							  
								<div class="form-group">
									<div class="col-sm-offset-3 col-sm-6">
									  <div class="checkbox">
										<label>
										  <input name="remember" type="checkbox" checked="checked" value="1">Remember me
										</label>
									  </div>
									</div>
								</div>
							  
								<div class="form-group">
									<div class="col-sm-offset-3 col-sm-6 col-md-9 col-lg-6">
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
							
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								  <div class="logfb">
									
									<a class="btn btn-default" href="#" role="button" style="width:60%;background:#4682d8;color:#fff;">
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
						  
					  <div class="modal_fp">
						
					  </div>
							<p style="font-size:12px;text-align:center;padding-top:15px;">
								
								<a href="#" data-toggle="modal" data-target="#forgotpass" style="color:#337ab7;">Forgot your password?</a> Not a member 
								
								<a href="#register" class="registerm" data-toggle="modal" data-target="#myModal" style="color:#5bc0de;">Register Here</a>
								
							</p>
						</div>
							
						
					</div><!-- End: register_details -->
                    
                    
                </div><!-- End: whatitem_inner -->
            </div>
        </div>
    </div>
</div>


<!--div id="satisfied_customer">
    <div class="container">
        <div class="row">
        
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="satisfation_box">
                	<img src="<?php //echo base_url(); ?>assets/frontend/images/interface/satisefaction01.png" class="img-responsive" alt="Satisfield Customer" />
                	<h3 class="satisfation_box_h3">Satisfied Customers</h3>
                    <p class="satisfation_box_p">Get to know shops and items with reviews from our community. </p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="satisfation_box">
                	<img src="<?php //echo base_url(); ?>assets/frontend/images/interface/satisefaction02.png" class="img-responsive" alt="Satisfield Customer" />
                	<h3 class="satisfation_box_h3">Passionate Sellers</h3>
                    <p class="satisfation_box_p">Buy from creative people who care about quality and craftsmanship.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="satisfation_box">
                	<img src="<?php //echo base_url(); ?>assets/frontend/images/interface/satisefaction03.png" class="img-responsive" alt="Satisfield Customer" />
                	<h3 class="satisfation_box_h3">Secure Transactions</h3>
                    <p class="satisfation_box_p">Feel confident knowing our Trust &amp; Safety team is here to protect you.</p>
                </div>
            </div>
            
        </div>
    </div>
</div--><!-- End: satisfied_customer -->

<?php $this->load->view('../../front-templates/footer.php'); ?>
