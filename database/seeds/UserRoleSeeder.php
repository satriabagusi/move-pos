<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_roles')->insert([
            'role_name' => 'Admin',
            'created_at' => today(),
            'updated_at' => today()
        ]);

        DB::table('user_roles')->insert([
            'role_name' => 'Cashier',
            'created_at' => today(),
            'updated_at' => today()
        ]);
    }
}
