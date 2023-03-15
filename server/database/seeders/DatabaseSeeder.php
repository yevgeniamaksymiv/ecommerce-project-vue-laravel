<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'role.create'],
            ['name' => 'role.access'],
            ['name' => 'role.update'],
            ['name' => 'role.delete'],
            ['name' => 'user.create'],
            ['name' => 'user.access'],
            ['name' => 'user.update'],
            ['name' => 'user.delete'],
            ['name' => 'delivery.create'],
            ['name' => 'delivery.access'],
            ['name' => 'delivery.update'],
            ['name' => 'delivery.delete'],
            ['name' => 'order.create'],
            ['name' => 'order.access'],
            ['name' => 'order.update'],
            ['name' => 'order.delete'],
            ['name' => 'category.create'],
            ['name' => 'category.access'],
            ['name' => 'category.update'],
            ['name' => 'category.delete'],
            ['name' => 'product.create'],
            ['name' => 'product.access'],
            ['name' => 'product.update'],
            ['name' => 'product.delete'],
        ];

        foreach ($permissions as $permission) {
            DB::table('permissions')->insert($permission);
        }

//        DB::table('roles')->insert(['name' => 'admin']);
//        DB::table('users')->insert([
//            'name' => 'Admin',
//            'email' => 'admin@gmail.com',
//            'password' => 'admin123',
//            'role_id' => 1
//        ]);


        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
