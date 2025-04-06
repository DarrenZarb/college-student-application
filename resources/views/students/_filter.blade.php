<!-- resources/views/students/_filter.blade.php -->
<div class="form-group">
    <label for="college_id">Filter by College</label>
    <form action="{{ route('students.index') }}" method="GET">
        <select name="college_id" id="college_id" class="form-control" onchange="this.form.submit()">
            <option value="">All Colleges</option>
            @foreach($colleges as $college)
                <option value="{{ $college->id }}" {{ request('college_id') == $college->id ? 'selected' : '' }}>
                    {{ $college->name }}
                </option>
            @endforeach
        </select>
    </form>
</div>
