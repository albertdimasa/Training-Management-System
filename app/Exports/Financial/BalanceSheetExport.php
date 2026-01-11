<?php

namespace App\Exports\Financial;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class BalanceSheetExport implements FromArray, WithHeadings, WithStyles, WithTitle, ShouldAutoSize
{
    protected array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function title(): string
    {
        return 'Balance Sheet';
    }

    public function headings(): array
    {
        return [
            'Kode Akun',
            'Nama Akun',
            'Saldo',
        ];
    }

    public function array(): array
    {
        $rows = [];

        // Period info
        $rows[] = ['BALANCE SHEET - ' . strtoupper($this->data['type'])];
        $rows[] = ['Periode: ' . $this->data['period']['label']];
        $rows[] = [''];

        // Assets
        $rows[] = ['ASET', '', ''];
        foreach ($this->data['assets']['accounts'] as $group) {
            if ($group['header']) {
                $rows[] = [
                    $group['header']->account_code,
                    $group['header']->account_name,
                    $group['header_total'],
                ];
            }
            if (isset($group['children']) && $this->data['type'] === 'detail') {
                foreach ($group['children'] as $child) {
                    $rows[] = [
                        '  ' . $child->account_code,
                        '  ' . $child->account_name,
                        $child->balance,
                    ];
                }
            }
        }
        $rows[] = ['TOTAL ASET', '', $this->data['assets']['total']];
        $rows[] = [''];

        // Liabilities
        $rows[] = ['LIABILITAS', '', ''];
        foreach ($this->data['liabilities']['accounts'] as $group) {
            if ($group['header']) {
                $rows[] = [
                    $group['header']->account_code,
                    $group['header']->account_name,
                    $group['header_total'],
                ];
            }
            if (isset($group['children']) && $this->data['type'] === 'detail') {
                foreach ($group['children'] as $child) {
                    $rows[] = [
                        '  ' . $child->account_code,
                        '  ' . $child->account_name,
                        $child->balance,
                    ];
                }
            }
        }
        $rows[] = ['TOTAL LIABILITAS', '', $this->data['liabilities']['total']];
        $rows[] = [''];

        // Equity
        $rows[] = ['EKUITAS', '', ''];
        foreach ($this->data['equity']['accounts'] as $group) {
            if ($group['header']) {
                $rows[] = [
                    $group['header']->account_code,
                    $group['header']->account_name,
                    $group['header_total'],
                ];
            }
            if (isset($group['children']) && $this->data['type'] === 'detail') {
                foreach ($group['children'] as $child) {
                    $rows[] = [
                        '  ' . $child->account_code,
                        '  ' . $child->account_name,
                        $child->balance,
                    ];
                }
            }
        }
        $rows[] = ['TOTAL EKUITAS', '', $this->data['equity']['total']];
        $rows[] = [''];

        // Grand total
        $totalLiabilitiesEquity = $this->data['liabilities']['total'] + $this->data['equity']['total'];
        $rows[] = ['TOTAL LIABILITAS + EKUITAS', '', $totalLiabilitiesEquity];

        return $rows;
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 14]],
            2 => ['font' => ['italic' => true]],
        ];
    }
}
