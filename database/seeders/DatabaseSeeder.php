<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // User (keep existing)
            UserSeeder::class,

            // Master Module
            ClientSeeder::class,
            ContactSeeder::class,
            VenueSeeder::class,

            // Education Module
            InstructorSeeder::class,
            CourseSeeder::class,
            TrainingBatchSeeder::class,
            ParticipantSeeder::class,

            // Operation Module
            OrderHeaderSeeder::class,
            OrderLineSeeder::class,
            InvoiceSeeder::class,
            PaymentSeeder::class,

            // Education Module (depends on Operation)
            EnrollmentSeeder::class,
            AttendanceSeeder::class,
            CertificateSeeder::class,

            // Financial Module
            AccountSeeder::class,
            JournalSeeder::class,
        ]);
    }
}
