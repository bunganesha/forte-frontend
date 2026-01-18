{{-- Component untuk Badge Role/Status --}}
@props(['type' => 'secondary', 'text'])

@php
    $badgeClasses = match($type) {
        'admin' => 'badge bg-danger',
        'operator' => 'badge bg-info',
        'user' => 'badge bg-secondary',
        'success' => 'badge bg-success',
        'warning' => 'badge bg-warning text-dark',
        'danger' => 'badge bg-danger',
        default => 'badge bg-secondary',
    };
@endphp

<span class="{{ $badgeClasses }}">{{ $text }}</span>
