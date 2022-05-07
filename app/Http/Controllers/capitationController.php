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

class capitationController extends Controller
{
    public function generate_capitation(Request $request){
        
      $all_groups = DB::table('capitation_grouping')->where('status','1')->get();
        $groups = DB::Select("select  DISTINCT c.group_id, SUM(c.total_cap) cap_total, COUNT(c.provider_id) provider_total , cg.month,cg.year,cg.name,cg.month_full 
        from capitation_grouping cg inner join capitations c  on cg.id = c.group_id  where cg.status='1' and c.status='1'  group by c.group_id, cg.month,cg.year,cg.name,cg.month_full 
         ");
      
        $data = ['groups'=>$groups, 'all_groups' => $all_groups];
        return view('capitation.generate_capitation_', compact('data'));
    }

    

    public function approve_capitation(Request $request){
        
        $all_groups = DB::table('capitation_grouping')->where('status','1')->get();
          $groups = DB::Select("select  DISTINCT c.group_id, SUM(c.total_cap) cap_total, COUNT(c.provider_id) provider_total , SUM(c.total_enrolee) total_enrolee, 
           cg.month,cg.year,cg.name,cg.month_full 
           from capitation_grouping cg inner join capitations c  on cg.id = c.group_id  where cg.status='1'and c.status='1'  AND c.approval_status ='0' 
          group by c.group_id, cg.month,cg.year,cg.name,cg.month_full ");
          $data = ['groups'=>$groups, 'all_groups' => $all_groups];
          return view('capitation.approve_capitation', compact('data'));
      }

      
      public function capitation_payment(Request $request){
        
        $all_groups = DB::table('capitation_grouping')->where('status','1')->get();
        $groups = DB::Select("select  DISTINCT c.group_id, SUM(c.total_cap) cap_total, COUNT(c.provider_id) provider_total , SUM(c.total_enrolee) total_enrolee, 
         cg.month,cg.year,cg.name,cg.month_full 
         from capitation_grouping cg inner join capitations c  on cg.id = c.group_id  where cg.status='1'and c.status='1'  AND c.approval_status ='1' AND  c.payment_status ='0' 
        group by c.group_id, cg.month,cg.year,cg.name,cg.month_full ");
        $data = ['groups'=>$groups, 'all_groups' => $all_groups];
        return view('capitation.capitation_payment', compact('data'));
      }

      
  

    public function generate_capitation_info($id){
        $capitation_year = date('Y');
        $cap_month = date('m');
        if(strlen($cap_month) == 1){ $cap_month = '0'.$cap_month;}

        $capitations  = DB::table('capitations')->where('group_id',$id)->where('status','1')->get();
        $group  = DB::table('capitation_grouping')->where('id',$id)->where('status','1')->first();
        $enroled_on_before_date = $capitation_year.'-'.$cap_month.'-20';
        $enrollees = Enrollee::select('id','mode_of_enrolment','provider_id')->where('enrol_date','<=', $enroled_on_before_date)->where('status', '1')->get();
        
        if(!empty($group)){
            $data = ['group'=>$group, 'capitations' => $capitations,'enrollees' => $enrollees];

            return view('capitation.generate_capitation_info', compact('data'));
        }
            
    }

    
    public function approve_capitation_info($id){

        $capitations  = DB::table('capitations')->where('group_id',$id)->where('approval_status', '0')->where('status','1')->get();
        $group = DB::table('capitation_grouping')->where('id',$id)->where('status','1')->first();
        
        if(!empty($group)){
            $data = ['group'=>$group, 'capitations' => $capitations];

            return view('capitation.approve_capitation_info', compact('data'));
        }
            
    }
    
    
    public function approve_selected_capitation(Request $request){
        request()->validate([
            'provider_id' => 'required',
            'group_id' => 'required',
            
         ]);

         $group_id = $request->get('group_id');
         $provider_list = $request->get('provider_id');
         $save = false;
         foreach ($provider_list as $key => $provider_id) {
            $save = DB::table('capitations')->where('group_id', $group_id)->where('provider_id', $provider_id)
            ->update(['approval_status' => '1','approved_date' => now(), 'approved_by' => $this->authId()]); 
         }
         if($save)
             return Redirect::back()->with('success','Capitation is approved successfully...');
         return Redirect::back()->with('error','Capitation is not approved successfully...');
     }

     public function pay_selected_capitation(Request $request){
        request()->validate([
            'group_id' => 'required',
            
         ]);

         $group_list = $request->get('group_id');
         $save = false;
         $payment_code = $this->generateRandomString(3).date('Ymd').$this->generateRandomString(3).date('his');
         $created_by = $this->authId();
         foreach ($group_list as $key => $group_id) {
            $caps = DB::Select("SELECT SUM(total_cap) total_cap,SUM(total_enrolee) total_enrolee FROM capitations WHERE group_id=? AND approval_status='1' 
            AND payment_status='0' AND payment_code IS NULL AND status='1'",[$group_id]);

            dd($group_id);
         }
     }

    public function generate_new_capitation(Request $request){
        request()->validate([
            'provider_id' => 'required',
            'group_id' => 'required',
            
         ]);
        

         $provider_list = $request->get('provider_id');
         $group_id = $request->get('group_id');
         $user_data = session()->get('user_data');
         $user_id = $user_data->id;
        
         $save = false;
         foreach ($provider_list as $key => $provider_data) {
            $provider_data_array =  explode(":", $provider_data);
            $provider_id = $provider_data_array[0];
            $total_nicare_enrollees = IntVal($provider_data_array[1]);
            $total_huwe_enrollees = IntVal($provider_data_array[2]);
            $total_enrolee = $total_nicare_enrollees + $total_huwe_enrollees;
            $min_wait_days = 25;
            $created_by = $user_id;
            $cap_rate = 360;
            $huwe_cap_rate = 520;
            $total_cap = ($total_nicare_enrollees * $cap_rate) + ($total_huwe_enrollees * $huwe_cap_rate);
            $is_exist = DB::table('capitations')->where('group_id',$group_id)->where('provider_id',$provider_id)->where('status','1')->first();

            if(empty($is_exist)){
                $save = DB::table('capitations')->insert([
                    [
                    'group_id' => $group_id, 
                    'provider_id' => $provider_id, 
                    'total_enrolee' => $total_enrolee, 
                    'total_nicare_enrollees' => $total_nicare_enrollees, 
                    'total_huwe_enrollees' =>$total_huwe_enrollees, 
                    'total_cap' => $total_cap, 
                    'min_wait_days' => $min_wait_days, 
                    'cap_rate' => $cap_rate, 
                    'created_by' => $created_by
                    ]
                ]);
            }
            
         }


         if($save)
             return Redirect::back()->with('success','Capitation is generated successfully...');
         return Redirect::back()->with('error','Capitation is not generated successfully...');
            
    }
    
    public function new_capitation_file(Request $request){
    
        request()->validate([
            'cap_year' => 'required',
            'cap_month' => 'required',
         ]);

            $capitation_month = $request->get('cap_month');
            $capitation_year = $request->get('cap_year');

            $is_exist = DB::table('capitation_grouping')->where('month', $capitation_month)->where('year', $capitation_year)->first();
            if(!empty($is_exist)){
                return  redirect()->route('capitation.generate-capitation')->with('error','Oops! Already opened');
            }

            $month_full = $this->get_full_month($capitation_month);
            if($capitation_month==1){
                $capitation_year = $capitation_year + 1;
                $full_month = $this->get_full_month(12);
            }else{
                $full_month = $this->get_full_month($capitation_month-1);
            }

                $user_data = session()->get('user_data');
                $user_id = $user_data->id;
                

            ////// WAITING PERIOD OF I MONTH  /////////////////////////////////
            $cap_month = $capitation_month;
            if(strlen($capitation_month)==1){ $cap_month = '0'.$capitation_month;}
            $enroled_on_before_date = $capitation_year.'-'.$cap_month.'-20';
            ////// WAITING PERIOD OF I MONTH  //////////////////////////////////
            $cap_name = $full_month.' Capitation';
            $created_by = $user_id;
            $save = DB::table('capitation_grouping')->insert([
                ['name' => $cap_name, 
                'year' => $capitation_year, 
                'month' => $capitation_month, 
                'created_by' => $created_by, 
                'last_modified' => now(), 
                'month_full' => $month_full, 
                'providers_string' => '', 
                'enroled_on_before_date' => $enroled_on_before_date, 
                ]
            ]);

                if($save)
                     return  redirect()->route('capitation.generate-capitation')->with('success','Capitation is opened successfully...');
                else
                     return  redirect()->route('capitation.generate-capitation')->with('error','Oops! something went wrong');
    }


    public function load_cap_months(Request $request){
        $year = $request->get('year');
        $current_month = date('m');
            $previous_year = $year - 1;
            $next_year = $year + 1;
                                
                
                

                
            $cap_monthS_by_year = DB::table('capitation_grouping')->where('year', $year)->where('status','1')->get();/// collect($groups)->where('year', $current_year)->all();
            $exist_months = array();
            $exist_months_no = array();
            $not_exist_months = array();


            foreach($cap_monthS_by_year as $key => $month){
                $month_db = $month->month;
                array_push($exist_months_no, $month_db);
                array_push($exist_months, $month_db);
            }

            $months_array = $this->months_array();

            foreach($months_array as $key => $month){
                $month_db = $month["month"];
                    $month_db_full = $month["month_full"];
                if(!in_array($month_db+1, $exist_months_no)){
                    array_push($not_exist_months, ['month'=> $month_db, 'month_full'=>$month_db_full]);
                }	
            }

            $output ='';
            foreach($not_exist_months as $key => $month){
                $month_db = $month["month"];
                $month_db_full = $month["month_full"];
                
                if($month_db >=12){
                    $mnth =1;
                }else{
                    $mnth = $month_db + 1; 
                }
                
                
                if($year < date('Y')){
                    
                    if($mnth == 1){
                        
                        $findd = DB::table('capitation_grouping')->where('year',$year+1)->where('month',$mnth)->where('status', '1')->first();
                            if(empty($findd)){
                                $output .='<option value="'.$mnth.'">'.$month_db_full.' Capitation</option>';
                            }
                    }else{
                        $output .= '<option value="'.$mnth.'">'.$month_db_full.' Capitation</option>';
                    }
                }else if($year == date('Y')){
                    
                    ///Cap for new month only start on the 25th
                    if($month_db <= (date('m') )){
                        if($month_db < (date('m') )){
                            $output .= '<option value="'.$mnth.'">'.$month_db_full.' Capitation</option>';
                        }else if($month_db == date('m')){
                           // echo '1';
                            if(intval(date('d')) >= 25 && intval(date('d')) <=31){
                                $output .= '<option value="'.$mnth.'">'.$month_db_full.' Capitation</option>';
                            }
                        }
                    }
                }
                
            }

            echo $output;
    }

    private function months_array(){
        return [
            ['month'=> 1, 'month_full'=> 'January'],
            ['month'=> 2, 'month_full'=> 'February'],
            ['month'=> 3, 'month_full'=> 'March'],
            ['month'=> 4, 'month_full'=> 'April'],
            ['month'=> 5, 'month_full'=> 'May'],
            ['month'=> 6, 'month_full'=> 'June'],
            ['month'=> 7, 'month_full'=> 'July'],
            ['month'=> 8, 'month_full'=> 'August'],
            ['month'=> 9, 'month_full'=> 'September'],
            ['month'=> 10, 'month_full'=> 'October'],
            ['month'=> 11, 'month_full'=> 'November'],
            ['month'=> 12, 'month_full'=> 'December']
        ];
    }

    private function get_full_month($mth){
        $months_array = $this->months_array();
        
        foreach($months_array as $key => $month){
             $month_db = $month["month"];
                $month_db_full = $month["month_full"];
             if($mth == $month_db){
                 return $month_db_full;
             }	
        }
        return '';
    }

    private function authId(){
        $user_data = session()->get('user_data');
        return $user_id = $user_data->id;
    }

    private function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    

    
}   
