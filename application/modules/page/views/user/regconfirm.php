<?php
	$this->load->view('../../front-templates/head.php');
	$this->load->view('../../front-templates/header.php');
	$this->load->view('../../front-templates/navigation.php');
?>


<div id="discover_tems"><!-- Begin: discover_tems -->
    <div class="container">
    
        <div class="row">
            <div class="discover_head"><!-- Begin: discover_head -->
                
            	<h1 class="discover_head_h3">
                    
                    <?php
                        if(isset($success_msg)){
                            echo '<span class="text-success"><i class="fa fa-thumbs-up"></i> Congratulation !<span>';
                        }else{
                            echo '<span class="text-danger"><i class="fa fa-frown-o"></i> Nope !<span>';
                        }
                    ?>
                    
                </h1>
                
                
                <h3> <i class="fa fa-user"></i> <?php echo $breadcrumb; ?></h3>
            
                
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
                        
         
                    <?php
                       // Success Or Failor check
                       if(isset($success_msg)){
                           
						   echo '<h4 id="msg" class="text-primary bg-success pdd5"> <i class="fa fa-check-circle"></i> '.$success_msg.' </h4>';
                           
						   echo '<h5 class="text-primary pdd5"> <i class="fa fa-check-square-o"></i> '.$slage.' </h5>';
                       }else if(isset($error_msg)){
                           echo '<h4 class="text-danger bg-danger pdd5"> <i class="fa fa-exclamation-triangle"></i> '.$error_msg.' </h4>';
                       }
                    ?>
                             
                    </h3>
                    
                    <h1>&nbsp;</h1>
                    <h1>&nbsp;</h1>
                    
                    <div class="whatitem_more">
                        <!--p class="whatitem_more_p">
                            
                            <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#myModal">Login Here! <i class="fa fa-angle-double-right"></i></a>
                            
                            <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#myModal">Register Here! <i class="fa fa-angle-double-right"></i></a>
                            
                        </p-->
                    </div>
                </div><!-- End: whatitem_inner -->
            </div>
        </div>
    </div>
</div>




<?php $this->load->view('../../front-templates/footer.php'); ?>
