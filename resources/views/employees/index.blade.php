@extends('layouts.template')
@section('app')

<div class="d-block position-relative height-0 pb-50 pb-lg-25">
    <div class="page-breadcrumb bg-info pb-2">
        {{ view('partials.breadcumb.normal', [
            'pages' => [
                'karyawan'         =>  url('employee'),
                'daftar karyawan'  =>  ''
            ],
            'pages_current' => 'daftar karyawan']) }}

        <form action="" method="get" class="pt-5 px-2 px-lg-5">
            <div class="d-flex justify-content-between">
                <input type="search" name="search" class="form-control rounded-5-important me-4" placeholder="Cari disini..." value="{{ request()->input('search') }}">
                <button class="btn btn-success text-capitalize text-center text-white mb-0 rounded-5-important">
                <svg xmlns="http://www.w3.org/2000/svg" height="16" fill="currentColor" class="bi bi-search text-white" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
                </button>
            </div>
        </form>
    </div>
    @include('partials.header.custom')
</div>

<main>
    <div class="container-fluid text-dark pt-5 mt-5">
        <div class="px-0 px-lg-4 py-4 mt-2 mt-lg-5">
            <div class="card bg-transparent border-0 shadow-none d-none d-lg-block">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="d-flex justify-content-between px-2 px-lg-4">
                            <p class="p-0 m-0 text-capitalize text-xxs">nama</p>
                            <p class="p-0 m-0 text-capitalize text-xxs">bidang</p>
                            <p class="p-0 m-0 text-capitalize text-xxs">email</p>
                            <p class="p-0 m-0 text-capitalize text-xxs">gaji pokok</p>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="d-flex justify-content-center px-2 px-lg-4">
                            <p class="p-0 m-0 text-capitalize text-xxs">tindakan</p>
                        </div>
                    </div>
                </div>
            </div>
            @can ('admin_superadmin')
                @foreach ($employees as $item)
                    <div class="card rounded-8-important overflow-hidden">
                        <div class="row px-3">
                            <div class="col-12 col-lg-8 py-3 table-responsive">
                                <div class="d-flex justify-content-between">
                                    <p class="p-0 m-0 text-capitalize py-2 mx-4">{{ $item->name }}</p>
                                    <p class="p-0 m-0 text-capitalize py-2 mx-4">{{ $item->section }}</p>
                                    <p class="p-0 m-0 text-lowercase py-2 mx-4">{{ $item->email }}</p>
                                    <p class="p-0 m-0 text-capitalize py-2 mx-4">Rp. {{ number_format($item->basic_salary, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4 py-3 d-flex justify-content-center border-1 border-start">
                                {{-- <a href="{{ url('employee/'.$item->id) }}" class="btn btn-outline-light bg-gradient-faded-light border-0 shadow-none text-decoration-none fw-bold py-0 mx-auto my-auto">
                                    <div class="input-group-text bg-transparent border-0 text-secondary">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                        </svg>
                                    </div>
                                </a> --}}
                                <a href="{{ url('employee/'.$item->id.'/edit') }}" class="btn btn-outline-light bg-gradient-faded-light border-0 shadow-none text-decoration-none fw-bold py-0 mx-auto my-auto">
                                    <div class="input-group-text bg-transparent border-0 text-secondary">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="16" fill="currentColor" class="bi bi-gear-wide-connected" viewBox="0 0 16 16">
                                            <path d="M7.068.727c.243-.97 1.62-.97 1.864 0l.071.286a.96.96 0 0 0 1.622.434l.205-.211c.695-.719 1.888-.03 1.613.931l-.08.284a.96.96 0 0 0 1.187 1.187l.283-.081c.96-.275 1.65.918.931 1.613l-.211.205a.96.96 0 0 0 .434 1.622l.286.071c.97.243.97 1.62 0 1.864l-.286.071a.96.96 0 0 0-.434 1.622l.211.205c.719.695.03 1.888-.931 1.613l-.284-.08a.96.96 0 0 0-1.187 1.187l.081.283c.275.96-.918 1.65-1.613.931l-.205-.211a.96.96 0 0 0-1.622.434l-.071.286c-.243.97-1.62.97-1.864 0l-.071-.286a.96.96 0 0 0-1.622-.434l-.205.211c-.695.719-1.888.03-1.613-.931l.08-.284a.96.96 0 0 0-1.186-1.187l-.284.081c-.96.275-1.65-.918-.931-1.613l.211-.205a.96.96 0 0 0-.434-1.622l-.286-.071c-.97-.243-.97-1.62 0-1.864l.286-.071a.96.96 0 0 0 .434-1.622l-.211-.205c-.719-.695-.03-1.888.931-1.613l.284.08a.96.96 0 0 0 1.187-1.186l-.081-.284c-.275-.96.918-1.65 1.613-.931l.205.211a.96.96 0 0 0 1.622-.434l.071-.286zM12.973 8.5H8.25l-2.834 3.779A4.998 4.998 0 0 0 12.973 8.5zm0-1a4.998 4.998 0 0 0-7.557-3.779l2.834 3.78h4.723zM5.048 3.967c-.03.021-.058.043-.087.065l.087-.065zm-.431.355A4.984 4.984 0 0 0 3.002 8c0 1.455.622 2.765 1.615 3.678L7.375 8 4.617 4.322zm.344 7.646.087.065-.087-.065z"/>
                                        </svg>
                                    </div>
                                </a>
                                <button form="delete-{{ $item->id }}" onclick="return confirm('Apakah benar Anda ingin menghapus {{ $item->name }} ?')" class="btn btn-outline-light bg-gradient-faded-light border-0 shadow-none fw-bold mx-auto py-0 my-auto">
                                    <form action="{{ url('employee/'.$item->id) }}" method="post" enctype="multipart/form-data" class="d-inline" id="delete-{{ $item->id }}">
                                        @method('delete')
                                        @csrf
                                        <div class="input-group-text bg-transparent border-0 text-secondary">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                            </svg>
                                        </div>
                                    </form>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endcan

            <div class="d-flex justify-content-end pb-5">
                {{ $employees->links() }}
                {{-- @php $pagination_external = $employees; @endphp
                @include('partials.pagination.simple-custom') --}}
            </div>
        </div>
    </div>
</main>

@include('partials.footer.custom')
@endsection
