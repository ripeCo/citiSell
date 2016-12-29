<?php
	$this->load->view('../../front-templates/head.php');
	$this->load->view('../../front-templates/header.php');
	$this->load->view('../../front-templates/navigation.php');
?>

<script>
	function clear_cart() {
		var result = confirm('Are you sure want to clear all shopping items?');
		
		if(result) {
			window.location = "<?php echo base_url(); ?>page/cart/remove/all";
		}else{
			return false; // cancel button
		}
	}

	function update_qty() {
		var result = confirm("Quantity has been changed. Do you want to proceed?");

		if(result)
			document.getElementById('updatecart').click();
		else
			return false;
	}

	function addressToggle(chosenAddress) {
		/* chosenAddress either 1 or 2 only. */
		document.getElementById('chosenAddress').value = chosenAddress;
		document.getElementById('updatecart').click();
	}
</script>


<div id="inner_page"><!-- Begin: inner_page -->
    <div class="container">
    
        <div class="row">
            <div class="user_hi"><!-- Begin: user_hi -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                
                    <div class="user_name"><!-- Begin: user_name -->
					
                        <h3 class="user_name_h3" style="color:#444;">
							
							<i class="fa fa-cart-arrow-down"></i>
							<?php
								if ($cart = $this->cart->contents()){
									echo ''.checkNumber(count($cart)).'';
								}else{
									echo '0';
								}
							?>
							Items in your shopping cart 
						</h3>
						
						
						
                    </div><!-- End: user_name -->
                    
                </div>
				
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<a class="btn btn-primary spcontinue" onclick="window.location='<?php echo base_url(); ?>page/catpaginat/category/0'" />
						
						<i class="fa fa-cart-plus"></i>&nbsp;
						Continue Shopping
						
					</a>
				</div>
				
				<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">				
					<div style="color:#F00">
					
						<?php if(isset($message)){ echo $message; } ?>
						
					</div>
				</div>
				
            </div><!-- End: ourpic4_you -->
        </div>
        <div class="clearfix"></div>

		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/css/mailbox.css" />

        <div class="row">			
			<?php if($this->session->userdata('isLogin') == TRUE){ ?>
				<form method="post" action="<?php echo base_url(); ?>page/cart/placeorder">
			<?php }else{ ?>
				<form method="post" action="<?php echo base_url(); ?>page/cart/checkout">
			<?php } ?>
			
            <div class="shopping_cart"><!-- Begin: shopping_cart -->
            	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                
					<?php
						if(count($cart) < 1 ){
							
					?>
						
					<h3 class="text-center text-danger"><i class="fa fa-times-circle"></i> Your cart is empty!</h3>
						
					<?php
						}else{
					?>

					<input type="hidden" name="chosenAddress" id="chosenAddress" value="<?=$chosenAddress;?>" />
					
                    <table class="table table-responsive table-bordered" style="margin-bottom:0px;">
                    
                      <tbody>
                        
						<?php
							if ($cart = $this->cart->contents()):
						?>
						
						<tr class="cart_title">
							<th width="10%">Serial</th>
							<th width="10%">Photo</th>
							<th width="40%">Name</th>
							<th width="10%">Price</th>
							<th width="10%">Quantity</th>
							<th width="10%">Amount</th>
							<th width="10%">Options</th>
                        </tr>
						
						<?php
							//echo form_open('page/cart/update_cart');
							$grand_total = 0; $i = 1; $totl = 0;
							
							foreach ($cart as $item):
								
								echo form_hidden('cart['. $item['id'] .'][id]', $item['id']);
								echo '<input type="hidden" name="pid[]" value="'.$item['id'].'" />';
								echo form_hidden('cart['. $item['id'] .'][rowid]', $item['rowid']);
								echo form_hidden('cart['. $item['id'] .'][name]', $item['name']);
								echo form_hidden('cart['. $item['id'] .'][pimg]', $item['pimg']);
								echo form_hidden('cart['. $item['id'] .'][shopid]', $item['shopid']);
								echo '<input type="hidden" name="shopuserid[]" value="'.$item['shopuserid'].'" />';
								
								// Get buyer info
								if($this->session->userdata('isLogin') == TRUE){
									
									$usid = $this->session->userdata('userid');
									
									$sqlBuyer = $this->db->query("select userid,display_name from mega_users where userid=$usid");
									$sqlBuyerfetch = $sqlBuyer->row_array();
									extract($sqlBuyerfetch);
								
									echo '<input type="hidden" name="buyername" value="'.$display_name.'" />';
								
									echo '<input type="hidden" name="buyerid" value="'.$userid.'" />';
									
								}
								
								echo '<input type="hidden" name="shpid[]" value="'.$item['shopid'].'" />';
								echo form_hidden('cart['. $item['id'] .'][shopname]', $item['shopname']);
								
								if($this->session->userdata('isLogin') == TRUE){
								// Get user country
									$usid = $this->session->userdata('userid');
									
									$getUserCountrysql = $this->db->query("select user_address, user_city, user_state, user_zip, user_country, user_address2, user_city2, user_state2, user_zip2, user_country2 from mega_users where userid=$usid");
									
									extract($getUserCountrysql->row_array());
									$usrCountry = $user_country;
									
									echo '<input type="hidden" name="userid" value="'.$usid.'" />';
									echo '<input type="hidden" name="usrcntry" value="'.$usrCountry.'" />';
									
								// Get Shop & product country
									$shpid = $item['shopid'];
									$getShopProductsql = $this->db->query("select user_country from mega_users where shopopen=$shpid");
									
									extract($getShopProductsql->row_array());
									$shopCountry = $user_country;
								}else{
									$shopCountry = '';
									$usrCountry = '';
								}
								
								echo form_hidden('cart['. $item['id'] .'][shopcountry]', $shopCountry);
								
								echo form_hidden('cart['. $item['id'] .'][usercountry]', $usrCountry);
								
								
								/*if($usrCountry == $shopCountry){
									if(!empty($item['shipping_cost_itself'])){
										echo form_hidden('cart['. $item['id'] .'][shipping_cost_itself]', $item['shipping_cost_itself']);
									}else{
										echo form_hidden('cart['. $item['id'] .'][shipping_cost_itself]', $item['shipping_cost_itself']);
									}
									
									if(!empty($item['shipping_cost_with_another_items'])){
										echo form_hidden('cart['. $item['id'] .'][shipping_cost_with_another_items]', $item['shipping_cost_with_another_items']);
									}else{
										echo form_hidden('cart['. $item['id'] .'][shipping_cost_with_another_items]', $item['shipping_cost_with_another_items']);
									}
								}else{
								
									if(!empty($item['shipping_cost_int_by_itself'])){
										echo form_hidden('cart['. $item['id'] .'][shipping_cost_int_by_itself]', $item['shipping_cost_int_by_itself']);
									}
									
									if(!empty($item['shipping_cost_int_with_another_items'])){
										echo form_hidden('cart['. $item['id'] .'][shipping_cost_int_with_another_items]', $item['shipping_cost_int_with_another_items']);
									}
								}*/

								echo form_hidden('cart['. $item['id'] .'][shippingCostPerRow]', $item['shippingCostPerRow']);
								
								if(!empty($item['color']) || !empty($item['size'])){
									echo '<input type="hidden" name="productVariations[]" value="<b>Color -</b> '.$item['color'].', '.'<b>Size -</b> '. $item['size'].'" />';
								}else{
									echo '<input type="hidden" name="productVariations[]" value="" />';
								}
								
								if(!empty($item['shipprocessingtime'])){
									echo form_hidden('cart['. $item['id'] .'][shipprocessingtime]', $item['shipprocessingtime']);
								}
								
								if(!empty($item['color'])){
									echo form_hidden('cart['. $item['id'] .'][color]', $item['color']);
								}
								
								if(!empty($item['size'])){
									echo form_hidden('cart['. $item['id'] .'][size]', $item['size']);
								}
								
								echo form_hidden('cart['. $item['id'] .'][price]', $item['price']);
								
								echo '<input type="hidden" name="unitprice[]" value="'.$item['price'].'" />';
								
								echo form_hidden('cart['. $item['id'] .'][qty]', $item['qty']);
								
								echo '<input type="hidden" name="quantity[]" value="'.$item['qty'].'" />';
								
								$sppid = $item['shopid'];
								// Get shop info
								$nvs_queryRecom007 		= $this->db->query("SELECT * FROM mega_shops where shopid='".$sppid."'");
								$nvs_resultsRecom007 	= $nvs_queryRecom007->row_array();
								extract($nvs_resultsRecom007);
						?>
						
                        <tr class="cart_content">
                          
							<td style="padding:10px;" align="center"><?php echo checkNumber($i++); ?></td>
							
							<td style="padding:8px;" align="center">
								
								<?php
									// Check product Image NULL Or Not
									$pimg = $item['pimg'];
									
									if($pimg == NULL){
										$pimglocationRec = base_url()."assets/frontend/images/shops/default-img.jpg";
									}else{
										$snameRec = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $item['shopname']))));
										
										$pimglocationRec = base_url()."assets/frontend/images/shops/$snameRec/$pimg";
									}
								?>
									
									<a href="<?php echo base_url(); ?>page/pdetails/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $item['name'])))))))); ?>/<?php echo $item['id']; ?>">
									
								<?php
									echo '<img style="height: 60px !important; width: 100%;" class="img-responsive img-thumbnail" src="'.$pimglocationRec.'" alt="'.$item['name'].'" />';
								?>
								
								</a>
								
							</td>
						  
							<td style="padding:10px;">
								
								
								<h5>
									<a href="<?php echo base_url(); ?>page/yourshop/viewshop/<?php echo $shopid; ?>">
										<?php
											if( $shoplogo !== NULL ){
											$shoplog = $shoplogo;
											$sname = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shop_name))));
										?>
										
										<img style="height:40px;width: 40px;border: 1px solid #ccc;" src="<?php echo base_url(); ?>assets/frontend/images/shops/<?php echo $sname.'/'.$shoplog; ?>" class="img-responsive img-thumbnail img-circle" alt="<?php echo $shop_name; ?> Shop Logo" />
										
										<?php }else{ ?>
										
										<img style="height:40px;width: 40px;border: 1px solid #ccc;" src="<?php echo base_url(); ?>assets/frontend/images/shops/nologo.jpg" class="img-responsive img-thumbnail img-circle" alt="<?php echo $shop_name; ?> Shop Logo" />
									
										<?php } ?>
										
										<?php
										$sppid = $item['shopid'];
										$getUserCountrysql786 = $this->db->query("select user_email from mega_users where shopopen=$sppid");
									
										extract($getUserCountrysql786->row_array());
											
											echo '<i><b>Shop</b> - '.$item['shopname'].'</i>';
											
											// Check Login Or Not
											if($this->session->userdata('isLogin') == TRUE){
												
												echo '<a class="btn btn-primary shopcontact" data-toggle="modal" href="#myModal'.$i.'" href="'.$user_email.'">';
													echo 'Contact';
												echo '</a>';
											
											}
											
										?>
									</a>
								</h5>
								
								
							
							<!-- Modal -->
							<div style="display: none;" class="modal fade" id="myModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							  <div class="modal-dialog">
								  <div class="modal-content">
									  
										<div class="modal-header">
										  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										  
										  <h4 class="modal-title">
											<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
											New conversation
										  </h4>
										  
										</div>
									  
										<div class="modal-body" style="min-height:450px; height:auto;">
											
											<form class="form-horizontal" method="post" enctype="multipart/form-data" role="form" action="<?php echo base_url(); ?>page/user/messagesend">
											
											
											 
												<div class="form-group">
												  
													<label class="col-lg-2 control-label">With </label>
												  
													<div class="col-lg-10">
													  
													  <input type="email" class="form-control" id="user_email" required="required" value="<?php echo $user_email; ?>" name="user_email" placeholder="Contact's user email" />
													  
													  <input type="hidden" class="form-control" name="senderid" value="<?php echo $this->session->userdata('userid'); ?>" />
													  
													</div>
												  
												</div>
												
												<p>&nbsp;</p>
											  
											  
											  <div class="form-group">
													<label class="col-lg-2 control-label">Subject</label>
													<div class="col-lg-10">
													  <input type="text" class="form-control" id="msgtitle" name="msgtitle" placeholder="Message Subject">
													</div>
											  </div>
												
												<p>&nbsp;</p>
											  
											  
											  <div class="form-group">
													<label class="col-lg-2 control-label">Message</label>
													<div class="col-lg-10">
													  <textarea name="message" id="myTextarea" class="form-control" cols="30" rows="10"></textarea>
													</div>
											  </div>
												
												<p>&nbsp;</p>
											  

												<div class="form-group">
													<div class="col-lg-offset-2 col-lg-10">
													  
													  <span class="btn green fileinput-button">
														<i class="fa fa-plus fa fa-white"></i>
														<span>Attachment</span>
														<input type="file" multiple="" name="userfile" />
													  </span>
													  
													  <button type="submit" class="btn btn-send">Send</button>
													  <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-default">Cancel</button>
													  
													</div>
												</div>
												
											</form>
											
											
											
										</div>
									</div><!-- /.modal-content -->
								</div><!-- /.modal-dialog -->
							</div><!-- /.modal -->
								
								
								<h5>
									
									<a href="<?php echo base_url(); ?>page/pdetails/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $item['name'])))))))); ?>/<?php echo $item['id']; ?>">
									
									<?php
										echo ucfirst(str_replace("and","&",strtolower(str_replace('-', ' ', str_replace('', "'", str_replace('', '', str_replace('', '', str_replace('', '', str_replace('', '', $item['name'])))))))));
									?>
									
									</a>
									
								</h5>
								
								<h6>
									
									<?php
										if(!empty($item['color'])){
											echo '<b>Color -</b> '. $item['color'];
										}
									
										if(!empty($item['size'])){
											echo ',<b>Size -</b> '. $item['size'];
										}
									?>
								
								</h6>
								
								<i class="pull-right rdytoshipng">
									
									Ready to shipping
									<?php
										if(!empty($item['shipprocessingtime'])){
											echo $item['shipprocessingtime'];
										}
									?>
								
								</i>
								
								<input type="hidden" name="shipprocessingtime[]" value="<?php echo $item['shipprocessingtime']; ?>" />
								
							</td>
						  
							<td style="padding:10px;" align="center">$ <?php echo number_format($item['price'],2); ?></td>
						  
							<td align="center" style="padding-top:10px;">
								<?php echo form_input('cart['. $item['id'] .'][qty]', $item['qty'], 'maxlength="3" type="hidden" size="8" style="text-align: center" onchange="update_qty()"'); ?>
								
								<?php //echo $item['qty']; ?>
								
							</td>
						  
							<td style="padding:10px;" align="center">
							
								$ <?php echo $stotal = number_format($item['subtotal'],2) ?>
								<?php $ssstotal = $item['subtotal'] ?>
								
								<input type="hidden" name="subtotal[]" value="<?php echo $ssstotal; ?>" />
								
								<?php $grand_total = $grand_total + $item['subtotal']; ?>
								
								<?php									
									
									// Product Shipping cost calculating here 
									/*if($usrCountry == $shopCountry){ // If shop & user local
										if($item['qty'] > 1){
										
											$pqty = $item['qty'] - 1;
											$spcost = $pqty * $item['shipping_cost_with_another_items'] + $item['shipping_cost_itself'];
											
										}else{
											
											$spcost = $item['qty'] * $item['shipping_cost_itself'];
											
										}
									}else{
										if($item['qty'] > 1){
										
											$pqty = $item['qty'] - 1;
											$spcost = $pqty * $item['shipping_cost_int_with_another_items'] + $item['shipping_cost_int_by_itself'];
											
										}else{
											
											$spcost = $item['qty'] * $item['shipping_cost_int_by_itself'];
											
										}
									}
									
									$totl += $spcost;*/

									$shippingCost += $item['shippingCostPerRow'];

								?>
								
								<input type="hidden" name="shippping_cost[]" value="<?php echo $shippingCost; ?>" />
								
							</td>
						  
							<td style="padding:10px;" align="center">
								
								<a onclick="return confirmDelete();" href="<?php echo base_url(); ?>page/cart/remove/<?php echo $item['rowid'] . '/' . $chosenAddress; ?>">
									<i class="fa fa-times-circle"></i>
								</a>
								
							</td>
						  
                        </tr>
						
						<?php endforeach; ?>
						
                      </tbody>
                      
                    </table>
					
					<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
					<script> 
					$(document).ready(function(){
						$("#flip1").click(function(){
							$("#panel1").slideToggle("slow");
						});
						$("#flip2").click(function(){
							$("#panel2").slideToggle("slow");
						});
					});
					</script>

					<style> 
						#flip1 {
							padding: 5px;
							background-color: #E0E07C;
							border: solid 1px #E0E07C;
						}

						#panel1 {
							padding: 0px;
							display: block;
						}
						
						#flip2 {
							padding: 5px;
							background-color: #E0E07C;
							border: solid 1px #E0E07C;
						}

						#panel2 {
							padding: 0px;
							display: block;
						}
					</style>
					
					<!-- Shipping Address -->
					<?php if($this->session->userdata('isLogin') == TRUE){ ?>
					
					<div class="row">
                    	
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
							
							<div style="background:#E0E07C; margin:0px;">
								<h4 id="flip1">
									<i class="fa fa-map-marker"></i>
									Choose a shipping address
								</h4>
							</div>
							
						</div>
                    	
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						
							<div id="panel1">
							
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									
									<h5 style="color: #7fba00; font-weight: bold;">
									<?php
										if ($chosenAddress == 1)
											$isChecked = 'checked="checked"';
										else
											$isChecked = '';
									?>
										<input <?php echo $isChecked; ?> type="radio" name="shipaddress" <?php if($user_address == ''){ echo 'required="required"'; } ?> value="<?php if($user_address !== NULL){echo $user_address;} ?>" onclick="addressToggle(1)" />
										
										Shipping Address 1
									</h5>
									
									<address>
									<?php
										if($user_address !== NULL){
											$add1 = explode(",", $user_address);
											
											for($ad1=0;$ad1<count($add1);$ad1++)
												echo $add1[$ad1].'<br/>';

											echo $user_city, "<br />", $user_state, "<br />", $user_zip, "<br />", $usrCountry;
										}
									?>
									</address>
									
								</div>
								
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									
									<h5 style="color: #7fba00; font-weight: bold;">
										<?php
											if ($chosenAddress == 2)
												$isChecked = 'checked="checked"';
											else
												$isChecked = '';
										?>
										<input <?php echo $isChecked; ?> type="radio" name="shipaddress" value="<?php if($user_address2 !== NULL){echo $user_address2;} ?>" onclick="addressToggle(2)" />
										
										Shipping Address 2
									</h5>
									
									<address>
										<?php
											if($user_address2 !== NULL){
												$add2 = explode(",", $user_address2);
												
												for($ad2=0;$ad2<count($add2);$ad2++)
													echo $add2[$ad2].'<br/>';

												echo $user_city2, "<br />", $user_state2, "<br />", $user_zip2, "<br />", $user_country2;
											}
										?>
									</address>
									
									
								</div>
							
							</div>
							
						</div>
						
					</div>
					<!-- Shipping Address END -->
					
					<?php } ?>
					
					<!-- Payment Methods -->
					<?php if($this->session->userdata('isLogin') == TRUE){ ?>
					
					<div class="row">
                    	
						<div class="pmethods">
						
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
								
								<div style="background:#E0E07C; margin:0px;">
									<h4 id="flip2">
										<i class="fa fa-cc-visa"></i>
										You'll Pay Using these Payment Methods
									</h4>
								</div>
								
							</div>
							
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							
								<div id="panel2">
								
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										
										<h5 style="color: #7fba00; font-weight: bold;">
											
											<ul>
												
												<li class="pminpt">
													<input checked="checked" type="radio" name="paymentmethod" value="Paypal" />
												</li>
												
												<li>
													<img class="img-responsive" src="<?php echo base_url(); ?>assets/frontend/images/interface/payment03.png" alt="Paypal">
												</li>
												
											</ul>
											
										</h5>
										
										<h5 style="color: #7fba00; font-weight: bold;">
											
											<ul>
												
												<li class="pminpt">
													<input type="radio" name="paymentmethod" value="Credit-Card" />
												</li>
												
												<li>
													<img class="img-responsive" src="<?php echo base_url(); ?>assets/frontend/images/interface/payment01.png" alt="American Express">
												</li>
												
												<li>
													<img class="img-responsive" src="<?php echo base_url(); ?>assets/frontend/images/interface/payment02.png" alt="Master Card">
												</li>
												
												<li>
													<img class="img-responsive" src="<?php echo base_url(); ?>assets/frontend/images/interface/discover-80.png" alt="Discover">
												</li>
												
												<li>
													<img class="img-responsive" src="<?php echo base_url(); ?>assets/frontend/images/interface/payment04.png" alt="Visa Card">
												</li>
												
											</ul>
											
										</h5>
										
									</div>
								
								</div>
								
							</div>
						
						</div>
						
					</div>
					<!-- Payment Methods END -->
					
					<?php } ?>
					
					
					<!-- Shipping calculation model -->
					<div class="contact_modal">
						<!-- Modal -->
						<div class="modal fade bs-example-modal-md" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						  <div class="modal-dialog modal-md" role="document">
							<div class="modal-content">
							
							  <div class="modal-header">
								
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								
								<h4 class="profile_contact_h40" id="myModalLabel">
								
									<i class="fa fa-calculator"></i> Shipping Calculation
									
								</h4>
								
								<p class="profile_contact_p">&nbsp;</p>
								
							  </div>
							  
							  <div class="modal-body">
								<div class="row">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<div class="profile_contact-cart">
											
											  <div class="form-group">
												
												<h4 class="shippingM">
													<span>
														<i class="fa fa-check"></i> Number of shipping Items
													</span> = 
													<?php
														if ($cart = $this->cart->contents()){
															echo ''.checkNumber(count($cart)).'';
														}else{
															echo '0';
														}
													?> 
												</h4>
												
												<h4 class="shippingM">
													<span><i class="fa fa-check"></i> 
														Total shopping amounts 
													</span> = 
													$<?php echo number_format($grand_total,2); ?>
												</h4>
												
												<h4 class="shippingM">
													<span><i class="fa fa-check"></i> 
														Total shipping cost 
													</span> =  
													$<?php echo number_format($shippingCost, 2); ?>
													<input type="hidden" name="shipping_amount" value="<?php echo number_format($shippingCost, 2); ?>" />
												</h4>
												
												<h4 class="shippingM0">
													<span>
														Grand Total
													</span> =  
													<b>$<?php echo number_format($grand_total + $shippingCost, 2); ?></b>
												</h4>
												
											  </div>
											
										</div>
									</div>
								</div>
							  </div>
							  
							  <div class="modal-footer">
								<!--button type="button" class="btn btn-primary">Send</button-->
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
							  </div>
							</div>
						  </div>
						</div>
					</div>
                    
                    <div class="row">
                    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="carttable_bottom"><!-- Begin: carttable_bottom -->
                            	<div class="row">
                                    
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="carttable_bottomL"><!-- Begin: carttable_bottomL -->
										
                                        	<h6 class="carttable_bottomL_h6">
                                        		<b>
													Shipping Cost: 
												</b>
												
												$<?php echo number_format($shippingCost, 2); ?><br />
												<b>
													<i class="fa fa-truck"></i> Shopping Total:
												</b>
												$<?php echo number_format($grand_total + $shippingCost, 2); ?>
												
												<input type="hidden" name="order_amount" value="<?php echo $grand_total + $shippingCost; ?>" />
												
											</h6>
											
                                        </div><!-- End: carttable_bottomL -->
                                    </div>
									
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="carttable_bottomL"><!-- Begin: carttable_bottomL -->
										
                                        	<h6 class="carttable_bottomL_h6">
												
												&nbsp;
												
											</h6>
											
                                        </div><!-- End: carttable_bottomL -->
                                    </div>
									
									
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding:0px;">
                                        <div class="carttable_bottomR"><!-- Begin: carttable_bottomR -->
										
                                        	<button class="btn btn-primary" type="button" onclick="clear_cart()">
												<i class="fa fa-times-circle"></i>
												Clear Cart
											</button>
											
											<button class="btn btn-success" name="updatecart" id="updatecart" value="cartupdate" type="submit">
												<i class="fa fa-pencil-square-o"></i>
												Update Cart
											</button>
											
											<?php
												//echo form_close();
												
												if($this->session->userdata('isLogin') == TRUE){
													if($this->uri->segment(3) == NULL){
														$sss = "window.location='page/placeorder'";
													}else if($this->uri->segment(2) == 'login'){
														$sss = "window.location='placeorder'";
													}else if($this->uri->segment(3) == 'remove'){
														$sss = "window.location='placeorder'";
													}else if($this->uri->segment(3) == 'update_cart'){
														$sss = "window.location='placeorder'";
													}else if($this->uri->segment(3) == 'add'){
														$sss = "window.location='placeorder'";
													}else{ $sss = "window.location='placeorder'"; }
												}else{
													
													if($this->uri->segment(3) == NULL){
														$sss = "window.location='cart/checkout'";
													}else if($this->uri->segment(3) == 'add'){
														$sss = "window.location='checkout'";
													}else if($this->uri->segment(3) == 'update_cart'){
														$sss = "window.location='checkout'";
													}else if($this->uri->segment(3) == 'remove'){
														$ur = base_url().'page/cart/checkout';
														$sss = "window.location='".$ur."'";
													}else{ $sss = "window.location='cart/checkout'"; }
													
												}
											?>
											
											<?php 
												
												//if($_POST['shopid'] !== $this->session->userdata('shopopen')){
											?>
											
												<button class="btn btn-danger" onclick="return confirmcheckout();" name="checkout" value="checkout" type="submit">	
													<i class="fa fa-shopping-cart"></i>
													Proceed to Checkout
												</button>
											
											<!--/form-->
											
                                        </div><!-- End: carttable_bottomR -->
                                    </div>
									
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding:0px;">
                                        <div class="carttable_bottomR0" style="float:right;"><!-- Begin: carttable_bottomR -->
										
                                        	<?php if($this->session->userdata('isLogin') == TRUE){ ?>
											
											<button class="btn btn-info" style="color:#333 !important;" type="button" data-toggle="modal" data-target="#myModal3">
												<i class="fa fa-calculator"></i>
												Shipping calculation
											</button>
											
											<?php }else{ ?>
											
											<button class="btn btn-info" style="color:#333 !important;" type="button" onclick="<?php echo $sss; ?>">	
												<i class="fa fa-calculator"></i>
												Shipping calculation
											</button>
											
											<?php } ?>
											
											
                                        </div><!-- End: carttable_bottomR -->
										
										
										
                                    </div>
									
                                </div>
                            </div><!-- End: carttable_bottom -->
                        </div>
                    </div>
					
					<?php endif; ?>
				
				<?php } ?>
                    
                </div>
            </div><!-- End: shopping_cart -->
			
			</form>
			
			
			<?php
				
				if(count($cart) < 1 ){
					echo '<div class="cartsidebar200">';
					
					$lastNumitems = $last2items;
						
				}else{
					echo '<div class="cartsidebar890">';
					
					$lastNumitems = $last5items;
				}
				
				
					foreach($lastNumitems as $recommandedpview8){
						// Get product info
						$recomndProductsql8 = $this->db->query("SELECT * FROM mega_products where productid='".$recommandedpview8->productid."'");
						
						$recomndProductFetch8 	= $recomndProductsql8->row_array();
						extract($recomndProductFetch8);
						
						// Get shop info
						$nvs_queryRecom8 		= $this->db->query("SELECT * FROM mega_shops where shopid='".$shopid."'");
						$nvs_resultsRecom8 	= $nvs_queryRecom8->row_array();
						extract($nvs_resultsRecom8);
				?>
			
				<div class="pitems">
					
					<a href="<?php echo base_url(); ?>page/pdetails/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $product_name)))))))); ?>/<?php echo $productid; ?>">
					
					<?php
						$ppimgRec8 = explode(',',$product_image);
							
						for($ppiRec8=0;$ppiRec8< count($ppimgRec8);$ppiRec8++){
							
							// Check product Image NULL Or Not
							if($product_image == NULL){
								$pimglocationRec8 = base_url()."assets/frontend/images/shops/default-img.jpg";
							}else{
								$snameRec8 = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shop_name))));
								
								$pimglocationRec8 = base_url()."assets/frontend/images/shops/$snameRec8/$ppimgRec8[$ppiRec8]";
							}
							
							echo '<img style="height:150px !important; width:100%;" class="img-responsive img-thumbnail" src="'.$pimglocationRec8.'" alt="'.$product_name.'" />';
							break;
						}
					?>
					
					</a>
					
					<div class="product_box_txt"><!-- Begin: recompro_box_txt" -->	
                            	
						<h6 class="product_box_txt_h6" style="border-bottom: 1px solid #ccc; margin: 0 auto; padding: 3px; width: 100% !important; float: left; height: 30px;">
							
							<a href="<?php echo base_url(); ?>page/pdetails/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $product_name)))))))); ?>/<?php echo $productid; ?>">
							
								<?php echo longtoshorttext($product_name,40); ?> ...
								
							</a>
							
						</h6>
						
						<p class="recompro_box_txt_p">
							
							<span class="recompro_box_txt_span">
								<i class="fa fa-usd"></i> <?php echo $product_price; ?> USD
							</span>
						</p>
					</div><!-- End: recompro_box_txt" -->
					
					
				</div>
				
				
				
				
				<?php } ?>
				
			
			</div>
			
			
			<div id="recommend"><!-- Begin: recommend -->
        
            <div class="row">
                <div class="discover_head"><!-- Begin: discover_head -->
                    <h3 class="recommend_h3">You might also like those items...</h3>
                    <p class="recommend_p">Items based on what you’ve viewed.</p>
                </div><!-- End: discover_head -->
            </div>
            <div class="clearfix"></div>
            
            <div class="recommend_products"><!-- Begin: recommend_products -->
            	<div class="row">
                
                    <?php
						foreach($last12items as $recommandedpview){
							
							// Get product info
							$recomndProductsql = $this->db->query("SELECT * FROM mega_products where productid='".$recommandedpview->productid."'");
							
							$recomndProductFetch 	= $recomndProductsql->row_array();
							extract($recomndProductFetch);
							
							// Get shop info
							$nvs_queryRecom 		= $this->db->query("SELECT * FROM mega_shops where shopid='".$shopid."'");
							$nvs_resultsRecom 	= $nvs_queryRecom->row_array();
							extract($nvs_resultsRecom);
					?>
					
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="recompro_box recomnd" style="height:300px !important;"><!-- Begin: recompro_box -->
                        
                            <div class="recompro_box_img"><!-- Begin: recompro_box_img" -->
                            
                            
                                <div class="main view-third">
                                    <!-- THIRD EXAMPLE -->
                                    <div class="view">

                                    <a href="<?php echo base_url(); ?>page/pdetails/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $product_name)))))))); ?>/<?php echo $productid; ?>">
									
									<?php
										$ppimgRec = explode(',',$product_image);
											
										for($ppiRec=0;$ppiRec< count($ppimgRec);$ppiRec++){
											
											// Check product Image NULL Or Not
											if($product_image == NULL){
												$pimglocationRec = base_url()."assets/frontend/images/shops/default-img.jpg";
											}else{
												$snameRec = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shop_name))));
												
												$pimglocationRec = base_url()."assets/frontend/images/shops/$snameRec/$ppimgRec[$ppiRec]";
											}
											
											echo '<img style="height:225px !important;" class="img-responsive img-thumbnail" src="'.$pimglocationRec.'" alt="'.$product_name.'" />';
											break;
										}
									?>
										
										<!--div class="mask">
                                        	<div class="heart_rate">
                                            	
												<?php
													//if($this->session->userdata('isLogin') == FALSE){
												?>
													<a href="#signin" id="sig" data-toggle="modal" data-target="#myModal" class="info signin">
														<i class="fa fa-heart-o" style="font-weight:bold"></i>
													</a>
													
												<?php //}else{ ?>
												
													<a href="#" class="info"><i class="fa fa-heart-o" style="font-weight:bold"></i></a>
													
												<?php //} ?>
												
                                            </div>
                                        </div-->
										
										</a>
										
                                    </div>
                                </div>
                            
                            	
                            </div><!-- End: recompro_box_img" -->
                            
                            <div class="recompro_box_txt"><!-- Begin: recompro_box_txt" -->	
                            	
								<h6 class="recompro_box_txt_h6" style="width:93% !important;">
									
									<a href="<?php echo base_url(); ?>page/pdetails/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $product_name)))))))); ?>/<?php echo $productid; ?>">
									
										<?php echo substr($product_name,0,40); ?> ...
										
									</a>
									
								</h6>
								
                                <p class="recompro_box_txt_p">
									
									<a href="<?php echo base_url(); ?>page/yourshop/viewshop/<?php echo $shopid; ?>">
										<?php  echo $shop_name; ?>
									</a>
									
									<span class="recompro_box_txt_span">
										<i class="fa fa-usd"></i> <?php echo $product_price; ?> USD
									</span>
								</p>
                            </div><!-- End: recompro_box_txt" -->
                            
                        </div><!-- End: recompro_box -->
                    </div>
					
					<?php } ?>
                    
                    
                    
                </div>
            </div><!-- End: recommend_products -->
            
        </div><!-- End: recommend -->
		
			
			
        </div>
        
    </div>
</div><!-- End: inner_page -->


<?php $this->load->view('../../front-templates/footer.php'); ?>
