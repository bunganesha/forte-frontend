@extends('layouts.app')

@section('content')
    <div class="row gap-4">
        {{-- ================= ENERGY MONITORING ================= --}}
        <div class="card bg-dark text-white">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Energy Monitoring</h6>

                <span id="device-status" class="badge bg-secondary">
                    <i class="fas fa-circle me-1"></i> Checking...
                </span>
            </div>



            <div class="card-body">
                <div class="row g-3">

                    {{-- Voltage --}}
                    <div class="col-md-4">
                        <div class="card bg-secondary h-100">
                            <div class="card-header bg-success">Voltage</div>
                            <div class="card-body text-center">
                                <h4 id="voltageCard">-</h4>
                            </div>
                        </div>
                    </div>

                    {{-- Current --}}
                    <div class="col-md-4">
                        <div class="card bg-secondary h-100">
                            <div class="card-header bg-success">Current</div>
                            <div class="card-body text-center">
                                <h4 id="currentCard">-</h4>
                            </div>
                        </div>
                    </div>

                    {{-- Power --}}
                    <div class="col-md-4">
                        <div class="card bg-secondary h-100">
                            <div class="card-header bg-success">Power</div>
                            <div class="card-body text-center">
                                <h4 id="powerCard">-</h4>
                            </div>
                        </div>
                    </div>

                    {{-- Energy Wh --}}
                    <div class="col-md-4">
                        <div class="card bg-secondary h-100">
                            <div class="card-header bg-success">Energy (Wh)</div>
                            <div class="card-body text-center">
                                <h4 id="energyWhCard">-</h4>
                            </div>
                        </div>
                    </div>

                    {{-- Energy kWh --}}
                    {{-- <div class="col-md-4">
                        <div class="card bg-secondary h-100">
                            <div class="card-header bg-success">Energy (kWh)</div>
                            <div class="card-body text-center">
                                <h4 id="energyKwhCard">-</h4>
                            </div>
                        </div>
                    </div> --}}

                    {{-- Cost --}}
                    <div class="col-md-8">
                        <div class="card bg-secondary h-100">
                            <div class="card-header bg-success">Prediksi Biaya Bulanan </div>
                            <div class="card-body text-center">
                                <h4 id="biayaCard">-</h4>
                            </div>
                        </div>
                    </div>

                </div>
                <div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card bg-dark text-white shadow-lg border-0">
                                <div class="card-header border-0">
                                    <h6 class="mb-0">Power Usage Chart</h6>
                                </div>
                                <div class="card-body">
                                    <canvas id="powerChart" height="90"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card bg-dark text-white shadow-lg border-0">
                                <div class="card-header border-0 d-flex justify-content-between">
                                    <h6 class="mb-0">Energy Log Table</h6>

                                    <div class="d-flex gap-2">
                                        <input type="date" id="filterDate"
                                            class="form-control form-control-sm bg-dark text-white">
                                        <input type="text" id="searchInput"
                                            class="form-control form-control-sm bg-dark text-white" placeholder="Search...">
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-white ps-4">Time</th>
                                                <th class="text-white">Voltage (V)</th>
                                                <th class="text-white">Current (A)</th>
                                                <th class="text-white">Power (W)</th>
                                                <th class="text-white">Energy (kWh)</th>
                                            </tr>
                                        </thead>
                                        <tbody id="logTableBody"></tbody>
                                    </table>
                                </div>

                                <div class="card-footer d-flex justify-content-end">
                                    <nav>
                                        <ul class="pagination pagination-sm mb-0" id="pagination"></ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    {{-- ================= JAVASCRIPT ================= --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let currentPage = 1;
        let powerChart;
        let polling = null;

        const voltageCard = document.getElementById('voltageCard');
        const currentCard = document.getElementById('currentCard');
        const powerCard = document.getElementById('powerCard');
        const energyWhCard = document.getElementById('energyWhCard');
        const energyKwhCard = document.getElementById('energyKwhCard');
        const biayaCard = document.getElementById('biayaCard');

        function fetchData() {
            fetch("{{ route('mqttfetch.data') }}")
                .then(res => res.json())
                .then(res => {
                    if (!res.energy) return;
                    const e = res.energy;

                    voltageCard.innerText = e.voltage.toFixed(1) + ' V';
                    currentCard.innerText = e.current.toFixed(2) + ' A';
                    powerCard.innerText = e.power.toFixed(1) + ' W';
                    energyWhCard.innerText = e.energy.toFixed(3) + ' Wh';
                    energyKwhCard.innerText = e.energy_kwh.toFixed(5) + ' kWh';
                    biayaCard.innerText = 'Rp ' + e.biaya_rp;

                    setRPM(Math.min(Math.round(e.power / 2), 100));
                    setBattery(Math.min(Math.round((e.voltage / 240) * 100), 100));
                })
                .catch(() => stopPolling());
        }



        function updateCards(e, predictedCost) {
            biayaCard.innerText = predictedCost ? 'Rp ' + predictedCost.toLocaleString() : 'Rp ' + e.biaya_rp;

            setRPM(Math.min(Math.round(e.power / 2), 100));
            setBattery(Math.min(Math.round((e.voltage / 240) * 100), 100));
        }

        function fetchAll() {
            document.getElementById('searchInput').addEventListener('input', () => loadLogs());
            document.getElementById('filterDate').addEventListener('change', () => loadLogs());

            fetch('/api/power/prediction')
                .then(res => res.json())
                .then(costData => {
                    if (costData.predicted_cost) {
                        biayaCard.innerText = 'Rp ' + costData.predicted_cost.toLocaleString();
                    }
                })
                .catch(err => console.error(err));
        }

        function loadLogs(page = 1) {
            const search = document.getElementById('searchInput').value;
            const date = document.getElementById('filterDate').value;

            fetch(`/power/api/log-table?page=${page}&search=${search}&date=${date}`)
                .then(res => res.json())
                .then(res => {
                    const tbody = document.getElementById('logTableBody');
                    tbody.innerHTML = '';

                    res.data.forEach((r, i) => {
                        tbody.innerHTML += `
                        <tr style="background-color:${i % 2 ? '#1a1a1a' : '#14451a'}">
                            <td class="ps-4 text-xs">${r.created_at}</td>
                            <td>${r.voltage}</td>
                            <td>${r.current}</td>
                            <td>${r.power}</td>
                            <td>${r.energy_kwh}</td>
                        </tr>`;
                    });

                    renderPagination(res);
                });
        }

        function renderPagination(res) {
            const pag = document.getElementById('pagination');
            pag.innerHTML = '';

            for (let i = 1; i <= res.last_page; i++) {
                pag.innerHTML += `
                <li class="page-item ${i === res.current_page ? 'active' : ''}">
                    <button class="page-link bg-dark text-white" onclick="loadLogs(${i})">${i}</button>
                </li>`;
            }
        }

        function loadChart() {
            fetch('/power/api/chart-power')
                .then(res => res.json())
                .then(data => {
                    const labels = data.map(d => d.time);
                    const values = data.map(d => d.power);

                    if (!powerChart) {
                        powerChart = new Chart(document.getElementById('powerChart'), {
                            type: 'line',
                            data: {
                                labels,
                                datasets: [{
                                    label: 'Power (W)',
                                    data: values,
                                    borderColor: '#00ff99',
                                    tension: 0.3
                                }]
                            }
                        });
                    } else {
                        powerChart.data.labels = labels;
                        powerChart.data.datasets[0].data = values;
                        powerChart.update();
                    }
                });
        }

        function setRPM(value) {
            const arc = document.getElementById('rpmArc');
            const text = document.getElementById('rpmValue');
            arc.style.strokeDashoffset = 345 * (1 - value / 100);
            text.innerText = value;
        }

        function setBattery(percent) {
            const arc = document.getElementById('batteryArc');
            const text = document.getElementById('batteryValue');
            arc.style.strokeDashoffset = 377 * (1 - percent / 100);
            text.innerText = percent + '%';
        }

        const statusBadge = document.getElementById('device-status');

        function setStatus(isOnline) {
            if (isOnline) {
                statusBadge.className = 'badge bg-success';
                statusBadge.innerHTML = '<i class="fas fa-circle me-1"></i> ONLINE';
            } else {
                statusBadge.className = 'badge bg-danger';
                statusBadge.innerHTML = '<i class="fas fa-circle me-1"></i> OFFLINE';
            }
        }

        /* ===================== STATE ===================== */
        let voltage = 225; // Volt
        let current = 1.2; // Ampere
        let energyWh = 0; // Akumulasi Wh
        let lastUpdate = Date.now();

        const TARIFF = 1444; // Rp / kWh

        /* ===================== UTIL ===================== */
        function rand(min, max, fixed = 2) {
            return +(Math.random() * (max - min) + min).toFixed(fixed);
        }

        function clamp(v, min, max) {
            return Math.min(Math.max(v, min), max);
        }

        /* ===================== DUMMY UPDATE ===================== */
        function updateEnergyDummy() {

            const now = Date.now();
            const deltaHour = (now - lastUpdate) / 3600000;
            lastUpdate = now;

            /* Voltage relatif stabil */
            voltage += rand(-0.5, 0.5);
            voltage = clamp(voltage, 215, 230);

            /* Current fluktuatif */
            current += rand(-0.05, 0.08);
            current = clamp(current, 0.3, 3.5);

            /* Power (W) */
            const power = voltage * current;

            /* Energy accumulation */
            energyWh += power * deltaHour;

            /* kWh */
            const energyKwh = energyWh / 1000;

            /* Biaya */
            // const biaya = energyKwh * TARIFF;

            /* ================= UPDATE UI ================= */
            voltageCard.innerText = voltage.toFixed(1) + ' V';
            currentCard.innerText = current.toFixed(2) + ' A';
            powerCard.innerText = power.toFixed(1) + ' W';
            energyWhCard.innerText = energyWh.toFixed(3) + ' Wh';
            // biayaCard.innerText = 'Rp ' + Math.round(biaya).toLocaleString();

            /* Status ONLINE */
            setStatus(true);
        }

        function fetchPrediction() {
            fetch('/power/api/prediction')
                .then(res => res.json())
                .then(res => {
                    if (res.predicted_cost !== undefined) {
                        biayaCard.innerText =
                            'Rp ' + Number(res.predicted_cost).toLocaleString('id-ID');
                    }
                })
                .catch(err => console.error('Prediction error:', err));
        }


        setInterval(updateEnergyDummy, 1000);
        updateEnergyDummy();
        loadLogs();
        loadChart();
        fetchPrediction();
    </script>
@endsection
