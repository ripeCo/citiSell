<?php
	$this->load->view('../../front-templates/head.php');
	$this->load->view('../../front-templates/header.php');
	$this->load->view('../../front-templates/navigation.php');
	$this->load->view('../../front-templates/banner.php');
?>


<div id="discover_tems"><!-- Begin: discover_tems -->
    <div class="container">
    
        <div class="row">
            <div class="discover_head"><!-- Begin: discover_head -->
            	<h3 class="discover_head_h3">Discover items you can't find anywhere else</h3>
            </div><!-- End: discover_head -->
        </div>
        
        <div class="row">
        	
            
			<?php
				foreach($last2items as $last2itemsview){
					
					$nvsd_query212 		= $this->db->query("SELECT * FROM mega_shops where shopid='".$last2itemsview->shopid."'");
					$nvsd_results212 	= $nvsd_query212->row_array();
					extract($nvsd_results212);
					
					$getCatName = $this->db->query("SELECT * FROM mega_productcategories where category_id='".$last2itemsview->product_category_id."'");
					extract($getCatName->row_array());
			?>
			
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="dlandscape"><!-- Begin: dlandscape -->
                	<div class="row">
                    
                        <div class="landscape_main"><!-- Begin: landscape_main -->
                        
                            <a href="<?php echo base_url(); ?>page/category/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $category_name)))); ?>/<?php echo $category_id; ?>">
                            
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="landscape_img"><!-- Begin: landscape_img -->
                                        
										<?php
											$pd212pimg = explode(',',$last2itemsview->product_image);
												
											for($pd212pi=0;$pd212pi< count($pd212pimg);$pd212pi++){
												
												// Check product Image NULL Or Not
												if($last2itemsview->product_image == NULL){
													$pd212imglocation = base_url()."assets/frontend/images/shops/default-img.jpg";
												}else{
													$pd212imglocation = base_url()."assets/frontend/images/shops/$shop_name/$pd212pimg[$pd212pi]";
												}
												
												echo '<img class="img-responsive" src="'.$pd212imglocation.'" alt="'.$last2itemsview->product_name.'" />';
												break;
											}
											//echo $category_name;
										?>
										
                                    </div><!-- End: landscape_img -->
                                </div>
                                
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="landscape_txt"><!-- Begin: landscape_txt -->
                                        
										<h6 class="landscape_txt_h6">Latest Items</h6>
										
                                        <h3 class="landscape_txt_h3"><?php echo substr($last2itemsview->product_name,0,53); ?></h3>
										
                                    </div><!-- End: landscape_txt -->
                                </div>
                            
                            </a>
                        
                        </div><!-- End: landscape_main -->
                        
                    </div>
                </div><!-- End: dlandscape -->
            </div>
            
			<?php } ?>
            
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
										$pd242imglocation = base_url()."assets/frontend/images/shops/$shop_name/$pd242pimg[$pd242pi]";
									}
									
									echo '<img class="img-responsive" src="'.$pd242imglocation.'" alt="'.$last4itemsview->product_name.'" />';
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
            
            <div class="items_more">
            	<p class="items_more_p">
					<a href="<?php echo base_url(); ?>page/catpaginat/category/0" class="btn btn-primary">
						More Update Items <i class="fa fa-angle-double-right"></i>
					</a>
				</p>
            </div>
            
        </div>
        
        <div id="recommend"><!-- Begin: recommend -->
        
            <div class="row">
                <div class="discover_head"><!-- Begin: discover_head -->
                    <h3 class="recommend_h3">Recommended for you</h3>
                    <p class="recommend_p">Shop for items based on what you’ve viewed.</p>
                </div><!-- End: discover_head -->
            </div>
            <div class="clearfix"></div>
            
            <div class="recommend_products"><!-- Begin: recommend_products -->
            	<div class="row">
                
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="recompro_box"><!-- Begin: recompro_box -->
                        
                            <div class="recompro_box_img"><!-- Begin: recompro_box_img" -->
                            
                            
                                <div class="main view-third">
                                    <!-- THIRD EXAMPLE -->
                                    <div class="view">

                                      <img src="<?php echo base_url(); ?>assets/frontend/images/interface/re_products12.jpg" class="img-responsive" />
                                        <div class="mask">
                                        	<div class="heart_rate">
                                            	<a href="#" data-toggle="modal" data-target="#myModal" class="info"><i class="fa fa-heart-o" style="font-weight:bold"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                            	
                            </div><!-- End: recompro_box_img" -->
                            
                            <div class="recompro_box_txt"><!-- Begin: recompro_box_txt" -->	
                            	<h6 class="recompro_box_txt_h6"><a href="#">Bulbasaur Planter 3D Printed</a></h6>
                                <p class="recompro_box_txt_p"><a href="#">MagMileBrand</a> <span class="recompro_box_txt_span"><i class="fa fa-usd"></i> 876.00 USD</span></p>
                            </div><!-- End: recompro_box_txt" -->
                            
                        </div><!-- End: recompro_box -->
                    </div>
                    
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="recompro_box"><!-- Begin: recompro_box -->
                        
                            <div class="recompro_box_img"><!-- Begin: recompro_box_img" -->
                            
                            
                                <div class="main view-third">
                                    <!-- THIRD EXAMPLE -->
                                    <div class="view">

                                      <img src="<?php echo base_url(); ?>assets/frontend/images/interface/re_products02.jpg" class="img-responsive" />
                                        <div class="mask">
                                        	<div class="heart_rate">
                                            	<a href="#" data-toggle="modal" data-target="#myModal" class="info"><i class="fa fa-heart-o" style="font-weight:bold"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                            	
                            </div><!-- End: recompro_box_img" -->
                            
                            <div class="recompro_box_txt"><!-- Begin: recompro_box_txt" -->	
                            	<h6 class="recompro_box_txt_h6"><a href="#">Baby Headbands, Choose Color</a></h6>
                                <p class="recompro_box_txt_p"><a href="#">MagMileBrand</a> <span class="recompro_box_txt_span"><i class="fa fa-usd"></i> 876.00 USD</span></p>
                            </div><!-- End: recompro_box_txt" -->
                            
                        </div><!-- End: recompro_box -->
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="recompro_box"><!-- Begin: recompro_box -->
                        
                            <div class="recompro_box_img"><!-- Begin: recompro_box_img" -->
                            
                            
                                <div class="main view-third">
                                    <!-- THIRD EXAMPLE -->
                                    <div class="view">

                                      <img src="<?php echo base_url(); ?>assets/frontend/images/interface/re_products03.jpg" class="img-responsive" />
                                        <div class="mask">
                                        	<div class="heart_rate">
                                            	<a href="#" data-toggle="modal" data-target="#myModal" class="info"><i class="fa fa-heart-o" style="font-weight:bold"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                            	
                            </div><!-- End: recompro_box_img" -->
                            
                            <div class="recompro_box_txt"><!-- Begin: recompro_box_txt" -->	
                            	<h6 class="recompro_box_txt_h6"><a href="#">Jade Brass Chain Anklet</a></h6>
                                <p class="recompro_box_txt_p"><a href="#">MagMileBrand</a> <span class="recompro_box_txt_span"><i class="fa fa-usd"></i> 876.00 USD</span></p>
                            </div><!-- End: recompro_box_txt" -->
                            
                        </div><!-- End: recompro_box -->
                    </div>
                    
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="recompro_box"><!-- Begin: recompro_box -->
                        
                            <div class="recompro_box_img"><!-- Begin: recompro_box_img" -->
                            
                            
                                <div class="main view-third">
                                    <!-- THIRD EXAMPLE -->
                                    <div class="view">

                                      <img src="<?php echo base_url(); ?>assets/frontend/images/interface/re_products04.jpg" class="img-responsive" />
                                        <div class="mask">
                                        	<div class="heart_rate">
                                            	<a href="#" data-toggle="modal" data-target="#myModal" class="info"><i class="fa fa-heart-o" style="font-weight:bold"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                            	
                            </div><!-- End: recompro_box_img" -->
                            
                            <div class="recompro_box_txt"><!-- Begin: recompro_box_txt" -->	
                            	<h6 class="recompro_box_txt_h6"><a href="#">Fingerless Gloves, Handmade Wrist</a></h6>
                                <p class="recompro_box_txt_p"><a href="#">MagMileBrand</a> <span class="recompro_box_txt_span"><i class="fa fa-usd"></i> 876.00 USD</span></p>
                            </div><!-- End: recompro_box_txt" -->
                            
                        </div><!-- End: recompro_box -->
                    </div>
                    
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="recompro_box"><!-- Begin: recompro_box -->
                        
                            <div class="recompro_box_img"><!-- Begin: recompro_box_img" -->
                            
                            
                                <div class="main view-third">
                                    <!-- THIRD EXAMPLE -->
                                    <div class="view">

                                      <img src="<?php echo base_url(); ?>assets/frontend/images/interface/re_products05.jpg" class="img-responsive" />
                                        <div class="mask">
                                        	<div class="heart_rate">
                                            	<a href="#" data-toggle="modal" data-target="#myModal" class="info"><i class="fa fa-heart-o" style="font-weight:bold"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                            	
                            </div><!-- End: recompro_box_img" -->
                            
                            <div class="recompro_box_txt"><!-- Begin: recompro_box_txt" -->	
                            	<h6 class="recompro_box_txt_h6"><a href="#">iPhone 6s Case Floral, iPhone 6s Plus</a></h6>
                                <p class="recompro_box_txt_p"><a href="#">MagMileBrand</a> <span class="recompro_box_txt_span"><i class="fa fa-usd"></i> 876.00 USD</span></p>
                            </div><!-- End: recompro_box_txt" -->
                            
                        </div><!-- End: recompro_box -->
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="recompro_box"><!-- Begin: recompro_box -->
                        
                            <div class="recompro_box_img"><!-- Begin: recompro_box_img" -->
                            
                                <div class="main view-third">
                                    <!-- THIRD EXAMPLE -->
                                    <div class="view">

                                      <img src="<?php echo base_url(); ?>assets/frontend/images/interface/re_products06.jpg" class="img-responsive" />
                                        <div class="mask">
                                        	<div class="heart_rate">
                                            	<a href="#" data-toggle="modal" data-target="#myModal" class="info"><i class="fa fa-heart-o" style="font-weight:bold"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            	
                            </div><!-- End: recompro_box_img" -->
                            
                            <div class="recompro_box_txt"><!-- Begin: recompro_box_txt" -->	
                            	<h6 class="recompro_box_txt_h6"><a href="#">Fingerless Gloves, Handmade Wrist</a></h6>
                                <p class="recompro_box_txt_p"><a href="#">MagMileBrand</a> <span class="recompro_box_txt_span"><i class="fa fa-usd"></i> 876.00 USD</span></p>
                            </div><!-- End: recompro_box_txt" -->
                            
                        </div><!-- End: recompro_box -->
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="recompro_box"><!-- Begin: recompro_box -->
                        
                            <div class="recompro_box_img"><!-- Begin: recompro_box_img" -->
                            
                            
                                <div class="main view-third">
                                    <!-- THIRD EXAMPLE -->
                                    <div class="view">

                                      <img src="<?php echo base_url(); ?>assets/frontend/images/interface/re_products07.jpg" class="img-responsive" />
                                        <div class="mask">
                                        	<div class="heart_rate">
                                            	<a href="#" data-toggle="modal" data-target="#myModal" class="info"><i class="fa fa-heart-o" style="font-weight:bold"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                            	
                            </div><!-- End: recompro_box_img" -->
                            
                            <div class="recompro_box_txt"><!-- Begin: recompro_box_txt" -->	
                            	<h6 class="recompro_box_txt_h6"><a href="#">Headbands &amp; Turbans</a></h6>
                                <p class="recompro_box_txt_p"><a href="#">MagMileBrand</a> <span class="recompro_box_txt_span"><i class="fa fa-usd"></i> 876.00 USD</span></p>
                            </div><!-- End: recompro_box_txt" -->
                            
                        </div><!-- End: recompro_box -->
                    </div>
                    
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="recompro_box"><!-- Begin: recompro_box -->
                        
                            <div class="recompro_box_img"><!-- Begin: recompro_box_img" -->
                            
                            
                                <div class="main view-third">
                                    <!-- THIRD EXAMPLE -->
                                    <div class="view">

                                      <img src="<?php echo base_url(); ?>assets/frontend/images/interface/re_products08.jpg" class="img-responsive" />
                                        <div class="mask">
                                        	<div class="heart_rate">
                                            	<a href="#" data-toggle="modal" data-target="#myModal" class="info"><i class="fa fa-heart-o" style="font-weight:bold"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                            	
                            </div><!-- End: recompro_box_img" -->
                            
                            <div class="recompro_box_txt"><!-- Begin: recompro_box_txt" -->	
                            	<h6 class="recompro_box_txt_h6"><a href="#">Ad New Style! Silicone Teething...</a></h6>
                                <p class="recompro_box_txt_p"><a href="#">MagMileBrand</a> <span class="recompro_box_txt_span"><i class="fa fa-usd"></i> 876.00 USD</span></p>
                            </div><!-- End: recompro_box_txt" -->
                            
                        </div><!-- End: recompro_box -->
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="recompro_box"><!-- Begin: recompro_box -->
                        
                            <div class="recompro_box_img"><!-- Begin: recompro_box_img" -->
                            
                            
                                <div class="main view-third">
                                    <!-- THIRD EXAMPLE -->
                                    <div class="view">

                                      <img src="<?php echo base_url(); ?>assets/frontend/images/interface/re_products09.jpg" class="img-responsive" />
                                        <div class="mask">
                                        	<div class="heart_rate">
                                            	<a href="#" data-toggle="modal" data-target="#myModal" class="info"><i class="fa fa-heart-o" style="font-weight:bold"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                            	
                            </div><!-- End: recompro_box_img" -->
                            
                            <div class="recompro_box_txt"><!-- Begin: recompro_box_txt" -->	
                            	<h6 class="recompro_box_txt_h6"><a href="#">Mix &amp; Match - Any Length or Color</a></h6>
                                <p class="recompro_box_txt_p"><a href="#">MagMileBrand</a> <span class="recompro_box_txt_span"><i class="fa fa-usd"></i> 876.00 USD</span></p>
                            </div><!-- End: recompro_box_txt" -->
                            
                        </div><!-- End: recompro_box -->
                    </div>
                    
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="recompro_box"><!-- Begin: recompro_box -->
                        
                            <div class="recompro_box_img"><!-- Begin: recompro_box_img" -->
                            
                            
                                <div class="main view-third">
                                    <!-- THIRD EXAMPLE -->
                                    <div class="view">

                                      <img src="<?php echo base_url(); ?>assets/frontend/images/interface/re_products10.jpg" class="img-responsive" />
                                        <div class="mask">
                                        	<div class="heart_rate">
                                            	<a href="#" data-toggle="modal" data-target="#myModal" class="info"><i class="fa fa-heart-o" style="font-weight:bold"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                            	
                            </div><!-- End: recompro_box_img" -->
                            
                            <div class="recompro_box_txt"><!-- Begin: recompro_box_txt" -->	
                            	<h6 class="recompro_box_txt_h6"><a href="#">Personalised Make Up Bag Or Wash</a></h6>
                                <p class="recompro_box_txt_p"><a href="#">MagMileBrand</a> <span class="recompro_box_txt_span"><i class="fa fa-usd"></i> 876.00 USD</span></p>
                            </div><!-- End: recompro_box_txt" -->
                            
                        </div><!-- End: recompro_box -->
                    </div>
                    
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="recompro_box"><!-- Begin: recompro_box -->
                        
                            <div class="recompro_box_img"><!-- Begin: recompro_box_img" -->
                            
                            
                                <div class="main view-third">
                                    <!-- THIRD EXAMPLE -->
                                    <div class="view">

                                      <img src="<?php echo base_url(); ?>assets/frontend/images/interface/re_products11.jpg" class="img-responsive" />
                                        <div class="mask">
                                        	<div class="heart_rate">
                                            	<a href="#" data-toggle="modal" data-target="#myModal" class="info"><i class="fa fa-heart-o" style="font-weight:bold"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                            	
                            </div><!-- End: recompro_box_img" -->
                            
                            <div class="recompro_box_txt"><!-- Begin: recompro_box_txt" -->	
                            	<h6 class="recompro_box_txt_h6"><a href="#">Inspirational Quote. Book. Sympathy</a></h6>
                                <p class="recompro_box_txt_p"><a href="#">MagMileBrand</a> <span class="recompro_box_txt_span"><i class="fa fa-usd"></i> 876.00 USD</span></p>
                            </div><!-- End: recompro_box_txt" -->
                            
                        </div><!-- End: recompro_box -->
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="recompro_box"><!-- Begin: recompro_box -->
                        
                            <div class="recompro_box_img"><!-- Begin: recompro_box_img" -->
                            
                            
                                <div class="main view-third">
                                    <!-- THIRD EXAMPLE -->
                                    <div class="view">

                                      <img src="<?php echo base_url(); ?>assets/frontend/images/interface/re_products01.jpg" class="img-responsive" />
                                        <div class="mask">
                                        	<div class="heart_rate">
                                            	<a href="#" data-toggle="modal" data-target="#myModal" class="info"><i class="fa fa-heart-o" style="font-weight:bold"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                            	
                            </div><!-- End: recompro_box_img" -->
                            
                            <div class="recompro_box_txt"><!-- Begin: recompro_box_txt" -->	
                            	<h6 class="recompro_box_txt_h6"><a href="#">Full grain leather belt, Black, Solid</a></h6>
                                <p class="recompro_box_txt_p"><a href="#">MagMileBrand</a> <span class="recompro_box_txt_span"><i class="fa fa-usd"></i> 876.00 USD</span></p>
                            </div><!-- End: recompro_box_txt" -->
                            
                        </div><!-- End: recompro_box -->
                    </div>
                    
                </div>
            </div><!-- End: recommend_products -->
            
        </div><!-- End: recommend -->
        
    </div>
</div><!-- End: discover_tems -->

<div id="community_tastemark"><!-- Begin: community_tastemark -->
    <div class="container">
    
        <div class="row">
            <div class="commtaste_head"><!-- Begin: commtaste_head -->
                <h3 class="commtaste_head_h3">Community Tastemakers</h3>
                <p class="commtaste_head_p">Get inspiration from these ctsell members' top picks.</p>
            </div><!-- End: commtaste_head -->
        </div>
        <div class="clearfix"></div>
        
        <div class="community_main"><!-- Begin: community_main -->
            <div class="row">
            
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="community_box"><!-- Begin: community_box -->
                    
                    	<a href="#">
                        
                            <div class="favorite_product"><!-- Begin: favorite_product -->
                                <img src="<?php echo base_url(); ?>assets/frontend/images/interface/favorite_product01.jpg" class="img-responsive" alt="Favorite Products" />
                            </div><!-- End: favorite_product -->
                            
                            <div class="favorite_product" id="last_box"><!-- Begin: favorite_product -->
                                <img src="<?php echo base_url(); ?>assets/frontend/images/interface/favorite_product02.jpg" class="img-responsive" alt="Favorite Products" />
                            </div><!-- End: favorite_product -->
                            
                            <div class="favorite_product"><!-- Begin: favorite_product -->
                                <img src="<?php echo base_url(); ?>assets/frontend/images/interface/favorite_product03.jpg" class="img-responsive" alt="Favorite Products" />
                            </div><!-- End: favorite_product -->
                            
                            <div class="favorite_product" id="last_box"><!-- Begin: favorite_product -->
                                <img src="<?php echo base_url(); ?>assets/frontend/images/interface/favorite_product04.jpg" class="img-responsive" alt="Favorite Products" />
                            </div><!-- End: favorite_product -->
                            
                            <div class="favorite_people"><!-- Begin: favorite_people -->
                                <img src="<?php echo base_url(); ?>assets/frontend/images/interface/favorite_people.jpg" class="img-circle" alt="Favorite People" />
                            </div><!-- End: favorite_people -->
                            
                            <div class="fapeo_name"><!-- Begin: fapeo_name -->
                                <h6 class="fapeo_name_h6">Md. Refat Hasan Favorites</h6>
                                <p class="fapeo_name_p">1525 Items</p>
                            </div><!-- End: fapeo_name -->
                            
                        </a>
                    	                        
                    </div><!-- End: community_box -->
                </div>
                
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="community_box"><!-- Begin: community_box -->
                    
                    	<a href="#">
                        
                            <div class="favorite_product"><!-- Begin: favorite_product -->
                                <img src="<?php echo base_url(); ?>assets/frontend/images/interface/favorite_product04.jpg" class="img-responsive" alt="Favorite Products" />
                            </div><!-- End: favorite_product -->
                            
                            <div class="favorite_product" id="last_box"><!-- Begin: favorite_product -->
                                <img src="<?php echo base_url(); ?>assets/frontend/images/interface/favorite_product03.jpg" class="img-responsive" alt="Favorite Products" />
                            </div><!-- End: favorite_product -->
                            
                            <div class="favorite_product"><!-- Begin: favorite_product -->
                                <img src="<?php echo base_url(); ?>assets/frontend/images/interface/favorite_product02.jpg" class="img-responsive" alt="Favorite Products" />
                            </div><!-- End: favorite_product -->
                            
                            <div class="favorite_product" id="last_box"><!-- Begin: favorite_product -->
                                <img src="<?php echo base_url(); ?>assets/frontend/images/interface/favorite_product01.jpg" class="img-responsive" alt="Favorite Products" />
                            </div><!-- End: favorite_product -->
                            
                            <div class="favorite_people"><!-- Begin: favorite_people -->
                                <img src="<?php echo base_url(); ?>assets/frontend/images/interface/favorite_people.jpg" class="img-circle" alt="Favorite People" />
                            </div><!-- End: favorite_people -->
                            
                            <div class="fapeo_name"><!-- Begin: fapeo_name -->
                                <h6 class="fapeo_name_h6">Md. Refat Hasan Favorites</h6>
                                <p class="fapeo_name_p">1525 Items</p>
                            </div><!-- End: fapeo_name -->
                            
                        </a>
                    	                        
                    </div><!-- End: community_box -->
                </div>
                
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="community_box"><!-- Begin: community_box -->
                    
                    	<a href="#">
                        
                            <div class="favorite_product"><!-- Begin: favorite_product -->
                                <img src="<?php echo base_url(); ?>assets/frontend/images/interface/favorite_product02.jpg" class="img-responsive" alt="Favorite Products" />
                            </div><!-- End: favorite_product -->
                            
                            <div class="favorite_product" id="last_box"><!-- Begin: favorite_product -->
                                <img src="<?php echo base_url(); ?>assets/frontend/images/interface/favorite_product04.jpg" class="img-responsive" alt="Favorite Products" />
                            </div><!-- End: favorite_product -->
                            
                            <div class="favorite_product"><!-- Begin: favorite_product -->
                                <img src="<?php echo base_url(); ?>assets/frontend/images/interface/favorite_product01.jpg" class="img-responsive" alt="Favorite Products" />
                            </div><!-- End: favorite_product -->
                            
                            <div class="favorite_product" id="last_box"><!-- Begin: favorite_product -->
                                <img src="<?php echo base_url(); ?>assets/frontend/images/interface/favorite_product03.jpg" class="img-responsive" alt="Favorite Products" />
                            </div><!-- End: favorite_product -->
                            
                            <div class="favorite_people"><!-- Begin: favorite_people -->
                                <img src="<?php echo base_url(); ?>assets/frontend/images/interface/favorite_people.jpg" class="img-circle" alt="Favorite People" />
                            </div><!-- End: favorite_people -->
                            
                            <div class="fapeo_name"><!-- Begin: fapeo_name -->
                                <h6 class="fapeo_name_h6">Md. Refat Hasan Favorites</h6>
                                <p class="fapeo_name_p">1525 Items</p>
                            </div><!-- End: fapeo_name -->
                            
                        </a>
                    	                        
                    </div><!-- End: community_box -->
                </div>
                
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="community_box"><!-- Begin: community_box -->
                    
                    	<a href="#">
                        
                            <div class="favorite_product"><!-- Begin: favorite_product -->
                                <img src="<?php echo base_url(); ?>assets/frontend/images/interface/favorite_product03.jpg" class="img-responsive" alt="Favorite Products" />
                            </div><!-- End: favorite_product -->
                            
                            <div class="favorite_product" id="last_box"><!-- Begin: favorite_product -->
                                <img src="<?php echo base_url(); ?>assets/frontend/images/interface/favorite_product01.jpg" class="img-responsive" alt="Favorite Products" />
                            </div><!-- End: favorite_product -->
                            
                            <div class="favorite_product"><!-- Begin: favorite_product -->
                                <img src="<?php echo base_url(); ?>assets/frontend/images/interface/favorite_product04.jpg" class="img-responsive" alt="Favorite Products" />
                            </div><!-- End: favorite_product -->
                            
                            <div class="favorite_product" id="last_box"><!-- Begin: favorite_product -->
                                <img src="<?php echo base_url(); ?>assets/frontend/images/interface/favorite_product02.jpg" class="img-responsive" alt="Favorite Products" />
                            </div><!-- End: favorite_product -->
                            
                            <div class="favorite_people"><!-- Begin: favorite_people -->
                                <img src="<?php echo base_url(); ?>assets/frontend/images/interface/favorite_people.jpg" class="img-circle" alt="Favorite People" />
                            </div><!-- End: favorite_people -->
                            
                            <div class="fapeo_name"><!-- Begin: fapeo_name -->
                                <h6 class="fapeo_name_h6">Md. Refat Hasan Favorites</h6>
                                <p class="fapeo_name_p">1525 Items</p>
                            </div><!-- End: fapeo_name -->
                            
                        </a>
                    	                        
                    </div><!-- End: community_box -->
                </div>
                
            </div>
        </div><!-- End: community_main -->
        
    </div>
</div><!-- End: community_tastemark -->

<div id="what_items"><!-- Begin: what_items -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="whatitem_inner"><!-- Begin: whatitem_inner -->
                	<h3 class="whatitem_inner_h3">What items do your favorite brands and bloggers love?</h3>
                    <div class="whatitem_more">
                        <p class="whatitem_more_p"><a href="#" class="btn btn-primary">Browse Their Favorites <i class="fa fa-angle-double-right"></i></a></p>
                    </div>
                </div><!-- End: whatitem_inner -->
            </div>
        </div>
    </div>
</div><!-- End: what_items -->

<div id="my_goals"><!-- Begin: my_goals -->
	
    <img src="<?php echo base_url(); ?>assets/frontend/images/interface/cover_image.jpg" class="img-responsive" alt="My Goals" />

    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="goals_main"><!-- Begin: goals_main -->
                
                    <div class="goal_photo"><!-- Begin: goal_photo -->
                    	<a href="#"><img src="<?php echo base_url(); ?>assets/frontend/images/interface/goal_photo.jpg" class="img-circle" alt="Goal Photo" /></a>
                    </div><!-- End: goal_photo -->
                    
                    <div class="goal_txt"><!-- Begin: goal_txt -->
                    	<h3 class="goal_txt_h3">My goal is to create artwork that brings joy and encouragement</h3>
                        <h6 class="goal_txt_h6">Meet <a href="#">Katie Geppert of HarvestHaversack</a> in Melbourne, Australia</h6>
                    </div><!-- End: goal_txt -->
                    
                </div><!-- End: goals_main -->
            </div>
        </div>
    </div>
    
</div><!-- End: my_goals -->

<div id="satisfied_customer"><!-- Begin: satisfied_customer -->
    <div class="container">
        <div class="row">
        
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="satisfation_box"><!-- Begin: satisfation_box -->
                	<img src="<?php echo base_url(); ?>assets/frontend/images/interface/satisefaction01.png" class="img-responsive" alt="Satisfield Customer" />
                	<h3 class="satisfation_box_h3">Satisfied Customers</h3>
                    <p class="satisfation_box_p">Get to know shops and items with reviews from our community. </p>
                </div><!-- End: satisfation_box -->
            </div>
            
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="satisfation_box"><!-- Begin: satisfation_box -->
                	<img src="<?php echo base_url(); ?>assets/frontend/images/interface/satisefaction02.png" class="img-responsive" alt="Satisfield Customer" />
                	<h3 class="satisfation_box_h3">Passionate Sellers</h3>
                    <p class="satisfation_box_p">Buy from creative people who care about quality and craftsmanship.</p>
                </div><!-- End: satisfation_box -->
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="satisfation_box"><!-- Begin: satisfation_box -->
                	<img src="<?php echo base_url(); ?>assets/frontend/images/interface/satisefaction03.png" class="img-responsive" alt="Satisfield Customer" />
                	<h3 class="satisfation_box_h3">Secure Transactions</h3>
                    <p class="satisfation_box_p">Feel confident knowing our Trust &amp; Safety team is here to protect you.</p>
                </div><!-- End: satisfation_box -->
            </div>
            
        </div>
    </div>
</div><!-- End: satisfied_customer -->

<?php $this->load->view('../../front-templates/footer.php'); ?>
