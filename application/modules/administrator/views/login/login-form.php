<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Md Salahuddin Khan, Skype: rony_khan2">
    <meta name="author" content="WAN IT LIMITED">
    
	<?php $this->load->view('../../templates/favicon.php'); ?>

    <title>
		<?php echo sitename(); ?>.com Online Shop :: <?php echo $breadcrumb; ?>
	</title>

    <!--Core CSS -->
    <link href="<?php echo base_url(); ?>assets/backend/bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/backend/css/bootstrap-reset.css" rel="stylesheet">
    
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">


    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/backend/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/backend/css/style-responsive.css" rel="stylesheet" />
	
	<!-- Custom Stylesheet -->
    <link href="<?php echo base_url(); ?>assets/backend/css/custom.css" rel="stylesheet"/>

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="<?php echo base_url(); ?>assets/backend/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	<style>
		.fntColor {
			border: 1px solid #eaeaea;
			border-radius: 5px;
			box-shadow: none;
			color: #1693d1;
			font-size: 12px;
			font-weight: bold;
			margin-bottom: 15px;
		}
        .titleColor{ color: #f00 !important; }
	</style>
</head>

  <body class="login-body">
	
	<div class="shopHeader">
		<h1 class="mp">
			<i class="fa fa-shopping-bag"></i>
			<b><?php echo sitename(); ?>.com</b><br/> Online Shop Portal
		</h1>
	</div>
	
    <div class="container">

		<form class="form-signin validate" role="form" method="post" action="<?php echo base_url(); ?>administrator/form">
					
			<h2 class="form-signin-heading"><i class="fa fa-lock fa-2x"></i>&nbsp;<?php echo $breadcrumb; ?></h2>
			
			<div class="login-wrap">
				
				<div class="col-lg-12 col-md-12 col-sm-12 pdng0">
					
					<?php if($this->session->flashdata('login_error')){ ?>
						<div class="alert alert-danger fade in block-inner">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<?php echo $this->session->flashdata('login_error'); ?>
						</div> <!-- Success Or Error Message -->
					<?php } ?>
                    
                    <?php
						 
                        // Success Or Failor check
						if(isset($success_msg)){
							echo '<span id="msg" class="text-primary"> <i class="fa fa-check-circle"></i> '.$success_msg.' </span><br/>';
						}else if(isset($error_msg)){
							echo '<span class="text-danger"> <i class="fa fa-exclamation-triangle"></i> '.$error_msg.' </span><br/>';
						}
					?>
					
					<div class="input-group m-bot15">
						
						<span class="input-group-addon btn-white"><i class="fa fa-user"></i></span>
						<input type="text" name="username" class="form-control tfieldmb0 fntColor" placeholder="Username">
						
					</div>
					<?php echo form_error('username'); ?>
					
					<div class="input-group m-bot15">
						
						<span class="input-group-addon btn-white"><i class="fa fa-key"></i></span>
						<input type="password" name="password" class="form-control tfieldmb0 fntColor" placeholder="Password">
						
					</div>
					<?php echo form_error('password'); ?>
					
				</div>
				
				<div style="clear:both;height:0px;">&nbsp;</div>
				
				<label class="checkbox">
					<input type="checkbox" name="remember" value="remember-me"> Remember me
					<span class="pull-right">
						<a data-toggle="modal" href="#myModal"> Forgot Password?</a>

					</span>
				</label>
				
				<button class="btn btn-lg btn-login btn-block" name="login" type="submit">
					 Sign in Me <i class="fa fa-sign-in"></i>
				</button>

				<div class="registration">
					Design & Developed by - 
					<a class="" href="http://wanitltd.com" target="_blank">
						WAN IT LIMITED
					</a>
				</div>

			</div>
            
            </form>
            <!-- END of Login Form -->
            
            
            <form class="form-signin validate" role="form" method="post" action="<?php echo base_url(); ?>administrator/resetpass">
			<!-- Modal -->
			<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
			  
				<div class="modal-dialog">
				  
					<div class="modal-content">
					  
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title">Forgot Password ?</h4>
						</div>
						  
						<div class="modal-body">
							
							<p class="titleColor">Enter your e-mail address below to reset your password.</p>
							<input type="email" name="useremail" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
                            <?php echo form_error('useremail'); ?>

						</div>
						  
						<div class="modal-footer">
							<button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
							<button class="btn btn-success" name="resetPass" type="submit">Reset Password</button>
						</div>
					  
					</div>
				  
				</div>
			  
			</div>
			<!-- modal -->

		</form>

    </div>



    <!-- Placed js at the end of the document so the pages load faster -->

    <!--Core js-->
    <script src="<?php echo base_url(); ?>assets/backend/js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/backend/bs3/js/bootstrap.min.js"></script>

	<!-- Javascript Confirmation -->
	<script type="text/javascript">
		
		function confirmDelete() {
		  return confirm('Are you sure want to delete this?');
		}
		
		function confirmUpdate() {
		  return confirm('Are you sure want to update this?');
		}

	</script>
	
	<script>
		$(document).ready(function(){
			$('#msg').fadeOut(3000);
		}
		);
	</script>
	
</body>
</html>

<?php
	/* the content */
	ob_get_contents();  //gets the contents of the output buffer 
	ob_end_flush(); // Send the output and turn off output buffering

?>