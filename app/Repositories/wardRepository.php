<?php
namespace App\Repositories;
use App\Helpers\HP;
use App\Ward;
use Error;

class WardRepository{


    /******************************* Services Grouup  ************************************/
    public function all(){
        return Ward::all();
    }

    public function find($id){
        return Ward::findOrFail($id);
    }

   
    

    
}
