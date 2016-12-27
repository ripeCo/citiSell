<?php
	include('common-head.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Md Salahuddin Khan, Skype: rony_khan2">
    <meta name="author" content="WAN IT LIMITED">
	
	<?php $this->load->view('templates/favicon.php'); ?>
	
    <title>
		ctSell.com Online Shop :: <?php echo $breadcrumb; ?>
	</title>
    
	<!--Core CSS -->
    <link href="<?php echo base_url(); ?>assets/backend/bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/backend/css/bootstrap-reset.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/backend/font-awesome/css/font-awesome.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!--dynamic table-->
    <link href="<?php echo base_url(); ?>assets/backend/js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/backend/js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/js/data-tables/DT_bootstrap.css" />
	
	<!--responsive table-->
    <link href="<?php echo base_url(); ?>assets/backend/css/table-responsive.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/backend/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/backend/css/style-responsive.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/backend/css/custom.css" rel="stylesheet"/>
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="<?php echo base_url(); ?>assets/backend/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>