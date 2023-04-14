<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

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

        $img_path = [];
        for ($i = 1; $i <= 16; $i++) {
            $filename = "images/products/mens-wear-" . $i . ".jpg";
            $img_path[] = $filename;
        }

        for ($i = 0; $i < 500; $i++) {
            $id = $categoryIds[array_rand($categoryIds)];
            $name =  DB::table('categories')->where('id', $id)->value('name');
            DB::table('products')->insert([
                'name' => $name . ' ' . Str::random(length: 5),
                'description' => Str::random(length: 300),
                'price' => random_int(500, 10000),
                'quantity' => random_int(5, 20),
                'size' =>  $sizes[array_rand($sizes)],
                'color' => $colors[array_rand($colors)],
                'img_path' => $img_path[array_rand($img_path)],
                'category_id' => $id,
                'created_at' => Carbon::now(),
            ]);
        }
    }
}
