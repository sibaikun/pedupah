<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detail Pengaduan - {{ $pengaduan->judul }}</title>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f5f5; min-height: 100vh; }
        
        /* Top Bar & Navbar - sama seperti index */
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
        .detail-card { background: white; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); overflow: hidden; }
        
        .detail-header { padding: 24px; border-bottom: 1px solid #e5e7eb; }
        .detail-title-row { display: flex; justify-content: space-between; align-items: start; gap: 16px; margin-bottom: 12px; }
        .detail-title { font-size: 1.75rem; font-weight: 700; color: #1f2937; }
        
        .badge { display: inline-block; padding: 6px 16px; border-radius: 999px; font-size: 0.875rem; font-weight: 600; }
        .badge-pending { background: #fef3c7; color: #92400e; }
        .badge-diproses { background: #dbeafe; color: #1e40af; }
        .badge-selesai { background: #d1fae5; color: #065f46; }
        .badge-ditolak { background: #fee2e2; color: #991b1b; }
        
        .detail-meta { display: flex; flex-wrap: wrap; gap: 24px; margin-top: 16px; }
        .meta-item { display: flex; align-items: center; gap: 8px; font-size: 0.875rem; color: #6b7280; }
        .meta-item svg { width: 18px; height: 18px; }
        .meta-item strong { color: #374151; font-weight: 600; }
        
        .detail-body { padding: 24px; }
        
        .image-section { margin-bottom: 32px; }
        .pengaduan-image { width: 100%; max-height: 500px; object-fit: cover; border-radius: 8px; }
        .no-image { width: 100%; height: 300px; background: #f3f4f6; border-radius: 8px; display: flex; flex-direction: column; align-items: center; justify-content: center; color: #9ca3af; }
        .no-image svg { width: 80px; height: 80px; margin-bottom: 12px; }
        
        .info-section { margin-bottom: 32px; }
        .section-title { font-size: 1.125rem; font-weight: 600; color: #1f2937; margin-bottom: 16px; padding-bottom: 8px; border-bottom: 2px solid #e5e7eb; }
        
        .info-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; }
        .info-item { }
        .info-label { font-size: 0.875rem; font-weight: 500; color: #6b7280; margin-bottom: 6px; }
        .info-value { font-size: 1rem; color: #1f2937; }
        
        .description-box { background: #f9fafb; padding: 20px; border-radius: 8px; border-left: 4px solid #b83232; }
        .description-text { font-size: 0.938rem; color: #374151; line-height: 1.7; white-space: pre-line; }
        
        .user-info-box { background: #f9fafb; padding: 20px; border-radius: 8px; display: flex; align-items: center; gap: 16px; }
        .user-avatar-large { width: 64px; height: 64px; border-radius: 50%; background: #b83232; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 700; color: white; }
        .user-details h3 { font-size: 1.125rem; font-weight: 600; color: #1f2937; margin-bottom: 4px; }
        .user-details p { font-size: 0.875rem; color: #6b7280; }
        
        /* Action Buttons */
        .action-section { padding: 24px; background: #f9fafb; border-top: 1px solid #e5e7eb; }
        .action-buttons { display: flex; gap: 12px; flex-wrap: wrap; }
        
        .btn { padding: 12px 24px; border-radius: 6px; font-size: 0.875rem; font-weight: 600; border: none; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; }
        .btn svg { width: 18px; height: 18px; }
        .btn-primary { background: #3b82f6; color: white; }
        .btn-primary:hover { background: #2563eb; }
        .btn-success { background: #10b981; color: white; }
        .btn-success:hover { background: #059669; }
        .btn-danger { background: #ef4444; color: white; }
        .btn-danger:hover { background: #dc2626; }
        .btn-secondary { background: #6b7280; color: white; }
        .btn-secondary:hover { background: #4b5563; }
        
        /* Modal */
        .modal { display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 9999; align-items: center; justify-content: center; padding: 20px; }
        .modal.show { display: flex; }
        .modal-content { background: white; border-radius: 12px; max-width: 500px; width: 100%; }
        .modal-header { padding: 20px 24px; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center; }
        .modal-title { font-size: 1.25rem; font-weight: 600; color: #1f2937; }
        .modal-close { background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #9ca3af; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 6px; }
        .modal-close:hover { background: #f3f4f6; color: #374151; }
        .modal-body { padding: 24px; }
        .modal-footer { padding: 16px 24px; border-top: 1px solid #e5e7eb; display: flex; justify-content: flex-end; gap: 12px; }
        
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 6px; }
        .form-control { width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.875rem; }
        .form-control:focus { outline: none; border-color: #b83232; box-shadow: 0 0 0 3px rgba(184, 50, 50, 0.1); }
        textarea.form-control { resize: vertical; min-height: 100px; }
        
        @media (max-width: 768px) {
            .container { padding: 20px 16px; }
            .detail-title { font-size: 1.25rem; }
            .info-grid { grid-template-columns: 1fr; }
            .action-buttons { flex-direction: column; }
            .btn { width: 100%; justify-content: center; }
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
            <img src="{{ asset('build/logoicon.png') }}" alt="Logo" class="logo-icon">
            <span class="logo-text">PEDUPA<span class="admin-badge">ADMIN</span></span>
        </div>
        <div class="nav-menu">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
            <a href="{{ route('admin.surats.index') }}" class="nav-link">Surat Online</a>
            <a href="{{ route('admin.surat-masuk.index') }}" class="nav-link">Surat Masuk</a>
            <a href="{{ route('admin.surat-keluar.index') }}" class="nav-link">Surat Keluar</a>
            <a href="{{ route('admin.pengaduans.index') }}" class="nav-link active">Pengaduan</a>
        </div>
    </div>
    <div class="profile-section" x-data="{ open: false }">
        <button class="profile-btn" @click="open = !open"><div class="profile-avatar">A</div><span class="profile-name">Admin</span><svg class="dropdown-icon" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg></button>
        <div class="dropdown-menu" x-show="open" @click.outside="open = false" x-transition style="display: none;">
            <a href="#" class="dropdown-item">Profil Admin</a>
            <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="dropdown-item logout">Keluar</button></form>
        </div>
    </div>
</nav>

<!-- CONTENT -->
<div class="container" x-data="detailPengaduan()">
    <a href="{{ route('admin.pengaduans.index') }}" class="back-btn">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Daftar Pengaduan
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
                <h1 class="detail-title">{{ $pengaduan->judul }}</h1>
                <span class="badge badge-{{ $pengaduan->status }}">{{ ucfirst($pengaduan->status) }}</span>
            </div>
            <div class="detail-meta">
                <div class="meta-item">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                    <strong>Kategori:</strong> {{ $pengaduan->kategori }}
                </div>
                <div class="meta-item">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <strong>Dilaporkan:</strong> {{ $pengaduan->created_at->format('d F Y, H:i') }} WIB
                </div>
                <div class="meta-item">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ $pengaduan->created_at->diffForHumans() }}
                </div>
            </div>
        </div>

        <!-- Body -->
        <div class="detail-body">
            <!-- Foto -->
            <div class="image-section">
                @if($pengaduan->foto)
                    <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="{{ $pengaduan->judul }}" class="pengaduan-image">
                @else
                    <div class="no-image">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <p>Tidak ada foto</p>
                    </div>
                @endif
            </div>

            <!-- Info Detail -->
            <div class="info-section">
                <h2 class="section-title">Informasi Detail</h2>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Lokasi</div>
                        <div class="info-value">
                            <svg style="width: 16px; height: 16px; display: inline; margin-right: 4px; vertical-align: middle;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            {{ $pengaduan->lokasi }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="info-section">
                <h2 class="section-title">Deskripsi Pengaduan</h2>
                <div class="description-box">
                    <p class="description-text">{{ $pengaduan->deskripsi }}</p>
                </div>
            </div>

            <!-- Info Pelapor -->
            <div class="info-section">
                <h2 class="section-title">Informasi Pelapor</h2>
                <div class="user-info-box">
                    <div class="user-avatar-large">
                        {{ strtoupper(substr($pengaduan->user->name ?? 'U', 0, 1)) }}
                    </div>
                    <div class="user-details">
                        <h3>{{ $pengaduan->user->name ?? 'User' }}</h3>
                        <p>{{ $pengaduan->user->email ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        @if($pengaduan->status !== 'selesai' && $pengaduan->status !== 'ditolak')
        <div class="action-section">
            <div class="action-buttons">
                @if($pengaduan->status === 'pending')
                <form method="POST" action="{{ route('admin.pengaduans.proses', $pengaduan->id) }}" style="flex: 1;" onsubmit="return confirm('Ubah status menjadi Diproses?')">
                    @csrf @method('PATCH')
                    <button type="submit" class="btn btn-primary" style="width: 100%;">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                        Proses Pengaduan
                    </button>
                </form>
                <form method="POST" action="{{ route('admin.pengaduans.tolak', $pengaduan->id) }}" style="flex: 1;" onsubmit="return confirm('Yakin menolak pengaduan ini?')">
                    @csrf @method('PATCH')
                    <button type="submit" class="btn btn-danger" style="width: 100%;">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        Tolak
                    </button>
                </form>
                @elseif($pengaduan->status === 'diproses')
                <button type="button" class="btn btn-success" @click="openSelesaiModal" style="flex: 1;">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Tandai Selesai
                </button>
                @endif
            </div>
        </div>
        @endif
    </div>

    <!-- Modal Selesai -->
    <div class="modal" :class="{ 'show': showSelesaiModal }">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.pengaduans.selesai', $pengaduan->id) }}">
                @csrf @method('PATCH')
                <div class="modal-header">
                    <h3 class="modal-title">Selesaikan Pengaduan</h3>
                    <button type="button" class="modal-close" @click="closeSelesaiModal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Catatan Penyelesaian (Opsional)</label>
                        <textarea name="catatan" class="form-control" placeholder="Tambahkan catatan penyelesaian jika diperlukan..."></textarea>
                    </div>
                    <p style="font-size: 0.875rem; color: #6b7280;">Pengaduan akan ditandai sebagai selesai dan status tidak dapat diubah lagi.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="closeSelesaiModal">Batal</button>
                    <button type="submit" class="btn btn-success">Selesaikan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function detailPengaduan() {
    return {
        showSelesaiModal: false,
        openSelesaiModal() {
            this.showSelesaiModal = true;
        },
        closeSelesaiModal() {
            this.showSelesaiModal = false;
        }
    }
}
</script>

</body>
</html>