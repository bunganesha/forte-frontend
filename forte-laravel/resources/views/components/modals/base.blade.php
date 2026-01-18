{{-- Component untuk Modal --}}
@props(['id', 'title', 'submitText' => 'Save', 'action' => '#', 'method' => 'POST'])

<div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-dark text-white border-secondary">
            <form action="{{ $action }}" method="{{ $method === 'GET' ? 'GET' : 'POST' }}">
                @csrf
                @if($method !== 'POST' && $method !== 'GET')
                    @method($method)
                @endif

                <div class="modal-header border-secondary">
                    <h5 class="modal-title text-white">{{ $title }}</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    {{ $slot }}
                </div>

                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success btn-sm">{{ $submitText }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
