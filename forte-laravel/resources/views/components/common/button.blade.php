{{-- Component untuk Button --}}
@props(['type' => 'button', 'variant' => 'primary', 'size' => 'md', 'icon' => null, 'text', 'href' => null, 'class' => ''])

@php
    $baseClasses = 'btn btn-' . $variant;
    $sizeClasses = match($size) {
        'sm' => 'btn-sm',
        'lg' => 'btn-lg',
        default => '',
    };
    $allClasses = "$baseClasses $sizeClasses $class";
@endphp

@if($href)
    <a href="{{ $href }}" class="{{ $allClasses }}" {{ $attributes }}>
        @if($icon) <i class="{{ $icon }} me-1"></i> @endif
        {{ $text }}
    </a>
@else
    <button type="{{ $type }}" class="{{ $allClasses }}" {{ $attributes }}>
        @if($icon) <i class="{{ $icon }} me-1"></i> @endif
        {{ $text }}
    </button>
@endif
