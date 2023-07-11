<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Api $api)
    {
        $customers = Customer::orderBy('name');

        if ($request->input('search')) {
            $customers
                ->where('name', 'like', '%' . $request->input('search') . '%')
                ->orwhere('phone', 'like', '%' . $request->input('search') . '%')
                ->orwhere('address', 'like', '%' . $request->input('search') . '%');
        }

        if (count($request->input()) == 0) {
            $data = $customers->get();
        } else {
            $data = $customers->paginate(8);
        }

        $cache_name = 'customerCache';
        $cache = cache($cache_name);
        Cache::put($cache_name, $data, now()->addMinutes(strtotime('1 minutes')));
        return $api->responseSuccess('Customer', $data);
    }

    public function show(Api $api, Customer $customer)
    {
        $customers = $customer::where('id', $customer->id);

        $check_customers = $customers->count();

        if ($check_customers == 0) {
            return $api->responseError('Data not found');
        }

        $data = $customers->first();
        $cache_name = 'customerCache';
        $cache = cache($cache_name);
        Cache::put($cache_name, $data, now()->addMinutes(strtotime('1 minutes')));
        return $api->responseSuccess('Customer', $data);
    }

    public function store(Request $request, Api $api)
    {
        $validate = $this->validation(false, $request);
        if ($validate->fails()) {
            return $api->errorValidation($validate);
        }

        $data = [
            'name'          => $request->input('name'),
            'phone'         => $request->input('phone'),
            'address'       => $request->input('address'),
        ];

        $result = Customer::create($data);
        if ($result == true) {
            return $api->responseSuccess('Success', $data);
        } else {
            return $api->responseError('Failed', $request);
        };
    }

    public function update(Request $request, Api $api, Customer $customer)
    {
        $validate = $this->validation('update', $request);
        if ($validate->fails()) {
            return $api->errorValidation($validate);
        }

        if ($customer::where('id', $customer->id)->count() == 0) {
            return $api->responseError('maaf anda tidak diperkenankan mengakses');
        }

        $data = [
            'name'          => $request->input('name'),
            'phone'         => $request->input('phone'),
            'address'       => $request->input('address'),
        ];

        $result = Customer::where('id', $customer->id)->update($data);
        if ($result == true) {
            return $api->responseSuccess('Success', $data);
        } else {
            return $api->responseError('Failed', $request);
        };
    }

    public function destroy(Api $api, Customer $customer)
    {
        if ($customer::where('id', $customer->id)->count() == 0) {
            return $api->responseError('maaf anda tidak diperkenankan mengakses');
        }

        $result = $customer::destroy($customer->id);
        if ($result == true) {
            return $api->responseSuccess('Success');
        } else {
            return $api->responseError('Failed or Data not found');
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
                    'phone'                 => ['required', 'numeric', 'digits_between:10,14'],
                ]);
                break;

            case 'update-img':
                break;

            default:
                $validation = validator($request->all(), [
                    'name'                  => ['required', 'string', 'min:3', 'max:50'],
                    'phone'                 => ['required', 'numeric', 'digits_between:10,14'],
                ]);
                break;
        }

        return $validation;
    }
}
