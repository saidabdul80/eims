<?php
//dd(env("PAY_STACK_KEY"));
$amountToPay =0;
use App\Sessions;

use App\Institution;

$sessions = Sessions::all();
$selected_session = $data['session']['id'];
$institutions = Institution::all();
$students = $data['students'];
$institutions = $data['institutions'];

$page ="add";
if(isset($_COOKIE['btn-type'])) {
    $page = $_COOKIE['btn-type'];
  }
?>
<script>
    var page = '<?= $page ;?>';
</script>
@extends('layouts/master')

@section('breadcrumb','Dashboard')

@section('content-body')

    @if (session()->exists('welcome'))

        <hr/> <div class="alert alert-success"> {{ session('welcome')}} </div>
    @endif

    @if (session()->exists('message'))
        <hr/> <div class="alert alert-success"> {!! session('message') !!} </div>    
    @endif
    @if (session()->exists('error'))
        <hr/> <div class="alert alert-danger"> {!! session('error') !!} </div>    
    @endif
    <div style="">
        <br>        
        <div class="row w-100 mx-0 mb-5" style="">
        <div class="col-md-2 w-100 jumbotron p-2 mb-0" title="Add and Edit Institution">          
            <center>
                <button class="my-1 mx-1 btn-light btn btn-md text-dark {{ $page!='add'?'':'active' }} panelBtn" btn-type="add" >Add</button>
                <button class="my-1 mx-1 btn-light btn btn-md text-dark {{ $page!='edit'?'':'active' }} panelBtn" btn-type="edit" >Institutions</button>
            </center>
        </div>
        <div class="offset-md-1 col-md-5 w-100 jumbotron p-2 mb-0" style="font-size:">            
        <center>

            <button class="my-1 mx-1 btn-light btn btn-md text-dark {{ $page!='upload'?'':'active' }} panelBtn" btn-type="upload" >Upload Student</button>
            <a href="{{asset('student_upload_format2.csv')}}" class="mt-1 btn-light btn btn-md text-dark " btn-type="upload" >Template File</a>
            <button class="my-1 mx-1 btn-light btn btn-md text-dark {{ $page!='view'?'':'active' }} panelBtn" id ="viewStudent" btn-type="view" >View Students</button>
            <button class="my-1 mx-1 btn-light btn btn-md text-dark {{ $page!='invoice'?'':'active' }} panelBtn" id ="viewInvoices" btn-type="view" >Invoices</button>
        </center>
        </div>
        </div>    

        <div class="btnPages w-100">
            <div btn-type="add" style="height:68vh;display:{{ $page!='add'?'none':'block' }};" >
                <form method="get" action="{{route('create_institution')}}">
                    <div class="group-input">
                        <label>School Name:</label> <input required type="text" name="name" class="form-control adx"><br>
                        <label>Short Name:</label> <input required type="text" class="form-control adx" name="shortname"><br>
                        <input style="display: none;" type="text" class="form-control" name="id" value="">
                        <button type="submit" class="btn btn-primary add">Save</button>                        
                    </div>
                </form>
            </div>

            <div btn-type="edit" style="display:{{ $page!='edit'?'none':'block' }};height:68vh;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>Name</td>
                                <td>short Name</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($data['institutions'] as $data)
                                <tr>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->sortCode}}</td>
                                    <td>                                        
                                        <button data-value="{{json_encode([$data->name,$data->sortCode,$data->id])}}" class="btn btn-light updateBtn"><span class="fa fa-edit">Edit</span></button>
                                        <a href="{{route('delete_institution',['id'=>$data->id, 'session_id'=>$selected_session])}}" onclick="return confirm('Are you sure you want to disable the Institution ?') " class="btn btn-danger deleteBtn"><span class="fa fa-times"> Disable</span></button>                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>

            <div class="w-100 text-center" btn-type="upload" style="display:{{ $page!='upload'?'none':'block' }};height:68vh;">
                <form id="uploadStudent" action="{{route('upload_students')}}" method="post" enctype="multipart/form-data">                
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="row">
                    <div class="col-md-12 text-left" >
                        <label class="text-left">Session:</label>
                        <select id="session_id"  require name="session_id" class="form-control" >
                            <option value="">--</option>
                            @foreach($sessions as $session)
                            <option value="{{$session->id}}"  >{{$session->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <select id="payment_type"  require name="payment_type" class="form-control" style="display: none;" >                                                        
                        <option value="Cash" >Cash</option>                            
                        <option value="Other" >Other</option>                            
                    </select>
                    
                    <div class="col-md-12 mt-4 text-left" >
                        <label class="text-left" >Institution:</label>
                        <select id="institution_id" require name="institution_id" class="form-control" >
                            <option value="">--</option>
                            @foreach($institutions as $institution)
                            <option value="{{$institution->id}}"  >{{$institution->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="text" name="ref" value="" style="display: none;">
                </div>                
                <div class="drag-area my-4" >
                    <div class="icon text-dark"><i class=" text-success fas fa-cloud-upload-alt"></i></div>                        
                    <center>
                        <!-- 
                        <header class="text-dark">Drag & Drop to Upload File</header>
                        <span class="text-dark">OR</span> -->
                        <button  class="text-dark" style="border: 1px solid #888;border-radius:5px;">Browse File</button>
                        <!-- <p>only excel file supported</p> -->
                        <input id="studentUpload" name="file" type="file" style="visibility: hidden;">
                    </center>                       
                </div>
                <div id="listFile" style="display:none;">                    
                    <div id="listFileContent">
                        
                    </div>
                    @include('layouts.paymentForm')
                    <div id="listFilex">
                        <button v-if="totalNumber > 0" type="submit" class="btn btn-primary">Pay & Continue</button>
                    </div>
                </div>
                
                </form>
            </div>
            <div btn-type="view" style="display:{{ $page!='view'?'none':'block' }};height:70vh;">
                <form method="get" action="{{route('mgt_institution_search')}}">
                    <div class="group-input row">
                        <div class="col-md-3">
                            <label>Institution:</label>                            
                            <select class="form-control ht4" name="institution_id"> 
                                @foreach($institutions  as $institution)                               
                                    <option value="{{$institution->id}}">{{$institution->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Session:</label> 
                            <select name="session_id" class="form-control ht4">
                                @foreach($sessions as $session)                               
                                    <option value="{{$session->id}}" {{ ($session->id == $selected_session)? 'selected':''}}>{{$session->name}}</option>
                                @endforeach
                            </select>                        
                        </div>
                        <div class="col-md-3">
                            <label>Search:</label> <input  type="text" class="form-control adx ht4" name="search"><br>
                        </div>
                        <div class="col-md-3" style="display: flex;justify-content:space-between;align-items:center;">                            
                            <button type="submit" class=" mt-2 btn btn-primary add ht4">Go</button>  
                            <div class="mt-2 mr-2">
                                {{$students->from}} - {{$students->to}} of {{$students->total}}
                                @if($students->prev_page_url != null)
                                <a  href="{{$students->prev_page_url}}" class="btn btn-primary fa fa-chevron-left" style="border-radius: 50% !important;"></a>    
                                @else
                                <button disabled class="btn btn-primary fa fa-chevron-left" style="border-radius: 50% !important;"></button>    
                                @endif

                                @if($students->next_page_url != null)
                                    <a href="{{$students->next_page_url}}" class="btn btn-primary fa fa-chevron-right" style="border-radius: 50% !important;"></a>    
                                @else
                                    <button disabled class="btn btn-primary fa fa-chevron-right" style="border-radius: 50% !important;"></button>    
                                @endif
                            </div>                      
                        </div>                        
                    </div>
                </form>
                <table class="table w-100" id="datatableX">
                        <thead>
                            <tr>
                                <td>Matric Number</td>
                                <td>Name</td>
                                <td>Phone Number</td>
                                <td>Email</td>
                                <td>Sex</td>
                                <td>Medical Histroy</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($students->data as $student)
                                <tr>
                                    <td>{{$student->matric_number}}</td>
                                    <td>{{$student->first_name .' '.$student->other_name .' '.$student->surname}}</td>
                                    <td>{{$student->phone_number}}</td>
                                    <td>{{$student->email_address}}</td>
                                    <td>{{$student->medical_history}}</td>
                                    <td>{{$data->name}}</td>
                                    <td>             
                                    <form action="{{route('delete_student')}}">
                                        <input type="text" name="id" hidden value="{{$student->id}}">                                                                                
                                        <input type="text" name="session_id" hidden value="{{$selected_session}}">                                                                                
                                        <button type="submit" class="btn btn-light"><span class="fa fa-times"></span></button>                                        
                                    </form>                                                                                  
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                 </table>
                   
            </div>
            <div btn-type="viewInvoices" style="display:{{ $page!='view'?'none':'block' }};height:70vh;">
                
            </div>
        </div>
    </div>
  


@endsection

@section('scripts_section')
    <script>        
    $(document).ready(function(){
        
        $("#datatableX").DataTable({
            "saveState":true,
            "lengthChange": false,
            "language": { search: "" },
            pageLength : 3,
            initComplete: function (settings, json) {                
                $("#datatableX_filter").find("input").addClass("form-control ht4").attr("placeholder","Search")
            }
        });
    })
        $(".panelBtn").on('click', function(){
            let type = $(this).attr('btn-type');
            document.cookie= `btn-type=${type}`;
            $('.adx').val('');
            $(".drag-area").show();
            $(".listFile").hide()   
            $(".btnPages >div").each(function(){                
                $(this).hide();
            })            
            $(".panelBtn").removeClass('active');
            $(this).addClass('active');
            $(`.btnPages > div[btn-type='${type}']`).show();
        })

        $('.updateBtn').on('click', function(){
            $('.btnPages >div[btn-type="edit"]').hide();
            let values = JSON.parse($(this).attr('data-value'));            
            $('.btnPages').find('div[btn-type="add"]').each(function(){                
                $(this).show();                
                let input = $(this).find('input');
                values.forEach((item, i)=>{
                    input[i].value = item
                });      
            })

        });
        function popMesage (msg){
            customAlert(msg);                                
            $("#studentUpload").val("");            
            return true
        }
let numberInSheet = 0;
var ExcelToJSON = function() {

this.parseExcel = function (file, callback) {
  var reader = new FileReader();

  reader.onload = function(e) {      
    var data = e.target.result;
    var workbook = XLSX.read(data, {
      type: 'binary'
    });
    var sheetsx = []
    workbook.SheetNames.forEach(function(sheetName) {
        sheetsx.push(sheetName)
    })       
    let sheetsname = "Sheet 1";        
    for(key in workbook.Sheets){
        sheetsname = key;
        break
    }     
            
    let Obj = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetsname],{ header: 1});
    let row1 = Obj[0];    
    let prevNumber = 0;
    let er = false;
    Obj.every((item , i)=>{
        if(i >0){
            if(typeof(item[0]) == undefined){
                er = popMesage("Invalid Content format: Row "+ (i +1) + " has no serial number");                
                return false;
            }else{              
                if(parseInt(item[0]) - parseInt(prevNumber) != 1 ){
                    er = popMesage("Invalid Content format: Row "+ (i +1) + " should be "+  (parseInt(prevNumber)+1))                    
                    return false;
                }
            }
            if(item[1].toLowerCase() !== selectedInstitution.toLowerCase()){
                er = popMesage("Invalid Content format: Row "+ (i +1) + " Institution must be "+ selectedInstitution)
                return false;
            }
            prevNumber +=1;       
        }
        return true;
    });
    if(er){
        return false;
    }
    numberInSheet = Obj.length-1;    
   if(  numberInSheet >3001 ){
        popMesage("maximum number of student is 3000, Number of Student is " + numberInSheet)        
        return false;
    }
    if(Obj.length < 2 ){
        popMesage("Cannot upload empty data" )
        return false;
    }
    let headers =["SN","Institution", "Matric_Number","Surname","First_Name","Other_Name","Department","Faculty","DOB","Phone_Number","Email_Address","Sex","Date_Admitted","Date_of_Graduation","Next_of_Kin_Name","Next_of_Kin_Address","Next_of_Kin_Phone_Number","Medical_History"];
    let error = false;
    headers.every((item, i) =>{        
        if(item != row1[i]){
            if(i != 0){                                
                error = popMesage("Invalid Content format: " +item + " column missing After '"+ headers[i-1]+ "' column" )
                return false
            }else{
                error = popMesage("Invalid Content format: "+ item + ' column missing');
                return false
            }
        }
        return true
    }); 
    
    if(error){
        return 0;
    }
    error = false;
    Obj.every((item,i)=>{
        if(i != 0){
            if(item[0] == undefined){
                error = popMesage("Row " + (i+1) + " matric_number Cannot be empty ");                                                
                return false
            }
            if(item[1] == undefined){
                error = popMesage("Row " + (i+1) + " first_name Cannot be empty ");                                                
                return false
            }
            if(item[2] == undefined){
                error = popMesage("Row " + (i+1) + " other_name Cannot be empty ");                                                
                return false
            }
            if(item[3] == undefined){
                error = popMesage("Row " + (i+1) + " surname Cannot be empty ");                                                
                return false
            }
            if(item[4] == undefined){
                error = popMesage("Row " + (i+1) + " department Cannot be empty ");                                                
                return false
            }
            if(item[5] == undefined){
                error = popMesage("Row " + (i+1) + " faculty Cannot be empty ");                                                
                return false
            }
        }
        return true;
    })
    if(error){
        return 0;
    }

    //check student payments

    $.ajax({
        url: '{{route("students_inventory_checker")}}',
        data:{obj:Obj,'_token':'{{csrf_token()}}', session_id: $("#session_id").val(),institution_id:$("#institution_id").val()},
        method: 'POST',
    }).done(function(res) {     
        //console.log(res)     
        numberInSheet = res.unpaid;
        var XL_row_object = XLSX.utils.sheet_to_html(workbook.Sheets[sheetsname]);
        //console.log(XL_row_object);
        callback(XL_row_object);
    })  

    //var json_object = JSON.stringify(XL_row_object.push({col:col}));        
    //console.log(XL_row_object)
    //return json_object;
   // console.log(XL_row_object)    
  };

  reader.onerror = function(ex) {
    console.log(ex);
  };

  reader.readAsBinaryString(file);
};

};
let amountToPay = 0;
function lisExceltContent(file){
    //console.log(file)
    
    var xl2json = new ExcelToJSON();      
    xl2json.parseExcel(file,function(res){
        Swal.fire("Verify Data and click continue");        
        $('.drag-area').hide()    
        $("#listFileContent").html(res)
        $("#listFile").show()
        $("#listFileContent table").addClass("table table-bordered")
        var vueItem = Vue.createApp({
            created(){
                store.commit('totalNumber', numberInSheet) //2000 is amount per student
            },
            computed: {
                totalNumber: function () {
                    return  store.getters.totalNumber
                },
            }

        });
        vueItem.mount("#listFilex");        
    });
}
const dropArea = document.querySelector(".drag-area"),
dragText = dropArea.querySelector("header"),
button = dropArea.querySelector("button"),
input = dropArea.querySelector("input");
let file; 
let selectedInstitution ="";
button.onclick = ()=>{
    event.preventDefault();
    if($("#session_id").val()==""){
        alert("Select Session");
        return 0;
    }
    if($("#institution_id").val()==""){
        alert("Select Institution");
        return 0;
    }
    selectedInstitution =  $( "#institution_id option:selected" ).text();
    input.click();
}

input.addEventListener("change", function(){
  //getting user select file and [0] this means if user select multiple files then we'll select only the first one
  file = this.files[0];
  dropArea.classList.add("active");
  showFile(); //calling function
});


//If user Drag File Over DropArea
/* dropArea.addEventListener("dragover", (event)=>{
  event.preventDefault(); //preventing from default behaviour
  dropArea.classList.add("active");
  dragText.textContent = "Release to Upload File";
}); */

//If user leave dragged File from DropArea
/* dropArea.addEventListener("dragleave", ()=>{
  dropArea.classList.remove("active");
  dragText.textContent = "Drag & Drop to Upload File";
}); */

/* dropArea.addEventListener("drop", (event)=>{
  event.preventDefault();
  file = event.dataTransfer.files[0];  
  showFile();

  
}); */

function showFile(){

  let fileType = file.type;   
  let validExtensions = ["text/csv"];   

  if(validExtensions.includes(fileType)){ 
    lisExceltContent(file)   
  }else{
    alert("This file is not Supported please Upload and Xls file !");
    dropArea.classList.remove("active");   
  }
}
    </script>

<style>
    .drag-area{
    border: 2px dashed #fff;  
    width:100%;
    border-radius: 5px;
    display: flex;  
    justify-content: center;
    align-items: center;
    }
    #listFileContent{
        height: 70%;
        overflow:scroll;
    }
    .drag-area.active{
    border: 2px solid #ddd;
    }
    .drag-area .icon{
    font-size: 100px;
    color: #fff;
    }
    .drag-area header{
    font-size: 30px;
    font-weight: 500;
    color: #fff;
    }
    .drag-area span{
    font-size: 25px;
    font-weight: 500;
    color: #fff;
    margin: 10px 0 15px 0;
    }
    .drag-area button{
    padding: 10px 25px;
    font-size: 20px;
    font-weight: 500;
    border: none;
    outline: none;
    background: #fff;
    color: #5256ad;
    border-radius: 5px;
    cursor: pointer;
    }
    .drag-area img{
    height: 100%;
    width: 100%;
    object-fit: cover;
    border-radius: 5px;
    }
    thead tr td{
        font-size: 0.9em !important;    
        border-bottom: 1px solid #77b7e7 !important;
        font-weight: 700;
        color: #77b7e7;
    }
    tr td{
        font-size: 0.9em !important;
        color: #666;
    }
    table{
        border-bottom:0px !important;
    }
    .ht4{
        height: 27px !important;
        padding: 4px 12px !important;
    }
</style>
@endsection
