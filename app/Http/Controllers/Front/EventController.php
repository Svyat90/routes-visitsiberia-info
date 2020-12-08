<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;

class EventController extends Controller
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
