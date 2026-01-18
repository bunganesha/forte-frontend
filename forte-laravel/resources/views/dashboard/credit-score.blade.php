@extends('layouts.app')

@section('title', 'Credit Score')

@section('content')
<div class="container-fluid py-4">
    {{-- Main Credit Score Card --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-dark text-white shadow-lg border-0">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        {{-- Score Circle --}}
                        <div class="col-md-4 text-center">
                            <div style="width: 200px; height: 200px; margin: 0 auto;">
                                <svg style="transform: rotate(-90deg);" viewBox="0 0 100 100">
                                    {{-- Background circle --}}
                                    <circle cx="50" cy="50" r="45" stroke="#495057" stroke-width="8" fill="none" />
                                    {{-- Progress circle --}}
                                    <circle cx="50" cy="50" r="45" stroke="#{{ $creditScoreInfo['color'] === 'success' ? '28a745' : ($creditScoreInfo['color'] === 'info' ? '17a2b8' : ($creditScoreInfo['color'] === 'warning' ? 'ffc107' : 'dc3545')) }}"
                                        stroke-width="8" fill="none" stroke-dasharray="{{ $creditScoreInfo['percentage'] * 2.827 }} 282.7"
                                        stroke-linecap="round" style="transition: stroke-dasharray 0.5s;" />
                                </svg>
                                <div style="position: relative; margin-top: -120px; text-align: center;">
                                    <div style="font-size: 48px; font-weight: bold; color: #{{ $creditScoreInfo['color'] === 'success' ? '28a745' : ($creditScoreInfo['color'] === 'info' ? '17a2b8' : ($creditScoreInfo['color'] === 'warning' ? 'ffc107' : 'dc3545')) }};">
                                        {{ $creditScoreInfo['score'] }}
                                    </div>
                                    <div style="font-size: 14px; color: #adb5bd;">
                                        {{ $creditScoreInfo['percentage'] }}%
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Score Info --}}
                        <div class="col-md-8">
                            <h4 class="mb-3">
                                <span class="badge bg-{{ $creditScoreInfo['color'] }}">{{ $creditScoreInfo['category'] }}</span>
                            </h4>
                            <p class="text-gray-300 mb-4">{{ $creditScoreInfo['description'] }}</p>

                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="bg-secondary rounded p-3">
                                        <small class="text-gray-400">Score Saat Ini</small>
                                        <div class="h6 mb-0 text-white">{{ $creditScoreInfo['score'] }}/100</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-secondary rounded p-3">
                                        <small class="text-gray-400">Update Terakhir</small>
                                        <div class="h6 mb-0 text-white">
                                            @if($creditScoreInfo['last_activity'])
                                                {{ $creditScoreInfo['last_activity']->created_at->diffForHumans() }}
                                            @else
                                                Belum ada aktivitas
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="bg-secondary rounded p-3">
                                        <small class="text-gray-400">Status Pengiriman Laporan</small>
                                        <div class="h6 mb-0 text-white">
                                            @if(auth()->user()->credit_score >= 20)
                                                <i class="bi bi-check-circle text-success"></i> Dapat Mengirim Laporan
                                            @else
                                                <i class="bi bi-x-circle text-danger"></i> Tidak Dapat Mengirim Laporan
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Score Rules & Information --}}
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card bg-dark text-white shadow-lg border-0">
                <div class="card-header bg-dark border-0">
                    <h5 class="mb-0 text-white">
                        <i class="bi bi-info-circle me-2"></i> Kategori Credit Score
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-success">Excellent (90-100)</span>
                            <small class="text-gray-400">Sangat Terpercaya</small>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-info">Good (75-89)</span>
                            <small class="text-gray-400">Terpercaya</small>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-warning">Fair (50-74)</span>
                            <small class="text-gray-400">Cukup Terpercaya</small>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-danger">Poor (25-49)</span>
                            <small class="text-gray-400">Perlu Peningkatan</small>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-danger">Critical (0-24)</span>
                            <small class="text-gray-400">Risiko Tinggi</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card bg-dark text-white shadow-lg border-0">
                <div class="card-header bg-dark border-0">
                    <h5 class="mb-0 text-white">
                        <i class="bi bi-plus-minus-lg me-2"></i> Poin & Penalti
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-dark">
                        <tbody>
                            <tr>
                                <td><small class="text-gray-400">Laporan Disetujui</small></td>
                                <td class="text-right"><span class="badge bg-success">+10</span></td>
                            </tr>
                            <tr>
                                <td><small class="text-gray-400">Data Terverifikasi</small></td>
                                <td class="text-right"><span class="badge bg-success">+8</span></td>
                            </tr>
                            <tr>
                                <td><small class="text-gray-400">Akurasi Tinggi</small></td>
                                <td class="text-right"><span class="badge bg-success">+12</span></td>
                            </tr>
                            <tr>
                                <td><small class="text-gray-400">Laporan Ditolak</small></td>
                                <td class="text-right"><span class="badge bg-danger">-15</span></td>
                            </tr>
                            <tr>
                                <td><small class="text-gray-400">Laporan Palsu</small></td>
                                <td class="text-right"><span class="badge bg-danger">-20</span></td>
                            </tr>
                            <tr>
                                <td><small class="text-gray-400">Submisi Terlambat</small></td>
                                <td class="text-right"><span class="badge bg-danger">-5</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- History --}}
    <div class="row">
        <div class="col-12">
            <div class="card bg-dark text-white shadow-lg border-0">
                <div class="card-header bg-dark border-0">
                    <h5 class="mb-0 text-white">
                        <i class="bi bi-clock-history me-2"></i> Riwayat Perubahan Score
                    </h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-dark mb-0">
                        <thead class="table-secondary">
                            <tr>
                                <th style="width: 30%">Alasan</th>
                                <th style="width: 15%">Tipe Aksi</th>
                                <th style="width: 15%">Perubahan</th>
                                <th style="width: 15%">Skor Sebelum</th>
                                <th style="width: 15%">Skor Sesudah</th>
                                <th style="width: 10%">Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($history as $log)
                                <tr>
                                    <td>
                                        <small>{{ $log['reason'] }}</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">{{ str_replace('_', ' ', $log['action_type']) }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $log['change_amount'] >= 0 ? 'success' : 'danger' }}">
                                            {{ $log['change_amount'] >= 0 ? '+' : '' }}{{ $log['change_amount'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <small>{{ $log['previous_score'] }}</small>
                                    </td>
                                    <td>
                                        <small class="text-info">{{ $log['new_score'] }}</small>
                                    </td>
                                    <td>
                                        <small class="text-gray-400">
                                            @php
                                                $date = \Carbon\Carbon::parse($log['created_at']);
                                            @endphp
                                            {{ $date->diffForHumans() }}
                                        </small>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <i class="bi bi-inbox text-gray-500 fs-3"></i>
                                        <p class="text-gray-400 mt-2">Belum ada riwayat perubahan score</p>
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

@endsection
