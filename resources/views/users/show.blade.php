@extends('layouts.admin')

@section('title', 'User Details')
@section('page_title', 'User Details')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
  <li class="breadcrumb-item active" aria-current="page">{{ $user->name }}</li>
@endsection

@section('content')
  <div class="card mb-4">
    <div class="card-header">
      <h3 class="card-title">{{ $user->name }}</h3>
    </div>
    <div class="card-body">
      <dl class="row mb-0">
        <dt class="col-sm-3">Name</dt>
        <dd class="col-sm-9">{{ $user->name }}</dd>

        <dt class="col-sm-3">Email</dt>
        <dd class="col-sm-9">{{ $user->email }}</dd>

        <dt class="col-sm-3">Phone</dt>
        <dd class="col-sm-9">{{ $user->phone ?? '—' }}</dd>

        <dt class="col-sm-3">Roles</dt>
        <dd class="col-sm-9">
          @forelse ($user->roles as $role)
            <span class="badge text-bg-secondary">{{ $role->name }}</span>
          @empty
            <span class="text-secondary">—</span>
          @endforelse
        </dd>

        <dt class="col-sm-3">Status</dt>
        <dd class="col-sm-9">
          <span class="badge text-bg-{{ $user->status ? 'success' : 'danger' }}">
            {{ $user->status ? 'Active' : 'Inactive' }}
          </span>
        </dd>

        <dt class="col-sm-3">Verified</dt>
        <dd class="col-sm-9">
          {{ optional($user->email_verified_at)->format('d M Y H:i') ?? 'Not verified' }}
        </dd>

        <dt class="col-sm-3">Joined</dt>
        <dd class="col-sm-9">{{ optional($user->created_at)->format('d M Y H:i') }}</dd>
      </dl>
    </div>
    <div class="card-footer">
      <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to Users</a>
    </div>
  </div>
@endsection