@extends('layouts.admin')

@section('title', 'Departments')
@section('page_title', 'Departments')
@section('breadcrumb')
  <li class="breadcrumb-item active" aria-current="page">Departments</li>
@endsection

@section('content')
  <div class="card mb-4">
    <div class="card-header">
      <h3 class="card-title">All Departments</h3>
      <div class="card-tools">
        <a href="{{ route('departments.create') }}" class="btn btn-sm btn-primary">
          <i class="bi bi-plus-lg"></i> Add Department
        </a>
      </div>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead>
            <tr>
              <th>Name</th>
              <th>Description</th>
              <th>Reports</th>
              <th>Created</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @forelse ($departments as $department)
              <tr>
                <td>{{ $department->name }}</td>
                <td>{{ $department->description ? \Illuminate\Support\Str::limit($department->description, 60) : '—' }}</td>
                <td><span class="badge text-bg-info">{{ $department->reports_count }}</span></td>
                <td>{{ optional($department->created_at)->format('d M Y') }}</td>
                <td class="text-end">
                  <a href="{{ route('departments.edit', $department) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                  <form action="{{ route('departments.destroy', $department) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Delete this department?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center text-secondary py-4">No departments yet.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
    @if ($departments->hasPages())
      <div class="card-footer">
        {{ $departments->links() }}
      </div>
    @endif
  </div>
@endsection
