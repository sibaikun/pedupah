<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedupa - Pengajuan Surat Online</title>

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
            background: linear-gradient(180deg, #b83232 0%, #8b2424 50%, #a52a2a 100%);
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

        /* Main Content */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 32px 24px;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 32px;
            margin-bottom: 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 32px;
        }

        .title-section h1 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 4px;
        }

        .subtitle {
            font-size: 0.875rem;
            color: #6b7280;
        }

        .subtitle strong {
            font-weight: 600;
            color: #1f2937;
        }

        .btn-primary {
            background: #b83232;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.875rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s;
        }

        .btn-primary:hover {
            background: #8b2424;
        }

        .btn-primary svg {
            width: 16px;
            height: 16px;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
        }

        .stat-card {
            padding: 24px;
            border-radius: 12px;
        }

        .stat-card.pending {
            background: linear-gradient(135deg, #fff9e6 0%, #fff3cc 100%);
        }

        .stat-card.approved {
            background: linear-gradient(135deg, #e6fff0 0%, #ccffd8 100%);
        }

        .stat-label {
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 8px;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 4px;
        }

        .stat-desc {
            font-size: 0.75rem;
            color: #6b7280;
        }

        /* Table Card */
        .table-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .table-header {
            padding: 20px 24px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1f2937;
        }

        .search-input {
            padding: 8px 16px;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            font-size: 0.875rem;
            width: 250px;
        }

        .search-input::placeholder {
            color: #9ca3af;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #b83232;
        }

        thead th {
            padding: 14px 24px;
            text-align: left;
            font-size: 0.875rem;
            font-weight: 600;
            color: white;
            text-transform: capitalize;
        }

        tbody td {
            padding: 16px 24px;
            font-size: 0.875rem;
            color: #374151;
            border-bottom: 1px solid #f3f4f6;
        }

        tbody tr:hover {
            background: #f9fafb;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-approved {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-rejected {
            background: #fee2e2;
            color: #991b1b;
        }

        .empty-state {
            text-align: center;
            padding: 48px 24px;
            color: #9ca3af;
        }

        @media (max-width: 768px) {
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

            .navbar {
                flex-wrap: wrap;
                position: relative;
            }

            .navbar-left {
                width: 100%;
                justify-content: space-between;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .card-header {
                flex-direction: column;
                gap: 16px;
            }

            .search-input {
                width: 100%;
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
</div>

<!-- NAVBAR -->
<nav class="navbar" x-data="{ mobileMenuOpen: false }">
    <div class="navbar-left">
        <div class="logo-section">
            <img src="{{ asset('build/images/logoicon.png') }}" alt="Logo Kota Semarang" class="logo-icon">
            <span class="logo-text">PEDUPA</span>
        </div>

        <button class="mobile-menu-btn" @click="mobileMenuOpen = !mobileMenuOpen" type="button">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

        <div class="nav-menu" :class="{ 'show': mobileMenuOpen }">
            <a href="{{ route('dashboard') }}" class="nav-link">Beranda</a>
            <a href="{{ route('surats.index') }}" class="nav-link active">Surat Online</a>
            <a href="{{ route('pengaduans.index') }}" class="nav-link">Aduan</a>
        </div>
    </div>

    <div class="profile-section" x-data="{ open: false }">
        <button class="profile-btn" :class="{ 'active': open }" @click="open = !open" type="button">
            <div class="profile-avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <span class="profile-name">{{ auth()->user()->name }}</span>
            <svg class="dropdown-icon" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
            </svg>
        </button>

        <div class="dropdown-menu" x-show="open" @click.outside="open = false" x-transition>
            <a href="{{ route('profile.edit') }}" class="dropdown-item">
                <svg style="width: 16px; height: 16px; display: inline; margin-right: 8px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Profil Saya
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

<!-- MAIN CONTENT -->
<div class="container">
    <!-- Dashboard Card -->
    <div class="card">
        <div class="card-header">
            <div class="title-section">
                <h1>Dashboard User</h1>
                <p class="subtitle">Selamat datang, <strong>{{ auth()->user()->name }}</strong></p>
            </div>
            <a href="{{ route('surats.create') }}" class="btn-primary">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Ajukan Surat
            </a>
        </div>

        <div class="stats-grid">
            <div class="stat-card pending">
                <div class="stat-label">Pending</div>
                <div class="stat-number">{{ auth()->user()->suratPengajuans->where('status','pending')->count() }}</div>
                <div class="stat-desc">Menunggu diproses</div>
            </div>

            <div class="stat-card approved">
                <div class="stat-label">Approved</div>
                <div class="stat-number">{{ auth()->user()->suratPengajuans->where('status','approved')->count() }}</div>
                <div class="stat-desc">Telah disetujui</div>
            </div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="table-card">
        <div class="table-header">
            <h2 class="table-title">Riwayat Pengajuan</h2>
            <input type="search" placeholder="Cari pengajuan..." class="search-input">
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jenis Surat</th>
                        <th>Keperluan</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(auth()->user()->suratPengajuans as $i => $s)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td style="font-weight: 500;">{{ $s->jenis_surat }}</td>
                        <td>{{ $s->keperluan ?? '-' }}</td>
                        <td>
                            @if($s->status === 'approved')
                                <span class="badge badge-approved">Approved</span>
                            @elseif($s->status === 'pending')
                                <span class="badge badge-pending">Pending</span>
                            @else
                                <span class="badge badge-rejected">Rejected</span>
                            @endif
                        </td>
                        <td>{{ $s->created_at->format('d-m-Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">Belum ada pengajuan</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
