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

<?php $__env->startSection('content-body'); ?>
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
                         
                            <?php $__currentLoopData = $all_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
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
                            <?php if(!empty($group_info)): ?>
                            <tr>   
                            <td><?php echo e($sn++); ?></td>
                            <td><?php echo e($group->year); ?></td>
                            <td><?php echo e($group->month_full); ?></td>
                            <td><?php echo e($group->name); ?></td>
                            <td class="text-center"><?php echo e($provider_total); ?></td>
                            <td class="text-center"><?php echo e($total_enrolee); ?></td>
                            <td class="text-center">&#8358;<?php echo e(number_format($cap_total)); ?></td>
                           
                            <td><a href="<?php echo e(route('capitation.approve-capitation-info',[$group->id])); ?>" class="btn btn-sm btn-primary">View Cap File</a></td>
                            </tr>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                        
                    </tbody>
                </table>
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
<?php echo $__env->make('layouts/master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/ngschdqn/eims.ngscha.ni.gov.ng/resources/views/capitation/approve_capitation.blade.php ENDPATH**/ ?>