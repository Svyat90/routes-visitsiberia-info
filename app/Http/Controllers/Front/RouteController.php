<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontController;

class RouteController extends FrontController
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
