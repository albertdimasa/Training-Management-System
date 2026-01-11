<?php

namespace Database\Seeders;

use App\Models\Financial\Account;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    public function run(): void
    {
        $accounts = [
            // ASSETS
            ['1100', 'Cash & Bank', 'ASSET', true, null, 'DEBIT'],
            ['1110', 'Cash on Hand', 'ASSET', false, '1100', 'DEBIT'],
            ['1120', 'Bank Account', 'ASSET', false, '1100', 'DEBIT'],
            ['1200', 'Accounts Receivable', 'ASSET', true, null, 'DEBIT'],
            ['1210', 'AR - Training Services', 'ASSET', false, '1200', 'DEBIT'],
            ['1300', 'Prepaid Expenses', 'ASSET', true, null, 'DEBIT'],
            ['1310', 'Prepaid Venue', 'ASSET', false, '1300', 'DEBIT'],

            // LIABILITIES
            ['2100', 'Accounts Payable', 'LIABILITY', true, null, 'CREDIT'],
            ['2110', 'AP - Trainer Fee', 'LIABILITY', false, '2100', 'CREDIT'],
            ['2120', 'AP - Venue', 'LIABILITY', false, '2100', 'CREDIT'],
            ['2200', 'Unearned Revenue', 'LIABILITY', true, null, 'CREDIT'],
            ['2210', 'Unearned - Training', 'LIABILITY', false, '2200', 'CREDIT'],

            // EQUITY
            ['3100', 'Equity', 'EQUITY', true, null, 'CREDIT'],
            ['3110', 'Retained Earnings', 'EQUITY', false, '3100', 'CREDIT'],

            // REVENUE
            ['4100', 'Training Revenue', 'REVENUE', true, null, 'CREDIT'],
            ['4110', 'Revenue - Public Training', 'REVENUE', false, '4100', 'CREDIT'],
            ['4120', 'Revenue - Inhouse Training', 'REVENUE', false, '4100', 'CREDIT'],
            ['4130', 'Revenue - Online Training', 'REVENUE', false, '4100', 'CREDIT'],

            // EXPENSE
            ['5100', 'Training Expenses', 'EXPENSE', true, null, 'DEBIT'],
            ['5110', 'Trainer Fee Expense', 'EXPENSE', false, '5100', 'DEBIT'],
            ['5120', 'Venue Expense', 'EXPENSE', false, '5100', 'DEBIT'],
            ['5130', 'Operational Expense', 'EXPENSE', false, '5100', 'DEBIT'],
        ];

        // First pass: create header accounts
        foreach ($accounts as $account) {
            if ($account[3]) { // is_header
                Account::create([
                    'account_code' => $account[0],
                    'account_name' => $account[1],
                    'account_type' => $account[2],
                    'is_header' => $account[3],
                    'parent_id' => null,
                    'normal_side' => $account[5],
                ]);
            }
        }

        // Second pass: create child accounts
        foreach ($accounts as $account) {
            if (!$account[3]) { // not is_header
                $parent = Account::where('account_code', $account[4])->first();

                Account::create([
                    'account_code' => $account[0],
                    'account_name' => $account[1],
                    'account_type' => $account[2],
                    'is_header' => $account[3],
                    'parent_id' => $parent?->id,
                    'normal_side' => $account[5],
                ]);
            }
        }
    }
}
