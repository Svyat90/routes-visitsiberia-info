<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontController;
use App\Services\Browser\ConstructorService;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;

class ConstructorController extends FrontController
{

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function choose(Request $request)
    {
        return view('front.pages.choose');
    }

    /**
     * @param Request $request
     * @param ConstructorService $constructorService
     * @return Application|Factory|View
     */
    public function constructor(Request $request, ConstructorService $constructorService)
    {
        $entities = $constructorService->getRouteData();

        return view('front.pages.constructor', compact('entities'));
    }

}
