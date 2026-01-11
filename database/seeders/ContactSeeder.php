<?php

namespace Database\Seeders;

use App\Models\Master\Client;
use App\Models\Master\Contact;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $roles = ['HRD', 'Procurement', 'Training Admin', 'GA', 'Finance'];

        $clients = Client::all();

        foreach ($clients as $client) {
            $contactCount = rand(1, 3);

            for ($i = 1; $i <= $contactCount; $i++) {
                Contact::create([
                    'client_id' => $client->id,
                    'contact_name' => 'Contact ' . $client->client_code . '-' . $i,
                    'email' => strtolower(str_replace('CL', 'contact', $client->client_code)) . $i . '@mail.com',
                    'phone' => '08' . rand(1000000000, 1999999999),
                    'role_title' => $faker->randomElement($roles),
                    'is_primary' => ($i === 1),
                    'created_at' => now()->subDays(rand(0, 700)),
                ]);
            }
        }
    }
}
