<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class YearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => '2023']);
        Role::create(['name' => '2024']);
    }
}
