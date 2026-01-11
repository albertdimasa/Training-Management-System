<?php

namespace Database\Seeders;

use App\Models\Financial\Account;
use App\Models\Financial\JournalHeader;
use App\Models\Financial\JournalLine;
use App\Models\Operation\Invoice;
use App\Models\Operation\Payment;
use App\Models\Education\TrainingBatch;
use App\Models\Operation\OrderLine;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class JournalSeeder extends Seeder
{
    public function run(): void
    {
        // Get account IDs
        $accountAR = Account::where('account_code', '1210')->first();
        $accountCash = Account::where('account_code', '1110')->first();
        $accountBank = Account::where('account_code', '1120')->first();
        $accountRevPublic = Account::where('account_code', '4110')->first();
        $accountRevInhouse = Account::where('account_code', '4120')->first();
        $accountRevOnline = Account::where('account_code', '4130')->first();
        $accountTrainerFee = Account::where('account_code', '5110')->first();
        $accountVenueExp = Account::where('account_code', '5120')->first();
        $accountOpsExp = Account::where('account_code', '5130')->first();
        $accountAPTrainer = Account::where('account_code', '2110')->first();
        $accountAPVenue = Account::where('account_code', '2120')->first();

        // 1. Journal from invoices (Dr AR / Cr Revenue)
        $invoices = Invoice::with(['order.lines.batch'])->get();

        foreach ($invoices as $invoice) {
            $journal = JournalHeader::create([
                'journal_no' => 'JRN-INV-' . $invoice->id,
                'journal_date' => $invoice->invoice_date,
                'source_table' => 'trx_invoice',
                'source_id' => $invoice->id,
                'memo' => 'Invoice issued ' . $invoice->invoice_no,
            ]);

            // Debit AR
            JournalLine::create([
                'journal_id' => $journal->id,
                'account_id' => $accountAR->id,
                'debit' => $invoice->grand_total,
                'credit' => 0,
                'cost_center' => 'FIN',
            ]);

            // Credit Revenue - determine type from batch
            $batch = optional($invoice->order->lines->first())->batch;
            $executionType = $batch?->execution_type ?? 'PUBLIC';

            $revenueAccount = match ($executionType) {
                'INHOUSE' => $accountRevInhouse,
                'ONLINE' => $accountRevOnline,
                default => $accountRevPublic,
            };

            JournalLine::create([
                'journal_id' => $journal->id,
                'account_id' => $revenueAccount->id,
                'debit' => 0,
                'credit' => $invoice->grand_total,
                'cost_center' => 'REV',
            ]);
        }

        // 2. Journal from payments (Dr Cash/Bank, Cr AR)
        $payments = Payment::all();

        foreach ($payments as $payment) {
            $journal = JournalHeader::create([
                'journal_no' => 'JRN-PAY-' . $payment->id,
                'journal_date' => $payment->payment_date,
                'source_table' => 'trx_payment',
                'source_id' => $payment->id,
                'memo' => 'Payment received ' . $payment->payment_no,
            ]);

            // Debit Cash or Bank
            $cashAccount = $payment->method === 'CASH' ? $accountCash : $accountBank;

            JournalLine::create([
                'journal_id' => $journal->id,
                'account_id' => $cashAccount->id,
                'debit' => $payment->amount,
                'credit' => 0,
                'cost_center' => 'FIN',
            ]);

            // Credit AR
            JournalLine::create([
                'journal_id' => $journal->id,
                'account_id' => $accountAR->id,
                'debit' => 0,
                'credit' => $payment->amount,
                'cost_center' => 'FIN',
            ]);
        }

        // 3. Monthly expense simulation
        $expenseAccounts = [$accountTrainerFee, $accountVenueExp, $accountOpsExp];
        $apAccounts = [$accountAPTrainer, $accountAPVenue];

        for ($m = 0; $m <= 30; $m++) {
            $date = Carbon::create(2024, 1, 1)->addMonths($m);

            for ($g = 1; $g <= 5; $g++) {
                $expenseAccount = $expenseAccounts[array_rand($expenseAccounts)];
                $apAccount = $apAccounts[array_rand($apAccounts)];
                $amount = rand(5000000, 50000000);

                $journal = JournalHeader::create([
                    'journal_no' => 'JRN-EXP-' . $date->format('Ym') . '-' . $g,
                    'journal_date' => $date,
                    'source_table' => 'manual_expense',
                    'source_id' => $g,
                    'memo' => 'Monthly expense simulation',
                ]);

                // Debit Expense
                JournalLine::create([
                    'journal_id' => $journal->id,
                    'account_id' => $expenseAccount->id,
                    'debit' => $amount,
                    'credit' => 0,
                    'cost_center' => 'OPS',
                ]);

                // Credit AP
                JournalLine::create([
                    'journal_id' => $journal->id,
                    'account_id' => $apAccount->id,
                    'debit' => 0,
                    'credit' => $amount,
                    'cost_center' => 'OPS',
                ]);
            }
        }
    }
}
