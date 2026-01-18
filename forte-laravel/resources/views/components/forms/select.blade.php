{{-- Component untuk Select Input --}}
@props(['name', 'label' => null, 'options' => [], 'value' => '', 'required' => false])

<div class="mb-3">
    @if($label)
        <label for="{{ $name }}" class="form-label text-secondary small">{{ $label }}</label>
    @endif
    <select
        name="{{ $name }}"
        id="{{ $name }}"
        class="form-select bg-dark text-white border-secondary @error($name) is-invalid @enderror"
        @if($required) required @endif
        {{ $attributes }}
    >
        <option value="">{{ $slot ?? 'Choose...' }}</option>
        @foreach($options as $val => $label)
            <option value="{{ $val }}" @if(old($name, $value) == $val) selected @endif>
                {{ $label }}
            </option>
        @endforeach
    </select>
    @error($name)
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>
