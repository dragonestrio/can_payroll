@php $menu = ['d']; @endphp

<nav id="header" class="navbar navbar-expand-lg navbar-dark navbar-bg fixed-top">
    <div class="container-fluid">
        <div class="row w-25">
            <div class="col-12 col-lg-12">
                <a href="{{ url('/') }}" class="text-decoration-none">
                    <h5 class="text-uppercase fw-bold mx-0 px-0 mt-1">{{ $app }}</h5>
                </a>
            </div>
        </div>
        <a class="navbar-toggler ms-auto btn-animate shadow" type="button" data-bs-target="#navbar" data-bs-toggle="collapse">
            <span id="navbar_toggler" class="navbar-toggler-icon" style="width: 1em;height: 1em;"></span>
        </a>
        <div id="navbar" class="navbar-collapse collapse">
            <div class="row w-100 ps-3">
                <div class="col-12 col-lg-4 nav-item">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            {{-- EMPTY --}}
                        </div>
                        <div class="col-12 col-lg-6">
                            {{-- EMPTY --}}
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 nav-item">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            {{-- <a href="" class="nav-link text-uppercase text-center text-lg-end text-white">
                                <p class="p-0 m-0 mt-2">buat cv</p>
                            </a> --}}
                        </div>
                        <div class="col-12 col-lg-6">
                            {{-- <a href="" class="nav-link text-uppercase text-center text-lg-center text-white">
                                <p class="p-0 m-0 mt-2">cari</p>
                            </a> --}}
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 nav-item">
                    <div class="row">
                        @guest
                        <div class="col-12 col-lg-12">
                            <a class="nav-link text-uppercase text-center text-white" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
                                <p class="p-0 m-0 btn-animate rounded-pill px-3 py-2 fw-bold">masuk</p>
                            </a>
                        </div>
                        @endguest

                        <div class="col-12 col-lg-12">
                            <div class="nav-link dropdown-large">

                                @auth
                                <div class="row">
                                    <div class="col-12 col-lg-8 d-none d-lg-block">
                                        {{-- EMPTY --}}
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <a class="nav-link btn-animate rounded-pill px-3 py-2 text-white text-center fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
                                            <div class="rotation-animate">
                                                <div class="d-block d-sm-none">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-gear-fill w-10" viewBox="0 0 16 16">
                                                        <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                                                    </svg>
                                                </div>
                                                <div class="d-none d-sm-block d-md-none">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-gear-fill w-3" viewBox="0 0 16 16">
                                                        <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                                                    </svg>
                                                </div>
                                                <div class="d-none d-md-block d-lg-none">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-gear-fill w-3" viewBox="0 0 16 16">
                                                        <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                                                    </svg>
                                                </div>
                                                <div class="d-none d-lg-block d-xl-none">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-gear-fill w-100" viewBox="0 0 16 16">
                                                        <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                                                    </svg>
                                                </div>
                                                <div class="d-none d-xl-block d-xxl-none">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-gear-fill w-50" viewBox="0 0 16 16">
                                                        <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                                                    </svg>
                                                </div>
                                                <div class="d-none d-xxl-block">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-gear-fill" width="20" viewBox="0 0 16 16">
                                                        <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                                                    </svg>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                @endauth

                                @isset($menu)
                                <div id="menu" class="table-responsive dropdown-menu bg-dark slidedown-animate menu-bg border-0 rounded-0 p-0 m-0 mt-3 start-0 w-100 h-100 h-lg-auto zindex-01 shadow">
                                    <div class="container-fluid pt-0 pt-lg-4 pb-4 pb-lg-5">
                                        <div class="row">
                                            <div class="col-12 col-lg-3">

                                                @if (in_array('a', $menu))
                                                <div class="row w-100 pt-2 text-center text-lg-end text-white">
                                                    <div class="col-12 col-lg-6">
                                                        <div class="row">
                                                            <div class="col-12 col-lg-12">
                                                                <h5 class="text-capitalize fw-bold pb-0 pb-lg-2 mt-4 mt-lg-0">test</h5>
                                                            </div>
                                                            <div class="col-12 col-lg-12">
                                                                <a href="#" class="btn btn-outline-secondary border-0 bg-transparent text-capitalize p-0">
                                                                    <h5 class="m-0">test</h5>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-lg-6">
                                                        <div class="row">
                                                            <div class="col-12 col-lg-12">
                                                                <h5 class="text-capitalize fw-bold pb-0 pb-lg-2 mt-4 mt-lg-0">test</h5>
                                                            </div>
                                                            <div class="col-12 col-lg-12">
                                                                <a href="#" class="btn btn-outline-secondary border-0 bg-transparent text-capitalize p-0">
                                                                    <h5 class="m-0">test</h5>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif

                                            </div>
                                            <div class="col-12 col-lg-3">

                                                @if (in_array('b', $menu))
                                                <div class="row w-100 pt-2 text-center text-lg-end text-white">
                                                    <div class="col-12 col-lg-6">
                                                        <div class="row">
                                                            <div class="col-12 col-lg-12">
                                                                <h5 class="text-capitalize fw-bold pb-0 pb-lg-2 mt-4 mt-lg-0">test</h5>
                                                            </div>
                                                            <div class="col-12 col-lg-12">
                                                                <a href="#" class="btn btn-outline-secondary border-0 bg-transparent text-capitalize p-0">
                                                                    <h5 class="m-0">test</h5>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-lg-6">
                                                        <div class="row">
                                                            <div class="col-12 col-lg-12">
                                                                <h5 class="text-capitalize fw-bold pb-0 pb-lg-2 mt-4 mt-lg-0">test</h5>
                                                            </div>
                                                            <div class="col-12 col-lg-12">
                                                                <a href="#" class="btn btn-outline-secondary border-0 bg-transparent text-capitalize p-0">
                                                                    <h5 class="m-0">test</h5>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif

                                            </div>
                                            <div class="col-12 col-lg-3">

                                                @if (in_array('c', $menu))
                                                <div class="row w-100 pt-2 text-center text-lg-end text-white">
                                                    <div class="col-12 col-lg-6">
                                                        <div class="row">
                                                            <div class="col-12 col-lg-12">
                                                                <h5 class="text-capitalize fw-bold pb-0 pb-lg-2 mt-4 mt-lg-0">test</h5>
                                                            </div>
                                                            <div class="col-12 col-lg-12">
                                                                <a href="#" class="btn btn-outline-secondary border-0 bg-transparent text-capitalize p-0">
                                                                    <h5 class="m-0">test</h5>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-lg-6">
                                                        <div class="row">
                                                            <div class="col-12 col-lg-12">
                                                                <h5 class="text-capitalize fw-bold pb-0 pb-lg-2 mt-4 mt-lg-0">test</h5>
                                                            </div>
                                                            <div class="col-12 col-lg-12">
                                                                <a href="#" class="btn btn-outline-secondary border-0 bg-transparent text-capitalize p-0">
                                                                    <h5 class="m-0">test</h5>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif

                                            </div>
                                            <div class="col-12 col-lg-3">

                                                @if (in_array('d', $menu))
                                                <div class="row w-100 pt-2 text-center text-lg-end text-white">

                                                    @guest
                                                    <div class="col-12 col-lg-12">
                                                        <div class="row">
                                                            <div class="col-12 col-lg-12">
                                                                <h5 class="text-capitalize fw-bold pb-0 pb-lg-2 mt-4 mt-lg-0">akun</h5>
                                                            </div>
                                                            <div class="col-12 col-lg-12">
                                                                <a href="{{ url('register') }}" class="btn btn-outline-secondary border-0 bg-transparent text-capitalize p-0">
                                                                    <h5 class="m-0">daftar baru</h5>
                                                                </a>
                                                            </div>
                                                            <div class="col-12 col-lg-12">
                                                                <a href="{{ url('login') }}" class="btn btn-outline-secondary border-0 bg-transparent text-capitalize p-0">
                                                                    <h5 class="m-0">masuk</h5>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @else
                                                    <div class="col-12 col-lg-12">
                                                        <div class="row">
                                                            <div class="col-12 col-lg-12">
                                                                <h5 class="text-capitalize fw-bold pb-0 pb-lg-2 mt-4 mt-lg-0">settings</h5>
                                                            </div>
                                                            <div class="col-12 col-lg-12">
                                                                <a href="{{ url('profile') }}" class="btn btn-outline-secondary border-0 bg-transparent text-capitalize p-0">
                                                                    <h5 class="m-0">edit profile</h5>
                                                                </a>
                                                            </div>
                                                            <div class="col-12 col-lg-12">
                                                                <a href="{{ url('logout') }}" class="btn btn-outline-secondary border-0 bg-transparent text-capitalize p-0">
                                                                    <h5 class="m-0">logout</h5>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endguest

                                                </div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endisset

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
