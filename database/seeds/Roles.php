<?php

use Illuminate\Database\Seeder;
use App\Roles;
class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Roles::create([
            "name" => 'Admin',
            "code" => 'admin_right'
        ]);

        Roles::create([
            "name" => 'TPA',
            "code" => 'tpa_right'
        ]);
    }
}
