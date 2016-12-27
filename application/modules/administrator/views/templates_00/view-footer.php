
<h5 class="pull-right">
	<span class="text-info">Design & Developed by  - </span>
	<!---a href="http://wanitltd.com" target="_blank" class="btn btn-default btn-primary">WAN IT LIMITED</a--->
	<a href="http://wanitltd.com" target="_blank" class="btn btn-default btn-primary powerBy">
		<img class="wanitLog" src="<?php echo base_url(); ?>assets/backend/images/wanitltd.png" alt="wan it ltd" />
	</a>
</h5>

<!-- Placed js at the end of the document so the pages load faster -->

<!--Core js-->
<script src="<?php echo base_url(); ?>assets/backend/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/bs3/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/js/jquery.scrollTo.min.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/js/jquery.nicescroll.js"></script>
<!--Easy Pie Chart-->
<script src="<?php echo base_url(); ?>assets/backend/js/easypiechart/jquery.easypiechart.js"></script>
<!--Sparkline Chart-->
<script src="<?php echo base_url(); ?>assets/backend/js/sparkline/jquery.sparkline.js"></script>
<!--jQuery Flot Chart-->
<script src="<?php echo base_url(); ?>assets/backend/js/flot-chart/jquery.flot.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/js/flot-chart/jquery.flot.tooltip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/js/flot-chart/jquery.flot.resize.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/js/flot-chart/jquery.flot.pie.resize.js"></script>

<!--dynamic table-->
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/backend/js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/data-tables/DT_bootstrap.js"></script>
<!--common script init for all pages-->
<script src="<?php echo base_url(); ?>assets/backend/js/scripts.js"></script>

<!--dynamic table initialization -->
<script src="<?php echo base_url(); ?>assets/backend/js/dynamic_table_init.js"></script>


	<!-- Javascript Confirmation -->
	<script type="text/javascript">
		
		function confirmDelete() {
		  return confirm('Are you sure want to delete this?');
		}
		
		function confirmUpdate() {
		  return confirm('Are you sure want to update this?');
		}

	</script>
	
	<script>
		$(document).ready(function(){
			$('#msg').fadeOut(5000);
		}
		);
	</script>
	
</body>
</html>

<?php
	/* the content */
	ob_get_contents();  //gets the contents of the output buffer 
	ob_end_flush(); // Send the output and turn off output buffering

?>