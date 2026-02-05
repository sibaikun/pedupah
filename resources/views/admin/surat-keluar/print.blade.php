<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Surat Keluar - {{ $surat->nomor_surat }}</title>

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

        /* Document Info */
        .document-info {
            margin: 30px 0 20px;
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
            width: 120px;
            font-weight: 600;
        }

        .info-table .separator {
            width: 20px;
            text-align: center;
        }

        .info-table .value {
            font-weight: normal;
        }

        /* Tujuan Section */
        .tujuan-section {
            margin: 25px 0;
        }

        .tujuan-label {
            font-size: 11pt;
            margin-bottom: 3px;
        }

        .tujuan-name {
            font-weight: bold;
            font-size: 12pt;
            margin-bottom: 3px;
        }

        .tujuan-address {
            font-size: 11pt;
            line-height: 1.6;
        }

        /* Greeting */
        .greeting {
            margin: 25px 0;
            font-size: 11pt;
            text-indent: 50px;
        }

        /* Content Sections */
        .isi-section {
            margin: 20px 0;
            padding: 15px;
            background: #f9f9f9;
            border-left: 4px solid #b83232;
        }

        .isi-section .label {
            font-weight: bold;
            font-size: 11pt;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        .isi-section .content-text {
            font-size: 11pt;
            text-align: justify;
            line-height: 1.8;
            white-space: pre-wrap;
        }

        .closing-text {
            margin: 20px 0;
            font-size: 11pt;
            text-align: justify;
            text-indent: 50px;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 3px;
            font-size: 10pt;
            font-weight: bold;
        }

        .status-badge.draft {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #f59e0b;
        }

        .status-badge.sent {
            background: #dbeafe;
            color: #1e40af;
            border: 1px solid #3b82f6;
        }

        .status-badge.delivered {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #10b981;
        }

        /* Signature Section */
        .signature-wrapper {
            margin-top: 40px;
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

        /* Metadata */
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

            .isi-section,
            .file-info {
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
            <img src="{{ public_path('build/images/logoicon.png') }}" alt="Logo Kota Semarang" class="logo">
        </div>
        <div class="kop-text">
            <h1>Pemerintah Kota Semarang</h1>
            <h2>Kecamatan Pedurungan</h2>
            <p>Jl. Majapahit No.357, Gemah, Kec. Pedurungan, Kota Semarang, Jawa Tengah 50191</p>
            <p class="alamat">Telp: (024) 6710024 | Email: pedurungan@semarangkota.go.id</p>
        </div>
    </div>

    <!-- Document Info -->
    <div class="document-info">
        <table class="info-table">
            <tr>
                <td class="label">Nomor</td>
                <td class="separator">:</td>
                <td class="value">{{ $surat->nomor_surat }}</td>
            </tr>
            <tr>
                <td class="label">Lampiran</td>
                <td class="separator">:</td>
                <td class="value">{{ $surat->file_path ? '1 (satu) berkas' : '-' }}</td>
            </tr>
            <tr>
                <td class="label">Perihal</td>
                <td class="separator">:</td>
                <td class="value"><strong>{{ $surat->perihal }}</strong></td>
            </tr>
            <tr>
                <td class="label">Status</td>
                <td class="separator">:</td>
                <td class="value">
                    <span class="status-badge {{ $surat->status }}">
                        {{ $surat->status_text }}
                    </span>
                </td>
            </tr>
        </table>
    </div>

    <!-- Tujuan Surat -->
    <div class="tujuan-section">
        <div class="tujuan-label">Kepada Yth.</div>
        <div class="tujuan-name">{{ $surat->tujuan }}</div>
        <div class="tujuan-address">{{ $surat->alamat_tujuan }}</div>
    </div>

    <!-- Greeting -->
    <div class="greeting">
        Dengan hormat,
    </div>

    <!-- Isi Surat -->
    <div class="isi-section">
        <div class="label">Isi Surat:</div>
        <div class="content-text">{{ $surat->isi_surat }}</div>
    </div>

    <!-- Closing -->
    <div class="closing-text">
        Demikian surat ini kami sampaikan. Atas perhatian dan kerjasamanya, kami ucapkan terima kasih.
    </div>

    <!-- File Info -->
    @if($surat->file_path)
    <div class="file-info">
        <div class="label">File Lampiran:</div>
        <div class="content-text">
            ✓ Tersedia file PDF lampiran surat<br>
            Nama File: {{ basename($surat->file_path) }}
        </div>
    </div>
    @endif

    <div class="divider"></div>

    <!-- Signature -->
    <div class="signature-wrapper">
        <div class="signature-section">
            <div class="place-date">Semarang, {{ $surat->tanggal_kirim->translatedFormat('d F Y') }}</div>
            <div class="position">
                {{ $surat->penandatangan ?: 'Camat Pedurungan' }}<br>
                Kota Semarang
            </div>
            <div class="name">
                @if($surat->penandatangan)
                    {{ $surat->penandatangan }}
                @else
                    (__________________)
                @endif
            </div>
            @if(!$surat->penandatangan)
            <div class="nip">NIP. ____________________</div>
            @endif
        </div>
    </div>

    <!-- Metadata -->
    <div class="metadata">
        <div class="metadata-title">Informasi Sistem</div>
        <div class="metadata-item">Dibuat pada: {{ $surat->created_at->translatedFormat('d F Y, H:i') }} WIB</div>
        <div class="metadata-item">Terakhir diubah: {{ $surat->updated_at->translatedFormat('d F Y, H:i') }} WIB</div>
        <div class="metadata-item">Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }} WIB</div>
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