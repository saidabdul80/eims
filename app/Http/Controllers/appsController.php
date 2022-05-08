<?php



namespace App\Http\Controllers;



use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use  Redirect, Response;
use Illuminate\Support\Facades\Validator;

use App\Drug;

use App\Claim;

use App\Enrollee;

use App\Repositories\EnrolleeRepository;

use App\Repositories\ProviderRepository;

use App\Repositories\WardRepository;

use App\Repositories\LgaRepository;

use Session;
use App\Institution;
use App\Provider;
use App\Students;
use Exception;
use App\Tpa;
use App\Tpa_institution;
use App\Sessions;
use App\Provider_institution;
use App\TishipEnrollee;
use App\TishipEnrolleeHistory;

class appsController extends Controller

{



    private $lgaRepository;

    private $wardRepository;

    private $enrolleeRepository;

    private $providerRepository;

    /* start */
    private $institutions;

    /* end */

    public function __construct(
                  

        LgaRepository $lgaRepository,

        WardRepository $wardRepository,

        EnrolleeRepository $enrolleeRepository,

        ProviderRepository $providerRepository

    ) {
        $this->institutions =Institution::all();

        $this->lgaRepository = $lgaRepository;

        $this->wardRepository = $wardRepository;

        $this->enrolleeRepository = $enrolleeRepository;

        $this->providerRepository = $providerRepository;

    }


    private function log_data($data,$name){

	$fp = fopen($name.'.json', 'a');

		fwrite($fp, json_encode($data));

		fclose($fp);

}
    public function cbs_payment(Request $request){

        $this->log_data($request->all(), "cbs_return_data");
        return response()->json(["error" => false],200);

    }



    public function index(){

        $data = $this->dashboardData();        
        return view('home', compact('data'));

    }

    /* start */
    public function deleteInstitution(Request $request){        
        $institution_id = $request->id;
        $check = TishipEnrollee::where('institution_id',$institution_id)->first();
        if(!$check){
            Institution::find()->delete();      
            return redirect('mgt_institution')->with("message","Success: Deleted Successfully");    
        }
        return redirect('mgt_institution')->with("error","Error: We found students associated with this Institution. Your action[delete] Cannot be completed.");    
        
          
    }
    public function createInstitution(Request $request){        
        $user  =  session()->get('user_data')->id;        
        if($request->id == ""){
            $create = Institution::insert([
                "name" => $request->get('name'),
                "created_by"=>$user,
                "sortCode" => $request->get('shortname')
            ]);            
            return redirect('mgt_institution')->with("message","Created Successfully");    
        }else{
            $create = Institution::find($request->id);        
                $create->name = $request->name;
                $create->sortCode = $request->shortname;
                $create->created_by=$user;
                $create = $create->save();
            return redirect('mgt_institution')->with("message","Updated Successfully");    
        }
        return redirect('mgt_institution')->with("error","failed to create Institution");    
    }
    public function deleteStudent(Request $request){        
        
        TishipEnrolleeHistory::where(["tiship_enrollee_id"=>$request->id, "session_id"=>$request->session_id])->delete();
        
        return redirect('mgt_institution')->with("message","deleted Successfully");        

    }

    public function addUpdateSession(Request $request){
        $id = $request->get('id')??'';
        Sessions::updateOrCreate(
            ['name' => $request->name, 'id' => $id],
            ['is_current' => '']
        );
        return redirect('session')->with("message","saved Successfully"); ;
    }
    public function setSession(Request $request){
        DB::table('tbl_session')->update(['is_current'=>Null]);
        $save = Sessions::find($request->id);
        $save->is_current = now();
        $save->save();
        return redirect('session')->with("message","Set Successfully"); ;
    }
    public function deleteSession(Request $request){
        $session = Sessions::find($request->id);
        if($session->is_current != Null){
            return redirect('session')->with("error","De assign (".$session->name.") session from current Session"); 
        }else{
            $session->delete();
            return redirect('session')->with("message","deleted Successfully"); 
        }
    }

    public function updateStudent(Request $request){
        $request = json_decode($request->get('data'));                
        $save = Students::find($request->id);                          
        $save->matric_number        =   $request['matric_number'];
        $save->first_name       =   $request['first_name'];
        $save->other_name       =   $request['other_name'];
        $save->surname      =   $request['surname'];
        $save->department       =   $request['department'];
        $save->faculty      =   $request['faculty'];
        $save->dob      =   $request['dob'];
        $save->phone_number     =   $request['phone_number'];
        $save->email_address        =   $request['email_address'];
        $save->sex      =   $request['sex'];
        $save->date_admitted        =   $request['date_admitted'];
        $save->date_of_graduation       =   $request['date_of_graduation'];
        $save->next_of_kin_name     =   $request['next_of_kin_name'];
        $save->next_of_kin_address      =   $request['next_of_kin_address'];
        $save->next_of_kin_phone_number     =   $request['next_of_kin_phone_number'];
        $save->medical_history      =   $request['medical_history'];
        //$save->session_id       =   $session_id;
        $save->save();        
        return redirect('mgt_institution')->with("message","Updated Successfully");    
    }
    public function indexInstitution(){

        $session = Sessions::where('is_current','!=', Null)->first();        
        $students = DB::table('tiship_enrollee_histories', 't')->RightJoin('tbl_tiship_enrollees',function($join){
            $join->on(['t.tiship_enrollee_id' =>'tbl_tiship_enrollees.id','t.session_id'=>'tbl_tiship_enrollees.session_id']);
        })->where('t.session_id',$session->id)->paginate(500);

        $students = json_decode(json_encode($students));
        $selected_institution = 1;
        $data = ['institutions'=>$this->institutions, 'students'=>$students, "mode"=>false, "session"=>$session,'selected_institution'=> $selected_institution];        
        return view('institution.manage_institution')->with('data',$data);
    }
    
    public function searchStudent(Request $request){
        
        $institution_id = $request->institution_id;
        $session_id = $request->session_id;
        $search = $request->search;        

        $searchParam = array();          
        if($institution_id != ""){
            $searchParam['t.institution_id'] = $institution_id;            
        }
        
        if($session_id != ""){
            $searchParam['t.session_id'] = $session_id;
        }else{
            if($search == ""){
                //don't use session if search is not empty. probably searching in all session;
                $searchParam['tbl_tiship_enrollees.session_id'] = "tbl_tiship_enrollees.session_id";
            }
        }

        if(sizeof($searchParam) > 1 && $search == ""){                               
            $students = DB::table('tiship_enrollee_histories', 't')->rightJoin('tbl_tiship_enrollees',"t.tiship_enrollee_id","=", "tbl_tiship_enrollees.id")->where($searchParam)->paginate(500);
        }else{
            $students = DB::table('tiship_enrollee_histories', 't')->rightJoin('tbl_tiship_enrollees',"t.tiship_enrollee_id","=", "tbl_tiship_enrollees.id")->where($searchParam)->where(function($query)use ($search){
                $query->orWhere("matric_number","like", "%$search%")->orWhere("first_name","like", "%$search%")->orWhere("surname","like", "%$search%")->orWhere("other_name","like", "%$search%")->orWhere("department","like", "$search")->orWhere("faculty","like", "$search");
            })->paginate(500);                      
        }       
        $session = Sessions::where('id', $session_id)->first();
        $data = ['institutions'=>$this->institutions, 'students'=>$students, "session"=>$session,'selected_institution'=> $institution_id];   
        session('students',$students);     
        return view('institution.manage_institution')->with('data',$data);
    }
    
    public function uploadStudents(Request $request){      
        $file = $request->file;
        $ref = json_decode($request->ref);
        
        if($ref != null){
            $payment_type = $request->get('payment_type');
            $amount = $request->get('amount');
            $payment_date = date("y-m-d");
            $payment_status = $ref->status;
            $payment_initiator = session('user_data')->id;
            $paid_by = session('user_data')->id;
            $payment_reference = $ref->reference;
            $payment_method = $ref->method ?? "-";            
        }
      

        $validator = Validator::make($request->all(), [
            'file' => ['required', "mimes:text,csv"],
            'session_id' => 'required',
            'institution_id'=>'required',            
        ]);
        $session_id = (int) $request->get('session_id');        
        $institution_id = (int) $request->get('institution_id');        

        if ($validator->fails()) {
        
            return redirect('mgt_institution')->with('error', "All field field is required");
        }
        
      
        $users = $this->fileToArray($file);        
            

        $data = [];
        $exists = "";
        $newStudents = "";        
        
        foreach ($users as $user) {
            
            $checkDuplicateMatricNumber = Students::where(['matric_number' => $user['matric_number']])->first();
            $checkDuplicateEmail = Students::where(['email_address' => $user['email_address']])->first();
            
            if ($user['matric_number'] != '') {
                DB::beginTransaction();
                if ($checkDuplicateMatricNumber == null) {  
                    //  if ($checkDuplicateEmail == null) {      
                    $chk = Students::where(['matric_number' => $user['matric_number'], 'session_id'=>$session_id])->exists();          
                      
                    if(!$chk){        
                      $id =  DB::table('tbl_tiship_enrollees')->insertGetId([      
                                "matric_number"=>$user['matric_number'],
                                "first_name"=>$user['first_name'],
                                "other_name"=>$user['other_name'],
                                "surname"=>$user['surname'],
                                "department"=>$user['department'],
                                "faculty"=>$user['faculty'],
                                "dob"=>$user['dob'],                        
                                "phone_number"=>$user['phone_number'],
                                "email_address"=>$user['email_address'],
                                "sex"=>$user['sex'],
                                "date_admitted"=>$user['date_admitted'],
                                "date_of_graduation"=>$user['date_of_graduation'],
                                "next_of_kin_name"=>$user['next_of_kin_name'],
                                "next_of_kin_address"=>$user['next_of_kin_address'],
                                "next_of_kin_phone_number"=>$user['next_of_kin_phone_number'],
                                "medical_history"=>$user['medical_history'],
                                "session_id"=>$session_id, //current session
                                "institution_id"=>$institution_id
                            ]);     
                            $enrollee_id = Students::find($id)->enrolment_number;                            
                            $saveHistory =  DB::table('tiship_enrollee_histories')->updateOrInsert([
                                "tiship_enrollee_id" => $id,                               
                                "session_id" => $session_id,
                            ],[
                                "tiship_enrollee_id" => $id,
                                "institution_id" => $institution_id,
                                "session_id" => $session_id
                            ]);
                            if($ref != null){

                                $saveInventory =  DB::table('tiship_inventories')->updateOrInsert([
                                    "institution_id" => $institution_id,                               
                                    "enrollee_id" => $enrollee_id,
                                    "session" =>  $session_id,
                                    "payment_status" => 'success',
                                ],[
                                    "institution_id" =>  $institution_id, 
                                    "enrollee_id" =>  $enrollee_id, 
                                    "payment_type" =>  $payment_type, 
                                    "amount" =>  $amount, 
                                    "payment_date" =>  $payment_date, 
                                    "payment_status" =>  $payment_status, 
                                    "payment_initiator" =>  $payment_initiator, 
                                    "paid_by" =>  $paid_by, 
                                    "payment_reference" =>  $payment_reference, 
                                    "payment_method" =>  $payment_method, 
                                    "session" => $session_id,
                                ]);
                            
                            }
                            if(!$saveHistory){
                                DB::rollBack();
                            }
                            $newStudents .= "Created: ".$user['matric_number']. ' <br>';
                        }else{
                            //return dd($chk);
                            $exists .= 'Duplicate: ' .$user['matric_number']. ' <br>';                                            
                        }                   
                   /*  }else{

                    }      */               
                } else {
                    $save = Students::find($checkDuplicateMatricNumber->id);                          
                    $save->matric_number        =   $user['matric_number'];
                    $save->first_name       =   $user['first_name'];
                    $save->other_name       =   $user['other_name'];
                    $save->surname      =   $user['surname'];
                    $save->department       =   $user['department'];
                    $save->faculty      =   $user['faculty'];
                    $save->dob      =   $user['dob'];
                    $save->phone_number     =   $user['phone_number'];
                    $save->email_address        =   $user['email_address'];
                    $save->sex      =   $user['sex'];
                    $save->date_admitted        =   $user['date_admitted'];
                    $save->date_of_graduation       =   $user['date_of_graduation'];
                    $save->next_of_kin_name     =   $user['next_of_kin_name'];
                    $save->next_of_kin_address      =   $user['next_of_kin_address'];
                    $save->next_of_kin_phone_number     =   $user['next_of_kin_phone_number'];
                    $save->medical_history      =   $user['medical_history'];
                    $save->session_id       =   $session_id; //current session
                    $save->institution_id = $institution_id;
                    $save->save();
                    $enrollee_id = $save->enrolment_number;
                    $saveHistory = DB::table('tiship_enrollee_histories')->updateOrInsert([
                        "tiship_enrollee_id" => $save->id,                               
                        "session_id" => $session_id,
                    ],[
                        "tiship_enrollee_id" => $save->id,
                        "institution_id" => $institution_id,
                        "session_id" => $session_id
                    ]);  
                    
                    if($ref != null){
                        $saveInventory =  DB::table('tiship_inventories')->updateOrInsert([
                            "institution_id" => $institution_id,                               
                            "enrollee_id" => $enrollee_id,
                            "session" =>  $session_id,
                            "payment_status" => 'success',
                        ],[
                            "institution_id" =>  $institution_id, 
                            "enrollee_id" =>  $enrollee_id, 
                            "payment_type" =>  $payment_type, 
                            "amount" =>  $amount, 
                            "payment_date" =>  $payment_date, 
                            "payment_status" =>  $payment_status, 
                            "payment_initiator" =>  $payment_initiator, 
                            "paid_by" =>  $paid_by, 
                            "payment_reference" =>  $payment_reference, 
                            "payment_method" =>  $payment_method, 
                            "session" => $session_id,
                        ]);                        
                    }


                    if(!$saveHistory){
                        DB::rollBack();
                    }                                 
                    $newStudents .='Updated: '. $user['matric_number']. ' <br>';                      
                }             
                DB::commit();
            }

        }        
        return redirect('mgt_institution')->with('message', "<table class='table table-bordered'>
        <tr>
            <td class='bg-white text-success'>
                <h5>Successfully Uploaded list</h5>
            </td>
            <td class='bg-white text-danger'>
                <h5>Fail List</h5>
            </td>
        </tr>
        <tr>
            <td class='bg-white text-success'>$newStudents</td>
            <td class='bg-white text-danger'>$exists</td>
        </tr>
        </div>
    </table>");
    }
    public function studentsInventoryChecker(Request $request){
        $session_id = $request->get('session_id');
        $institution_id = $request->get('institution_id');
        $students = $request->get('obj');
        $index = 0;
        $unpaid = $paid = 0;
        foreach($students as $student){
            if($index != 0){
                $matric_number = $student[2];
                $user = DB::table('tbl_tiship_enrollees','t')->join('tiship_inventories','tiship_inventories.enrollee_id','=','t.enrolment_number')->where(['t.matric_number'=>$matric_number,'tiship_inventories.session'=>$session_id, 'tiship_inventories.institution_id'=>$institution_id ])->first();
                if(!$user){
                    $unpaid++;
                }else{
                    $paid++;
                }
            }
            $index++;
        }
        return response()->json(["paid"=>$paid,"unpaid"=>$unpaid], 200);
    }

    private function fileToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return response()->json(['error' => "Error while reading file"], 400);

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if (!$header){
                    $header =  $row;
                    foreach($header as &$hd){
                        $hd = strtolower($hd);
                    }
                }
                else{
                    $data[] = array_combine($header, $row);
                }                    
            }
            fclose($handle);
        }

        return $data;
    }

    public function indexAssignTpa(){
        $data = $this->institutions;
        return view('institution.assign_tpa')->with('data',['institutions'=>$data]);
    }

    public function indexAssignProviderToInstitution(){
        $data = $this->institutions;
        return view('institution.assign_provider_institution')->with('data',['institutions'=>$data]);
    }

    
    public function allTpas(Request $request){
        Validator::make($request->all(), [               
            'length' => 'required',
            'start' => 'required',
            'search' => 'required',
        ]);   
        $start = $request->get('start');
        
        $tpas = EnrolleeRepository::tpas($request);

        $idx = $start;
        foreach($tpas as &$tpa){
          $idx += 1;
          $tpa['sn'] = $idx;
        }
        if(empty($search)){
            $data = [
              "draw"=> $request->get('draw'),
              "recordsTotal"=>  sizeof( Tpa::all()),
              "recordsFiltered"=> sizeof( Tpa::all()),
              "data"=>$tpas
            ];
          }else{
            $data = [
              "draw"=> $request->get('draw'),
              "length"=>sizeof($tpas),
              "recordsTotal"=>  sizeof($tpas),
              "recordsFiltered"=> sizeof($tpas),
              "data"=>$tpas
            ];
          }
        return response()->json($data);
        
    }

    public function tpaToInstitution(Request $request){
        $validator = Validator::make($request->all(), [               
            'tpa_id' => 'required',
            'institution_id' => 'required',            
        ]);   

        if($validator->fails()){
            //return response()->json('all field required');   
        }
        $tpa_id  = (int) $request->tpa_id;
        $institution_id  = (int) $request->institution_id;
        $session_id = Sessions::where('is_current','!=', Null)->first()->id;        
        
        $tpa = Tpa_institution::where([
            'tpa_id' => $tpa_id,
            'institution_id'=> $institution_id,
            'session_id' => $session_id
            ])->first();

        $check = Tpa_institution::where([            
            'institution_id'=> $institution_id,
            'session_id' => $session_id
            ])->first();
        if($check){            
            $tpa_code = Tpa::where('id',$check->tpa_id)->first()->tpa_code;
            return response()->json("Already Assigned to ". $tpa_code);   
        }

        if($tpa){
            $save = Tpa_institution::find($tpa->id);        
            $save->tpa_id = $tpa_id;
            $save->institution_id= $institution_id;
            $save->session_id = $session_id;
            $save->deleted_at = Null;
            $complete = $save->save();                           
        }else{
            
            $complete = Tpa_institution::insert([
                'tpa_id' => $tpa_id,
                'institution_id'=> $institution_id,
                'session_id' => $session_id
            ]);  

        }
        if($complete){
            return response()->json("Assigned Successfully");   
        }else{
            return response()->json("Failed to Assign, Try Again");   
        }
    }

    public function tpaFromInstitution(Request $request)
    {
        $id = (int) $request->id;
        $delete = Tpa_institution::where('id', $id)->delete();
        if($delete){
            return response()->json("Deasigned Successfully");   
        }else{
            return response()->json("Failed to Deassign, Try Again");   
        }

    }

    public function allProviders(Request $request){
        Validator::make($request->all(), [               
            'length' => 'required',
            'start' => 'required',
            'search' => 'required',
        ]);   
        $start = $request->get('start');
        
        $providers = EnrolleeRepository::providers($request);

        $idx = $start;
        foreach($providers as &$provider){
          $idx += 1;
          $provider['sn'] = $idx;
        }
        if(empty($search)){
            $data = [
              "draw"=> $request->get('draw'),
              "recordsTotal"=>  sizeof( Provider::all()),
              "recordsFiltered"=> sizeof( Provider::all()),
              "data"=>$providers
            ];
          }else{
            $data = [
              "draw"=> $request->get('draw'),
              "length"=>sizeof($providers),
              "recordsTotal"=>  sizeof($providers),
              "recordsFiltered"=> sizeof($providers),
              "data"=>$providers
            ];
          }
        return response()->json($data);
        
    }

    public function providerToInstitution(Request $request){
        $validator = Validator::make($request->all(), [               
            'provider_id' => 'required',
            'institution_id' => 'required',            
        ]);   
        
        if($validator->fails()){
            //return response()->json('all field required');   
        }
        $provider_id  = (int) $request->provider_id;
        $institution_id  = (int) $request->institution_id;
        $session_id = Sessions::where('is_current','!=', Null)->first()->id;        
        
        $provider = Provider_institution::where([
            'provider_id' => $provider_id,
            'institution_id'=> $institution_id,
            'session_id' => $session_id
            ])->first();
        
        $check = Provider_institution::where([            
            'institution_id'=> $institution_id,
            'session_id' => $session_id
            ])->first();
            
        if($check){            
            $provider_code = Provider::where('id',$check->provider_id)->first()->hcpcode;            
            return response()->json("Already Assigned to ". $provider_code);   
        }
        
        if($provider){
            $save = Provider_institution::find($provider->id);        
            $save->provider_id = $provider_id;
            $save->institution_id= $institution_id;
            $save->session_id = $session_id;
            $save->deleted_at = Null;
            $complete = $save->save();                           
        }else{
            
            $complete = Provider_institution::insert([
                'provider_id' => $provider_id,
                'institution_id'=> $institution_id,
                'session_id' => $session_id
            ]);  
        
        }
        if($complete){
            return response()->json("Assigned Successfully");   
        }else{
            return response()->json("Failed to Assign, Try Again");   
        }
    }

    public function providerFromInstitution(Request $request)
    {
        $id = (int) $request->id;
        $delete = Provider_institution::where('id', $id)->delete();
        if($delete){
            return response()->json("Deasigned Successfully");   
        }else{
            return response()->json("Failed to Deassign, Try Again");   
        }

    }


    public function makePay(Request $request){
        return dd($request);
    }
    public function makePayCallback(Request $request){
        return dd($request);
    }
    


    /* end */
    public function dashboard()    {

        $data = $this->dashboardData();
        return view('dashboard', compact('data'));

    }

    private function dashboardData(){
        $data['providers-count'] = $this->providerRepository->total();

        $data['nicare-bhcpf-count'] = $this->enrolleeRepository->totalNiCareBHCPF();

        $data['nicare-bhcpf-sex-count'] = $this->enrolleeRepository->totalEnrolleeBySex();

        $data['caps'] = $this->enrolleeRepository->capByYear(date('Y'), 'NiCare');

    $data['caps_bhcpf'] = $this->enrolleeRepository->capByYear(date('Y'), 'BHCPF');
    
        $data['bhcpf-categories'] = $this->enrolleeRepository->bhcpfEnrolleeByCategory();

        $data['bhcpf-disabilities'] = $this->enrolleeRepository->bhcpfEnrolleeByDisabilities();

        $data['bhcpf-pregnant-enrollee-count'] = $this->enrolleeRepository->bhcpfPregnantEnrollee();

        $data['bhcpf-zone-count'] = $this->enrolleeRepository->bhcpfEnrolleeByZone();

        $data['today-encounter'] = $this->todayEncounter();
        $data['encounter_arr'] = $this->encounter_arr();
        //////
        $premium_to_expire_counts = $this->premium_to_expire_counts();
        $data['expired_premium_count'] = $premium_to_expire_counts['expired'];
        $data['expired_premium_count_this_month'] = $premium_to_expire_counts['this_month'];
        $data['expired_premium_count_next_month'] = $premium_to_expire_counts['next_month'];
        
       

        $data['enrollees-by-lga']  = $this->enrolleeRepository->enrolleeByLgaAndScheme()->map(function ($enrollee) {

            return json_decode(json_encode([
                'lga_id' => $enrollee->lga,
                'lga' => $this->lgaRepository->find($enrollee->lga)->lga,
                'total' => $enrollee->total,
                'scheme' => $enrollee->scheme

            ]));

        });



        $data['enrollees-by-ward']  = $this->enrolleeRepository->enrolleeByWardAndScheme()->map(function ($enrollee) {
            $ward = $this->wardRepository->find($enrollee->ward);
            return json_decode(json_encode([
                'id' => $ward->id,
                'lga_id' => $ward->lga_id,
                'ward' => $ward->ward,
                'total' => $enrollee->total

            ]));

        });



        $data['enrollees-by-provider']  = $this->enrolleeRepository->enrolleeByProvider()->map(function ($enrollee) {

            $provider = $this->providerRepository->find($enrollee->provider_id);

            return json_decode(json_encode([

                'id' => $provider->id,

                'ward_id' => $provider->hcpward,

                'provider' => $provider->hcpname,

                'total' => $enrollee->total

            ]));

        });

        $data['nicare-type-count'] = $this->enrolleeRepository->totalEnrolleeByType()->map(function ($type) {
            return json_decode(json_encode([strtolower($type->enrolee_type) . '_enrolee' => $type->total]));
        });
        return $data;
    }


    private function todayEncounter(){
        $date = date('Y-m-d');
        return DB::table('tbl_encounters')->where('encounterOpenDate', 'LIKE', $date . '%')->where('status', '1')->get()->count();
    }

    private function encounter_arr(){
        $date = date('Y-m-d');

        ///// Today : Nicare
        $nicare_encounter_today =  DB::table('tbl_encounters')
        ->join('tbl_enrolee', 'tbl_encounters.enroleeId', '=', 'tbl_enrolee.enrolment_number')
        ->where('tbl_encounters.encounterOpenDate', 'LIKE', date('Y-m-d') . '%')
        ->where('tbl_enrolee.mode_of_enrolment', 'Premium')
        ->where('tbl_encounters.status', '1')->get()->count();


        ///// This month: nicare
        $nicare_encounter_this_month =  DB::table('tbl_encounters')
        ->join('tbl_enrolee', 'tbl_encounters.enroleeId', '=', 'tbl_enrolee.enrolment_number')
        ->where('tbl_encounters.encounterOpenDate', 'LIKE', date('Y-m-') . '%')
        ->where('tbl_enrolee.mode_of_enrolment', 'Premium')
        ->where('tbl_encounters.status', '1')->get()->count();

         ///// This year : Nicare
         $nicare_encounter_this_year =  DB::table('tbl_encounters')
         ->join('tbl_enrolee', 'tbl_encounters.enroleeId', '=', 'tbl_enrolee.enrolment_number')
         ->where('tbl_encounters.encounterOpenDate', 'LIKE', date('Y-') . '%')
         ->where('tbl_enrolee.mode_of_enrolment', 'Premium')
         ->where('tbl_encounters.status', '1')->get()->count();



          ///// Today : Huwe
        $bhcpf_encounter_today =  DB::table('tbl_encounters')
        ->join('tbl_enrolee', 'tbl_encounters.enroleeId', '=', 'tbl_enrolee.enrolment_number')
        ->where('tbl_encounters.encounterOpenDate', 'LIKE', date('Y-m-d') . '%')
        ->where('tbl_enrolee.mode_of_enrolment', 'huwe')
        ->where('tbl_encounters.status', '1')->get()->count();


        ///// This month: Huwe
        $bhcpf_encounter_this_month =  DB::table('tbl_encounters')
        ->join('tbl_enrolee', 'tbl_encounters.enroleeId', '=', 'tbl_enrolee.enrolment_number')
        ->where('tbl_encounters.encounterOpenDate', 'LIKE', date('Y-m-') . '%')
        ->where('tbl_enrolee.mode_of_enrolment', 'huwe')
        ->where('tbl_encounters.status', '1')->get()->count();

         ///// This year : Huwe
         $bhcpf_encounter_this_year =  DB::table('tbl_encounters')
         ->join('tbl_enrolee', 'tbl_encounters.enroleeId', '=', 'tbl_enrolee.enrolment_number')
         ->where('tbl_encounters.encounterOpenDate', 'LIKE', date('Y-') . '%')
         ->where('tbl_enrolee.mode_of_enrolment', 'huwe')
         ->where('tbl_encounters.status', '1')->get()->count();

         return [
            'bhcpf_encounter_today' => $bhcpf_encounter_today,
            'bhcpf_encounter_this_month' => $bhcpf_encounter_this_month,
            'bhcpf_encounter_this_year' => $bhcpf_encounter_this_year,
            'nicare_encounter_today' => $nicare_encounter_today,
            'nicare_encounter_this_month' => $nicare_encounter_this_month,
            'nicare_encounter_this_year' => $nicare_encounter_this_year,
         ];
    }


    public function loadChart(Request $request){
        $data = $request->get('data');
        //$lga = $request->get('lga');
        $chartData = $data;
        $returnHTML = view('chart_loader')->with('chartData', $chartData)->render();
        return response()->json(array('success' => true, 'status' => 200, 'html' => $returnHTML));

    }


    public function premium_reports(Request $request){
        $recipients = [];
    
        $premium_to_expire_counts = $this->premium_to_expire_counts();
        $enrollees  = $premium_to_expire_counts['enrollees'];
        $expired_count = $premium_to_expire_counts['expired'];
        $to_expire_this_month = $premium_to_expire_counts['this_month'];
        $to_expire_next_month = $premium_to_expire_counts['next_month'];
        
       return view('premium.reports', compact('enrollees', 'to_expire_this_month', 'to_expire_next_month', 'expired_count', 'recipients'));

    }
    
    private function premium_to_expire_counts(){
          $month = intval(date('m'));
          
          $next_two_month_val = $month + 2;
           $next_two_month = date('Y-').($next_two_month_val <= 9 ? '0'.$next_two_month_val : $next_two_month_val);
          if($next_two_month == 2){
              $next_two_month_string = $next_two_month.'-28';
          }else{
              $next_two_month_string = $next_two_month.'-30';
          }
           
        $enrollees =  DB::table('tbl_pin_inven')
       ->join('tbl_enrolee', 'tbl_pin_inven.id', '=', 'tbl_enrolee.pin')
       ->select('tbl_pin_inven.date_expired', 'tbl_enrolee.enrolment_number', 'tbl_enrolee.surname', 'tbl_enrolee.first_name', 'tbl_enrolee.other_name',
        'tbl_enrolee.provider_id' , 'tbl_enrolee.lga' , 'tbl_enrolee.ward', 'tbl_enrolee.sex', 'tbl_enrolee.address', 'tbl_enrolee.id', 'tbl_enrolee.enrol_date', 'tbl_enrolee.phone_number'
        )
       ->where('tbl_pin_inven.date_expired','<=', ''.$next_two_month_string.'' )
       ->where('tbl_enrolee.status', '1')->get();
       
    
       $expired_count =  DB::table('tbl_pin_inven')
       ->join('tbl_enrolee', 'tbl_pin_inven.id', '=', 'tbl_enrolee.pin')
       ->select('tbl_pin_inven.date_expired', 'tbl_enrolee.enrolment_number', 'tbl_enrolee.surname', 
        'tbl_enrolee.first_name', 'tbl_enrolee.other_name',
        'tbl_enrolee.provider_id' , 'tbl_enrolee.lga' , 'tbl_enrolee.ward', 'tbl_enrolee.sex', 'tbl_enrolee.address', 'tbl_enrolee.id', 'tbl_enrolee.phone_number')
       ->where('tbl_pin_inven.date_expired', '<=', date('Y-m-d') )
       ->where('tbl_enrolee.status', '1')->get()->count();

       $next_month_val = $month + 1;
       $next_month = date('Y-').($next_month_val <= 9 ? '0'.$next_month_val : $next_month_val);
       $to_expire_this_month =  DB::table('tbl_pin_inven') ->where('date_expired', 'LIKE', '%'.date('Y-m').'%')->get()->count();
       $to_expire_next_month =  DB::table('tbl_pin_inven') ->where('date_expired', 'LIKE', '%'.$next_month.'%')->get()->count();

       return [
            'enrollees'=> $enrollees,
            'expired' => $expired_count,
            'this_month' => $to_expire_this_month,
            'next_month' => $to_expire_next_month
           ];

    }
    

    public function send_reminder(Request $request){

    $month = intval(date('m'));
          
          
      $recipients = [];
    $message = null;
    $sn = 1;
        if(count($request->all()) > 0){

            $next_month = date('Y-m-d', strtotime('+3 months')) ; 
            $next_two_month_val = $month + 2;
           $next_two_month = date('Y-').($next_two_month_val <= 9 ? '0'.$next_two_month_val : $next_two_month_val);
          if($next_two_month == 2){
              $next_two_month_string = $next_two_month.'-28';
          }else{
              $next_two_month_string = $next_two_month.'-30';
          }
          
            $expired_list =  DB::table('tbl_pin_inven')
            ->join('tbl_enrolee', 'tbl_pin_inven.id', '=', 'tbl_enrolee.pin')
            ->select('tbl_pin_inven.date_expired', 'tbl_enrolee.enrolment_number',  'tbl_enrolee.phone_number')
            ->where('tbl_pin_inven.date_expired', '<=', $next_two_month_string)
            // ->where('tbl_enrolee.principal_id', 0)
            ->where('tbl_enrolee.status', '1')->get();

            foreach ($expired_list as $key => $expired_) {
                $phone_number = '+234'.substr($expired_->phone_number,-10);
                $expired_date = date('d/m/Y', strtotime(''.$expired_->date_expired.''));
                
                $is_sent_this_month = DB::table('tbl_messages')->where('created_at','LIKE', ''.date('Y-m').'%')->get()->count(); 
                
                if($is_sent_this_month == 0){
                     $message = 'REMINDER!%20Dear%20Enrollee,%20Your%201%20Year%20NiCare%20Health%20Insurance%20of%20N7,200%20Premium%20expires%20on%20'.$expired_date.'.%20Kindly%20renew%20your%20premium.%20For%20enquiries%20call%20099041210';
                
                    $sendSms = $this->sendSms($phone_number,$message);
                    if (isset($sendSms->SMSMessageData)) { 
                        $Recipients_arr = $sendSms->SMSMessageData->Recipients;
                        $recipients__ = $Recipients_arr[0];
                        $recipients__->enrolment_number = $expired_->enrolment_number;
                        $recipients__->phone_number = $phone_number;
                        $recipients__->message = $message;
                        $recipients__->expired_date = $expired_date;
                        
                        DB::table('tbl_messages')->insert([
                            'recipient' => $phone_number,
                            'message' => preg_replace('/%20/i', ' ', $message),
                            'messageId' => $recipients__->messageId,
                            'sender' => 'NiCare',
                            'enrollee_id' => $expired_->enrolment_number,
                            'status' => $recipients__->status,
                            'created_at' => date('Y-m-d H:i:s')
                            ]); 
                        
                        array_push($recipients, $recipients__);
                      
                     }
                }
            
            }

        }
    
    
   
    
        $premium_to_expire_counts = $this->premium_to_expire_counts();
        $enrollees  = $premium_to_expire_counts['enrollees'];
        $expired_count = $premium_to_expire_counts['expired'];
        $to_expire_this_month = $premium_to_expire_counts['this_month'];
        $to_expire_next_month = $premium_to_expire_counts['next_month'];
        
       return view('premium.reports', compact('enrollees', 'to_expire_this_month', 'to_expire_next_month', 'expired_count', 'recipients'));
       
        
        

    }
    
    private function sendSms($phones,$message){
           $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL,"https://api.africastalking.com/version1/messaging");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLINFO_HEADER_OUT, true);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,"username=nicare&to=+2348130051228&message=$message&from=NiCare");
                // In real life you should use something like:
                // curl_setopt($ch, CURLOPT_POSTFIELDS, 
                //          http_build_query(array('postvar1' => 'value1')));
                // Set HTTP Header for POST request 
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Accept: application/json',
                    'Content-Type: application/x-www-form-urlencoded',
                    'apiKey: bbbc3950ef2e0979266cd9dbf3d0356d5efbf0fd6c58f0ee3d2b36149e28919d')
                );
        
                // Receive server response ...
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec($ch);
                curl_close ($ch);
        
                $server_output = json_decode($server_output);
           
                // Further processing ...
                if (isset($server_output->SMSMessageData)) { 
                   
                 }
        
               
                
                return $server_output;
        
    }


    public function message_history(Request $request){
         $messages = DB::table('tbl_messages')->get(); 
         
         return view('premium.message_history', compact('messages'));
         
        //   $ch = curl_init();
        //     curl_setopt($ch, CURLOPT_URL,"https://api.africastalking.com/version1/messaging?username=nicare&lastReceivedId=0'");
        //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //     curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Accept: application/json', 'apiKey: bbbc3950ef2e0979266cd9dbf3d0356d5efbf0fd6c58f0ee3d2b36149e28919d'));
        //     // Receive server response ...
        //     $server_output = curl_exec($ch);
        //     curl_close ($ch);
        //     $server_output = json_decode($server_output);
        //     dd($server_output);
    }
    
    
    public function logout(Request $request){
        $request->session()->flush();
        return view('index');
    }

}

