<?php

namespace Database\Seeders;

use App\Models\BudgetCode;
use App\Models\Quarter;
use App\Models\Unit;
use App\Models\Year;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BudgetCodesSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //create seeder for budgetcode       // Get all units and quarters
        $units = Unit::all();
        $quarters = Quarter::all();
        $years = Year::all();

        // Create 10 budget codes for each unit and quarter combination
        foreach ($units as $unit) {
            foreach ($quarters as $quarter) {
                for ($i = 1; $i <= 4; $i++) {
                    BudgetCode::create([
                        'year_id' => 1,
                        'unit_activity' => "Activity $i",
                        'budget' => rand(1000, 5000),
                        'unit_id' => $unit->id,
                        'quarter_id' => $quarter->id,
                    ]);
                }
            }
        }
    }
}
