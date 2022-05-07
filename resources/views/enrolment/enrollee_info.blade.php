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

?>
<div  class="preview" style="padding:20px 30px">
    <div class="text-center">

        @if($enrollee->mode_of_enrolment == 'Premium')
			<img src="{{env('FULL_APP_URL')}}apps/img/slip_heading.PNG"/>
         @else
			<img src="{{env('FULL_APP_URL')}}apps/img/huwe_slip_heading.png"/>
        @endif

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
    <p class="text-right" style="text-align:right !important"><img src="https://ngscha.ni.gov.ng/apps/img_data/enrollees/{{$enrollee->id}}.jpg"  style="float:right" width="120px" height="120px" alt="passport"/></p>

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
																	<td>LGA :</td>
																	<td>{{lga_name($lgas,$enrollee->lga)}}
																	</td>
																	<td>Ward:</td>
																	<td>{{ward_name($wards,$enrollee->ward)}}
																	</td>
																</tr>
																<tr>
																<td>Benefit Plan:</td>
																<td>{{$enrollee->benefit_plan}}</td>
																<td>Choice of Provider:</td>
																<td>{{provider_name($providers,$enrollee->provider_id)}}</td>
															</tr>
																<tr>
																	<td>Address:</td>
																	<td>{{$enrollee->address}}</td>
																	<td>Date Enroled:</td>
																	<td>{{$enrollee->enrol_date}}</td>
																</tr>
																
																<tr>
																	<td colspan="4"><h5>National Identification Number (NIN):  {{$enrollee->nin}}</h5></td>
																</tr>
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


