<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Session;
use Closure;
use Illuminate\Support\Facades\DB;
use App\User;
class loginAuth
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
       
        if (!Session::get('user_data')) {
            return redirect('/');
        }

        return $next($request);
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
}
