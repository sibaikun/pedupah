<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detail Pengajuan Surat - {{ $surat->jenis_surat }}</title>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f5f5; min-height: 100vh; }
        
        /* Top Bar & Navbar */
        .top-bar { background: #b83232; color: white; padding: 8px 32px; display: flex; justify-content: space-between; align-items: center; font-size: 0.813rem; }
        .top-bar-left { display: flex; gap: 24px; }
        .top-bar-item { display: flex; align-items: center; gap: 8px; }
        .top-bar-item svg { width: 14px; height: 14px; }
        
        .navbar { background: white; border-bottom: 2px solid #e5e7eb; padding: 16px 32px; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .navbar-left { display: flex; align-items: center; gap: 40px; }
        .logo-section { display: flex; align-items: center; gap: 12px; }
        .logo-icon { width: 50px; height: 50px; object-fit: contain; }
        .logo-text { font-size: 1.125rem; font-weight: 700; color: #b83232; }
        .admin-badge { background: #b83232; color: white; padding: 4px 12px; border-radius: 999px; font-size: 0.75rem; font-weight: 600; margin-left: 8px; }
        .nav-menu { display: flex; gap: 8px; align-items: center; }
        .nav-link { font-size: 0.875rem; font-weight: 500; color: #374151; text-decoration: none; padding: 10px 16px; border-radius: 6px; transition: all 0.2s; }
        .nav-link:hover { color: #b83232; background: #fef2f2; }
        .nav-link.active { color: white; background: #b83232; }
        
        .profile-section { position: relative; }
        .profile-btn { background: none; border: none; cursor: pointer; display: flex; align-items: center; gap: 8px; padding: 8px 12px; border-radius: 6px; transition: background 0.2s; border: 1px solid #e5e7eb; }
        .profile-btn:hover { background: #f9fafb; }
        .profile-avatar { width: 32px; height: 32px; border-radius: 50%; background: #b83232; display: flex; align-items: center; justify-content: center; color: white; font-size: 0.875rem; font-weight: 600; }
        .profile-name { font-size: 0.875rem; font-weight: 500; color: #1f2937; }
        .dropdown-icon { width: 14px; height: 14px; transition: transform 0.2s; }
        .profile-btn.active .dropdown-icon { transform: rotate(180deg); }
        .dropdown-menu { position: absolute; right: 0; top: 100%; margin-top: 8px; width: 180px; background: white; border: 1px solid #e5e7eb; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); overflow: hidden; z-index: 1000; }
        .dropdown-item { display: block; width: 100%; padding: 12px 16px; font-size: 0.875rem; color: #374151; text-align: left; border: none; background: none; cursor: pointer; text-decoration: none; transition: background 0.2s; }
        .dropdown-item:hover { background: #f9fafb; }
        .dropdown-item.logout { color: #dc2626; border-top: 1px solid #f3f4f6; }
        
        .container { max-width: 1200px; margin: 0 auto; padding: 32px 24px; }
        
        /* Back Button */
        .back-btn { display: inline-flex; align-items: center; gap: 8px; color: #6b7280; text-decoration: none; font-size: 0.875rem; font-weight: 500; padding: 8px 16px; border-radius: 6px; transition: all 0.2s; margin-bottom: 20px; }
        .back-btn:hover { background: white; color: #b83232; }
        .back-btn svg { width: 18px; height: 18px; }
        
        /* Alert */
        .alert { background: white; border-left: 4px solid #10b981; padding: 16px 20px; border-radius: 8px; margin-bottom: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); display: flex; align-items: center; gap: 12px; }
        .alert svg { width: 24px; height: 24px; color: #10b981; flex-shrink: 0; }
        .alert-text { color: #065f46; font-size: 0.938rem; font-weight: 500; }
        
        /* Detail Card */
        .detail-card { background: white; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); overflow: hidden; margin-bottom: 24px; }
        
        .detail-header { padding: 24px; border-bottom: 1px solid #e5e7eb; background: linear-gradient(135deg, #b83232 0%, #8b2424 100%); color: white; }
        .detail-title-row { display: flex; justify-content: space-between; align-items: start; gap: 16px; margin-bottom: 12px; }
        .detail-title { font-size: 1.75rem; font-weight: 700; }
        .detail-subtitle { font-size: 0.938rem; opacity: 0.9; }
        
        .badge { display: inline-block; padding: 6px 16px; border-radius: 999px; font-size: 0.875rem; font-weight: 600; }
        .badge-pending { background: #fef3c7; color: #92400e; }
        .badge-approved { background: #d1fae5; color: #065f46; }
        .badge-rejected { background: #fee2e2; color: #991b1b; }
        
        .detail-body { padding: 32px; }
        
        .section { margin-bottom: 32px; }
        .section:last-child { margin-bottom: 0; }
        .section-title { font-size: 1.125rem; font-weight: 600; color: #1f2937; margin-bottom: 16px; padding-bottom: 8px; border-bottom: 2px solid #e5e7eb; display: flex; align-items: center; gap: 8px; }
        .section-title svg { width: 20px; height: 20px; color: #b83232; }
        
        .info-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; }
        .info-item { background: #f9fafb; padding: 16px; border-radius: 8px; border-left: 3px solid #b83232; }
        .info-label { font-size: 0.813rem; font-weight: 600; color: #6b7280; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px; }
        .info-value { font-size: 1rem; color: #1f2937; font-weight: 500; }
        
        .dokumen-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 16px; }
        .dokumen-item { background: #f9fafb; padding: 16px; border-radius: 8px; border: 1px solid #e5e7eb; transition: all 0.2s; }
        .dokumen-item:hover { border-color: #b83232; box-shadow: 0 2px 8px rgba(184, 50, 50, 0.1); }
        .dokumen-icon { width: 48px; height: 48px; background: #b83232; border-radius: 8px; display: flex; align-items: center; justify-content: center; margin-bottom: 12px; }
        .dokumen-icon svg { width: 24px; height: 24px; color: white; }
        .dokumen-name { font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 8px; }
        .dokumen-link { display: inline-flex; align-items: center; gap: 6px; font-size: 0.813rem; color: #b83232; text-decoration: none; font-weight: 500; }
        .dokumen-link:hover { text-decoration: underline; }
        .dokumen-link svg { width: 16px; height: 16px; }
        
        .no-dokumen { text-align: center; padding: 40px; color: #9ca3af; background: #f9fafb; border-radius: 8px; }
        .no-dokumen svg { width: 60px; height: 60px; margin: 0 auto 12px; opacity: 0.3; }
        
        .keperluan-box { background: #f9fafb; padding: 20px; border-radius: 8px; border-left: 4px solid #b83232; }
        .keperluan-text { font-size: 0.938rem; color: #374151; line-height: 1.7; white-space: pre-line; }
        
        .user-card { background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%); padding: 24px; border-radius: 8px; display: flex; align-items: center; gap: 20px; border: 1px solid #e5e7eb; }
        .user-avatar-large { width: 80px; height: 80px; border-radius: 50%; background: #b83232; display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: 700; color: white; box-shadow: 0 4px 12px rgba(184, 50, 50, 0.3); }
        .user-details { flex: 1; }
        .user-details h3 { font-size: 1.25rem; font-weight: 700; color: #1f2937; margin-bottom: 4px; }
        .user-details p { font-size: 0.875rem; color: #6b7280; margin-bottom: 2px; }
        .user-details .user-label { font-weight: 600; color: #374151; }
        
        .timeline { position: relative; padding-left: 32px; }
        .timeline::before { content: ''; position: absolute; left: 8px; top: 8px; bottom: 8px; width: 2px; background: #e5e7eb; }
        .timeline-item { position: relative; margin-bottom: 24px; }
        .timeline-item:last-child { margin-bottom: 0; }
        .timeline-dot { position: absolute; left: -28px; top: 4px; width: 16px; height: 16px; border-radius: 50%; background: white; border: 3px solid #b83232; z-index: 1; }
        .timeline-content { background: #f9fafb; padding: 16px; border-radius: 8px; }
        .timeline-date { font-size: 0.813rem; font-weight: 600; color: #b83232; margin-bottom: 4px; }
        .timeline-status { font-size: 0.938rem; font-weight: 600; color: #1f2937; }
        
        /* Action Buttons */
        .action-section { padding: 24px; background: #f9fafb; border-top: 1px solid #e5e7eb; }
        .action-buttons { display: flex; gap: 12px; flex-wrap: wrap; }
        
        .btn { padding: 12px 24px; border-radius: 6px; font-size: 0.875rem; font-weight: 600; border: none; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; justify-content: center; }
        .btn svg { width: 18px; height: 18px; }
        .btn-approve { background: #10b981; color: white; flex: 1; }
        .btn-approve:hover { background: #059669; }
        .btn-reject { background: #ef4444; color: white; flex: 1; }
        .btn-reject:hover { background: #dc2626; }
        .btn-print { background: #3b82f6; color: white; }
        .btn-print:hover { background: #2563eb; }
        
        @media (max-width: 768px) {
            .top-bar { padding: 8px 16px; font-size: 0.75rem; }
            .top-bar-left { gap: 12px; }
            .navbar { padding: 12px 16px; }
            .navbar-left { gap: 12px; }
            .nav-menu { display: none; }
            .container { padding: 20px 16px; }
            .detail-title { font-size: 1.25rem; }
            .detail-title-row { flex-direction: column; }
            .info-grid { grid-template-columns: 1fr; }
            .action-buttons { flex-direction: column; }
            .btn { width: 100%; flex: none; }
            .user-card { flex-direction: column; text-align: center; }
        }
    </style>
</head>
<body>

<!-- TOP BAR -->
<div class="top-bar">
    <div class="top-bar-left">
        <div class="top-bar-item">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            <span>(024) 6710024</span>
        </div>
        <div class="top-bar-item">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            <span>pedurungan@semarangkota.go.id</span>
        </div>
    </div>
    <div class="top-bar-item">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <span>{{ now()->format('l, d F Y') }}</span>
    </div>
</div>

<!-- NAVBAR -->
<nav class="navbar" x-data="{ mobileMenuOpen: false }">
    <div class="navbar-left">
        <div class="logo-section">
            <img src="{{ asset('build/images/logoicon.png') }}" alt="Logo Kota Semarang" class="logo-icon">
            <span class="logo-text">
                PEDUPA
                <span class="admin-badge">ADMIN</span>
            </span>
        </div>
        <div class="nav-menu">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
            <a href="{{ route('admin.surats.index') }}" class="nav-link active">Surat Online</a>
            <a href="{{ route('admin.surat-masuk.index') }}" class="nav-link">Surat Masuk</a>
            <a href="{{ route('admin.surat-keluar.index') }}" class="nav-link">Surat Keluar</a>
            <a href="{{ route('admin.pengaduans.index') }}" class="nav-link">Pengaduan</a>
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
        <div class="dropdown-menu" x-show="open" @click.outside="open = false" x-transition style="display: none;">
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

<!-- CONTENT -->
<div class="container">
    <a href="{{ route('admin.surats.index') }}" class="back-btn">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Daftar Surat
    </a>

    @if(session('success'))
    <div class="alert">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <span class="alert-text">{{ session('success') }}</span>
    </div>
    @endif

    <div class="detail-card">
        <!-- Header -->
        <div class="detail-header">
            <div class="detail-title-row">
                <div style="flex: 1;">
                    <h1 class="detail-title">{{ $surat->jenis_surat }}</h1>
                    <p class="detail-subtitle">ID Pengajuan: #{{ str_pad($surat->id, 6, '0', STR_PAD_LEFT) }}</p>
                </div>
                <span class="badge badge-{{ $surat->status }}">
                    @if($surat->status === 'approved')
                        Disetujui
                    @elseif($surat->status === 'pending')
                        Pending
                    @else
                        Ditolak
                    @endif
                </span>
            </div>
        </div>

        <!-- Body -->
        <div class="detail-body">
            
            <!-- Data Pemohon -->
            <div class="section">
                <h2 class="section-title">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Data Pemohon
                </h2>
                <div class="user-card">
                    <div class="user-avatar-large">
                        {{ strtoupper(substr($surat->nama_pemohon, 0, 1)) }}
                    </div>
                    <div class="user-details">
                        <h3>{{ $surat->nama_pemohon }}</h3>
                        <p><span class="user-label">NIK:</span> {{ $surat->nik }}</p>
                        <p><span class="user-label">Email:</span> {{ $surat->user->email ?? '-' }}</p>
                        <p><span class="user-label">Diajukan:</span> {{ $surat->created_at->format('d F Y, H:i') }} WIB</p>
                    </div>
                </div>
            </div>

            <!-- Informasi Surat -->
            <div class="section">
                <h2 class="section-title">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Informasi Surat
                </h2>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Jenis Surat</div>
                        <div class="info-value">{{ $surat->jenis_surat }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Alamat</div>
                        <div class="info-value">{{ $surat->alamat ?? '-' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">No. Telepon</div>
                        <div class="info-value">{{ $surat->nomor_telepon ?? '-' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Tanggal Pengajuan</div>
                        <div class="info-value">{{ $surat->created_at->format('d F Y') }}</div>
                    </div>
                </div>
            </div>

            <!-- Keperluan -->
            <div class="section">
                <h2 class="section-title">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    Keperluan
                </h2>
                <div class="keperluan-box">
                    <p class="keperluan-text">{{ $surat->keperluan }}</p>
                </div>
            </div>

            <!-- Dokumen Pendukung -->
            <div class="section">
                <h2 class="section-title">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                    Dokumen Pendukung
                </h2>
                @if($surat->file_pendukung)
                <div class="dokumen-grid">
                    <div class="dokumen-item">
                        <div class="dokumen-icon">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        </div>
                        <div class="dokumen-name">Dokumen Pendukung</div>
                        <a href="{{ asset('storage/' . $surat->file_pendukung) }}" target="_blank" class="dokumen-link">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Lihat File
                        </a>
                    </div>
                </div>
                @else
                <div class="no-dokumen">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <p>Tidak ada dokumen pendukung</p>
                </div>
                @endif
            </div>

            <!-- Timeline Status -->
            <div class="section">
                <h2 class="section-title">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Riwayat Status
                </h2>
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <div class="timeline-date">{{ $surat->created_at->format('d F Y, H:i') }} WIB</div>
                            <div class="timeline-status">Pengajuan Diterima</div>
                        </div>
                    </div>
                    @if($surat->status === 'approved')
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <div class="timeline-date">{{ $surat->updated_at->format('d F Y, H:i') }} WIB</div>
                            <div class="timeline-status">✓ Pengajuan Disetujui</div>
                        </div>
                    </div>
                    @elseif($surat->status === 'rejected')
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <div class="timeline-date">{{ $surat->updated_at->format('d F Y, H:i') }} WIB</div>
                            <div class="timeline-status">✗ Pengajuan Ditolak</div>
                        </div>
                    </div>
                    @else
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <div class="timeline-status">Menunggu Persetujuan Admin...</div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

        </div>

        <!-- Actions -->
        @if($surat->status === 'pending')
        <div class="action-section">
            <div class="action-buttons">
                <form method="POST" action="{{ route('admin.surats.approve', $surat->id) }}" style="flex: 1;" onsubmit="return confirm('Setujui pengajuan surat ini?')">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-approve" style="width: 100%;">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Setujui
                    </button>
                </form>
                <form method="POST" action="{{ route('admin.surats.reject', $surat->id) }}" style="flex: 1;" onsubmit="return confirm('Tolak pengajuan surat ini?')">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-reject" style="width: 100%;">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        Tolak
                    </button>
                </form>
            </div>
        </div>
        @elseif($surat->status === 'approved')
        <div class="action-section">
            <div class="action-buttons">
                <a href="{{ route('admin.surats.print', $surat->id) }}" target="_blank" class="btn btn-print">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                    Cetak Surat
                </a>
            </div>
        </div>
        @endif
    </div>

</div>

</body>
</html>