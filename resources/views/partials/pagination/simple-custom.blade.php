@php
$data = json_decode(json_encode($pagination_external->toArray()));

$next_text = '>';
$next_page = $data->current_page + 1;
$prev_text = '<';
$prev_page = $data->current_page - 1;
@endphp

@if ($data->last_page > 1)
    <nav role="navigation" aria-label="Pagination Navigation" class="d-inline-flex justify-content-between">
    {{-- Previous Page Link --}}
    @if ($data->prev_page_url == null)
        <span class="relative inline-flex items-center px-4 py-2 text-sm fw-normal text-muted bg-white border border-gray-300 cursor-default leading-5 rounded-5 rounded-end-0">
            {{ $prev_text }}
        </span>
    @else
        <a href="{{ url()->current().'?page='.$prev_page }}" rel="prev" class="relative inline-flex items-center px-4 py-2 text-sm fw-normal text-info bg-white border border-gray-300 leading-5 rounded-5 rounded-end-0 hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
            {{ $prev_text }}
            {{-- click --}}
        </a>
    @endif

    {{-- Next Page Link --}}
    @if ($data->next_page_url != null)
        <a href="{{ url()->current().'?page='.$next_page }}" rel="next" class="relative inline-flex items-center px-4 py-2 text-sm fw-normal text-info bg-white border border-gray-300 leading-5 rounded-5 rounded-start-0 hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
            {{ $next_text }}
            {{-- click --}}
        </a>
    @else
        <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-muted bg-white border border-gray-300 cursor-default leading-5 rounded-5 rounded-start-0">
            {{ $next_text }}
        </span>
    @endif
    </nav>
@endif
