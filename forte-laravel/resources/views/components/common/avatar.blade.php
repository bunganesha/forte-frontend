{{-- Component untuk Avatar Circle --}}
@props(['initials', 'size' => 'md', 'class' => ''])

@php
    $sizeClasses = match($size) {
        'sm' => 'avatar-circle-sm',
        'lg' => 'avatar-circle-lg',
        'nav' => 'avatar-circle-nav',
        default => 'avatar-circle',
    };
@endphp

<div class="{{ $sizeClasses }} {{ $class }}">
    {{ $initials }}
</div>
