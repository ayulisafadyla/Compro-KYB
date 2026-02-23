<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel - PT Kayaba Indonesia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-red: #eb0a1e;
            --primary-dark: #c4081a;
            --primary-light: #f03040;
            --sidebar-width: 200px;
            --sidebar-bg: #ffffff;
            --sidebar-border: #e8e8e8;
            --body-bg: #f5f7fa;
            --body-bg-end: #e8ecf1;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--body-bg) 0%, var(--body-bg-end) 100%);
            min-height: 100vh;
            overflow-x: hidden;
            font-size: 14px;
        }

        /* Sidebar Styling */
        #sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--sidebar-bg);
            border-right: 1px solid var(--sidebar-border);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.04);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
            overflow-y: auto;
        }

        #sidebar::-webkit-scrollbar {
            width: 4px;
        }

        #sidebar::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.15);
            border-radius: 10px;
        }

        #sidebar.collapsed {
            margin-left: calc(-1 * var(--sidebar-width));
        }

        .sidebar-header {
            padding: 14px 14px;
            background: linear-gradient(135deg, var(--primary-red), var(--primary-dark));
            border-bottom: 1px solid var(--sidebar-border);
            text-align: center;
        }

        .sidebar-header img {
            text-align: center;
            height: 50px;
            filter: brightness(0) invert(1);
            transition: transform 0.3s ease;
        }

        .sidebar-header img:hover {
            transform: scale(1.05);
        }

        /* User Profile in Sidebar */
        .sidebar-user {
            padding: 12px 14px;
            background: #fff5f5;
            border-bottom: 1px solid var(--sidebar-border);
        }

        .sidebar-user .user-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-red) 0%, var(--primary-dark) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
            font-weight: 600;
            box-shadow: 0 3px 8px rgba(235, 10, 30, 0.25);
            flex-shrink: 0;
        }

        .sidebar-user .user-info {
            color: #333;
            margin-left: 8px;
            overflow: hidden;
        }

        .sidebar-user .user-name {
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 1px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar-user .user-role {
            font-size: 11px;
            color: #999;
        }

        /* Section Label */
        .sidebar-section-label {
            padding: 14px 14px 6px;
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: #aaa;
        }

        /* Navigation Menu */
        #sidebar ul.components {
            padding: 4px 0;
            list-style: none;
        }

        #sidebar ul li {
            margin: 2px 6px;
        }

        #sidebar ul li a {
            padding: 9px 12px;
            font-size: 12px;
            font-weight: 500;
            display: flex;
            align-items: center;
            color: #555;
            text-decoration: none;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            border-radius: 7px;
            border-left: none;
        }

        #sidebar ul li a:hover {
            color: var(--primary-red);
            background: #fff0f0;
        }

        #sidebar ul li a.active {
            color: white;
            background: linear-gradient(135deg, var(--primary-red), var(--primary-dark));
            box-shadow: 0 3px 12px rgba(235, 10, 30, 0.25);
        }

        #sidebar ul li a i {
            margin-right: 8px;
            font-size: 14px;
            width: 18px;
            text-align: center;
        }

        /* Sidebar Submenu */
        .sidebar-dropdown-toggle::after {
            display: inline-block;
            margin-left: auto;
            vertical-align: 0.255em;
            content: "";
            border-top: 0.3em solid;
            border-right: 0.3em solid transparent;
            border-bottom: 0;
            border-left: 0.3em solid transparent;
            transition: transform 0.3s ease;
        }

        .sidebar-dropdown-toggle[aria-expanded="true"]::after {
            transform: rotate(180deg);
        }

        #sidebar ul.collapse {
            background: #fcfcfc;
            margin: 0 6px 4px 18px;
            border-radius: 0 0 7px 7px;
            border-left: 1px dashed #eee;
        }

        #sidebar ul.collapse li a {
            padding: 7px 12px;
            font-size: 11px;
            color: #777;
        }

        #sidebar ul.collapse li a:hover {
            color: var(--primary-red);
            background: #fff5f5;
        }

        #sidebar ul.collapse li a.active {
            color: var(--primary-red);
            background: #fff0f0;
            font-weight: 600;
            box-shadow: none;
        }

        /* Sidebar Footer */
        .sidebar-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 10px 14px;
            border-top: 1px solid var(--sidebar-border);
            background: #fafafa;
        }

        .sidebar-footer a {
            color: #888;
            text-decoration: none;
            font-size: 11px;
            display: flex;
            align-items: center;
            transition: color 0.2s ease;
        }

        .sidebar-footer a:hover {
            color: var(--primary-red);
        }

        .sidebar-footer a i {
            margin-right: 6px;
            font-size: 13px;
        }

        /* Main Content Area */
        #content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            padding: 20px 28px;
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            width: calc(100% - var(--sidebar-width));
        }

        #content.expanded {
            margin-left: 0;
            width: 100%;
        }

        /* Top Navbar */
        .navbar-admin {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(0, 0, 0, 0.06);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.04);
            border-radius: 12px;
            padding: 12px 20px;
            margin-bottom: 24px;
        }

        .navbar-admin .btn-toggle {
            background: linear-gradient(135deg, var(--primary-red), var(--primary-dark));
            border: none;
            color: white;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 3px 10px rgba(235, 10, 30, 0.25);
        }

        .navbar-admin .btn-toggle:hover {
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(235, 10, 30, 0.35);
        }

        .navbar-admin .page-title {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-left: 12px;
        }

        .navbar-admin .dropdown-toggle {
            background: transparent;
            border: none;
            color: #333;
            font-weight: 500;
            font-size: 13px;
            padding: 6px 12px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .navbar-admin .dropdown-toggle:hover {
            background: rgba(235, 10, 30, 0.06);
        }

        .navbar-admin .dropdown-toggle::after {
            margin-left: 6px;
        }

        .navbar-admin .user-avatar-small {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-red), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 13px;
            box-shadow: 0 2px 8px rgba(235, 10, 30, 0.25);
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 6px;
            margin-top: 8px;
        }

        .dropdown-item {
            border-radius: 6px;
            padding: 8px 14px;
            transition: all 0.2s ease;
            font-weight: 500;
            font-size: 13px;
        }

        .dropdown-item:hover {
            background: rgba(235, 10, 30, 0.06);
        }

        .dropdown-item.text-danger:hover {
            background: rgba(235, 10, 30, 0.1);
        }

        /* ========================================
           GLOBAL ADMIN STYLES
           ======================================== */

        /* Page Headers */
        .admin-page-header h2 {
            font-size: 22px;
            font-weight: 700;
            color: #1a1d29;
        }

        .admin-page-header p {
            font-size: 13px;
            color: #888;
        }

        /* Cards */
        .card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
            transition: box-shadow 0.2s ease;
        }

        .card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .card-header {
            background: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
            border-radius: 12px 12px 0 0 !important;
            padding: 14px 18px;
        }

        .card-header h5 {
            font-size: 15px;
            font-weight: 600;
            color: #333;
        }

        .card-body {
            padding: 18px;
        }

        /* Tables */
        .table {
            font-size: 13px;
            margin-bottom: 0;
        }

        .table thead th {
            background: linear-gradient(135deg, var(--primary-red), var(--primary-dark));
            color: white;
            border-bottom: none;
            font-weight: 600;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 12px 14px;
        }

        .table tbody td {
            padding: 10px 14px;
            vertical-align: middle;
            border-bottom: 1px solid #f0f0f0;
            color: #444;
        }

        .table-striped > tbody > tr:nth-of-type(odd) > * {
            background-color: #fff5f5;
            --bs-table-bg-type: #fff5f5;
        }

        .table-striped > tbody > tr:nth-of-type(even) > * {
            background-color: white;
            --bs-table-bg-type: white;
        }

        .table-hover tbody tr:hover {
            background: #ffe0e0 !important;
            --bs-table-hover-bg: #ffe0e0;
        }

        /* Buttons */
        .btn {
            font-size: 13px;
            font-weight: 500;
            border-radius: 8px;
            padding: 7px 14px;
            transition: all 0.2s ease;
        }

        .btn-sm {
            font-size: 12px;
            padding: 5px 10px;
            border-radius: 6px;
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--primary-red), var(--primary-dark));
            border: none;
            box-shadow: 0 2px 8px rgba(235, 10, 30, 0.2);
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, var(--primary-light), var(--primary-red));
            box-shadow: 0 4px 12px rgba(235, 10, 30, 0.3);
            transform: translateY(-1px);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-red), var(--primary-dark));
            border: none;
            box-shadow: 0 2px 8px rgba(235, 10, 30, 0.2);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-light), var(--primary-red));
            box-shadow: 0 4px 12px rgba(235, 10, 30, 0.3);
            transform: translateY(-1px);
        }

        .btn-warning {
            background: #FFA726;
            border: none;
            color: white;
        }

        .btn-warning:hover {
            background: #FB8C00;
            color: white;
            transform: translateY(-1px);
        }

        .btn-info {
            background: #42A5F5;
            border: none;
            color: white;
        }

        .btn-info:hover {
            background: #1E88E5;
            color: white;
            transform: translateY(-1px);
        }

        .btn-outline-danger {
            border-color: var(--primary-red);
            color: var(--primary-red);
        }

        .btn-outline-danger:hover {
            background: var(--primary-red);
            border-color: var(--primary-red);
            transform: translateY(-1px);
        }

        /* Badges */
        .badge {
            font-size: 11px;
            font-weight: 500;
            padding: 4px 8px;
            border-radius: 5px;
        }

        .bg-primary {
            background: var(--primary-red) !important;
        }

        /* Forms */
        .form-control, .form-select {
            font-size: 13px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            padding: 8px 12px;
            transition: all 0.2s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-red);
            box-shadow: 0 0 0 3px rgba(235, 10, 30, 0.1);
        }

        .form-label {
            font-size: 12px;
            font-weight: 600;
            color: #555;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            margin-bottom: 4px;
        }

        /* Alerts */
        .alert {
            font-size: 13px;
            border-radius: 10px;
            padding: 12px 16px;
            border: none;
        }

        .alert-success {
            background: #E8F5E9;
            color: #2E7D32;
        }

        .alert-danger {
            background: #FFEBEE;
            color: #eb0a1e;
        }

        /* Pagination */
        .pagination {
            gap: 4px;
        }

        .page-link {
            font-size: 12px;
            border-radius: 6px !important;
            border: 1px solid #e0e0e0;
            color: #555;
            padding: 6px 10px;
        }

        .page-link:hover {
            background: rgba(235, 10, 30, 0.06);
            color: var(--primary-red);
            border-color: var(--primary-red);
        }

        .page-item.active .page-link {
            background: var(--primary-red);
            border-color: var(--primary-red);
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            #content {
                padding: 20px 20px;
            }
        }

        @media (max-width: 992px) {
            #sidebar {
                margin-left: calc(-1 * var(--sidebar-width));
            }

            #sidebar.active {
                margin-left: 0;
            }

            #content {
                margin-left: 0;
                width: 100%;
                padding: 16px;
            }
        }

        @media (max-width: 768px) {
            #content {
                padding: 12px;
            }

            .navbar-admin {
                padding: 10px 14px;
                border-radius: 8px;
                margin-bottom: 16px;
            }

            .navbar-admin .btn-toggle {
                padding: 6px 10px;
                font-size: 14px;
            }

            .card-body {
                padding: 14px;
            }

            .table {
                font-size: 12px;
            }

            .table thead th {
                padding: 10px 10px;
                font-size: 10px;
            }

            .table tbody td {
                padding: 8px 10px;
            }
        }

        @media (max-width: 576px) {
            #sidebar {
                width: 100%;
                max-width: var(--sidebar-width);
            }

            #content {
                padding: 10px;
            }

            .btn {
                font-size: 12px;
                padding: 6px 10px;
            }

            .btn-sm {
                font-size: 11px;
                padding: 4px 8px;
            }
        }
    </style>
    @stack('styles')
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <a href="{{ route('admin.dashboard') }}">
                    <img src="{{ asset('assets/img/kybLogo.png') }}" alt="KYB Logo">
                </a>
            </div>


            <ul class="components">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                        <i class="bi bi-grid-1x2-fill"></i> Dashboard
                    </a>
                </li>

                <div class="sidebar-section-label">Main Menu</div>
                <li>
                    <a href="#berandaSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="sidebar-dropdown-toggle {{ Request::is('admin/banners*', 'admin/home-abouts*', 'admin/home-about-images*', 'admin/home-videos*', 'admin/home-philosophies*') ? 'active' : '' }}">
                        <i class="bi bi-house-door-fill"></i> Beranda
                    </a>

                    <ul class="collapse list-unstyled {{ Request::is('admin/banners*', 'admin/home-abouts*', 'admin/home-about-images*', 'admin/home-videos*', 'admin/home-philosophies*') ? 'show' : '' }}" id="berandaSubmenu">
                        <li><a href="{{ route('admin.banners.index') }}" class="{{ Request::is('admin/banners*') ? 'active' : '' }}">Hero Carousel</a></li>
                        <li><a href="{{ route('admin.home-abouts.index') }}" class="{{ Request::is('admin/home-abouts*') ? 'active' : '' }}">About Us</a></li>
                        <li><a href="{{ route('admin.home-about-images.edit') }}" class="{{ Request::is('admin/home-about-images*') ? 'active' : '' }}">Company Images</a></li>
                        <li><a href="{{ route('admin.home-videos.index') }}" class="{{ Request::is('admin/home-videos*') ? 'active' : '' }}">Video Banner</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#produkSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="sidebar-dropdown-toggle {{ Request::is('admin/categories*', 'admin/products*', 'admin/brands*') ? 'active' : '' }}">
                        <i class="bi bi-box-seam-fill"></i> Produk
                    </a>
                    <ul class="collapse list-unstyled {{ Request::is('admin/categories*', 'admin/products*', 'admin/brands*') ? 'show' : '' }}" id="produkSubmenu">
                        <li><a href="{{ route('admin.categories.index') }}" class="{{ Request::is('admin/categories*') ? 'active' : '' }}">Kategori Produk</a></li>
                        <li><a href="{{ route('admin.products.index') }}" class="{{ Request::is('admin/products*') ? 'active' : '' }}">Daftar Produk</a></li>
                        <li><a href="{{ route('admin.brands.index') }}" class="{{ Request::is('admin/brands*') ? 'active' : '' }}">Brand Logo</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#eventSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="sidebar-dropdown-toggle {{ Request::is('admin/events*') ? 'active' : '' }}">
                        <i class="bi bi-calendar-event-fill"></i> Pencapaian
                    </a>
                    <ul class="collapse list-unstyled {{ Request::is('admin/events*') ? 'show' : '' }}" id="eventSubmenu">
                        <li><a href="{{ route('admin.events.index', ['type' => 'promo']) }}" class="{{ request('type') == 'promo' ? 'active' : '' }}">Sertifikat</a></li>
                        <li><a href="{{ route('admin.events.index', ['type' => 'workshop']) }}" class="{{ request('type') == 'workshop' ? 'active' : '' }}">Penghargaan</a></li>
                        <li><a href="{{ route('admin.events.index', ['type' => 'launch']) }}" class="{{ request('type') == 'launch' ? 'active' : '' }}">Daftar Events</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#staticSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="sidebar-dropdown-toggle {{ request()->routeIs('admin.faqs.*', 'admin.about-sections.*', 'admin.contact-items.*', 'admin.policy-sections.*') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-text-fill"></i> Halaman Statis
                    </a>
                    <ul class="collapse list-unstyled {{ request()->routeIs('admin.faqs.*', 'admin.about-sections.*', 'admin.contact-items.*', 'admin.policy-sections.*') ? 'show' : '' }}" id="staticSubmenu">
                    <li><a href="{{ route('admin.faqs.index') }}" class="{{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}">FAQ</a></li>
                        <li><a href="{{ route('admin.contact-items.index') }}" class="{{ request()->routeIs('admin.contact-items.*') ? 'active' : '' }}">Kontak Kami</a></li>
                    </ul>
                </li>

                @if(Auth::user()->role && Auth::user()->role->slug === 'super-admin')
                <li>
                    <a href="#userSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="sidebar-dropdown-toggle {{ Request::is('admin/users*', 'admin/roles*', 'admin/security*') ? 'active' : '' }}">
                        <i class="bi bi-people-fill"></i> Pengguna
                    </a>
                    <ul class="collapse list-unstyled {{ Request::is('admin/users*', 'admin/roles*', 'admin/security*') ? 'show' : '' }}" id="userSubmenu">
                        <li><a href="{{ route('admin.users.index') }}" class="{{ Request::is('admin/users*') ? 'active' : '' }}">Admin Users</a></li>
                        <li><a href="{{ route('admin.roles.index') }}" class="{{ Request::is('admin/roles*') ? 'active' : '' }}">Role & Permissions</a></li>
                    </ul>
                </li>
                @endif

                @if(Auth::user()->role && Auth::user()->role->slug === 'super-admin')
                <li>
                    <a href="#settingSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="sidebar-dropdown-toggle {{ Request::is('admin/settings*') ? 'active' : '' }}">
                        <i class="bi bi-gear-fill"></i> Pengaturan Website
                    </a>
                    <ul class="collapse list-unstyled {{ Request::is('admin/settings*') ? 'show' : '' }}" id="settingSubmenu">
                        <li><a href="{{ route('admin.settings.index', ['group' => 'general']) }}" class="{{ request('group') == 'general' ? 'active' : '' }}">General Setting</a></li>
                        <li><a href="{{ route('admin.settings.index', ['group' => 'seo']) }}" class="{{ request('group') == 'seo' ? 'active' : '' }}">SEO & Meta</a></li>
                        <li><a href="{{ route('admin.settings.index', ['group' => 'analytics']) }}" class="{{ request('group') == 'analytics' ? 'active' : '' }}">Google Analytics</a></li>
                        <li><a href="{{ route('admin.settings.index', ['group' => 'maintenance']) }}" class="{{ request('group') == 'maintenance' ? 'active' : '' }}">Maintenance Mode</a></li>
                    </ul>
                </li>
                @endif

                @if(Auth::user()->role && Auth::user()->role->slug === 'super-admin')
                <li>
                    <a href="#logSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="sidebar-dropdown-toggle {{ Request::is('admin/logs*') ? 'active' : '' }}">
                        <i class="bi bi-clock-history"></i> Log & Aktivitas
                    </a>
                    <ul class="collapse list-unstyled {{ Request::is('admin/logs*') ? 'show' : '' }}" id="logSubmenu">
                        <li><a href="{{ route('admin.logs.activity') }}" class="{{ Request::is('admin/logs/activity*') ? 'active' : '' }}">Activity Log</a></li>
                        <li><a href="{{ route('admin.logs.login') }}" class="{{ Request::is('admin/logs/login*') ? 'active' : '' }}">Login History</a></li>
                    </ul>
                </li>
                @endif
            </ul>

            <div class="sidebar-footer">
                <a href="{{ url('/') }}" target="_blank">
                    <i class="bi bi-globe2"></i> Visit Website
                </a>
            </div>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-admin">
                <div class="container-fluid">
                    <button type="button" id="sidebarToggle" class="btn btn-toggle me-3">
                        <i class="bi bi-list"></i>
                    </button>

                    <div class="d-flex align-items-center ms-auto">
                        <div class="dropdown">
                            <button class="dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
                                <div class="user-avatar-small">
                                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                                </div>
                                <span class="d-none d-md-inline">{{ Auth::user()->name ?? 'Admin' }}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="main-content">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');

        sidebarToggle.addEventListener('click', function () {
            if (window.innerWidth <= 992) {
                sidebar.classList.toggle('active');
            } else {
                sidebar.classList.toggle('collapsed');
                content.classList.toggle('expanded');
            }
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            if (window.innerWidth <= 992) {
                const isClickInside = sidebar.contains(event.target) || sidebarToggle.contains(event.target);
                if (!isClickInside && sidebar.classList.contains('active')) {
                    sidebar.classList.remove('active');
                }
            }
        });
    </script>
    @stack('scripts')
</body>

</html>
