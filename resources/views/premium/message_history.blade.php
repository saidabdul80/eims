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
     



<h5>  Message History</h5>

<div class="">

<table id="table_id" class="display dataTable no-footer" style="font-size: 12px; " role="grid" aria-describedby="table_id_info">

<thead>
    <tr>

            <td class="text-center">SN</td>

             <td class="text-center">ENROLLEE ID</td>

              <td class="text-center">PHONE</td>

               <td class="text-center">MESSAGE</td>
               <td class="text-center">DATE</td>
               <td class="text-center">STATUS</td>

        </tr>
</thead>
<tbody>

            @foreach ($messages as $message)

                <tr id="row_{{$message->id}}">

                    <td>{{($loop->index + 1)}}</td>

                    <td>{{$message->enrollee_id}}</td>
                    <td>{{$message->recipient}}</td>
                    <td>{{$message->message}}</td>
                    <td>{{date('d M, Y H:i:s A', strtotime(''.$message->created_at.''))}}</td>
                    <td>{{$message->status}}</td>

                </tr>

               

            @endforeach
</tbody>
    </table>
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