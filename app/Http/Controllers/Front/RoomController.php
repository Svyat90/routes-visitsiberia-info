<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontController;

class RoomController extends FrontController
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
