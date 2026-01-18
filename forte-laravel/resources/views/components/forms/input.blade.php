{{-- Component untuk Input Form Field --}}
@props(['name', 'label' => null, 'type' => 'text', 'value' => '', 'placeholder' => '', 'required' => false])

<div class="mb-3">
    @if($label)
        <label for="{{ $name }}" class="form-label text-secondary small">{{ $label }}</label>
    @endif
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        class="form-control form-control-dark @error($name) is-invalid @enderror"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        @if($required) required @endif
        {{ $attributes }}
    >
    @error($name)
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>
