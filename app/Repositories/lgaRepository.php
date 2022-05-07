<?php
namespace App\Repositories;
use App\Helpers\HP;
use App\Lga;
use Error;

class LgaRepository{


    /******************************* Services Grouup  ************************************/
    public function all(){
        return Lga::where('status', '1')->orderBy('lga')->get();
    }

    public function find($id){
        return Lga::findOrFail($id);
    }

   
    

    
}
