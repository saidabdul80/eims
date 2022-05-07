<?php
$sn = 0;



?>

@extends('layouts/master')
@section('breadcrumb','Edit Provider')
@section('content-body')
    
   
    <div class="row bg-white" >      
	    <div class="col-xs-12 col-sm-12 col-md-12 col-lg 12">
        @include('layouts.error_success_message')
                @include('providers._provider_view')
		</div>
	    <div>
	    	
	    </div>
    </div>



@endsection
