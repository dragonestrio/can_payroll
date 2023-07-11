<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Mail as ControllersMail;
use App\Http\Requests\StorePayrollRequest;
use App\Http\Requests\UpdatePayrollRequest;
use App\Mail\Payroll as MailPayroll;
use App\Models\Employee;
use App\Models\Payroll;
use App\Models\Payroll_category;
use App\Models\Payroll_detail;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Mail;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $payrolls = Payroll::with('users', 'employees', 'payroll_details')->latest();

        if ($request->input('search')) {
            $check_date = DateTime::createFromFormat('Y-m-d', $request->input('search'));
            ($check_date == false) ?: $payrolls->whereDate('date', $request->input('search'));
            $payrolls
                ->where('description', 'like', '%' . $request->input('search') . '%')
                ->orwhereHas('employees', function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->input('search') . '%');
                });
        }

        $data = [
            'title'         => 'Gajian',
            'app'           => env('APP_NAME'),
            'author'        => '',
            'description'   => '',
            'state'         => 'read',
            'position'      => 'payroll',
            'payrolls'      => $payrolls->simplePaginate(8),
        ];

        return view('payrolls.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $payroll = [];
        $payroll_details = [];
        $employee_list = [];

        $format_payroll_details = [
            // 'payroll_id'            => null,
            'payroll_category_id'   => null,
            'name'                  => null,
            'type'                  => 'dynamic',
            'value'                 => null,
            'description'           => null,
        ];

        $employee = Employee::get();
        foreach ($employee as $key => $value) {
            $employee_list[$value->id] = $value->name;
        };
        ($request->input('employee_id') == null) ? $employee_basic_salary = 0
            : $employee_basic_salary = $employee->where('id', $request->input('employee_id'))->first()->basic_salary;

        $payroll_category = Payroll_category::orderBy('created_at', 'asc')->get();
        if ($request->input('payroll_details') != null) {
            $payroll_details = $request->input('payroll_details');
            ($request->input('add') == null) ?: array_push($payroll_details, $format_payroll_details);
        } else {
            array_push($payroll_details, $format_payroll_details);
            $payroll_details[0]['payroll_category_id'] = null;
            $payroll_details[0]['name'] = 'Gaji Pokok';
            $payroll_details[0]['type'] = 'static';
            $payroll_details[0]['value'] = $employee_basic_salary;

            foreach ($payroll_category as $key => $value) {
                array_push($payroll_details, $format_payroll_details);
                $payroll_details[$key + 1]['payroll_category_id'] = $value->id;
                $payroll_details[$key + 1]['name'] = $value->name;
                $payroll_details[$key + 1]['type'] = $value->type;
                $payroll_details[$key + 1]['value'] = $value->value_default;
            }
        }

        $data = [
            'title'         => 'Tambah Gajian',
            'app'           => env('APP_NAME'),
            'author'        => '',
            'description'   => '',
            'state'         => 'create',
            'position'      => 'payroll',
            'employees'     => $employee_list,
            'employee_basic_salaries' => $employee_basic_salary,
            'payroll_categories' => json_decode(json_encode($payroll_details)),
            'payroll_details'    => ($request->input('payroll_details') == null) ?: $payroll_details,
        ];

        return view('payrolls.form-create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePayrollRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $this->validation(false, $request);
        if ($validate->fails()) {
            return redirect('payroll/create')->withErrors($validate)->withInput();
        }

        $payroll_last_id = Payroll::withTrashed()->latest()->first();
        ($payroll_last_id == null) ? $payroll_next_id = 1 : $payroll_next_id = (int) $payroll_last_id->id + 1;
        $data_payroll_details = $request->input('payroll_details');
        for ($i = 0; $i < count($data_payroll_details); $i++) {
            $data_payroll_details[$i]['payroll_id'] = $payroll_next_id;
        }

        $data_payroll = [
            'id'            => $payroll_next_id,
            'user_id'       => Auth::id(),
            'employee_id'   => $request->input('employee_id'),
            'date'          => date('Y-m-d', strtotime($request->input('date'))),
            'description'   => $request->input('description'),
        ];

        $employees = Employee::where('id', $data_payroll['employee_id'])->first();
        $users = User::where('id', $data_payroll['user_id'])->first();
        $data_email = [
            'title'             => 'Penggajian ' . $users->name . ' pada tanggal ' . date('M Y', strtotime($data_payroll['date'])),
            'app'               => env('APP_NAME'),
            'author'            => '',
            'description'       => '',
            'state'             => 'email',
            'position'          => 'payroll',
            'payrolls'          => json_decode(json_encode($data_payroll)),
            'payroll_details'   => json_decode(json_encode($data_payroll_details)),
            'users'             => $users,
            'employees'         => $employees,
        ];

        $result = (new ControllersMail)->send(
            $employees->email,
            env('MAIL_FROM_ADDRESS'),
            env('APP_NAME'),
            ucwords('slip gaji ' . date('M Y', strtotime($data_payroll['date']))),
            null,
            null,
            $data_email,
            'partials.email.payroll'
        );

        Payroll::create($data_payroll);
        foreach ($data_payroll_details as $key => $value) {
            Payroll_detail::create($value);
        }

        if ($result == true) {
            return redirect('payroll')->with('notif-y', 'sukses');
        } else {
            return redirect('payroll/create')->with('notif-x', 'error')->withInput();
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payroll  $payroll
     * @return \Illuminate\Http\Response
     */
    public function show(Payroll $payroll)
    {
        $payrolls = $payroll::with('users', 'employees', 'payroll_details')->where('id', $payroll->id)->first();

        $data = [
            'title'         => 'Lihat user',
            'app'           => env('APP_NAME'),
            'author'        => '',
            'description'   => '',
            'state'         => 'read',
            'position'      => 'payroll',
            'payrolls'      => $payrolls,
            'employees'     => $payrolls->employees()->first(),
            'users'         => $payrolls->users()->first(),
            'payroll_details' => $payrolls->payroll_details()->get()
        ];

        return view('payrolls.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payroll  $payroll
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Payroll $payroll)
    {
        if ($payroll::where('id', $payroll->id)->count() == 0) {
            return redirect('payroll')->with('notif-x', 'maaf anda tidak diperkenankan mengakses');
        }

        $payrolls = $payroll::with('users', 'employees', 'payroll_details')->where('payrolls.id', $payroll->id)->first();
        $payroll_details = [];
        $employee_list = [];

        $format_payroll_details = [
            // 'payroll_id'            => null,
            'payroll_category_id'   => null,
            'name'                  => null,
            'type'                  => 'dynamic',
            'value'                 => null,
            'description'           => null,
            'id'                    => null,
        ];

        $employee = Employee::get();
        foreach ($employee as $key => $value) {
            $employee_list[$value->id] = $value->name;
        };
        ($request->input('employee_id') == null) ? $employee_basic_salary = 0
            : $employee_basic_salary = $employee->find($request->input('employee_id'))->first()->basic_salary;

        $payroll_category = Payroll_category::orderBy('created_at', 'asc')->get();
        if ($request->input('payroll_details') != null) {
            $payroll_details = $request->input('payroll_details');
            ($request->input('add') == null) ?: array_push($payroll_details, $format_payroll_details);
        } else {
            foreach ($payrolls->payroll_details()->get() as $key => $value) {
                array_push($payroll_details, $format_payroll_details);
                $payroll_details[$key]['payroll_category_id'] = $value->payroll_category_id;
                $payroll_details[$key]['name'] = $value->name;
                $payroll_details[$key]['type'] = $value->type;
                $payroll_details[$key]['value'] = $value->value;
                $payroll_details[$key]['description'] = $value->description;
                $payroll_details[$key]['id'] = $value->id;
            }
        }

        if ($request->input('submit') != null) {
            return $this->update($request, $payroll);
        }

        $data = [
            'title'             => 'Perbarui Gajian',
            'app'               => env('APP_NAME'),
            'author'            => '',
            'description'       => '',
            'state'             => 'update',
            'position'          => 'payroll',
            'employees'         => $employee_list,
            'employee_basic_salaries' => $employee_basic_salary,
            'payroll_categories' => json_decode(json_encode($payroll_details)),
            'payroll_details'    => ($request->input('payroll_details') == null) ?: $payroll_details,
            'payrolls'           => $payrolls,
        ];

        return view('payrolls.form-update', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePayrollRequest  $request
     * @param  \App\Models\Payroll  $payroll
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payroll $payroll)
    {
        $validate = $this->validation('update', $request);
        if ($validate->fails()) {
            return redirect('payroll/' . $payroll->id . '/edit')->withErrors($validate)->withInput();
        }

        if ($payroll::where('id', $payroll->id)->count() == 0) {
            return redirect('payroll')->with('notif-x', 'maaf anda tidak diperkenankan mengakses');
        }

        $data_payroll_details = $request->input('payroll_details');
        for ($i = 0; $i < count($data_payroll_details); $i++) {
            $data_payroll_details[$i]['payroll_id'] = $payroll->id;
            if ($data_payroll_details[$i]['id'] == null) {
                unset($data_payroll_details[$i]['id']);
            }
        }

        $data_payroll = [
            // 'id'            => $payroll_next_id,
            'user_id'       => Auth::id(),
            'employee_id'   => $request->input('employee_id'),
            'date'          => date('Y-m-d', strtotime($request->input('date'))),
            'description'   => $request->input('description'),
        ];

        $employees = Employee::where('id', $data_payroll['employee_id'])->first();
        $users = User::where('id', $data_payroll['user_id'])->first();
        $data_email = [
            'title'             => 'Penggajian ' . $users->name . ' pada tanggal ' . date('M Y', strtotime($data_payroll['date'])),
            'app'               => env('APP_NAME'),
            'author'            => '',
            'description'       => '',
            'state'             => 'email',
            'position'          => 'payroll',
            'payrolls'          => json_decode(json_encode($data_payroll)),
            'payroll_details'   => json_decode(json_encode($data_payroll_details)),
            'users'             => $users,
            'employees'         => $employees,
        ];

        $result = (new ControllersMail)->send(
            $employees->email,
            env('MAIL_FROM_ADDRESS'),
            env('APP_NAME'),
            ucwords('update slip gaji ' . date('M Y', strtotime($data_payroll['date']))),
            null,
            null,
            $data_email,
            'partials.email.payroll'
        );

        foreach ($data_payroll_details as $key => $value) {
            if (isset($value['id'])) {
                Payroll_detail::where('id', $value['id'])->update($value);
            } else {
                Payroll_detail::create($value);
            }
        }

        Payroll::where('id', $payroll->id)->update($data_payroll);
        if ($result == true) {
            return redirect('payroll')->with('notif-y', 'sukses');
        } else {
            return redirect('payroll/' . $payroll->id . '/edit')->with('notif-x', 'error')->withInput();
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payroll  $payroll
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payroll $payroll)
    {
        if ($payroll::where('id', $payroll->id)->count() == 0) {
            return redirect('payroll')->with('notif-x', 'maaf anda tidak diperkenankan mengakses');
        }

        $test = Payroll_detail::where('payroll_id', $payroll->id)->delete();
        $result = $payroll::destroy($payroll->id);
        if ($result == true) {
            return redirect('payroll')->with('notif-y', 'sukses');
        } else {
            return redirect('payroll')->with('notif-x', 'error');
        }
    }

    public function validation($type = false, $request)
    {
        switch ($type) {
            case 'login':
                break;

            case 'update':
                $validation = validator($request->all(), [
                    'date'                  => ['required', 'date'],
                    'employee_id'           => ['required', 'string', 'exists:employees,id'],
                    'payroll_details'       => ['required', 'array'],
                ]);
                break;

            case 'update-img':
                break;

            default:
                $validation = validator($request->all(), [
                    'date'                  => ['required', 'date'],
                    'employee_id'           => ['required', 'string', 'exists:employees,id'],
                    'payroll_details'       => ['required', 'array'],
                ]);
                break;
        }

        return $validation;
    }
}
