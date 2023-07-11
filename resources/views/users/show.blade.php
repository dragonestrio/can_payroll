@extends('layouts.template')
@section('app')

<div class="d-block position-relative height-0 pb-50 pb-lg-15">
    <div class="page-breadcrumb bg-info pb-2">
        {{ view('partials.breadcumb.normal', [
            'pages' => [
                'users'         =>  url('user'),
                $users->name    =>  url('user/'.$users->id)
            ],
            'pages_current' => $users->name]) }}

        {{-- <form action="" method="get" class="pt-5 px-2 px-lg-5">
            <div class="d-flex justify-content-between">
                <input type="search" name="search" class="form-control rounded-5-important me-4" placeholder="Cari disini..." value="{{ request()->input('search') }}">
                <button class="btn btn-success text-capitalize text-break text-center text-white mb-0 rounded-5-important">
                <svg xmlns="http://www.w3.org/2000/svg" height="16" fill="currentColor" class="bi bi-search text-white" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
                </button>
            </div>
        </form> --}}
    </div>
    @include('partials.header.custom')
</div>

<main>
    <div class="container-fluid text-dark">
        <div class="px-0 px-lg-4 pb-4">
            <div class="card rounded-8-important width-100 width-lg-75 py-4 py-lg-4 px-3 px-lg-4 mx-auto">
                <div class="d-flex justify-content-center justify-content-lg-end">
                    @if ($position == 'profile' || Auth::user()->getRoleNames()->first() == 'admin' || Auth::user()->getRoleNames()->first() == 'superadmin')
                        <div class="px-2">
                            <a href="{{ url('user/'.$users->id.'/edit') }}" class="btn btn-outline-light bg-gradient-faded-light border-0 text-muted py-2 px-4 rounded-5-important border-0">
                                <i class="bi bi-gear-wide-connected"></i>
                            </a>
                        </div>
                        <div class="px-2">
                            <a href="{{ url('user/'.$users->id.'/change_password') }}" class="btn btn-outline-light bg-gradient-faded-light border-0 text-muted py-2 px-4 rounded-5-important">
                                <i class="bi bi-shield-lock-fill"></i>
                            </a>
                        </div>
                    @else
                        <a href="{{ url('user/'.$users->id.'/change_password') }}" class="btn btn-outline-light bg-gradient-faded-light border-0 text-muted py-2 px-4 rounded-5-important">
                            <i class="bi bi-shield-lock-fill"></i>
                        </a>
                    @endif
                </div>

                <div class="row pb-2">
                    <div class="col-3 col-lg-3">
                        <div class="w-100 rounded-5-important overflow-hidden">
                            <div class="d-block position-relative overflow-hidden m-0 h-0 pb-100">
                                @if ($users->profile_pic != null || $users->profile_pic != '')
                                    <div class="h-0 pt-100">
                                        <img src="{{ url('media/upload/profile/'.$users->profile_pic) }}"
                                        class="position-absolute object-fit-cover inset-0 w-100 h-100"
                                        decoding="async">
                                    </div>
                                @else
                                    <div class="bg-dark position-absolute inset-0 w-100 h-100">
                                        <div class="py-2 py-lg-5 text-white">
                                            <i class="bi bi-eye-slash fs-1 d-flex justify-content-center"></i>
                                            <p class="p-0 m-0 text-uppercase fs-3 d-lg-flex justify-content-center d-none">no pic</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-9 col-lg-9">
                        <div class="row">
                            <div class="col-12 col-lg-8">
                                <p class="m-0 p-0 fs-5 text-capitalize text-break fw-bold">{{ $users->name }}</p>
                                <div class="d-flex text-break">
                                    <div class="d-inline-flex text-muted">
                                        <i class="bi bi-person-circle"></i>
                                        <p class="m-0 p-0 text-xs text-capitalize text-break fw-normal ps-1 my-auto">{{ $users->getRoleNames()->first() }}</p>
                                    </div>
                                    <div class="d-inline-flex text-muted px-2">
                                        <i class="bi bi-envelope"></i>
                                        <p class="m-0 p-0 text-xs text-lowecase fw-normal ps-1 my-auto">{{ $users->email }}</p>
                                    </div>
                                </div>
                                <div class="d-flex text-muted">
                                    <i class="bi bi-door-closed"></i>
                                    <p class="m-0 p-0 text-xs text-lowecase fw-normal ps-1 my-auto">terakhir login : {{
                                    (count($login_history) == 0) ? '-' : date('d M Y, h:i:s', strtotime($login_history->first()->created_at)) }}</p>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="text-center d-none d-lg-block">
                                    <p class="m-0 p-0 text-capitalize text-break text-xs">status kelengkapan akun</p>
                                    @php
                                        $count_data_user = 0;
                                        $count_data_user_min = 0;
                                    @endphp
                                    @foreach (Auth::user()->getOriginal() as $key => $value)
                                        @switch($key)
                                            @case('id')
                                            @case('email_verified_at')
                                            @case('remember_token')
                                            @case('deleted_at')
                                            @case('created_at')
                                            @case('updated_at')
                                                @break

                                            @default
                                            @php
                                                $count_data_user++;
                                            @endphp
                                            @if ($value != null || $value != '')
                                                @php
                                                    $count_data_user_min++;
                                                @endphp
                                            @endif

                                            @endswitch
                                    @endforeach
                                    @php
                                        $count_data_user_different = $count_data_user - $count_data_user_min;
                                    @endphp
                                    <div id="highchart" class="w-100"></div>
                                    <p class="m-0 p-0 text-capitalize text-break"><span class="@switch($count_data_user)
                                        @case($count_data_user_different == 0)
                                            text-success
                                            @break
                                        @case($count_data_user_different >= 1 && $count_data_user_different <= 3)
                                            text-warning
                                            @break
                                        @case($count_data_user_different > 3 || $count_data_user_different < 0)
                                            text-danger
                                            @break

                                        @default

                                    @endswitch">{{ $count_data_user_min }}</span>  / {{ $count_data_user }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="pt-5">
                <div class="card rounded-8-important py-4 py-lg-5 px-3 px-lg-4">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-capitalize text-break py-2 px-4 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                            type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">detail</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-capitalize text-break py-2 px-4" id="login-tab" data-bs-toggle="tab" data-bs-target="#login-tab-pane"
                            type="button" role="tab" aria-controls="login-tab-pane" aria-selected="false">aktifitas login</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                            <div class="row py-4 border-1 border-bottom">
                                <div class="col-6 col-lg-6 d-flex justify-content-start text-capitalize text-break">
                                    <p class="p-0 m-0 text-xs fw-bold">nama</p>
                                </div>
                                <div class="col-6 col-lg-6 d-flex justify-content-end text-capitalize text-break">
                                    <p class="p-0 m-0">{{ $users->name }}</p>
                                </div>
                            </div>
                            <div class="row py-4 border-1 border-top border-bottom">
                                <div class="col-6 col-lg-6 d-flex justify-content-start text-capitalize text-break">
                                    <p class="p-0 m-0 text-xs fw-bold">email</p>
                                </div>
                                <div class="col-6 col-lg-6 d-flex justify-content-end text-lowercase">
                                    <p class="p-0 m-0">{{ $users->email }}</p>
                                </div>
                            </div>
                            <div class="row py-4 border-1 border-top border-bottom">
                                <div class="col-6 col-lg-6 d-flex justify-content-start text-capitalize text-break">
                                    <p class="p-0 m-0 text-xs fw-bold">nomor telepon</p>
                                </div>
                                <div class="col-6 col-lg-6 d-flex justify-content-end text-capitalize text-break">
                                    <p class="p-0 m-0">+62 {{ $users->phone }}</p>
                                </div>
                            </div>
                            <div class="row py-4 border-1 border-top border-bottom">
                                <div class="col-6 col-lg-6 d-flex justify-content-start text-capitalize text-break">
                                    <p class="p-0 m-0 text-xs fw-bold">jenis kelamin</p>
                                </div>
                                @switch($users->gender)
                                    @case('male')
                                        @php
                                            $users->gender = 'pria';
                                        @endphp
                                        @break
                                    @case('female')
                                        @php
                                            $users->gender = 'wanita';
                                        @endphp
                                        @break

                                    @default
                                        @php
                                            $users->gender = 'tidak ingin diketahui'
                                        @endphp

                                @endswitch
                                <div class="col-6 col-lg-6 d-flex justify-content-end text-capitalize text-break">{{ $users->gender }}</div>
                            </div>
                            <div class="row py-4 border-1 border-top border-bottom">
                                <div class="col-6 col-lg-6 d-flex justify-content-start text-capitalize text-break">
                                    <p class="p-0 m-0 text-xs fw-bold">tanggal lahir</p>
                                </div>
                                <div class="col-6 col-lg-6 d-flex justify-content-end text-capitalize text-break">{{ date('d M Y', strtotime($users->date_born)) }}</div>
                            </div>
                            <div class="row py-4 border-1 border-top border-bottom">
                                <div class="col-6 col-lg-6 d-flex justify-content-start text-capitalize text-break">
                                    <p class="p-0 m-0 text-xs fw-bold">alamat</p>
                                </div>
                                <div class="col-6 col-lg-6 d-flex justify-content-end text-capitalize text-break">{{ $users->address }}</div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="login-tab-pane" role="tabpanel" aria-labelledby="login-tab" tabindex="0">
                            <div class="container img-view table-responsive py-4">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-capitalize text-break text-center text-xs">no</th>
                                            <th class="text-capitalize text-break text-center text-xs">nama akifitas</th>
                                            <th class="text-capitalize text-break text-center text-xs">waktu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($login_history as $key => $value)
                                        <tr>
                                            <td class="text-capitalize text-break text-start">{{ $no++ }}</td>
                                            <td class="text-capitalize text-break text-center">{{ $value->description }}</td>
                                            <td class="text-capitalize text-break text-center">{{ date('d M Y, h:i:s',strtotime($value->created_at)) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
