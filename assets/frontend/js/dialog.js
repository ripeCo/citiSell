$(document).ready(function() {
	$(function() {
		$("#dialog").dialog({
		autoOpen: false
		});

		$("#button").on("change", function() {
			var sel_opt = $(this).val();
			if(sel_opt==1){
				$("#dialog").dialog("open");
			}
			
		});
	});

});