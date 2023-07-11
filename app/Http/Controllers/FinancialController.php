<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFinancialRequest;
use App\Http\Requests\UpdateFinancialRequest;
use App\Models\Financial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinancialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $financials = Financial::latest();

        if ($request->input('search')) {
            switch ($request->input('search')) {
                case $request->input('search') == 'pemasukan' || $request->input('search') == ucwords('pemasukan'):
                    $search = 'additional';
                    break;
                case $request->input('search') == 'pengeluaran' || $request->input('search') == ucwords('pengeluaran'):
                    $search = 'deductions';
                    break;

                default:
                    $search = $request->input('search');
                    break;
            }
            $financials
                ->where('name', 'like', '%' . $search . '%')
                ->orwhere('category', 'like', '%' . $search . '%')
                ->orwhere('value', 'like', '%' . $search . '%');
        }

        $data = [
            'title'         => 'Keuangan',
            'app'           => env('APP_NAME'),
            'author'        => '',
            'description'   => '',
            'state'         => 'read',
            'position'      => 'financial',
            'financials'      => $financials->simplePaginate(8),
        ];

        return view('financials.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title'         => 'Tambah Keuangan',
            'app'           => env('APP_NAME'),
            'author'        => '',
            'description'   => '',
            'state'         => 'create',
            'position'      => 'financial',
        ];

        return view('financials.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFinancialRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $this->validation(false, $request);
        if ($validate->fails()) {
            return redirect('financial/create')->withErrors($validate)->withInput();
        }

        $data = [
            'user_id'      => Auth::user()->id,
            'name'         => $request->input('name'),
            'category'     => $request->input('category'),
            'value'        => $request->input('value'),
            'description'  => $request->input('description'),
            'created_at'   => $request->input('created_at'),
        ];

        $result = Financial::create($data);
        if ($result == true) {
            return redirect('financial')->with('notif-y', 'sukses');
        } else {
            return redirect('financial/create')->with('notif-x', 'error')->withInput();
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Financial  $financial
     * @return \Illuminate\Http\Response
     */
    public function show(Financial $financial)
    {
        // EMPTY
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Financial  $financial
     * @return \Illuminate\Http\Response
     */
    public function edit(Financial $financial)
    {
        if ($financial::where('id', $financial->id)->count() == 0) {
            return redirect('financial')->with('notif-x', 'maaf anda tidak diperkenankan mengakses');
        }

        $data = [
            'title'             => 'Perbarui Keuangan',
            'app'               => env('APP_NAME'),
            'author'            => '',
            'description'       => '',
            'state'             => 'update',
            'position'          => 'financial',
            'financials'        => $financial::where('id', $financial->id)->first(),
        ];

        return view('financials.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFinancialRequest  $request
     * @param  \App\Models\Financial  $financial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Financial $financial)
    {
        $validate = $this->validation('update', $request);
        if ($validate->fails()) {
            return redirect('financial/' . $financial->id . '/edit')->withErrors($validate)->withInput();
        }

        if ($financial::where('id', $financial->id)->count() == 0) {
            return redirect('financial')->with('notif-x', 'maaf anda tidak diperkenankan mengakses');
        }

        $data = [
            'user_id'      => Auth::user()->id,
            'name'         => $request->input('name'),
            'category'     => $request->input('category'),
            'value'        => $request->input('value'),
            'description'  => $request->input('description'),
            'created_at'   => $request->input('created_at'),
        ];

        $result = Financial::where('id', $financial->id)->update($data);
        if ($result == true) {
            return redirect('financial')->with('notif-y', 'sukses');
        } else {
            return redirect('financial/' . $financial->id . '/edit')->with('notif-x', 'error')->withInput();
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Financial  $financial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Financial $financial)
    {
        if ($financial::where('id', $financial->id)->count() == 0) {
            return redirect('financial')->with('notif-x', 'maaf anda tidak diperkenankan mengakses');
        }

        $result = $financial::destroy($financial->id);
        if ($result == true) {
            return redirect('financial')->with('notif-y', 'sukses');
        } else {
            return redirect('financial')->with('notif-x', 'error');
        }
    }

    public function validation($type = false, $request)
    {
        switch ($type) {
            case 'login':
                break;

            case 'update':
                $validation = validator($request->all(), [
                    'name'                 => ['required', 'string', 'min:3', 'max:255'],
                    'category'             => ['required', 'string', 'min:3', 'max:255'],
                    'value'                => ['required', 'numeric', 'digits_between:1,20', 'min:100'],
                    'description'          => ['nullable', 'string', 'max:255'],
                    'created_at'           => ['required', 'date', 'after:2000-01-01', 'before:' . date('Y-m-d', strtotime('+1 days'))],
                ]);
                break;

            case 'update-img':
                break;

            default:
                $validation = validator($request->all(), [
                    'name'                 => ['required', 'string', 'min:3', 'max:255'],
                    'category'             => ['required', 'string', 'min:3', 'max:255'],
                    'value'                => ['required', 'numeric', 'digits_between:1,20', 'min:100'],
                    'description'          => ['nullable', 'string', 'max:255'],
                    'created_at'           => ['required', 'date', 'after:2000-01-01', 'before:' . date('Y-m-d', strtotime('+1 days'))],
                ]);
                break;
        }

        return $validation;
    }
}
