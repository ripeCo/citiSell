<?php
	$this->load->view('../../front-templates/head.php');
	$this->load->view('../../front-templates/header.php');
	$this->load->view('../../front-templates/navigation.php');
?>
	<div class="shippinglabel">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="shippingpanel">
						<h3>Shipping labels</h3>
						<div class="shippingmnutb">
							<ul class="nav nav-tabs" style="padding-left:20px;">
								<li class="active"><a href="<?php echo base_url('page/shipping'); ?>">Buy Shipping Labels</a></li>
								<li><a href="<?php echo base_url('page/shipping/purchasedlbl'); ?>">Purchased Label <strong>12</strong></a></li>
								<li><a href="<?php echo base_url('page/shipping/refundedlbl'); ?>">Refunded Labels <strong>07</strong></a></li>
								<li><a href="<?php echo base_url('page/shipping/optionlbl'); ?>">Options</a></li>
							</ul>
						</div>
						<div class="shippanelbody">
							<div class="row">
								<div class="col-lg-9">
									<div class="shippingpnl">
										<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
											<span class="lbltxttop">
												<strong><?=count($orderDetails)?> item to
													<?php
														if ($orderDetails[0]['preferredAddress'] == 1) {
															if ($orderDetails[0]['user_country'] == "USA")
																echo $orderDetails[0]['user_city'], ", ", $orderDetails[0]['user_state'];
															else
																echo $orderDetails[0]['user_country'];
														} elseif ($orderDetails[0]['preferredAddress'] == 2) {
															if ($orderDetails[0]['user_country2'] == "USA")
																echo $orderDetails[0]['user_city2'], ", ", $orderDetails[0]['user_state2'];
															else
																echo $orderDetails[0]['user_country2'];
														}
													?>
												</strong>
											</span>
											<span class="lbltxtbottom">
												<?php
													$date = new DateTime($orderDetails[0]['order_date']);
												?>
												<strong>Receipt <a href="">#<?php echo $orderNumber; ?></a> from <?=$shopInfo['shop_name']?> (paid on <?php echo $date->format('D. F d, Y'); ?>)</strong>
											</span>
										</button>
										<div class="collapse" id="collapseExample">
											<div class="well">
												<div class="row">
														<div class="col-md-3">
															<address><b>
																<?php
																	echo($orderDetails[0]['user_first_name'] . ' ' . $orderDetails[0]['user_last_name']);
																?></b> <br />
																<?php
																	if ($orderDetails[0]['preferredAddress'] == 1) {
																		if ($orderDetails[0]['user_country'] == "USA") {
																			echo $orderDetails[0]['user_address'], "<br />";
																			echo $orderDetails[0]['user_city'], ", ", $orderDetails[0]['user_state'], ' ', $orderDetails[0]['user_zip'], "<br />";
																			echo $orderDetails[0]['user_country'];
																		} else {
																			echo $orderDetails[0]['notUSfullAddress'], '<br />', $orderDetails[0]['user_country'];
																		}
																	} elseif ($orderDetails[0]['preferredAddress'] == 2) {
																		if ($orderDetails[0]['user_country2'] == "USA") {
																			echo $orderDetails[0]['user_address2'], "<br />";
																			echo $orderDetails[0]['user_city2'], ", ", $orderDetails[0]['user_state2'], ' ', $orderDetails[0]['user_zip2'], "<br />";
																			echo $orderDetails[0]['user_country2'];
																		} else {
																			echo $orderDetails[0]['notUSfullAddress2'], '<br />', $orderDetails[0]['user_country2'];
																		}
																	}
																?>
															 </address>
														</div>
														<div class="col-md-9">
															<?php
																foreach ($orderDetails as $image)
																	echo $image['productImage'];
															?>
														</div>
												</div>
												<div class="row">
													<div class="panel panel-default">
														<div class="panel-body">
															<div class="col-lg-12">
																<div class="row">
																	<div class="col-lg-3">
																		Note to <b><?php echo($orderDetails[0]['user_first_name'] . ' ' . $orderDetails[0]['user_last_name']); ?></b>
																	</div>
																	<div class="col-lg-9">
																		<div class="panel panel-default">
																			<div class="panel-body">
																				<b>Shipping Method:</b> <span id="shippingMethodStamp"><?=$shippingRates[0]['desc']?></span><br>
																				<b>Packaging:</b> <span id="packagingType"><?=$packagingTypes[0]?></span>
																			</div>
																		</div>
																		<div class="col-lg-6">
																			Shipping Method<br>
																			<select name="shippingMethod" id="shippingMethod">
																				<?php
																					foreach ($shippingRates as $index => $shippingRate)
																						echo "<option value='$index'>" . $shippingRate['desc'] . "</option>";
																				?>
																			</select><br><br>

																			Package Type<br>
																			<select name="packagingTypes" id="packagingTypes">
																				<?php
																					foreach ($packagingTypes as $packagingType)
																						echo "<option value='$packagingType'>$packagingType</option>";
																				?>
																			</select><br><br>

																			Package Dimension<br>
																			(Width x length x height)<br>
																			<input type="text" name="width" id="width" size="1" maxlength="3"> x 
																			<input type="text" name="length" id="length" size="1" maxlength="3"> x 
																			<input type="text" name="height" id="height" size="1" maxlength="3"> inches

																			<br><br>Package Weight<br>
																			<input type="text" name="lbs" id="lbs" size="1" maxlength="3"> lbs
																			<input type="text" name="oz" id="oz" size="1" maxlength="3"> oz.

																			<br><br>Insurance (optional)<br>
																			<input type="text" name="insurance" id="insurance" size="3" maxlength="9" value="" placeholder="0.00"><br><br>

																			<input type="checkbox" name="signature" id="signature">Signature Confirmation
																		</div>
																		<div class="col-lg-6">
																			<b>Package Costs</b><br>
																			<table style="width: 100%">
																				<tr>
																					<td>Postage</td>
																					<td id="postageValue">0.00</td>
																				</tr>
																				<tr>
																					<td>Delivery Confirmation</td>
																					<td>Included</td>
																				</tr>
																				<tr>
																					<td>USPS Insurance</td>
																					<td>Included</td>
																				</tr>
																				<tr>
																					<td><hr></td>
																					<td><hr></td>
																				</tr>
																				<tr>
																					<td>Package Total</td>
																					<td id="packageTotalValue">0.00</td>
																				</tr>
																			</table>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-3">
									<div class="shippingcrt">
										<span class="lftshipcrt"><strong>0 labels</strong></span>
										<span class="rightshipcrt"><strong>$ 0.00</strong></span>
										<div style="clear:both;"></div>
										<button class="shipsubmt" id="confirmAndBuy">Confirm and Buy</button>
										<div class="">
											<br />
											<span>Ship Date</span><br />
											<select id="shippingDate" name="shippingDate">
												<?php
													$date = new DateTime();
													echo "<option value='" . $date->format('F d, Y') . "'>Today - " . $date->format('F d, Y') . "</option>";
													for ($i=0; $i < 56; $i++) {
														$date = $date->add(new DateInterval('P1D'));
														echo "<option value='" . $date->format('F d, Y') . "'>" . $date->format('F d, Y') . "</option>";
													}
												?>
											</select>

											<br><br>
											<p>We'll email the buyer on</p>
											<p><b id="shippingDateStamp"></b></p>
											<br>
											<b>Ship from Address</b><br>
											<address>
												<?php
													echo $shopInfo['display_name'], "<br>";
													if ($shopInfo['preferredAddress'] == 1) {
														if ($shopInfo['user_country'] == "USA") {
															echo $shopInfo['user_address'], "<br />";
															echo $shopInfo['user_city'], ", ", $shopInfo['user_state'], ' ', $shopInfo['user_zip'], "<br />";
															echo $shopInfo['user_country'];
														} else {
															echo $shopInfo['notUSfullAddress'], '<br />', $shopInfo['user_country'];
														}
													} elseif ($shopInfo['preferredAddress'] == 2) {
														if ($shopInfo['user_country2'] == "USA") {
															echo $shopInfo['user_address2'], "<br />";
															echo $shopInfo['user_city2'], ", ", $shopInfo['user_state2'], ' ', $shopInfo['user_zip2'], "<br />";
															echo $shopInfo['user_country2'];
														} else {
															echo $shopInfo['notUSfullAddress2'], '<br />', $shopInfo['user_country2'];
														}
													}
													
													echo "<br>", $shopInfo['user_phone'];
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
	</div>

	<script type="text/javascript">
		$(document).ready(function() {
			$("#shippingDateStamp").text($("#shippingDate").val());


			$("#shippingDate").change(function() {
				$("#shippingDateStamp").text($("#shippingDate").val());
			});			

			$("#packagingTypes").change(function() {
				$("#packagingType").text($("#packagingTypes").val());
			});


			if (typeof(Storage) !== "undefined")
				localStorage.setItem('shippingRates', JSON.stringify(<?=json_encode($shippingRates)?>));
			else {
			    console.log("Sorry! No Web Storage support.");
			    return;
			}

			var shippingRate = JSON.parse(localStorage.getItem('shippingRates'));

			$("#postageValue").text(shippingRate[0]['rate']);
			var packageTotalValue = parseFloat(shippingRate[0]['rate']) + 0; // add more here...
			$("#packageTotalValue").text(packageTotalValue);

			$("#shippingMethod").change(function() {
				var selectedShippingMethod = $("#shippingMethod").val();
				$("#postageValue").text(shippingRate[selectedShippingMethod]['rate']);
				// $("#packageTotalValue").text(shippingRate[selectedShippingMethod]['rate']);

				var packageTotalValue = parseFloat(shippingRate[selectedShippingMethod]['rate']) + 0; // add more here...
				$("#packageTotalValue").text(packageTotalValue);
			});


			// confirm and buy
			$("#confirmAndBuy").click(function() {
				var shippingMethod = $("#shippingMethod").val();
				var packagingType = $("#packagingTypes").val();
				var width = $("#width").val();
				var length = $("#length").val();
				var height = $("#height").val();
				var lbs = $("#lbs").val();
				var oz = $("#oz").val();
				var insurance = $("insurance").val();
				var signature = $("#signature").val();
				var shippingDate = $("#shippingDate").val();

				if (!shippingMethod) { alert("No shipping Method."); $("#shippingMethod").focus(); return; };
				if (!packagingType) { alert("No packing type."); $("#packagingTypes").focus(); return; };
				if (!width) { alert("Please input width."); $("#width").focus(); return; };
				if (!length) { alert("Please input length."); $("#length").focus(); return; };
				if (!height) { alert("Please input height."); $("#height").focus(); return; };
				if (!lbs) { alert("Please input pounds."); $("#lbs").focus(); return; };
				// if (!oz) { return; };
				// if (!insurance) { return; };
				// if (!signature) { return; };
				// if (!shippingDate) { return; };

				if (!$.isNumeric(width)) { alert("Width must be numeric."); $("#width").focus(); return; };
				if (!$.isNumeric(length)) { alert("Length must numeric."); $("#length").focus(); return; };
				if (!$.isNumeric(height)) { alert("Height must be numeric."); $("#height").focus(); return; };
				if (!$.isNumeric(lbs)) { alert("Lbs must be in numeric."); $("#lbs").focus(); return; };

				var url = "<?=base_url();?>page/shipping/";
				var data = {
					shippingMethod: shippingMethod,
					packagingType: packagingType,
					width: width,
					length: length,
					height: height,
					lbs: lbs,
					oz: oz,
					insurance: insurance,
					signature: signature,
					shippingDate: shippingDate,
				};

				$.post(url, data, function(data) {
					console.log(data);
				});

				alert("Okay");
			});
				
		});
	</script>

<?php $this->load->view('../../front-templates/footer.php'); ?>