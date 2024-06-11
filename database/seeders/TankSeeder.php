<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tanks = [
            [
                'name' => 'Diesel Tank',
                'name_bangla' => 'ডিজেল ট্যাঙ্ক',
                'tank_size' => 5000.0000,
                'opening_stock' => 2500.0000,
                'purchase_price' => 75.5000,
                'sell_price' => 80.7500,
                'status' => 'active',
            ],
            [
                'name' => 'Octane Tank',
                'name_bangla' => 'অকটেন ট্যাঙ্ক',
                'tank_size' => 10000.0000,
                'opening_stock' => 8000.0000,
                'purchase_price' => 74.0000,
                'sell_price' => 79.5000,
                'status' => 'active',
            ],
            [
                'name' => 'Petrol Tank',
                'name_bangla' => 'পেট্রোল ট্যাঙ্ক',
                'tank_size' => 7500.0000,
                'opening_stock' => 3000.0000,
                'purchase_price' => 76.2500,
                'sell_price' => 81.0000,
                'status' => 'active',
            ],
        ];

        DB::table('tanks')->insert($tanks);
    }
}
