<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FinancialController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PayrollCategoryController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::name('logout')->group(function () {
    Route::get('logout', [UserController::class, 'logout'])->name('logout');
    Route::post('logout', [UserController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {
    // home
    Route::get('/', [HomeController::class, 'login_index'])->name('home');
    //
    // register
    // Route::get('register', [HomeController::class, 'register_index'])->name('register');
    // Route::post('register', [UserController::class, 'register'])->name('register.store');
    //
    // login
    Route::get('login', [HomeController::class, 'login_index'])->name('login');
    Route::post('login', [UserController::class, 'login'])->name('login.authenticate');
    //
});

Route::middleware('auth')->group(function () {
    // dashboard
    Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    //
    // profile
    Route::get('profile', [UserController::class, 'profile_index'])->name('profile');
    Route::get('profile/edit', [UserController::class, 'edit'])->name('profile.edit');
    Route::get('profile/change_password', [UserController::class, 'edit'])->name('profile.change_password');
    //

    Route::middleware(['role:user'])->group(function () {
        //
    });

    Route::middleware(['role:admin|superadmin'])->group(function () {
        // user
        Route::resource('user', UserController::class);
        Route::get('user/{user}/change_password', [UserController::class, 'change_passwd_index'])->name('user.change_passwd');
        Route::put('user/{user}/change_password', [UserController::class, 'change_passwd'])->name('user.change_passwd.update');
        Route::patch('user/{user}/change_password', [UserController::class, 'change_passwd'])->name('user.change_passwd.update');
        //
        // employee
        Route::resource('employee', EmployeeController::class);
        //
        // financial
        Route::resource('financial', FinancialController::class);
        //
        // payroll_category
        Route::resource('payroll_category', PayrollCategoryController::class);
        //
        // payroll
        Route::resource('payroll', PayrollController::class)->except('update');
        Route::post('payroll/create', [PayrollController::class, 'create'])->name('payroll.create.next');
        Route::post('payroll/{payroll}/edit', [PayrollController::class, 'edit'])->name('payroll.edit.next');
        //
        // report
        Route::get('report', [HomeController::class, 'report'])->name('report.index');
        Route::post('report/generate', [HomeController::class, 'report_process'])->name('report.index');
        //

    });
});
