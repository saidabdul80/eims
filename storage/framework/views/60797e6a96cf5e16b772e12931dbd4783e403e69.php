<?php

use App\Lga;
use App\Ward;
use App\Provider;

require('phpqrcode/qrlib.php');




$lgas = Lga::all();
$wards = Ward::all();
$providers = Provider::all();


function lga_name($lgas, $id)
{
    foreach ($lgas as $key => $lga) {
        if ($lga['id'] == $id) {
            return $lga['lga'];
        }
    }
}


function ward_name($wards, $id)
{
    foreach ($wards as $key => $ward) {
        if ($ward['id'] == $id) {
            return $ward['ward'];
        }
    }
}


function provider_name($providers, $id)
{
    foreach ($providers as $key => $provider) {
        if ($provider['id'] == $id) {
            return $provider['hcpname'];
        }
    }
}


$sn = 0;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrolment Slip</title>

    <!-- Site Icons -->
    <link rel="shortcut icon" href="<?php echo e(asset('images/favicon.ico')); ?>" type="image/x-icon" />
    <link rel="apple-touch-icon" href="<?php echo e(asset('images/logo.png')); ?>">

    <!-- Bootstrap CSS -->

    <!-- Site CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('CSS/bootstrap4.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('styles2.css')); ?>">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/responsive.css')); ?>">
    <!-- Custom CSS -->

    <link rel="stylesheet" href="<?php echo e(asset('wow/css/animate.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('SA_swift/css/SA_swifter.css')); ?>">

    <script type="text/javascript" src="<?php echo e(asset('js/jquery-3.1.1.min.js')); ?>"></script>

    <link href="<?php echo e(asset('css/datatable.css')); ?>" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <script type="text/javascript" src="<?php echo e(asset('js/jquery-3.1.1.min.js')); ?>"></script>
    <scrip type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
        </script>
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />

        <style>
            
            .card{
                margin: 20px;
            }
        </style>
</head>

<body>

    <div id="body-wrap">
        <div id="button-area">
            <?php if(count($enrollees) > 0): ?>
            <p>
                <button class="btn btn-lg btn-primary" onclick="ClickheretoprintDiv('printable-area')">
                    Print Enrolment Slips
                </button>
            </p>
            <?php else: ?>
            <h4 class="text-center">No Record is found!</h4>
            <?php endif; ?>
        </div>

        <div id="printable-area">

            <?php $__currentLoopData = $enrollees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enrollee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
            $sn++;

            ?>

            <?php if(($loop->index % 2) == 0): ?>
            <table width="90%">
                <tr>
                    <?php endif; ?>
                    <td width="50%">
                        <?php echo $__env->make('enrolment.slip.slip_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </td>

                    <?php
                    $sn = ($sn == 2 ? 0 : $sn);
                    ?>
                    <?php if(($sn) == 0): ?>
                </tr>
            </table>
            <?php endif; ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </div>
</body>

<!-- ALL JS FILES -->
<script src="<?php echo e(asset('js/jquery-3.1.1.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/all.js')); ?>"></script>




<!-- ALL PLUGINS -->
<script src="<?php echo e(asset('wow/js/wow.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/custom.js')); ?>"></script>
<script src="<?php echo e(asset('js/portfolio.js')); ?>"></script>
<script src="<?php echo e(asset('js/hoverdir.js')); ?>"></script>
<!--<script type="text/javascript" src="js/actions.js"></script>-->
<script src="<?php echo e(asset('js/datatable.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/app.js')); ?>"></script>

<script type="text/javascript" src="<?php echo e(asset('js/ees.script.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('SA_swift/js/SA_swifter.js')); ?>"></script>

<script type="text/javascript" src="<?php echo e(asset('js/chart.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('aos/aos.js')); ?>"></script>

<script>
    function getId(x) {
        return document.getElementById(x);
    }


    $(document).load(function() {
        ClickheretoprintDiv('printable-area');
        $('.twoData').hide();

    });

    function ClickheretoprintDiv(div_id) {
        var disp_setting = "toolbar=yes,location=no,directories=yes,menubar=yes,";
        disp_setting += "scrollbars=yes,width=800, height=400, left=100, top=25";
        var content_vlue = document.getElementById(div_id).innerHTML;

        var docprint = window.open("", "", disp_setting);
        docprint.document.write('<html><head><title>.::Nicare</title> <link rel="stylesheet" href="../css/bootstrap.min.css">');
        docprint.document.write('</head><body onLoad="self.print()" style="width: 900px; height="auto" font-size:16px; font-family:arial;">');
        docprint.document.write(content_vlue);
        docprint.document.write('</body></html>');
        docprint.document.close();
        docprint.focus();
    }
</script>

</html><?php /**PATH C:\Users\AshlabTech\Desktop\projects\nicare-eims\resources\views/enrolment/slip/print_bulk_enrolment_slip.blade.php ENDPATH**/ ?>