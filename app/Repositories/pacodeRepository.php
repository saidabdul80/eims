<?php
use Illuminate\Support\Facades\DB;
namespace App\Repositories;
use App\Helpers\HP;
use App\Pacode;
use Error;
use Illuminate\Support\Facades\DB;

class PacodeRepository{

    public function all(){
        return Pacode::where('status', '1')->get();
    }

    public function allUnused(){
        return Pacode::where('status', '1')->get();
    }

    public function allUsed(){
        return Pacode::where('status', '1')->get();
    }


    public function byProvider($data){
        $key = array_keys($data)[0];
        return Pacode::where($key, $data[$key])->where('status','!=', '1')->get();
    }

    public function find($id){
        return Pacode::findOrFail($id);
    }

    public function findByCode($code){
        return Pacode::where('pacode', $code)->first();
    }
    
    
    public function referedEnrollees(){
        $enrollees = DB::select("SELECT DISTINCT p.enrollee_id,
            e.surname, e.first_name, e.other_name, e.enrolment_number, e.BHCPF_number, e.sex, e.phone_number, e.mode_of_enrolment, 
            pr.hcpname
        FROM tbl_pacode p 
        INNER JOIN tbl_enrolee e 
            ON p.enrollee_id = e.id 
        INNER JOIN tbl_providers pr 
            ON e.provider_id = pr.id 
        WHERE e.status 
        ORDER BY created_at DESC ");
        return $enrollees;
        
    }

    public function pendings($id){
        return Pacode::where('enrollee_id', $id)->where('status','2')->get();
    }

    public function recent_pacodes(){
        return DB::Select($this->paCodeSqlString());
    }

    public function enrollee_pacodes($data){
        return DB::Select($this->paCodeSqlString($data));
    }
    
    public function pacodesByDate($date){
        $enrollees = DB::select("
        SELECT  e.surname, 
        e.first_name, e.other_name, concat(e.surname,' ',e.first_name)  full_name,
        e.sex, e.lga, e.ward,e.enrolment_number,
        p1.hcpname sending_provider,
        p2.hcpname receiving_provider,  p2.id receiving_provider_id,
        pr.programme_name,
        a.*
        FROM tbl_pacode a
        INNER JOIN tbl_enrolee e 
            ON a.enrollee_id = e.id
        INNER JOIN tbl_programme_case pc 
            ON a.case_id = pc.id
        INNER JOIN tbl_providers p1 
            ON a.s_provider = p1.id
        INNER JOIN tbl_providers p2 
            ON a.r_provider = p2.id
        INNER JOIN tbl_programme pr 
            ON a.programme_id = pr.id 
        WHERE a.created_at LIKE '$date%'
        ORDER BY created_at DESC ");
        return $enrollees;
        
    }

    public function totalReferedEnrollees(){
       return Pacode::distinct()->get(['enrollee_id'])->count();
        
    }

  


    public function canceledPacodes(){
        
        return Pacode::where('status', '0')->get();
    }
    public function totalPacodeByMonth($month,$year){
        
        return Pacode::where('date_month', $month)
        ->where('date_year', $year)->get()->count();
    }

    public function totalPacode(){
        
        return Pacode::all()->count();
    }

    public function activePacodes(){
        
        return Pacode::where('status', '2')->get()->count();
    }

    public function todayPacodes(){
        
        return Pacode::where('created_at', 'LIKE', date('Y-m-d').'%')->get()->count();
    }

    public function usedPacodes(){
        
        return Pacode::where('status', '1')->get()->count();
    }

    public function unusedPacodes(){
        
        return Pacode::where('status', '2')->get()->count();
    }

    public function totalCanceledPacodes(){
        
        return Pacode::where('status', '0')->get()->count();
    }


    public function save($data){
        return DB::table('tbl_pacode')->insert($data);
        
    }
    public function delete($id){
        $pacode =  Pacode::find($id);
            $pacode->status = '0';
        return $pacode->save();
    }

   

   
    

  

    private function paCodeSqlString($wheres = [], $limit = 0, $order = 'DESC'){
        $where_string ='';
        $limit_string = $limit > 0 ? " LIMIT $limit " : " ";
        if(count($wheres) > 0){
            $where_string =' WHERE ';
            foreach($wheres as $key => $value){
                $where_string .= " ".$key."=".$value." AND";
            }
            $where_string= chop($where_string,"AND");
        }
        

        $sql = "
        SELECT  e.surname, 
        e.first_name, e.other_name, concat(e.surname,' ',e.first_name)  full_name,
        e.sex, e.lga, e.ward,e.enrolment_number,
        p1.hcpname sending_provider,
        p2.hcpname receiving_provider,  p2.id receiving_provider_id,
        pr.programme_name,
        a.*
        FROM tbl_pacode a
        INNER JOIN tbl_enrolee e 
            ON a.enrollee_id = e.id
        INNER JOIN tbl_programme_case pc 
            ON a.case_id = pc.id
        INNER JOIN tbl_providers p1 
            ON a.s_provider = p1.id
        INNER JOIN tbl_providers p2 
            ON a.r_provider = p2.id
        INNER JOIN tbl_programme pr 
            ON a.programme_id = pr.id 
             $where_string
            $limit_string
            ORDER BY created_at $order
            ";

        return $sql;
    }

    
}
