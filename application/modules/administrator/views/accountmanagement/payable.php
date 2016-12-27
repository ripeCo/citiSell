<?php

	// Common files are loaded
	$this->load->view('../../templates/head-view.php');
	$this->load->view('../../templates/headeer.php');
	$this->load->view('../../templates/sidebar-left.php');

	if(isset($success_msg)){
		
?>
<script> <!-- This Script for Page redirect after 4 second -->
	setTimeout(function(){
		window.location.href = '<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/payable'; ?>';
	},3000)
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
												<th width="10%">Current Month</th>
												<th width="15%">Shop Name</th>
												<th width="45%">Payment Info</th>
												<th width="10%">Payable Amounts (USD)</th>
												<th width="10%">Action</th>
											</tr>
										</thead>
										<tbody>
										
										<?php
										
											$gTotal 	= 0;
											
										?>
										
										<?php

											$i=1; foreach ($shopdetails as $result){
												
												$shpid = $result->shopid;
												
												$sqlShopPaymentDetails = $this->db->query("select * from mega_paymentdetails where shopid=$shpid and paymentmade='Pending' order by paymentdetailsid DESC");
												
												if($sqlShopPaymentDetails->num_rows() > 0){
												
													extract($sqlShopPaymentDetails->row_array());
													
													
													$pmntdetailsid = $paymentdetailsid;
												
													if($currentbalance > 0){
										?>
										
											
										
											<tr>

												<td> <?php echo date('F Y'); ?> </td>
												<td> <?php echo $result->shop_name; ?> </td>
												<td>
													<?php
														$sqlShopPaymentMethodsInfo = $this->db->query("select * from mega_paymentmethods where shopid=$shpid");	
														extract($sqlShopPaymentMethodsInfo->row_array());
														
														if($paymenttype == 'Creditcard'){
															echo "<h5><span class='text-success'>$paymenttype</span> [ <br/> <b>Name on Card - </b>$nameoncard, <br/> <b>Card Name - </b>$cardname, <br/> <b>Card Number - </b>$cardnumber <br/>]</h5>";
														}
														
														
														if($paymenttype == 'Paypal'){
															echo "<h5><span class='text-success'>$paymenttype</span> [ <br/> <b>Account Id - </b>$paymentemail <br/>]</h5>";
														}
														
													?>
												</td>
												<td> 
													$ 
													<?php
														$totalAmounts = $currentbalance;
														echo $totalAmounts;
														
														$gTotal += $totalAmounts;
													?> 
												</td>
												
												<td align="center">
													<div class="btn-group">
														
														<a href="<?php echo base_url();?>administrator/account/paymentmade/<?php echo $shpid;?>/<?php echo $pmntdetailsid; ?>/<?php echo $userid; ?>"  title="Payment Made" type="button" class="btn btn-icon btn-danger">
															<i class="icon-coin"></i> Payment Made
														</a>
														
													</div>
												</td>

											</tr>
											
										<?php } } } ?>
										

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
