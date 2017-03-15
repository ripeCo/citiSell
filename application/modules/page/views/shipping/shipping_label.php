<?php
	$this->load->view('../../front-templates/head.php');
	$this->load->view('../../front-templates/header.php');
	$this->load->view('../../front-templates/navigation.php');
?>
<script type="text/javascript" src="<?=base_url();?>assets/frontend/js/jquery-dateFormat.min.js"></script>

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
																foreach ($images as $image)
																	echo "<img src='$image' width='75' height='75' alt=''>";
															?>
														</div>
												</div>
												<div class="row">
													<div class="panel panel-default">
														<div class="panel-body">
															<div class="col-lg-12">
																<div class="row">
																	<div class="col-lg-2">
																		Note to <b><?php echo($orderDetails[0]['user_first_name'] . ' ' . $orderDetails[0]['user_last_name']); ?></b>
																	</div>
																	<div class="col-lg-10">
																		<div class="panel panel-default">
																			<div class="panel-body">
																				<b>Shipping Method:</b>
																				<?php
																					if ($orderStatus != "Pending")
																						echo "(This item has already been processed.)";
																					elseif (!empty($meta['data']['error']))
																						echo "<span id='shippingMethodStamp'>{$meta['data']['error']}</span>";
																					else
																						echo "<span id='shippingMethodStamp'>" . reset($meta['data'])->desc . "</span>";
																				?><br>
																			</div>
																		</div>
																		<div class="col-lg-6">
																			Shipping Method<br>
																			<select name="shippingMethod" id="shippingMethod">
																				<?php
																					foreach ($meta['data'] as $index => $shippingRate)
																						echo "<option value='{$index},{$shippingRate->ServiceType}'>" . $shippingRate->desc . "</option>";
																				?>
																			</select><br>
																			Expected delivery in <span id="expectedDeliveryInDays"></span> day(s).
																			<br><br>

																			Package Dimension<br>
																			(Length x Width x height)<br>
																			<input type="text" name="length" id="length" size="1" maxlength="3"> x
																			<input type="text" name="width" id="width" size="1" maxlength="3"> x																			
																			<input type="text" name="height" id="height" size="1" maxlength="3"> inches

																			<br><br>Package Weight<br>
																			<input type="text" name="lbs" id="lbs" size="1" maxlength="3"> lbs
																			<input type="text" name="oz" id="oz" size="1" maxlength="3"> oz.

																			<br><br>Insurance in USD (optional)<br>
																			<input type="text" name="insuredValue" id="insuredValue" size="3" maxlength="9" value="" placeholder="0.00"><br><br>

																			<input type="checkbox" name="signature" id="signature" value="signature">Signature Confirmation
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
																					<td><hr></td>
																					<td><hr></td>
																				</tr>
																				<tr>
																					<td>Package Total</td>
																					<td id="packageTotalValue" class="packageTotalValue">0.00</td>
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
										<button type="button" class="shipsubmt" id="confirmAndBuy" data-toggle="modal" data-target="#myModal" disabled>Confirm and Buy</button>
										<div class="">
											<br />
											<span>Ship Date</span><br />
											<select id="shippingDate" name="shippingDate"<?php ($orderStatus != "Pending" ? print "disabled" : ""); ?>>
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

								<!-- Modal -->
								<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title" id="myModalLabel">Confirmation</h4>
											</div>
											<div class="modal-body">
												Once purchased, <b><span class="packageTotalValue"></span></b> USD will be added to your CitiSell bill. <br>By clicking Purchase you agree to the CitiSell Shipping Policy.
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal" id="modalCloseButton">Close</button>
												<button type="button" class="btn btn-primary" id="confirmPayment">Confirm Payment</button>
											</div>
										</div>
									</div>
								</div> <!-- End Modal -->
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

			if (typeof(Storage) !== "undefined") {
				localStorage.setItem('shippingRates', JSON.stringify([]));
				localStorage.setItem('shippingRates', JSON.stringify(<?=json_encode($meta['data'])?>));
			} else {
			    console.log("Sorry! No Web Storage support. Please upgrade your web browser.");
			    return;
			}

			var shippingRates = JSON.parse(localStorage.getItem('shippingRates'));

			// default values
			for (var shippingRate in shippingRates) {
				// $("#postageValue").text(shippingRates[shippingRate]['Amount']);
				// $(".packageTotalValue").text(parseFloat(shippingRates[shippingRate]['Amount']));
				// $("#shippingMethodStamp").text($("#shippingMethod option:selected").text());
				$("#expectedDeliveryInDays").text(shippingRates[shippingRate]["DeliverDays"]);
				break;
			}

			
			$("#shippingMethod").change(function() {
				$("#shippingMethodStamp").text($("#shippingMethod option:selected").text());

				var selectedShippingMethod = $("#shippingMethod").val();	// 2,US-PM
				commaIndexPos = selectedShippingMethod.indexOf(',');
				selectedShippingMethod = selectedShippingMethod.substr(0, commaIndexPos);
				$("#expectedDeliveryInDays").text(shippingRates[selectedShippingMethod]["DeliverDays"]);

				getShippingRates();
			});

			function getShippingRates() {
				// there should be loder here...

				var shippingMethod = $("#shippingMethod").val();
				if (!shippingMethod) { return; }

				var length = $("#length").val();
				var width = $("#width").val();
				var height = $("#height").val();
				var lbs = $("#lbs").val();
				var oz = $("#oz").val();
				var insuredValue = $("#insuredValue").val();
				var signature = $("#signature").is(":checked");
				var shippingDate = $("#shippingDate").val();

				if (!shippingMethod) { return; };
				if (!length) { return; };
				if (!width) { return; };
				if (!height) { return; };
				if (!lbs) { return; };
				if (!$.isNumeric(width)) { return; };
				if (!$.isNumeric(length)) { return; };
				if (!$.isNumeric(height)) { return; };
				if (!$.isNumeric(lbs)) { return; };

				var orderNumber = document.documentURI.match(/\d+/g)[1];
				var url = "<?=base_url();?>page/Shipping/shippingRates/" + orderNumber;
				var data = {
					shippingMethod: shippingMethod,
					length: length,
					width: width,
					height: height,
					lbs: lbs,
					oz: oz,
					insuredValue: insuredValue,
				};

				$.get(url, data, function(response) {
					/*if (response['data']['error'])	// if there's an error
						alert(response['data']['error'][0]['description']);
					else
						alert("Successfully processed. Tracking number: " + response['data']['response']['trk_main']);*/

					commaIndexPos = shippingMethod.indexOf(','); // 2,US-PM
					shippingMethod = shippingMethod.substr(0, commaIndexPos);
					$("#postageValue").text(response['meta']['data'][shippingMethod]['Amount']);
					$(".packageTotalValue").text(response['meta']['data'][shippingMethod]['Amount']);
					$("#confirmAndBuy").prop("disabled", false);
				});
			}

			$("#length").change(function() {
				$("#confirmAndBuy").prop("disabled", true);
				getShippingRates();
			});
			$("#width").change(function() {
				$("#confirmAndBuy").prop("disabled", true);
				getShippingRates();
			});
			$("#height").change(function() {
				$("#confirmAndBuy").prop("disabled", true);
				getShippingRates();
			});
			$("#lbs").change(function() {
				$("#confirmAndBuy").prop("disabled", true);
				getShippingRates();
			});
			$("#oz").change(function() {
				$("#confirmAndBuy").prop("disabled", true);
				getShippingRates();
			});

			$("#insuredValue").change(function() {
				/*$("#insuranceValue").text($("#insuredValue").val());
				var selectedShippingMethod = $("#shippingMethod").val();
				var packageTotalValue = parseFloat(shippingRate[selectedShippingMethod]['Amount']) + parseFloat($("#insuredValue").val());
				$(".packageTotalValue").text(packageTotalValue);*/
				$("#confirmAndBuy").prop("disabled", true);
				getShippingRates();
			});


			// confirm and buy
			$("#confirmAndBuy").click(function() {
				var shippingMethod = $("#shippingMethod").val();
				var width = $("#width").val();
				var length = $("#length").val();
				var height = $("#height").val();
				var lbs = $("#lbs").val();
				var oz = $("#oz").val();
				var insuredValue = $("#insuredValue").val();
				var signature = $("#signature").is(":checked");
				var shippingDate = $("#shippingDate").val();

				if (!shippingMethod) { alert("No shipping Method."); $("#shippingMethod").focus(); $("#confirmAndBuy").attr("data-target", ""); return; };
				if (!length) { alert("Please input length."); $("#length").focus(); $("#confirmAndBuy").attr("data-target", ""); return; };
				if (!width) { alert("Please input width."); $("#width").focus(); $("#confirmAndBuy").attr("data-target", ""); return; };
				if (!height) { alert("Please input height."); $("#height").focus(); $("#confirmAndBuy").attr("data-target", ""); return; };
				if (!lbs) { alert("Please input pounds."); $("#lbs").focus(); $("#confirmAndBuy").attr("data-target", ""); return; };
				if (!$.isNumeric(width)) { alert("Width must be numeric."); $("#width").focus(); $("#confirmAndBuy").attr("data-target", ""); return; };
				if (!$.isNumeric(length)) { alert("Length must numeric."); $("#length").focus(); $("#confirmAndBuy").attr("data-target", ""); return; };
				if (!$.isNumeric(height)) { alert("Height must be numeric."); $("#height").focus(); $("#confirmAndBuy").attr("data-target", ""); return; };
				if (!$.isNumeric(lbs)) { alert("Lbs must be in numeric."); $("#lbs").focus(); $("#confirmAndBuy").attr("data-target", ""); return; };

				$("#confirmAndBuy").attr("data-target", "#myModal");
			});

			// //confirm payment
			$("#confirmPayment").click(function() {
				var shippingMethod = $("#shippingMethod").val();
				var width = $("#width").val();
				var length = $("#length").val();
				var height = $("#height").val();
				var lbs = $("#lbs").val();
				var oz = $("#oz").val();
				var insuredValue = $("#insuredValue").val();
				var signature = $("#signature").is(":checked");
				var shippingDate = $("#shippingDate").val();

				var url = "<?=base_url();?>page/Shipping/confirmAndBuy";
				var orderNumber = document.documentURI.match(/\d+/g)[1];
				var data = {
					shippingMethod: shippingMethod,
					orderNumber: orderNumber,
					width: width,
					length: length,
					height: height,
					lbs: lbs,
					oz: oz,
					insuredValue: insuredValue,
					shippingDate: shippingDate,
				};

				if (signature)
					data['signature'] = signature;

				$.post(url, data, function(response) {
					if (response['data']['error'])	// if there's an error
						alert(response['data']['error'][0]['description']);
					else
						alert("Successfully processed. Tracking number: " + response['data']['response']['trk_main']);
				});

				$("#modalCloseButton").click();
			});
				
		});
	</script>
	

<?php $this->load->view('../../front-templates/footer.php'); ?>