<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('categories')->insert([
            ['name' => 'Одяг'],
            ['name' => 'Аксесуари'],
        ]);

        DB::table('categories')->insert([
            ['name' => 'Куртки, пальта, пуховики', 'parent_id' => 1],
            ['name' => 'Піджаки', 'parent_id' => 1],
            ['name' => 'Штани', 'parent_id' => 1],
            ['name' => 'Сорочки', 'parent_id' => 1],
            ['name' => 'Футболки', 'parent_id' => 1],
            ['name' => 'Светри', 'parent_id' => 1],
            ['name' => 'Взуття', 'parent_id' => 2],
            ['name' => 'Сумки', 'parent_id' => 2],
            ['name' => 'Білизна', 'parent_id' => 2],
            ['name' => 'Шапки, шарфи, рукавиці', 'parent_id' => 2],
            ['name' => 'Пояси, гаманці', 'parent_id' => 2],
        ]);
    }
}
