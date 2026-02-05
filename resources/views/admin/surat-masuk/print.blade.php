<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Surat Masuk - {{ $suratMasuk->nomor_surat }}</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            line-height: 1.6;
            color: #000;
            background: #fff;
            padding: 20mm;
        }

        .print-container {
            max-width: 210mm;
            margin: 0 auto;
            background: white;
        }

        /* Header Kop Surat */
        .kop-surat {
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .logo-container {
            flex-shrink: 0;
        }

        .logo {
            width: 80px;
            height: 80px;
        }

        .kop-text {
            flex: 1;
            text-align: center;
        }

        .kop-text h1 {
            font-size: 18pt;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 2px;
            color: #000;
        }

        .kop-text h2 {
            font-size: 16pt;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 2px;
            color: #000;
        }

        .kop-text p {
            font-size: 10pt;
            margin: 2px 0;
        }

        .kop-text .alamat {
            font-size: 9pt;
            font-style: italic;
        }

        /* Judul Dokumen */
        .document-title {
            text-align: center;
            margin: 30px 0 20px;
        }

        .document-title h3 {
            font-size: 14pt;
            font-weight: bold;
            text-decoration: underline;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .document-title p {
            font-size: 11pt;
        }

        /* Content */
        .content {
            margin: 30px 0;
        }

        .info-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .info-table tr {
            vertical-align: top;
        }

        .info-table td {
            padding: 5px 0;
            font-size: 11pt;
        }

        .info-table .label {
            width: 150px;
            font-weight: 600;
        }

        .info-table .separator {
            width: 20px;
            text-align: center;
        }

        .info-table .value {
            font-weight: normal;
        }

        .perihal-section {
            margin: 20px 0;
            padding: 15px;
            background: #f9f9f9;
            border-left: 4px solid #b83232;
        }

        .perihal-section .label {
            font-weight: bold;
            font-size: 11pt;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        .perihal-section .content-text {
            font-size: 11pt;
            text-align: justify;
            line-height: 1.8;
        }

        .catatan-section {
            margin: 20px 0;
            padding: 15px;
            background: #fffbeb;
            border-left: 4px solid #f59e0b;
        }

        .catatan-section .label {
            font-weight: bold;
            font-size: 11pt;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        .catatan-section .content-text {
            font-size: 11pt;
            text-align: justify;
            line-height: 1.8;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 3px;
            font-size: 10pt;
            font-weight: bold;
        }

        .status-badge.pending {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #f59e0b;
        }

        .status-badge.processed {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #10b981;
        }

        .status-badge.archived {
            background: #dbeafe;
            color: #1e40af;
            border: 1px solid #3b82f6;
        }

        /* Footer */
        .footer {
            margin-top: 50px;
            text-align: right;
        }

        .signature-section {
            display: inline-block;
            text-align: center;
            min-width: 250px;
        }

        .signature-section .place-date {
            margin-bottom: 10px;
            font-size: 11pt;
        }

        .signature-section .position {
            font-weight: bold;
            margin-bottom: 80px;
            font-size: 11pt;
        }

        .signature-section .name {
            font-weight: bold;
            border-bottom: 1px solid #000;
            padding-bottom: 2px;
            margin-bottom: 3px;
            font-size: 11pt;
        }

        .signature-section .nip {
            font-size: 10pt;
        }

        /* Divider */
        .divider {
            height: 1px;
            background: #ddd;
            margin: 20px 0;
        }

        /* Print Button */
        .print-button-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }

        .print-button {
            background: #10b981;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .print-button:hover {
            background: #059669;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(16, 185, 129, 0.4);
        }

        .print-button svg {
            width: 20px;
            height: 20px;
        }

        /* Print Styles */
        @media print {
            body {
                padding: 0;
                background: white;
            }

            .print-button-container {
                display: none;
            }

            .print-container {
                max-width: 100%;
            }

            .perihal-section,
            .catatan-section {
                background: white !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .status-badge {
                border: 2px solid #000 !important;
            }

            @page {
                size: A4;
                margin: 20mm;
            }
        }

        /* Watermark */
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 120pt;
            color: rgba(184, 50, 50, 0.05);
            font-weight: bold;
            z-index: -1;
            pointer-events: none;
        }

        /* File Info */
        .file-info {
            margin: 20px 0;
            padding: 15px;
            background: #fef2f2;
            border-left: 4px solid #dc2626;
        }

        .file-info .label {
            font-weight: bold;
            font-size: 11pt;
            margin-bottom: 8px;
            text-transform: uppercase;
            color: #991b1b;
        }

        .file-info .content-text {
            font-size: 10pt;
            color: #7f1d1d;
        }

        .metadata {
            margin-top: 30px;
            padding: 15px;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            font-size: 9pt;
            color: #6b7280;
        }

        .metadata-title {
            font-weight: bold;
            margin-bottom: 8px;
            font-size: 10pt;
            color: #374151;
        }

        .metadata-item {
            margin: 3px 0;
        }
    </style>
</head>

<body>

<!-- Print Button -->
<div class="print-button-container">
    <button onclick="window.print()" class="print-button">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
        </svg>
        Cetak Dokumen
    </button>
</div>

<!-- Watermark -->
<div class="watermark">PEDUPA</div>

<!-- Print Container -->
<div class="print-container">
    
    <!-- Kop Surat -->
    <div class="kop-surat">
        <div class="logo-container">
            <img src="{{ asset('build/images/logoicon.png') }}" alt="Logo Kota Semarang" class="logo">
        </div>
        <div class="kop-text">
            <h1>Pemerintah Kota Semarang</h1>
            <h2>Kecamatan Pedurungan</h2>
            <p>Jl. Majapahit No.357, Gemah, Kec. Pedurungan, Kota Semarang, Jawa Tengah 50191</p>
            <p class="alamat">Telp: (024) 6710024 | Email: pedurungan@semarangkota.go.id</p>
        </div>
    </div>

    <!-- Document Title -->
    <div class="document-title">
        <h3>Arsip Surat Masuk</h3>
        <p>Nomor: {{ $suratMasuk->nomor_surat }}</p>
    </div>

    <!-- Content -->
    <div class="content">
        <table class="info-table">
            <tr>
                <td class="label">Nomor Surat</td>
                <td class="separator">:</td>
                <td class="value">{{ $suratMasuk->nomor_surat }}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Terima</td>
                <td class="separator">:</td>
                <td class="value">{{ $suratMasuk->tanggal_terima->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <td class="label">Pengirim</td>
                <td class="separator">:</td>
                <td class="value">{{ $suratMasuk->pengirim }}</td>
            </tr>
            <tr>
                <td class="label">Status Surat</td>
                <td class="separator">:</td>
                <td class="value">
                    <span class="status-badge {{ $suratMasuk->status }}">
                        {{ $suratMasuk->status_text }}
                    </span>
                </td>
            </tr>
        </table>

        <!-- Perihal Section -->
        <div class="perihal-section">
            <div class="label">Perihal Surat:</div>
            <div class="content-text">{{ $suratMasuk->perihal }}</div>
        </div>

        <!-- Catatan Section -->
        @if($suratMasuk->catatan)
        <div class="catatan-section">
            <div class="label">Catatan:</div>
            <div class="content-text">{{ $suratMasuk->catatan }}</div>
        </div>
        @endif

        <!-- File Info -->
        @if($suratMasuk->file_path)
        <div class="file-info">
            <div class="label">File Lampiran:</div>
            <div class="content-text">
                ✓ Tersedia file PDF lampiran surat<br>
                Nama File: {{ basename($suratMasuk->file_path) }}
            </div>
        </div>
        @endif

        <div class="divider"></div>

        <!-- Metadata -->
        <div class="metadata">
            <div class="metadata-title">Informasi Sistem</div>
            <div class="metadata-item">Dibuat pada: {{ $suratMasuk->created_at->translatedFormat('d F Y, H:i') }} WIB</div>
            <div class="metadata-item">Terakhir diubah: {{ $suratMasuk->updated_at->translatedFormat('d F Y, H:i') }} WIB</div>
            <div class="metadata-item">Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }} WIB</div>
        </div>
    </div>

    <!-- Footer / Signature -->
    <div class="footer">
        <div class="signature-section">
            <div class="place-date">Semarang, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
            <div class="position">
                Kepala Kecamatan Pedurungan<br>
                Kota Semarang
            </div>
            <div class="name">(__________________)</div>
            <div class="nip">NIP. ____________________</div>
        </div>
    </div>

</div>

<script>
    // Auto print dialog on load (optional)
    // window.onload = function() {
    //     window.print();
    // }

    // Close window after print (optional)
    window.onafterprint = function() {
        // window.close();
    }
</script>

</body>
</html>