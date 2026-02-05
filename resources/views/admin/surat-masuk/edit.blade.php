<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pedupa - Edit Surat Masuk</title>
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

        .hero-section {
            background: linear-gradient(135deg, #b83232 0%, #8b2424 100%);
            color: white;
            padding: 40px 32px;
            text-align: center;
        }

        .hero-content h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .hero-content p {
            font-size: 1rem;
            opacity: 0.95;
        }

        .container {
            max-width: 1200px;
            margin: -20px auto 40px;
            padding: 0 24px;
            position: relative;
            z-index: 2;
        }

        .content-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        .content-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .card-header {
            padding: 20px 24px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .card-header svg {
            width: 24px;
            height: 24px;
        }

        .card-header.info {
            background: #eff6ff;
        }

        .card-header.info svg {
            color: #2563eb;
        }

        .card-header.edit {
            background: #fef3c7;
        }

        .card-header.edit svg {
            color: #d97706;
        }

        .card-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1f2937;
        }

        .card-body {
            padding: 24px;
        }

        /* Info Display Styles */
        .info-group {
            margin-bottom: 20px;
        }

        .info-label {
            font-size: 0.75rem;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .info-value {
            font-size: 0.938rem;
            color: #1f2937;
            padding: 8px 0;
        }

        .info-value.empty {
            color: #9ca3af;
            font-style: italic;
        }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .badge-success {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-warning {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-info {
            background: #dbeafe;
            color: #1e40af;
        }

        .file-info {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px;
            background: #f9fafb;
            border-radius: 6px;
            margin-top: 8px;
        }

        .file-info svg {
            width: 20px;
            height: 20px;
            color: #dc2626;
        }

        .file-link {
            color: #2563eb;
            text-decoration: none;
            font-size: 0.875rem;
        }

        .file-link:hover {
            text-decoration: underline;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 6px;
        }

        .form-label .required {
            color: #dc2626;
        }

        .form-control {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 0.875rem;
            font-family: inherit;
        }

        .form-control:focus {
            outline: none;
            border-color: #b83232;
            box-shadow: 0 0 0 3px rgba(184, 50, 50, 0.1);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        .form-help {
            font-size: 0.75rem;
            color: #6b7280;
            margin-top: 4px;
        }

        .invalid-feedback {
            display: block;
            font-size: 0.813rem;
            color: #dc2626;
            margin-top: 4px;
        }

        .is-invalid {
            border-color: #dc2626;
        }

        .current-file {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 12px;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 6px;
            margin-bottom: 8px;
            font-size: 0.875rem;
            color: #065f46;
        }

        .current-file svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 6px;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-primary {
            background: #b83232;
            color: white;
        }

        .btn-primary:hover {
            background: #9b2828;
        }

        .btn-secondary {
            background: #6b7280;
            color: white;
        }

        .btn-secondary:hover {
            background: #4b5563;
        }

        .card-footer {
            padding: 16px 24px;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            grid-column: 1 / -1;
        }

        .full-width-footer {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            overflow: hidden;
            margin-top: 24px;
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

        .divider {
            height: 1px;
            background: #e5e7eb;
            margin: 20px 0;
        }

        @media (max-width: 1024px) {
            .content-wrapper {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .top-bar {
                padding: 8px 16px;
                font-size: 0.75rem;
            }

            .top-bar-left {
                gap: 12px;
                flex-direction: column;
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
                padding: 0 16px;
            }

            .card-footer {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
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
        <span>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
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

        <button class="mobile-menu-btn" @click="mobileMenuOpen = !mobileMenuOpen" type="button">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

        <div class="nav-menu" :class="{ 'show': mobileMenuOpen }">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
            <a href="{{ route('admin.surats.index') }}" class="nav-link">Surat Online</a>
            <a href="{{ route('admin.surat-masuk.index') }}" class="nav-link active">Surat Masuk</a>
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

<!-- HERO SECTION -->
<section class="hero-section">
    <div class="hero-content">
        <h1>Edit Surat Masuk</h1>
        <p>Perbarui informasi surat masuk dari instansi lain</p>
    </div>
</section>

<!-- MAIN CONTENT -->
<div class="container">
    <div class="content-wrapper">
        
        <!-- LEFT COLUMN: DATA SEBELUMNYA -->
        <div class="content-card">
            <div class="card-header info">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h2 class="card-title">Data Sebelumnya</h2>
            </div>

            <div class="card-body">
                <div class="info-group">
                    <div class="info-label">Nomor Surat</div>
                    <div class="info-value">{{ $suratMasuk->nomor_surat }}</div>
                </div>

                <div class="info-group">
                    <div class="info-label">Tanggal Terima</div>
                    <div class="info-value">{{ $suratMasuk->tanggal_terima->format('d F Y') }}</div>
                </div>

                <div class="info-group">
                    <div class="info-label">Pengirim</div>
                    <div class="info-value">{{ $suratMasuk->pengirim }}</div>
                </div>

                <div class="info-group">
                    <div class="info-label">Perihal</div>
                    <div class="info-value">{{ $suratMasuk->perihal }}</div>
                </div>

                <div class="info-group">
                    <div class="info-label">Status</div>
                    <div class="info-value">
                        <span class="badge {{ $suratMasuk->status_badge }}">
                            {{ $suratMasuk->status_text }}
                        </span>
                    </div>
                </div>

                <div class="info-group">
                    <div class="info-label">Catatan</div>
                    <div class="info-value {{ $suratMasuk->catatan ? '' : 'empty' }}">
                        {{ $suratMasuk->catatan ?? 'Tidak ada catatan' }}
                    </div>
                </div>

                <div class="info-group">
                    <div class="info-label">File Surat</div>
                    @if($suratMasuk->file_path)
                        <div class="file-info">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                            <a href="{{ asset('storage/' . $suratMasuk->file_path) }}" target="_blank" class="file-link">
                                Lihat File PDF
                            </a>
                        </div>
                    @else
                        <div class="info-value empty">Tidak ada file</div>
                    @endif
                </div>

                <div class="divider"></div>

                <div class="info-group">
                    <div class="info-label">Dibuat Pada</div>
                    <div class="info-value">{{ $suratMasuk->created_at->format('d F Y, H:i') }} WIB</div>
                </div>

                <div class="info-group">
                    <div class="info-label">Terakhir Diubah</div>
                    <div class="info-value">{{ $suratMasuk->updated_at->format('d F Y, H:i') }} WIB</div>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN: FORM EDIT -->
        <div class="content-card">
            <div class="card-header edit">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                <h2 class="card-title">Form Edit Data</h2>
            </div>

            <form method="POST" action="{{ route('admin.surat-masuk.update', $suratMasuk->id) }}" enctype="multipart/form-data" id="editForm">
                @csrf
                @method('PUT')
                
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">
                            Nomor Surat <span class="required">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="nomor_surat" 
                            class="form-control @error('nomor_surat') is-invalid @enderror" 
                            value="{{ old('nomor_surat', $suratMasuk->nomor_surat) }}"
                            placeholder="Contoh: 001/SKP/I/2026"
                            required>
                        @error('nomor_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">
                            Tanggal Terima <span class="required">*</span>
                        </label>
                        <input 
                            type="date" 
                            name="tanggal_terima" 
                            class="form-control @error('tanggal_terima') is-invalid @enderror"
                            value="{{ old('tanggal_terima', $suratMasuk->tanggal_terima->format('Y-m-d')) }}"
                            required>
                        @error('tanggal_terima')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">
                            Pengirim <span class="required">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="pengirim" 
                            class="form-control @error('pengirim') is-invalid @enderror"
                            value="{{ old('pengirim', $suratMasuk->pengirim) }}"
                            placeholder="Nama instansi/lembaga pengirim"
                            required>
                        @error('pengirim')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">
                            Perihal <span class="required">*</span>
                        </label>
                        <textarea 
                            name="perihal" 
                            class="form-control @error('perihal') is-invalid @enderror"
                            placeholder="Perihal surat"
                            required>{{ old('perihal', $suratMasuk->perihal) }}</textarea>
                        @error('perihal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">
                            Status <span class="required">*</span>
                        </label>
                        <select 
                            name="status" 
                            class="form-control @error('status') is-invalid @enderror"
                            required>
                            <option value="pending" {{ old('status', $suratMasuk->status) == 'pending' ? 'selected' : '' }}>Belum Diproses</option>
                            <option value="processed" {{ old('status', $suratMasuk->status) == 'processed' ? 'selected' : '' }}>Sudah Diproses</option>
                            <option value="archived" {{ old('status', $suratMasuk->status) == 'archived' ? 'selected' : '' }}>Diarsipkan</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Catatan</label>
                        <textarea 
                            name="catatan" 
                            class="form-control @error('catatan') is-invalid @enderror"
                            placeholder="Catatan tambahan (opsional)">{{ old('catatan', $suratMasuk->catatan) }}</textarea>
                        @error('catatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Upload File Surat Baru (PDF)</label>
                        
                        @if($suratMasuk->file_path)
                            <div class="current-file">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>File saat ini ada. Upload file baru untuk menggantinya.</span>
                            </div>
                        @endif
                        
                        <input 
                            type="file" 
                            name="file" 
                            class="form-control @error('file') is-invalid @enderror"
                            accept=".pdf">
                        <div class="form-help">Maksimal 2MB, format PDF. Kosongkan jika tidak ingin mengganti file.</div>
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- FOOTER BUTTONS -->
    <div class="full-width-footer">
        <div class="card-footer">
            <a href="{{ route('admin.surat-masuk.index') }}" class="btn btn-secondary">
                <svg style="width: 18px; height: 18px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Batal
            </a>
            <button type="submit" form="editForm" class="btn btn-primary">
                <svg style="width: 18px; height: 18px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Simpan Perubahan
            </button>
        </div>
    </div>
</div>

</body>
</html>