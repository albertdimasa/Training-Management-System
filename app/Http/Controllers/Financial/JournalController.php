<?php

namespace App\Http\Controllers\Financial;

use App\Http\Controllers\Controller;
use App\Services\Financial\TrialBalanceService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JournalController extends Controller
{
    public function __construct(
        private TrialBalanceService $trialBalanceService
    ) {}

    public function index(Request $request)
    {
        // Get date filters from request, with default start_date as first day of current month
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date');

        // Get trial balance data from service
        $groupedAccounts = $this->trialBalanceService->getTrialBalance($startDate, $endDate);

        return view('financial.journal.index', compact('groupedAccounts', 'startDate', 'endDate'));
    }
}
