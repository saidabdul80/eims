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
                                                                <p><input type="text" class="form-control" name="surname" value="{{$enrollee->surname}}" id="surname" placeholder="Surname" required></p>
                                                        
                                                            </div>
                                                            
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                  <label for="surname">FIRST NAME<span class="asterik asterik_other_name"></span></label>
                                                                <p><input type="text" class="form-control" name="first_name" value="{{$enrollee->first_name}}" id="first_name" placeholder="First Name" required></p>
                                                            </div>
                                                            
                                                        </div>
                                                        
                                                        <!-- column -->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                  <label for="marital_status"> OTHER NAME <span class="asterik asterik_marital_status">*</span></label>
                                                                <p><input type="text" class="form-control" name="other_name"  value="{{$enrollee->other_name}}" id="other_name" placeholder="Other Name" ></p>
                                                            
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                  <label for="marital_status">Marital Status</label>
                                                                <p>
                                                                    <select class="form-control" name="marital_status" id="marital_status">
                                                                        <option value="" > </option>
                                                                        <option value="Married" {{ $enrollee->marital_status == 'Married' ? 'selected' : ''}} > Married</option>
                                                                        <option value="Single" {{$enrollee->marital_status == 'Single' ? 'selected' : ''}}> Single</option>
                                                                        <option value="Divorced" {{$enrollee->marital_status == 'Divorced' ? 'selected' : '' }} > Divorced</option>
                                                                        <option value="Widow" {{$enrollee->marital_status == 'Widow' ? 'selected' : '' }} > Widow</option>
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
                                                                        <option value="Male" {{ $enrollee->sex == 'Male' ? 'selected' : ''}} > Male</option>
                                                                        <option value="Female" {{$enrollee->sex == 'Female' ? 'selected' : ''}}> Female</option>
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
                                                                        <p><input type="text" class="form-control" name="phone_number"  id="phone_number" value="{{$enrollee->phone_number}}" placeholder="Phone Number" required></p>
                                                                    </div>
                                                                    
                                                                </div>
                                                                <!-- column /-->
                                                                
                                                                <!-- column -->
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                          <label for="occupation">Occupation</label>
                                                                        <p><input type="text" class="form-control" name="occupation"  id="occupation" value="{{$enrollee->occupation}}" placeholder="Occupation" required></p>
                                                                    </div>
                                                                    
                                                                </div>
                                                                <!-- column /-->
                                                                <!-- column -->
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                          <label for="email_address">Email Address</label>
                                                                        <p><input type="text" class="form-control" name="email_address" value="{{$enrollee->email_address}}"  id="email_address" placeholder="Email Address" ></p>
                                                                    </div>
                                                                    
                                                                </div>
                                                                <div class="col-md-6">
                                                            <div class="form-group">
                                                                  <label for="marital_status">Settlement</label>
                                                                <p>
                                                                    <select class="form-control" name="settlement" id="settlement">
                                                                        <option value="" > </option>
                                                                        <option value="Rural" {{ $enrollee->settlement == 'Rural' ? 'selected' : ''}} > Rural</option>
                                                                        <option value="Urban" {{$enrollee->settlement == 'Urban' ? 'selected' : ''}}> Urban</option>
                                                                    </select>
                                                                </p>
                                                            </div>
                                                            
                                                        </div>
                                                                <!-- column /-->
                                                                 <!-- column -->
                                                                 <div class="col-md-6">
                                                                    <div class="form-group">
                                                                          <label for="nin">National Identification Number (NIN)</label>
                                                                        <p><input type="text" class="form-control" name="nin" value="{{$enrollee->nin}}"  id="nin" placeholder="NIN" ></p>
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
                                                                    @foreach($lgas as $lga)
                                                                         <option value="{{$lga->id}}" {{($enrollee->lga == $lga->id ? 'selected' : '')}}>{{$lga->lga}}</option>
                                                                    @endforeach
                                                                    
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                  <label for="surname">Ward<span class="asterik asterik_surname">*</span> </label>
                                                                <select class="form-control" id="ward"  name="ward"  required>
                                                                    <option value="{{$enrollee->ward}}">{{ ward_name($wards,$enrollee->ward)}}</option>

                                                                    @foreach($wards as $ward)
                                                                         @if($ward->lga_id == $enrollee->lga)
                                                                            <option value="{{$ward->id}}" {{($enrollee->ward == $ward->id ? 'selected' : '')}}>{{$ward->ward}}</option>
                                                                          @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                        </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                              <label for="address">Address <span class="asterik asterik_ministry">*</span></label>
                                                            <p>
                                                                    <p><input type="text" class="form-control" id="address" name="address" value="{{$enrollee->address}}" id="address"  placeholder="address" ></p>

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
                                                                    @foreach($lgas as $lga)
                                                                         <option value="{{$lga->id}}" {{(provider_info($providers,$enrollee->provider_id)['hcplga'] == $lga->id ? 'selected' : '')}}>{{$lga->lga}}</option>
                                                                    @endforeach
                                                                    
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                  <label for="surname">Ward<span class="asterik asterik_surname">*</span> </label>
                                                                <select class="form-control" id="ward2"  name="ward2" onchange="load_user_provider(this.value)" required>
                                                                    <option value="{{$enrollee->ward}}">{{ ward_name($wards,provider_info($providers,$enrollee->provider_id)['hcpward'])}}</option>


                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                  <label for="provider">CHOICE OF PROVIDER<span class="asterik asterik_choice_of_providers">*</span> </label>
                                                                <p><select class="form-control" name="provider" id="provider" style=""  required>
                                                                    <option value="{{$enrollee->provider_id}}">{{provider_name($providers,$enrollee->provider_id)}}</option>
                                                                </select>
                                                                </p>
                                                            </div>
                                                        </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                              <label for="address">Address <span class="asterik asterik_ministry">*</span></label>
                                                            <p>
                                                                    <p><input type="text" class="form-control"value="{{provider_info($providers,$enrollee->provider_id)['hcpaddress']}}"   placeholder="address" readonly></p>

                                                            </p>
                                                        </div>

                                                    </div>
                                                </fieldset>
                                                <fieldset>
                                        <legend>Next of Kin (NOK) Details: </legend>

                                        <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="surname">NOK Name:</label>
                                        <p><input type="text" class="form-control" name="nok_name" value="{{$enrollee->nok_name}}" id="nok_name" placeholder="NOK Name" ></p>
                                        </div>

                                        </div>

                                        <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="surname">NOK Phone Number:</label>
                                        <p><input type="text" class="form-control" name="nok_phone_number" value="{{$enrollee->nok_phone_number}}" id="nok_phone_number" placeholder="NOK Phone Number" ></p>
                                        </div>

                                        </div>

                                        <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="nok_relationship">Relationship:</label>
                                        <p>
                                            <select class="form-control" name="nok_relationship" id="nok_relationship" required>
                                                <option value="Wife" {{($enrollee->nok_relationship == 'Spouse' ? 'selected' : '') }}> Spouse</option>
                                                <option value="Son" {{($enrollee->nok_relationship == 'Son' ? 'selected' : '') }}> Son</option>
                                                <option value="Daughter" {{($enrollee->nok_relationship == 'Daughter' ? 'selected' : '') }}> Daughter</option>
                                                <option value="Mother" {{($enrollee->nok_relationship == 'Mother' ? 'selected' : '') }}> Mother</option>
                                                <option value="Father" {{($enrollee->nok_relationship == 'Father' ? 'selected' : '') }}> Father</option>
                                                <option value="Cousin" {{($enrollee->nok_relationship == 'Cousin' ? 'selected' : '') }}> Cousin</option>
                                            </select>
                                        </p>
                                        </div>

                                        </div>
                                        </fieldset>
                                        
                                        
                                        <div id="feedback"></div>
                                        <div class="row">
                                        <div class="col-md-12 text-center">
                                        <input type="hidden" name="action" value="edit_enrolee_form_admin" required>
                                        <input type="hidden" name="enrolee_id" value="{{$enrollee->id}}" required>

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
      
    
</script>