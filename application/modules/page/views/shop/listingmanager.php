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
							
							Product Listing Manager
							
							<span class="text-primary">
								<?php
									$sid = $this->session->userdata('shopid');
									
									$numofproducts = $this->db->query("select * from mega_products where shopid=$sid");
									echo '('.$numofproducts->num_rows().')';
								?>
							</span>
						</h3>
						
                    </div><!-- End: user_name -->
					
					
                    <?php
				 
						// Success Or Failor check
						if(isset($success_msg)){
							
							echo '<h4 id="msg" class="text-success text-center"> <i class="fa fa-check-circle"></i> '.$success_msg.' </h4>';
							$redurl = base_url().'page/user/userarea';
							$this->output->set_header('refresh:3; url='.$redurl);
							
						}else if(isset($error_msg)){
							
							echo '<h4 class="text-danger text-center"> <i class="fa fa-exclamation-triangle"></i> '.$error_msg.' </h4>';
							
						}
						
					?>
                    
                </div>  
            </div><!-- End: ourpic4_you -->
        </div>
        <div class="clearfix"></div>


        <div class="row">
            <div class="ourpic4_you"><!-- Begin: ourpic4_you -->
            
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="ourpic4u_box"><!-- Begin: ourpic4u_box -->
                        <!--img src="<?php echo base_url(); ?>assets/frontend/images/shops/listingmanager.png" class="img-responsive" alt="listing manager inner banner" /-->
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
														
														$sqll = $this->db->query("SHOW COLUMNS from $table_name where Field NOT LIKE 'productid' AND Field NOT LIKE 'product_suk' AND Field NOT LIKE 'product_name' AND Field NOT LIKE 'who_made' AND Field NOT LIKE 'is_supply' AND Field NOT LIKE 'when_made' AND Field NOT LIKE 'product_price' AND Field NOT LIKE 'product_item_details' AND Field NOT LIKE 'product_overview' AND Field NOT LIKE 'product_shopping_policy' AND Field NOT LIKE 'product_image' AND Field NOT LIKE 'shopid' AND Field NOT LIKE 'product_category_id' AND Field NOT LIKE 'product_sub_category_id' AND Field NOT LIKE 'product_sub_category_lev2_id' AND Field NOT LIKE 'product_update_date' AND Field NOT LIKE 'product_update_date' AND Field NOT LIKE 'bill_paid_or_not' AND Field NOT LIKE 'product_ratings' AND Field NOT LIKE 'product_favourites' AND Field NOT LIKE 'product_location' AND Field NOT LIKE 'productsection' AND Field NOT LIKE 'tags' AND Field NOT LIKE 'materials' AND Field NOT LIKE 'product_renew'");
														
														$obj = $sqll->result();
														
														$shopid = $this->session->userdata('shopid');
														
														foreach($obj as $viewws)
														{
															//$filter_id=$obj->Field;
															echo "<b><i class='fa fa-caret-right'></i> {$viewws->Field}</b>:<br/>";
															
															$filters = $this->db->query("SELECT distinct {$viewws->Field} FROM $table_name where shopid=$shopid");
															$obj1 = $filters->result();
																foreach($obj1 as $viewss)
																{
																	
																		//$filter_name=$obj1->{$obj->Field};
																		echo "<input type='checkbox' id='{$viewws->Field}' name='{$viewss->{$viewws->Field}}'> {$viewss->{$viewws->Field}}<br/>";
																		
																		
																		if($viewws->Field === 'product_live' and $viewss->{$viewws->Field} !== 'Active'){
																			
																			echo "<input type='checkbox' id='{$viewws->Field}' name='Active'> Active<br/>";
																			break;
																		}
																		
																		if($viewws->Field === 'product_live' and $viewss->{$viewws->Field} !== 'Inactive'){
																			
																			echo "<input type='checkbox' id='{$viewws->Field}' name='Inactive'> Inactive<br/>";
																			break;
																		}
																	
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


<?php
	
	// Shop product will be automatic update when will expire
	
	/*$shopid = $this->session->userdata('shopid');
	$sqlpp = $this->db->query("select * from mega_products");
	$sqlppresult = $sqlpp->result();
	
	foreach($sqlppresult as $vvview){
		
		$date 			= date('Y-m-d H:i:s', bd_time());
		
		if($date >= $vvview->product_expire_date){
			
			$pid = $vvview->productid;
			$this->db->query("update mega_products set product_update_date='$date',bill_paid_or_not=0,product_live='Inactive',product_renew=0 where productid=$pid");
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
				   
				   
					if(k=='productid'){
						tbl_row += "<div class='pedit'><a class='btn btn-primary' href='<?php echo base_url(); ?>page/yourshop/peditpage/"+v+"' title='Update product'><i class='fa fa-pencil' aria-hidden='true'></i> Edit</a></div>";
					}
					
				   
					if(k=='product_price'){
						tbl_row += "<div class='pcost'>$ "+v+"</div>";
					}
				   
					
				   
					if(k=='product_renew'){
						
						//var expd = '<?php echo date('Y-m-d H:i:s'); ?>';
						
						if(v == 0 ){
							tbl_row += "<div class='prenew'><a class='btn btn-success' href='<?php echo base_url(); ?>page/yourshop/listingrenew' title='Listed  Product Renew'>Renew</a></div>";
						}
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
			  url: "<?php echo base_url(); ?>page/yourshop/listingviews",
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
