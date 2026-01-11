<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\Education\Instructor;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function index()
    {
        $instructors = Instructor::latest()->paginate(20);
        return view('education.instructor.index', compact('instructors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'trainer_code' => 'required|string|unique:instructors,trainer_code',
            'trainer_name' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'level' => 'required|in:JUNIOR,MID,SENIOR,EXPERT',
            'daily_rate' => 'required|numeric|min:0',
            'status' => 'required|in:ACTIVE,INACTIVE',
        ]);

        Instructor::create($validated);

        return redirect()->route('education.instructor')->with('success', 'Instruktur berhasil ditambahkan!');
    }

    public function update(Request $request, Instructor $instructor)
    {
        $validated = $request->validate([
            'trainer_code' => 'required|string|unique:instructors,trainer_code,' . $instructor->id,
            'trainer_name' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'level' => 'required|in:JUNIOR,MID,SENIOR,EXPERT',
            'daily_rate' => 'required|numeric|min:0',
            'status' => 'required|in:ACTIVE,INACTIVE',
        ]);

        $instructor->update($validated);

        return redirect()->route('education.instructor')->with('success', 'Instruktur berhasil diperbarui!');
    }

    public function destroy(Instructor $instructor)
    {
        $instructor->delete();

        return redirect()->route('education.instructor')->with('success', 'Instruktur berhasil dihapus!');
    }
}
