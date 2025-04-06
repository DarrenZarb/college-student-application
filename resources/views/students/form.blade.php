@extends('layouts.app')

@section('title', 'Add New Student')

@section('content')
    <h1>{{ isset($student) ? 'Edit Student' : 'Add New Student' }}</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($student) ? route('students.update', $student->id) : route('students.store') }}" method="POST">
        @csrf
        @if(isset($student))
            @method('PUT') <!-- This is important for updating an existing record -->
        @endif

        <!-- Student Name -->
        <div class="form-group">
            <label for="name">Student Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $student->name ?? '') }}" required>
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $student->email ?? '') }}" required>
        </div>

        <!-- Phone -->
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $student->phone ?? '') }}" required>
        </div>

        <!-- Date of Birth -->
        <div class="form-group">
            <label for="dob">Date of Birth</label>
            <input type="date" name="dob" id="dob" class="form-control" value="{{ old('dob', $student->dob ?? '') }}" required>
        </div>

        <!-- College Dropdown -->
        <div class="form-group">
            <label for="college_id">College</label>
            <select name="college_id" id="college_id" class="form-control" required>
                @foreach($colleges as $college)
                    <option value="{{ $college->id }}" {{ old('college_id', $student->college_id ?? '') == $college->id ? 'selected' : '' }}>
                        {{ $college->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">{{ isset($student) ? 'Update' : 'Save' }}</button>
    </form>
@endsection
