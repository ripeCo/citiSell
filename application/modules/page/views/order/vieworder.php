<?php
	$this->load->view('../../front-templates/head.php');
	$this->load->view('../../front-templates/header.php');
	$this->load->view('../../front-templates/navigation.php');
?>

	<div class="shippinglabel">
		<div class="container">
			<div class="row">
				<div class="col-lgo-12">
					<div class="shippingpanel">
						<h3>Open Orders</h3>
						<div class="shippingmnutb">
							<?php 
								$getuserid = $this->session->userdata('userid');
								$getshoipbyuser = $this->order_model->getshopinfobyuser($getuserid);
								$orderinfos = $this->order_model->getorderinfo($getshoipbyuser['shopid']);
							?>
							<ul class="nav nav-tabs" style="padding-left:20px;">
								<li class="active"><a href="<?php echo base_url('page/order'); ?>">Open <strong><?php echo count($orderinfos); ?></strong></a></li>
								<li><a href="<?php echo base_url('page/order/completedorder'); ?>">Completed <strong>12</strong></a></li>
								<li><a href="<?php echo base_url('page/order/allorder'); ?>">All <strong>07</strong></a></li>
								<li><a href="<?php echo base_url('page/order/canceledorder'); ?>">Canceled <strong>12</strong></a></li>
							</ul>
						</div>
						<div class="shippanelbody">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12">
									<?php 
										foreach ($orderinfos as $orderinfo) {
										$getbuyer = $this->order_model->getbuyerinfo($orderinfo['order_buyerid'])
									?>
									<div class="orderbx">
										<div class="orderbxtop">
											<div class="row">
												<div class="col-lg-8">
													<div class="orderdtails">
														<div class="buyerinfo">
															<span class="buyrico"><i class="fa fa-user"></i></span>
															<div class="buyrnm"><strong><?php echo $getbuyer['display_name']; ?></strong></div>
														</div>
														<div class="ordrdate">
															<strong>Ordered</strong>
															<span>
															<?php
																$time = strtotime($orderinfo['order_date']);
																$myFormatForView = date("M d, Y", $time).'&nbsp;&nbsp;'.date("g:i A", $time);
																echo $myFormatForView;
															?>				
															</span>
														</div>
														<div class="ttlamnt">
															<strong>Total</strong>
															<span><strong>$<?php echo $orderinfo['order_amount']; ?></strong></span>
														</div>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="shippingdtails">
														<div class="shippingtop">
															<ul class="nav nav-tabs" role="tablist">
																<li role="presentation" class="active"><a href="#paid<?php echo $orderinfo['orderid']; ?>" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-check" style="color:#0a0;margin-right:7px"></i> Paid</a></li>
																<li role="presentation"><a href="#notshipped<?php echo $orderinfo['orderid']; ?>" aria-controls="home" role="tab" data-toggle="tab">Not Shipped</a></li>
															</ul>
														</div>
														<div class="recipt">
															<span>Receipt</span><br />
															<a href="<?php echo base_url('page/order/orderdetails/'.$orderinfo['ordernumber']); ?>">#<?php echo $orderinfo['ordernumber']; ?></a>
														</div>
													</div>
												</div>
											</div>
										</div>
										
										<div class="orderbxdtails">
											<div class="row">
												<div class="col-lg-8">
													<div class="orderdtails">
														<div class="ordrstepone">
															<div class="shippmthd">
																<strong>Shipping Method : </strong> Standard Shipping
															</div>
															<div class="shippcost">
																<strong>Shipping <br /> $<?php echo $orderinfo['order_shipping_amount']; ?></strong>
															</div>
														</div>
														<?php 
															$getorderproductinfo = $this->order_model->getorderproductinfo($getshoipbyuser['shopid'], $orderinfo['orderid']);
															foreach ($getorderproductinfo as $productinfo) {
														?>
														<div class="ordrsteptwo">
															<div class="colnm thumbpro">
																<?php
																	$getprothumb = $this->order_model->getprothumb($productinfo['productid']);
																	$sname = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $getprothumb['shopname']))));	
																	$pooimglocation = base_url()."assets/frontend/images/shops/".$sname."/";
																?>
																<img src="<?php echo $pooimglocation.$getprothumb['pic_name']; ?>" alt="" />
															</div>
															<div class="colnm" style="width:50%;float:left;">
																<div class="titleproorder">
																	<a href="">
																		<?php echo $productinfo['product_name']; ?>
																	</a>
																</div>
																<div class="productvrtion">
																	<div class="varents">
																		<p>
																			<strong>Size : </strong> 18 inch <br /> 
																			<strong>Color : </strong> Blue
																		</p>
																	</div>
																</div>
																<div class="qnty"><strong>Quantity : </strong> <?php echo $productinfo['quantity'] ?></div>
															</div>
															<div class="colnm" style="width:32%;float:left;text-align:right;margin-top:95px;">
																<strong style="text-align:center;display:inline-block;">Price <br /> $<?php echo $productinfo['unitprice']; ?></strong>
															</div>
														</div>
														<?php } ?>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="shippingdtails">
														<div class="shippingtop">
															<div class="tab-content">
																<div role="tabpanel" class="tab-pane active" id="paid<?php echo $orderinfo['orderid']; ?>">
																	<div class="pmntmthd">
																		<strong>Payment Method</strong>
																		<span style="display:block;">Paid Via <?php echo $orderinfo['order_paymenttype']; ?></span>
																		<strong><a href="#" data-toggle="modal" data-target="#trackingModal" onClick="getTrackingStatus('<?=$orderinfo['trk_main']?>')"><?=$orderinfo['trk_main']?></a></strong>
																		
																		<strong style="margin-top:20px;">Paid On 
																		<?php
																			$time = strtotime($orderinfo['order_date']);
																			$myFormatForView = date("M d, Y", $time).'&nbsp;&nbsp;'.date("g:i A", $time);
																			echo $myFormatForView;
																		?>
																		</strong>
																	</div>
																</div>
																<div role="tabpanel" class="tab-pane" id="notshipped<?php echo $orderinfo['orderid']; ?>">
																	<div class="shippiglbllink">
																		<a href="<?php echo base_url('page/shipping/reciept/'.$orderinfo['ordernumber']); ?>" class="shipanchor">Print Shipping Label</a>
																		<a href="javascript:void();" data-toggle="modal" data-target="#notifytobuyer" class="shipanchor">Mark As Shipped</a>
																	</div>
																	<div class="shipto">
																		 <strong>Ship To</strong>
																		 <address>
																			<?php
																				echo($orderinfo['user_first_name'] . ' ' . $orderinfo['user_last_name']);
																			?> <br />
																			<?php
																				if ($orderinfo['preferredAddress'] == 1) {
																					echo $orderinfo['user_address'], "<br />";
																					echo $orderinfo['user_city'], ", ", $orderinfo['user_state'], ' ', $orderinfo['user_zip'], "<br />";
																					echo $orderinfo['user_country'];
																				} elseif ($orderinfo['preferredAddress'] == 2) {
																					echo $orderinfo['user_address2'], "<br />";
																					echo $orderinfo['user_city2'], ", ", $orderinfo['user_state2'], ' ', $orderinfo['user_zip2'], "<br />";
																					echo $orderinfo['user_country2'];
																				}
																			?>
																		 </address>
																	</div>
																</div>
														    </div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								    <?php } ?>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="notifytobuyer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Mark As Shipped and Notify Buyer </h4>
				</div>
				<form action="<?php echo base_url(); ?>" class="" method="post">
				<div class="modal-body msbuyrnote">
					
						<div class="form-group">
							<label for="shipdate">Ship Date</label>
							<input class="form-control" type="text" name="shipdate" />
						</div>
						<div class="form-group">
							<label for="notetobuyer">Note to buyer</label>
							<textarea class="form-control" name="notetobuyer" id="" cols="30" rows="10"></textarea>
						</div>
						<div class="form-group">
							<label for="trackingnumber">Tracking Number</label>
							<input class="form-control" type="text" name="shiptracknumber" />
						</div>
						<div class="form-group">
							<label for="Shipprovider">Shipping Provider</label>
							<select name="shipprovider" class="form-control" id="">
								<option value="" selected="selected">Select Shipping Provider</option>
								<option value="1">USPS</option>
							</select>
						</div>
				</div>
				
				<div class="modal-footer">
					<button type="submit" class="btn btn-default">Submit</button>
				</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Tracking Modal -->
	<div class="modal fade" id="trackingModal" tabindex="-1" role="dialog" aria-labelledby="trackingLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="trackingLabel">Tracking</h4>
				</div>
				<div class="modal-body">
					
				</div>
				<div class="modal-footer"></div>
			</div>
		</div>
	</div> <!-- End tracking Modal -->

	<script type="text/javascript">
		function getTrackingStatus(trackingNumber) {
			var url = "<?=base_url();?>page/Shipping/tracking/" + trackingNumber;
			// var url = "<?=base_url();?>page/testonly/tracking/" + trackingNumber;
			$("#trackingModal .modal-body").empty();
			$("#trackingModal .modal-footer").empty();

			$.get(url, function(response) {
				if (response['Data']['Errors'].length > 0) {
					$("#trackingModal .modal-body").append("<p>" + response['Data']['Errors'][0]['Description'] + "</p>");
				} else {
					$("#trackingModal .modal-body").append('<table class="table" id="trackingTable"></table>');
					$("#trackingTable").append("<tr><th>Date</th><th>Shipping</th><th>Event</th></tr>");
					$.each(response['Data']['Packages'][0]['Activity'], function(index, item) {
						var location = item.Location.City + ', ' + item.Location.State + ', ' + item.Location.PostalCode + ', ' + item.Location.Country;
						markup = "<tr><td>" + item.Time + "</td><td>" +  location + "</td><td>" + item.StatusDescription + "</td></tr>";
						$("#trackingTable").append(markup);
					});

					$("#trackingModal .modal-body").append("<p>Shipped on <b><span id='shipDate'></span></b></p>");

					var a_dom = "<a href='https://tools.usps.com/go/TrackConfirmAction_input?qtc_tLabels1=" + trackingNumber + "' target='_blank'>" + trackingNumber + "</a>";

					$("#trackingModal .modal-footer").append(a_dom);

					$("#shipDate").text(response['shipDate']);
				}				
			});
		}
	</script>

<?php $this->load->view('../../front-templates/footer.php'); ?>