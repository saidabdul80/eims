<?php
use App\Lga;
use App\Ward;
use App\Provider;
require('phpqrcode/qrlib.php');

QRcode::png($enrollee->enrolment_number, 'qrcode_image.png'); 


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

function finger_text($finger){
		if($finger== 'Present'){
			$status = '<span class="bg-success">Present</span>';
		}else if($finger== 'Absent'){
			$status = '<span class="bg-danger">Absent</span>';
		}else{
		    	$status = '';
		}
		
		echo $status;
	}

?>


         <?php if($enrollee->enrolment_approval_status != '0'): ?>
                  <div class="alert alert-success"><strong>Info! </strong>Enrolment already approved</div>
        <?php else: ?>
           <div class="alert alert-danger"><strong>Info! </strong>Enrolment has not been approved</div>
        <?php endif; ?>

<div  class="preview" style="padding:20px 30px">
    <div class="text-center">
        <table style="color:#000" width="100%">

<tr >
    <td class="">
        <p class="text-left" style="font-size: 12px">
        <img src="qrcode_image.png"/>
            <br> NiCare Number.: <?php echo e($enrollee->enrolment_number); ?>

            <br> Date Enroled: <?php echo e($enrollee->enrol_date); ?>

            
            <?php if($enrollee->mode_of_enrolment == 'Premium'): ?>
                    <br>NIN Number: <?php echo e($enrollee->nin); ?>

           <?php else: ?>
               
                <br> BHCPF Number:  <?php echo e($enrollee->BHCPF_number); ?>

                <br> NIN Number:  <?php echo e($enrollee->nin); ?>

                <br> Category: <?php echo e($enrollee->vulnerability_status); ?>

            <?php endif; ?>
            
        </p>
        </td>

    <td class="">
        <?php
        
        try{
        	$string = file_get_contents("https://ngscha.ni.gov.ng/apps/enrollees_data/pictures/$enrollee->id.json");
        	$json_data = json_decode($string, true);
        	$passport = $json_data['passport'];
            echo '<p class="text-right" style="text-align:right !important"><img src="data:image/jpeg;base64,'.$passport.'"  style="float:right" width="120px" height="120px" alt="passport"/></p>';
        }catch(Exception $e){
          echo ' <p class="text-right" style="text-align:right !important"><img src="https://ngscha.ni.gov.ng/apps/img_data/enrollees/'.$enrollee->id.'.jpg"  style="float:right" width="120px" height="120px" alt="passport"/></p>';
        }
        ?>
   

    </td>
</tr>
</table>
    </div>


    <fieldset>

                         
                         
											 <table class="table  table-bordered " border="2" width="100%" id="" style="color:#000;font-size:14px" border="1">
											 			
																	
																
                                                                <?php if($enrollee->mode_of_enrolment == 'Premium'): ?>
                                                                <tr>
                                                                    <td colspan="4"><h5>Enrolment Number:  <strong><?php echo e($enrollee->enrolment_number); ?></h5></strong> </td>
                                                                    </tr>
                                                                <?php else: ?>
                                                                 <tr>
                                                                    <td colspan="4"><h5>Enrolment Number:  <strong><?php echo e($enrollee->enrolment_number); ?></h5></strong> </td>
                                                                </tr>

                                                                <?php endif; ?>
																<tr>
																	<td>Surname:</td><td><?php echo e($enrollee->surname); ?></td>
																	<td>First Name:</td><td><?php echo e($enrollee->first_name); ?></td>
																</tr>
																<tr>

																	<td>Other Name:</td>
																	<td ><?php echo e($enrollee->other_name); ?></td>
																	<td></td>
																	<td >
																	</td>
																</tr>
																<tr>

																	<td>Sex:</td>
																	<td ><strong><?php echo e($enrollee->sex); ?></strong></td>
																	<td>Age:</td>
																	<td ><?php echo e($enrollee->date_of_birth); ?>

																	</td>
																</tr>
																<tr>
																	<td>Email:</td>
																	<td><?php echo e($enrollee->email_address); ?></td>
																	<td>Phone Number:</td>
																	<td><?php echo e($enrollee->phone_number); ?></td>
																</tr>
																<tr>
																	<td>Marital Status:</td>
																	<td><?php echo e($enrollee->marital_status); ?></td>
																	<td>Occupation:</td>
																	<td><?php echo e($enrollee->occupation); ?></td>
																</tr>
																
																<tr>
																<td>Benefit Plan:</td>
																<td><?php echo e($enrollee->benefit_plan); ?></td>
															</tr>
																<tr>
																	<td>Date Enroled:</td>
																	<td colspan="3"><?php echo e($enrollee->enrol_date); ?></td>
																</tr>
																
																<tr>
																	<td colspan="4"><h5>National Identification Number (NIN):  <?php echo e($enrollee->nin); ?></h5></td>
																</tr>
															</table>
															
															
															<h4>Enrollee's Address</h4>
															<table class="table table-bordered">
															    
															    <tr>
																	<td>LGA :</td>
																	<td><?php echo e(lga_name($lgas,$enrollee->lga)); ?>

																	</td>
																	<td>Ward:</td>
																	<td><?php echo e(ward_name($wards,$enrollee->ward)); ?>

																	</td>
																</tr>
																	<tr>
																	<td>Address:</td>
																	<td colspan=""><?php echo e($enrollee->address); ?></td>
																	<td>Settlement:</td>
																	<td colspan=""><?php echo e($enrollee->settlement); ?></td>
																</tr>
															</table>
															
															<h4>Provider's Address</h4>
															<table class="table table-bordered">
															    
															    <tr>
																	<td>LGA :</td>
																	<td><?php echo e(lga_name($lgas,provider_info($providers,$enrollee->provider_id)['hcplga'])); ?>

																	</td>
																	<td>Ward:</td>
																	<td><?php echo e(ward_name($wards,provider_info($providers,$enrollee->provider_id)['hcpward'])); ?></td>
																</tr>
																	
																<td>Provider Name:</td>
																<td><?php echo e(provider_info($providers,$enrollee->provider_id)['hcpname']); ?></td>
															</table>
													</div>
											</fieldset>
                                            
                                            <fieldset>
                                            <div  class="preview" style="padding:3px 30px">
												<h4>Next of Kin (NOK)</h4>
                                                <table class="table  table-bordered " border="2" width="100%" id="" style="color:#000;font-size:14px" border="1">
														 <tr>
															<td>Name of Next of Kin:</td>
															<td><?php echo e($enrollee->nok_name); ?></td>
															<td>Next of Kin Phone Number:</td>
															<td> <?php echo e($enrollee->nok_phone_number); ?></td>
														</tr>
														 <tr>
															<td>Relationship:</td>
															<td colspan="3"><?php echo e($enrollee->nok_relationship); ?></td>
														</tr>
													  </table>
												  </div>
											</fieldset>



	<h3 class="panel-heading">Biometric Verification </h3>
	  <div class="panel-body">
		  <div class="row">
			<div class="col-md-6">  
					<h6>LEFT FINGER</h6>
					<table class="table table-bordered" border="2" width="90%">
						<tr>
							<td>Thump: </td>
							<td> <?php echo e(finger_text($enrollee->leftOne)); ?></td>
						</tr>
						<tr>
							<td>Index </td>
							<td> <?php echo e(finger_text($enrollee->leftTwo)); ?></td>
						</tr>
						<tr>
							<td>Middle </td>
							<td><?php echo e(finger_text($enrollee->leftThree)); ?> </td>
						</tr>
						<tr>
							<td>Ring </td>
							<td> <?php echo e(finger_text($enrollee->leftFour)); ?></td>
						</tr>
						<tr>
							<td>Baby </td>
							<td><?php echo e(finger_text($enrollee->leftFive)); ?> </td>
						</tr>
					</table>
					
					<div>
						
					</div>
			</div>
			<div class="col-md-6">  
				<h6>RIGHT FINGER</h6>
					<table class="table table-bordered" border="2" width="90%">
						<tr>
							<td>Thump </td>
							<td> <?php echo e(finger_text($enrollee->rightOne)); ?></td>
						</tr>
						<tr>
							<td>Index </td>
							<td><?php echo e(finger_text($enrollee->rightTwo)); ?> </td>
						</tr>
						<tr>
							<td>Middle </td>
							<td><?php echo e(finger_text($enrollee->rightThree)); ?> </td>
						</tr>
						<tr>
							<td>Ring </td>
							<td> <?php echo e(finger_text($enrollee->rightFour)); ?></td>
						</tr>
						<tr>
							<td>Baby </td>
							<td><?php echo e(finger_text($enrollee->rightFive)); ?> </td>
						</tr>
					</table>
					
				
			</div>
		  
				<div>
					<?php if(!empty($enrollee->biometricComplain)): ?>
						<h2 class="text-danger">Finger print issues: <strong ><?php echo e($enrollee->biometricComplain); ?></strong></h2>
					<?php endif; ?>
				</div>
		  
		         <div>
					<?php if(!empty($enrollee->biometricComplain)): ?>
						<div style="">
						    
						    <?php
						    
						        	$string = file_get_contents("https://ngscha.ni.gov.ng/apps/enrollees_data/biometrics/$enrollee->id.json");
                                	$json_data = json_decode($string, true);
                                	$passport = $json_data['fingersPhoto'];
                                	
                                	echo '<img src="data:image/jpeg;base64,'.$passport.'" width="200px" />';
						    ?>
						</div>
					<?php endif; ?>
				</div>
		  
		 
		  </div>
	  </div>



	  <P class="text-right">
		     <select id="approval_comment" name="approval_comment">
	        <option value="None">None</option>
	        <option value="Poor Image Issue">Bad Image Issue</option>
	         <option value="Biometric Issue">Biometric Issue</option>
	        <option value="Poor Image Issue & Biometric Issue">Bad Image Issue & Biometric Issue</option>
	       
	    </select>
			<button class="btn btn-success"  id="approve_btn" onclick="approve_reject_enrolment(<?php echo e($enrollee->id); ?>,1)" 
			<?php echo e(($enrollee->enrolment_approval_status != '0' ? 'disabled' :'')); ?>>Approve Enrolment</button>
			<button type="submit" class="btn btn-danger" id="reject_btn" onclick="approve_reject_enrolment(<?php echo e($enrollee->id); ?>,2)" 
			<?php echo e(($enrollee->enrolment_approval_status != '0' ? 'disabled' :'')); ?>>Approve Enrolment With Issue</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</P> 
	
	<p class="text-right">
	   
	    
	</p>
	<br/>
	<div class="well well-sm ">
	    <h5>Officers approving enrolment should carefully checked the enrolee's data and ensure accuracy in all the data before approving or rejecting the enrolment data. </h5>
	    	<p class="text-center"> Click here to modify record <button class="btn btn-primary" title="Update Record" onclick="load_edit_enrollee_info(<?php echo e($enrollee->id); ?>)">Edit Record <i class="fa fa-edit" style="color:#fff"></i></button></p>
	    
	</div>
<?php /**PATH C:\Users\AshlabTech\Desktop\projects\nicare-eims\resources\views/enrolment/enrollee_info_with_biometric.blade.php ENDPATH**/ ?>