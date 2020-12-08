<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;

class PlaceController extends Controller
{

    public function index()
    {
        return view('front.places.index');
    }

    public function show()
    {
        return view('front.places.show');
    }

}
