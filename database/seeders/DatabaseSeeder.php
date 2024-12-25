<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\AccomplishmentReport;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create an admin user
        User::factory()->create([
            'name' => 'Admin User',
            'role' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'), // Use Hash::make() for consistency
        ]);

        // Create 9 Accomplishment Reports
        AccomplishmentReport::factory()->count(9)->create();
    }
}
