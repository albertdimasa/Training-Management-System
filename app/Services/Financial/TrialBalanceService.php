<?php

namespace App\Services\Financial;

use App\Enums\Financial\AccountType;
use App\Models\Financial\Account;
use App\Models\Financial\JournalLine;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TrialBalanceService
{
    /**
     * Get trial balance with optional date filtering
     * Default start_date is first day of current month
     */
    public function getTrialBalance(?string $startDate = null, ?string $endDate = null): array
    {
        // Default start_date to first day of current month if not provided
        $startDate = $startDate ?: Carbon::now()->startOfMonth()->format('Y-m-d');

        $accountBalances = $this->getAccountBalances($startDate, $endDate);
        $accounts = $this->getAllAccountsWithBalances($accountBalances);

        return $this->groupAccountsByType($accounts);
    }

    /**
     * Get account balances with optional date filtering
     */
    public function getAccountBalances(?string $startDate, ?string $endDate): Collection
    {
        $query = JournalLine::select(
            'journal_lines.account_id',
            DB::raw('SUM(journal_lines.debit) as total_debit'),
            DB::raw('SUM(journal_lines.credit) as total_credit')
        )
            ->join('journal_headers', 'journal_lines.journal_id', '=', 'journal_headers.id');

        // Apply date filters
        if ($startDate) {
            $query->where('journal_headers.journal_date', '>=', $startDate);
        }

        if ($endDate) {
            $query->where('journal_headers.journal_date', '<=', $endDate);
        }

        return $query->groupBy('journal_lines.account_id')
            ->get()
            ->keyBy('account_id');
    }

    /**
     * Get all accounts and calculate their balances
     */
    public function getAllAccountsWithBalances(Collection $accountBalances): Collection
    {
        $accounts = Account::with('parent')
            ->orderBy('account_code')
            ->get();

        return $accounts->map(function ($account) use ($accountBalances) {
            $balance = $accountBalances->get($account->id);
            $totalDebit = $balance ? floatval($balance->total_debit) : 0;
            $totalCredit = $balance ? floatval($balance->total_credit) : 0;

            // Calculate balance based on normal side
            if ($account->normal_side?->value === 'DEBIT') {
                $account->balance = $totalDebit - $totalCredit;
            } else {
                $account->balance = $totalCredit - $totalDebit;
            }

            return $account;
        });
    }

    /**
     * Group accounts by account type with hierarchical structure
     */
    public function groupAccountsByType(Collection $accounts): array
    {
        $groupedAccounts = [];

        foreach (AccountType::cases() as $type) {
            $typeAccounts = $accounts->where('account_type', $type);

            // Separate headers and details
            $headers = $typeAccounts->where('is_header', true);
            $details = $typeAccounts->where('is_header', false);

            $structured = [];
            $typeTotal = 0;

            foreach ($headers as $header) {
                // Get children of this header
                $children = $details->where('parent_id', $header->id);

                // Calculate header total from children balances
                $headerTotal = $children->sum('balance');

                // If header has its own transactions, add it
                if ($header->balance != 0) {
                    $headerTotal += $header->balance;
                }

                $structured[] = [
                    'header' => $header,
                    'header_total' => $headerTotal,
                    'children' => $children,
                ];

                $typeTotal += $headerTotal;
            }

            // Add orphan accounts (no parent, not header)
            $orphans = $details->whereNull('parent_id');
            if ($orphans->isNotEmpty()) {
                $orphanTotal = $orphans->sum('balance');
                $structured[] = [
                    'header' => null,
                    'header_total' => $orphanTotal,
                    'children' => $orphans,
                ];
                $typeTotal += $orphanTotal;
            }

            $groupedAccounts[$type->value] = [
                'label' => $this->getTypeLabel($type),
                'accounts' => $structured,
                'total' => $typeTotal,
            ];
        }

        return $groupedAccounts;
    }

    /**
     * Get label for account type
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
