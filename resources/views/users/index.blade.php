@extends('layouts.admin')

@section('title', 'Users')
@section('page_title', 'Users')
@section('breadcrumb')
  <li class="breadcrumb-item active" aria-current="page">Users</li>
@endsection

@section('content')
  <div class="card mb-4">
    <div class="card-header">
      <h3 class="card-title">All Users</h3>
      <div class="card-tools">
        <form action="{{ route('users.index') }}" method="GET" class="d-flex gap-2">
          <input type="search" name="search" value="{{ request('search') }}" class="form-control form-control-sm"
                 placeholder="Search name or email" aria-label="Search users">
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
              <th>Name</th>
              <th>Email</th>
              <th>Roles</th>
              <th>Joined</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @forelse ($users as $user)
              <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                  @forelse ($user->roles as $role)
                    <span class="badge text-bg-secondary">{{ $role->name }}</span>
                  @empty
                    <span class="text-secondary">—</span>
                  @endforelse
                </td>
                <td>{{ optional($user->created_at)->format('d M Y') }}</td>
                <td class="text-end">
                  <a href="{{ route('users.show', $user) }}" class="btn btn-sm btn-outline-primary">View</a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center text-secondary py-4">No users found.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
    @if ($users->hasPages())
      <div class="card-footer">
        {{ $users->links() }}
      </div>
    @endif
  </div>
@endsection
