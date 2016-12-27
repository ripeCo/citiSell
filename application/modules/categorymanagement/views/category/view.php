<?php
	
	// Common files are loaded
	$this->load->view('../../templates/head-view.php');
	$this->load->view('../../templates/headeer.php');
	$this->load->view('../../templates/sidebar-left.php');
	
	if(isset($success_msg)){
?>
<script> <!-- This Script for Page redirect after 4 second -->
	setTimeout(function(){
		window.location.href = '<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2); ?>';
	},4000)
</script>
<?php } ?>
	
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->

        <div class="row">
            <div class="col-sm-12">
                <section class="panel">

                    <h5 style="position:relative;top:10px;right: 100px;">
                        <a class="btn btn-primary pull-right" href="<?php echo base_url(); ?><?php echo $this->uri->segment(1).'/'.$this->uri->segment(2).'/addcat'; ?>">
                            <i class="fa fa-plus-square"></i>&nbsp;Add New Record
                        </a>
                        <span style="margin-right:5px;float:right;">&nbsp;</span>

                        <a class="btn btn-success pull-right" href="<?php echo base_url(); ?><?php echo $this->uri->segment(1).'/'.$this->uri->segment(2); ?>">
                            <i class="fa fa-eye"></i>&nbsp;View Record
                        </a>
                    </h5>
					
					<header class="panel-heading">
                       <i class="fa fa-eye"></i> <?php echo $breadcrumb; ?>
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>
                    </header>

                    <?php
                        // Success Or Failor check
						
                        if(isset($success_msg)){
                            echo '<h4 id="msg" class="text-primary bg-success pdd5"> <i class="fa fa-check-circle"></i> '.$success_msg.' </h4>';
                        }else if(isset($error_msg)){
                            echo '<h4 class="text-danger bg-danger pdd5"> <i class="fa fa-exclamation-triangle"></i> '.$error_msg.' </h4>';
                        }
						
                    ?>

                    <div class="panel-body">
                        <div class="adv-table">
                            <table  class="display table table-bordered table-striped" id="dynamic-table">
                                <thead>
                                    <tr>
                                        <th class="th-center">#Serial</th>
                                        <th class="th-center">Main menu</th>
                                        <th class="th-center">Category Name</th>
                                        <th class="th-center">Category Status</th>
                                        <th class="th-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php
                                    $sr = 0;
                                    foreach($viewdata as $result){
                                        $sr++;
                                        if($sr>9){ $sr = $sr; }else{ $sr = '0'.$sr; }
                                ?>

                                    <tr class="gradeX">
                                        <td class="td-center"><?php echo $sr; ?></td>
                                        <td class="td-center"><?php echo $result->main_menus; ?></td>
                                        <td class="td-center"><?php echo $result->category_name; ?></td>
                                        <td class="td-center">

                                            <?php if( $result->category_status == 1 ){ ?>
                                                <span class="badge bg-primary">Active</span>
                                            <?php }else{ ?>
                                                <span class="badge bg-important">In Active</span>
                                            <?php } ?>

                                        </td>
                                        <td class="td-center">

                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-success" tabindex="-1">Action</button>
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" tabindex="-1">
                                                    <span class="caret"></span>
                                                </button>

                                                <ul class="dropdown-menu pull-right" role="menu">

                                                    <!--li>
                                                        <a href="<?php //echo base_url(); ?><?php //echo $this->uri->segment(1).'/'.$this->uri->segment(2); ?>">
                                                            <i class="fa fa-eye"></i>
                                                            View
                                                        </a>
                                                    </li-->

                                                    <li>
                                                        <a href="<?php echo base_url(); ?><?php echo $this->uri->segment(1).'/'.$this->uri->segment(2).'/catupdate/'.$result->category_id; ?>">
                                                            <i class="fa fa-pencil-square-o"></i>
                                                            Edit
                                                        </a>
                                                    </li>

                                                    <?php if($this->session->userdata('type') === 'SuperAdmin'){ ?>
                                                    <li class="divider"></li>
                                                    <li>
                                                        <a onclick="return confirmDelete();" href="<?php echo base_url();?><?php echo $this->uri->segment(1).'/'.$this->uri->segment(2).'/delete/'.$result->category_id; ?>">
                                                            <i class="fa fa-trash-o"></i>
                                                            Delete
                                                        </a>
                                                    </li>

                                                    <?php } ?>

                                                </ul>
                                            </div>

                                        </td>
                                    </tr>

                                 <?php } ?>

                                </tbody>

                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>


        <!-- page end-->
        </section>
    </section>
    <!--main content end-->
	
<?php $this->load->view('../../templates/sidebar-right.php'); ?>

</section>

<?php
	$this->load->view('../../templates/view-footer.php');
?>
