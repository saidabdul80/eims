function loadLga(id){
		
		$.ajax({
		url:"lga.php",
			data:'state_id='+id,
			method:"POST"
		}).done(function(res){
		
			$('#lga_id').html(res)
			
			
		});	
}

function loadWard(lga){
		$.ajax({
		url:"ward.php",
			data:'lga='+lga,
			method:"POST"
		}).done(function(res){
		
			$('#enrolee_ward').html(res)
			
			
		});	
}

function loadProvider(ward){
		
		$.ajax({
		url:"ward.php",
			data:'ward='+ward,
			method:"POST"
		}).done(function(res){
		
			$('#choice_of_providers').html(res)
			
			
		});	
}
