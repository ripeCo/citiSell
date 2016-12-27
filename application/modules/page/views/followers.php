<?php include('inc/head.php');?>

<?php include('inc/user_header.php');?>
                                                                  
<?php include('inc/navigation.php');?>


<div id="inner_page"><!-- Begin: inner_page -->

    <div class="container">
    
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="innerpage_head"><!-- Begin: innerpage_head -->
                <p clainnerpage_head_p><a href="#">Home</a> <i class="fa fa-angle-double-right"></i> <span class="p_active">Refat Hasan Profile</span> </p>
            </div><!-- End: innerpage_head -->
        </div>  
    </div>
    
    <div class="row">
        <div class="usershop_inner"><!-- Begin: usershop_inner -->
        
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <div class="userlft_fav"><!-- Begin: userlft_fav -->
                    <div class="profilepic"><!-- Begin: profilepic -->
                    	<a href="profile.html"><img src="images/interface/userprofile.png" class="img-responsive img-circle"  title="Refat Hasan"/></a>
                    	<div class="profilepic_browse">
                        	<a href="#"><i class="fa fa-camera"></i></a>
                        </div>
                    </div><!-- End: profilepic -->
                    <h6 class="profilepic_browse_h6"><a href="profile.php">Refat Hasan</a></h6>
                    <div class="profile_list">
                    	<ul>
                        	<li><a href="profile.php">Profile</a></li>
                        	<li><a href="favorite.php">Favorites</a></li>
                        	<li><a href="followers.php">Followers</a></li>
                        	<li><a href="#" data-toggle="modal" data-target="#myModal3" data-target=".bs-example-modal-sm">Contact</a></li>
                        </ul>
                    </div>
                    <div class="contact_modal">
                        <!-- Modal -->
                        <div class="modal fade bs-example-modal-sm" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                            
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="profile_contact_h4" id="myModalLabel">New conversation</h4>
                                <p class="profile_contact_p">with Refat Hasan</p>
                              </div>
                              
                              <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="profile_contact">
                                            <form>
                                              <div class="form-group">
                                                <label for="exampleInputEmail1">Subject</label>
                                                <input type="email" class="form-control" placeholder="Enter subject">
                                              </div>
                                              <div class="form-group">
                                                <label for="exampleInputEmail1">Message</label>
                                                <textarea rows="3" cols="3" class="form-control" placeholder="Enter message"></textarea>
                                              </div>
                                              <div class="form-group">
                                                <label for="exampleInputFile">Attached image</label>
                                                <input type="file" id="exampleInputFile">
                                              </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                              </div>
                              
                              <div class="modal-footer">
                                <button type="button" class="btn btn-primary">Send</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div><!-- End: userlft_fav -->
            </div> 
            
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                <div class="userrt_fav"><!-- Begin: userrt_fav -->                    
                    <div class="row">
                    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="fav_tavuser">

                              <!-- Nav tabs -->
                              <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#followers" aria-controls="shop" role="tab" data-toggle="tab">Followers</a></li>
                                <li role="presentation"><a href="#following" aria-controls="shop" role="tab" data-toggle="tab">Following</a></li>
                                <li role="presentation"><a href="#findfriend" aria-controls="treasuries" role="tab" data-toggle="tab">Find your friends</a></li>
                              </ul>
                            
                              <!-- Tab panes -->
                              <div class="tab-content" style="background:#f5f5f1;padding:12px 15px;height:263px;">
                              
                                <div role="tabpanel" class="tab-pane" id="followers">
                                    <p class="userrt_fav_p">No one's followers you yet</p>
                                </div>
                                
                                <div role="tabpanel" class="tab-pane active" id="following">
                                    <p class="userrt_fav_p">No one's following you yet.</p>
                                </div>
                                
                                <div role="tabpanel" class="tab-pane" id="findfriend">
                                    <p class="userrt_fav_p">No one's find your friends yet</p>
                                </div>
                                
                              </div>
                            
                            </div>
                        </div>
                    </div>
                    
                </div><!-- End: userrt_fav -->
            </div>  
        
        </div><!-- End: usershop_inner -->        
    </div>
    
    </div>
    
</div><!-- End: inner_page -->


<?php include('inc/footer.php');?>
