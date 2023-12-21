<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            'logo' => 'logos/default_logo.jpg',
            'HomePageBanner' => 'banners/default_banner_homepage.jpg',
            'opportunitiesBanner' => 'banners/default_banner_opportunities.jpg',
            'applicationsBanner' => 'banners/default_banner_homepage.jpg',
            'projectsBanner' => 'banners/default_banner_homepage.jpg',
            'aboutUsBanner' => 'banners/default_banner_aboutus.jpg',
            'year_id' => 1,
            'quarter_id' => 4,
            // Add more columns as needed
        ]);
    }
}
