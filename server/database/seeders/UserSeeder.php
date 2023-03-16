<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for ($i = 0; $i < 9; $i++) {
            DB::table('users')->insert([
                'name' => Str::random(length: 8),
                'surname' => Str::random(length: 8),
                'email' => Str::random(10) . '@gmail.com',
                'password' => Str::random(length: 8)
//                'password' => Hash::make('password'),
            ]);
        }
    }
}
