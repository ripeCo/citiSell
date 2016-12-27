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
                        <h3 class="user_name_h3">
							<i class="fa fa-key"></i>  <?php echo $breadcrumb; ?>
						</h3>
                    </div><!-- End: user_name -->
					
                    
                </div>  
            </div><!-- End: ourpic4_you -->
        </div>
        <div class="clearfix"></div>


        <div class="row">
        	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="shopur_latest"><!-- Begin: shopur_latest -->
                
                    <div class="row">
                        <div class="sl_landscap"><!-- Begin: sl_landscap -->
							
							<?php
								extract($pagecontents); // Extract Page contents
							?>
							
                            <!--div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            	<div class="landseeall">
                                    <p class="landseeall_p"> <i class="fa fa-key"></i> <?php //echo $title; ?> </p>
                                </div>
                            </div-->
                            
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="dlandscape2"><!-- Begin: dlandscape2 -->
                                    <div class="row">
                                    
                                        <div class="landscape_main"><!-- Begin: landscape_main -->
											
											<h3><?php echo $title; ?></h3>
											
                                            <?php
												echo $contents; 
											?>
                                        
                                        </div><!-- End: landscape_main -->
                                        
                                    </div>
                                </div><!-- End: dlandscape2 -->
                            </div>
                            
                            
                            
                                        
                        </div><!-- End: sl_landscap -->
                    </div>
                    <div class="clearfix"></div>
                    
                    

                </div><!-- End: ourpic4_you -->
            </div>
        </div>
        
    </div>
</div><!-- End: inner_page -->


<?php $this->load->view('../../front-templates/footer.php'); ?>
