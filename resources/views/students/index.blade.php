@extends('layouts.app')

@section('content')
<div class="card">
  <!-- Card Header -->
  <div class="card-header bg-primary text-white">
    <h4 class="mb-0">Student Management</h4>
  </div>
  
  <!-- Card Body -->
  <div class="card-body">
    <!-- Toolbar Section -->
    <div class="row mb-3">
      <!-- Sort & Filter Section -->
      <div class="col-md-8 d-flex align-items-center">
        <div class="btn-group me-3" role="group" aria-label="Sort Options">
          <button type="button" class="btn btn-outline-secondary sort-btn" data-sort="asc">
            <i class="fa fa-sort-alpha-asc"></i> Ascending
          </button>
          <button type="button" class="btn btn-outline-secondary sort-btn" data-sort="desc">
            <i class="fa fa-sort-alpha-desc"></i> Descending
          </button>
        </div>
        <div class="col-md-4">
          <select class="form-select filter-select">
            <option value="">Filter by College</option>
            <option value="all">All Colleges</option>
            @foreach($colleges as $college)
              <option value="{{ $college->id }}">{{ $college->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <!-- New Student Button -->
      <div class="col-md-4 text-end">
        <a href="{{ route('students.create') }}" class="btn btn-success">
          <i class="fa fa-plus"></i> New Student
        </a>
      </div>
    </div>
    
    <!-- Table Section -->
    <div class="table-responsive">
      <table class="table table-bordered table-hover" id="students-table">
        <thead>
          <tr>
            <th>Name</th>
            <th>College</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($students as $student)
          <tr>
            <td>{{ $student->name }}</td>
            <!-- Use data attribute for filtering -->
            <td data-college-id="{{ $student->college->id }}">{{ $student->college->name }}</td>
            <td>
              <a href="{{ route('students.show', $student->id) }}" class="btn btn-info btn-sm">View</a>
              <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-sm">Edit</a>
              <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Are you sure?');" class="btn btn-danger btn-sm" type="submit">
                  Delete
                </button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  
  <!-- Card Footer: Pagination -->
  <div class="card-footer">
    <div class="d-flex justify-content-center">
      {{ $students->links() }}
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function(){
  // Sort buttons click event
  $('.sort-btn').on('click', function(){
    var sortOrder = $(this).data('sort'); // 'asc' or 'desc'
    var $tbody = $('#students-table tbody');
    var rows = $tbody.find('tr').get();

    // Sort rows based on the student name in the first column
    rows.sort(function(a, b){
      var keyA = $(a).children('td').eq(0).text().trim().toUpperCase();
      var keyB = $(b).children('td').eq(0).text().trim().toUpperCase();
      return sortOrder === 'asc'
             ? (keyA < keyB ? -1 : (keyA > keyB ? 1 : 0))
             : (keyA > keyB ? -1 : (keyA < keyB ? 1 : 0));
    });

    // Re-append the sorted rows to the table body
    $.each(rows, function(index, row) {
      $tbody.append(row);
    });
  });
  
  // Filter dropdown change event
  $('.filter-select').on('change', function(){
    var selectedVal = $(this).val(); // college id, or "", or "all"
    
    $('#students-table tbody tr').each(function(){
      var collegeId = $(this).find('td:eq(1)').data('college-id');
      if(selectedVal === "" || selectedVal === "all" || collegeId == selectedVal) {
        $(this).show();
      } else {
        $(this).hide();
      }
    });
  });
});
</script>
@endsection