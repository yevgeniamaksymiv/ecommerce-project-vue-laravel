<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 9; $i++) {
            DB::table('products')->insert([
                'name' => Str::random(length: 8),
                'description' => Str::random(length: 20),
                'price' => random_int(1000, 5000),
                'size' =>  random_int(38, 46)
            ]);
        }

    }
}
