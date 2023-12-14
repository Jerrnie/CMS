<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

            Admin::create([
                'first_name' => 'Super',
                'middle_name' => 'Admin',
                'last_name' => 'zff',
                'email' => 'superadmin@example.com',
                'password' => bcrypt('passwordzff'), // replace 'password' with the actual password
                'role_id' => 1,
            ]);
    }
}
