<header class="topbar" data-navbarbg="skin6">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header px-4" data-logobg="skin6">
            {{-- Logo --}}
            <a class="navbar-brand" href="index.html">
                <img src="{{ url('media/logo/favicon.png') }}" height="40px" width="40px" alt="homepage" class="rounded-3">
                <span class="px-2 text-white text-break">{{ ucwords($app) }}</span>
            </a>
            {{--  --}}
            <a class="nav-toggler waves-effect waves-light text-white d-block d-md-none"
                href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
        </div>
        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
            <ul class="navbar-nav d-lg-none d-md-block ">
                <li class="nav-item">
                    <a class="nav-toggler nav-link waves-effect waves-light text-white "
                        href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav me-auto mt-md-0 ">
                {{-- Search --}}
                {{-- <li class="nav-item search-box">
                    <a class="nav-link text-muted" href="javascript:void(0)"><i class="ti-search"></i></a>
                    <form class="app-search" style="display: none;">
                        <input type="text" class="form-control" placeholder="Search &amp; enter"> <a
                            class="srh-btn"><i class="ti-close"></i></a> </form>
                </li> --}}
                {{--  --}}
            </ul>

            <ul class="navbar-nav">
                {{-- User profile --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-dark" href="{{ url('profile') }}">
                        <i class="bi bi-person-circle"></i>
                    </a>
                    {{-- <a class="nav-link dropdown-toggle text-muted waves-dark" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i>
                    </a> --}}
                    {{-- <ul class="dropdown-menu" aria-labelledby="navbarDropdown"></ul> --}}
                </li>
                {{--  --}}
            </ul>
        </div>
    </nav>
</header>
