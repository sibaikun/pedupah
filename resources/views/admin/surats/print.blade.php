<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Surat - {{ $surat->jenis_surat }}</title>
    <style>
        @media print {
            .no-print { display: none !important; }
            body { margin: 0; }
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Times New Roman', Times, serif;
            line-height: 1.6;
            padding: 40px;
            max-width: 21cm;
            margin: 0 auto;
            background: white;
        }
        
        .kop-surat {
            text-align: center;
            border-bottom: 3px solid #000;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }
        
        .kop-surat img {
            width: 80px;
            height: 80px;
            margin-bottom: 10px;
        }
        
        .kop-surat h1 {
            font-size: 20px;
            font-weight: bold;
            margin: 5px 0;
            text-transform: uppercase;
        }
        
        .kop-surat h2 {
            font-size: 18px;
            font-weight: bold;
            margin: 5px 0;
        }
        
        .kop-surat p {
            font-size: 12px;
            margin: 2px 0;
        }
        
        .nomor-surat {
            text-align: center;
            margin: 30px 0;
        }
        
        .nomor-surat h3 {
            font-size: 16px;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 10px;
        }
        
        .nomor-surat p {
            font-size: 14px;
        }
        
        .isi-surat {
            text-align: justify;
            font-size: 14px;
            margin: 30px 0;
        }
        
        .isi-surat p {
            margin-bottom: 15px;
            text-indent: 40px;
        }
        
        .data-pemohon {
            margin: 20px 0 20px 60px;
        }
        
        .data-pemohon table {
            border-collapse: collapse;
        }
        
        .data-pemohon td {
            padding: 5px 0;
            font-size: 14px;
        }
        
        .data-pemohon td:first-child {
            width: 150px;
            vertical-align: top;
        }
        
        .data-pemohon td:nth-child(2) {
            width: 20px;
            vertical-align: top;
        }
        
        .penutup {
            text-align: justify;
            font-size: 14px;
            margin: 30px 0;
        }
        
        .penutup p {
            margin-bottom: 15px;
            text-indent: 40px;
        }
        
        .ttd {
            margin-top: 50px;
            text-align: right;
        }
        
        .ttd-content {
            display: inline-block;
            text-align: center;
        }
        
        .ttd p {
            font-size: 14px;
            margin: 5px 0;
        }
        
        .ttd .tanggal {
            margin-bottom: 80px;
        }
        
        .ttd .nama {
            font-weight: bold;
            text-decoration: underline;
        }
        
        .ttd .jabatan {
            font-size: 12px;
        }
        
        .btn-print {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #b83232;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(184, 50, 50, 0.3);
            transition: all 0.2s;
        }
        
        .btn-print:hover {
            background: #8b2424;
            transform: translateY(-2px);
        }
        
        .btn-back {
            position: fixed;
            top: 20px;
            left: 20px;
            background: #6b7280;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.2s;
        }
        
        .btn-back:hover {
            background: #4b5563;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <!-- Tombol Print & Back -->
    <a href="{{ route('admin.surats.show', $surat->id) }}" class="btn-back no-print">← Kembali</a>
    <button onclick="window.print()" class="btn-print no-print">🖨️ Cetak Surat</button>

    <!-- Kop Surat -->
    <div class="kop-surat">
        <img src="{{ asset('build/images/logoicon.png') }}" alt="Logo Kota Semarang">
        <h1>PEMERINTAH KOTA SEMARANG</h1>
        <h2>KECAMATAN PEDURUNGAN</h2>
        <p>Jl. Brigjen Sudiarto No. 366, Pedurungan Lor, Kec. Pedurungan</p>
        <p>Kota Semarang, Jawa Tengah 50192</p>
        <p>Telp: (024) 6710024 | Email: pedurungan@semarangkota.go.id</p>
    </div>

    <!-- Nomor Surat -->
    <div class="nomor-surat">
        <h3>{{ strtoupper($surat->jenis_surat) }}</h3>
        <p>Nomor: {{ str_pad($surat->id, 4, '0', STR_PAD_LEFT) }}/SKT/{{ now()->format('m/Y') }}</p>
    </div>

    <!-- Isi Surat -->
    <div class="isi-surat">
        <p>Yang bertanda tangan di bawah ini, Lurah Pedurungan Kecamatan Pedurungan Kota Semarang, menerangkan bahwa:</p>
    </div>

    <!-- Data Pemohon -->
    <div class="data-pemohon">
        <table>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><strong>{{ $surat->nama_pemohon }}</strong></td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td>{{ $surat->nik }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $surat->alamat ?? '-' }}</td>
            </tr>
            <tr>
                <td>No. Telepon</td>
                <td>:</td>
                <td>{{ $surat->nomor_telepon ?? '-' }}</td>
            </tr>
        </table>
    </div>

    <!-- Keperluan -->
    <div class="isi-surat">
        <p>Adalah benar penduduk Kecamatan Pedurungan dan surat keterangan ini dibuat untuk keperluan:</p>
        <p style="text-indent: 0; margin-left: 40px;"><strong>"{{ $surat->keperluan }}"</strong></p>
    </div>

    <!-- Penutup -->
    <div class="penutup">
        <p>Demikian surat keterangan ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.</p>
    </div>

    <!-- Tanda Tangan -->
    <div class="ttd">
        <div class="ttd-content">
            <p>Semarang, {{ now()->translatedFormat('d F Y') }}</p>
            <p class="tanggal">Lurah Pedurungan</p>
            <p class="nama">_______________________</p>
            <p class="jabatan">NIP. __________________</p>
        </div>
    </div>

    <script>
        // Auto print saat halaman dibuka (optional)
        // window.onload = function() {
        //     window.print();
        // }
    </script>
</body>
</html>