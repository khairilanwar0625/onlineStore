<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>@yield('title', 'Admin - Online Store')</title>
    <style>
        body { background-color: #f8f9fc; margin: 0; }
        .sidebar { min-height: 100vh; width: 220px; background-color: #1a1a2e; position: fixed; top: 0; left: 0; }
        .sidebar a { color: #ccc; text-decoration: none; }
        .sidebar a:hover { color: #fff; }
        .main-content { margin-left: 220px; min-height: 100vh; display: flex; flex-direction: column; }
        .top-navbar { background-color: #fff; border-bottom: 1px solid #e3e6f0; padding: 10px 20px; }
        .content-area { flex: 1; padding: 20px; }
        .copyright { background-color: #1a252f; }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column p-3 text-white">
        <a href="{{ route('admin.home.index') }}" class="text-white text-decoration-none mb-3">
            <span class="fs-5 fw-bold">Admin Panel</span>
        </a>
        <hr class="text-white">
        <ul class="nav flex-column mb-3">
            <li class="nav-item mb-1">
                <a href="{{ route('admin.home.index') }}" class="nav-link text-white-50">
                    - Admin - Home
                </a>
            </li>
            <li class="nav-item mb-1">
                <a href="{{ route('admin.product.index') }}" class="nav-link text-white-50">
                    - Admin - Products
                </a>
            </li>
        </ul>
        <hr class="text-white">
        <a href="{{ route('home.index') }}" class="btn btn-success btn-sm">
            Go back to the home page
        </a>
    </div>

    <!-- Main Content -->
    <div class="main-content">

        <!-- Top Navbar -->
        <div class="top-navbar d-flex justify-content-end align-items-center">
            @auth
            <span class="me-2 fw-bold">{{ Auth::user()->name }}</span>
            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=4e73df&color=fff&size=35"
                 class="rounded-circle" width="35" height="35">
            @endauth
        </div>

        <!-- Content -->
        <div class="content-area">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @yield('content')
        </div>

        <!-- Footer -->
        <div class="copyright py-3 text-center text-white">
            <small>Copyright - <strong>Online Store</strong></small>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>