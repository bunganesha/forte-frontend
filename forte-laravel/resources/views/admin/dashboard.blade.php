@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <h1 class="text-white mb-6 text-2xl font-bold">Admin Dashboard</h1>

        <div class="row g-4">

            {{-- Info Cards --}}
            <div class="col-md-3">
                <div class="card bg-dark text-white shadow-sm">
                    <div class="card-body">
                        <h6 class="text-white mb-2">Total Users</h6>
                        <h3 class="text-success">{{ $users }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-dark text-white shadow-sm">
                    <div class="card-body">
                        <h6 class="text-white mb-2">Total Reports</h6>
                        <h3 class="text-info">{{ $reports }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-dark text-white shadow-sm">
                    <div class="card-body">
                        <h6 class="text-white mb-2">Total Sensors</h6>
                        <h3 class="text-warning">{{ $sensors }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-dark text-white shadow-sm">
                    <div class="card-body">
                        <h6 class="text-white mb-2">Pending Reports</h6>
                        <h3 class="text-danger">{{ $pendingReports }}</h3>
                    </div>
                </div>
            </div>

        </div>

        {{-- Tables Section --}}
        <div class="row g-4 mt-4">

            {{-- Users Table --}}
            <div class="col-md-6">
                <div class="card bg-dark text-white shadow-sm">
                    <div class="card-header bg-green-700">
                        <h6 class="mb-0">Users</h6>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-hover text-white mb-0" style="background-color:#064e18;">
                            <thead class="text-white">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (App\Models\User::all() as $user)
                                    <tr class="hover:bg-green-800">
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role->name ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Reports Table --}}
            <div class="col-md-6">
                <div class="card bg-dark text-white shadow-sm">
                    <div class="card-header bg-green-700">
                        <h6 class="mb-0">Reports</h6>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-hover text-white mb-0" style="background-color:#064e18;">
                            <thead class="text-white">
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Status</th>
                                    <th>Bukti</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (App\Models\Report::latest()->take(5)->get() as $report)
                                    <tr class="hover:bg-green-800">
                                        <td>{{ $report->id }}</td>
                                        <td>{{ $report->user->username }}</td>
                                        <td>{{ ucfirst($report->status) }}</td>
                                        <td>
                                            <a href="{{ asset('storage/' . $report->image_path) }}" target="_blank"
                                                class="btn btn-xs btn-outline-light">Lihat Foto</a>
                                        </td>
                                        {{-- <td>
                                        @if ($report->status == 'pending')
                                        <a href="{{ route('reports.approve', $report->id) }}" class="btn btn-sm btn-success">Approve</a>
                                        @endif
                                    </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
