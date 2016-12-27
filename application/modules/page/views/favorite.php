<?php
	$this->load->view('../../front-templates/head.php');
	$this->load->view('../../front-templates/header.php');
	$this->load->view('../../front-templates/navigation.php');
	
	if( $this->session->userdata('isLogin') == TRUE){
		$shopid 				= $this->session->userdata('shopopen');
		$userid 				= $this->session->userdata('userid');
		
		$sqluser = $this->db->query("select * from mega_users where userid=$userid");
		$sqlfetchuser = $sqluser->row_array();
		extract($sqlfetchuser);
		
	}else{
		if($this->uri->segment(4) !== NULL){
			$userid 				= $this->uri->segment(4);
		}else{ $userid = 16; }
		
		$sqluser = $this->db->query("select * from mega_users where userid=$userid");
		$sqlfetchuser = $sqluser->row_array();
		extract($sqlfetchuser);
		
	}
	
?>


<div id="inner_page"><!-- Begin: inner_page -->

	<div class="userfav_wrapper">
    	<div class="container">
            <div class="row">
                <div class="user_favorite"><!-- Begin: user_hi -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="user_name2"><!-- Begin: user_name2 -->
                                    <p class="user_name2_h3">
										
										<a href="<?php echo base_url(); ?>page/user/userprofile/<?php echo $userid; ?>">
											
											<img src="<?php echo base_url(); ?>assets/frontend/images/users/<?php if($user_picture == NULL ){echo 'userprofile.png'; }else{ echo  $user_picture; } ?>" class="img-responsive img-circle" alt="profile" style="margin: 0 20px 0px 0px;" align="left" vspace="5" hspace="5" />
										</a>
										
										<a href="<?php echo base_url(); ?>page/user/userprofile/<?php echo $userid; ?>">
											<?php echo ucwords($display_name); ?>
										</a>
										
									</p>
                                </div><!-- End: user_name2 -->
                            </div>
                            
							<!--div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-xs-offset-0">
                                <div class="follower"><!-- Begin: follower -->
                                    <!--div class="btn-group" data-toggle="buttons">
                                      
									  <label class="btn btn-default">
                                        <input type="checkbox" autocomplete="off" checked> <span class="span_follow"><span style="color:#34a8c4">0</span> Followers</span>
                                      </label>
									  
                                      <label class="btn btn-default">
                                        <input type="checkbox" autocomplete="off"> <span class="span_follow"><span style="color:#34a8c4">0</span> Following</span>
                                      </label>
									  
                                    </div>
                                </div>
                            </div-->
							
                        </div>
                        
                    </div>  
                </div><!-- End: user_hi -->
            </div>
        </div>
    </div>


	<div class="favorite_main">
    	<div class="container">
        
        	<div class="row">
            
            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="ur_favoritesL"><!-- Begin: ur_favoritesL -->
                    	<div class="row">
                        
                        	<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                <div class="urfav_title"><!-- Begin: urfav_title -->
                                	<h3 class="urfav_title_h3"> <i class="fa fa-heart-o text-danger"></i> Your Favorites</h3>
                                </div><!-- End: urfav_title -->
                            </div>
                            
                        	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                <div class="urfav_items"><!-- Begin: urfav_items -->
                                    <div class="btn-group favdatatoggle">
                                      
									  <label class="btn btn-default active">
									  
                                        <a href="<?php echo base_url(); ?>page/user/favotites/<?php echo $userid; ?>" autocomplete="off" checked>
											<span class="span_follow">Items</span>
										</a>
										
                                      </label> 
									  
                                      <label class="btn btn-default">
									  
                                        <a href="<?php echo base_url(); ?>page/user/shop/<?php echo $userid; ?>" autocomplete="off">
											<span class="span_follow">Shops</span>
										</a>
										
                                      </label>
									  
                                      <!--label class="btn btn-default">
                                        <a autocomplete="off"> <span class="span_follow">Treasuries</span></a>
                                      </label-->
									  
                                    </div>
                                </div><!-- End: urfav_items -->
                            </div>
                            
                        </div>
                    </div><!-- End: ur_favoritesL -->
                </div>
                
            	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-xs-offset-0">
                    <div class="ur_favoritesR"><!-- Begin: ur_favoritesL -->
                    
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Search available items...">
                          <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Search</button>
                          </span>
                        </div><!-- /input-group -->
                      
                    </div><!-- End: ur_favoritesL -->
                </div>
                
            </div>
            
        	<div class="row">
            
            	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="favitem_box"><!-- Begin: favitem_box -->
                    	<a href="#">
                        
                            <div class="favorite_product"><!-- Begin: favorite_product -->
                                <img src="<?php echo base_url(); ?>assets/frontend/images/interface/favorite_product03.jpg" class="img-responsive" alt="Favorite Products" />
                            </div><!-- End: favorite_product -->
                            
                            <div class="favorite_product" id="last_box"><!-- Begin: favorite_product -->
                                <img src="<?php echo base_url(); ?>assets/frontend/images/interface/favorite_product01.jpg" class="img-responsive" alt="Favorite Products" />
                            </div><!-- End: favorite_product -->
                            
                            <div class="favorite_product"><!-- Begin: favorite_product -->
                                <img src="<?php echo base_url(); ?>assets/frontend/images/interface/favorite_product04.jpg" class="img-responsive" alt="Favorite Products" />
                            </div><!-- End: favorite_product -->
                            
                            <div class="favorite_product" id="last_box"><!-- Begin: favorite_product -->
                                <img src="<?php echo base_url(); ?>assets/frontend/images/interface/favorite_product02.jpg" class="img-responsive" alt="Favorite Products" />
                            </div><!-- End: favorite_product -->
                                                        
                            <div class="fapeo_name"><!-- Begin: fapeo_name -->
                                <h6 class="fapeo_name_h6">Favorites items title goes here...</h6>
                                <p class="fapeo_name_p">1525 Items</p>
                            </div><!-- End: fapeo_name -->
                            
                        </a>
                    </div><!-- End: favitem_box -->
                </div>
                
            	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="favitem_box"><!-- Begin: favitem_box -->
                    	<a href="#">
                        
                            <div class="favorite_product"><!-- Begin: favorite_product -->
                                <img src="<?php echo base_url(); ?>assets/frontend/images/interface/favorite_product03.jpg" class="img-responsive" alt="Favorite Products" />
                            </div><!-- End: favorite_product -->
                            
                            <div class="favorite_product" id="last_box"><!-- Begin: favorite_product -->
                                <img src="<?php echo base_url(); ?>assets/frontend/images/interface/favorite_product01.jpg" class="img-responsive" alt="Favorite Products" />
                            </div><!-- End: favorite_product -->
                            
                            <div class="favorite_product"><!-- Begin: favorite_product -->
                                <img src="<?php echo base_url(); ?>assets/frontend/images/interface/favorite_product04.jpg" class="img-responsive" alt="Favorite Products" />
                            </div><!-- End: favorite_product -->
                            
                            <div class="favorite_product" id="last_box"><!-- Begin: favorite_product -->
                                <img src="<?php echo base_url(); ?>assets/frontend/images/interface/favorite_product02.jpg" class="img-responsive" alt="Favorite Products" />
                            </div><!-- End: favorite_product -->
                                                        
                            <div class="fapeo_name"><!-- Begin: fapeo_name -->
                                <h6 class="fapeo_name_h6">Favorites items title goes here...</h6>
                                <p class="fapeo_name_p">1525 Items</p>
                            </div><!-- End: fapeo_name -->
                            
                        </a>
                    </div><!-- End: favitem_box -->
                </div>

            	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="favitem_box"><!-- Begin: favitem_box -->
                    	<a href="#">
                        
                            <div class="favorite_product"><!-- Begin: favorite_product -->
                                <img src="<?php echo base_url(); ?>assets/frontend/images/interface/favorite_product03.jpg" class="img-responsive" alt="Favorite Products" />
                            </div><!-- End: favorite_product -->
                            
                            <div class="favorite_product" id="last_box"><!-- Begin: favorite_product -->
                                <img src="<?php echo base_url(); ?>assets/frontend/images/interface/favorite_product01.jpg" class="img-responsive" alt="Favorite Products" />
                            </div><!-- End: favorite_product -->
                            
                            <div class="favorite_product"><!-- Begin: favorite_product -->
                                <img src="<?php echo base_url(); ?>assets/frontend/images/interface/favorite_product04.jpg" class="img-responsive" alt="Favorite Products" />
                            </div><!-- End: favorite_product -->
                            
                            <div class="favorite_product" id="last_box"><!-- Begin: favorite_product -->
                                <img src="<?php echo base_url(); ?>assets/frontend/images/interface/favorite_product02.jpg" class="img-responsive" alt="Favorite Products" />
                            </div><!-- End: favorite_product -->
                                                        
                            <div class="fapeo_name"><!-- Begin: fapeo_name -->
                                <h6 class="fapeo_name_h6">Favorites items title goes here...</h6>
                                <p class="fapeo_name_p">1525 Items</p>
                            </div><!-- End: fapeo_name -->
                            
                        </a>
                    </div><!-- End: favitem_box -->
                </div>

            	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="creat_list"><!-- Begin: creat_list -->
                        <form>
                          <h6 class="creat_list_h6">Create a List</h6>
                          <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter list name">
                          </div>
                          <button type="submit" class="btn btn-info" style="width:100%;">Create</button>
                        </form>
                    </div><!-- End: creat_list -->
                </div>
                                
            </div>
            
        </div>
    </div>
    
</div><!-- End: inner_page -->

<?php $this->load->view('../../front-templates/footer.php'); ?>