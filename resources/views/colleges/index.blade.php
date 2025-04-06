@extends('layouts.app')

@section('title', 'Colleges List')

@section('content')
    <h1>Colleges</h1>
    <a href="{{ route('colleges.create') }}" class="btn btn-primary">Add New College</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($colleges as $college)
                <tr>
                    <td>{{ $college->id }}</td>
                    <td>{{ $college->name }}</td>
                    <td>
                        <a href="{{ route('colleges.show', $college->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('colleges.edit', $college->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('colleges.destroy', $college->id) }}" method="POST" style="display:inline;">
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
