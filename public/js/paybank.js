// JavaScript Document

function payWithPaystack(amt,email_address,txn_ref,status,request_id){
	 			var payment_statu=status;
				//// re - initiate segment /////////////////////
 		if(payment_statu=='new') {
	
	var r = confirm("Are you sure you want to Initiate New Payment?");
		if (r ===  true) {
			$.ajax({
			 url:"payconfirm.php",
			 method:"POST",
			 data:{txn_ref:txn_ref,request_id:request_id,new_payment:payment_statu},
			 success:function(data){}
       });	 
	}else{
		exit;	
	}
}else if(payment_statu=='requery') {
		payconfirm(txn_ref);
exit;	
}
	  
	var handler = PaystackPop.setup({
	key: 'pk_test_05a27bee851170732234f04e246059134ea9d733',
	email: email_address,
	amount: amt + '00',
	currency: "NGN",
	//ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
	ref:txn_ref,
	
      metadata: {
         custom_fields: [
            {
                display_name: "Mobile Number",
                variable_name: "mobile_number",
                value: "+2348012345678"
            }
         ]
      },
      callback: function(response){
			var txn_ref = response.reference;
				if(txn_ref != '')
           			{
payconfirm(txn_ref);
           }
		  
      },
      onClose: function(){
		 window.location.href = 'dash.php?pending';
      }
    });
    handler.openIframe();
  }


function payconfirm(txn_ref)
{ 
	$.ajax({
			 url:"payconfirm.php",
			 method:"POST",
			 data:{requery:txn_ref},
			 success:function(data){
			
			var json = JSON.parse(data);
			$("#message").html(json["message"]);
			
	//	$("#status").html(json["status"]);
		alert(json["message_point"]);		
				
				///document.getElementById("disply").innerHTML = '(Min: ' + I_min + '/ Max: ' + I_max+' Allowed)';
				
				$('#view_PIN_mode').modal('show');
			 }
		});
				
}
