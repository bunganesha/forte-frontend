{{-- Component untuk Alert/Notification --}}
@props(['type' => 'info', 'icon' => null, 'dismissible' => true])

@php
    $alertClasses = match($type) {
        'success' => 'alert-success bg-success bg-opacity-10 border-success border-opacity-25',
        'danger' => 'alert-danger bg-danger bg-opacity-10 border-danger border-opacity-25',
        'warning' => 'alert-warning bg-warning bg-opacity-10 border-warning border-opacity-25',
        default => 'alert-info bg-info bg-opacity-10 border-info border-opacity-25',
    };
@endphp

<div class="alert {{ $alertClasses }} mb-3" role="alert">
    @if($icon)
        <i class="{{ $icon }} me-2"></i>
    @else
        <i class="bi bi-info-circle me-2"></i>
    @endif
    <small>
        {{ $slot }}
    </small>
    @if($dismissible)
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    @endif
</div>
