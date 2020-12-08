<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;

class RoomController extends Controller
{

    public function index()
    {
        return view('front.rooms.index');
    }

    public function show()
    {
        return view('front.rooms.show');
    }
}
