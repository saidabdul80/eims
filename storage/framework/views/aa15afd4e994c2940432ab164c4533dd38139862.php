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


function provider_info($providers, $id){
    foreach ($providers as $key => $provider) {
        if($provider['id'] == $id){
            return $provider;
        
        }   
    }
}

?>
<div  class="preview" style="padding:20px 30px">
    

<form onsubmit="update_enrollee_info(event)" id="edit_enrolee_form_admin" enctype="multipart/form-data">
											
                                            <fieldset>
                                                    <legend>Personal Details: </legend>
                                                    <div class="row">
                                                        <!-- column -->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                 <label for="first_name">SURNAME  <span class="asterik asterik_first_name">*</span> </label>
                                                                <p><input type="text" class="form-control" name="surname" value="<?php echo e($enrollee->surname); ?>" id="surname" placeholder="Surname" required></p>
                                                        
                                                            </div>
                                                            
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                  <label for="surname">FIRST NAME<span class="asterik asterik_other_name"></span></label>
                                                                <p><input type="text" class="form-control" name="first_name" value="<?php echo e($enrollee->first_name); ?>" id="first_name" placeholder="First Name" required></p>
                                                            </div>
                                                            
                                                        </div>
                                                        
                                                        <!-- column -->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                  <label for="marital_status"> OTHER NAME <span class="asterik asterik_marital_status">*</span></label>
                                                                <p><input type="text" class="form-control" name="other_name"  value="<?php echo e($enrollee->other_name); ?>" id="other_name" placeholder="Other Name" ></p>
                                                            
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                  <label for="marital_status">Marital Status</label>
                                                                <p>
                                                                    <select class="form-control" name="marital_status" id="marital_status">
                                                                        <option value="" > </option>
                                                                        <option value="Married" <?php echo e($enrollee->marital_status == 'Married' ? 'selected' : ''); ?> > Married</option>
                                                                        <option value="Single" <?php echo e($enrollee->marital_status == 'Single' ? 'selected' : ''); ?>> Single</option>
                                                                        <option value="Divorced" <?php echo e($enrollee->marital_status == 'Divorced' ? 'selected' : ''); ?> > Divorced</option>
                                                                        <option value="Widow" <?php echo e($enrollee->marital_status == 'Widow' ? 'selected' : ''); ?> > Widow</option>
                                                                    </select>
                                                                </p>
                                                            </div>
                                                            
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                  <label for="marital_status">Sex</label>
                                                                <p>
                                                                    <select class="form-control" name="sex" id="sex">
                                                                        <option value="" > </option>
                                                                        <option value="Male" <?php echo e($enrollee->sex == 'Male' ? 'selected' : ''); ?> > Male</option>
                                                                        <option value="Female" <?php echo e($enrollee->sex == 'Female' ? 'selected' : ''); ?>> Female</option>
                                                                    </select>
                                                                </p>
                                                            </div>
                                                            
                                                        </div>
                                                        <!-- column /-->
                                                            
                                                            <!-- column /-->
                                                            <!-- column -->
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                          <label for="phone_number">Phone Number</label>
                                                                        <p><input type="text" class="form-control" name="phone_number"  id="phone_number" value="<?php echo e($enrollee->phone_number); ?>" placeholder="Phone Number" required></p>
                                                                    </div>
                                                                    
                                                                </div>
                                                                <!-- column /-->
                                                                
                                                                <!-- column -->
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                          <label for="occupation">Occupation</label>
                                                                        <p><input type="text" class="form-control" name="occupation"  id="occupation" value="<?php echo e($enrollee->occupation); ?>" placeholder="Occupation" required></p>
                                                                    </div>
                                                                    
                                                                </div>
                                                                <!-- column /-->
                                                                <!-- column -->
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                          <label for="email_address">Email Address</label>
                                                                        <p><input type="text" class="form-control" name="email_address" value="<?php echo e($enrollee->email_address); ?>"  id="email_address" placeholder="Email Address" ></p>
                                                                    </div>
                                                                    
                                                                </div>
                                                                <div class="col-md-6">
                                                            <div class="form-group">
                                                                  <label for="marital_status">Settlement</label>
                                                                <p>
                                                                    <select class="form-control" name="settlement" id="settlement">
                                                                        <option value="" > </option>
                                                                        <option value="Rural" <?php echo e($enrollee->settlement == 'Rural' ? 'selected' : ''); ?> > Rural</option>
                                                                        <option value="Urban" <?php echo e($enrollee->settlement == 'Urban' ? 'selected' : ''); ?>> Urban</option>
                                                                    </select>
                                                                </p>
                                                            </div>
                                                            
                                                        </div>
                                                                <!-- column /-->
                                                                 <!-- column -->
                                                                 <div class="col-md-6">
                                                                    <div class="form-group">
                                                                          <label for="nin">National Identification Number (NIN)</label>
                                                                        <p><input type="text" class="form-control" name="nin" value="<?php echo e($enrollee->nin); ?>"  id="nin" placeholder="NIN" ></p>
                                                                    </div>
                                                                    
                                                                </div>
                                                                <!-- column /-->
                                                                                                    
                                                    </div>
                                        </fieldset>
                                        

                                                <br/>
                                                <fieldset id="vulnerability_wrap">
                                                    <legend>Residential Address: </legend>
                                                    <div class="col-md-6">
                                                            <div class="form-group">
                                                                  <label for="surname">LGA  <span class="asterik asterik_surname">*</span> </label>
                                                                <select class="form-control" onchange="load_user_ward(this.value)" id="lga"  name="lga" required>
                                                                    <option value="">Select User lga</option>
                                                                    <?php $__currentLoopData = $lgas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lga): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                         <option value="<?php echo e($lga->id); ?>" <?php echo e(($enrollee->lga == $lga->id ? 'selected' : '')); ?>><?php echo e($lga->lga); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                  <label for="surname">Ward<span class="asterik asterik_surname">*</span> </label>
                                                                <select class="form-control" id="ward"  name="ward"  required>
                                                                    <option value="<?php echo e($enrollee->ward); ?>"><?php echo e(ward_name($wards,$enrollee->ward)); ?></option>

                                                                    <?php $__currentLoopData = $wards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ward): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                         <?php if($ward->lga_id == $enrollee->lga): ?>
                                                                            <option value="<?php echo e($ward->id); ?>" <?php echo e(($enrollee->ward == $ward->id ? 'selected' : '')); ?>><?php echo e($ward->ward); ?></option>
                                                                          <?php endif; ?>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>

                                                        </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                              <label for="address">Address <span class="asterik asterik_ministry">*</span></label>
                                                            <p>
                                                                    <p><input type="text" class="form-control" id="address" name="address" value="<?php echo e($enrollee->address); ?>" id="address"  placeholder="address" ></p>

                                                            </p>
                                                        </div>

                                                    </div>
                                                </fieldset>	
                                                
                                                 <br/>
                                                <fieldset id="vulnerability_wrap">
                                                    <legend>Provider : </legend>
                                                    <div class="col-md-6">
                                                            <div class="form-group">
                                                                  <label for="surname">LGA  <span class="asterik asterik_surname">*</span> </label>
                                                                <select class="form-control" onchange="load_user_ward2(this.value)" id="lga2"  name="lga2" required>
                                                                    <option value="">Select User lga</option>
                                                                    <?php $__currentLoopData = $lgas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lga): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                         <option value="<?php echo e($lga->id); ?>" <?php echo e((provider_info($providers,$enrollee->provider_id)['hcplga'] == $lga->id ? 'selected' : '')); ?>><?php echo e($lga->lga); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                  <label for="surname">Ward<span class="asterik asterik_surname">*</span> </label>
                                                                <select class="form-control" id="ward2"  name="ward2" onchange="load_user_provider(this.value)" required>
                                                                    <option value="<?php echo e($enrollee->ward); ?>"><?php echo e(ward_name($wards,provider_info($providers,$enrollee->provider_id)['hcpward'])); ?></option>


                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                  <label for="provider">CHOICE OF PROVIDER<span class="asterik asterik_choice_of_providers">*</span> </label>
                                                                <p><select class="form-control" name="provider" id="provider" style=""  required>
                                                                    <option value="<?php echo e($enrollee->provider_id); ?>"><?php echo e(provider_name($providers,$enrollee->provider_id)); ?></option>
                                                                </select>
                                                                </p>
                                                            </div>
                                                        </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                              <label for="address">Address <span class="asterik asterik_ministry">*</span></label>
                                                            <p>
                                                                    <p><input type="text" class="form-control"value="<?php echo e(provider_info($providers,$enrollee->provider_id)['hcpaddress']); ?>"   placeholder="address" readonly></p>

                                                            </p>
                                                        </div>

                                                    </div>
                                                </fieldset>
                                                <fieldset>
                                        <legend>Next of Kin (NOK) Details: </legend>

                                        <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="surname">NOK Name:</label>
                                        <p><input type="text" class="form-control" name="nok_name" value="<?php echo e($enrollee->nok_name); ?>" id="nok_name" placeholder="NOK Name" ></p>
                                        </div>

                                        </div>

                                        <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="surname">NOK Phone Number:</label>
                                        <p><input type="text" class="form-control" name="nok_phone_number" value="<?php echo e($enrollee->nok_phone_number); ?>" id="nok_phone_number" placeholder="NOK Phone Number" ></p>
                                        </div>

                                        </div>

                                        <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="nok_relationship">Relationship:</label>
                                        <p>
                                            <select class="form-control" name="nok_relationship" id="nok_relationship" required>
                                                <option value="Wife" <?php echo e(($enrollee->nok_relationship == 'Spouse' ? 'selected' : '')); ?>> Spouse</option>
                                                <option value="Son" <?php echo e(($enrollee->nok_relationship == 'Son' ? 'selected' : '')); ?>> Son</option>
                                                <option value="Daughter" <?php echo e(($enrollee->nok_relationship == 'Daughter' ? 'selected' : '')); ?>> Daughter</option>
                                                <option value="Mother" <?php echo e(($enrollee->nok_relationship == 'Mother' ? 'selected' : '')); ?>> Mother</option>
                                                <option value="Father" <?php echo e(($enrollee->nok_relationship == 'Father' ? 'selected' : '')); ?>> Father</option>
                                                <option value="Cousin" <?php echo e(($enrollee->nok_relationship == 'Cousin' ? 'selected' : '')); ?>> Cousin</option>
                                            </select>
                                        </p>
                                        </div>

                                        </div>
                                        </fieldset>
                                        
                                        
                                        <div id="feedback"></div>
                                        <div class="row">
                                        <div class="col-md-12 text-center">
                                        <input type="hidden" name="action" value="edit_enrolee_form_admin" required>
                                        <input type="hidden" name="enrolee_id" value="<?php echo e($enrollee->id); ?>" required>

                                        <HR/>
                                        <br/>
                                       <P class="text-right">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <input type="submit" class="btn btn-primary" value="Update Now!" name="update_principal_info_btn" ></P> 
                                        </div>
                                        </div>
                                        </form>

</div>


<script>
      var wards = <?php echo json_encode($wards); ?>;
       var providers = <?php echo json_encode($providers); ?>;
      
    
</script><?php /**PATH C:\Users\AshlabTech\Desktop\projects\nicare-eims\resources\views/enrolment/edit_enrollee_form.blade.php ENDPATH**/ ?>