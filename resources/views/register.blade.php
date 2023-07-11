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
                                <a href="{{ url('login') }}" class="d-inline-flex bg-transparent py-2 px-4">
                                    <i class="bi bi-power fs-4 pe-2"></i>
                                    <p class="p-0 m-0 fs-5 my-auto">login</p>
                                </a>
                                <div class="d-inline-flex bg-white py-2 px-4">
                                    <i class="bi bi-person-plus fs-4 pe-2"></i>
                                    <p class="p-0 m-0 fs-5 my-auto">daftar</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('register') }}" method="POST" enctype="multipart/form-data" id="form">
                                @csrf
                                <div class="py-2">
                                    {{ view('forms.input-floating', ['data' => [
                                        'type'          => 'email',
                                        'name'          => 'email',
                                        'value'         => (old('email') != null) ? old('email') : '',
                                        'placeholder'   => ucwords('masukkan email'),
                                        'class_add'     => '',
                                        'optional'      => 'required autofocus',
                                        'label'         => 'email',
                                        'option'        => []
                                    ]]) }}
                                </div>
                                <div class="py-2">
                                    {{ view('forms.input-floating', ['data' => [
                                        'type'          => 'text',
                                        'name'          => 'name',
                                        'value'         => (old('name') != null) ? old('name') : '',
                                        'placeholder'   => ucwords('masukkan nama lengkap'),
                                        'class_add'     => '',
                                        'optional'      => 'required',
                                        'label'         => 'nama lengkap',
                                        'option'        => []
                                    ]]) }}
                                </div>
                                <div class="py-2">
                                    {{ view('forms.input-group', ['data' => [
                                        'type'          => 'number',
                                        'name'          => 'phone',
                                        'value'         => (old('phone') != null) ? old('phone') : '',
                                        'placeholder'   => ucwords('masukkan nomor telp'),
                                        'class_add'     => '',
                                        'optional'      => 'required',
                                        'label'         => '+62',
                                        'option'        => []
                                    ]]) }}
                                </div>
                                <div class="py-2">
                                    {{ view('forms.input-select-floating', ['data' => [
                                        'type'          => 'select',
                                        'name'          => 'gender',
                                        'value'         => (old('gender') != null) ? old('gender') : '',
                                        'placeholder'   => ucwords('masukkan jenis kelamin'),
                                        'class_add'     => '',
                                        'optional'      => 'required',
                                        'label'         => 'jenis kelamin',
                                        'option'        => ['male' => 'pria', 'female' => 'wanita', 'hidden' => 'tidak ingin diketahui']
                                    ]]) }}
                                </div>
                                <div class="py-2">
                                    {{ view('forms.input-floating', ['data' => [
                                        'type'          => 'date',
                                        'name'          => 'date_born',
                                        'value'         => (old('date_born') != null) ? old('date_born') : '',
                                        'placeholder'   => ucwords('masukkan tanggal lahir'),
                                        'class_add'     => '',
                                        'optional'      => 'required',
                                        'label'         => 'tanggal lahir',
                                        'option'        => []
                                    ]]) }}
                                </div>
                                <div class="py-2">
                                    {{ view('forms.input-textarea', ['data' => [
                                        'type'          => 'textarea',
                                        'name'          => 'address',
                                        'value'         => (old('address') != null) ? old('address') : '',
                                        'placeholder'   => ucwords('masukkan alamat'),
                                        'class_add'     => '',
                                        'optional'      => 'required',
                                        'label'         => 'alamat',
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
                                <div class="py-2">
                                    {{ view('forms.input-floating', ['data' => [
                                        'type'          => 'password',
                                        'name'          => 'password_confirmation',
                                        'value'         => (old('password_confirmation') != null) ? old('password_confirmation') : '',
                                        'placeholder'   => ucwords('masukkan konfirmasi password'),
                                        'class_add'     => '',
                                        'optional'      => 'required',
                                        'label'         => 'konfirmasi password',
                                        'option'        => []
                                    ]]) }}
                                </div>
                                <div class="py-2 d-flex justify-content-between">
                                    <a href="{{ url('login') }}" class="btn btn-outline-white text-capitalize border-0 px-4">kembali</a>
                                    <button class="btn btn-info text-capitalize text-white px-4 mb-0" form="form">selanjutnya</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-0 col-lg-5 d-none d-lg-block">
                    <div class="card bg-transparent shadow-none border-0 h-100 text-center">
                        <div class="text-capitalize">
                            <h2 class="fw-bolder text-white">daftar</h2>
                            <h5 class="text-light pt-3">"untuk mendapatkan akses ke sistem ini"</h5>
                        </div>
                        <p class="text-light fw-light fs-6">Jika ingin tidak kesusahan pada saat mendaftar, silahkan isi semua kolom yang terdapat pada form ini</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>

@endsection
