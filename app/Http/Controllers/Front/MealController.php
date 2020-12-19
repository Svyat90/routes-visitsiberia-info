<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontController;

class MealController extends FrontController
{

    public function index()
    {
        return view('front.meals.index');
    }

    public function show()
    {
        return view('front.meals.show');
    }
}
