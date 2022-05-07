
<?php
$caps_month = [];

$months = [
    1 => ['name' => 'January' , 'nicare_cap'=> 0, 'bhcpf_cap'=> 0],
    2 => ['name' => 'February' , 'nicare_cap'=> 0, 'bhcpf_cap'=> 0],
    3 => ['name' => 'March' , 'nicare_cap'=> 0, 'bhcpf_cap'=> 0],
    4 => ['name' => 'April' , 'nicare_cap'=> 0, 'bhcpf_cap'=> 0],
    5 => ['name' => 'May' , 'nicare_cap'=> 0, 'bhcpf_cap'=> 0],
    6 => ['name' => 'June' , 'nicare_cap'=> 0, 'bhcpf_cap'=> 0],
    7 => ['name' => 'July' , 'nicare_cap'=> 0, 'bhcpf_cap'=> 0],
    8 => ['name' => 'August' , 'nicare_cap'=> 0, 'bhcpf_cap'=> 0],
    9 => ['name' => 'September' , 'nicare_cap'=> 0, 'bhcpf_cap'=> 0],
    10 => ['name' => 'October' , 'nicare_cap'=> 0, 'bhcpf_cap'=> 0],
    11 => ['name' => 'November' , 'nicare_cap'=> 0, 'bhcpf_cap'=> 0],
    12 => ['name' => 'December' , 'nicare_cap'=> 0, 'bhcpf_cap'=> 0],
];

//dd($months[intval(date('0002'))]['cap']);

$this_month_cap_nicare = 0;
$this_month_cap_bhcpf = 0;
// foreach ($data['caps'] as $key => $cap) {

  
//     $months[$cap->month]['nicare_cap'] = $cap->nicare_total * 360;
//     $months[$cap->month]['bhcpf_cap'] = $cap->bhcpf_total * 570;
  
    
// }

foreach ($data['caps'] as $key => $cap) {
    $months[$cap->month]['nicare_cap'] = $cap->total_cap;

}

foreach ($data['caps_bhcpf'] as $key => $cap) {
    $months[$cap->month]['bhcpf_cap'] = $cap->total_cap;

}

?>
@extends('layouts/master')


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  



@section('content-body')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    @if (session()->exists('welcome'))
        <hr/> <div class="alert alert-success"> {{ session('welcome')}} </div>
        
    @endif
    <div class="viewer-plain"></div>
    <div class="container" style="width:100%;">
	<div class="row">
	    <br/>
	   
		
             
		
	</div>
    @include('nicare_dashboard_top_figures')
</div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-lg-8">
             @include('nicare_dashboard_charts')
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
               @include('nicare_dashboard_summary_reports')
        </div>
    </div>
   
@endsection
@section('scripts_section')
<script>

    getId('total_enrollees').innerText = all.length;
</script>

@endsection


<script>
$(document).ready(function(){
    $('.twoData').hide('slow');
})
</script>