<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Api extends Controller
{
    public function sendGet($data = null, $url = null, $id = null)
    {
        if ($data == null && $url == null) {
            return $this->responseError('Data or Url is not valid', null);
        }

        if ($id == null) {
            $result = Http::withBody(json_encode($data), 'application/json')->get($url)->body();
        } else {
            $result = Http::withBody(json_encode($data), 'application/json')->get($url . '/' . $id)->body();
        }

        return json_decode($result);
    }

    public function sendPost($data = null, $url = null, $id = null)
    {
        if ($data == null && $url == null) {
            return $this->responseError('Data or Url is not valid', null);
        }

        if ($id == null) {
            $result = Http::withBody(json_encode($data), 'application/json')->post($url)->body();
        } else {
            $result = Http::withBody(json_encode($data), 'application/json')->post($url . '/' . $id)->body();
        }

        return json_decode($result);
    }

    public function responseSuccess($message, $data = null, int $code = 200)
    {
        return response([
            'code' => $code,
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public function responseError($message = null, $data = null, int $code = 401)
    {
        return response()->json([
            'code' => $code,
            'success' => false,
            'error' => $message,
            'data' => $data
        ], $code);
    }

    public function errorValidation($validator)
    {
        return response()->json([
            'code'  => 422,
            'success' => false,
            'error' => 'Failed to Validate',
            'data' => $validator->errors(),
        ], 422);
    }
}
