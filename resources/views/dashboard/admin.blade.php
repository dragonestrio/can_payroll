@extends('layouts.template')
@section('app')

<div class="d-block position-relative height-0 pb-50 pb-lg-25">
    <div class="page-breadcrumb bg-info pb-2">
        {{ view('partials.breadcumb.normal', [
            'pages' => [
                'dashboard'     =>  '',
            ],
            'pages_current' => 'dashboard']) }}

        <div class="arccordion pt-5">
            <div class="accordion-item">
                <div class="accordion-header d-flex justify-content-center justify-content-lg-end">
                    <button class="btn bg-transparent btn-outline-light text-capitalize text-light fw-bold rounded-5-important pe-3" type="button" data-bs-toggle="collapse" data-bs-target="#flush-one" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
                        <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                        filters
                    </button>
                </div>
                <div id="flush-one" class="accordion-collapse collapse border-0">
                    <form action="" method="get" class="pt-3">
                        <div class="row text-light">

                            {{-- <div class="col-6 col-lg-4">
                                <div class="row">
                                <div class="col-12 col-lg-12">
                                    <p class="p-0 m-0 text-capitalize fw-bolder">filter status</p>
                                </div>
                                <div class="col-12 col-lg-12">
                                    <select name="status" class="form-select text-center">
                                    @if (request()->input('status') != null)
                                        @foreach ($status as $item)
                                        @if ($item->status == request()->input('status'))
                                            <option value="{{ $item->status }}">{{ ucwords($item->status) }}</option>
                                        @endif
                                        @endforeach
                                    @endif

                                    @foreach ($status as $item)
                                        <option value="{{ $item->status }}">{{ ucwords($item->status) }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                </div>
                            </div> --}}

                            <div class="col-8 col-lg-10">
                                <div class="row">
                                <div class="col-12 col-lg-12">
                                    <p class="p-0 m-0 text-capitalize fw-bolder">berdasarkan</p>
                                </div>
                                <div class="col-12 col-lg-12">
                                    @php
                                        $filter = [
                                            // 'time'  => 'jam',
                                            // 'day'   => 'hari',
                                            'month' => 'bulan',
                                            'year'  => 'tahun',
                                        ];
                                    @endphp
                                    {{ view('forms.input-select', ['data' => [
                                        'type'          => 'select',
                                        'name'          => 'sort',
                                        'value'         => (request()->input('sort') != null) ? request()->input('sort') : '',
                                        'placeholder'   => ucwords('pilih filter'),
                                        'class_add'     => 'text-center',
                                        'optional'      => 'required',
                                        'label'         => 'berdasarkan',
                                        'option'        => $filter
                                    ]]) }}
                                </div>
                                </div>
                            </div>

                            <div class="col-4 col-lg-2">
                                <div class="row">
                                <div class="col-12 col-lg-12">
                                    <p class="p-0 m-0 text-capitalize fw-bolder">&nbsp;</p>
                                </div>
                                <div class="col-12 col-lg-12">
                                    <button class="form-control btn btn-success text-capitalize text-center text-white fw-bold mb-0 rounded-5-important">muat</button>
                                </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('partials.header.custom')
</div>

<main>
    <div class="container-fluid text-dark">
        <div class="row">

            <div class="col-12 col-lg-4 mb-4">
                <div class="card p-3 rounded-10-important h-100">
                    <div class="row">
                        <div class="col-9 col-lg-9">
                            <p class="p-0 m-0 text-uppercase text-secondary">akumulasi penggajian</p>
                            <div class="d-flex justify-content-between">
                                <p class="p-0 m-0 text-capitalize fw-bold pe-2 pt-1">Rp. </p>
                                <p class="p-0 m-0 text-capitalize fw-bold text-break fs-3"> {{ number_format($report->penggajian[0], 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="col-3 col-lg-3 px-3 px-lg-3">
                            <div class="d-flex justify-content-center size-dashboard-circle rounded-circle bg-success bg-gradient text-white shadow shadow-blur">
                                <i class="bi bi-wallet2 fs-2 fs-lg-3 my-auto"></i>
                            </div>
                        </div>
                    </div>
                    @php
                        $penggajian_different = $report->penggajian[0] - $report->penggajian[1];
                    @endphp
                    <p class="p-0 m-0 text-lowercase text-secondary mt-auto">@if ($penggajian_different > 0)
                        <span class="fw-bold text-success">+{{ number_format($penggajian_different, 0, ',', '.') }}</span>
                    @elseif ($penggajian_different < 0)
                        <span class="fw-bold text-danger">{{ number_format($penggajian_different, 0, ',', '.') }}</span>
                    @else
                        <span class="fw-bold">{{ number_format($penggajian_different, 0, ',', '.') }}</span>
                    @endif dari jumlah sebelumnya
                    </p>
                </div>
            </div>
            <div class="col-12 col-lg-4 mb-4">
                <div class="card p-3 rounded-10-important h-100">
                    <div class="row">
                        <div class="col-9 col-lg-9">
                            <p class="p-0 m-0 text-uppercase text-secondary">akumulasi pemasukan</p>
                            <div class="d-flex justify-content-between">
                                <p class="p-0 m-0 text-capitalize fw-bold pe-2 pt-1">Rp. </p>
                                <p class="p-0 m-0 text-capitalize fw-bold text-break fs-3"> {{ number_format($report->pemasukan[0], 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="col-3 col-lg-3 px-3 px-lg-3">
                            <div class="d-flex justify-content-center size-dashboard-circle rounded-circle bg-warning bg-gradient text-white shadow shadow-blur">
                                <i class="bi bi-cash-coin fs-2 fs-lg-3 my-auto"></i>
                            </div>
                        </div>
                    </div>
                    @php
                        $pemasukan_different = $report->pemasukan[0] - $report->pemasukan[1];
                    @endphp
                    <p class="p-0 m-0 text-lowercase text-secondary mt-auto">@if ($pemasukan_different > 0)
                        <span class="fw-bold text-success">+{{ number_format($pemasukan_different, 0, ',', '.') }}</span>
                    @elseif ($pemasukan_different < 0)
                        <span class="fw-bold text-danger">{{ number_format($pemasukan_different, 0, ',', '.') }}</span>
                    @else
                        <span class="fw-bold">{{ number_format($pemasukan_different, 0, ',', '.') }}</span>
                    @endif dari jumlah sebelumnya
                    </p>
                </div>
            </div>
            <div class="col-12 col-lg-4 mb-4">
                <div class="card p-3 rounded-10-important h-100">
                    <div class="row">
                        <div class="col-9 col-lg-9">
                            <p class="p-0 m-0 text-uppercase text-secondary">akumulasi pengeluaran</p>
                            <div class="d-flex justify-content-between">
                                <p class="p-0 m-0 text-capitalize fw-bold pe-2 pt-1">Rp. </p>
                                <p class="p-0 m-0 text-capitalize fw-bold text-break fs-3"> {{ number_format($report->pengeluaran[0], 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="col-3 col-lg-3 px-3 px-lg-3">
                            <div class="d-flex justify-content-center size-dashboard-circle rounded-circle bg-danger bg-gradient text-white shadow shadow-blur">
                                <i class="bi bi-currency-exchange fs-2 fs-lg-3 my-auto"></i>
                            </div>
                        </div>
                    </div>
                    @php
                        $pengeluaran_different = $report->pengeluaran[0] - $report->pengeluaran[1];
                    @endphp
                    <p class="p-0 m-0 text-lowercase text-secondary mt-auto">@if ($pengeluaran_different > 0)
                        <span class="fw-bold text-success">+{{ number_format($pengeluaran_different, 0, ',', '.') }}</span>
                    @elseif ($pengeluaran_different < 0)
                        <span class="fw-bold text-danger">{{ number_format($pengeluaran_different, 0, ',', '.') }}</span>
                    @else
                        <span class="fw-bold">{{ number_format($pengeluaran_different, 0, ',', '.') }}</span>
                    @endif dari jumlah sebelumnya
                    </p>
                </div>
            </div>

        </div>
    </div>
    <div class="container-fluid text-dark">
        <div class="card rounded-8-important overflow-hidden">
            <div class="py-4">
                <p class="p-0 m-0 text-capitalize text-center">statistik laporan pengeluaran & penggajian <span class="text-lowercase">vs</span> pemasukan</p>
            </div>
            <div id="dashboard_admin-a"></div>
            <table id="datatable" class="table">
                <thead class="d-none">
                    <tr>
                        <th class="text-capitalize">{{ ucwords('tanggal') }}</th>
                        <th class="text-capitalize">{{ ucwords('pengeluaran + penggajian') }}</th>
                        <th class="text-capitalize">{{ ucwords('pemasukan') }}</th>
                    </tr>
                </thead>
                <tbody class="d-none">
                    @foreach ($report->pengeluaran_penggajian as $key => $value)
                        <tr>
                            <td>{{ $report->label[$key] }}</td>
                            <td>{{ $value }}</td>
                            <td>{{ $report->pemasukan[$key] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>

@include('partials.footer.custom')
@endsection
