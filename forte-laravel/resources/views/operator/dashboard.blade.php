@extends('layouts.app')

@section('content')
    <div class="row gap-4">
        <div class="card bg-dark text-white"> {{-- Monitoring Card --}}
            <div class="mx-4 mt-2 d-flex justify-content-between">
            </div>
            <div class="card-body">
                <div class="row g-3">
                    {{-- Front Camera --}}
                    <div class="col-md-6">
                        <h6 class="text-white mb-2">
                            <i class="bi bi-camera text-white fs-5"></i> Live Front Camera
                        </h6>
                        <div class="card bg-secondary p-2 text-center">
                            <img id="frontCam" class="img-fluid rounded"
                                src="{{ config('services.raspi.host')
                                    ? 'http://' . config('services.raspi.host') . ':' . config('services.raspi.port') . '/video'
                                    : '' }}"
                                alt="Front Camera" />

                            <small class="text-muted">Live MJPEG Stream</small>

                            <small id="frontStatus" class="text-muted"></small>
                        </div>
                    </div>

                    {{-- Back Camera --}}
                    <div class="col-md-6">
                        <h6 class="text-white mb-2 ">
                            <i class="bi bi-camera text-white fs-5"></i> Live Back Camera
                        </h6>
                        <div class="card bg-secondary p-2 text-center">
                            <img id="backImg" class="img-fluid rounded d-none">
                            <video id="backVid" class="w-100 rounded d-none" autoplay muted playsinline></video>
                            <small id="backStatus" class="text-muted"></small>
                        </div>
                    </div>
                </div>

            </div>
            {{-- sec lapor annomali --}}
            <div class="mb-4">
                <div class="card-body">
                    <div class="fw-bold text-white mb-3">Laporkan Anomali</div>

                    <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data"
                        id="reportForm">
                        @csrf
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label text-white">Nama Anomali</label>
                                <input name="title" class="form-control bg-dark text-white" placeholder="Nama Anomali"
                                    required>
                            </div>
                            <div class="col-md-8">
                                <label class="form-label text-white">Deskripsi Anomali</label>
                                <textarea name="description" class="form-control bg-dark text-white" rows="3" placeholder="Deskripsi" required></textarea>
                            </div>
                        </div>

                        {{-- Hidden latitude & longitude --}}
                        <input type="hidden" name="latitude" id="reportLat">
                        <input type="hidden" name="longitude" id="reportLon">

                        {{-- Capture Image --}}
                        <div class="mb-3">
                            <label class="form-label text-white">Gambar Snapshot Front Camera</label>
                            <div class="mb-2">
                                <img id="snapshotPreview" class="img-fluid rounded d-none" alt="Snapshot Preview">
                            </div>
                            <input type="hidden" name="image" id="snapshotInput">
                            <button type="button" class="btn btn-info btn-sm" id="captureBtn">
                                <i class="bi bi-camera me-1"></i> Ambil Snapshot
                            </button>
                        </div>

                        <button type="submit" class="btn btn-success float-end">Simpan Laporan</button>
                    </form>
                </div>
            </div>


        </div>
        <div class="card bg-dark text-white">
            <div class="card-header pb-0">
                <h6 class="text-white mb-0">Monitoring Card</h6>
            </div>

            <div class="card-body">
                <div class="row gap-4">
                    <div class="card bg-dark text-white">
                        <div class="card-body">
                            <div class="row g-3">
                                {{-- Latitude --}}
                                <div class="col-md-4">
                                    <div class="card bg-secondary h-100">
                                        <div class="card-header bg-success text-white py-2 d-flex align-items-center">
                                            <i class="ni ni-pin-3 me-2"></i>
                                            <span>Latitude</span>
                                        </div>
                                        <div class="card-body text-center">
                                            <h4 class="mb-0" id="latitudeCard">-</h4>
                                        </div>
                                    </div>
                                </div>

                                {{-- Longitude --}}
                                <div class="col-md-4">
                                    <div class="card bg-secondary h-100">
                                        <div class="card-header bg-success text-white py-2 d-flex align-items-center">
                                            <i class="ni ni-pin-3 me-2"></i>
                                            <span>Longitude</span>
                                        </div>
                                        <div class="card-body text-center">
                                            <h4 class="mb-0" id="longitudeCard">-</h4>
                                        </div>
                                    </div>
                                </div>

                                {{-- Daya --}}
                                <div class="col-md-4">
                                    <div class="card bg-secondary h-100">
                                        <div class="card-header bg-success text-white py-2 d-flex align-items-center">
                                            <i class="ni ni-bolt me-2"></i>
                                            <span>Daya (kWh)</span>
                                        </div>
                                        <div class="card-body text-center">
                                            <h4 class="mb-0" id="dayaCard">-</h4>
                                        </div>
                                    </div>
                                </div>

                                {{-- Accelerometer X --}}
                                <div class="col-md-4">
                                    <div class="card bg-secondary h-100">
                                        <div class="card-header bg-success text-white py-2">
                                            Accelerometer X
                                        </div>
                                        <div class="card-body text-center">
                                            <h4 class="mb-0" id="accXCard">-</h4>
                                        </div>
                                    </div>
                                </div>

                                {{-- Accelerometer Y --}}
                                <div class="col-md-4">
                                    <div class="card bg-secondary h-100">
                                        <div class="card-header bg-success text-white py-2">
                                            Accelerometer Y
                                        </div>
                                        <div class="card-body text-center">
                                            <h4 class="mb-0" id="accYCard">-</h4>
                                        </div>
                                    </div>
                                </div>

                                {{-- Accelerometer Z --}}
                                <div class="col-md-4">
                                    <div class="card bg-secondary h-100">
                                        <div class="card-header bg-success text-white py-2">
                                            Accelerometer Z
                                        </div>
                                        <div class="card-body text-center">
                                            <h4 class="mb-0" id="accZCard">-</h4>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card bg-dark text-white">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <h6 class="text-white mb-2">
                                <i class="bi bi-speedometer text-white fs-5"></i> RPM Diagram
                            </h6>
                            <div class="card bg-secondary ">
                                <div class="card-body text-center">

                                    <div class="d-flex justify-content-center">
                                        <svg width="260" height="140" viewBox="0 0 260 140">
                                            <!-- Background arc -->
                                            <path d="M20,120 A110,110 0 0 1 240,120" stroke="#333" stroke-width="16"
                                                fill="none" />

                                            <!-- Progress arc -->
                                            <path id="rpmArc" d="M20,120 A110,110 0 0 1 240,120" stroke="#28a745"
                                                stroke-width="16" fill="none" stroke-dasharray="345"
                                                stroke-dashoffset="345" stroke-linecap="round" />

                                            <!-- Text -->
                                            <text x="130" y="95" text-anchor="middle" font-size="36" fill="#fff"
                                                id="rpmValue">0</text>

                                            <text x="130" y="120" text-anchor="middle" font-size="12" fill="#aaa">RPM
                                                × 1000/min</text>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h6 class="text-white mb-2">
                                <i class="bi bi-battery text-white fs-5"></i> Battery Status
                            </h6>
                            <div class="card bg-secondary ">
                                <div class="card-body text-center">
                                    <svg width="140" height="140">
                                        <circle cx="70" cy="70" r="60" stroke="#333" stroke-width="12"
                                            fill="none" />

                                        <circle id="batteryArc" cx="70" cy="70" r="60" stroke="#28a745"
                                            stroke-width="12" fill="none" stroke-dasharray="377"
                                            stroke-dashoffset="377" stroke-linecap="round"
                                            transform="rotate(-90 70 70)" />

                                        <text x="70" y="78" text-anchor="middle" font-size="28" fill="#fff"
                                            id="batteryValue">0%</text>
                                    </svg>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            let polling = null;

            const latitudeCard = document.getElementById('latitudeCard');
            const longitudeCard = document.getElementById('longitudeCard');
            const dayaCard = document.getElementById('dayaCard');

            const accXCard = document.getElementById('accXCard');
            const accYCard = document.getElementById('accYCard');
            const accZCard = document.getElementById('accZCard');

            const reportLat = document.getElementById('reportLat');
            const reportLon = document.getElementById('reportLon');

            function fetchData() {
                fetch("{{ route('fetch.data') }}")
                    .then(res => res.json())
                    .then(res => {

                        /* ================= ENERGY ================= */
                        if (res.energy) {
                            dayaCard.innerText = res.energy.energy_kwh ?
                                res.energy.energy_kwh.toFixed(5) :
                                '-';

                            setBattery(
                                Math.min(
                                    Math.round((res.energy.voltage / 240) * 100),
                                    100
                                )
                            );
                        }

                        /* ================= GPS ================= */
                        if (res.gps) {
                            latitudeCard.innerText = res.gps.lat ?? '-';
                            longitudeCard.innerText = res.gps.lon ?? '-';

                            reportLat.value = res.gps.lat ?? '';
                            reportLon.value = res.gps.lon ?? '';
                        }

                        /* ================= IMU ================= */
                        if (res.imu?.acc) {
                            accXCard.innerText = res.imu.acc[0]?.toFixed(2) ?? '-';
                            accYCard.innerText = res.imu.acc[1]?.toFixed(2) ?? '-';
                            accZCard.innerText = res.imu.acc[2]?.toFixed(2) ?? '-';
                        }

                        /* ================= RPM (SIMULASI DARI POWER) ================= */
                        if (res.energy?.power) {
                            const rpm = Math.min(Math.round(res.energy.power / 2), 100);
                            setRPM(rpm);
                        }
                    })
                    .catch(err => {
                        console.error('MQTT fetch error', err);
                        stopPolling();
                        showOffline();
                    });
            }

            function startPolling() {
                if (!polling) polling = setInterval(fetchData, 1000);
            }

            function stopPolling() {
                clearInterval(polling);
                polling = null;
            }

            function showOffline() {
                [latitudeCard, longitudeCard, dayaCard, accXCard, accYCard, accZCard]
                .forEach(el => el.innerText = '-');
            }

            startPolling();
            fetchData();
        </script>
    @endsection
