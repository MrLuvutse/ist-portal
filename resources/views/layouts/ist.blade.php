<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="shortcut icon" href="/favicon.svg">
    <title>IST System — @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root { --ist-red: #c0392b; --ist-dark: #1a1a2e; --ist-navy: #16213e; }
        body { background: #f4f5f7; font-family: 'Segoe UI', sans-serif; }
        .ist-navbar { background: var(--ist-dark); padding: 0 24px; height: 56px; display: flex; align-items: center; }
        .ist-navbar .navbar-brand { color: #fff; font-weight: 600; font-size: 16px; display: flex; align-items: center; gap: 10px; }
        .ist-logo-box { width: 32px; height: 32px; background: var(--ist-red); border-radius: 4px; display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 13px; }
        .ist-navbar .nav-link { color: #ccc !important; font-size: 13px; padding: 6px 14px !important; border-radius: 4px; }
        .ist-navbar .nav-link:hover, .ist-navbar .nav-link.active { background: var(--ist-red); color: #fff !important; }
        .ist-navbar .nav-link.logout:hover { background: #555; }
        .sidebar { background: var(--ist-dark); min-height: calc(100vh - 56px); width: 220px; padding: 20px 0; }
        .sidebar .nav-link { color: #aaa; font-size: 13px; padding: 9px 20px; border-radius: 0; display: flex; align-items: center; gap: 10px; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: var(--ist-red); color: #fff; }
        .sidebar .nav-label { color: #555; font-size: 10px; font-weight: 600; letter-spacing: 1px; padding: 8px 20px 4px; }
        .main-content { flex: 1; padding: 24px; }
        .stat-card { background: #fff; border-radius: 8px; border: 1px solid #e8e8e8; padding: 16px; }
        .stat-card .stat-label { font-size: 12px; color: #888; margin-bottom: 4px; }
        .stat-card .stat-value { font-size: 28px; font-weight: 600; color: var(--ist-dark); }
        .ist-card { background: #fff; border-radius: 8px; border: 1px solid #e8e8e8; overflow: hidden; }
        .ist-card .card-header { background: #fff; border-bottom: 1px solid #e8e8e8; padding: 14px 18px; font-weight: 500; font-size: 14px; }
        .ist-btn { background: var(--ist-red); color: #fff; border: none; padding: 8px 18px; border-radius: 6px; font-size: 13px; }
        .ist-btn:hover { background: #a93226; color: #fff; }
        .badge-active { background: #E1F5EE; color: #0F6E56; }
        .badge-inactive { background: #FCEBEB; color: #791F1F; }
        .badge-pending { background: #FAEEDA; color: #633806; }
    </style>
    @yield('styles')
</head>
<body>
    <nav class="ist-navbar">
        <a class="navbar-brand" href="#">
            <div class="ist-logo-box">IST</div>
            IST System
            <small style="color:#aaa;font-size:10px;font-weight:400">@yield('portal-name')</small>
        </a>
        <div class="ms-auto d-flex align-items-center gap-2">
            <span style="color:#aaa;font-size:12px">{{ Auth::user()->name }}</span>
            <div style="width:28px;height:28px;border-radius:50%;background:var(--ist-red);color:#fff;font-size:11px;font-weight:600;display:flex;align-items:center;justify-content:center">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="nav-link logout btn btn-sm" style="color:#ccc;background:transparent;border:1px solid #444;border-radius:4px;padding:4px 12px;font-size:12px">Logout</button>
            </form>
        </div>
    </nav>
    <div class="d-flex">
        <div class="sidebar">
            @yield('sidebar')
        </div>
        <div class="main-content">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @yield('content')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>