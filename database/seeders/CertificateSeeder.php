<?php

namespace Database\Seeders;

use App\Models\Education\Certificate;
use App\Models\Education\Enrollment;
use Illuminate\Database\Seeder;

class CertificateSeeder extends Seeder
{
    public function run(): void
    {
        // Certificates for ATTENDED enrollments with score >= 75
        $enrollments = Enrollment::with('batch')
            ->where('enroll_status', 'ATTENDED')
            ->whereNotNull('score')
            ->where('score', '>=', 75)
            ->get();

        foreach ($enrollments as $enrollment) {
            if (!$enrollment->batch) continue;

            $endDate = $enrollment->batch->end_date;

            Certificate::create([
                'enrollment_id' => $enrollment->id,
                'certificate_no' => 'CERT-' . str_pad($enrollment->id, 6, '0', STR_PAD_LEFT),
                'issued_date' => $endDate->copy()->addDay(),
                'expiry_date' => $endDate->copy()->addDay()->addYears(rand(1, 3)),
                'status' => 'ISSUED',
            ]);
        }
    }
}
