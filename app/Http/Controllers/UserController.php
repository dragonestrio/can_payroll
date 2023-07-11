<?php

namespace App\Http\Controllers;

use App\Models\User;
use Dotenv\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Http\Controllers\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Validated;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UpdateUsersRequest;
use App\Models\LoginHistory;
use Spatie\Permission\Models\Role;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule as ValidationRule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_current = User::with('roles', 'permissions', 'login_history')->where('id', Auth::id())->get()->toArray();
        $user = User::with('roles', 'permissions', 'login_history')->orderBy('name', 'asc');

        if ($request->input('search')) {
            $user
                ->where('name', 'like', '%' . $request->input('search') . '%')
                ->orwhere('email', 'like', '%' . $request->input('search') . '%')
                ->orwhere('phone', 'like', '%' . $request->input('search') . '%')
                ->orwhere('gender', 'like', '%' . $request->input('search') . '%')
                ->orwhere('address', 'like', '%' . $request->input('search') . '%')
                ->orwherehas('roles', function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->input('search') . '%');
                });
            // ->orwherehas('permissions', function ($query) use ($request) {
            //     $query->where('name', 'like', '%' . $request->input('search') . '%');
            // });
        }

        $user = $user->get()->toArray();
        for ($i = 0; $i < count($user); $i++) {
            if ($request->input('search')) {
                $user_current = $user;
            } else {
                if ($user[$i]['id'] != Auth::id()) {
                    array_push($user_current, $user[$i]);
                }
            }
        }
        $user = collect(json_decode(json_encode($user_current)));

        $data = [
            'title'         => 'user',
            'app'           => env('APP_NAME'),
            'author'        => '',
            'description'   => '',
            'state'         => 'read',
            'position'      => 'user',
            'users'         => (new Pagination)->convert($user, 8, ($request->input('page')) ?: 1),
        ];

        return view('users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title'         => 'Tambah user',
            'app'           => env('APP_NAME'),
            'author'        => '',
            'description'   => '',
            'state'         => 'create',
            'position'      => 'user',
            'roles'         => Role::get(),
        ];

        return view('users.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $this->validation(false, $request);
        if ($validate->fails()) {
            return redirect('user/create')->withErrors($validate)->withInput();
        }

        // $user = (isset($user)) ? $user->first() : '';
        // $profile_pic = $request->file('profile_pic');
        // if (filesize($profile_pic) == false) {
        //     $profile_pic = '';
        // } else {
        //     // $count_file = count($profile_pic['name']);
        //     // if ($count_file > 1) {
        //     //     return redirect('user/create')->with('notif-x', 'you just can upload 1 files')->withInput();
        //     // }
        //     $profile_pic_name = time() . '_' . $profile_pic->hashName();
        //     $profile_pic->move(public_path('media/upload/profile/'), $profile_pic_name);
        //     $profile_pic = $profile_pic_name;
        //     if ($user->profile_pic != null) {
        //         $old_profile = public_path('media/upload/profile/' . $user->profile_pic);
        //         if (file_exists($old_profile)) {
        //             $unlink_old_pic = unlink($old_profile);
        //         }
        //     }

        $data = [
            'id'            => $this->id_generate(),
            'email'         => $request->input('email'),
            'password'      => bcrypt($request->input('password')),
            'name'          => $request->input('name'),
            'phone'         => $request->input('phone'),
            'gender'        => $request->input('gender'),
            'address'       => $request->input('address'),
            'date_born'     => $request->input('date_born'),
            // 'profile_pic'   => $profile_pic,
        ];

        $result = User::create($data);
        $result->assignRole($request->input('role'));
        if ($result == true) {
            return redirect('user')->with('notif-y', 'sukses');
        } else {
            return redirect('user/create')->with('notif-x', 'error')->withInput();
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        switch (Auth::user()->getRoleNames()->first()) {
            case 'superadmin':
            case 'admin':
                # code...
                break;

            default:
                $user->id = Auth::id();
                break;
        }

        $user = $user::with('roles', 'permissions', 'login_history')->where('id', $user->id);
        if ($user->count() == 0) {
            return redirect('user')->with('notif-x', 'maaf pengguna tidak ditemukan');
        }

        $data = [
            'title'         => 'Lihat user',
            'app'           => env('APP_NAME'),
            'author'        => '',
            'description'   => '',
            'state'         => 'read',
            'position'      => 'user',
            'users'         => $user->first(),
            'roles'         => Role::get(),
            'login_history' => $user->first()->login_history()->latest()->get(),
        ];

        return view('users.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        switch (Auth::user()->getRoleNames()->first()) {
            case 'superadmin':
            case 'admin':
                # code...
                break;

            default:
                $user->id = Auth::id();
                break;
        }

        $user = $user::with('roles', 'permissions', 'login_history')->where('id', $user->id);
        if ($user->count() == 0) {
            return redirect('user')->with('notif-x', 'maaf pengguna tidak ditemukan');
        }

        $data = [
            'title'         => 'Perbarui user',
            'app'           => env('APP_NAME'),
            'author'        => '',
            'description'   => '',
            'state'         => 'update',
            'position'      => 'user',
            'users'         => $user->first(),
            'roles'         => Role::get(),
        ];

        return view('users.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        (filesize($request->file('profile_pic')) == false) ? $validate = $this->validation('update', $request) : $validate = $this->validation('update-img', $request);
        if ($validate->fails()) {
            return redirect('user/' . $user->id . '/edit')->withErrors($validate)->withInput();
        }

        switch (Auth::user()->getRoleNames()->first()) {
            case 'superadmin':
            case 'admin':
                # code...
                break;

            default:
                $user->id = Auth::id();
                break;
        }

        $user = $user::with('roles', 'permissions', 'login_history')->where('id', $user->id);
        if ($user->count() == 0) {
            return redirect('user')->with('notif-x', 'maaf pengguna tidak ditemukan');
        }

        $user = (isset($user)) ? $user->first() : '';
        $profile_pic = $request->file('profile_pic');
        if (filesize($profile_pic) == false) {
            $profile_pic = $user->profile_pic;
        } else {
            // $count_file = count($profile_pic['name']);
            // if ($count_file > 1) {
            //     return redirect('user/' . $user->id . '/edit')->with('notif-x', 'you just can upload 1 files')->withInput();
            // }
            $profile_pic_name = time() . '_' . $profile_pic->hashName();
            $profile_pic->move(public_path('media/upload/profile/'), $profile_pic_name);
            $profile_pic = $profile_pic_name;
            if ($user->profile_pic != null) {
                $old_profile = public_path('media/upload/profile/' . $user->profile_pic);
                if (file_exists($old_profile)) {
                    $unlink_old_pic = unlink($old_profile);
                }
            }
        }

        $data = [
            // 'email'         => $request->input('email'),
            // 'password'      => $user->password,
            'name'          => $request->input('name'),
            'phone'         => $request->input('phone'),
            // 'gender'        => $request->input('gender'),
            // 'address'       => $request->input('address'),
            // 'date_born'     => $request->input('date_born'),
            'profile_pic'   => $profile_pic,
        ];

        $result = User::find($user->id)->update($data);
        if ($request->input('role') != null && $user->roles->first()->name != $request->input('role')) {
            $user->syncRoles($request->input('role'));
        }
        if ($result == true) {
            return redirect('user/' . $user->id)->with('notif-y', 'sukses');
        } else {
            return redirect('user/' . $user->id . '/edit')->with('notif-x', 'error')->withInput();
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $result = $user::destroy($user->id);

        if ($result == true) {
            return redirect('user')->with('notif-y', 'sukses');
        } else {
            return redirect('user')->with('notif-x', 'error');
        }
    }

    public function profile_index()
    {
        $user = User::with('roles', 'permissions', 'login_history')->where('id', Auth::user()->id);
        $data = [
            'title'         => 'Lihat user',
            'app'           => env('APP_NAME'),
            'author'        => '',
            'description'   => '',
            'state'         => 'read',
            'position'      => 'profile',
            'users'         => $user->first(),
            'roles'         => Role::get(),
            'login_history' => $user->first()->login_history()->latest()->get(),
        ];

        return view('users.show', $data);
    }

    public function change_passwd_index(User $user)
    {
        switch (Auth::user()->getRoleNames()->first()) {
            case 'superadmin':
            case 'admin':
                # code...
                break;

            default:
                $user->id = Auth::id();
                break;
        }

        $check_users = $user::where('id', $user->id)->count();
        $data = [
            'title'         => 'Perbarui Password',
            'app'           => env('APP_NAME'),
            'author'        => '',
            'description'   => '',
            'state'         => 'update',
            'position'      => 'profile',
            'users_count'   => $check_users,
            'users'         => $user::where('id', $user->id)->first(),
        ];

        return view('users.change_passwd', $data);
    }

    public function change_passwd(Request $request, User $user)
    {
        $validate = $this->validation('password', $request);
        if ($validate->fails()) {
            return redirect('user/' . $user->id . '/change_password')->withErrors($validate)->withInput();
        }

        switch (Auth::user()->getRoleNames()->first()) {
            case 'superadmin':
            case 'admin':
                # code...
                break;

            default:
                $user->id = Auth::id();
                break;
        }

        $data = [
            'password'      => bcrypt($request->input('password')),
        ];

        $result = User::where('id', $user->id)->update($data);
        if ($result == true) {
            return redirect('user/' . $user->id)->with('notif-y', 'sukses');
        } else {
            return redirect('user/' . $user->id)->with('notif-x', 'error')->withInput();
        };
    }

    public function logout(Request $request)
    {
        LoginHistory::create(['user_id' => Auth::user()->id, 'description' => 'logout']);
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }

    public function login(Request $request)
    {
        $validate = $this->validation('login', $request);
        if ($validate->fails()) {
            return redirect(url('login'))->withErrors($validate)->withInput();
        }

        $data = [
            'email'         => $request->input('email'),
            'password'      => $request->input('password'),
        ];
        $data_cookie_a = [
            'name'      => 'satrio_n_w_remember-me',
            'value'     => $request->input('email')
        ];

        $remember_me = ($request->input('remember_me') != null) ? true : false;
        if (Auth::attempt($data, $remember_me) == true) {
            $cookie = new Cookie;
            $request->session()->regenerate();
            $cookie->create($data_cookie_a, 'year');
            $result = LoginHistory::create(['user_id' => Auth::user()->id, 'description' => 'login']);

            if ($result == true) {
                return redirect()->intended('dashboard');
            }
        }

        return redirect('login')->with('notif-x', 'email/password salah')->onlyInput('email');
    }

    public function register(Request $request)
    {
        $validate = $this->validation(null, $request);
        if ($validate->fails()) {
            return redirect(url('register'))->withErrors($validate)->withInput();
        }

        $user = (isset($user)) ? $user->first() : '';
        $profile_pic = $request->file('profile_pic');
        if (filesize($profile_pic) == false) {
            $profile_pic = '';
        } else {
            // $count_file = count($profile_pic['name']);
            // if ($count_file > 1) {
            //     return redirect('register')->with('notif-x', 'you just can upload 1 files')->withInput();
            // }
            $profile_pic_name = time() . '_' . $profile_pic->hashName();
            $profile_pic->move(public_path('media/upload/profile/'), $profile_pic_name);
            $profile_pic = $profile_pic_name;
            if ($user->profile_pic != null) {
                $old_profile = public_path('media/upload/profile/' . $user->profile_pic);
                if (file_exists($old_profile)) {
                    $unlink_old_pic = unlink($old_profile);
                }
            }
        }

        $data = [
            'id'            => $this->id_generate(),
            'email'         => $request->input('email'),
            'password'      => bcrypt($request->input('password')),
            'name'          => $request->input('name'),
            'phone'         => $request->input('phone'),
            'gender'        => $request->input('gender'),
            'address'       => $request->input('address'),
            'date_born'     => $request->input('date_born'),
            'profile_pic'   => $profile_pic,
        ];

        $result = User::create($data);
        $result->assignRole('user');
        if ($result == true) {
            return redirect('login')->with('notif-y', 'sukses, silahkan login');
        } else {
            return redirect('register')->with('notif-x', 'error')->withInput();
        };
    }

    public function id_generate()
    {
        $main = md5(Str::random(255));
        $check = User::where('id', $main)->count();

        if ($check == 0) {
            return $main;
        } else {
            return $this->id_generate();
        }
    }

    public function validation($type = null, $request)
    {
        if (Auth::check() == true) {
            $role = Auth::user()->getRoleNames()->first();
        }

        switch ($type) {
            case 'login':
                $validation = validator($request->all(), [
                    'email'                     => ['required', 'email:rfc,dns', 'max:100'],
                    'password'                  => ['required', Password::min(8)->mixedCase(), 'max:100'],
                ]);
                break;

            case 'password':
                $validation = validator($request->all(), [
                    'password'                  => ['required', 'confirmed', Password::min(8)->mixedCase(), 'max:100'],
                    'password_confirmation'     => ['required', 'same:password', 'max:100'],
                ]);
                break;

            case 'update':
                $validation = validator($request->all(), [
                    // 'email'                     => ['required', 'email:rfc,dns', 'max:255'],
                    'name'                      => ['required', 'string', 'min:5', 'max:255'],
                    'phone'                     => ['required', 'numeric', 'digits_between:10,14'],
                    // 'gender'                    => ['required', 'string',  'max:20'],
                    // 'address'                   => ['nullable','string', 'max:255'],
                    // 'date_born'                 => ['required', 'date'],
                    'role'                   => (!isset($role)) ? ['prohibited'] : (($role == 'admin' || $role == 'superadmin') ? ['exists:roles,name'] : ''),
                ]);
                break;

            case 'update-img':
                $validation = validator($request->all(), [
                    // 'email'                     => ['required', 'email:rfc,dns', 'max:255'],
                    'name'                      => ['required', 'string', 'min:5', 'max:255'],
                    'phone'                     => ['required', 'numeric', 'digits_between:10,14'],
                    // 'gender'                    => ['required', 'string', 'max:20'],
                    // 'address'                   => ['nullable','string', 'max:255'],
                    // 'date_born'                 => ['required', 'date'],
                    'profile_pic'               => ['required', 'file', 'mimes:jpg,jpeg,png'],
                    'role'                   => (!isset($role)) ? ['prohibited'] : (($role == 'admin' || $role == 'superadmin') ? ['exists:roles,name'] : ''),
                ]);
                break;

            default:
                $validation = validator($request->all(), [
                    'email'                     => ['required', 'email:rfc,dns', 'unique:users,email', 'max:255'],
                    'name'                      => ['required', 'string', 'min:5', 'max:255'],
                    'phone'                     => ['required', 'numeric', 'digits_between:10,14'],
                    'gender'                    => ['required', 'string', 'max:20'],
                    'address'                   => ['nullable', 'string', 'max:255'],
                    'date_born'                 => ['required', 'date'],
                    // 'profile_pic'               => ['required', 'file', 'mimes:jpg,jpeg,png'],
                    'role'                      => (!isset($role)) ? ['prohibited'] : (($role == 'admin' || $role == 'superadmin') ? ['exists:roles,name'] : ''),
                    'password'                  => ['required', 'confirmed', Password::min(8)->mixedCase(), 'max:100'],
                    'password_confirmation'     => ['required', 'same:password', 'max:100'],
                ]);
                break;
        }

        return $validation;
    }
}
