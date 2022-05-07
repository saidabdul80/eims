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




	

	

	 $user_data = session()->get('user_data');

         $user_id = $user_data->id;

         $first_name = $user_data->first_name;

         



?>

@extends('layouts/master')

@section('content-body')





<div class="row">
    <div class="col-md-12">
        <div class="alert alert-info">
    Total to expire this month: {{$to_expire_this_month}} <br>
    Total to expire Next month: {{$to_expire_next_month}} <br>

</div>

@if($recipients != [])

    <div class="well well-sm" style="padding:20px;background:#fff !important">
        <div><h4>Message Status</h4></div>
         @foreach ($recipients as $recipient)
            <div class="panel panel-default">
                <div class="panel-heading">
                        Enrollee ID: {{$recipient->enrolment_number}}
                        <span class="pull-right">Recipient: {{$recipient->phone_number}}</span>
                   
                </div>
                <div class="panel-footer">
                    <b>Expiring Date: </b>{{$recipient->expired_date}} <br>
                    <b>SMS Status: </b>{{$recipient->status}} <br>
                    <b>Message Id: </b>{{$recipient->messageId}}
                </div>
            </div>
        @endforeach
    </div>

@endif

<h5>  LIST OF ENROLLEES WHOSE PREMIUM TO EXPIRE IN THREE MONTHS LATER ({{count($enrollees)}}) </h5>

<div class="">

<table id="table_id" class="display dataTable no-footer" style="font-size: 12px; " role="grid" aria-describedby="table_id_info">

<thead>
    <tr>

            <td class="text-center">SN</td>

             <td class="text-center">NAME</td>

              <td class="text-center">ENROLMENT NO.</td>

               <td class="text-center">SEX</td>
               <td class="text-center">ENROLMENT DATE</td>
               <td class="text-center">EXPIRATION DATE</td>

                <td class="text-center">PHONE</td>

                 <td class="text-center">LGA</td>

                 <td class="text-center">WARD</td>

                 <td class="text-center">ADDRESS</td>

        </tr>
</thead>
<tbody>

            @foreach ($enrollees as $enrollee)

                <tr id="row_{{$enrollee->id}}">

                    <td>{{($loop->index + 1)}}</td>

                    <td>{{$enrollee->surname.' '.$enrollee->first_name.' '.$enrollee->other_name}}</td>

                    <td>{{$enrollee->enrolment_number}}</td>
                    <td class="text-center">{{$enrollee->sex}}</td>
                    <td class="text-center"><b>{{date('d-m-Y', strtotime("".$enrollee->enrol_date.""))}}</b></td>
                    <td class="text-center"><b>{{date('d-m-Y', strtotime("".$enrollee->date_expired.""))}}</b></td>
                     <td class="text-center">{{$enrollee->phone_number}}</td>
                     <td class="text-center">{{lga_name($lgas, $enrollee->lga)}}</td>
                      <td class="text-center">{{ward_name($wards, $enrollee->ward)}}</td>
                    <td class="text-center"> {{$enrollee->address}}</td>

                </tr>

               

            @endforeach
</tbody>
    </table>
<hr>
<h4>Message: </h2>
<hr>
<div class="text-center">
    <form action="{{ route('premium.sendSms')}}" method="post" style="display: inline;" onsubmit="return confirm('If you proceed, you will be sending reminder to {{ count($enrollees) }} enrollees. Proceed? ')">
    {{ csrf_field() }}
    <button type="submit" class="btn btn-sm btn-primary " name="send-message" value="send-message"><i class="fa fa-envelope" style="color:#FFF"></i>&nbsp;Send reminder to all enrollees</button>
    </form>
   &nbsp;&nbsp; |&nbsp;&nbsp;
     <a href="{{route('premium.message_history')}}" class="btn btn-sm btn-success "><i class="fa fa-file" style="color:#FFF"></i>&nbsp;Message History</a>
</div>
    <hr>

   

</div>
    </div>
</div>

   @include('layouts.modal')

@endsection

@section('scripts_section')

<script>


</script>



@endsection