{{-- Component untuk Textarea --}}
@props(['name', 'label' => null, 'value' => '', 'placeholder' => '', 'required' => false, 'rows' => 4])

<div class="mb-3">
    @if($label)
        <label for="{{ $name }}" class="form-label text-secondary small">{{ $label }}</label>
    @endif
    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        class="form-control form-control-dark @error($name) is-invalid @enderror"
        placeholder="{{ $placeholder }}"
        rows="{{ $rows }}"
        @if($required) required @endif
        {{ $attributes }}
    >{{ old($name, $value) }}</textarea>
    @error($name)
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>
