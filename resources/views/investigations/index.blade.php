@extends('layouts.admin')

@section('title', 'Investigations')
@section('page_title', 'Investigations')
@section('breadcrumb')
  <li class="breadcrumb-item active" aria-current="page">Investigations</li>
@endsection

@php
  $statusBadge = [
    'assigned' => 'primary', 'investigating' => 'warning', 'under_review' => 'info',
    'resolved' => 'success', 'closed' => 'dark', 'rejected' => 'danger',
  ];
@endphp

@section('content')
  <div class="card mb-4">
    <div class="card-header">
      <h3 class="card-title">All Investigations</h3>
      <div class="card-tools">
        @if (auth()->user()?->hasAnyRole(['Admin', 'Super Admin']))
          <a href="{{ route('investigations.create') }}" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-lg"></i> Assign Investigator
          </a>
        @endif
      </div>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead>
            <tr>
              <th>Tracking No.</th>
              <th>Subject</th>
              <th>Investigator</th>
              <th>Report Status</th>
              <th>Assigned</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @forelse ($investigations as $investigation)
              <tr>
                <td><code>{{ $investigation->report?->tracking_number }}</code></td>
                <td>{{ \Illuminate\Support\Str::limit($investigation->report?->subject, 45) }}</td>
                <td>{{ $investigation->investigator?->name ?? '—' }}</td>
                <td>
                  <span class="badge text-bg-{{ $statusBadge[$investigation->report?->status] ?? 'secondary' }}">
                    {{ ucwords(str_replace('_', ' ', $investigation->report?->status ?? 'n/a')) }}
                  </span>
                </td>
                <td>{{ optional($investigation->created_at)->format('d M Y') }}</td>
                <td class="text-end">
                  <a href="{{ route('investigations.show', $investigation) }}" class="btn btn-sm btn-outline-primary">Open</a>
                  @if (auth()->user()?->hasAnyRole(['Admin', 'Super Admin']))
                    <form action="{{ route('investigations.destroy', $investigation) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Remove this investigation assignment?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-outline-danger">Remove</button>
                    </form>
                  @endif
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="text-center text-secondary py-4">No investigations yet.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
    @if ($investigations->hasPages())
      <div class="card-footer">
        {{ $investigations->links() }}
      </div>
    @endif
  </div>
@endsection
