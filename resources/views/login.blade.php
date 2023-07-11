@extends('layouts.template-login_register')
@section('app')

<main>
    <div class="min-vh-100">
        <div class="position-absolute inset-0 object-fit-cover">
            <div class="bg-success position-absolute inset-0 object-fit-cover opacity-25"></div>
            <img src="{{ url('assets/img/bg/bg-1.jpg') }}" class="w-100 h-100">
        </div>

        <div class="container">
            <div class="row min-vh-100 align-items-center px-0 px-lg-5 py-5">
                <div class="col-12 col-lg-7">
                    <div class="card rounded-8-important overflow-hidden shadow shadow-lg">
                        <div class="card-header py-0 px-0 text-capitalize">
                            <div class="d-flex justify-content-between">
                                <div class="d-inline-flex bg-white py-2 px-4">
                                    <i class="bi bi-power fs-4 pe-2"></i>
                                    <p class="p-0 m-0 fs-5 my-auto">login</p>
                                </div>
                                {{-- <a href="{{ url('register') }}" class="d-inline-flex bg-transparent py-2 px-4">
                                    <i class="bi bi-person-plus fs-4 pe-2"></i>
                                    <p class="p-0 m-0 fs-5 my-auto">daftar</p>
                                </a> --}}
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('login') }}" method="POST" enctype="multipart/form-data" id="form">
                                @csrf
                                <div class="py-2">
                                    {{ view('forms.input-floating', ['data' => [
                                        'type'          => 'email',
                                        'name'          => 'email',
                                        'value'         => (old('email') != null) ? old('email') : ($recent_email != null ? $recent_email : ''),
                                        'placeholder'   => ucwords('masukkan email'),
                                        'class_add'     => '',
                                        'optional'      => 'required autofocus',
                                        'label'         => 'email',
                                        'option'        => []
                                    ]]) }}
                                </div>
                                <div class="py-2">
                                    {{ view('forms.input-floating', ['data' => [
                                        'type'          => 'password',
                                        'name'          => 'password',
                                        'value'         => (old('password') != null) ? old('password') : '',
                                        'placeholder'   => ucwords('masukkan password'),
                                        'class_add'     => '',
                                        'optional'      => 'required',
                                        'label'         => 'password',
                                        'option'        => []
                                    ]]) }}
                                </div>
                                <div class="py-2 d-flex justify-content-between">
                                    <div class="my-auto">
                                        {{ view('forms.input-checkbox', ['data' => [
                                            'type'          => 'checkbox',
                                            'name'          => 'remember_me',
                                            'value'         => 1,
                                            'placeholder'   => ucwords('remember me'),
                                            'class_add'     => '',
                                            'optional'      => 'checked',
                                            'label'         => 'remember me',
                                            'option'        => []
                                        ]]) }}
                                    </div>
                                    <button class="btn btn-info text-capitalize text-white px-4 mb-0" form="form">masuk</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-0 col-lg-5 d-none d-lg-block">
                    <div class="card bg-transparent shadow-none border-0 h-100 text-center">
                        <div class="text-capitalize">
                            <h2 class="fw-bolder text-white">masuk</h2>
                            <h5 class="text-light pt-3">"untuk mendapatkan akses kembali ke akun anda"</h5>
                        </div>
                        <p class="text-light fw-light fs-6">Jika ingin tidak kesusahan untuk login kembali, silahkan centang pada kolom Remember Me.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>

@endsection
