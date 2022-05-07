<?php



namespace App\Http\Controllers;



use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use Validator, Redirect, Response;

use JWTAuth;

use App\User;

use Illuminate\Support\Str;

use Tymon\JWTAuth\Exceptions\JWTException;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

use Session;

use App\Enrollee;

use App\Provider;

use App\Repositories\EnrolleeRepository;

use App\Repositories\ProviderRepository;

use App\Repositories\WardRepository;

use App\Repositories\LgaRepository;



class enrolleeController extends Controller

{



    private $lgaRepository;

    private $wardRepository;

    private $enrolleeRepository;

    private $providerRepository;



    public function __construct(

        LgaRepository $lgaRepository,

        WardRepository $wardRepository,

        EnrolleeRepository $enrolleeRepository,

        ProviderRepository $providerRepository

    ) {

        $this->lgaRepository = $lgaRepository;

        $this->wardRepository = $wardRepository;

        $this->enrolleeRepository = $enrolleeRepository;

        $this->providerRepository = $providerRepository;

    }





    public function all_enrollees()

    {

        return view('enrolment.all', [

            'enrollees' => Enrollee::where('status', '1')->paginate(50)

        ]);

    }





    public function enrollees_by_provider(Request $request)

    {

        $enrollees = null;

        if ($request->get('ward') || $request->get('lga') || $request->get('provider')) {

            $provider_id = $request->get('provider');

            $lga = $request->get('lga');

            $ward = $request->get('ward');

            $data = [];

            if (!empty($provider_id)) {

                $data['provider_id'] = $provider_id;

            }

            if (!empty($lga)) {

                $data['lga'] = $lga;

            }



            if (!empty($ward)) {

                $data['ward'] = $ward;

            }



            $enrollees = $this->enrolleeRepository->get($data);

            // return view('enrolment.enrollees_by_provider', compact('data', 'enrollees'));

        }

        $data = [];

        $data['lgas'] = $this->lgaRepository->all();

        $data['wards'] = $this->wardRepository->all();

        $data['providers'] = $this->providerRepository->allPrimaryProviders();

        return view('enrolment.enrollees_by_provider', compact('data', 'enrollees'));

    }







    public function load_enrollee_info(Request $request)

    {

        $enrollee = Enrollee::find($request->get('id'));

        $returnHTML = view('enrolment.enrollee_info', compact('enrollee'))->render();

        return response()->json(['success' => true, 'status' => 200, 'html' => $returnHTML]);

    }



    public function load_enrollee_info_with_biometric(Request $request)

    {



        $enrollee = Enrollee::find($request->get('id'));

        // return response()->json(['html' => $enrollee]);

        $returnHTML = view('enrolment.enrollee_info_with_biometric', compact('enrollee'))->render();

        return response()->json(['success' => true, 'status' => 200, 'html' => $returnHTML]);

    }









    public function load_edit_enrollee_info(Request $request)

    {

        $enrollee = Enrollee::find($request->get('id'));



        $returnHTML = view('enrolment.edit_enrollee_form', compact('enrollee'))->render();

        return response()->json(['success' => true, 'status' => 200, 'html' => $returnHTML]);

    }





    public function update_enrollee_info(Request $request)

    {





        $enrollee = Enrollee::find($request->input('enrolee_id'));



        $lga_info = $this->get_lga_info($request->input('lga'));

        $data = ['sex' => $request->input('sex'), 'surname' => $request->input('surname'), 'first_name' => $request->input('first_name'), 'date_of_birth' => $enrollee->date_of_birth, 'lga_code' => $lga_info->code];

        $bhcpf_number = $this->generate_bhcpf_number($data);





        $enrollee->surname = $request->input('surname');

        $enrollee->first_name = $request->input('first_name');

        $enrollee->other_name = $request->input('other_name');

        $enrollee->marital_status = $request->input('marital_status');

        $enrollee->phone_number = $request->input('phone_number');

        $enrollee->occupation = $request->input('occupation');

        $enrollee->email_address = $request->input('email_address');

        $enrollee->lga = $request->input('lga');

        $enrollee->settlement = $request->input('settlement');

        $enrollee->sex = $request->input('sex');





        $enrollee->ward = $request->input('ward');

        $enrollee->provider_id = $request->input('provider');

        $enrollee->address = $request->input('address');

        $enrollee->nok_name = $request->input('nok_name');

        $enrollee->nok_phone_number = $request->input('nok_phone_number');

        $enrollee->nok_relationship = $request->input('nok_relationship');

        $enrollee->nin = $request->input('nin');

        $enrollee->BHCPF_number = $bhcpf_number;



        $save = $enrollee->save();

        if ($save)

            return response()->json(['status' => 200, 'message' => 'Saved successfully...']);

        else

            return response()->json(['status' => 500, 'message' => 'Oops! Something went wrong.']);

    }



    private function generate_bhcpf_number($data)

    {

        $code = $data['lga_code'];







        if (strtolower($data['sex']) == 'female') {

            $sex = 'F';

        } else {

            $sex = 'M';

        }

        $la = substr($data['surname'], -2);

        $fa = substr($data['first_name'], -2);

        $dob = preg_split('/-/', $data['date_of_birth']);

        $year = substr($dob[0], -2);

        $month = substr($dob[1], -2);

        $day = substr($dob[2], -2);

        return  strtoupper('NIG' . $code . $sex . $fa . $la . $day . $month . $year);

    }



    private function get_lga_info($id)

    {

        $lga = DB::table('lga')->where('id', $id)->first();

        return $lga;

    }



    public function idcard($id)

    {

        $id = base64_decode(base64_decode(base64_decode($id)));

        $enrollee = Enrollee::find($id);

        $returnHTML = view('enrolment.idcard_html', compact('enrollee'))->render();

        return redirect('render_idcard')->with('returnHTML', $returnHTML);

    }



    public function idcard_by_provider()

    {

        $providers =  Provider::where('hcptype', 'Primary')->get();

        return view('enrolment.idcard_by_provider', compact('providers'));

    }



    public function render_idcard()

    {

        if (!session('returnHTML') == null)

            return view('enrolment.idcard');

        else

            return Redirect::to("/all-enrollees");

    }





    public function print_idcard_by_provider(Request $request)

    {

        request()->validate([

            'provider_id' => 'required',

        ]);





        $enrollees = Enrollee::select('id', 'first_name', 'surname', 'mode_of_enrolment', 'other_name', 'enrolment_number', 'provider_id', 'BHCPF_number', 'date_of_birth', 'date_of_birth', 'sex', 'occupation')->where('provider_id', $request->get('provider_id'))->where('status', '1')->get();



        $returnHTML = view('enrolment.print_idcard_by_provider_html', compact('enrollees'))->render();

        return redirect('render_idcard_by_provider')->with('returnHTML', $returnHTML);

    }



    public function render_idcard_by_provider()

    {

        if (!session('returnHTML') == null)

            return view('enrolment.print_idcard_by_provider');

        else

            return Redirect::to("/idcard-by-provider");

    }



    public function enrolment_approval()

    {

        $enrollees_not_approved = DB::Select("SELECT * FROM tbl_enrolee WHERE enrolment_approval_status = '0' AND status = '1'  ORDER BY synced_datetime DESC  LIMIT 500");

        

       $collection = collect($enrollees_not_approved);

        $enrollees_list = $collection->shuffle();

        $enrollees = collect($enrollees_list)->take(40);

        return view('enrolment.enrolment_approval', compact('enrollees'));

    }



    public function approve_reject_enrolment(Request $request)

    {

        request()->validate([

            'id' => 'required',

            'enrolment_approval_status' => 'required',

        ]);



        $user_data = session()->get('user_data');

        $user_id = $user_data->id;

        $approved_date = date('Y-m-d h:i:s');

        $approval_comment = $request->input('approval_comment');

        $reject_reason = $request->input('$reject_reason');

        $enrollee = Enrollee::find($request->input('id'));

        $enrollee->enrolment_approval_status = $request->input('enrolment_approval_status');

        $enrollee->approved_by = $user_id;

        $enrollee->approved_date = $approved_date;

        $enrollee->approval_comment = $approval_comment;

        $save = $enrollee->save();





        if ($save)

            return response()->json(['status' => 200, 'message' => 'Done successfully...']);

        else

            return response()->json(['status' => 500, 'message' => 'Oops! Something went wrong.']);

    }





    public function enrolment_slip_print()

    {

        return view('enrolment.slip.enrolment_slip_print');

    }

    

    public function recapture_list()

    {

       // dd('Under construction');

           $enrollees = DB::Select("SELECT * FROM tbl_enrolee WHERE approval_comment != 'none' ");

           return view('enrolment.recapture_list', compact('enrollees'));

    }





    public function print_bulk_enrolment_slip(Request $request)

    {

        request()->validate([

            'lga' => 'required',

        ]);



        $lga = $request->get('lga');

        $provider_id = $request->get('provider_id');
        $filter_by = $request->get('filter_by');
        $from = $request->get('from');
        $to = $request->get('to');
        
        $current_date = date('Y-m-d');

        $other_string = !empty($provider_id) ? " AND  provider_id = $provider_id " : "";
        
        
        if($from != $current_date &&  !empty($filter_by)){
           $other_string .= " AND  ($filter_by >= '$from' AND $filter_by <= '$to' ) " ;  
        }
       


        //$enrollees = Enrollee::where('lga', $lga)->where('status', '1')->get();

        $enrollees = DB::Select("SELECT * FROM tbl_enrolee WHERE lga = ? AND status = '1' $other_string AND enrolment_approval_status = '1' AND approval_comment= 'none'", [$lga]);



        return view('enrolment.slip.print_bulk_enrolment_slip', compact('enrollees'));

    }



    

    public function get_bhcpf_enrollees(Request $request) {
        $category = $request->get('category');
        $string = ' ';
        if($category != 'All'){
            $string = " AND vulnerability_status = '$category'  ";
        }


        $enrollees = DB::Select("SELECT * FROM tbl_enrolee WHERE mode_of_enrolment = 'huwe' $string AND status = '1' ");
        return view('enrolment.bhcpf_enrollees', compact('enrollees'));
    }

    public function bhcpf_enrollees(Request $request) {
        $enrollees = null;
        return view('enrolment.bhcpf_enrollees', compact('enrollees'));
    }
        
    public function move_enrollees_to_another_provider(Request $request) {

        $enrolleeIds = $request->get('enrollees_id');

        $provider_id = $request->get('provider_id');

        $user_data = session()->get('user_data');

        $user_id = $user_data->id;

        $msg = '';

        $provider = $this->providerRepository->find($provider_id);

        for ($i = 0; $i < count($enrolleeIds); $i++) {

            $id = $enrolleeIds[$i];

            $enrollee = $this->enrolleeRepository->find($id);

            $msg .= $enrollee->enrolment_number.' IS moved to '.$provider->hcpname.'         |        ';

           $changed = $this->enrolleeRepository->changeProvider($id, $provider, $user_id);

        }



        if($changed){

            return  redirect()->route('enrolment.enrollees-by-provider')->with('success',$msg);

        }else{

            return  redirect()->route('enrolment.enrollees-by-provider')->with('error','Oops! Something went wrong...');

        }

    }

}

