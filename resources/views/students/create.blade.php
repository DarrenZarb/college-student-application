@extends('layouts.app')

@section('title', isset($student) ? 'Edit Student' : 'Add New Student')

@section('content')
    <h1>{{ isset($student) ? 'Edit Student' : 'Add New Student' }}</h1>

    <form action="{{ isset($student) ? route('students.update', $student->id) : route('students.store') }}" method="POST">
        @csrf
        @isset($student)
            @method('PUT')
        @endisset

        <div class="form-group">
            <label for="name">Student Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $student->name ?? '') }}" required>
        </div>

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

        <button type="submit" class="btn btn-success mt-3">Save</button>
    </form>
@endsection
