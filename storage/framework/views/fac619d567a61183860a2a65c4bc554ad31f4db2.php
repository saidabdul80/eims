<?php

use App\Lga;

use App\Ward;

use App\Provider;







    $lgas = Lga::all();

    $wards = Ward::all();

    $providers = Provider::all();





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




	

	

	 $user_data = session()->get('user_data');

         $user_id = $user_data->id;

         $first_name = $user_data->first_name;

         



?>



<?php $__env->startSection('content-body'); ?>





<div class="row">
    <div class="col-md-12">
        <div class="alert alert-info">
    Total to expire this month: <?php echo e($to_expire_this_month); ?> <br>
    Total to expire Next month: <?php echo e($to_expire_next_month); ?> <br>

</div>

<?php if($recipients != []): ?>

    <div class="well well-sm" style="padding:20px;background:#fff !important">
        <div><h4>Message Status</h4></div>
         <?php $__currentLoopData = $recipients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recipient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                        Enrollee ID: <?php echo e($recipient->enrolment_number); ?>

                        <span class="pull-right">Recipient: <?php echo e($recipient->phone_number); ?></span>
                   
                </div>
                <div class="panel-footer">
                    <b>Expiring Date: </b><?php echo e($recipient->expired_date); ?> <br>
                    <b>SMS Status: </b><?php echo e($recipient->status); ?> <br>
                    <b>Message Id: </b><?php echo e($recipient->messageId); ?>

                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

<?php endif; ?>

<h5>  LIST OF ENROLLEES WHOSE PREMIUM TO EXPIRE IN THREE MONTHS LATER (<?php echo e(count($enrollees)); ?>) </h5>

<div class="">

<table id="table_id" class="display dataTable no-footer" style="font-size: 12px; " role="grid" aria-describedby="table_id_info">

<thead>
    <tr>

            <td class="text-center">SN</td>

             <td class="text-center">NAME</td>

              <td class="text-center">ENROLMENT NO.</td>

               <td class="text-center">SEX</td>
               <td class="text-center">ENROLMENT DATE</td>
               <td class="text-center">EXPIRATION DATE</td>

                <td class="text-center">PHONE</td>

                 <td class="text-center">LGA</td>

                 <td class="text-center">WARD</td>

                 <td class="text-center">ADDRESS</td>

        </tr>
</thead>
<tbody>

            <?php $__currentLoopData = $enrollees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enrollee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr id="row_<?php echo e($enrollee->id); ?>">

                    <td><?php echo e(($loop->index + 1)); ?></td>

                    <td><?php echo e($enrollee->surname.' '.$enrollee->first_name.' '.$enrollee->other_name); ?></td>

                    <td><?php echo e($enrollee->enrolment_number); ?></td>
                    <td class="text-center"><?php echo e($enrollee->sex); ?></td>
                    <td class="text-center"><b><?php echo e(date('d-m-Y', strtotime("".$enrollee->enrol_date.""))); ?></b></td>
                    <td class="text-center"><b><?php echo e(date('d-m-Y', strtotime("".$enrollee->date_expired.""))); ?></b></td>
                     <td class="text-center"><?php echo e($enrollee->phone_number); ?></td>
                     <td class="text-center"><?php echo e(lga_name($lgas, $enrollee->lga)); ?></td>
                      <td class="text-center"><?php echo e(ward_name($wards, $enrollee->ward)); ?></td>
                    <td class="text-center"> <?php echo e($enrollee->address); ?></td>

                </tr>

               

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
    </table>
<hr>
<h4>Message: </h2>
<hr>
<div class="text-center">
    <form action="<?php echo e(route('premium.sendSms')); ?>" method="post" style="display: inline;" onsubmit="return confirm('If you proceed, you will be sending reminder to <?php echo e(count($enrollees)); ?> enrollees. Proceed? ')">
    <?php echo e(csrf_field()); ?>

    <button type="submit" class="btn btn-sm btn-primary " name="send-message" value="send-message"><i class="fa fa-envelope" style="color:#FFF"></i>&nbsp;Send reminder to all enrollees</button>
    </form>
   &nbsp;&nbsp; |&nbsp;&nbsp;
     <a href="<?php echo e(route('premium.message_history')); ?>" class="btn btn-sm btn-success "><i class="fa fa-file" style="color:#FFF"></i>&nbsp;Message History</a>
</div>
    <hr>

   

</div>
    </div>
</div>

   <?php echo $__env->make('layouts.modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts_section'); ?>

<script>


</script>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/ngschdqn/eims.ngscha.ni.gov.ng/resources/views/premium/reports.blade.php ENDPATH**/ ?>