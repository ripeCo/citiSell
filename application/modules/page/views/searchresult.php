<?php
	$this->load->view('../../front-templates/head.php');
	$this->load->view('../../front-templates/header.php');
	$this->load->view('../../front-templates/navigation.php');
	
?>

<div id="inner_page"><!-- Begin: inner_page -->
    <div class="container">
    
        <div class="row">
        
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="innerpage_head"><!-- Begin: innerpage_head -->
                    <p clainnerpage_head_p>
						<a href="<?php echo base_url(); ?>/page">Home</a>
						<i class="fa fa-angle-double-right"></i>
						
						<a href="">
							<span class="p_active">
								"<?php if($this->uri->segment(4) == NULL){ echo $searchkey = $this->input->get('search'); }else{ echo $searchkey = $this->uri->segment(4); }; ?>"
							</span>
						</a>
					</p>
                </div><!-- End: innerpage_head -->
            </div>  
                      
        </div>
                        
        <div class="row">
        
            <div class="innerpage_main"><!-- Begin: innerpage_main -->
            
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="product_category"><!-- Begin: product_category -->
                        <h6 class="product_category_h6" style="text-align:left;font-weight:bold;">
							<i class="fa fa-list"></i>
							All Categories<?php //echo ucfirst(str_replace('-', ' ', $this->uri->segment(5))); ?>
						</h6>
    
                        <ul>
                        	<?php
								
								foreach ($allcategories as $nv_row){
								
							?>
							
							<li>
								<a href="<?php echo base_url(); ?>page/catpaginat/category/0/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $nv_row->category_name))));  ?>/<?php echo $nv_row->category_id;  ?>">
									&#x0226B;&nbsp; 
									<?php
										echo $nv_row->category_name;
									?>
								</a>
							</li>
							
							<?php } ?>
							
							
                        </ul>
                        
                        <p class="product_category_p" style="text-align:left;font-weight:bold;">
							<a href="#">
								&#x0226A; <a href="<?php echo base_url(); ?>page/catpaginat/category/0">Shop all items</a> 
							</a>
						</p>
                        
                    </div><!-- End: product_category -->
                </div>  
                
				
				
			<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
			
					<h5>
						<i class="fa fa-search" aria-hidden="true"></i>&nbsp;
						<span class="p_active">Records founded for search keyword >> "<?php if($this->uri->segment(4) == NULL){ echo $searchkey = $this->input->get('search'); }else{ echo $searchkey = $this->uri->segment(4); } ?>" </span> (<?php echo checkNumber(number_format($total_results)); ?> Results)
					</h5>
						
					<?php
						/*$sql = "select * from mega_products order by productid DESC limit 0,4";
						$allitemsres = $this->db->query($sql);
						$allitems = $allitemsres->result();
						$rcount = $allitemsres->num_rows();*/
						
						//for ($i = 0; $i <count($allitems); ++$i){
						//foreach($allitems as $allitemsview){
							if(is_array($allitem) && count($allitem) ) {
								foreach($allitem as $allitems){
							
					?>
					<?php //echo ($page+$i+1); ?>
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<div class="recompro_box aalp"><!-- Begin: recompro_box -->
							
								<div class="recompro_box_img"><!-- Begin: recompro_box_img" -->
								
								
									<div class="main view-third">
										<!-- THIRD EXAMPLE -->
										<div class="view">

										  <?php
												$nvsoo_query 		= $this->db->query("SELECT * FROM mega_shops where shopid='".$allitems->shopid."'");
												$nvsoo_results 	= $nvsoo_query->row_array();
												extract($nvsoo_results);
												
												$poopimg = explode(',',$allitems->product_image);
													
												for($poopi=0;$poopi< count($poopimg);$poopi++){
													
													// Check product Image NULL Or Not
													if($allitems->product_image == NULL){
														$pooimglocation = base_url()."assets/frontend/images/shops/default-img.jpg";
													}else{
														$sname = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shop_name))));
														
														$pooimglocation = base_url()."assets/frontend/images/shops/$sname/$poopimg[$poopi]";
													}
													
											?>
											
											<a href="<?php echo base_url(); ?>page/pdetails/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $allitems->product_name)))))))); ?>/<?php echo $allitems->productid; ?>">
											
											<?php
													echo '<img class="img-responsive" src="'.$pooimglocation.'" alt="'.$allitems->product_name.'" />';
													break;
												}
											?>
										  </a>
											
										</div>
									</div>
								
									
								</div><!-- End: recompro_box_img" -->
								
								<div class="recompro_box_txt allccat"><!-- Begin: recompro_box_txt" -->	
									
									<h6 class="recompro_box_txt_h6">
										
										<a href="<?php echo base_url(); ?>page/pdetails/<?php echo str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $allitems->product_name)))))))); ?>/<?php echo $allitems->productid; ?>">
											
											<?php echo substr($allitems->product_name,0,60); ?>
											
										</a>
										
									</h6>
									
									<p class="recompro_box_txt_p">&nbsp; 
										<span class="recompro_box_txt_span">
											<i class="fa fa-usd"></i> 
											<?php  echo $allitems->product_price; ?>
										</span>
										
										<span class="recompro_box_txt_span_shop">
											
											<a href="<?php echo base_url(); ?>page/yourshop/viewshop/<?php echo $allitems->shopid; ?>">
												<?php  echo $allitems->shop_name; ?>
											</a>
											
										</span>
									</p>
									
								</div><!-- End: recompro_box_txt" -->
								
							</div><!-- End: recompro_box -->
						</div>
						
						<?php } }else{ ?>
						
						<h4> <i>Sorry! your searching record couldn't found yet!</i> </h4>
						
						<?php } ?>
						
						

					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">    
						<h3 class="border_styles" style="margin-top:25px;">&nbsp;</h3>
							
						<div class="row">
							<div class="col-md-12">
								<div class="row"><?php echo $this->pagination->create_links(); ?></div> 
							</div>
						</div>
							
					</div>
					
						
					</div>
				
			
			</div>
            
        
                
                
            </div><!-- End: innerpage_main -->
            
        </div>
        <div class="clearfix"></div>

		
                
    </div>
</div><!-- End: inner_page -->




<?php $this->load->view('../../front-templates/footer.php'); ?>
