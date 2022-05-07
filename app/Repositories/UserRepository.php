<?php
namespace App\Repositories;
use JWTAuth;
use App\User;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use App\Helpers\HP;
use Error;

class UserRepository{

    public function all(){
        return User::where('status', '1')->get();
    }


    public function find($id){
        return User::findOrFail($id);
    }

    public function authUser(){
        return Auth::user();
    }

    public function authUserId(){
        return Auth::id();
    }

    public function authUserName(){
       return  Hp::formatName(Auth::user());

    }

    public function authUserUsername(){
        return Auth::user()->nicare_code;
    }

    public function authenticUser($username, $md5_password){
        return   User::where('nicare_code', $username)
        ->where('password', $md5_password)->first();
    }
}
