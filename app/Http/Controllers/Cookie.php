<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie as FacadesCookie;

class Cookie extends Controller
{
    public function check($keywoard = false)
    {
        ($keywoard == false) ? $name = 'satrio_n_w_csrf' : $name = $keywoard;

        if (isset($_COOKIE[$name])) {
            return true;
        } else {
            return false;
        }
    }

    public function show($keywoard = false)
    {
        ($keywoard == false) ? $name = 'satrio_n_w_csrf' : $name = $keywoard;
        return $_COOKIE[$name];
    }

    public function create($data, $type = false)
    {
        $name   = $data['name'];
        $value  = $data['value'];
        $path   = '/';

        switch ($type) {
            case 'day':
                $expires = time() + 86400;
                break;

            case 'week':
                $expires = time() + 604800;
                break;

            case 'month':
                $expires = time() + 2592000;
                break;

            case 'year':
                $expires = time() + 31104000;
                break;

            default:
                $expires = 0;
                break;
        }

        $make = setcookie($name, $value, $expires, $path);
        $result = $this->check($name);

        if ($result == true) {
            return true;
        } else {
            return false;
        }
    }

    public function update($data, $type = false)
    {
        $this->create($data, $type);
    }

    public function destroy($keywoard = false)
    {
        ($keywoard == false) ? $name = 'satrio_n_w_csrf' : $name = $keywoard;
        setcookie($name, null, -1, '/');

        $result = $this->check($name);
        if ($result == false) {
            return true;
        } else {
            return false;
        }
    }
}
