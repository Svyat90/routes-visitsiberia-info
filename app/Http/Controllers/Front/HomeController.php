<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function index()
    {
        return view('front.home');
    }

    /**
     * @return RedirectResponse
     */
    public function redirectToHome() : RedirectResponse
    {
        return response()->redirectToRoute('front.home');
    }

}
