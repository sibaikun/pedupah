<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Surat Online - Pedupa Admin</title>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8fafc;
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

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 32px 24px;
        }

        .page-header {
            background: white;
            border-radius: 16px;
            padding: 32px;
            margin-bottom: 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            border: 1px solid #f1f5f9;
        }

        .page-header h1 {
            font-size: 1.875rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .page-header p {
            font-size: 0.938rem;
            color: #64748b;
        }

        .filter-section {
            background: white;
            border-radius: 16px;
            padding: 28px;
            margin-bottom: 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            border: 1px solid #f1f5f9;
        }

        .filter-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .filter-header svg {
            width: 20px;
            height: 20px;
            color: #b83232;
        }

        .filter-header h3 {
            font-size: 1rem;
            font-weight: 700;
            color: #1e293b;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 18px;
            align-items: end;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .filter-label {
            font-size: 0.875rem;
            font-weight: 600;
            color: #475569;
        }

        .filter-input,
        .filter-select {
            padding: 11px 14px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 0.875rem;
            color: #1e293b;
            transition: all 0.2s;
            background: white;
        }

        .filter-input:focus,
        .filter-select:focus {
            outline: none;
            border-color: #b83232;
            box-shadow: 0 0 0 3px rgba(184, 50, 50, 0.1);
        }

        .filter-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3E%3Cpath stroke='%2364748b' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3E%3C/svg%3E");
            background-position: right 10px center;
            background-repeat: no-repeat;
            background-size: 20px;
            padding-right: 40px;
        }

        .filter-actions {
            display: flex;
            gap: 10px;
        }

        .btn-filter {
            background: linear-gradient(135deg, #b83232 0%, #8b2424 100%);
            color: white;
            padding: 11px 24px;
            border: none;
            border-radius: 10px;
            font-size: 0.875rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(184, 50, 50, 0.25);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-filter:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(184, 50, 50, 0.35);
        }

        .btn-filter svg {
            width: 16px;
            height: 16px;
        }

        .btn-reset {
            background: white;
            color: #64748b;
            padding: 11px 24px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 0.875rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-reset:hover {
            border-color: #b83232;
            color: #b83232;
            background: #fff1f1;
        }

        .btn-reset svg {
            width: 16px;
            height: 16px;
        }

        .table-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            overflow: hidden;
            border: 1px solid #f1f5f9;
        }

        .table-header {
            padding: 24px 28px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(to right, #fafafa, white);
        }

        .table-title {
            font-size: 1.125rem;
            font-weight: 700;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .table-title svg {
            width: 22px;
            height: 22px;
            color: #b83232;
        }

        .table-count {
            font-size: 0.813rem;
            color: #64748b;
            background: #f1f5f9;
            padding: 6px 14px;
            border-radius: 999px;
            font-weight: 600;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: linear-gradient(135deg, #b83232 0%, #8b2424 100%);
        }

        thead th {
            padding: 16px 18px;
            text-align: left;
            font-size: 0.813rem;
            font-weight: 700;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        tbody td {
            padding: 18px;
            font-size: 0.875rem;
            color: #475569;
            border-bottom: 1px solid #f1f5f9;
        }

        tbody tr {
            transition: all 0.2s;
        }

        tbody tr:hover {
            background: #f8fafc;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .badge::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .badge-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-pending::before {
            background: #f59e0b;
        }

        .badge-approved {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-approved::before {
            background: #10b981;
        }

        .badge-rejected {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge-rejected::before {
            background: #ef4444;
        }

        .btn-action {
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.813rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            margin-right: 6px;
            margin-bottom: 6px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-action svg {
            width: 14px;
            height: 14px;
        }

        .btn-view {
            background: #3b82f6;
            color: white;
        }

        .btn-view:hover {
            background: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .btn-upload {
            background: #8b5cf6;
            color: white;
        }

        .btn-upload:hover {
            background: #7c3aed;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
        }

        .btn-view-pdf {
            background: #059669;
            color: white;
        }

        .btn-view-pdf:hover {
            background: #047857;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
        }

        .btn-approve {
            background: #10b981;
            color: white;
        }

        .btn-approve:hover {
            background: #059669;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .btn-reject {
            background: #ef4444;
            color: white;
        }

        .btn-reject:hover {
            background: #dc2626;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        .empty-state {
            text-align: center;
            padding: 80px 24px;
            color: #94a3b8;
        }

        .empty-state svg {
            width: 100px;
            height: 100px;
            margin: 0 auto 24px;
            opacity: 0.3;
        }

        .empty-state h3 {
            font-size: 1.125rem;
            font-weight: 700;
            color: #64748b;
            margin-bottom: 8px;
        }

        .empty-state p {
            font-size: 0.938rem;
        }

        .alert {
            background: white;
            border-left: 4px solid #10b981;
            padding: 18px 24px;
            border-radius: 12px;
            margin-bottom: 24px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
            display: flex;
            align-items: center;
            gap: 14px;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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
            font-weight: 600;
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

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: linear-gradient(135deg, #e2e8f0, #cbd5e1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
            font-weight: 700;
            color: #475569;
        }

        .user-details {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-weight: 700;
            color: #1e293b;
            font-size: 0.875rem;
        }

        .user-email {
            font-size: 0.75rem;
            color: #94a3b8;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            padding: 24px;
            border-top: 1px solid #f1f5f9;
        }

        .pagination a,
        .pagination span {
            padding: 10px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 0.875rem;
            color: #475569;
            text-decoration: none;
            transition: all 0.2s;
            font-weight: 600;
        }

        .pagination a:hover {
            background: #fff1f1;
            border-color: #b83232;
            color: #b83232;
        }

        .pagination .active {
            background: linear-gradient(135deg, #b83232 0%, #8b2424 100%);
            color: white;
            border-color: #b83232;
            box-shadow: 0 4px 12px rgba(184, 50, 50, 0.25);
        }

        .pagination .disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            padding: 20px;
        }

        .modal-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
            max-width: 480px;
            width: 100%;
            overflow: hidden;
            animation: modalSlideIn 0.3s ease-out;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: scale(0.9) translateY(-20px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .modal-header {
            padding: 28px 28px 20px;
            text-align: center;
        }

        .modal-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: iconPulse 2s infinite;
        }

        @keyframes iconPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .modal-icon.approve {
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
        }

        .modal-icon.reject {
            background: linear-gradient(135deg, #fee2e2, #fecaca);
        }

        .modal-icon svg {
            width: 44px;
            height: 44px;
        }

        .modal-icon.approve svg {
            color: #059669;
        }

        .modal-icon.reject svg {
            color: #dc2626;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .modal-body {
            padding: 0 28px 28px;
        }

        .modal-message {
            font-size: 0.938rem;
            color: #64748b;
            text-align: center;
            line-height: 1.6;
            margin-bottom: 10px;
        }

        .modal-detail {
            background: #f8fafc;
            border-radius: 12px;
            padding: 16px;
            margin-top: 16px;
            border: 2px solid #e2e8f0;
        }

        .modal-detail-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .modal-detail-item:last-child {
            border-bottom: none;
        }

        .modal-detail-label {
            font-size: 0.813rem;
            color: #64748b;
            font-weight: 600;
        }

        .modal-detail-value {
            font-size: 0.875rem;
            color: #1e293b;
            font-weight: 700;
        }

        .modal-footer {
            padding: 20px 28px 28px;
            display: flex;
            gap: 12px;
        }

        .modal-btn {
            flex: 1;
            padding: 14px 24px;
            border: none;
            border-radius: 12px;
            font-size: 0.938rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .modal-btn svg {
            width: 18px;
            height: 18px;
        }

        .modal-btn-cancel {
            background: white;
            color: #64748b;
            border: 2px solid #e2e8f0;
        }

        .modal-btn-cancel:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            color: #475569;
        }

        .modal-btn-confirm {
            color: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .modal-btn-confirm:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        }

        .modal-btn-confirm.approve {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .modal-btn-confirm.reject {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }

        [x-cloak] { 
            display: none !important; 
        }

        @media (max-width: 768px) {
            .btn-action {
                display: flex;
                width: 100%;
                justify-content: center;
            }
            
            .modal-container {
                margin: 20px;
            }
            
            .modal-footer {
                flex-direction: column;
            }
        }
    </style>
</head>

<body x-data="{ 
    showModal: false, 
    modalType: '', 
    currentSurat: null,
    openConfirmModal(type, suratId, suratNama, suratNik, suratJenis) {
        this.modalType = type;
        this.currentSurat = {
            id: suratId,
            nama: suratNama,
            nik: suratNik,
            jenis: suratJenis
        };
        this.showModal = true;
    },
    closeModal() {
        this.showModal = false;
        this.modalType = '';
        this.currentSurat = null;
    },
    confirmAction() {
        if (this.modalType === 'approve') {
            document.getElementById('approve-form-' + this.currentSurat.id).submit();
        } else if (this.modalType === 'reject') {
            document.getElementById('reject-form-' + this.currentSurat.id).submit();
        }
        this.closeModal();
    }
}">

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

    <!-- Validation Errors -->
    @if($errors->any())
        <div class="alert alert-error">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div>
                @foreach($errors->all() as $error)
                    <div class="alert-text">{{ $error }}</div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Page Header -->
    <div class="page-header">
        <h1>📋 Manajemen Surat Online</h1>
        <p>Kelola dan proses semua pengajuan surat dari masyarakat Kecamatan Pedurungan</p>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <div class="filter-header">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
            </svg>
            <h3>Filter Pengajuan</h3>
        </div>

        <form method="GET" action="{{ route('admin.surats.index') }}">
            <div class="filter-grid">
                <div class="filter-group">
                    <label class="filter-label">🔍 Cari Nama/NIK</label>
                    <input type="text" name="search" class="filter-input" placeholder="Ketik nama atau NIK..." value="{{ request('search') }}">
                </div>

                <div class="filter-group">
                    <label class="filter-label">📄 Jenis Surat</label>
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
                    <label class="filter-label">📊 Status</label>
                    <select name="status" class="filter-select">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label class="filter-label">&nbsp;</label>
                    <div class="filter-actions">
                        <button type="submit" class="btn-filter">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                            </svg>
                            Filter
                        </button>
                        @if(request()->hasAny(['search', 'jenis_surat', 'status']))
                        <a href="{{ route('admin.surats.index') }}" class="btn-reset">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Reset
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Table Card -->
    <div class="table-card">
        <div class="table-header">
            <h2 class="table-title">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
                Daftar Pengajuan Surat
            </h2>
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
                        <td><strong>{{ $surats->firstItem() + $index }}</strong></td>
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
                        <td><strong>{{ $surat->nik }}</strong></td>
                        <td style="font-weight: 600; color: #1e293b;">{{ $surat->jenis_surat }}</td>
                        <td>{{ Str::limit($surat->keperluan, 35) }}</td>
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
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Detail
                            </a>

                            @if($surat->status === 'approved')
                                @if($surat->file_hasil)
                                    <!-- Jika sudah ada file hasil, tampilkan tombol Lihat PDF -->
                                    <a href="{{ Storage::url($surat->file_hasil) }}" target="_blank" class="btn-action btn-view-pdf">
                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                        </svg>
                                        Lihat PDF
                                    </a>
                                @else
                                    <!-- Jika belum ada file hasil, tampilkan tombol Upload -->
                                    <form method="POST" action="{{ route('admin.surats.upload', $surat->id) }}" enctype="multipart/form-data" style="display: inline-block;">
                                        @csrf
                                        <input type="file" 
                                               name="file_hasil" 
                                               id="file-{{ $surat->id }}" 
                                               accept=".pdf,.doc,.docx" 
                                               style="display: none;" 
                                               onchange="this.form.submit()">
                                        <button type="button" class="btn-action btn-upload" onclick="document.getElementById('file-{{ $surat->id }}').click()">
                                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                            </svg>
                                            Upload
                                        </button>
                                    </form>
                                @endif
                            @endif

                            @if($surat->status === 'pending')
                            <button type="button" 
                                    class="btn-action btn-approve" 
                                    @click="openConfirmModal('approve', {{ $surat->id }}, '{{ $surat->nama_pemohon }}', '{{ $surat->nik }}', '{{ $surat->jenis_surat }}')">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Setujui
                            </button>
                            
                            <button type="button" 
                                    class="btn-action btn-reject" 
                                    @click="openConfirmModal('reject', {{ $surat->id }}, '{{ $surat->nama_pemohon }}', '{{ $surat->nik }}', '{{ $surat->jenis_surat }}')">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Tolak
                            </button>

                            <!-- Hidden Forms -->
                            <form id="approve-form-{{ $surat->id }}" method="POST" action="{{ route('admin.surats.approve', $surat->id) }}" style="display: none;">
                                @csrf
                                @method('PATCH')
                            </form>
                            <form id="reject-form-{{ $surat->id }}" method="POST" action="{{ route('admin.surats.reject', $surat->id) }}" style="display: none;">
                                @csrf
                                @method('PATCH')
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
                                <h3>Tidak Ada Data Pengajuan</h3>
                                <p>Data pengajuan surat akan muncul di sini ketika masyarakat mengajukan surat</p>
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
            @if ($surats->onFirstPage())
                <span class="disabled">← Sebelumnya</span>
            @else
                <a href="{{ $surats->previousPageUrl() }}">← Sebelumnya</a>
            @endif

            @foreach ($surats->getUrlRange(1, $surats->lastPage()) as $page => $url)
                @if ($page == $surats->currentPage())
                    <span class="active">{{ $page }}</span>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach

            @if ($surats->hasMorePages())
                <a href="{{ $surats->nextPageUrl() }}">Selanjutnya →</a>
            @else
                <span class="disabled">Selanjutnya →</span>
            @endif
        </div>
        @endif
    </div>

</div>

<!-- ========== MODAL KONFIRMASI ========== -->
<div class="modal-overlay" 
     x-show="showModal" 
     x-cloak
     @click.self="closeModal()"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0">
    
    <div class="modal-container"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-90"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-90">
        
        <!-- Modal Header -->
        <div class="modal-header">
            <div class="modal-icon" :class="modalType">
                <svg x-show="modalType === 'approve'" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <svg x-show="modalType === 'reject'" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h3 class="modal-title" x-text="modalType === 'approve' ? 'Konfirmasi Persetujuan' : 'Konfirmasi Penolakan'"></h3>
        </div>

        <!-- Modal Body -->
        <div class="modal-body">
            <p class="modal-message" x-show="modalType === 'approve'">
                Apakah Anda yakin ingin <strong>menyetujui</strong> pengajuan surat ini? Pemohon akan menerima notifikasi bahwa suratnya telah disetujui.
            </p>
            <p class="modal-message" x-show="modalType === 'reject'">
                Apakah Anda yakin ingin <strong>menolak</strong> pengajuan surat ini? Pemohon akan menerima notifikasi bahwa suratnya ditolak.
            </p>

            <div class="modal-detail" x-show="currentSurat">
                <div class="modal-detail-item">
                    <span class="modal-detail-label">Nama Pemohon:</span>
                    <span class="modal-detail-value" x-text="currentSurat?.nama || '-'"></span>
                </div>
                <div class="modal-detail-item">
                    <span class="modal-detail-label">NIK:</span>
                    <span class="modal-detail-value" x-text="currentSurat?.nik || '-'"></span>
                </div>
                <div class="modal-detail-item">
                    <span class="modal-detail-label">Jenis Surat:</span>
                    <span class="modal-detail-value" x-text="currentSurat?.jenis || '-'"></span>
                </div>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer">
            <button type="button" class="modal-btn modal-btn-cancel" @click="closeModal()">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                Batal
            </button>
            <button type="button" 
                    class="modal-btn modal-btn-confirm" 
                    :class="modalType"
                    @click="confirmAction()">
                <svg x-show="modalType === 'approve'" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <svg x-show="modalType === 'reject'" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                <span x-text="modalType === 'approve' ? 'Ya, Setujui' : 'Ya, Tolak'"></span>
            </button>
        </div>
    </div>
</div>

</body>
</html>