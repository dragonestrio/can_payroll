<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePayroll_detailRequest;
use App\Http\Requests\UpdatePayroll_detailRequest;
use App\Models\Payroll_detail;

class PayrollDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePayroll_detailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePayroll_detailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payroll_detail  $payroll_detail
     * @return \Illuminate\Http\Response
     */
    public function show(Payroll_detail $payroll_detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payroll_detail  $payroll_detail
     * @return \Illuminate\Http\Response
     */
    public function edit(Payroll_detail $payroll_detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePayroll_detailRequest  $request
     * @param  \App\Models\Payroll_detail  $payroll_detail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePayroll_detailRequest $request, Payroll_detail $payroll_detail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payroll_detail  $payroll_detail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payroll_detail $payroll_detail)
    {
        //
    }
}
