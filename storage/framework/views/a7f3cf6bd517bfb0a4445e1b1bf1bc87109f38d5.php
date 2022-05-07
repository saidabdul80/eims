<?php
$sn = 0;

$provider = $data['provider'];
$lgas = $data['lgas'];
$wards = $data['wards'];

$hcpcategory = $provider->hcpcategory;
$hcptype = $provider->hcptype;
$hcplga = $provider->hcplga;
$hcpward = $provider->hcpward;
$serviceClaimType = $provider->serviceClaimType;

?>


<?php $__env->startSection('breadcrumb','Edit Provider'); ?>
<?php $__env->startSection('content-body'); ?>
    
   
    <div class="row bg-white" >      
	    <div class="col-xs-12 col-sm-12 col-md-12 col-lg 12">
        <?php echo $__env->make('layouts.error_success_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make('providers._provider_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</div>
	    <div>
	    	
	    </div>
    </div>


<script>
var wards = <?= json_encode($wards); ?>;

function load_ward_by_lga(lga){
    let opt = '';
    wards.forEach(ward => {
        if(ward.lga_id == lga){
            opt +='<option value="'+ward.id+'">'+ward.ward+'</option>';
        }

        $('#ward').html(opt);
    });
}


</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/ngschdqn/eims.ngscha.ni.gov.ng/resources/views/providers/edit.blade.php ENDPATH**/ ?>