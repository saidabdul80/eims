<?php

use Illuminate\Database\Seeder;
use App\Tpa;

class TpaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     
        Tpa::crete([
            "tpa_code"=>'TPA/0002',
            "tpa_phone_number"=> '08051322662',
            "tpa_email_address"=> 'info@integratedhealthcareltd.com', 
            "tpa_address"=>'No_ 19 Jos Street, Area 3 Garki, Abuja ',
             "organisation"=>'Integrated Healthcare Limited', 
             "bankName"=>'Zenith Bank Plc',
             "bankAccountName"=> 0,
             "bankAccountNumber"=>'1010625933', 
             "sortCode"=> '057080044',
             "zone_id"=> 1,
             "date_register"=> '2020-07-01',
             "password"=>md5(12345)
        ]);
        Tpa::crete([
            "tpa_code"=>'TPA/0003',
            "tpa_phone_number"=> '08085927262',
            "tpa_email_address"=> 'info@prepaidmedicareng.com', 
            "tpa_address"=>'Suit F6, 3rd Floor, Wing C,
             "organisation"=>ABM Plaza, Opp. Utako Market, Plot 23Ekukinam Street Off Obafemi Awolowo Way Utako District, Abuja', 
             "bankAccountName"=>'Prepaid Medicare Services',
             "bankName"=> 'ECOBANK',
             "bankAccountNumber"=>'3342020881',
             "sortCode"=> '050080892',
             "zone_id"=> 1,
             "date_register"=> '2020-07-01',
             "password"=>md5(12345)
        ]);
        Tpa::crete([
            "tpa_code"=>'TPA/0004',
            "tpa_phone_number"=> '08036650203',
            "tpa_email_address"=> 'info@markfema.com', 
            "tpa_address"=>'4A Lumsar Street, Ibrahim Abacha Estate, 
            "organisation"=>Wuse Zone 4, Abuja',
             "bankAccountName"=>'Markfema Nigeria Limited',
             "bankName"=> 'Sterling Bank Plc',
             "bankAccountNumber"=>'0067342779',
             "sortCode"=> '232080050',
             "zone_id"=> 1,
             "date_register"=> '2020-07-03',
             "password"=>md5(12345)
        ]);

    }
}
