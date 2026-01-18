<div class="modal fade" id="modalEditUser{{ $user->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-dark text-white border-secondary">
            {{-- Form Update - Method WAJIB PUT --}}
            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header border-secondary">
                    <h5 class="modal-title text-white">Edit User: {{ $user->username }}</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="username" value="{{ $user->username }}"
                            class="form-control bg-transparent text-white border-secondary" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ $user->email }}"
                            class="form-control bg-transparent text-white border-secondary" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select bg-dark text-white border-secondary">
                            <option value="user" {{ $user->getRoleNames()->contains('user') ? 'selected' : '' }}>User
                            </option>
                            <option value="admin" {{ $user->getRoleNames()->contains('admin') ? 'selected' : '' }}>
                                Admin</option>
                        </select>
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Password Baru (Kosongkan jika tidak ganti)</label>
                        <input type="password" name="password"
                            class="form-control bg-transparent text-white border-secondary" placeholder="******">
                    </div>
                </div>

                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-info btn-sm">Update Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
