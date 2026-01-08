<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $schedules = [];

        if ($user && $user->isInstructor() && $user->instructor) {
            if ($user->instructor->schedules) {
                $schedules = $user->instructor->schedules()->with('course')->orderBy('date', 'asc')->get();
            }
        }

        return view('dashboard.index', compact('schedules'));
    }
}
