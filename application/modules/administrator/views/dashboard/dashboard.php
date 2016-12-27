<?php
	// Common files are loaded
	$this->load->view('../../templates/head.php');
	$this->load->view('../../templates/headeer.php');
	$this->load->view('../../templates/sidebar-left.php');
?>

<!--main content start-->
<section id="main-content">
<section class="wrapper">

<!--mini statistics start-->
<div class="row">
    
<!---- Event section Start ---->
<div class="col-lg-9 col-md-9 col-sm-9">
			
	<!--mini statistics start-->
	<div class="row">
		<div class="col-lg-2 col-md-2 col-sm-2">
			<div class="mini-stat clearfix">
				<div class="inBlock">
					<span class="mini-stat-icon orange"><i class="fa fa-cart-arrow-down"></i></span>
				</div>
				<div class="mini-stat-info inBlock">
					
					<?php
						$getallDeliveredSql = $this->db->query("select * from mega_orders where order_status='Delivered'");
						
						if($getallDeliveredSql->num_rows() > 0){
										
							$numRowsDelivered = $getallDeliveredSql->num_rows();
							
						}else{
							$numRowsDelivered = 0;
						}
						
					?>
					
					<span><?php echo checkNumber($numRowsDelivered); ?></span>
					Total Sales
					
				</div>
			</div>
		</div>
		
		
		<div class="col-lg-2 col-md-2 col-sm-2">
			<div class="mini-stat clearfix">
				
				<div class="inBlock">
					<span class="mini-stat-icon pink"><i class="fa fa-money"></i></span>
				</div>
				
				<div class="mini-stat-info inBlock">
					
					<?php
						$getallPendingSql = $this->db->query("select * from mega_orders where order_status='Pending'");
						
						if($getallPendingSql->num_rows() > 0){
										
							$numRowsPending = $getallPendingSql->num_rows();
							
						}else{
							$numRowsPending = 0;
						}
						
					?>
					
					<span><?php echo checkNumber($numRowsPending); ?></span>
					Pending Order
				</div>
				
			</div>
		</div>
		
		
		<div class="col-lg-2 col-md-2 col-sm-2">
			<div class="mini-stat clearfix">
				
				<div class="inBlock">
					<span class="mini-stat-icon green"><i class="fa fa-eye"></i></span>
				</div>
				
				<div class="mini-stat-info inBlock">
				
					<?php
						$getallProcessingSql = $this->db->query("select * from mega_orders where order_status='Processing'");
						
						if($getallProcessingSql->num_rows() > 0){
										
							$numRowsProcessing = $getallProcessingSql->num_rows();
							
						}else{
							$numRowsProcessing = 0;
						}
						
					?>
					
					<span><?php echo checkNumber($numRowsProcessing); ?></span>
					Processing Order
				</div>
				
			</div>
		</div>
		
		
		<div class="col-lg-2 col-md-2 col-sm-2">
			<div class="mini-stat clearfix">
				
				<div class="inBlock">
					<span class="mini-stat-icon orange"><i class="fa fa-times-circle"></i></span>
				</div>
				
				<div class="mini-stat-info inBlock">
				
					<?php
						$getallCancelledSql = $this->db->query("select * from mega_orders where order_status='Cancelled'");
						
						if($getallCancelledSql->num_rows() > 0){
										
							$numRowsCancelled = $getallCancelledSql->num_rows();
							
						}else{
							$numRowsCancelled = 0;
						}
					?>
					
					<span><?php echo checkNumber($numRowsCancelled); ?></span>
					Cancelled Order
				</div>
				
			</div>
		</div>
		
		
		<div class="col-lg-2 col-md-2 col-sm-2">
			<div class="mini-stat clearfix">
				
				<div class="inBlock">
					<span class="mini-stat-icon green"><i class="fa fa-refresh"></i></span>
				</div>
				
				<div class="mini-stat-info inBlock">
				
					<?php
						$getallRefundedSql = $this->db->query("select * from mega_orders where order_status='Refund'");
						
						
						if($getallRefundedSql->num_rows() > 0){
										
							$numRowsRefunded = $getallRefundedSql->num_rows();
							
						}else{
							$numRowsRefunded = 0;
						}
					?>
					
					<span><?php echo checkNumber($numRowsRefunded); ?></span>
					Refunded Order
				</div>
				
			</div>
		</div>
		
		
		<div class="col-lg-2 col-md-2 col-sm-2">
			<div class="mini-stat clearfix">
				
				<div class="inBlock">
					<span class="mini-stat-icon pink"><i class="fa fa-gavel"></i></span>
				</div>
				
				<div class="mini-stat-info inBlock">
				
					<?php
						$getallOrderedSql = $this->db->query("select * from mega_orders");
						
						if($getallOrderedSql->num_rows() > 0){
										
							$numRowsOrdered = $getallOrderedSql->num_rows();
							
						}else{
							$numRowsOrdered = 0;
						}
					?>
					
					<span><?php echo checkNumber($numRowsOrdered); ?></span>
					Total Ordered
				</div>
				
			</div>
		</div>
		
	</div>
<!--mini statistics end-->
</div>
		
    <!--Event Start-->
    <div class="col-lg-3 col-md-3 col-sm-3">
        <div class="profile-nav alt">
            <section class="panel">
                <div class="user-heading alt clock-row terques-bg">
                    <h1><?php echo thisMonth(); ?></h1>
                    <p class="text-left"> <?php echo currenTDay(); ?></p>
                    <p class="text-left"> <?php echo thisTime(); ?> </p>
                </div>
                <ul id="clock">
                    <li id="sec"></li>
                    <li id="hour"></li>
                    <li id="min"></li>
                </ul>

            </section>

        </div>
    </div>
    <!--Event end-->
	
	<!---- Event section END ---->
	
	<div class="col-md-3">
        <section class="panel">
            <div class="panel-body">
                <div class="top-stats-panel">
                    
					<div class="gauge-canvas">
                        
						<h4 class="widget-h">Today Sales Amount</h4>
                        
						<h3 class="text-danger">
							
							<?php
								$orderTodaydatetime1 = date('Y-m-d 00:00:00');
								$orderTodaydatetime2 = date('Y-m-d 11:59:59');
								
								$getallTodaySalesAmountSql = $this->db->query("select SUM(order_amount) as todayorderamount from mega_orders where order_status='Delivered' and order_date between '$orderTodaydatetime1' and '$orderTodaydatetime2'");
								
								if($getallTodaySalesAmountSql->num_rows() > 0){
										
									extract($getallTodaySalesAmountSql->row_array());
							
									echo number_format($todayorderamount,2);
									
								}else{
									echo number_format(0,2);
								}
							?>
							
						</h3>
						
                       <h4 style="font-weight:bold;">
							USD
						</h4>
                    </div>
                    
					<ul class="gauge-meta clearfix">
                        
						<li id="gauge-textfield" class="pull-left gauge-value"></li>
                        
						<li class="pull-right visit-chart-title">
							<i class="fa fa-arrow-up"></i> Sales Amount
						</li>
                    </ul>
					
                </div>
            </div>
        </section>
    </div>

    <div class="col-md-3">
        <section class="panel">
            <div class="panel-body">
                <div class="top-stats-panel">
                    <div class="daily-visit">
                        
						<h4 class="widget-h">Current Month Sales Amount</h4>
                        
						<div id="daily-visit-chart" style="width:100%; height: 100px; display: block">
							
							<h3 class="text-primary">
								<?php
									$orderStartMonthdatetime1 = date('Y-m-01 00:00:00');
									$cmonth = monthdaycount(date('F Y'));
									$orderEndMonthdatetime2 = date("Y-m-$cmonth 11:59:59");
									
									$getallCurrentMonthSalesAmountSql = $this->db->query("select SUM(order_amount) as currentMonthorderamount from mega_orders where order_status='Delivered' and order_date between '$orderStartMonthdatetime1' and '$orderEndMonthdatetime2'");
									
									if($getallCurrentMonthSalesAmountSql->num_rows() > 0){
										
										extract($getallCurrentMonthSalesAmountSql->row_array());
								
										echo number_format($currentMonthorderamount,2);
										
									}else{
										echo number_format(0,2);
									}
								?>
							</h3>
							
							<h4 style="font-weight:bold;">
								USD
							</h4>
                        </div>
						
                        <ul class="chart-meta clearfix">
                            
							<li class="pull-left visit-chart-value">&nbsp;</li>
							
                            <li class="pull-right visit-chart-title">
								<i class="fa fa-arrow-up"></i> Sales Amount
							</li>
							
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
	

    <div class="col-md-3">
        <section class="panel">
            <div class="panel-body">
                <div class="top-stats-panel">
				
                    <h4 class="widget-h">Total Sales Amount</h4>
					
                    <div id="daily-visit-chart" style="width:100%; height: 100px; display: block;text-align:center;">
						
						<h3 class="text-warning">
							
							<?php
								$getallDeliveredSalesAmountSql = $this->db->query("select SUM(order_amount) as orderamount from mega_orders where order_status='Delivered'");
								
								if($getallDeliveredSalesAmountSql->num_rows() > 0){
										
									extract($getallDeliveredSalesAmountSql->row_array());
						
									echo number_format($orderamount,2);
									
								}else{
									echo number_format(0,2);
								}
							?>
							
						</h3>
						
						<h4 style="font-weight:bold;">
							USD
						</h4>
					</div>
					
					<ul class="chart-meta clearfix">
						<li class="pull-left visit-chart-value">&nbsp;</li>
                        <li class="pull-right visit-chart-title">
							<i class="fa fa-arrow-up"></i> Sales Amount
						</li>
					</ul>
					
                </div>
            </div>
        </section>
    </div>
	

    <div class="col-md-3">
        <section class="panel">
            <div class="panel-body">
                <div class="top-stats-panel">
				
                    <h4 class="widget-h">Average Daily Sales Amount</h4>
					
                    <div id="daily-visit-chart" style="width:100%; height: 100px; display: block;text-align:center;">
						
						<h3 class="text-warning">
							
							<?php
								$getallDeliveredSalesAmountSql = $this->db->query("select SUM(order_amount) as orderamount from mega_orders where order_status='Delivered'");
								
								if($getallDeliveredSalesAmountSql->num_rows() > 0){
										
									extract($getallDeliveredSalesAmountSql->row_array());
						
									echo number_format($orderamount / sitefinalLaunchingNumOfDays(),2);
									
								}else{
									echo number_format(0,2);
								}
								 
							?>
							
						</h3>
						
						<h4 style="font-weight:bold;">
							USD
						</h4>
					</div>
					
					<ul class="chart-meta clearfix">
						<li class="pull-left visit-chart-value">&nbsp;</li>
                        <li class="pull-right visit-chart-title">
							<i class="fa fa-arrow-up"></i> Sales Amount
						</li>
					</ul>
					
                </div>
            </div>
        </section>
    </div>
	
	
</div>
<!--mini statistics end-->

</section>
</section>
<!--main content end-->

<?php //include('inc/sidebar-right.php'); ?>

</section>

<?php
	$this->load->view('../../templates/dashboard-footer.php');
?>