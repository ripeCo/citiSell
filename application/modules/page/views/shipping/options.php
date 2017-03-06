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
						<h3>Shipping labels</h3>
						<div class="shippingmnutb">
							<ul class="nav nav-tabs" style="padding-left:20px;">
								<li><a href="<?php echo base_url('page/shipping'); ?>">Buy Shipping Labels</a></li>
								<li><a href="<?php echo base_url('page/shipping/purchasedlbl'); ?>">Purchased Label <strong>12</strong></a></li>
								<li><a href="<?php echo base_url('page/shipping/refundedlbl'); ?>">Refunded Labels <strong>07</strong></a></li>
								<li class="active"><a href="<?php echo base_url('page/shipping/optionlbl'); ?>">Options</a></li>
							</ul>
						</div>
						<div class="shippanelbody">
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php $this->load->view('../../front-templates/footer.php'); ?>