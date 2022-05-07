
<?php
 use App\Provider;
 use Illuminate\Support\Facades\DB;
    
	
    $all_providers = Provider::where('hcpenrollee','Both')->orWhere('hcpenrollee','Nicare')->get()->count();
    $year = date('Y');
    $caps = DB::Select("Select cg.month, SUM(c.total_cap) total FROM capitations c 
        INNER JOIN capitation_grouping cg 
        ON c.group_id = cg.id
        WHERE cg.year = ? AND c.status = '1' GROUP BY month ORDER BY month
    ",[$year]);

    if(date('m') == 12){
        $next_month = 1;
    }else{
        $next_month = date('m') + 1;
    }

    
    

    $caps_month = [];

    $months = [
        1 => ['name' => 'January' , 'cap'=> 0],
        2 => ['name' => 'February' , 'cap'=> 0],
        3 => ['name' => 'March' , 'cap'=> 0],
        4 => ['name' => 'April' , 'cap'=> 0],
        5 => ['name' => 'May' , 'cap'=> 0],
        6 => ['name' => 'June' , 'cap'=> 0],
        7 => ['name' => 'July' , 'cap'=> 0],
        8 => ['name' => 'August' , 'cap'=> 0],
        9 => ['name' => 'September' , 'cap'=> 0],
        10 => ['name' => 'October' , 'cap'=> 0],
        11 => ['name' => 'November' , 'cap'=> 0],
        12 => ['name' => 'December' , 'cap'=> 0],
    ];
  
//dd($months[intval(date('0002'))]['cap']);
  
    foreach ($caps as $key => $cap) {
		$months[$cap->month]['cap'] = $cap->total;
    }
  
    $all = $data['all'];
    $all_enrollees = count($all);
    $huwe_enrollees = collect($all)->where('mode_of_enrolment', 'huwe')->count() +  collect($all)->where('mode_of_enrolment', 'Huwe')->count();
    $nicare_enrollees_list = collect($all)->where('mode_of_enrolment', 'Premium')->all();
    $nicare_enrollees = count($nicare_enrollees_list);
    $formal_enrollees_male = collect($nicare_enrollees_list)->where('sex', 'Male')->count();
    $formal_enrollees_female = collect($nicare_enrollees_list)->where('sex', 'Female')->count();
    $formal_enrollees = collect($nicare_enrollees_list)->where('enrolee_type', 'Formal')->count();
    $informal_enrollees = collect($nicare_enrollees_list)->where('enrolee_type', 'Informal')->count();
    $next_month_cap = $nicare_enrollees * 360;

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
<?php echo $__env->make('layouts/master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\AshlabTech\Desktop\projects\nicare-eims\resources\views/home.blade.php ENDPATH**/ ?>