@extends('layouts.app')

@section('title', 'View College')

@section('content')
    <h1>College Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Name: {{ $college->name }}</h5>
            <p class="card-text">Address: {{ $college->address }}</p>

            <!-- Add any other college details here -->

            <a href="{{ route('colleges.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
@endsection
