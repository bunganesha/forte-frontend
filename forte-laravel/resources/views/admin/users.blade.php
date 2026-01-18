@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            {{-- Card Container --}}
            <div class="card bg-dark text-white shadow-lg border-0">

                {{-- Card Header --}}
                <div class="card-header bg-dark border-0 pb-2">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                        {{-- Title Section --}}
                        <div class="d-flex align-items-center">
                            <div class="bg-success rounded-circle p-2 me-3">
                                <i class="bi bi-person-fill text-white fs-5"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 text-white fw-semibold">Manage Users</h5>
                                <small class="text-gray-300">Total {{ $users->total() }} pengguna terdaftar</small>
                            </div>
                        </div>

                        {{-- Button Group --}}
                        <div class="d-flex flex-wrap gap-2">
                            <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modalCreateUser">
                                <i class="bi bi-plus-lg me-1"></i>
                                <span class="d-none d-sm-inline">Tambah User</span>
                                <span class="d-inline d-sm-none">Tambah</span>
                            </button>

                            <a href="{{ route('admin.users.export') }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-download me-1"></i>
                                <span class="d-none d-sm-inline">Export CSV</span>
                                <span class="d-inline d-sm-none">Export</span>
                            </a>

                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modalImportCsv">
                                <i class="bi bi-upload me-1"></i>
                                <span class="d-none d-sm-inline">Import CSV</span>
                                <span class="d-inline d-sm-none">Import</span>
                            </button>
                        </div>
                    </div>

                    {{-- Search Bar --}}
                    <div class="mt-4">
                        <form action="{{ route('admin.users.index') }}" method="GET">
                            <div class="input-group input-group-sm">
                                <input type="text" name="search"
                                    class="form-control bg-dark text-white border border-secondary"
                                    placeholder="Cari user berdasarkan nama atau email..."
                                    value="{{ $search ?? '' }}">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-search me-1 d-none d-sm-inline"></i>
                                    <span class="d-none d-sm-inline">Search</span>
                                    <i class="bi bi-search d-sm-none"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Card Body - Tabel Utama Tetap Sama --}}
                <div class="card-body px-0 pt-2 pb-0">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0" style="border-collapse: collapse;">
                            <thead>
                                <tr class="border-0">
                                    <th class="text-uppercase text-xxs font-weight-bolder text-white ps-4">Nama</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-white text-center">Email</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-white text-center">Role</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-white text-center">Joined At</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-white text-center">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="border-0">
                                @forelse ($users as $user)
                                    <tr style="background-color: {{ $loop->iteration % 2 == 0 ? '#1a1a1a' : '#14451a' }}; border: none;">
                                        <td class="text-sm py-3 text-white ps-4">
                                            <div class="d-flex align-items-center">
                                                <span>{{ $user->username }}</span>
                                            </div>
                                        </td>
                                        <td class="text-center text-sm text-white">{{ $user->email }}</td>
                                        <td class="text-center text-sm text-white">
                                            <span class="badge bg-secondary text-xxs px-3 py-1">
                                                {{ strtoupper($user->getRoleNames()->first() ?? 'user') }}
                                            </span>
                                        </td>
                                        <td class="text-center text-sm text-white">{{ $user->created_at->format('d M Y') }}</td>
                                        <td class="text-center">
                                            {{-- Button Edit --}}
                                            <button class="btn btn-link text-info text-gradient px-2 mb-0"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalEditUser{{ $user->id }}"
                                                title="Edit">
                                                <i class="bi bi-pencil-fill text-white fs-6"></i>
                                            </button>

                                            {{-- Button Delete --}}
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                                class="d-inline delete-form">
                                                @csrf @method('DELETE')
                                                <button type="button"
                                                    class="btn btn-link text-danger text-gradient px-2 mb-0 delete-btn"
                                                    title="Delete">
                                                    <i class="bi bi-trash-fill text-white fs-6"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>

                                    {{-- Include Modal Edit per User --}}
                                    @include('admin.partials.modal-edit')
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-white py-5">
                                            <i class="bi bi-people display-6 text-gray-500 mb-3"></i>
                                            <p class="mb-0">Tidak ada data user</p>
                                            <small class="text-gray-400">Coba tambah user baru atau gunakan pencarian lain</small>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if($users->hasPages())
                    <div class="d-flex justify-content-between align-items-center px-4 py-3 mt-3 border-top border-secondary">
                        <div class="text-gray-300 text-sm">
                            Menampilkan {{ $users->firstItem() ?? 0 }} - {{ $users->lastItem() ?? 0 }} dari {{ $users->total() }} data
                        </div>
                        <div>
                            {{ $users->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                    @else
                    <div class="d-flex justify-content-center mt-4 pb-3">
                        {{ $users->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Include Modal Create --}}
@include('admin.partials.modal-create')

{{-- Modal Import CSV --}}
<div class="modal fade" id="modalImportCsv" tabindex="-1" aria-labelledby="modalImportCsvLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header border-secondary">
                <h5 class="modal-title" id="modalImportCsvLabel">
                    <i class="bi bi-file-earmark-arrow-up me-2"></i>Import Users dari CSV
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.users.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-info bg-info bg-opacity-10 border border-info border-opacity-25 mb-3">
                        <small>
                            <i class="bi bi-info-circle me-1"></i>
                            Pastikan format CSV sesuai: Username, Email, Password, Role
                        </small>
                    </div>
                    <div class="mb-3">
                        <label for="csv_file" class="form-label">Pilih file CSV</label>
                        <input type="file" name="csv_file" class="form-control bg-dark border-secondary text-white"
                            id="csv_file" required accept=".csv">
                        <div class="form-text text-gray-300">Format CSV: ID, Username, Email, Role, Joined At</div>
                    </div>
                </div>
                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning btn-sm">
                        <i class="bi bi-file-earmark-arrow-up me-1"></i>Import
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
/* Mobile Responsive */
@media (max-width: 768px) {
    .container-fluid {
        padding-left: 10px;
        padding-right: 10px;
    }

    .card-header {
        padding: 1rem !important;
    }

    .table-responsive {
        margin: 0 -0.75rem;
        padding: 0 0.75rem;
    }

    .table {
        font-size: 0.875rem;
    }

    .text-xxs {
        font-size: 0.7rem !important;
    }

    .text-sm {
        font-size: 0.8rem !important;
    }

    .ps-4 {
        padding-left: 1rem !important;
    }

    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }

    /* Better spacing for buttons in header */
    .d-flex.flex-wrap {
        gap: 0.5rem !important;
    }

    /* Adjust avatar size on mobile */
    .avatar-xs {
        width: 28px;
        height: 28px;
        font-size: 0.75rem;
    }

    /* Action buttons spacing */
    .btn-link {
        padding: 0.25rem !important;
    }

    .fs-6 {
        font-size: 1rem !important;
    }
}

@media (max-width: 576px) {
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .table {
        min-width: 600px; /* Minimum width to keep table readable */
    }

    .d-flex.flex-column.flex-md-row {
        gap: 1rem !important;
    }

    /* Pagination adjustments */
    .pagination {
        flex-wrap: wrap;
        justify-content: center;
    }

    .page-link {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
}

/* Desktop Enhancements */
@media (min-width: 992px) {
    .table {
        min-width: 100%;
    }
}

/* General Improvements */
.bg-success.rounded-circle {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.avatar-xs {
    width: 32px;
    height: 32px;
}

.avatar-title {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 0.875rem;
}

.border-secondary {
    border-color: #495057 !important;
}

.text-gray-300 {
    color: #dee2e6;
}

.text-gray-400 {
    color: #adb5bd;
}

.bg-dark {
    background-color: #1a1a1a !important;
}

/* Table row hover effect */
tbody tr:hover {
    opacity: 0.9;
    transition: opacity 0.2s ease;
}

/* Badge improvements */
.badge {
    font-weight: 500;
    letter-spacing: 0.5px;
}

/* Form input styling */
.form-control.bg-dark {
    background-color: #121212 !important;
    border-color: #495057;
}

.form-control.bg-dark:focus {
    background-color: #121212;
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

/* Button hover effects */
.btn-success:hover, .btn-primary:hover, .btn-warning:hover {
    transform: translateY(-1px);
    transition: transform 0.2s ease;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Delete confirmation
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            const form = this.closest('.delete-form');
            if (confirm('Yakin hapus user ini?')) {
                form.submit();
            }
        });
    });

    // File input validation for CSV import
    const csvFileInput = document.getElementById('csv_file');
    if (csvFileInput) {
        csvFileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const fileName = file.name.toLowerCase();
                if (!fileName.endsWith('.csv')) {
                    alert('Hanya file CSV yang diperbolehkan');
                    this.value = '';
                }
            }
        });
    }

    // Mobile menu adjustments
    function adjustForMobile() {
        if (window.innerWidth < 768) {
            // Adjust table padding on mobile
            const tableCells = document.querySelectorAll('td, th');
            tableCells.forEach(cell => {
                if (cell.classList.contains('ps-4')) {
                    cell.style.paddingLeft = '1rem';
                }
            });
        }
    }

    // Run on load and resize
    adjustForMobile();
    window.addEventListener('resize', adjustForMobile);
});
</script>
@endpush
