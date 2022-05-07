<?php
namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use App\Helpers\HP;
use App\Provider;
use Error;

class ProviderRepository{


    /******************************* Services Grouup  ************************************/
    public function all(){
        return Provider::where('status', '1')->orderBy('hcpname')->get();
    }

    public function total(){
        return Provider::count();
    }

    public function find($id){
        return Provider::findOrFail($id);
    }

    public function findByCode($code){
        return Provider::where('hcpcode', $code)->where('status', '1')->first();
    }
    

    public function allSecondaryProviders(){
        return Provider::where('hcptype', 'Secondary')->where('status', '1')->orderBy('hcpname')->get();
    }

    public function allPrimaryProviders(){
        return Provider::where('hcptype', 'Primary')->where('status', '1')->orderBy('hcpname')->get();
    }

    public function allRefferableProviders(){
        return Provider::where('serviceClaimType', '!=' ,'cap')->where('status', '1')->get();
    }

    public function totalSecondaryProviders(){
        return Provider::where('hcptype', 'Secondary')->where('status', '1')->get()->count();
    }

    public function get($data){
        return DB::Select($this->sqlString($data));
    }

    public function update($data, $id){
     return  DB::table('tbl_providers')->where('id', $id)->update($data); 
    }

    
    public function save($data){
        return  DB::table('tbl_providers')->insert($data); 
       }

    private function sqlString($wheres = [], $limit = 0, $order = 'DESC'){
   
        $where_string ='';
        $limit_string = $limit > 0 ? " LIMIT $limit " : " ";
        if(count($wheres) > 0){
            $where_string =' WHERE ';
            foreach($wheres as $key => $value){
                $where_string .= " p.".$key."=".$value." AND";
            }
            $where_string= chop($where_string,"AND");
        }
        

        $sql = "
        SELECT  p.*, w.ward, l.lga
        FROM tbl_providers p 
        INNER JOIN ward w
            ON p.hcpward = w.id 
        INNER JOIN lga l
            ON p.hcplga = l.id 
            $where_string
            $limit_string
            ORDER BY hcpname $order
            ";
     
        return $sql;
    }
    

    
}
