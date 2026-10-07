@extends('layouts.admin')

@section('title', 'Investigation Details')
@section('page_title', 'Investigation Details')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('investigations.index') }}">Investigations</a></li>
  <li class="breadcrumb-item active" aria-current="page">{{ $investigation->report?->tracking_number ?? 'Details' }}</li>
@endsection

@php
  $statusBadge = [
    'submitted' => 'secondary', 'under_review' => 'info', 'assigned' => 'primary',
    'investigating' => 'warning', 'resolved' => 'success', 'closed' => 'dark', 'rejected' => 'danger',
  ];
  $priorityBadge = ['low' => 'success', 'medium' => 'info', 'high' => 'warning', 'critical' => 'danger'];
  $report = $investigation->report;
@endphp

@section('content')
  <div class="row g-3 mb-3">
    <div class="col-lg-8">
      <div class="card mb-3">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h3 class="card-title">{{ $report?->subject ?? 'Report Details' }}</h3>
          @if ($report)
            <span class="text-secondary"><code>{{ $report->tracking_number }}</code></span>
          @endif
        </div>
        <div class="card-body">
          @if ($report)
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
          @else
            <p class="text-secondary mb-0">The related report could not be found.</p>
          @endif
        </div>
      </div>

      <div class="card mb-3">
        <div class="card-header"><h3 class="card-title">Evidence</h3></div>
        <div class="card-body p-0">
          <ul class="list-group list-group-flush">
            @forelse ($report?->evidences ?? [] as $evidence)
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
      <div class="card mb-3">
        <div class="card-header"><h3 class="card-title">Assignment</h3></div>
        <div class="card-body">
          <dl class="row mb-0">
            <dt class="col-5">Investigator</dt>
            <dd class="col-7">{{ $investigation->investigator?->name ?? '—' }}</dd>

            <dt class="col-5">Assigned</dt>
            <dd class="col-7">{{ optional($investigation->created_at)->format('d M Y H:i') }}</dd>
          </dl>
        </div>
      </div>

      <div class="card">
        <div class="card-header"><h3 class="card-title">Findings &amp; Recommendations</h3></div>
        <div class="card-body">
          @if (session('success'))
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
          @endif

          <form action="{{ route('investigations.update', $investigation) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="mb-3">
              <label for="findings" class="form-label">Findings</label>
              <textarea name="findings" id="findings" rows="6" class="form-control @error('findings') is-invalid @enderror"
                        placeholder="Record investigation findings...">{{ old('findings', $investigation->findings) }}</textarea>
              @error('findings')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="recommendations" class="form-label">Recommendations</label>
              <textarea name="recommendations" id="recommendations" rows="6" class="form-control @error('recommendations') is-invalid @enderror"
                        placeholder="Record recommendations...">{{ old('recommendations', $investigation->recommendations) }}</textarea>
              @error('recommendations')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">
              <i class="bi bi-save"></i> Save Changes
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
