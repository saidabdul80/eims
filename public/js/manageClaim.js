function showMakeClaims(token){
document.getElementById("loadNewClaim").innerHTML='<center><p style="margin-top:150px;"><img src="img/loading1.gif"></p></center>';
  $.post("manageclaim/loadNewClaim.php",{authorizationID:token},
function(response,status){ // Required Callback Function
document.getElementById("loadNewClaim").innerHTML=response;
});
}



function PickDrug(drugid,authorizationID){
  $.post("manageclaim/PickDrug.php",{drugid:drugid,authorizationID:authorizationID},
function(response,status){ // Required Callback Function
    alert(response);
    refreshDrugPicked(authorizationID);
});
}

function PickLap(labid,authorizationID){
 $.post("manageclaim/AddLab.php",{labid:labid,authorizationID:authorizationID},
function(response,status){ // Required Callback Function
    alert(response);
    refreshLabPicked(authorizationID);
});
}

function PickRadiology(Radiologyid,authorizationID){
 $.post("manageclaim/AddRadiology.php",{Radiologyid:Radiologyid,authorizationID:authorizationID},
function(response,status){ // Required Callback Function
    alert(response);
    refreshRadiologyPicked(authorizationID);
});
}


function Pickprofessional(professionalid,authorizationID){
 $.post("manageclaim/AddProfessional.php",{professionalid:professionalid,authorizationID:authorizationID},
function(response,status){ // Required Callback Function
    alert(response);
    refreshProfessionalPicked(authorizationID);
});
}


function changeValue(claim_drugs_id){
    var quantity=document.getElementById("quantity").value;
    if(quantity > 0){
        $.post("manageclaim/changeValue.php",{quantity:quantity,claim_drugs_id:claim_drugs_id},
function(response,status){ // Required Callback Function
   
});
    }else{
        alert("Invalid Quantity");
    }
}


function changeValueProfessional(claim_professional_id){
   
    var quantity=document.getElementById("quantityProf").value;
    
   
    
    if(quantity > 0){
        $.post("manageclaim/changeValueProfessional.php",{quantity:quantity,claim_professional_id:claim_professional_id},
function(response,status){ // Required Callback Function

});
    }else{
        alert("Invalid Quantity");
    }
}



function refreshDrugPicked(authorizationID){
    document.getElementById("refreshDrugPicked").innerHTML='<center><p style="margin-top:150px;"><img src="img/loading1.gif"></p></center>';
  $.post("manageclaim/refreshDrugPicked.php",{authorizationID:authorizationID},
    function(response,status){ // Required Callback Function
    document.getElementById("refreshDrugPicked").innerHTML=response;
    });
}


function refreshLabPicked(authorizationID){
    document.getElementById("refreshLabPicked").innerHTML='<center><p style="margin-top:150px;"><img src="img/loading1.gif"></p></center>';
  $.post("manageclaim/refreshLabPicked.php",{authorizationID:authorizationID},
    function(response,status){ // Required Callback Function
    document.getElementById("refreshLabPicked").innerHTML=response;
    });
}


function refreshRadiologyPicked(authorizationID){
    document.getElementById("refreshRadiologyPicked").innerHTML='<center><p style="margin-top:150px;"><img src="img/loading1.gif"></p></center>';
  $.post("manageclaim/refreshRadiologyPicked.php",{authorizationID:authorizationID},
    function(response,status){ // Required Callback Function
    document.getElementById("refreshRadiologyPicked").innerHTML=response;
    });
}

function refreshProfessionalPicked(authorizationID){
    document.getElementById("refreshProfessionalPicked").innerHTML='<center><p style="margin-top:150px;"><img src="img/loading1.gif"></p></center>';
  $.post("manageclaim/refreshProfessionalPicked.php",{authorizationID:authorizationID},
    function(response,status){ // Required Callback Function
    document.getElementById("refreshProfessionalPicked").innerHTML=response;
    });
}

function refreshloadClaims(){
 document.getElementById("load_content").innerHTML='<center><p style="margin-top:150px;"><img src="img/loading1.gif"></p></center>';
  $.post("manageclaim/loadPendingClaims.php",
function(response,status){ // Required Callback Function
document.getElementById("load_content").innerHTML=response;
});
}



function RemoveDrug(drugid,claim_drugs_id,authorizationID){
     $.post("manageclaim/RemoveDrug.php",{drugid:drugid,claim_drugs_id:claim_drugs_id},
function(response,status){ // Required Callback Function
    refreshDrugPicked(authorizationID);
});
}


function RemoveLab(labid,claim_lab_id,authorizationID){
     $.post("manageclaim/DeleteLabTest.php",{labid:labid,claim_lab_id:claim_lab_id},
function(response,status){ // Required Callback Function
    refreshLabPicked(authorizationID);
});
}


function RemoveRadiology(Radiologyid,claim_radiology_id,authorizationID){
     $.post("manageclaim/DeleteRadiology.php",{Radiologyid:Radiologyid,claim_radiology_id:claim_radiology_id},
function(response,status){ // Required Callback Function
    refreshRadiologyPicked(authorizationID);
});
}


/* Script written by Adam Khoury @ DevelopPHP.com */
/* Video Tutorial: http://www.youtube.com/watch?v=EraNFJiY0Eg */
function _(el){
	return document.getElementById(el);
}
function uploadFile1(authorizationID){
    localStorage.setItem("authorizationID", authorizationID);
    var attachmentType=document.getElementById("attachmentType").value;
	var file = _("file1").files[0];
	// alert(file.name+" | "+file.size+" | "+file.type);
	var formdata = new FormData();
	formdata.append("attachmentType", attachmentType);
	formdata.append("file1", file);
	formdata.append("authorizationID", authorizationID);
	
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST", "manageclaim/file_upload_file.php");
	ajax.send(formdata);
}
function progressHandler(event){
	_("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
	var percent = (event.loaded / event.total) * 100;
	_("progressBar").value = Math.round(percent);
	_("status").innerHTML = Math.round(percent)+"% uploaded... please wait";
	
}
function completeHandler(event){
	_("status").innerHTML = event.target.responseText;
	_("progressBar").value = 0;
	_("loaded_n_total").value = "";
	//ReloadAttachments();
}
function errorHandler(event){
	_("status").innerHTML = "Upload Failed";
}
function abortHandler(event){
	_("status").innerHTML = "Upload Aborted";
}


function SubmitClaim(authorizationID){
     var diagnosis=document.getElementById("diagnosis").value;
    document.getElementById("submitCliamErro").innerHTML='<center><p style="margin-top:5px;"><img src="img/loading1.gif"></p></center>';
  $.post("manageclaim/SubmitClaim.php",{authorizationID:authorizationID,diagnosis:diagnosis},
    function(response,status){ // Required Callback Function
    if(response=="Claim Submited"){
        alert("Claim Submited Successfully");
        $('#showMakeClaim').modal('hide');
         refreshloadClaims();
    }else{
        document.getElementById("submitCliamErro").innerHTML=response;
    }

    });
   
}

function pendingClaims(){
    refreshloadClaims();
}

function rejectedClaims(){
	 document.getElementById("load_content").innerHTML='<center><p style="margin-top:150px;"><img src="img/loading1.gif"></p></center>';
   $.post("manageclaim/rejectedClaims.php",
    function(response,status){ // Required Callback Function
    document.getElementById("load_content").innerHTML=response;
    });
}

function approvedClaims(){
	 document.getElementById("load_content").innerHTML='<center><p style="margin-top:150px;"><img src="img/loading1.gif"></p></center>';
   $.post("manageclaim/approvedClaims.php",
    function(response,status){ // Required Callback Function
    document.getElementById("load_content").innerHTML=response;
    });
}

function allSubmitedClaims(){
     document.getElementById("load_content").innerHTML='<center><p style="margin-top:150px;"><img src="img/loading1.gif"></p></center>';
   $.post("manageclaim/allSubmitedClaims.php",
    function(response,status){ // Required Callback Function
    document.getElementById("load_content").innerHTML=response;
    });
}

function showclaimstatus(authorizationID){
      document.getElementById("loadClaimStatus").innerHTML='<center><p style="margin-top:150px;"><img src="img/loading1.gif"></p></center>';
   $.post("manageclaim/showclaimstatus.php",{authorizationID:authorizationID},
    function(response,status){ // Required Callback Function
    document.getElementById("loadClaimStatus").innerHTML=response;
    });
}

function showViewClaims(claimID){
	 document.getElementById("load_claim_Details").innerHTML='<center><p style="margin-top:150px;"><img src="img/loading1.gif"></p></center>';
	  $.post("manageclaim/loadClaimDetails.php",{claimID:claimID},
    function(response,status){ // Required Callback Function
    document.getElementById("load_claim_Details").innerHTML=response;
    });
}



function Claimsconfirm(claimID){
	 document.getElementById("load_claimDetailsconfirm").innerHTML='<center><p style="margin-top:150px;"><img src="img/loading1.gif"></p></center>';
	$.post("manageclaim/loadClaimDetails2.php",{claimID:claimID},
    function(response,status){ // Required Callback Function
    document.getElementById("load_claimDetailsconfirm").innerHTML=response;
    });
}


function approveClaims(claimID){
	 document.getElementById("load_claimDetailsconfirm").innerHTML='<center><p style="margin-top:150px;"><img src="img/loading1.gif"></p></center>';
	$.post("manageclaim/loadClaimDetails3.php",{claimID:claimID},
    function(response,status){ // Required Callback Function
    document.getElementById("load_claimDetailsconfirm").innerHTML=response;
    });
}



function refreshloadReviewClaims(){
 window.location.href = "hcp.review_claims.php";
}

function reviewCliam(){
	document.getElementById("load_content").innerHTML='<center><p style="margin-top:150px;"><img src="img/loading1.gif"></p></center>';
	$.post("manageclaim/reviewClaims.php",
    function(response,status){ // Required Callback Function
    document.getElementById("load_content").innerHTML=response;
    });
}

function SubmitReview(claimId){
    document.getElementById("reviewsError").innerHTML='<center><p style="margin-top:5px;"><img src="img/loading1.gif"></p></center>';
  $.post("manageclaim/SubmitReview.php",{claimId:claimId},
    function(response,status){ // Required Callback Function
    if(response=="Claim Submited"){
        alert("Review Submited Successfully");
        $('#showMakeClaim').modal('hide');
         reviewCliam();
    }else{
        document.getElementById("reviewsError").innerHTML=response;
    }

    }); 
}

function SubmitRejectReview(claimId){
    document.getElementById("reviewsError").innerHTML='<center><p style="margin-top:5px;"><img src="img/loading1.gif"></p></center>';
  $.post("manageclaim/SubmitRejectReview.php",{claimId:claimId},
    function(response,status){ // Required Callback Function
    if(response=="Action Submited"){
        alert("Claim Rejected Successfully");
        $('#showMakeClaim').modal('hide');
         reviewCliam();
    }else{
        document.getElementById("reviewsError").innerHTML=response;
    }

    }); 
}



function ConfirmCliam(){
	 document.getElementById("load_content").innerHTML='<center><p style="margin-top:150px;"><img src="img/loading1.gif"></p></center>';
	  $.post("manageclaim/ConfirmCliam.php",
    function(response,status){ // Required Callback Function
    document.getElementById("load_content").innerHTML=response;
    });
}

function approve_claim(){
	 document.getElementById("load_content").innerHTML='<center><p style="margin-top:150px;"><img src="img/loading1.gif"></p></center>';
	  $.post("manageclaim/approveClaim.php",
    function(response,status){ // Required Callback Function
    document.getElementById("load_content").innerHTML=response;
    });
}


function account_officer(){
	 document.getElementById("load_content").innerHTML='<center><p style="margin-top:150px;"><img src="img/loading1.gif"></p></center>';
	  $.post("manageclaim/account_officer.php",
    function(response,status){ // Required Callback Function
    document.getElementById("load_content").innerHTML=response;
    });
}




function confirmsubmut(claimID){
	  document.getElementById("c_error").innerHTML='<center><p style="margin-top:5px;"><img src="img/loading1.gif"></p></center>';
  $.post("manageclaim/Submitconfirm.php",{claimID:claimID},
    function(response,status){ // Required Callback Function
    if(response=="Claim Submited"){
        alert("Claim Confirmed Successfully");
         
		 $('#showViewClaimConfirm').modal('hide');
		 ConfirmCliam();
    }else{
        document.getElementById("c_error").innerHTML=response;
    }

    }); 
}

function approveclaim(claimID){
	 document.getElementById("c_error").innerHTML='<center><p style="margin-top:5px;"><img src="img/loading1.gif"></p></center>';
  $.post("manageclaim/submitapproveclaim.php",{claimID:claimID},
    function(response,status){ // Required Callback Function
    if(response=="Claim Submited"){
        alert("Claim Approved Successfully");
         
		 $('#showViewClaimConfirm').modal('hide');
		 approve_claim();
    }else{
        document.getElementById("c_error").innerHTML=response;
    }

    }); 
}


function Rejectconfirm(claimID){
	  document.getElementById("c_error").innerHTML='<center><p style="margin-top:5px;"><img src="img/loading1.gif"></p></center>';
  $.post("manageclaim/Rejectconfirm.php",{claimID:claimID},
    function(response,status){ // Required Callback Function
		document.getElementById("c_error").innerHTML=response;
    }); 
     $('#showViewClaimConfirm').modal('hide');
}

function submitRejectClaim(claimID){
	 var rejectClaimReason=document.getElementById("rejectClaimReason").value;
	   document.getElementById("c_error").innerHTML='<center><p style="margin-top:5px;"><img src="img/loading1.gif"></p></center>';
  $.post("manageclaim/submitRejectClaim.php",{claimID:claimID,rejectClaimReason:rejectClaimReason},
    function(response,status){ // Required Callback Function
	alert(response);
    if(response=="Claim Rejected"){
        alert("Claim Rejected");
        
    }else{
        document.getElementById("c_error").innerHTML=response;
    }

    }); 
	 $('#showViewClaimConfirm').modal('hide');
		 ConfirmCliam();
		  
}

function viewClaimSettlement(settlementID){
	  document.getElementById("load_Details").innerHTML='<center><p style="margin-top:5px;"><img src="img/loading1.gif"></p></center>';
  $.post("manageclaim/getAllClaimsonthisSettlement.php",{settlementID:settlementID},
    function(response,status){ // Required Callback Function
		document.getElementById("load_Details").innerHTML=response;
    }); 
}

function PrintClaimReport(settlementID){
		  document.getElementById("load_Details").innerHTML='<center><p style="margin-top:5px;"><img src="img/loading1.gif"></p></center>';
  $.post("manageclaim/claimReport.php",{settlementID:settlementID},
    function(response,status){ // Required Callback Function
		document.getElementById("load_Details").innerHTML=response;
    });
}

function PrintClaimReportbyProviders(settlementID){
	  document.getElementById("load_Details").innerHTML='<center><p style="margin-top:5px;"><img src="img/loading1.gif"></p></center>';
  $.post("manageclaim/claimByProvidersReport.php",{settlementID:settlementID},
    function(response,status){ // Required Callback Function
		document.getElementById("load_Details").innerHTML=response;
    });
}
function PaidSettlement(settlementID){
	$.post("manageclaim/PaidSettlement.php",{settlementID:settlementID},
    function(response,status){ // Required Callback Function
		account_officer();
    });
	
}
