<?php 
	$this->load->view('templates/_header');
	extract($users);
?>

				
	<form class="form-horizontal validate" action="<?php echo base_url();?>upassword" role="form" method="post" >
		
		<div class="block">

			<div class="form-group">
				<label for="inputText1" class="col-lg-2 col-md-2 col-sm-2 col-xs-8 control-label">Full Name</label>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-7">
					<input type='text' name='name'  value="<?php echo $name; ?>" class='form-control'>
					<span class="error"> <?php echo form_error('name');?></span>
				</div>
			</div>
			
			<div class="form-group">
				<label for="inputText1" class="col-lg-2 col-md-2 col-sm-2 col-xs-8 control-label">E-mail</label>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-7">
					<input type='text' name='email'  value="<?php echo $email; ?>" class='form-control'>
					<span class="error"> <?php echo form_error('email');?></span>
				</div>
			</div>
			
			<div class="form-group">
				<label for="inputText1" class="col-lg-2 col-md-2 col-sm-2 col-xs-8 control-label">Username</label>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-7">
					<!-- very important for unique check -->
					<input value="<?php echo $username; ?>" name="original_value" type="hidden" />
					<input type='text' name='username'  value="<?php echo $username; ?>" class='form-control'>
					<span class="error"> <?php echo form_error('username');?></span>
				</div>
			</div>
			
			<div class="form-group">
				<label for="inputText1" class="col-lg-2 col-md-2 col-sm-2 col-xs-8 control-label">Password</label>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-7">
					<input type='password' name='password'  value="" class='form-control'>
					<span class="error"> <?php echo form_error('password');?></span>
				</div>
			</div>

			<div class="form-group">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-9">
					<div class="form-actions text-right">
						<button type="submit" name="update" class="btn btn-primary">
							<i class="icon-loop4"></i> Update Password
						</button>
					</div>
				</div>
			</div>
			
		</div>
		
	</form>

<?php $this->load->view('templates/_footer');?>    
