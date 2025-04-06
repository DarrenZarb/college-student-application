<!-- resources/views/partials/student-form.blade.php -->

<form method="POST" action="{{ isset($student) ? route('students.update', $student->id) : route('students.store') }}">
    @csrf
    @isset($student)
        @method('PUT') <!-- This tells Laravel to update the student -->
    @endisset

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $student->name ?? '') }}" required>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $student->email ?? '') }}" required>
    </div>

    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $student->phone ?? '') }}" required>
    </div>

    <div class="form-group">
        <label for="dob">Date of Birth</label>
        <input type="date" name="dob" id="dob" class="form-control" value="{{ old('dob', $student->dob ?? '') }}" required>
    </div>

    <div class="form-group">
        <label for="college_id">College</label>
        <select name="college_id" id="college_id" class="form-control" required>
            <option value="">Select College</option>
            @foreach($colleges as $college)
                <option value="{{ $college->id }}" {{ (old('college_id', $student->college_id ?? '') == $college->id) ? 'selected' : '' }}>
                    {{ $college->name }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary mt-3">
        {{ isset($student) ? 'Update Student' : 'Add Student' }}
    </button>
</form>
