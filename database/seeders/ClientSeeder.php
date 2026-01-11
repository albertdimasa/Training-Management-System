<?php

namespace Database\Seeders;

use App\Models\Master\Client;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $prefixes = ['PT', 'CV', 'DINAS', 'UNIV', 'RS', 'YAYASAN'];
        $midNames = ['NUSANTARA', 'PRIMA', 'MEGA', 'SINERGI', 'MAKMUR', 'SEJAHTERA', 'GLOBAL', 'MANDIRI'];
        $suffixes = ['INDO', 'JAYA', 'ABADI', 'GROUP', 'UTAMA', 'TEKNO', 'KARYA'];
        $types = ['CORPORATE', 'GOVERNMENT', 'EDUCATION', 'INDIVIDUAL_RESELLER'];
        $industries = ['MANUFACTURING', 'LOGISTICS', 'MINING', 'OIL_GAS', 'HEALTHCARE', 'EDUCATION', 'CONSTRUCTION'];
        $cities = ['Jakarta', 'Bandung', 'Surabaya', 'Semarang', 'Balikpapan', 'Medan', 'Makassar'];

        for ($i = 1; $i <= 50; $i++) {
            Client::create([
                'client_code' => 'CL' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'client_name' => $faker->randomElement($prefixes) . ' ' .
                    $faker->randomElement($midNames) . ' ' .
                    $faker->randomElement($suffixes),
                'client_type' => $faker->randomElement($types),
                'industry' => $faker->randomElement($industries),
                'city' => $faker->randomElement($cities),
                'status' => 'ACTIVE',
                'created_at' => now()->subDays(rand(0, 900)),
            ]);
        }
    }
}
