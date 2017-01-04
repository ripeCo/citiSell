<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cart_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	


	function update_cart($rowid, $qty, $price, $amount, $shippingInfo) {
 		$data = array(
			'rowid'   => $rowid,
			'qty'     => $qty,
			'price'   => $price,
			'amount'   => $amount,
			'shippingCostPerRow' => $shippingInfo['shippingCostPerRow'],
			'trk_main' => (!empty($shippingInfo['trk_main']) ? $shippingInfo['trk_main'] : ""),
			'label_fmt' => (!empty($shippingInfo['label_fmt']) ? $shippingInfo['label_fmt'] : ""),
			'label_img' => (!empty($shippingInfo['label_img']) ? $shippingInfo['label_img'] : ""),
		);

		$this->cart->update($data);
	}
	
	
	

	function update_paymentstatus() {
 		//$uuid = $this->session->userdata('userid');
 		$orderid = $this->session->userdata('orderid');
		
		$data = array(
			'payment_status'   => 'Paid'
		);
		$this->db->where('orderid', $orderid);
		$this->db->update('orders', $data);
	}
	
	
	

	function update_outstandingbillingstatus() {
 		
		$uuid 		= $this->session->userdata('userid');
 		$shopid 	= $this->session->userdata('shopid');
 		$billmonth 	= date('F Y');
 		$billdate 	= date('F d, Y');
		$billdatetime = date('Y-m-d H:i:s');
		
		$data = array(
			'billdatetime'   	=> $billdatetime,
			'billstatus'   		=> 'Paid'
		);
		
		$this->db->where('userid', $uuid);
		$this->db->where('shopid', $shopid);
		$this->db->where('billmonth', $billmonth);
		$this->db->update('bill', $data);
	}
	

	function update_cancel_outstandingbillingstatusandtime() {
 		
		$uuid 		= $this->session->userdata('userid');
 		$shopid 	= $this->session->userdata('shopid');
 		$billmonth 	= date('F Y');
 		$billdate 	= date('F d, Y');
		$billdatetime = date('Y-m-d H:i:s');
		
		$data = array(
			'billdatetime'  => '0000-00-00 00:00:00',
			'billstatus'   	=> NULL
		);
		
		$this->db->where('userid', $uuid);
		$this->db->where('shopid', $shopid);
		$this->db->where('billmonth', $billmonth);
		$this->db->update('bill', $data);
	}
	

	function update_cancel_order_delete() {
 		
		$uuid 		= $this->session->userdata('userid');
 		$shopid 	= $this->session->userdata('shopid');
 		$billmonth 	= date('F Y');
 		$billdate 	= date('F d, Y');
		$billdatetime = date('Y-m-d H:i:s');
		
		$data = array(
			'billdatetime'  => '0000-00-00 00:00:00',
			'billstatus'   	=> NULL
		);
		
		$this->db->where('userid', $uuid);
		$this->db->where('shopid', $shopid);
		$this->db->where('billmonth', $billmonth);
		$this->db->where('billstatus', 'Pending');
		$this->db->update('bill', $data);
	}
	
	
	

	function delete_cancelledorder() {
 		//$uuid = $this->session->userdata('userid');
 		$orderid = $this->session->userdata('orderid');
		
		$this->db->delete('orders', array('orderid' => $orderid)); // Delete from orders table
		
		$this->db->delete('orderdetails', array('orderid' => $orderid)); // Delete from orderdetails table
		
		$this->db->delete('ordershop', array('orderid' => $orderid)); // Delete from ordershop table
		
		$this->db->delete('paymentdetails', array('orderid' => $orderid)); // Delete from paymentdetails table
		
		$this->db->delete('billdetails', array('orderid' => $orderid)); // Delete from billdetails table
		
		
		if ($this->db->affected_rows() == 1)
			return TRUE;
		else 
			return FALSE;
		
	}
	
	
	

	function delete_PendingOrders($orderid) {
 		//$uuid = $this->session->userdata('userid');
 		//$orderid = $this->session->userdata('orderid');
		
		$this->db->delete('orders', array('orderid' => $orderid)); // Delete from orders table
		
		$this->db->delete('orderdetails', array('orderid' => $orderid)); // Delete from orderdetails table
		
		$this->db->delete('ordershop', array('orderid' => $orderid)); // Delete from ordershop table
		
		$this->db->delete('paymentdetails', array('orderid' => $orderid)); // Delete from paymentdetails table
		
		$this->db->delete('billdetails', array('orderid' => $orderid)); // Delete from billdetails table
		
		
		if ($this->db->affected_rows() == 1)
			return TRUE;
		else 
			return FALSE;
		
	}
	
	
	

	function delete_outstandingbillingstatus() {
 		
		$uuid 			= $this->session->userdata('userid');
		$shopid 		= $this->session->userdata('shopid');
		$billdetailsid 	= $this->session->userdata('billdetailsid');
		$billid 		= $this->session->userdata('billid');
		
		$this->db->delete('billdetails', array('userid' => $uuid, 'shopid' => $shopid, 'billdetailsid' => $billdetailsid, 'billid' =>$billid )); // Delete from billdetails table
		
		if ($this->db->affected_rows() == 1)
			return TRUE;
		else 
			return FALSE;
		
	}
	
	
	
	function getLastInserted() {
		$query ="SELECT orderid as maxID from mega_orders where orderid = LAST_INSERT_ID()";
		return $query;
	}
	
	

	public function placeorder() {
 		
		$this->db->trans_start();
		
		$date = date('Y-m-d H:i:s');
		
		// Get last order id number
		$this->db->select_max('orderid');
		$result = $this->db->get('mega_orders')->row();  
		$orderid = $result->orderid+1;
		
		if($orderid < 10){ $ordrid = checkNumber($orderid); }else{ $ordrid = checkNumber($orderid); }
		$ordernumber = 'Order#'.date('Ymd').$ordrid;
		
		$insert_order = array(
			'ordernumber' 			=> $ordernumber,
			'order_date' 			=> $date,
			'order_userid' 			=> $this->session->userdata('userid'),
			'order_paymenttype' 	=> $this->input->post('paymentmethod'),
			'order_amount' 			=> $this->input->post('order_amount'),
			'order_shipping_amount' => $this->input->post('shipping_amount'),
			'order_shippingtype' 	=> '',
			'order_usercountry' 	=> $this->input->post('usrcntry'),
			'order_ship_address' 	=> $this->input->post('shipaddress'),
			'order_status' 			=> 'Pending'
		);
		
		
		 // Insert into mega_orders
		$this->db->insert('orders',$insert_order);
		$orderid = $this->db->insert_id();
		
		// Set orderid in session
		$this->session->set_userdata(array(
			'orderid'       => $orderid
		));
		
		
		// ordershop table data insert
		for($spod=0;$spod<count($this->input->post('shpid')); $spod++){
			
			$cpaymentmonth = date('F d, Y');
			$ssspid = $this->input->post('shpid');
			
			$insert_ordershop = array(
				'orderid' 			=> $orderid,
				'shopid' 			=> $ssspid[$spod],
				'shippingstatus' 	=> 'Pending'
			);
			
			$shpid = $this->input->post('shpid');
			
			
			// Insert into mega_ordershop
			
			$this->db->insert('ordershop',$insert_ordershop);
			
			$qnty = $this->input->post('quantity');
			
			$buyername = $this->input->post('buyername');
			$buyerid = $this->input->post('buyerid');
			$ssstotal = $this->input->post('subtotal');
			
			$order = '<a class="text-primary" href="'.base_url().'page/user/yourorder/'.$orderid.'/'.$shpid[$spod].'">'.$ordernumber.'</a>';
			
			$buyer = '<a class="text-primary" href="'.base_url().'page/user/userprofile/'.$buyerid.'">'.$buyername.'</a>';
			
			$description = 'Payment for '.$order.' ('.$qnty[$spod].' item) purchased online by '.$buyer.' on '.$cpaymentmonth;
			
			// Get Sales Commission from mega_settings
				$getSalesCommission101 = $this->db->query("select * from mega_settings");
				extract($getSalesCommission101->row_array());
			
			$selscommission = $sell_commission * $ssstotal[$spod] / 100;
			$netamount = $ssstotal[$spod] - $selscommission;
			
			$shopuserid = $this->input->post('shopuserid');
			$shpid 		= $this->input->post('shpid');
			
			
			// Get current balance Seller Shop Payment account
			$paymentaccdetailsSql = $this->db->query("select currentbalance from mega_paymentdetails where userid=$shopuserid[$spod] and shopid=$shpid[$spod] order by paymentdetailsid DESC");
			
			if($paymentaccdetailsSql->num_rows() >0){
				extract($paymentaccdetailsSql->row_array());
				$cbalance = $currentbalance;
			}else{
				$cbalance = 0;
			}
			
			$currentamount = $cbalance + $netamount;
			
			$insert_paymentdetails = array(
				'userid' 			=> $shopuserid[$spod],
				'shopid' 			=> $shpid[$spod],
				'orderid' 			=> $orderid,
				'paymentmonth' 		=> $cpaymentmonth,
				'descriptions' 		=> $description,
				'amount' 			=> $ssstotal[$spod],
				'fees' 				=> $selscommission,
				'netamount' 		=> $netamount,
				'currentbalance' 	=> $currentamount
			);
			
			// Insert into mega_paymentdetails
			$this->db->insert('paymentdetails',$insert_paymentdetails);
			
			
			
			// Get current balance Seller Billing Account
			
			$billingmonth = date('F Y');
			
			$paymentBillingSql = $this->db->query("select billid,fees from mega_bill where userid=$shopuserid[$spod] and shopid=$shpid[$spod] and billmonth='$billingmonth' order by billid DESC");
			
			extract($paymentBillingSql->row_array());
			
			$currentFees = $fees + $selscommission;
			$billno = $billid;
			
			$update_bill = array(
				'fees' 			=> $currentFees,
				'billdatetime' 	=> $date,
				'billstatus' 	=> 'Pending'
			);
			
			// Update mega_bill
			$this->db->where('userid', $shopuserid[$spod]);
			$this->db->where('shopid', $shpid[$spod]);
			$this->db->where('billmonth', $billingmonth);
			$this->db->update('bill',$update_bill);
			
			
			// Insert into mega_billdetails
			
			$salesCommissionOrder = '<a class="text-primary" href="'.base_url().'page/user/yourorder/'.$orderid.'/'.$shpid[$spod].'">'.$ordernumber.'</a>';
			
			$salCommissionDetails = 'Payment for '.$order.' sales commission by '.$buyer.' on '.$cpaymentmonth;
			
			$insert_billdetailsSalesFee = array(
				'userid' 				=> $shopuserid[$spod],
				'shopid' 				=> $shpid[$spod],
				'billid' 				=> $billno,
				'orderid' 				=> $orderid,
				'billmonth' 			=> $billingmonth,
				'billdate' 				=> $cpaymentmonth,
				'descriptions' 			=> $salCommissionDetails,
				'activitytype' 			=> 'Sales Commission',
				'billdatetime' 			=> $date,
				'fees' 					=> $selscommission
			);
			
			// Insert into mega_billdetails
			$this->db->insert('billdetails',$insert_billdetailsSalesFee); 
			
			
			// Double Insert for Shipping fees
			
			/*
				$paymentBillShippingSql = $this->db->query("select billid,fees from mega_bill where userid=$shopuserid and shopid=$shpid and billmonth='$billingmonth' order by billid DESC");
				
				extract($paymentBillShippingSql->row_array());
				
				$recentFees = $fees + $this->input->post('shipping_amount');
				$billnumber = $billid;
				
				$update_Sgippingbill = array(
					'fees' 		=> $recentFees
				);
				
				// Update mega_bill
				$this->db->where('userid', $shopuserid);
				$this->db->where('shopid', $shpid);
				$this->db->where('billmonth', $billingmonth);
				$this->db->update('bill',$update_Sgippingbill);
			*/
			
			
			$salShippingCoseDDetails = 'Payment for '.$order.' sales shipping cost by '.$buyer.' on '.$cpaymentmonth;
			
			$insert_billdetailsSalesShippingFee = array(
				'userid' 				=> $shopuserid[$spod],
				'shopid' 				=> $shpid[$spod],
				'billid' 				=> $billno,
				'orderid' 				=> $orderid,
				'billmonth' 			=> $billingmonth,
				'billdate' 				=> $cpaymentmonth,
				'descriptions' 			=> $salShippingCoseDDetails,
				'activitytype' 			=> 'Shipping Cost',
				'billdatetime' 			=> $date,
				'fees' 					=> $this->input->post('shipping_amount')
			);
			
			// Insert into mega_billdetails
			$this->db->insert('billdetails',$insert_billdetailsSalesShippingFee); 
			
			
		}
		
		$cart = $this->cart->contents();
		
		// orderdetails table data insert
		for($od=0;$od<count($this->input->post('pid')); $od++){
			
			$pid = $this->input->post('pid');
			$unitprice = $this->input->post('unitprice');
			$quantity = $this->input->post('quantity');
			$subtotal = $this->input->post('subtotal');
			$productVariations = $this->input->post('productVariations');
			$shipprocessingtime = $this->input->post('shipprocessingtime');

			// Let's find the corresponding productId in the cart because this one uses the post data instead of shopping cart.
			foreach ($cart as $key => $value) {
				if ($pid[$od] == $value['id']) {
					$trk_main = $value['trk_main'];
					$label_fmt = $value['label_fmt'];
					$label_img = $value['label_img'];
					$shippping_cost = $value['shippingCostPerRow'];
					break;
				}
			}
			
			$insert_orderdetails = array(
				'shopid' 				=> $shpid[$od],
				'orderid' 				=> $orderid,
				'productid' 			=> $pid[$od],
				'unitprice' 			=> $unitprice[$od],
				'quantity' 				=> $quantity[$od],
				'subtotal' 				=> $subtotal[$od],
				'shippping_cost' 		=> $shippping_cost,
				'productVariations' 	=> $productVariations[$od],
				'shipprocessingtime' 	=> $shipprocessingtime[$od],
				'trk_main' => $trk_main,
				'label_fmt' => $label_fmt,
				'label_img' => $label_img,
			);
			
			// Insert into mega_orderdetails
			$this->db->insert('orderdetails',$insert_orderdetails); 
		}

		file_put_contents("c:\\tmp\\cart_contents.txt", print_r($this->cart->contents(), TRUE));
		
		$data['message'] = '<p class="bg-success" id="msg"><i class="fa fa-check-square-o"></i> Order place confirm!</p>';
		$data['breadcrumb'] = sitename().' - Order place confirm';
		
		//$this->load->view('page/placeorder', $data);
		
		$this->db->trans_complete();
		
	}
	
	
	
	

	public function outstandingbillpay() {
 		
		$this->db->trans_start();
		
		$datetime = date('Y-m-d H:i:s');
		$shpid = $this->session->userdata('shopid');
		$userid = $this->session->userdata('userid');
		
			
			$cpaymentmonth = date('F d, Y');
			
			
			// Get current balance Seller Billing Account
			
			$billingmonth = date('F Y');
			
			if($this->input->post('paymentamount_choice') == 'total_balance'){
				
				$billpaymentamounts = $this->input->post('totalbill'); //Bill Payment Amounts
				
			}else if($this->input->post('paymentamount_choice') == 'other'){
				
				$billpaymentamounts = $this->input->post('other_amount'); //Bill Payment Amounts
				
			}else{
				
				$billpaymentamounts = 0; //Bill Payment Amounts
				
			}
			
			$paymentBillingSql = $this->db->query("select billid,fees,paymentamount from mega_bill where userid=$userid and shopid=$shpid and billmonth='$billingmonth' order by billid DESC");
			
			extract($paymentBillingSql->row_array());
			
			$currentFees = $fees - $billpaymentamounts;
			$paidamounts = $paymentamount + $billpaymentamounts;
			$billno = $billid;
			
			$update_bill = array(
				'fees' 			=> $currentFees,
				'paymentamount' => $paidamounts,
				'billdatetime' 	=> $datetime,
				'billstatus' 	=> 'Pending'
			);
			
			// Update mega_bill
			$this->db->where('userid', $userid);
			$this->db->where('shopid', $shpid);
			$this->db->where('billmonth', $billingmonth);
			$this->db->update('bill',$update_bill);
		
		
		// Insert into mega_billdetails
			
			$outstandingBillDetails = 'Payment for outstanding bill on month '.$cpaymentmonth;
			
			$currentdatetime = date('Y-m-d H:i:s');
			
			$insert_billdetailsOutstandingPayment = array(
				'userid' 				=> $userid,
				'shopid' 				=> $shpid,
				'billid' 				=> $billno,
				'billmonth' 			=> $billingmonth,
				'billdate' 				=> $cpaymentmonth,
				'descriptions' 			=> $outstandingBillDetails,
				'activitytype' 			=> 'Outstanding bill payment',
				'billdatetime' 			=> $currentdatetime,
				'billpayment' 			=> $billpaymentamounts,
				'billingstatus' 		=> 'Pending'
			);
			
			// Insert into mega_billdetails
			$this->db->insert('billdetails',$insert_billdetailsOutstandingPayment);

			$billdetailsid = $this->db->insert_id();
			
			// Set session for billdetailsid
			$this->session->set_userdata(array(
				'billid'       		=> $billno,
				'billdetailsid'     => $billdetailsid
			));
		
		
		//$data['message'] = '<p class="bg-success" id="msg"><i class="fa fa-check-square-o"></i> Order place confirm!</p>';
		//$data['breadcrumb'] = sitename().' - Order place confirm';
		
		$this->db->trans_complete();
		
	}
	
	
	
	
	
}