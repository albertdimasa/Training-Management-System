<?php

namespace Database\Seeders;

use App\Models\Operation\Invoice;
use App\Models\Operation\Payment;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $methods = ['TRANSFER', 'CASH', 'VA', 'GIRO', 'CARD'];

        $invoices = Invoice::all();

        foreach ($invoices as $invoice) {
            $paymentCount = rand(0, 3);

            if ($paymentCount == 0) continue;

            $totalPaid = 0;

            for ($i = 1; $i <= $paymentCount; $i++) {
                // Payment chunk up to 70% of invoice
                $amount = round($invoice->grand_total * (0.15 + (rand(0, 55) / 100)), 2);

                // Don't overpay
                if ($totalPaid + $amount > $invoice->grand_total) {
                    $amount = max($invoice->grand_total - $totalPaid, 0);
                }

                if ($amount <= 0) break;

                Payment::create([
                    'payment_no' => 'PAY-' . str_pad($invoice->id, 5, '0', STR_PAD_LEFT) . '-' . $i,
                    'invoice_id' => $invoice->id,
                    'payment_date' => $invoice->invoice_date->addDays(rand(1, 40)),
                    'method' => $faker->randomElement($methods),
                    'amount' => $amount,
                    'reference_no' => 'REF' . rand(100000, 999999),
                    'created_at' => now()->subDays(rand(0, 600)),
                ]);

                $totalPaid += $amount;
            }

            // Update invoice status based on payments
            if ($totalPaid <= 0) {
                $invoice->status = 'UNPAID';
            } elseif ($totalPaid + 0.01 < $invoice->grand_total) {
                $invoice->status = 'PARTIAL';
            } else {
                $invoice->status = 'PAID';
            }
            $invoice->save();
        }
    }
}
