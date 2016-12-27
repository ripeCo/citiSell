<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">

                <li>
                    <!--a class="active" href="dashboard.php"-->
                    <a class="active" href="<?php echo base_url(); ?>administrator">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sub-menu ">
                    <a href="javascript:;" class="dcjq-parent <?php if($this->uri->segment(2) === 'setting'){ echo 'active'; } ?>">
                        <i class="fa fa-cogs"></i>
                        <span>Settings</span>
                    </a>
                    <ul class="sub">

                        <li>
                            <a href="<?php echo base_url(); ?>administrator/setting/config/1">
                                <i class="fa fa-cog"></i>&nbsp;Shop Settings
                            </a>
                        </li>
                        
                        <li>
                            <a href="<?php echo base_url(); ?>administrator/setting/social/1">
                                <i class="fa fa-cog"></i>&nbsp;Social Media Settings
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="sub-menu ">
                    <a href="javascript:;" class="dcjq-parent <?php if($this->uri->segment(2) === 'category' || $this->uri->segment(2) === 'subcategory' || $this->uri->segment(2) === 'subcategory2'){ echo 'active'; } ?>">
                        <i class="fa fa-product-hunt"></i>
                        <span>Cat | Sub-Cat Management</span>
                    </a>
                    <ul class="sub">
                        <!-- Category -->
                        <li><a href="<?php echo base_url(); ?>categorymanagement/category/addcat"><i class="fa fa-plus"></i>&nbsp;Add New Category</a></li>
                        <li><a href="<?php echo base_url(); ?>categorymanagement/category"><i class="fa fa-eye"></i>&nbsp;View Category lists</a></li>

                        <!-- Sub Category -->
                        <li><a href="<?php echo base_url(); ?>categorymanagement/subcategory/addsubcat"><i class="fa fa-plus"></i>&nbsp;Add New Subcategory</a></li>
                        <li><a href="<?php echo base_url(); ?>categorymanagement/subcategory"><i class="fa fa-eye"></i>&nbsp;View Sub Category lists</a></li>

                        <!-- Sub Category Lev2 -->
                        <li><a href="<?php echo base_url(); ?>categorymanagement/subcategory2/addlev2subcat"><i class="fa fa-plus"></i>&nbsp;Add New Subcategory 2</a></li>
                        <li><a href="<?php echo base_url(); ?>categorymanagement/subcategory2"><i class="fa fa-eye"></i>&nbsp;View Sub Category2 lists</a></li>
                    </ul>
                </li>

				
                <li class="sub-menu ">
                    
					<a href="javascript:;" class="dcjq-parent <?php if($this->uri->segment(2) === 'shops'){ echo 'active'; } ?>">
                        <i class="fa fa-shopping-bag"></i>
                        <span>Shop Management</span>
                    </a>
					
                    <ul class="sub">
                        
						<li><a href="<?php echo base_url(); ?>administrator/shops/"><i class="fa fa-eye"></i>&nbsp;View Active Shops</a></li>
						
						<li><a href="<?php echo base_url(); ?>administrator/shops/suspended"><i class="fa fa-eye"></i>&nbsp;View Suspended Shops</a></li>
						<li><a href="<?php echo base_url(); ?>administrator/shops/pending"><i class="fa fa-eye"></i>&nbsp;View Pending Shops</a></li>
						
                    </ul>
					
                </li>
				

                <!--li class="sub-menu ">
                    <a href="javascript:;" class="dcjq-parent">
                        <i class="fa fa-product-hunt"></i>
                        <span>Product Management</span>
                    </a>
                    <ul class="sub">
                        <!-- Category -->
                        <!--li><a href="<?php //echo base_url(); ?>productmanagement/category/add"><i class="fa fa-plus"></i>&nbsp;Add New Category</a></li>
                        <li><a href="<?php //echo base_url(); ?>productmanagement/category"><i class="fa fa-eye"></i>&nbsp;View Category lists</a></li-->

                        <!-- Sub Category -->
                        <!--li><a href="<?php //echo base_url(); ?>productmanagement/subcategory/add"><i class="fa fa-plus"></i>&nbsp;Add New Subcategory</a></li>
                        <li><a href="<?php //echo base_url(); ?>productmanagement/subcategory"><i class="fa fa-eye"></i>&nbsp;View Sub Category lists</a></li-->

                        <!-- Sub Category Lev2 -->
                        <!--li><a href="<?php //echo base_url(); ?>productmanagement/subcategory2/add"><i class="fa fa-plus"></i>&nbsp;Add New Subcategory 2</a></li>
                        <li><a href="<?php //echo base_url(); ?>productmanagement/subcategory2"><i class="fa fa-eye"></i>&nbsp;View Sub Category2 lists</a></li-->
                    <!--/ul>
                </li-->
				

                <!--li class="sub-menu ">
                    <a href="javascript:;" class="dcjq-parent">
                        <i class="fa fa-shopping-basket"></i>
                        <span>Sales Management</span>
                    </a>
                    <ul class="sub">
                        <li><a href="add.php"><i class="fa fa-plus"></i>&nbsp;Add New</a></li>
                        <li><a href="view.php"><i class="fa fa-eye"></i>&nbsp;View Details</a></li>
                    </ul>
                </li-->
				

                <!--li class="sub-menu ">
                    <a href="javascript:;" class="dcjq-parent">
                        <i class="fa fa-suitcase"></i>
                        <span>Order Management</span>
                    </a>
                    <ul class="sub">
                        
						<li><a href="<?php //echo base_url(); ?>administrator/shops/delivered"><i class="fa fa-eye"></i>&nbsp;View Delivered Orders</a></li>
						<li><a href="<?php //echo base_url(); ?>administrator/shops/pendingorder"><i class="fa fa-eye"></i>&nbsp;View Pending Orders</a></li>
						<li><a href="<?php //echo base_url(); ?>administrator/shops/cancelled"><i class="fa fa-eye"></i>&nbsp;View Cancelled Orders</a></li>
						<li><a href="<?php //echo base_url(); ?>administrator/shops/refunded"><i class="fa fa-eye"></i>&nbsp;View Refunded Orders</a></li>
						
                    </ul>
                </li-->
				

                <li class="sub-menu ">
                    <a href="javascript:;" class="dcjq-parent <?php if($this->uri->segment(2) === 'account'){ echo 'active'; } ?>">
                        <i class="fa fa-calculator"></i>
                        <span>Accounts Management</span>
                    </a>
                    <ul class="sub">
                        
						<li>
							<a href="<?php echo base_url(); ?>administrator/account/citisellaccounts"><i class="fa fa-eye"></i>&nbsp;Accounts Details</a>
						</li>
						
                        <li>
							<a href="<?php echo base_url(); ?>administrator/account/payable"><i class="fa fa-eye"></i>&nbsp;Payable Payments</a>
						</li>
						
                        <li>
							<a href="<?php echo base_url(); ?>administrator/account/receiveable"><i class="fa fa-eye"></i>&nbsp;Receiveable Payments</a>
						</li>
						
                    </ul>
                </li>
				

                <!--li class="sub-menu">

                    <a href="javascript:;">
                        <i class="fa fa-comments"></i>
                        <span>Conversations </span>
                    </a>

                    <ul class="sub">
                        <li><a href="mail.php"><i class="fa fa-inbox"></i>&nbsp;Inbox</a></li>
                        <li><a href="mail_compose.php"><i class="fa fa-list-alt"></i>&nbsp;Compose Mail</a></li>
                        <li><a href="mail_view.php"><i class="fa fa-eye"></i>&nbsp;View Mail</a></li>
                    </ul>

                </li-->
				

                <!--li class="sub-menu">

                   <a href="javascript:;" class="dcjq-parent <?php //if($this->uri->segment(1) === 'newsletters'){ echo 'active'; } ?>">
                        <i class="fa fa-envelope"></i>
                        <span>Newsletter </span>
                    </a>

                    <ul class="sub">
                        <li><a href="<?php //echo base_url(); ?>newsletters/newsmail"><i class="fa fa-list-alt"></i>&nbsp;Compose Newsletter</a></li>
                        <!--li><a href="mail_view.php"><i class="fa fa-eye"></i>&nbsp;View Delivered Newsletters</a></li>
                    </ul>

                </li-->
				
				

                <li class="sub-menu ">
                    <a href="javascript:;" class="dcjq-parent <?php if($this->uri->segment(2) === 'page'){ echo 'active'; } ?>">
                        <i class="fa fa-product-hunt"></i>
                        <span>Page Contents</span>
                    </a>
                    <ul class="sub">
                        <!-- Page Management CMS -->
                        <?php if($this->session->userdata('type') == 'SuperAdmin'){ ?>
                        <li><a href="<?php echo base_url(); ?>pages/page/add"><i class="fa fa-plus"></i>&nbsp;Add New Page</a></li>
                        <?php } ?>
                        <li><a href="<?php echo base_url(); ?>pages/page"><i class="fa fa-eye"></i>&nbsp;Manage Page lists</a></li>
                    </ul>
                </li>

                <!--li class="sub-menu">
                    <a href="javascript:;">
                        <i class=" fa fa-bar-chart-o"></i>
                        <span>Charts</span>
                    </a>
                    <ul class="sub">
                        <li><a href="morris.php"><i class="fa fa-bar-chart-o"></i>&nbsp;Morris</a></li>
                        <li><a href="chartjs.php"><i class="fa fa-bar-chart-o"></i>&nbsp;Chartjs</a></li>
                        <li><a href="flot_chart.php"><i class="fa fa-bar-chart-o"></i>&nbsp;Flot Charts</a></li>
                        <li><a href="c3_chart.php"><i class="fa fa-bar-chart-o"></i>&nbsp;C3 Chart</a></li>
                    </ul>
                </li-->

                <li class="sub-menu ">
                    <a href="javascript:;" class="dcjq-parent <?php if($this->uri->segment(2) === 'users'){ echo 'active'; } ?>">
                        <i class="fa fa-user"></i>
                        <span>User management</span>
                    </a>
                    <ul class="sub">

                        <li>
                            <a href="<?php echo base_url(); ?>usermanagement/users/add">
                                <i class="fa fa-plus"></i>&nbsp;Add New User
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo base_url(); ?>usermanagement/users">
                                <i class="fa fa-cog"></i>&nbsp;Manage Users
                            </a>
                        </li>

                    </ul>
                </li>
				

                <li>
                    <a href="<?php echo base_url(); ?>administrator/dbBackup">
                        <i class="fa fa-database"></i>
                        <span>Database Backup</span>
                    </a>
                </li>
				

                <li>
                    <a href="<?php echo base_url(); ?>administrator/logout">
                        <i class="fa fa-sign-out"></i>
                        <span>Logout</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
