<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Get Out of the system ..!'); 

class Yourshop_model extends CI_Model 
{
	
	// Create new record
	public function newshopopen() 
	{
		$status = 'Active';
		$date = date('Y-m-d H:i:s', bd_time());
                  
		$data = array(
			'userid'          			=> $this->session->userdata('userid'),  
			'shop_language'            	=> $this->input->post('shop_language'),  
			'shop_currency'            	=> $this->input->post('shop_currency'),  
			'shop_location'             => $this->input->post('shop_location'),
			'intention'                	=> $this->input->post('intention'),
			'created_on'    			=> $date, 
			'shop_status'              	=> $status
		);  
		$this->db->insert('shops', $data);
	}
	
	
        
        
	// Get record by id for update
	public function get_sectiondata() 
	{
	   $this->db->select('*');
	   $this->db->from('section');
	   $this->db->where('sectionstatus', 1);
	   
	   $results = $this->db->get();
	   return $results->result();
	}

	public function getShippingDetails($productId) 
	{
	   $this->db->select('ship_from, lbs, length, width, height');
	   $this->db->from('mega_shippingdetails');
	   $this->db->where('productid', $productid);
	   
	   $results = $this->db->get();
	   return $results->row_array();
	}
	
        
        
	// Get record by id for update
	public function getshopdata($shopid) 
	{
	   $query = $this->db->get_where('shops',array('shopid' => $shopid));
	   return $query->row_array();		  
	}
	
        
        
	// Get record by id for update
	public function getshopbilldata($shopid) 
	{
	   
	   $currentmonth = date('F Y');
	   
	   $query = $this->db->get_where('bill',array('shopid' => $shopid, 'billmonth' => $currentmonth));
	   return $query->row_array();		  
	}
	
        
        
	// Get record by id for update
	public function get_data_shops($id) 
	{
	   $query = $this->db->get_where('shops',array('userid' => $id));
	   return $query->row_array();		  
	}
	
	
	
        
	// Get record by id for update
	public function get_data($id) 
	{
	   $query = $this->db->get_where('users',array('userid' => $id));
	   return $query->row_array();		  
	}
	
	
	
        
	// Get checkshopname check
	public function checkshopname($shopname) 
	{
	   $attr = array(
			'shop_name'	=> $shopname
		);
        $query = $this->db->get_where('shops',$attr);
		
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
		
	}
	
	
	
    
    // userid Exist Checking By Model Function
    public function shopuser_exists($key)
    {
        $attr = array(
			'userid'	=> $key
		);
        $query = $this->db->get_where('shops',$attr);
        if ($query->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }
    
	
    // Shopname Exist Checking By Model Function
    public function shopname_exists($key)
    {
        $attr = array(
			'shop_name'	=> $key
		);
        $query = $this->db->get_where('shops',$attr);
        if ($query->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }
	
	
    
	
    // Shop product Exist Checking By Model Function
    public function shopproduct_exists($key)
    {
        $attr = array(
			'shopid'	=> $key
		);
        $query = $this->db->get_where('products',$attr);
        if ($query->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }
    
	
	
	
    // Shop product Exist Checking By Model Function
    public function shopproduct_num($key)
    {
        $attr = array(
			'shopid'	=> $key
		);
        $query = $this->db->get_where('products',$attr);
        return $query->num_rows();
    }
        
        
		
		
	
	// Update Shopname record
	public function updateshopname($userid) 
	{
		$data = array(
			'shop_name'	=> $this->input->post('shop_name')
		);  

		$this->db->where('userid', $userid);
		$this->db->update('shops', $data);

	}	
	
	
	/////////////////////////////////////
	//	Shop Close Query Start
	////////////////////////////////////
	
	// Update Shop Block record
	public function shopcloseblock($userid,$shopid) 
	{
		$data = array(
			'shop_status'	=> 'Block'
		);  

		$this->db->where('userid', $userid);
		$this->db->where('shopid', $shopid);
		$this->db->update('shops', $data);

	}	
		
	
	// Update Shop product inactive record
	public function shopproductinactive($shopid) 
	{
		$data = array(
			'product_live'	=> 'Inactive'
		);  

		$this->db->where('shopid', $shopid);
		$this->db->update('products', $data);

	}	
		
	
	// Update Shop open none record
	public function shopopennone($userid,$shopid) 
	{
		$data = array(
			'shopopen'	=> 0
		);  

		$this->db->where('userid', $userid);
		$this->db->where('shopopen', $shopid);
		$this->db->update('users', $data);

	}  
	
	
	/////////////////////////////////////
	//	Shop Close Query End
	////////////////////////////////////
	
	
	
	// Product Listing query
	public function insertlistedproduct($shopid,$imgfiles) 
	{
		$userid 		= $this->input->post('userid');
		$date 			= date('Y-m-d H:i:s', bd_time());
		
		$tags = array();
		foreach($this->input->post('tags') as $res) {
			//do something
			$tags[] = $res;
		}
		$tagsVal = implode(',', $tags);
		
		$materials = array();
		foreach($this->input->post('materials') as $resMat) {
			//do something
			$materials[] = $resMat;
		}
		$materialsVal = implode(',', $materials);
		
		$data = array(
			'product_name'					=> $this->input->post('product_name'),
			'who_made'						=> $this->input->post('who_made'),
			'is_supply'						=> $this->input->post('is_supply'),
			'when_made'						=> $this->input->post('when_made'),
			'product_price'					=> $this->input->post('product_price'),
			'product_item_details'			=> $this->input->post('product_item_details'),
			'product_image'					=> $imgfiles,
			'shopid'						=> $shopid,
			'product_category_id'			=> $this->input->post('product_category_id'),  
			'product_sub_category_id'		=> $this->input->post('product_sub_category_id'),  
			'product_sub_category_lev2_id'	=> $this->input->post('product_sub_category_lev2_id'),  
			'product_update_date'			=> $date,
			'product_expire_date'			=> addmonths($this->input->post('product_renewal')),
			/*'product_expire_date'			=> $date,*/
			'product_stock'					=> $this->input->post('product_stock'),
			'product_live'					=> 'Active',
			'product_location'				=> $this->input->post('product_location'),
			'productsection'				=> $this->input->post('section'),
			'tags'							=> $tagsVal,
			'materials'						=> $materialsVal,
			'product_renew'					=> 1
		);  

		$this->db->insert('products', $data);

	}
	
	
	// Product Update Listing query
	public function updateshopproduct($productid,$shopid,$listingimg) 
	{
		$userid 		= $this->input->post('userid');
		$date 			= date('Y-m-d H:i:s', bd_time());
		
		$tags = array();
		foreach($this->input->post('tags') as $res) {
			//do something
			$tags[] = $res;
		}
		$tagsVal = implode(',', $tags);
		
		$materials = array();
		foreach($this->input->post('materials') as $resMat) {
			//do something
			$materials[] = $resMat;
		}
		$materialsVal = implode(',', $materials);
		
		$data = array(
			'product_name'					=> $this->input->post('product_name'),
			'who_made'						=> $this->input->post('who_made'),
			'is_supply'						=> $this->input->post('is_supply'),
			'when_made'						=> $this->input->post('when_made'),
			'product_price'					=> $this->input->post('product_price'),
			'product_item_details'			=> $this->input->post('product_item_details'),
			'product_image'					=> $listingimg,
			'product_category_id'			=> $this->input->post('product_category_id'),  
			'product_sub_category_id'		=> $this->input->post('product_sub_category_id'),  
			'product_sub_category_lev2_id'	=> $this->input->post('product_sub_category_lev2_id'), 
			'product_stock'					=> $this->input->post('product_stock'),
			'product_live'					=> $this->input->post('product_live'),
			'productsection'				=> $this->input->post('section'),
			'tags'							=> $tagsVal,
			'materials'						=> $materialsVal
		);  

		$this->db->where('productid', $productid);
		$this->db->where('shopid', $shopid);
		$this->db->update('products', $data);
	} 
	
	
	// Shop Vacation update query
	public function vacationupdate() 
	{
		$userid 		= $this->session->userdata('userid');
		$shopid 		= $this->session->userdata('shopid');
		
		$date 			= date('Y-m-d H:i:s', bd_time());
		
		$data = array(
			'vacationmode'		=> $this->input->post('vacationmode')
		);  

		$this->db->where('userid', $userid);
		$this->db->where('shopid', $shopid);
		$this->db->update('shops', $data);
	} 
	
	
	
	// Product Variations Update Listing query
	public function updateproductvariationsC($productid) 
	{
		// Color Variation Option
		
			$coloroptgroupid = $this->input->post('option_group_nameC');
			$colorVaritionGet = $this->db->query("select * from mega_productvariations where productid=$productid and optiongroupid=$coloroptgroupid");
			
			if( count($this->input->post('coloroptionname')) > $colorVaritionGet->num_rows()){
				
				// First Delete
				$colorVaritiondelete = $this->db->query("delete from mega_productvariations where productid=$productid and optiongroupid=$coloroptgroupid");
				
				// Than Insert
				for($opt=0;$opt<count($this->input->post('coloroptionname'));$opt++){
					
					$coloroptiongroupid = $this->input->post('option_group_nameC');
					$coloroptionname = $this->input->post('coloroptionname');
					
					$data = array(
						'productid'			=> $productid,
						'optiongroupid'		=> $coloroptiongroupid,
						'optionname'		=> $coloroptionname[$opt]
					); 

					$this->db->insert('productvariations', $data);
					
				}
			
			}else{
			
				for($opt=0;$opt<count($this->input->post('coloroptionid'));$opt++){
					
					$coloroptiongroupid = $this->input->post('option_group_nameC');
					$coloroptionname = $this->input->post('coloroptionname');
					$coloroptionid = $this->input->post('coloroptionid');
					
					$data = array(
						'productid'			=> $productid,
						'optiongroupid'		=> $coloroptiongroupid,
						'optionname'		=> $coloroptionname[$opt]
					); 

					//$this->db->insert('productvariations', $data);
					$this->db->where('variationsid', $coloroptionid[$opt]);
					$this->db->update('productvariations', $data);
					
				}
			
			}
		
		
	}
	
	
	
	// Product Variations Update Listing query
	public function updateproductvariationsS($productid) 
	{
		
		// Variation Size option
		
			$sizeoptgroupid = $this->input->post('option_group_nameS');
			$sizeVaritionGet = $this->db->query("select * from mega_productvariations where productid=$productid and optiongroupid=$sizeoptgroupid");
			
			if( count($this->input->post('sizeoptionname')) > $sizeVaritionGet->num_rows()){
				
				// First Delete
				$sizeVaritiondelete = $this->db->query("delete from mega_productvariations where productid=$productid and optiongroupid=$sizeoptgroupid");
				
				$sizeoptiongroupid = $this->input->post('option_group_nameS');
				$sizeoptionname = $this->input->post('sizeoptionname');
				$measuringunits = $this->input->post('measuringunits');
				$pricing = $this->input->post('pricing');
				
				// Than Insert
				for($opt=0;$opt<count($this->input->post('sizeoptionname'));$opt++){
					
					$data = array(
						'productid'			=> $productid,
						'optiongroupid'		=> $sizeoptiongroupid,
						'optionname'		=> $sizeoptionname[$opt],
						'measuringunits'	=> $measuringunits,
						'pricing'			=> $pricing[$opt]
					); 

					$this->db->insert('productvariations', $data);
					
				}
			
			}else{
			
				$sizeoptiongroupid = $this->input->post('sizeoptiongroupid');
				$sizeoptionname = $this->input->post('sizeoptionname');
				$measuringunits = $this->input->post('measuringunits');
				$pricing = $this->input->post('pricing');
				$sizeoptionid = $this->input->post('sizeoptionid');
				
				for($opt=0;$opt<count($this->input->post('sizeoptionid'));$opt++){
					
					$data = array(
						'productid'			=> $productid,
						'optiongroupid'		=> $sizeoptiongroupid,
						'optionname'		=> $sizeoptionname[$opt],
						'measuringunits'	=> $measuringunits,
						'pricing'			=> $pricing[$opt]
					); 

					//$this->db->insert('productvariations', $data);
					$this->db->where('variationsid', $sizeoptionid[$opt]);
					$this->db->update('productvariations', $data);
					
				}
			
			}
		
		
	} 
	
	
	
	// Product Shipping details Update query
	public function updateproductshipping($productid,$shopid) 
	{
		
		$data = array(
			'ship_from'								=> $this->input->post('ship_from'),
			'processing_time'						=> $this->input->post('processing_time'),
			'shipping_cost_by_itself'				=> $this->input->post('shipping_cost_by_itself'),
			'shipping_cost_with_another_items'		=> $this->input->post('shipping_cost_with_another_items'),
			'shipping_cost_int_by_itself'			=> $this->input->post('shipping_cost_int_by_itself'),
			'shipping_cost_int_with_another_items'	=> $this->input->post('shipping_cost_int_with_another_items'),
			'lbs'									=> $this->input->post('lbs'),
			'oz'									=> $this->input->post('oz'),
			'length'								=> $this->input->post('length'),
			'width'									=> $this->input->post('width'),
			'height'								=> $this->input->post('height')
		);

		$this->db->where('productid', $productid);
		$this->db->where('shopid', $shopid);
		$this->db->update('shippingdetails', $data);
		
	}  
	
	
	
	// Product Listing query
	public function insertproductoptions($productid) 
	{
		$userid 		= $this->input->post('userid');
		
		
		for($opt=0;$opt<count($this->input->post('option_group_id'));$opt++){
			
			$option_group_id = $this->input->post('option_group_id');
			$option_details = $this->input->post('option_details');
		
			$data = array(
				'product_id'			=> $productid,
				'option_group_id'		=> $option_group_id[$opt],
				'option_details'		=> $option_details[$opt]
			);

			$this->db->insert('productoptions', $data);
		}

	} 
	
	
	
	// Product Listing query
	public function insertproductvariationsColor($productid) 
	{
		$userid 		= $this->input->post('userid');
		
		for($opt=0;$opt<count($this->input->post('coloroptionname'));$opt++){
			
			$option_group_nameC = $this->input->post('option_group_nameC');
			$coloroptionname = $this->input->post('coloroptionname');
			
			$data = array(
				'productid'			=> $productid,
				'optiongroupid'		=> $option_group_nameC,
				'optionname'		=> $coloroptionname[$opt]
			);

			$this->db->insert('productvariations', $data);
		}

	}
	
	
	// Product Listing query
	public function insertproductvariationsSize($productid) 
	{
		$userid 		= $this->input->post('userid');
		
		for($opt=0;$opt<count($this->input->post('sizeoptionname'));$opt++){
			
			
			$optiongroupid			= $this->input->post('option_group_nameS');
			$optionname				= $this->input->post('sizeoptionname');
			$measuringunits			= $this->input->post('measuringunits');
			$pricing				= $this->input->post('pricing');
			
			$data = array(
				'productid'			=> $productid,
				'optiongroupid'		=> $optiongroupid,
				'optionname'		=> $optionname[$opt],
				'measuringunits'	=> $measuringunits,
				'pricing'			=> $pricing[$opt]
			);

			$this->db->insert('productvariations', $data);
		}

	}  
	
	
	// Product Listing query
	public function insertshoppinginfo($shopid,$productid) 
	{
		$userid 		= $this->input->post('userid');
				
		$data = array(
			'shopid'									=> $shopid,
			'productid'									=> $productid,
			'ship_from'									=> $this->input->post('ship_from'),
			'ship_to'									=> $this->input->post('ship_to'),
			'shipping_cost_by_itself'					=> $this->input->post('shipping_cost_by_itself'),
			'shipping_cost_with_another_items'			=> $this->input->post('shipping_cost_with_another_items'),
			'shipping_cost_int_by_itself'				=> $this->input->post('shipping_cost_int_by_itself'),
			'shipping_cost_int_with_another_items'		=> $this->input->post('shipping_cost_int_with_another_items'),
			'lbs'										=> $this->input->post('lbs'),
			'oz'										=> $this->input->post('oz'),
			'length'									=> $this->input->post('length'),
			'width'										=> $this->input->post('width'),
			'height'									=> $this->input->post('height'),
			'processing_time'							=> $this->input->post('processing_time')
		); 

		$this->db->insert('shippingdetails', $data);
		
	} 
	
	
	// Get max id record
	public function max() 
	{
		$this->db->select_max('productid');
		$result = $this->db->get('products')->row();  
		return $result->productid;
		
	}
	
	
	// Get all record from table
    public function getproducts($shopid)
    {
        $this->db->select('*');
        $this->db->from('products');
		
        $this->db->where('shopid', $shopid);
        $this->db->order_by('productid', 'ASC');
        $this->db->limit(7);
		
        $query = $this->db->get();
        return $query->result();
    }
	
	
	// Get all record from table
    public function getlistingproducts($shopid)
    {
        $this->db->select('*');
        $this->db->from('products');
		
        $this->db->where('shopid', $shopid);
        $this->db->order_by('productid', 'ASC');
		
        $query = $this->db->get();
        return $query->result();
    }
	
	
	// Get all record from table
    public function getRenualroducts()
    {
        $pid = $this->uri->segment(5);
		
		$this->db->select('*');
        $this->db->from('products');
		
        $this->db->order_by('productid', $pid);
		
        $query = $this->db->get();
        return $query->row_array();
    }
	
	
	
	
	// Payment Info Save for Paypal
	public function paypalinfosave($userid,$shopid){
		
		if($this->input->post('bankcountry') !== NULL){
			$bankaccount = 1;
			$bankcountry = $this->input->post('bankcountry');
			$accounttype = $this->input->post('accounttype');
			$accownername = $this->input->post('accownername');
			$routingnumber = $this->input->post('routingnumber');
			$accountnumber = $this->input->post('accountnumber');
		}else{
			$bankaccount = 0;
			$bankcountry = '';
			$accounttype = '';
			$accownername = '';
			$routingnumber = '';
			$accountnumber = '';
		}
		
		$data = array(
		'paymenttype'							=> $this->input->post('paymentmethod'),
		'paymentemail'							=> $this->input->post('paymentemail'),
		'userid'								=> $userid,
		'shopid'								=> $shopid,
		'bankaccount'							=> $bankaccount,
		'bankcountry'							=> $bankcountry,
		'accounttype'							=> $accounttype,
		'accownername'							=> $accownername,
		'routingnumber'							=> $routingnumber,
		'accountnumber'							=> $accountnumber
		); 
		
		$this->db->insert('paymentmethods', $data);
		
	}
	
	
	// Creditcard Info Save for Creditcard
	public function creditcardinfosave($userid,$shopid){
		
		if($this->input->post('bankcountry') !== NULL){
			$bankaccount = 1;
			$bankcountry = $this->input->post('bankcountry');
			$accounttype = $this->input->post('accounttype');
			$accownername = $this->input->post('accownername');
			$routingnumber = $this->input->post('routingnumber');
			$accountnumber = $this->input->post('accountnumber');
		}else{
			$bankaccount = 0;
			$bankcountry = '';
			$accounttype = '';
			$accownername = '';
			$routingnumber = '';
			$accountnumber = '';
		}
		
		$data = array(
		'paymenttype'						=> $this->input->post('paymentmethod'),
		'nameoncard'						=> $this->input->post('nameoncard'),
		'cardname'							=> $this->input->post('paymenttype'),
		'cardnumber'						=> $this->input->post('cardnumber'),
		'userid'							=> $userid,
		'shopid'							=> $shopid,
		'cvc'								=> $this->input->post('cvc'),
		'securitycode'						=> $this->input->post('securitycode'),
		'expiremonth'						=> $this->input->post('expiremonth'),
		'expireyear'						=> $this->input->post('expireyear'),
		'bankaccount'							=> $bankaccount,
		'bankcountry'							=> $bankcountry,
		'accounttype'							=> $accounttype,
		'accownername'							=> $accownername,
		'routingnumber'							=> $routingnumber,
		'accountnumber'							=> $accountnumber
		); 
		
		$this->db->insert('paymentmethods', $data);
		
	} 
	
	
	
	// Update users table openshop field record
	public function updateopendshop($userid,$shopid) 
	{
		$data = array(
			'shopopen'	=> $shopid
		);  

		$this->db->where('userid', $userid);
		$this->db->update('users', $data);

	}
	
	
	
	// Update shops table shopdone field record
	public function updateshopdone($shopid) 
	{
		$data = array(
			'shopdone'	=> 'Done'
		);  

		$this->db->where('shopid', $shopid);
		$this->db->update('shops', $data);
		
	}  
	
	
	
	// shop listings
	public function shoplistingview($shopid)
	{
		$select = 'SELECT *';
		$from = " From ".$_POST['tableName'];
		$where = " WHERE shopid=$shopid";
		$orderby = ' ORDER BY productid desc';
		$opts = isset($_POST['filterOpts'])? $_POST['filterOpts'] : array('');
		$main_opts = isset($_POST['filterMainOpts'])? $_POST['filterMainOpts'] : array('');	
		$from_colsize = '';
		
		$sql = $this->db->query("SHOW COLUMNS ".$from." where Field NOT LIKE 'product_suk' AND Field NOT LIKE 'product_name' AND Field NOT LIKE 'who_made' AND Field NOT LIKE 'is_supply' AND Field NOT LIKE 'when_made' AND Field NOT LIKE 'product_price' AND Field NOT LIKE 'product_item_details' AND Field NOT LIKE 'product_overview' AND Field NOT LIKE 'product_shopping_policy' AND Field NOT LIKE 'product_image' AND Field NOT LIKE 'shopid' AND Field NOT LIKE 'product_category_id' AND Field NOT LIKE 'product_sub_category_id' AND Field NOT LIKE 'product_sub_category_lev2_id' AND Field NOT LIKE 'product_update_date' AND Field NOT LIKE 'product_update_date' AND Field NOT LIKE 'bill_paid_or_not' AND Field NOT LIKE 'product_ratings' AND Field NOT LIKE 'product_favourites' AND Field NOT LIKE 'product_location'");	

		$colname = $sql->result();

		   foreach($colname as $queryShow)
			{
				if (in_array("$queryShow->Field", $main_opts))
				{
					$where .=" AND ( ";
					$field = $queryShow->Field;
					$filters = $this->db->query("SELECT distinct $field".$from);
					$colname1 = $filters->result();
					foreach($colname1 as $queryShw)
					{	
						if (in_array("{$queryShw->$field}", $opts))
						{
							$where .=" $queryShow->Field like '{$queryShw->$field}' OR ";
						}
					}
					$where .=" FALSE) ";
				}
			}


		$sql = $select . $from . $from_colsize . $where. $orderby;
		$statement = $this->db->query($sql);
		$results = $statement->result();
		$json = json_encode($results);
		echo ($json);
		
	}
	
	
	
	// shop listings
	public function shoplistinginactivatedview($shopid,$ppstatus)
	{
		$select = 'SELECT *';
		$from = " From ".$_POST['tableName'];
		$where = " WHERE shopid=$shopid AND product_live='$ppstatus'";
		$orderby = ' ORDER BY productid desc';
		$opts = isset($_POST['filterOpts'])? $_POST['filterOpts'] : array('');
		$main_opts = isset($_POST['filterMainOpts'])? $_POST['filterMainOpts'] : array('');	
		$from_colsize = '';
		
		$sql = $this->db->query("SHOW COLUMNS ".$from." where Field NOT LIKE 'product_suk' AND Field NOT LIKE 'product_name' AND Field NOT LIKE 'who_made' AND Field NOT LIKE 'is_supply' AND Field NOT LIKE 'when_made' AND Field NOT LIKE 'product_price' AND Field NOT LIKE 'product_item_details' AND Field NOT LIKE 'product_overview' AND Field NOT LIKE 'product_shopping_policy' AND Field NOT LIKE 'product_image' AND Field NOT LIKE 'product_category_id' AND Field NOT LIKE 'product_sub_category_id' AND Field NOT LIKE 'product_sub_category_lev2_id' AND Field NOT LIKE 'product_update_date' AND Field NOT LIKE 'product_expire_date' AND Field NOT LIKE 'bill_paid_or_not' AND Field NOT LIKE 'product_ratings' AND Field NOT LIKE 'product_favourites' AND Field NOT LIKE 'product_location'");	

		$colname = $sql->result();

		   foreach($colname as $queryShow)
			{
				if (in_array("$queryShow->Field", $main_opts))
				{
					$where .=" AND ( ";
					$field = $queryShow->Field;
					$filters = $this->db->query("SELECT distinct $field".$from);
					$colname1 = $filters->result();
					foreach($colname1 as $queryShw)
					{	
						if (in_array("{$queryShw->$field}", $opts))
						{
							$where .=" $queryShow->Field like '{$queryShw->$field}' OR ";
						}
					}
					$where .=" FALSE) ";
				}
			}


		$sql = $select . $from . $from_colsize . $where. $orderby;
		$statement = $this->db->query($sql);
		$results = $statement->result();
		$json = json_encode($results);
		echo ($json);
		
	}
	
	
	
	// shop listings
	public function shoplistingrenewview($shopid)
	{
		$select = 'SELECT *';
		$from = " From ".$_POST['tableName'];
		$where = " WHERE shopid=$shopid AND product_renew=0";
		$orderby = ' ORDER BY productid desc';
		$opts = isset($_POST['filterOpts'])? $_POST['filterOpts'] : array('');
		$main_opts = isset($_POST['filterMainOpts'])? $_POST['filterMainOpts'] : array('');	
		$from_colsize = '';
		
		$sql = $this->db->query("SHOW COLUMNS ".$from." where Field NOT LIKE 'product_suk' AND Field NOT LIKE 'product_name' AND Field NOT LIKE 'who_made' AND Field NOT LIKE 'is_supply' AND Field NOT LIKE 'when_made' AND Field NOT LIKE 'product_price' AND Field NOT LIKE 'product_item_details' AND Field NOT LIKE 'product_overview' AND Field NOT LIKE 'product_shopping_policy' AND Field NOT LIKE 'product_image' AND Field NOT LIKE 'product_category_id' AND Field NOT LIKE 'product_sub_category_id' AND Field NOT LIKE 'product_sub_category_lev2_id' AND Field NOT LIKE 'product_update_date' AND Field NOT LIKE 'product_expire_date' AND Field NOT LIKE 'bill_paid_or_not' AND Field NOT LIKE 'product_ratings' AND Field NOT LIKE 'product_favourites' AND Field NOT LIKE 'product_location'");	

		$colname = $sql->result();

		   foreach($colname as $queryShow)
			{
				if (in_array("$queryShow->Field", $main_opts))
				{
					$where .=" AND ( ";
					$field = $queryShow->Field;
					$filters = $this->db->query("SELECT distinct $field".$from);
					$colname1 = $filters->result();
					foreach($colname1 as $queryShw)
					{	
						if (in_array("{$queryShw->$field}", $opts))
						{
							$where .=" $queryShow->Field like '{$queryShw->$field}' OR ";
						}
					}
					$where .=" FALSE) ";
				}
			}


		$sql = $select . $from . $from_colsize . $where. $orderby;
		$statement = $this->db->query($sql);
		$results = $statement->result();
		$json = json_encode($results);
		echo ($json);
		
	}  
	
	
	
	// Shops privacy policy Insert model
	public function shopprivacypolicysave() 
	{
		$shopid = $this->session->userdata('shopid');
		$userid = $this->session->userdata('userid');
		
		$data = array(
			'userid'				=> $userid,
			'shopid'				=> $shopid,
			'welcomemsg'			=> $this->input->post('welcomemsg'),
			'paymentpolicy'			=> $this->input->post('paymentpolicy'),
			'shippingpolicy'		=> $this->input->post('shippingpolicy'),
			'refundpolicy'			=> $this->input->post('refundpolicy'),
			'additionalinfo'		=> $this->input->post('additionalinfo'),
			'privatereceiptinfo'	=> $this->input->post('privatereceiptinfo')
		);  

		$this->db->insert('shopsettings', $data);
		
	}
	
	
	
	// Get listing renewal Insert model
	public function getrenewal() 
	{
		
		$this->db->trans_start();
		
		$shopid = $this->session->userdata('shopid');
		$userid = $this->session->userdata('userid');
		
		$billingmonth = date('F Y');
		
		$cpaymentmonth = date('F d, Y');
		
		$currentdate = date('Y-m-d H:i:s');
		
		$paymentBillShippingSql = $this->db->query("select billid,fees from mega_bill where userid=$userid and shopid=$shopid and billmonth='$billingmonth' order by billid DESC");
			
		extract($paymentBillShippingSql->row_array());
		$billnumber = $billid;
		
		for($od=0;$od<count($this->input->post('renewalpid')); $od++){
			
			// Update bill record fees
			
			$totalfees = $fees + $this->input->post('totalfees');
			
			// Update mega_bill
			$update_Sgippingbill = array(
				'fees' 		=> $totalfees
			);
			
			$this->db->where('userid', $userid);
			$this->db->where('shopid', $shopid);
			$this->db->where('billmonth', $billingmonth);
			$this->db->update('bill',$update_Sgippingbill);
			
			
			// Update bill_paid_or_not, product_renew, product_stock into mega_products
			
			$ppid = $this->input->post('renewalpid');
			$quantity = $this->input->post('quantity');
			
			$update_products = array(
				'product_update_date' 	=> $currentdate,
				'product_expire_date' 	=> addmonths($this->input->post('productrenewal')),
				'bill_paid_or_not' 		=> 1,
				'product_stock' 		=> $quantity[$od],
				'product_live' 			=> 'Active',
				'product_renew' 		=> 1
			);
			
			$this->db->where('productid', $ppid[$od]);
			$this->db->update('products',$update_products);
			
			
			// Insert billdetails records
			
			$renewalDetails = $this->input->post('descriptions');
			$renewal_amount = $this->input->post('renewal_amount');
			
			$insert_billdetailsSalesShippingFee = array(
				'userid' 				=> $userid,
				'shopid' 				=> $shopid,
				'billid' 				=> $billnumber,
				'billmonth' 			=> $billingmonth,
				'billdate' 				=> $cpaymentmonth,
				'descriptions' 			=> $renewalDetails[$od],
				'activitytype' 			=> 'Renewal fees',
				'fees' 					=> $renewal_amount[$od]
			);
			
			// Insert into mega_billdetails
			$this->db->insert('billdetails',$insert_billdetailsSalesShippingFee); 
			
		}
		
		$this->db->trans_complete();
		
	}
	
	
	
	// Get listing renewal Insert model
	public function generateNewListingBill() 
	{
		
		$this->db->trans_start();
		
		$shopid = $this->session->userdata('shopid');
		$userid = $this->session->userdata('userid');
		
		$billingmonth = date('F Y');
		
		$cpaymentmonth = date('F d, Y');
		
		$currentdate = date('Y-m-d H:i:s');
		
		$paymentBillShippingSql = $this->db->query("select billid,fees from mega_bill where userid=$userid and shopid=$shopid and billmonth='$billingmonth' order by billid DESC");
			
		extract($paymentBillShippingSql->row_array());
		$billnumber = $billid;
		
		// Get listing_cost Months from mega_settings
			$getProductRenewalMonth101 = $this->db->query("select * from mega_settings");
			extract($getProductRenewalMonth101->row_array());
		
			
			// Update bill record fees
			
			$totalfees = $fees + $listing_cost;
			
			// Update mega_bill
			$update_Sgippingbill = array(
				'fees' 		=> $totalfees
			);
			
			$this->db->where('userid', $userid);
			$this->db->where('shopid', $shopid);
			$this->db->where('billmonth', $billingmonth);
			$this->db->update('bill',$update_Sgippingbill);
			
			
			// Insert billdetails records
			
			$renewalDetails = $this->input->post('product_name');
			$renewal_amount = $listing_cost;
			
			$insert_billdetailsSalesShippingFee = array(
				'userid' 				=> $userid,
				'shopid' 				=> $shopid,
				'billid' 				=> $billnumber,
				'billmonth' 			=> $billingmonth,
				'billdate' 				=> $cpaymentmonth,
				'descriptions' 			=> $renewalDetails,
				'activitytype' 			=> 'Listing fees',
				'fees' 					=> $renewal_amount
			);
			
			// Insert into mega_billdetails
			$this->db->insert('billdetails',$insert_billdetailsSalesShippingFee); 
			
		
		$this->db->trans_complete();
		
	} 
	
	
	
	// Shops privacy policy update model
	public function shopprivacypolicyupdate() 
	{
		$shopid = $this->session->userdata('shopid');
		$userid = $this->session->userdata('userid');
		
		$data = array(
			'userid'				=> $userid,
			'shopid'				=> $shopid,
			'welcomemsg'			=> $this->input->post('welcomemsg'),
			'paymentpolicy'			=> $this->input->post('paymentpolicy'),
			'shippingpolicy'		=> $this->input->post('shippingpolicy'),
			'refundpolicy'			=> $this->input->post('refundpolicy'),
			'additionalinfo'		=> $this->input->post('additionalinfo'),
			'privatereceiptinfo'	=> $this->input->post('privatereceiptinfo')
		);  

		$this->db->where('userid', $userid);
		$this->db->where('shopid', $shopid);
		$this->db->update('shopsettings', $data);
		
	}  
	
	
	
	// Shops product activate model
	public function activeproduct() 
	{
		$pid = $this->uri->segment(4);
		$date = date('Y-m-d H:i:s', bd_time());
		$expnumberofmonth = 4; // Expire number of month
		
		$data = array(
			'product_update_date'	=> $date,
			'product_expire_date'	=> addmonths($expnumberofmonth),
			'product_live'			=> 'Active'
		);  

		$this->db->where('productid', $pid);
		$this->db->update('products', $data);
		
	}
	
	
	
	// Shops product Deactivate model
	public function deactiveproduct() 
	{
		$pid = $this->uri->segment(4);
		$date = date('Y-m-d H:i:s', bd_time());
		//$expnumberofmonth = 4; // Expire number of month
		
		$data = array(
			'product_update_date'	=> $date,
			'product_live'			=> 'Inactive'
		);  

		$this->db->where('productid', $pid);
		$this->db->update('products', $data);
		
	}  
	
	
	
	// Shops Appearances Insert model
	public function shopinfoupdate($logofile,$bannerfile) 
	{
		$shopid = $this->session->userdata('shopid');
		$userid = $this->session->userdata('userid');
		
		$data = array(
			'shoplogo'			=> $logofile,
			'shoptitle'			=> $this->input->post('shoptitle'),
			'shopbanner'		=> $bannerfile
		);  

		$this->db->where('shopid', $shopid);
		$this->db->update('shops', $data);
		
	}
	
	
	
	// Main Search
	public function getsectionrecords($limit=NULL,$offset=NULL){
		
		if( $this->session->userdata('isLogin') == TRUE){
			//$shopid 				= $this->session->userdata('shopopen');
			$shopid 				= $this->uri->segment(4);
			$userid 				= $this->session->userdata('userid');
			$data['users'] 			= $this->yourshop_model->get_data($userid);
		}else{
			$shopid 				= $this->uri->segment(4);
		}
		
		$sectionid 	= $this->uri->segment(5);
		
		
		$this->db->select("*");
		
		if($this->uri->segment(6) == NULL){
			$query2 = $this->db->where('products.product_live', 'Active')
             ->where('products.shopid', $shopid)
             ->order_by('products.productid', 'DESC')
             ->limit($limit, $offset)
             ->get('products');
		}else{
			
			$query2 = $this->db->where('products.product_live', 'Active')
             ->where('products.shopid', $shopid)
             ->where('products.productsection', $sectionid)
             ->order_by('products.productid', 'DESC')
             ->limit($limit, $offset)
             ->get('products');
		}
		 
		return $query2->result();
		
	}
	
	
	// Main Action Search
	public function getsectiontotalrecords(){
		
		if( $this->session->userdata('isLogin') == TRUE){
			//$shopid 				= $this->session->userdata('shopopen');
			$shopid 				= $this->uri->segment(4);
			$userid 				= $this->session->userdata('userid');
			$data['users'] 			= $this->yourshop_model->get_data($userid);
		}else{
			$shopid 				= $this->uri->segment(4);
		}
		
		$sectionid 	= $this->uri->segment(5);
		
		$this->db->select("*");
		
		if($this->uri->segment(6) == NULL){
			$query2 = $this->db->where('products.product_live', 'Active')
             ->where('products.shopid', $shopid)
             ->get('products');
		}else{
			
			$query2 = $this->db->where('products.product_live', 'Active')
             ->where('products.shopid', $shopid)
             ->where('products.productsection', $sectionid)
             ->get('products');
		}
		
		 
		return $query2->num_rows();
		
	}
        
	
	

}
