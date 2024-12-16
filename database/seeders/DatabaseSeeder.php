<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PlatformSeeder::class,
            CompanyUserRoleSeeder::class
        ]);

//        if (! app()->environment('testing')) {
//           //
//        }

        if (app()->environment('local')) {
            $companies = Company::factory()->count(5)->create();

            $companies->each(function ($company) {
                $users = User::factory()->count(3)->create([
                    'password' => Hash::make('password'),
                ]);
                $company->users()->attach($users->pluck('id'));
            });
        }
    }
}
