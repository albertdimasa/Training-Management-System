<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\Education\TrainingBatch;
use App\Models\Education\Course;
use App\Models\Education\Instructor;
use App\Models\Master\Venue;
use Illuminate\Http\Request;

class TrainingBatchController extends Controller
{
    public function index()
    {
        $batches = TrainingBatch::with(['course', 'instructor', 'venue'])
            ->withCount('enrollments')
            ->latest()
            ->paginate(20);
        $courses = Course::where('status', 'ACTIVE')->get();
        $instructors = Instructor::where('status', 'ACTIVE')->get();
        $venues = Venue::all();
        return view('education.batch.index', compact('batches', 'courses', 'instructors', 'venues'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'batch_code' => 'required|string|unique:training_batches,batch_code',
            'course_id' => 'required|exists:courses,id',
            'trainer_id' => 'nullable|exists:instructors,id',
            'venue_id' => 'nullable|exists:venues,id',
            'execution_type' => 'required|in:PUBLIC,INHOUSE,ONLINE',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'quota' => 'required|integer|min:5|max:100',
            'status' => 'required|in:PLANNED,OPEN,ONGOING,COMPLETED,CANCELLED',
        ]);

        TrainingBatch::create($validated);

        return redirect()->route('education.batch')->with('success', 'Batch berhasil ditambahkan!');
    }

    public function update(Request $request, TrainingBatch $batch)
    {
        $validated = $request->validate([
            'batch_code' => 'required|string|unique:training_batches,batch_code,' . $batch->id,
            'course_id' => 'required|exists:courses,id',
            'trainer_id' => 'nullable|exists:instructors,id',
            'venue_id' => 'nullable|exists:venues,id',
            'execution_type' => 'required|in:PUBLIC,INHOUSE,ONLINE',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'quota' => 'required|integer|min:5|max:100',
            'status' => 'required|in:PLANNED,OPEN,ONGOING,COMPLETED,CANCELLED',
        ]);

        $batch->update($validated);

        return redirect()->route('education.batch')->with('success', 'Batch berhasil diperbarui!');
    }

    public function destroy(TrainingBatch $batch)
    {
        $batch->delete();

        return redirect()->route('education.batch')->with('success', 'Batch berhasil dihapus!');
    }
}
