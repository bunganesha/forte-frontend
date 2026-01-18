{{-- Component untuk Table dengan Header Responsif --}}
@props(['headers' => [], 'striped' => true, 'hover' => true])

@php
    $tableClasses = 'table text-white';
    if($striped) $tableClasses .= ' table-striped';
    if($hover) $tableClasses .= ' table-hover';
@endphp

<div class="table-responsive">
    <table class="{{ $tableClasses }}">
        @if(!empty($headers))
            <thead class="table-dark">
                <tr>
                    @foreach($headers as $header)
                        <th scope="col">{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
        @endif
        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>
