<?php
	$this->load->view('../../front-templates/head.php');
	$this->load->view('../../front-templates/header.php');
	$this->load->view('../../front-templates/navigation.php');
	
?>


<div id="discover_tems"><!-- Begin: discover_tems -->
    <div class="container">
    
        <div class="row">
            <div class="discover_head"><!-- Begin: discover_head -->
                
            	<h1 class="discover_head_h3"> &nbsp; </h1>
                
                <h1>&nbsp;</h1>
                <h3> <i class="fa fa-cc-visa"></i> <u> Outstanding Billing :: Payment Confirmation! </u></h3>
            
                
            </div><!-- End: discover_head -->
        </div>
    </div>
</div><!-- End: discover_tems -->


<div id="what_items"><!-- Begin: what_items -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="whatitem_inner"><!-- Begin: whatitem_inner -->
                    <h3 class="whatitem_inner_h3">
                        
         
                    
                    <div class="whatitem_more">
                        
						<h2 style="font-family: 'quicksandbold'; font-size:25px; color:#313131; padding-bottom:8px; text-align: left; font-weight:bold;">
							
							Dear <?php echo $this->session->userdata('displayname'); ?>,
							
						</h2>
						
						<span style="color: #7FBA01; font-size:37px; text-align: left; left: -40px; position: relative;"> <i class="fa fa-check-circle"></i>
							
							Your bill payment was successful, thank you for paid bill on time.
							
						</span><br/>
						
                    </div>
					
					
                </div><!-- End: whatitem_inner -->
            </div>
        </div>
    </div>
</div>


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
