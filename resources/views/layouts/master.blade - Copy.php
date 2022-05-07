<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>::NiCare EIMS @yield('page-title')</title>
    
   @include('layouts.head')
   
</head>
<body>
@include('header')
<div class="container-fluid">
<br>
<div class="row">
        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs">
            <div id="side-menu">
                <hr/>    
                @include('layouts.sidemenu')
            </div>
        </div>
        <div class="col-md-9 col-lg-9 ">
              <div class="w3-card" style="padding:20px">
                <div id="content-body">
               
                @yield('content-body')
                </div>
            </div>
        </div>
    </div>
</div>
    @include('layouts.scripts')

    <script>
    $(document).ready( function () {

        setTimeout(function() {
            $('.twoData').hide();
            AOS.init();
        }, 1000);
        
        $('#table_id').DataTable();
    } );

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
    <div>
        @yield('scripts_section')
    </div>

</body>
</html>