@extends('layouts.admin')

@section('title', 'Audit Log')
@section('page_title', 'Audit Log')
@section('breadcrumb')
  <li class="breadcrumb-item active" aria-current="page">Audit Log</li>
@endsection

@section('content')
  <div class="card mb-4">
    <div class="card-header">
      <h3 class="card-title">Activity Log</h3>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead>
            <tr>
              <th>User</th>
              <th>Action</th>
              <th>Description</th>
              <th>IP Address</th>
              <th>Date &amp; Time</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($logs as $log)
              <tr>
                <td>{{ $log->user?->name ?? 'System' }}</td>
                <td><span class="badge text-bg-secondary">{{ $log->action }}</span></td>
                <td>{{ $log->description }}</td>
                <td><code>{{ $log->ip_address }}</code></td>
                <td>{{ optional($log->created_at)->format('d M Y H:i') }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center text-secondary py-4">No audit log entries yet.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
    @if ($logs->hasPages())
      <div class="card-footer">
        {{ $logs->links() }}
      </div>
    @endif
  </div>
@endsection
