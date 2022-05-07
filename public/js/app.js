function loading(id,text){
	$('#'+id).html('<div class="text-center"><img src="/images/ajax-loader.gif" style="color:red;width:100px;height:100px"><br/>'+text+'</div>');
  }
  function format_number(num){
	  return num.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')
  }

function success_message(id,text){
	$('#'+id).html('<div class="alert alert-success text-center">'+text+'</div>');
}


function error_message(id,text){
	$('#'+id).html('<div class="alert alert-danger text-center">'+text+'</div>');
}