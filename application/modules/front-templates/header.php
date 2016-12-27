<?php
    error_reporting(0); // Disabled all warnings, errors
	
	if($this->session->isLogin == TRUE){
		$this->load->view('userloged-head.php');
	}else{ $this->load->view('userreg-head.php'); }	

	
	// Create a monthly bill statements records if dosn't exist every month
	// Create a Payment account statements records if dosn't exist; that means opening one(1) record
	
	$userSql = $this->db->query("select userid,shopopen from mega_users where shopopen!=0");
	
	foreach($userSql->result() as $userresults){
	
		$usrid = $userresults->userid;
		$cmonth = date('F Y');
		$cpaymentmonth = date('F d, Y');
		$cYear = date('Y');
		
		$shhpid = $userresults->shopopen;
		
			// If Billstatus is Pending AND billdatetime is greater than 1 hours from inserted datetime than billdetails info will be delete
			
				// Get Bill info
				$billNNDataSql = $this->db->query("select * from mega_bill where userid=$usrid and shopid=$shhpid and billstatus='Pending'");
				extract($billNNDataSql->row_array());
				
				$currentdatetime = date('Y-m-d H:i:s');
				
				$pret = "$billdatetime";
				$date = new DateTime($pret);
				$date->modify("+1 hours");
				$exptime = $date->format('Y-m-d H:i:s');
				
				if($currentdatetime >= $exptime){
					
					// Delete record from mega_billdetails
					$this->db->query("delete from mega_billdetails where shopid=$shhpid and userid=$usrid and billingstatus='Pending'");
					$this->db->query("update mega_bill set billdatetime=null,billstatus=null where shopid=$shhpid and userid=$usrid and billstatus='Pending'");
					
					//$this->load->model('cart_model');
					//$this->cart_model->delete_cancelledorder();
					
				}
				
				
		
			// If Orderstatus is Pending AND Orderdatetime is greater than 1 hours from inserted datetime than all order info will be delete
			
				// Get order info
				$orderNNDataSql = $this->db->query("select * from mega_orders where payment_status='None' and order_status='Pending'");
				extract($orderNNDataSql->row_array());
				
				$currentdatetime2 = date('Y-m-d H:i:s');
				
				$pret2 		= "$order_date";
				$orderrrrid = $orderid;
				$date2 		= new DateTime($pret);
				
				$date2->modify("+1 hours");
				$exptime2 = $date2->format('Y-m-d H:i:s');
				
				
				if($currentdatetime2 >= $exptime2){
					
					// Delete record from mega_billdetails
					$this->db->query("delete from mega_billdetails where shopid=$shhpid and userid=$usrid and billingstatus='Pending'");
					$this->db->query("update mega_bill set billdatetime=null,billstatus=null where shopid=$shhpid and userid=$usrid and billstatus='Pending'");
					
					$this->load->model('cart_model');
					$this->cart_model->delete_PendingOrders($orderrrrid);
					
				}
				
				
		// Bill account
		$billSql = $this->db->query("select * from mega_bill where userid=$usrid and shopid=$shhpid and billmonth='$cmonth'");		
		
		if($billSql->num_rows() == 0){ // Check current month record exist or not
			extract($billSql->row_array());
			
				// Get Bill info
				$billDataSql = $this->db->query("select * from mega_bill where userid=$usrid and shopid=$shhpid order by billid DESC");
				extract($billDataSql->row_array());
				
				$billingFee = $fees;
				
				// Paymentdetails Account Info
				$sellerpaymentaccdetailsSql = $this->db->query("select currentbalance from mega_paymentdetails where userid=$usrid and shopid=$shhpid order by paymentdetailsid DESC");
				extract($sellerpaymentaccdetailsSql->row_array());
				$opngAmount = $currentbalance;
					
					// If mega_paymentdetails not available number of row check
					if($sellerpaymentaccdetailsSql->num_rows() > 0 ){
						
						$openingbalance = $opngAmount;
						$fees = $billingFee;
						$paymentamount = 0;
						$closingbalance = 0;
						
					}else{
						
						$openingbalance = 0;
						$fees = 0;
						$paymentamount = 0;
						$closingbalance = 0;
						
					}
				
				
				$sql = "INSERT INTO mega_bill(userid,shopid,billmonth,billyear,openingbalance,fees,paymentamount,closingbalance) VALUES ($usrid,$shhpid,'$cmonth',$cYear,$openingbalance,$fees,$paymentamount,$closingbalance)";

				if (!$this->db->query($sql)) {
					//echo "FALSE";
				}
				else {
					//echo "TRUE";
				}
				
			
			// Paymentdetails Account
			$paymentaccdetailsSql = $this->db->query("select * from mega_paymentdetails where userid=$usrid and shopid=$shhpid");
			
			if($paymentaccdetailsSql->num_rows() == 0){ // Check user record exist or not
				
				$Pmntaccdetailssql = "INSERT INTO mega_paymentdetails(userid,shopid,paymentmonth,descriptions,amount,fees,netamount,currentbalance) VALUES ($usrid,$shhpid,'$cpaymentmonth','Opening Balance',0,0,0,0)";

				if (!$this->db->query($Pmntaccdetailssql)) {
					//echo "FALSE";
				}
				else {
					//echo "TRUE";
				}
			}
		}
	}
	
	
	//////////////////////////////////////////////////////////////////
	//
	// Shop product will be automatic update when will expire
	//
	/////////////////////////////////////////////////////////////////
	
	$shopid = $this->session->userdata('shopid');
	$sqlpp = $this->db->query("select * from mega_products");
	$sqlppresult = $sqlpp->result();
	
	foreach($sqlppresult as $vvview){
		
		$date 			= date('Y-m-d H:i:s', bd_time());
		
		if($date >= $vvview->product_expire_date){
			
			$pid = $vvview->productid;
			$this->db->query("update mega_products set product_update_date='$date',bill_paid_or_not=0,product_live='Inactive',product_renew=0 where productid=$pid");
		}
		
	}
	
		
?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">
	
	function fill(Value)
	{
		$('#search').val(Value);
		$('#display').hide();
	}

	$(document).ready(function(){
		$("#search").keyup(function() {
		var search = $('#search').val();
		if(search==""){
			$("#display").html("");
		}else{
			$.ajax({
			type: "GET",
			url: "<?php echo base_url(); ?>page/mainsearching",
			data: "search="+ search ,
			success: function(html){
			$("#display").html(html).show();
			}
			});
		}
		});
		
		//$("#search").mouseout(function() {$("#display").html(html).hide();}
		$('#display').hide();
	});
</script>

	
<?php
	$val='';
	if(isset($_POST['submit']))
	{
		if(!empty($_POST['search']))
		{
			$val = $_POST['search'];
		}
		else
		{
			$val='';
		}
	}
?>
			
<div id="header"><!-- Begin: header -->
    <div class="container">
        <div class="row">
        
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <div class="logo"><!-- Begin: logo -->
                	<h1>
						<!--a href="<?php //if($this->session->isLogin == FALSE){echo base_url();}else{echo base_url().'page/user/userarea'; } ?>"-->
						<a href="<?php echo base_url(); ?>">
							
							<?php if( $this->session->userdata('isLogin') == True){ ?>
							
							<img style="position: relative; top: 0px;" src="<?php echo base_url(); ?>assets/frontend/images/interface/logo.png" class="img-responsive" alt="Logo" />
							
							<?php }else{ ?>
							
							<img src="<?php echo base_url(); ?>assets/frontend/images/interface/logo.png" class="img-responsive" alt="Logo" />
							
							<?php } ?>
							
						</a>
					</h1>
                </div><!-- End: logo -->
            </div>
            
			
            
			<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
			
				<form name="mainsearch" method="get" action="<?php echo base_url(); ?>page/mainactionsearchresult">
				
				<div class="h_search"><!-- Begin: h_search -->
					<div class="row">
					  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="input-group">
							
								<div class="input-group-btn">
								
									<button type="button" class="btn btn-default dropdown-toggle" style="height:37px;display:none" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><p class="h_search_p">All Categories <span class="caret"></span></p></button>
								
									<ul class="dropdown-menu">
									  <li><a href="#">All Categories</a></li>
									  <li><a href="#">Another action</a></li>
									  <li><a href="#">Something else here</a></li>
									</ul>
								
								</div>
						  
							
							
								<input style="height:36px;border: 1px solid #5579bb;" type="text" class="form-control" placeholder="Search for products or shops..." name="search" id="search" autocomplete="off" value="<?php echo $val;?>" />
								
								<span class="input-group-btn">
									<button class="btn btn-default" style="width:60px;height:37px;background:#5579BB;color:#fff;margin-top:-1px;position: relative;left:-2px;border:none !important;"type="submit">
										<i class="fa fa-search" aria-hidden="true"></i>
									</button>
								</span>
								
							
							
							<div style="display:none;" class="test" id="display"></div>
							
						</div>
					  </div>
					</div>
				</div><!-- End: h_search -->
				
				</form>
				
			</div>
			
			

			
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <div class="h_right"><!-- Begin: h_right -->
                	<div class="cart_lft">
                    	<h6 class="cart_lft_h6">Your Cart </h6>
                        <!--p class="cart_lft_p">2 Items - <span style="color:#a240a5">122.50&euro;</span></p-->
                    </div>
                    <div class="cart_rt">
                    	
						<a href="<?php echo base_url(); ?>page/cart">
							<p class="cart_rt_p"><i class="fa fa-shopping-cart" aria-hidden="true"></i></p>
							<div class="cart_rt_rate">
								
								<p class="cart_rt_rate_p">
									<?php
										if ($cart = $this->cart->contents()){
											echo checkNumber(count($cart));
										}else{
											echo '0';
										}
									?>
								</p>
								
							</div>
						</a>
						
                    </div>
                </div><!-- End: h_right -->
            </div>

        </div>
        
        </div>
    </div>
</div><!-- End: header -->
