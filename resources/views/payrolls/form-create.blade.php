@extends('layouts.template')
@section('app')

<div class="d-block position-relative height-0 pb-50 pb-lg-15">
    <div class="page-breadcrumb bg-info pb-2">
        @switch($state)
            @case('create')
                {{ view('partials.breadcumb.normal', [
                    'pages' => [
                        'gajian'             =>  url('payroll'),
                        'buat data penggajian baru'   =>  ''
                    ],
                    'pages_current' => 'buat data penggajian baru']) }}
                @break

            @case('update')
                {{ view('partials.breadcumb.normal', [
                    'pages' => [
                        'gajian'         =>  url('payroll'),
                        'edit data penggajian'  =>  ''
                    ],
                    'pages_current' => 'edit data penggajian']) }}
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
                <form action="" method="post" enctype="multipart/form-data" id="form">
                    @csrf
                    @if (isset($payrolls))
                        @method('put')
                    @endif

                    @if (request()->input('date') == null)
                        <div class="py-2">
                            {{ view('forms.input-floating', ['data' => [
                                'type'          => 'month',
                                'name'          => 'date',
                                'value'         => (old('date') != null) ? old('date') : '',
                                'placeholder'   => ucwords('masukkan bulan dan tahun nya'),
                                'class_add'     => '',
                                'optional'      => 'required autofocus',
                                'label'         => 'bulan dan tahun',
                                'option'        => []
                            ]]) }}
                        </div>
                    @else
                        <input type="hidden" name="date" value="{{ request()->input('date') }}">
                    @endif

                    @if (request()->input('date') != null && request()->input('employee_id') == null)
                        <div class="py-2">
                            {{ view('forms.input-select-floating', ['data' => [
                                'type'          => 'select',
                                'name'          => 'employee_id',
                                'value'         => (old('employee_id') != null) ? old('employee_id') : '',
                                'placeholder'   => ucwords('pilih karyawan'),
                                'class_add'     => '',
                                'optional'      => 'required autofocus',
                                'label'         => 'karyawan',
                                'option'        => $employees
                            ]]) }}
                        </div>
                        <div class="py-2">
                            {{ view('forms.input-textarea', ['data' => [
                                'type'          => 'textarea',
                                'name'          => 'description',
                                'value'         => (old('description') != null) ? old('description') : '',
                                'placeholder'   => ucwords('masukan catatan (bila ada)'),
                                'class_add'     => '',
                                'optional'      => '',
                                'label'         => 'deskripsi',
                                'option'        => []
                            ]]) }}
                        </div>
                    @elseif (request()->input('date') != null && request()->input('employee_id') != null)
                        <input type="hidden" name="employee_id" value="{{ request()->input('employee_id') }}">
                        <input type="hidden" name="description" value="{{ request()->input('description') }}">
                    @endif

                    @if (request()->input('date') != null && request()->input('employee_id') != null)
                        <div class="py-2 d-flex justify-content-between">
                            <p class="m-0 p-0 text-capitalize">detail gaji</p>
                            {{-- add button --}}
                            <button form="form" id="payroll_add" onclick="add_payroll_details()"
                            class="btn btn-outline-light bg-gradient-faded-light border-0 text-muted py-2 px-4 rounded-5-important">
                                <i class="bi bi-plus-circle"></i>
                            </button>
                            {{--  --}}
                        </div>
                        <input type="hidden" name="payroll_details" value="[]">
                        @foreach ($payroll_categories as $key => $value)
                            <input type="hidden" name="payroll_details[{{ $key }}]" value="[]">
                            <input type="hidden" name="payroll_details[{{ $key }}][payroll_category_id]" value="{{ $value->payroll_category_id }}">
                            <input type="hidden" name="payroll_details[{{ $key }}][name]" value="{{ $value->name }}">
                            <input type="hidden" name="payroll_details[{{ $key }}][type]" value="{{ $value->type }}">
                            <div class="py-3 px-3 mb-3 rounded-5-important border-1 border">
                                @if ($value->name != null)
                                    <p class="m-0 p-0 text-capitalize">{{ $value->name }}</p>
                                @else
                                    {{ view('forms.input-floating', ['data' => [
                                        'type'          => 'text',
                                        'name'          => 'payroll_details['.$key.'][name]',
                                        'value'         => (!isset($payroll_details[$key]['name']) ? '' : $payroll_details[$key]['name']),
                                        'placeholder'   => ucwords('masukkan nama kategori gaji'),
                                        'class_add'     => 'border-start-0 border-end-0 border-top-0 rounded-0',
                                        'optional'      => ($value->type == 'dynamic') ? 'required' : 'readonly',
                                        'label'         => 'nama kategori gaji tambahan',
                                        'option'        => []
                                    ]]) }}
                                @endif
                                <div class="py-2">
                                    {{ view('forms.input-floating', ['data' => [
                                        'type'          => 'number',
                                        'name'          => 'payroll_details['.$key.'][value]',
                                        'value'         => (!isset($payroll_details[$key]['value']))
                                        ? (($value->name == 'gaji pokok' || $value->name == ucwords('gaji pokok')) ? $employee_basic_salaries : $value->value)
                                        : $payroll_details[$key]['value'],
                                        'placeholder'   => ucwords('masukkan nominal nya'),
                                        'class_add'     => '',
                                        'optional'      => ($value->type == 'dynamic') ? 'required' : 'readonly',
                                        'label'         => 'nominal',
                                        'option'        => []
                                    ]]) }}
                                </div>
                                <div class="py-2">
                                    {{ view('forms.input-textarea', ['data' => [
                                        'type'          => 'textarea',
                                        'name'          => 'payroll_details['.$key.'][description]',
                                        'value'         => (!isset($payroll_details[$key]['description']) ? '' : $payroll_details[$key]['description']),
                                        'placeholder'   => ucwords('masukan deskripsi dari kategori gaji ini'),
                                        'class_add'     => '',
                                        'optional'      => ($value->type == 'dynamic') ? '' : 'readonly',
                                        'label'         => 'deskripsi',
                                        'option'        => []
                                    ]]) }}
                                </div>
                            </div>
                        @endforeach
                    @endif

                </form>
                <div class="d-flex justify-content-between pt-4">
                    <a onclick="history.back()"
                    class="btn btn-outline-light bg-gradient-faded-light border-0 py-2 px-4 rounded-5-important text-secondary text-uppercase">
                        <p class="p-0 m-0 text-capitalize">kembali</p>
                    </a>
                    <button form="form" id="payroll_submit" {{ (request()->input('employee_id') == null) ? '' : 'onclick=submit_payroll_details()' }}
                    class="btn btn-info py-2 px-4 rounded-5-important text-white text-uppercase">
                        <p class="p-0 m-0 text-capitalize">{{ (request()->input('employee_id') == null) ? 'selanjutnya' : 'buat' }}</p>
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>

@include('partials.footer.custom')
@endsection
