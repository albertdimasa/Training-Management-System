<?php

namespace Database\Seeders;

use App\Models\Education\Course;
use App\Models\Education\TrainingBatch;
use App\Models\Operation\OrderHeader;
use App\Models\Operation\OrderLine;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class OrderLineSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $prices = [1500000, 2000000, 2500000, 3000000, 3500000, 4500000, 5500000];

        $orders = OrderHeader::all();
        $courseIds = Course::pluck('id')->toArray();
        $batchIds = TrainingBatch::pluck('id')->toArray();

        foreach ($orders as $order) {
            $lineCount = rand(1, 3);

            for ($i = 1; $i <= $lineCount; $i++) {
                $qty = rand(5, 45);
                $unitPrice = $faker->randomElement($prices);
                $discountAmt = rand(0, 1) ? rand(0, 5000000) : 0;
                $taxRate = 11.00;
                $lineTotal = max(($qty * $unitPrice) - $discountAmt, 0) * (1 + ($taxRate / 100));

                OrderLine::create([
                    'order_id' => $order->id,
                    'batch_id' => rand(0, 100) < 75 ? $faker->randomElement($batchIds) : null,
                    'course_id' => $faker->randomElement($courseIds),
                    'qty_participant' => $qty,
                    'unit_price' => $unitPrice,
                    'discount_amt' => $discountAmt,
                    'tax_rate' => $taxRate,
                    'line_total' => round($lineTotal, 2),
                ]);
            }
        }
    }
}
