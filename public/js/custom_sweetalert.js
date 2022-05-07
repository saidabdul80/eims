function sweetalertFire(type,title,text,confirmButtonText){
		Swal.fire({
			  title: title,
			  text: text,
			  type: type,
			  confirmButtonText: confirmButtonText
			})
}

if(validate_error_msg === 'success' || validate_error_msg === 'error'){
			sweetalertFire(validate_error_msg,validate_error_msg,validate_error_msg_text,'OK');
}

