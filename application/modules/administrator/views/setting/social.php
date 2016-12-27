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
                                <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>administrator/setting/socialupdate/<?php echo $socialid; ?>">

									<div class="form-group ">
                                        <label for="facebook" class="control-label col-lg-3">Facebook :</label>
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <input class="form-control" id="facebook" name="facebook" type="text" value="<?php echo $facebook; ?>" />
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="gplus" class="control-label col-lg-3">Google Plus :</label>
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <input class="form-control" id="gplus" name="gplus" type="text" value="<?php echo $gplus; ?>" />
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="twitter" class="control-label col-lg-3">Twitter :</label>
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <input class="form-control" id="twitter" name="twitter" type="text" value="<?php echo $twitter; ?>" />
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="linkedin" class="control-label col-lg-3">Linkedin :</label>
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <input class="form-control" id="linkedin" name="linkedin" type="text" value="<?php echo $linkedin; ?>" />
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="pinterest" class="control-label col-lg-3">Pinterest :</label>
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <input class="form-control" id="pinterest" name="pinterest" type="text" value="<?php echo $pinterest; ?>" />
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
