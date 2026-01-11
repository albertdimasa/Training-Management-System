<?php

namespace App\Http\Controllers\Financial;

use App\Http\Controllers\Controller;
use App\Services\Financial\BalanceSheetService;
use App\Exports\Financial\BalanceSheetExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BalanceSheetController extends Controller
{
    public function __construct(
        private BalanceSheetService $balanceSheetService
    ) {}

    /**
     * Display Balance Sheet page with filters and PDF viewer
     */
    public function index(Request $request)
    {
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);
        $type = $request->input('type', 'summary');

        return view('financial.balance-sheet.index', compact('month', 'year', 'type'));
    }

    /**
     * Generate PDF for Balance Sheet
     */
    public function generatePdf(Request $request)
    {
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);
        $type = $request->input('type', 'summary');

        $data = $this->balanceSheetService->getBalanceSheet($month, $year, $type);

        $pdf = Pdf::loadView('financial.balance-sheet.pdf', $data);
        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream("balance-sheet-{$year}-{$month}.pdf");
    }

    /**
     * Export Balance Sheet to Excel
     */
    public function exportExcel(Request $request)
    {
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);
        $type = $request->input('type', 'summary');

        $data = $this->balanceSheetService->getBalanceSheet($month, $year, $type);

        return Excel::download(
            new BalanceSheetExport($data),
            "balance-sheet-{$year}-{$month}.xlsx"
        );
    }
}
