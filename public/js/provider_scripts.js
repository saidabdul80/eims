function load_payment_advice(){
	var provider = $("#provider_id").val();
	var cap_year = $("#cap_year").val();
	var cap_month = $("#cap_month").val();
	
	if(cap_year !=='' && cap_month !==''){
		open_close();
		loading('default_view_content','Loading, please wait..');
		$.ajax({
			url:"pp.capitation.php",
			data:'action=load_payment_advice&cap_year='+cap_year+'&cap_month='+cap_month,
			method:"POST"
		}).done(function(response){
			$('#default_view_content').html(response);
		});
	}
}

function load_provider_cap_report_by_year(year){
	
	if(year !== ''){
		loading('capitation_table_wrap','Loading, please wait..');
		$.ajax({
			url:"pp.capitation.php",
			data:'action=load_provider_cap_report_by_year&year='+year,
			method:"POST"
		}).done(function(response){
			$('#capitation_table_wrap').html(response);
		});
	}
	

}