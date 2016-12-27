<?php
    // Common files are loaded
    $this->load->view('../../templates/head-form.php');
    $this->load->view('../../templates/headeer.php');
    $this->load->view('../../templates/sidebar-left.php');
    
    extract($users);
    
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
            <div class="col-lg-12">
                <section class="panel">

                    <h5 style="position:relative;top:10px;right: 100px;">
                        <a class="btn btn-primary pull-right" href="<?php echo base_url(); ?><?php echo $this->uri->segment(1).'/'.$this->uri->segment(2).'/add'; ?>">
                            <i class="fa fa-plus-square"></i>&nbsp;Add new Record
                        </a>
                        <span style="margin-right:5px;float:right;">&nbsp;</span>

                        <a class="btn btn-success pull-right" href="<?php echo base_url(); ?><?php echo $this->uri->segment(1).'/'.$this->uri->segment(2); ?>">
                            <i class="fa fa-eye"></i>&nbsp;View Record
                        </a>
                    </h5>

                    <header class="panel-heading">
                        <h3><i class="fa fa-pencil-square-o"></i>&nbsp;<?php echo $breadcrumb; ?></h3>
                            <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
                                <a class="fa fa-cog" href="javascript:;"></a>
                                <a class="fa fa-times" href="javascript:;"></a>
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
                        <div class="form">

                            <form action="<?php echo base_url();?>usermanagement/users/update/<?php echo $PortalUId;?>" method="post" class="form form-horizontal validate">

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Full Name</label>
                                    <div class="col-md-5">
                                        <input type='text' name='name' required value="<?php echo $name;?>" class='form-control'>
                                        <span class="error"> <?php echo form_error('name');?></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">E-mail</label>
                                    <div class="col-md-5">
                                        <input type='hidden' name='email_old'  value="<?php echo $email; ?>" />
                                        <input type='text' name='email' required  value="<?php echo $email; ?>" class='form-control' />
                                        <span class="error"> <?php echo form_error('name');?></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Type</label>
                                    <div class="col-md-5">
                                        <select name="type" required class="form-control" style="width:150px;">
                                            <?php
                                            $utype = $this->session->userdata('type');
                                            if($utype == 'SuperAdmin') { ?>
                                            <option value="SuperAdmin" <?php echo ($type=='SuperAdmin')?'selected="selected"':''; ?>>Super Admin</option>
                                        <?php }?>
                                            <option value="Admin" <?php echo ($type=='Admin')?'selected="selected"':''; ?>>Administrator</option>
                                            <option value="Sub-Admin" <?php echo ($type=='Sub-Admin')?'selected="selected"':''; ?>>Sub-Admin</option>
                                            <option value="Author" <?php echo ($type=='Author')?'selected="selected"':''; ?>>Author</option>
                                            <option value="Normal" <?php echo ($type=='Normal')?'selected="selected"':''; ?>>Normal</option>
                                        </select>
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label class="col-md-2 control-label">Status</label>
                                    <div class="col-md-5">

                                        <?php if($status == 1){ ?>
                                            <input  type="checkbox" style="width: 20px" checked="checked" class="checkbox form-control" id="status" name="status" />
                                        <?php }else{ ?>
                                            <input type="checkbox" style="width: 20px" class="checkbox form-control" id="status" name="status" />
                                        <?php } ?>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Username</label>
                                    <div class="col-md-5">
                                        <!-- very important for unique check -->
                                        <input value="<?php echo $username; ?>" name="username_old" type="hidden" />
                                        <input type='text' name='username' required value="<?php echo $username;?>" class='form-control' />
                                        <span class="error"> <?php echo form_error('username');?></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Password <!--span class="text-danger">*</span--></label>
                                    <div class="col-md-5">
                                        <input type='password' name='password' class='form-control' />
                                        <span class="error"> <?php echo form_error('password');?></span>
                                    </div>
                                </div>

                                <div class="form-actions form-actions-padding-sm">
                                    <div class="row">
                                        <div class="col-md-10 col-md-offset-2">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-refresh"></i> Update</button>
                                        </div>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->
    </section>
</section>
<!--main content end-->

<?php //include('inc/sidebar-right.php'); ?>

</section>

<?php
$this->load->view('../../templates/form-footer.php');
?>

