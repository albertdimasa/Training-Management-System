<?php

namespace Database\Seeders;

use App\Models\Master\Venue;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class VenueSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $prefixes = ['Grand', 'Mega', 'Atria', 'Santika', 'Aston', 'Ibis', 'Prime', 'Sky'];
        $suffixes = ['Hall', 'Room', 'Ballroom', 'Center', 'Hub'];
        $cities = ['Jakarta', 'Bandung', 'Surabaya', 'Semarang', 'Balikpapan', 'Medan', 'Makassar'];
        $venueTypes = ['INHOUSE', 'CLIENT_SITE', 'HOTEL', 'ONLINE'];

        for ($i = 1; $i <= 20; $i++) {
            $venueType = $faker->randomElement($venueTypes);

            // Capacity depends on venue_type
            $capacity = match ($venueType) {
                'ONLINE' => rand(200, 1000),
                'HOTEL' => rand(80, 500),
                'CLIENT_SITE' => rand(30, 250),
                default => rand(20, 150), // INHOUSE
            };

            Venue::create([
                'venue_name' => $faker->randomElement($prefixes) . ' ' .
                    $faker->randomElement($suffixes) . ' ' . $i,
                'city' => $faker->randomElement($cities),
                'capacity' => $capacity,
                'venue_type' => $venueType,
                'created_at' => now()->subDays(rand(0, 800)),
            ]);
        }
    }
}
