<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\College;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Start a query on the students model, including the related college
        $query = Student::with('college');

        // Filter students by college if a college_id is selected
        if ($request->has('college_id') && $request->college_id) {
            $query->where('college_id', $request->college_id);
        }

        // Sort students by name if a sort parameter is passed in the query string
        if ($request->has('sort')) {
            if ($request->sort == 'name_asc') {
                $query->orderBy('name', 'asc');
            } elseif ($request->sort == 'name_desc') {
                $query->orderBy('name', 'desc');
            }
        }

        // Paginate the students with 8 records per page and append query parameters
        $students = $query->paginate(8)->appends($request->all());

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
        return view('students.form', compact('colleges'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:students,email',
            'phone'      => 'required|string|regex:/^\d{8}$/', // Ensure this matches your phone format
            'dob'        => 'required|date',
            'college_id' => 'required|exists:colleges,id', // Ensure the college exists
        ]);

        // Convert date format (from dd/mm/yyyy to yyyy-mm-dd)
        $dob = Carbon::createFromFormat('d/m/Y', $request->dob)->format('Y-m-d');

        // Create new student with formatted dob
        Student::create($request->merge(['dob' => $dob])->all());

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
        return view('students.form', compact('student', 'colleges'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate incoming data
        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:students,email,' . $id, // Exclude current student from the unique check
            'phone'      => 'required|string|regex:/^\d{8}$/',
            'dob'        => 'required|date',
            'college_id' => 'required|exists:colleges,id',
        ]);

        // Convert date format (from dd/mm/yyyy to yyyy-mm-dd)
        $dob = Carbon::createFromFormat('d/m/Y', $request->dob)->format('Y-m-d');

        // Find the student and update their details with formatted dob
        $student = Student::findOrFail($id);
        $student->update($request->merge(['dob' => $dob])->all());

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
