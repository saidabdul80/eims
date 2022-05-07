<?php
use App\Lga;
use App\Ward;
use App\Provider;


    $providers = Provider::all();


    function get_full_month($mth){
        $months_array = months_array();
        
        foreach($months_array as $key => $month){
             $month_db = $month["month"];
                $month_db_full = $month["month_full"];
             if($mth == $month_db){
                 return $month_db_full;
             }	
        }
        return '';
    }
    
    function months_array(){
        return [
            ['month'=> 1, 'month_full'=> 'January'],
            ['month'=> 2, 'month_full'=> 'February'],
            ['month'=> 3, 'month_full'=> 'March'],
            ['month'=> 4, 'month_full'=> 'April'],
            ['month'=> 5, 'month_full'=> 'May'],
            ['month'=> 6, 'month_full'=> 'June'],
            ['month'=> 7, 'month_full'=> 'July'],
            ['month'=> 8, 'month_full'=> 'August'],
            ['month'=> 9, 'month_full'=> 'September'],
            ['month'=> 10, 'month_full'=> 'October'],
            ['month'=> 11, 'month_full'=> 'November'],
            ['month'=> 12, 'month_full'=> 'December']
        ];
    }
    


function provider_name($providers, $id){
    foreach ($providers as $key => $provider) {
        if($provider['id'] == $id){
            return $provider['hcpname'];
        
        }   
    }
}






$current_year = date('Y');
$year = $current_year;
$current_month = date('m');
$previous_year = $current_year - 1;
$next_year = $current_year + 1;
                    
    $groups = $data['groups'];
    $all_groups = $data['all_groups'];
    


$cap_monthS_by_year =  collect($groups)->where('year', $current_year)->all();
$exist_months = array();
$exist_months_no = array();
$not_exist_months = array();


foreach($cap_monthS_by_year as $key => $month){
	$month_db = $month->month;
	//$month_db_full = $month["month_full"];
	array_push($exist_months_no, $month_db);
	array_push($exist_months, $month_db);
}

$months_array = months_array();

 foreach($months_array as $key => $month){
	 $month_db = $month["month"];
		$month_db_full = $month["month_full"];
	 if(!in_array($month_db+1, $exist_months_no)){
		 array_push($not_exist_months, ['month'=> $month_db, 'month_full'=>$month_db_full]);
	 }	
}
    
?>

<?php $__env->startSection('content-body'); ?>
<br>
<br>
<br>


        <div class="row">
            <div class="col-md-8">
                
                <table class="table table-stripped table-bordered">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>YEAR</th>
                            <th>CAPITATED MONTH</th>
                            <th>CAPITATION</th>
                            <th>PROVIDERS</th>
                            <th>AMOUNT</th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                         
                            <?php $__currentLoopData = $all_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>   
                            <td><?php echo e($loop->index + 1); ?></td>
                            <td><?php echo e($group->year); ?></td>
                            <td><?php echo e($group->month_full); ?></td>
                            <td><?php echo e($group->name); ?></td>
                            <?php
                                $provider_total = 0;
                                $cap_total = 0;
                                $group_info =  collect($groups)->where('group_id', $group->id)->first();
                                if(!empty($group_info)){
                                    $provider_total = $group_info->provider_total;
                                    $cap_total = $group_info->cap_total;
                                }
                            ?>
                            <td class="text-center"><?php echo e($provider_total); ?></td>
                            <td class="text-center">&#8358;<?php echo e(number_format($cap_total)); ?></td>
                           
                            <td><a href="<?php echo e(route('capitation.generate-capitation-info',[$group->id])); ?>" class="btn btn-sm btn-info">Open file</a></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                        
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <div class="" style="padding:20px;margin:20px; border:1px dashed #08c">

                    <div class="alert alert-info"><small>Use the below form to open new claim file.</small>  </div>
                    <form action="<?php echo e(route('capitation.new-capitation-file')); ?>" method="post">
                    <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                            Year:
                            <select name="cap_year" id="" class="form-control" style="padding:1px;" onchange="load_cap_months(this.value)">
                                <option value=""> Select Year</option>
                                <option value="<?php echo e($previous_year); ?>"> <?php echo e($previous_year); ?></option>
                                <option value="<?php echo e($current_year); ?>" selected> <?php echo e($current_year); ?></option>
                            </select>
                        </div>
                        <div class="form-group">
                             Capitation Month:
                             <select name="cap_month" id="cap_month" class="form-control" style="padding:1px;">
                                <option value=""> Select Capitation Month</option>
                                    <?php
                                        foreach($not_exist_months as $key => $month){
                                            $month_db = $month["month"];
                                            $month_db_full = $month["month_full"];
                                            
                                            if($month_db >=12){
                                                $mnth =1;
                                            }else{
                                                $mnth = $month_db + 1; 
                                            }
                                            
                                            
                                            if($year < date('Y')){
                                                
                                                if($mnth == 1){
                                                    
                                                    $findd = DB::table('capitation_grouping')->where('year',$year+1)->where('month',$mnth)->where('status', '1')->first();
                                                    if(empty($findd)){
                                                        $output .='<option value="'.$mnth.'">'.$month_db_full.' Capitation</option>';
                                                    }
                                                }else{
                                                    echo '<option value="'.$mnth.'">'.$month_db_full.' Capitation</option>';
                                                }
                                            }else if($year == date('Y')){
                                                
                                                ///Cap for new month only start on the 25th
                                                if($month_db <= (date('m') )){
                                                    if($month_db < (date('m') )){
                                                        echo '<option value="'.$mnth.'">'.$month_db_full.' Capitation</option>';
                                                    }else if($month_db == date('m')){
                                                       // echo '1';
                                                        if(intval(date('d')) >= 25 && intval(date('d')) <=31){
                                                            echo '<option value="'.$mnth.'">'.$month_db_full.' Capitation</option>';
                                                        }
                                                    }
                                                }
                                            }
                                            
                                        }
                                    ?>
                            </select>
                        </div>
                        <div><button class="btn btn-primary text-center form-control">New Capitation File</button></div>
                        <?php echo $__env->make('layouts.error_success_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </form>
                </div>
            </div>
        </div>
   <?php echo $__env->make('layouts.modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts_section'); ?>
<script>

    function load_cap_months(year){
        $.ajax({
         type: 'POST',
         url:  "/load-cap-months",
         data:  {year:year, _token:'<?php echo e(csrf_token()); ?>' },
         success: function(data){
                $('#cap_month').html(data);
               
             },
         error: function(data){
            
             console.log(data);
         }
     })
    }
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/ngschdqn/eims.ngscha.ni.gov.ng/resources/views/capitation/generate_capitation_.blade.php ENDPATH**/ ?>