<?php
 use Illuminate\Support\Facades\DB;
 $tpas = DB::table('tbl_tpa')->where('status','=','1')->get();

?>
<script type="text/javascript" src="<?php echo e(asset('js/js_functions.js')); ?>"></script>
<script>

        var all_TPA = <?php echo json_encode($tpas); ?> ;
   
</script>
<?php if($type == 1): ?>
	 	<?php echo $__env->make('users.mainform', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<?php if($type == 2): ?>
	<?php echo $__env->make('users.mainform', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<div class="col-md-12">
		<fieldset>
			<legend> Other Info</legend>
			<div class="col-md-12">
				<?php echo $__env->make('users.lga_ward_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>					
				<div class="col-md-6">
				<div class="form-group">
				 <label for="first_name">DeviceId  <span class="asterik asterik_first_name">*</span> </label>
				<p><input type="text" class="form-control" name="deviceId" value="" id="deviceId" placeholder="deviceId" required=""></p>

				</div>

				</div>
		<!-- column /-->
				<!-- column -->
				<div class="col-md-6">
					<div class="form-group">
					 <label for="first_name">DeviceModel  <span class="asterik asterik_first_name">*</span> </label>
					<p><input type="text" class="form-control" name="deviceModel" onkeyup="" value="" id="deviceModel" onblur="" placeholder="deviceModel" required=""></p>

					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						  <label for="occupation">DeviceIMEI <span class="asterik asterik_occupation">*</span></label>
						<p>
						</p><p><input type="text" class="form-control" name="deviceIMEI" value="" id="deviceIMEI" placeholder=" deviceIMEI" required=""></p>

						<p></p>
					</div>
				</div>
			</div>
			
		</fieldset>
	</div>
<?php endif; ?>


<?php if($type == 3): ?>
	<div class="col-md-6">
		<div class="form-group">
			<label for="first_name">TPA <span class="asterik asterik_first_name">*</span> </label>
			<input list="tpaOption" name="tpa" id="tpaname" class="form-control" required="" onchange="(function(){$('#tpa_id_id').val(searchA(all_TPA, 'organisation', $('#tpaname').val()))})();">
		    <input type="hidden" name="tpa_id" id="tpa_id_id" class="form-control">
		    <datalist id="tpaOption"  >
		    	<?php $__currentLoopData = $tpas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tpa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		        	<option value="<?php echo e($tpa->organisation); ?>">                       
		        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		    </datalist>      
		</div>
	</div>
	<?php echo $__env->make('users.mainform', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>	
			
<?php endif; ?>


<?php if($type == 4): ?>
	<?php echo $__env->make('users.mainform', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>	
	<?php echo $__env->make('users.lga_ward_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>	
	<script>
		$(document).ready(function(){
			$('#providerMain').show();
		});
	</script>
<?php endif; ?>

<?php if($type == 5): ?>
	<h5>no form Available</h5>
<?php endif; ?>

<?php if($type == 6): ?>
	<?php echo $__env->make('users.enrollee_info_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<?php if($type == 7): ?>
	<?php echo $__env->make('users.enrollee_info_form_informal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>	
<?php endif; ?>
    <div class="col-md-12">
                        <div class="form-group">
                              <button type="submit" name="create_user_btn" class="btn btn-primary btn-radius btn-brd grd1 "> Create User </button>
                        </div>
                    </div>    <?php /**PATH C:\Users\User\Desktop\Desktop\eims.ngscha.ni.gov.ng\resources\views/users/main.blade.php ENDPATH**/ ?>