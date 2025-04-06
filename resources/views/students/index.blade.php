@extends('layouts.app')

@section('title', 'Students List')

@section('content')
    <h1>Students</h1>

    <form method="GET" action="{{ route('students.index') }}">
        <div class="form-group">
            <label for="college">Filter by College</label>
            <select name="college_id" id="college" class="form-control" onchange="this.form.submit()">
                <option value="">All Colleges</option>
                @foreach($colleges as $college)
                    <option value="{{ $college->id }}" {{ request('college_id') == $college->id ? 'selected' : '' }}>
                        {{ $college->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    <a href="{{ route('students.create') }}" class="btn btn-primary mt-3">Add New Student</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>College</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->college->name }}</td>
                    <td>
                        <a href="{{ route('students.show', $student->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
