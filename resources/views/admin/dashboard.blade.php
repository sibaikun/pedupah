<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedupa - Dashboard Admin</title>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            min-height: 100vh;
        }

        /* Top Bar */
        .top-bar {
            background: #b83232;
            color: white;
            padding: 8px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.813rem;
        }

        .top-bar-left {
            display: flex;
            gap: 24px;
        }

        .top-bar-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .top-bar-item svg {
            width: 14px;
            height: 14px;
        }

        /* Navbar */
        .navbar {
            background: white;
            border-bottom: 2px solid #e5e7eb;
            padding: 16px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 40px;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            width: 50px;
            height: 50px;
            object-fit: contain;
        }

        .logo-text {
            font-size: 1.125rem;
            font-weight: 700;
            color: #b83232;
        }

        .admin-badge {
            background: #b83232;
            color: white;
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-left: 8px;
        }

        .nav-menu {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .nav-link {
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            text-decoration: none;
            padding: 10px 16px;
            border-radius: 6px;
            transition: all 0.2s;
        }

        .nav-link:hover {
            color: #b83232;
            background: #fef2f2;
        }

        .nav-link.active {
            color: white;
            background: #b83232;
        }

        .profile-section {
            position: relative;
        }

        .profile-btn {
            background: none;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 6px;
            transition: background 0.2s;
            border: 1px solid #e5e7eb;
        }

        .profile-btn:hover {
            background: #f9fafb;
        }

        .profile-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #b83232;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .profile-name {
            font-size: 0.875rem;
            font-weight: 500;
            color: #1f2937;
        }

        .dropdown-icon {
            width: 14px;
            height: 14px;
            transition: transform 0.2s;
        }

        .profile-btn.active .dropdown-icon {
            transform: rotate(180deg);
        }

        .dropdown-menu {
            position: absolute;
            right: 0;
            top: 100%;
            margin-top: 8px;
            width: 180px;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            overflow: hidden;
            z-index: 1000;
        }

        .dropdown-item {
            display: block;
            width: 100%;
            padding: 12px 16px;
            font-size: 0.875rem;
            color: #374151;
            text-align: left;
            border: none;
            background: none;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s;
        }

        .dropdown-item:hover {
            background: #f9fafb;
        }

        .dropdown-item.logout {
            color: #dc2626;
            border-top: 1px solid #f3f4f6;
        }

        .dropdown-item.logout:hover {
            background: #fef2f2;
        }

        /* Mobile Menu Toggle */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
        }

        .mobile-menu-btn svg {
            width: 24px;
            height: 24px;
            color: #1f2937;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #b83232 0%, #8b2424 100%);
            color: white;
            padding: 60px 32px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.1)" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
            background-size: cover;
            background-position: bottom;
            opacity: 0.3;
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            margin: 0 auto;
        }

        .hero-content h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 16px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        .hero-content p {
            font-size: 1.125rem;
            opacity: 0.95;
            line-height: 1.7;
        }

        /* Main Content */
        .container {
            max-width: 1400px;
            margin: -40px auto 40px;
            padding: 0 24px;
            position: relative;
            z-index: 2;
        }

        /* Alert */
        .alert {
            background: white;
            border-left: 4px solid #10b981;
            padding: 16px 20px;
            border-radius: 8px;
            margin-bottom: 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert svg {
            width: 24px;
            height: 24px;
            color: #10b981;
            flex-shrink: 0;
        }

        .alert-text {
            color: #065f46;
            font-size: 0.938rem;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .top-bar {
                padding: 8px 16px;
                font-size: 0.75rem;
            }

            .top-bar-left {
                gap: 12px;
            }

            .navbar {
                padding: 12px 16px;
            }

            .nav-menu {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: white;
                flex-direction: column;
                gap: 0;
                padding: 8px;
                border-top: 1px solid #e5e7eb;
                box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            }

            .nav-menu.show {
                display: flex;
            }

            .nav-link {
                width: 100%;
                text-align: left;
            }

            .mobile-menu-btn {
                display: block;
            }

            .navbar-left {
                width: 100%;
                justify-content: space-between;
                gap: 12px;
            }

            .hero-section {
                padding: 40px 16px;
            }

            .hero-content h1 {
                font-size: 1.75rem;
            }

            .hero-content p {
                font-size: 0.938rem;
            }

            .container {
                margin: -30px auto 30px;
            }
        }
    </style>
</head>

<body>

<!-- TOP BAR -->
<div class="top-bar">
    <div class="top-bar-left">
        <div class="top-bar-item">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
            </svg>
            <span>(024) 6710024</span>
        </div>
        <div class="top-bar-item">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            <span>pedurungan@semarangkota.go.id</span>
        </div>
    </div>
    <div class="top-bar-item">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <span>{{ now()->format('l, d F Y') }}</span>
    </div>
</div>

<!-- NAVBAR -->
<nav class="navbar" x-data="{ mobileMenuOpen: false }">
    <div class="navbar-left">
        <div class="logo-section">
            <img src="{{ asset('build/images/logosemkot.png') }}" alt="Logo Kota Semarang" class="logo-icon">
            <span class="logo-text">
                PEDUPA
                <span class="admin-badge">ADMIN</span>
            </span>
        </div>

        <button class="mobile-menu-btn" @click="mobileMenuOpen = !mobileMenuOpen" type="button">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

        <div class="nav-menu" :class="{ 'show': mobileMenuOpen }">
            <a href="{{ route('admin.dashboard') }}" class="nav-link active">Dashboard</a>
            <a href="{{ route('admin.surats.index') }}" class="nav-link">Surat Online</a>
            <a href="{{ route('admin.pengaduans.index') }}" class="nav-link">Pengaduan</a>
            <a href="#" class="nav-link">Manajemen User</a>
        </div>
    </div>

    <div class="profile-section" x-data="{ open: false }">
        <button class="profile-btn" :class="{ 'active': open }" @click="open = !open" type="button">
            <div class="profile-avatar">
                A
            </div>
            <span class="profile-name">Admin</span>
            <svg class="dropdown-icon" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
            </svg>
        </button>

        <div class="dropdown-menu" x-show="open" @click.outside="open = false" x-transition>
            <a href="#" class="dropdown-item">
                <svg style="width: 16px; height: 16px; display: inline; margin-right: 8px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Profil Admin
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item logout">
                    <svg style="width: 16px; height: 16px; display: inline; margin-right: 8px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Keluar
                </button>
            </form>
        </div>
    </div>
</nav>

<!-- HERO SECTION -->
<section class="hero-section">
    <div class="hero-content">
        <h1>Dashboard Administrator</h1>
        <p>Sistem Manajemen Layanan Digital Kecamatan Pedurungan - Kelola Pengajuan Surat dan Pengaduan Masyarakat</p>
    </div>
</section>

<!-- MAIN CONTENT -->
<div class="container">

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="alert-text">{{ session('success') }}</span>
        </div>
    @endif

</div>

</body>
</html>
