<?php
    // Common files are loaded
    $this->load->view('../../templates/head-form.php');
    $this->load->view('../../templates/headeer.php');
    $this->load->view('../../templates/sidebar-left.php');
    
    extract($editpage);
    
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

                            <form action="<?php echo base_url();?>pages/page/update/<?php echo $pageid;?>" method="post" class="form form-horizontal validate">

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Page Name</label>
                                    <div class="col-md-5">
                                        <input type='text' name='pagename' required value="<?php echo $pagename;?>" class='form-control'>
                                        <span class="error"> <?php echo form_error('pagename');?></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Content Title</label>
                                    <div class="col-md-5">
                                        <input type='text' name='title' required  value="<?php echo $title; ?>" class='form-control' />
                                        <span class="error"> <?php echo form_error('title');?></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Page Conents</label>
                                    <div class="col-md-5">
                                        <textarea style="border: 1px solid #ccc !important;" class="form-control ckeditor" name="contents" rows="6">
                                            <?php echo $contents; ?>
                                        </textarea>
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label class="col-md-2 control-label">Page Status</label>
                                    <div class="col-md-5">

                                        <?php if($pagestatus == 1){ ?>
                                            <input  type="checkbox" style="width: 20px" checked="checked" class="checkbox form-control" id="pagestatus" name="pagestatus" />
                                        <?php }else{ ?>
                                            <input type="checkbox" style="width: 20px" class="checkbox form-control" id="pagestatus" name="pagestatus" />
                                        <?php } ?>

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

