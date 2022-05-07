<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\JWTSubject;
class Tpa extends Authenticatable implements JWTSubject
{
    use Notifiable;

    public $table = 'tbl_tpa';

    public function permissions(){
        return $this->hasMany(Permission::class );
    }



    public function getJWTIdentifier()

    {

        return $this->getKey();

    }

    public function getJWTCustomClaims()

    {

        return [];

    }

    static public function scopeLike($query,$obj)
    {        
        foreach($obj as $column => $value){
            if($value != ""){
                $query->orWhere($column,'like', $value);            
            }
        }
        return $query;
    }

    public function tpa_institution(){
       return $this->hasMany(Tpa_institution::class);
    }

}
