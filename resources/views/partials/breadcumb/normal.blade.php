<h2 class="text-center text-lg-end text-info fw-normal text-capitalize text-white fw-bold mb-0 p-0">{{ $pages_current }}</h2>
<div class="d-flex justify-content-center justify-content-lg-end">
    <div class="d-inline-flex justify-content-between">

        {{-- Left alignment --}}
        {{-- @foreach ($pages as $key => $item)
        @if ($key == $pages_current)
        <a class="text-capitalize text-white">{{ $key }}</a>
        @else
        <a href="{{ $item }}" class="text-capitalize text-white-80">{{ $key }}</a>
        <span class="mdi mdi-chevron-right text-muted fw-light"></span>
        @endif
        @endforeach --}}
        {{--  --}}

        {{-- Right alignment --}}
        @php
            $pages = array_reverse($pages);
        @endphp
        @foreach ($pages as $key => $item)
        @if ($key == $pages_current)
        <a class="text-capitalize text-white">{{ $key }}</a>
        @else
        <span class="mdi mdi-chevron-left text-muted fw-light"></span>
        <a href="{{ $item }}" class="text-capitalize text-white-80">{{ $key }}</a>
        @endif
        @endforeach
        {{--  --}}

    </div>
</div>
