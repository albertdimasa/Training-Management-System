<?php

namespace Database\Seeders;

use App\Models\Master\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            [
                'title' => 'Dasar Pemrograman Web',
                'description' => 'Mempelajari dasar-dasar HTML, CSS, dan JavaScript untuk membangun website modern.',
            ],
            [
                'title' => 'Flutter Mobile Development',
                'description' => 'Belajar membuat aplikasi mobile cross-platform menggunakan Flutter dan Dart.',
            ],
            [
                'title' => 'Machine Learning Fundamentals',
                'description' => 'Pengantar machine learning dengan Python, scikit-learn, dan TensorFlow.',
            ],
            [
                'title' => 'Laravel Full Stack Development',
                'description' => 'Membangun aplikasi web full stack dengan Laravel, Vue.js, dan MySQL.',
            ],
            [
                'title' => 'Cloud Computing dengan AWS',
                'description' => 'Menguasai layanan AWS untuk deployment dan manajemen infrastruktur cloud.',
            ],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
