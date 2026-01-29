<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Creates the test user with hashed password if it doesn't exist.
     */
    public function run(): void
    {
        // Only create test user if it doesn't already exist
        if (! User::where('username', 'nguyentuanminh')->exists()) {
            // Create the test user with specified credentials
            // Password is hashed using bcrypt via Hash::make()
            User::create([
                'username' => 'nguyentuanminh',
                'password' => Hash::make('15102004'),  // Securely hashed password
                'stuId' => '400387',
                'class' => '67PM2',
                'gender' => 'male',
                'email' => null,  // Email is optional in our system
            ]);
        }
    }
}
