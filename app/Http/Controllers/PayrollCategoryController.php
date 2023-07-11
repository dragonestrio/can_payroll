<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePayroll_categoryRequest;
use App\Http\Requests\UpdatePayroll_categoryRequest;
use App\Models\Payroll_category;
use Illuminate\Http\Request;

class PayrollCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $payroll_categories = Payroll_category::latest();

        if ($request->input('search')) {
            $payroll_categories
                ->where('name', 'like', '%' . $request->input('search') . '%');
        }

        $data = [
            'title'         => 'Kategori Penggajian',
            'app'           => env('APP_NAME'),
            'author'        => '',
            'description'   => '',
            'state'         => 'read',
            'position'      => 'payroll_category',
            'payroll_categories'      => $payroll_categories->simplePaginate(8),
        ];

        return view('payroll_categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title'         => 'Tambah Kategori Penggajian',
            'app'           => env('APP_NAME'),
            'author'        => '',
            'description'   => '',
            'state'         => 'create',
            'position'      => 'payroll_category',
        ];

        return view('payroll_categories.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePayroll_categoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $this->validation(false, $request);
        if ($validate->fails()) {
            return redirect('payroll_category/create')->withErrors($validate)->withInput();
        }

        $data = [
            'name'                  => $request->input('name'),
            'type'                  => $request->input('type'),
            'value_default'         => $request->input('value_default'),
            'description'           => $request->input('description'),
        ];

        $result = Payroll_category::create($data);
        if ($result == true) {
            return redirect('payroll_category')->with('notif-y', 'sukses');
        } else {
            return redirect('payroll_category/create')->with('notif-x', 'error')->withInput();
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payroll_category  $payroll_category
     * @return \Illuminate\Http\Response
     */
    public function show(Payroll_category $payroll_category)
    {
        // EMPTY
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payroll_category  $payroll_category
     * @return \Illuminate\Http\Response
     */
    public function edit(Payroll_category $payroll_category)
    {
        if ($payroll_category::where('id', $payroll_category->id)->count() == 0) {
            return redirect('payroll_category')->with('notif-x', 'maaf anda tidak diperkenankan mengakses');
        }

        $data = [
            'title'             => 'Perbarui Kategori Penggajian',
            'app'               => env('APP_NAME'),
            'author'            => '',
            'description'       => '',
            'state'             => 'update',
            'position'          => 'payroll_category',
            'payroll_categories'        => $payroll_category::where('id', $payroll_category->id)->first(),
        ];

        return view('payroll_categories.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePayroll_categoryRequest  $request
     * @param  \App\Models\Payroll_category  $payroll_category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payroll_category $payroll_category)
    {
        $validate = $this->validation('update', $request);
        if ($validate->fails()) {
            return redirect('payroll_category/' . $payroll_category->id . '/edit')->withErrors($validate)->withInput();
        }

        if ($payroll_category::where('id', $payroll_category->id)->count() == 0) {
            return redirect('payroll_category')->with('notif-x', 'maaf anda tidak diperkenankan mengakses');
        }

        $data = [
            'name'                  => $request->input('name'),
            'type'                  => $request->input('type'),
            'value_default'         => $request->input('value_default'),
            'description'           => $request->input('description'),
        ];

        $result = Payroll_category::where('id', $payroll_category->id)->update($data);
        if ($result == true) {
            return redirect('payroll_category')->with('notif-y', 'sukses');
        } else {
            return redirect('payroll_category/' . $payroll_category->id . '/edit')->with('notif-x', 'error')->withInput();
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payroll_category  $payroll_category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payroll_category $payroll_category)
    {
        if ($payroll_category::where('id', $payroll_category->id)->count() == 0) {
            return redirect('payroll_category')->with('notif-x', 'maaf anda tidak diperkenankan mengakses');
        }

        $result = $payroll_category::destroy($payroll_category->id);
        if ($result == true) {
            return redirect('payroll_category')->with('notif-y', 'sukses');
        } else {
            return redirect('payroll_category')->with('notif-x', 'error');
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
                    'type'                 => ['required', 'string', 'min:3', 'max:255'],
                    'value_default'        => ['nullable', 'numeric'],
                    'description'          => ['nullable', 'string', 'max:255'],
                ]);
                break;

            case 'update-img':
                break;

            default:
                $validation = validator($request->all(), [
                    'name'                 => ['required', 'string', 'min:3', 'max:255', 'unique:payroll_categories,name'],
                    'type'                 => ['required', 'string', 'min:3', 'max:255'],
                    'value_default'        => ['nullable', 'numeric'],
                    'description'          => ['nullable', 'string', 'max:255'],
                ]);
                break;
        }

        return $validation;
    }
}
