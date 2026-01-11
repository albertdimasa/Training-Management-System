<?php

namespace Database\Seeders;

use App\Models\Education\Course;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $titles = [
            'Basic K3',
            'Fire Safety',
            'First Aid',
            'Working at Height',
            'Rigging & Slinging',
            'Forklift Operator',
            'Scaffolding',
            'Confined Space',
            'Electrical Safety',
            'HSE Supervisor',
            'Leadership Bootcamp',
            'Project Management',
            'ISO 45001 Awareness',
            'ISO 9001 Awareness',
            'Inspection Fundamentals',
            'NDT Level 1',
            'Lifting Equipment Inspection',
            'Hydraulic Safety',
            'Defensive Driving',
            'Ergonomics'
        ];
        $categories = ['SAFETY', 'TECHNICAL', 'MANAGEMENT', 'COMPLIANCE'];
        $certificators = ['INTERNAL', 'GOV', 'VENDOR'];
        $prices = [1500000, 2000000, 2500000, 3000000, 3500000, 4500000, 5500000];

        for ($i = 1; $i <= 30; $i++) {
            Course::create([
                'course_code' => 'CRS' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'course_title' => $faker->randomElement($titles) . ' - ' . $i,
                'category' => $faker->randomElement($categories),
                'certificator' => $faker->randomElement($certificators),
                'duration_days' => rand(1, 5),
                'base_price' => $faker->randomElement($prices),
                'status' => 'ACTIVE',
                'created_at' => now()->subDays(rand(0, 1000)),
            ]);
        }
    }
}
