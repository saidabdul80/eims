<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator,Redirect,Response;
use App\Drug;
use App\Claim;
use App\Pacodes;
use Session;

class claimController extends Controller
{
    public function index()
    {   
        //dd(Session::get('user_menus'));
        return view('rcms.home');
    }

    
}
