<?php

namespace Database\Seeders;

use App\Models\Education\Enrollment;
use App\Models\Education\Participant;
use App\Models\Education\TrainingBatch;
use App\Models\Operation\OrderLine;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EnrollmentSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $enrollStatuses = ['REGISTERED', 'CONFIRMED', 'ATTENDED', 'NO_SHOW', 'CANCELLED'];

        $batchIds = TrainingBatch::pluck('id')->toArray();
        $participantIds = Participant::pluck('id')->toArray();
        $orderLineIds = OrderLine::pluck('id')->toArray();

        $created = [];

        for ($i = 1; $i <= 2000; $i++) {
            $batchId = $faker->randomElement($batchIds);
            $participantId = $faker->randomElement($participantIds);

            // Check for unique constraint
            $key = $batchId . '-' . $participantId;
            if (isset($created[$key])) continue;
            $created[$key] = true;

            $enrollStatus = $faker->randomElement($enrollStatuses);
            $score = rand(0, 100) < 55 ? round(60 + (rand(0, 40)), 2) : null;

            Enrollment::create([
                'order_line_id' => rand(0, 100) < 60 ? $faker->randomElement($orderLineIds) : null,
                'batch_id' => $batchId,
                'participant_id' => $participantId,
                'enroll_status' => $enrollStatus,
                'score' => $score,
                'created_at' => now()->subDays(rand(0, 500)),
            ]);
        }
    }
}
