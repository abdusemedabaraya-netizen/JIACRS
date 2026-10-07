@extends('layouts.admin')

@section('title', 'Report Details')
@section('page_title', 'Report Details')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('reports.index') }}">Reports</a></li>
  <li class="breadcrumb-item active" aria-current="page">{{ $report->tracking_number }}</li>
@endsection

@php
  $statusBadge = [
    'submitted' => 'secondary', 'under_review' => 'info', 'assigned' => 'primary',
    'investigating' => 'warning', 'resolved' => 'success', 'closed' => 'dark', 'rejected' => 'danger',
  ];
  $priorityBadge = ['low' => 'success', 'medium' => 'info', 'high' => 'warning', 'critical' => 'danger'];
  $admin = auth()->user()?->hasAnyRole(['Admin', 'Super Admin']);
@endphp

@section('content')
  <div class="row g-3 mb-3">
    <div class="col-lg-8">
      <div class="card mb-3">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h3 class="card-title">{{ $report->subject }}</h3>
          <span class="text-secondary"><code>{{ $report->tracking_number }}</code></span>
        </div>
        <div class="card-body">
          <dl class="row mb-0">
            <dt class="col-sm-3">Category</dt>
            <dd class="col-sm-9">{{ ucwords(str_replace('_', ' ', $report->category)) }}</dd>

            <dt class="col-sm-3">Department</dt>
            <dd class="col-sm-9">{{ $report->department?->name ?? '—' }}</dd>

            <dt class="col-sm-3">Priority</dt>
            <dd class="col-sm-9">
              <span class="badge text-bg-{{ $priorityBadge[$report->priority] ?? 'secondary' }}">{{ ucfirst($report->priority) }}</span>
            </dd>

            <dt class="col-sm-3">Status</dt>
            <dd class="col-sm-9">
              <span class="badge text-bg-{{ $statusBadge[$report->status] ?? 'secondary' }}">{{ ucwords(str_replace('_', ' ', $report->status)) }}</span>
            </dd>

            <dt class="col-sm-3">Location</dt>
            <dd class="col-sm-9">{{ $report->location ?? '—' }}</dd>

            <dt class="col-sm-3">Incident Date</dt>
            <dd class="col-sm-9">{{ optional($report->incident_date)->format('d M Y') ?? '—' }}</dd>

            <dt class="col-sm-3">Submitted</dt>
            <dd class="col-sm-9">{{ optional($report->created_at)->format('d M Y H:i') }}</dd>

            <dt class="col-sm-3">Reporter</dt>
            <dd class="col-sm-9">
              @if ($report->anonymous)
                <span class="badge text-bg-secondary">Anonymous</span>
              @elseif ($report->user)
                {{ $report->user->name }} ({{ $report->user->email }})
              @else
                —
              @endif
            </dd>

            <dt class="col-sm-3">Description</dt>
            <dd class="col-sm-9">{{ $report->description ?: '—' }}</dd>
          </dl>
        </div>
      </div>

      <div class="card mb-3">
        <div class="card-header"><h3 class="card-title">Investigation</h3></div>
        <div class="card-body">
          @if ($report->investigation)
            <dl class="row mb-0">
              <dt class="col-sm-3">Investigator</dt>
              <dd class="col-sm-9">{{ $report->investigation->investigator?->name ?? '—' }}</dd>
              <dt class="col-sm-3">Findings</dt>
              <dd class="col-sm-9">{{ $report->investigation->findings ?: '—' }}</dd>
              <dt class="col-sm-3">Recommendations</dt>
              <dd class="col-sm-9">{{ $report->investigation->recommendations ?: '—' }}</dd>
            </dl>
          @else
            <p class="text-secondary mb-0">No investigation has been assigned to this report yet.</p>
          @endif
        </div>
      </div>

      <div class="card mb-3">
        <div class="card-header"><h3 class="card-title">Evidence</h3></div>
        <div class="card-body p-0">
          <ul class="list-group list-group-flush">
            @forelse ($report->evidences as $evidence)
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>
                  <i class="bi bi-paperclip"></i> {{ $evidence->file_name }}
                  <small class="text-secondary">({{ number_format($evidence->file_size / 1024, 1) }} KB)</small>
                </span>
                <a href="{{ asset($evidence->file_path) }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-primary">Download</a>
              </li>
            @empty
              <li class="list-group-item text-center text-secondary py-4">No evidence attached.</li>
            @endforelse
          </ul>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card">
        <div class="card-header"><h3 class="card-title">Update Status</h3></div>
        <div class="card-body">
          <form action="{{ route('reports.update', $report) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="mb-3">
              <label for="status" class="form-label">Status</label>
              <select name="status" id="status" class="form-select">
                @php $statuses = $admin ? ['submitted', 'under_review', 'assigned', 'investigating', 'resolved', 'closed', 'rejected'] : ['investigating', 'resolved']; @endphp
                @foreach ($statuses as $status)
                  <option value="{{ $status }}" @selected($report->status === $status)>
                    {{ ucwords(str_replace('_', ' ', $status)) }}
                  </option>
                @endforeach
              </select>
            </div>

            @if ($admin)
              <div class="mb-3">
                <label for="priority" class="form-label">Priority</label>
                <select name="priority" id="priority" class="form-select">
                  @foreach (['low', 'medium', 'high', 'critical'] as $priority)
                    <option value="{{ $priority }}" @selected($report->priority === $priority)>{{ ucfirst($priority) }}</option>
                  @endforeach
                </select>
              </div>
            @endif

            <button type="submit" class="btn btn-primary w-100">
              <i class="bi bi-save"></i> Save Changes
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection