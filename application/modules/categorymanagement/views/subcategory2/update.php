<?php
// Common files are loaded
$this->load->view('../../templates/head-form.php');
$this->load->view('../../templates/headeer.php');
$this->load->view('../../templates/sidebar-left.php');

extract($editdata);

if(isset($success_msg)){
?>
<script> <!-- This Script for Page redirect after 4 second -->
	setTimeout(function(){
		window.location.href = '<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2); ?>';
	},4000)
</script>
<?php } ?>

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <!-- page start-->

            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">

                        <h5 style="position:relative;top:10px;right: 100px;">
                            <a class="btn btn-primary pull-right" href="<?php echo base_url(); ?><?php echo $this->uri->segment(1).'/'.$this->uri->segment(2).'/addlev2subcat'; ?>">
                                <i class="fa fa-plus-square"></i>&nbsp;Add New Record
                            </a>
                            <span style="margin-right:5px;float:right;">&nbsp;</span>

                            <a class="btn btn-success pull-right" href="<?php echo base_url(); ?><?php echo $this->uri->segment(1).'/'.$this->uri->segment(2); ?>">
                                <i class="fa fa-eye"></i>&nbsp;View Record
                            </a>
                        </h5>

                        <header class="panel-heading">
                            <h3><i class="fa fa-plus-circle"></i>&nbsp;<?php echo $breadcrumb; ?></h3>
                            <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
                                <a class="fa fa-cog" href="javascript:;"></a>
                                <a class="fa fa-times" href="javascript:;"></a>
                             </span>
                        </header>

                        <?php
                            // Success Or Failor check
                            if(isset($success_msg)){
                                echo '<h4 id="msg" class="text-primary bg-success pdd5"> <i class="fa fa-check-circle"></i> '.$success_msg.' </h4>';
                            }else if(isset($error_msg)){
                                echo '<h4 class="text-danger bg-danger pdd5"> <i class="fa fa-exclamation-triangle"></i> '.$error_msg.' </h4>';
                            }
                        ?>

                        <div class="panel-body">
                            <div class="form">
                                <form class="cmxform form-horizontal" id="signupForm0" method="post" action="<?php echo base_url(); ?>categorymanagement/subcategory2/updatesubcat/<?php echo $sub_category_lev2_id; ?>">

                                    <div class="form-group">
                                        <label class="col-lg-3 col-md-3 col-sm-3 control-label">Category Name :</label>
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <select id="e2" style="width:380px" name="CategoryID" class="populate placeholder">
                                                <option value="">Choose a Category</option>
                                                <option selected value="<?php echo $category_id; ?>"><?php echo $category_name; ?></option>
                                                
												<?php
													foreach($mainmenusArray as $key1 => $values1){
												?>
												
												<optgroup label="<?php echo $values1; ?>">
												
                                                    <?php foreach($catview[$values1] as $result){ ?>
													    <option value="<?php echo $result->category_id; ?>"><?php echo $result->category_name; ?></option>
													<?php } ?>

												</optgroup>
												
												<?php } ?>
												
                                            </select>
                                        </div>
                                    </div>
                                    <?php echo form_error('CategoryName'); ?>
                                    
                                    <div class="form-group">
										<label class="col-lg-3 col-md-3 col-sm-3 control-label">Sub Category Name :</label>
										<div class="col-lg-3 col-md-3 col-sm-3">
											<select id="e1" style="width:380px" name="SubCategoryID" class="populate placeholder">
                                                <option value="">Choose a Sub Category</option>
                                                <option selected value="<?php echo $sub_category_id; ?>"><?php echo $sub_category_name; ?></option>

                                               <?php
													foreach($mainmenusArray as $key2 => $values2){
												?>
												
												<?php foreach($catview[$values2] as $result2){ ?>
												<optgroup label="<?php echo $values2; ?>  >==  <?php echo $result2->category_name; ?>">
												
                                                  
													<?php foreach($viewSubCatdata[$result2->category_id] as $result3){ ?>
													    <option value="<?php echo $result3->sub_category_id; ?>"><?php echo $result3->sub_category_name; ?></option>
													<?php } ?>    
													

												</optgroup>
												<?php } ?>
												<?php } ?>

											</select>
										</div>
									</div>
                                    <?php echo form_error('SubCategoryName'); ?>


                                    <div class="form-group ">
                                        <label for="SubCategoryLev2Name" class="control-label col-lg-3">Sub Category Level2 Name :</label>
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <input class=" form-control" required="required" id="SubCategoryLev2Name_old" name="SubCategoryLev2Name_old" type="hidden" value="<?php echo $sub_category_lev2_name ?>" />
                                            <input class=" form-control" required="required" id="SubCategoryLev2Name" name="SubCategoryLev2Name" type="text" value="<?php echo $sub_category_lev2_name; ?>" />
                                        </div>
                                    </div>
                                    <?php echo form_error('SubCategoryLev2Name'); ?>


                                    <div class="form-group ">
                                        <label for="agree" class="control-label col-lg-3 col-sm-3">&nbsp;</label>
                                        <div class="col-lg-6 col-sm-9">
                                            &nbsp;
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="sub_cat_lev2_status" class="control-label col-lg-3 col-sm-3">Status :</label>
                                        <div class="col-lg-6 col-sm-9">
                                            <?php if($sub_cat_lev2_status == 1){ ?>
                                                <input  type="checkbox" style="width: 20px" checked="checked" class="checkbox form-control" id="sub_cat_lev2_status" name="sub_cat_lev2_status" />
                                            <?php }else{ ?>
                                                <input type="checkbox" style="width: 20px" class="checkbox form-control" id="sub_cat_lev2_status" name="sub_cat_lev2_status" />
                                            <?php } ?>
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
