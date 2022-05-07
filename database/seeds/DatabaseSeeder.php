<?php

use Illuminate\Database\Seeder;
use Database\seeds\InstitutionSeeder;
use App\Tpa;
use App\Sessions;
use App\Institution;
use App\Roles;

class DatabaseSeeder extends Seeder

{

    /**

     * Seed the application's database.

     *

     * @return void

     */

    public function run()

    {

        Institution::create([
            "name"=>"IBB Univeristy",
            "sortCode"=>"IBB"
        ]);

        Institution::create([
            "name"=>"Federal University of Technology Minna",
            "sortCode"=>"FUT"
        ]);   
        
        
        Sessions::create([
            "name"=> "2020/2021"
        ]);

        Sessions::create([
            "name"=> "2021/2022"
        ]);

        Sessions::create([
            "name"=> "2022/2023",
            "is_current"=> now(),
        ]);

    }

}

