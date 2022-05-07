<?php



$lgas = $data['lgas'];
$wards = $data['wards'];
$providers = $data['providers'];


function lga_name($lgas, $id)
{
    foreach ($lgas as $key => $lga) {
        if ($lga['id'] == $id) {
            return $lga['lga'];
        }
    }
}


function ward_name($wards, $id)
{
    foreach ($wards as $key => $ward) {
        if ($ward['id'] == $id) {
            return $ward['ward'];
        }
    }
}


function provider_name($providers, $id)
{
    foreach ($providers as $key => $provider) {
        if ($provider['id'] == $id) {
            return $provider['hcpname'];
        }
    }
}

?>

<?php $__env->startSection('content-body'); ?>


<section>
   <form action="<?php echo e(route('enrolment.enrollees-by-provider-post')); ?>" method="post">
    <?php echo e(csrf_field()); ?>

   <fieldset id="vulnerability_wrap">
        <legend>Searh Enrollees </legend>
        <div class="col-md-4">
            <div class="form-group">
                <label for="surname">LGA </label>
                <select class="form-control" onchange="load_ward_by_lga(this.value)" id="lga" name="lga">
                    <option value="">Select User lga</option>
                    <?php $__currentLoopData = $lgas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lga): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($lga->id); ?>"> <?php echo e($lga->lga); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </select>
            </div>

        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="surname">Ward<span class="asterik asterik_surname">*</span> </label>
                <select class="form-control" id="ward" name="ward" onchange="load_provider_by_ward(this.value)">
                    <option value=""> Select ward </option>

                    <?php $__currentLoopData = $wards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ward): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($ward->id); ?>"><?php echo e($ward->ward); ?></option>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="provider">CHOICE OF PROVIDER<span class="asterik asterik_choice_of_providers">*</span> </label>
                <p><select class="form-control" name="provider" id="provider" >
                <option value=""></option>
                <?php $__currentLoopData = $providers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $provider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($provider->id); ?>"><?php echo e($provider->hcpname); ?></option>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </p>
            </div>

        </div>
    </fieldset>
    <div><button class="btn btn-lg btn-primary " type="submit" style="display: block;width: 100%;">Load Enrollees</button></div>
   </form>

</section>
<br />
<br />




<?php if(!empty($enrollees)): ?>
<div class="container">
    <table class="table table-bordered table-stripped">
        <tr>
            <th>SN</th>
            <th>NAME</th>
            <th>ENROLMENT NUMBER</th>
            <th>ENROLEE TYPE</th>
            <th>ENROLEE GROUP</th>
            <th>GENDER</th>
            <th>LGA</th>
            <th>WARD</th>
            <th></th>

        </tr>
        <?php $__currentLoopData = $enrollees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enrollee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e(($loop->index + 1)); ?></td>
            <td><?php echo e($enrollee->surname.' '.$enrollee->first_name.' '.$enrollee->other_name); ?></td>
            <td><?php echo e($enrollee->enrolment_number); ?></td>
            <td><?php echo e($enrollee->enrolee_type); ?></td>
            <td><?php echo e($enrollee->enrolee_category); ?></td>
            <td><?php echo e($enrollee->sex); ?></td>
            <td><?php echo e(lga_name($lgas, $enrollee->lga)); ?></td>
            <td><?php echo e(ward_name($wards,$enrollee->ward)); ?></td>
            <td class="text-center">
                <button class="btn btn-info" title="View Enrolment Detials" onclick="load_enrollee_info(<?php echo e($enrollee->id); ?>)"><i class="fa fa-eye" style="color:#fff"></i></button>
                <button class="btn btn-primary" title="Update Record" onclick="load_edit_enrollee_info(<?php echo e($enrollee->id); ?>)"><i class="fa fa-edit" style="color:#fff"></i></button>
                <a href="<?php echo e(route('enrolment.idcard',[base64_encode(base64_encode(base64_encode($enrollee->id)))])); ?>" target="_BLANK" class="btn btn-success" title="IdCard"><i class="fa fa-print" style="color:#fff"></i></a>
            </td>
        </tr>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>


</div>
<?php endif; ?>
<?php echo $__env->make('layouts.modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts_section'); ?>
<script>
var wards = <?= json_encode($wards); ?>;
var providers = <?= json_encode($providers); ?>;

function load_ward_by_lga(lga){
    let opt = '';
    wards.forEach(ward => {
        if(ward.lga_id == lga){
            opt +='<option value="'+ward.id+'">'+ward.ward+'</option>';
        }

        $('#ward').html(opt);
    });
}

function load_provider_by_ward(ward){
    let opt = '';
    providers.forEach(provider => {
        if(provider.hcpward == ward){
            opt +='<option value="'+provider.id+'">'+provider.hcpname+'</option>';
        }

        $('#provider').html(opt);
    });
}


    function update_enrollee_info(event) {
        event.preventDefault();
        //window.history.back();
        $('#feedback').html('<p style="color:red">Saving....</p>');

        $.ajax({
            type: 'POST',
            url: "/update-enrollee-info",
            data: $('#edit_enrolee_form_admin').serialize() + "&_token=<?php echo e(csrf_token()); ?>",
            //data:  {id:id, _token:'<?php echo e(csrf_token()); ?>' },
            success: function(data) {
                if (data.status == 200)
                    $('#feedback').html('<p class="alert alert-success">' + data.message + '</p>');
                else
                    $('#feedback').html('<p class="alert alert-danger">' + data.message + '</p>');

            },
            error: function(data) {

                console.log(data);
            }
        })


    }




    function load_edit_enrollee_info(id) {
        $('#myModal').modal('show');
        $('#modal-footer').hide('slow');
        $.ajax({
            type: 'POST',
            url: "/load-edit-enrollee-info",
            data: {
                id: id,
                _token: '<?php echo e(csrf_token()); ?>'
            },
            success: function(data) {

                $('#modal-content').html(data.html);
            },
            error: function(data) {

                console.log(data);
            }
        })


    }


    function load_enrollee_info(id) {
        let biometric = false;
        $('#myModal').modal('show');
        $('#modal-footer').show('slow');
        $.ajax({
            type: 'POST',
            url: "/load-enrollee-info",
            data: {
                id: id,
                biometric: biometric,
                _token: '<?php echo e(csrf_token()); ?>'
            },
            success: function(data) {

                $('#modal-content').html(data.html);
            },
            error: function(data) {

                console.log(data);
            }
        })


    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\AshlabTech\Desktop\projects\nicare-eims\resources\views/enrolment/enrollees_by_provider.blade.php ENDPATH**/ ?>