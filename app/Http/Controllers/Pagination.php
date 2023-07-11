<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class Pagination extends Controller
{
    public function convert($items, $perPage = 8, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        $result = new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
        return $result->withPath(url()->current());
    }
}
