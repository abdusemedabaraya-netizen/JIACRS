@extends('layouts.admin')

@section('title', 'Reports')
@section('page_title', 'Reports')
@section('breadcrumb')
  <li class="breadcrumb-item active" aria-current="page">Reports</li>
@endsection

@php
  $statusBadge = [
    'submitted' => 'secondary', 'under_review' => 'info', 'assigned' => 'primary',
    'investigating' => 'warning', 'resolved' => 'success', 'closed' => 'dark', 'rejected' => 'danger',
  ];
  $priorityBadge = ['low' => 'success', 'medium' => 'info', 'high' => 'warning', 'critical' => 'danger'];
@endphp

@section('content')
  <div class="card mb-4">
    <div class="card-header">
      <h3 class="card-title">All Reports</h3>
      <div class="card-tools">
        <form action="{{ route('reports.index') }}" method="GET" class="d-flex gap-2">
          <input type="search" name="search" value="{{ request('search') }}" class="form-control form-control-sm"
                 placeholder="Search tracking no. or subject" aria-label="Search reports">
          <button type="submit" class="btn btn-sm btn-outline-primary">
            <i class="bi bi-search"></i>
          </button>
        </form>
      </div>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead>
            <tr>
              <th>Tracking No.</th>
              <th>Subject</th>
              <th>Department</th>
              <th>Priority</th>
              <th>Status</th>
              <th>Submitted</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @forelse ($reports as $report)
              <tr>
                <td><code>{{ $report->tracking_number }}</code></td>
                <td>{{ \Illuminate\Support\Str::limit($report->subject, 45) }}</td>
                <td>{{ $report->department?->name ?? '—' }}</td>
                <td>
                  <span class="badge text-bg-{{ $priorityBadge[$report->priority] ?? 'secondary' }}">
                    {{ ucfirst($report->priority) }}
                  </span>
                </td>
                <td>
                  <span class="badge text-bg-{{ $statusBadge[$report->status] ?? 'secondary' }}">
                    {{ ucwords(str_replace('_', ' ', $report->status)) }}
                  </span>
                </td>
                <td>{{ optional($report->created_at)->format('d M Y') }}</td>
                <td class="text-end">
                  <a href="{{ route('reports.show', $report) }}" class="btn btn-sm btn-outline-primary">Open</a>
                  @if (auth()->user()?->hasAnyRole(['Admin', 'Super Admin']))
                    <form action="{{ route('reports.destroy', $report) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Delete this report?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                  @endif
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="text-center text-secondary py-4">No reports found.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
    @if ($reports->hasPages())
      <div class="card-footer">
        {{ $reports->appends(request()->query())->links() }}
      </div>
    @endif
  </div>
@endsection