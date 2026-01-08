<?php

namespace Database\Seeders;

use App\Models\Master\Instructor;
use Illuminate\Database\Seeder;

class InstructorSeeder extends Seeder
{
    public function run(): void
    {
        $instructors = [
            [
                'name' => 'John Doe',
                'specialization' => 'Web Development',
            ],
            [
                'name' => 'Jane Smith',
                'specialization' => 'Mobile Development',
            ],
            [
                'name' => 'Ahmad Fauzi',
                'specialization' => 'Data Science',
            ],
            [
                'name' => 'Sarah Johnson',
                'specialization' => 'UI/UX Design',
            ],
            [
                'name' => 'Michael Chen',
                'specialization' => 'Cloud Computing',
            ],
        ];

        foreach ($instructors as $instructor) {
            Instructor::create($instructor);
        }
    }
}
