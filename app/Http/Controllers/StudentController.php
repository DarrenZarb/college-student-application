<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\College;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    // Get all students, optionally filter by college if needed
    $students = Student::with('college');

    // Filter students by college if a college_id is selected
    if ($request->has('college_id') && $request->college_id) {
        $students = $students->where('college_id', $request->college_id);
    }

    // Fetch students with their college info
    $students = $students->get();

    // Get all colleges for the filter dropdown
    $colleges = College::all();

    return view('students.index', compact('students', 'colleges'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get all colleges to populate the dropdown in the form
        $colleges = College::all();
        return view('students.create', compact('colleges'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming data
     $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|string|regex:/^\d{10}$/', // Ensure this matches your phone format
            'dob' => 'required|date',
            'college_id' => 'required|exists:colleges,id', // Ensure the college exists
    ]);

        // Create new student
        Student::create($request->all());

        // Redirect with a success message
        return redirect()->route('students.index')->with('success', 'Student created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Show details for a specific student
        $student = Student::findOrFail($id);
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Get the student and colleges for the edit form
        $student = Student::findOrFail($id);
        $colleges = College::all();
        return view('students.edit', compact('student', 'colleges'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $id, // Exclude current student from the unique check
            'phone' => 'required|string|regex:/^\d{10}$/', // Adjust regex if needed
            'dob' => 'required|date',
            'college_id' => 'required|exists:colleges,id',
        ]);

        // Find the student and update their details
        $student = Student::findOrFail($id);
        $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'Student updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find and delete the student
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully');
    }
}
