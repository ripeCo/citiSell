<?php
	$this->load->view('../../front-templates/head.php');
	$this->load->view('../../front-templates/header.php');
	$this->load->view('../../front-templates/navigation.php');
	
	if( $this->session->userdata('isLogin') == TRUE){
		//$shopid 				= $this->session->userdata('shopopen');
		$shopid 				= $this->uri->segment(4);
		$userid 				= $this->session->userdata('userid');
		
		$sqlshopOwner = $this->db->query("select display_name,user_picture,user_city,user_country from mega_users where shopopen=$shopid");
		$sqlshopfetchOwner = $sqlshopOwner->row_array();
		extract($sqlshopfetchOwner);
		
	}else{
		if($this->uri->segment(4) !== NULL){
			$shopid 	= $this->uri->segment(4);
		}else{ $shopid = 28; }
		
		$sqlshopOwner = $this->db->query("select display_name,user_picture,user_city,user_country from mega_users where shopopen=$shopid");
		$sqlshopfetchOwner = $sqlshopOwner->row_array();
		extract($sqlshopfetchOwner);
		
	}
	
	$sqlshop = $this->db->query("select * from mega_shops where shopid=$shopid");
	$sqlshopfetch = $sqlshop->row_array();
	extract($sqlshopfetch);
	
?>

<div id="inner_page"><!-- Begin: inner_page -->
    <div class="container">
    
        
		<div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="details_top" style="border-bottom:1px solid #c1c1c1; padding:10px 0 0 10px;margin-bottom:0px;"><!-- Begin: details_top -->
                	<div class="row">
                    
                    	<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                            <div class="dt_lft"><!-- Begin: dt_lft -->
                            	<div class="row">
								
								<span class="pull-center text-warning" style="display: block; font-size: 33px; text-align: right; color:#FF1B2D;font-weight:bold;margin-right: 14px;">
									
									<?php
										if($vacationmode == 'Enabled'){
											echo 'Shopper already gone to vacation!';
										}
									?>
									
								</span>
								
								<span class="pull-center text-warning" style="display: block; font-size: 33px; text-align: right; color:#FF1B2D;font-weight:bold;margin-right: 14px;">
																
									
									
									<?php
										if($shop_status == 'Suspended'){
											echo '<i class="fa fa-sign-out" aria-hidden="true"></i> This shop currently suspended!';
										}
									?>
									
								</span>
								
                                	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <div class="dtl_photo"><!-- Begin: dtl_photo -->
                                        	
											<?php
												if( $shoplogo !== NULL ){
													$shoplog = $shoplogo;
													$sname = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shop_name))));
											?>
											
											<img src="<?php echo base_url(); ?>assets/frontend/images/shops/<?php echo $sname.'/'.$shoplog; ?>" class="img-responsive img-thumbnail" alt="Shop Logo" />
											
											<?php }else{ ?>
											
											<img src="<?php echo base_url(); ?>assets/frontend/images/shops/nologo.jpg" class="img-responsive img-thumbnail" alt="Shop Logo" />
											
											<?php } ?>
											
                                        </div><!-- End: dtl_photo -->
                                    </div>
                                    
                                	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                        <div class="dtl_txt"><!-- Begin: dtl_txt -->
                                        	
											<h6 class="dtl_txt_h6">
												
												<a style="color: #f46000; display: inline-block; font-family: arial; font-size: 30px; font-weight: bold; margin-bottom: 9px;" href="<?php echo base_url(); ?>page/yourshop/viewshop/<?php echo $shopid; ?>">
													
													<?php echo $shop_name; ?>
													
												</a>
												
											</h6>
											
											<h5><?php echo ucfirst($shoptitle); ?></h5>
											
											<h5>
												<span class="shopmap-since">
													<i style="color:#FF8F27" class="fa fa-map-marker"></i>
													<?php echo $user_city; ?>
												</span>
												
												|
												
												<span class="shopmap-since">
													<i style="color:#FF8F27" class="fa fa-signal"></i>
													Shop On Citisell since 
													<?php echo substr($created_on,0,4); ?>
												</span>
												
											</h5>
                                            <!-- Standard button -->
											
											<?php if($this->session->userdata('isLogin') == True && $shopid == $this->session->userdata('shopid')){ ?>
                                            
											<a href="<?php echo base_url(); ?>page/yourshop/shopsettings?act=appearance" class="btn btn-primary" style="margin-top:10px;">
												
												<i class="fa fa-pencil" style="color:#bebebe"> </i>
												Edit your shop
												
											</a>
											
											<?php } ?>
											
                                            <span class="btn btn-default" style="margin-top:10px;">
												
												<i class="fa fa-heart" style="color:#bebebe"> </i>
												Favorite Shop (237)
												
											</span>
											
                                        </div><!-- End: dtl_txt -->
                                    </div>
                                    
                                </div>
                            </div><!-- End: dt_lft -->
                        </div>
                        
                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
							
							<div style="margin:0 auto; width:68%;">
								
								<!--p class="dt_rt_p" style="position: relative;">Shop Owner</p-->
								
								<div class="photo_dtails img-thumbnail" style="display: inline-table;height: 108px;background:#ddd;left: 24px;position: relative;"><!-- Begin: photo_dtails -->
									
									<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
										
									
										<div class="profilepicc"><!-- Begin: profilepic -->
							
											<a href="<?php echo base_url(); ?>page/user/userprofile/<?php echo $userid; ?>">
												
												<img src="<?php echo base_url(); ?>assets/frontend/images/<?php if($user_picture == NULL ){echo 'users/userprofile.png'; }else{ echo 'users/'.$user_picture;} ?>" class="img-responsive img-circle" alt="profile" style="margin: 0 20px 0px 0px;" align="left" vspace="5" hspace="5" />
												
											</a>
											
										</div><!-- End: profilepic -->
										
									</div>
									
								</div><!-- End: photo_dtails -->
								
								<?php if($this->session->userdata('isLogin') == True){ ?>
								
								<h5 style="text-align: center;">
									<a href="<?php echo base_url(); ?>page/user/userprofile/<?php echo $userid; ?>">
										<?php echo ucwords($display_name); ?>
									</a>
									
								</h5>
								
								<?php }else{ ?>
								
								<h5 style="position: relative; text-align: center;">
									<a href="<?php echo base_url(); ?>page/user/userprofile/<?php echo $userid; ?>">
										<?php echo ucwords($display_name); ?>
									</a>
									
								</h5>
								
								<?php } ?>
								
							</div>
						</div>
                        
                    </div>
                </div><!-- End: details_top -->
            </div>
        </div>
        <div class="clearfix"></div>
		
		<?php
		
			if($this->uri->segment(5) == 'vacationmode' && $this->session->userdata('isLogin') == TRUE){
				
		?>
		
		<div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div style="background: #fbb216 none repeat scroll 0 0 !important; border-bottom: 1px solid #c1c1c1; color: #d91e76; font-size: 21px; margin-bottom: 0px; padding: 10px;"><!-- Begin: details_top -->
                	<div class="row">
                    
                    	<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                            <div class="dt_lft"><!-- Begin: dt_lft -->
                            	<div class="row">
                                
                                	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <div class="dtl_photo"><!-- Begin: dtl_photo -->
                                        	
											<h5 style="font-weight:bold !important; font-size: 17px;">Shop vacation Mode? :</h5>
											
                                        </div><!-- End: dtl_photo -->
                                    </div>
                                    
                                	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                        
										<form method="post" class="form-inline" action="<?php echo base_url(); ?>page/yourshop/vacationupdate">
										
											<div class="form-group">
												
												<label class="radio-inline" style="color: #222;">
													
													<input type="radio" <?php if($vacationmode == 'Disabled'){ echo 'Checked="Checked"'; } ?> class="form-control" name="vacationmode" id="vacationmode1" value="Disabled"> Enable
													
												</label>
												
												<label class="radio-inline" style="color: #222;">
													
													<input type="radio" <?php if($vacationmode == 'Enabled'){ echo 'Checked="Checked"'; } ?> class="form-control" name="vacationmode" id="vacationmode2" value="Enabled"> Disable
													
												</label>
												
												
												<input type="submit" class="btn btn-success" name="save" value="Update" />
												
											</div>
											
										</form>
											
                                    </div>
                                    
                                </div>
                            </div><!-- End: dt_lft -->
                        </div>
                        
                    </div>
                </div><!-- End: details_top -->
            </div>
        </div>
        <div class="clearfix"></div>
		
		<?php } ?>
		
		
		<?php if($shopbanner !== NULL){ ?>
		
		<div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="" style="border-bottom:1px solid #c1c1c1; padding:10px;margin-bottom:7px;"><!-- Begin: details_top -->
                	<div class="row">
                    
                    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="dt_lft"><!-- Begin: dt_lft -->
                            	<div class="row">
                                
                                	<div class="shopbanner">
										<img src="<?php echo base_url(); ?>assets/frontend/images/shops/<?php echo $sname.'/'.$shopbanner; ?>" alt="<?php echo $shop_name; ?> Shop Banner" class="img-responsive" />	
									</div>
                                    
                                </div>
                            </div><!-- End: dt_lft -->
                        </div>
                        
                    </div>
                </div><!-- End: details_top -->
            </div>
        </div>
		
		<?php } ?>
		
		
		
		<?php										
			$sqlshopwelcomeM = $this->db->query("select * from mega_shopsettings where shopid=$shopid");
			$sqlshopfetchwelcomeM = $sqlshopwelcomeM->row_array();
			
			if($sqlshopwelcomeM->num_rows() > 0){
				extract($sqlshopfetchwelcomeM);
			
			if($welcomemsg !== ''){
		?>
		
		<div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="" style="border-bottom:1px solid #c1c1c1; padding:10px;margin-bottom:7px;"><!-- Begin: details_top -->
                	<div class="row">
                    
                    	<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                            <div class="dt_lft"><!-- Begin: dt_lft -->
                            	<div class="row">
                                
                                	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <div class="dtl_photo"><!-- Begin: dtl_photo -->
                                        	
											<h5 style="font-weight:bold !important;">Announcement :</h5>
											
                                        </div><!-- End: dtl_photo -->
                                    </div>
                                    
                                	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                        
										<h5 style="font-size: 17px;font-weight: normal !important;line-height: 1.5;color:#003580;">
											<?php echo $welcomemsg; ?>
										</h5>
											
                                    </div>
                                    
                                </div>
                            </div><!-- End: dt_lft -->
                        </div>
                        
                    </div>
                </div><!-- End: details_top -->
            </div>
        </div>
		
        <div class="clearfix"></div>
		<?php } } ?>
		
                        
        <div class="row">
        
            <div class="innerpage_main"><!-- Begin: innerpage_main -->
            
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="product_category"><!-- Begin: product_category -->
                        <h6 class="product_category_h6" style="text-align:left;font-weight:bold;font-size: 19px;">
							
							<i class="fa fa-list"></i>
							<?php echo ucfirst($shop_name); ?> Items 
							
						</h6>
    
                        <ul id="sectionCount">
							<li>
								<a style="color:#D91E76" href="<?php echo base_url(); ?>page/yourshop/viewshop/<?php echo $shopid; ?>">
									&#x0226B;&nbsp; 
									<?php
										echo 'All';
										
										$numberOfSectionAllItems = $this->db->query("select * from mega_products where shopid=$shopid AND product_live='Active'");
										$numberOfAllSctn = $numberOfSectionAllItems->num_rows();
									?>
								</a>
								
								<b style="color:#D91E76"><?php echo checkNumber(number_format($numberOfAllSctn)); ?></b>
								
							</li>
							
                        	<?php
								
								foreach ($getsections as $nv_row){
									
									$sectnid = $nv_row->sectionid;
									$numberOfSectionItems = $this->db->query("select * from mega_products where shopid=$shopid AND productsection=$sectnid AND product_live='Active'");
									$numberOfSctn = $numberOfSectionItems->num_rows();
							?>
							
							<li>
								<a href="<?php echo base_url(); ?>page/yourshop/viewshop/<?php echo $shopid; ?>/<?php echo $nv_row->sectionid; ?>/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $nv_row->sectionname))));  ?>">
									&#x0226B;&nbsp; 
									<?php
										echo ucfirst($nv_row->sectionname);
									?>
								</a>
								
								<b><?php echo checkNumber(number_format($numberOfSctn)); ?></b>
							</li>
								
							<?php } ?>
							
							
                        </ul>
                        
                        <p class="product_category_p" style="text-align:left;font-weight:bold;">
							&nbsp;
						</p>
                        
                    </div><!-- End: product_category -->
                </div>  
                
				
				
			<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
			
					<h5>
						<i class="fa fa-search" aria-hidden="true"></i>&nbsp;
						<span class="p_active">Records founded from all categories >></span> (<?php echo checkNumber(number_format($total_results)); ?> Results)
					</h5>
						
					<?php
						/*$sql = "select * from mega_products order by productid DESC limit 0,4";
						$allitemsres = $this->db->query($sql);
						$allitems = $allitemsres->result();
						$rcount = $allitemsres->num_rows();*/
						
						//for ($i = 0; $i <count($allitems); ++$i){
						//foreach($allitems as $allitemsview){
							if(is_array($allitem) && count($allitem) ) {
								foreach($allitem as $allitems){
							
					?>
					<?php //echo ($page+$i+1); ?>
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<div class="recompro_box aalp"><!-- Begin: recompro_box -->
							
								<div class="recompro_box_img"><!-- Begin: recompro_box_img" -->
								
								
									<div class="main view-third">
										<!-- THIRD EXAMPLE -->
										<div class="view">
										
											<a href="<?php echo base_url(); ?>page/pdetails/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $allitems->product_name)))))))); ?>/<?php echo $allitems->productid; ?>">

										  <?php
												$nvsoo_query 		= $this->db->query("SELECT * FROM mega_shops where shopid='".$allitems->shopid."'");
												$nvsoo_results 	= $nvsoo_query->row_array();
												extract($nvsoo_results);
												
												$poopimg = explode(',',$allitems->product_image);
													
												for($poopi=0;$poopi< count($poopimg);$poopi++){
													
													// Check product Image NULL Or Not
													if($allitems->product_image == NULL){
														$pooimglocation = base_url()."assets/frontend/images/shops/default-img.jpg";
													}else{
														$sname = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shop_name))));
														
														$pooimglocation = base_url()."assets/frontend/images/shops/$sname/$poopimg[$poopi]";
													}
													
													echo '<img class="img-responsive img-thumbnail" src="'.$pooimglocation.'" alt="'.$allitems->product_name.'" />';
													break;
												}
											?>
											
											</a>
											
										</div>
									</div>
								
									
								</div><!-- End: recompro_box_img" -->
								
								<div class="recompro_box_txt allccat"><!-- Begin: recompro_box_txt" -->	
									
									<h6 class="recompro_box_txt_h6">
										
										<a href="<?php echo base_url(); ?>page/pdetails/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $allitems->product_name)))))))); ?>/<?php echo $allitems->productid; ?>">
											
											<?php echo substr($allitems->product_name,0,60); ?>
											
										</a>
										
									</h6>
									
									<p class="recompro_box_txt_p">&nbsp; 
										<span class="recompro_box_txt_span">
											<i class="fa fa-usd"></i> 
											<?php  echo $allitems->product_price; ?>
										</span>
										
										<span class="recompro_box_txt_span_shop">
											<?php  echo $shop_name; ?>
										</span>
									</p>
									
								</div><!-- End: recompro_box_txt" -->
								
							</div><!-- End: recompro_box -->
						</div>
						
						<?php } }else{ ?>
						
						<p>&nbsp;</p>
						
						<h4> <i>Sorry! Records didn't found yet!</i> </h4>
						
						<?php } ?>
						
						

					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">    
						<h3 class="border_styles" style="margin-top:25px;">&nbsp;</h3>
							
						<div class="row">
							<div class="col-md-12">
								<div class="row"><?php echo $this->pagination->create_links(); ?></div> 
							</div>
						</div>
							
					</div>
					
						
					</div>
				
			
			</div>
            
        
                
                
            </div><!-- End: innerpage_main -->
            
        </div>
        <div class="clearfix"></div>

		
                
    </div>
</div><!-- End: inner_page -->




<?php $this->load->view('../../front-templates/footer.php'); ?>
