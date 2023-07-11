<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoginHistoryRequest;
use App\Http\Requests\UpdateLoginHistoryRequest;
use App\Models\LoginHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $login_history = LoginHistory::with('users');

        if ($request->input('search')) {
            $login_history->join('users', 'users.id', '=', 'login_histories.user_id')
                ->select('login_histories.*', 'users.*')
                ->where('users.email', 'like', '%' . $request->input('search') . '%')
                ->orWhere('users.name', 'like', '%' . $request->input('search') . '%');
        }

        $data = [
            'title'         => 'Tambah Login History',
            'app'           => env('APP_NAME'),
            'author'        => '',
            'description'   => '',
            'state'         => 'read',
            'position'      => 'login_history',
            'login_history' => $login_history->simplePaginate(8),
        ];

        return view('login_history.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title'         => 'Tambah Login History',
            'app'           => env('APP_NAME'),
            'author'        => '',
            'description'   => '',
            'state'         => 'create',
            'position'      => 'login_history',
            'users'         => User::latest()->get(),
        ];

        return view('login_history.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLoginHistoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $this->validation(false, $request);
        if ($validate->fails()) {
            return redirect('login_history/create')->withErrors($validate)->withInput();
        }

        $data = [
            'user_id'           => $request->input('user_id'),
            'description'       => $request->input('description'),
        ];

        $result = LoginHistory::create($data);
        if ($result == true) {
            return redirect('login_history')->with('notif-y', 'sukses');
        } else {
            return redirect('login_history/create')->with('notif-x', 'error')->withInput();
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LoginHistory  $loginHistory
     * @return \Illuminate\Http\Response
     */
    public function show(LoginHistory $login_history)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LoginHistory  $loginHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(LoginHistory $login_history)
    {
        $check_login_history = $login_history::where('id', $login_history->id)->count();
        $data = [
            'title'         => 'Edit Login History',
            'app'           => env('APP_NAME'),
            'author'        => '',
            'description'   => '',
            'state'         => 'update',
            'position'      => 'users',
            'login_history_count'   => $check_login_history,
            'login_history'         => $login_history::where('id', $login_history->id)->first(),
        ];

        return view('login_history.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLoginHistoryRequest  $request
     * @param  \App\Models\LoginHistory  $loginHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LoginHistory $login_history)
    {
        $validate = $this->validation('update', $request);
        if ($validate->fails()) {
            return redirect('login_history/' . $login_history->id . '/edit')->withErrors($validate)->withInput();
        }

        $data = [
            'user_id'           => $request->input('user_id'),
            'description'       => $request->input('description'),
        ];

        $result = LoginHistory::where('id', $login_history->id)->update($data);
        if ($result == true) {
            return redirect('login_history')->with('notif-y', 'sukses');
        } else {
            return redirect('login_history/' . $login_history->id . '/edit')->with('notif-x', 'error')->withInput();
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LoginHistory  $loginHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoginHistory $login_history)
    {
        $result = $login_history::destroy($login_history->id);

        if ($result == true) {
            return redirect('login_history')->with('notif-y', 'sukses');
        } else {
            return redirect('login_history')->with('notif-x', 'error');
        }
    }

    public function validation($type = false, $request)
    {
        switch ($type) {
            case 'login':
                break;

            case 'update':
                $validation = validator($request->all(), [
                    'user_id'                  => ['required', 'string', 'min:5', 'exists:users,id'],
                    'description'              => ['required', 'string', 'min:5'],
                ]);
                break;

            case 'update-img':
                break;

            default:
                $validation = validator($request->all(), [
                    'user_id'                  => ['required', 'string', 'min:5', 'exists:users,id'],
                    'description'              => ['required', 'string', 'min:5'],
                ]);
                break;
        }

        return $validation;
    }
}
