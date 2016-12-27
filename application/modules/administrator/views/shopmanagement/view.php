<?php

	// Common files are loaded
	$this->load->view('../../templates/head-view.php');
	$this->load->view('../../templates/headeer.php');
	$this->load->view('../../templates/sidebar-left.php');

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
            <div class="col-sm-12">
                <section class="panel">

                    <h5 style="position:relative;top:10px;right: 100px;">
                        
                        <a class="btn btn-success pull-right" href="<?php echo base_url(); ?><?php echo $this->uri->segment(1).'/'.$this->uri->segment(2); ?>">
                            <i class="fa fa-eye"></i>&nbsp;View Record
                        </a>
						
                    </h5>

					<header class="panel-heading">
                       <i class="fa fa-eye"></i> <?php echo $breadcrumb; ?>
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
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
                        <div class="adv-table">
							<!-- Tasks table -->
							<div class="block">

								<div class="datatable-tasks">
									<table class="display table table-bordered table-striped" id="dynamic-table">
										<thead>
										<tr>
											<th>#</th>
											<th width="7%">Shop Logo</th>
											<th width="15%">Shop Name</th>
											<th width="13%">Shoplocation</th>
											<th width="10%">Created On</th>
											<th width="10%">Active Listing</th>
											<th width="10%">Deactive Listing</th>
											<th width="10%">Total Sale</th>
											<th width="10%">Shop Status</th>
											<th>Action</th>
										</tr>
										</thead>
										<tbody>

										<?php $i=1; foreach ($getshops as $result){ ?>
										
										<?php
											$this->load->model('shopmanagement_model');
										?>
										
											<tr>

												<td> <?php echo $i++; ?> </td>
												<td>
													
													<a  target="_blank" style="font-family: arial; position: relative; font-size: 15px; font-weight: bold; margin-bottom: 9px;" href="<?php echo base_url(); ?>page/yourshop/viewshop/<?php echo $result->shopid; ?>">
													
													<?php
														if( $result->shoplogo !== NULL ){
															$shoplog = $result->shoplogo;
															$sname = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $result->shop_name))));
													?>
													
													<img width="50" height="50" src="<?php echo base_url(); ?>assets/frontend/images/shops/<?php echo $sname.'/'.$shoplog; ?>" class="img-responsive img-thumbnail0" alt="Shop Logo" />
													
													<?php }else{ ?>
													
													<img width="50" height="50" src="<?php echo base_url(); ?>assets/frontend/images/shops/nologo.jpg" class="img-responsive img-thumbnail0" alt="Shop Logo" />
													
													<?php } ?>
													
													</a>
												</td>
												<td>
													<a  target="_blank" style="position: relative; font-family: arial; font-size: 15px; font-weight: bold; margin-bottom: 9px;" href="<?php echo base_url(); ?>page/yourshop/viewshop/<?php echo $result->shopid; ?>">
													
													<?php echo $result->shop_name; ?>
													
													</a>
													
												</td>
												<td> <?php echo $result->shop_location; ?> </td>
												<td> <?php echo $result->created_on; ?> </td>
												<td align="center"> <?php echo $this->shopmanagement_model->getallListingNumbers('Active',$result->shopid); ?> </td>
												<td align="center"> <?php echo $this->shopmanagement_model->getallListingNumbers('Inactive',$result->shopid); ?> </td>
												<td align="center">

													<?php
														$sspid = $result->shopid;
														$sqlSShop = $this->db->query("select * from mega_ordershop where shopid=$sspid and shippingstatus='Delivered' group by orderid");
														
														echo $sqlsqlSShopFetch = $sqlSShop->num_rows();
													?>

												</td>
												<td align="center">
													<?php if( $result->shop_status == 'Active' ){ ?>
														<span class="badge bg-primary">Active</span>
													<?php }else{ ?>
														<span class="badge bg-important"><?php echo $result->shop_status; ?></span>
													<?php } ?>
												</td>

												<td class="td-center">

													<div class="input-group-btn">
														<button type="button" class="btn btn-success" tabindex="-1">Action</button>
														<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" tabindex="-1">
															<span class="caret"></span>
														</button>

														<ul class="dropdown-menu pull-right" role="menu">

															<li>
																
																<a href="<?php echo base_url(); ?><?php echo $this->uri->segment(1).'/'.$this->uri->segment(2).'/active/'.$result->shopid; ?>">
																	<i class="fa fa-pencil-square-o"></i>
																	Active Shop
																</a>
																
															</li>
															
															<li class="divider"></li>

															<li>
																
																<a href="<?php echo base_url(); ?><?php echo $this->uri->segment(1).'/'.$this->uri->segment(2).'/suspend/'.$result->shopid; ?>">
																	<i class="fa fa-pencil-square-o"></i>
																	Suspend Shop
																</a>
																
															</li>

															<?php if($this->session->userdata('type') === 'SuperAdmin'){ ?>
															<li class="divider"></li>
															<li>
																<a onclick="return confirmDelete();" href="<?php echo base_url();?><?php echo $this->uri->segment(1).'/'.$this->uri->segment(2).'/delete/'.$result->shopid; ?>">
																	<i class="fa fa-trash-o"></i>
																	Delete
																</a>
															</li>
															<?php } ?>

														</ul>
													</div>

												</td>

											</tr>
										<?php } ?>

										</tbody>
									</table>
								</div>
							</div>
							<!-- /tasks table -->
                        </div>
                    </div>
                </section>
            </div>
        </div>


        <!-- page end-->
        </section>
    </section>
    <!--main content end-->

<?php $this->load->view('../../templates/sidebar-right.php'); ?>

</section>

<?php
	$this->load->view('../../templates/view-footer.php');
?>
