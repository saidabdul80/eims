function addNews(){
    var newsTitle=document.getElementById("newsTitle").value;
    var newscontent=document.getElementById("newscontent").value;
    
    if(newsTitle == ""){
       alert("Enter News Title");
    }else if(newscontent==""){
        alert("Enter News Content");
    }else{
         $.post("managePortal/addNewNews.php",{newsTitle:newsTitle,newscontent:newscontent},
            function(response,status){ // Required Callback Function
            document.getElementById("load_newsError").innerHTML=response;
            
    });
    }
}


/* Script written by Adam Khoury @ DevelopPHP.com */
/* Video Tutorial: http://www.youtube.com/watch?v=EraNFJiY0Eg */
function _(el){
	return document.getElementById(el);
}

function uploadFile(token){
    localStorage.setItem("token", token);
	var file = _("file1").files[0];
	// alert(file.name+" | "+file.size+" | "+file.type);
	var formdata = new FormData();
	formdata.append("file1", file);
	formdata.append("token", token);
	
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST", "managePortal/changeImage.php");
	ajax.send(formdata);
}


function uploadFile(token){
    localStorage.setItem("token", token);
	var file = _("file1").files[0];
	// alert(file.name+" | "+file.size+" | "+file.type);
	var formdata = new FormData();
	formdata.append("file1", file);
	formdata.append("token", token);
	
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST", "managePortal/file_upload_file.php");
	ajax.send(formdata);
}

function uploadPhoto(token){
    localStorage.setItem("token", token);
	var file = _("file1").files[0];
	// alert(file.name+" | "+file.size+" | "+file.type);
	var formdata = new FormData();
	formdata.append("file1", file);
	formdata.append("token", token);

	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST", "managePortal/file_upload_Photo.php");
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
	
}
function errorHandler(event){
	_("status").innerHTML = "Upload Failed";
}
function abortHandler(event){
	_("status").innerHTML = "Upload Aborted";
}

function deleteNews(token){
  
  $.post("managePortal/deleteNews.php",{token:token},
function(response,status){ // Required Callback Function
    loadManageNews();
});
}

function loadManageNews(){
    document.getElementById("load_content").innerHTML='<center><p style="margin-top:150px;">Loading, Please wait...</p></center>';
     $.post("managePortal/ManageNews.php",
            function(response,status){ // Required Callback Function
            document.getElementById("load_content").innerHTML=response;
            
    });
}

function loadManagePictureNews(){
     document.getElementById("load_content").innerHTML='<center><p style="margin-top:150px;">Loading, Please wait...</p></center>';
     $.post("managePortal/loadManagePictureNews.php",
            function(response,status){ // Required Callback Function
            document.getElementById("load_content").innerHTML=response;
            
    });
}

function managenewspictures(token){
     document.getElementById("load_content").innerHTML='<center><p style="margin-top:150px;">Loading, Please wait...</p></center>';
     $.post("managePortal/managenewspictures.php",{token:token},
            function(response,status){ // Required Callback Function
            document.getElementById("load_content").innerHTML=response;
            
    });
}

function deletePictureNews(news_id,token){
     $.post("managePortal/deletePictureNews.php",{token:token,news_id:news_id},
function(response,status){ // Required Callback Function

    if(response=="0"){
        alert("You can not Delete this Picture");
    }else{
         managenewspictures(news_id);
    }
   
});
}

function loadManageAbout(){
    document.getElementById("load_content").innerHTML='<center><p style="margin-top:150px;">Loading, Please wait...</p></center>';
     $.post("managePortal/loadManageAbout.php",
            function(response,status){ // Required Callback Function
            document.getElementById("load_content").innerHTML=response;
            
    });
}

function UpdateAboutPage(){
    var about_nicare=document.getElementById("about_nicare").value;
   
    if(about_nicare==""){
         alert("Empty feilds");
    }else{
         $.post("managePortal/UpdateAbout.php",{about_nicare:about_nicare},
            function(response,status){ // Required Callback Function
            alert("Updated Successfully");
            
    });
    }
}

function loadManageGallary(){
     document.getElementById("load_content").innerHTML='<center><p style="margin-top:150px;">Loading, Please wait...</p></center>';
     $.post("managePortal/loadManageGallary.php",
            function(response,status){ // Required Callback Function
            document.getElementById("load_content").innerHTML=response;
            
    });
}

function ecitNews(newsID){
     document.getElementById("load_content").innerHTML='<center><p style="margin-top:150px;">Loading, Please wait...</p></center>';
     $.post("managePortal/load_manage_news.php",{newsID:newsID},
            function(response,status){ // Required Callback Function
            document.getElementById("load_content").innerHTML=response;
            
    });
    
}

function UpdateNews(newsID){
    var newsTitle=document.getElementById("newsTitle").value;
    var newscontent=document.getElementById("newscontent").value;
    
    if(newsTitle == ""){
       alert("Enter News Title");
    }else if(newscontent==""){
        alert("Enter News Content");
    }else{
         $.post("managePortal/UpdateNews.php",{news_id:newsID,newsTitle:newsTitle,newscontent:newscontent},
            function(response,status){ // Required Callback Function
            //alert(response);
            loadManageNews();
            
    });
    }
    
}

function managegallarypictures(galleries_id){
     document.getElementById("load_gallery_content").innerHTML='<center><p style="margin-top:150px;">Loading, Please wait...</p></center>';
     $.post("managePortal/managegallarypictures.php",{galleries_id:galleries_id},
            function(response,status){ // Required Callback Function
            document.getElementById("load_gallery_content").innerHTML=response;
            
    });
}

function createGallery(){
     var galleryName=document.getElementById("galleryName").value;
     
    if(galleryName==""){
        alert("Enter Gallery Name");
    }else{
         $.post("managePortal/addGallery.php",{galleryName:galleryName},
            function(response,status){ // Required Callback Function
          loadManageGallary();
    });
    }
     
}

function deletegallary(galleries_id){
    $.post("managePortal/DeleteGallery.php",{galleries_id:galleries_id},
            function(response,status){ // Required Callback Function
          loadManageGallary();
    });
}


function deletegallaryPhoto(collection_id){
     $.post("managePortal/deletegallaryPhoto.php",{collection_id:collection_id},
            function(response,status){ // Required Callback Function
          document.getElementById("D"+collection_id).remove();
    });
    
}

function loadManageFAQ(){
     document.getElementById("load_content").innerHTML='<center><p style="margin-top:150px;">Loading, Please wait...</p></center>';
     $.post("managePortal/loadManageFAQ.php",
            function(response,status){ // Required Callback Function
            document.getElementById("load_content").innerHTML=response;
            
    });
}

function addFAQ(){
   
    var question=document.getElementById("question").value;
    var answer=document.getElementById("answer").value;
    
    if(question == ""){
       alert("Enter Question");
    }else if(answer==""){
        alert("Enter Answer");
    }else{
         $.post("managePortal/addFAQ.php",{question:question,answer:answer},
            function(response,status){ // Required Callback Function
            
            
    });
    }
    loadManageFAQ();
    
}

function deleteFAQ(token){
  $.post("managePortal/deleteFAQ.php",{token:token},
function(response,status){ // Required Callback Function
    loadManageFAQ();
});
}

function editFAQ(token){
     document.getElementById("loadForm").innerHTML='<center><p style="margin-top:150px;">Loading, Please wait...</p></center>';
     $.post("managePortal/LoadeditFAQ.php",{token:token},
            function(response,status){ // Required Callback Function
            document.getElementById("loadForm").innerHTML=response;
            
    });
}

function UpdateFAQ(faqID){
    var question=document.getElementById("question").value;
    var answer=document.getElementById("answer").value;
    
    if(question == ""){
       alert("Enter Question");
    }else if(answer==""){
        alert("Enter Answer");
    }else{
         $.post("managePortal/UpdateFAQ.php",{question:question,answer:answer,faqID:faqID},
            function(response,status){ // Required Callback Function
            loadManageFAQ();
    });
    }
}

function loadManageDepartments(){
    document.getElementById("load_content").innerHTML='<center><p style="margin-top:150px;">Loading, Please wait...</p></center>';
     $.post("managePortal/loadManageDepartments.php",
            function(response,status){ // Required Callback Function
            document.getElementById("load_content").innerHTML=response;
            
    });
}



function addDepartment(){
    
    document.getElementById("error").innerHTML='<center><p style="margin-top:150px;">Saving, Please wait...</p></center>';
     var departmentName=document.getElementById("departmentName").value;
     var hod=document.getElementById("hod").value;
     var responsibility=document.getElementById("responsibility").value;
    
    if(departmentName == ""){
       alert("Enter Department Name");
    }else if(hod==""){
        alert("Enter Head of Department");
    }else if(responsibility==""){
        alert("Enter Department Responsibility");
    }else{
         $.post("managePortal/addDepartment.php",{departmentName:departmentName,hod:hod,responsibility:responsibility},
            function(response,status){ // Required Callback Function
            loadManageDepartments();
    });
    }
    
}

function deleteDepartment(token){
    var ans=confirm("Are you sure you want to delete this record?");
    if(ans==true){
         $.post("managePortal/deleteDepartment.php",{token:token},
            function(response,status){ // Required Callback Function
          loadManageDepartments();
    });
    }
    
}


function editDepartment(token){
     document.getElementById("loadEditDepartment").innerHTML='<center><p style="margin-top:150px;">Loading, Please wait...</p></center>';
     $.post("managePortal/loadEditDepartment.php",{token:token},
            function(response,status){ // Required Callback Function
            document.getElementById("loadEditDepartment").innerHTML=response;
            
    });
}

function UpdateDepartment(token){
    document.getElementById("error").innerHTML='<center><p style="margin-top:150px;">Saving, Please wait...</p></center>';
     var departmentName=document.getElementById("departmentName").value;
     var hod=document.getElementById("hod").value;
     var responsibility=document.getElementById("responsibility").value;
    
    if(departmentName == ""){
       alert("Enter Department Name");
    }else if(hod==""){
        alert("Enter Head of Department");
    }else if(responsibility==""){
        alert("Enter Department Responsibility");
    }else{
         $.post("managePortal/UpdateDepartment.php",{departmentName:departmentName,hod:hod,responsibility:responsibility,token:token},
            function(response,status){ // Required Callback Function
            loadManageDepartments();
    });
    }
}

function ManageDepartmentUnit(departmentId){
    document.getElementById("load_content").innerHTML='<center><p style="margin-top:150px;">Loading, Please wait...</p></center>';
     $.post("managePortal/ManageDepartmentUnit.php",{departmentId:departmentId},
            function(response,status){ // Required Callback Function
            document.getElementById("load_content").innerHTML=response;
            
    });
}

function addUnit(departmentId){
    document.getElementById("error").innerHTML='<center><p style="margin-top:150px;">Saving, Please wait...</p></center>';
     var UnitName=document.getElementById("UnitName").value;
     var Unithod=document.getElementById("Unithod").value;
     var Unitresponsibility=document.getElementById("Unitresponsibility").value;
     var unit_description=document.getElementById("unit_description").value;
    
    if(UnitName == ""){
       alert("Enter Unit Name");
    }else if(Unithod==""){
        alert("Enter Head of Unit");
    }else if(Unitresponsibility==""){
        alert("Enter Unit Responsibility");
    }else if(unit_description==""){
        alert("Enter About Unit Head");
    }
    else{
         $.post("managePortal/addUnit.php",{unit_description:unit_description,departmentId:departmentId,UnitName:UnitName,Unithod:Unithod,Unitresponsibility:Unitresponsibility},
            function(response,status){ // Required Callback Function
            ManageDepartmentUnit(departmentId);
    });
    }
}


function deleteDepartmentUnit(token,departmentId){
    var ans=confirm("Are you sure you want to delete this record?");
    if(ans==true){
         $.post("managePortal/deleteUnit.php",{token:token},
            function(response,status){ // Required Callback Function
          ManageDepartmentUnit(departmentId);
    });
    }
    
}

function loadEditDepartmentUnit(token,departmentId){
    document.getElementById("loadEditDepartment").innerHTML='<center><p style="margin-top:150px;">Loading, Please wait...</p></center>';
     $.post("managePortal/loadEditDepartmentUnit.php",{departmentId:departmentId,token:token},
            function(response,status){ // Required Callback Function
            document.getElementById("loadEditDepartment").innerHTML=response;
            
    });
}

function UpdateUnit(token,departmentId){
     document.getElementById("error").innerHTML='<center><p style="margin-top:150px;">Saving, Please wait...</p></center>';
     var UnitName=document.getElementById("UnitName").value;
     var Unithod=document.getElementById("Unithod").value;
     var Unitresponsibility=document.getElementById("Unitresponsibility").value;
     var unit_description=document.getElementById("unit_description").value;
    
    if(UnitName == ""){
       alert("Enter Unit Name");
    }else if(Unithod==""){
        alert("Enter Head of Unit");
    }else if(Unitresponsibility==""){
        alert("Enter Unit Responsibility");
    }else if(unit_description==""){
        alert("Enter About Unit Head");
    }
    else{
         $.post("managePortal/UpdateUnit.php",{token:token,unit_description:unit_description,UnitName:UnitName,Unithod:Unithod,Unitresponsibility:Unitresponsibility},
            function(response,status){ // Required Callback Function
            ManageDepartmentUnit(departmentId);
    });
    }
}