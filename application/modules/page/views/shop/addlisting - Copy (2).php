<?php
$this->load->view('../../front-templates/head.php');
$this->load->view('../../front-templates/header.php');
$this->load->view('../../front-templates/navigation.php');

if(!empty($users)){
	extract($users); // Get all info from users table using userid
}else{
	redirect(base_url()."page/yourshop/addlisting");
}

?>


<!-- This for dependency select category, Subcategory & Subcategory level2 --->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/jquery-1.4.1.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$("#category").change(function(){
			var id=$(this).val();
			var dataString = 'category_id='+ id;

			$.ajax
			({
			type: "POST",
			url: "<?php echo base_url(); ?>page/yourshop/getproductsubcategory",
			data: dataString,
			cache: false,
			success: function(html)
			{
				$("#subcategory").html(html);
			} 
			});	
		});


		$("#subcategory").change(function(){
			var id=$(this).val();
			var dataString = 'subcategory_id='+ id;

		$.ajax
			({
			type: "POST",
			url: "<?php echo base_url(); ?>page/yourshop/getproductsubcategorylev2",
			data: dataString,
			cache: false,
			success: function(html)
			{
				$("#subcategorylev2").html(html);
			} 
			});
		});

	});
</script>

<div id="inner_page"><!-- Begin: inner_page -->

<div class="container">

<div class="row">
<div class="usershop_inner mgtop"><!-- Begin: usershop_inner -->

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	
		<h4 class="text-center">
			<?php
				 
				// Success Or Failor check
				if(isset($success_msg)){
					
					echo '<span id="msg" class="text-success"> <i class="fa fa-check-circle"></i> '.$success_msg.' </span><br/>';
					$redurl = base_url().'page/yourshop/addlisting';
					$this->output->set_header('refresh:3; url='.$redurl);
					
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
					
					<?php
						$this->load->model('yourshop_model'); // Load Database
						$userid = $this->session->userdata('userid');
						if($this->yourshop_model->shopuser_exists($userid)){
							extract($this->yourshop_model->get_data_shops($userid));
						}
						
					?>
						
						<div class="stepwizard-step urshop_step" style="background-color:#EFEFEB">
							<a disabled="disabled" class="btn btn-circle btn-default btn-primary" type="button" href="#step-3">
								
							</a>
					
						</div>
				</div>
			</div>
		</div>
		
		
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="wizarcontent"><!-- Begin: wizarcontent -->
					
					   
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
												
												<form role="form" action="<?php echo base_url(); ?>page/yourshop/shopproductstock" method="post" enctype="multipart/form-data" accept-charset="utf-8" autocomplete="off">
												
												
												
												<div class="stockmodal"><!-- Begin: stockmodal -->
												
													<?php
														// This Settings table Global query user for all
														$setting_query = $this->db->query('SELECT * from mega_settings where setting_id=1');
														$fetch_setting = $setting_query->row_array();
														
														$listing_cost 		= $fetch_setting['listing_cost'];
														$product_renewal 	= $fetch_setting['product_renewal'];
														$sell_commission 	= $fetch_setting['sell_commission'];
														
														// Get country name using ip
														$ip = $_SERVER['REMOTE_ADDR'];
														// this is where you create the variable that get you the name of the country
														$country = getCountryFromIP($ip, " NamE ");
													?>
													
													
													
													<input type="hidden" name="product_renewal" value="<?php echo $product_renewal; ?>" />
													<input type="hidden" name="product_location" value="<?php echo $country; ?>" />
												
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
																						Product Image upload here!
																					</h5>
																					
																					<div class="shopfrm_box"><!-- Begin: shopfrm_box -->
																						
																						<div class="fileUpload">
																							<span class="custom-span">
																								<i class="fa fa-camera"></i>
																							</span>
																							<p class="custom-para">Add a Image</p>
																							
																							<input type="file" id="files1" name="userfile[]" />
																							
																							<b id="imgclose1">
																								<i class="fa fa-times-circle"></i>
																							</b>
																							
																						</div>
																						
																						<div class="fileUpload">
																							<span class="custom-span">
																								<i class="fa fa-camera"></i>
																							</span>
																							<p class="custom-para">Add a Image</p>
																							
																							<input type="file" id="files2" name="userfile[]" />
																							
																							<b  id="imgclose2">
																								<i class="fa fa-times-circle"></i>
																							</b>
																							
																						</div>
																						
																						<div class="fileUpload">
																							<span class="custom-span">
																								<i class="fa fa-camera"></i>
																							</span>
																							<p class="custom-para">Add a Image</p>
																							
																							<input type="file" id="files3" name="userfile[]" />
																							
																							<b id="imgclose3">
																								<i class="fa fa-times-circle"></i>
																							</b>
																							
																						</div>
																						
																						<div class="fileUpload">
																							<span class="custom-span">
																								<i class="fa fa-camera"></i>
																							</span>
																							<p class="custom-para">Add a Image</p>
																							
																							<input type="file" id="files4" name="userfile[]" />
																							
																							<b id="imgclose4">
																								<i class="fa fa-times-circle"></i>
																							</b>
																							
																						</div>
																						
																					</div><!-- End: shopfrm_box -->
																				</div>
																				
																			</div>
																		</div><!-- End: stockform_lft -->
																	</div>
																	
																	
																	<script>
																		// Preview Images Remove
																		
																		$(document).ready(function(){
																			$("#imgclose1").click(function(){
																				$("#thumb1").remove();
																			});
																			
																			$("#imgclose2").click(function(){
																				$("#thumb2").remove();
																			});
																			
																			$("#imgclose3").click(function(){
																				$("#thumb3").remove();
																			});
																			
																			$("#imgclose4").click(function(){
																				$("#thumb4").remove();
																			});
																			
																			$("#imgclose1").on('click', function() { $("#files1").val(''); });
																			$("#imgclose2").on('click', function() { $("#files2").val(''); });
																			$("#imgclose3").on('click', function() { $("#files3").val(''); });
																			$("#imgclose4").on('click', function() { $("#files4").val(''); });
																		});
																		
																	</script>
																	
																	
																	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
																		<div class="stockform_rht"><!-- Begin: stockform_rht -->
																			<!--p class="stockform_rht_p">Use high-quality JPG, PNG or GIF files that are at least 570px wide (we recommend 1000px).<br><br>The best photos use natural or diffused lighting, and don’t use a flash.<br><br>These are thumbnails of your photos. Zoom in to see them full-size.</p--> &nbsp;
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
																									Product name
																									<span style="color:#FF3A3D"> *</span>
																								</label>
																								
																								<div class="col-sm-9">
																									<input type="text" name="product_name" id="product_name" placeholder="Enter product name..." class="form-control">
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
																								
																								<select name="product_category_id" id="category" style="width:30%;float:left;margin-right:7px;" class="form-control">
																									
																									<option>---Category---</option>
																									
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
																										
																										<option value="<?php echo $value101->category_id; ?>">
																											<?php echo $value101->category_name; ?>
																										</option>
																										
																										
																										<?php } ?>
																										
																									</optgroup>
																									
																									<?php } ?>
																									
																								</select>
																								
																								
																								<select name="product_sub_category_id" id="subcategory" style="width:30%;float:left;margin-right:7px;" class="form-control">
																								
																									
																									<option>---Subcategory---</option>
																									
																								</select>
																								
																								
																								<select name="product_sub_category_lev2_id" id="subcategorylev2" style="width:30%;float:left;margin-right:7px;" class="form-control">
																								
																									<option>---SubcategoryLevel2---</option>
																									
																									
																								</select>
																								
																								
																							</div>
																							
																						  </div>
																						  <div class="clearfix"></div>
																						  
																						  
																						  
																						  <div style="margin-top:15px" class="form-group">
																								<label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">
																									Price($)<span style="color:#FF3A3D"> *</span>
																								</label>
																								
																								<div class="col-sm-4">
																								<input type="text" name="product_price" id="product_price" placeholder="Enter price..." class="form-control">
																								</div>
																						  </div>
																						  <div class="clearfix"></div>
																						  
																						  
																						  <div style="margin-top:15px" class="form-group">
																							<label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">Quantity<span style="color:#FF3A3D">*</span></label>
																							<div class="col-sm-4">
																							  <input type="text" name="product_stock" placeholder="Enter quantity..." class="form-control">
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
																						  
																						  
																						  						

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
	$(function () {
		
		
		$(":input#option_group_id").live("change", function () {
			
			var sel_opt = $(this).val();
			
			if(sel_opt == 1){ // For Color
				$(".varition-sectmain1").addClass('dpB');
				$(".varition-sectmain1").removeClass('dpN');
				$("#scale_size").addClass('dpN');
				$("#scale_size").removeClass('dpB');
				$(".reset").addClass('dpN');
				$(".reset").removeClass('dpB');
				$(".varition-sectmain1 strong").html("<input name='option_group_nameC' id='edbdsbl' type='hidden' value='1' /><h4> Color </h4>");
			}
			
			if(sel_opt == 2){ // For Size
				$(".varition-sectmain2").addClass('dpN');
				$("#scale_size").addClass('dpN');
				$("#scale_size").removeClass('dpB');
				$(".reset").addClass('dpN');
				$(".reset").removeClass('dpB');
			}
			
		});
		
		
		$(":input#scale_size").live("change", function () {
			
			var sel_opt2 = $(this).val();
			
			if(sel_opt2){ // For Size Measuring Units
				$(".varition-sectmain2").addClass('dpB');
				$(".varition-sectmain2").removeClass('dpN');
				$(".varition-sectmain2 strong").html("<input name='option_group_nameS' id='edbdsbl' type='hidden' value='2' /><input name='measuringunits' id='edbdsbl' type='hidden' value="+sel_opt2+" /><h4> Size </h4>"+"<h5>"+sel_opt2+"</h5>");
				
				$("#sizeval0").each(function(){
					$(this).append("<i>"+sel_opt2+"</i>");
				});
				//$(".sizeval").html("<h5>"+sel_opt2+"</h5>");
				 
			}
			
		});
		
		
		$(":input#option_group_id").live("change", function () {
			
			var sise_opt = $(this).val();
			
			if(sise_opt == 2){ // For Size
				$("#scale_size").addClass('dpB');
				$("#scale_size").removeClass('dpN');
				$(".reset").addClass('dpB');
				$(".reset").removeClass('dpN');
			}
			
		});
		
		
		
		$(".reset").click(function(){
			$("#scale_size").removeClass('dpB');
			$("#scale_size").addClass('dpN');
			$(".reset").addClass('dpN');
			$(".reset").removeClass('dpB');
		});
		
		
		$(".remove1").click(function(){
			$(".varition-sectmain1").removeClass('dpB');
			$(".varition-sectmain1").addClass('dpN');
		});
		
		
		$(".remove2").click(function(){
			$(".varition-sectmain2").removeClass('dpB');
			$(".varition-sectmain2").addClass('dpN');
		});
		
		
		$("body").on("click", ".remove", function () {
			$(this).closest(".variation-fields").remove();
		});
	});

	
	function GetDynamicTextBox(value) {
		
		return '<select name="option_group_id[]" id="option_group_id" class="form-control" style="width:40%;float:left;margin:5px;"><option value="">Add a variation</option><optgroup label="Select a property"><?php
			$optsql = $this->db->query("select * from mega_optiongroups");$optresult = $optsql->result();foreach($optresult as $viewresult){ ?><option value="<?php echo $viewresult->optiongroup_id; ?>"><?php echo $viewresult->option_group_name; ?></option><?php } ?></optgroup></select><input name="option_details[]" class="form-control" placeholder="Option details" id="option_details" type="text" style="width:40%; margin:5px;" value = "' + value + '" />&nbsp;' +
		'<button type="button" value="Remove" class="remove btn btn-danger rmButton"><i class="fa fa-remove"></i></button>'
		
	}
</script>
																						  
																						  
																						  <div style="margin-top:15px" class="form-group">
																								
																								<label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">
																									Item details  <span style="color:#FF3A3D"> *</span>
																								</label>
																								
																								<div class="col-sm-9">
																									<textarea name="product_item_details" id="product_item_details" placeholder="Item details..." class="form-control" cols="7" rows="15"></textarea>
																								</div>
																						  </div>
																						  
																						  
																						  <div style="margin-top:15px" class="form-group">
																								
																								<label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">
																									Section
																								</label>
																								
																								<div class="col-sm-9">
																								
																									<select style="width:250px" name="section" id="section" class="select select-custom form-control">
																										<option value="">None</option>
																										<optgroup label="Select a Section">
																												
																												<?php
																													foreach($sections as $valueSection){
																												?>
																												
																												<option value="<?php echo $valueSection->sectionid; ?>">
																													<?php echo $valueSection->sectionname; ?>
																												</option>
																												
																												<?php } ?>
																												
																										</optgroup>
																											<optgroup label="Couldn't find a section?">
																												<option value="add" id="create-user" data-target="#myModal3" data-toggle="modal">
																													Add a section
																												</option>
																											</optgroup>
																									</select>
																									
																								</div>
																						  </div>
																						  
																			
																	<!-- Popup Section -->			  
																	  <div aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal3" class="modal fade bs-example-modal-sm in" style="display: none;left: 15px;overflow: hidden; padding-left: 17px;position: absolute;top: 504px;">
																	  <div role="document" class="modal-dialog modal-sm">
																		<div class="modal-content">
																		
																		  <div class="modal-header" style="padding:5px !important;">
																			<!--button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button-->
																			<h4 id="myModalLabel" class="profile_contact_h4">Add New Section</h4>
																		  </div>
																		  
																		  <div class="modal-body" style="padding:5px !important;">
																			<div class="row">
																				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																					<div style="padding-left:15px;" class="profile_contact">
																						
																						  <div class="form-group">
																							<label for="exampleInputEmail1">Enter Section</label>
																							<input style="width:280px;" type="email" placeholder="Enter Section" class="form-control" />
																						  </div>
																						
																					</div>
																				</div>
																			</div>
																		  </div>
																		  
																		  <div class="modal-footer" style="padding:5px !important;">
																			<button class="btn btn-primary" type="button">Save</button>
																			<!--button aria-label="Close" data-dismiss="modal" class="btn btn-default" type="button">Cancel</button-->

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
																			<!--p class="stockform_rht_p">Include keywords that buyers would use to search for your item.<br><br>Learn more about what types of items are allowed on ctSell.<br><br>Factor in the costs of materials and labor, plus any related business expenses.<br><br>For quantities greater than one, this listing will renew automatically until it sells out. You’ll be charged a $0.20 USD listing fee each time.<br><br><br><br><br><br>Each renewal lasts for four months or until the listing sells out. Get more details on auto-renewing.<br><br><br><br><br><br><br><br> </p-->
																		</div><!-- End: stockform_rht -->
																	</div>
																</div><!-- End: formstock_box -->
																<div class="clearfix"></div>
																								
																			
																
	<div style="margin-top:40px;" class="formstock_box"><!-- Begin: formstock_box -->
		<h6 class="formstock_box_h6">Product Variations</h6>
		
		<p class="formstock_box_p">
			Add available options, such as color or size. If you add variations, buyers must select them before adding your items to their cart.
		</p>
		
		<p>&nbsp;</p>
		
		<!-- For Color -->
		<div class="form-group varition-sectmain1 dpN">
									
			<label class="col-lg-3 col-md-3 col-sm-3 control-label hor_frm_title2" for="inputEmail3">
				
				<strong>Variations</strong>
				
				<p>
					<b class="remove1 text-danger">Delete</b>
				</p>
				
			</label>
			
			<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
				<div class="row">
					<div class="varition-area clearfix new-option-content">
						
						<div class="variation-head">
						
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<h5 style="padding-left:10px;width:200px;"><p>Options</p></h5>
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<h5 style="padding-left:10px;width:200px;text-align:right"><p>Action</p></h5>
							</div>
							
						</div>
						
						<?php
							$color = array('Silver','Gold','Black','Blue','Brown','Green','Gray','Pink','Purple','Red','White','Yellow');
							foreach($color as $key => $val){
						?>
						
						
							
						<div class="variation-fields">
						
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<p><?php echo $val; ?></p>
								<input type="hidden" name="coloroptionname[]" value="<?php echo $val; ?>" />
							</div>
							
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<p>
									<b class="pull-right remove">
										<span class="fa fa-remove"></span>
									</b>
								</p>
							</div>
							
						</div>
							
						
						
						<?php
							}
						?>
						
					</div>
					
					
					<!-- Add new Color Options -->	
					<div class="clearfix add-new-option" style="padding:10px;">
						  
						<input style="display:inline;width:77%" id="optionInput" type="text" class="form-control checklist-new-item-text" placeholder="+ Add a new option...">
						  
						<button style="display:inline;" id="add" type="button" class="btn btn-primary btn-sm new-option-add">Add</button>
						
					</div>
					
					
					
				</div>
			</div>
			
		</div>
		

		
		<p>&nbsp;</p>
		
		
		<!-- For Size -->
		<div class="form-group varition-sectmain2 dpN">
									
			<label class="col-lg-3 col-md-3 col-sm-3 control-label hor_frm_title2" for="inputEmail3">
				
				<strong>Variations</strong>
				
				<p>
					<b class="remove2 text-danger">Delete</b>
				</p>
				
			</label>
			
			<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
				<div class="row">
					<div class="varition-area clearfix new-option-content2">
						
						<div class="variation-head">
						
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<h5 style="padding-left:10px;">Options</h5>
							</div>
							
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<h5 style="padding-left:10px;" class="pric">Add pricing</h5>
							</div>
							
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<h5 style="padding-left:10px;text-align:center;">Action</h5>
							</div>
							
						</div>
						
						<?php
							//$color = array('Black','Blue','Brown','Green','Gray','Pink','Purple','Red','White','Yellow');
							
							//$size = array(14,15,16,17,18,19,20,21,22,23,24,25);
							
							//foreach($size as $key1 => $val1){
									
						?>
						
						<!--div class="variation-fields">
						
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<b style="font-weight:normal;" id="sizeval">
									<?php 
										//echo $val1;
									?>
									<input type="hidden" name="optionname[]" value="<?php //echo $val1; ?>" />
								</b>
							</div>
							
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<p>
									<input type="text" id="pric" name="pricing[]" value="0" /> USD
								</p>
							</div>
							
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<p style="text-align:center;">
									<b class="remove" style="text-align:center;">
										<span class="fa fa-remove"></span>
									</b>
								</p>
							</div>
							
						</div-->
						
						<?php
							//}
						?>
						
					
					
					</div>
					
					
				</div>
				
					
					
					
					<!-- Add new Color Options -->	
					<div class="clearfix add-new-option" style="padding:10px;">
						  
						<input style="display:inline;width:77%" id="optionInput2" type="text" class="form-control checklist-new-item-text" placeholder="+ Add a new option...">
						  
						<button style="display:inline;" id="add2" type="button" class="btn btn-primary btn-sm new-option-add">Add</button>
						
					</div>
					
					
			</div>
		</div>
		
		
		<div class="form-group vvritions">
									
			<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
				<div class="stockform_lft"><!-- Begin: stockform_lft -->
					
					<div class="hor_frm">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="form-horizontal">
									
									<div class="form-group">
										
										<label class="col-sm-3 control-label hor_frm_title2" for="inputEmail3">
											Add a variation
										</label>
										
										<div class="col-sm-9">
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<div class="input-group">
														
														
														<!--button id="btnAdd" class="btn btn-primary" type="button">
															<i class="fa fa-plus"></i>
															Add New Option
														</button-->
														
														
														<div class="clearfix"></div>
														
														<div id="TextBoxContainer" style="margin-top:0px;">
															
															<select name="option_group_id" id="option_group_id" class="form-control" style="width:180px;float:left; margin:5px;display:inline;">
																
																<option value="">Add a variation</option>
																
																<optgroup label="Select a property">
																	
																	<?php
																		$optsql = $this->db->query("select * from mega_optiongroups");
																		$optresult = $optsql->result();
																		
																		foreach($optresult as $viewresult){
																	?>
																	
																	<option value="<?php echo $viewresult->optiongroup_id; ?>">
																		<?php echo $viewresult->option_group_name; ?>
																	</option>
																	
																	<?php } ?>
																
																</optgroup>
																
															</select>
															
															
															<select name="scale_size" id="scale_size" class="form-control dpN" style="width:180px;float:left; margin:5px;display:inline;">
																
																<option value="">What scale are your sizes in?</option>
																
																<optgroup label="Select a scale...">
																	
																	<?php
																		$optSizesql = array('Alpha','Inches','Centimeters','Fluid Ounces','Millilitres','Litres','Other');
																		
																		foreach($optSizesql as $key => $val){
																	?>
																	
																	<option value="<?php echo $val; ?>">
																		<?php echo $val; ?>
																	</option>
																	
																	<?php } ?>
																
																</optgroup>
																
															</select>
															
															<b class="reset dpN" style="color: #3399ff;float: left;margin-left: 10px;margin-top: 13px;"> Reset </b>
															
															<!--input name="option_details[]" class="form-control" placeholder="Option details" id="option_details" type="text" style="width:40%; margin:5px;" />
															
															<button type="button" value="Remove" class="remove btn btn-danger rmButton" disabled >
																<i class="fa fa-remove"></i>
															</button-->
															<!--Textboxes will be added here -->
															
														</div>
														
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
		</div>
		
		<!--div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<div class="stockform_rht">
				<p class="stockform_rht_p">What words might someone use to search for your listings? Use all 13 tags to get found. Get ideas for tags.</p>
			</div>
		</div-->
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
									
									<select onfocus="this.blur();" name="ship_from" id="ship_from" style="width:70%;float:left;margin-right:7px;" class="form-control">
									
										<option>What is Country?</option>
										<optgroup label="Select a Country">
											
											<option selected="selected" value="United States">
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
									
									<select name="processing_time" required="required" id="processing_time" style="width:70%;float:left;margin-right:7px;" class="form-control">
										
										<option value="">Ready to ship in...</option>
										
										<option value="1 business day">1 business day</option>
										
										<option value="1-2 business days">1-2 business days</option>
										
										<option value="1-3 business days">1-3 business days</option>
										
										<option value="3-5 business days">3-5 business days</option>
										
										<option value="1-2 weeks">1-2 weeks</option>
										
										<option value="2-3 weeks">2-3 weeks</option>
										
										<option value="3-4 weeks">3-4 weeks</option>
										
										<option value="4-6 weeks">4-6 weeks</option>
										
										<option value="6-8 weeks">6-8 weeks</option>
										
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
										
										<div class="col-xs-4 p-xs-0">
											
											<input type="text" onfocus="this.blur();" name="ship_to" id="ship_to" data-field="primary_cost" value="Local" class="form-control" style="text-align: center">
											
										</div>
										
										<div class="col-xs-4 p-xs-0">
											
											<div class="input-group">
												<span class="input-group-addon">USD</span>
												<input type="text" required="required" name="shipping_cost_by_itself" id="shipping_cost_by_itself" data-field="primary_cost" value="" class="form-control" style="text-align: center">
											</div>
												
										</div>
										
										<div class="col-xs-4 p-xs-0">
											
											<div class="input-group">
												<span class="input-group-addon">USD</span>
												<input type="text" required="required" name="shipping_cost_with_another_items" id="shipping_cost_with_another_items" data-field="secondary_cost" value="" class="form-control" style="text-align: center">
											</div>
											
										</div>
										
									</div>
									
									<div class="clearfix"></div>
									
									<div class="col-group panel-heading p-xs-2 bb-xs-0 hide-xs">
										
										<div class="col-xs-4 p-xs-0">
											
											<input type="text" onfocus="this.blur();" name="ship_to_int" id="ship_to_int" data-field="primary_cost" value="International" class="form-control" style="text-align: center">
											
										</div>
										
										<div class="col-xs-4 p-xs-0">
											
											<div class="input-group">
												<span class="input-group-addon">USD</span>
												<input type="text" required="required" name="shipping_cost_int_by_itself" id="shipping_cost_int_by_itself" data-field="primary_cost" value="" class="form-control" style="text-align: center">
											</div>
												
										</div>
										
										<div class="col-xs-4 p-xs-0">
											
											<div class="input-group">
												<span class="input-group-addon">USD</span>
												<input type="text" required="required" name="shipping_cost_int_with_another_items" id="shipping_cost_int_with_another_items" data-field="secondary_cost" value="" class="form-control" style="text-align: center">
											</div>
											
										</div>
										
									</div>
									
								</div>
								
							  </div>
							  <div class="clearfix"></div>
							
							<div style="margin-top:15px;" class="form-group">
								<label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">
									Item weight (Optional)
								</label>
								
								<div class="col-sm-9">
									
									<div class="col-group panel-heading p-xs-2 bb-xs-0 hide-xs">
										
										<div class="col-xs-4 p-xs-0">
											
											<div class="input-group">
												<span class="input-group-addon">lbs</span>
												<input type="text" name="lbs" id="lbs" data-field="primary_cost" class="form-control" style="text-align: center">
											</div>
												
										</div>
										
										<div class="col-xs-4 p-xs-0">
											
											<div class="input-group">
												<span class="input-group-addon">oz</span>
												<input type="text" name="oz" id="oz" data-field="primary_cost" class="form-control" style="text-align: center">
											</div>
												
										</div>
										
									</div>
									
								</div>
								
							  </div>
							  <div class="clearfix"></div>
							
							<div style="margin-top:15px;" class="form-group">
								<label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">
									Item size (Optional)
								</label>
								
								<div class="col-sm-9">
									
									<div class="col-group panel-heading p-xs-2 bb-xs-0 hide-xs">
										
										<div class="col-xs-4 p-xs-0">
											
											<div class="input-group">
												<span class="input-group-addon">in</span>
												<input type="text" name="length" id="length" data-field="primary_cost" class="form-control" placeholder="Length" style="text-align: center">
											</div>
												
										</div>
										
										<div class="col-xs-4 p-xs-0">
											
											<div class="input-group">
												<span class="input-group-addon">in</span>
												<input type="text" name="width" id="width" data-field="primary_cost" placeholder="Width" class="form-control" style="text-align: center">
											</div>
												
										</div>
										
										<div class="col-xs-4 p-xs-0">
											
											<div class="input-group">
												<span class="input-group-addon">in</span>
												<input type="text" name="height" id="height" data-field="primary_cost" placeholder="Height" class="form-control" style="text-align: center">
											</div>
												
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
						<!--p class="stockform_rht_p">You can send a customized note to buyers of digital items after the item is downloaded.<br><br>Add a note for buyers who purchase digital items</p-->
					</div><!-- End: stockform_rht -->
					
				</div>
				
				
			</div><!-- End: formstock_box -->
			<div class="clearfix"></div>
			
			
			<div style="margin-top:40px;" class="formstock_box"><!-- Begin: formstock_box -->
							<h6 class="formstock_box_h6">Search terms</h6>
							<p class="formstock_box_p">Help more people discover your listing by using accurate and descriptive words or phrases. How does search work on ctSell?</p>
							
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="stockform_lft"><!-- Begin: stockform_lft -->
								
									<div class="hor_frm">
										<div class="row">
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="form-horizontal">
												
												  <div class="form-group">
													<label class="col-sm-2 control-label hor_frm_title2" for="inputEmail3">Tags</label>
													
													<div class="col-lg-10 col-md-10">
														<div class="row">
															<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
																<div class="input-group0">
																  
																  <input type="text" name="tags" placeholder="Shape, color, style, function, etc." class="form-control">
																  
																</div>
															</div>
														</div>
													  </div>
													  
												  </div>
												  
												  <div class="form-group">
													<label class="col-sm-2 control-label hor_frm_title2" for="inputEmail3">Materials</label>
													
													<div class="col-lg-10 col-md-10">
														<div class="row">
															<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
																<div class="input-group0">
																  
																  <input type="text" name="materials" placeholder="Ingredients, components, etc." class="form-control">
																  
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
							
							<!--div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<div class="stockform_rht">
									<p class="stockform_rht_p">What words might someone use to search for your listings? Use all 13 tags to get found. Get ideas for tags.</p>
								</div>
							</div-->
						</div>
						
						<!-- End of adding tag, Materials -->
																
																

															</div>
																																	
														  </div>
														  
															<div class="modal-footer">
														  
																<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
																<button class="btn btn-primary" id="productlisting" type="submit">Save and continue</button>
															
															</div>
														  
														</div>
													  </div>
													</div>
																												
												</div><!-- End: stockmodal -->
												
												
												</form>
												
												
											</div><!-- End: shoppre_box -->
										</div>
										
										
										<?php
											/*if($this->yourshop_model->shopproduct_num($shopid) > 0){
											
											foreach($this->yourshop_model->getlistingproducts($shopid) as $viewproducts){
										?>
										
											<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
												<div class="shoppre_box"><!-- Begin: shoppre_box -->
													
													<a href="<?php echo base_url(); ?>page/pdetails/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $viewproducts->product_name)))))))); ?>/<?php echo $viewproducts->productid; ?>">
														
														<div class="shoppre_bxtop">
															<?php
																$pimg = explode(',',$viewproducts->product_image);
																	
																for($pi=0;$pi< count($pimg);$pi++){
																	
																	// Check product Image NULL Or Not
																	if($viewproducts->product_image == NULL){
																		$imglocation = base_url()."assets/frontend/images/shops/default-img.jpg";
																	}else{
																		$sname = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shop_name))));
																		
																		$imglocation = base_url()."assets/frontend/images/shops/$sname/$pimg[$pi]";
																	}
																	
																	echo '<img src="'.$imglocation.'" alt="'.$viewproducts->product_name.'" title="'.$viewproducts->product_name.'" />';
																	break;
																}
															?>
														</div>
														
														<div class="shoppre_bxbtm">
															<h5 class="pname"><?php  echo substr($viewproducts->product_name,0,55); ?></h5>
															<h6 class="pprice">
																$ <?php  echo $viewproducts->product_price; ?>
																	<span>&nbsp;</span>
																
															</h6>
														</div>
													</a>
													
												</div><!-- End: shoppre_box -->
											</div>
										
										<?php		
												}
											}else{*/
										?>
										
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
										
										<?php } ?>
										
										
										

									</div><!-- End: stepcontent01 -->
									
								</div>   
																			
							</div>
						</div>
						
						</form>
						
						
					
					
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

$(document).ready(function(){    
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


// Set Billing check  
$('#billing000000').click(function() {

	//get input data as a array
	var paymentmeth = $("#paymentmethod").val();
	
	if(paymentmeth === 'Paypal'){
		var post_data = {
			'paymentmethod'	: $("#paymentmethod").val(),
			'paymentemail'	: $("#paymentemail").val(),
			'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
		};
	}else{
		var post_data = {
			'paymentmethod'	: $("#paymentmethod").val(),
			'cardnumber'	: $("#cardnumber").val(),
			'cvc'			: $("#cvc").val(),
			'securitycode'	: $("#securitycode").val(),
			'expiremonth'	: $("#expiremonth").val(),
			'expireyear'	: $("#expireyear").val(),
			'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
		};
	}

	$.ajax({
		type: "POST",
		url: "<?php echo base_url(); ?>page/yourshop/paymentinfosave",
		data: post_data,
		success: function(paymentmethod) {
			$("#result").html(paymentmethod);
		}
	});

});




});
</script>


<?php $this->load->view('../../front-templates/footer.php'); ?>
