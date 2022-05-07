// JavaScript Document

$(document).ready(function() {
	$("#lga").change(function() {
		var lga_id = $(this).val();
		if(lga_id != "") {
			$.ajax({
				url:"get-programmes2.php",
				data:{c_id2:lga_id},
				type:'POST',
				success:function(response) {
					var resp = $.trim(response);
					$("#ward").html(resp);
				}
			});
		} else {
			$("#ward").html("<option value=''>-- Select Ward --</option>");
		}
	});
});


