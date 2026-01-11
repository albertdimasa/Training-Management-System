<?php

namespace App\Http\Controllers;

use App\Models\Education\TrainingBatch;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        $batches = TrainingBatch::with(['course', 'instructor', 'venue', 'enrollments'])
            ->whereIn('status', ['OPEN', 'PLANNED'])
            ->whereDate('start_date', '>=', now())
            ->orderBy('start_date', 'asc')
            ->get();

        return view('public.schedule.index', compact('batches'));
    }
}
