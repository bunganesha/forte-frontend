<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controller Setting - FORTE</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Fonts (Poppins) --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
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
        }

        /* Background Lines (Hiasan) */
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

        /* --- Main Card Styling --- */
        .card-controller {
            background-color: #3b3b3b;
            border-radius: 30px;
            width: 100%;
            max-width: 1000px;
            padding: 40px;
            position: relative;
            z-index: 5;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.5);
        }

        /* --- Panel Styles (Left Side) --- */
        .panel-light {
            background-color: #dcdcdc;
            border-radius: 20px;
            padding: 15px 25px;
            color: #222;
            margin-bottom: 20px;
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 700;
            font-size: 1.1rem;
            cursor: pointer;
        }

        /* Setting Item Row */
        .setting-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            font-weight: 600;
            font-size: 1rem;
            user-select: none;
            /* Supaya teks tidak terblok saat klik cepat */
        }

        .setting-row:last-child {
            margin-bottom: 0;
        }

        /* Value Spinner (60 ^ v) */
        .spinner-box {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
            color: #444;
        }

        /* Class khusus untuk angka agar mudah diakses JS */
        .value-display {
            min-width: 25px;
            /* Mencegah layout goyang saat angka berubah */
            text-align: right;
        }

        .spinner-arrows {
            display: flex;
            flex-direction: column;
            justify-content: center;
            line-height: 0.6;
            color: #888;
            cursor: pointer;
        }

        .spinner-arrows i {
            transition: color 0.2s;
        }

        .spinner-arrows i:hover {
            color: #222;
            /* Warna lebih gelap saat hover */
        }

        .spinner-arrows i:active {
            color: #2d7a32;
            /* Warna hijau saat diklik */
        }

        /* Key Mapping Section */
        .key-mapping-container {
            max-height: 140px;
            overflow-y: auto;
            padding-right: 5px;
        }

        .key-row {
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid #bbb;
            padding: 8px 0;
            font-weight: 600;
        }

        .key-row:last-child {
            border-bottom: none;
        }

        /* Scrollbar Styling Custom */
        .key-mapping-container::-webkit-scrollbar {
            width: 6px;
        }

        .key-mapping-container::-webkit-scrollbar-thumb {
            background-color: #999;
            border-radius: 10px;
        }

        .key-mapping-container::-webkit-scrollbar-track {
            background-color: transparent;
        }

        .wheel-img-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .wheel-img {
            max-width: 100%;
            height: auto;
            filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.5));
        }

        @media (max-width: 768px) {
            .navbar-forte {
                padding: 15px 20px;
            }

            .content-container {
                padding: 20px;
            }

            .card-controller {
                padding: 20px;
            }

            .wheel-img {
                margin-top: 30px;
                max-width: 80%;
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

    <div class="content-container">
        <div class="bg-lines"></div>

        <div class="card-controller">
            <div class="row align-items-center">

                <div class="col-lg-5">

                    <div class="panel-light panel-header">
                        <span>Steering Wheel</span>
                        <div class="d-flex flex-column lh-1 text-secondary" style="font-size: 0.6rem;">
                            <i class="bi bi-caret-up-fill"></i>
                            <i class="bi bi-caret-down-fill"></i>
                        </div>
                    </div>

                    <div class="panel-light">
                        <div class="setting-row">
                            <span>Vibration Scale</span>
                            <div class="spinner-box">
                                <span class="value-display">60</span>
                                <div class="spinner-arrows">
                                    <i class="bi bi-caret-up-fill" onclick="updateValue(this, 1)"></i>
                                    <i class="bi bi-caret-down-fill" onclick="updateValue(this, -1)"></i>
                                </div>
                            </div>
                        </div>

                        <div class="setting-row">
                            <span>Feedback Scale</span>
                            <div class="spinner-box">
                                <span class="value-display">60</span>
                                <div class="spinner-arrows">
                                    <i class="bi bi-caret-up-fill" onclick="updateValue(this, 1)"></i>
                                    <i class="bi bi-caret-down-fill" onclick="updateValue(this, -1)"></i>
                                </div>
                            </div>
                        </div>

                        <div class="setting-row">
                            <span>Load Sensitivity</span>
                            <div class="spinner-box">
                                <span class="value-display">60</span>
                                <div class="spinner-arrows">
                                    <i class="bi bi-caret-up-fill" onclick="updateValue(this, 1)"></i>
                                    <i class="bi bi-caret-down-fill" onclick="updateValue(this, -1)"></i>
                                </div>
                            </div>
                        </div>

                        <div class="setting-row">
                            <span>Road Feel Scale</span>
                            <div class="spinner-box">
                                <span class="value-display">60</span>
                                <div class="spinner-arrows">
                                    <i class="bi bi-caret-up-fill" onclick="updateValue(this, 1)"></i>
                                    <i class="bi bi-caret-down-fill" onclick="updateValue(this, -1)"></i>
                                </div>
                            </div>
                        </div>

                        <div class="setting-row">
                            <span>Steering Sensitivity</span>
                            <div class="spinner-box">
                                <span class="value-display">60</span>
                                <div class="spinner-arrows">
                                    <i class="bi bi-caret-up-fill" onclick="updateValue(this, 1)"></i>
                                    <i class="bi bi-caret-down-fill" onclick="updateValue(this, -1)"></i>
                                </div>
                            </div>
                        </div>

                        <div class="setting-row">
                            <span>Steering Linearity</span>
                            <div class="spinner-box">
                                <span class="value-display">60</span>
                                <div class="spinner-arrows">
                                    <i class="bi bi-caret-up-fill" onclick="updateValue(this, 1)"></i>
                                    <i class="bi bi-caret-down-fill" onclick="updateValue(this, -1)"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-light">
                        <div class="setting-row mb-2">
                            <span>Key</span>
                        </div>
                        <div class="key-mapping-container">
                            <div class="key-row">
                                <span>Menu</span>
                                <span>Esc</span>
                            </div>
                            <div class="key-row">
                                <span>Camera</span>
                                <span>R3</span>
                            </div>
                            <div class="key-row">
                                <span>Horn</span>
                                <span>R2</span>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-7">
                    <div class="wheel-img-container">
                        <img src="{{ asset('assets/img/wheel.png') }}" class="wheel-img"
                            alt="Logitech G29 Steering Wheel">
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- SCRIPT UNTUK INTERAKSI ANGKA --}}
    <script>
        /**
         * Fungsi untuk mengubah nilai angka
         * @param {HTMLElement} element - Elemen icon yang diklik
         * @param {number} change - Jumlah perubahan (+1 atau -1)
         */
        function updateValue(element, change) {
            // 1. Cari elemen induk 'spinner-box' dari icon yang diklik
            const spinnerBox = element.closest('.spinner-box');

            // 2. Cari elemen 'span' yang menampilkan angka di dalam box tersebut
            const display = spinnerBox.querySelector('.value-display');

            // 3. Ambil nilai saat ini dan ubah ke integer
            let currentValue = parseInt(display.innerText);

            // 4. Hitung nilai baru
            let newValue = currentValue + change;

            // 5. Batasi nilai antara 0 sampai 100
            if (newValue > 100) newValue = 100;
            if (newValue < 0) newValue = 0;

            // 6. Tampilkan nilai baru
            display.innerText = newValue;
        }
    </script>
</body>

</html>
