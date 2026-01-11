<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\Education\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->paginate(20);
        return view('education.course.index', compact('courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_code' => 'required|string|unique:courses,course_code',
            'course_title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'certificator' => 'required|string|max:100',
            'duration_days' => 'required|integer|min:1|max:10',
            'base_price' => 'required|numeric|min:0',
            'status' => 'required|in:ACTIVE,INACTIVE',
        ]);

        Course::create($validated);

        return redirect()->route('education.course')->with('success', 'Course berhasil ditambahkan!');
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'course_code' => 'required|string|unique:courses,course_code,' . $course->id,
            'course_title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'certificator' => 'required|string|max:100',
            'duration_days' => 'required|integer|min:1|max:10',
            'base_price' => 'required|numeric|min:0',
            'status' => 'required|in:ACTIVE,INACTIVE',
        ]);

        $course->update($validated);

        return redirect()->route('education.course')->with('success', 'Course berhasil diperbarui!');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('education.course')->with('success', 'Course berhasil dihapus!');
    }
}
