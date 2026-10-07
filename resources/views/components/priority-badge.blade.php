@props(['priority'])
@php
  $map = ['low' => 'success', 'medium' => 'info', 'high' => 'warning', 'critical' => 'danger'];
@endphp
<span class="badge text-bg-{{ $map[$priority] ?? 'secondary' }}">{{ ucfirst($priority ?? 'n/a') }}</span>
