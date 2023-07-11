<?php

namespace App\Http\Controllers;

use App\Models\Financial;
use App\Models\LoginHistory;
use App\Models\Payroll;
use App\Models\Payroll_detail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'title'         => 'Home',
            'app'           => env('APP_NAME'),
            'author'        => '',
            'description'   => '',
            'state'         => 'read',
            'position'      => 'home',
        ];
        return view('welcome', $data);
    }

    // public function register_index(Request $request)
    // {
    //     $data = [
    //         'title'         => 'Register',
    //         'app'           => env('APP_NAME'),
    //         'author'        => '',
    //         'description'   => '',
    //         'state'         => 'read',
    //         'position'      => 'register',
    //     ];

    //     return view('register', $data);
    // }

    public function login_index(Request $request)
    {
        $cookie = new Cookie;
        $ck_name = 'satrio_n_w_remember-me';
        $cookie_check = $cookie->check($ck_name);
        ($cookie_check == false) ?: $recent_email = $cookie->show($ck_name);

        $data = [
            'title'         => 'Login',
            'app'           => env('APP_NAME'),
            'author'        => '',
            'description'   => '',
            'state'         => 'read',
            'position'      => 'login',
            'recent_email'  => ($recent_email) ?? ''
        ];

        return view('login', $data);
    }

    public function dashboard(Request $request)
    {
        $role = Auth::user()->getRoleNames()->first();
        switch ($role) {
            case 'superadmin':
            case 'admin':
                return $this->dashboard_admin();
                break;

            default:
                return abort(404);
                // return redirect('/')->with('notif-x', 'Error');
                // return $this->dashboard_user($request);
                break;
        }
    }

    // public function dashboard_user(Request $request)
    // {
    //     $mhs = Mhs::latest();

    //     if ($request->input('search')) {
    //         $mhs
    //             ->where('nim', 'like', '%' . $request->input('search') . '%')
    //             ->orwhere('nama', 'like', '%' . $request->input('search') . '%');
    //     }

    //     $data = [
    //         'title'         => 'Dashboard',
    //         'app'           => env('APP_NAME'),
    //         'author'        => '',
    //         'description'   => '',
    //         'state'         => 'read',
    //         'position'      => 'dashboard',
    //         'mhs'           => $mhs->simplePaginate(8),
    //     ];

    //     return view('dashboard.user', $data);
    // }

    public function dashboard_admin()
    {
        $before = 13;
        $color = ['red', 'blue', 'green', 'orange', 'purple', 'magenta'];
        $sort = (request()->input('sort') == null) ? 'month' : request()->input('sort');

        $time_before_set = [];
        $time_before_set_label = [];
        for ($aa = 0; $aa < $before; $aa++) {
            array_push($time_before_set, date('Y-m-d H', strtotime('-' . $aa . 'hours')));
            array_push($time_before_set_label, date('H', strtotime('-' . $aa . 'hours')));
        }
        $day_before_set = [];
        $day_before_set_label = [];
        for ($ab = 0; $ab < $before; $ab++) {
            array_push($day_before_set, date('Y-m-d', strtotime('-' . $ab . 'days')));
            array_push($day_before_set_label, date('D', strtotime('-' . $ab . 'days')));
        }
        $month_before_set = [];
        $month_before_set_label = [];
        for ($ac = 0; $ac < $before; $ac++) {
            array_push($month_before_set, date('Y-m', strtotime('-' . $ac . 'months')));
            array_push($month_before_set_label, date('M', strtotime('-' . $ac . 'months')));
        }
        $years_before_set = [];
        $years_before_set_label = [];
        for ($ad = 0; $ad < $before; $ad++) {
            array_push($years_before_set, date('Y', strtotime('-' . $ad . 'years')));
            array_push($years_before_set_label, date('Y', strtotime('-' . $ad . 'years')));
        }

        $before_set = [
            'time'  => [
                'label' => $time_before_set_label,
                'data'  => $time_before_set,
            ],
            'day'  => [
                'label' => $day_before_set_label,
                'data'  => $day_before_set,
            ],
            'month'  => [
                'label' => $month_before_set_label,
                'data'  => $month_before_set,
            ],
            'year'  => [
                'label' => $years_before_set_label,
                'data'  => $years_before_set,
            ],
        ];

        $before_set = json_decode(json_encode($before_set));
        switch ($sort) {
            case 'time':
                $filter = $before_set->time;
                break;
            case 'day':
                $filter = $before_set->day;
                break;
            case 'month':
                $filter = $before_set->month;
                break;
            case 'year':
                $filter = $before_set->year;
                break;
            default:
                $filter = null;
                break;
        }

        // db side
        $data_report = [];
        $label = [];
        $penggajian = [];
        $pemasukan = [];
        $pengeluaran = [];
        $pengeluaran_penggajian = [];

        foreach ($filter->data as $key => $value) {
            $payroll = Payroll_detail::with('payrolls')->whereHas('payrolls', function($query) use($value) {
                $query->where('date', 'like', '%' . $value . '%');
            })->sum('value');
            array_push($penggajian, $payroll);
            $financial_in = Financial::where('created_at', 'like', '%' . $value . '%')->where('category', 'additional')->sum('value');
            array_push($pemasukan, $financial_in);
            $financial_out = Financial::where('created_at', 'like', '%' . $value . '%')->where('category', 'deductions')->sum('value');
            array_push($pengeluaran, $financial_out);
            array_push($pengeluaran_penggajian, $financial_out + $payroll);
            array_push($label, $value);
        }

        $data_report['penggajian'] = $penggajian;
        $data_report['pemasukan'] = $pemasukan;
        $data_report['pengeluaran'] = $pengeluaran;
        $data_report['pengeluaran_penggajian'] = $pengeluaran_penggajian;
        $data_report['label'] = $label;
        //

        // dd($data_report);
        $data = [
            'title'         => 'Dashboard',
            'app'           => env('APP_NAME'),
            'author'        => '',
            'description'   => '',
            'state'         => 'read',
            'position'      => 'dashboard',
            'report'        => json_decode(json_encode($data_report)),
        ];

        return view('dashboard.admin', $data);
    }

    public function report(Request $request)
    {
        $data = [
            'title'         => 'Cetak Laporan Keuangan',
            'app'           => env('APP_NAME'),
            'author'        => '',
            'description'   => '',
            'state'         => 'read',
            'position'      => 'report',
        ];

        return view('report.index', $data);
    }

    public function report_process(Request $request)
    {
        $financial_addition = [];
        $financial_deduction = [];

        $date_find = $request->input('date');
        $financial = Financial::where('created_at', 'like', '%' . $date_find . '%')->latest()->get();
        $payroll = Payroll::with('payroll_details')->where('date', 'like', '%' . $date_find . '%')->latest()->get();

        foreach ($financial as $key => $value) {
            switch ($value->category) {
                case 'additional':
                    array_push($financial_addition, $value);
                    break;
                case 'deductions':
                    array_push($financial_deduction, $value);
                    break;

                default:
                    # code...
                    break;
            }
        }

        $financial_addition = json_decode(json_encode($financial_addition));
        $financial_deduction = json_decode(json_encode($financial_deduction));
        $financial = [
            'addition' => $financial_addition,
            'deduction' => $financial_deduction,
        ];

        $data = [
            'title'         => 'Laporan Keuangan Periode '. date('M Y', strtotime($date_find)),
            'app'           => env('APP_NAME'),
            'author'        => '',
            'description'   => '',
            'state'         => 'read',
            'position'      => 'report',
            'date_find'     => $date_find,
            'payroll'       => $payroll,
            'financial'     => json_decode(json_encode($financial)),
        ];

        return view('report.print', $data);
    }
}
