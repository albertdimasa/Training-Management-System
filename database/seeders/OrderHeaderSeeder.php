<?php

namespace Database\Seeders;

use App\Models\Master\Client;
use App\Models\Operation\OrderHeader;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class OrderHeaderSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $resourceTypes = ['TRANSACTION_BASED', 'ACCRUAL_BASED'];
        $statuses = ['DRAFT', 'CONFIRMED', 'COMPLETED'];
        $notes = ['Inhouse request', 'Public training', 'Corporate program', 'Renewal batch', 'Special package'];

        $clientIds = Client::pluck('id')->toArray();

        for ($i = 1; $i <= 320; $i++) {
            OrderHeader::create([
                'order_no' => 'SO-' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'order_date' => Carbon::create(2024, 1, 1)->addDays(rand(0, 900)),
                'client_id' => $faker->randomElement($clientIds),
                'resource_type' => $faker->randomElement($resourceTypes),
                'status' => $faker->randomElement($statuses),
                'notes' => $faker->randomElement($notes),
                'created_at' => now()->subDays(rand(0, 700)),
            ]);
        }
    }
}
