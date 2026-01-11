<?php

namespace Database\Seeders;

use App\Models\Education\Attendance;
use App\Models\Education\Enrollment;
use App\Models\Education\TrainingBatch;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    public function run(): void
    {
        $enrollments = Enrollment::with('batch')->get();

        foreach ($enrollments as $enrollment) {
            if (!$enrollment->batch) continue;

            $batch = $enrollment->batch;
            $startDate = $batch->start_date;
            $endDate = $batch->end_date;

            $days = min($startDate->diffInDays($endDate) + 1, 3);

            for ($day = 0; $day < $days; $day++) {
                Attendance::create([
                    'enrollment_id' => $enrollment->id,
                    'attend_date' => $startDate->copy()->addDays($day),
                    'is_present' => rand(0, 100) < 92,
                    'note' => rand(0, 100) < 8 ? 'Late / Permission' : null,
                ]);
            }
        }
    }
}
