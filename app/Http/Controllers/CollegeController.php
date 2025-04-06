<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\College;

class CollegeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all colleges
        $colleges = College::all();
        return view('colleges.index', compact('colleges'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('colleges.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:colleges,name',  
        ]);

        // Validate the input data
        $validated = $request->validate([
            'name' => 'required|string|unique:colleges,name',  
        'address' => 'required|string',  
        ]);

        // Create a new college
        College::create($validated);

        // Redirect with success message
        return redirect()->route('colleges.index')->with('success', 'College created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Fetch the college by its ID
        $college = College::findOrFail($id);
        return view('colleges.edit', compact('college'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the college by ID
        $college = College::findOrFail($id);

        // Validate the input data (allowing the current name to be unchanged)
        $validated = $request->validate([
            'name' => 'required|string|unique:colleges,name,' . $college->id, // Skip unique check for the current record
            'address' => 'required|string',
        ]);

        // Update the college
        $college->update($validated);

        // Redirect with success message
        return redirect()->route('colleges.index')->with('success', 'College updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Fetch the college and delete it
        $college = College::findOrFail($id);
        $college->delete();

        // Redirect with success message
        return redirect()->route('colleges.index')->with('success', 'College deleted successfully.');
    }
    public function show(string $id)
    {
        // Find the college by ID
        $college = College::findOrFail($id);

        // Return the view and pass the college data
        return view('colleges.show', compact('college'));
    }
}
