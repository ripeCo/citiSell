<?php ob_start(); // start the output buffer ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Md Salahuddin Khan, Skype: rony_khan2">
    <meta name="author" content="WAN IT LIMITED">
	
	<?php $this->load->view('../../templates/favicon.php'); ?>
	
    <title>
		<?php echo admintitle($breadcrumb); ?>
	</title>
    
	<!--Core CSS -->
    <link href="<?php echo base_url(); ?>assets/backend/bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/backend/js/jquery-ui/jquery-ui-1.10.1.custom.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/backend/css/bootstrap-reset.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/backend/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/backend/js/jvector-map/jquery-jvectormap-1.2.2.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/backend/css/clndr.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    
	<!--clock css-->
    <link href="<?php echo base_url(); ?>assets/backend/js/css3clock/css/style.css" rel="stylesheet">
    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/js/morris-chart/morris.css">
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/backend/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/backend/css/style-responsive.css" rel="stylesheet"/>
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