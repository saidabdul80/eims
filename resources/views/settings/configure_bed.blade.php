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
@extends('layouts/master')
@section('content-body')

  <br/>
  <br/>
<div class="container">
    <div role="tabpanel">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="{{$nicare_active}}"><a href="#home" aria-controls="home" role="tab" name="nicare-tab" data-toggle="tab"><strong>NiCare Enrolment Devices</strong> </a></li>
        <li role="presentation" class="{{$huwe_active}}"><a href="#profile" name="huwe-tab" aria-controls="profile" role="tab" data-toggle="tab"><strong>Huwe Enrolment Devices</strong> </a></li>
        <li role="presentation" class="{{$encounter_active}}"><a href="#encounter-devices" name="huwe-tab" aria-controls="encounter-devices" role="tab" data-toggle="tab"><strong>Encounter  Devices</strong> </a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
        <div role="tabpanel" class="tab-pane {{$nicare_active}}" id="home">
        @if (session()->exists('error'))
                <hr/>
                    <div class="alert alert-danger">
                        {{ session('error')}}
                    </div>
            @endif

            @if (session()->exists('success'))
                <hr/>
                    <div class="alert alert-success">
                        {{ session('success')}}
                    </div>
            @endif
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
                                    @foreach($nicare_devices as $nicare_device)

                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>{{$nicare_device->device}}</td>
                                            <td>{{$nicare_device->tpa_code}}</td>
                                            <td>{{ empty($nicare_device->deviceIMEI) ? 'Not Activated' : 'Activated'}}</td>
                                            @if($nicare_device->deviceStatus == '1')
                                                 <td>Active</td>
                                            @elseif($nicare_device->deviceStatus == '0')
                                             <td>Blocked</td>
                                            @elseif($nicare_device->deviceStatus == '2')
                                             <td>Suspended</td>
                                            @else
                                            <td>-</td>
                                            @endif
                                            
                                            <td>
                                                <button class="btn btn-primary"><i class="fa fa-eye" style="color:#fff"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                          </table>
                    </div>
                </div>
                <div class="col-md-4">
                      <div style="padding:20px;margin:20px; border:1px dashed #08c">
                            <h4>New Device Form</h4>
                            <form action="{{route('settings.create-new-nicare-device')}}" method="post">
                            {{ csrf_field() }}
                                <div class="form-group">
                                    <select name="tpa_code" id="" class="form-control" style="padding-top:3px">
                                        <option value=""> Select Organization </option>
                                        @foreach($tpas as $tpa)
                                             <option value="{{$tpa->tpa_code}}"> {{$tpa->tpa_code}} - {{$tpa->organisation}} </option>

                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                   <button class="btn btn-primary form-control">Create Device</button>
                                </div>
                                @if ($errors->any())
                                    <hr/>
                                    @foreach($errors->all() as $err)
                                        <div class="alert alert-danger">
                                            {{ $err}}
                                        </div>
                                    @endforeach
                                @endif
                            </form>
                    </div>

                    <div style="padding:20px;margin:20px; border:1px dashed #08c">
                            <h4> Device Operations</h4>
                            <form action="{{route('settings.execute-device-operation')}}" method="post">
                            {{ csrf_field() }}
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
                                        @foreach($nicare_devices as $nicare_device)
                                             <option value="{{$nicare_device->id}}"> {{$nicare_device->device}} </option>

                                        @endforeach
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
        <div role="tabpanel" class="tab-pane {{$huwe_active}}" id="profile">

        @if (session()->exists('error'))
                <hr/>
                    <div class="alert alert-danger">
                        {{ session('error')}}
                    </div>
            @endif

            @if (session()->exists('success'))
                <hr/>
                    <div class="alert alert-success">
                        {{ session('success')}}
                    </div>
            @endif
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
                                    @foreach($huwe_devices as $nicare_device)

                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>{{$nicare_device->device}}</td>
                                            <td>{{$nicare_device->tpa_code}}</td>
                                            <td>{{ empty($nicare_device->deviceIMEI) ? 'Not Activated' : 'Activated'}}</td>
                                            @if($nicare_device->deviceStatus == '1')
                                                 <td>Active</td>
                                            @elseif($nicare_device->deviceStatus == '0')
                                             <td>Blocked</td>
                                            @elseif($nicare_device->deviceStatus == '2')
                                             <td>Suspended</td>
                                            @else
                                            <td>-</td>
                                            @endif
                                            
                                            <td>
                                                <button class="btn btn-primary"><i class="fa fa-eye" style="color:#fff"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
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
                                    @foreach($device_lgas as $device_lga)
                                          
                                        <?php array_push($device_lga_list,$device_lga->lga_id); ?>
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>{{$device_lga->device}}</td>
                                            <td>{{$device_lga->lga}}</td>
                                            <td>{{$device_lga->state}}</td>
                                            <td>
                                                @if($device_lga->state == 'Active')
                                                 <a href="{{route('settings.make-device-lga-inactive',[$device_lga->id])}}" class="btn btn-danger" title="Make inactive"><i class="fa fa-close" style="color:#fff"></i></a>
                                                @else
                                                  <a href="{{route('settings.make-device-lga-active',[$device_lga->id])}}" class="btn btn-success" title="Make Active"><i class="fa fa-check" style="color:#fff"></i></a>
                                                @endif
                                                
                                            </td>
                                        </tr>
                                    @endforeach

                                  
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
                                    @foreach($staff_list as $staff)
                                        <?php 
                                              
                                            $device ='';
                                            $staff_device_info = collect($huwe_staff)->where('id',$staff->id)->first();
                                            
                                            if(!empty($staff_device_info)){
                                                $device = $staff_device_info->device;
                                            }
                                        ?>
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>{{$staff->surname.' '.$staff->first_name.' '.$staff->other_name}}</td>
                                            <td>{{$staff->nicare_code}}</td>
                                            <td>{{$device}}</td>
                                            <td>{{$staff->phone_number}}</td>
                                            
                                            <td>
                                                <button class="btn btn-primary"><i class="fa fa-eye" style="color:#fff"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                          </table>
                    </div>
                     <!-- -------------------------------------------------------END HUWE ENROLMENT OFFICERS--------------------------------------- -->



                </div>
                <div class="col-md-4">
                      <div style="padding:20px;margin:20px; border:1px dashed #08c">
                            <h4>New Device Form</h4>
                            <form action="{{route('settings.create-new-nicare-device')}}" method="post">
                            {{ csrf_field() }}
                                <div class="form-group">
                                    <select name="tpa_code" id="" class="form-control" style="padding-top:3px">
                                        <option value="NGSCHA/HUWE"> NGSCHA/HUWE </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                   <button class="btn btn-primary form-control">Create Device</button>
                                </div>
                                @if ($errors->any())
                                    <hr/>
                                    @foreach($errors->all() as $err)
                                        <div class="alert alert-danger">
                                            {{ $err}}
                                        </div>
                                    @endforeach
                                @endif
                            </form>
                    </div>

                    <div style="padding:20px;margin:20px; border:1px dashed #08c">
                            <h4> L.G.A <code><i class="fa fa-chain"></i></code> DEVICE</h4>
                            <div class="alert alert-info">
                                   <small> <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong>NEW:</strong>  Huwe Biometric Enrollment Device (BED) can now be assigned to multiple L.G.A base on configuration.
                                    <p>The current configurtion is: <strong>{{$action_}}</strong></p>
                                    </small>
                             </div>
                            <form action="{{route('settings.assign-lga-to-device')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                    <select name="action" id="" class="form-control" style="padding-top:1px" required>
                                        <option value="assign"> Assign device</option>
                                        <option value="de-assign"> De-assign device</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="device_id" id="" class="form-control" style="padding-top:1px" required>
                                        <option value=""> Select Device </option>
                                        @foreach($huwe_devices as $nicare_device)
                                             <option value="{{$nicare_device->id}}"> {{$nicare_device->device}} </option>

                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="lga_id" id="" class="form-control" style="padding-top:1px" required>
                                        <option value=""> Select LGA </option>
                                        @foreach($lgas as $lga)
                                            @if($action_ == 'MULTIPLE_LGA')
                                                <option value="{{$lga->id}}"> {{$lga->lga}} </option>
                                            @else
                                                @if(!in_array($lga->id, $device_lga_list))
                                                    <option value="{{$lga->id}}"> {{$lga->lga}} </option>
                                                @endif
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                   <button class="btn btn-primary form-control">Assign Device NOW!</button>
                                </div>
                               
                            </form>
                    </div>


                    <div style="padding:20px;margin:20px; border:1px dashed #08c">
                            <h4> NEW ENROLMENT OFFICER </h4>
                            
                            <form action="{{route('settings.create-huwe-staff')}}" method="post">
                            {{ csrf_field() }}
                            <p> <input type="text" class="form-control"  placeholder="Surname" name="surname" value="{{old('surname')}}" required></p><br>
                            <p> <input type="text" class="form-control"  placeholder="Other names" name="other_name" value="{{old('other_name')}}" required></p><br>
                            <p> <input type="text" class="form-control"  placeholder="Phone number" name="phone_number" value="{{old('phone_number')}}" required></p><br>
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
                            
                            <form action="{{route('settings.assign-device-to-staff')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                    <select name="action" id="" class="form-control" style="padding-top:1px" required>
                                        <option value="assign"> Assign device</option>
                                        <option value="de-assign"> De-assign device</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="user_id" id="" class="form-control" style="padding-top:1px" required>
                                        <option value=""> Select STAFF </option>
                                        @foreach($staff_list as $staff)
                                          <option value="{{$staff->id}}"> {{$staff->nicare_code}} </option>
                                          
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="device" id="" class="form-control" style="padding-top:1px" >
                                        <option value=""> Select Device </option>
                                        @foreach($huwe_devices as $nicare_device)
                                        <?php 
                                             $staff_device_info = collect($huwe_staff)->where('device',$nicare_device->device)->first();
                                            
                                        ?>
                                            @if(empty($staff_device_info))
                                                <option value="{{$nicare_device->device}}"> {{$nicare_device->device}} </option>
                                            @endif

                                        @endforeach
                                    </select>
                                </div>
                               
                                <div class="form-group">
                                   <button class="btn btn-primary form-control">Assign Device NOW!</button>
                                </div>
                               
                            </form>
                    </div>

                    <div style="padding:20px;margin:20px; border:1px dashed #08c">
                            <h4> Device Operations</h4>
                            <form action="{{route('settings.execute-device-operation')}}" method="post">
                            {{ csrf_field() }}
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
                                        @foreach($huwe_devices as $nicare_device)
                                             <option value="{{$nicare_device->id}}"> {{$nicare_device->device}} </option>

                                        @endforeach
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
		
		<div role="tabpanel" class="tab-pane {{$encounter_active}}" id="encounter-devices">

        @if (session()->exists('error'))
                <hr/>
                    <div class="alert alert-danger">
                        {{ session('error')}}
                    </div>
            @endif

            @if (session()->exists('success'))
                <hr/>
                    <div class="alert alert-success">
                        {{ session('success')}}
                    </div>
            @endif
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
                                    @foreach($encounter_devices as $encounter_device)

                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>{{$encounter_device->device}}</td>
                                            <td>{{provider_name($providers,$encounter_device->provider_id)}}</td>
                                            <td>{{ empty($encounter_device->deviceIMEI) ? 'Not Activated' : 'Activated'}}</td>
                                            @if($encounter_device->deviceStatus == '1')
                                                 <td>Active</td>
                                            @elseif($encounter_device->deviceStatus == '0')
                                             <td>Blocked</td>
                                            @elseif($encounter_device->deviceStatus == '2')
                                             <td>Suspended</td>
                                            @else
                                            <td>-</td>
                                            @endif
                                            
                                            <td>
                                                <button class="btn btn-primary"><i class="fa fa-eye" style="color:#fff"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                          </table>
				
				</div>
				
				 <div class="col-md-4">
                      <div style="padding:20px;margin:20px; border:1px dashed #08c">
                            <h4>New Device Form</h4>
                            <form action="{{ route('settings.create-new-encounter-device')}}" method="post">
                            {{ csrf_field() }}
                                <div class="form-group">
                                    <select name="provider_id" id="provider_id" class="form-control" style="padding-top:3px">
                                        <option value=""> Select Provider </option>
                                        @foreach($secondary_providers as $provider)
                                             <option value="{{$provider->id}}"> {{$provider->hcpname}} - {{$provider->hcpcode}} </option>

                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                   <button class="btn btn-primary form-control">Create Device</button>
                                </div>
                                @if ($errors->any())
                                    <hr/>
                                    @foreach($errors->all() as $err)
                                        <div class="alert alert-danger">
                                            {{ $err}}
                                        </div>
                                    @endforeach
                                @endif
                            </form>
                    </div>
				
				</div>
            </div>

        </div>
		
		
        </div>

        </div>
   
</div>
   @include('layouts.modal');
@endsection
@section('scripts_section')
<script>


$('#myTab a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})
</script>


@endsection