<?php
use Illuminate\Support\Facades\Auth;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>::NiCare EIMS <?php echo $__env->yieldContent('page-title'); ?></title>
    
   <?php echo $__env->make('layouts.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                <p class="well well-sm" style="padding:2px"><a href="/home"> <span style="float: right;"><?php echo e(!empty(session('user_data')) ? 'Logged In ['.session('user_data')->first_name.']' : 'Session Timeout'); ?></span> Go back home</a></p>
                <?php echo $__env->yieldContent('content-body'); ?>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php echo $__env->make('layouts.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
        <?php echo $__env->yieldContent('scripts_section'); ?>
    </div>

</body>
</html><?php /**PATH /home3/ngschdqn/eims.ngscha.ni.gov.ng/resources/views/layouts/dashboard_master.blade.php ENDPATH**/ ?>