@extends('layouts.app')

@section('title', 'Manage Roles')

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
                            <div class="bg-info rounded-circle p-2 me-3">
                                <i class="bi bi-shield-lock text-white fs-5"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 text-white fw-semibold">Manage Roles</h5>
                                <small class="text-gray-300">Total {{ $roles->total() }} role terdaftar</small>
                            </div>
                        </div>

                        {{-- Button Group --}}
                        <div class="d-flex flex-wrap gap-2">
                            <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modalCreateRole">
                                <i class="bi bi-plus-lg me-1"></i>
                                <span class="d-none d-sm-inline">Tambah Role</span>
                                <span class="d-inline d-sm-none">Tambah</span>
                            </button>
                        </div>
                    </div>

                    {{-- Search Bar --}}
                    <div class="mt-3">
                        <form method="GET" action="{{ route('roles.index') }}" class="d-flex gap-2">
                            <input type="text" name="search" class="form-control form-control-sm bg-secondary text-white border-secondary"
                                placeholder="Cari role..." value="{{ $search }}">
                            <button type="submit" class="btn btn-info btn-sm">
                                <i class="bi bi-search"></i>
                            </button>
                            @if($search)
                                <a href="{{ route('roles.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="bi bi-x-lg"></i>
                                </a>
                            @endif
                        </form>
                    </div>
                </div>

                {{-- Alert Messages --}}
                @if ($errors->any())
                    <div class="alert alert-danger m-3 mb-0">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success m-3 mb-0 alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger m-3 mb-0 alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- Table --}}
                <div class="table-responsive">
                    <table class="table table-hover table-dark mb-0">
                        <thead class="table-secondary">
                            <tr>
                                <th style="width: 5%">No</th>
                                <th style="width: 25%">Nama Role</th>
                                <th style="width: 45%">Deskripsi</th>
                                <th style="width: 10%">Jumlah User</th>
                                <th style="width: 15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $key => $role)
                                <tr>
                                    <td>{{ $roles->firstItem() + $key }}</td>
                                    <td>
                                        <span class="badge bg-info">{{ $role->name }}</span>
                                    </td>
                                    <td>
                                        <small>{{ $role->description ?? '-' }}</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $role->users()->count() }}</span>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#modalEditRole{{ $role->id }}">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Yakin ingin menghapus role ini?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <i class="bi bi-inbox text-gray-500 fs-3"></i>
                                        <p class="text-gray-400 mt-2">Tidak ada role ditemukan</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="card-footer bg-dark border-top border-secondary py-3">
                    {{ $roles->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Create Role --}}
<div class="modal fade" id="modalCreateRole" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-white border-secondary">
            <div class="modal-header border-secondary">
                <h5 class="modal-title">Tambah Role Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Role</label>
                        <input type="text" class="form-control form-control-sm bg-secondary text-white border-secondary"
                            id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control form-control-sm bg-secondary text-white border-secondary"
                            id="description" name="description" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-info btn-sm">Simpan Role</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Edit Role --}}
@foreach ($roles as $role)
    <div class="modal fade" id="modalEditRole{{ $role->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-white border-secondary">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title">Edit Role</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name{{ $role->id }}" class="form-label">Nama Role</label>
                            <input type="text" class="form-control form-control-sm bg-secondary text-white border-secondary"
                                id="name{{ $role->id }}" name="name" value="{{ $role->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="description{{ $role->id }}" class="form-label">Deskripsi</label>
                            <textarea class="form-control form-control-sm bg-secondary text-white border-secondary"
                                id="description{{ $role->id }}" name="description" rows="3">{{ $role->description }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning btn-sm">Update Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

@endsection
