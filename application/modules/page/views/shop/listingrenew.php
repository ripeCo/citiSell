<?php
	$this->load->view('../../front-templates/head.php');
	$this->load->view('../../front-templates/header.php');
	$this->load->view('../../front-templates/navigation.php');
?>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<style>
	
	.dp {
	  border: 1px solid #c3c3c3;
	  border-radius: 4%;
	  display: inline-block;
	  float: left;
	  height: auto;
	  margin: 10px;
	  min-height: 270px;
	  padding: 10px;
	  width: 300px;
	}
	.dp:hover {
		  background: #e5e5e5 none repeat scroll 0 0;
		  border: 1px solid #c3c3c3;
		  border-radius: 4%;
		  display: inline-block;
		  float: left;
		  height: auto;
		  margin: 10px;
		  min-height: 270px;
		  padding: 10px;
		  width: 300px;
		}
		
	#filter > b {
		text-transform: capitalize;
	}
	
	#filter {
	  background: #ddd none repeat scroll 0 0;
	  border-radius: 10px;
	}
	.dp b {
		display: inline-block;
		text-transform: capitalize;
		width: 106px;
	}
	
	span.offer {
		background: #a60cf3 none repeat scroll 0 0;
		border: 1px solid #a60cf3;
		border-radius: 32%;
		color: #fff;
		float: right;
		font-size: 12px;
		font-style: italic;
		font-weight: bold;
		height: 27px;
		padding: 5px 10px;
		position: relative;
		right: -13px;
		top: -7px;
		transform: rotate(-30deg);
	}
	
	span.offer:hover {
		background: #a60cf3 none repeat scroll 0 0;
		border: 1px solid #a60cf3;
		border-radius: 32%;
		color: #fff;
		float: right;
		font-size: 12px;
		font-style: italic;
		font-weight: bold;
		height: 27px;
		padding: 5px 10px;
		position: relative;
		right: -13px;
		top: -7px;
		transform: rotate(-50deg);
	}
	
	.spCart {
	  padding: 2px 18px !important;
	}
	
	.btn-warning {
		background-color: #7ac142;
		border-color: #7ac142;
		color: #fff;
	}
	
	.p {
		background: #ddd none repeat scroll 0 0;
		padding: 7px 3px;
	}
	
</style>

<div id="inner_page"><!-- Begin: inner_page -->
    <div class="container">
    
        <div class="row">
            <div class="user_hi"><!-- Begin: user_hi -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                
                
                    <div class="user_name"><!-- Begin: user_name -->
                        
						<h3 class="user_name_h3 pull-left">
							
							<i class="fa fa-th"></i>
							
							<?php echo $breadcrumb; ?>
							
							<span class="text-primary">
								<?php
									$sid = $this->session->userdata('shopid');
									
									$numofproducts = $this->db->query("select * from mega_products where shopid=$sid and product_renew=0");
									$numofListing = $numofproducts->num_rows();
									
									echo '('.$numofListing.')';
								?>
							</span>
							
							<a class="btn btn-success" style="color:#333 !important;" type="button" data-toggle="modal" data-target="#myModal3" href="">
								Click here for Items Renew
							</a>
							
						</h3>
						
                    </div><!-- End: user_name -->
					
					
					
                    <div style="color:#F00">
						
						<?php 
							
							if(isset($message)){
								
								echo $message; $redurl = base_url().'page/yourshop/listingrenew';
								$this->output->set_header('refresh:3; url='.$redurl);
								
							} 
							
						?>
						
					</div>
					
                    
                </div>  
            </div><!-- End: ourpic4_you -->
        </div>
		
		
		<!-- Products Renewd BEING model -->
		
		<div class="contact_modal">
			<!-- Modal -->
			<div class="modal fade bs-example-modal-md" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  
					<div class="modal-dialog0 modal-md" role="document">
					
						<div class="modal-content">
						
						  <div class="modal-header">
							
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							
							<h4 class="profile_contact_h40" id="myModalLabel">
							
								<i class="fa fa-calculator"></i> You are want to renew <input type="text" style="text-align:center;border:none;width: 25px;" onfocus="this.blur();" id="edit-count-checked-checkboxes" value="<?php echo $numofListing; ?>" size="1" class="form-text" /> item your listing?
								
								<!--input type="text" id="edit-count-checked-checkboxes" name="count-checked-checkboxes" value="0" size="60" maxlength="50" class="form-text required" /-->
								
								
							</h4>
							
							<p class="profile_contact_p">
							
								By clicking “Renew” you agree to pay the nonrefundable listing fee below, and the new expiration date will be four months from today.
							
							</p>
							
						  </div>
						  
						<form id="devel-generate-content-form" method="post" action="<?php echo base_url(); ?>page/yourshop/listingrenewnow">
						  
						  <div class="modal-body">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="profile_contact">
										
										<div class="form-group">
											
											<table class="table table-bordered renewallistingtable">
											
												<tr>
													<th>
														 <p><label><input type="checkbox" checked="checked" onfocus="this.blur();" id="checkAll"/> ALL</label></p>
													</th>
													<th width="15%">Image</th>
													<th width="60%">Product Name</th>
													<th width="15%">Quantity</th>
												</tr>
											
											<?php
												
												//$listingRenewalProducts = $this->db->query("select * from mega_products where shopid=$sid AND product_renew=0 order by productid DESC");
												$listingRenewalProducts = $this->db->query("select * from mega_products where shopid=$sid AND product_renew=0");
												$getFetch = $listingRenewalProducts->result();
												
												$defaultNumber = $listingRenewalProducts->num_rows(); // Renewal product numbers
												
												foreach($getFetch as $val){ 
												
											?>
											
											<tr>
												<td align="center">
													<input type="checkbox" checked="checked" id="renewalpid" name="renewalpid[]" value="<?php echo $val->productid; ?>" />
												</td>
												
												<td align="center">
													
													<?php
														$ppimg = explode(',',$val->product_image);
															
														for($ppi=0;$ppi< count($ppimg);$ppi++){
															
															// Check product Image NULL Or Not
															if($val->product_image == NULL){
																$pimglocation = base_url()."assets/frontend/images/shops/default-img.jpg";
															}else{
																$sname1 = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $this->session->userdata('shopname')))));
																
																$pimglocation = base_url()."assets/frontend/images/shops/$sname1/$ppimg[$ppi]";
															}
															
															echo '<img width="100" height="70" class="img-responsive img-thumbnail" src="'.$pimglocation.'" alt="'.$val->product_name.'" />';
															
															break;
														}
													?>
													
												</td>
												
												<td align="left">
													
													<?php echo $val->product_name; ?>
													
													<input type="hidden" name="descriptions[]" value="<?php echo $val->product_name; ?>" />
													
													<input type="hidden" name="renewal_amount[]" value="<?php echo listingfee(); ?>" />
													
												</td>
												
												<td align="center">
													
													<input style="text-align:center; width:100%;" class="form-control" size="10" type="text" name="quantity[]" value="<?php echo $val->product_stock; ?>" />
													
												</td>
												
											</tr>
											
											
											<?php } ?>
											
											</table>
											
										</div>
										
										
									</div>
								</div>
							</div>
						  </div>
						  
							<?php
									
								// Get product_renewal Months from mega_settings
								$getProductRenewalMonth101 = $this->db->query("select * from mega_settings");
								extract($getProductRenewalMonth101->row_array());
								
							?>
						  
						  <input type="hidden" name="productrenewal" value="<?php echo $product_renewal; ?>" />
						  
							<div class="modal-footer">
						  
						  
							<p class="text-right" style="position:relative; right: 90px;"> New expiration date will be - <b> <?php echo newexpiredate($product_renewal); ?>. </b> </p>
							
							<h4 class="shippingM000">
								<span>
									
									Total 
										(<input type="text" style="text-align:right; border:none; width: 65px;" onfocus="this.blur();" id="totlItems" value="<?php echo $numofListing; ?>" size="1" class="form-text" /> X $<?php echo $listing_cost; ?> )
									
								</span> =  
								<b style="color:#449D44;">
									
									$
									<input type="text" name="totalfees" style="text-align:left; border:none; width: 60px;" onfocus="this.blur();" id="totl" value="<?php echo number_format($numofListing * $listing_cost,2); ?>" size="1" class="form-text" />
									
								</b>
							</h4>
							
							<h4>&nbsp;</h4>
							
							<!--button type="button" class="btn btn-primary">Send</button-->
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
							
							<button type="submit" class="btn btn-success">Renew</button>
							
						  </div>
						  
						  
						  </form>
						  
						</div>
					</div>
			  
			</div>
		</div>
		
		<!-- Products Renewd END model -->
		
		
        <div class="clearfix"></div>


        <div class="row">
            <div class="ourpic4_you"><!-- Begin: ourpic4_you -->
            
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="ourpic4u_box"><!-- Begin: ourpic4u_box -->
                        <!--img src="<?php //echo base_url(); ?>assets/frontend/images/shops/listingmanager.png" class="img-responsive" alt="listing manager inner banner" /-->
                    </div><!-- End: ourpic4u_box -->
                </div> 
                
            </div><!-- End: ourpic4_you -->
        </div>
        <div class="clearfix"></div>
		
		
		
		
        
        <div class="row">
        	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="shopur_latest"><!-- Begin: shopur_latest -->
                    
                    <div class="row">
                        <div class="following_interaction"><!-- Begin: following_interaction -->
                        
                            <!--div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							
                                <div class="following_left" id="Products"></div>
								
                            </div-->
							
							<!--div class="col-lg-8 col-md-8 col-sm-8" id="Products"></div-->
                            
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="following_right"><!-- Begin: following_right -->
                                
                                	<div class="row">
                                    
                                       
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="ctsell_app02"><!-- Begin: ctsell_app02 -->
                                                
                                                <h3 class="ctsell_app02_h3"><strong>Product Filtering</strong></h3>
                                                
                                                <div class="ctsell_items" id="filter"><!-- Begin: ctsell_items -->
                                                    <?php
														$table_name = 'mega_products';
														
														$sqll = $this->db->query("SHOW COLUMNS from $table_name where Field NOT LIKE 'productid' AND Field NOT LIKE 'product_suk' AND Field NOT LIKE 'product_name' AND Field NOT LIKE 'who_made' AND Field NOT LIKE 'is_supply' AND Field NOT LIKE 'when_made' AND Field NOT LIKE 'product_price' AND Field NOT LIKE 'product_item_details' AND Field NOT LIKE 'product_overview' AND Field NOT LIKE 'product_shopping_policy' AND Field NOT LIKE 'product_image' AND Field NOT LIKE 'shopid' AND Field NOT LIKE 'product_category_id' AND Field NOT LIKE 'product_sub_category_id' AND Field NOT LIKE 'product_sub_category_lev2_id' AND Field NOT LIKE 'product_update_date' AND Field NOT LIKE 'product_update_date' AND Field NOT LIKE 'bill_paid_or_not' AND Field NOT LIKE 'product_ratings' AND Field NOT LIKE 'product_favourites' AND Field NOT LIKE 'product_location' AND Field NOT LIKE 'productsection' AND Field NOT LIKE 'tags' AND Field NOT LIKE 'materials' AND Field NOT LIKE 'product_live' AND Field NOT LIKE 'product_renew'");
														
														$obj = $sqll->result();
														
														$shopid = $this->session->userdata('shopid');
														
														foreach($obj as $viewws)
														{
															//$filter_id=$obj->Field;
															echo "<b><i class='fa fa-caret-right'></i> {$viewws->Field}</b>:<br/>";
															
															$filters = $this->db->query("SELECT distinct {$viewws->Field} FROM $table_name where shopid=$shopid and bill_paid_or_not=0");
															$obj1 = $filters->result();
																foreach($obj1 as $viewss)
																{
																	
																		//$filter_name=$obj1->{$obj->Field};
																		echo "<input type='checkbox' id='{$viewws->Field}' name='{$viewss->{$viewws->Field}}'> {$viewss->{$viewws->Field}}<br/>";
																		
																}
															echo "<br/>";
														}
													?>
                                                </div><!-- End: ctsell_items -->
                                                
                                                
                                                                                            
                                            </div><!-- End: ctsell_app02 -->
                                        </div>
                                        
                                    </div>
                                    
                                </div><!-- End: following_right -->
                            </div>
							
							<div class="col-lg-9 col-md-9 col-sm-9" id="products"></div>
                            <?php //echo $this->session->userdata('shopid'); ?>
                        </div><!-- End: following_interaction -->
                    </div>
					
					

                </div><!-- End: ourpic4_you -->
            </div>
        </div>
        
    </div>
</div><!-- End: inner_page -->



		<!-- Products Renewd BEING model -->
		
		<div class="contact_modal">
			<!-- Modal -->
			<div class="modal fade bs-example-modal-md" id="myModal003" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog modal-md" role="document">
				<div class="modal-content">
				
				  <div class="modal-header">
					
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					
					<h4 class="profile_contact_h40" id="myModalLabel">
					
						<i class="fa fa-calculator"></i> You are about to renew 1 listing
						
					</h4>
					
					<p class="profile_contact_p">
					
						By clicking “Renew” you agree to pay the nonrefundable listing fee below, and the new expiration date will be four months from today.
					
					</p>
					
				  </div>
				  
				  <form method="post" action="<?php echo base_url(); ?>page/yourshop/productrenew">
				  
				  <div class="modal-body">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="profile_contact">
								
								<div class="form-group">
									
									<h4 class="">
										
										<span class="ppnametitle">
											Product name
										</span>
										
										<span class="ppquantitytitle">
											Quantity00
										</span>
										
										
									</h4>
									
									<div class="clearfix"></div>
									
									<?php 
										
										for($i=0; $i<1; $i++){
											
									?>
									
									<h4 class="prdname">
										
										<span class="ppname">
											
											<input type="checkbox" name="productid" value="<?php echo $i; ?>" />
											
											<input type="text" name="userid" value="<?php echo $this->session->userdata('userid'); ?>" />
											<input type="text" name="shopid" value="<?php echo $this->session->userdata('shopid'); ?>" />
											<input type="text" name="billdate" value="<?php echo date('Y-m-d H:i:s', bd_time()); ?>" />
											<input type="text" name="billmonth" value="<?php echo date('F Y'); ?>" />
											<input type="text" name="billyear" value="<?php echo date('Y'); ?>" />
											
											&nbsp;Beautiful silver rhinestone Love necklace, Beautiful and one kind of perfect Mothers day gift ,
											
										</span>
										
										<span class="ppquantity">
										
											<input type="text" name="pquantity" value="17" />
											
										</span>
										
									</h4>
									
									<?php } ?>
									
									
									<p class="text-right"> New expiration date  <b> October 18, 2016 </b> </p>
									
									
									<h4 class="shippingM000">
										<span>
											Total (1 X $0.20)
										</span> =  
										<b style="color:#449D44;">$<?php echo number_format(1 * 0.20,2); ?></b> 
									</h4>
									
								</div>
								
								
							</div>
						</div>
					</div>
				  </div>
				  
				  <div class="modal-footer">
					<!--button type="button" class="btn btn-primary">Send</button-->
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					
					<button type="submit" class="btn btn-success">Renew</button>
					
				  </div>
				  
				  
				  </form>
				  
				</div>
			  </div>
			</div>
		</div>
		
		<!-- Single Products Renewd END model -->


<?php
	
	// Shop product will be automatic update when will expire
	
	/*$shopid = $this->session->userdata('shopid');
	$sqlpp = $this->db->query("select * from mega_products");
	$sqlppresult = $sqlpp->result();
	
	foreach($sqlppresult as $vvview){
		
		$date 			= date('Y-m-d H:i:s', bd_time());
		
		if($date >= $vvview->product_expire_date){
			
			$pid = $vvview->productid;
			$this->db->query("update mega_products set product_update_date='$date',bill_paid_or_not=0, product_live='Inactive', product_renew=0 where productid=$pid");
		}
		
	}*/
	
?>


	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script>
		var opts;
		var main_opts;

		  function makeTable(data){
		   var tbl_body = "";
			  $.each(data, function() {
				
				var tbl_row = "";
				$.each(this, function(k , v) {
					if(k=='product_image'){
						
						var exploded = v.split(',');
						
						if(v==''){
							var imgg = 'default-img.jpg';
						}else{
							var imgg = exploded[0];
						}
						//default-img.jpg
						
						var im = '<img src="<?php echo base_url(); ?>assets/frontend/images/shops/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $this->session->userdata('shopname'))))); ?>/'+imgg+'" alt="ctSell shop product image" />';
						
						tbl_row += "<div id='pimg'>"+im+"</div>";
					}
				   
				   
					if(k=='product_name'){
						var pname = v;
						var ptitle = pname.substr(0, 50);
						tbl_row += "<div class='pname'>"+ptitle+"</div>";
					}
				   
				   
					/*if(k=='productid'){
						tbl_row += "<div class='pedit'><a style='color:#333 !important;' type='button' data-toggle='modal' data-target='#myModal003' class='btn btn-success' href='<?php echo base_url(); ?>page/yourshop/renewproduct/"+v+"' title='Renew product'><i class='fa fa-pencil' aria-hidden='true'></i> Renew</a></div>";
					}*/
				   
				   
					if(k=='productid'){
						tbl_row += "<div class='pedit'><a style='color:#333 !important;' type='button' class='btn btn-success' href='' title='Renew product'><i class='fa fa-times-circle' aria-hidden='true'></i> Expired</a></div>";
					}
					
				   
					if(k=='product_price'){
						tbl_row += "<div class='pcost'>$ "+v+"</div>";
					}
				   
					
				   
					if(k=='product_expire_date'){
						
						var expd = '<?php echo date('Y-m-d H:i:s'); ?>';
						
						/*if(expd >= v){
							tbl_row += "<div class='prenew'><a class='btn btn-success' href='<?php echo base_url(); ?>page/yourshop/feepay' title='Active for listing fee pay'>Renew</a></div>";
						}*/
					}
					
					
					
					//tbl_row += "<div class='pedit'><a class='btn btn-primary' href='<?php echo base_url(); ?>page/yourshop/pedit' title='Listed product edit'>Edit</a></div>";
					
				   
					if(k=='product_live'){
						if(v=='Inactive'){
							tbl_row += "<div class='plive'>(Deactive)</div>";
						}else{
							tbl_row += "<div class='plive'>("+v+")</div>";
						}
					}
					
				   
					if(k=='product_stock'){
						tbl_row += "<div class='pinstock'><b>"+v+"</b> - In Stock</div>";
					}
				   
				   
					if(k=='product_expire_date'){
						tbl_row += "<div class='pexpire'>Expires - "+v+" </div>";
					}
				   
				})
				
				tbl_body += "<div class='col-lg-4 col-md-4 col-sm-4'><div class='areaa'>"+tbl_row+"</div></div>";
				
				/*var tbl_row = "";
				$.each(this, function(k , v) {
				   tbl_row += "<td>"+v+"</td>";
				})
				tbl_body += "<tr>"+tbl_row+"</tr>";*/              
			  })
			return tbl_body;
		  }

		  function getFilterOptions(){
			 opts = [];
			 main_opts = [];
			$checkboxes.each(function(){
			  if(this.checked){
				main_opts.push(this.id);
				opts.push(this.name);
			  }
			});
		  }

		  function update(){
			$.ajax({
			  type: "POST",
			  url: "<?php echo base_url(); ?>page/yourshop/shoplistingrenewview",
			  dataType : 'json',
			  cache: false,
			  data: {filterOpts: opts,filterMainOpts: main_opts,tableName: "mega_products"},
			  success: function(data){
				$('#products').html(makeTable(data));
				//$('#Products tbody').html(makeTable(data));
			  }
			});
		  }

		  var $checkboxes = $("input:checkbox");
		  $checkboxes.on("change", function(){
			getFilterOptions();
			update();
			});

		  update();
	</script>


<?php $this->load->view('../../front-templates/footer.php'); ?>
