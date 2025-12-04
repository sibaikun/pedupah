<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedupa - Ajukan Pengaduan</title>

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
            background: linear-gradient(180deg, #4169e1 0%, #5a7de6 50%, #7b68ee 100%);
            min-height: 100vh;
        }

        /* Navbar */
        .navbar {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            padding: 16px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 32px;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }

        .logo-text {
            font-size: 1rem;
            font-weight: 600;
            color: #1f2937;
        }

        .nav-menu {
            display: flex;
            gap: 24px;
            align-items: center;
        }

        .nav-link {
            font-size: 0.875rem;
            font-weight: 500;
            color: #6b7280;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 6px;
            transition: all 0.2s;
        }

        .nav-link:hover {
            color: #1f2937;
            background: #f3f4f6;
        }

        .nav-link.active {
            color: #5b6cf0;
            background: #eef2ff;
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
            padding: 4px 8px;
            border-radius: 6px;
            transition: background 0.2s;
        }

        .profile-btn:hover {
            background: #f3f4f6;
        }

        .profile-name {
            font-size: 0.875rem;
            font-weight: 500;
            color: #1f2937;
        }

        .dropdown-icon {
            width: 16px;
            height: 16px;
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
            width: 160px;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            overflow: hidden;
            z-index: 1000;
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
            border-color: #3b82f6;
        }

        textarea {
            resize: vertical;
            min-height: 120px;
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

        .file-preview {
            margin-top: 12px;
            max-width: 300px;
            border-radius: 8px;
            overflow: hidden;
        }

        .file-preview img {
            width: 100%;
            height: auto;
            display: block;
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

        .error-list {
            list-style: disc;
            margin-left: 20px;
        }

        .error-list li {
            margin-bottom: 4px;
        }

        .button-group {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .btn-submit {
            background: #3b82f6;
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
            background: #2563eb;
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

            .container {
                padding: 20px 16px;
            }

            .form-card {
                padding: 20px;
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

<!-- NAVBAR -->
<nav class="navbar" x-data="{ mobileMenuOpen: false }">
    <div class="navbar-left">
        <div class="logo-section">
            <img src="{{ asset('build/images/logosemkot.png') }}" alt="Logo Kota Semarang" class="logo-icon">
            <span class="logo-text">Pedupa</span>
        </div>

        <button class="mobile-menu-btn" @click="mobileMenuOpen = !mobileMenuOpen" type="button">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

        <div class="nav-menu" :class="{ 'show': mobileMenuOpen }">
            <a href="{{ route('dashboard') }}" class="nav-link">Beranda</a>
            <a href="{{ route('surats.index') }}" class="nav-link">Surat Online</a>
            <a href="{{ route('pengaduans.index') }}" class="nav-link active">Pengaduan</a>
        </div>
    </div>

    <div class="profile-section" x-data="{ open: false }">
        <button class="profile-btn" :class="{ 'active': open }" @click="open = !open" type="button">
            <span class="profile-name">{{ auth()->user()->name }}</span>
            <svg class="dropdown-icon" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
            </svg>
        </button>

        <div class="dropdown-menu" x-show="open" @click.outside="open = false" x-transition>
            <a href="{{ route('profile.edit') }}" class="dropdown-item">Profil</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item logout">Log Out</button>
            </form>
        </div>
    </div>
</nav>

<!-- MAIN CONTENT -->
<div class="container">
    <div class="form-card">
        <h1 class="form-title">Ajukan Pengaduan</h1>

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

        <form action="{{ route('pengaduans.store') }}" method="POST" enctype="multipart/form-data" x-data="{ imagePreview: null }">
            @csrf

            <div class="form-group">
                <label>Judul Pengaduan <span class="required">*</span></label>
                <input type="text" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Jalan Rusak di RT 05" required>
                @error('judul')
                    <span style="color: #dc2626; font-size: 0.75rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Kategori <span class="required">*</span></label>
                <select name="kategori" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Infrastruktur" {{ old('kategori') == 'Infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
                    <option value="Kebersihan" {{ old('kategori') == 'Kebersihan' ? 'selected' : '' }}>Kebersihan</option>
                    <option value="Keamanan" {{ old('kategori') == 'Keamanan' ? 'selected' : '' }}>Keamanan</option>
                    <option value="Layanan Publik" {{ old('kategori') == 'Layanan Publik' ? 'selected' : '' }}>Layanan Publik</option>
                    <option value="Kesehatan" {{ old('kategori') == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                    <option value="Pendidikan" {{ old('kategori') == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                    <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
                @error('kategori')
                    <span style="color: #dc2626; font-size: 0.75rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Deskripsi Pengaduan <span class="required">*</span></label>
                <textarea name="deskripsi" placeholder="Jelaskan detail pengaduan Anda..." required>{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <span style="color: #dc2626; font-size: 0.75rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Lokasi <span class="required">*</span></label>
                <input type="text" name="lokasi" value="{{ old('lokasi') }}" placeholder="Contoh: Jl. Pedurungan Tengah RT 05 RW 03" required>
                @error('lokasi')
                    <span style="color: #dc2626; font-size: 0.75rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Upload Foto (Opsional)</label>
                <div class="file-input-wrapper">
                    <input 
                        type="file" 
                        name="foto" 
                        id="fotoInput" 
                        accept="image/jpeg,image/jpg,image/png" 
                        @change="const file = $event.target.files[0]; if(file) { const reader = new FileReader(); reader.onload = (e) => imagePreview = e.target.result; reader.readAsDataURL(file); updateFileName($event.target); }"
                    >
                    <div class="file-input-display">
                        <div class="file-btn">Pilih Foto</div>
                        <span class="file-name" id="fileName">Tidak ada file yang dipilih</span>
                    </div>
                </div>
                @error('foto')
                    <span style="color: #dc2626; font-size: 0.75rem;">{{ $message }}</span>
                @enderror
                <small style="color: #6b7280; font-size: 0.75rem; display: block; margin-top: 4px;">Format: JPG, JPEG, PNG (Maks. 2MB)</small>
                
                <!-- Image Preview -->
                <div class="file-preview" x-show="imagePreview" x-cloak>
                    <img :src="imagePreview" alt="Preview">
                </div>
            </div>

            <div class="button-group">
                <a href="{{ route('pengaduans.index') }}" class="btn-back">Kembali</a>
                <button type="submit" class="btn-submit">Kirim Pengaduan</button>
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

<style>
    [x-cloak] {
        display: none !important;
    }
</style>

</body>
</html>