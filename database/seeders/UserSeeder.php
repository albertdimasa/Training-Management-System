<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Master\Instructor;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin
        User::updateOrCreate(
            ['email' => 'admin@tms.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'role' => UserRole::ADMIN,
            ]
        );

        // Create Instructor User
        // Expecting InstructorSeeder to have run first
        $instructor = Instructor::first();

        if ($instructor) {
            $userHandler = User::updateOrCreate(
                ['email' => 'instructor@tms.com'],
                [
                    'name' => $instructor->name,
                    'password' => Hash::make('password'),
                    'role' => UserRole::INSTRUCTOR,
                ]
            );

            // Link instructor to user
            $instructor->user_id = $userHandler->id;
            $instructor->save();
        }
    }
}
