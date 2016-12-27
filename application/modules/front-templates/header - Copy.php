<div id="header"><!-- Begin: header -->
    <div class="container">
        <div class="row">
        
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <div class="logo"><!-- Begin: logo -->
                	<h1>
						<a href="<?php if($this->session->isLogin == FALSE){echo base_url();}else{echo base_url().'page/user/userarea'; } ?>">
							<img src="<?php echo base_url(); ?>assets/frontend/images/interface/logo.png" class="img-responsive" alt="Logo" />
						</a>
					</h1>
                </div><!-- End: logo -->
            </div>
            <a href="userreg-head.php"></a>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="h_search"><!-- Begin: h_search -->
                
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="input-group">
                        
                        
                          <input type="text" id="tags" class="form-control" placeholder="Search for items or shops">
                          <span class="input-group-btn">
                            <button class="btn btn-default sbtn_header" type="button">Search</button>
                          </span>
                        </div><!-- /input-group -->
                      </div><!-- /.col-lg-6 -->
                    </div><!-- /.row -->
                
                </div><!-- End: h_search -->
            </div>

            <?php
                if( $this->session->isLogin == TRUE){
                    $this->load->view('userloged-head.php');
                }else{ $this->load->view('userreg-head.php'); }
                
            
            ?>

        </div>
    </div>
</div><!-- End: header -->
