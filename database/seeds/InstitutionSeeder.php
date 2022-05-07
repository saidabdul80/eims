<?php

use Illuminate\Database\Seeder;
use App\Institution;
class InstitutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
    }
}
