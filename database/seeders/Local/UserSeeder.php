<?php

namespace Database\Seeders\Local;

use App\Models\CompanyUserRole;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompanyUserRole::updateOrCreate([
            'name' => 'Owner',
            'description' => 'The owner of the company.',
        ]);

        CompanyUserRole::updateOrCreate([
            'name' => 'Admin',
            'description' => 'An administrator of the company.',
        ]);
    }
}
