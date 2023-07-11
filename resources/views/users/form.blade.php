@extends('layouts.template')
@section('app')

<div class="d-block position-relative height-0 pb-50 pb-lg-15">
    <div class="page-breadcrumb bg-info pb-2">
        @switch($state)
            @case('create')
                {{ view('partials.breadcumb.normal', [
                    'pages' => [
                        'users'             =>  url('user'),
                        'buat users baru'   =>  ''
                    ],
                    'pages_current' => 'buat users baru']) }}
                @break

            @case('update')
                {{ view('partials.breadcumb.normal', [
                    'pages' => [
                        'users'         =>  url('user'),
                        'edit users'  =>  ''
                    ],
                    'pages_current' => 'edit users']) }}
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
                <form action="{{ (isset($users)) ? url('user/'.$users->id) : url('user') }}" method="post" enctype="multipart/form-data" id="form">
                    @csrf
                    @if (isset($users))
                        @method('put')
                    @endif

                    @if ($state != 'update')
                    <div class="py-2">
                        {{ view('forms.input-floating', ['data' => [
                            'type'          => 'email',
                            'name'          => 'email',
                            'value'         => (old('email') != null) ? old('email') : (isset($users) ? $users->email : ''),
                            'placeholder'   => ucwords('masukkan alamat email'),
                            'class_add'     => '',
                            'optional'      => 'required autofocus',
                            'label'         => 'email',
                            'option'        => []
                        ]]) }}
                    </div>
                    @endif

                    <div class="py-2">
                        {{ view('forms.input-floating', ['data' => [
                            'type'          => 'text',
                            'name'          => 'name',
                            'value'         => (old('name') != null) ? old('name') : (isset($users) ? $users->name : ''),
                            'placeholder'   => ucwords('masukkan nama lengkap anda'),
                            'class_add'     => '',
                            'optional'      => 'required',
                            'label'         => 'nama',
                            'option'        => []
                        ]]) }}
                    </div>

                    <div class="py-2">
                        {{ view('forms.input-group', ['data' => [
                            'type'          => 'number',
                            'name'          => 'phone',
                            'value'         => (old('phone') != null) ? old('phone') : (isset($users) ? $users->phone : ''),
                            'placeholder'   => ucwords('masukkan nomor telepon anda'),
                            'class_add'     => '',
                            'optional'      => 'required',
                            'label'         => '+62',
                            'option'        => []
                        ]]) }}
                    </div>

                    @if ($state != 'update')
                    <div class="py-2">
                        {{ view('forms.input-select-floating', ['data' => [
                            'type'          => 'select',
                            'name'          => 'gender',
                            'value'         => (old('gender') != null) ? old('gender') : (isset($users) ? $users->gender : ''),
                            'placeholder'   => ucwords('masukkan jenis kelamin anda'),
                            'class_add'     => '',
                            'optional'      => 'required',
                            'label'         => 'jenis kelamin',
                            'option'        => ['male'=>'Laki-Laki', 'female'=>'Perempuan', 'hidden'=>'Tidak ingin diketahui']
                        ]]) }}
                    </div>

                    <div class="py-2">
                        {{ view('forms.input-floating', ['data' => [
                            'type'          => 'date',
                            'name'          => 'date_born',
                            'value'         => (old('date_born') != null) ? old('date_born') : (isset($users) ? $users->date_born : ''),
                            'placeholder'   => ucwords('masukkan tanggal lahir anda'),
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
                            'value'         => (old('address') != null) ? old('address') : (isset($users) ? $users->address : ''),
                            'placeholder'   => ucwords('masukkan alamat anda'),
                            'class_add'     => '',
                            'optional'      => 'required',
                            'label'         => 'alamat',
                            'option'        => []
                        ]]) }}
                    @endif

                    @if ($state == 'update')
                    <div class="py-2">
                        {{ view('forms.input-file', ['data' => [
                            'type'          => 'file',
                            'name'          => 'profile_pic',
                            'value'         => (old('profile_pic') != null) ? old('profile_pic') : (isset($users) ? $users->profile_pic : ''),
                            'placeholder'   => ucwords('masukkan gambar profil anda'),
                            'class_add'     => '',
                            'optional'      => 'accept=".jpg, .jpeg, .png" '.(isset($users)) ? '' : 'required',
                            'label'         => 'foto profile',
                            'option'        => []
                        ]]) }}
                    </div>
                    @endif

                    @if(Auth::user()->getRoleNames()->first() == 'admin' || Auth::user()->getRoleNames()->first() == 'superadmin')
                    <div class="py-2">
                        @php
                            $role = [];
                        @endphp
                        @for ($i=0; $i < count($roles) ; $i++)
                            @php
                                $role[$roles[$i]->name] = ucwords($roles[$i]->name);
                            @endphp
                        @endfor
                        {{ view('forms.input-select-floating', ['data' => [
                            'type'          => 'select',
                            'name'          => 'role',
                            'value'         => (old('role') != null) ? old('role') : (isset($users) ? $users->roles->first()->name : ''),
                            'placeholder'   => ucwords('masukkan jabatan anda'),
                            'class_add'     => '',
                            'optional'      => 'required',
                            'label'         => 'jabatan',
                            'option'        => $role
                        ]]) }}
                    </div>
                    @endif

                    @if ($state != 'update')
                    <div class="py-2">
                        {{ view('forms.input-floating', ['data' => [
                            'type'          => 'password',
                            'name'          => 'password',
                            'value'         => (old('password') != null) ? old('password') : '',
                            'placeholder'   => ucwords('masukkan password anda'),
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
                            'placeholder'   => ucwords('masukkan konfirmasi password anda'),
                            'class_add'     => '',
                            'optional'      => 'required',
                            'label'         => 'konfirmasi password',
                            'option'        => []
                        ]]) }}
                    </div>

                    @endif
                </form>
                <div class="d-flex justify-content-between pt-4">
                    <a onclick="history.back()" class="btn btn-outline-light bg-gradient-faded-light border-0 py-2 px-4 rounded-5-important text-secondary text-uppercase">
                        <p class="p-0 m-0 text-capitalize">kembali</p>
                    </a>
                    <button form="form" class="btn btn-info py-2 px-4 rounded-5-important text-white text-uppercase">
                        <p class="p-0 m-0 text-capitalize">{{ (isset($users)) ? 'perbarui' : 'buat' }}</p>
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>

@include('partials.footer.custom')
@endsection
