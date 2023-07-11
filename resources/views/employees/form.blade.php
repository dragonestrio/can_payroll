@extends('layouts.template')
@section('app')

<div class="d-block position-relative height-0 pb-50 pb-lg-15">
    <div class="page-breadcrumb bg-info pb-2">
        @switch($state)
            @case('create')
                {{ view('partials.breadcumb.normal', [
                    'pages' => [
                        'karyawan'             =>  url('employee'),
                        'buat data karyawan baru'   =>  ''
                    ],
                    'pages_current' => 'buat data karyawan baru']) }}
                @break

            @case('update')
                {{ view('partials.breadcumb.normal', [
                    'pages' => [
                        'karyawan'         =>  url('employee'),
                        'edit data karyawan'  =>  ''
                    ],
                    'pages_current' => 'edit data karyawan']) }}
                @break

            @default

        @endswitch

        {{-- <form action="" method="get" class="pt-5 px-2 px-lg-5">
            <div class="d-flex justify-content-between">
                <input type="search" name="search" class="form-control rounded-5-important me-4" placeholder="Cari disini..." value="{{ request()->input('search') }}">
                <button class="btn btn-success text-capitalize text-center text-white mb-0 rounded-5-important">
                <svg xmlns="http://www.w3.org/2000/svg" height="16" fill="currentColor" class="bi bi-search text-white" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
                </button>
            </div>
        </form> --}}
    </div>
    @include('partials.header.custom')
</div>

<main class="">
    <div class="container-fluid text-dark">
        <div class="px-0 px-lg-4 pb-4">
            <div class="card rounded-8-important width-100 width-lg-75 py-4 py-lg-5 px-3 px-lg-4 mx-auto">
                <form action="{{ (isset($employees)) ? url('employee/'.$employees->id) : url('employee') }}" method="post" enctype="multipart/form-data" id="form">
                    @csrf
                    @if (isset($employees))
                        @method('put')
                    @endif

                    <div class="py-2">
                        {{ view('forms.input-floating', ['data' => [
                            'type'          => 'text',
                            'name'          => 'name',
                            'value'         => (old('name') != null) ? old('name') : (isset($employees) ? $employees->name : ''),
                            'placeholder'   => ucwords('masukkan nama karyawan'),
                            'class_add'     => '',
                            'optional'      => 'required autofocus',
                            'label'         => 'nama karyawan',
                            'option'        => []
                        ]]) }}
                    </div>

                    <div class="py-2">
                        {{ view('forms.input-floating', ['data' => [
                            'type'          => 'text',
                            'name'          => 'section',
                            'value'         => (old('section') != null) ? old('section') : (isset($employees) ? $employees->section : ''),
                            'placeholder'   => ucwords('masukkan divisi karyawan'),
                            'class_add'     => '',
                            'optional'      => 'required',
                            'label'         => 'divisi karyawan',
                            'option'        => []
                        ]]) }}
                    </div>

                    <div class="py-2">
                        {{ view('forms.input-floating', ['data' => [
                            'type'          => 'email',
                            'name'          => 'email',
                            'value'         => (old('email') != null) ? old('email') : (isset($employees) ? $employees->email : ''),
                            'placeholder'   => ucwords('masukkan email karyawan'),
                            'class_add'     => '',
                            'optional'      => 'required',
                            'label'         => 'email karyawan',
                            'option'        => []
                        ]]) }}
                    </div>

                    <div class="py-2">
                        {{ view('forms.input-group', ['data' => [
                            'type'          => 'number',
                            'name'          => 'basic_salary',
                            'value'         => (old('basic_salary') != null) ? old('basic_salary') : (isset($employees) ? $employees->basic_salary : ''),
                            'placeholder'   => ucwords('masukkan nominal gaji pokok karyawan'),
                            'class_add'     => '',
                            'optional'      => 'required',
                            'label'         => 'rp',
                            'option'        => []
                        ]]) }}
                    </div>

                </form>
                <div class="d-flex justify-content-between pt-4">
                    <a onclick="history.back()" class="btn btn-outline-light bg-gradient-faded-light border-0 py-2 px-4 rounded-5-important text-secondary text-uppercase">
                        <p class="p-0 m-0 text-capitalize">kembali</p>
                    </a>
                    <button form="form" class="btn btn-info py-2 px-4 rounded-5-important text-white text-uppercase">
                        <p class="p-0 m-0 text-capitalize">{{ (isset($employees)) ? 'perbarui' : 'buat' }}</p>
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>

@include('partials.footer.custom')
@endsection
