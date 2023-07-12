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

<style>
    @media print {
        @page {
            margin: 0;
        }
    }
</style>

<body id="body" class="">
    <div class="container mt-0 mt-md-5 px-0 border rounded-10-important overflow-hidden">
        <div class="px-2 px-md-4 py-3 bg-light">
            <table class="w-100">
                <tr>
                    <td>
                        <div class="mx-auto">
                            <img src="{{ url('media/logo/banner.png') }}" style="width: 7rem; height: 5rem; border-radius: 1rem;">
                        </div>
                    </td>
                    <td width="30%" class="text-end text-capitalize">
                        <table width="100%">
                            <tr>
                                <td>
                                    <p class="text-lowercase my-auto">hallo@can.co.id</p>
                                </td>
                                <td width="8%">
                                    <i class="bi bi-envelope"></i>
                                </td>
                            </tr>
                        </table>
                        <table width="100%">
                            <tr>
                                <td>
                                    <p class="my-auto">Jl. Pangeran Jayakarta No.12 RT.08 / RW.09 Mangga Dua Selatan, Sawah Besar, Jakarta Pusat, 10730 DKI Jakarta</p>
                                </td>
                                <td width="8%">
                                    <i class="bi bi-building"></i>
                                </td>
                            </tr>
                        </table>
                        <table width="100%">
                            <tr>
                                <td>
                                    <p class="my-auto">Jl. Sentyaki Raya No.7, Bulu Lor, Kec. Semarang Utara Kota Semarang, Jawa Tengah 50179</p>
                                </td>
                                <td width="8%">
                                    <i class="bi bi-building"></i>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        <div class="py-5 text-capitalize">
            <div class="text-center">
                <h3 class="m-0">laporan keuangan</h3>
                <p>periode {{ date('M Y', strtotime($date_find)) }}</p>
            </div>
        </div>
        <div class="pb-5 px-2 px-md-4 text-capitalize">
            @php
                $total_addition = 0;
                $total_deduction = 0;
                $total_payroll = 0;
                $no_pendapatan = 'a';
                $no_beban = 'a';
                $no_payroll = 1;
            @endphp

            {{-- pendapatan --}}
            <h4 class="pt-3">pendapatan</h4>
            <div class="row">
                {{-- financial --}}
                @foreach ($financial->addition as $key => $value)
                @php
                    $total_addition += $value->value;
                @endphp
                    <div class="col-6">
                        <p class="m-0">{{ $no_pendapatan++ .'. '. $value->name }}</p>
                        @if ($value->description != null || $value->description != '')
                            <p class="m-0 ms-2">deskripsi :
                                <p class="text-secondary m-0 ms-2">{{ $value->description }}</p>
                            </p>
                        @endif
                    </div>
                    <div class="col-6 col-md-3 text-end">
                        <p>Rp. {{ number_format($value->value, 0, ',', '.') }}</p>
                    </div>
                @endforeach
                {{-- ./financial --}}

                {{-- total pendapatan --}}
                <div class="col-6">
                    <p class="m-0">total pendapatan</p>
                </div>
                <div class="col-6 col-md-6 text-end border-top border-dark">
                    <p class="m-0">Rp. {{ number_format($total_addition, 0, ',', '.') }}</p>
                </div>
                {{-- ./total pendapatan --}}
            </div>
            {{-- ./pendapatan --}}

            {{-- beban --}}
            <h4 class="pt-3">beban</h4>
            <div class="row">
                {{-- financial --}}
                @foreach ($financial->deduction as $key => $value)
                @php
                    $total_deduction += $value->value;
                @endphp
                    <div class="col-6">
                        <p class="m-0">{{ $no_beban++ .'. '. $value->name }}</p>
                        @if ($value->description != null || $value->description != '')
                            <p class="m-0 ms-2">deskripsi :
                                <p class="text-secondary m-0 ms-2">{{ $value->description }}</p>
                            </p>
                        @endif
                    </div>
                    <div class="col-6 col-md-3 text-end text-danger">
                        <p class="m-0">Rp. {{ number_format($value->value, 0, ',', '.') }}</p>
                    </div>
                @endforeach
                {{-- ./financial --}}
                {{-- payroll --}}
                <div class="col-6">
                    <p class="m-0">{{ $no_beban++ .'. penggajian karyawan' }}</p>
                        <p class="m-0 ms-2">deskripsi :
                            @foreach ($payroll as $key => $value)
                                @php
                                    $payroll_value = $value->payroll_details->sum('value');
                                    $total_payroll += $payroll_value;
                                    $total_deduction += $payroll_value;
                                @endphp
                                <p class="text-secondary m-0 ms-2">{{ $no_payroll++ .'. '. $value->employees->name
                                .' ( Rp. '. number_format($payroll_value, 0, ',', '.') .' )'  }}</p>
                            @endforeach
                        </p>
                    </div>
                    <div class="col-6 col-md-3 text-end text-danger">
                        <p class="m-0">Rp. {{ number_format($total_payroll, 0, ',', '.') }}</p>
                    </div>
                {{-- ./payroll --}}

                {{-- total beban --}}
                <div class="col-6">
                    <p class="m-0">total beban</p>
                </div>
                <div class="col-6 col-md-6 text-end text-danger border-top border-dark">
                    <p class="m-0">Rp. {{ number_format($total_deduction, 0, ',', '.') }}</p>
                </div>
                {{-- ./total beban --}}
            </div>
            {{-- ./beban --}}

            {{-- total laba --}}
            @php
                $laba = $total_addition - $total_deduction;
            @endphp

            <hr>
            <div class="row">
                <div class="col-6">
                    <h4 class="">laba/rugi</h4>
                </div>
                <div class="col-6 text-end">
                    <h5 class="text-end {{ ($laba >= 0) ? '' : 'text-danger' }}">Rp. {{ number_format($laba, 0, ',', '.') }}</h5>
                </div>
            </div>
            {{-- ./total laba --}}
        </div>
    </div>

    {{-- // JS --}}
    @include('layouts.js')
    <script>
        var css = '@page { size: landscape; }',
            head = document.head || document.getElementsByTagName('head')[0],
            style = document.createElement('style');

        style.type = 'text/css';
        style.media = 'print';

        if (style.styleSheet){
        style.styleSheet.cssText = css;
        } else {
        style.appendChild(document.createTextNode(css));
        }

        head.appendChild(style);
        window.print()
    </script>
    {{-- // ./JS --}}
</body>

</html>
