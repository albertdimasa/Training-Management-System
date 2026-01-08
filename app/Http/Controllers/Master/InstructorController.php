<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\InstructorRequest;
use App\Models\Master\Instructor;

class InstructorController extends Controller
{
    public function index()
    {
        $instructors = Instructor::latest()->get();
        return view('master.instructor.index', compact('instructors'));
    }

    public function store(InstructorRequest $request)
    {
        Instructor::create($request->validated());

        return redirect()->route('master.instructor')->with('success', 'Instruktor berhasil ditambahkan!');
    }

    public function update(InstructorRequest $request, Instructor $instructor)
    {
        $instructor->update($request->validated());

        return redirect()->route('master.instructor')->with('success', 'Instruktor berhasil diperbarui!');
    }

    public function destroy(Instructor $instructor)
    {
        $instructor->delete();

        return redirect()->route('master.instructor')->with('success', 'Instruktor berhasil dihapus!');
    }
}
