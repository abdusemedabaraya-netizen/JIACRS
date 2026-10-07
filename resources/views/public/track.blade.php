@extends('layouts.public')

@section('title', 'Track a report')

@section('content')
<div class="container py-5" style="max-width: 560px">
  <h1 class="h3 mb-3">Track your report</h1>

  <div class="card shadow-sm">
    <div class="card-body p-4">
      <form method="POST" action="{{ route('track.search') }}">
        @csrf
        <div class="mb-3">
          <label class="form-label" for="tracking_number">Tracking number</label>
          <input type="text" id="tracking_number" name="tracking_number" value="{{ old('tracking_number') }}"
                 placeholder="JU-2026-000001" class="form-control @error('tracking_number') is-invalid @enderror" required>
          @error('tracking_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
          <label class="form-label" for="access_code">Access code</label>
          <input type="text" id="access_code" name="access_code" placeholder="XXXXX-XXXXX" autocomplete="off"
                 class="form-control code-box @error('access_code') is-invalid @enderror" required>
          @error('access_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <button class="btn btn-ju w-100">Check status</button>
      </form>
    </div>
  </div>
</div>
@endsection
