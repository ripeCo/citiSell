<?php
	$this->load->view('../../front-templates/head.php');
	$this->load->view('../../front-templates/header.php');
	$this->load->view('../../front-templates/navigation.php');
	
	extract($users); // Get all info from users table using userid
?>


<div id="inner_page"><!-- Begin: inner_page -->

    <div class="container">
        
    <div class="row">
        <div class="usershop_inner"><!-- Begin: usershop_inner -->
                    
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="your_shop"><!-- Begin: your_shop -->
                
                	<div class="row">
                    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="stepwizard">
                                <div class="stepwizard-row setup-panel">
                                
                                    <div class="stepwizard-step">
                                        <a class="btn btn-default btn-circle btn-primary" type="button" href="#step-1">1</a>
                                        <p class="urshop_step_p">Shop preferences</p>
                                    </div>
                                    
                                    <div class="stepwizard-step">
                                        <a disabled="disabled" class="btn btn-default btn-circle" type="button" href="#step-2">2</a>
                                        <p class="urshop_step_p">Name your shop</p>
                                    </div>
									
									<div class="stepwizard-step urshop_step">
                                        <a disabled="disabled" class="btn btn-circle btn-default" type="button" href="#step-3">3</a>
                                        <p class="urshop_step_p">Stock your shop</p>
                                    </div>
                                    
                                    <div class="stepwizard-step">
                                        <a disabled="disabled" class="btn btn-default btn-circle btn-default" type="button" href="#step-4">4</a>
                                        <p class="urshop_step_p">How you'll get paid</p>
                                    </div>

                                    <div class="stepwizard-step">
                                        <a disabled="disabled" class="btn btn-default btn-circle" type="button" href="#step-5">5</a>
                                        <p class="urshop_step_p">Set up billing </p>
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                    
                	<div class="row">
                    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="wizarcontent"><!-- Begin: wizarcontent -->
                                
								<form method="post" action="" role="form"><!-- Create: form -->
                                
                                        
                                    <div id="step-1" class="row setup-content" style="display: block;">
                                        
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        	<h3 class="shop_steptitle">Shop preferences </h3>
                                            <p class="shop_step_p">Let's get started! Tell us about you and your shop.</p>
                                            
                                            <div class="row">
                                                <div class="stepcontent02"><!-- Begin: stepcontent02 -->
                                                
                    								<div class="shopperformance_box"><!-- Begin: shopperformance_box -->
                                                    
                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                            <div class="stockform_lft"><!-- Begin: stockform_lft -->
                                                            
                                                                <div class="hor_frm">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                            <div class="hor_frm">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                                        <div class="form-horizontal">
                                                                                        
                                                                                          <div style="margin-top:15px;" class="form-group">
                                                                                            <label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">Shop language<span style="color:#FF3A3D">*</span></label>
                                                                                            <div class="col-sm-9">
                                                                                                
																								<select required="required" style="width:64%;" class="form-control">
																									<option>English</option>
																									<option>Bangla</option>
																									<option>Japanese</option>
																									<option>China</option>
                                                                                                </select>
																								
                                                                                            </div>
                                                                                          </div>
                                                                                          <div class="clearfix"></div>
                                                                                          
                                                                                          <div style="margin-top:15px;" class="form-group">
                                                                                            <label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">Shop country<span style="color:#FF3A3D">*</span></label>
                                                                                            <div class="col-sm-9">
                                                                                                <select style="width:64%;" class="form-control">
                                                                                                  <option>Bangladesh</option>
                                                                                                  <option>America</option>
                                                                                                  <option>England</option>
                                                                                                  <option>Japan</option>
                                                                                                </select>
                                                                                            </div>
                                                                                          </div>
                                                                                          <div class="clearfix"></div>
                                                                                          
                                                                                          <div style="margin-top:15px;" class="form-group">
                                                                                            <label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">Shop currency<span style="color:#FF3A3D">*</span></label>
                                                                                            <div class="col-sm-9">
                                                                                                <select style="width:64%;" class="form-control">
                                                                                                  <option>$ United state dollar</option>
                                                                                                  <option>Taka</option>
                                                                                                  <option>Rupi</option>
                                                                                                  <option>Diner</option>
                                                                                                </select>
                                                                                            </div>
                                                                                          </div>
                                                                                          
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div><!-- End: stockform_lft -->
                                                        </div>
                                                        
                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                            <div class="stockform_rht"><!-- Begin: stockform_rht -->
                                                                <p class="stockform_rht_p">The language you’ll use to describe your items.<br><br><br><br> Where is your shop based?<br><br><br>The currency you'll use to price your items. Shoppers in other countries will automatically see prices in their local currency.</p>
                                                            </div><!-- End: stockform_rht -->
                                                        </div>
                                                        
                                                    </div><!-- Begin: shopperformance_box -->
                                                    
                    								<div style="border-top:1px solid #ddd;margin-top:25px;" class="shopperformance_box"><!-- Begin: shopperformance_box -->
                                                    
                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                            <div class="stockform_lft"><!-- Begin: stockform_lft -->
                                                            
                                                                <div class="hor_frm">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                            <div class="hor_frm">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                                        <div class="form-horizontal">
                                                                                        
                                                                                          <div style="margin-top:15px;" class="form-group">
                                                                                            <label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">Which of these best describes you?<span style="color:#FF3A3D">*</span></label>
                                                                                            <div class="col-sm-9">
                                                                                            
                                                                                                <div class="radio">
                                                                                                  <label class="shoppalabel">
                                                                                                    <input type="radio" aria-label="..." value="option1" id="blankRadio1" name="blankRadio">Selling is my full-time job
                                                                                                  </label>
                                                                                                </div>
                                                                                                
                                                                                                <div class="radio">
                                                                                                  <label class="shoppalabel">
                                                                                                    <input type="radio" aria-label="..." value="option1" id="blankRadio1" name="blankRadio">sell part-time but hope to sell full-time 
                                                                                                  </label>
                                                                                                </div>

                                                                                                <div class="radio">
                                                                                                  <label class="shoppalabel">
                                                                                                    <input type="radio" aria-label="..." value="option1" id="blankRadio1" name="blankRadio">I sell part-time and that’s how I like it 
                                                                                                  </label>
                                                                                                </div>

                                                                                                <div class="radio">
                                                                                                  <label class="shoppalabel">
                                                                                                    <input type="radio" aria-label="..." value="option1" id="blankRadio1" name="blankRadio">Other
                                                                                                  </label>
                                                                                                </div>
                                                                                                
                                                                                            </div>
                                                                                          </div>
                                                                                          
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div><!-- End: stockform_lft -->
                                                        </div>
                                                        
                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                            <div class="stockform_rht"><!-- Begin: stockform_rht -->
                                                                <p class="stockform_rht_p"> This is just an FYI for us, and won’t affect the opening of your shop.</p>
                                                            </div><!-- End: stockform_rht -->
                                                        </div>
                                                        
                                                    </div><!-- Begin: shopperformance_box -->
                                                    
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <button type="button" class="btn btn-info nextBtn pull-right btn_submit">Next</button>
                                                        </div>
                                                    </div>
                                                                                
                                                </div><!-- End: stepcontent02 -->
                                                
                                            </div>  
                                            
                                        </div>                                      
                                        
                                    </div>
									
									
                                        
                                    <div id="step-2" class="row setup-content" style="display: none;">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        	<h3 class="shop_steptitle">Name your shop </h3>
                                            <p class="shop_step_p">Choose a memorable name that reflects your style.</p>
                                            
                                            <div class="row">
                                                <div class="stepcontent03"><!-- Begin: stepcontent03 -->
                                                                                                    
                    								<div class="shopperformance_box"><!-- Begin: shopperformance_box -->
                                                    
                                                    	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-0">
                                                            <div class="input-group">
                                                              <input type="text" placeholder="Enter your shop name..." class="form-control input-lg inputtxtcheck2">
                                                              <span class="input-group-btn">
                                                                <button type="button" class="btn btn-info input-lg inputtxtcheck">Check availability</button>
                                                              </span>
                                                            </div>
                                                            <p class="stepcontent03_p">Your shop name will appear in your shop and next to each of your listings throughout ctSell. You can change it later if you’d like. Here are some tips for picking a shop name.</p>
                                                        </div>
                                                        
                                                    </div><!-- Begin: shopperformance_box -->
                                                    
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <button type="button" class="btn btn-info nextBtn pull-right btn_submit">Next</button>
                                                        </div>
                                                    </div>
                                                                                                                                    
                                                </div><!-- End: stepcontent03 -->
                                                
                                            </div>  
                                            
                                        </div>
                                    </div>
									
									
									<div id="step-3" class="row setup-content" style="display: none;">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        
                                        	<h3 class="shop_steptitle">Stock your shop </h3>
                                            <p class="shop_step_p">Add as many listings as you can. Ten or more would be a great start.<br>More listings means more chances to be discovered! </p>
                                                
                                            <div class="row">
                                            
                                                <div class="stepcontent02"><!-- Begin: stepcontent01 -->
                                                
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <div class="shoppre_box"><!-- Begin: shoppre_box -->
                                                            <a data-target="#myModal" data-toggle="modal" href="#">
                                                                <div class="shoppre_bxtop">
                                                                    <i class="fa fa-plus-circle"></i>
                                                                    <h6 class="shoppre_bxtop_h6">Add a listing</h6>
                                                                </div>
                                                                <div class="shoppre_bxbtm"></div>
                                                            </a>
                                                            
                                                            <div class="stockmodal"><!-- Begin: stockmodal -->
                                                            
                                                                <!-- Modal -->
                                                                <div aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade bs-example-modal-lg" style="display: none;">
                                                                  <div role="document" class="modal-dialog modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                      <div class="modal-header">
                                                                        <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                                                                        <h4 id="myModalLabel" class="modal-title shop_steptitle">Add a new listing</h4>
                                                                      </div>
                                                                      <div class="modal-body">
                                                                      
                                                                        <div class="row">
                                                                        
                                                                        	<div class="formstock_box"><!-- Begin: formstock_box -->
                                                                            	<h6 class="formstock_box_h6">Photos</h6>
                                                                                <p class="formstock_box_p">Add at least one photo. Use all five photos to show different angles and details.</p>
                                                                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                                    <div class="stockform_lft"><!-- Begin: stockform_lft -->
                                                                                    	<div class="row">
                                                                                        	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                                <div class="shopfrm_box"><!-- Begin: shopfrm_box -->
                                                                                                    <a href="#">
                                                                                                    <div class="shopfrm_bxtop">
                                                                                                        <i class="fa fa-camera"></i>
                                                                                                        <h6 class="shoppre_bxtop_h6">Add a photo</h6>
                                                                                                    </div>
                                                                                                    <div class="shopfrm_bxbtm"></div>
                                                                                                    </a>
                                                                                                </div><!-- End: shopfrm_box -->
                                                                                            </div>
                                                                                        	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                                <div class="shopfrm_box"><!-- Begin: shopfrm_box -->
                                                                                                    <a href="#">
                                                                                                    <div class="shopfrm_bxtop">
                                                                                                    </div>
                                                                                                    <div class="shopfrm_bxbtm"></div>
                                                                                                    </a>
                                                                                                </div><!-- End: shopfrm_box -->
                                                                                            </div>
                                                                                        	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                                <div class="shopfrm_box"><!-- Begin: shopfrm_box -->
                                                                                                    <a href="#">
                                                                                                    <div class="shopfrm_bxtop">
                                                                                                    </div>
                                                                                                    <div class="shopfrm_bxbtm"></div>
                                                                                                    </a>
                                                                                                </div><!-- End: shopfrm_box -->
                                                                                            </div>
                                                                                        </div>
                                                                                    </div><!-- End: stockform_lft -->
                                                                                </div>
                                                                                
                                                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                    <div class="stockform_rht"><!-- Begin: stockform_rht -->
                                                                                    	<p class="stockform_rht_p">Use high-quality JPG, PNG or GIF files that are at least 570px wide (we recommend 1000px).<br><br>The best photos use natural or diffused lighting, and don’t use a flash.<br><br>These are thumbnails of your photos. Zoom in to see them full-size.</p>
                                                                                    </div><!-- End: stockform_rht -->
                                                                                </div>
                                                                            </div><!-- End: formstock_box -->
                                                                            <div class="clearfix"></div>
                                                                            
                                                                        	<div style="margin-top:40px;" class="formstock_box"><!-- Begin: formstock_box -->
                                                                            	<h6 class="formstock_box_h6">Listing details</h6>
                                                                                <p class="formstock_box_p">Tell the world all about your item and why they’ll love it.</p>
                                                                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                                    <div class="stockform_lft"><!-- Begin: stockform_lft -->
                                                                                    
                                                                                    	<div class="hor_frm">
                                                                                        	<div class="row">
                                                                                            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                                                    <div class="form-horizontal">
                                                                                                    
                                                                                                      <div class="form-group">
                                                                                                        <label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">Title<span style="color:#FF3A3D">*</span></label>
                                                                                                        <div class="col-sm-9">
                                                                                                          <input type="text" placeholder="Enter title..." class="form-control">
                                                                                                        </div>
                                                                                                      </div>
                                                                                                      <div class="clearfix"></div>
                                                                                                      
                                                                                                      <div style="margin-top:15px;" class="form-group">
                                                                                                        <label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">About this listing<span style="color:#FF3A3D">*</span></label>
                                                                                                        <div class="col-sm-9">
                                                                                                            <select style="width:30%;float:left;margin-right:20px;" class="form-control">
                                                                                                              <option>Who made it</option>
                                                                                                              <option>2</option>
                                                                                                              <option>3</option>
                                                                                                              <option>4</option>
                                                                                                              <option>5</option>
                                                                                                            </select>
                                                                                                            <select style="width:30%;float:left;margin-right:20px;" class="form-control">
                                                                                                              <option>what is it</option>
                                                                                                              <option>2</option>
                                                                                                              <option>3</option>
                                                                                                              <option>4</option>
                                                                                                              <option>5</option>
                                                                                                            </select>
                                                                                                            <select style="width:30%;float:left;" class="form-control">
                                                                                                              <option>When made</option>
                                                                                                              <option>2</option>
                                                                                                              <option>3</option>
                                                                                                              <option>4</option>
                                                                                                              <option>5</option>
                                                                                                            </select>
                                                                                                        </div>
                                                                                                      </div>
                                                                                                      <div class="clearfix"></div>
                                                                                                      
                                                                                                      <div style="margin-top:15px;" class="form-group">
                                                                                                        <label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">Category<span style="color:#FF3A3D">*</span></label>
                                                                                                        <div class="col-sm-9">
                                                                                                            <select style="width:64%;" class="form-control">
                                                                                                              <option>None</option>
                                                                                                              <option>2</option>
                                                                                                              <option>3</option>
                                                                                                              <option>4</option>
                                                                                                              <option>5</option>
                                                                                                            </select>
                                                                                                        </div>
                                                                                                      </div>
                                                                                                      <div class="clearfix"></div>
                                                                                                      
                                                                                                      <div style="margin-top:15px" class="form-group">
                                                                                                        <label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">Price($)<span style="color:#FF3A3D">*</span></label>
                                                                                                        <div class="col-sm-9">
                                                                                                          <input type="text" placeholder="Enter price..." class="form-control">
                                                                                                        </div>
                                                                                                      </div>
                                                                                                      <div class="clearfix"></div>
                                                                                                      
                                                                                                      <div style="margin-top:15px" class="form-group">
                                                                                                        <label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">Quantity<span style="color:#FF3A3D">*</span></label>
                                                                                                        <div class="col-sm-9">
                                                                                                          <input type="text" placeholder="Enter quantity..." class="form-control">
                                                                                                        </div>
                                                                                                      </div>
                                                                                                      <div class="clearfix"></div>
                                                                                                      
                                                                                                      <div style="margin-top:15px" class="form-group">
                                                                                                        <label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">Renewal options<span style="color:#FF3A3D">*</span></label>
                                                                                                        <div class="col-sm-9">
                                                                                                            <label class="radio-inline hor_frm_check">
                                                                                                              <input type="radio" value="option1" id="inlineRadio1" name="inlineRadioOptions">Manual
                                                                                                            </label>
                                                                                                            <label style="margin-top:7px;" class="radio-inline hor_frm_check">
                                                                                                              <input type="radio" value="option2" id="inlineRadio2" name="inlineRadioOptions"> Automatic
                                                                                                            </label>
                                                                                                        </div>
                                                                                                      </div>
                                                                                                      <div class="clearfix"></div>
                                                                                                      
                                                                                                      <div style="margin-top:15px" class="form-group">
                                                                                                        <label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">Type <span style="color:#FF3A3D">*</span></label>
                                                                                                        <div class="col-sm-9">
                                                                                                            <label class="radio-inline hor_frm_check">
                                                                                                              <input type="radio" value="option1" id="inlineRadio1" name="inlineRadioOptions">Physical
                                                                                                            </label>
                                                                                                            <label style="margin-top:7px;" class="radio-inline hor_frm_check">
                                                                                                              <input type="radio" value="option2" id="inlineRadio2" name="inlineRadioOptions"> Digital
                                                                                                            </label>
                                                                                                        </div>
                                                                                                      </div>
                                                                                                      <div class="clearfix"></div>
                                                                                                      
                                                                                                      <div style="margin-top:15px" class="form-group">
                                                                                                        <label class="col-sm-3 control-label hor_frm_title" for="inputEmail3">Description  <span style="color:#FF3A3D">*</span></label>
                                                                                                        <div class="col-sm-9">
                                                                                                            <textarea placeholder="Enter description ..." class="form-control" cols="7" rows="7"></textarea>
                                                                                                        </div>
                                                                                                      </div>
        
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        
                                                                                    </div><!-- End: stockform_lft -->
                                                                                </div>
                                                                                
                                                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                    <div class="stockform_rht"><!-- Begin: stockform_rht -->
                                                                                    	<p class="stockform_rht_p">Include keywords that buyers would use to search for your item.<br><br>Learn more about what types of items are allowed on ctSell.<br><br>Factor in the costs of materials and labor, plus any related business expenses.<br><br>For quantities greater than one, this listing will renew automatically until it sells out. You’ll be charged a $0.20 USD listing fee each time.<br><br><br><br><br><br>Each renewal lasts for four months or until the listing sells out. Get more details on auto-renewing.<br><br><br><br><br><br><br><br>Start with a brief overview that describes your item's finest features.<br><br>List details like dimensions and key features in easy-to-read bullet points. <br><br>Tell buyers a bit about your process or the story behind this item. </p>
                                                                                    </div><!-- End: stockform_rht -->
                                                                                </div>
                                                                            </div><!-- End: formstock_box -->
                                                                            <div class="clearfix"></div>
                                                                            
                                                                        	<div style="margin-top:40px;" class="formstock_box"><!-- Begin: formstock_box -->
                                                                            	<h6 class="formstock_box_h6">Digital files</h6>
                                                                                <p class="formstock_box_p">Buyers can download these files as soon as they complete their purchase.</p>
                                                                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                                    <div class="stockform_lft"><!-- Begin: stockform_lft -->
                                                                                    	<div class="row">
                                                                                        	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                                                <input type="file" id="exampleInputFile">
                                                                                                <p class="help-block">By adding files to this listing, you guarantee that you have rights to the content. Etsy may remove content per our Intellectual Property Policy, at which point buyers may not be able to access purchased files. See our Terms for more information</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div><!-- End: stockform_lft -->
                                                                                </div>
                                                                                
                                                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                    <div class="stockform_rht"><!-- Begin: stockform_rht -->
                                                                                    	<p class="stockform_rht_p">You can send a customized note to buyers of digital items after the item is downloaded.<br><br>Add a note for buyers who purchase digital items</p>
                                                                                    </div><!-- End: stockform_rht -->
                                                                                </div>
                                                                                
                                                                            </div><!-- End: formstock_box -->
                                                                            <div class="clearfix"></div>
                                                                            
                                                                        	<div style="margin-top:40px;" class="formstock_box"><!-- Begin: formstock_box -->
                                                                            	<h6 class="formstock_box_h6">Search terms</h6>
                                                                                <p class="formstock_box_p">Help more people discover your listing by using accurate and descriptive words or phrases. How does search work on ctSell?</p>
                                                                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                                    <div class="stockform_lft"><!-- Begin: stockform_lft -->
                                                                                    
                                                                                    	<div class="hor_frm">
                                                                                        	<div class="row">
                                                                                            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                                                    <div class="form-horizontal">
                                                                                                    
                                                                                                      <div class="form-group">
                                                                                                        <label class="col-sm-3 control-label hor_frm_title2" for="inputEmail3">Tags</label>
                                                                                                        <div class="col-sm-9">
                                                                                                        	<div class="row">
                                                                                                            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                                                                    <div class="input-group">
                                                                                                                      <input type="text" placeholder="Search for..." class="form-control">
                                                                                                                      <span class="input-group-btn">
                                                                                                                        <button type="button" class="btn btn-default">Add</button>
                                                                                                                      </span>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                          </div>
                                                                                                      </div>
                                                                                                      
                                                                                                      <div class="form-group">
                                                                                                        <label class="col-sm-3 control-label hor_frm_title2" for="inputEmail3">Materials</label>
                                                                                                        <div class="col-sm-9">
                                                                                                        	<div class="row">
                                                                                                            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                                                                    <div class="input-group">
                                                                                                                      <input type="text" placeholder="Search for..." class="form-control">
                                                                                                                      <span class="input-group-btn">
                                                                                                                        <button type="button" class="btn btn-default">Add</button>
                                                                                                                      </span>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                          </div>
                                                                                                      </div>
                                                                                                      
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        
                                                                                    </div><!-- End: stockform_lft -->
                                                                                </div>
                                                                                
                                                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                    <div class="stockform_rht"><!-- Begin: stockform_rht -->
                                                                                    	<p class="stockform_rht_p">What words might someone use to search for your listings? Use all 13 tags to get found. Get ideas for tags.</p>
                                                                                    </div><!-- End: stockform_rht -->
                                                                                </div>
                                                                            </div><!-- End: formstock_box -->
                                                                            <div class="clearfix"></div>

                                                                        </div>
                                                                                                                                                
                                                                      </div>
                                                                      <div class="modal-footer">
                                                                        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                                                                        <button class="btn btn-primary" type="button">Save and continue</button>
                                                                      </div>
                                                                    </div>
                                                                  </div>
                                                                </div>
                                                                                                                            
                                                            </div><!-- End: stockmodal -->
                                                            
                                                        </div><!-- End: shoppre_box -->
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <div class="shoppre_box"><!-- Begin: shoppre_box -->
                                                            <a href="#">
                                                                <div class="shoppre_bxtop">
                                                                </div>
                                                                <div class="shoppre_bxbtm"></div>
                                                            </a>
                                                        </div><!-- End: shoppre_box -->
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <div class="shoppre_box"><!-- Begin: shoppre_box -->
                                                            <a href="#">
                                                                <div class="shoppre_bxtop">
                                                                </div>
                                                                <div class="shoppre_bxbtm"></div>
                                                            </a>
                                                        </div><!-- End: shoppre_box -->
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <div class="shoppre_box"><!-- Begin: shoppre_box -->
                                                            <a href="#">
                                                                <div class="shoppre_bxtop">
                                                                </div>
                                                                <div class="shoppre_bxbtm"></div>
                                                            </a>
                                                        </div><!-- End: shoppre_box -->
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <div class="shoppre_box"><!-- Begin: shoppre_box -->
                                                            <a href="#">
                                                                <div class="shoppre_bxtop">
                                                                </div>
                                                                <div class="shoppre_bxbtm"></div>
                                                            </a>
                                                        </div><!-- End: shoppre_box -->
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <div class="shoppre_box"><!-- Begin: shoppre_box -->
                                                            <a href="#">
                                                                <div class="shoppre_bxtop">
                                                                </div>
                                                                <div class="shoppre_bxbtm"></div>
                                                            </a>
                                                        </div><!-- End: shoppre_box -->
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <div class="shoppre_box"><!-- Begin: shoppre_box -->
                                                            <a href="#">
                                                                <div class="shoppre_bxtop">
                                                                </div>
                                                                <div class="shoppre_bxbtm"></div>
                                                            </a>
                                                        </div><!-- End: shoppre_box -->
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <div class="shoppre_box"><!-- Begin: shoppre_box -->
                                                            <a href="#">
                                                                <div class="shoppre_bxtop">
                                                                </div>
                                                                <div class="shoppre_bxbtm"></div>
                                                            </a>
                                                        </div><!-- End: shoppre_box -->
                                                    </div>
                                                    
                                                    <button type="button" class="btn btn-info nextBtn pull-right btn_submit">Next</button>

                                                </div><!-- End: stepcontent01 -->
                                                
                                            </div>   
                                                                                        
                                        </div>
                                    </div>
									
                                    
                                    <div id="step-4" class="row setup-content" style="display: none;">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        	<h3 class="shop_steptitle">How you'll get paid</h3>
                                            <p class="shop_step_p">Choose a memorable name that reflects your style.</p>
                                            
                                            <div class="row">
                                                <div class="stepcontent03"><!-- Begin: stepcontent03 -->
                                                                                                    
                    								<div class="shopperformance_box"><!-- Begin: shopperformance_box -->
                                                    
                                                    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        
                                                            <p class="stepcontent03_p"><strong>Payment policies :</strong> We currently accept Paypal. An existing Paypal account is not required to pay via this method. If you would like to pay with any major credit card, simply select Paypal as your method of payment in the Etsy checkout, click on the green "Pay with Paypal" button, and follow the steps to pay with a credit card. Paypal will simply facilitate the transaction.<br><br>

If you pay via echeck with Paypal it takes 3-5 days before the payment clears. Your order will not be started until the payment has been cleared. This delays production time by 3-5 days.</p>

                                                        </div>
                                                        
                                                    </div><!-- Begin: shopperformance_box -->
                                                    
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <button type="button" class="btn btn-info nextBtn pull-right btn_submit">Next</button>
                                                        </div>
                                                    </div>
                                                                                                                                    
                                                </div><!-- End: stepcontent03 -->
                                                
                                            </div>  
                                            
                                        </div>
                                    </div>

                                    <div id="step-5" class="row setup-content" style="display: none;">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        	<h3 class="shop_steptitle">Set up billing</h3>
                                            <p class="shop_step_p">Choose a memorable name that reflects your style.</p>
                                            
                                            <div class="row">
                                                <div class="stepcontent03"><!-- Begin: stepcontent03 -->
                                                                                                    
                    								<div class="shopperformance_box"><!-- Begin: shopperformance_box -->
                                                    
                                                    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        
                                                            <div class="payment_box01">
                                                                <h3 class="payment_box_h3">Payment methods</h3>
                                                                <label style="margin-top:15px;" class="radio-inline">
                                                                  <input type="radio" value="option1" id="inlineRadio1" name="inlineRadioOptions"> <p class="step5_pay_label">American Express</p>
                                                                </label>
                                                                <label style="margin-top:15px;" class="radio-inline">
                                                                  <input type="radio" value="option1" id="inlineRadio1" name="inlineRadioOptions"> <p class="step5_pay_label">Mastercard</p>
                                                                </label>
                                                                <label style="margin-top:15px;" class="radio-inline">
                                                                  <input type="radio" value="option1" id="inlineRadio1" name="inlineRadioOptions"> <p class="step5_pay_label">PayPal</p>
                                                                </label>
                                                                <label style="margin-top:15px;" class="radio-inline">
                                                                  <input type="radio" value="option1" id="inlineRadio1" name="inlineRadioOptions"> <p class="step5_pay_label">VISA</p>
                                                                </label>
                                                                <p class="payment_box01_p">Ready to ship in 1-2 weeks. </p>
                                                            </div>

                                                        </div>
                                                        
                                                    </div><!-- Begin: shopperformance_box -->
                                                                                                                                                                        
                                                </div><!-- End: stepcontent03 -->
                                                
                                            </div>  
                                            
                                        </div>
                                    </div>
                                    
                                </form>
								
                            </div><!-- End: wizarcontent -->
                        </div>
                    </div>
              
                                        
                </div><!-- End: your_shop -->
            </div>  
        
        </div><!-- End: usershop_inner -->        
    </div>
    
    </div>
    
</div>


<?php $this->load->view('../../front-templates/footer.php'); ?>
