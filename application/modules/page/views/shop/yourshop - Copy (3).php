<?php
	$this->load->view('../../front-templates/head.php');
	$this->load->view('../../front-templates/header.php');
	$this->load->view('../../front-templates/navigation.php');
	
	extract($users); // Get all info from users table using userid
?>

<div id="inner_page"><!-- Begin: inner_page -->

    <div class="container">
        
    <div class="row">
        <div class="usershop_inner"><!-- Begin: usershop_inner -->
            
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
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
				
				</div>
			</div>
			
			
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="your_shop"><!-- Begin: your_shop -->
                
                	<div class="row">
                    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            
							<div class="stepwizard">
                                <div class="stepwizard-row setup-panel">
                                
                                    <div class="stepwizard-step">
                                        <a class="btn btn-default btn-circle btn-primary" type="button" href="#step-1">
											
											<?php
												$this->load->model('yourshop_model'); // Load Database
												$userid = $this->session->userdata('userid');
												if($this->yourshop_model->shopuser_exists($userid)){
													extract($this->yourshop_model->get_data_shops($userid));
												}
												
												if( $this->yourshop_model->shopuser_exists($userid)){
													echo '<i class="fa fa-check-circle"></i>';
												}else{ echo '<i class="fa fa-dot-circle-o"></i>'; }
											?>
											
										</a>
                                        <p class="urshop_step_p">Shop preferences</p>
                                    </div>
                                    
                                    <div class="stepwizard-step">
                                        <a disabled="disabled" class="btn btn-default btn-circle" type="button" href="#step-2">
											<?php
												
												if($this->yourshop_model->shopuser_exists($userid)){
													
													if($shop_name !== NULL){
														echo '<i class="fa fa-check-circle"></i>';
													}else{ echo '<i class="fa fa-dot-circle-o"></i>'; }
												
												}else{
													echo '<i class="fa fa-dot-circle-o"></i>';
												}
											?>
										</a>
                                        <p class="urshop_step_p">Name your shop</p>
                                    </div>
									
									<div class="stepwizard-step urshop_step">
                                        <a disabled="disabled" class="btn btn-circle btn-default" type="button" href="#step-3">
											
											<i class="fa fa-dot-circle-o"></i>
											
										</a>
                                        <p class="urshop_step_p">Stock your shop</p>
                                    </div>
                                    
                                    <div class="stepwizard-step">
                                        <a disabled="disabled" class="btn btn-default btn-circle btn-default" type="button" href="#step-4">
											
											<i class="fa fa-dot-circle-o"></i>
											
										</a>
                                        <p class="urshop_step_p">How you'll get paid</p>
                                    </div>

                                    <div class="stepwizard-step">
                                        <a disabled="disabled" class="btn btn-default btn-circle" type="button" href="#step-5">
											
											<i class="fa fa-dot-circle-o"></i>
											
										</a>
                                        <p class="urshop_step_p">Set up billing </p>
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                    
                	<div class="row">
                    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="wizarcontent"><!-- Begin: wizarcontent -->
                                
								   
                                    <!--form role="form" action="<?php //echo base_url(); ?>page/yourshop/shoppreferences" method="post"-->
                                    <form role="form" action="" id="preferences" method="post" accept-charset="utf-8">
									
									<div id="step-1" class="row setup-content" style="display: block; color:#">
                                        
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        	<h3 class="shop_steptitle">Shop preferences </h3>
                                            <p class="shop_step_p">Let's get started! Tell us about you and your shop.</p>
                                            
                                            <div class="row">
                                                <div class="stepcontent02"><!-- Begin: stepcontent02 -->
                                                
                    								<div class="shopperformance_box"><!-- Begin: shopperformance_box -->
                                                    
                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                            <div class="stockform_lft"><!-- Begin: stockform_lft -->
                                                            
                                                                <div class="hor_frm">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                            <div class="hor_frm">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                                        
																						<div class="form-horizontal">
                                                                                        
                                                                                          <div style ="margin-top:15px;" class="form-group">
                                                                                            
																							<label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">
																								Shop language <span style="color:#FF3A3D"> *</span>
																							</label>
																							
                                                                                            <div class="col-sm-9">
                                                                                                
																								<select disabled onfocus="this.blur();" id="shop_language" name="shop_language" required="required" style="width:64%;" class="form-control">
																									
																									<option selected="selected" value="English">English</option>
																									
                                                                                                </select>
																								
                                                                                            </div>
                                                                                          </div>
                                                                                          <div class="clearfix"></div>
                                                                                          
                                                                                          <div style="margin-top:15px;" class="form-group">
                                                                                            
																							<label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">
																								Shop country <span style="color:#FF3A3D"> *</span>
																							</label>
																							
                                                                                            <div class="col-sm-9">
                                                                                                
																								<select disabled onfocus="this.blur();" id="shop_location" name="shop_location" required="required" style="width:64%;" class="form-control">
                                                                                                  
																								  <option selected="selected" value="United States">
																									United States
																								  </option>
																								  
                                                                                                </select>
																								
                                                                                            </div>
                                                                                          </div>
																						  
                                                                                          <div class="clearfix"></div>
                                                                                          
                                                                                          <div style="margin-top:15px;" class="form-group">
                                                                                            
																							<label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">		Shop currency <span style="color:#FF3A3D"> *</span>
																							</label>
																							
                                                                                            <div class="col-sm-9">
                                                                                                
																								<select disabled id="shop_currency" name="shop_currency" onfocus="this.blur();" required="required" style="width:64%;" class="form-control">
																									
																									<option selected="selected" value="USD">
																										$ United State Dollar
																									</option>
                                                                                                </select>
																								
                                                                                            </div>
                                                                                          </div>
																						  
                                                                                          <div class="clearfix"></div>
                                                                                          
                                                                                          <div style="margin-top:15px;" class="form-group">
                                                                                            
																							<label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">
																								Which of these best describes you?
																								<span style="color:#FF3A3D"> *</span>
																							</label>
																							
                                                                                            <div class="col-sm-9">
                                                                                                
																								<select id="intention" name="intention" required="required" style="width:64%;" class="form-control">
																									
																									<option selected="selected" value="Selling is my full-time job">
																										Selling is my full-time job
																									</option>
																									
																									<option value="Sell part-time but hope to sell full-time">
																										Sell part-time but hope to sell full-time
																									</option>
																									
																									<option value="I sell part-time and that’s how I like it ">
																										I sell part-time and that’s how I like it 
																									</option>
																									
																									<option value="Other ">
																										Other 
																									</option>
																									
                                                                                                </select>
																								
                                                                                            </div>
                                                                                          </div>
                                                                                          
                                                                                        </div>
																						
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div><!-- End: stockform_lft -->
                                                        </div>
                                                        
                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                            <div class="stockform_rht"><!-- Begin: stockform_rht -->
                                                                
																<p class="stockform_rht_p">
																	The language you’ll use to describe your items.<br><br><br><br> Where is your shop based?<br><br><br>The currency you'll use to price your items. Shoppers in other countries will automatically see prices in their local currency.<br><br><br>This is just an FYI for us, and won’t affect the opening of your shop.
																</p>
																
                                                            </div><!-- End: stockform_rht -->
                                                        </div>
                                                        
                                                    </div><!-- Begin: shopperformance_box -->
                                                    
                    								
                                                    
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <button type="button" id="submit" class="btn btn-info nextBtn pull-right btn_submit">Save & Continue</button>
                                                        </div>
                                                    </div>
                                                                                
                                                </div><!-- End: stepcontent02 -->
												
                                                
                                            </div>  
                                            
                                        </div>                                      
											
                                    </div>
									
									</form>
									
									
                                    <form role="form" action="" method="post" accept-charset="utf-8" autocomplete="off">
									
                                    <div id="step-2" class="row setup-content" style="display: none;">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        	<h3 class="shop_steptitle">Name your shop <span class='text-success'> <?php if(!empty($shop_name)){ echo ' - '.$shop_name; } ?></span></h3>
                                            <p class="shop_step_p">Choose a memorable name that reflects your style.</p>
                                            
                                            <div class="row">
                                                <div class="stepcontent03"><!-- Begin: stepcontent03 -->
                                                                                                    
                    								<div class="shopperformance_box"><!-- Begin: shopperformance_box -->
                                                    
                                                    	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-0">
                                                           
															<div class="input-group form-group">
                                                              
															<?php if(!empty($shop_name)){ ?>
															<h4 class='text-success'>
															   <?php echo $shop_name; ?> - <b class="badge badge-green"> <i class="fa fa-check"></i> Available</b>
															</h4>
															<?php } ?>
															  
                                                            </div>
                                                           
														   <div class="input-group form-group">
                                                              
															  <input type="hidden" name="old_shopname" value="<?php echo $shop_name; ?>" />
															  
															  <input type="text" <?php if(!empty($shop_name)){ echo 'disabled'; } ?> required="required" name="shop_name" id="shop_name" placeholder="Enter your shop name..." class="form-control input-lg inputtxtcheck2" value="<?php if(!empty($shop_name)){ echo $shop_name; } ?>" />
																
																<span class="input-group-btn">
                                                                
																	<button type="button" class="btn btn-info input-lg inputtxtcheck">Check availability</button>
																
																</span>
																
																<?php //echo base_url().'assets/frontend/images/shops/'; ?>
															  
                                                            </div>
                                                           
														   <div class="input-group form-group">
                                                              
																<span id="result"></span>
															  
                                                            </div>
															
                                                            <p class="stepcontent03_p">Your shop name will appear in your shop and next to each of your listings throughout ctSell. You can change it later if you’d like. Here are some tips for picking a shop name.</p>
                                                        </div>
                                                        
                                                    </div><!-- Begin: shopperformance_box -->
                                                    
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <button type="button" id="shopnamecheck" class="btn btn-info nextBtn pull-right btn_submit">
																Save & Continue
															</button>
                                                        </div>
                                                    </div>
                                                                                                                                    
                                                </div><!-- End: stepcontent03 -->
                                                
                                            </div>  
                                            
                                        </div>
                                    </div>
									
									</form>
									
									
									
									<form role="form" action="" method="post" accept-charset="utf-8" autocomplete="off">
									
									<div id="step-3" class="row setup-content" style="display: none;">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        
                                        	<h3 class="shop_steptitle">Stock your shop </h3>
                                            <p class="shop_step_p">Add as many listings as you can. Ten or more would be a great start.<br>More listings means more chances to be discovered! </p>
                                                
                                            <div class="row">
                                            
                                                <div class="stepcontent02"><!-- Begin: stepcontent01 -->
                                                
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <div class="shoppre_box"><!-- Begin: shoppre_box -->
                                                            <a data-target="#myModal" data-toggle="modal" href="#">
                                                                
																<div class="shoppre_bxtop">
                                                                    <i class="fa fa-plus-circle"></i>
                                                                    <h6 class="shoppre_bxtop_h6">Add a listing</h6>
                                                                </div>
                                                                <div class="shoppre_bxbtm"></div>
																
                                                            </a>
                                                            
                                                            <div class="stockmodal"><!-- Begin: stockmodal -->
                                                            
                                                                <!-- Modal -->
                                                                <div aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade bs-example-modal-lg" style="display: none;">
                                                                  <div role="document" class="modal-dialog modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                      <div class="modal-header">
                                                                        
																		<button aria-label="Close" data-dismiss="modal" class="close" type="button">
																			<span aria-hidden="true">×</span>
																		</button>
																		
                                                                        <h4 id="myModalLabel" class="modal-title shop_steptitle">Add a new listing</h4>
                                                                      </div>
                                                                      <div class="modal-body">
                                                                      
                                                                        <div class="row">
                                                                        
                                                                        	<div class="formstock_box"><!-- Begin: formstock_box -->
                                                                            	<h6 class="formstock_box_h6">Photos</h6>
                                                                                <p class="formstock_box_p">Add at least one photo. Use all five photos to show different angles and details.</p>
                                                                                
																				
																					
																				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                                    <div class="stockform_lft"><!-- Begin: stockform_lft -->
                                                                                    	<div class="row">
                                                                                        	
																							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                                                
																								<h5 class="text-danger">
																									<i class="fa fa-upload"></i>
																									Multiple Images upload here!
																								</h5>
																								
																								<div class="shopfrm_box"><!-- Begin: shopfrm_box -->
                                                                                                    
																									<div class="fileUpload">
																										<span class="custom-span">
																											<i class="fa fa-camera"></i>
																										</span>
																										<p class="custom-para">Add a Image</p>
																										
																										<input type="file" id="files" name="files[]" multiple />
																										
																									</div>
																									
                                                                                                </div><!-- End: shopfrm_box -->
                                                                                            </div>
																							
                                                                                        </div>
                                                                                    </div><!-- End: stockform_lft -->
                                                                                </div>
																				
																				
                                                                                
                                                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                    <div class="stockform_rht"><!-- Begin: stockform_rht -->
                                                                                    	<p class="stockform_rht_p">Use high-quality JPG, PNG or GIF files that are at least 570px wide (we recommend 1000px).<br><br>The best photos use natural or diffused lighting, and don’t use a flash.<br><br>These are thumbnails of your photos. Zoom in to see them full-size.</p>
                                                                                    </div><!-- End: stockform_rht -->
                                                                                </div>
                                                                            </div><!-- End: formstock_box -->
                                                                            <div class="clearfix"></div>
                                                                            
                                                                        	<div style="margin-top:40px;" class="formstock_box"><!-- Begin: formstock_box -->
                                                                            	<h6 class="formstock_box_h6">Listing details</h6>
                                                                                <p class="formstock_box_p">Tell the world all about your item and why they’ll love it.</p>
                                                                                
																				<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                                    <div class="stockform_lft"><!-- Begin: stockform_lft -->
                                                                                    
                                                                                    	<div class="hor_frm">
                                                                                        	<div class="row">
                                                                                            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                                                    <div class="form-horizontal">
                                                                                                    
																										<div class="form-group">
																											<label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">
																												Title<span style="color:#FF3A3D"> *</span>
																											</label>
																											
																											<div class="col-sm-9">
																												<input type="text" name="product_name" id="product_name" placeholder="Enter title..." class="form-control">
																											</div>
																										</div>
																									  
																										<div class="clearfix"></div>
                                                                                                      
																										<div style="margin-top:15px;" class="form-group">
																											
																											<label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">About this listing
																												<span style="color:#FF3A3D"> *</span>
																											</label>
																											
                                                                                                        <div class="col-sm-9">
                                                                                                            
																											<select name="who_made" id="who_made" style="width:30%;float:left;margin-right:7px;" class="form-control">
																												<option>Who made it?</option>
																												<optgroup label="Select a Maker">
																													
																													<option value="i_did">
																														I did
																													</option>
																													
																													<option value="collective">
																														A member of my shop
																													</option>
																													
																													<option value="someone_else">
																														Another company or person
																													</option>
																													
																												</optgroup>
																												
                                                                                                            </select>
																											
                                                                                                            <select name="is_supply" id="is_supply" style="width:30%;float:left;margin-right:7px;" class="form-control">
																												<option>What is it?</option>
																												<optgroup label="Select a Maker">
																													
																													<option value="finished_product">
																														A finished product
																													</option>
																													
																													<option value="a_supply_tool_to_make">
																														A supply or tool to make things
																													</option>
																													
																												</optgroup>
																												
                                                                                                            </select>
																											
                                                                                                            <select name="when_made" id="when_made" style="width:30%;float:left;margin-right:7px;" class="form-control">
																												<option value="">When was it made?</option>
																												<optgroup label="Not yet made">
																														<option value="made_to_order">Made To Order</option>
																												</optgroup>
																												<optgroup label="Recently">
																														<option value="2010_2016">2010 - 2016</option>
																														<option value="2000_2009">2000s</option>
																														<option value="1997_1999">1997 - 1999</option>
																												</optgroup>
																												<optgroup label="Vintage">
																														<option value="before_1997">Before 1997</option>
																														<option value="1990_1996">1990 - 1996</option>
																														<option value="1980s">1980s</option>
																														<option value="1970s">1970s</option>
																														<option value="1960s">1960s</option>
																														<option value="1950s">1950s</option>
																														<option value="1940s">1940s</option>
																														<option value="1930s">1930s</option>
																														<option value="1920s">1920s</option>
																														<option value="1910s">1910s</option>
																														<option value="1900s">1900 - 1909</option>
																														<option value="1800s">1800s</option>
																														<option value="1700s">1700s</option>
																														<option value="before_1700">Before 1700</option>
																												</optgroup>
																												
                                                                                                            </select>
																											
                                                                                                        </div>
																										</div>
																									  
                                                                                                      <div class="clearfix"></div>
                                                                                                      
                                                                                                      <div style="margin-top:15px;" class="form-group">
                                                                                                        <label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">Category<span style="color:#FF3A3D">*</span></label>
                                                                                                        
																										<div class="col-sm-9">
                                                                                                            
																											<select name="category" id="category" style="width:30%;float:left;margin-right:7px;" class="form-control">
																												
																												<option>----Category---</option>
																												
																												<?php
																													$this->load->model('navigation_model');
																													
																													$mainmenusArray101 = array( 7001 => 'Clothing & Accessories', 7002 => 'Hand made Jewelry', 7003 => 'Handicraft Supplies', 7004 => 'Weddings', 7005 => 'Cosmetics', 7006 => 'Living & Home', 7007 => 'Kids Need', 7008 => 'Vintage');
																													
																													foreach($mainmenusArray101 as $key101 => $values101){
																												?>
																												
																												<optgroup style="10px 0 !important;margin-bottom:10px!important;" label="<?php echo $values101; ?>">
																													
																													<!-- Get Query for all category under by Main Menus -->
																													<?php
																														$catview101 =	$this->navigation_model->category($values101,1); // Get Category where status is 1
																														foreach($catview101 as $value101){
																															
																															$c0atid101 = $value101->category_id;
																													?>
																													
																													<option value="<?php echo $value101->category_name; ?>">
																														<?php echo $value101->category_name; ?>
																													</option>
																													
																													
																													<?php } ?>
																													
																												</optgroup>
																												
																												<?php } ?>
																												
                                                                                                            </select>
                                                                                                            
																											<select name="subcategory" id="subcategory" style="width:30%;float:left;margin-right:7px;" class="form-control">
																											
																												
																												<option>--Sub Category--</option>
																												
																												<?php
																													
																													foreach($mainmenusArray101 as $key102 => $values102){
																													
																														$catview102 =	$this->navigation_model->category($values102,1); // Get Category where status is 1
																														foreach($catview102 as $value102){
																															
																															$c0atid102 = $value102->category_id;
																													?>
																													
																													<optgroup style="10px 0 !important;margin-bottom:10px!important;" label="<?php echo $values102. ' > ' .$value102->category_name; ?>">
																														
																														<!-- Get Query for all sub category under by Main Menus -->
																														
																														<?php
																															// Gel All Subcategory According to CategoryID
																															$query102 = $this->db->query("SELECT * FROM mega_subcategory where category_id=$value102->category_id");
																															$results102 = $query102->result();
																															
																															foreach ($results102 as $row102){
																																
																																$subcatid102 = $row102->sub_category_id;
																														?>
																															
																															<option value="<?php echo $subcatid102; ?>">
																																<?php echo $row102->sub_category_name; ?>
																															</option>
																															
																															
																														<?php } ?>
																														
																													</optgroup>
																													
																												<?php } } ?>
																												
																													
																												</optgroup>
																												
																												
                                                                                                            </select>
																											
                                                                                                            
																											<select name="subcategorylev2" id="subcategorylev2" style="width:30%;float:left;margin-right:7px;" class="form-control">
																												<option>What is categoryLevel 2?</option>
																												<optgroup label="Select a sub category Lev2">
																													
																													<option value="Accessories">
																														Accessories
																													</option>
																													
																													<option value="a_supply_tool_to_make">
																														A supply or tool to make things
																													</option>
																													
																												</optgroup>
																												
                                                                                                            </select>
																											
                                                                                                        </div>
																										
                                                                                                      </div>
                                                                                                      <div class="clearfix"></div>
																									  
                                                                                                      
                                                                                                      <div style="margin-top:15px" class="form-group">
																											<label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">
																												Product SUK 
																											</label>
																											
																											<div class="col-sm-9">
																											<input type="product_suk" name="product_suk" id="price" placeholder="Product suk?" class="form-control">
																											</div>
                                                                                                      </div>
                                                                                                      <div class="clearfix"></div>
																									  
                                                                                                      
                                                                                                      <div style="margin-top:15px" class="form-group">
																											<label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">
																												Price($)<span style="color:#FF3A3D"> *</span>
																											</label>
																											
																											<div class="col-sm-9">
																											<input type="text" name="price" id="price" placeholder="Enter price..." class="form-control">
																											</div>
                                                                                                      </div>
                                                                                                      <div class="clearfix"></div>
																									  
                                                                                                      
                                                                                                      <div style="margin-top:15px" class="form-group">
                                                                                                        <label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">Quantity<span style="color:#FF3A3D">*</span></label>
                                                                                                        <div class="col-sm-9">
                                                                                                          <input type="text" placeholder="Enter quantity..." class="form-control">
                                                                                                        </div>
                                                                                                      </div>
                                                                                                      <div class="clearfix"></div>
																									  
                                                                                                      
                                                                                                      <!--div style="margin-top:15px" class="form-group">
                                                                                                        
																										<label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">
																											Renewal options<span style="color:#FF3A3D"> *</span>
																										</label>
																										
                                                                                                        <div class="col-sm-9">
                                                                                                            <label class="radio-inline hor_frm_check">
                                                                                                              <input type="radio" value="option1" id="inlineRadio1" name="inlineRadioOptions">Manual
                                                                                                            </label>
																											
                                                                                                            <label style="margin-top:7px;" class="radio-inline hor_frm_check">
                                                                                                              <input type="radio" value="option2" id="inlineRadio2" name="inlineRadioOptions"> Automatic
                                                                                                            </label>
																											
                                                                                                        </div>
                                                                                                      </div>
                                                                                                      <div class="clearfix"></div>
																									  
                                                                                                      
                                                                                                      <div style="margin-top:15px" class="form-group">
																											<label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">
																												Type <span style="color:#FF3A3D"> *</span>
																											</label>
																											
                                                                                                        <div class="col-sm-9">
                                                                                                            <label class="radio-inline hor_frm_check">
                                                                                                              <input type="radio" value="option1" id="inlineRadio1" name="inlineRadioOptions">Physical
                                                                                                            </label>
																											
                                                                                                            <label style="margin-top:7px;" class="radio-inline hor_frm_check">
																												<input type="radio" value="option2" id="inlineRadio2" name="inlineRadioOptions"> Digital
                                                                                                            </label>
                                                                                                        </div>
                                                                                                      </div>
                                                                                                      <div class="clearfix"></div-->
																									  
                                                                                                      
                                                                                                      <div style="margin-top:15px" class="form-group">
																											
																											<label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">
																												Cat Description  <span style="color:#FF3A3D"> *</span>
																											</label>
																											
																											<div class="col-sm-9">
																												<textarea name="product_cat_desc" id="product_cat_desc" placeholder="Enter Cat description ..." class="form-control" cols="7" rows="7"></textarea>
																											</div>
                                                                                                      </div>
																									  
                                                                                                      
                                                                                                      <div style="margin-top:15px" class="form-group">
																											
																											<label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">
																												Short Description  <span style="color:#FF3A3D"> *</span>
																											</label>
																											
																											<div class="col-sm-9">
																												<textarea name="product_short_desc" id="product_short_desc" placeholder="Enter Short description ..." class="form-control" cols="7" rows="7"></textarea>
																											</div>
                                                                                                      </div>
																									  
                                                                                                      
                                                                                                      <div style="margin-top:15px" class="form-group">
																											
																											<label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">
																												Long Description  <span style="color:#FF3A3D"> *</span>
																											</label>
																											
																											<div class="col-sm-9">
																												<textarea name="product_long_desc" id="product_long_desc" placeholder="Enter long description ..." class="form-control" cols="7" rows="7"></textarea>
																											</div>
                                                                                                      </div>
        
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        
                                                                                    </div><!-- End: stockform_lft -->
                                                                                </div>
                                                                                
                                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                    <div class="stockform_rht"><!-- Begin: stockform_rht -->
                                                                                    	<p class="stockform_rht_p">Include keywords that buyers would use to search for your item.<br><br>Learn more about what types of items are allowed on ctSell.<br><br>Factor in the costs of materials and labor, plus any related business expenses.<br><br>For quantities greater than one, this listing will renew automatically until it sells out. You’ll be charged a $0.20 USD listing fee each time.<br><br><br><br><br><br>Each renewal lasts for four months or until the listing sells out. Get more details on auto-renewing.<br><br><br><br><br><br><br><br>Start with a brief overview that describes your item's finest features.<br><br>List details like dimensions and key features in easy-to-read bullet points. <br><br>Tell buyers a bit about your process or the story behind this item. </p>
                                                                                    </div><!-- End: stockform_rht -->
                                                                                </div>
                                                                            </div><!-- End: formstock_box -->
                                                                            <div class="clearfix"></div>
																			
																			
                                                                            
                                                                        	<div style="margin-top:40px;" class="formstock_box"><!-- Begin: formstock_box -->
                                                                            	<h3 class="formstock_box_h6">Shipping</h3>
																				
                                                                                <p class="formstock_box_p">Set clear and realistic shipping expectations for shoppers by providing accurate processing time and shipping rates. </p>
                                                                                
																				<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                                    <div class="stockform_lft"><!-- Begin: stockform_lft -->
                                                                                    	<div class="row">
                                                                                        	
																							<div style="margin-top:15px;" class="form-group">
																								<label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">
																									Ships from <span style="color:#FF3A3D"> *</span>
																								</label>
																								
																								<div class="col-sm-9">
																									
																									<select name="country" id="country" style="width:70%;float:left;margin-right:7px;" class="form-control">
																										<option>What is Country?</option>
																										<optgroup label="Select a Country">
																											
																											<option value="United States">
																												United States
																											</option>
																											
																										</optgroup>
																										
																									</select>
																									
																								</div>
																								
																							  </div>
																							  <div class="clearfix"></div>
                                                                                        	
																							<div style="margin-top:15px;" class="form-group">
																								<label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">
																									Processing time
																								</label>
																								
																								<div class="col-sm-9">
																									
																									<select name="processing_time" id="processing_time" style="width:70%;float:left;margin-right:7px;" class="form-control">
																										
																										<option value="">Ready to ship in...</option>
																										<option value="1_1">1 business day</option>
																										<option value="1_2">1-2 business days</option>
																										<option value="1_3">1-3 business days</option>
																										<option value="3_5">3-5 business days</option>
																										<option value="5_10">1-2 weeks</option>
																										<option value="10_15">2-3 weeks</option>
																										<option value="15_20">3-4 weeks</option>
																										<option value="20_30">4-6 weeks</option>
																										<option value="30_40">6-8 weeks</option>
																										
																									</select>
																									
																								</div>
																								
																							  </div>
																							  <div class="clearfix"></div>
                                                                                        	
																							<div style="margin-top:15px;" class="form-group">
																								<label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">
																									Shipping costs
																								</label>
																								
																								<div class="col-sm-9">
																									
																									<div class="col-group panel-heading p-xs-2 bb-xs-0 hide-xs">
																										
																										<div class="col-xs-5 p-xs-0" style="background:#d3d3d3;">
																											<p class="strong text-truncate">Ships to</p>
																										</div>
																										
																										<div class="col-xs-3 p-xs-0" style="background:#d3d3d3;">
																											<p class="strong text-truncate">By itself</p>
																										</div>
																										
																										<div class="col-xs-4 p-xs-0" style="background:#d3d3d3;">
																											<p class="strong text-truncate">
																												With another item
																											</p>
																										</div>
																										
																									</div>
																									
																									<div class="col-group panel-heading p-xs-2 bb-xs-0 hide-xs">
																										
																										<div class="col-xs-5 p-xs-0">
																											<p class="align-with-btn text-truncate">
																												United States
																											</p>
																										</div>
																										
																										<div class="col-xs-3 p-xs-0">
																											<input type="text" data-field="primary_cost" value="" class="form-control" style="padding-left: 48px">USD
																										</div>
																										
																										<div class="col-xs-4 p-xs-0">
																											<input type="text" data-field="secondary_cost" value="" class="form-control" style="padding-left: 48px">USD
																										</div>
																										
																									</div>
																									
																								</div>
																								
																							  </div>
																							  <div class="clearfix"></div>
																							
																							
                                                                                        </div>
                                                                                    </div><!-- End: stockform_lft -->
                                                                                </div>
                                                                                
                                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                    <div class="stockform_rht"><!-- Begin: stockform_rht -->
                                                                                    	<p class="stockform_rht_p">You can send a customized note to buyers of digital items after the item is downloaded.<br><br>Add a note for buyers who purchase digital items</p>
                                                                                    </div><!-- End: stockform_rht -->
                                                                                </div>
                                                                                
                                                                            </div><!-- End: formstock_box -->
                                                                            <div class="clearfix"></div>
																			
																			
                                                                            
                                                                        	<div style="margin-top:40px;" class="formstock_box"><!-- Begin: formstock_box -->
                                                                            	<h6 class="formstock_box_h6">Search terms</h6>
                                                                                <p class="formstock_box_p">Help more people discover your listing by using accurate and descriptive words or phrases. How does search work on ctSell?</p>
                                                                                
																				<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                                    <div class="stockform_lft"><!-- Begin: stockform_lft -->
                                                                                    
                                                                                    	<div class="hor_frm">
                                                                                        	<div class="row">
                                                                                            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                                                    <div class="form-horizontal">
                                                                                                    
                                                                                                      <div class="form-group">
                                                                                                        <label class="col-sm-3 control-label hor_frm_title2" for="inputEmail3">Tags</label>
                                                                                                        <div class="col-sm-9">
                                                                                                        	<div class="row">
                                                                                                            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                                                                    <div class="input-group">
                                                                                                                      <input type="text" placeholder="Search for..." class="form-control">
                                                                                                                      <span class="input-group-btn">
                                                                                                                        <button type="button" class="btn btn-default">Add</button>
                                                                                                                      </span>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                          </div>
                                                                                                      </div>
                                                                                                      
                                                                                                      <div class="form-group">
                                                                                                        <label class="col-sm-3 control-label hor_frm_title2" for="inputEmail3">Materials</label>
                                                                                                        <div class="col-sm-9">
                                                                                                        	<div class="row">
                                                                                                            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                                                                    <div class="input-group">
                                                                                                                      <input type="text" placeholder="Search for..." class="form-control">
                                                                                                                      <span class="input-group-btn">
                                                                                                                        <button type="button" class="btn btn-default">Add</button>
                                                                                                                      </span>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                          </div>
                                                                                                      </div>
                                                                                                      
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        
                                                                                    </div><!-- End: stockform_lft -->
                                                                                </div>
                                                                                
                                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                    <div class="stockform_rht"><!-- Begin: stockform_rht -->
                                                                                    	<p class="stockform_rht_p">What words might someone use to search for your listings? Use all 13 tags to get found. Get ideas for tags.</p>
                                                                                    </div><!-- End: stockform_rht -->
                                                                                </div>
                                                                            </div><!-- End: formstock_box -->
                                                                            <div class="clearfix"></div>

                                                                        </div>
                                                                                                                                                
                                                                      </div>
                                                                      <div class="modal-footer">
                                                                        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                                                                        <button class="btn btn-primary" type="button">Save and continue</button>
                                                                      </div>
                                                                    </div>
                                                                  </div>
                                                                </div>
                                                                                                                            
                                                            </div><!-- End: stockmodal -->
                                                            
                                                        </div><!-- End: shoppre_box -->
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <div class="shoppre_box"><!-- Begin: shoppre_box -->
                                                            <a href="#">
                                                                <div class="shoppre_bxtop">
                                                                </div>
                                                                <div class="shoppre_bxbtm"></div>
                                                            </a>
                                                        </div><!-- End: shoppre_box -->
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <div class="shoppre_box"><!-- Begin: shoppre_box -->
                                                            <a href="#">
                                                                <div class="shoppre_bxtop">
                                                                </div>
                                                                <div class="shoppre_bxbtm"></div>
                                                            </a>
                                                        </div><!-- End: shoppre_box -->
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <div class="shoppre_box"><!-- Begin: shoppre_box -->
                                                            <a href="#">
                                                                <div class="shoppre_bxtop">
                                                                </div>
                                                                <div class="shoppre_bxbtm"></div>
                                                            </a>
                                                        </div><!-- End: shoppre_box -->
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <div class="shoppre_box"><!-- Begin: shoppre_box -->
                                                            <a href="#">
                                                                <div class="shoppre_bxtop">
                                                                </div>
                                                                <div class="shoppre_bxbtm"></div>
                                                            </a>
                                                        </div><!-- End: shoppre_box -->
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <div class="shoppre_box"><!-- Begin: shoppre_box -->
                                                            <a href="#">
                                                                <div class="shoppre_bxtop">
                                                                </div>
                                                                <div class="shoppre_bxbtm"></div>
                                                            </a>
                                                        </div><!-- End: shoppre_box -->
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <div class="shoppre_box"><!-- Begin: shoppre_box -->
                                                            <a href="#">
                                                                <div class="shoppre_bxtop">
                                                                </div>
                                                                <div class="shoppre_bxbtm"></div>
                                                            </a>
                                                        </div><!-- End: shoppre_box -->
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <div class="shoppre_box"><!-- Begin: shoppre_box -->
                                                            <a href="#">
                                                                <div class="shoppre_bxtop">
                                                                </div>
                                                                <div class="shoppre_bxbtm"></div>
                                                            </a>
                                                        </div><!-- End: shoppre_box -->
                                                    </div>
                                                    
                                                    <button type="button" id="shoplisting" class="btn btn-info nextBtn pull-right btn_submit">
														Save & Continue
													</button>

                                                </div><!-- End: stepcontent01 -->
                                                
                                            </div>   
                                                                                        
                                        </div>
                                    </div>
									
									</form>
									
                                    
                                    <div id="step-4" class="row setup-content" style="display: none;">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        	<h3 class="shop_steptitle">How you'll get paid</h3>
                                            <p class="shop_step_p">Choose a memorable name that reflects your style.</p>
                                            
                                            <div class="row">
                                                <div class="stepcontent03"><!-- Begin: stepcontent03 -->
                                                                                                    
                    								<div class="shopperformance_box"><!-- Begin: shopperformance_box -->
                                                    
                                                    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        
                                                            <p class="stepcontent03_p"><strong>Payment policies :</strong> We currently accept Paypal. An existing Paypal account is not required to pay via this method. If you would like to pay with any major credit card, simply select Paypal as your method of payment in the Etsy checkout, click on the green "Pay with Paypal" button, and follow the steps to pay with a credit card. Paypal will simply facilitate the transaction.<br><br>

If you pay via echeck with Paypal it takes 3-5 days before the payment clears. Your order will not be started until the payment has been cleared. This delays production time by 3-5 days.</p>

                                                        </div>
                                                        
                                                    </div><!-- Begin: shopperformance_box -->
                                                    
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <button type="button" class="btn btn-info nextBtn pull-right btn_submit">Next</button>
                                                        </div>
                                                    </div>
                                                                                                                                    
                                                </div><!-- End: stepcontent03 -->
                                                
                                            </div>  
                                            
                                        </div>
                                    </div>

                                    <div id="step-5" class="row setup-content" style="display: none;">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        	<h3 class="shop_steptitle">Set up billing</h3>
                                            <p class="shop_step_p">Choose a memorable name that reflects your style.</p>
                                            
                                            <div class="row">
                                                <div class="stepcontent03"><!-- Begin: stepcontent03 -->
                                                                                                    
                    								<div class="shopperformance_box"><!-- Begin: shopperformance_box -->
                                                    
                                                    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        
                                                            <div class="payment_box01">
                                                                <h3 class="payment_box_h3">Payment methods</h3>
                                                                <label style="margin-top:15px;" class="radio-inline">
                                                                  <input type="radio" value="option1" id="inlineRadio1" name="inlineRadioOptions"> <p class="step5_pay_label">American Express</p>
                                                                </label>
                                                                <label style="margin-top:15px;" class="radio-inline">
                                                                  <input type="radio" value="option1" id="inlineRadio1" name="inlineRadioOptions"> <p class="step5_pay_label">Mastercard</p>
                                                                </label>
                                                                <label style="margin-top:15px;" class="radio-inline">
                                                                  <input type="radio" value="option1" id="inlineRadio1" name="inlineRadioOptions"> <p class="step5_pay_label">PayPal</p>
                                                                </label>
                                                                <label style="margin-top:15px;" class="radio-inline">
                                                                  <input type="radio" value="option1" id="inlineRadio1" name="inlineRadioOptions"> <p class="step5_pay_label">VISA</p>
                                                                </label>
                                                                <p class="payment_box01_p">Ready to ship in 1-2 weeks. </p>
                                                            </div>

                                                        </div>
                                                        
                                                    </div><!-- Begin: shopperformance_box -->
                                                                                                                                                                        
                                                </div><!-- End: stepcontent03 -->
                                                
                                            </div>  
                                            
                                        </div>
                                    </div>
                                    
                                
								
                            </div><!-- End: wizarcontent -->
                        </div>
                    </div>
              
                                        
                </div><!-- End: your_shop -->
            </div>  
        
        </div><!-- End: usershop_inner -->        
    </div>
    
    </div>
    
</div>


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

	<script type="text/javascript">
	
		// Shop Name Avalibility Check
		
		$(document).ready(function()
		{    
			$("#shop_name").keyup(function()
			{		
				var shop_name = $(this).val();	
				
				if(shop_name.length > 3)
				{		
					$("#result").html('checking...');
					
					/*$.post("username-check.php", $("#reg-form").serialize())
						.done(function(data){
						$("#result").html(data);
					});*/
					
					$.ajax({
						
						type : 'POST',
						url  : '<?php echo base_url(); ?>page/yourshop/shopavailablecheck',
						data : $(this).serialize(),
						success : function(data)
							{
								$("#result").html(data);
							}
						});
						return false;
				}
				else
				{
					$("#result").html('');
				}
			});
			
		});
	</script>
		
	
	<!-- Insert Data without Refresh -->
	
	<script type="text/javascript">
		$(function() {

			// Shop Preferences 
			$('#submit').click(function() {

				//get input data as a array
				var post_data = {
					'shop_language'	: $("#shop_language").val(),
					'shop_currency'	: $("#shop_currency").val(),
					'shop_location'	: $("#shop_location").val(),
					'intention'		: $("#intention").val(),
					'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
				};

				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>page/yourshop/shoppreferences",
					data: post_data,
					success: function(shop_language) {
						// return success message to the id='result' position
						$("#result").html(shop_language);
					}
				});

			});
			
			
			// shopname check  
			$('#shopnamecheck').click(function() {

				//get input data as a array
				var post_data = {
					'shop_name'	: $("#shop_name").val(),
					'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
				};

				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>page/yourshop/shopnamesave",
					data: post_data,
					success: function(shop_name) {
						// return success message to the id='result' position
						$("#result").html(shop_name);
					}
				});

			});
			
			

		});
	</script>


<?php $this->load->view('../../front-templates/footer.php'); ?>
