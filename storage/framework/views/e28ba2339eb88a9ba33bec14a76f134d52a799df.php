<?php if($errors->any()): ?>
            <hr/>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="alert alert-danger">
                    <?php echo e($err); ?>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <?php if(session()->exists('success')): ?>
            <hr/>
                <div class="alert alert-success">
                    <?php echo e(session('success')); ?>

                </div>
        <?php endif; ?>

        <?php if(session()->exists('error')): ?>
            <hr/>
                <div class="alert alert-danger">
                    <?php echo e(session('error')); ?>

                </div>
        <?php endif; ?>

        <?php if(session()->exists('account_success')): ?>
            <hr/>
                <div class="alert alert-success">
                    <?php echo e(session('account_success')); ?>

                </div>
        <?php endif; ?><?php /**PATH /home3/ngschdqn/eims.ngscha.ni.gov.ng/resources/views/layouts/error_success_message.blade.php ENDPATH**/ ?>