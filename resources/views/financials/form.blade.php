@extends('layouts.template')
@section('app')

<div class="d-block position-relative height-0 pb-50 pb-lg-15">
    <div class="page-breadcrumb bg-info pb-2">
        @switch($state)
            @case('create')
                {{ view('partials.breadcumb.normal', [
                    'pages' => [
                        'keuangan'             =>  url('financial'),
                        'buat data keuangan baru'   =>  ''
                    ],
                    'pages_current' => 'buat data keuangan baru']) }}
                @break

            @case('update')
                {{ view('partials.breadcumb.normal', [
                    'pages' => [
                        'keuangan'         =>  url('financial'),
                        'edit data keuangan'  =>  ''
                    ],
                    'pages_current' => 'edit data keuangan']) }}
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
                <form action="{{ (isset($financials)) ? url('financial/'.$financials->id) : url('financial') }}" method="post" enctype="multipart/form-data" id="form">
                    @csrf
                    @if (isset($financials))
                        @method('put')
                    @endif

                    <div class="py-2">
                        {{ view('forms.input-floating', ['data' => [
                            'type'          => 'text',
                            'name'          => 'name',
                            'value'         => (old('name') != null) ? old('name') : (isset($financials) ? $financials->name : ''),
                            'placeholder'   => ucwords('masukkan nama karyawan'),
                            'class_add'     => '',
                            'optional'      => 'required autofocus',
                            'label'         => 'nama transaksi',
                            'option'        => []
                        ]]) }}
                    </div>

                    <div class="py-2">
                        {{ view('forms.input-floating', ['data' => [
                            'type'          => 'date',
                            'name'          => 'created_at',
                            'value'         => (old('created_at') != null) ? old('created_at') : (isset($financials) ? date('Y-m-d', strtotime($financials->created_at)) : ''),
                            'placeholder'   => ucwords('masukkan tanggal transaksi nya'),
                            'class_add'     => '',
                            'optional'      => 'min=2001-01-01 max='.date('Y-m-d', time()).' required',
                            'label'         => 'tanggal transaksi',
                            'option'        => []
                        ]]) }}
                    </div>

                    <div class="py-2">
                        {{ view('forms.input-select-floating', ['data' => [
                            'type'          => 'text',
                            'name'          => 'category',
                            'value'         => (old('category') != null) ? old('category') : (isset($financials) ? $financials->category : ''),
                            'placeholder'   => ucwords('masukkan divisi karyawan'),
                            'class_add'     => '',
                            'optional'      => 'required',
                            'label'         => 'jenis transaksi',
                            'option'        => ['additional'=>'pemasukan', 'deductions'=>'pengeluaran']
                        ]]) }}
                    </div>

                    <div class="py-2">
                        {{ view('forms.input-group', ['data' => [
                            'type'          => 'number',
                            'name'          => 'value',
                            'value'         => (old('value') != null) ? old('value') : (isset($financials) ? $financials->value : ''),
                            'placeholder'   => ucwords('masukkan nominal nya'),
                            'class_add'     => '',
                            'optional'      => 'required',
                            'label'         => 'Rp',
                            'option'        => []
                        ]]) }}
                    </div>

                    <div class="py-2">
                        {{ view('forms.input-textarea', ['data' => [
                            'type'          => 'text',
                            'name'          => 'description',
                            'value'         => (old('description') != null) ? old('description') : (isset($financials) ? $financials->description : ''),
                            'placeholder'   => ucwords('masukkan penjelasan tentang transaksi ini'),
                            'class_add'     => '',
                            'optional'      => '',
                            'label'         => 'deskripsi',
                            'option'        => []
                        ]]) }}
                    </div>

                </form>
                <div class="d-flex justify-content-between pt-4">
                    <a onclick="history.back()" class="btn btn-outline-light bg-gradient-faded-light border-0 py-2 px-4 rounded-5-important text-secondary text-uppercase">
                        <p class="p-0 m-0 text-capitalize">kembali</p>
                    </a>
                    <button form="form" class="btn btn-info py-2 px-4 rounded-5-important text-white text-uppercase">
                        <p class="p-0 m-0 text-capitalize">{{ (isset($financials)) ? 'perbarui' : 'buat' }}</p>
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>

@include('partials.footer.custom')
@endsection
