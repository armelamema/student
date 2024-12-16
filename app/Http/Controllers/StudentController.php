<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use App\Models\Course;  // Fixed typo in Course model name

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('students.index', [
            'students' => Student::with('courses')->get()  // Eager loading courses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create', [
            'courses' => Course::all()  // Fixed class name and syntax
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        $student = Student::create($request->validated());
        
        // Attach selected courses to the student
        if ($request->has('courses')) {
            $student->courses()->attach($request->courses);
        }
        
        return redirect()->route('students.index')
            ->with('success', 'Student created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return view('students.show', [
            'student' => $student->load('courses')  // Eager load courses
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view('students.edit', [
            'student' => $student,
            'courses' => Course::all(),
            'selectedCourses' => $student->courses->pluck('id')->toArray()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->validated());
        
        // Sync the courses (removes old associations and adds new ones)
        if ($request->has('courses')) {
            $student->courses()->sync($request->courses);
        } else {
            $student->courses()->detach();  // Remove all course associations if none selected
        }
        
        return redirect()->route('students.index')
            ->with('success', 'Student updated successfully');
    }

    /**
     * Soft delete the specified student
     */
    public function trash($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->route('students.trashed')
            ->with('success', 'Student moved to trash');
    }

    /**
     * Display trashed students
     */
    public function trashed()
    {
        $students = Student::onlyTrashed()->get();
        return view('students.trashed', ['students' => $students]);
    }

    /**
     * Permanently delete the specified student
     */
    public function destroy($id)
    {
        $student = Student::withTrashed()->findOrFail($id);
        $student->courses()->detach();  // Remove all course associations
        $student->forceDelete();
        return redirect()->route('students.index')
            ->with('success', 'Student permanently deleted');
    }

    /**
     * Restore a trashed student
     */
    public function restore($id)
    {
        $student = Student::withTrashed()->findOrFail($id);
        $student->restore();
        return redirect()->route('students.index')
            ->with('success', 'Student restored successfully');
    }
}