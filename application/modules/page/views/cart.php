<?php
	$this->load->view('../../front-templates/head.php');
	$this->load->view('../../front-templates/header.php');
	$this->load->view('../../front-templates/navigation.php');
?>
<?php 
	$getcrt_info = $this->Msmodel->getcrt_info();
?>
<div id="inner_page"><!-- Begin: inner_page -->
    <div class="container">
        <div class="row">
            <div class="user_hi"><!-- Begin: user_hi -->
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="user_name"><!-- Begin: user_name -->
                        <h3 class="user_name_h3" style="color:#444;">
							<?php
								echo $this->Msmodel->total_itm();
							?>
							Items in your shopping cart 
						</h3>
                    </div><!-- End: user_name -->
                </div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right">
					<a style="border-radius:0;" class="btn btn-primary spcontinue" onclick="window.location='<?php echo base_url(); ?>page/catpaginat/category/0'" />
						Continue Shopping
					</a>
				</div>
            </div><!-- End: ourpic4_you -->
        </div>
        <div class="clearfix"></div>
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/css/mailbox.css" />
		<?php 
			if(count($getcrt_info) !== 0){
		?>
			<?php foreach($getcrt_info as $crtinfo){ ?>
			<div class="row">
				<div class="col-lg-12">
					<div class="cartind">
						<div class="row">
							<div class="col-lg-9">
								<div class="maincrtbody">
									<div class="crtlft">
										<div class="shopinfo">
											<div class="shoppic">
												<?php 
													$get_shoplogo = $this->Yourshop_model->getshop_logo($crtinfo['craw_shopid']);
													if($get_shoplogo['shoplogo']){
												?>
												<?php
													$sname = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $crtinfo['shop_name']))));
												?>
												<img src="<?php echo base_url(); ?>assets/frontend/images/shops/<?php echo $sname.'/'.$get_shoplogo['shoplogo']; ?>" alt="" />
												<?php }else{ ?>
												<img src="<?php echo base_url(); ?>assets/frontend/images/shops/nologo.jpg" alt="" />
												<?php } ?>
											</div>
											<div class="shopname"><?php echo $crtinfo['shop_name']; ?></div>
										</div>
										<div class="contactinfo">
											<a href="">Contact With Shop</a>
										</div>
									</div>
									
									<?php
										$cartcontents = $this->Msmodel->getproductby_shopid($crtinfo['craw_shopid']);
										foreach($cartcontents as $item){
									?>
									<div class="crtlft cartbody">
										<div class="productthumb">
											<?php 
												$get_thumbs = $this->Yourshop_model->get_productimgs($item['craw_prodctid']);
												if(count($get_thumbs) !== 0){
													$sname = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $crtinfo['shop_name']))));	
													$pooimglocation = base_url()."assets/frontend/images/shops/".$sname."/";
											?>
													<img src="<?php echo $pooimglocation.$get_thumbs['pic_name']; ?>" alt="" />
											<?php	}else{ ?>
													<img src="" alt="" />
											<?php } ?>
										</div>
										<div class="produdesc">
											<a href="<?php echo base_url(); ?>page/pdetails/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $item['product_name'])))))))); ?>/<?php echo $item['craw_prodctid']; ?>">
												<?php echo $item['product_name']; ?>
											</a>
											<?php 
												if($item['craw_size']){
											?>
											<span class="siz" style="position:relative">
												<strong>Size: </strong> &nbsp; <?php echo $item['craw_size']; ?>
												<!--
												<select name="" id="" class="selprm">
													<?php 
														for($inc = 1; $inc<101;$inc++){
													?>
													<option value="<?php echo $inc; ?>"><?php echo "size ".$inc; ?></option>
													<?php } ?>
												</select>
												-->
												<!--<span class="editico"><i class="fa fa-pencil"></i></span>-->
											</span>
											<?php
												}else{ echo null; }
											?>
											<?php 
												if($item['craw_color']){
											?>
											<span class="clr" style="position:relative">
												<strong>Color: </strong> &nbsp; <?php echo $item['craw_color']; ?>
												<!--
												<select name="" id="" class="selprm clrsel">
													<?php 
														for($inc = 1; $inc<101;$inc++){
													?>
													<option value="<?php echo $inc; ?>"><?php echo "color ".$inc; ?></option>
													<?php } ?>
												</select>
												-->
												<!--<span class="editico"><i class="fa fa-pencil"></i></span>-->
											</span>
											<?php }else{ echo null; } ?>
											<div style="display:block; margin-top:10px;">
												<!--<a style="display:inline-block" onclick="alert('Edit cart');">Edit</a>-->
												<a style="display:inline-block;" onclick="removeitm(<?php echo $item['craw_id']; ?>);">Remove</a>
											</div>
										</div>
										<div class="prodqnty">
											<select name="crtqnty" id="" onchange="getqnty(<?php echo $item['craw_id']; ?>, this.options[this.selectedIndex].value);">
												<?php 
													for($i=1;$i<101;$i++){
												?>
													<option value="<?php echo $i; ?>" <?php echo ($item['craw_qty'] == $i)? 'selected' : null; ?>><?php echo $i; ?></option>
												<?php } ?>
											</select>
										</div>
										<div class="prodprice">
											<span style="display:block"><strong>USD</strong> <?php echo number_format($item['craw_price'], 2); ?></span>
										</div>
									</div>
									<?php } ?>
<!--------------------------------- End Cart Body --------------------------------------------------------->
									<div class="crtlft">
										<div class="additional_txt">
											<textarea name="" id="" cols="40" rows="2" placeholder="add an additional note to seller."></textarea>
										</div>
										<div class="shipinfo">
											<span>
												Ready to ship in 
												<?php
													if(!empty($crtinfo['processing_time'])){
														echo $crtinfo['processing_time'];
													}
												?>
												<br />
												<?php 
													if($crtinfo['ship_from']){
												?>
												from <?php echo $crtinfo['ship_from']; ?>
												<?php	}else{ echo null; } ?>
											</span> 
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-3" style="border-left:1px solid #ddd;">
								<div class="crdopt">
									<?php 
										$checklogin = $this->session->userdata('isLogin');
										if($checklogin === null && $checklogin !== TRUE){
									?>
									<form action="<?php echo base_url('page/login/dologin?ref=crt'); ?>" method="post">
									<?php
										}else{
									?>
									<form action="<?php echo base_url('page/porder/buy'); ?>" method="post">
									<?php } ?>
										<input type="hidden" name="shoperid" value="<?php echo $crtinfo['craw_shopid']; ?>" />
										<strong>How you 'll pay</strong>
										<div class="selct_pymnt">
											<span class="crdopt">
												<input type="radio" name="paymentmethod" value="Credit-Card"/> 
												<span class="attchimg">
													<span class="crdico"><img src="" alt="" /></span>
													<span class="crdico two"><img src="" alt="" /></span>
													<span class="crdico three"><img src="" alt="" /></span>
													<span class="crdico four"><img src="" alt="" /></span>
												</span>
											</span>
											<span class="crdpaypal"><input type="radio" name="paymentmethod" value="Paypal" checked="checked" /> <span class="crdpico"><img src="" alt="" /></span></span>
										</div>
										<?php 
											$shopamount = $this->Msmodel->totalcrt_amount($crtinfo['craw_shopid']);
										?>
										<div class="itempdestail">
											<span>Item's Total</span>
											<span><strong>USD <?php echo number_format($shopamount['total'], 2); ?></strong></span>
											<input type="hidden" name="order_amount" value="<?php echo number_format($shopamount['total'], 2); ?>" />
										</div>
										<div class="itempdestail">
											<span>Total Shipping</span>
											<span><strong>USD 0.00</strong></span>
											<input type="hidden" name="order_shipping_amount" value="<?php echo ($shopamount['craw_shipping'] !== null)? $shopamount['craw_shipping'] : '0.00'; ?>" />
										</div>
										<div class="itempdestail crttotal">
											<span><strong>Total</strong></span>
											<span><strong>USD <?php echo number_format($shopamount['total'], 2); ?></strong></span>
										</div>
										<div class="itempdestail">
											<button type="submit" class="proccedcheck">Procced To Checkout</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
		<?php }else{ ?>
		<div class="cartind"><h3 class="nitmcrt">No Item In Your Cart</h3></div>
		<?php } ?>
    </div>
</div><!-- End: inner_page -->
<script type="text/javascript">
	var base_url = "<?php echo base_url(); ?>";
	function removeitm(val){
		$.post(base_url + "page/cart/removeitm", {rawid: val}, function(data){
			if(data.status='ok'){
				window.location.reload();
			}
		}, "json");
	}
	function getqnty(val, valtwo){
		$.post(base_url + "page/cart/pqnty", {rawid: val, qnty: valtwo}, function(data){
			if(data.status='ok'){
				window.location.reload();
			}
		}, "json");
	}
</script>
<?php $this->load->view('../../front-templates/footer.php'); ?>
