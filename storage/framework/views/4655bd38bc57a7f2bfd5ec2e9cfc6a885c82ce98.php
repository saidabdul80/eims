
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



<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  



<?php $__env->startSection('content-body'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <?php if(session()->exists('welcome')): ?>
        <hr/> <div class="alert alert-success"> <?php echo e(session('welcome')); ?> </div>
        
    <?php endif; ?>
    <div class="viewer-plain"></div>
    <div class="container" style="width:100%;">
	<div class="row">
	    <br/>
	   
		
             
		
	</div>
    <?php echo $__env->make('nicare_dashboard_top_figures', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-lg-8">
             <?php echo $__env->make('nicare_dashboard_charts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
               <?php echo $__env->make('nicare_dashboard_summary_reports', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
   
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts_section'); ?>
<script>

    getId('total_enrollees').innerText = all.length;
</script>

<?php $__env->stopSection(); ?>


<script>
$(document).ready(function(){
    $('.twoData').hide('slow');
})
</script>
<?php echo $__env->make('layouts/master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\Desktop\eims.ngscha.ni.gov.ng\resources\views/home.blade.php ENDPATH**/ ?>