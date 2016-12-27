<?php
	$this->load->view('../../front-templates/head.php');
	$this->load->view('../../front-templates/header.php');
	$this->load->view('../../front-templates/navigation.php');
	$this->load->view('../../front-templates/banner.php');
	//echo listingfee();
	//echo salescommission().'%';
?>


<div id="discover_tems"><!-- Begin: discover_tems -->
    <div class="container">
    
        <div class="row">
            <div class="discover_head"><!-- Begin: discover_head -->
            	<h3 class="discover_head_h3"> <?php echo sitename(); ?> home page </h3>
            </div><!-- End: discover_head -->
        </div>
        
        
		
        <div class="row">
        	
            <?php
				foreach($last4items as $last4itemsview){
					
					$nvsd_query242 		= $this->db->query("SELECT * FROM mega_shops where shopid='".$last4itemsview->shopid."'");
					$nvsd_results242 	= $nvsd_query242->row_array();
					extract($nvsd_results242);
					
					$getCatName4 = $this->db->query("SELECT * FROM mega_productcategories where category_id='".$last4itemsview->product_category_id."'");
					extract($getCatName4->row_array());
			?>
			
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <div class="dportate"><!-- Begin: dportate -->
                
                	<a href="<?php echo base_url(); ?>page/category/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $category_name)))); ?>/<?php echo $category_id; ?>">
                    
                        <div class="dportate_img"><!-- Begin: dportate_img -->
                            
							<?php
								$pd242pimg = explode(',',$last4itemsview->product_image);
									
								for($pd242pi=0;$pd242pi< count($pd242pimg);$pd242pi++){
									
									// Check product Image NULL Or Not
									if($last4itemsview->product_image == NULL){
										$pd242imglocation = base_url()."assets/frontend/images/shops/default-img.jpg";
									}else{
										$sname = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shop_name))));
										
										$pd242imglocation = base_url()."assets/frontend/images/shops/$sname/$pd242pimg[$pd242pi]";
									}
									
									echo '<img class="img-responsive img-thumbnail" src="'.$pd242imglocation.'" alt="'.$last4itemsview->product_name.'" />';
									break;
								}
								//echo $category_name;
							?>
							
                        </div><!-- End: dportate_img -->
                        
                        <div class="dportate_txt"><!-- Begin: dportate_txt -->
                            
							<h6 class="dportate_txt_h6">Latest Items</h6>
							
                            <h3 class="dportate_txt_h3"><?php echo substr($last4itemsview->product_name,0,43); ?></h3>
							
                        </div><!-- End: dportate_txt -->
                        
                    </a>
                    
                </div><!-- End: dportate -->
            </div>
			
			
			<?php } ?>
            
            
            <div class="clearfix"></div>
            
            <!--div class="items_more">
            	<p class="items_more_p">
					<a href="<?php //echo base_url(); ?>page/catpaginat/category/0" class="btn btn-primary">
						More Update Items <i class="fa fa-angle-double-right"></i>
					</a>
				</p>
            </div--->
            
        </div>
		
		
		<div class="recommend_products"><!-- Begin: recommend_products -->
            	<div class="row">
                
                    <?php
						foreach($alllitems as $recommandedpview){
							
							// Get product info
							$recomndProductsql = $this->db->query("SELECT * FROM mega_products where productid='".$recommandedpview->productid."'");
							
							$recomndProductFetch 	= $recomndProductsql->row_array();
							extract($recomndProductFetch);
							
							// Get shop info
							$nvs_queryRecom 		= $this->db->query("SELECT * FROM mega_shops where shopid='".$shopid."'");
							$nvs_resultsRecom 	= $nvs_queryRecom->row_array();
							extract($nvs_resultsRecom);
					?>
					
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="recompro_box recomnd" style="height:300px !important;"><!-- Begin: recompro_box -->
                        
                            <div class="recompro_box_img"><!-- Begin: recompro_box_img" -->
                            
                            
                                <div class="main view-third">
                                    <!-- THIRD EXAMPLE -->
                                    <div class="view">

                                      <a href="<?php echo base_url(); ?>page/pdetails/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $product_name)))))))); ?>/<?php echo $productid; ?>">
									  
									<?php
										$ppimgRec = explode(',',$product_image);
											
										for($ppiRec=0;$ppiRec< count($ppimgRec);$ppiRec++){
											
											// Check product Image NULL Or Not
											if($product_image == NULL){
												$pimglocationRec = base_url()."assets/frontend/images/shops/default-img.jpg";
											}else{
												$snameRec = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shop_name))));
												
												$pimglocationRec = base_url()."assets/frontend/images/shops/$snameRec/$ppimgRec[$ppiRec]";
											}
											
											echo '<img style="height:225px !important;" class="img-responsive img-thumbnail" src="'.$pimglocationRec.'" alt="'.$product_name.'" />';
											break;
										}
									?>
										
										</a>
                                    </div>
                                </div>
                            
                            	
                            </div><!-- End: recompro_box_img" -->
                            
                            <div class="recompro_box_txt"><!-- Begin: recompro_box_txt" -->	
                            	
								<h6 class="recompro_box_txt_h6" style="width:93% !important;">
									
									<a href="<?php echo base_url(); ?>page/pdetails/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $product_name)))))))); ?>/<?php echo $productid; ?>">
									
										<?php echo substr($product_name,0,40); ?> ...
										
									</a>
									
								</h6>
								
                                <p class="recompro_box_txt_p">
									
									<a href="<?php echo base_url(); ?>page/yourshop/viewshop/<?php echo $shopid; ?>">
										<?php  echo $shop_name; ?>
									</a>
									
									<span class="recompro_box_txt_span">
										<i class="fa fa-usd"></i> <?php echo $product_price; ?> USD
									</span>
								</p>
                            </div><!-- End: recompro_box_txt" -->
                            
                        </div><!-- End: recompro_box -->
                    </div>
					
					<?php } ?>
                    
                    
					
					<div class="clearfix"></div>
					
					<div class="items_more">
						<p class="items_more_p">
							<a href="<?php echo base_url(); ?>page/catpaginat/category/0" class="btn btn-primary">
								More Items <i class="fa fa-angle-double-right"></i>
							</a>
						</p>
					</div>
				
                    
                </div>
            </div><!-- End: recommend_products -->
        
        
        
    </div>
</div><!-- End: discover_tems -->




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
