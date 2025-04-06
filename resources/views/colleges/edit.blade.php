@extends('layouts.app')

@section('title', 'Edit College')

@section('content')
    <h1>Edit College</h1>

    <form action="{{ route('colleges.update', $college->id) }}" method="POST">
        @csrf
        @method('PUT')  <!-- This tells Laravel it's an update request -->

        <!-- College Name -->
        <div class="form-group">
            <label for="name">College Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $college->name) }}" required>
        </div>

        <!-- College Address -->
        <div class="form-group">
            <label for="address">College Address</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $college->address) }}" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Save Changes</button>
    </form>
@endsection
