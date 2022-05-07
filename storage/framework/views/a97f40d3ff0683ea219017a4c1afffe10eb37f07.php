<?php $__env->startSection('content-body'); ?>



  <br/>

  <br/>

<div class="container">

   

       <form action="<?php echo e(route('enrolment.get-bhcpf-enrollees')); ?>" method="POST" >

			<?php echo e(csrf_field()); ?>


        <div class="row">

                <div class="col-md-6">

                    <select name="category" id="category" class="form-control">

                        <option value="All">All categories </option>
                        <option value="Children under 5yrs">Children under 5yrs</option>
                        <option value="Female Reproductive (15-45 years)">Female Reproductive (15-45 years)</option>
                        <option value="Elderly (85 and above)">Elderly (85 and above)</option>
                        <option value="Others">Others</option>

                    </select>

                </div>

                <div class="col-md-6">

                    <button class="btn btn-primary form-control">Load List</button>

                </div>

        </div>

       </form>

           

   

</div>
<br>
<hr>
<br>
<?php if($enrollees != null): ?>
<div class="container">
<table class="table table-bordered table-stripped">
            <tr>
                <th>SN</th>
                <th>NAME</th>
                <th>ENROLLEE ID</th>
                <hd>CATEGORY</hd>
                <th>SEX</th>
                <th>DOB</th>
            </tr>

            <?php $__currentLoopData = $enrollees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enrollee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr id="row_<?php echo e($enrollee->id); ?>">

                    <td><?php echo e(($loop->index + 1)); ?></td>

                    <td><?php echo e($enrollee->surname.' '.$enrollee->first_name.' '.$enrollee->other_name); ?></td>

                    <td><?php echo e($enrollee->enrolment_number); ?></td>

                    <td class="text-center"><?php echo e($enrollee->vulnerability_status); ?></td>

                    <td class="text-center"><?php echo e($enrollee->sex); ?></td>

                    <td class="text-center"><?php echo e($enrollee->date_of_birth); ?></td>

                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </table>
</div>
<?php endif; ?>

   

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts_section'); ?>

<script>



 

</script>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/ngschdqn/eims.ngscha.ni.gov.ng/resources/views/enrolment/bhcpf_enrollees.blade.php ENDPATH**/ ?>