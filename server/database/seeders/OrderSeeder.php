<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = DB::table('users')->pluck('id')->toArray();
        $deliveryIds = DB::table('deliveries')->pluck('id')->toArray();

        for ($i = 0; $i <= 9; $i++) {
            DB::table('orders')->insert([
                [
                    'order_date' => Carbon::parse(),
                    'delivery_address' => Str::random(length: 50),
                    'order_amount' =>  random_int(1000, 10000),
                    'user_id' => $userIds[array_rand($userIds)],
                    'delivery_id' => $deliveryIds[array_rand($deliveryIds)],
                ],
            ]);
        }
    }
}
