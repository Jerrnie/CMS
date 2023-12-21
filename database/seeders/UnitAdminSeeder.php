<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = \App\Models\Unit::all();

        foreach ($units as $unit) {
            //insert all units in super admin with id 1
            \App\Models\UnitAdmin::create([
                'unit_id' => $unit->id,
                'admin_id' => 1,
            ]);
        }
    }
}
