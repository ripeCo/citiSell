<?php
	// Common files are loaded
	$this->load->view('../../templates/head-form.php');
	$this->load->view('../../templates/headeer.php');
	$this->load->view('../../templates/sidebar-left.php');

    extract($shoppaymentdetails);
	
	$shhpid 			= $this->uri->segment(4);
	$paymentdetailsid 	= $this->uri->segment(5);
	$userid 			= $this->uri->segment(6);
?>

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <!-- page start-->
            
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        
						<header class="panel-heading">
                            <h3><i class="fa fa-refresh"></i>&nbsp;<?php echo $breadcrumb; ?></a></h3>
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
                                <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>administrator/account/paymentmadeconfirm/<?php echo $shhpid;?>/<?php echo $paymentdetailsid; ?>/<?php echo $userid; ?>">

									<div class="form-group ">
                                        <label for="shopname" class="control-label col-lg-3">Shop Name :</label>
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <input class="form-control" onfocus="this.blur();" id="shopname" name="shopname" type="text" value="<?php echo $shop_name; ?>" />
                                        </div>
                                    </div>
									
									
									<div class="form-group ">
                                        <label for="shopname" class="control-label col-lg-3">Payable amounts(USD) :</label>
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <input class="form-control" onfocus="this.blur();" id="payableamounts" name="payableamounts" type="text" value="<?php echo $currentbalance; ?>" />
                                        </div>
                                    </div>
									
									
									<div class="form-group ">
                                        <label for="shopname" class="control-label col-lg-3">Paid amounts(USD) :</label>
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <input class="form-control" required="required" id="paidamounts" name="paidamounts" type="text" placeholder="Paid amounts?" />
                                        </div>
                                    </div>
									
									<?php //echo $cpaymentmonth = date('F d, Y'); ?>

                                    <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-6">
                                            <button class="btn btn-primary" type="submit"><i class="fa fa-refresh"></i>&nbsp;Payment Made</button>
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
