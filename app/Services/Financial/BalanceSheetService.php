<?php

namespace App\Services\Financial;

use App\Enums\Financial\AccountType;
use App\Models\Financial\Account;
use App\Models\Financial\JournalLine;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class BalanceSheetService
{
    /**
     * Get balance sheet data for a specific period
     */
    public function getBalanceSheet(int $month, int $year, string $type = 'summary'): array
    {
        // End date is the last day of the selected month
        $endDate = Carbon::create($year, $month)->endOfMonth()->format('Y-m-d');

        return [
            'period' => [
                'month' => $month,
                'year' => $year,
                'label' => Carbon::create($year, $month)->translatedFormat('F Y'),
                'end_date' => $endDate,
            ],
            'type' => $type,
            'assets' => $this->getAccountsByType(AccountType::ASSET, $endDate, $type),
            'liabilities' => $this->getAccountsByType(AccountType::LIABILITY, $endDate, $type),
            'equity' => $this->getAccountsByType(AccountType::EQUITY, $endDate, $type),
        ];
    }

    /**
     * Get accounts by type with balances up to end date
     */
    private function getAccountsByType(AccountType $accountType, string $endDate, string $type): array
    {
        // Get account balances up to end date
        $accountBalances = JournalLine::select(
            'journal_lines.account_id',
            DB::raw('SUM(journal_lines.debit) as total_debit'),
            DB::raw('SUM(journal_lines.credit) as total_credit')
        )
            ->join('journal_headers', 'journal_lines.journal_id', '=', 'journal_headers.id')
            ->where('journal_headers.journal_date', '<=', $endDate)
            ->groupBy('journal_lines.account_id')
            ->get()
            ->keyBy('account_id');

        // Get all accounts of this type
        $accounts = Account::with('parent')
            ->where('account_type', $accountType)
            ->orderBy('account_code')
            ->get();

        // Calculate balance for each account
        $accounts = $accounts->map(function ($account) use ($accountBalances) {
            $balance = $accountBalances->get($account->id);
            $totalDebit = $balance ? floatval($balance->total_debit) : 0;
            $totalCredit = $balance ? floatval($balance->total_credit) : 0;

            if ($account->normal_side?->value === 'DEBIT') {
                $account->balance = $totalDebit - $totalCredit;
            } else {
                $account->balance = $totalCredit - $totalDebit;
            }

            return $account;
        });

        // Group by headers
        $headers = $accounts->where('is_header', true);
        $details = $accounts->where('is_header', false);

        $structured = [];
        $total = 0;

        foreach ($headers as $header) {
            $children = $details->where('parent_id', $header->id);
            $headerTotal = $children->sum('balance');

            if ($header->balance != 0) {
                $headerTotal += $header->balance;
            }

            $item = [
                'header' => $header,
                'header_total' => $headerTotal,
            ];

            // Only include children for detail type
            if ($type === 'detail') {
                $item['children'] = $children;
            }

            $structured[] = $item;
            $total += $headerTotal;
        }

        // Add orphan accounts
        $orphans = $details->whereNull('parent_id');
        if ($orphans->isNotEmpty()) {
            $orphanTotal = $orphans->sum('balance');
            $item = [
                'header' => null,
                'header_total' => $orphanTotal,
            ];
            if ($type === 'detail') {
                $item['children'] = $orphans;
            }
            $structured[] = $item;
            $total += $orphanTotal;
        }

        return [
            'accounts' => $structured,
            'total' => $total,
        ];
    }

    /**
     * Get type label in Indonesian
     */
    public function getTypeLabel(AccountType $type): string
    {
        return match ($type) {
            AccountType::ASSET => 'ASET',
            AccountType::LIABILITY => 'LIABILITAS',
            AccountType::EQUITY => 'EKUITAS',
            AccountType::REVENUE => 'PENDAPATAN',
            AccountType::EXPENSE => 'BEBAN',
        };
    }
}
