<?php
use App\Lga;
use App\Ward;
use App\Provider;


    $providers = Provider::all();


    


function provider_name($providers, $id){
    foreach ($providers as $key => $provider) {
        if($provider['id'] == $id){
            return $provider['hcpname'];
        
        }   
    }
}







    $groups = $data['groups'];
    $all_groups = $data['all_groups'];
    
    $sn=1;
?>
@extends('layouts/master')
@section('content-body')
<br>
<br>
<br>


        <div class="row">
            <div class="col-md-12 col-lg-12">
                
                <table class="table table-stripped table-bordered">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>YEAR</th>
                            <th>CAPITATION</th>
                            <th>CAPITATED MONTH</th>
                            <th>PROVIDERS</th>
                            <th>TOTAL ENROLLEES</th>
                            <th>AMOUNT</th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                         
                            @foreach($all_groups as $group)
                            
                            <?php
                                $provider_total = 0;
                                $total_enrolee = 0;
                                $cap_total = 0;
                                $group_info =  collect($groups)->where('group_id', $group->id)->first();
                                
                                if(!empty($group_info)){
                                    $provider_total = $group_info->provider_total;
                                    $cap_total = $group_info->cap_total;
                                    $total_enrolee = $group_info->total_enrolee;
                                }
                            ?>
                            @if(!empty($group_info))
                            <tr>   
                            <td>{{$sn++}}</td>
                            <td>{{$group->year}}</td>
                            <td>{{$group->month_full}}</td>
                            <td>{{$group->name}}</td>
                            <td class="text-center">{{$provider_total}}</td>
                            <td class="text-center">{{$total_enrolee}}</td>
                            <td class="text-center">&#8358;{{number_format($cap_total)}}</td>
                           
                            <td><a href="{{ route('capitation.approve-capitation-info',[$group->id])}}" class="btn btn-sm btn-primary">View Cap File</a></td>
                            </tr>
                            @endif
                            @endforeach
                            
                        
                    </tbody>
                </table>
            </div>
            
        </div>
   @include('layouts.modal')
@endsection
@section('scripts_section')
<script>

    function load_cap_months(year){
        $.ajax({
         type: 'POST',
         url:  "/load-cap-months",
         data:  {year:year, _token:'{{csrf_token()}}' },
         success: function(data){
                $('#cap_month').html(data);
               
             },
         error: function(data){
            
             console.log(data);
         }
     })
    }
</script>


@endsection