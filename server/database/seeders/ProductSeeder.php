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
        $colors = ['чорний', 'синій', 'сірий', 'коричневий', 'білий', 'червоний', 'жовтий','зелений'];
        $sizes = [46, 48, 50, 52, 54, 56, 58];
        $categoryIds = DB::table('categories')
            ->whereNotNull('parent_id')->pluck('id')->toArray();
        $img_path = ['images/products/1680183724_white-suit.jpg', 'images/products/1680183709_blue-shirt.png'];

        for ($i = 0; $i < 199; $i++) {
            DB::table('products')->insert([
                'name' => Str::random(length: 8),
                'description' => Str::random(length: 200),
                'price' => random_int(500, 10000),
                'quantity' => random_int(1, 20),
                'size' =>  array_rand($sizes),
                'color' => array_rand($colors),
                'img_path' => array_rand($img_path),
                'category_id' => $categoryIds[array_rand($categoryIds)],
            ]);
        }

    }
}
