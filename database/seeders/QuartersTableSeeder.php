<?php

namespace Database\Seeders;

use App\Models\Quarter;
use Illuminate\Database\Seeder;

class QuartersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $quarters = [
            [
                'name' => 'Quarter 1',
                'short_name' => 'Q1',
            ],
            [
                'name' => 'Quarter 2',
                'short_name' => 'Q2',
            ],
            [
                'name' => 'Quarter 3',
                'short_name' => 'Q3',
            ],
            [
                'name' => 'Quarter 4',
                'short_name' => 'Q4',
            ],
        ];

        foreach ($quarters as $quarter) {
            Quarter::create($quarter);
        }
    }
}
