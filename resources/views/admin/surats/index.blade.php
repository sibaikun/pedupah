<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedupa - Manajemen Surat Online</title>

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

        /* Container */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 32px 24px;
        }

        /* Page Header */
        .page-header {
            background: white;
            border-radius: 12px;
            padding: 32px;
            margin-bottom: 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .page-header h1 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 8px;
        }

        .page-header p {
            font-size: 0.938rem;
            color: #6b7280;
        }

        /* Filter Section */
        .filter-section {
            background: white;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            align-items: end;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .filter-label {
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
        }

        .filter-input,
        .filter-select {
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 0.875rem;
            color: #1f2937;
            transition: border-color 0.2s;
        }

        .filter-input:focus,
        .filter-select:focus {
            outline: none;
            border-color: #b83232;
        }

        .filter-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3E%3Cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3E%3C/svg%3E");
            background-position: right 8px center;
            background-repeat: no-repeat;
            background-size: 20px;
            padding-right: 40px;
        }

        .btn-filter {
            background: #b83232;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-filter:hover {
            background: #8b2424;
        }

        .btn-reset {
            background: #6b7280;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-reset:hover {
            background: #4b5563;
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

        .table-count {
            font-size: 0.875rem;
            color: #6b7280;
            background: #f3f4f6;
            padding: 4px 12px;
            border-radius: 999px;
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
            padding: 14px 16px;
            text-align: left;
            font-size: 0.875rem;
            font-weight: 600;
            color: white;
        }

        tbody td {
            padding: 16px;
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

        .btn-action {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.813rem;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            margin-right: 4px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-view {
            background: #3b82f6;
            color: white;
        }

        .btn-view:hover {
            background: #2563eb;
        }

        .btn-approve {
            background: #10b981;
            color: white;
        }

        .btn-approve:hover {
            background: #059669;
        }

        .btn-reject {
            background: #ef4444;
            color: white;
        }

        .btn-reject:hover {
            background: #dc2626;
        }

        .empty-state {
            text-align: center;
            padding: 60px 24px;
            color: #9ca3af;
        }

        .empty-state svg {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            opacity: 0.3;
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

        .alert-error {
            border-left-color: #ef4444;
        }

        .alert-error svg {
            color: #ef4444;
        }

        .alert-error .alert-text {
            color: #991b1b;
        }

        /* User Info */
        .user-info {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 600;
            color: #6b7280;
        }

        .user-details {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-weight: 600;
            color: #1f2937;
        }

        .user-email {
            font-size: 0.75rem;
            color: #9ca3af;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            padding: 20px;
        }

        .pagination a,
        .pagination span {
            padding: 8px 12px;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            font-size: 0.875rem;
            color: #374151;
            text-decoration: none;
            transition: all 0.2s;
        }

        .pagination a:hover {
            background: #f9fafb;
            border-color: #b83232;
            color: #b83232;
        }

        .pagination .active {
            background: #b83232;
            color: white;
            border-color: #b83232;
        }

        .pagination .disabled {
            opacity: 0.5;
            cursor: not-allowed;
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

            .container {
                padding: 20px 16px;
            }

            .filter-grid {
                grid-template-columns: 1fr;
            }

            .table-wrapper {
                overflow-x: scroll;
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
            <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
            <a href="{{ route('admin.surats.index') }}" class="nav-link active">Surat Online</a>
            <a href="{{ route('admin.pengaduans.index') }}" class="nav-link">Pengaduan</a>
            <a href="#" class="nav-link">Manajemen User</a>
        </div>
    </div>

    <div class="profile-section" x-data="{ open: false }">
        <button class="profile-btn" :class="{ 'active': open }" @click="open = !open" type="button">
            <div class="profile-avatar">A</div>
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

    <!-- Error Alert -->
    @if(session('error'))
        <div class="alert alert-error">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="alert-text">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Page Header -->
    <div class="page-header">
        <h1>Manajemen Surat Online</h1>
        <p>Kelola semua pengajuan surat dari masyarakat Kecamatan Pedurungan</p>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <form method="GET" action="{{ route('admin.surats.index') }}">
            <div class="filter-grid">
                <div class="filter-group">
                    <label class="filter-label">Cari Nama/NIK</label>
                    <input type="text" name="search" class="filter-input" placeholder="Ketik nama atau NIK..." value="{{ request('search') }}">
                </div>

                <div class="filter-group">
                    <label class="filter-label">Jenis Surat</label>
                    <select name="jenis_surat" class="filter-select">
                        <option value="">Semua Jenis</option>
                        <option value="Surat Keterangan Domisili" {{ request('jenis_surat') == 'Surat Keterangan Domisili' ? 'selected' : '' }}>Surat Keterangan Domisili</option>
                        <option value="Surat Keterangan Usaha" {{ request('jenis_surat') == 'Surat Keterangan Usaha' ? 'selected' : '' }}>Surat Keterangan Usaha</option>
                        <option value="Surat Pengantar SKCK" {{ request('jenis_surat') == 'Surat Pengantar SKCK' ? 'selected' : '' }}>Surat Pengantar SKCK</option>
                        <option value="Surat Keterangan Tidak Mampu" {{ request('jenis_surat') == 'Surat Keterangan Tidak Mampu' ? 'selected' : '' }}>Surat Keterangan Tidak Mampu</option>
                        <option value="Lainnya" {{ request('jenis_surat') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label class="filter-label">Status</label>
                    <select name="status" class="filter-select">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label class="filter-label">&nbsp;</label>
                    <button type="submit" class="btn-filter">
                        <svg style="width: 16px; height: 16px; display: inline; margin-right: 6px; vertical-align: middle;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                        </svg>
                        Filter
                    </button>
                </div>

                @if(request()->hasAny(['search', 'jenis_surat', 'status']))
                <div class="filter-group">
                    <label class="filter-label">&nbsp;</label>
                    <a href="{{ route('admin.surats.index') }}" class="btn-reset">Reset Filter</a>
                </div>
                @endif
            </div>
        </form>
    </div>

    <!-- Table Card -->
    <div class="table-card">
        <div class="table-header">
            <h2 class="table-title">Daftar Pengajuan Surat</h2>
            <span class="table-count">Total: {{ $surats->total() }} pengajuan</span>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pemohon</th>
                        <th>NIK</th>
                        <th>Jenis Surat</th>
                        <th>Keperluan</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($surats as $index => $surat)
                    <tr>
                        <td>{{ $surats->firstItem() + $index }}</td>
                        <td>
                            <div class="user-info">
                                <div class="user-avatar">
                                    {{ strtoupper(substr($surat->nama_pemohon, 0, 1)) }}
                                </div>
                                <div class="user-details">
                                    <span class="user-name">{{ $surat->nama_pemohon }}</span>
                                    <span class="user-email">{{ $surat->user->email ?? '-' }}</span>
                                </div>
                            </div>
                        </td>
                        <td>{{ $surat->nik }}</td>
                        <td style="font-weight: 500;">{{ $surat->jenis_surat }}</td>
                        <td>{{ Str::limit($surat->keperluan, 30) }}</td>
                        <td>{{ $surat->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            @if($surat->status === 'approved')
                                <span class="badge badge-approved">Disetujui</span>
                            @elseif($surat->status === 'pending')
                                <span class="badge badge-pending">Pending</span>
                            @else
                                <span class="badge badge-rejected">Ditolak</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.surats.show', $surat->id) }}" class="btn-action btn-view">
                                Detail
                            </a>
                            @if($surat->status === 'pending')
                            <form method="POST" action="{{ route('admin.surats.approve', $surat->id) }}" style="display: inline;" onsubmit="return confirm('Setujui pengajuan ini?')">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn-action btn-approve">
                                    Setujui
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.surats.reject', $surat->id) }}" style="display: inline;" onsubmit="return confirm('Tolak pengajuan ini?')">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn-action btn-reject">
                                    Tolak
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">
                            <div class="empty-state">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p>Tidak Ada Data Pengajuan</p>
                                <small>Data pengajuan surat akan muncul di sini</small>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($surats->hasPages())
        <div class="pagination">
            {{-- Previous Page Link --}}
            @if ($surats->onFirstPage())
                <span class="disabled">&laquo; Sebelumnya</span>
            @else
                <a href="{{ $surats->previousPageUrl() }}">&laquo; Sebelumnya</a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($surats->getUrlRange(1, $surats->lastPage()) as $page => $url)
                @if ($page == $surats->currentPage())
                    <span class="active">{{ $page }}</span>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($surats->hasMorePages())
                <a href="{{ $surats->nextPageUrl() }}">Selanjutnya &raquo;</a>
            @else
                <span class="disabled">Selanjutnya &raquo;</span>
            @endif
        </div>
        @endif
    </div>

</div>

</body>
</html>