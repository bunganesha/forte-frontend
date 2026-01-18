{{-- Component untuk Card Profile --}}
@props(['title' => null, 'avatar' => null, 'badge' => null])

<div class="card-profile text-center">
    @if($avatar)
        <div class="profile-avatar-lg">
            {{ $avatar }}
        </div>
    @endif

    @if($title)
        <h4 class="mb-1">{{ $title }}</h4>
    @endif

    @if($badge)
        <span class="user-role-badge">{{ $badge }}</span>
    @endif

    {{ $slot }}
</div>
