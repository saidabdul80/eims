<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;

class manageUsers extends Controller
{
    //
    public function index()
    {
    	return view('users.manage_users');
    }
    public function add_user(Request $request)
    {
                     

    		$usergroupId = $request->input('usergroupId');
			$userroleid  = $request->input('userroleid');
			$surname    = $request->input('surname');
			$first_name    = $request->input('first_name');
			$phone_number    = $request->input('phone_number');
			$email_address    = $request->input('email_address');
			$address    = $request->input('address');
			$address    = $request->input('address');
			$address    = $request->input('address');
			$address    = $request->input('address');
    	return view('users.manage_users')->with('success','new user added successfully');
    	
    }
    public function user_forms(Request $request)
    {
    	
    	$type = $request->input('type');    	
    	if (empty($type)) {
    		return '<div class="alert alert-warning">select a role</div>';
    	}

    	return view('users.main', ['type'=>$type])->render();;
    }
}
