<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Zulfan Admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => '2025-05-04 11:26:27',
                'password' => Hash::make('123456'),
                'is_role' => 1,
                'created_at' => '2025-05-04 19:58:27',
                'updated_at' => '2025-05-04 16:47:16',
            ],
            [
                'name' => 'Zulfan Manager',
                'email' => 'manager@gmail.com',
                'email_verified_at' => '2025-05-04 11:26:27',
                'password' => Hash::make('123456'),
                'is_role' => 2,
                'created_at' => '2025-05-04 19:58:27',
                'updated_at' => '2025-05-04 16:47:16',
            ],
        ]);
    }
}
