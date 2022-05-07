function load_Generate_code(){
document.getElementById("load_content").innerHTML='<center><p style="margin-top:150px;"><img src="img/loading1.gif"></p></center>';
 
  $.post("preauthorization/load_Generate_code_page.php",
function(response,status){ // Required Callback Function
document.getElementById("load_content").innerHTML=response;
});
}

function searchEnrollee(){
    var enrolleeId=document.getElementById("enrolleeID").value;
    document.getElementById("displaySearchResult").innerHTML='<center><p style="margin-top:150px;"><img src="img/loading1.gif"></p></center>';
  $.post("preauthorization/searchEnrollee.php",{enrolleeId:enrolleeId},
function(response,status){ // Required Callback Function
document.getElementById("displaySearchResult").innerHTML=response;
});
}

function load_available_cases(programme_id,enroleeID){
    document.getElementById("loadCContent").innerHTML='<center><p style="margin-top:150px;"><img src="img/loading1.gif"></p></center>';
    $.post("preauthorization/load_available_cases.php",{programme_id:programme_id,enroleeID:enroleeID},
  function(response,status){ // Required Callback Function
  document.getElementById("loadCContent").innerHTML=response;
  
  });
}

function load_available_providers(case_id,referable,enroleeID,programme_id){
    document.getElementById("loadCContent").innerHTML='<center><p style="margin-top:150px;"><img src="img/loading1.gif"></p></center>';
    $.post("preauthorization/load_available_providers.php",{programme_id:programme_id,case_id:case_id,referable:referable,enroleeID:enroleeID},
  function(response,status){ // Required Callback Function
  document.getElementById("loadCContent").innerHTML=response;
  });
}

function generate_code(provider_ID,enroleeID,programme_id,case_id){
  document.getElementById("loadCContent").innerHTML='<center><p style="margin-top:150px;"><img src="img/loading1.gif"></p></center>';
    $.post("preauthorization/generate_code.php",{case_id:case_id,provider_ID:provider_ID,enroleeID:enroleeID,programme_id:programme_id},
  function(response,status){ // Required Callback Function
  document.getElementById("loadCContent").innerHTML=response;
  });
}

function generate(recieving_provider_ID,enroleeID,programme_id,case_id){
  var coment=document.getElementById("coment").value;
  
 
 if(coment==""){
      alert("Please Enter Comment");
  }else{
  document.getElementById("loadCContent").innerHTML='<center><p style="margin-top:150px;"><img src="img/loading1.gif"></p></center>';
    $.post("preauthorization/generate.php",{case_id:case_id,coment:coment,recieving_provider_ID:recieving_provider_ID,enroleeID:enroleeID,programme_id:programme_id},
  function(response,status){ // Required Callback Function
  document.getElementById("loadCContent").innerHTML=response;
  });
  }
  load_Generate_code();
}


function loadSlip(token){
  document.getElementById("loadGeneratedCase").innerHTML='<center><p style="margin-top:150px;"><img src="img/loading1.gif"></p></center>';
    $.post("preauthorization/loadSlip.php",{token:token},
  function(response,status){ // Required Callback Function
  document.getElementById("loadGeneratedCase").innerHTML=response;
  });
}




function managecases(){
document.getElementById("load_content").innerHTML='<center><p style="margin-top:150px;"><img src="img/loading1.gif"></p></center>';
  $.post("preauthorization/managecases.php",
function(response,status){ // Required Callback Function
document.getElementById("load_content").innerHTML=response;
});
}


function printElem(divId) {
   //Get the HTML of div
            var divElements = document.getElementById(divId).innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;

            //Reset the page's HTML with div's HTML only
document.body.innerHTML = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><title></title></head><body>' + 
              divElements + '</body>';

            //Print Page
            window.print();

            //Restore orignal HTML
            document.body.innerHTML = oldPage;

}


function Addnewcase(){
     var programme_id=document.getElementById("programme_id").value;
     var caseTitle=document.getElementById("caseTitle").value;
     var caseICD=document.getElementById("caseICD").value;
     
     if(caseTitle == ''){
         document.getElementById("caseError").innerHTML='<p style="color:red;margin-top:5;">Enter Case Title</p>';
     }else if(programme_id==''){
         document.getElementById("caseError").innerHTML='<p style="color:red;margin-top:5;">Select Programme</p>';
     }else if(caseICD==''){
         document.getElementById("caseError").innerHTML='<p style="color:red;margin-top:5;">Enter Case ICD</p>';
     }
     
     else{
         document.getElementById("caseError").innerHTML='<center><p style="margin-top:5;"><img src="img/loading1.gif"></p></center>';
 
  $.post("preauthorization/Addnewcase.php",{caseICD:caseICD,caseTitle:caseTitle,programme_id:programme_id},
function(response,status){ // Required Callback Function
if(response==1){
    managecases();
}else{
    document.getElementById("caseError").innerHTML='<p style="color:red;margin-top:5;">'+ response +'</p>';
}
});
     }
}

function deleteCase(caseId){
    var ans=confirm("Are you sure you want to Delete This case?");
    if(ans==true){
         $.post("preauthorization/deleteCase.php",{caseId:caseId},
function(response,status){ // Required Callback Function
managecases();
});
    }
}

function loadEdit(caseID){
    document.getElementById("loadEdit").innerHTML='<center><p style="margin-top:150px;"><img src="img/loading1.gif"></p></center>';
 
  $.post("preauthorization/loadEdit.php",{caseID:caseID},
function(response,status){ // Required Callback Function
document.getElementById("loadEdit").innerHTML=response;
});
}


function UpdateCase(caseID){
    
     var caseTitle=document.getElementById("caseTitle").value;
     var caseICD=document.getElementById("caseICD").value;
     
     if(caseTitle == ''){
         document.getElementById("caseError").innerHTML='<p style="color:red;margin-top:5;">Enter Case Title</p>';
     }else{
         document.getElementById("caseError").innerHTML='<center><p style="margin-top:5;"><img src="img/loading1.gif"></p></center>';
 
  $.post("preauthorization/UpdateCase.php",{caseTitle:caseTitle,caseID:caseID,caseICD:caseICD},
function(response,status){ // Required Callback Function

if(response==1){
    managecases();
}else{
    document.getElementById("caseError").innerHTML='<p style="color:red;margin-top:5;">'+ response +'</p>';
}
});
     }
}
    
    
function availableProgramme(){
document.getElementById("load_content").innerHTML='<center><p style="margin-top:150px;"><img src="img/loading1.gif"></p></center>';
 
  $.post("preauthorization/availableProgramme.php",
function(response,status){ // Required Callback Function
document.getElementById("load_content").innerHTML=response;
});
}
 
function chkifpchecked(token){
    var checkBox = document.getElementById("p"+token);
    if (checkBox.checked == true){
    //update to 1
     $.post("preauthorization/updateSeconderyTo1.php",{token:token},
function(response,status){ // Required Callback Function
    alert(response);
});
  } else {
     //update to 0
      $.post("preauthorization/updateSeconderyTo0.php",{token:token},
function(response,status){ // Required Callback Function
    alert(response);
});
  }
}
 
 function chkifschecked(token){
       var checkBox = document.getElementById("s"+token);
    if (checkBox.checked == true){
    //update to 1
     $.post("preauthorization/updatetertiaryTo1.php",{token:token},
function(response,status){ // Required Callback Function
    alert(response);
});
  } else {
     //update to 0
      $.post("preauthorization/updatetertiaryTo0.php",{token:token},
function(response,status){ // Required Callback Function
    alert(response);
});
  }
    
}


function managePreauthorizationReport(){
document.getElementById("load_content").innerHTML='<center><p style="margin-top:150px;"><img src="img/loading1.gif"></p></center>';
 
  $.post("preauthorization/managePreauthorizationReport.php",
function(response,status){ // Required Callback Function
document.getElementById("load_content").innerHTML=response;
});
}
