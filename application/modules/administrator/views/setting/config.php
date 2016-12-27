<?php
	// Common files are loaded
	$this->load->view('../../templates/head-form.php');
	$this->load->view('../../templates/headeer.php');
	$this->load->view('../../templates/sidebar-left.php');

    extract($editdata);
?>

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <!-- page start-->
            
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        
						<header class="panel-heading">
                            <h3 style="text-transform: lowercase;font-size:18px;"><i class="fa fa-refresh"></i>&nbsp;<?php echo $breadcrumb; ?></a></h3>
                            <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
                                <a class="fa fa-cog" href="javascript:;"></a>
                                <a class="fa fa-times" href="javascript:;"></a>
                             </span>
                        </header>

                        <?php
                            // Success Or Failor check
    						if(isset($success_msg)){
    							echo '<h4 id="msg" class="text-primary"> <i class="fa fa-check-circle"></i> '.$success_msg.' </h4>';
    						}else if(isset($error_msg)){
    							echo '<h4 class="text-danger"> <i class="fa fa-exclamation-triangle"></i> '.$error_msg.' </h4>';
    						}
                        ?>

                        <div class="panel-body">
                            <div class="form">
                                <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>administrator/setting/conf/<?php echo $setting_id; ?>">

									<div class="form-group ">
                                        <label for="listingcost" class="control-label col-lg-3">Listing Cost ( $ - Cent ) :</label>
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <input class="form-control" required="required" id="listingcost" name="listingcost" type="text" value="<?php echo $listing_cost; ?>" />
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="productrenewal" class="control-label col-lg-3">Product Renewal Periods (Month) :</label>
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <input class="form-control" id="productrenewal" required="required" name="productrenewal" type="text" value="<?php echo $product_renewal; ?>" />
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="sellcommission" class="control-label col-lg-3">Sells Commission (%) :</label>
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <input class="form-control" id="sellcommission" required="required" name="sellcommission" type="text" value="<?php echo $sell_commission; ?>" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-6">
                                            <button class="btn btn-primary" type="submit"><i class="fa fa-refresh"></i>&nbsp;Update</button>
                                            <button class="btn btn-default" type="button"><i class="fa fa-ban"></i>&nbsp;Cancel</button>
                                        </div>
                                    </div>
									
                                </form>
								
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <!-- page end-->
        </section>
    </section>
    <!--main content end-->
	
<?php //include('inc/sidebar-right.php'); ?>

</section>

<?php
	$this->load->view('../../templates/form-footer.php');
?>
