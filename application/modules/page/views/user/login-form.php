<?php
	$this->load->view('../../front-templates/head.php');
	$this->load->view('../../front-templates/header.php');
	$this->load->view('../../front-templates/navigation.php');
?>

<div id="what_items"><!-- Begin: what_items -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="whatitem_inner"><!-- Begin: whatitem_inner -->
					<div class="signin_details" style="padding-top: 40px"><!-- Begin: register_details -->
					<div class="row">
					 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						  
						  <form class="form-horizontal" id="signinp" action="<?php echo base_url(); ?>page/login/dologin" method="post">
								<div class="hding"><span>Sign into citisell</span></div>
								<?php if($this->session->flashdata('login_error')){ ?>
									<div style="padding:10px 10px;border-radius:0;text-align: center" class="alert alert-danger fade in block-inner">
										<button type="button" class="close" data-dismiss="alert">×</button>
										<i class="fa fa-exclamation-triangle"></i> <?php echo $this->session->flashdata('login_error'); ?>
									</div> <!-- Success Or Error Message -->
								<?php }else{ echo null; }?>
								<div class="form-group" style="margin-top: 20px">
									<label for="inputEmail3" class="col-sm-3 control-label">User Email</label>
									<div class="col-sm-6">
										<input type="email" name="user_email" class="form-control" id="inputEmail3" placeholder="Enter Email">
									</div>
								</div>
								
								<div class="form-group">
									<label for="inputPassword3" class="col-sm-3 control-label">Password</label>
									<div class="col-sm-6">
										<input type="password" name="user_password" class="form-control" id="inputPassword3" placeholder="Enter Password">
									</div>
								</div>
							  
								<div class="form-group">
									<div class="col-sm-offset-3 col-sm-6">
									  <div class="checkbox">
										<label>
										  <input name="remember" type="checkbox" value="1">Remember me
										</label>
									  </div>
									</div>
								</div>
							  
								<div class="form-group">
									<div class="col-sm-offset-3 col-sm-6 col-md-9 col-lg-6">
									  <button type="submit" class="btn btn-info btn-sm custom-button" style="background: #112C6F;border: 0;border-radius: 0;width: 100%">Signin</button>
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
						
							<div class="row msloggin">
								<div class="col-lg-12 col-md-21 col-sm-12 col-xs-12">
								  <div class="logfb">
									
									<a class="btn btn-default" href="#" role="button" style="width:100%;background:#4682d8;color:#fff;">
											<i class="fa fa-facebook"></i> Sign in With Facebook
									</a>
									
								  </div>
								</div>
								
								<div class="col-lg-12 col-md-21 col-sm-12 col-xs-12 text-center">
								  <div class="logtt">
									<a class="btn btn-default" href="#" role="button" style="width:100%;background:#e04733;color:#fff;"><i class="fa fa-google-plus"></i> Sign in With Google+</a>
								  </div>
								</div>
							</div>
							

						 </div>
							<p style="font-size:12px;text-align:center;padding-top:15px;">
								
								<a href="#" data-toggle="modal" data-target="#forgotpass" style="color:#337ab7;">Forgot your password?</a> Not a member 
								
								<a href="javascript:void(0);" class="registerm" data-toggle="modal" data-target=".regging" style="color:#5bc0de;">Register Here</a>
								
							</p>
						</div>
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
