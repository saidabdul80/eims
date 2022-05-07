function viewEnrollee(){
document.getElementById("displaySearchResult").innerHTML='<center><p style="margin-top:150px;"><img src="img/loading1.gif"></p></center>';
  $.post("manageproviderportal/load_enrolle.php",
function(response,status){ // Required Callback Function
document.getElementById("displaySearchResult").innerHTML=response;
});
}

function loadEnrolleDetails(token){
    document.getElementById("displaySearchResult").innerHTML='<center><p style="margin-top:150px;"><img src="img/loading1.gif"></p></center>';
  $.post("manageproviderportal/loadEnrolleDetails.php",{token:token},
function(response,status){ // Required Callback Function
document.getElementById("displaySearchResult").innerHTML=response;
});
}

function viewCapitation(){
     document.getElementById("displaySearchResult").innerHTML='<center><p style="margin-top:150px;"><img src="img/loading1.gif"></p></center>';
  $.post("manageproviderportal/viewCapitationClaim.php",
function(response,status){ // Required Callback Function
document.getElementById("displaySearchResult").innerHTML=response;
});
}

function Manage_Referrals(){
     document.getElementById("displaySearchResult").innerHTML='<center><p style="margin-top:150px;"><img src="img/loading1.gif"></p></center>';
  $.post("manageproviderportal/Manage_Referrals.php",
function(response,status){ // Required Callback Function
document.getElementById("displaySearchResult").innerHTML=response;
});
}