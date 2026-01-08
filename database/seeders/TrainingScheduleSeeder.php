<?php

namespace Database\Seeders;

use App\Models\Master\Course;
use App\Models\Master\Instructor;
use App\Models\Transaction\TrainingSchedule;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TrainingScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ensure we have some courses and instructors
        if (Course::count() == 0) {
            $this->call(CourseSeeder::class);
        }
        if (Instructor::count() == 0) {
            $this->call(InstructorSeeder::class);
        }

        $courses = Course::all();
        $instructors = Instructor::all();

        // Create schedules for the next 7 days
        for ($i = 0; $i < 7; $i++) {
            $date = Carbon::now()->addDays($i);

            // Create 1-3 schedules per day
            $dailySchedules = rand(1, 3);

            for ($j = 0; $j < $dailySchedules; $j++) {
                TrainingSchedule::create([
                    'course_id' => $courses->random()->id,
                    'instructor_id' => $instructors->random()->id,
                    'date' => $date,
                    'capacity' => rand(10, 30),
                ]);
            }
        }
    }
}
