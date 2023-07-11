<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use Str;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $employees = Employee::orderBy('name', 'asc');

        if ($request->input('search')) {
            $employees
                ->where('name', 'like', '%' . $request->input('search') . '%')
                ->orwhere('section', 'like', '%' . $request->input('search') . '%')
                ->orwhere('email', 'like', '%' . $request->input('search') . '%')
                ->orwhere('basic_salary', 'like', '%' . $request->input('search') . '%');
        }

        $data = [
            'title'         => 'Karyawan',
            'app'           => env('APP_NAME'),
            'author'        => '',
            'description'   => '',
            'state'         => 'read',
            'position'      => 'employee',
            'employees'      => $employees->simplePaginate(8),
        ];

        return view('employees.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title'         => 'Tambah Karyawan',
            'app'           => env('APP_NAME'),
            'author'        => '',
            'description'   => '',
            'state'         => 'create',
            'position'      => 'employee',
        ];

        return view('employees.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $this->validation(false, $request);
        if ($validate->fails()) {
            return redirect('employee/create')->withErrors($validate)->withInput();
        }

        $data = [
            'id'            => $this->id_generate(),
            'name'          => $request->input('name'),
            'section'       => $request->input('section'),
            'email'         => $request->input('email'),
            'basic_salary'  => $request->input('basic_salary'),
        ];

        $result = Employee::create($data);
        if ($result == true) {
            return redirect('employee')->with('notif-y', 'sukses');
        } else {
            return redirect('employee/create')->with('notif-x', 'error')->withInput();
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        // EMPTY
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        if ($employee::where('id', $employee->id)->count() == 0) {
            return redirect('employee')->with('notif-x', 'maaf anda tidak diperkenankan mengakses');
        }

        $data = [
            'title'             => 'Perbarui Karyawan',
            'app'               => env('APP_NAME'),
            'author'            => '',
            'description'       => '',
            'state'             => 'update',
            'position'          => 'employee',
            'employees'          => $employee::where('id', $employee->id)->first(),
        ];

        return view('employees.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeeRequest  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $validate = $this->validation('update', $request);
        if ($validate->fails()) {
            return redirect('employee/' . $employee->id . '/edit')->withErrors($validate)->withInput();
        }

        if ($employee::where('id', $employee->id)->count() == 0) {
            return redirect('employee')->with('notif-x', 'maaf anda tidak diperkenankan mengakses');
        }

        $data = [
            'name'          => $request->input('name'),
            'section'       => $request->input('section'),
            'email'         => $request->input('email'),
            'basic_salary'  => $request->input('basic_salary'),
        ];

        $result = Employee::where('id', $employee->id)->update($data);
        if ($result == true) {
            return redirect('employee')->with('notif-y', 'sukses');
        } else {
            return redirect('employee/' . $employee->id . '/edit')->with('notif-x', 'error')->withInput();
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        if ($employee::where('id', $employee->id)->count() == 0) {
            return redirect('employee')->with('notif-x', 'maaf anda tidak diperkenankan mengakses');
        }

        $result = $employee::destroy($employee->id);
        if ($result == true) {
            return redirect('employee')->with('notif-y', 'sukses');
        } else {
            return redirect('employee')->with('notif-x', 'error');
        }
    }

    public function id_generate()
    {
        $main = md5(Str::random(255));
        $check = Employee::where('id', $main)->count();

        if ($check == 0) {
            return $main;
        } else {
            return $this->id_generate();
        }
    }

    public function validation($type = false, $request)
    {
        switch ($type) {
            case 'login':
                break;

            case 'update':
                $validation = validator($request->all(), [
                    'name'                  => ['required', 'string', 'min:3', 'max:50'],
                    'section'               => ['required', 'string', 'min:3', 'max:255'],
                    'email'                 => ['required', 'email:rfc,dns', 'max:255'],
                    'basic_salary'          => ['required', 'numeric', 'digits_between: 1,20', 'min:1000'],
                ]);
                break;

            case 'update-img':
                break;

            default:
                $validation = validator($request->all(), [
                    'name'                  => ['required', 'string', 'min:3', 'max:50'],
                    'section'               => ['required', 'string', 'min:3', 'max:255'],
                    'email'                 => ['required', 'email:rfc,dns', 'unique:employees,email', 'max:255'],
                    'basic_salary'          => ['required', 'numeric', 'digits_between: 1,20', 'min:1000'],
                ]);
                break;
        }

        return $validation;
    }
}
