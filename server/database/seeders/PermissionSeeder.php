<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert([
            ['name' => 'role.create', 'description' => 'create new role'],
            ['name' => 'role.access', 'description' => 'access role'],
            ['name' => 'role.update', 'description' => 'update role'],
            ['name' => 'role.delete', 'description' => 'delete role'],
            ['name' => 'user.create', 'description' => 'create new user'],
            ['name' => 'user.access', 'description' => 'access user'],
            ['name' => 'user.update', 'description' => 'update user'],
            ['name' => 'user.delete', 'description' => 'delete user'],
            ['name' => 'delivery.create', 'description' => 'create new delivery'],
            ['name' => 'delivery.access', 'description' => 'access delivery'],
            ['name' => 'delivery.update', 'description' => 'update delivery'],
            ['name' => 'delivery.delete', 'description' => 'delete delivery'],
            ['name' => 'order.create', 'description' => 'create new order'],
            ['name' => 'order.access', 'description' => 'access order'],
            ['name' => 'order.update', 'description' => 'update order'],
            ['name' => 'order.delete', 'description' => 'delete order'],
            ['name' => 'category.create', 'description' => 'create new category'],
            ['name' => 'category.access', 'description' => 'access category'],
            ['name' => 'category.update', 'description' => 'update category'],
            ['name' => 'category.delete', 'description' => 'delete category'],
            ['name' => 'product.create', 'description' => 'create new product'],
            ['name' => 'product.access', 'description' => 'access product'],
            ['name' => 'product.update', 'description' => 'update product'],
            ['name' => 'product.delete', 'description' => 'delete product'],
        ]);
    }
}
