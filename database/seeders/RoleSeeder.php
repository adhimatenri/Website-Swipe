<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            'id'         => 1,
            'name'       => 'superadmin',
            'permission' => json_encode(["manage_users", "manage_events", "jamaah"]),
            'created_at' => now(),
        ]);

        DB::table('roles')->insert([
            'id'         => 2,
            'name'       => 'admin',
            'permission' => json_encode(["view_events", "jamaah"]),
            'created_at' => now(),
        ]);
    }
}
