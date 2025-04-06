@extends('layouts.app')

@section('title', isset($student) ? 'Edit Student' : 'Add New Student')

@section('content')
    <h1>{{ isset($student) ? 'Edit Student' : 'Add New Student' }}</h1>

    <!-- Display Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Display Errors -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form -->
    <form action="{{ isset($student) ? route('students.update', $student->id) : route('students.store') }}" method="POST">
        @csrf
        @if(isset($student))
            @method('PUT') <!-- Important for updating an existing record -->
        @endif

        <!-- Student Name -->
        <div class="form-group">
            <label for="name">Student Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $student->name ?? '') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $student->email ?? '') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Phone -->
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $student->phone ?? '') }}" required>
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Date of Birth -->
        <div class="form-group">
            <label for="dob">Date of Birth</label>
            <input type="text" name="dob" id="dob" class="form-control @error('dob') is-invalid @enderror"
                value="{{ old('dob', isset($student) ? \Carbon\Carbon::parse($student->dob)->format('d/m/Y') : '') }}" required>
            @error('dob')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- College Dropdown -->
        <div class="form-group">
            <label for="college_id">College</label>
            <select name="college_id" id="college_id" class="form-control @error('college_id') is-invalid @enderror" required>
                @foreach($colleges as $college)
                    <option value="{{ $college->id }}" {{ old('college_id', $student->college_id ?? '') == $college->id ? 'selected' : '' }}>
                        {{ $college->name }}
                    </option>
                @endforeach
            </select>
            @error('college_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success mt-3">{{ isset($student) ? 'Update' : 'Save' }}</button>
    </form>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Initialize Flatpickr with dd/mm/yyyy format
            flatpickr("#dob", {
                dateFormat: "d/m/Y", // Set the format to dd/mm/yyyy
                defaultDate: "{{ old('dob', isset($student) ? \Carbon\Carbon::parse($student->dob)->format('d/m/Y') : '') }}",
            });
        });
    </script>
@endsection
