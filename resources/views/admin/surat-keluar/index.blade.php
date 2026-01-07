<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedupa - Surat Keluar</title>
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
            background: #b83232;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
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
            cursor: pointer;
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
            max-width: 1400px;
            margin: -20px auto 40px;
            padding: 0 24px;
            position: relative;
            z-index: 2;
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
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1f2937;
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

        .btn-success {
            background: #10b981;
            color: white;
        }

        .btn-success:hover {
            background: #059669;
        }

        .btn-danger {
            background: #ef4444;
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .btn-info {
            background: #3b82f6;
            color: white;
        }

        .btn-info:hover {
            background: #2563eb;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 0.813rem;
        }

        .card-body {
            padding: 24px;
        }

        .search-filter {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .search-box {
            flex: 1;
            min-width: 250px;
            position: relative;
        }

        .search-box input {
            width: 100%;
            padding: 10px 16px 10px 40px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 0.875rem;
        }

        .search-box svg {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            color: #9ca3af;
        }

        .filter-select {
            padding: 10px 16px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 0.875rem;
            background: white;
            cursor: pointer;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #f9fafb;
        }

        th {
            padding: 12px 16px;
            text-align: left;
            font-size: 0.813rem;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            border-bottom: 2px solid #e5e7eb;
        }

        td {
            padding: 16px;
            font-size: 0.875rem;
            color: #374151;
            border-bottom: 1px solid #f3f4f6;
        }

        tbody tr:hover {
            background: #f9fafb;
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

        .badge-primary {
            background: #dbeafe;
            color: #1e40af;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 24px;
            border-top: 1px solid #e5e7eb;
        }

        .pagination-info {
            font-size: 0.875rem;
            color: #6b7280;
        }

        .pagination-buttons {
            display: flex;
            gap: 8px;
        }

        .pagination-btn {
            padding: 8px 12px;
            border: 1px solid #d1d5db;
            background: white;
            border-radius: 6px;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .pagination-btn:hover:not(:disabled) {
            background: #f9fafb;
            border-color: #b83232;
        }

        .pagination-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .pagination-btn.active {
            background: #b83232;
            color: white;
            border-color: #b83232;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal.show {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 12px;
            max-width: 600px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-header {
            padding: 20px 24px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1f2937;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #9ca3af;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
        }

        .modal-close:hover {
            background: #f3f4f6;
            color: #374151;
        }

        .modal-body {
            padding: 24px;
        }

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

        .form-control {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 0.875rem;
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

        .modal-footer {
            padding: 16px 24px;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }

        .btn-secondary {
            background: #6b7280;
            color: white;
        }

        .btn-secondary:hover {
            background: #4b5563;
        }

        @media (max-width: 768px) {
            .top-bar {
                padding: 8px 16px;
                font-size: 0.75rem;
            }

            .navbar {
                padding: 12px 16px;
            }

            .search-filter {
                flex-direction: column;
            }

            .search-box {
                min-width: 100%;
            }

            .table-container {
                font-size: 0.813rem;
            }

            th, td {
                padding: 10px 12px;
            }

            .action-buttons {
                flex-direction: column;
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
        <span>Selasa, 07 Januari 2026</span>
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
            <a href="{{ route('admin.surats.index') }}" class="nav-link">Surat Online</a>
            <a href="{{ route('admin.surat-masuk.index') }}" class="nav-link">Surat Masuk</a>
            <a href="{{ route('admin.surat-keluar.index') }}" class="nav-link active">Surat Keluar</a>
            <a href="{{ route('admin.pengaduans.index') }}" class="nav-link">Pengaduan</a>
        </div>
    </div>

    <div class="profile-section" x-data="{ open: false }">
        <button class="profile-btn" @click="open = !open" type="button">
            <div class="profile-avatar">A</div>
            <span class="profile-name">Admin</span>
            <svg class="dropdown-icon" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
            </svg>
        </button>

        <div class="dropdown-menu" x-show="open" @click.outside="open = false" x-transition style="display: none;">
            <a href="#" class="dropdown-item">Profil Admin</a>
            <button type="button" class="dropdown-item logout">Keluar</button>
        </div>
    </div>
</nav>

<!-- HERO SECTION -->
<section class="hero-section">
    <div class="hero-content">
        <h1>Surat Keluar</h1>
        <p>Kelola dan monitoring surat keluar ke instansi lain</p>
    </div>
</section>

<!-- MAIN CONTENT -->
<div class="container" x-data="suratKeluarApp()">
    <div class="content-card">
        <div class="card-header">
            <h2 class="card-title">Daftar Surat Keluar</h2>
            <button class="btn btn-primary" @click="openModal('add')">
                <svg style="width: 18px; height: 18px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Buat Surat Keluar
            </button>
        </div>

        <div class="card-body">
            <!-- Search & Filter -->
            <div class="search-filter">
                <div class="search-box">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" placeholder="Cari nomor surat, tujuan, atau perihal..." x-model="searchQuery">
                </div>
                <select class="filter-select" x-model="filterStatus">
                    <option value="">Semua Status</option>
                    <option value="draft">Draft</option>
                    <option value="sent">Terkirim</option>
                    <option value="delivered">Diterima</option>
                </select>
            </div>

            <!-- Table -->
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Surat</th>
                            <th>Tanggal Kirim</th>
                            <th>Tujuan</th>
                            <th>Perihal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="(surat, index) in filteredSurat" :key="surat.id">
                            <tr>
                                <td x-text="index + 1"></td>
                                <td x-text="surat.nomor"></td>
                                <td x-text="surat.tanggal"></td>
                                <td x-text="surat.tujuan"></td>
                                <td x-text="surat.perihal"></td>
                                <td>
                                    <span class="badge" :class="{
                                        'badge-warning': surat.status === 'draft',
                                        'badge-primary': surat.status === 'sent',
                                        'badge-success': surat.status === 'delivered'
                                    }" x-text="getStatusText(surat.status)"></span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-sm btn-success" @click="viewDetail(surat)">
                                            <svg style="width: 14px; height: 14px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            Detail
                                        </button>
                                        <button class="btn btn-sm btn-info" @click="printSurat(surat.id)">
                                            <svg style="width: 14px; height: 14px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                                            </svg>
                                            Cetak
                                        </button>
                                        <button class="btn btn-sm btn-danger" @click="deleteSurat(surat.id)">
                                            <svg style="width: 14px; height: 14px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <div class="pagination-info">
                Menampilkan <strong>1-10</strong> dari <strong x-text="suratList.length"></strong> surat
            </div>
            <div class="pagination-buttons">
                <button class="pagination-btn" disabled>Sebelumnya</button>
                <button class="pagination-btn active">1</button>
                <button class="pagination-btn">2</button>
                <button class="pagination-btn">3</button>
                <button class="pagination-btn">Selanjutnya</button>
            </div>
        </div>
    </div>

    <!-- Modal Add/Edit -->
    <div class="modal" :class="{ 'show': showModal }">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" x-text="modalMode === 'add' ? 'Buat Surat Keluar' : 'Detail Surat Keluar'"></h3>
                <button class="modal-close" @click="closeModal">&times;</button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label class="form-label">Nomor Surat *</label>
                        <input type="text" class="form-control" x-model="formData.nomor" placeholder="Contoh: 001/PED/I/2026">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tanggal Kirim *</label>
                        <input type="date" class="form-control" x-model="formData.tanggal">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tujuan Surat *</label>
                        <input type="text" class="form-control" x-model="formData.tujuan" placeholder="Nama instansi/lembaga tujuan">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Alamat Tujuan *</label>
                        <textarea class="form-control" x-model="formData.alamat" placeholder="Alamat lengkap tujuan surat"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Perihal *</label>
                        <input type="text" class="form-control" x-model="formData.perihal" placeholder="Perihal surat">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Isi Surat *</label>
                        <textarea class="form-control" x-model="formData.isi" placeholder="Isi/konten surat" style="min-height: 150px;"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status *</label>
                        <select class="form-control" x-model="formData.status">
                            <option value="draft">Draft</option>
                            <option value="sent">Terkirim</option>
                            <option value="delivered">Diterima</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Penandatangan</label>
                        <input type="text" class="form-control" x-model="formData.penandatangan" placeholder="Nama pejabat penandatangan">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Upload Lampiran (PDF)</label>
                        <input type="file" class="form-control" accept=".pdf">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" @click="closeModal">Batal</button>
                <button class="btn btn-primary" @click="saveSurat">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
function suratKeluarApp() {
    return {
        searchQuery: '',
        filterStatus: '',
        showModal: false,
        modalMode: 'add',
        formData: {
            nomor: '',
            tanggal: '',
            tujuan: '',
            alamat: '',
            perihal: '',
            isi: '',
            status: 'draft',
            penandatangan: '',
            tembusan: ''
        },
        suratList: [
            {
                id: 1,
                nomor: '001/PED/I/2026',
                tanggal: '05/01/2026',
                tujuan: 'Dinas Kesehatan Kota Semarang',
                perihal: 'Permohonan Data Kesehatan',
                status: 'sent'
            },
            {
                id: 2,
                nomor: '002/PED/I/2026',
                tanggal: '06/01/2026',
                tujuan: 'Polsek Pedurungan',
                perihal: 'Pemberitahuan Kegiatan Masyarakat',
                status: 'delivered'
            },
            {
                id: 3,
                nomor: '003/PED/I/2026',
                tanggal: '07/01/2026',
                tujuan: 'Dinas Pendidikan Kota Semarang',
                perihal: 'Usulan Program Pendidikan',
                status: 'draft'
            },
            {
                id: 4,
                nomor: '004/PED/XII/2025',
                tanggal: '28/12/2025',
                tujuan: 'BPBD Kota Semarang',
                perihal: 'Laporan Bencana dan Tanggap Darurat',
                status: 'delivered'
            },
            {
                id: 5,
                nomor: '005/PED/I/2026',
                tanggal: '04/01/2026',
                tujuan: 'Dinas Sosial Kota Semarang',
                perihal: 'Usulan Bantuan Sosial',
                status: 'sent'
            },
            {
                id: 6,
                nomor: '006/PED/I/2026',
                tanggal: '03/01/2026',
                tujuan: 'Kecamatan Genuk',
                perihal: 'Surat Balasan Koordinasi Wilayah',
                status: 'delivered'
            }
        ],
        
        get filteredSurat() {
            let result = this.suratList;
            
            if (this.searchQuery) {
                result = result.filter(s => 
                    s.nomor.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                    s.tujuan.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                    s.perihal.toLowerCase().includes(this.searchQuery.toLowerCase())
                );
            }
            
            if (this.filterStatus) {
                result = result.filter(s => s.status === this.filterStatus);
            }
            
            return result;
        },
        
        getStatusText(status) {
            const statusMap = {
                'draft': 'Draft',
                'sent': 'Terkirim',
                'delivered': 'Diterima'
            };
            return statusMap[status] || status;
        },
        
        openModal(mode) {
            this.modalMode = mode;
            this.showModal = true;
            if (mode === 'add') {
                this.resetForm();
            }
        },
        
        closeModal() {
            this.showModal = false;
            this.resetForm();
        },
        
        resetForm() {
            this.formData = {
                nomor: '',
                tanggal: '',
                tujuan: '',
                alamat: '',
                perihal: '',
                isi: '',
                status: 'draft',
                penandatangan: '',
                tembusan: ''
            };
        },
        
        viewDetail(surat) {
            this.formData = { ...surat };
            this.openModal('view');
        },
        
        saveSurat() {
            if (this.modalMode === 'add') {
                alert('Surat keluar berhasil dibuat!');
            } else {
                alert('Surat keluar berhasil diperbarui!');
            }
            this.closeModal();
        },
        
        printSurat(id) {
            alert('Mencetak surat ID: ' + id + '\n\nFitur cetak akan tersedia pada versi selanjutnya.');
        },
        
        deleteSurat(id) {
            if (confirm('Apakah Anda yakin ingin menghapus surat ini?')) {
                this.suratList = this.suratList.filter(s => s.id !== id);
                alert('Surat berhasil dihapus!');
            }
        }
    }
}
</script>

</body>
</html>