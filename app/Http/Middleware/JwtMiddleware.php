<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Log;
use Closure;
use JWTAuth;
use Exception;
use Illuminate\Support\Facades\DB;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try{
             if (! $user = JWTAuth::parseToken()->authenticate()) {
                 return response()->json(['status' =>  404, 'message'=> 'user_not_found'], 404);
            }
        } catch (Exception $e) {
            
           
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['status' =>  404, 'message'=> 'Token is Invalid']);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['status' => 404, 'message'=>'Token is Expired']);
            }else{
                return response()->json(['status' => 404, 'message'=>'Authorization Token not found']);
            }
        }
         return $next($request);
    }
}
