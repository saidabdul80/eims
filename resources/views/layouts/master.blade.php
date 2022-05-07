<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>::NiCare EIMS @yield('page-title')</title>
    
   @include('layouts.head')
</head>
<body>
@include('header')
<div class="container-fluid">
<div class="row">
        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs">
            <div id="side-menu">
                <hr/>
                
                @include('layouts.sidemenu')
            </div>
        </div>
        <div class="col-lg-9 ">
              <div class="w3-card" style="padding:20px">
            <br><br>
                <div id="content-body">
                <!--@include('layouts.breadcrumb')-->
                @yield('content-body')
                </div>
            </div>
        </div>
    </div>
    </div>
    @include('layouts.scripts')

    <script>
    $(document).ready( function () {
        $('#table_id').DataTable();
       // $('.table').DataTable();
    } );
/*$('.datepicker').datepicker({
     format: 'mm-dd-yyyy',
    startDate: '-3d'
});*/
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    
    function load_user_ward(lga_id){
        var options = '';
        wards.forEach(ward =>{
            if(ward.lga_id == lga_id){
                options += '<option value="'+ward.id+'">'+ward.ward+'</option>';
            }
        })
        
        $('#ward').html(options);
    }
    
    function load_user_ward2(lga_id){
        var options = '';
        wards.forEach(ward =>{
            if(ward.lga_id == lga_id){
                options += '<option value="'+ward.id+'">'+ward.ward+'</option>';
            }
        })
        
        $('#ward2').html(options);
    }
    
    function load_user_provider(hcpward){
        var options = '';
        providers.forEach(provider =>{
            if(provider.hcpward == hcpward){
                options += '<option value="'+provider.id+'">'+provider.hcpname+'</option>';
            }
        })
        
        $('#provider').html(options);
    }
</script>
    <div>
        @yield('scripts_section')
    </div>

</body>
</html>