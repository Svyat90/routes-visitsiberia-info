<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;

class MealController extends Controller
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
