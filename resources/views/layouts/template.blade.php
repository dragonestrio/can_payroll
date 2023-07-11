<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="referrer" content="origin" />
    <meta name="description" content="{{ $description }}" />
    <meta name="author" content="{{ $author }}" />
    <title>{{ ucwords($app) }} - {{ ucwords($title) }} </title>

    {{-- Favicon  --}}
    <link rel="icon" type="image/x-icon" href="{{ url('media/logo/favicon.png') }}" />
    {{-- ./Favicon --}}

    {{-- CSS --}}
    @include('layouts.css')
    {{-- ./CSS --}}
</head>

<body id="body" class="">
    {{-- Preloader --}}
    @include('partials.preloader.custom')
    {{-- ./Preloader --}}

    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">

        {{-- Header --}}
        @include('partials.navbar.custom')
        @include('partials.sidebar.custom')
        {{-- <div class="d-none d-lg-block" style="height: 55px;">&nbsp;</div> --}}
        @include('layouts.notif')
        {{-- ./Header --}}

        <div class="page-wrapper">
            {{-- Content --}}
            {{-- <div class="mt-3"></div> --}}
            @yield('app')
            {{-- <br> --}}
            {{-- ./Content --}}
        </div>

        {{-- Footer --}}
        {{-- @include('partials.footer.custom') --}}
        {{-- ./Footer --}}

    </div>

    {{-- Popup --}}
    {{-- @include('partials.popup.normal') --}}
    {{-- ./Popup --}}

    {{-- // JS --}}
    @include('layouts.js')
    {{-- // ./JS --}}
</body>

</html>
