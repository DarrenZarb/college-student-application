<!-- Sort Form -->
<form method="GET" action="{{ route('students.index') }}">
    <div class="form-group">
        <label for="sort_by">Sort by Name</label>
        <select name="sort_by" id="sort_by" class="form-control" onchange="this.form.submit()">
            <option value="">-- Select Sorting --</option>
            <option value="asc" {{ request('sort_by') == 'asc' ? 'selected' : '' }}>Ascending</option>
            <option value="desc" {{ request('sort_by') == 'desc' ? 'selected' : '' }}>Descending</option>
        </select>
    </div>
</form>
