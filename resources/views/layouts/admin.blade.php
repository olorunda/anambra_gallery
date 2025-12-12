<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Panel - Anambra State')</title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link href="{{asset('bootstrap.min.css')}}" rel="stylesheet">
    <!-- Bootstrap Icons (CDN) -->
    <link href="//cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Fonts -->
    <link href="//fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --admin-primary: #2563eb;
            --admin-primary-dark: #1d4ed8;
            --admin-secondary: #64748b;
            --admin-success: #059669;
            --admin-warning: #d97706;
            --admin-danger: #dc2626;
            --admin-sidebar-width: 280px;
            --admin-sidebar-bg: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            --admin-header-height: 70px;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8fafc;
            font-size: 14px;
        }

        .admin-sidebar {
            width: var(--admin-sidebar-width);
            background: var(--admin-sidebar-bg);
            border-right: 1px solid #e2e8f0;
            z-index: 1000;
        }

        .admin-main {
            margin-left: var(--admin-sidebar-width);
            min-height: 100vh;
        }

        .admin-header {
            height: var(--admin-header-height);
            background: white;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
        }

        .nav-pills .nav-link {
            color: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
            margin-bottom: 4px;
            padding: 12px 16px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nav-pills .nav-link:hover {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateX(4px);
        }

        .nav-pills .nav-link.active {
            color: white;
            background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-primary-dark) 100%);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .nav-pills .nav-link i {
            width: 20px;
            font-size: 18px;
        }

        .stats-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
            border: 1px solid #f1f5f9;
            transition: all 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px 0 rgb(0 0 0 / 0.1), 0 4px 6px -2px rgb(0 0 0 / 0.05);
        }

        .stats-icon {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
        }

        .card {
            border: 1px solid #f1f5f9;
            border-radius: 12px;
            box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
        }

        .card-header {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-bottom: 1px solid #e2e8f0;
            font-weight: 600;
        }

        .btn {
            border-radius: 8px;
            font-weight: 500;
            padding: 8px 16px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-primary-dark) 100%);
            border: none;
            box-shadow: 0 2px 4px rgba(37, 99, 235, 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .table th {
            font-weight: 600;
            color: #475569;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 2px solid #e2e8f0;
            padding: 16px 24px;
        }

        .table td {
            padding: 16px 24px;
            vertical-align: middle;
        }

        .badge {
            padding: 6px 12px;
            font-weight: 500;
            border-radius: 6px;
        }

        .alert {
            border-radius: 8px;
            border: none;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 25px 0 rgb(0 0 0 / 0.1), 0 4px 6px -2px rgb(0 0 0 / 0.05);
            border-radius: 8px;
        }

        @media (max-width: 768px) {
            .admin-sidebar {
                margin-left: calc(-1 * var(--admin-sidebar-width));
                transition: margin-left 0.3s ease;
            }

            .admin-main {
                margin-left: 0;
            }

            .admin-sidebar.show {
                margin-left: 0;
            }
        }
        /* Ensure non-WYSIWYG (opt-out) textareas have comfortable height */
        textarea.form-control { min-height: 240px; }
    </style>
    @stack('styles')
    @yield('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="admin-sidebar position-fixed top-0 start-0 vh-100 overflow-auto">
        <div class="p-4">
            <div class="d-flex align-items-center mb-4">
                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAahs_GBXB_QF-I2oDBJhi15x_dMHjAZ1F-OLBdDdy0qr-5324psB2fiDLoURwDT-LHSiDMy1QKS8Snt--7wIvkhYqb0lknBNdsNgwSCeFJUJ5J59P4eilVazpgi1OfzlmrL77B1l8Fe0Ofrx_2TfB1kIO8hLsurBWWLosZX4w4KylXUQ_ion0Xq4oKmpSZV3pL9C7bjsxxcnwwQrSB6rm-JP69cTZDSPwfvJRY89Ou34gtfqXXKaluv03XEfCNT2TAtgtWwx-20byP" alt="Logo" class="me-3" style="width: 40px; height: 40px; border-radius: 8px;">
                <div>
                    <h5 class="text-white mb-0">Admin Panel</h5>
                    <small class="text-white-50">Anambra State</small>
                </div>
            </div>
        </div>

        <nav class="px-3">
            <div class="px-3 py-2 mb-2">
                <small class="text-white-50 text-uppercase fw-semibold">Content Management</small>
            </div>

            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-house-door"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}" href="{{ route('admin.pages.index') }}">
                        <i class="bi bi-file-text"></i>
                        Pages
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.executive-council-members.*') ? 'active' : '' }}" href="{{ route('admin.executive-council-members.index') }}">
                        <i class="bi bi-people-fill"></i>
                        Executive Council
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.artifacts.*') ? 'active' : '' }}" href="{{ route('admin.artifacts.index') }}">
                        <i class="bi bi-gem"></i>
                        Artifacts
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.achievements.*') ? 'active' : '' }}" href="{{ route('admin.achievements.index') }}">
                        <i class="bi bi-trophy"></i>
                        Achievements
                    </a>
                </li>

            </ul>

            <hr class="border-white-50 my-4">

            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}" target="_blank">
                        <i class="bi bi-globe"></i>
                        View Site
                    </a>
                </li>
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" href="{{ route('dashboard') }}">--}}
{{--                        <i class="bi bi-person-circle"></i>--}}
{{--                        Profile--}}
{{--                    </a>--}}
{{--                </li>--}}
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="admin-main">
        <!-- Header -->
        <header class="admin-header py-3">
            <div class="container-fluid px-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-1 text-dark fw-semibold">@yield('page_title', 'Dashboard')</h4>
                        @hasSection('page_description')
                            <p class="text-muted mb-0 small">@yield('page_description')</p>
                        @endif
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <span class="badge bg-success">
                            <i class="bi bi-circle-fill me-1" style="font-size: 8px;"></i>
                            Online
                        </span>
                        <span class="text-muted">{{ auth()->user()->name }}</span>
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="dropdown-item" type="submit">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <strong>There were some problems with your input:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Rich Text Editor (TinyMCE) -->
    <script src="https://cdn.tiny.cloud/1/409qbo6k8552n8vgc4ge7fufka9vqm1relsceldlaqetlttv/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof tinymce !== 'undefined') {
                tinymce.init({
                    selector: 'textarea:not([data-wysiwyg="off"])',
                    plugins: 'link lists image table code codesample autoresize fullscreen',
                    toolbar: 'undo redo | blocks | bold italic underline | alignleft aligncenter alignright | bullist numlist outdent indent | link table | removeformat | code | fullscreen',
                    menubar: 'file edit view insert format table tools help',
                    branding: false,
                    convert_urls: false,
                    // Auto-resize with sensible bounds
                    min_height: 600,
                    max_height: 1200,
                    autoresize_bottom_margin: 16,
                    relative_urls: false,
                    remove_script_host: false,
                });

                // Ensure editor content is synced back to the textarea on submit
                document.querySelectorAll('form').forEach(function (form) {
                    form.addEventListener('submit', function () {
                        if (tinymce && tinymce.editors) {
                            tinymce.triggerSave();
                        }
                    });
                });
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
