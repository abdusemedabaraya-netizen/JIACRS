<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'JIACRS') | Jimma University</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <style>
    :root { --ju-navy:#0B3C6F; --ju-green:#1E8E5A; --ju-gold:#E0A800; }
    body { background:#F5F7FA; }
    .navbar-ju { background:var(--ju-navy); }
    .btn-ju { background:var(--ju-green); border-color:var(--ju-green); color:#fff; }
    .btn-ju:hover { background:#17734a; border-color:#17734a; color:#fff; }
    .page-head { background:linear-gradient(135deg,#071F3D,var(--ju-navy) 60%,#0F5A6B); color:#fff; }
    .code-box { font-family:ui-monospace,Consolas,monospace; letter-spacing:.15em; }
  </style>
  @stack('styles')
</head>
<body class="d-flex flex-column min-vh-100">
  <nav class="navbar navbar-expand-lg navbar-dark navbar-ju">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}"><i class="bi bi-shield-check"></i> JIACRS</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-label="Menu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="nav">
        <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
          <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('report.create') }}">Submit Report</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('track.index') }}">Track Report</a></li>
          <li class="nav-item">
            @auth
              <a class="btn btn-sm btn-outline-light" href="{{ route('dashboard') }}">Dashboard</a>
            @else
              <a class="btn btn-sm btn-outline-light" href="{{ route('login') }}">Login</a>
            @endauth
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <main class="flex-grow-1">
    @if (session('error'))
      <div class="container mt-3"><div class="alert alert-danger">{{ session('error') }}</div></div>
    @endif
    @yield('content')
  </main>

  <footer class="py-4 text-center text-secondary small">
    &copy; {{ date('Y') }} Jimma University &mdash; Integrity and Anti-Corruption Reporting System
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>
</html>
