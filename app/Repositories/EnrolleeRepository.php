<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

use App\Enrollee;
use App\Tpa;
use Illuminate\Support\Carbon;
use App\Provider;

use Error;



class EnrolleeRepository{



    public function all(){

        return Enrollee::where('status', '1')->get();

    }



    public function findByCode($code){

        return Enrollee::where('enrolment_number', $code)->where('status', '1')->first();

    }



    public function find($id){

        return Enrollee::findOrFail($id);

    }



    public function totalNiCareBHCPF(){

        return DB::Select("SELECT COUNT(id) total, mode_of_enrolment  FROM `tbl_enrolee` WHERE status = '1' GROUP BY mode_of_enrolment ORDER by mode_of_enrolment DESC");

    }



    public function totalEnrolleeBySex(){

        return DB::Select("SELECT COUNT(id) total, sex,mode_of_enrolment  FROM `tbl_enrolee` WHERE  status = '1' GROUP BY mode_of_enrolment,sex ORDER by mode_of_enrolment DESC");

    }

    public function totalEnrolleeByType(){

        return Enrollee::select(DB::raw('COUNT(id) total, enrolee_type'))

        ->where('mode_of_enrolment', 'Premium')

        ->where('status', '1')

        ->groupBy('enrolee_type')->orderBy('enrolee_type', 'DESC')->get();

    }



    public function bhcpfEnrolleeByCategory(){

        return Enrollee::select(DB::raw('COUNT(id) total, vulnerability_status category'))

        ->where('mode_of_enrolment', 'huwe')

        ->where('status', '1')

        ->groupBy('category')->orderBy('category')->get();

    }



    public function bhcpfEnrolleeByDisabilities(){

        return Enrollee::select(DB::raw('COUNT(id) total, disability'))

        ->where('mode_of_enrolment', 'huwe')

        ->where('status', '1')

        ->groupBy('disability')->orderBy('disability')->get();

    }



    public function bhcpfEnrolleeByZone(){

        return DB::Select('select count(z.zone) as total, z.zone from tbl_enrolee as e inner join lga as l on l.id = e.lga inner join tbl_zones as z on z.id=l.zone 

        where e.mode_of_enrolment= "Huwe" and e.status= "1" group by  z.zone');

    }





    public function enrolleeByLgaAndScheme(){

        return Enrollee::select(DB::raw('COUNT(id) total,lga, mode_of_enrolment scheme'))

        ->where('status', '1')

        ->groupBy(['lga', 'mode_of_enrolment'])->orderBy('scheme')->get();

    }



   



    public function enrolleeByWardAndScheme(){

        return Enrollee::select(DB::raw('COUNT(id) total, ward'))

        ->where('status', '1')

        ->where('mode_of_enrolment', 'huwe')

        ->groupBy('ward')->get();

    }



    public function enrolleeByProvider(){

        return Enrollee::select(DB::raw('COUNT(id) total, provider_id'))

        ->where('status', '1')

        ->where('mode_of_enrolment', 'huwe')

        ->groupBy('provider_id')->get();

    }



    public function bhcpfPregnantEnrollee(){

        return Enrollee::where('mode_of_enrolment', 'huwe')

        ->where('pregnant', 1)->get()->count();

    }



    public function capByYear($year, $programme_type){

        return DB::Select("Select cg.month, SUM(c.total_cap) total_cap, SUM(c.total_enrolee) total_enrolee FROM capitations c INNER JOIN capitation_grouping cg ON c.group_id = cg.id WHERE cg.year = ? AND c.status = '1' AND c.programme_type='$programme_type' GROUP BY cg.month", [$year]);

    }

    // return DB::Select("Select cg.month, SUM(c.total_cap) total, SUM(c.total_nicare_enrollees) nicare_total, SUM(c.total_huwe_enrollees) bhcpf_total 

           // FROM capitations c INNER JOIN capitation_grouping cg ON c.group_id = cg.id WHERE cg.year = ? AND c.status = '1' GROUP BY cg.month", [$year]);



    public function get($data){

        

        return DB::Select($this->sqlString($data));

    }



    public function changeProvider($id, $provider, $user_id){

        $enrollee = $this->find($id);

        $prev_provider = $enrollee->provider_id;

            $enrollee->provider_id = $provider->id ;

        $enrollee->save();



        DB::table('tbl_enrollee_provider')->where('enrollee_id',$id)->update([

            'status'=> '0',

            'date_changed' => Carbon::now()

        ]);



       return  DB::table('tbl_enrollee_provider')->insert([

            ['enrollee_id' => $id, 

            'provider_id' => $provider->id, 

            'lga' => $provider->hcplga,

            'ward' => $provider->hcpward,

            'date_joined' => Carbon::now(),

            'changed_by' => $user_id,

            'prev_provider' => $prev_provider,

            'date_changed' => Carbon::now()

            ]

        ]); 

    }



    private function sqlString($wheres = [], $limit = 0, $order = 'DESC'){

   

        $where_string ='';

        $limit_string = $limit > 0 ? " LIMIT $limit " : " ";

        if(count($wheres) > 0){

            $where_string =' WHERE ';

            foreach($wheres as $key => $value){

                $where_string .= " e.".$key."=".$value." AND";

            }

            $where_string= chop($where_string,"AND");

        }

        



        $sql = "

        SELECT  e.*, w.ward ward_name, l.lga lga_name, p.hcpname provider_name

        FROM tbl_enrolee e 

         INNER JOIN tbl_providers p 

            ON e.provider_id = p.id

        INNER JOIN ward w

            ON e.ward = w.id 

        INNER JOIN lga l

            ON e.lga = l.id 

            $where_string

            $limit_string

            ORDER BY enrolment_number $order

            ";

     

        return $sql;

    }
    
 static public function providers($request){        
        
    $length = (int) $request->length;
    $start = $request->get('start');
    $search = $request->search??"";
    $search = str_replace('_','/',$search);       
    $providers= [];     
     
    if($length == -1){
        if($search !=""){
            $search = "%".$search."%";
            $providers =  Provider::with(['provider_institution'=>function($query){
                $query->with('institution');
            }])->where('hcpname','like', $search)->orWhere('hcpcode','like', $search)->paginate($length);  
        }else{
            $providers =  Provider::with(['provider_institution'=>function($query){
                $query->with('institution');
            }])->all();
        }

    }else{
        
        if($search !=""){
            $search = "%".$search."%";
        $providers = Provider::with(['provider_institution'=>function($query){
                    $query->with('institution');
                }])->where('hcpname','like', $search)->orWhere('hcpcode','like', $search)->paginate($length);  
        }else{                
            $providers = Provider::with(['provider_institution'=>function($query){
                $query->with('institution');
            }])->paginate($length);  
        }
    }        
    return $providers;
}
   

    static public function tpas($request){        
        
        $length = (int) $request->length;
        $start = $request->get('start');
        $search = $request->search??"";
        $search = str_replace('_','/',$search);       
        $tpas= [];     
         
        if($length == -1){
            if($search !=""){
                $search = "%".$search."%";
                $tpas =  Tpa::with(['tpa_institution'=>function($query){
                    $query->with('institution');
                }])->where('tpa_email_address','like', $search)->orWhere('tpa_code','like', $search)->paginate($length);  
            }else{
                $tpas =  Tpa::with(['tpa_institution'=>function($query){
                    $query->with('institution');
                }])->all();
            }

        }else{
            
            if($search !=""){
                $search = "%".$search."%";
            $tpas = Tpa::with(['tpa_institution'=>function($query){
                        $query->with('institution');
                    }])->where('tpa_email_address','like', $search)->orWhere('tpa_code','like', $search)->paginate($length);  
            }else{                
                $tpas = Tpa::with(['tpa_institution'=>function($query){
                    $query->with('institution');
                }])->paginate($length);  
            }
        }        
        return $tpas;
    }

}

