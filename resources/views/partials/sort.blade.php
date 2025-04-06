<!-- resources/views/partials/sort.blade.php -->

<div class="form-group">
    <a href="{{ route('students.index', ['sort' => 'name_asc']) }}" class="btn btn-secondary btn-sm">Sort by Name (Ascending)</a>
    <a href="{{ route('students.index', ['sort' => 'name_desc']) }}" class="btn btn-secondary btn-sm ml-2">Sort by Name (Descending)</a>
</div>
