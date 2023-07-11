@extends('layouts.template')
@section('app')

<div class="d-block position-relative height-0 pb-50 pb-lg-15">
    <div class="page-breadcrumb bg-info pb-2">
        {{ view('partials.breadcumb.normal', [
            'pages' => [
                'gajian'        =>  url('payroll'),
                $employees->name    =>  url('payroll/'.$payrolls->id)
            ],
            'pages_current' => $employees->name]) }}
    </div>
    @include('partials.header.custom')
</div>

<main>
    <div class="container-fluid text-dark">
        <div class="px-0 px-lg-4 pb-4">
            <div class="card rounded-8-important width-100 width-lg-75 py-4 py-lg-4 px-3 px-lg-4 mx-auto">
                <div class="d-flex justify-content-center justify-content-lg-end">
                    <div class="px-2">
                        <a href="{{ url('payroll/'.$payrolls->id.'/edit') }}" class="btn btn-outline-light bg-gradient-faded-light border-0 text-muted py-2 px-4 rounded-5-important border-0">
                            <i class="bi bi-gear-wide-connected"></i>
                        </a>
                        <button form="delete-{{ $payrolls->id }}" onclick="return confirm('Apakah benar Anda ingin menghapus data gaji {{ $employees->name }} ?')"
                        class="btn btn-outline-light bg-gradient-faded-light border-0 shadow-none fw-bold mx-auto py-0 my-auto">
                            <form action="{{ url('payroll/'.$payrolls->id) }}" method="post" enctype="multipart/form-data" class="d-inline" id="delete-{{ $payrolls->id }}">
                                @method('delete')
                                @csrf
                                <div class="input-group-text bg-transparent border-0 text-muted">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                    </svg>
                                </div>
                            </form>
                        </button>
                    </div>
                </div>

                <div class="container pb-4">
                    <p class="p-0 m-0 text-capitalize fw-bold">gaji {{ $employees->name }}</p>
                    <div class="px-2">
                        <div class="d-flex text-muted">
                            <i class="bi bi-envelope"></i>
                            <p class="m-0 p-0 text-xs text-lowecase fw-normal ps-1 my-auto">{{ $users->email }}</p>
                        </div>
                        <p class="p-0 m-0 text-capitalize text-xs">dibuat oleh : <span class="fw-bold">{{ $users->name }}</span></p>
                        <p class="p-0 m-0 text-capitalize text-xs">tanggal : {{ date('d M Y', strtotime($payrolls->date)) }}</p>
                    </div>
                </div>

            </div>
            <div class="pt-5">
                <div class="card rounded-8-important py-4 py-lg-5 px-3 px-lg-4">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-capitalize text-break py-2 px-4 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                            type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">rincian</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                            <div class="row">
                                @foreach ($payroll_details as $key => $value)
                                <div class="col-7 col-lg-7 py-4 border-1 border-bottom">
                                    <p class="p-0 m-0 text-capitalize fw-bold">{{ $value->name }}</p>
                                    <p class="p-0 m-0 text-capitalize text-xs">{{ $value->description }}</p>
                                </div>
                                <div class="col-5 col-lg-5 py-4 border-1 border-bottom">
                                    <div class="d-flex justify-content-end">
                                        <p class="p-0 m-0 text-capitalize">Rp. {{ number_format($value->value, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@include('partials.footer.custom')
@endsection
