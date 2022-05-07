<?php
$sn = 0;
?>

@extends('layouts/master')
@section('breadcrumb','Manage Providers')
@section('content-body')
    
    @if (session()->exists('welcome'))
        <hr/> <div class="alert alert-success"> {{ session('welcome')}} </div>
    @endif
    <div class="row bg-white" style="width: 100%; min-height: 500px; padding: 10px; margin: 0px;">      
	    <div class="row" style="margin:0; width: 100%;height: 93px;padding: 0px;">
			<div class="col-md-6 col-sm-6 col-xs-12" style="">
				<ul class="features-left shadow-1 pd-4 b-round" style="margin:0; height: 90px;">
					<li class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInLeft;">
						<a href="sa.new_provider.php">
						<i class="fa fa-plus"></i>
						<div class="fl-inner">
		<!-- 					<h4>New User</h4> -->
							<p>Add New Provider </p>
						</div>
						</a>
					</li>

				</ul>
			</div>

			<div class="col-md-6 col-sm-6 col-xs-12">
				<ul class="features-right shadow-1 pd-4 b-round" style="margin:0;height: 90px;">
					<li class="wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInRight;">
						<a href="#">
						<i class="fa fa-search"></i>
						<div class="fr-inner">
							<!-- <h4>Providers Overview </h4> -->
							<p><input type="text" class="form-control" placeholder="Search Provider"> </p>
						</div>
						</a>
					</li>


				</ul>
			</div><!-- end col -->
		</div>
	    <div>
	    	<table id="table_id" class="display dataTable no-footer" style="font-size: 12px; width: 911px;" role="grid" aria-describedby="table_id_info">
				<thead>
					<tr role="row">
						<td class="sorting_asc" tabindex="0" aria-controls="table_id" rowspan="1" colspan="1" aria-sort="ascending" aria-label="SN: activate to sort column descending" style="width: 20px;">SN</td>
						<td class="sorting" tabindex="0" aria-controls="table_id" rowspan="1" colspan="1" aria-label="HCPNAME: activate to sort column ascending" style="width: 140px;">HCPNAME</td>
						<td class="sorting" tabindex="0" aria-controls="table_id" rowspan="1" colspan="1" aria-label="HCPCODE : activate to sort column ascending" style="width: 94px;">HCPCODE </td>
						<td class="sorting" tabindex="0" aria-controls="table_id" rowspan="1" colspan="1" aria-label="LGA: activate to sort column ascending" style="width: 67px;">LGA</td>
						<td class="sorting" tabindex="0" aria-controls="table_id" rowspan="1" colspan="1" aria-label="WARD: activate to sort column ascending" style="width: 121px;">WARD</td>
						<td class="sorting" tabindex="0" aria-controls="table_id" rowspan="1" colspan="1" aria-label="ENROLLEE: activate to sort column ascending" style="width: 154px;">ENROLLEE</td>
						<td class="sorting" tabindex="0" aria-controls="table_id" rowspan="1" colspan="1" aria-label=": activate to sort column ascending" style="width: 63px;"></td>
					</tr>
				</thead>
				<tbody>

				@foreach($providers as $provider)
					<tr>
						<td>{{$loop->index + 1}}</td>
						<td>{{$provider->hcpname}}</td>
						<td>{{$provider->hcpcode}}</td>
						<td>{{$provider->lga}}</td>
						<td>{{$provider->ward}}</td>
						<td></td>
						<td>
							<a href="{{ route('provider.view', [$provider->id] )}}" class="btn btn-sm btn-info"> <i class="fa fa-eye" style="color:aliceblue"></i></a>
							<a href="{{ route('provider.edit', [$provider->id] )}}" class="btn btn-sm btn-info"> <i class="fa fa-edit" style="color:aliceblue"></i></a>
						</td>
					</tr>

				@endforeach
				</tbody>
			</table>
	    </div>
    </div>
@endsection
