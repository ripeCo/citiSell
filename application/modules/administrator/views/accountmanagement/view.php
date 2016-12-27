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
												<th width="10%">#</th>
												<th width="15%">Order Date</th>
												<th width="15%">Order Number</th>
												<th width="15%">Payment Type</th>
												<th width="15%">Order Amounts (USD)</th>
												<th width="15%">Sales Commission (USD)</th>
												<th width="15%">Shipping Costs (USD)</th>
											</tr>
										</thead>
										<tbody>
										
										<?php
										
											$sqlShopSettings = $this->db->query("select * from mega_settings where setting_id=1");
											extract($sqlShopSettings->row_array());
										
											$gTotal 	= 0;
											$slsCtotal 	= 0;
											$shpCtotal 	= 0;
										?>
										
										<?php $i=1; foreach ($accountdetails as $result){ ?>
										
										
											<tr>

												<td> <?php echo $i++; ?> </td>
												<td> <?php echo $result->order_date; ?> </td>
												<td> <?php echo $result->ordernumber; ?> </td>
												<td> <?php echo $result->order_paymenttype; ?> </td>
												<td> 
													$ 
													<?php
														$totalAmounts = $result->order_amount;
														echo $totalAmounts;
														
														$gTotal += $totalAmounts;
													?> 
												</td>
												<td>
													$ 
													<?php
														$salesCommission = $sell_commission * $result->order_amount / 100;
														echo number_format($salesCommission,2);
														
														$slsCtotal += $salesCommission;
													?>
												</td>
												<td> 
													$ 
													<?php
														echo $shippingCost = $result->order_shipping_amount;
														
														$shpCtotal += $shippingCost;
													?>
												</td>

											</tr>
											
										<?php } ?>
										

										</tbody>
										
										
										<tfoot>
											
											<tr>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td class="bg-primary text-right"><h4>Total (USD) = </h4></td>
												
												<td class="bg-success">
													<h4>
														$<?php echo number_format($gTotal,2); ?>
													</h4>
												</td>
												
												<td class="bg-success">
													<h4>
														$<?php echo number_format($slsCtotal,2); ?>
													</h4>
												</td>
												
												<td class="bg-success">
													<h4>
														$<?php echo number_format($shpCtotal,2); ?>
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
