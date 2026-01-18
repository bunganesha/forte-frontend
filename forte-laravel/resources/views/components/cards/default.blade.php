{{-- Component untuk Card Default --}}
@props(['title' => null, 'icon' => null, 'class' => ''])

<div class="card-profile {{ $class }}">
    @if($title)
        <h5 class="mb-3 d-flex align-items-center">
            @if($icon)
                <i class="{{ $icon }} me-2"></i>
            @endif
            {{ $title }}
        </h5>
    @endif

    {{ $slot }}
</div>
