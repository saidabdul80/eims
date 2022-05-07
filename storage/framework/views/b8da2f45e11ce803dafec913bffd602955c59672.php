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
     



<h5>  Message History</h5>

<div class="">

<table id="table_id" class="display dataTable no-footer" style="font-size: 12px; " role="grid" aria-describedby="table_id_info">

<thead>
    <tr>

            <td class="text-center">SN</td>

             <td class="text-center">ENROLLEE ID</td>

              <td class="text-center">PHONE</td>

               <td class="text-center">MESSAGE</td>
               <td class="text-center">DATE</td>
               <td class="text-center">STATUS</td>

        </tr>
</thead>
<tbody>

            <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr id="row_<?php echo e($message->id); ?>">

                    <td><?php echo e(($loop->index + 1)); ?></td>

                    <td><?php echo e($message->enrollee_id); ?></td>
                    <td><?php echo e($message->recipient); ?></td>
                    <td><?php echo e($message->message); ?></td>
                    <td><?php echo e(date('d M, Y H:i:s A', strtotime(''.$message->created_at.''))); ?></td>
                    <td><?php echo e($message->status); ?></td>

                </tr>

               

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
    </table>
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
<?php echo $__env->make('layouts/master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/ngschdqn/eims.ngscha.ni.gov.ng/resources/views/premium/message_history.blade.php ENDPATH**/ ?>