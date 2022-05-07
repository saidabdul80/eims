<?php
use App\Lga;
use App\Ward;
use App\Provider;



    $lgas = Lga::all();
    $wards = Ward::all();
    $providers = Provider::where('hcptype','Primary')->get();


   function lga_name($lgas, $id){
        foreach ($lgas as $key => $lga) {
            if($lga['id'] == $id){
                return $lga['lga'];
            
            }   
        }
   }


   function ward_name($wards, $id){
    foreach ($wards as $key => $ward) {
        if($ward['id'] == $id){
            return $ward['ward'];
        
        }
    }
}


function provider_name($providers, $id){
    foreach ($providers as $key => $provider) {
        if($provider['id'] == $id){
            return $provider['hcpname'];
        
        }   
    }
}



?>

<?php $__env->startSection('content-body'); ?>


<div class="well well-sm">
        <form action="<?php echo e(route('enrolment.print-bulk-enrolment-slip')); ?>" method="post" target="_BLANK">
        <?php echo e(csrf_field()); ?>

        <div class="row">
            <div class="col-md-6">
                <select name="lga" id="lga" class="form-control" onchange="load_provider(this.value)">
                <option value=""> select L.G.A </option>
                    <?php $__currentLoopData = $lgas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lga): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($lga->id); ?>"><?php echo e(ucfirst(strtolower($lga->lga))); ?></option>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-6">
            <select name="provider_id" id="provider_id" class="form-control" >
                <option value=""> select Provider </option>
                    
                </select>
            </div>
        </div>
        <br>
        <br>
        <div>
            <button  class="btn btn-lg btn-primary form-control">Load Enrolment Slip</button>
        </div>
        </form>
   
</div>
   <?php echo $__env->make('layouts.modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts_section'); ?>
<script>
    var providers = <?php echo json_encode($providers); ?>;

    function load_provider(lga){
        let opt = '<option value=""> - Select Provider - </option>';
        providers.forEach(provider => {
            if(provider.hcplga == lga){
                opt +='<option value="'+provider.id+'">'+provider.hcpname+'</option>';
            }
        });

        $('#provider_id').html(opt);
        return 0;
    }





 
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\AshlabTech\Desktop\projects\nicare-eims\resources\views/enrolment/slip/enrolment_slip_print.blade.php ENDPATH**/ ?>