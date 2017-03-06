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
						<h3>Canceled Orders</h3>
						<div class="shippingmnutb">
							<ul class="nav nav-tabs" style="padding-left:20px;">
								<li><a href="<?php echo base_url('page/order'); ?>">Open <strong>12</strong></a></li>
								<li><a href="<?php echo base_url('page/order/completedorder'); ?>">Completed <strong>12</strong></a></li>
								<li><a href="<?php echo base_url('page/order/allorder'); ?>">All <strong>07</strong></a></li>
								<li class="active"><a href="<?php echo base_url('page/order/canceledorder'); ?>">Canceled <strong>12</strong></a></li>
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