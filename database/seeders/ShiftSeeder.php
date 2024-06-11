<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shifts = [
            ['shift_name' => 'Morning Shift'],
            ['shift_name' => 'Afternoon Shift'],
            ['shift_name' => 'Night Shift'],
        ];

        DB::table('shifts')->insert($shifts);
    }
}
