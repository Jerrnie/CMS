<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DocumentCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DocumentCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Authorization To Negotiate',
            'Commendations and Awards',
            'ISO/Quality Assurance Certification',
            'Incorporation Document',
            'News Items',
            'References',
            'Resume',
            'Scanned ID (Passport, Driver\'s License, other Government issued ID)',
            'Website/Homepage',
            // Add more as needed
        ];

        foreach ($categories as $category) {
            DocumentCategory::create(['name' => $category]);
        }
    }
}
