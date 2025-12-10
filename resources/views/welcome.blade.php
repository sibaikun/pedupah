<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedupa - Pedurungan Menyapa</title>

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
            background: #f5f5f5;
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
            position: sticky;
            top: 0;
            z-index: 100;
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
            font-size: 1.25rem;
            font-weight: 700;
            color: #b83232;
        }

        .auth-buttons {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .btn-login {
            padding: 10px 24px;
            border: 2px solid #b83232;
            background: transparent;
            color: #b83232;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
        }

        .btn-login:hover {
            background: #b83232;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(184, 50, 50, 0.3);
        }

        .btn-register {
            padding: 10px 24px;
            background: linear-gradient(135deg, #b83232 0%, #8b2424 100%);
            color: white;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
            box-shadow: 0 4px 8px rgba(184, 50, 50, 0.3);
        }

        .btn-register:hover {
            background: linear-gradient(135deg, #8b2424 0%, #6d1c1c 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(184, 50, 50, 0.4);
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #b83232 0%, #8b2424 100%);
            color: white;
            padding: 100px 32px 120px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.1)" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
            background-size: cover;
            background-position: bottom;
            opacity: 0.3;
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 900px;
            margin: 0 auto;
        }

        .hero-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 24px;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            line-height: 1.8;
            opacity: 0.95;
            max-width: 700px;
            margin: 0 auto 40px;
        }

        .hero-cta {
            display: flex;
            gap: 16px;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }

        .btn-primary {
            padding: 14px 32px;
            background: white;
            color: #b83232;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }

        .btn-secondary {
            padding: 14px 32px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            color: white;
            border: 2px solid white;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s;
        }

        .btn-secondary:hover {
            background: white;
            color: #b83232;
            transform: translateY(-3px);
        }

        /* Services Section */
        .container {
            max-width: 1200px;
            margin: -60px auto 60px;
            padding: 0 24px;
            position: relative;
            z-index: 2;
        }

        .section-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-label {
            display: inline-block;
            background: #fef2f2;
            color: #b83232;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.813rem;
            font-weight: 600;
            margin-bottom: 16px;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 12px;
        }

        .section-description {
            font-size: 1.063rem;
            color: #6b7280;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.7;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
        }

        .service-card {
            background: white;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: all 0.4s;
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #b83232 0%, #8b2424 100%);
            transform: scaleX(0);
            transition: transform 0.4s;
        }

        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 28px rgba(0,0,0,0.15);
            border-color: #b83232;
        }

        .service-card:hover::before {
            transform: scaleX(1);
        }

        .service-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #b83232 0%, #8b2424 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            box-shadow: 0 4px 12px rgba(184, 50, 50, 0.3);
        }

        .service-icon svg {
            width: 36px;
            height: 36px;
            color: white;
        }

        .service-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 12px;
        }

        .service-description {
            font-size: 0.938rem;
            color: #6b7280;
            line-height: 1.7;
            margin-bottom: 28px;
        }

        .btn-service {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background: linear-gradient(135deg, #b83232 0%, #8b2424 100%);
            color: white;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
            box-shadow: 0 4px 8px rgba(184, 50, 50, 0.3);
        }

        .btn-service:hover {
            background: linear-gradient(135deg, #8b2424 0%, #6d1c1c 100%);
            transform: translateX(5px);
            box-shadow: 0 6px 16px rgba(184, 50, 50, 0.4);
        }

        .btn-service svg {
            width: 16px;
            height: 16px;
        }

        /* Features Section */
        .features-section {
            background: white;
            padding: 80px 24px;
            margin-top: 60px;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .feature-item {
            text-align: center;
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: #fef2f2;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .feature-icon svg {
            width: 30px;
            height: 30px;
            color: #b83232;
        }

        .feature-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 8px;
        }

        .feature-description {
            font-size: 0.875rem;
            color: #6b7280;
            line-height: 1.6;
        }

        /* Footer */
        .footer {
            background: #1f2937;
            color: white;
            padding: 40px 24px 24px;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-section h3 {
            font-size: 1.125rem;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .footer-section p,
        .footer-section a {
            font-size: 0.875rem;
            color: #d1d5db;
            line-height: 1.8;
            text-decoration: none;
        }

        .footer-section a:hover {
            color: white;
        }

        .footer-links {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .footer-bottom {
            max-width: 1200px;
            margin: 0 auto;
            padding-top: 24px;
            border-top: 1px solid #374151;
            text-align: center;
            font-size: 0.875rem;
            color: #9ca3af;
        }

        .contact-item {
            display: flex;
            align-items: start;
            gap: 12px;
            margin-bottom: 12px;
        }

        .contact-item svg {
            width: 20px;
            height: 20px;
            color: #b83232;
            flex-shrink: 0;
            margin-top: 2px;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.25rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .navbar {
                padding: 16px;
            }

            .auth-buttons {
                gap: 8px;
            }

            .btn-login,
            .btn-register {
                padding: 8px 16px;
                font-size: 0.813rem;
            }

            .services-grid {
                grid-template-columns: 1fr;
            }

            .section-title {
                font-size: 1.875rem;
            }

            .hero-cta {
                flex-direction: column;
            }

            .btn-primary,
            .btn-secondary {
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
<nav class="navbar">
    <div class="logo-section">
        <img src="{{ asset('build/images/logosemkot.png') }}" alt="Logo Kota Semarang" class="logo-icon">
        <span class="logo-text">PEDUPA</span>
    </div>

    <div class="auth-buttons">
        <a href="/login" class="btn-login">Login</a>
        <a href="/register" class="btn-register">Register</a>
    </div>
</nav>

<!-- HERO SECTION -->
<section class="hero-section">
    <div class="hero-content">
        <div class="hero-badge">
            🏛️ Kecamatan Pedurungan, Semarang
        </div>
        <h1 class="hero-title">Pedurungan Menyapa</h1>
        <p class="hero-subtitle">
            Platform digital terpadu untuk layanan publik Kecamatan Pedurungan. Ajukan surat online, sampaikan pengaduan, dan akses berbagai layanan kecamatan dengan mudah, cepat, dan transparan.
        </p>
        <div class="hero-cta">
            <a href="/register" class="btn-primary">Mulai Sekarang</a>
            <a href="#layanan" class="btn-secondary">Lihat Layanan</a>
        </div>
    </div>
</section>

<!-- SERVICES SECTION -->
<div class="container" id="layanan">
    <div class="services-grid">

        <!-- Pengajuan Surat Online -->
        <div class="service-card">
            <div class="service-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <h3 class="service-title">Pengajuan Surat Online</h3>
            <p class="service-description">
                Ajukan berbagai jenis surat keterangan seperti domisili, usaha, tidak mampu, dan lainnya secara online tanpa perlu datang ke kantor.
            </p>
            <a href="/login" class="btn-service">
                Ajukan Surat
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <!-- Layanan Pengaduan -->
        <div class="service-card">
            <div class="service-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                </svg>
            </div>
            <h3 class="service-title">Layanan Pengaduan</h3>
            <p class="service-description">
                Sampaikan keluhan, aspirasi, atau laporan permasalahan di lingkungan Anda. Kami akan menindaklanjuti setiap pengaduan dengan serius.
            </p>
            <a href="/login" class="btn-service">
                Buat Pengaduan
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

    </div>
</div>

<!-- FEATURES SECTION -->
<section class="features-section">
    <div class="section-header">
        <span class="section-label">Keunggulan</span>
        <h2 class="section-title">Mengapa Pilih PEDUPA?</h2>
        <p class="section-description">
            Platform digital yang memudahkan akses layanan publik dengan teknologi modern
        </p>
    </div>

    <div class="features-grid">
        <div class="feature-item">
            <div class="feature-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <h3 class="feature-title">Cepat & Efisien</h3>
            <p class="feature-description">Proses pengajuan surat dan pengaduan dapat dilakukan dalam hitungan menit</p>
        </div>

        <div class="feature-item">
            <div class="feature-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
            <h3 class="feature-title">Aman & Terpercaya</h3>
            <p class="feature-description">Data Anda dijamin keamanannya dengan sistem enkripsi terkini</p>
        </div>

        <div class="feature-item">
            <div class="feature-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h3 class="feature-title">Transparan</h3>
            <p class="feature-description">Lacak status pengajuan Anda secara realtime kapan saja</p>
        </div>

        <div class="feature-item">
            <div class="feature-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h3 class="feature-title">24/7 Online</h3>
            <p class="feature-description">Akses layanan kapan saja dan dimana saja tanpa batasan waktu</p>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="footer">
    <div class="footer-content">
        <div class="footer-section">
            <h3>PEDUPA</h3>
            <p>Platform Digital Kecamatan Pedurungan untuk melayani masyarakat dengan lebih baik melalui teknologi informasi.</p>
        </div>

        <div class="footer-section">
            <h3>Layanan</h3>
            <div class="footer-links">
                <a href="/login">Pengajuan Surat Online</a>
                <a href="/login">Layanan Pengaduan</a>
                <a href="/login">Tracking Status</a>
            </div>
        </div>

        <div class="footer-section">
            <h3>Kontak Kami</h3>
            <div class="contact-item">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
                <div>
                    <p>(024) 6710024</p>
                </div>
            </div>
            <div class="contact-item">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <div>
                    <p>pedurungan@semarangkota.go.id</p>
                </div>
            </div>
            <div class="contact-item">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <div>
                    <p>Kecamatan Pedurungan, Kota Semarang, Jawa Tengah</p>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        &copy; 2024 Kecamatan Pedurungan, Kota Semarang. All Rights Reserved.
    </div>
</footer>

</body>
</html>