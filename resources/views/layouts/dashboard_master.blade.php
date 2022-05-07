<?php
use Illuminate\Support\Facades\Auth;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>::NiCare EIMS @yield('page-title')</title>
    
   @include('layouts.head')
   <style>
   .borderb{
       margin-left: 5px;
   }
    .card {
  /* Add shadows to create the "card" effect */
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  padding: 10px 20px;
}

/* On mouse-over, add a deeper shadow */
.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}
   </style>
</head>
<body>
<div class="container-fluid">

<div class="row">
       
        <div class="col-md-12 col-lg-12 ">
              <div class="w3-card" style="padding:20px">
                <div id="content-body">
                <p class="well well-sm" style="padding:2px"><a href="/home"> <span style="float: right;">{{!empty(session('user_data')) ? 'Logged In ['.session('user_data')->first_name.']' : 'Session Timeout'}}</span> Go back home</a></p>
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