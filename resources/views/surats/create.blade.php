<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pengajuan Surat</title>

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

        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 32px 24px;
        }

        .form-card {
            background: white;
            border-radius: 12px;
            padding: 32px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .form-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 24px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }

        label .required {
            color: #dc2626;
        }

        input[type="text"],
        input[type="date"],
        input[type="tel"],
        textarea,
        select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 0.875rem;
            color: #1f2937;
            transition: border-color 0.2s;
        }

        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #b83232;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3E%3Cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3E%3C/svg%3E");
            background-position: right 8px center;
            background-repeat: no-repeat;
            background-size: 20px;
            padding-right: 40px;
        }

        .file-input-wrapper {
            position: relative;
        }

        .file-input-wrapper input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .file-input-display {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .file-btn {
            padding: 8px 16px;
            background: #f3f4f6;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 0.875rem;
            color: #374151;
            cursor: pointer;
            white-space: nowrap;
        }

        .file-name {
            font-size: 0.875rem;
            color: #6b7280;
        }

        .alert {
            background: #dcfce7;
            border: 1px solid #86efac;
            color: #166534;
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 0.875rem;
        }

        .error {
            background: #fee2e2;
            border: 1px solid #fca5a5;
            color: #991b1b;
        }

        .button-group {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .btn-submit {
            background: #b83232;
            color: white;
            padding: 10px 24px;
            border: none;
            border-radius: 6px;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-submit:hover {
            background: #8b2424;
        }

        .btn-back {
            background: #6b7280;
            color: white;
            padding: 10px 24px;
            border: none;
            border-radius: 6px;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: background 0.2s;
        }

        .btn-back:hover {
            background: #4b5563;
        }

        .dropdown-item {
            display: block;
            width: 100%;
            padding: 10px 16px;
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
            background: #f3f4f6;
        }

        .dropdown-item.logout {
            color: #dc2626;
        }

        .dropdown-item.logout:hover {
            background: #fef2f2;
        }

        .error-list {
            list-style: disc;
            margin-left: 20px;
        }

        .error-list li {
            margin-bottom: 4px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px 16px;
            }

            .form-card {
                padding: 20px;
            }

            .navbar {
                padding: 16px;
            }

            .button-group {
                flex-direction: column-reverse;
                width: 100%;
            }

            .btn-submit,
            .btn-back {
                width: 100%;
                text-align: center;
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
    <div class="form-card">
        <h1 class="form-title">Buat Pengajuan Surat</h1>

        {{-- Alert Success --}}
        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        {{-- Alert Error --}}
        @if($errors->any())
            <div class="alert error">
                <strong>Terjadi kesalahan:</strong>
                <ul class="error-list">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('surats.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Nama Pemohon <span class="required">*</span></label>
                <input type="text" name="nama_pemohon" value="{{ old('nama_pemohon') }}" required>
                @error('nama_pemohon')
                    <span style="color: #dc2626; font-size: 0.75rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>NIK <span class="required">*</span></label>
                <input type="text" name="nik" value="{{ old('nik') }}" required maxlength="16" pattern="[0-9]{16}" title="NIK harus 16 digit angka">
                @error('nik')
                    <span style="color: #dc2626; font-size: 0.75rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Alamat <span class="required">*</span></label>
                <textarea name="alamat" required>{{ old('alamat') }}</textarea>
                @error('alamat')
                    <span style="color: #dc2626; font-size: 0.75rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Nomor Telepon <span class="required">*</span></label>
                <input type="tel" name="nomor_telepon" value="{{ old('nomor_telepon') }}" required pattern="[0-9]{10,13}" title="Nomor telepon harus 10-13 digit">
                @error('nomor_telepon')
                    <span style="color: #dc2626; font-size: 0.75rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Tanggal Lahir <span class="required">*</span></label>
                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                @error('tanggal_lahir')
                    <span style="color: #dc2626; font-size: 0.75rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Tempat Lahir <span class="required">*</span></label>
                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
                @error('tempat_lahir')
                    <span style="color: #dc2626; font-size: 0.75rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Jenis Kelamin <span class="required">*</span></label>
                <select name="jenis_kelamin" required>
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jenis_kelamin')
                    <span style="color: #dc2626; font-size: 0.75rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Jenis Surat <span class="required">*</span></label>
                <select name="jenis_surat" id="jenisSurat" required>
                    <option value="">-- Pilih Jenis Surat --</option>
                    <option value="Surat Keterangan Domisili" {{ old('jenis_surat') == 'Surat Keterangan Domisili' ? 'selected' : '' }}>Surat Keterangan Domisili</option>
                    <option value="Surat Keterangan Usaha" {{ old('jenis_surat') == 'Surat Keterangan Usaha' ? 'selected' : '' }}>Surat Keterangan Usaha</option>
                    <option value="Surat Pengantar SKCK" {{ old('jenis_surat') == 'Surat Pengantar SKCK' ? 'selected' : '' }}>Surat Pengantar SKCK</option>
                    <option value="Surat Keterangan Tidak Mampu" {{ old('jenis_surat') == 'Surat Keterangan Tidak Mampu' ? 'selected' : '' }}>Surat Keterangan Tidak Mampu</option>
                    <option value="Lainnya" {{ old('jenis_surat') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
                @error('jenis_surat')
                    <span style="color: #dc2626; font-size: 0.75rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Keperluan <span class="required">*</span></label>
                <textarea name="keperluan" required>{{ old('keperluan') }}</textarea>
                @error('keperluan')
                    <span style="color: #dc2626; font-size: 0.75rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Upload File Pendukung <span class="required">*</span></label>
                <div class="file-input-wrapper">
                    <input type="file" name="file_pendukung" id="filePendukung" accept=".pdf,.jpg,.jpeg,.png" required onchange="updateFileName(this)">
                    <div class="file-input-display">
                        <div class="file-btn">Pilih File</div>
                        <span class="file-name" id="fileName">Tidak ada file yang dipilih</span>
                    </div>
                </div>
                @error('file_pendukung')
                    <span style="color: #dc2626; font-size: 0.75rem;">{{ $message }}</span>
                @enderror
                <small style="color: #6b7280; font-size: 0.75rem; display: block; margin-top: 4px;">Format: PDF, JPG, JPEG, PNG (Maks. 2MB)</small>
            </div>

            <div class="button-group">
                <a href="{{ route('surats.index') }}" class="btn-back">Kembali</a>
                <button type="submit" class="btn-submit">Kirim Pengajuan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function updateFileName(input) {
        const fileName = document.getElementById('fileName');
        if (input.files && input.files[0]) {
            fileName.textContent = input.files[0].name;
        } else {
            fileName.textContent = 'Tidak ada file yang dipilih';
        }
    }
</script>

</body>
</html>
