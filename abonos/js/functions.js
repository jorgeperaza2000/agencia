jQuery(function($) {
	$(document).ready(function(){
		$('#fecha').datepicker({
	        startView: 1,
	        todayBtn: "linked",
	        language: "es",
	        daysOfWeekDisabled: "0",
	        autoclose: true,
	        format: "dd-mm-yyyy"
	    }).on('changeDate', function(){
	    	
	    });

	});
});