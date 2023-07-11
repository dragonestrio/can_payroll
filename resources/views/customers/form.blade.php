@extends('layouts.template')
@section('app')

<main>
  @include('partials.sidebar.custom')
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
              <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white text-capitalize">Admin</a></li>
              <li class="breadcrumb-item text-sm text-white text-capitalize active">{{ $position }}</li>
            </ol>
            <h6 class="font-weight-bolder text-white text-capitalize mb-0">{{ $position }}</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            {{-- EMPTY --}}
          </div>
          <ul class="navbar-nav  justify-content-end">

            @auth
            <li class="nav-item dropdown pe-2 d-flex align-items-center">
                <a href="{{ url('login') }}" class="nav-link text-white p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-user me-sm-1"></i>
                  <span class="d-sm-inline d-none text-capitalize">{{ auth()->user()->name }}</span>
                </a>
              <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                <li class="mb-2">
                  <a href="{{ url('profile') }}" class="dropdown-item border-radius-md">
                    <div class="d-flex justify-content-center text-capitalize fw-bold">
                        <i class="fa fa-user pe-2 pt-1"></i>
                        <span class="">Profile</span>
                    </div>
                  </a>
                </li>
                <li class="mb-2">
                  <form action="{{ url('logout') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <button class="dropdown-item form-control btn btn-primary bg-primary text-center text-capitalize fw-bold border-radius-md">logout</button>
                  </form>
                </li>
              </ul>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                </div>
              </a>
            </li>
            @else
            <li class="nav-item">
              <a href="{{ url('login') }}" class="nav-link text-white p-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="ps-2">Sign In</span>
              </a>
            </li>
            @endauth

          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4 text-dark">
      <div class="row">
        <div class="col-12 col-lg-12">
          <div class="card">
            <div class="row pt-4">
                <div class="col-12 col-lg-12 py-3 px-5">
                    @switch($state)
                        @case('update')
                            <h4 class="text-center text-capitalize fw-bolder">perbarui {{ $position }}</h4>
                            @break
                        @case('create')
                            <h4 class="text-center text-capitalize fw-bolder">tambah {{ $position }}</h4>
                            @break
                        @default

                    @endswitch
                </div>
                <div class="col-12 col-lg-12 py-3 px-5">
                    <form action="{{ (isset($customers)) ? url('customers/'.$customers->id) : url('customers') }}" method="post" enctype="multipart/form-data" id="form">
                        @csrf
                        @if (isset($customers))
                            @method('put')
                        @endif
                        <div class="row py-2">
                            <div class="col-12 col-lg-4">
                                <p class="text-capitalize fs-5 p-0 m-0 text-sm fw-bold">nama</p>
                            </div>
                            <div class="col-12 col-lg-8">
                                <input type="text" name="name" class="form-control @error('name')
                                is-invalid
                                @enderror" value="{{ (old('name') != null) ? old('name') : (isset($customers) ? $customers->name : '') }}" required autofocus>
                                @error('name')
                                <p class="p-0 m-0 text-danger text-input-failed">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row py-2">
                            <div class="col-12 col-lg-4">
                                <p class="text-capitalize fs-5 p-0 m-0 text-sm fw-bold">nomor telpon</p>
                            </div>
                            <div class="col-12 col-lg-8">
                                <input type="number" name="phone" class="form-control @error('phone')
                                is-invalid
                                @enderror" value="{{ (old('phone') != null) ? old('phone') : (isset($customers) ? $customers->phone : '') }}" required>
                                @error('phone')
                                <p class="p-0 m-0 text-danger text-input-failed">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row py-2">
                            <div class="col-12 col-lg-4">
                                <p class="text-capitalize fs-5 p-0 m-0 text-sm fw-bold">alamat</p>
                            </div>
                            <div class="col-12 col-lg-8">
                                <textarea name="address" class="form-control @error('address')
                                is-invalid
                                @enderror" rows="2">{!! (old('address') != null) ? old('address') : (isset($customers) ? $customers->address : '') !!}</textarea>
                                @error('address')
                                <p class="p-0 m-0 text-danger text-input-failed">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <div class="row py-5">
                <div class="col-12 col-lg-12">
                    <div class="px-3 px-lg-4">
                        <div class="d-flex justify-content-between">
                            <button onclick="history.back()" class="btn btn-primary rounded-pill text-uppercase fw-bold" role="button">
                                <div class="d-flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="27" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                                    </svg>
                                    <p class="d-none d-lg-block p-0 m-0 ps-2 fw-bold text-capitalize">kembali</p>
                                </div>
                            </button>
                            <button form="form" class="btn btn-primary rounded-pill text-uppercase fw-bold" role="button">
                                <div class="d-flex">
                                    <p class="d-none d-lg-block p-0 m-0 ps-2 pe-2 fw-bold text-capitalize">{{ (isset($customers)) ? 'perbarui' : 'buat' }}</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" height="27" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                                    </svg>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      @include('partials.footer.custom')
    </div>
  </main>
</main>

@endsection
