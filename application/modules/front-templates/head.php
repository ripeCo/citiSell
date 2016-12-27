<!DOCTYPE HTML>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $breadcrumb; ?></title>
	
	<?php $this->load->view('../../templates/favicon.php'); ?>
    
	<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/css/animate.css" type="text/css" />
	
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/frontend/css/datatables-bootstrap3.css" rel="stylesheet">
	
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" type="text/css" />
	
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/css/styles.css" type="text/css" />
    
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/css/jquery-ui.css" type="text/css" />
    
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/css/recommend.css" type="text/css" />
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/css/elastislide.css" />
	
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/css/slicknav.css" /><!--slicknav.css for menu-->
	<!-- Mega Navigation Munu css -->
	
	
	
	<!-- Custom & Overide Style CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/css/custom.css" />
	
	<style type="text/css">
		
		.cart_rt_rate{
			width:37px;
			height:25px;
			position:absolute;
			top:-10px;
			left:-20px;
			background:url(<?php echo base_url(); ?>assets/frontend/images/interface/bg_cart.png) no-repeat;
		}
		
	</style>
	
	<style>
		
		/* navigation style */
		
		.acttive{ background:#389e96; }
		
		#nav{
			height: 39px;
			font: 15px Geneva, Arial, Helvetica, sans-serif;
			/*background: #3AB3A9;
			border: 1px solid #30A097;*/	
			border-radius: 3px;
			min-width:500px;
			margin-left: 0px;
			padding-left: 0px;
		}	

		#nav li{
			list-style: none;
			display: block;
			float: left;
			height: 40px;
			position: relative;
			/*border-right: 1px solid #52BDB5;*/
		}

		#nav li a {
		  border-right: 1px solid #389e96;
		  color: #fff !important;
		  height: 40px;
		  line-height: 40px;
		  margin: 0;
		  padding: 0 5px;/*0 15px*/
		  text-decoration: none;
		  text-shadow: 1px 1px 1px #66696b;
		}

		#nav ul {
		  background: #ff7400 none repeat scroll 0 0;
		  border-bottom: 1px solid #dddddd;
		  border-left: 1px solid #dddddd;
		  border-radius: 0 0 3px 3px;
		  border-right: 1px solid #dddddd;
		  box-shadow: 2px 2px 3px #ececec;
		  padding: 0;
		  width: 180px;/*240*/
		}
		
		#nav .site-name,#nav .site-name:hover{
			padding-left: 10px;
			padding-right: 10px;
			color: #FFF;
			text-shadow: 1px 1px 1px #66696B;
			font: italic 20px/38px Georgia, "Times New Roman", Times, serif;
			width: 90px;/*160*/
			border-right: 1px solid #52BDB5;
		}
		
		#nav .site-name a{
			width: 129px;
			overflow:hidden;
		}

		#nav li:hover{
			background: #3BA39B;
		}
		
		#nav li a{
			display: block;
		}
		
		#nav ul li {
			border-right:none;
			border-bottom:1px solid #DDDDDD;
			width:180px;/*240*/
			height:39px;
		}
		
		#nav ul li a {
		  border-bottom: 1px solid #ffffff;
		  border-right: medium none;
		  color: #fff;
		}
		
		#nav ul li:hover{background:#3BA39B;}
		
		#nav ul li:last-child { border-bottom: none;}
		#nav ul li:last-child a{ border-bottom: none;}
		
		/* Sub menus */
		
		#nav ul {
		  display: none;
		  position: absolute;
		  top: 40px;
		  visibility: hidden;
		  z-index: 1;
		}

		/* Third-level menus */
		
		#nav ul ul{
			top: 0px;
			left:175px;/*******240*********/
			display: none;
			visibility:hidden;
			border: 1px solid #DDDDDD;
		}
		
		/* Fourth-level menus */
		
		#nav ul ul ul{
			top: 0px;
			left:175px;/*240*/
			display: none;
			visibility:hidden;
			border: 1px solid #DDDDDD;
		}

		#nav ul li{
			display: block;
			visibility:visible;
		}
		
		#nav li:hover > ul{
			display: block;
			visibility:visible;
		}
		</style>
		
		<!--[if IE 7]>
		<style>
		#nav{
			margin-left:0px
		}
		#nav ul{
			left:-40px;
		}
		#nav ul ul{
			left:130px;
		}
		#nav ul ul ul{
			left:130px;
		}
		</style>
		<![endif]-->
	
	<!-- Device Touch Enable Scripts -->
	<script type='text/javascript'>
		
		function init() {
		  var touchzone = document.getElementById("mycanvas");
		  
			if(touchzone){
			  touchzone.addEventListener("touchmove", draw, false);
			  touchzone.addEventListener("touchend", end, false);   
			  canvas = document.getElementById('mycanvas');
			  ctx = canvas.getContext("2d");
			}
		}
	
	</script>
	
	
    
</head>

<body onload="init()">
