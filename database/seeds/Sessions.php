<?php

use Illuminate\Database\Seeder;
use App\Sessions;
class SessionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
