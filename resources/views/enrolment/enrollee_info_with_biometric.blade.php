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
		    
		    if(strlen($finger) > 20){
		        	$status = '<span class="bg-success">Present</span>';
		    }else{
		        	$status = '<span class="bg-danger">Absent</span>';
		    }
		    
		}
		
		echo $status;
	}

?>


         @if($enrollee->enrolment_approval_status != '0')
                  <div class="alert alert-success"><strong>Info! </strong>Enrolment already approved</div>
        @else
           <div class="alert alert-danger"><strong>Info! </strong>Enrolment has not been approved</div>
        @endif

<div  class="preview" style="padding:20px 30px">
    <div class="text-center">
        <table style="color:#000" width="100%">

<tr >
    <td class="">
        <p class="text-left" style="font-size: 12px">
        <img src="qrcode_image.png"/>
            <br> NiCare Number.: {{$enrollee->enrolment_number}}
            <br> Date Enroled: {{$enrollee->enrol_date}}
            
            @if($enrollee->mode_of_enrolment == 'Premium')
                    <br>NIN Number: {{$enrollee->nin}}
           @else
               
                <br> BHCPF Number:  {{$enrollee->BHCPF_number}}
                <br> NIN Number:  {{$enrollee->nin}}
                <br> Category: {{$enrollee->vulnerability_status}}
            @endif
            
        </p>
        </td>

    <td class="">
        <?php
        
        try{
            
            if(strlen($enrollee->enrolee_image_link) > 20){
                $passport = $enrollee->enrolee_image_link;
            }else{
                	$string = file_get_contents("https://ngscha.ni.gov.ng/apps/enrollees_data/pictures/$enrollee->id.json");
                	//	$string = file_get_contents("/home3/ngschdqn/public_html/apps/enrollees_data/pictures/$enrollee->id.json");
        	$json_data = json_decode($string, true);
        	$passport = $json_data['passport'];
            }
        
        	
        	    echo '<p class="text-right" style="text-align:right !important"><img src="data:image/jpeg;base64,'.$passport.'"  style="float:right" width="120px" height="120px" alt="passport"/></p>';
        	
            
        }catch(Exception $e){
          echo ' ';
        }
        ?>
   

    </td>
</tr>
</table>
    </div>



    <fieldset>

                         
                         
											 <table class="table  table-bordered " border="2" width="100%" id="" style="color:#000;font-size:14px" border="1">
											 			
																	
																
                                                                @if($enrollee->mode_of_enrolment == 'Premium')
                                                                <tr>
                                                                    <td colspan="4"><h5>Enrolment Number:  <strong>{{$enrollee->enrolment_number}}</h5></strong> </td>
                                                                    </tr>
                                                                @else
                                                                 <tr>
                                                                    <td colspan="4"><h5>Enrolment Number:  <strong>{{$enrollee->enrolment_number}}</h5></strong> </td>
                                                                </tr>

                                                                @endif
																<tr>
																	<td>Surname:</td><td>{{$enrollee->surname}}</td>
																	<td>First Name:</td><td>{{$enrollee->first_name}}</td>
																</tr>
																<tr>

																	<td>Other Name:</td>
																	<td >{{$enrollee->other_name}}</td>
																	<td></td>
																	<td >
																	</td>
																</tr>
																<tr>

																	<td>Sex:</td>
																	<td ><strong>{{$enrollee->sex}}</strong></td>
																	<td>Age:</td>
																	<td >{{$enrollee->date_of_birth}}
																	</td>
																</tr>
																<tr>
																	<td>Email:</td>
																	<td>{{$enrollee->email_address}}</td>
																	<td>Phone Number:</td>
																	<td>{{$enrollee->phone_number}}</td>
																</tr>
																<tr>
																	<td>Marital Status:</td>
																	<td>{{$enrollee->marital_status}}</td>
																	<td>Occupation:</td>
																	<td>{{$enrollee->occupation}}</td>
																</tr>
																
																<tr>
																<td>Benefit Plan:</td>
																<td>{{$enrollee->benefit_plan}}</td>
															</tr>
																<tr>
																	<td>Date Enroled:</td>
																	<td colspan="3">{{$enrollee->enrol_date}}</td>
																</tr>
																
																<tr>
																	<td colspan="4"><h5>National Identification Number (NIN):  {{$enrollee->nin}}</h5></td>
																</tr>
															</table>
															
															
															<h4>Enrollee's Address</h4>
															<table class="table table-bordered">
															    
															    <tr>
																	<td>LGA :</td>
																	<td>{{lga_name($lgas,$enrollee->lga)}}
																	</td>
																	<td>Ward:</td>
																	<td>{{ward_name($wards,$enrollee->ward)}}
																	</td>
																</tr>
																	<tr>
																	<td>Address:</td>
																	<td colspan="">{{$enrollee->address}}</td>
																	<td>Settlement:</td>
																	<td colspan="">{{$enrollee->settlement}}</td>
																</tr>
															</table>
															
															<h4>Provider's Address</h4>
															<table class="table table-bordered">
															    
															    <tr>
																	<td>LGA :</td>
																	<td>{{lga_name($lgas,provider_info($providers,$enrollee->provider_id)['hcplga'])}}
																	</td>
																	<td>Ward:</td>
																	<td>{{ward_name($wards,provider_info($providers,$enrollee->provider_id)['hcpward'])}}</td>
																</tr>
																	
																<td>Provider Name:</td>
																<td>{{provider_info($providers,$enrollee->provider_id)['hcpname']}}</td>
															</table>
													</div>
											</fieldset>
                                            
                                            <fieldset>
                                            <div  class="preview" style="padding:3px 30px">
												<h4>Next of Kin (NOK)</h4>
                                                <table class="table  table-bordered " border="2" width="100%" id="" style="color:#000;font-size:14px" border="1">
														 <tr>
															<td>Name of Next of Kin:</td>
															<td>{{$enrollee->nok_name}}</td>
															<td>Next of Kin Phone Number:</td>
															<td> {{$enrollee->nok_phone_number}}</td>
														</tr>
														 <tr>
															<td>Relationship:</td>
															<td colspan="3">{{$enrollee->nok_relationship}}</td>
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
							<td> {{finger_text($enrollee->leftOne)}}</td>
						</tr>
						<tr>
							<td>Index </td>
							<td> {{finger_text($enrollee->leftTwo)}}</td>
						</tr>
						<tr>
							<td>Middle </td>
							<td>{{finger_text($enrollee->leftThree)}} </td>
						</tr>
						<tr>
							<td>Ring </td>
							<td> {{finger_text($enrollee->leftFour)}}</td>
						</tr>
						<tr>
							<td>Baby </td>
							<td>{{finger_text($enrollee->leftFive)}} </td>
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
							<td> {{finger_text($enrollee->rightOne)}}</td>
						</tr>
						<tr>
							<td>Index </td>
							<td>{{finger_text($enrollee->rightTwo)}} </td>
						</tr>
						<tr>
							<td>Middle </td>
							<td>{{finger_text($enrollee->rightThree)}} </td>
						</tr>
						<tr>
							<td>Ring </td>
							<td> {{finger_text($enrollee->rightFour)}}</td>
						</tr>
						<tr>
							<td>Baby </td>
							<td>{{finger_text($enrollee->rightFive)}} </td>
						</tr>
					</table>
					
				
			</div>
		  
				<div>
					@if(!empty($enrollee->biometricComplain))
						<h2 class="text-danger">Finger print issues: <strong >{{$enrollee->biometricComplain}}</strong></h2>
					@endif
				</div>
		  
		         <div>
					@if(!empty($enrollee->biometricComplain))
						<div style="">
						    
						    <?php
						       if(strlen($enrollee->enrolee_image_link) > 20){
						            $passport = $enrollee->enrolee_image_link;
						       }else{
						    
						        	$string = file_get_contents("https://ngscha.ni.gov.ng/apps/enrollees_data/biometrics/$enrollee->id.json");
                                	$json_data = json_decode($string, true);
                                	$passport = $json_data['fingersPhoto'];
						       }
                                	echo '<img src="data:image/jpeg;base64,'.$passport.'" width="200px" />';
						    ?>
						</div>
					@endif
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
	    @if($enrollee->enrolment_approval_status == 2)
	        <button class="btn btn-success"  id="approve_btn" onclick="approve_reject_enrolment({{$enrollee->id}},1)" >Approve Enrolment</button>
	    @else
	        <button class="btn btn-success"  id="approve_btn" onclick="approve_reject_enrolment({{$enrollee->id}},1)" {{($enrollee->enrolment_approval_status != '0' ? 'disabled' :'')}}>Approve Enrolment</button>
			<button type="submit" class="btn btn-danger" id="reject_btn" onclick="approve_reject_enrolment({{$enrollee->id}},2)" {{($enrollee->enrolment_approval_status != '0' ? 'disabled' :'')}}>Approve Enrolment With Issue</button>
	    @endif
			
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</P> 
	
	<p class="text-right">
	   
	    
	</p>
	<br/>
	<div class="well well-sm ">
	    <h5>Officers approving enrolment should carefully checked the enrolee's data and ensure accuracy in all the data before approving or rejecting the enrolment data. </h5>
	    	<p class="text-center"> Click here to modify record <button class="btn btn-primary" title="Update Record" onclick="load_edit_enrollee_info({{$enrollee->id}})">Edit Record <i class="fa fa-edit" style="color:#fff"></i></button></p>
	    
	</div>
