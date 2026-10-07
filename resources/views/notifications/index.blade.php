@extends('layouts.admin')

@section('title', 'Notifications')
@section('page_title', 'Notifications')
@section('breadcrumb')
  <li class="breadcrumb-item active" aria-current="page">Notifications</li>
@endsection

@section('content')
<div class="card mb-4">
  <div class="card-header">
    <h3 class="card-title">Your notifications</h3>
    <div class="card-tools">
      <form method="POST" action="{{ route('notifications.readAll') }}">
        @csrf <button class="btn btn-sm btn-outline-secondary">Mark all as read</button>
      </form>
    </div>
  </div>
  <ul class="list-group list-group-flush">
    @forelse ($notifications as $n)
      <li class="list-group-item {{ $n->read_at ? '' : 'bg-body-tertiary' }}">
        <a href="{{ $n->data['url'] ?? '#' }}" class="text-decoration-none">
          <strong>{{ $n->data['title'] ?? 'Notification' }}</strong>
        </a>
        <div class="text-secondary">{{ $n->data['message'] ?? '' }}</div>
        <small class="text-secondary">{{ $n->created_at->diffForHumans() }}</small>
      </li>
    @empty
      <li class="list-group-item text-secondary">Nothing here yet.</li>
    @endforelse
  </ul>
  @if ($notifications->hasPages())<div class="card-footer">{{ $notifications->links() }}</div>@endif
</div>
@endsection
