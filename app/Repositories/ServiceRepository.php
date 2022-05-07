<?php
namespace App\Repositories;
use App\Helpers\HP;
use App\Programme;
use App\ProgrammeCase;
use Error;

class ServiceRepository{


    /******************************* Services Grouup  ************************************/
    public function allServiceGroup(){
        return Programme::where('status', '1')->get();
    }
    public function totalServiceGroup(){
        return Programme::where('status', '1')->get()->count();
    }
    public function findGroup($id){
        return Programme::findOrFail($id);
    }

    public function serviceGroupByCode($code){
        return Programme::where('programme_code', $code)->where('status', '1')->first();
    }
    
    /******************************* Services  ************************************/

    public function allServices(){
        return ProgrammeCase::where('status', '1')->get();
    }

    public function totalServices(){
        return ProgrammeCase::where('status', '1')->get()->count();
    }

    public function allRefferableServices(){
        return ProgrammeCase::where('status', '1')
        ->where('level_of_care', '!=', 'P')
        ->get();
    }

    public function allRefferablesSchemeServices($scheme){
        return ProgrammeCase::where('status', '1')
        ->where('level_of_care', '!=', 'P')
        ->where('service_scheme', 'like', '%'.$scheme.'%')
        ->get();
    }
    public function findService($id){
        return ProgrammeCase::findOrFail($id);
    }


    public function serviceByCode($code){
        return ProgrammeCase::where('case_code', $code)->where('status', '1')->first();
    }

   
    

    public function serviceByGroup($group){
        return ProgrammeCase::where('programme_id', $group)->where('status', '1')->get();
    }

   


    public function serviceByServiceScheme($scheme){
        return ProgrammeCase::where('service_scheme', $scheme)->where('status', '1')->get();
    }

    public function update($data, $id, $no = 1){
        return  $no ==1 ? ProgrammeCase::where('id', $id)->update($data) : Programme::where('id', $id)->update($data);
    }
    
    public function save($data, $no = 1){
        return  $no ==1 ? ProgrammeCase::insert($data) : Programme::insert($data);
    }

   

    
    
}
