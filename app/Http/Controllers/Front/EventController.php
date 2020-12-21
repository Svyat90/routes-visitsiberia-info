<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontController;

class EventController extends FrontController
{

    public function index()
    {

        return view('front.events.index');
    }

    public function show()
    {
        return view('front.events.show');
    }
}
