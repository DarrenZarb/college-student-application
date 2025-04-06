@extends('layouts.app')

@section('title', isset($college) ? 'Edit College' : 'Add New College')

@section('content')
    <h1>{{ isset($college) ? 'Edit College' : 'Add New College' }}</h1>

    <form action="{{ isset($college) ? route('colleges.update', $college->id) : route('colleges.store') }}" method="POST">
        @csrf
        @isset($college)
            @method('PUT')
        @endisset

        <div class="form-group">
            <label for="name">College Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $college->name ?? '') }}" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Save</button>
    </form>
@endsection
