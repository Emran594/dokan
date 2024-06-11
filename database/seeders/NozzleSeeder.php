<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NozzleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nozzles = [
            [
                'nozzle_name' => 'D-1',
                'nozzle_name_bangla' => 'ডিজেল-১',
                'tank_id' => 1,
                'current_meter_reading' => 1234.5678,
                'status' => 'active',
            ],
            [
                'nozzle_name' => 'D-2',
                'nozzle_name_bangla' => 'ডিজেল-২',
                'tank_id' => 1,
                'current_meter_reading' => 1234.5678,
                'status' => 'active',
            ],
            [
                'nozzle_name' => 'Octane 1',
                'nozzle_name_bangla' => 'অকটেন ১',
                'tank_id' => 2,
                'current_meter_reading' => 2345.6789,
                'status' => 'inactive',
            ],
            [
                'nozzle_name' => 'Octane-1',
                'nozzle_name_bangla' => 'অকটেন ২',
                'tank_id' => 2,
                'current_meter_reading' => 2345.6789,
                'status' => 'inactive',
            ],
            [
                'nozzle_name' => 'Petrol-1',
                'nozzle_name_bangla' => 'পেট্রোল-১',
                'tank_id' => 3, // Make sure this matches a valid tank_id from your tanks table
                'current_meter_reading' => 3456.7890,
                'status' => 'active',
            ],
            [
                'nozzle_name' => 'Petrol-2',
                'nozzle_name_bangla' => 'পেট্রোল-২',
                'tank_id' => 3,
                'current_meter_reading' => 3456.7890,
                'status' => 'active',
            ],
        ];

        DB::table('nozzles')->insert($nozzles);
    }
}
