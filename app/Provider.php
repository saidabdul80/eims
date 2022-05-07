<?php



namespace App;



use Illuminate\Database\Eloquent\Model;



class Provider extends Model

{

    protected $table = 'tbl_providers';

    public function provider_institution(){
        return $this->hasMany(provider_institution::class);
     }

}

