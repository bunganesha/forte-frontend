{{-- Component untuk Detail Row (Profile) --}}
@props(['label', 'value'])

<div class="detail-row">
    <span class="detail-label">{{ $label }}</span>
    <span class="detail-value">{{ $value }}</span>
</div>
