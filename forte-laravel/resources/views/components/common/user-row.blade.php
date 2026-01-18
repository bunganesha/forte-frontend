{{-- Component untuk User List Item/Row --}}
@props(['user', 'editRoute' => null, 'deleteRoute' => null])

<tr>
    <td>
        <div class="d-flex align-items-center">
            <x-common.avatar :initials="substr($user->username ?? 'AH', 0, 2)" size="sm" />
            <div class="ms-2">
                <div class="fw-bold">{{ $user->username ?? 'N/A' }}</div>
                <small class="text-muted">{{ $user->email ?? 'N/A' }}</small>
            </div>
        </div>
    </td>
    <td>
        <x-common.badge :type="$user->role" :text="ucfirst($user->role ?? 'User')" />
    </td>
    <td>{{ $user->phone ?? 'N/A' }}</td>
    <td>
        <span class="badge {{ $user->status ? 'bg-success' : 'bg-secondary' }}">
            {{ $user->status ? 'Active' : 'Inactive' }}
        </span>
    </td>
    <td>
        <div class="btn-group btn-group-sm" role="group">
            @if($editRoute)
                <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $user->id }}">
                    <i class="bi bi-pencil"></i>
                </button>
            @endif
            @if($deleteRoute)
                <form action="{{ $deleteRoute }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure?')">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            @endif
        </div>
    </td>
</tr>
