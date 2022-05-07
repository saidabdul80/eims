// JavaScript Document

$(document).ready(function() {
	$("#health_zone").change(function() {
	//	alert('ffffffffffffffffffffff');
		var category_id = $(this).val();
		if(category_id != "") {
			$.ajax({
				url:"get-programmes.php",
				data:{c_id:category_id},
				type:'POST',
				success:function(response) {
					var resp = $.trim(response);
					$("#lga").html(resp);
				}
			});
		} else {
			$("#lga").html("<option value=''>-- Select LGA --</option>");
		}
	});
});

