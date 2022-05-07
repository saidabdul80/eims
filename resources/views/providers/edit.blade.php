<?php
$sn = 0;

$provider = $data['provider'];
$lgas = $data['lgas'];
$wards = $data['wards'];

$hcpcategory = $provider->hcpcategory;
$hcptype = $provider->hcptype;
$hcplga = $provider->hcplga;
$hcpward = $provider->hcpward;
$serviceClaimType = $provider->serviceClaimType;

?>

@extends('layouts/master')
@section('breadcrumb','Edit Provider')
@section('content-body')
    
   
    <div class="row bg-white" >      
	    <div class="col-xs-12 col-sm-12 col-md-12 col-lg 12">
        @include('layouts.error_success_message')
                @include('providers._provider_form')
		</div>
	    <div>
	    	
	    </div>
    </div>


<script>
var wards = <?= json_encode($wards); ?>;

function load_ward_by_lga(lga){
    let opt = '';
    wards.forEach(ward => {
        if(ward.lga_id == lga){
            opt +='<option value="'+ward.id+'">'+ward.ward+'</option>';
        }

        $('#ward').html(opt);
    });
}


</script>
@endsection
