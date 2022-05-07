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

    $devices = $data['devices'];
    $tpas = $data['tpas'];
    $huwe_device_assignment_config = $data['huwe_device_assignment_config'];
    $huwe_staff = $data['huwe_staff'];
    $device_lgas = $data['device_lga'];
    $staff_list = $data['staff_list'];
    $nicare_devices = collect($devices)->where('tpa_code','!=','NGSCHA/HUWE')->all();
    $huwe_devices = collect($devices)->where('tpa_code','NGSCHA/HUWE')->all();
	$encounter_devices = collect($devices)->where('tpa_code','Provider')->all();
	
	$secondary_providers = collect($providers)->where('hcptype','Secondary')->all();

    $action_ = $huwe_device_assignment_config->action;

    $device_lga_list = [];
    $device_staff_list = [];


   


    if(isset($_GET['huwe'])){
        $huwe_active = 'active';
        $nicare_active = '';
        $encounter_active = '';
    }else  if(isset($_GET['encounter'])){
        $huwe_active = '';
        $nicare_active = '';
		  $encounter_active = 'active';
    }else {
        $huwe_active = '';
        $nicare_active = 'active';
		 $encounter_active = '';
    }
?>

<?php $__env->startSection('content-body'); ?>

  <br/>
  <br/>
<div class="container">
    <div role="tabpanel">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="<?php echo e($nicare_active); ?>"><a href="#home" aria-controls="home" role="tab" name="nicare-tab" data-toggle="tab"><strong>NiCare Enrolment Devices</strong> </a></li>
        <li role="presentation" class="<?php echo e($huwe_active); ?>"><a href="#profile" name="huwe-tab" aria-controls="profile" role="tab" data-toggle="tab"><strong>Huwe Enrolment Devices</strong> </a></li>
        <li role="presentation" class="<?php echo e($encounter_active); ?>"><a href="#encounter-devices" name="huwe-tab" aria-controls="encounter-devices" role="tab" data-toggle="tab"><strong>Encounter  Devices</strong> </a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
        <div role="tabpanel" class="tab-pane <?php echo e($nicare_active); ?>" id="home">
        <?php if(session()->exists('error')): ?>
                <hr/>
                    <div class="alert alert-danger">
                        <?php echo e(session('error')); ?>

                    </div>
            <?php endif; ?>

            <?php if(session()->exists('success')): ?>
                <hr/>
                    <div class="alert alert-success">
                        <?php echo e(session('success')); ?>

                    </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-md-8">
                      <div style="padding:20px;margin:20px; border:1px dashed #08c">
                         <h4>Existing Devices</h4>
                          <table id="" class="table table-bordered">
                                <thead>
                                    <tr>
                                    <th>sn</th>
                                    <th>Device</th>
                                    <th>Organization</th>
                                    <th>Activation Status</th>
                                    <th>Device Status</th>
                                    <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $nicare_devices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nicare_device): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <tr>
                                            <td><?php echo e($loop->index + 1); ?></td>
                                            <td><?php echo e($nicare_device->device); ?></td>
                                            <td><?php echo e($nicare_device->tpa_code); ?></td>
                                            <td><?php echo e(empty($nicare_device->deviceIMEI) ? 'Not Activated' : 'Activated'); ?></td>
                                            <?php if($nicare_device->deviceStatus == '1'): ?>
                                                 <td>Active</td>
                                            <?php elseif($nicare_device->deviceStatus == '0'): ?>
                                             <td>Blocked</td>
                                            <?php elseif($nicare_device->deviceStatus == '2'): ?>
                                             <td>Suspended</td>
                                            <?php else: ?>
                                            <td>-</td>
                                            <?php endif; ?>
                                            
                                            <td>
                                                <button class="btn btn-primary"><i class="fa fa-eye" style="color:#fff"></i></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                          </table>
                    </div>
                </div>
                <div class="col-md-4">
                      <div style="padding:20px;margin:20px; border:1px dashed #08c">
                            <h4>New Device Form</h4>
                            <form action="<?php echo e(route('settings.create-new-nicare-device')); ?>" method="post">
                            <?php echo e(csrf_field()); ?>

                                <div class="form-group">
                                    <select name="tpa_code" id="" class="form-control" style="padding-top:3px">
                                        <option value=""> Select Organization </option>
                                        <?php $__currentLoopData = $tpas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tpa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                             <option value="<?php echo e($tpa->tpa_code); ?>"> <?php echo e($tpa->tpa_code); ?> - <?php echo e($tpa->organisation); ?> </option>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                   <button class="btn btn-primary form-control">Create Device</button>
                                </div>
                                <?php if($errors->any()): ?>
                                    <hr/>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="alert alert-danger">
                                            <?php echo e($err); ?>

                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </form>
                    </div>

                    <div style="padding:20px;margin:20px; border:1px dashed #08c">
                            <h4> Device Operations</h4>
                            <form action="<?php echo e(route('settings.execute-device-operation')); ?>" method="post">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                    <select name="device_action" id="" class="form-control" style="padding-top:1px" required>
                                        <option value=""> Select Action </option>
                                        <option value="Re-generate-Code"> Re-generate Code </option>
                                        <option value="suspend-device"> Suspend Device </option>
                                        <option value="block-device"> Block device </option>
                                        
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="device_id" id="" class="form-control" style="padding-top:3px" required>
                                        <option value=""> Select Device </option>
                                        <?php $__currentLoopData = $nicare_devices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nicare_device): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                             <option value="<?php echo e($nicare_device->id); ?>"> <?php echo e($nicare_device->device); ?> </option>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    Reason for operation<br/>
                                   <textarea name="reason" id="reason" cols="30" rows="5" required></textarea>
                                </div>
                                <div class="form-group">
                                   <button class="btn btn-primary form-control">Execute Device Operation</button>
                                </div>
                               
                            </form>
                    </div>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane <?php echo e($huwe_active); ?>" id="profile">

        <?php if(session()->exists('error')): ?>
                <hr/>
                    <div class="alert alert-danger">
                        <?php echo e(session('error')); ?>

                    </div>
            <?php endif; ?>

            <?php if(session()->exists('success')): ?>
                <hr/>
                    <div class="alert alert-success">
                        <?php echo e(session('success')); ?>

                    </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-md-8">
                      <div style="padding:20px;margin:20px; border:1px dashed #08c">
                         <h4>Existing Devices</h4>
                          <table id="" class="table table-bordered">
                                <thead>
                                    <tr>
                                    <th>sn</th>
                                    <th>Device</th>
                                    <th>Organization</th>
                                    <th>Activation Status</th>
                                    <th>Device Status</th>
                                    <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $huwe_devices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nicare_device): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <tr>
                                            <td><?php echo e($loop->index + 1); ?></td>
                                            <td><?php echo e($nicare_device->device); ?></td>
                                            <td><?php echo e($nicare_device->tpa_code); ?></td>
                                            <td><?php echo e(empty($nicare_device->deviceIMEI) ? 'Not Activated' : 'Activated'); ?></td>
                                            <?php if($nicare_device->deviceStatus == '1'): ?>
                                                 <td>Active</td>
                                            <?php elseif($nicare_device->deviceStatus == '0'): ?>
                                             <td>Blocked</td>
                                            <?php elseif($nicare_device->deviceStatus == '2'): ?>
                                             <td>Suspended</td>
                                            <?php else: ?>
                                            <td>-</td>
                                            <?php endif; ?>
                                            
                                            <td>
                                                <button class="btn btn-primary"><i class="fa fa-eye" style="color:#fff"></i></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                          </table>
                    </div>

                    <!-- -------------------------------------------------------DEVICE TO LGA--------------------------------------- -->
                    <div style="padding:20px;margin:20px; border:1px dashed #08c">
                         <h4>ASSIGNED DEVICE TO LGA</h4>
                          <table id="" class="table table-bordered">
                                <thead>
                                    <tr>
                                    <th>sn</th>
                                    <th>Device</th>
                                    <th>LGA</th>
                                    <th>Active Status</th>
                                    <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $device_lgas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $device_lga): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          
                                        <?php array_push($device_lga_list,$device_lga->lga_id); ?>
                                        <tr>
                                            <td><?php echo e($loop->index + 1); ?></td>
                                            <td><?php echo e($device_lga->device); ?></td>
                                            <td><?php echo e($device_lga->lga); ?></td>
                                            <td><?php echo e($device_lga->state); ?></td>
                                            <td>
                                                <?php if($device_lga->state == 'Active'): ?>
                                                 <a href="<?php echo e(route('settings.make-device-lga-inactive',[$device_lga->id])); ?>" class="btn btn-danger" title="Make inactive"><i class="fa fa-close" style="color:#fff"></i></a>
                                                <?php else: ?>
                                                  <a href="<?php echo e(route('settings.make-device-lga-active',[$device_lga->id])); ?>" class="btn btn-success" title="Make Active"><i class="fa fa-check" style="color:#fff"></i></a>
                                                <?php endif; ?>
                                                
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                  
                                </tbody>
                          </table>
                    </div>
                     <!-- -------------------------------------------------------END DEVICE TO LGA--------------------------------------- -->

                     <!-- -------------------------------------------------------HUWE ENROLMENT OFFICERS--------------------------------------- -->
                    <div style="padding:20px;margin:20px; border:1px dashed #08c">
                         <h4>HUWE ENROLMENT OFFICERS</h4>
                          <table id="" class="table table-bordered ">
                                <thead>
                                    <tr>
                                    <th>SN</th>
                                    <th>NAME</th>
                                    <th>STAFF ID</th>
                                    <th>DEVICE</th>
                                    <th>PHONE NUMBER</th>
                                    <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $staff_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php 
                                              
                                            $device ='';
                                            $staff_device_info = collect($huwe_staff)->where('id',$staff->id)->first();
                                            
                                            if(!empty($staff_device_info)){
                                                $device = $staff_device_info->device;
                                            }
                                        ?>
                                        <tr>
                                            <td><?php echo e($loop->index + 1); ?></td>
                                            <td><?php echo e($staff->surname.' '.$staff->first_name.' '.$staff->other_name); ?></td>
                                            <td><?php echo e($staff->nicare_code); ?></td>
                                            <td><?php echo e($device); ?></td>
                                            <td><?php echo e($staff->phone_number); ?></td>
                                            
                                            <td>
                                                <button class="btn btn-primary"><i class="fa fa-eye" style="color:#fff"></i></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                          </table>
                    </div>
                     <!-- -------------------------------------------------------END HUWE ENROLMENT OFFICERS--------------------------------------- -->



                </div>
                <div class="col-md-4">
                      <div style="padding:20px;margin:20px; border:1px dashed #08c">
                            <h4>New Device Form</h4>
                            <form action="<?php echo e(route('settings.create-new-nicare-device')); ?>" method="post">
                            <?php echo e(csrf_field()); ?>

                                <div class="form-group">
                                    <select name="tpa_code" id="" class="form-control" style="padding-top:3px">
                                        <option value="NGSCHA/HUWE"> NGSCHA/HUWE </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                   <button class="btn btn-primary form-control">Create Device</button>
                                </div>
                                <?php if($errors->any()): ?>
                                    <hr/>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="alert alert-danger">
                                            <?php echo e($err); ?>

                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </form>
                    </div>

                    <div style="padding:20px;margin:20px; border:1px dashed #08c">
                            <h4> L.G.A <code><i class="fa fa-chain"></i></code> DEVICE</h4>
                            <div class="alert alert-info">
                                   <small> <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong>NEW:</strong>  Huwe Biometric Enrollment Device (BED) can now be assigned to multiple L.G.A base on configuration.
                                    <p>The current configurtion is: <strong><?php echo e($action_); ?></strong></p>
                                    </small>
                             </div>
                            <form action="<?php echo e(route('settings.assign-lga-to-device')); ?>" method="post">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                    <select name="action" id="" class="form-control" style="padding-top:1px" required>
                                        <option value="assign"> Assign device</option>
                                        <option value="de-assign"> De-assign device</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="device_id" id="" class="form-control" style="padding-top:1px" required>
                                        <option value=""> Select Device </option>
                                        <?php $__currentLoopData = $huwe_devices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nicare_device): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                             <option value="<?php echo e($nicare_device->id); ?>"> <?php echo e($nicare_device->device); ?> </option>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="lga_id" id="" class="form-control" style="padding-top:1px" required>
                                        <option value=""> Select LGA </option>
                                        <?php $__currentLoopData = $lgas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lga): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($action_ == 'MULTIPLE_LGA'): ?>
                                                <option value="<?php echo e($lga->id); ?>"> <?php echo e($lga->lga); ?> </option>
                                            <?php else: ?>
                                                <?php if(!in_array($lga->id, $device_lga_list)): ?>
                                                    <option value="<?php echo e($lga->id); ?>"> <?php echo e($lga->lga); ?> </option>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                   <button class="btn btn-primary form-control">Assign Device NOW!</button>
                                </div>
                               
                            </form>
                    </div>


                    <div style="padding:20px;margin:20px; border:1px dashed #08c">
                            <h4> NEW ENROLMENT OFFICER </h4>
                            
                            <form action="<?php echo e(route('settings.create-huwe-staff')); ?>" method="post">
                            <?php echo e(csrf_field()); ?>

                            <p> <input type="text" class="form-control"  placeholder="Surname" name="surname" value="<?php echo e(old('surname')); ?>" required></p><br>
                            <p> <input type="text" class="form-control"  placeholder="Other names" name="other_name" value="<?php echo e(old('other_name')); ?>" required></p><br>
                            <p> <input type="text" class="form-control"  placeholder="Phone number" name="phone_number" value="<?php echo e(old('phone_number')); ?>" required></p><br>
                            <p> <input type="password" class="form-control"  placeholder="Password" name="password"  required></p><br>
                            <p> <input type="password" class="form-control"  placeholder="Confirm Password" name="c_password" required></p><br>
                            <div class="alert alert-sm alert-info"><small><strong>Note:</strong> The username will be auto-generated and in this format NGSCHA/STAFF/0001</small></div>
                            
																							
                               
                                <div class="form-group">
                                   <button class="btn btn-primary form-control">Create User</button>
                                </div>
                               
                            </form>
                    </div>


                    <div style="padding:20px;margin:20px; border:1px dashed #08c">
                            <h4> STAFF <code><i class="fa fa-chain"></i></code> DEVICE</h4>
                            
                            <form action="<?php echo e(route('settings.assign-device-to-staff')); ?>" method="post">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                    <select name="action" id="" class="form-control" style="padding-top:1px" required>
                                        <option value="assign"> Assign device</option>
                                        <option value="de-assign"> De-assign device</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="user_id" id="" class="form-control" style="padding-top:1px" required>
                                        <option value=""> Select STAFF </option>
                                        <?php $__currentLoopData = $staff_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <option value="<?php echo e($staff->id); ?>"> <?php echo e($staff->nicare_code); ?> </option>
                                          
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="device" id="" class="form-control" style="padding-top:1px" >
                                        <option value=""> Select Device </option>
                                        <?php $__currentLoopData = $huwe_devices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nicare_device): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php 
                                             $staff_device_info = collect($huwe_staff)->where('device',$nicare_device->device)->first();
                                            
                                        ?>
                                            <?php if(empty($staff_device_info)): ?>
                                                <option value="<?php echo e($nicare_device->device); ?>"> <?php echo e($nicare_device->device); ?> </option>
                                            <?php endif; ?>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                               
                                <div class="form-group">
                                   <button class="btn btn-primary form-control">Assign Device NOW!</button>
                                </div>
                               
                            </form>
                    </div>

                    <div style="padding:20px;margin:20px; border:1px dashed #08c">
                            <h4> Device Operations</h4>
                            <form action="<?php echo e(route('settings.execute-device-operation')); ?>" method="post">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                    <select name="device_action" id="" class="form-control" style="padding-top:1px" required>
                                        <option value=""> Select Action </option>
                                        <option value="Re-generate-Code"> Re-generate Code </option>
                                        <option value="suspend-device"> Suspend Device </option>
                                        <option value="block-device"> Block device </option>
                                        
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="device_id" id="" class="form-control" style="padding-top:3px" required>
                                        <option value=""> Select Device </option>
                                        <?php $__currentLoopData = $huwe_devices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nicare_device): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                             <option value="<?php echo e($nicare_device->id); ?>"> <?php echo e($nicare_device->device); ?> </option>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    Reason for operation<br/>
                                   <textarea name="reason" id="reason" cols="30" rows="5" required></textarea>
                                </div>
                                <div class="form-group">
                                   <button class="btn btn-primary form-control">Execute Device Operation</button>
                                </div>
                               
                            </form>
                    </div>



                </div>
            </div>

        </div>
		
		<div role="tabpanel" class="tab-pane <?php echo e($encounter_active); ?>" id="encounter-devices">

        <?php if(session()->exists('error')): ?>
                <hr/>
                    <div class="alert alert-danger">
                        <?php echo e(session('error')); ?>

                    </div>
            <?php endif; ?>

            <?php if(session()->exists('success')): ?>
                <hr/>
                    <div class="alert alert-success">
                        <?php echo e(session('success')); ?>

                    </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-md-8">
						  <h4>Existing Devices</h4>
                          <table id="" class="table table-bordered">
                                <thead>
                                    <tr>
                                    <th>sn</th>
                                    <th>Device</th>
                                    <th>Provider</th>
                                    <th>Activation Status</th>
                                    <th>Device Status</th>
                                    <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $encounter_devices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $encounter_device): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <tr>
                                            <td><?php echo e($loop->index + 1); ?></td>
                                            <td><?php echo e($encounter_device->device); ?></td>
                                            <td><?php echo e(provider_name($providers,$encounter_device->provider_id)); ?></td>
                                            <td><?php echo e(empty($encounter_device->deviceIMEI) ? 'Not Activated' : 'Activated'); ?></td>
                                            <?php if($encounter_device->deviceStatus == '1'): ?>
                                                 <td>Active</td>
                                            <?php elseif($encounter_device->deviceStatus == '0'): ?>
                                             <td>Blocked</td>
                                            <?php elseif($encounter_device->deviceStatus == '2'): ?>
                                             <td>Suspended</td>
                                            <?php else: ?>
                                            <td>-</td>
                                            <?php endif; ?>
                                            
                                            <td>
                                                <button class="btn btn-primary"><i class="fa fa-eye" style="color:#fff"></i></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                          </table>
				
				</div>
				
				 <div class="col-md-4">
                      <div style="padding:20px;margin:20px; border:1px dashed #08c">
                            <h4>New Device Form</h4>
                            <form action="<?php echo e(route('settings.create-new-encounter-device')); ?>" method="post">
                            <?php echo e(csrf_field()); ?>

                                <div class="form-group">
                                    <select name="provider_id" id="provider_id" class="form-control" style="padding-top:3px">
                                        <option value=""> Select Provider </option>
                                        <?php $__currentLoopData = $secondary_providers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $provider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                             <option value="<?php echo e($provider->id); ?>"> <?php echo e($provider->hcpname); ?> - <?php echo e($provider->hcpcode); ?> </option>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                   <button class="btn btn-primary form-control">Create Device</button>
                                </div>
                                <?php if($errors->any()): ?>
                                    <hr/>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="alert alert-danger">
                                            <?php echo e($err); ?>

                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </form>
                    </div>
				
				</div>
            </div>

        </div>
		
		
        </div>

        </div>
   
</div>
   <?php echo $__env->make('layouts.modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts_section'); ?>
<script>


$('#myTab a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/ngschdqn/eims.ngscha.ni.gov.ng/resources/views/settings/configure_bed.blade.php ENDPATH**/ ?>