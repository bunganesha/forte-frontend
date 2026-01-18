<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Rover - FORTE</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Fonts (Poppins) --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        /* --- Global Styles --- */
        body {
            background-color: #1a1a1a;
            font-family: 'Poppins', sans-serif;
            color: white;
            margin: 0;
            overflow-x: hidden;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* --- Navbar Styling --- */
        .navbar-forte {
            padding: 20px 50px;
            z-index: 10;
        }

        .navbar-brand img {
            height: 20px;
            width: auto;
        }

        .nav-link {
            color: #ccc !important;
            margin: 0 15px;
            font-size: 1rem;
            font-weight: 400;
            transition: color 0.3s;
        }

        .nav-link:hover,
        .nav-link.active {
            color: white !important;
            font-weight: 500;
        }

        /* Profile Pill */
        .profile-pill {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 5px 10px;
        }

        .avatar-circle {
            width: 35px;
            height: 35px;
            background-color: #2d7a32;
            color: white;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .user-name {
            font-size: 0.9rem;
            color: white;
            font-weight: 500;
        }

        /* --- Main Layout --- */
        .content-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            padding: 40px 50px;
            transition: filter 0.3s;
            /* Untuk efek blur saat modal aktif */
        }

        /* Background Lines */
        .bg-lines {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 60%;
            height: 100%;
            background: repeating-linear-gradient(120deg,
                    transparent,
                    transparent 20px,
                    rgba(45, 122, 50, 0.2) 20px,
                    rgba(45, 122, 50, 0.05) 22px);
            mask-image: radial-gradient(circle at bottom right, black, transparent 70%);
            -webkit-mask-image: radial-gradient(circle at bottom right, black, transparent 70%);
            z-index: 1;
            pointer-events: none;
        }

        /* --- Cards Styling --- */
        .info-card {
            background-color: #444;
            border-radius: 30px;
            padding: 40px;
            height: 100%;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            position: relative;
            z-index: 5;
        }

        .info-card h3 {
            font-weight: 500;
            font-size: 1.8rem;
            margin-bottom: 25px;
            letter-spacing: 1px;
        }

        .info-card p {
            color: #ddd;
            font-size: 0.95rem;
            line-height: 1.8;
            font-weight: 300;
            text-align: justify;
        }

        .feature-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .feature-list li {
            position: relative;
            padding-left: 20px;
            margin-bottom: 15px;
            color: #ddd;
            font-size: 1rem;
            line-height: 1.5;
            font-weight: 300;
        }

        .feature-list li::before {
            content: "•";
            position: absolute;
            left: 0;
            color: white;
            font-size: 1.2rem;
            top: -2px;
        }

        /* Middle Column Styles */
        .middle-box-empty {
            background-color: #444;
            border-radius: 30px;
            height: 300px;
            width: 100%;
            margin-bottom: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 5;
        }

        .middle-box-img {
            background-color: #444;
            border-radius: 30px;
            height: 250px;
            width: 100%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            z-index: 5;
            overflow: hidden;
        }

        .rover-thumb {
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
        }

        .expand-icon {
            position: absolute;
            bottom: 20px;
            right: 25px;
            font-size: 1.5rem;
            color: white;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .expand-icon:hover {
            transform: scale(1.2);
        }

        /* --- MODAL OVERLAY STYLING (NEW) --- */
        .rover-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.7);
            /* Background gelap transparan */
            backdrop-filter: blur(10px);
            /* Efek Blur kuat sesuai gambar */
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s;
        }

        .rover-modal.active {
            opacity: 1;
            visibility: visible;
        }

        .rover-3d-img {
            max-width: 80vw;
            max-height: 60vh;
            object-fit: contain;
            filter: drop-shadow(0 20px 40px rgba(0, 0, 0, 0.6));
            margin-bottom: 30px;
        }

        .modal-controls {
            display: flex;
            gap: 15px;
        }

        .btn-control {
            width: 50px;
            height: 50px;
            background-color: white;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .btn-control:hover {
            transform: scale(1.1);
        }

        .btn-control i {
            color: black;
            font-size: 1.5rem;
        }

        @media (max-width: 992px) {
            .navbar-forte {
                padding: 15px 20px;
            }

            .content-container {
                padding: 20px;
            }

            .info-card {
                padding: 30px;
                height: auto;
            }

            .middle-box-empty,
            .middle-box-img {
                height: 250px;
            }
        }
    </style>
</head>

<body>

    <x-navigation.navbar
        :items="[
            ['route' => 'dashboard', 'label' => 'Dashboard'],
            ['route' => 'settings.index', 'label' => 'Setting'],
            ['route' => 'about', 'label' => 'About Rover']
        ]"
    />

    <div class="content-container" id="mainContent">
        <div class="bg-lines"></div>

        <div class="container-fluid px-lg-5">
            <div class="row g-4 align-items-stretch">

                <div class="col-lg-4">
                    <div class="info-card">
                        <h3>ROVER</h3>
                        <p>
                            (Remote Operated Vehicle for Environmental Reconnaissance) adalah sebuah mobil RC
                            multifungsi yang
                            dirancang untuk menjelajahi area sulit dijangkau oleh manusia.
                        </p>
                        <p>
                            Dilengkapi dengan kamera, sensor jarak, serta sistem kendali berbasis web/mobile, ROVER
                            mampu
                            melakukan pemetaan jalur (area mapping), pelacakan manusia (human tracking), dan deteksi
                            rintangan secara real-time.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 d-flex flex-column">
                    <div class="middle-box-empty"></div>

                    <div class="middle-box-img">
                        <img src="{{ asset('assets/img/2 1.png') }}" alt="Rover Thumbnail" class="rover-thumb">
                        <i class="bi bi-arrows-fullscreen expand-icon" onclick="openModal()"></i>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="info-card">
                        <h3>Fitur</h3>
                        <ul class="feature-list">
                            <li>Kontrol jarak jauh via web/mobile</li>
                            <li>Monitoring video real-time</li>
                            <li>Monitoring Hardware Produk via Web/Mobile</li>
                            <li>Human tracking otomatis</li>
                            <li>Area mapping</li>
                            <li>Deteksi rintangan (obstacle detection)</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div id="roverModal" class="rover-modal">
        <img src="{{ asset('assets/img/rover-removebg.png') }}" alt="Rover Side View" class="rover-3d-img">

        <div class="modal-controls">
            <div class="btn-control">
                <i class="bi bi-arrows-move"></i>
            </div>
            <div class="btn-control">
                <i class="bi bi-arrow-repeat"></i>
            </div>
            <div class="btn-control" onclick="closeModal()">
                <i class="bi bi-x-lg"></i>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function openModal() {
            // Tampilkan Modal
            document.getElementById('roverModal').classList.add('active');
            // Opsional: Blur konten belakang agar lebih fokus
            document.getElementById('mainContent').style.filter = "blur(5px)";
        }

        function closeModal() {
            // Sembunyikan Modal
            document.getElementById('roverModal').classList.remove('active');
            // Hilangkan Blur
            document.getElementById('mainContent').style.filter = "none";
        }
    </script>
</body>

</html>
