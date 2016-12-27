<?php
	$this->load->view('../../front-templates/head.php');
	$this->load->view('../../front-templates/header.php');
	$this->load->view('../../front-templates/navigation.php');
?>


<div id="inner_page"><!-- Begin: inner_page -->
    <div class="container">
    
        <div class="row">
            <div class="user_hi"><!-- Begin: user_hi -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                
                
                    <div class="user_name"><!-- Begin: user_name -->
                        <h3 class="user_name_h3 pull-left">
							<i class="fa fa-th"></i> Product Listing Manager
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
            
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                    <div class="ourpic4u_box"><!-- Begin: ourpic4u_box -->
                        <a href="#"><img src="<?php echo base_url(); ?>assets/frontend/images/products/urpic4u01.jpg" class="img-responsive" alt="photo" /></a>
                    </div><!-- End: ourpic4u_box -->
                </div>  
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                    <div class="ourpic4u_box"><!-- Begin: ourpic4u_box -->
                        <a href="#"><img src="<?php echo base_url(); ?>assets/frontend/images/products/urpic4u02.jpg" class="img-responsive" alt="photo" /></a>
                    </div><!-- End: ourpic4u_box -->
                </div>  
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                    <div class="ourpic4u_box"><!-- Begin: ourpic4u_box -->
                        <a href="#"><img src="<?php echo base_url(); ?>assets/frontend/images/products/urpic4u03.jpg" class="img-responsive" alt="photo" /></a>
                    </div><!-- End: ourpic4u_box -->
                </div>  
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                    <div class="ourpic4u_box"><!-- Begin: ourpic4u_box -->
                        <a href="#"><img src="<?php echo base_url(); ?>assets/frontend/images/products/urpic4u04.jpg" class="img-responsive" alt="photo" /></a>
                    </div><!-- End: ourpic4u_box -->
                </div>  
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                    <div class="ourpic4u_box"><!-- Begin: ourpic4u_box -->
                        <a href="#"><img src="<?php echo base_url(); ?>assets/frontend/images/products/urpic4u05.jpg" class="img-responsive" alt="photo" /></a>
                    </div><!-- End: ourpic4u_box -->
                </div>  
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                    <div class="ourpic4u_box"><!-- Begin: ourpic4u_box -->
                        <a href="#"><img src="<?php echo base_url(); ?>assets/frontend/images/products/urpic4u06.jpg" class="img-responsive" alt="photo" /></a>
                    </div><!-- End: ourpic4u_box -->
                </div>  
                
            </div><!-- End: ourpic4_you -->
        </div>
        <div class="clearfix"></div>
        
        <div class="row">
        	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="shopur_latest"><!-- Begin: shopur_latest -->
                
                    
                    <div class="row">
                        <div class="ur_feed"><!-- Begin: ur_feed -->
                        
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            	<div class="urfeed_main"><!-- Begin: urfeed_main -->
                                	<div class="row">
                                    
                                    	<div class="col-lg-1 col-md-1 col-sm-3 col-xs-12">
                                            <p class="ur_feed_p">Your feed</p>
                                        </div>
                                        
                                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	
                                            <div class="btn-group" data-toggle="buttons">
                                              <label class="btn btn-default active">
                                                <input type="checkbox" autocomplete="off" checked> <span class="span_follow">Following</span>
                                              </label>
                                              <label class="btn btn-default">
                                                <input type="checkbox" autocomplete="off"> <span class="span_follow">Interactions</span>
                                              </label>
                                            </div>
                                        
                                        </div>
                                        
                                    </div>
                                </div><!-- End: urfeed_main -->
                            </div>
                            
                        </div><!-- End: ur_feed -->
                    </div>
                    <div class="clearfix"></div>
					
                    
                    <div class="row">
                        <div class="following_interaction"><!-- Begin: following_interaction -->
                        
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                <div class="following_left"><!-- Begin: following_left -->
                                
                                    <div class="row">
                                    
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="following_left_box"><!-- Begin: following_left_box -->
                                            
                                            <div class="photobox_follow">
                                                <img src="<?php echo base_url(); ?>assets/frontend/images/products/follow01.jpg" class="img-responsive" />
                                            </div>
                                            <div class="photobox_follow">
                                                <img src="<?php echo base_url(); ?>assets/frontend/images/products/follow02.jpg" class="img-responsive" />
                                            </div>
                                            <div class="photobox_follow">
                                                <img src="<?php echo base_url(); ?>assets/frontend/images/products/follow03.jpg" class="img-responsive" />
                                            </div>
                                            <div class="photobox_follow">
                                                <img src="<?php echo base_url(); ?>assets/frontend/images/products/follow04.jpg" class="img-responsive" />
                                            </div>
                                            
                                            <div class="follow_title">
                                                <div class="ft_txt">
                                                    <h6 class="ft_txt_h6">Sonofa Wood Cutter &nbsp;<span class="span_fttxt"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i></span></h6>
                                                    <p class="ft_txt_p">Electroformed Raw Crystal Jewel...</p>
                                                </div>
                                                <div class="ft_heart">
                                                    <a href="#"><i class="fa fa-heart-o"></i></a>
                                                </div>
                                            </div>
                                            
                                            <div class="follow_pshop">
                                                <div class="ft_txt">
                                                    <p class="follow_pshop_p">One of our most popular shops </p>
                                                </div>
                                                <div class="oneshoplist">
                                                    <!-- Single button -->
                                                    
                                                    <div class="btn-group" style="border:none;">
                                                      <button type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border:none;">
                                                       <p class="oneshoplist_p">...</p>
                                                      </button>
                                                      <ul class="dropdown-menu">
                                                        <li><a href="#"><span class="span_btn">Remove from my feed.</span></a></li>
                                                      </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div><!-- End: following_left_box -->
                                    </div>
                                    
                                    
                                    
                                    
                                    

                                    </div>
                                    
                                </div><!-- End: following_left -->
                            </div>
                            
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="following_right"><!-- Begin: following_right -->
                                
                                	<div class="row">
                                    
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="ctsell_app01"><!-- Begin: ctsell_app -->
                                                
                                                <h3 class="ctsell_app01_h3">ctSell app: Tap into inspiration</h3>
                                                <h6 class="ctsell_app01_h6">Get a free download link. <a href="#">Learn More</a></h6>
                                                
                                                <div class="searh_btn01">
                                                    <div class="input-group">
                                                      <input type="text" class="form-control" placeholder="(123) 456 78910">
                                                      <span class="input-group-btn">
                                                        <button class="btn btn-default" type="button">Send!</button>
                                                      </span>
                                                    </div><!-- /input-group -->
                                                </div>
                                                
                                                <p class="ctsell_app01_p">Your standard messaging and data rates may apply.</p>
                                                
                                            </div><!-- End: ctsell_app -->
                                        </div>
                                        
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="ctsell_app02"><!-- Begin: ctsell_app02 -->
                                                
                                                <h3 class="ctsell_app02_h3">Browse</h3>
                                                
                                                <div class="ctsell_items"><!-- Begin: ctsell_items -->
                                                    <ul>
                                                        <li><a href="#">Trending Items</a></li>
                                                        <li><a href="#">ctSell Local</a></li>
                                                    </ul>
                                                </div><!-- End: ctsell_items -->
                                                
                                                <div class="story_behind"><!-- Begin: story_behind -->
                                                    <h3 class="story_behind_h3">Story Behind the Shop &nbsp;&nbsp;<span class="span_btn"><a href="#">See more</a></span></h3>
                                                    <p class="story_behind_p"><img src="<?php echo base_url(); ?>assets/frontend/images/products/story_behind.jpg" style="margin: 0 12px 0px 0px;" align="left" vspace="5" hspace="5"><strong>Plywood Office</strong><br />Get a glimpse into the process of this architect-turned-furniture maker.<br />
                                                    <a href="#">Read the story and tour their studio</a></p>
                                                </div><!-- End: story_behind -->
                                                
                                                <div class="pwoffice_pic"><!-- Begin: pwoffice_pic -->
                                                    <ul>
                                                        <li><a href="#"><img src="<?php echo base_url(); ?>assets/frontend/images/products/urpic4u06.jpg" class="img-responsive" alt="photo" /></a></li>
                                                        <li><a href="#"><img src="<?php echo base_url(); ?>assets/frontend/images/products/urpic4u05.jpg" class="img-responsive" alt="photo" /></a></li>
                                                        <li><a href="#"><img src="<?php echo base_url(); ?>assets/frontend/images/products/urpic4u03.jpg" class="img-responsive" alt="photo" /></a></li>
                                                    </ul>
                                                </div><!-- End: pwoffice_pic -->
                                                
                                                <div class="more_from"><!-- Begin: more_from -->
                                                    <h3 class="story_behind_h3">More From the ctSell Blog &nbsp;&nbsp;<span class="span_btn"><a href="#">See more</a></span></h3>
                                                    <div class="mofro_box">
                                                        <p class="story_behind_p"><a href="#"><img src="<?php echo base_url(); ?>assets/frontend/images/products/from_product01.jpg" style="margin: 0 12px 0px 0px;" align="left" vspace="5" hspace="5"></a><strong><a href="#">4 Iconic Minimalist Interiors — and How to Get the Look</a></strong><br /><a href="#"> Shop the collection</a></p>
                                                    </div>
                                                    <div class="mofro_box" id="last_box">
                                                        <p class="story_behind_p"><a href="#"><img src="<?php echo base_url(); ?>assets/frontend/images/products/from_product02.jpg" style="margin: 0 12px 0px 0px;" align="left" vspace="5" hspace="5"></a><strong><a href="#">Turn Your Pin Collection Into a Work of Art</a></strong><br /><a href="#"> Make this </a></p>
                                                    </div>
                                                </div><!-- End: more_from -->
                                                
                                                <div class="ctsell_find"><!-- Begin: ctsell_find -->
                                                    <h3 class="story_behind_h3">ctSell Finds</h3>
                                                    <p class="ctsell_find_p">Your daily Etsy shopping guide.</p>
                                                    <a type="submit" class="btn btn-default" style="margin-top:5px;">Subcribe</a>
                                                </div><!-- End: ctsell_find -->
    
                                                <div class="more_ways"><!-- Begin: more_ways -->
                                                    <h3 class="story_behind_h3">More Ways to Shop</h3>
                                                    <ul>
                                                        <li><a href="#"><i class="fa fa-circle-o"></i>&nbsp; Categories</a></li>
                                                        <li><a href="#"><i class="fa fa-circle-o"></i>&nbsp; Gift Cards</a></li>
                                                        <li><a href="#"><i class="fa fa-circle-o"></i>&nbsp; Treasury</a></li>
                                                        <li><a href="#"><i class="fa fa-circle-o"></i>&nbsp; Shop Nearby Items</a></li>
                                                        <li><a href="#"><i class="fa fa-circle-o"></i>&nbsp; Find a Shop</a></li>
                                                        <li><a href="#"><i class="fa fa-circle-o"></i>&nbsp; Search for People</a></li>
                                                        <li><a href="#"><i class="fa fa-circle-o"></i>&nbsp; Prototypes</a></li>
                                                    </ul>
                                                </div><!-- End: more_ways -->
                                                                                            
                                            </div><!-- End: ctsell_app02 -->
                                        </div>
                                        
                                    </div>
                                    
                                </div><!-- End: following_right -->
                            </div>
                            
                        </div><!-- End: following_interaction -->
                    </div>
					
					

                </div><!-- End: ourpic4_you -->
            </div>
        </div>
        
    </div>
</div><!-- End: inner_page -->


<?php $this->load->view('../../front-templates/footer.php'); ?>
