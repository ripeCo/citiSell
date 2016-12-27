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
												<th width="10%">Billing Month</th>
												<th width="15%">Shop Name</th>
												<th width="10%">Receivable Amounts (USD)</th>
												<th width="10%">Bill Status</th>
											</tr>
										</thead>
										<tbody>
										
										<?php
										
											$gTotal 	= 0;
											
										?>
										
										<?php

											$i=1; foreach ($accountdetails as $result){
												
												if($result->fees > 0){
										?>
										
										
											<tr>

												<td> <?php echo $result->billmonth; ?> </td>
												<td> <?php echo $result->shop_name; ?> </td>
												<td> 
													$ 
													<?php
														$totalAmounts = $result->fees;
														echo $totalAmounts;
														
														$gTotal += $totalAmounts;
													?> 
												</td>
												
												<td align="center">
													<?php if( $result->billstatus !== 'Paid' ){ ?>
															<span class="badge bg-important">Pending</span>
													<?php } ?>
												</td>

											</tr>
											
										<?php } } ?>
										

										</tbody>
										
										
										<tfoot>
											
											<tr>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td class="bg-primary text-right"><h4>Total (USD) = </h4></td>
												
												<td colspan="2" class="bg-success">
													<h4>
														<b>$<?php echo number_format($gTotal,2); ?></b>
													</h4>
												</td>
												
											</tr>
											
										 </tfoot>
										
										
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
