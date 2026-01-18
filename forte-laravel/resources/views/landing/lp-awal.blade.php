<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - FORTE</title>
    {{-- Menggunakan CDN Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #1a1a1a;
            font-family: 'Poppins', sans-serif;
            color: white;
            margin: 0;
            overflow-x: hidden;
        }

        /* --- Navbar Styling --- */
        .navbar-forte {
            padding: 20px 50px;
            background-color: rgba(26, 26, 26, 0.95);
            /* Sedikit transparan saat scroll */
            backdrop-filter: blur(10px);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid #333;
        }

        .navbar-brand img {
            height: 25px;
            /* Sedikit diperbesar */
            width: auto;
        }

        .nav-link {
            color: #ccc !important;
            margin: 0 10px;
            font-size: 0.9rem;
            transition: color 0.3s;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #4caf50 !important;
            /* Hijau terang saat hover */
        }

        .btn-daftar-nav {
            background-color: #2d7a32;
            color: white !important;
            border-radius: 20px;
            padding: 8px 25px !important;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn-daftar-nav:hover {
            background-color: #3e8e41;
            transform: scale(1.05);
        }

        /* --- General Layout --- */
        section {
            padding: 80px 0;
        }

        .section-title {
            font-weight: 700;
            margin-bottom: 20px;
            position: relative;
            display: inline-block;
            color: #4caf50;
            /* Aksen Hijau */
        }

        .section-subtitle {
            color: #ccc;
            margin-bottom: 50px;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        /* --- Hero Section --- */
        .hero-section {
            min-height: 90vh;
            display: flex;
            align-items: center;
            position: relative;
            padding: 0 50px;
            overflow: hidden;
            border-bottom: 1px solid #333;
        }

        .hero-text h1 {
            font-size: 2.8rem;
            font-weight: 700;
            margin-bottom: 20px;
            color: white;
            line-height: 1.2;
        }

        .hero-text p {
            font-size: 1.1rem;
            color: #bbb;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .btn-mulai {
            background-color: #2d7a32;
            color: white;
            border: none;
            border-radius: 30px;
            padding: 12px 50px;
            font-size: 1.1rem;
            font-weight: 600;
            transition: 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-mulai:hover {
            background-color: #3e8e41;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 5px 20px rgba(45, 122, 50, 0.4);
        }

        /* Rover Image */
        .rover-container {
            position: relative;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .rover-img {
            max-width: 110%;
            height: auto;
            position: relative;
            z-index: 2;
            transform: translateX(5%);
            filter: drop-shadow(0 0 20px rgba(0, 0, 0, 0.5));
        }

        /* Background Lines */
        .bg-lines {
            position: absolute;
            top: 0;
            right: 0;
            width: 60%;
            height: 100%;
            background: repeating-linear-gradient(45deg,
                    transparent,
                    transparent 10px,
                    rgba(45, 122, 50, 0.05) 10px,
                    rgba(45, 122, 50, 0.05) 11px);
            z-index: 1;
            mask-image: linear-gradient(to right, transparent, black);
            -webkit-mask-image: linear-gradient(to right, transparent, black);
        }

        /* --- Features Cards --- */
        .feature-card {
            background-color: #222;
            border: 1px solid #333;
            padding: 30px;
            border-radius: 15px;
            height: 100%;
            transition: 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            border-color: #2d7a32;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .feature-icon {
            font-size: 2rem;
            color: #4caf50;
            margin-bottom: 20px;
        }

        /* --- Footer / Contact --- */
        .footer-section {
            background-color: #111;
            border-top: 1px solid #333;
            padding: 60px 0 20px 0;
        }

        .map-container iframe {
            width: 100%;
            height: 300px;
            border-radius: 15px;
            border: 2px solid #333;
        }

        /* --- Responsive Styles --- */
        @media (max-width: 768px) {
            .navbar-forte {
                padding: 15px 20px;
            }

            .hero-section {
                padding: 40px 20px;
                flex-direction: column;
                justify-content: center;
                text-align: center;
                min-height: auto;
            }

            .hero-text h1 {
                font-size: 2rem;
            }

            .rover-container {
                justify-content: center;
                margin-top: 40px;
            }

            .rover-img {
                max-width: 90%;
                transform: none;
            }

            section {
                padding: 50px 20px;
            }
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-forte navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('assets/img/FORTE.png') }}" alt="FORTE Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    <li class="nav-item ps-2"><a class="nav-link btn-daftar-nav" href="{{ route('login') }}">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid hero-section">
        <div class="bg-lines"></div>

        <div class="row w-100 align-items-center m-0">
            <div class="col-lg-6 ps-lg-5 hero-text position-relative" style="z-index: 5;">
                <h1>FORTE: Sistem Monitoring IoT & Laporan Insiden</h1>
                <p>Pantau sensor secara real-time, kirim laporan dengan foto dan lokasi, serta kelola data dengan mudah
                    dan aman. FORTE menghadirkan solusi terpadu untuk pemantauan kondisi dan manajemen laporan, semua
                    dalam satu platform interaktif.</p>

                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-mulai">Ke Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-mulai">Mulai Sekarang</a>
                    @endauth
                @endif
            </div>

            <div class="col-lg-6 rover-container">
                <img src="{{ asset('assets/img/2 1.png') }}" class="rover-img" alt="Forte Rover">
            </div>
        </div>
    </div>

    <section id="about" style="background-color: #202020;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="section-title">About FORTE</h2>
                    <p class="text-secondary mb-4">IoT Monitoring & Reporting System</p>

                    <p style="text-align: justify; color: #ccc;">
                        FORTE adalah sistem monitoring berbasis IoT yang dirancang untuk memudahkan pengguna dalam
                        memantau berbagai sensor secara akurat dan real-time. Setiap sensor mencatat data penting
                        seperti daya, posisi, akselerasi, dan anomali yang terdeteksi, sehingga pengguna dapat langsung
                        mengambil keputusan berdasarkan informasi terbaru.
                    </p>
                    <p style="text-align: justify; color: #ccc;">
                        Pengguna dapat mengirim laporan kondisi atau insiden melalui dashboard dengan menyertakan gambar
                        dan lokasi GPS. Laporan tersebut divalidasi oleh admin untuk memastikan keakuratan data. Semua
                        aktivitas tercatat secara sistematis, memberikan histori lengkap dan mudah diakses kapan saja.
                    </p>
                    <p style="text-align: justify; color: #ccc;">
                        Sistem ini mendukung manajemen user berbasis role, termasuk user biasa, admin, dan superadmin,
                        sehingga hak akses dan kontrol terhadap data menjadi jelas dan terstruktur. FORTE juga
                        menyediakan dashboard visual dengan grafik dan statistik untuk memudahkan pemantauan tren data
                        sensor serta laporan secara keseluruhan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="features">
        <div class="container">
            <div class="text-center">
                <h2 class="section-title">Key Features</h2>
                <p class="section-subtitle">Teknologi canggih untuk efisiensi pemantauan dan pelaporan.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <i class="bi bi-speedometer2 feature-icon"></i>
                        <h5>Monitoring Sensor Real-Time</h5>
                        <p class="text small">Pantau berbagai sensor dengan parameter seperti daya, akselerasi,
                            dan lokasi secara langsung dari dashboard interaktif.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <i class="bi bi-file-earmark-text feature-icon"></i>
                        <h5>Pengiriman Laporan Mudah</h5>
                        <p class="text small">Kirim laporan lengkap dengan foto dan koordinat GPS secara cepat,
                            yang kemudian bisa divalidasi oleh admin.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <i class="bi bi-check-circle feature-icon"></i>
                        <h5>Validasi & Transaksi</h5>
                        <p class="text small">Setiap laporan yang disetujui admin dapat menghasilkan transaksi
                            yang tercatat secara sistematis, memudahkan kontrol dan histori pelaporan.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <i class="bi bi-people feature-icon"></i>
                        <h5>Manajemen User Berbasis Role</h5>
                        <p class="text small">Mengatur hak akses user, admin, dan superadmin dengan jelas,
                            memastikan keamanan dan kontrol data.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <i class="bi bi-graph-up feature-icon"></i>
                        <h5>Dashboard Grafik & Statistik</h5>
                        <p class="text small">Visualisasi data sensor dan laporan dalam bentuk grafik yang
                            informatif, memudahkan analisis tren dan pengambilan keputusan.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <i class="bi bi-phone feature-icon"></i>
                        <h5>Responsive & Modern</h5>
                        <p class="text small">Tampilan yang responsif mendukung berbagai perangkat, dengan UI
                            minimalis dan mudah digunakan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="developers" style="background-color: #202020;">
        <div class="container text-center">
            <h2 class="section-title">About the Developers</h2>
            <div class="col-lg-8 mx-auto mt-4">
                <p class="text-light">
                    FORTE dikembangkan oleh tim mahasiswa <strong>
                        <ul class="menu"> Kelompok D6 <li>152024127 Dzakiyya Puteri Aulia</li>
                            <li>152024198 Zahratu Thohiroh Sunanto</li>
                            <li>152024160 Satria Radja Anugerah</li>
                        </ul>
                    </strong> sebagai
                    proyek akhir Ujian Semester.
                </p>
                <p class="text-light">
                    Tim kami memiliki tujuan untuk menciptakan sistem monitoring yang mudah digunakan, aman, dan
                    efisien.
                    Kami mengutamakan pengembangan yang berbasis <em>best practice</em> Laravel dan UI/UX modern agar
                    pengalaman pengguna menjadi optimal.
                </p>
            </div>
        </div>
    </section>

    <footer class="footer-section" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mb-4">
                    <h3 class="text-white mb-4">FORTE</h3>
                    <p class="text">Jika Anda ingin informasi lebih lanjut atau membutuhkan bantuan, jangan ragu
                        untuk menghubungi kami.</p>

                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-envelope-fill me-3 text-success"></i>
                        <span>support@forte.com</span>
                    </div>

                    <p class="small text mt-5">&copy; {{ date('Y') }} FORTE System. All Rights Reserved.</p>
                </div>

                <div class="col-lg-7">
                    <h5 class="mb-3">Lokasi Lab Pengembangan</h5>
                    <div class="map-container">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.945155687894!2d107.63618863782041!3d-6.897163439258578!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e7bb3ecbe445%3A0xc603604dc4fa418!2sGedung%20Informatika%20Itenas%20-%20Gedung%202!5e0!3m2!1sid!2sid!4v1767282611822!5m2!1sid!2sid"
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scrolling untuk link navbar
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>

</html>
