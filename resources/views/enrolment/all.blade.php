<?php
use App\Lga;
use App\Ward;
use App\Provider;



    $lgas = Lga::all();
    $wards = Ward::all();
    $providers = Provider::all();


   function lga_name($lgas, $id){
        foreach ($lgas as $key => $lga) {
            if($lga['id'] == $id){
                return $lga['lga'];
            
            }   
        }
   }


   function ward_name($wards, $id){
    foreach ($wards as $key => $ward) {
        if($ward['id'] == $id){
            return $ward['ward'];
        
        }
    }
}


function provider_name($providers, $id){
    foreach ($providers as $key => $provider) {
        if($provider['id'] == $id){
            return $provider['hcpname'];
        
        }   
    }
}

?>
@extends('layouts/master')
@section('content-body')

  <br/>
  <br/>
<div class="container">
    <table class="table table-bordered table-stripped">
            <tr>
                <th>SN</th>
                <th>NAME</th>
                <th>ENROLMENT NUMBER</th>
                 <th>ENROLEE TYPE</th>
                 <th>ENROLEE GROUP</th>
                 <th>GENDER</th>
                 <th>LGA</th>
                 <th>WARD</th>
                 <th></th>
                
            </tr>
            @foreach ($enrollees as $enrollee)
                <tr>
                    <td>{{($loop->index + 1)}}</td>
                    <td>{{$enrollee->surname.' '.$enrollee->first_name.' '.$enrollee->other_name}}</td>
                    <td>{{$enrollee->enrolment_number}}</td>
                    <td>{{$enrollee->enrolee_type}}</td>
                    <td>{{$enrollee->enrolee_category}}</td>
                    <td>{{$enrollee->sex}}</td>
                    <td>{{lga_name($lgas, $enrollee->lga)}}</td>
                    <td>{{ward_name($wards,$enrollee->ward)}}</td>
                    <td class="text-center" >
                        <button class="btn btn-info" title="View Enrolment Detials" onclick="load_enrollee_info({{$enrollee->id}})"><i class="fa fa-eye" style="color:#fff"></i></button>
                        <button class="btn btn-primary" title="Update Record" onclick="load_edit_enrollee_info({{$enrollee->id}})"><i class="fa fa-edit" style="color:#fff"></i></button>
                         <a href="{{route('enrolment.idcard',[base64_encode(base64_encode(base64_encode($enrollee->id)))])}}" target="_BLANK" class="btn btn-success" title="IdCard"><i class="fa fa-print" style="color:#fff"></i></a>
                    </td>
                </tr>
               
            @endforeach
    </table>
    {{ $enrollees->links() }}
   
</div>
   @include('layouts.modal');
@endsection
@section('scripts_section')
<script>
function update_enrollee_info(event){
    event.preventDefault();
    //window.history.back();
    $('#feedback').html('<p style="color:red">Saving....</p>');
   
    $.ajax({
         type: 'POST',
         url:  "/update-enrollee-info",
         data : $('#edit_enrolee_form_admin').serialize() + "&_token={{csrf_token()}}",
         //data:  {id:id, _token:'{{csrf_token()}}' },
         success: function(data){
             if(data.status == 200)
                 $('#feedback').html('<p class="alert alert-success">'+data.message+'</p>');
            else
                 $('#feedback').html('<p class="alert alert-danger">'+data.message+'</p>');

            },
         error: function(data){
            
             console.log(data);
         }
     })

     
}




function load_edit_enrollee_info(id){
        $('#myModal').modal('show');
        $('#modal-footer').hide('slow');
        $.ajax({
         type: 'POST',
         url:  "/load-edit-enrollee-info",
         data:  {id:id, _token:'{{csrf_token()}}' },
         success: function(data){
            
               $('#modal-content').html(data.html);
             },
         error: function(data){
            
             console.log(data);
         }
     })

     
    }


    function load_enrollee_info(id){
        let biometric = false;
        $('#myModal').modal('show');
        $('#modal-footer').show('slow');
        $.ajax({
         type: 'POST',
         url:  "/load-enrollee-info",
         data:  {id:id,biometric:biometric, _token:'{{csrf_token()}}' },
         success: function(data){
             
               $('#modal-content').html(data.html);
             },
         error: function(data){
            
             console.log(data);
         }
     })

     
    }
 
</script>

@endsection