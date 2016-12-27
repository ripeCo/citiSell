
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
<script src="<?php echo base_url(); ?>assets/backend/js/jquery-1.8.3.min.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/bs3/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/js/jquery-ui-1.9.2.custom.min.js"></script>
<script class="include" type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/js/jquery.scrollTo.min.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/js/easypiechart/jquery.easypiechart.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/js/jquery.nicescroll.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/js/jquery.nicescroll.js"></script>

<script src="<?php echo base_url(); ?>assets/backend/js/bootstrap-switch.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/fuelux/js/spinner.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/bootstrap-fileupload/bootstrap-fileupload.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/jquery-multi-select/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/jquery-multi-select/js/jquery.quicksearch.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>

<script src="<?php echo base_url(); ?>assets/backend/js/jquery-tags-input/jquery.tagsinput.js"></script>

<script src="<?php echo base_url(); ?>assets/backend/js/select2/select2.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/js/select-init.js"></script>


<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/jquery.validate.min.js"></script>

<!--common script init for all pages-->
<script src="<?php echo base_url(); ?>assets/backend/js/scripts.js"></script>
<!--this page script-->
<script src="<?php echo base_url(); ?>assets/backend/js/validation-init.js"></script>

<script src="<?php echo base_url(); ?>assets/backend/js/toggle-init.js"></script>

<script src="<?php echo base_url(); ?>assets/backend/js/advanced-form.js"></script>


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