<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'id' => Str::uuid(),
            'name' => 'superadmin',
            'email' => 'superadmin@example.com',
            'phone' => '081234567890',
            'gender' => 'male',
            'role_id' => 1,
            'password' => Hash::make('superadmin'),
            'created_at' => now(),
        ]);

        DB::table('users')->insert([
            'id' => Str::uuid(),
            'name' => 'admin',
            'email' => 'admin@example.com',
            'phone' => '081111111111',
            'gender' => 'female',
            'role_id' => 2,
            'password' => Hash::make('admin1'),
            'created_at' => now(),
        ]);
    }
}
