<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - FORTE</title>

    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Google Fonts --}}
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
            z-index: 100;
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

        .profile-pill {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 5px 10px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 30px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .avatar-circle-nav {
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

        /* --- Main Layout --- */
        .profile-container {
            flex: 1;
            padding: 40px 50px;
            position: relative;
        }

        /* Background Lines Pattern */
        .bg-lines {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 50%;
            height: 100%;
            background: repeating-linear-gradient(120deg,
                    transparent,
                    transparent 20px,
                    rgba(45, 122, 50, 0.15) 20px,
                    rgba(45, 122, 50, 0.05) 22px);
            mask-image: radial-gradient(circle at bottom right, black, transparent 80%);
            -webkit-mask-image: radial-gradient(circle at bottom right, black, transparent 80%);
            z-index: 1;
            pointer-events: none;
        }

        /* --- Cards Styling --- */
        .card-profile {
            background-color: #2c2c2c;
            border-radius: 20px;
            padding: 30px;
            height: 100%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
            position: relative;
            z-index: 5;
            border: 1px solid #333;
            transition: transform 0.3s ease;
        }

        /* Avatar Besar di Halaman Profile */
        .profile-avatar-lg {
            width: 120px;
            height: 120px;
            background-color: #2d7a32;
            color: white;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 3rem;
            font-weight: 600;
            margin: 0 auto 20px auto;
            border: 4px solid #1a1a1a;
            box-shadow: 0 0 20px rgba(45, 122, 50, 0.5);
            text-transform: uppercase;
        }

        .user-role-badge {
            background-color: rgba(45, 122, 50, 0.2);
            color: #4caf50;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-block;
            margin-bottom: 20px;
            border: 1px solid #2d7a32;
        }

        /* Detail List Styling */
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #444;
            font-size: 0.95rem;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            color: #888;
        }

        .detail-value {
            font-weight: 500;
            color: white;
        }

        .btn-edit-profile {
            background-color: #2d7a32;
            color: white;
            width: 100%;
            border: none;
            padding: 10px;
            border-radius: 12px;
            margin-top: 20px;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn-edit-profile:hover {
            background-color: #3e8e41;
            box-shadow: 0 5px 15px rgba(45, 122, 50, 0.3);
        }

        /* --- Modal Custom Style (Dark Theme) --- */
        .modal-content-dark {
            background-color: #2c2c2c;
            color: white;
            border: 1px solid #444;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.8);
        }

        .modal-header {
            border-bottom: 1px solid #444;
        }

        .modal-footer {
            border-top: 1px solid #444;
        }

        .form-control-dark {
            background-color: #1a1a1a;
            border: 1px solid #444;
            color: white;
            padding: 10px 15px;
        }

        .form-control-dark:focus {
            background-color: #222;
            border-color: #2d7a32;
            color: white;
            box-shadow: 0 0 0 0.25rem rgba(45, 122, 50, 0.25);
        }

        .btn-close-white {
            filter: invert(1) grayscale(100%) brightness(200%);
        }

        /* --- Chart Sections --- */
        .chart-container {
            position: relative;
            height: 200px;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .credit-score-overlay {
            position: absolute;
            top: 55%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .score-val {
            font-size: 2.5rem;
            font-weight: 700;
            color: white;
            line-height: 1;
            transition: color 0.5s;
        }

        .score-label {
            font-size: 0.8rem;
            color: #aaa;
            text-transform: uppercase;
            font-weight: 600;
        }

        .points-card {
            background: linear-gradient(135deg, #2c2c2c 0%, #202020 100%);
        }

        .points-highlight {
            font-size: 1.5rem;
            font-weight: 700;
            color: #4caf50;
            transition: all 0.5s;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .navbar-forte {
                padding: 15px 20px;
            }

            .profile-container {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    {{-- Navbar --}}
    <x-navigation.navbar :items="[
        ['route' => 'dashboard', 'label' => 'Dashboard'],
        ['route' => 'settings.index', 'label' => 'Setting'],
        ['route' => 'about', 'label' => 'About Rover'],
    ]" />

    {{-- Main Content --}}
    <div class="profile-container">
        <div class="bg-lines"></div>

        <div class="row g-4">
            {{-- Kiri: Data Pribadi --}}
            <div class="col-lg-4 col-md-5">
                <div class="card-profile text-center">
                    {{-- Avatar Besar --}}
                    <div class="profile-avatar-lg">
                        {{ Auth::user()->username ? substr(strtoupper(Auth::user()->username), 0, 2) : 'AU' }}
                    </div>

                    <h4 class="mb-1">{{ Auth::user()->username }}</h4>
                    <span class="user-role-badge">{{ Auth::user()->roles->first()?->name ?? 'User' }}</span>

                    <div class="text-start mt-3">
                        <div class="detail-row">
                            <span class="detail-label">Email</span>
                            <span class="detail-value">{{ Auth::user()->email }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Credit Score</span>
                            <span class="detail-value">{{ Auth::user()->credit_score }}/100</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Member Since</span>
                            <span class="detail-value">{{ Auth::user()->created_at->format('M Y') }}</span>
                        </div>
                        <div class="detail-row border-0">
                            <span class="detail-label">Status</span>
                            <span class="text-success fw-bold"><i class="bi bi-circle-fill" style="font-size: 8px;"></i>
                                Active</span>
                        </div>
                    </div>

                    {{-- Tombol untuk Membuka Modal Edit --}}
                    <button class="btn-edit-profile" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        <i class="bi bi-pencil-square me-2"></i> Edit Profile
                    </button>
                </div>
            </div>

            {{-- Kanan: Statistik & Chart --}}
            <div class="col-lg-8 col-md-7">
                <div class="row g-4">
                    {{-- Credit Score Card --}}
                    <div class="col-md-6">
                        <div class="card-profile">
                            <h5 class="mb-4 d-flex align-items-center justify-content-between">
                                <span><i class="bi bi-shield-check me-2 text-success"></i> Credit Score</span>
                            </h5>

                            <div class="chart-container">
                                <canvas id="creditScoreChart"></canvas>
                                <div class="credit-score-overlay">
                                    <div class="score-val" id="scoreValue">{{ $creditScoreInfo['score'] }}</div>
                                    <div class="score-label" id="scoreLabel">{{ $creditScoreInfo['category'] }}</div>
                                </div>
                            </div>
                            <p class="text-center text-muted small mt-2">
                                {{ $creditScoreInfo['description'] }}
                            </p>
                        </div>
                    </div>

                    {{-- Points Card --}}
                    <div class="col-md-6">
                        <div class="card-profile points-card">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h5 class="mb-0"><i class="bi bi-graph-up me-2 text-success"></i> Score Trend</h5>
                                    <small class="text-muted">7 days trend</small>
                                </div>
                            </div>

                            <div style="height: 180px; width: 100%;">
                                <canvas id="scoreChartHistory"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Recent Activity Table --}}
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card-profile">
                            <h5 class="mb-3">Recent Credit Score Activities</h5>
                            <div class="table-responsive">
                                <table class="table table-dark table-borderless align-middle mb-0">
                                    <thead class="text-secondary text-uppercase text-xs">
                                        <tr>
                                            <th>Activity</th>
                                            <th>Type</th>
                                            <th class="text-end">Change</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recentActivities as $activity)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="bg-{{ $activity['change_amount'] >= 0 ? 'success' : 'danger' }} rounded-circle p-1 me-2"
                                                            style="width:8px; height:8px;"></div>
                                                        {{ $activity['reason'] }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <small
                                                        class="text-muted">{{ str_replace('_', ' ', $activity['action_type']) }}</small>
                                                </td>
                                                <td
                                                    class="text-end text-{{ $activity['change_amount'] >= 0 ? 'success' : 'danger' }}">
                                                    {{ $activity['change_amount'] >= 0 ? '+' : '' }}{{ $activity['change_amount'] }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted py-3">
                                                    Belum ada riwayat perubahan score
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL EDIT PROFILE --}}
    {{-- Ini adalah Modal Pop-up yang muncul ketika tombol Edit ditekan --}}
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-dark">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                {{-- Form action dikosongkan/di-comment karena hanya frontend --}}
                <form action="#" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label text-secondary small">Full Name</label>
                            <input type="text" class="form-control form-control-dark"
                                value="{{ Auth::user()->username }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-secondary small">Email Address</label>
                            <input type="email" class="form-control form-control-dark"
                                value="{{ Auth::user()->email }}" readonly>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-secondary small">Credit Score</label>
                                <input type="text" class="form-control form-control-dark"
                                    value="{{ Auth::user()->credit_score }}/100" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-secondary small">Member Since</label>
                                <input type="text" class="form-control form-control-dark"
                                    value="{{ Auth::user()->created_at->format('M d, Y') }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Bootstrap Bundle JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Data dari backend
        const creditScore = {{ $creditScoreInfo['score'] }};
        const maxScore = 100;
        const categoryColor = '{{ $creditScoreInfo['color'] }}';
        const categoryText = '{{ $creditScoreInfo['category'] }}';
        const chartLabels = @json($chartLabels);
        const chartData = @json($chartData);

        // Color mapping
        const colorMap = {
            'success': {
                gradient: ['#2d7a32', '#4caf50'],
                text: '#4caf50'
            },
            'info': {
                gradient: ['#0066cc', '#0099ff'],
                text: '#0099ff'
            },
            'warning': {
                gradient: ['#ffc107', '#ff9800'],
                text: '#ffc107'
            },
            'danger': {
                gradient: ['#dc3545', '#ff6b6b'],
                text: '#dc3545'
            }
        };

        const colors = colorMap[categoryColor] || colorMap['success'];

        // --- 1. Randomizer Utility ---
        function getRandomInt(min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }

        // --- 2. Credit Score Chart Logic ---
        const ctxScore = document.getElementById('creditScoreChart').getContext('2d');
        const scoreValEl = document.getElementById('scoreValue');
        const scoreLabelEl = document.getElementById('scoreLabel');

        let gradientGreen = ctxScore.createLinearGradient(0, 0, 200, 0);
        gradientGreen.addColorStop(0, colors.gradient[0]);
        gradientGreen.addColorStop(1, colors.gradient[1]);

        const creditScoreChart = new Chart(ctxScore, {
            type: 'doughnut',
            data: {
                labels: ['Score', 'Remaining'],
                datasets: [{
                    data: [creditScore, maxScore - creditScore],
                    backgroundColor: [gradientGreen, '#444'],
                    borderWidth: 0,
                    borderRadius: 20,
                    cutout: '85%',
                    circumference: 180,
                    rotation: 270,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        enabled: false
                    }
                },
                animation: {
                    duration: 1500,
                    easing: 'easeOutQuart'
                }
            }
        });

        // --- 3. Score History Chart Logic (Line Chart - SUCCESS THEME) ---
        const ctxHistory = document
            .getElementById('scoreChartHistory')
            .getContext('2d');

        // Gradient hijau
        let gradientFill = ctxHistory.createLinearGradient(0, 0, 0, 400);
        gradientFill.addColorStop(0, 'rgba(76, 175, 80, 0.35)'); // #4caf50
        gradientFill.addColorStop(1, 'rgba(45, 122, 50, 0.0)'); // #2d7a32

        const scoreHistoryChart = new Chart(ctxHistory, {
            type: 'line',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Score Change',
                    data: chartData,
                    borderColor: '#4caf50',
                    backgroundColor: gradientFill,
                    borderWidth: 3,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#4caf50',
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff',
                        borderColor: '#4caf50',
                        borderWidth: 1,
                        callbacks: {
                            label: function(context) {
                                let value = context.parsed.y || 0;
                                return (value >= 0 ? '+' : '') + value + ' points';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#8bcf94' // hijau soft
                        }
                    },
                    y: {
                        grid: {
                            color: 'rgba(76, 175, 80, 0.08)'
                        },
                        ticks: {
                            color: '#8bcf94',
                            stepSize: 5
                        },
                        border: {
                            display: false
                        }
                    }
                }
            }
        });


        // Fetch latest credit score dari API
        async function fetchCreditScoreData() {
            try {
                const response = await fetch('{{ route('credit-score.info') }}');
                const result = await response.json();

                if (result.success && result.data) {
                    const data = result.data;
                    const remaining = maxScore - data.score;

                    // Update chart
                    creditScoreChart.data.datasets[0].data = [data.score, remaining];
                    creditScoreChart.update();

                    // Update text
                    scoreValEl.innerText = data.score;
                    scoreValEl.style.color = colors.text;
                    scoreLabelEl.innerText = data.category;
                    scoreLabelEl.style.color = colors.text;
                }
            } catch (error) {
                console.error('Error fetching credit score:', error);
            }
        }

        // Update setiap 10 detik
        setInterval(fetchCreditScoreData, 10000);
    </script>
</body>

</html>
