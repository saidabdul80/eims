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

function finger_text($finger){
		if(empty($finger) || $finger==null){
			$status = '<span class="bg-danger">Absent</span>';
		}else{
			$status = '<span class="bg-success">Present</span>';
		}
		
		echo $status;
	}
	
	
	 $user_data = session()->get('user_data');
         $user_id = $user_data->id;
         $first_name = $user_data->first_name;
         

?>
@extends('layouts/master')
@section('content-body')


<div class="well well-sm">
   
      <h5> Recapture List:</h5>
       
    
</div>
<p class="text-right"> <a href="{{route('enrolment.enrolment-approval')}}" class="btn btn-sm btn-primary"> Back to Approval Page </a></p>
  <br/>
  <br/>
<div class="container">
    <table class="table table-bordered table-stripped" border="2">
        <tr>
            <td class="text-center">SN</td>
             <td class="text-center">NAME</td>
              <td class="text-center">ENROLMENT NO.</td>
               <td class="text-center">SEX</td>
                <td class="text-center">PHONE</td>
                 <td class="text-center">COMMENT</td>
                 <td class="text-center">LGA</td>
                 <td class="text-center">WARD</td>
                 <td class="text-center">VILLAGE</td>
                 <td class="text-center">ADDRESS</td>
        </tr>
            @foreach ($enrollees as $enrollee)
                <tr id="row_{{$enrollee->id}}">
                    <td>{{($loop->index + 1)}}</td>
                    <td>{{$enrollee->surname.' '.$enrollee->first_name.' '.$enrollee->other_name}}</td>
                    <td>{{$enrollee->enrolment_number}}</td>
                    <td class="text-center">{{$enrollee->sex}}</td>
                    <td class="text-center">{{$enrollee->phone_number}}</td>
                    <td class="text-center" > {{$enrollee->approval_comment}}</td>
                    
                    <td class="text-center">{{lga_name($lgas, $enrollee->lga)}}</td>
                    <td class="text-center">{{ward_name($wards, $enrollee->ward)}}</td>
                    <td class="text-center">{{$enrollee->village}}</td>
                    
                    <td class="text-center"> {{$enrollee->address}}</td>
                </tr>
               
            @endforeach
    </table>
    
   
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




function approve_reject_enrolment(id, enrolment_approval_status){
    let proceed = false;
    let approval_comment = $('#approval_comment').val();
    let reject_reason = '';
      /*  if(enrolment_approval_status == 1){
            proceed = confirm('Are you sure you want to approve the ennrolment?')
        }else{
            proceed = confirm('Are you sure you want to reject the ennrolment?')
            if(proceed){
                reject_reason = prompt('Reason for rejecting the enrolment:');
                console.log(reject_reason)
                if(reject_reason == null){
                    alert('Sorry cannot continue without specifying reason for rejeceting the enrolment')
                    proceed = false
                }
            }
        }
    
        if(proceed){
            */
        
        if(enrolment_approval_status == '2' && approval_comment == 'None'){
            alert('Please select Biometric Issue')
        }else{
             $.ajax({
             type: 'POST',
             url:  "/approve-reject-enrolment",
             data:  {id:id,enrolment_approval_status:enrolment_approval_status,reject_reason:reject_reason,approval_comment:approval_comment, _token:'{{csrf_token()}}' },
             success: function(data){
                
                    alert(data.message)
                    if(enrolment_approval_status == 1){
                        $('#approve_btn').attr('disabled','disabled')
                        $('#reject_btn').attr('disabled',false)
    
                        $('#approve_btn_'+id).attr('disabled','disabled')
                        $('#reject_btn_'+id).attr('disabled',false)
                        
                         $('#row_'+id).css('color','green');
                    }else{
                        $('#approve_btn').attr('disabled',false)
                        $('#reject_btn').attr('disabled','disabled')
    
                        $('#approve_btn_'+id).attr('disabled',false)
                        $('#reject_btn_'+id).attr('disabled','disabled')
                        $('#row_'+id).css('color','red');
                    }
                    
                    $('#approve_btn_'+id).attr('disabled','disabled')
                   $('#reject_btn_'+id).attr('disabled','disabled')
                 },
             error: function(data){
                
                 console.log(data);
             }
         })
        }
        
        
       
       
   // }
}


    function load_enrollee_info(id){
        
        $('#myModal').modal('show');
        $('#modal-footer').hide('slow');
        $('#modal-content').html('<h2 class="text-center text-danger">Loading Enrollee Info.,Please wait...</h2>');
        $.ajax({
         type: 'POST',
         url:  "/load-enrollee-info-with-biometric",
         data:  {id:id, _token:'{{csrf_token()}}' },
         success: function(data){
           
               $('#modal-content').html(data.html);
             },
         error: function(data){
            
             console.log(data);
         }
     })

     
    }
    
    
    function load_edit_enrollee_info(id){
        $('#myModal2').modal('show');
        $('#modal-footer2').hide('slow');
        $.ajax({
         type: 'POST',
         url:  "/load-edit-enrollee-info",
         data:  {id:id, _token:'{{csrf_token()}}' },
         success: function(data){
            
               $('#modal-content2').html(data.html);
             },
         error: function(data){
            
             console.log(data);
         }
     })

     
    }
 
</script>

@endsection