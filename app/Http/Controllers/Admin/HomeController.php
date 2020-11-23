<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

class HomeController extends AdminController
{
    public function index()
    {
        return view('admin.home.index');
    }
}
