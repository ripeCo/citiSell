<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Get Out of the system ..!'); 

class Page_model extends CI_Model 
{
	
	// Get all record from users table
	public function pagecontents($pagename) 
	{
		$this->db->select('*');
		$this->db->from('cms');
		
		$this->db->where('pagename',$pagename);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	
	
	// Get shop record from shops using shopid table
	public function shopinfo($shopid) 
	{
		$this->db->select('*');
		$this->db->from('shops');
		
		$this->db->where('shopid',$shopid);
		$query = $this->db->get();
		return $query->result();
	}
	
	
	
	// Get last 2 record from products table
    public function getlastnumberofproducts($limit)
    {
        $this->db->select('*');
        $this->db->from('products');
		
        $this->db->where('product_live', 'Active');
        $this->db->order_by('productid', 'DESC');
        $this->db->limit(0,$limit);
		
        $query = $this->db->get();
        return $query->result();
    }
	
	
	
	// Get last 3 record from products table
    public function getlastnumberofrandomproducts($limit)
    {
        $this->db->select('*');
        $this->db->from('products');
		
        $this->db->where('product_live', 'Active');
        $this->db->order_by('productid', 'DESC');
        $this->db->limit(0,$limit);
		
        $query = $this->db->get();
        return $query->result();
    }
	
	
	
	 

	function totalrecommaddeduiprecords($userip){
	 
		//return $this->db->count_all_results('mega_products');
		$this->db->select("*,recommededproducts.productid");
		$this->db->from('recommededproducts');
		
		$this->db->join('products','products.productid=recommededproducts.productid', 'LEFT');

		$this->db->where('recommededproducts.userip', $userip);
		$this->db->where('products.product_live', 'Active');
		$this->db->group_by('recommededproducts.productid');
        $this->db->order_by('recommededproducts.productid', 'RANDOM');
		
		$query = $this->db->get();
		return $query->num_rows();

	}
	
	
	
	// Get last 3 record from products table
    public function getlastnumberofrecommandedomproducts($limit)
    {
        $this->db->select('*,recommededproducts.productid');
        $this->db->from('recommededproducts');
		
		$this->db->join('products','recommededproducts.productid=products.productid', 'LEFT');
		
		$this->db->where('products.product_live', 'Active');
		$this->db->group_by('recommededproducts.productid');
		
        //$this->db->order_by('recommededproducts.productid', 'DESC');
        $this->db->order_by('recommededproducts.productid', 'RANDOM');
        $this->db->limit($limit);
		
        $query = $this->db->get();
        return $query->result();
    }
	
	
	
	// Get last 3 record from products table
    public function getlastnumberofrecommandedomproductsbyUserip($userip,$limit)
    {
        $this->db->select('*,recommededproducts.productid');
        $this->db->from('recommededproducts');
		
		$this->db->join('products','recommededproducts.productid=products.productid', 'LEFT');
		
        $this->db->where('userip', $userip);
		$this->db->where('products.product_live', 'Active');
		$this->db->group_by('recommededproducts.productid');
        //$this->db->order_by('recommededproducts.productid', 'DESC');
        $this->db->order_by('recommededproducts.productid', 'RANDOM');
        $this->db->limit($limit);
		
        $query = $this->db->get();
        return $query->result();
    }
	
	
	
	// Get all record from table
    public function getcategoryproducts($catid,$limit)
    {
        $this->db->select('*');
        $this->db->from('products');
		
        $this->db->where('product_live', 'Active');
        $this->db->where('product_category_id', $catid);
        $this->db->order_by('productid', 'RANDOM');
        $this->db->limit($limit);
		
        $query = $this->db->get();
        return $query->result();
    }
	
	
	
	// Get all record from table
    public function getallcatproducts($limit)
    {
        $this->db->select('*');
        $this->db->from('products');
		
        $this->db->where('product_live', 'Active');
        //$this->db->order_by('productid', 'RANDOM');
        $this->db->order_by('productid', 'DESC');
        $this->db->limit(0,$limit);
		
        $query = $this->db->get();
        return $query->result();
    }
	
	
	// Get all record from table
    public function getfavcatproducts($int,$limit)
    {
        $this->db->select('*');
        $this->db->from('products');
		
        $this->db->where('product_live', 'Active');
        //$this->db->order_by('productid', 'RANDOM');
        $this->db->order_by('productid', 'DESC');
        $this->db->limit($int,$limit);
		
        $query = $this->db->get();
        return $query->result();
    }
	
	
	
	
	// Get all record from table
    public function getallproducts($init,$limit)
    {
        $sql = 'select * from mega_products where product_live="Active" order by rand() limit ' .$init.','.$limit;
        $query = $this->db->query($sql);
        return $query->result();
    }
	
	
	
	
	function getrecords($limit=NULL,$offset=NULL){
	  
	  $this->db->select("*");
	  $this->db->from('products');
	  
	  $this->db->where('product_live','Active');
	  $this->db->order_by('productid', 'RANDOM');
	  $this->db->limit($limit, $offset);
	  $query = $this->db->get();
	  
	  return $query->result();
	  
	}
	
	
	
	function getcatrecords($catid,$limit=NULL,$offset=NULL){
	  
	  $this->db->select("*");
	  $this->db->from('products');
	  
	  $this->db->where('product_live','Active');
	  $this->db->where('product_category_id', $catid);
	  $this->db->order_by('productid', 'RANDOM');
	  $this->db->limit($limit, $offset);
	  $query = $this->db->get();
	  
	  return $query->result();
	  
	}
	
	 

	function totalrecords(){
	 
		//return $this->db->count_all_results('mega_products');
		$this->db->select("*");
		$this->db->from('products');

		$this->db->where('product_live','Active');
		
		$query = $this->db->get();
		return $query->num_rows();

	}
	
	
	
 
	function totalcatrecords($catid){
	 
		$this->db->select("*");
		$this->db->from('products');

		$this->db->where('product_live','Active');
		$this->db->where('product_category_id', $catid);
		
		$query = $this->db->get();
		return $query->num_rows();

	}
	
	
	
	
	// Get all record from table
    public function getaalcategory($limit)
    {
        $this->db->select('*');
        $this->db->from('productcategories');
		
        $this->db->order_by('category_id', 'ASC');
        $this->db->limit($limit);
		
        $query = $this->db->get();
        return $query->result();
    }
	
	
	
	
	// Get single record from table
    public function get1category($catid)
    {
        $this->db->select('*');
        $this->db->from('productcategories');
		
        $this->db->where('category_id', $catid);
		
        $query = $this->db->get();
        return $query->row_array();
    }
	
	
	
	
	// Get single product details from table
    public function getproductdetails($pid)
    {
        $this->db->select('*');
        $this->db->from('products');
		
        $this->db->where('productid', $pid);
		
        $query = $this->db->get();
        return $query->row_array();
    }
	
	
	
	
	// Product User Recommended query
	public function recommendedproductsave($pid) 
	{
		$viewdatetime 	= date('Y-m-d H:i:s', bd_time());
		
		$data = array(
			'productid'							=> $pid,
			'userip'							=> $_SERVER['REMOTE_ADDR'],
			'viewdatetime'						=> $viewdatetime
		); 

		$this->db->insert('recommededproducts', $data);
		
	}
	
	
	// Product review query
	public function previewsave() 
	{
		//$date = date('Y-m-d H:i:s', bd_time());
		$date = date("F jS, Y h:i:s A");
		
		$data = array(
			'userid'							=> $this->input->post('userid'),
			'shopid'							=> $this->input->post('shopid'),
			'productid'							=> $this->input->post('productid'),
			'product_rating'					=> $this->input->post('product_rating'),
			'product_review_date'				=> $date,
			'product_review_details'			=> $this->input->post('product_review_details')
		); 

		$this->db->insert('productreviews', $data);
		
	}
	
	
	
	// Main Search
	public function mainsearch(){
		
		if($this->input->get('search'))
		{
			$search = $this->db->escape_like_str($this->input->get('search'));
			
			//$query2 = $this->db->query("SELECT * FROM mega_products WHERE product_name LIKE '%$name%' OR productid LIKE '%$name%'");
			$this->db->select("*");
			
			$this->db->join('shops','products.shopid=shops.shopid', 'LEFT');
			$this->db->join('section','products.productsection=section.sectionid', 'LEFT');
			$this->db->join('productcategories','products.product_category_id=productcategories.category_id', 'LEFT');
			$this->db->join('subcategory','products.product_sub_category_id=subcategory.sub_category_id', 'LEFT');
			$this->db->join('subcategorylevel2','products.product_sub_category_lev2_id=subcategorylevel2.sub_category_lev2_id', 'LEFT');
			
			$query2 = $this->db->like('products.product_name',$search, 'after')
             ->or_like('products.productid',$search, 'after')
             ->or_like('products.shopid',$search, 'after')
             ->or_like('products.product_item_details',$search, 'after')
             ->or_like('products.product_location',$search, 'after')
             ->or_like('products.productsection',$search, 'after')
             ->or_like('products.tags',$search, 'after')
             ->or_like('products.materials',$search, 'after')
             ->or_like('shops.shop_name',$search, 'after')
             ->or_like('section.sectionname',$search, 'after')
             ->or_like('productcategories.main_menus',$search, 'after')
             ->or_like('productcategories.category_name',$search, 'after')
             ->or_like('subcategory.sub_category_name',$search, 'after')
             ->or_like('subcategorylevel2.sub_category_lev2_name',$search, 'after')
             ->where('products.product_live', 'Active')
             ->where('products.product_renew', 1)
             ->group_by('products.product_name')
             ->get('products');
			 
			 
			$sqlFetch = $query2->result();
			echo "<ul>";
			echo '<h4><i class="fa fa-search"></i> Search Results :</h4>';
			echo '<hr class="hr" /';
			$baseurl = base_url();
			foreach($sqlFetch as $val)
			{
				$pcatname = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $val->category_name))));
				
				$pname = str_replace('/', '', $val->product_name);
				
				echo '<li onclick='.$val->product_name.'><a href="'.$baseurl.'page/mainsearchresults/category/0/'.$pcatname.'/'.$val->product_category_id.'/'.trim($pname).'/'.$val->sectionname.'/'.$val->sectionid.'">'.'<b class="srcb">'.ucwords($val->sectionname).' - </b>'.$val->product_name.'<p class="sarcshp"><i class="fa fa-shopping-bag"></i> '.$val->shop_name.' Shop</p>'.'</a></li>';
			
			}
		}
		
		echo "</ul>";
		
	}
	
	
	
	/*function getsearchrecords($limit=NULL,$offset=NULL){
	  
	  $this->db->select("*");
	  $this->db->from('products');
	  
	  $this->db->where('product_live','Active');
	  $this->db->order_by('productid', 'DESC');
	  $this->db->limit($limit, $offset);
	  $query = $this->db->get();
	  
	  return $query->result();
	  
	}*/
	
	
	// Main Search
	public function getsearchrecords($limit=NULL,$offset=NULL){
		
		
		$catid 		= $this->uri->segment(6);
		$sectionid 	= $this->uri->segment(9);
		
		//echo $search = trim(htmlentities(stripslashes($this->uri->segment(9))));
		
		//$query2 = $this->db->query("SELECT * FROM mega_products WHERE product_name LIKE '%$name%' OR productid LIKE '%$name%'");
		$this->db->select("*");
		
		$this->db->join('shops','products.shopid=shops.shopid', 'LEFT');
		$this->db->join('section','products.productsection=section.sectionid', 'LEFT');
		$this->db->join('productcategories','products.product_category_id=productcategories.category_id', 'LEFT');
		$this->db->join('subcategory','products.product_sub_category_id=subcategory.sub_category_id', 'LEFT');
		$this->db->join('subcategorylevel2','products.product_sub_category_lev2_id=subcategorylevel2.sub_category_lev2_id', 'LEFT');
		
		if($this->uri->segment(6) !== NULL){
			$query2 = $this->db->or_like('section.sectionid', $sectionid, 'after')
             ->where('products.product_live', 'Active')
             ->group_by('products.product_name')
             ->limit($limit, $offset)
             ->get('products');
		}
		
		if($this->uri->segment(9) == NULL){
			$query2 = $this->db->or_like('products.product_category_id', $catid, 'after')
             ->where('products.product_live', 'Active')
             ->group_by('products.product_name')
             ->limit($limit, $offset)
             ->get('products');
		}
		 
		return $query2->result();
		
	}
	
	
	
	// Main Search
	public function getsearchtotalrecords(){
		
		$catid 		= $this->uri->segment(6);
		$sectionid 	= $this->uri->segment(9);
		
		//$search = trim($this->uri->segment(9));
		//$query2 = $this->db->query("SELECT * FROM mega_products WHERE product_name LIKE '%$name%' OR productid LIKE '%$name%'");
		$this->db->select("*");
		
		$this->db->join('shops','products.shopid=shops.shopid', 'LEFT');
		$this->db->join('section','products.productsection=section.sectionid', 'LEFT');
		$this->db->join('productcategories','products.product_category_id=productcategories.category_id', 'LEFT');
		$this->db->join('subcategory','products.product_sub_category_id=subcategory.sub_category_id', 'LEFT');
		$this->db->join('subcategorylevel2','products.product_sub_category_lev2_id=subcategorylevel2.sub_category_lev2_id', 'LEFT');
		
		if($this->uri->segment(6) !== NULL){
			$query2 = $this->db->or_like('section.sectionid', $sectionid, 'after')
             ->where('products.product_live', 'Active')
             ->group_by('products.product_name')
             ->get('products');
		}
		
		if($this->uri->segment(9) == NULL){
			$query2 = $this->db->or_like('products.product_category_id', $catid, 'after')
             ->where('products.product_live', 'Active')
             ->group_by('products.product_name')
             ->get('products');
		}
		 
		return $query2->num_rows();
		
	}
	
	
	
	
	
	
	// Main Search
	public function getactionsearchrecords($limit=NULL,$offset=NULL){
		
		if($this->uri->segment(4) == NULL){
			$search = $this->db->escape_like_str($this->input->get('search'));
		}else{
			$search = $this->db->escape_like_str($this->uri->segment(4));
		}
		
		//echo $search = trim(htmlentities(stripslashes($this->uri->segment(9))));
		
		//$query2 = $this->db->query("SELECT * FROM mega_products WHERE product_name LIKE '%$name%' OR productid LIKE '%$name%'");
		$this->db->select("*");
		
		$this->db->join('shops','products.shopid=shops.shopid', 'LEFT');
		$this->db->join('section','products.productsection=section.sectionid', 'LEFT');
		$this->db->join('productcategories','products.product_category_id=productcategories.category_id', 'LEFT');
		$this->db->join('subcategory','products.product_sub_category_id=subcategory.sub_category_id', 'LEFT');
		$this->db->join('subcategorylevel2','products.product_sub_category_lev2_id=subcategorylevel2.sub_category_lev2_id', 'LEFT');
		
		
		if($this->uri->segment(4) == NULL){
			$query2 = $this->db->like('products.product_name',$search, 'after')
			->or_like('section.sectionname',$search, 'after')
			->or_like('shops.shop_name',$search, 'after')
			->or_like('productcategories.category_name',$search, 'after')
			->or_like('subcategory.sub_category_name',$search, 'after')
			->or_like('subcategorylevel2.sub_category_lev2_name',$search, 'after')
            ->or_like('products.tags',$search, 'after')
            ->where('products.product_live', 'Active')
            ->group_by('products.product_name')
            ->limit($limit, $offset)
            ->get('products');
		}else{
			
			$query2 = $this->db->like('products.product_name',$search, 'after')
			->or_like('section.sectionname',$search, 'after')
			->or_like('shops.shop_name',$search, 'after')
			->or_like('productcategories.category_name',$search, 'after')
			->or_like('subcategory.sub_category_name',$search, 'after')
			->or_like('subcategorylevel2.sub_category_lev2_name',$search, 'after')
            ->or_like('products.tags',$search, 'after')
            ->where('products.product_live', 'Active')
            ->group_by('products.product_name')
            ->limit($limit, $offset)
            ->get('products');
		}
		 
		return $query2->result();
		
	}
	
	
	// Main Action Search
	public function getactionsearchtotalrecords(){
		
		if($this->uri->segment(4) == NULL){
			$search = $this->db->escape_like_str($this->input->get('search'));
		}else{
			$search = $this->db->escape_like_str($this->uri->segment(4));
		}
		
		//$search = trim($this->uri->segment(9));
		//$query2 = $this->db->query("SELECT * FROM mega_products WHERE product_name LIKE '%$name%' OR productid LIKE '%$name%'");
		$this->db->select("*");
		
		$this->db->join('shops','products.shopid=shops.shopid', 'LEFT');
		$this->db->join('section','products.productsection=section.sectionid', 'LEFT');
		$this->db->join('productcategories','products.product_category_id=productcategories.category_id', 'LEFT');
		$this->db->join('subcategory','products.product_sub_category_id=subcategory.sub_category_id', 'LEFT');
		$this->db->join('subcategorylevel2','products.product_sub_category_lev2_id=subcategorylevel2.sub_category_lev2_id', 'LEFT');
		
		
		if($this->uri->segment(4) == NULL){
			$query2 = $this->db->like('products.product_name',$search, 'after')
			->or_like('section.sectionname',$search, 'after')
			->or_like('shops.shop_name',$search, 'after')
			->or_like('productcategories.category_name',$search, 'after')
			->or_like('subcategory.sub_category_name',$search, 'after')
			->or_like('subcategorylevel2.sub_category_lev2_name',$search, 'after')
             ->where('products.product_live', 'Active')
             ->group_by('products.productid')
             ->get('products');
		}else{
			
			$query2 = $this->db->like('products.product_name',$search, 'after')
			->or_like('section.sectionname',$search, 'after')
			->or_like('shops.shop_name',$search, 'after')
			->or_like('productcategories.category_name',$search, 'after')
			->or_like('subcategory.sub_category_name',$search, 'after')
			->or_like('subcategorylevel2.sub_category_lev2_name',$search, 'after')
             ->where('products.product_live', 'Active')
             ->group_by('products.productid')
             ->get('products'); 
		}
		
		 
		return $query2->num_rows();
		
	}
	
	
	/*
	// Main Search
	public function mainsearch(){
		
		$name = $this->input->post('name_startsWith');
		
		if($this->input->post('name')){
			$query2 = $this->db->query("SELECT * FROM mega_products WHERE product_name LIKE '$name%' OR productid LIKE '$name%'");
			$sqlFetch = $query2->result();	
			
			$data = array();
			foreach($sqlFetch as $val){
				array_push($data, $val->product_name);	
			}	
			echo json_encode($data);
		}
		
	}
	*/
	

	
}
