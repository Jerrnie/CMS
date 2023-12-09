<?php

namespace Database\Seeders;

use App\Models\ExpertiseField;
use Illuminate\Database\Seeder;

class ExpertiseFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $expertiseFields = [
            'Information Technology (IT)',
            'Healthcare',
            'Business and Finance',
            'Engineering',
            'Science',
            'Education',
            'Art and Design',
            'Law and Legal Services',
            'Social Sciences',
            'Agriculture and Environmental Sciences'
            // Add more as needed
        ];

        foreach ($expertiseFields as $field) {
            ExpertiseField::firstOrCreate([
                'name' => $field,
            ]);
        }
    }
}
