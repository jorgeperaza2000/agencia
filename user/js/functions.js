jQuery(function($) {
	$(document).ready(function(){
		$("#userType").on("change", function(){
			if ( $(this).val() == 3 ) {

				$("#bankId").attr("disabled", false);
				$("#merchantGuid").attr("disabled", true);
				$("#merchantGuid").val("").change();

			} else if ( $(this).val() == 4 ) {

				$("#bankId").attr("disabled", true);
				$("#bankId").val("").change();
				$("#merchantGuid").attr("disabled", false);
				
			} else {

				$("#bankId").attr("disabled", true);
				$("#bankId").val("").change();
				$("#merchantGuid").attr("disabled", true);
				$("#merchantGuid").val("").change();
				
			}
		});
	});
});