<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            'ADMIN',
            'ASRH Portfolio',
            'CDRP',
            'CORPCOMM',
            'HR',
            'IMS',
            'LHS Portfolio',
            'Nutrition Portfolio',
            'OED',
            'Strategy and Partnerships',
            'UNFPA',
            'KGJF-PNGP',
            'TCI',
            'ZFFI',
            'FINANCE',
            'BARMMHEALTH',
            'UNFPA-MISP',
            'PLGP 3',
            'Office of the President',
            'ASRH Portfolio- M&E',
            'KGJF 3',
            'PLGP4',
            'HRIMSA',
            'S. ZUELLIG',
            'PASCAL GUIESSAZ',
            'ASRH: RRR',
        ];

        foreach ($units as $unit) {
            DB::table('units')->insert([
                'name' => $unit,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
