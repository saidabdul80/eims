<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator,Redirect,Response;
use JWTAuth;
use App\User;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Enrollee;
use App\Provider;
use App\Tpa;


class settingsController extends Controller
{
    public function configure_bed(){

        $devices = DB::table('user_mobile_details')->where('status','1')->get();
        $tpas = Tpa::where('status','1')->get();

         $staff_list = DB::table('users')->where('user_role_id',20)->where('status','1')->get();
        $huwe_staff = DB::Select("SELECT u.*,hsd.device FROM  users u inner join huwe_staff_device hsd on u.id=hsd.user_id where u.user_role_id=20 AND u.status='1'");
        $device_lga = DB::Select("SELECT l.lga,md.device,dl.id,dl.state,dl.device_id,dl.lga lga_id FROM  huwe_device_lga dl inner join lga l
        ON dl.lga = l.id inner join user_mobile_details md on dl.device_id = md.id  
        WHERE   dl.status='1' ORDER BY md.device");
        $huwe_device_assignment_config =  DB::table('tbl_device_assignment_configuration')->where('config_type','HUWE_DEVICE_ASSIGNMENT')->first();
       
        $data = ['tpas' =>$tpas, 'devices' => $devices, 'huwe_staff' =>$huwe_staff, 'staff_list'=> $staff_list, 'device_lga'=>$device_lga,'huwe_device_assignment_config'=>$huwe_device_assignment_config];
        return view('settings.configure_bed', compact('data'));
    }

    public function create_new_nicare_device(Request $request){
        request()->validate([
            'tpa_code' => 'required',
         ]);

        $tpa_code = $request->get('tpa_code');
        $tpa_last_device_array = DB::Select("select device from user_mobile_details where device like '$tpa_code%' and status ='1' ORDER BY id DESC LIMIT 1");
        if(count($tpa_last_device_array)> 0){
            $tpa_last_device = $tpa_last_device_array[0];
            $device = $tpa_last_device->device;
            $dev = preg_replace('#[/]#i', '+', $device);
			$dev_split = explode('+',$dev);
			
			 $count = intval($dev_split[3]) + 1;
        }else{
            $count = 1;
        }

        $current_date = date('Y-m-d h:i:s');
        $code = random_int(9999, 99999);
        $activation_code = 'NGS-'.$code;
        $date_expired = date('Y-m-d h:i:s', strtotime("+75 minutes", strtotime($current_date)));

        
        $all_device = $this->pad_zeros(4,$count).$count;
        $deviceId = $tpa_code.'/BED/'.$all_device;
       ///dd($deviceId);
        $is_id_exist = DB::table('user_mobile_details')->where('device', $deviceId)->where('status','1')->first();

        if(empty($is_id_exist)){
            
            $execute = DB::table('user_mobile_details')->insert([
                ['activation_code' => $code, 
                'device' => $deviceId, 
                'tpa_code' => $tpa_code,
                'code_expiration_time' => $date_expired,
                'deviceStatus' => '1',
                ]
            ]); 
        }else{
            $id = $is_id_exist->id;
            $execute = DB::table('user_mobile_details')->where('id', $id)
            ->update([
                ['activation_code' => $code, 
                'code_expiration_time' => $date_expired,
                'deviceStatus' => '1',
                ]
            ]); 
        }

        if($execute){
            return  redirect()->route('settings.configure-bed')->with('success','Created successfully...Activation code is '.$activation_code);
        }else{
            return  redirect()->route('settings.configure-bed')->with('error','Oops! Something went wrong...');
        }
       
    }
    
     public function create_new_encounter_device(Request $request){
        request()->validate([
            'provider_id' => 'required',
         ]);

        $provider_id = $request->get('provider_id');
        $tpa_last_device_array = DB::Select("select device from user_mobile_details where  provider_id =  '$provider_id' and status ='1' ORDER BY id DESC LIMIT 1");
        if(count($tpa_last_device_array)> 0){
            $tpa_last_device = $tpa_last_device_array[0];
            $device = $tpa_last_device->device;
            $dev = preg_replace('#[/]#i', '+', $device);
			$dev_split = explode('+',$dev);
			
			 $count = intval($dev_split[3]) + 1;
        }else{
            $count = 1;
        }

        $current_date = date('Y-m-d h:i:s');
        $code = random_int(9999, 99999);
        $activation_code = 'NGS-'.$code;
        $date_expired = strtotime("+15 minutes", strtotime($current_date));

        $provider = DB::table('tbl_providers')->where('id',$provider_id)->first();
        $all_device = $this->pad_zeros(4,$count).$count;
        $deviceId = $provider->hcpcode.'/FERD/'.$all_device;
       ///dd($deviceId);
        $is_id_exist = DB::table('user_mobile_details')->where('device', $deviceId)->where('status','1')->first();

        if(empty($is_id_exist)){
            
            $execute = DB::table('user_mobile_details')->insert([
                ['activation_code' => $code, 
                'device' => $deviceId, 
                'tpa_code' => 'Provider',
                'provider_id' => $provider_id,
                'code_expiration_time' => $date_expired,
                'deviceStatus' => '1',
                ]
            ]); 
        }else{
            $id = $is_id_exist->id;
            $execute = DB::table('user_mobile_details')->where('id', $id)
            ->update([
                ['activation_code' => $code, 
                'code_expiration_time' => $date_expired,
                'deviceStatus' => '1',
                ]
            ]); 
        }

        if($execute){
             return  Redirect::to('/configure-bed?encounter')->with('success','Created successfully...Activation code is '.$activation_code);
        }else{
            return  Redirect::to('/configure-bed?encounter')->with('error','Opps! something went wrong...');
        }
       
    }

    public function execute_device_operation(Request $request){
        request()->validate([
            'device_id' => 'required',
            'device_action' => 'required',
            'reason' => 'required',
         ]);

            
         $device_id = $request->get('device_id');
         $device_action = $request->get('device_action');
         $reason = $request->get('reason');

         if($device_action == 'Re-generate-Code'){
            $execute_response = $this->regenerate_code($device_id,$reason);
            $execute = $execute_response['status'];
         }else if($device_action == 'suspend-device'){
            $execute = $this->suspend_block_device($device_id,'2', $reason);
         }else if($device_action == 'block-device'){
            $execute = $this->suspend_block_device($device_id,'0',$reason);
         }
         if($execute){
            if($device_action == 'Re-generate-Code')
                 return  redirect()->route('settings.configure-bed')->with('success','Operation Executed successfully...Activation code is '.$execute_response["code"]);
            else
                 return  redirect()->route('settings.configure-bed')->with('success','Operation Executed successfully...');
        }else{
            return  redirect()->route('settings.configure-bed')->with('error','Oops! Something went wrong...');
        }
    }
    
    private function regenerate_code($id,$reason){
        $current_date = date('Y-m-d h:i:s');
        $code = random_int(9999, 99999);
        $activation_code = 'NGS-'.$code;
        $date_expired = date('Y-m-d h:i:s', strtotime("+75 minutes", strtotime($current_date)));
        $execute = DB::table('user_mobile_details')->where('id', $id) 
        ->update(['activation_code' => $code, 
        'block_suspend_reason' => $reason, 
        'deviceIMEI' => null,
        'deviceModel' => null,
        'deviceId' => null,
        'code_expiration_time' => $date_expired,
        'deviceStatus' => '1']); 
        return ['status'=>$execute, 'code'=> $activation_code] ;

    }

    private function suspend_block_device($id,$deviceStatus,$reason){
        $execute = DB::table('user_mobile_details')->where('id', $id)->update(['block_suspend_reason' => $reason, 'deviceStatus' => $deviceStatus ]); 
        return $execute;
     }


    private function pad_zeros($length,$number){
            $preceeding_zero='';
            if(strlen($number) <= $length){
                    for($i=1;$i<=($length - strlen($number));$i++){
                        $preceeding_zero .= '0';
                    }
            }

            return $preceeding_zero;
    }


    public function assign_lga_to_device(Request $request){
        request()->validate([
            'device_id' => 'required',
            'lga_id' => 'required',
            'action' => 'required',
         ]);

         $lga = $request->get('lga_id');
         $device_id = $request->get('device_id');
         $action = $request->get('action');
        
         if($action == 'assign'){
            $huwe_device_assignment_config =  DB::table('tbl_device_assignment_configuration')->where('config_type','HUWE_DEVICE_ASSIGNMENT')->first();
            if($huwe_device_assignment_config->action == 'SINGLE_LGA'){
                $execute = DB::table('huwe_device_lga')->where('status', '1')->where('lga', $lga)->update(['status' => '0']); 
            }

            $execute = DB::table('huwe_device_lga')->insert([
                ['device_id' => $device_id, 
                'lga' => $lga, 
                ]
            ]);
         
         }else{
            $execute = DB::table('huwe_device_lga')->where('device_id', $device_id)->where('lga', $lga)->update(['status' => '0']); 
         }
         
         
         if($execute)
            return  Redirect::to('/configure-bed?huwe')->with('success','Executed successfully...');
        else
            return  Redirect::to('/configure-bed?huwe')->with('error','Oops! something wend wrong...');
            

        }

        public function make_device_lga_active($id){
            $device_lga = DB::table('huwe_device_lga')->where('id', $id)->first();

            $lga = $device_lga->lga;
            $device_id = $device_lga->device_id;
             DB::table('huwe_device_lga')->where('device_id', $device_id)->update(['state' => 'Not Active']); 
             $execute = DB::table('huwe_device_lga')->where('id', $id)->update(['state' => 'Active']); 
             if($execute)
                return  Redirect::to('/configure-bed?huwe')->with('success','L.G.A Made active successfully...');
            else
                return  Redirect::to('/configure-bed?huwe')->with('error','Oops! something wend wrong...');
        }

        public function make_device_lga_inactive($id){
           
             $execute = DB::table('huwe_device_lga')->where('id', $id)->update(['state' => 'Not Active']); 
             if($execute)
                return  Redirect::to('/configure-bed?huwe')->with('success','L.G.A Made in-active successfully...');
            else
                return  Redirect::to('/configure-bed?huwe')->with('error','Oops! something wend wrong...');
        }

        
        public function assign_device_to_staff(Request $request){
            request()->validate([
                'action' => 'required',
             ]);

             $action = $request->get('action');
             $user_id = $request->get('user_id');
             if($action == 'assign'){
                request()->validate([
                    'device' => 'required',
                    'user_id' => 'required',
                 ]);

                
                 $device = $request->get('device');

                 $is_exist = DB::table('huwe_staff_device')->where('user_id', $user_id)->where('status', '1')->first();
                 if(!empty($is_exist)){
                    return  Redirect::to('/configure-bed?huwe')->with('error','The staff is already assigned a device');
                 }

                  DB::table('huwe_staff_device')->insert([
                    ['user_id' => $user_id, 
                    'device' => $device, 
                    ]
                ]);
                return  Redirect::to('/configure-bed?huwe')->with('success','Device assigned to staff successfully...');
             }else{
                request()->validate([
                    'user_id' => 'required',
                 ]);

                 DB::table('huwe_staff_device')->where('user_id', $user_id)->delete();
                 return  Redirect::to('/configure-bed?huwe')->with('success','Device de-assigned from staff successfully...');
             }


         }

         public function create_huwe_staff(Request $request){
            request()->validate([
                'surname' => 'required',
                'other_name' => 'required',
                'phone_number' => 'required',
                'password' => 'required',
                'c_password' => 'required',
                
             ]);
            
             $password = $request->get('password');
             $c_password = $request->get('c_password');
             if($c_password != $password){
                return  Redirect::to('/configure-bed?huwe')->with('error','Password did not match...');
             }
             $password_salt= md5('ishan').md5($password).md5('tonic-health');

             $total_count = DB::table('users')->where('user_role_id', 20)->count();
             $total_count = $total_count + 1;
             $serial_number = $this->pad_zeros(4, $total_count).$total_count;
            $nicare_code = 'NGSCHA/STAFF/'.$serial_number;
            

             DB::table('users')->insert([
                ['surname' => $request->get('surname'), 
                'first_name' => $request->get('other_name'), 
                'other_name' => '', 
                'nicare_code' => $nicare_code, 
                'password' => $password_salt, 
                'phone_number' => $request->get('other_name'),
                'user_role_id' => 20, 
                'created_by' => Auth::id(), 
                ]
            ]);

            return  Redirect::to('/configure-bed?huwe')->with('success','Staff profile created successfully...');
           
         }

}
