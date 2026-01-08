<?php

namespace App\Http\Controllers;

use App\Models\Transaction\TrainingSchedule;
use App\Models\Transaction\Registration;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        $schedules = TrainingSchedule::with(['course', 'instructor'])
            ->whereDate('date', '>=', now())
            ->orderBy('date', 'asc')
            ->get();

        return view('public.schedule.index', compact('schedules'));
    }

    public function create(TrainingSchedule $schedule)
    {
        return view('public.schedule.register', compact('schedule'));
    }

    public function store(Request $request, TrainingSchedule $schedule)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'user_phone' => 'required|string|max:20',
        ]);

        // Check capacity
        $registeredCount = $schedule->registrations()->count();
        if ($registeredCount >= $schedule->capacity) {
            return back()->with('error', 'Class is full.');
        }

        Registration::create([
            'schedule_id' => $schedule->id,
            'user_name' => $request->user_name,
            'user_phone' => $request->user_phone,
        ]);

        return redirect()->route('public.index')->with('success', 'Registration successful!');
    }
}
