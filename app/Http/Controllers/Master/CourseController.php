<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\CourseRequest;
use App\Models\Master\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->get();
        return view('master.course.index', compact('courses'));
    }

    public function store(CourseRequest $request)
    {
        Course::create($request->validated());

        return redirect()->route('master.course')->with('success', 'Course berhasil ditambahkan!');
    }

    public function update(CourseRequest $request, Course $course)
    {
        $course->update($request->validated());

        return redirect()->route('master.course')->with('success', 'Course berhasil diperbarui!');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('master.course')->with('success', 'Course berhasil dihapus!');
    }
}
