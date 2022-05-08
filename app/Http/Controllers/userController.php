<?php



namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use Validator,Redirect,Response;

use JWTAuth;

use App\User;
use App\Sessions;

use Illuminate\Support\Str;

use Tymon\JWTAuth\Exceptions\JWTException;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

use Session;



class userController extends Controller

{

    //



	public function user(Request $request){

        

        $user = JWTAuth::toUser($this->bearerToken($request));

        // get the details in the payload

        //$payload = JWTAuth::getPayload($this->bearerToken($request));

        //return response()->json($user);

        return response()->json(['status'=>200,"data"=>$user]);

    }



    public function postLogin(Request $request){

        request()->validate([

        'nicare_code' => 'required',

        'password' => 'required',

        ]);

 

       

       $user = DB::table('users')

            ->join('user_role', 'users.user_role_id', '=', 'user_role.id')

            ->select('users.*', 'user_role.role_name')

            ->where('users.nicare_code', $request->get('nicare_code'))

            ->where('users.password', md5($request->get('password')))

            ->where('users.status', '=', '1')

            ->where('user_role.group_id', '=', 1) //// Only Agency staff have access here

            ->first();



        //dd( md5($request->get('password')));

        if(empty($user)){

            session()->flash('error',' Invalid user id or password...');

            return Redirect::to("/");

        }

        $user = User::where('nicare_code', $request->get('nicare_code'))->where('password', md5($request->get('password')))->first();

        $payloadable = [

            'nicare_code' => $request->get('nicare_code'),

            'password' => $request->get('password'),

        ];



        $token = JWTAuth::customClaims([

            'nicare_code' => $user->nicare_code,

        ])->fromUser($user);

        $current_session = Sessions::where('is_current','!=', Null)->first();      



        

        session([

            'token' => $token,

            'user_data' => $user,

            'user_menus' => $this->user_menus($user->id),

            'session_id'=>$request->session()->regenerate(),
            
            'current_session'=> $current_session

            ]);

            session()->flash('welcome',"You're welcome ".$user->surname."!");

        return Redirect::to("home");

    }



    private function user_menus($user_id){

        $menu_head_id_stmt =  DB::Select("SELECT distinct u.menu_head_id,h.title FROM user_menus u 

        inner join menu_heads h 

        on u.menu_head_id=h.id 

        WHERE u.user_id=? AND u.status='1' order by menu_head_id",[$user_id]);



        $head = $menu_head_id_stmt;

        $subhead = [];

        if(count($menu_head_id_stmt)  < 1){

            return ['heads'=> $head,'subheads'=> $subhead]; 

        }



       

        foreach ($menu_head_id_stmt as $key => $menu_head) {

            

            $user_menus =  DB::Select("SELECT s.title,s.link,s.id as s_id,u.id,s.function,s.route 

            FROM user_menus u 

            inner join sub_menus s 

            on u.sub_menu_id = s.id 

            WHERE u.menu_head_id=? 

            AND u.user_id=? 

            AND u.status='1' 

            AND s.status='1'",[$menu_head->menu_head_id,$user_id]);



            array_push($subhead,$user_menus);	

        }

        

        return ['heads'=> $head,'subheads'=> $subhead]; 

    }

	

    public function login(Request $request){



    	 $validator = Validator::make($request->all(), [

            'user_id' => 'required',

            'password' => 'required|min:4',

        ]);

        

       

         if($validator->fails()){

         		return response()->json(['status'=>'error',"message"=>"User ID and Password is required ","token"=>""]);

         }



        $payloadable = [

            'user_id' => $request->get('user_id'),

            'password' => $request->get('password'),

        ];

         $user = User::where('nicare_code', $request->get('user_id'))

       ->where('password', md5($request->get('password')))->first();

        



        try {

            

            if(empty($user)){

                return response()->json(['status' => 'error', 'message' => 'Invalid Credentials', 'token' => '']);

            }

            

             $token = JWTAuth::fromUser($user,$payloadable);

        } catch (JWTException $e) {

            return response()->json(['status' => 'error','message' => 'Could not create token']);

           

        }



    	return response()->json(['status' => 'success', 'message' => 'Logged In Successfully', 'token' => $token, 'user' => $user]);

    }





    public function bearerToken($request)

    {

       $header = $request->header('Authorization', '');

       if (Str::startsWith($header, 'Bearer ')) {

                return Str::substr($header, 7);

       }

    }

}

