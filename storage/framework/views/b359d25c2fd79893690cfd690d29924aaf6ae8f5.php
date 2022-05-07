

<?php $__env->startSection('content-body'); ?>

  <br/>
  <br/>
<div class="container">
    <div class="alert alert-info">
        Select provider below to print ID of all enrollees whose choice of provider is selected.
    </div>
       <form action="<?php echo e(route('enrolment.print-id-by-provider')); ?>" method="POST" >
			<?php echo e(csrf_field()); ?>

        <div class="row">
                <div class="col-md-6">
                    <select name="provider_id" id="provider_id" class="form-control">
                        <option value="">-- select provider --</option>
                        <?php $__currentLoopData = $providers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $provider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($provider->id); ?>"><?php echo e($provider->hcpname); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-primary form-control">Print All ID card</button>
                </div>
        </div>
       </form>
           
   
</div>
   <?php echo $__env->make('layouts.modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts_section'); ?>
<script>

 
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\AshlabTech\Desktop\projects\nicare-eims\resources\views/enrolment/idcard_by_provider.blade.php ENDPATH**/ ?>