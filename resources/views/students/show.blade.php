@extends('layouts.app')

@section('title', 'View Student')

@section('content')
    <h1>Student Details</h1>

    <div class="card p-4">
        <p><strong>Name:</strong> {{ $student->name }}</p>
        <p><strong>Email:</strong> {{ $student->email }}</p>
        <p><strong>Phone:</strong> {{ $student->phone }}</p>
        <p><strong>Date of Birth:</strong> {{ $student->dob }}</p>
        <p><strong>College:</strong> {{ $student->college->name ?? 'N/A' }}</p>
    </div>

    <a href="{{ route('students.index') }}" class="btn btn-secondary mt-3">Back to Students</a>
@endsection
