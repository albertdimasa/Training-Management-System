<?php

namespace Database\Seeders;

use App\Models\Education\Course;
use App\Models\Education\Instructor;
use App\Models\Education\TrainingBatch;
use App\Models\Master\Venue;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class TrainingBatchSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $executionTypes = ['PUBLIC', 'INHOUSE', 'ONLINE'];
        $statuses = ['PLANNED', 'OPEN', 'ONGOING', 'COMPLETED'];

        $courseIds = Course::pluck('id')->toArray();
        $instructorIds = Instructor::pluck('id')->toArray();
        $venueIds = Venue::pluck('id')->toArray();

        for ($i = 1; $i <= 120; $i++) {
            $startDate = Carbon::create(2024, 1, 1)->addDays(rand(0, 900));
            $duration = rand(1, 4);

            TrainingBatch::create([
                'batch_code' => 'BATCH' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'course_id' => $faker->randomElement($courseIds),
                'trainer_id' => $faker->randomElement($instructorIds),
                'venue_id' => $faker->randomElement($venueIds),
                'execution_type' => $faker->randomElement($executionTypes),
                'start_date' => $startDate,
                'end_date' => $startDate->copy()->addDays($duration),
                'quota' => rand(10, 70),
                'status' => $faker->randomElement($statuses),
                'created_at' => now()->subDays(rand(0, 700)),
            ]);
        }
    }
}
