<?php
$this->load->view('../../front-templates/head.php');
$this->load->view('../../front-templates/header.php');
$this->load->view('../../front-templates/navigation.php');

if(!empty($users)){
	extract($users); // Get all info from users table using userid
}else{
	redirect(base_url()."page/yourshop/listingmanager");
}

if($this->uri->segment(4) == NULL){ redirect(base_url()."page/yourshop/listingmanager"); }

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
				
				if( $this->uri->segment(5) ){
					
					// Success Or Failor check
					if(isset($success_msg)){
						
						echo '<span id="msg" class="text-success"> <i class="fa fa-check-circle"></i> '.$success_msg.' </span><br/>';
						$redurl = base_url().'page/yourshop/listingmanager';
						$this->output->set_header('refresh:3; url='.$redurl);
						
					}else if(isset($error_msg)){
						
						echo '<span class="text-danger"> <i class="fa fa-exclamation-triangle"></i> '.$error_msg.' </span><br/>';
						
					}
					
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
							
								<h3 class="shop_steptitle">Edit your stock shop product's </h3>
								<p class="shop_step_p">You can change products information's! </p>
									
								<div class="row">
								
									<div class="stepcontent02"><!-- Begin: stepcontent01 -->
									
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="shoppre_box" style="padding:7px;"><!-- Begin: shoppre_box -->
												
												<?php
													
													// Get products informations
													$pid = $this->uri->segment(4);
													$updateproductSql = $this->db->query("select * from mega_products where productid=$pid");
													$editproductFetch = $updateproductSql->row_array();
													extract($editproductFetch);
													
													// Get product shop informations
													$getShopNameSql = $this->db->query("select * from mega_shops where shopid=$shopid");
													$getShopNameFetch = $getShopNameSql->row_array();
													extract($getShopNameFetch);
												
												?>
												
												
												<form role="form" action="<?php echo base_url(); ?>page/yourshop/pedit/<?php echo $this->uri->segment(4); ?>/<?php echo $shopid; ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8" autocomplete="off">
												
												
												<div class="row">
															
													<div class="formstock_box"><!-- Begin: formstock_box -->
														
														<h6 class="formstock_box_h6">Product Photos</h6>
														
														<p class="formstock_box_p">
															<b>Name:</b> <?php echo $product_name; ?>
														</p>
														
														
															
														<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
															<div class="stockform_lft"><!-- Begin: stockform_lft -->
																<div class="row">
																	
																	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
																		
																		
																		<!--div class="shopfrm_box" style="padding-bottom:2px;"><!-- Begin: shopfrm_box -->
																			
																			<?php
																				/*$pimg1 = explode(',',$product_image);
																				$pi1 = 1;
																				
																				foreach($pimg1 as $pimg01){
																					
																					$pi1++;
																					$img_old = $pimg01;
																			?>
																			
																			<!--div class="fileUpload">
																				
																				<span class="custom-span">
																					<i class="fa fa-camera"></i>
																				</span>
																				<p class="custom-para">Add a Image</p>
																				
																				<input type="file" id="files<?php echo $pi1; ?>" value="<?php echo $img_old; ?>" name="userfile[]" />
																				
																				<b id="imgclose<?php echo $pi1; ?>">
																					<i class="fa fa-times-circle"></i>
																				</b>
																				
																			</div-->
																			
																			<?php }*/ ?>
																			
																		<!--/div-->
																			
																			
																		<div class="shopfrm_box" style="padding-bottom:2px;"><!-- Begin: shopfrm_box -->	
																			
																			<?php
																				$pimg = explode(',',$product_image);
																					
																				for($pi=0;$pi<count($pimg);$pi++){
																					
																					// Check product Image NULL Or Not
																					if($product_image == NULL){
																						$imglocation = base_url()."assets/frontend/images/shops/default-img.jpg";
																					}else{
																						$sname = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shop_name))));
																						
																						$imglocation = base_url()."assets/frontend/images/shops/$sname/$pimg[$pi]";
																					}
																					
																					echo '<div class="fileUpload editp" style="padding:5px;height:120px;">';
																						echo '<img src="'.$imglocation.'" alt="'.$product_name.'" title="'.$product_name.'" />';

																					echo '</div>';
																					
																					if(count($pimg) >4){
																						break;
																					}
																					
																				}
																			?>
																			
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
														
														
													</div><!-- End: formstock_box -->
													<div class="clearfix"></div>
													
													<div style="margin-top:40px;" class="formstock_box"><!-- Begin: formstock_box -->
														
														<h6 class="formstock_box_h6">
															<i class="fa fa-th"></i> Listing details
														</h6>
														
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
																						<input type="text" name="product_name" id="product_name" placeholder="Enter product name..." class="form-control" value="<?php echo $product_name; ?>" />
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
																							
																							
																							<option <?php if($who_made == 'i_did'){echo 'selected';} ?> value="i_did">
																								I did
																							</option>
																							
																							<option <?php if($who_made == 'collective'){echo 'selected';} ?> value="collective">
																								A member of my shop
																							</option>
																							
																							<option <?php if($who_made == 'someone_else'){echo 'selected';} ?> value="someone_else">
																								Another company or person
																							</option>
																							
																						</optgroup>
																						
																					</select>
																					
																					
																					<select name="is_supply" id="is_supply" style="width:30%;float:left;margin-right:7px;" class="form-control">
																						<option>What is it?</option>
																						<optgroup label="Select a Maker">
																							
																							<option <?php if($is_supply == 'finished_product'){echo 'selected';} ?> value="finished_product">
																								A finished product
																							</option>
																							
																							<option <?php if($is_supply == 'a_supply_tool_to_make'){echo 'selected';} ?> value="a_supply_tool_to_make">
																								A supply or tool to make things
																							</option>
																							
																						</optgroup>
																						
																					</select>
																					
																					
																					<select name="when_made" id="when_made" style="width:30%;float:left;margin-right:7px;" class="form-control">
																						<option value="">When was it made?</option>
																						
																						<option selected value="<?php echo $when_made; ?>">
																							<?php
																								echo ucfirst(str_replace('_', ' - ', $when_made))
																							?>
																						</option>
																						
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
																							
																							<option <?php if($value101->category_id == $product_category_id){ echo 'selected'; } ?> value="<?php echo $value101->category_id; ?>">
																							
																								<?php echo $value101->category_name; ?>
																								
																							</option>
																							
																							
																							<?php } ?>
																							
																						</optgroup>
																						
																						<?php } ?>
																						
																					</select>
																					
																					
																					<select name="product_sub_category_id" id="subcategory" style="width:30%;float:left;margin-right:7px;" class="form-control">
																					
																						<option>---Subcategory---</option>
																						
																						<?php
																							$subCat = $this->db->query("select sub_category_name from mega_subcategory where sub_category_id=$product_sub_category_id");
																							
																							extract($subCat->row_array());
																							if($subCat->num_rows() >0){
																						?>
																						<option selected value="<?php echo $product_sub_category_id; ?>"><?php echo $sub_category_name; ?></option>
																						
																						<?php } ?>
																					</select>
																					
																					
																					<select name="product_sub_category_lev2_id" id="subcategorylev2" style="width:30%;float:left;margin-right:7px;" class="form-control">
																					
																						<option>---SubcategoryLevel2---</option>
																						
																						<?php
																							$subCatLev2 = $this->db->query("select sub_category_lev2_name from mega_subcategorylevel2 where sub_category_lev2_id=$product_sub_category_lev2_id");
																							
																							extract($subCatLev2->row_array());
																							if($subCatLev2->num_rows() >0){
																						?>
																						
																						<option selected value="<?php echo $product_sub_category_lev2_id; ?>">
																							<?php echo $sub_category_lev2_name; ?>
																						</option>
																						
																						<?php } ?>
																						
																					</select>
																					
																					
																				</div>
																				
																			  </div>
																			  <div class="clearfix"></div>
																			  
																			  
																			  
																			  <div style="margin-top:15px" class="form-group">
																					
																					<label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">
																						Price($)<span style="color:#FF3A3D"> *</span>
																					</label>
																					
																					<div class="col-sm-3">
																						<input type="text" name="product_price" id="product_price" placeholder="Enter price..." class="form-control" value="<?php echo $product_price; ?>" />
																					</div>
																					
																			  </div>
																			  
																			  <div class="clearfix"></div>
																			  
																			  
																			  <div style="margin-top:15px" class="form-group">
																				
																				<label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">
																					Quantity<span style="color:#FF3A3D">*</span>
																				</label>
																				
																				<div class="col-sm-3">
																				  
																				  <input type="text" name="product_stock" placeholder="Enter quantity..." class="form-control" value="<?php echo $product_stock; ?>" />
																				  
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
																						Item details  <span style="color:#FF3A3D"> *</span>
																					</label>
																					
																					<div class="col-sm-9">
																						
																						<textarea name="product_item_details" id="product_item_details" placeholder="Item details..." class="form-control" cols="7" rows="15"><?php echo $product_item_details; ?></textarea>
																						
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
																									
																									<option <?php if($valueSection->sectionid == $productsection){ echo 'selected="selected"'; }; ?> value="<?php echo $valueSection->sectionid; ?>">
																										<?php echo $valueSection->sectionname; ?>
																									</option>
																									
																									<?php } ?>
																									
																							</optgroup>
																								
																							<!--optgroup label="Couldn't find a section?">
																								<option value="add" id="create-user" data-target="#myModal3" data-toggle="modal">
																									Add a section
																								</option>
																							</optgroup-->
																								
																						</select>
																						
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
																<p class="stockform_rht_p">Include keywords that buyers would use to search for your item.<br><br>Learn more about what types of items are allowed on ctSell.<br><br>Factor in the costs of materials and labor, plus any related business expenses.<br><br>For quantities greater than one, this listing will renew automatically until it sells out. You’ll be charged a $0.20 USD listing fee each time.<br><br><br><br><br><br>Each renewal lasts for four months or until the listing sells out. Get more details on auto-renewing.<br><br><br><br><br><br><br><br> </p>
															</div><!-- End: stockform_rht -->
														</div>
													</div><!-- End: formstock_box -->
													<div class="clearfix"></div>
													
													
													
<div style="margin-top:40px;" class="formstock_box"><!-- Begin: formstock_box -->
<h6 class="formstock_box_h6">Product Variations</h6>

<p class="formstock_box_p">
Add available options, such as color or size. If you add variations, buyers must select them before adding your items to their cart.
</p>

<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
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
										
										<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
										<script type="text/javascript">
											$(function () {
												$("#btnAdd").bind("click", function () {
													var div = $("<div />");
													div.html(GetDynamicTextBox(""));
													$("#TextBoxContainer").append(div);
												});
												$("#btnGet").bind("click", function () {
													var values = "";
													$("input[name=DynamicTextBox]").each(function () {
														values += $(this).val() + "\n";
													});
													alert(values);
												});
												$("body").on("click", ".remove", function () {
													$(this).closest("div").remove();
												});
											});
											function GetDynamicTextBox(value) {
												
												return '<select name="option_group_id[]" id="option_group_id" class="form-control" style="width:40%;float:left;margin:5px;"><option value="">Add a variation</option><optgroup label="Select a property"><?php
													$optsql = $this->db->query("select * from mega_optiongroups");$optresult = $optsql->result();foreach($optresult as $viewresult){ ?><option value="<?php echo $viewresult->optiongroup_id; ?>"><?php echo $viewresult->option_group_name; ?></option><?php } ?></optgroup></select><input name="option_details[]" class="form-control" placeholder="Option details" id="option_details" type="text" style="width:40%; margin:5px;" value = "' + value + '" />&nbsp;' +
												'<button type="button" value="Remove" class="remove btn btn-danger rmButton"><i class="fa fa-remove"></i></button>'
												
											}
										</script>
										
										<!--button id="btnAdd" class="btn btn-primary" type="button">
											<i class="fa fa-plus"></i>
											Add New Option
										</button-->
										
										<div class="clearfix"></div>
										
										
										<?php
											$pOptsql = $this->db->query("select * from mega_productoptions where product_id=$productid GROUP BY option_group_id");
											$pOptresult = $pOptsql->result();
											
											if($pOptsql->num_rows() >0){
												
											foreach($pOptresult as $viewOptresult){
										?>
										
										<div id="TextBoxContainer" style="margin-top:10px;">
											
											<select name="option_group_id[]" id="option_group_id" class="form-control" style="width:40%;float:left; margin:5px;">
												
												<option value="">Add a variation</option>
												
												<optgroup label="Select a property">
													
													<?php
														$optsql = $this->db->query("select * from mega_optiongroups");
														$optresult = $optsql->result();
														
														foreach($optresult as $viewresult){
													?>
													
													<option <?php if($viewresult->optiongroup_id == $viewOptresult->option_group_id){echo 'selected';} ?> value="<?php echo $viewresult->optiongroup_id; ?>">
														<?php echo $viewresult->option_group_name; ?>
													</option>
													
													<?php } ?>
												
												</optgroup>
												
											</select>
											
											<input name="option_details[]" class="form-control" placeholder="Option details" id="option_details" type="text" style="width:40%; margin:5px;" value="<?php echo $viewOptresult->option_details; ?>" />
											
											<button type="button" value="Remove" class="remove btn btn-danger rmButton" disabled >
												<i class="fa fa-remove"></i>
											</button>
											<!--Textboxes will be added here -->
											
										</div>
										
										<?php } }else{ ?>
										
											<h5 class="text-danger">No Variations found!</h5>
										
										<?php } ?>
										
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
																	  
																	  <?php
																		$shippingDsql = $this->db->query("select * from mega_shippingdetails where productid=$productid and shopid=$shopid GROUP BY productid");
																		
																		$processing_time 					= '';
																		$shipping_cost_by_itself 			= '';
																		$shipping_cost_with_another_items 	= '';
																		
																		if($shippingDsql->num_rows() >0){
																			extract($shippingDsql->row_array());
																		}
																	?>
																	
																	<div style="margin-top:15px;" class="form-group">
																		<label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">
																			Processing time
																		</label>
																		
																		<div class="col-sm-9">
																			
																			<select name="processing_time" required="required" id="processing_time" style="width:70%;float:left;margin-right:7px;" class="form-control">
																				
																				<option value="">Ready to ship in...</option>
																				
																				
																				<option <?php if(!empty($processing_time)){echo 'selected';} ?> value="<?php echo $processing_time; ?>">
																				<?php echo $processing_time; ?>
																				</option>
																				
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
																				
																				<div class="col-xs-5 p-xs-0">
																					
																					<input type="text" onfocus="this.blur();" name="ship_to" id="ship_to" data-field="primary_cost" value="United States" class="form-control" style="padding-left: 48px" />
																					
																				</div>
																				
																				<div class="col-xs-3 p-xs-0">
																					
																					<input type="text" required="required" name="shipping_cost_by_itself" id="shipping_cost_by_itself" data-field="primary_cost" class="form-control" style="padding-left: 48px" value="<?php echo $shipping_cost_by_itself; ?>" />USD
																						
																				</div>
																				
																				<div class="col-xs-4 p-xs-0">
																					
																					<input type="text" required="required" name="shipping_cost_with_another_items" id="shipping_cost_with_another_items" data-field="secondary_cost" class="form-control" style="padding-left: 48px" value="<?php echo $shipping_cost_with_another_items; ?>" />USD
																					
																				</div>
																				
																			</div>
																			
																		</div>
																		
																	  </div>
																	  <div class="clearfix"></div>
																	  
																	  
																	
																	<div style="margin-top:15px;" class="form-group">
																		<label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">
																			&nbsp;
																		</label>
																		
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
																  
																  <input type="text" name="tags" placeholder="Shape, color, style, function, etc." class="form-control" value="<?php echo $tags; ?>" />
																  
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
																  
																  <input type="text" name="materials" placeholder="Ingredients, components, etc." class="form-control" value="<?php echo $materials; ?>" />
																  
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


																	  
																	
											<div style="margin-top:15px;" class="form-group">
												<label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">
													Product Status
												</label>
												
												<div class="col-sm-9">
													
													<div class="col-group panel-heading p-xs-2 bb-xs-0 hide-xs">
														
														<div class="input-group">
															
															<?php if($bill_paid_or_not == 1){ ?>
															<label class="radio-inline">
																<input type="radio" <?php if($product_live == 'Active'){ echo 'checked'; } ?> name="product_live" id="product_live" value="Active" /> Active
															</label>
															<?php } ?>
															
															<label class="radio-inline">
																<input type="radio"  <?php if($product_live == 'Inactive'){ echo 'checked'; } ?> name="product_live" id="product_live" value="Inactive" /> Inactive
															</label>
															
															
														</div>
														
													</div>
													
												</div>
												
											  </div>
											  <div class="clearfix"></div>						
																		
																		
																		
									<div class="col-lg-12 col-md-12 col-sm-12">
										
										<div style="display: block; height: 50px; left: 207px; margin: 20px 0; position: relative;top: 23px;">
										
											<button class="btn btn-primary pull-left" id="productlisting" type="submit">
												Update records
											</button>
											
										</div>
										
									</div>
													

												</div>
												
												
												
												</form>
												
												
											</div><!-- End: shoppre_box -->
										</div>
										
										
										
										
										
										

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
