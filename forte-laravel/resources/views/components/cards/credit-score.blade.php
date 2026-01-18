{{-- Credit Score Widget Component --}}
<div class="card bg-dark text-white shadow-lg border-0">
    <div class="card-body p-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h6 class="text-gray-400 mb-1">Credit Score</h6>
                <div class="d-flex align-items-baseline gap-2">
                    <span class="h5 mb-0 text-white">{{ $creditScore['score'] }}/100</span>
                    <span class="badge bg-{{ $creditScore['color'] }} text-xs">{{ $creditScore['category'] }}</span>
                </div>
            </div>
            <div>
                <svg style="width: 80px; height: 80px; transform: rotate(-90deg);">
                    <circle cx="40" cy="40" r="35" stroke="#495057" stroke-width="6" fill="none" />
                    <circle cx="40" cy="40" r="35"
                        stroke="#{{ $creditScore['color'] === 'success' ? '28a745' : ($creditScore['color'] === 'info' ? '17a2b8' : ($creditScore['color'] === 'warning' ? 'ffc107' : 'dc3545')) }}"
                        stroke-width="6" fill="none"
                        stroke-dasharray="{{ $creditScore['percentage'] * 2.199 }} 219.9"
                        stroke-linecap="round" />
                </svg>
                <div style="position: relative; margin-top: -50px; text-align: center; font-size: 12px; color: #adb5bd;">
                    {{ round($creditScore['percentage']) }}%
                </div>
            </div>
        </div>
        <div class="mt-3 pt-3 border-top border-secondary">
            <small class="text-gray-400">{{ $creditScore['description'] }}</small>
        </div>
        <a href="{{ route('credit-score.show') }}" class="btn btn-sm btn-outline-info w-100 mt-2">
            <i class="bi bi-arrow-right me-1"></i> Lihat Detail
        </a>
    </div>
</div>
