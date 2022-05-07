<?php
$sn = 0;



?>


<?php $__env->startSection('breadcrumb','Edit Provider'); ?>
<?php $__env->startSection('content-body'); ?>
    
   
    <div class="row bg-white" >      
	    <div class="col-xs-12 col-sm-12 col-md-12 col-lg 12">
        <?php echo $__env->make('layouts.error_success_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make('providers._provider_view', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</div>
	    <div>
	    	
	    </div>
    </div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/ngschdqn/eims.ngscha.ni.gov.ng/resources/views/providers/view.blade.php ENDPATH**/ ?>