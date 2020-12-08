<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{

    public function index()
    {
        return view('front.routes.index');
    }

    public function show()
    {
        return view('front.routes.show');
    }
}
