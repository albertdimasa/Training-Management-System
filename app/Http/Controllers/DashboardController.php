<?php

namespace App\Http\Controllers;

use App\Models\Education\Course;
use App\Models\Education\Instructor;
use App\Models\Education\Participant;
use App\Models\Education\TrainingBatch;
use App\Models\Master\Client;
use App\Models\Operation\Invoice;
use App\Models\Operation\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // ============================================================
        // KPI / SUMMARY CARDS
        // ============================================================
        $totalInstructors = Instructor::where('status', 'ACTIVE')->count();
        $totalCourses = Course::where('status', 'ACTIVE')->count();
        $totalParticipants = Participant::count();
        $totalClients = Client::where('status', 'ACTIVE')->count();
        $totalBatches = TrainingBatch::count();
        $trainingThisMonth = TrainingBatch::whereMonth('start_date', now()->month)
            ->whereYear('start_date', now()->year)
            ->count();

        // Revenue summary
        $totalRevenue = Invoice::where('status', 'PAID')->sum('grand_total');
        $pendingRevenue = Invoice::whereIn('status', ['UNPAID', 'PARTIAL'])->sum('grand_total');

        // Invoice Outstanding (unpaid/partial count)
        $invoiceOutstanding = Invoice::whereIn('status', ['UNPAID', 'PARTIAL'])->count();

        // ============================================================
        // RECENT DATA
        // ============================================================
        $recentBatches = TrainingBatch::with(['course', 'instructor'])
            ->withCount('enrollments')
            ->orderBy('start_date', 'desc')
            ->take(5)
            ->get();

        // ============================================================
        // RANKINGS / VISUALIZATIONS
        // ============================================================

        // Top 5 Instructors by Batch Count
        $topInstructors = Instructor::withCount('batches')
            ->orderBy('batches_count', 'desc')
            ->take(5)
            ->get();

        // Top 5 Clients by Revenue (from paid invoices)
        $topClientsByRevenue = Client::select('clients.*')
            ->selectRaw('COALESCE(SUM(invoices.grand_total), 0) as total_revenue')
            ->leftJoin('order_headers', 'clients.id', '=', 'order_headers.client_id')
            ->leftJoin('invoices', function ($join) {
                $join->on('order_headers.id', '=', 'invoices.order_id')
                    ->where('invoices.status', '=', 'PAID');
            })
            ->groupBy('clients.id')
            ->orderByDesc('total_revenue')
            ->take(5)
            ->get();

        // Top 5 Courses by Enrollment
        $topCoursesByEnrollment = Course::select('courses.*')
            ->selectRaw('COUNT(enrollments.id) as enrollment_count')
            ->leftJoin('training_batches', 'courses.id', '=', 'training_batches.course_id')
            ->leftJoin('enrollments', 'training_batches.id', '=', 'enrollments.batch_id')
            ->groupBy('courses.id')
            ->orderByDesc('enrollment_count')
            ->take(5)
            ->get();

        // Revenue by Course Category (for pie chart)
        $revenueByCategory = Course::select('courses.category')
            ->selectRaw('COALESCE(SUM(invoices.grand_total), 0) as total_revenue')
            ->leftJoin('order_lines', 'courses.id', '=', 'order_lines.course_id')
            ->leftJoin('order_headers', 'order_lines.order_id', '=', 'order_headers.id')
            ->leftJoin('invoices', function ($join) {
                $join->on('order_headers.id', '=', 'invoices.order_id')
                    ->where('invoices.status', '=', 'PAID');
            })
            ->whereNotNull('courses.category')
            ->groupBy('courses.category')
            ->orderByDesc('total_revenue')
            ->get();

        // Monthly Revenue Trend (last 6 months)
        $monthlyRevenue = Payment::selectRaw("DATE_PART('month', payment_date) as month, DATE_PART('year', payment_date) as year, SUM(amount) as total")
            ->where('payment_date', '>=', now()->subMonths(6)->startOfMonth())
            ->groupBy(DB::raw("DATE_PART('year', payment_date), DATE_PART('month', payment_date)"))
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->map(function ($item) {
                $monthNames = ['', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
                return [
                    'label' => $monthNames[$item->month] . ' ' . $item->year,
                    'value' => (float) $item->total
                ];
            });

        return view('dashboard.index', compact(
            'totalInstructors',
            'totalCourses',
            'totalParticipants',
            'totalClients',
            'totalBatches',
            'trainingThisMonth',
            'recentBatches',
            'topInstructors',
            'totalRevenue',
            'pendingRevenue',
            'invoiceOutstanding',
            'topClientsByRevenue',
            'topCoursesByEnrollment',
            'revenueByCategory',
            'monthlyRevenue'
        ));
    }
}
