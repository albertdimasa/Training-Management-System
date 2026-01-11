<?php

namespace Database\Seeders;

use App\Models\Education\Instructor;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class InstructorSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $firstNames = ['Andi', 'Budi', 'Citra', 'Dewi', 'Eka', 'Fajar', 'Gita', 'Hendra', 'Indra', 'Joko', 'Kiki', 'Lina'];
        $lastNames = ['Saputra', 'Wijaya', 'Pratama', 'Siregar', 'Santoso', 'Putri', 'Utama', 'Nugroho'];
        $specializations = ['SAFETY', 'TECHNICAL', 'MANAGEMENT', 'COMPLIANCE', 'INSPECTION'];
        $levels = ['JUNIOR', 'MID', 'SENIOR', 'EXPERT'];
        $dailyRates = [1500000, 2000000, 2500000, 3500000, 4500000];

        for ($i = 1; $i <= 25; $i++) {
            Instructor::create([
                'trainer_code' => 'TR' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'trainer_name' => $faker->randomElement($firstNames) . ' ' . $faker->randomElement($lastNames),
                'specialization' => $faker->randomElement($specializations),
                'level' => $faker->randomElement($levels),
                'daily_rate' => $faker->randomElement($dailyRates),
                'status' => 'ACTIVE',
                'created_at' => now()->subDays(rand(0, 900)),
            ]);
        }
    }
}
