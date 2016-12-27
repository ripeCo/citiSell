<?php
	// Common files are loaded
	$this->load->view('templates/head-form.php');
	$this->load->view('templates/headeer.php');
	$this->load->view('templates/sidebar-left.php');
?>

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <!-- page start-->
            
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        
						<h5 style="position:relative;top:10px;right: 100px;">
							<a class="btn btn-primary pull-right" href="<?php echo base_url(); ?>administrator/setting/add">
								<i class="fa fa-plus-square"></i>&nbsp;Add New Record
							</a>
							<span style="margin-right:5px;float:right;">&nbsp;</span> 
							<a class="btn btn-success pull-right" href="<?php echo base_url(); ?>administrator/setting"><i class="fa fa-eye"></i>&nbsp;View Record</a>
						</h5>
						
						<header class="panel-heading">
                            <h3><i class="fa fa-plus-circle"></i>&nbsp;Add New Records</h3>
                            <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
                                <a class="fa fa-cog" href="javascript:;"></a>
                                <a class="fa fa-times" href="javascript:;"></a>
                             </span>
                        </header>
						
                        <div class="panel-body">
                            <div class="form">
                                <form class="cmxform form-horizontal " id="signupForm" method="post" action="">
                                    
									<div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-3">Firstname :</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" id="firstname" name="firstname" type="text" />
                                        </div>
                                    </div>
									
                                    <div class="form-group ">
                                        <label for="lastname" class="control-label col-lg-3">Lastname :</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" id="lastname" name="lastname" type="text" />
                                        </div>
                                    </div>
									
                                    <div class="form-group ">
                                        <label for="username" class="control-label col-lg-3">Username :</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="username" name="username" type="text" />
                                        </div>
                                    </div>
									
                                    <div class="form-group ">
                                        <label for="password" class="control-label col-lg-3">Password :</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="password" name="password" type="password" />
                                        </div>
                                    </div>
									
                                    <div class="form-group ">
                                        <label for="confirm_password" class="control-label col-lg-3">Confirm Password :</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="confirm_password" name="confirm_password" type="password" />
                                        </div>
                                    </div>
									
                                    <div class="form-group ">
                                        <label for="email" class="control-label col-lg-3">Email :</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="email" name="email" type="email" />
                                        </div>
                                    </div>
									
                                    <div class="form-group ">
                                        <label for="country" class="control-label col-lg-3">Country :</label>
                                        <div class="col-lg-6">
                                            <?php echo country(); ?>
                                        </div>
                                    </div>
									
									<div class="form-group">
										<label class="control-label col-md-3">Select date :</label>
										<div class="col-md-4 col-xs-11">

											<div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="<?php echo date("d-m-Y"); ?>"  class="input-append date dpYears">
												<input type="text" readonly="" value="<?php echo date("d-m-Y"); ?>" size="16" class="form-control" required>
													  <span class="input-group-btn add-on">
														<button class="btn btn-primary" type="button"><i class="fa fa-calendar"></i></button>
													  </span>
											</div>
											<!--span class="help-block">Select date</span--->
										</div>
									</div>
									
									<div class="form-group ">
                                        <label class="control-label col-md-3">Spinner 4</label>
                                        <div class="col-md-9">
                                            <div id="spinner4">
                                                <div class="input-group" style="width:150px;">
                                                    <div class="spinner-buttons input-group-btn">
                                                        <button type="button" class="btn spinner-up btn-primary">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>
                                                    <input type="text" class="spinner-input form-control" maxlength="3" readonly>
                                                    <div class="spinner-buttons input-group-btn">
                                                        <button type="button" class="btn spinner-down btn-warning">
                                                            <i class="fa fa-minus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                             <span class="help-block">
                                                with step: 5
                                             </span>
                                        </div>
                                    </div>
									
									<div class="form-group last">
										<label class="control-label col-md-3">Image Upload :</label>
										<div class="col-md-9">
											<div class="fileupload fileupload-new" data-provides="fileupload">
												<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
													<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
												</div>
												<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
												<div>
														   <span class="btn btn-white btn-file">
														   <span class="fileupload-new">
														   <i class="fa fa-upload"></i> Select image</span>
														   <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
														   <input type="file" class="default" />
														   </span>
													<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
												</div>
											</div>
											
											<span class="label label-danger">NOTE!</span>
												<span>
													Attached image thumbnail is
													supported in Latest Firefox, Chrome, Opera,
													Safari and Internet Explorer 10 only
												</span>
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-md-2">Content Editor :</label>
										<div class="col-md-10">
											<textarea class="wysihtml5 form-control" rows="9"></textarea>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-lg-2 col-sm-2 control-label">Select :</label>
										<div class="col-lg-6">
											<select id="e2" style="width:300px" class="populate placeholder">
												<optgroup label="Alaskan/Hawaiian Time Zone">
													<option value="AK">Alaska</option>
													<option value="HI">Hawaii</option>
												</optgroup>
												<optgroup label="Pacific Time Zone">
													<option value="CA">California</option>
													<option value="NV">Nevada</option>
													<option value="OR">Oregon</option>
													<option value="WA">Washington</option>
												</optgroup>
												<optgroup label="Mountain Time Zone">
													<option value="AZ">Arizona</option>
													<option value="CO">Colorado</option>
													<option value="ID">Idaho</option>
													<option value="MT">Montana</option><option value="NE">Nebraska</option>
													<option value="NM">New Mexico</option>
													<option value="ND">North Dakota</option>
													<option value="UT">Utah</option>
													<option value="WY">Wyoming</option>
												</optgroup>
												<optgroup label="Central Time Zone">
													<option value="AL">Alabama</option>
													<option value="AR">Arkansas</option>
													<option value="IL">Illinois</option>
													<option value="IA">Iowa</option>
													<option value="KS">Kansas</option>
													<option value="KY">Kentucky</option>
													<option value="LA">Louisiana</option>
													<option value="MN">Minnesota</option>
													<option value="MS">Mississippi</option>
													<option value="MO">Missouri</option>
													<option value="OK">Oklahoma</option>
													<option value="SD">South Dakota</option>
													<option value="TX">Texas</option>
													<option value="TN">Tennessee</option>
													<option value="WI">Wisconsin</option>
												</optgroup>
												<optgroup label="Eastern Time Zone">
													<option value="CT">Connecticut</option>
													<option value="DE">Delaware</option>
													<option value="FL">Florida</option>
													<option value="GA">Georgia</option>
													<option value="IN">Indiana</option>
													<option value="ME">Maine</option>
													<option value="MD">Maryland</option>
													<option value="MA">Massachusetts</option>
													<option value="MI">Michigan</option>
													<option value="NH">New Hampshire</option><option value="NJ">New Jersey</option>
													<option value="NY">New York</option>
													<option value="NC">North Carolina</option>
													<option value="OH">Ohio</option>
													<option value="PA">Pennsylvania</option><option value="RI">Rhode Island</option><option value="SC">South Carolina</option>
													<option value="VT">Vermont</option><option value="VA">Virginia</option>
													<option value="WV">West Virginia</option>
												</optgroup>
											</select>
										</div>
									</div>
									
                                    <div class="form-group ">
                                        <label for="agree" class="control-label col-lg-3 col-sm-3">Agree to Our Policy :</label>
                                        <div class="col-lg-6 col-sm-9">
                                            <input  type="checkbox" style="width: 20px" class="checkbox form-control" id="agree" name="agree" />
                                        </div>
                                    </div>
									
                                    <div class="form-group ">
                                        <label for="newsletter" class="control-label col-lg-3 col-sm-3">Receive the Newsletter :</label>
                                        <div class="col-lg-6 col-sm-9">
                                            <input  type="checkbox" style="width: 20px" class="checkbox form-control" id="newsletter" name="newsletter" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-6">
                                            <button class="btn btn-primary" type="submit"><i class="fa fa-floppy-o"></i>&nbsp;Save</button>
                                            <button class="btn btn-default" type="button"><i class="fa fa-ban"></i>&nbsp;Cancel</button>
                                        </div>
                                    </div>
									
                                </form>
								
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <!-- page end-->
        </section>
    </section>
    <!--main content end-->
	
<?php //include('inc/sidebar-right.php'); ?>

</section>

<?php
	$this->load->view('templates/form-footer.php');
?>