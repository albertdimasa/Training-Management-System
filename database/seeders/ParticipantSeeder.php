<?php

namespace Database\Seeders;

use App\Models\Education\Participant;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class ParticipantSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $firstNames = ['Rizky', 'Ayu', 'Dimas', 'Nadia', 'Rafi', 'Sarah', 'Ilham', 'Tiara', 'Bagas', 'Wulan', 'Yoga', 'Sinta', 'Ardi', 'Maya'];
        $lastNames = ['Putra', 'Putri', 'Saputra', 'Wijaya', 'Pratama', 'Santoso', 'Hidayat', 'Siregar'];
        $genders = ['M', 'F'];
        $cities = ['Jakarta', 'Bandung', 'Surabaya', 'Semarang', 'Balikpapan', 'Medan', 'Makassar'];

        for ($i = 1; $i <= 600; $i++) {
            Participant::create([
                'participant_code' => 'P' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'full_name' => $faker->randomElement($firstNames) . ' ' . $faker->randomElement($lastNames),
                'gender' => $faker->randomElement($genders),
                'dob' => Carbon::create(1980, 1, 1)->addDays(rand(0, 9000)),
                'city' => $faker->randomElement($cities),
                'phone' => '08' . rand(1000000000, 1999999999),
                'email' => 'p' . $i . '@mail.com',
                'created_at' => now()->subDays(rand(0, 900)),
            ]);
        }
    }
}
