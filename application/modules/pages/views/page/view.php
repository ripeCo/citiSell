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
                        
                        <?php if($this->session->userdata('type') == 'SuperAdmin'){ ?>
                        <a class="btn btn-primary pull-right" href="<?php echo base_url(); ?><?php echo $this->uri->segment(1).'/'.$this->uri->segment(2).'/add'; ?>">
                            <i class="fa fa-plus-square"></i>&nbsp;Add New Record
                        </a>
                        <span style="margin-right:5px;float:right;">&nbsp;</span>
                        
                        <?php } ?>

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
									<table class="table table-bordered">
										<thead>
										<tr>
											<th class="th-center">#</th>
											<th class="th-center" width="15%">Page Name</th>
											<th class="th-center" width="15%">Content Title</th>
											<th class="th-center">Content Details</th>
											<th class="th-center">Status</th>
											<th class="th-center">Action</th>
										</tr>
										</thead>
										<tbody>

										<?php $i=1; foreach ($view as $result){ ?>
											<tr>

												<td> <?php echo $i++; ?> </td>
												<td> <?php echo $result->pagename; ?> </td>
												<td> <?php echo $result->title; ?> </td>
												<td> <?php echo $result->contents; ?> </td>
												<td>
													<?php if( $result->pagestatus == 1 ){ ?>
														<span class="badge bg-primary">Active</span>
													<?php }else{ ?>
														<span class="badge bg-important">In Active</span>
													<?php } ?>
												</td>

												<td class="td-center">

													<div class="input-group-btn">
														<button type="button" class="btn btn-success" tabindex="-1">Action</button>
														<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" tabindex="-1">
															<span class="caret"></span>
														</button>

														<ul class="dropdown-menu pull-right" role="menu">

															<!--li>
																<a href="<?php //echo base_url(); ?><?php //echo $this->uri->segment(1).'/'.$this->uri->segment(2); ?>">
																	<i class="fa fa-eye"></i>
																	View
																</a>
															</li-->
															
															<li>
																<a href="<?php echo base_url(); ?><?php echo $this->uri->segment(1).'/'.$this->uri->segment(2).'/edit/'.$result->pageid; ?>">
																	<i class="fa fa-pencil-square-o"></i>
																	Edit
																</a>
															</li>

															<?php if($this->session->userdata('type') === 'SuperAdmin'){ ?>
															<li class="divider"></li>
															<li>
																<a onclick="return confirmDelete();" href="<?php echo base_url();?><?php echo $this->uri->segment(1).'/'.$this->uri->segment(2).'/delete/'.$result->pageid; ?>">
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
