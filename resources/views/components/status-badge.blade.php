@props(['status'])
@php
  $map = ['submitted' => 'secondary', 'under_review' => 'info', 'assigned' => 'primary',
          'investigating' => 'warning', 'resolved' => 'success', 'closed' => 'dark', 'rejected' => 'danger'];
@endphp
<span class="badge text-bg-{{ $map[$status] ?? 'secondary' }}">{{ ucwords(str_replace('_', ' ', $status)) }}</span>
