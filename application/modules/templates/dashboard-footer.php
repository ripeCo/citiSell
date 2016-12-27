
<h5 class="pull-right">
    <span class="text-info">Powered by - </span><br/>
    <!---a href="http://wanitltd.com" target="_blank" class="btn btn-default btn-primary">WAN IT LIMITED</a--->
    <a href="http://wanitltd.com" target="_blank" class="btn btn-default btn-primary powerBy">
        <img class="wanitLog" src="<?php echo base_url(); ?>assets/backend/images/wanitltd.png" alt="wan it ltd" />
    </a>
</h5>

<!-- Placed js at the end of the document so the pages load faster -->
<!--Core js-->
<script src="<?php echo base_url(); ?>assets/backend/js/jquery.js"></script>
<script src="j<?php echo base_url(); ?>assets/backend/s/jquery-ui/jquery-ui-1.10.1.custom.min.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/bs3/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/js/jquery.scrollTo.min.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="<?php echo base_url(); ?>assets/backend/js/skycons/skycons.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/js/jquery.scrollTo/jquery.scrollTo.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/js/calendar/clndr.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/js/calendar/moment-2.2.1.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/js/evnt.calendar.init.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/js/jvector-map/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/js/jvector-map/jquery-jvectormap-us-lcc-en.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/js/gauge/gauge.js"></script>
<!--clock init-->
<script src="<?php echo base_url(); ?>assets/backend/js/css3clock/js/css3clock.js"></script>

<!--common script init for all pages-->
<script src="<?php echo base_url(); ?>assets/backend/js/scripts.js"></script>

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
			$('#msg').fadeOut(6000);
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