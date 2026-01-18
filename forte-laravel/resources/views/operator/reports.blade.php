@extends('layouts.app')

@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="card bg-dark text-white border-0 shadow-lg">
            <div class="card-header bg-dark border-0">
                <h5 class="text-white">Validation Queue (Report Masuk)</h5>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-white ps-4">Judul</th>
                            <th class="text-white">Latitude</th>
                            <th class="text-white">Longitude</th>
                            <th class="text-white">Lokasi (Lat, Long)</th>
                            <th class="text-white">Bukti</th>
                            <th class="text-white text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reports as $r)
                        <tr style="background-color: {{ $loop->iteration % 2 == 0 ? '#1a1a1a' : '#14451a' }};">
                            <td class="ps-4">
                                <span class="text-sm font-weight-bold">{{ $r->title }}</span>
                            </td>
                            <td>
                                <span class="text-xs">{{ $r->latitude }}</span>
                            </td>
                            <td>
                                <span class="text-xs">{{ $r->longitude }}</span>
                            </td>
                            <td>
                                <span class="text-xs">{{ $r->latitude }}, {{ $r->longitude }}</span>
                            </td>
                            <td>
                                <a href="{{ asset('storage/' . $r->image_path) }}" target="_blank" class="btn btn-xs btn-outline-light">Lihat Foto</a>
                            </td>
                            <td class="text-center">
                                @if($r->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($r->status == 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @else
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
